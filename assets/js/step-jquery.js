var current_fs, next_fs, previous_fs; //fieldsets
    var left, opacity, scale; //fieldset properties which we will animate
	var animating; //flag to prevent quick multi-click glitches
    $(".next").click(function(){
		
        animating = true;
        current_fs = $(this).parent();
        next_fs = $(this).parent().next();
        
        var currentid=$(this).attr('id');
        if(currentid=='next-1'){
            document.getElementById('d_nameErr').innerHTML = "";
			document.getElementById('l_nameErr').innerHTML = "";
			var rep_nameErr = document.getElementById('rep_nameErr');
			if(typeof(rep_nameErr) != 'undefined' && rep_nameErr !== null)
			{
			    rep_nameErr.innerHTML = "";
			}
			
			document.getElementById('genErr').innerHTML = "";
			document.getElementById('dobErr').innerHTML = "";
			document.getElementById('contErr').innerHTML = "";
			document.getElementById('idNErr').innerHTML = "";
			var id = document.getElementById('id').value;
			/* type=''; rep_name
			if($("input[name='userType']").prop("checked")){
				var type = $("input[name='userType']:checked").val();	
			} */
			var dname = document.getElementById('d_name').value;
			var lname = document.getElementById('l_name').value;
			
			var rep_name = document.getElementById('rep_name');
			if(typeof(rep_name) != 'undefined' && rep_name !== null)
			{
			    rep_name = rep_name.value;
			    if (rep_name == "")
    			{
    				// alert("Input field required");
    				document.getElementById('rep_nameErr').innerHTML = "Input field required";
    				return false;
    			}
			}
			
			var gender = document.getElementById('gender').value;
			var dob = document.getElementById('dob').value;
			var country = document.getElementById('country').value;
			var idN = document.getElementById('id_number').value;
			if (dname == "")
			{
				/* alert("Input field required"); */

				document.getElementById('d_nameErr').innerHTML = "Input field required";
				return false;
			}
			if (gender == "")
			{
				// alert("Input field required");
				document.getElementById('genErr').innerHTML = "Input field required";
				return false;
			}
			if (country == "")
			{
				// alert("Input field required");
				document.getElementById('contErr').innerHTML = "Input field required";
				return false;
			}
			if (lname == "")
			{
				// alert("Input field required");
				document.getElementById('l_nameErr').innerHTML = "Input field required";
				return false;
			}

			if (dob == "")
			{
				// alert("Input field required");
				document.getElementById('dobErr').innerHTML = "Input field required";
				return false;
			}

			if (idN == "")
			{
				// alert("Input field required");
				document.getElementById('idNErr').innerHTML = "Input field required";

				return false;
			}
			var formdata = new FormData();
			formdata.append('id',id)
			if(dname !== undefined){formdata.append('d_name',dname)}                    
			if(lname !== undefined){formdata.append('l_name',lname)}                       
			if(rep_name !== undefined){formdata.append('owner_details',rep_name)}                
			if(gender !== undefined){formdata.append('gender',gender)}                    
			if(dob !== undefined){formdata.append('dob',dob)}                    
			if(country !== undefined){formdata.append('country',country)}                    
			if(idN !== undefined){formdata.append('id_number',idN)}                    
			var xhttp = new XMLHttpRequest();
			xhttp.onreadystatechange = function ()
			{
				if (this.readyState == 4 && this.status == 200)
				{
                var response = this.responseText;
               
				}
			};
			xhttp.open("POST", "ajaxdata.php", true);
			/* xhttp.open("GET", "test.php?name="+name+"&email="+email+"&password="+password, true); */
			//xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded"); rep_name
			//xhttp.send("id="+id+"&d_name=" + dname + "&l_name=" + lname + "&gender=" + gender + "&dob=" + dob + "&country=" + country + "&id_number=" + idN);
            xhttp.send(formdata);
            nextstep()
        }else if(currentid=='next-2'){
			document.getElementById('fidErr').innerHTML = "";
			document.getElementById('bidErr').innerHTML = "";
			document.getElementById('faceidErr').innerHTML = "";
			document.getElementById('selfieErr').innerHTML = "";
			
			var formdata = new FormData();
			
			var id = document.getElementById('id').value;
			var fid = document.getElementById('fid').files[0];
			var bid = document.getElementById('bid').files[0];
			var faceid = document.getElementById('fandid').files[0];
			var avatar = document.getElementById('avatar').files[0];
			
			
			var company_registration = document.getElementById('registration');
			var proof_address        = document.getElementById('proof_address');
			var bank_confirm         = document.getElementById('bank');
			console.log(bank_confirm);
			if(typeof(company_registration) != 'undefined' && company_registration !== null)
			{
			    company_registration = company_registration.files[0];
			}
			if(typeof(proof_address) != 'undefined' && proof_address !== null)
			{
			    proof_address = proof_address.files[0];
			}
			if(typeof(bank_confirm) != 'undefined' && bank_confirm !== null)
			{
			    bank_confirm = bank_confirm.files[0];
			}
			
			console.log(company_registration);
			
			console.log(proof_address);
			
			console.log(bank_confirm);
			
			var img1 =  document.getElementById('img1').value;                             
			var img2 =  document.getElementById('img2').value;                             
			var img3 =  document.getElementById('img3').value;                             
			var img4 =  document.getElementById('img4').value;
			                        
			var img5 =  document.getElementById('img5').value;                             
			var img6 =  document.getElementById('img6').value;                             
			var img7 =  document.getElementById('img7').value;
			
			if(img1 == "" || fid !== undefined){
				if (fid !== undefined)
				{
					console.log(fid);
					var ext = fid.name.split('.').pop();
					
					if (ext.toUpperCase() == 'jpg'.toUpperCase() || ext.toUpperCase() == 'png'.toUpperCase() || ext.toUpperCase() == 'jpeg'.toUpperCase()|| ext.toUpperCase() == 'pdf'.toUpperCase())
					{}
					else
					{
					    var filesize = ((fid.size/1024)/1024).toFixed(4);
					    if(filesize > 10 )
					    {
					        document.getElementById('fidErr').innerHTML = "file Size greater tha 10MB are not allowed " + filesize;
						    return false;
					    }
					    else
					    {
    						document.getElementById('fidErr').innerHTML = "Input file are not allowed";
    						return false;
					    }
					}
				}
				else
				{
					document.getElementById('fidErr').innerHTML = "Input field required";
					return false;
				}
			    formdata.append('id_front', fid);

			}
			
			if(img2 == "" || bid !== undefined){
			    
				if (bid !== undefined)
				{
					var ext = bid.name.split('.').pop();
					if (ext.toUpperCase() == 'jpg'.toUpperCase() || ext.toUpperCase() == 'png'.toUpperCase() || ext.toUpperCase() == 'jpeg'.toUpperCase()|| ext.toUpperCase() == 'pdf'.toUpperCase())
					{}
					else
					{
						document.getElementById('bidErr').innerHTML = "Input file are not allowed";
						return false;
					}
				}
				else
				{
					document.getElementById('bidErr').innerHTML = "Input field required";
					return false;
				}
			    formdata.append('id_back', bid);
			}               
			if(img3 == "" || faceid !== undefined){
				if (faceid !== undefined)
				{
					var ext = faceid.name.split('.').pop();
					if (ext.toUpperCase() == 'jpg'.toUpperCase() || ext.toUpperCase() == 'png'.toUpperCase() || ext.toUpperCase() == 'jpeg'.toUpperCase()|| ext.toUpperCase() == 'pdf'.toUpperCase())
					{}
					else
					{
						document.getElementById('faceidErr').innerHTML = "Input file are not allowed";
						return false;
					}
				}
				else
				{
					document.getElementById('faceidErr').innerHTML = "Input field required";
					return false;
				}
			    formdata.append('face_id', faceid);
			}
			if(img4 == "" || avatar !== undefined){
				if (avatar !== undefined)
				{
					var ext = avatar.name.split('.').pop();
					if (ext.toUpperCase() == 'jpg'.toUpperCase() || ext.toUpperCase() == 'png'.toUpperCase() || ext.toUpperCase() == 'jpeg'.toUpperCase())
					{}
					else
					{
						document.getElementById('selfieErr').innerHTML = "Input file are not allowed";
						return false;
					}
				}
				else
				{
					document.getElementById('selfieErr').innerHTML = "Input field required";
					return false;
				}
			    formdata.append('selfie', avatar);   
			}
			
			if((img5 == "" || company_registration !== undefined) && company_registration !== null){
				if (company_registration !== undefined)
				{
					var ext = company_registration.name.split('.').pop();
					if (ext.toUpperCase() == 'jpg'.toUpperCase() || ext.toUpperCase() == 'png'.toUpperCase() || ext.toUpperCase() == 'jpeg'.toUpperCase()|| ext.toUpperCase() == 'pdf'.toUpperCase())
					{}
					else
					{
						document.getElementById('registrationErr').innerHTML = "Input file are not allowed";
						return false;
					}
				}
				else
				{
				    document.getElementById('registrationErr').innerHTML = "Input file is required";
					return false;
				}
			    formdata.append('company_registration', company_registration);  
			}
			if((img6 == "" || proof_address !== undefined) && proof_address !== null ){
				if (proof_address !== undefined)
				{
					var ext = proof_address.name.split('.').pop();
					if (ext.toUpperCase() == 'jpg'.toUpperCase() || ext.toUpperCase() == 'png'.toUpperCase() || ext.toUpperCase() == 'jpeg'.toUpperCase()|| ext.toUpperCase() == 'pdf'.toUpperCase())
					{}
					else
					{
						document.getElementById('addressErr').innerHTML = "Input file are not allowed";
						return false;
					}
				}
				else
				{
				    document.getElementById('addressErr').innerHTML = "Input file is required";
					return false;
				}
			    formdata.append('proof_address', proof_address);
			}
			if((img7 == "" || bank_confirm !== undefined) && bank_confirm !== null){
				if (bank_confirm !== undefined)
				{
					var ext = bank_confirm.name.split('.').pop();
					if (ext.toUpperCase() == 'jpg'.toUpperCase() || ext.toUpperCase() == 'png'.toUpperCase() || ext.toUpperCase() == 'jpeg'.toUpperCase()|| ext.toUpperCase() == 'pdf'.toUpperCase())
					{}
					else
					{
						document.getElementById('bankErr').innerHTML = "Input file are not allowed";
						return false;
					}
				}
				else
				{
				    document.getElementById('bankErr').innerHTML = "Input file is required";
					return false;
				}
				
			    formdata.append('bank_confirm', bank_confirm);
			}
			
			
			
			formdata.append('id', id); 
			
			
			var xhttp = new XMLHttpRequest();
			xhttp.onreadystatechange = function ()
			{
				if (this.readyState == 4 && this.status == 200)
				{
					var response = this.responseText;
					//var row = JSON.parse(response);
					//console.log(response);
					//if(response != null){
						
					//}		
					var loadDiv  = document.getElementById("loadDiv");
			            loadDiv.style.display = "none";
			        nextstep()
				}
			};
			xhttp.open("POST", "ajaxdata.php", true);
			/* xhttp.open("GET", "test.php?name="+name+"&email="+email+"&password="+password, true); */
			// xhttp.setRequestHeader("Content-type", "application/x-www-form-");
			var loadDiv  = document.getElementById("loadDiv");
			    loadDiv.style.display = "block";
			xhttp.send(formdata);
			

        }else if(currentid=='next-3'){
            nextstep()
        }
        else if(currentid=='next-5'){
		    console.log("in Next 5");
            document.getElementById('account_typeErr').innerHTML = "";
            document.getElementById('branch_codeErr').innerHTML = "";
            document.getElementById('account_noErr').innerHTML = "";
            document.getElementById('bank_nameErr').innerHTML = "";
            document.getElementById('iban_typeErr').innerHTML = "";
            document.getElementById('swift_typeErr').innerHTML = "";
            document.getElementById('bank_address_typeErr').innerHTML = "";
            
			var  bank_name = document.getElementById('bank_name').value;
			var  account_no = document.getElementById('account_no').value;
			var  branch_code = document.getElementById('branch_code').value;
			var  account_type = document.getElementById('account_type').value;
			
			var  iban = document.getElementById('iban').value;
			var  swift = document.getElementById('swift').value;
			var  bank_address = document.getElementById('bank_address').value;
			
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
            
            if(iban==""){
                document.getElementById('iban_typeErr').innerHTML = "Account Number Required";
                return false;
            }
            if(swift ==""){
                document.getElementById('swift_typeErr').innerHTML = "Branch code Required";
                return false;
            }
            if(bank_address==""){
                document.getElementById('bank_address_typeErr').innerHTML = "Account Type Required";
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
			xhttp.send("bank_name="+bank_name+"&account_no=" + account_no + "&branch_code=" + branch_code + "&account_type=" + account_type
			           + "&iban="+iban+ "&swift="+swift+ "&bank_address="+bank_address );
			//xhttp.send();
			nextstep();
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