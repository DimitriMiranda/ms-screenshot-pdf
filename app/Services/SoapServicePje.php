<?php

namespace App\Services;



use App\Services\SoapServiceCnj;

class SoapServicePje
{
    private $wsdl;
    private $idConsultante;
    private $senhaConsultante;
    private $soapClient;
    private $objSoapServiceCnj;

    public function __construct()
    {
        try {
            $this->wsdl = "https://pje.tjba.jus.br/pje-web/intercomunicacao?wsdl";
            $this->idConsultante = '17493080020';
            $this->senhaConsultante = 'DPEb@2019';
            //$this->
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

    public function consultarProcesso($numeroProcesso)
    {
        try {

            $this->soapClient->__soapCall('consultarProcesso',
                array(
                    'consultarProcesso' => array(
                        'idConsultante' => $this->idConsultante,
                        'senhaConsultante' => $this->senhaConsultante,
                        'numeroProcesso' => $numeroProcesso,
                        'movimentos' => 0,
                        'incluirCabecalho' => 0,
                        'incluirDocumentos' => 1,
                        //'documento' => '20805434'
                        'documento' => '20805434'
                        
                    ),
                )

            );
            return $xmlResponse = $this->soapClient->__getLastResponse();
           return $this->parseSimpleXMLElementConsultarProcessos($xmlResponse);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function parseSimpleXMLElementConsultarProcessos($xml)
    {
        try { 
            $xmlFormatado = removeCaractersEspeciaisConsultarProcesso($xml);
            $xmlFormatado = new \SimpleXMLElement($xmlFormatado);

           //dd($xmlFormatado->soapBody->ns4consultarProcessoResposta->processo->ns2documento[1]->ns2conteudo->xopInclude->attributes()['href']);
            
            // $cod_classe_processual = $xmlFormatado->soapBody->ns4consultarProcessoResposta->processo->ns2dadosBasicos->attributes()['classeProcessual'];
            // $cod_assunto_processual = $xmlFormatado->soapBody->ns4consultarProcessoResposta->processo->ns2dadosBasicos->ns2assunto->ns2codigoNacional;
            // $classeProcessual = (new SoapServiceCnj())->consultarItemPublico('C', 'C', $cod_classe_processual)[0];
            // $assuntoProcessual = (new SoapServiceCnj())->consultarItemPublico('A', 'C', $cod_assunto_processual)[0];
            // $xmlFormatado->soapBody->ns4consultarProcessoResposta->processo->ns2dadosBasicos->addAttribute('descricaoClasseProcessual', $classeProcessual->nome);
            // $xmlFormatado->soapBody->ns4consultarProcessoResposta->processo->ns2dadosBasicos->addAttribute('descricaoAssuntoProcessual', $assuntoProcessual->nome);
            return $xmlFormatado->soapBody->ns4consultarProcessoResposta->processo->ns2documento[1]->ns2conteudo->xopInclude->attributes()['href'];

        } catch (\Throwable $th) {
            throw $th;
        }
    }

}
