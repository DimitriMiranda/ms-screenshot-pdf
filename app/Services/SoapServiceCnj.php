<?php

namespace App\Services;

class SoapServiceCnj
{
    private $wsdl;
    private $idConsultante;
    private $senhaConsultante;
    private $soapClient;

    public function __construct()
    {
        try {
            $this->wsdl = "https://www.cnj.jus.br/sgt/sgt_ws.php?wsdl";
            $this->soapClient = new \SoapClient($this->wsdl, array(
                'soap_version' => SOAP_1_1,
                'trace' => 1,
                'encoding' => 'UTF-8',
                'exceptions' => 0,
            ));

        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function consultarItemPublico($tipoTabela, $tipoPesquisa, $valorPesquisa)
    {

        // dd($tipoTabela. '  ' .$tipoPesquisa.' '.$valorPesquisa);

        try {

            $response = $this->soapClient->__soapCall('pesquisarItemPublicoWS',
                array(
                    'tipoTabela' => $tipoTabela,
                    'tipoPesquisa' => $tipoPesquisa,
                    'valorPesquisa' => $valorPesquisa,
                ));

            if ($response) {
                return $response;
            } else {
                return ['error' => 'Item não encontrado', 'status' => 404];
            }

        } catch (\Throwable $th) {
            throw $th;
        }

    }

}
