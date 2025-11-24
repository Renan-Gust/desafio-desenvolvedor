<?php

namespace App\Helpers;

use Carbon\Carbon;
use Illuminate\Http\UploadedFile;

class CsvHelper
{
    public static function getValue(array $row, array $map, string $column)
    {
        return isset($map[$column]) ? ($row[$map[$column]] ?? null) : null;
    }

    public static function convertToUTF8(?string $value): ?string
    {
        if ($value === null) {
            return null;
        }

        $value = mb_convert_encoding($value, 'UTF-8', 'UTF-8, ISO-8859-1, ISO-8859-15, Windows-1252');

        return $value;
    }

    public static function extractDateFromFilename(string $filename): ?string
    {
        $date = null;

        if (preg_match('/_(\d{8})(?:_|\.csv$)/', $filename, $matches)) {
            $date = $matches[1];
        }

        if ($date) {
            $date = Carbon::createFromFormat('Ymd', $date);
            return $date?->toDateString();
        }

        return $date;
    }

    public static function guessFileExtension(UploadedFile $file): string
    {
        $mime = $file->getMimeType();

        $map = [
            'text/plain' => 'csv',
            'text/csv' => 'csv',
            'application/csv' => 'csv',
            'application/vnd.ms-excel' => 'xls',
            'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet' => 'xlsx',
        ];

        return $map[$mime] ?? 'csv';
    }
}
