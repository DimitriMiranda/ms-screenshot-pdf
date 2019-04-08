<?php

namespace App\Http\Controllers;

use App\Services\RenderFileService;

class RenderFileController
{
    protected $renderFileService;

    public function __construct(RenderFileService $renderFileService)
    {
        $this->renderFileService = $renderFileService;
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
