
<?php

    $postdata = http_build_query(
        array(
            'username' => 'walit',
            'userid' => '15970',
            'handle' => '504acd5615a9a9a5362fa6e6b569d295',
            'msg' => 'TestingSMS',
            'from' => '1324513254',
            'to' => '27680089701'
        )
    );
    /*$opts = array('http' =>
        array(
            'method' => 'POST',
            'header' => 'Content-type: application/x-www-form-urlencoded',
            'content' => $postdata
        )
    );*/
    //$context = stream_context_create($opts);
    //$result = file_get_contents('https://www.pondacams.com/escorts/test2.php', false, $context);
    //echo 'https://www.pondacams.com/escorts/test2.php'."?".$postdata;
    $response = file_get_contents('https://api.budgetsms.net/sendsms/?'.$postdata, false);
    echo $response;
?>