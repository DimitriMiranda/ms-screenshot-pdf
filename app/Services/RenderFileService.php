<?php

namespace App\Services;

use Storage;

class RenderFileService
{
    private $temp_path;
    private $file_name;

    public function __construct()
    {
        $this->temp_path = storage_path('app/temp-files/');
    }

    public function renderFile($file_type, $name)
    {
        try {
            return $this->temp_path . $name . '.' . $file_type;
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function createTempFile($file_type, $file_data)
    {
        try {
            $this->file_name = 'temp' . time();
            Storage::disk('temp-files')->put($this->file_name . '.' . $file_type, base64_decode($file_data));
            $reponse = new \stdClass();
            $reponse->file_name = $this->file_name;
            $reponse->file_type = $file_type;
            $reponse->acesss_route = request()->getSchemeAndHttpHost() . "/render-file/$file_type/$this->file_name";
            return $reponse;
        } catch (\Throwable $th) {
            throw $th;
        }
    }

}
