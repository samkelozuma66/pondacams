<?php
    include 'config.php';
    include 'SimpleXLSXGen.php';
    $output =[];
    
    $dataCompany = ["user_type"          => 0 ,
                     "status"            => "approved",
                     "registration_type" => "company"];
                     
    $paymentCompany = $conn -> getRow("users",$dataCompany);
    
    foreach($paymentCompany as $ind => $company)
    {
        $paymentDetails = $conn -> getRow("banking_details",["user_id" => $company["id"]]);
        $companyModels  = $conn -> getRow("users",["parent_id" => $company["id"]]);
        $money = 0;
        foreach($companyModels as $indC => $rowC)
        {
            $money += $rowC["money"];
        }
        if($money > 0)
        {
            $temp = ["name"         => $company["l_name"],
                     "bank_name"    => $paymentDetails[0]["bank_name"],
                     "branch_code"  => $paymentDetails[0]["branch_code"],
                     "account_no"   => $paymentDetails[0]["account_no"],
                     "account_type" => $paymentDetails[0]["account_type"],
                     "tokens"       => $money,
                     "amount"       => ($money / 10 * 0.5)];
                     
            array_push($output,$temp);
        }
    }
    
    $data = ["user_type" => 0 ,
             "status"    => "approved",
             "parent_id" => 0,
             "NOT money" => 0];
             
    $paymentUsers = $conn -> getRow("users",$data);
    
    foreach($paymentUsers as $ind => $row)
    {   $paymentDetails = $conn -> getRow("banking_details",["user_id" => $row["id"]]);
    
        $temp = ["name"         => $row["l_name"],
                 "bank_name"    => $paymentDetails[0]["bank_name"],
                 "branch_code"  => $paymentDetails[0]["branch_code"],
                 "account_no"   => $paymentDetails[0]["account_no"],
                 "account_type" => $paymentDetails[0]["account_type"],
                 "tokens"       => $row["money"],
                 "amount"       => ($row["money"] / 10 * 0.5)];
                 
        array_push($output,$temp);
        
    }
    
    date_default_timezone_set("africa/johannesburg");
    
    $filename = './documents/paymenrun/paymentRun'.date('Y-m-d').'-'.date("h-i-s");
    
    $xlsx = SimpleXLSXGen::fromArray( $output );
    $xlsx->saveAs($filename.'.xlsx');
    
    $myfile = fopen($filename.".csv", "w") or die("Unable to open file!");
    foreach($output as $ind => $row)
    {
        $line = $row["name"].",".$row["bank_name"].",".$row["branch_code"].",".$row["account_no"].",".$row["account_type"].",".$row["amount"]."\n";
        fwrite($myfile, $line);
    }
    fclose($myfile);
    
    
    $paymentRunData = ["date"  => date("Y-m-d"),
                       "time"  => date("h:i:s"),
                       "excel" => $filename.'.xlsx',
                       "csv"   => $filename.".csv"];
    $conn -> insData("paymentRun",$paymentRunData);
    
    echo "{'success':true}"
    
?>