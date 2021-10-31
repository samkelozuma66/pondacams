<?php 
    include 'config.php';
    $code = $_POST["code"];
    $cnty = $conn -> getRow("country",["code" => $code]);
    $url1 = "https://countriesnow.space/api/v0.1/countries/states";
    if(isset($cnty[0]))
    {
        //echo $cnty[0]["name"];
        $data1 = ["country" => $cnty[0]["name"]];
        $resp = httpPost($url1, $data1);
        $respondJSON = json_decode($resp);
        echo json_encode($respondJSON->data->states);
    }
     
     
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