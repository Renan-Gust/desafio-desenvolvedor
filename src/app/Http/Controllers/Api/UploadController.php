<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\CsvService;
use Illuminate\Http\Request;

class UploadController extends Controller
{
    public function index(Request $request, CsvService $service)
    {
        $request->validate([
            'file' => 'required|file|mimes:xlsx,csv'
        ]);

        $file = $request->file('file');

        $service->processUpload($file);

        return response()->json(['success' => true, 'message' => 'File sent successfully.']);
    }
}
