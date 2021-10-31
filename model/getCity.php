<?php 
    include 'config.php';
    $code  = $_POST["country"];
    $state = $_POST["state"];
    
    $url1 = "https://countriesnow.space/api/v0.1/countries";
    $xml1 = file_get_contents($url1);
    //echo $cnty[0]["name"];
    //$data1 = ["country" => $code,"state"=>$state];
    //$resp = httpPost($url1, $data1);
    //$respondJSON = json_decode($resp);
    echo $xml1;
    
     
     
    function httpPost($url, $data)
    {
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($curl);
        curl_close($curl);
        return $response;
    }
?>