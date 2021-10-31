<?php
include 'config.php';
$rate = $conn -> getRow('USDZAR',['id'=>'1']);
$subs = $conn -> getRow('subscription');
?>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.all.min.js"></script>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.5/jquery.min.js"></script>    
<link href="css/style.css" rel="stylesheet">
<link href="css/bootstrap.css" rel="stylesheet">
<link href="css/animate.min.css" rel="stylesheet">
<link href="css/bootstrap-select.min.css" rel="stylesheet">
<link href="css/metisMenu.min.css" rel="stylesheet">
<script>
    function addSubscription()
    {
        
        var rate = "<?php echo $rate[0]['rate']; ?>";
        var vipOption = document.getElementById("vipOption");
        var form = document.getElementById("payForm");
        
        var sub = "<?php echo $subs[0]["amount"];?>";
        var subRands = Math.round(sub * rate * 100)/100;
        var amount    = document.getElementById("amount");
        var itm1 = document.getElementById("m_payment_id");
        
        var return_url = document.getElementById("return_url");
        
        if(itm1 !== "undefined" && itm1 !== null)
        {
            form.removeChild(itm1);
        }
        
        var itm2 = document.getElementById("frequency");
        if(itm2 !== "undefined" && itm2 !== null)
        {
            form.removeChild(itm2);
        }
        
        var itm3 = document.getElementById("subscription_type");
        if(itm3 !== "undefined" && itm3 !== null)
        {
            form.removeChild(itm3);
        }
        
        var itm4 = document.getElementById("recurring_amount");
        if(itm4 !== "undefined" && itm4 !== null)
        {
            form.removeChild(itm4);
        }
        
        var itm5 = document.getElementById("cycles");
        if(itm5 !== "undefined" && itm5 !== null)
        {
            form.removeChild(itm5);
        }
        
        if(vipOption.checked)
        {
            var m_payment_id = document.createElement("input");
                m_payment_id.type  = "hidden";
                m_payment_id.name  = "m_payment_id";
                m_payment_id.value = "pay_now_17675990";
                m_payment_id.id = "m_payment_id";
                
            var frequency = document.createElement("input");
                frequency.type  = "hidden";
                frequency.name  = "frequency";
                frequency.value = "3";
                frequency.id = "frequency";
                
            var subscription_type = document.createElement("input");
                subscription_type.type  = "hidden";
                subscription_type.name  = "subscription_type";
                subscription_type.value = "1";
                subscription_type.id = "subscription_type";
                
            var recurring_amount = document.createElement("input");
                recurring_amount.type  = "hidden";
                recurring_amount.name  = "recurring_amount";
                recurring_amount.value = subRands;
                recurring_amount.id = "recurring_amount";
                
            var cycles = document.createElement("input");
                cycles.type  = "hidden";
                cycles.name  = "cycles";
                cycles.value = "0";
                cycles.id    = "cycles";
            return_url.value = return_url.value + "&vip=yes" ; 
            form.appendChild(document.createTextNode(" "));
            form.appendChild(m_payment_id);
            
            form.appendChild(document.createTextNode(" "));
            form.appendChild(frequency);
            
            form.appendChild(document.createTextNode(" "));
            form.appendChild(subscription_type);
            
            form.appendChild(document.createTextNode(" "));
            form.appendChild(recurring_amount);
            
            form.appendChild(document.createTextNode(" "));
            form.appendChild(cycles);
            //alert(parseFloat(amount.value) + parseFloat(subRands));
            amount.value = parseFloat(amount.value) + parseFloat(subRands);
        }
    }
    function radChange(btn)
    {
        //addSubscription()
        var rate = "<?php echo $rate[0]['rate']; ?>";
        var val = btn.value;
        var rands = Math.round(val * rate * 100)/100;
        var form = document.getElementById("payForm");
        var sub = "<?php echo $subs[0]["amount"];?>";
        var subRands = Math.round(sub * rate * 100)/100;
        
        if(val >= 50)
        {
            var vipSub = document.getElementById("vipSub");
            vipSub.style.display = "block";
        }
        else
        {
            var vipOption = document.getElementById("vipOption");
            vipOption.checked = false;
            addSubscription();
            var vipSub = document.getElementById("vipSub");
            vipSub.style.display = "none";
        }
           
        //var recu = document.getElementById("recurring_amount");
        
        var item_name = document.getElementById("item_name");
        var amount    = document.getElementById("amount");
        var item_description = document.getElementById("item_description");
        //var custom_amount = document.getElementById("custom_amount");
        var return_url = document.getElementById("return_url");
        
        amount.value = rands;
        //custom_amount.value = rands;
        /*
        if(recu !== null && recu !== "undefined")
        {
            amount.value = rands + recu.value;
        }
        else
        {
            amount.value = rands;
        }
        
        */
        switch(val) {
        <?php   $tokens = $conn -> getRow('tokenOptions');
	        
	        foreach($tokens as $raw => $val)
	        {
	            echo 'case "'.round($val['value'],2).'":
                        item_name.value = "'.$val['Description'].'";
                        item_description.value = "'.$val['tokens'].' Pondacams Tokens  ";
                        return_url.value = "http://pondacams.com/paymentSuccess.php?tokens='.$val['tokens'].'&userid='.$_SESSION['id'].'";
                        break;
                      ';
	        }
	    ?>    
          default:
            // code block
        }
        
        
        
    }
</script>
<div class="modal-content ">
    <div class="modal-body joinnowbg">
	    <div class="row">
	        <div class="col-sm-5 image-holderbgjoin"></div>
            <div class="col-sm-7">
<form id="payForm" method="post" class="paddform" action="https://www.payfast.co.za/eng/process" name="form_f33092451744c895e7d67fd0af1001b1" onsubmit="return click_f33092451744c895e7d67fd0af1001b1( this );" >
    <h2 class="headig-logon mb-3">Buy Tokens</h2>
