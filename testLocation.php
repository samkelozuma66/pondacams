<?php   
    include 'config.php';
    $xml1 = file_get_contents("https://countriesnow.space/api/v0.1/countries/iso");
    $xml = json_decode($xml1);
    
    //var_dump(key($xml->"data"));
    //echo $xml["data"];
    //echo $xm["data"][0]["name"];
    //echo $xml1;
    //echo "<br /><br /><br /><br />";
    //$cnty = $conn -> getRow("country");
    foreach($xml->data as $key => $row)
    {
        $cnty = $conn -> getRow("country",["code" => $row->Iso2]);
         echo $row->name." ".$row->Iso2." ".$row->Iso3."<br />";
         echo $cnty[0]["name"]." ".$cnty[0]["code"]." ".$cnty[0]["iso3"]."<br />";
        if(isset($cnty[0]))
            $conn -> updateData("country",["iso3"=>$row->Iso3,"name" => $row->name],["code" => $row->Iso2]);
            
        //echo $row->Iso2."<br />";
        
        /*if($key >= 238 )
        {
            $cnty = $conn -> getRow("country",["id" => $key]);
            echo $row->name."<br />";
            echo $cnty[0]["name"]."<br />";
            echo $row->iso3."<br />";
            echo "<br /><br />";
            $conn -> updateData("country",["iso3"=>$row->iso3],["id" => $key]);
        }**/
    }
?>