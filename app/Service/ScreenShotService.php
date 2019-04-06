<?php

namespace App\Services;

use Storage;

class ScreenShotService
{
    private $file_data;
    private $file_name;
    private $screenshotnumber;
    private $temp_path;

    public function __construct()
    {
        $this->temp_path = storage_path('app/temp-files/');
    }

    public function screenShotFromPdf($file_data, $screenshotnumber)
    {
        try {
            $this->file_data = $file_data;
            $this->createTemporaryFiles();
            // $pdf_handle = fopen(storage_path('app/temp-files/'.$this->file_name), 'rb');
            $pdf_handle = fopen($this->temp_path.'/'.$this->file_name, 'rb');
            $doc_preview = new \Imagick();
            $doc_preview->setResolution(180, 180);
            $doc_preview->readImageFile($pdf_handle);
            $doc_preview->setIteratorIndex(0);
            $doc_preview->setImageFormat('jpeg');

            //$tmpscreenpath = storage_path('app/temp-files/');
            $tmpscreenpath = $this->temp_path;
            $tmpscreenshortFileName = 'temp'.time();
            $doc_preview->writeImage($tmpscreenpath.$tmpscreenshortFileName.'.jpg');

            $reponse = new \stdClass();

            $reponse->screenshort_name = $tmpscreenshortFileName;
            $reponse->filebase64 = base64_encode($doc_preview->getImagesBlob());

            return $reponse;
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function createTemporaryFiles()
    {
        try {
            $this->file_name = 'temp'.time().'.pdf';

            return Storage::disk('temp-files')->put($this->file_name, base64_decode($this->file_data));
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
