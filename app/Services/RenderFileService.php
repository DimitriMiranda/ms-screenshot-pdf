<?php

namespace App\Services;

class RenderFileService
{
    private $temp_path;

    public function __construct()
    {
        $this->temp_path = storage_path('app/temp-files/');
    }

    public function renderFile($file_type, $name)
    {
        try {
            return $this->temp_path.$name.'.'.$file_type;
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
