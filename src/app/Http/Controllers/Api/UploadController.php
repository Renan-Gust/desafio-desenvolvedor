<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ContentResource;
use App\Http\Resources\UploadResource;
use App\Services\CsvService;
use App\Services\UploadService;
use Illuminate\Http\Request;

class UploadController extends Controller
{
    public function store(Request $request, CsvService $service)
    {
        $request->validate(
            [
                'file' => 'required|file|mimetypes:text/csv,text/plain,application/csv,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
            ],
            [
                'file.mimetypes' => 'The file must be a CSV or XLSX file.',
                'file.required'  => 'A file is required.',
            ]
        );

        $file = $request->file('file');

        $upload = $service->processUpload($file);
        return (new UploadResource($upload))->additional(['success' => true, 'message' => 'File sent successfully.']);
    }

    public function searchUploads(Request $request, UploadService $service)
    {
        $validated = $request->validate([
            'filename' => 'nullable|string|min:1|max:255',
            'ref_date' => 'nullable|date_format:Y-m-d',
        ]);

        $uploads = $service->searchUploads($validated);
        return UploadResource::collection($uploads)->additional(['success' => true]);
    }

    public function searchContents(Request $request, UploadService $service)
    {
        $validated = $request->validate([
            'TckrSymb' => 'nullable|string|min:1|max:255',
            'RptDt'    => 'nullable|date_format:Y-m-d',
        ]);

        $contents = $service->searchContents($validated);
        return ContentResource::collection($contents)->additional(['success' => true]);
    }
}
