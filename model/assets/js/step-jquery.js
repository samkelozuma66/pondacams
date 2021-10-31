var current_fs, next_fs, previous_fs; //fieldsets
    var left, opacity, scale; //fieldset properties which we will animate
	var animating; //flag to prevent quick multi-click glitches
    $(document).ready(function() {
       $('.js-example-basic-multiple').select2();
    });
    $(".next").click(function(){
        animating = true;
        current_fs = $(this).parent();
        next_fs = $(this).parent().next();   
		var currentid=$(this).attr('id');
        console.log(currentid);
        
        console.log("currentid=='next-1'" +(currentid=='next-1'));
        console.log("currentid='next-2'" +(currentid=='next-2'));
        console.log("currentid='next-3'" +(currentid=='next-3'));
        console.log("currentid='next-4'" +(currentid=='next-4'));
        
		if(currentid=='next-1'){
		    console.log("in Next 1");
            //var id = document.getElementById('id').value;
            document.getElementById('showTypeErr').innerHTML = "";
            document.getElementById('priceErr').innerHTML = "";
            document.getElementById('willingnessErr').innerHTML = "";
            document.getElementById('languageErr').innerHTML = "";
            document.getElementById('ageErr').innerHTML = "";
            document.getElementById('ethnicityErr').innerHTML = "";
           // var showType = document.getElementsByName('showType[]');
            var showType = $('#showType').select2('val');
           // console.log(showType);
           // alert(showType);
            
            var price = document.getElementById('price').value;
           
			//alert(price)
			var willingness = $('#willingness').select2('val');
			//alert(willingness);
			var language = $('#language').select2('val');
			//alert(language);
			var age = document.getElementById('age').value;
			//alert(age);
			var ethnicity = document.getElementById('ethnicity').value;
            //alert(ethnicity);
            if(showType==""){
                document.getElementById('showTypeErr').innerHTML = "Selection Required";
                return false;
            }
            if(price ==""){
                document.getElementById('priceErr').innerHTML = "Selection Required";
                return false;
            }
            if(willingness==""){
                document.getElementById('willingnessErr').innerHTML = "Selection Required";
                return false;
            }
            if(language==""){
                document.getElementById('languageErr').innerHTML = "Selection Required"; 
                return false;
            }
            if(age==""){
                document.getElementById('ageErr').innerHTML = "input field Required";
                return false;
            }
            if(ethnicity==""){
                document.getElementById('ethnicityErr').innerHTML = "Selection Required";
                return false;
            }         
			var xhttp = new XMLHttpRequest();
			xhttp.onreadystatechange = function ()
			{
				if (this.readyState == 4 && this.status == 200)
				{
                var response = this.responseText;
                //console.log(response);
				// var row = JSON.parse(response);
				//console.log(row[0]['name']);
				// console.log(row[0]);
				// console.log(JSON.parse(response)[0]);
				/* next(); */
				}
			};
			xhttp.open("POST", "info.php", true);
			/* xhttp.open("GET", "test.php?name="+name+"&email="+email+"&password="+password, true); */
			xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			xhttp.send("showType="+showType+/* "&model_id="+id+ */"&price=" + price + "&willingness=" + willingness + "&age=" + age + "&ethnicity=" + ethnicity  + "&language=" + language);
            //xhttp.send();			
			nextstep();
		}else if(currentid=='next-2'){
		    console.log("in Next 2");
            document.getElementById('appearanceErr').innerHTML = "";
            document.getElementById('bSizeErr').innerHTML = "";
            document.getElementById('hairErr').innerHTML = "";
            
            document.getElementById('eyeErr').innerHTML = "";
            document.getElementById('placeErr').innerHTML = "";
			var appearance = $('#appearance').select2('val');
			var  bSize = document.getElementById('bSize').value;
			var  hair = document.getElementById('hair').value;
			
			var  eye = document.getElementById('eye').value;
            var  place = document.getElementById('place').value;
            if(appearance==""){
                document.getElementById('appearanceErr').innerHTML = "Selection Required";  
                return false;             
            }
            if(bSize==""){
                document.getElementById('bSizeErr').innerHTML = "Selection Required";
                return false;
            }
            if(hair ==""){
                document.getElementById('hairErr').innerHTML = "Selection Required";
                return false;
            }
            
            if(eye==""){
                document.getElementById('eyeErr').innerHTML = "Selection Required"; 
                return false;
            }
            if(place==""){
                document.getElementById('placeErr').innerHTML = "Selection Required";
                return false;
            }
			var xhttp = new XMLHttpRequest();
			xhttp.onreadystatechange = function ()
			{
				if (this.readyState == 4 && this.status == 200)
				{
                var response = this.responseText;
               // console.log(response);
				// var row = JSON.parse(response);
				//console.log(row[0]['name']);
				// console.log(row[0]);
				// console.log(JSON.parse(response)[0]);
				/* next(); */
				}
			};
			xhttp.open("POST", "info.php", true);
			/* xhttp.open("GET", "test.php?name="+name+"&email="+email+"&password="+password, true); */
			xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			xhttp.send("appearance="+appearance+"&bSize=" + bSize + "&hair=" + hair  + "&eye=" + eye + "&place=" + place);
			//xhttp.send();
			nextstep();
		}else if(currentid=='next-3'){
		    console.log("in Next 3");
            document.getElementById('account_typeErr').innerHTML = "";
            document.getElementById('branch_codeErr').innerHTML = "";
            document.getElementById('account_noErr').innerHTML = "";
            document.getElementById('bank_nameErr').innerHTML = "";
            
			var  bank_name = document.getElementById('bank_name').value;
			var  account_no = document.getElementById('account_no').value;
			var  branch_code = document.getElementById('branch_code').value;
			var  account_type = document.getElementById('account_type').value;
			
            if(bank_name==""){
                document.getElementById('bank_nameErr').innerHTML = "Bank Name Required";  
                return false;             
            }
            if(account_no==""){
                document.getElementById('account_noErr').innerHTML = "Account Number Required";
                return false;
            }
            if(branch_code ==""){
                document.getElementById('branch_codeErr').innerHTML = "Branch code Required";
                return false;
            }
            if(account_type==""){
                document.getElementById('account_typeErr').innerHTML = "Account Type Required";
                return false;
            }
            
			var xhttp = new XMLHttpRequest();
			xhttp.onreadystatechange = function ()
			{
				if (this.readyState == 4 && this.status == 200)
				{
                var response = this.responseText;
               // console.log(response);
				// var row = JSON.parse(response);
				//console.log(row[0]['name']);
				// console.log(row[0]);
				// console.log(JSON.parse(response)[0]);
				/* next(); */
				}
			};
			xhttp.open("POST", "info.php", true);
			/* xhttp.open("GET", "test.php?name="+name+"&email="+email+"&password="+password, true); */
			xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			xhttp.send("bank_name="+bank_name+"&account_no=" + account_no + "&branch_code=" + branch_code + "&account_type=" + account_type);
			//xhttp.send();
			nextstep();
		}else if(currentid=='next-4'){
		    console.log("in Next 4");
		    //video_price
            document.getElementById('private_nameErr').innerHTML = "";
            document.getElementById('cam_noErr').innerHTML = "";
            document.getElementById('spy_codeErr').innerHTML = "";
            document.getElementById('picture_price_codeErr').innerHTML = "";
            document.getElementById('video_price_codeErr').innerHTML = "";
            
			var  video_price = document.getElementById('video_price').value;
			var  private_tokens = document.getElementById('private_tokens').value;
			var  cam_tokens = document.getElementById('cam_tokens').value;
			var  Spy = document.getElementById('Spy').value;
			var  picture_price = document.getElementById('picture_price').value;
			//picture_price
			
            if(private_tokens==""){
                document.getElementById('private_nameErr').innerHTML = "Field Required";  
                return false;             
            }
            if(cam_tokens==""){
                document.getElementById('cam_noErr').innerHTML = "Field Required";
                return false;
            }
            if(Spy ==""){
                document.getElementById('spy_codeErr').innerHTML = "Field Required";
                return false;
            }
            if(picture_price ==""){
                document.getElementById('picture_price_codeErr').innerHTML = "Field Required";
                return false;
            }
            
            if(video_price ==""){
                document.getElementById('video_price_codeErr').innerHTML = "Field Required";
                return false;
            }
            
			var xhttp = new XMLHttpRequest();
			xhttp.onreadystatechange = function ()
			{
				if (this.readyState == 4 && this.status == 200)
				{
                var response = this.responseText;
               // console.log(response);
				// var row = JSON.parse(response);
				//console.log(row[0]['name']);
				// console.log(row[0]);
				// console.log(JSON.parse(response)[0]);
			
				}
			};
			xhttp.open("POST", "info.php", true);
			/* xhttp.open("GET", "test.php?name="+name+"&email="+email+"&password="+password, true); */
			xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			xhttp.send("private="+private_tokens+"&camtocam=" + cam_tokens + "&spy=" + Spy +"&picture_price=" + picture_price +"&video_price=" + video_price);
			//xhttp.send();
			nextstep();
		
		    
		}
		if(currentid=='next-7'){
		    console.log("in Next 7");
            //var id = document.getElementById('id').value; countrySelect
            document.getElementById('provinceErr').innerHTML = "";
            document.getElementById('cityErr').innerHTML = "";
            document.getElementById('areaErr').innerHTML = "";
            document.getElementById('bioErr').innerHTML = "";
            document.getElementById('countryErr').innerHTML = "";
           
            
            var province = document.getElementById('province').value;
            var city = document.getElementById('city').value;
            var area = document.getElementById('area').value;
            var bio = document.getElementById('bio').value;
            var countrySelect = document.getElementById('countrySelect').value;
            
            document.getElementById('regionErr').innerHTML = "";
            var  region = document.getElementById('region').value;
            if(region==""){
                document.getElementById('regionErr').innerHTML = "Selection Required";
                return false;
            }
            
            if(countrySelect==""){
                document.getElementById('countryErr').innerHTML = "Selection Required";
                return false;
            }
            
            if(province==""){
                document.getElementById('provinceErr').innerHTML = "Selection Required";
                return false;
            }
            if(city ==""){
                document.getElementById('cityErr').innerHTML = "Selection Required";
                return false;
            }
            if(area==""){
                document.getElementById('areaErr').innerHTML = "Selection Required";
                return false;
            }
            if(bio==""){
                document.getElementById('bioErr').innerHTML = "Selection Required"; 
                return false;
            }        
			var xhttp = new XMLHttpRequest();
			xhttp.onreadystatechange = function ()
			{
				if (this.readyState == 4 && this.status == 200)
				{
                var response = this.responseText;
                window.location.href = "index.php"
                //console.log(response);
				// var row = JSON.parse(response);
				//console.log(row[0]['name']);
				// console.log(row[0]);
				// console.log(JSON.parse(response)[0]);
				/* next(); */
				}
			};
			xhttp.open("POST", "info.php", true);
			/* xhttp.open("GET", "test.php?name="+name+"&email="+email+"&password="+password, true); */
			xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			xhttp.send("province="+province+/* "&model_id="+id+ */"&city=" + city + "&area=" + area + "&bio=" + bio + "&region=" + region +"&country=" +countrySelect );
            //xhttp.send();			
			//nextstep();
		}
    });
    $(".previous").click(function(){
        animating = true;
        
        current_fs = $(this).parent();
        previous_fs = $(this).parent().prev();
        
        $("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active");
        
        previous_fs.show(); 
        current_fs.animate({opacity: 0}, {
            step: function(now, mx) {
                scale = 0.8 + (1 - now) * 0.2;
                left = ((1-now) * 50)+"%";
                opacity = 1 - now;
                current_fs.css({'left': left});
                previous_fs.css({'transform': 'scale('+scale+')', 'opacity': opacity});
            }, 
            duration: 200, 
            complete: function(){
                current_fs.hide();
                animating = false;
            }, 
            easing: 'easeOutQuint'
        });
    });
    function nextstep(){
    $("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");
        //show the next fieldset
         next_fs.show(); 
        //hide the current fieldset with style
        current_fs.animate({opacity: 0}, {
            step: function(now, mx) {
                //as the opacity of current_fs reduces to 0 - stored in "now"
                //1. scale current_fs down to 80%
                scale = 1 - (1 - now) * 0.2;
                //2. bring next_fs from the right(50%)
                left = (now * 50)+"%";
                //3. increase opacity of next_fs to 1 as it moves in
                opacity = 1 - now;
                current_fs.css({'transform': 'scale('+scale+')'});
                next_fs.css({'left': left, 'opacity': opacity});
            }, 
            duration: 200, 
            complete: function(){
                current_fs.hide();
                animating = false;
            }, 
            //this comes from the custom easing plugin
            easing: 'easeOutQuint'
        });
    }
    $("fieldset").delegate(".removeOrder", "click", function () {  
        $(this).closest('.card').remove();
    }
    );  