<!-- <form class="mt-3 mb-3 login-input">-->
	<div class="form-group">
		<label>Token Package</label>
		<!--<select name="tokkens" id="tokkens" class="form-control">
          <option value="45">45</option>
          <option value="100">100</option>
          <option value="200">200</option>
          <option value="500">500</option>
        </select>-->
		<span id = "nameErr"></span>
	</div>
	<?php   $tokens = $conn -> getRow('tokenOptions');
	        
	        foreach($tokens as $raw => $val)
	        {
	            echo '<div class="input-group mb-3" style="width:100%;">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
            
                                <input type="radio" name="test" id="tkn'.$val['id'].'" checked value="'.round($val['value'],2).'" onclick="radChange(this)">
              
                            </div>
                        </div>
                        <!--<input type="text" class="form-control" placeholder="Some text">-->
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                '.$val['Description'].'
                             </div>
                        </div>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                $ '.round($val['value'],2).'&nbsp;&nbsp;
                                ' ;
                                
                                
                                
                                if($val['discount'] != 0 ) echo '<p style="color:red;">'.$val['discount'].' % <br /> Discount</P>';
                                
                                echo '
                            </div>
                        </div>
                      </div>';
	        }
	?>
	<div style="font-size:20px;text-align:center;display:none;" id="vipSub">
	    <hr />
    	<input type="checkbox" id="vipOption" name="vehicle1" onchange="addSubscription()">
        <label for="vehicle1"> BUY VIP SUPSCRIPTION FOR $ <?php echo $subs[0]["amount"];?></label><br>
        <p style="color:yellow;font-size:12px;">Get Vip subscription for $ <?php echo $subs[0]["amount"];?> p/m to unlock more features  </p>
        <hr />
    </div>
    <button id ="buy" type ="submit" class="btn login-form__btn submit">Buy Now</button>
    
    <input type="hidden" name="cmd" value="_paynow">
    <input type="hidden" name="receiver" value="17675990">
    <input type="hidden" name="item_name" id="item_name" value="Xfinity Home AirFibre + Instalation + Activation ">
    <input type="hidden" name="amount"    id="amount" value="1949.00">
    <input type="hidden" name="item_description" id="item_description" value="Gold Internet Subscribtion">
    <input type="hidden" name="cancel_url" id="cancel_url" value="http://pondacams.com/payment.php">
    <input type="hidden" name="return_url" id="return_url" value="http://pondacams.com/paymentSuccess.php?tokens=" >
    
	<!--<input type="hidden" name="merchant_id" value="17675990">
   <input type="hidden" name="merchant_key" value="n656992b2jxrn">
   <input type="hidden" name="amount" id="amount" value="100.00">
   <input type="hidden" name="item_name" id="item_name" value="Test Product">
   <input type="hidden" name="item_description" id="item_description" value="Gold Internet Subscribtion">
    
   
    <input type="hidden" name="cmd" value="_paynow">
    <input type="hidden" name="receiver" value="17675990">
    <input type="hidden" name="item_name" id="item_name" value="Xfinity Home AirFibre + Instalation + Activation ">
    <input type="hidden" name="amount"    id="amount" value="1949.00">
    <input type="hidden" name="item_description" id="item_description" value="Gold Internet Subscribtion">
    <input type="hidden" name="return_url" value="http://pondacams.com/paymentSuccess.php?tokens=" >
    <input type="hidden" name="cancel_url" value="http://pondacams.com/">
    <input type="hidden" name="cycles" value="0">
    <input type="hidden" name="frequency" value="3">
    <input type="hidden" name="m_payment_id" value="pay_now_17675990">
    <input type="hidden" name="subscription_type" value="1">
    <input type="hidden" name="recurring_amount" value="0">
    
    <input type="hidden" name="custom_amount" id="custom_amount" class="pricing" value="1949.00">
    <input type="hidden" name="custom_quantity" class="qty" value="1"  placeholder="Quantity">-->
	<script>
        document.getElementById("tkn<?php echo $tokens[0]['id']; ?>").click();
    </script>					
</form>
						
			</div>
		</div>
	</div>
</div>
<!--<div class="input-group mb-3" style="width:100%;">
          <div class="input-group-prepend">
            <div class="input-group-text">
            
              <input type="radio" name="test" id="tkn45" checked value="4.99" onclick="radChange(this)">
              
            </div>
          </div>
          
          <div class="input-group-prepend">
            <div class="input-group-text">
              45 Tokens&nbsp;&nbsp;
            </div>
          </div>
        <div class="input-group-append">
            <div class="input-group-text">
              $ 4.99&nbsp;&nbsp;
            </div>
        </div>
    </div>
    <div class="input-group mb-3 " style="width:100%;">
          <div class="input-group-prepend">
            <div class="input-group-text">
            
              <input type="radio" name="test" id="tkn200" value="15.99" onclick="radChange(this)">
            </div>
          </div>
          
          <div class="input-group-prepend">
            <div class="input-group-text">
              200 Tokens
            </div>
          </div>
        <div class="input-group-append">
            <div class="input-group-text">
              $ 15.99
            </div>
        </div>
    </div>
    <div class="input-group mb-3 " style="width:100%;">
          <div class="input-group-prepend">
            <div class="input-group-text">
            
              <input type="radio" name="test" id="tkn540" value="49.99" onclick="radChange(this)">
            </div>
          </div>
          
          <div class="input-group-prepend">
            <div class="input-group-text">
              540 Tokens
            </div>
          </div>
        <div class="input-group-append">
            <div class="input-group-text">
              $ 49.99
            </div>
        </div>
    </div>-->