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

    
    public function screenShotFromPdf(Request $request) {
      // $input = $request->input('arquivo');
       // return $input;
         $this->soapServicePje->screenShotFromPdf($request->input('arquivo'));

    }


}
