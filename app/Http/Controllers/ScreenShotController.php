<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ScreenShotService;

class ScreenShotController
{
    protected $screenShotService;

    public function __construct(ScreenShotService $screenShotService)
    {
        $this->soapServicePje = $screenShotService;
    }

    public function screenShotFromPdf(Request $request)
    {
        return response()->json(
        $this->soapServicePje->screenShotFromPdf(
          $request->input('file_base64'),
          $request->input('screenshotnumber')
        )
      );
    }
}
