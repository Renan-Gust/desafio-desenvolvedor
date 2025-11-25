<?php

namespace App\Services;

use App\Models\Content;
use App\Models\Upload;

class UploadService
{
    public function searchUploads(array $filters)
    {
        $query = Upload::query();

        if (!blank($filters['filename'] ?? null)) {
            $query->where('filename', 'like', '%' . $filters['filename'] . '%');
        }

        if (!blank($filters['ref_date'] ?? null)) {
            $query->whereDate('ref_date', $filters['ref_date']);
        }

        return $query->orderBy('created_at', 'desc')->paginate(20);
    }

    public function searchContents(array $filters)
    {
        $query = Content::query();

        if (!blank($filters['TckrSymb'] ?? null)) {
            $query->where('TckrSymb', $filters['TckrSymb']);
        }

        if (!blank($filters['RptDt'] ?? null)) {
            $query->whereDate('RptDt', $filters['RptDt']);
        }

        return $query->paginate(100);
    }
}
