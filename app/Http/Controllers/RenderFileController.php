<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use App\Services\RenderFileService;

class RenderFileController
{
    protected $renderFileService;

    public function __construct(RenderFileService $renderFileService)
    {
        $this->renderFileService = $renderFileService;
    }

    public function createTempFile(Request $request)
    {

        try {
            return response()->json($this->renderFileService->createTempFile(
                $request->input('file_type'),
                $request->input('file_data')
            ));
        } catch (\Throwable $th) {
            throw $th;
        }

    }

    public function renderFile($file_type, $name)
    {
        try {
            return response()->file(
                $this->renderFileService->renderFile($file_type, $name)
            );
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
