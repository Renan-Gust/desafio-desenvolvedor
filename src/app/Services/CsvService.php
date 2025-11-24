<?php

namespace App\Services;

use App\Helpers\CsvHelper;
use App\Models\Upload;
use App\Models\Content;
use Illuminate\Http\UploadedFile;

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

        $path = $file->storeAs('uploads', $filename, 'public');

        $upload = Upload::create([
            'filename' => $filename,
            'path'     => $path,
            'ref_date' => CsvHelper::extractDateFromFilename($originalName)
        ]);

        $this->importCsv(storage_path("app/public/uploads/$filename"), $upload->id);

        return $upload;
    }

    private function importCsv(string $path, int $uploadId): void
    {
        $handle = fopen($path, 'r');

        fgetcsv($handle, 0, ';'); // Ignore first line
        $header = fgetcsv($handle, 0, ';');

        $map = [];
        foreach ($header as $index => $name) {
            $map[$name] = $index;
        }

        $batch = [];
        $chunkSize = 1000;

        while (($row = fgetcsv($handle, 0, ';')) !== false) {
            $batch[] = [
                'upload_id'   => $uploadId,
                'RptDt'       => CsvHelper::getValue($row, $map, 'RptDt'),
                'TckrSymb'    => CsvHelper::convertToUTF8(CsvHelper::getValue($row, $map, 'TckrSymb')),
                'MktNm'       => CsvHelper::convertToUTF8(CsvHelper::getValue($row, $map, 'MktNm')),
                'SctyCtgyNm'  => CsvHelper::convertToUTF8(CsvHelper::getValue($row, $map, 'SctyCtgyNm')),
                'ISIN'        => CsvHelper::convertToUTF8(CsvHelper::getValue($row, $map, 'ISIN')),
                'CrpnNm'      => CsvHelper::convertToUTF8(CsvHelper::getValue($row, $map, 'CrpnNm')),
                'created_at'  => now(),
                'updated_at'  => now(),
            ];

            if (count($batch) >= $chunkSize) {
                Content::insert($batch);
                $batch = [];
            }
        }

        if (!empty($batch)) {
            Content::insert($batch);
        }

        fclose($handle);
    }
}
