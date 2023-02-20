<?php

namespace Phpdev;

Class Kuveytturk
{
    
    
    public $username = "";
    public $pasword = "";
    public $musteri_no = "";
    
    function __construct($username, $password, $musteri_no, $musteri_suffix)
    {
        $this->username       = $username;
        $this->password       = $password;
        $this->musteri_no     = $musteri_no;
        $this->musteri_suffix = $musteri_suffix;
    }
    
    
    
    public function hesap_hareketleri($tarih1, $tarih2)
    {
        
        $curl = curl_init();
        
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://boa.kuveytturk.com.tr/BOA.Integration.WCFService/BOA.Integration.AccountStatement/AccountStatementService.svc/Basic",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "<soapenv:Envelope xmlns:soapenv=\"http://schemas.xmlsoap.org/soap/envelope/\" xmlns:ser=\"http://boa.net/BOA.Integration.CoreBanking.Teller/Service\" xmlns:boa=\"http://schemas.datacontract.org/2004/07/BOA.Integration.Base\" xmlns:boa1=\"http://schemas.datacontract.org/2004/07/BOA.Integration.Model.CoreBanking.Teller\">\r\n   <soapenv:Header/>\r\n   <soapenv:Body>\r\n      <ser:GetAccountStatement>\r\n         <!--Optional:-->\r\n         <ser:request>\r\n  \r\n            <boa:ExtUName>" . $this->username . "</boa:ExtUName>\r\n            <!--Optional:-->\r\n            <boa:ExtUPassword>" . $this->password . "</boa:ExtUPassword>\r\n            <!--Optional:-->\r\n            <!--Optional:-->\r\n            <boa1:AccountNumber>" . $this->musteri_no . "</boa1:AccountNumber>\r\n <boa1:AccountSuffix>" . $this->musteri_suffix . "</boa1:AccountSuffix>           <!--Optional:-->\r\n            <!--Optional:-->\r\n            <boa1:BeginDate>" . $tarih1 . "</boa1:BeginDate>\r\n            <!--Optional:-->\r\n            <boa1:EndDate>" . $tarih2 . "</boa1:EndDate>\r\n         </ser:request>\r\n      </ser:GetAccountStatement>\r\n   </soapenv:Body>\r\n</soapenv:Envelope>",
            CURLOPT_HTTPHEADER => array(
                "cache-control: no-cache",
                "content-type: text/xml",
                "postman-token: 4232c001-ef35-0df5-916d-59c11f051f8b",
                "soapaction: http://boa.net/BOA.Integration.CoreBanking.Teller/Service/IAccountStatementService/GetAccountStatement"
            )
        ));
        
        $response = curl_exec($curl);
        $err      = curl_error($curl);
        curl_close($curl);
        @$xml = simplexml_load_string($response, "SimpleXMLElement", 1, "s", true);
        $content2 = str_replace(array_map(function($e)
        {
            return "$e:";
        }, array_keys($xml->getDocNamespaces())), array(), $response);
        $xml2     = @simplexml_load_string($content2);
        return json_encode($xml2);
    }
    
    
}