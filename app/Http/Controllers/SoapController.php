<?php
namespace App\Http\Controllers;

use App\Services\SoapServiceCnj;
use App\Services\SoapServicePje;
use App\Services\RenderFileService;
use Response;

class SoapController
{

    protected $soapServicePje;

    public function __construct(SoapServicePje $soapServicePje, SoapServiceCnj $soapServiceCnj, RenderFileService $renderFileService)
    {
        $this->soapServicePje = $soapServicePje;
        $this->soapServiceCnj = $soapServiceCnj;
        $this->renderFileService = $renderFileService;
    }

    public function consultarProcessoPje($numeroProcesso)
    {
        $response = $this->soapServicePje->consultarProcesso($numeroProcesso);

       
        $this->renderFileService->createTempFile(
            'pdf',
            base64_encode($response)
            // $request->input('file_type'),
            // $request->input('file_data')
            



        );
        
        dd('');
        $filename = 'teste.pdf';

        return Response::make($response, 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="'.$filename.'"',
        ]);
              

        return 't';

        // return response()->json($response);
        //return $response = new BinaryFileResponse($path, 200 , $headers);
       

        return response()->json($this->renderFileService->createTempFile(
            // $request->input('file_type'),
            // $request->input('file_data')
            $request->json()->get('file_type'),
            $request->json()->get('file_data')
         ));
         
        return response()->file(
            $response
        );

        $file_contents = base64_decode(base64_encode($response));
        return response($file_contents)
          ->header('Cache-Control', 'no-cache private')
          ->header('Content-Description', 'File Transfer')
          ->header('Content-Type', 'pdf')
          ->header('Content-length', strlen($file_contents))
          ->header('Content-Disposition', 'attachment; filename=' . 'teste.pdf')
          ->header('Content-Transfer-Encoding', 'binary');


    }

    public function consultarItemPublicoCnj($tipoTabela, $tipoPesquisa, $valorPesquisa)
    {
        $response = $this->soapServiceCnj->consultarItemPublico(strtoupper($tipoTabela), strtoupper($tipoPesquisa), $valorPesquisa);
        return response()->json($response);
    }
}
