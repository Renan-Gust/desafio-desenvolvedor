<?php

namespace App\Services;

use App\Helpers\CsvHelper;
use App\Models\Upload;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use OpenSpout\Reader\XLSX\Reader;

class CsvService
{
    public function processUpload(UploadedFile $file): Upload
    {
        $originalName = $file->getClientOriginalName();
        if (Upload::where('filename', $originalName)->exists()) {
            abort(400, 'File has already been sent.');
        }

        $ext = strtolower($file->getClientOriginalExtension()) ?: CsvHelper::guessFileExtension($file);
        $name = pathinfo($originalName, PATHINFO_FILENAME);
        $filename = "{$name}.{$ext}";

        $savedFilePath = $file->storeAs('uploads', $filename, 'public');
        $savedFileAbsolutePath = Storage::disk('public')->path($savedFilePath);

        $upload = Upload::create([
            'filename' => $filename,
            'path'     => $savedFilePath,
            'ref_date' => CsvHelper::extractDateFromFilename($originalName)
        ]);

        if ($ext === 'csv') {
            $this->importCsv($savedFileAbsolutePath, $upload->id);
        } else {
            $this->importXlsx($savedFileAbsolutePath, $upload->id);
        }

        return $upload;
    }

    private function importCsv(string $path, int $uploadId): void
    {
        $handle = fopen($path, 'r');

        fgetcsv($handle, 0, ';'); // Ignore first line
        $header = fgetcsv($handle, 0, ';');

        $map = array_flip($header);
        $batch = [];
        $batchSize = 1000;

        while (($row = fgetcsv($handle, 0, ';')) !== false) {
            $batch[] = $this->fillBatch($row, $map, $uploadId);

            if (count($batch) >= $batchSize) {
                DB::table('contents')->insert($batch);
                $batch = [];
            }
        }

        if (!empty($batch)) {
            DB::table('contents')->insert($batch);
        }

        fclose($handle);
    }

    private function importXlsx(string $path, int $uploadId): void
    {
        $reader = new Reader();
        $reader->open($path);

        $map = [];
        $batch = [];
        $batchSize = 1000;

        foreach ($reader->getSheetIterator() as $sheet) {
            $rowNumber = 0;

            foreach ($sheet->getRowIterator() as $row) {
                $cells = $row->toArray();
                $rowNumber++;

                if ($rowNumber === 1) continue; // Skip first line
                if ($rowNumber === 2) {
                    $map = array_flip($cells); // Header
                    continue;
                }

                $batch[] = $this->fillBatch($cells, $map, $uploadId);

                if (count($batch) >= $batchSize) {
                    DB::table('contents')->insert($batch);
                    $batch = [];
                }
            }
        }

        if (!empty($batch)) {
            DB::table('contents')->insert($batch);
        }

        $reader->close();
    }

    private function fillBatch(array $cells, array $map, int $uploadId): array
    {
        return [
            'upload_id'   => $uploadId,
            'RptDt'       => CsvHelper::getValue($cells, $map, 'RptDt'),
            'TckrSymb'    => CsvHelper::convertToUTF8($cells[$map['TckrSymb']] ?? null),
            'MktNm'       => CsvHelper::convertToUTF8($cells[$map['MktNm']] ?? null),
            'SctyCtgyNm'  => CsvHelper::convertToUTF8($cells[$map['SctyCtgyNm']] ?? null),
            'ISIN'        => CsvHelper::convertToUTF8($cells[$map['ISIN']] ?? null),
            'CrpnNm'      => CsvHelper::convertToUTF8($cells[$map['CrpnNm']] ?? null),
            'created_at'  => now(),
            'updated_at'  => now(),
        ];
    }
}
