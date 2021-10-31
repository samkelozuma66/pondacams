<?php
header("Pragma: no-cache");
header("Cache-Control: no-cache");
header("Expires: 0");
require_once("config_paytm.php");
require_once("encdec_paytm.php");


$paramList["MID"] = PAYTM_MERCHANT_MID;
$paramList["ORDER_ID"] ='108';
$paramList["CUST_ID"] = '1';
$paramList["INDUSTRY_TYPE_ID"] = PAYTM_INDUSTRY_TYPE_ID;
$paramList["CHANNEL_ID"] = PAYTM_CHANNEL_ID;
$paramList["TXN_AMOUNT"] ='10';
$paramList["WEBSITE"] = PAYTM_MERCHANT_WEBSITE;
$paramList["CALLBACK_URL"] ='http://localhost/pondacam/paytm/callback.php';
$checkSum = getChecksumFromArray($paramList,PAYTM_MERCHANT_KEY);
$paramList["CHECKSUMHASH"]=$checkSum;
$data=[];
$data['parameter']=$paramList;
$data['redirect']=PAYTM_TXN_URL; 


?>
<html>
<head>
<title>Merchant Check Out Page</title>
</head>
<body>
    <h1>Please do not refresh this page...</h1>
        <form method="post" action="<?php echo PAYTM_TXN_URL ?>" name="f1">
            <?php foreach($paramList as $name => $value) {  ?>
                <input type="text" name="<?= $name ?>" value="<?= $value ?>">
            <?php } ?>
            <script type="text/javascript">
                document.f1.submit();
            </script>
        </form>
</body>
</html>