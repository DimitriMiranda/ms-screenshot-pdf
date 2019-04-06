<?php

namespace App\Services;

use Storage;

class ScreenShotService
{
    private $file_data;
    private $file_name;

    public function screenShotFromPdf($file_data)
    {
        try {
            

            $this->createTemporaryFiles();
            $myurl = Storage::disk('public')->get($this->file_name);
            $image = new \Imagick($myurl);
            // $image->setResolution( 300, 300 );
            // $image->setImageFormat( "png" );
           // return $image->getImagesBlob();
            
         
        } catch (\Throwable $th) {
            throw $th;
        }

    }

    public function createTemporaryFiles()
    {
        try {
            $this->file_name = 'temp' . time() . '.pdf';
            return Storage::disk('public')->put($this->file_name, base64_decode($this->file_data));
        } catch (\Throwable $th) {
            throw $th;
        }

    }

}
