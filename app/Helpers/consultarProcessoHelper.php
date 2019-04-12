<?php

if (!function_exists('removeCaractersEspeciaisConsultarProcesso')) {

    function removeCaractersEspeciaisConsultarProcesso($xml)
    {
        try {
            $response = '';
            $explode = explode("<root.message@cxf.apache.org>", $xml);
            //$explode = str_replace("--uuid:69f54230-aa77-4af8-ab7a-59ff5bf7c481--", "", $explode[1]);
            $explode = preg_split('/\n|\r\n?/', $explode[1]);
            $response = preg_replace("/(<\/?)(\w+):([^>]*>)/", "$1$2$3", $explode[2]);
            return $response;

        } catch (\Throwable $th) {
            throw $th;
        }

    }
}
