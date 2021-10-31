<?php 
include 'config.php';
if(!isset($_SESSION['name'])){
    header('location: login.php');
} 
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>Pondacams</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
        <meta content="Coderthemes" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        
        <!-- App favicon -->
        <link rel="shortcut icon" href="assets/images/favicon.ico">

        <!-- App css -->
        <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/app.min.css" rel="stylesheet" type="text/css" />
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.0/jquery.min.js"></script>
    </head>

    <body>

        <!-- Begin page -->
        <div id="wrapper">

            <!-- Topbar Start -->
           <?php include 'topbar.php'; ?>
            <!-- end Topbar -->

            <!-- ========== Left Sidebar Start ========== -->
            <?php include 'leftsidebar.php'; ?>
            <!-- Left Sidebar End -->

            <!-- ============================================================== -->
            <!-- Start Page Content here -->
            <!-- ============================================================== -->

            <div class="content-page">
                <div class="content">
                    
                    <!-- Start Content-->
                    <div class="container-fluid">
                        <div class="row page-title">
                            <div class="col-md-12">
                                <nav aria-label="breadcrumb" class="float-right mt-1">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="#">Pondacams</a></li>
                                        <li class="breadcrumb-item"><a href="#">Tables</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Basic</li>
                                    </ol>
                                </nav>
                                <h4 class="mb-1 mt-0">Token Packages</h4>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body">
                                    <ul class="navbar-nav flex-row ml-auto d-flex list-unstyled topnav-menu float-right mb-0">
                                        <li class="d-none d-sm-block">
                                            <div class="app-search">
                                                <form>
                                                    <div class="input-group">
                                                        <input type="text" class="form-control" name = "search" placeholder="Search...">
                                                        <button type="submit"><i data-feather="search"></i>.</button>                                    
                                                    </div>
                                                </form>
                                            </div>
                                        </li>
                                    </ul>                                      
                                    <!-- <a class = "btn btn-primary" href="model_edit.php">ADD</a> -->                                   
                                        <div class="table-responsive">
                                            <table class="table m-0" id="myTable">
                                                <thead>
                                                    <tr>
                                                        
                                                        <th>ID</th>                                                    
                                                        <th>Description</th>                                                      
                                                        <th>Tokens</th>
                                                        <th>Value($)</th>                                                       
                                                        <th>Discount</th>
                                                        <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Action&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>                                                          
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    
                                                    
                                                    
                                                        
                                                        if(isset($_GET['delete'])){
                                                            $conn ->deleteRow('users',['id'=>$_GET['delete']]);  
                                                        }
                                                        if (!isset ($_GET['page']) ) {  
                                                            $page = 1;  
                                                        } else {  
                                                            $page = $_GET['page'];  
                                                        } 
                                                        $searchsql = ""; 
                                                        if(isset($_GET['search'])){
                                                            $name = $_GET['search'];
                                                            $searchsql =  " WHERE name LIKE '%{$name}%' OR l_name LIKE '%{$name}%'";
                                                        }                                                                  
                                                        $results_per_page = 100;  
                                                        $page_first_result = ($page-1) * $results_per_page; 
                                                        $modsql = "SELECT * FROM users";
                                                        $connection = $conn->connect(); 
                                                        $brndres = $connection->query($modsql);                                                             
                                                        $number_of_result = mysqli_num_rows($brndres);
                                                        $number_of_page = ceil ($number_of_result / $results_per_page);
                                                        
                                                        $sql = "SELECT * FROM tokenOptions ";   
                                                        
                                                       
                                                        
                                                        $res = $connection->query($sql);
                                                        while($row = $res->fetch_assoc()){                                                                                                                                                                      
                                                    ?>
                                                    <tr id="r<?php echo $row['id'] ?>">                                                                  
                                                                                  
                                                        <td><input type="text" class="form-control" name = "ID" id="id<?php echo $row['id'] ?>" placeholder="ID" disabled value ="<?php echo $row['id'] ?>"></td>                                       
                                                        <td><input type="text" class="form-control" name = "ID" id="Description<?php echo $row['id'] ?>" placeholder="ID" disabled value ="<?php echo $row['Description'] ?>"></td>                                                                                                                                                                                 
                                                        <td><input type="text" class="form-control" name = "ID" id="tokens<?php echo $row['id'] ?>" placeholder="ID" disabled value ="<?php echo $row['tokens'] ?>"></td>                                                                                                                                    
                                                        <td><input type="text" class="form-control" name = "ID" id="value<?php echo $row['id'] ?>" placeholder="ID" disabled value ="<?php echo $row['value'] ?>"></td>      
                                                        <td>                            
                                                            <select name="status" id = "discount<?php echo $row['id'] ?>" class ="mySelect" disabled>
                                                                <option value="0"  <?php if($row['discount']=="0"){ echo "selected";} ?>>0 </a></option>
                                                                <option value="1"  <?php if($row['discount']=="1"){ echo "selected";} ?>>1%</option>
                                                                <option value="2"  <?php if($row['discount']=="2"){ echo "selected";} ?>>2%</option>
                                                                <option value="3"  <?php if($row['discount']=="3"){ echo "selected";} ?>>3%</a></option>
                                                                <option value="4"  <?php if($row['discount']=="4"){ echo "selected";} ?>>4%</option>
                                                                <option value="5"  <?php if($row['discount']=="5"){ echo "selected";} ?>>5%</option>
                                                                <option value="6"  <?php if($row['discount']=="6"){ echo "selected";} ?>>6%</a></option>
                                                                <option value="7"  <?php if($row['discount']=="7"){ echo "selected";} ?>>7%</option>
                                                                <option value="8"  <?php if($row['discount']=="8"){ echo "selected";} ?>>8%</option>
                                                                <option value="9"  <?php if($row['discount']=="9"){ echo "selected";} ?>>9%</option>
                                                                <option value="10" <?php if($row['discount']=="10"){ echo "selected";} ?>>10%</option>
                                                            </select>
                                                        </td>
                                                        <script>
                                                            function editRow(tr,id)
                                                            {
                                                                var Description = document.getElementById("Description"+id);
                                                                var tokens = document.getElementById("tokens"+id);
                                                                var value = document.getElementById("value"+id);
                                                                 var discount = document.getElementById("discount"+id);
                                                                
                                                                var save = document.getElementById("save"+id);
                                                                var edit = document.getElementById("edit"+id);
                                                                var deleteT = document.getElementById("delete"+id);
                                                                
                                                                save.style = "display:block;"
                                                                edit.style = "display:none;"
                                                                deleteT.style = "display:none;"
                                                                
                                                                Description.disabled = false;
                                                                tokens.disabled = false;
                                                                value.disabled = false;
                                                                discount.disabled = false;
                                                                
                                                            }
                                                            function saveRow(id)
                                                            {
                                                                
                                                                
                                                                var Description = document.getElementById("Description"+id);
                                                                var tokens = document.getElementById("tokens"+id);
                                                                var value = document.getElementById("value"+id);
                                                                var discount = document.getElementById("discount"+id);
                                                                
                                                                var save = document.getElementById("save"+id);
                                                                var edit = document.getElementById("edit"+id);
                                                                var deleteT = document.getElementById("delete"+id);
                                                                
                                                                
                                                                //tokenman.php
                                                                var xhttp = new XMLHttpRequest();
                                                                xhttp.onreadystatechange = function() {
                                                                    if (this.readyState == 4 && this.status == 200) {
                                                                        var response = this.responseText;  
                                                                       // var row = JSON.parse(response);
                                                                       // console.log(row[0]['name']);
                                                                       // console.log(JSON.parse(response)[0]);
                                                                        save.style = "display:none;"
                                                                        edit.style = "display:block;"
                                                                        deleteT.style = "display:block;"
                                                                        Description.disabled = true;
                                                                        tokens.disabled = true;
                                                                        value.disabled = true;
                                                                        discount.disabled = true;
                                                                        
                                                                       console.log(response);
                                                                    }
                                                                };       
                                                                xhttp.open("POST", "tokenman.php", true); 
                                                                xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                                                                xhttp.send("ID="+id+"&DESCRIPTION="+Description.value+"&VALUE="+value.value+"&DISCOUNT="+discount.value+"&TOKENS="+tokens.value+"&ACTION=SAVE");    
                                                            }
                                                            function deleteRow(id)
                                                            {
                                                                
                                                                var Description = document.getElementById("Description"+id);
                                                                var tokens = document.getElementById("tokens"+id);
                                                                var value = document.getElementById("value"+id);
                                                                var discount = document.getElementById("discount"+id);
                                                                
                                                                //document.getElementById("myTable").deleteRow(0);
                                                                var save = document.getElementById("save"+id);
                                                                var edit = document.getElementById("edit"+id);
                                                                var deleteT = document.getElementById("delete"+id);
                                                                
                                                                
                                                                //tokenman.php
                                                                var xhttp = new XMLHttpRequest();
                                                                xhttp.onreadystatechange = function() {
                                                                    if (this.readyState == 4 && this.status == 200) {
                                                                        var response = this.responseText;  
                                                                       // var row = JSON.parse(response);
                                                                       // console.log(row[0]['name']);
                                                                       // console.log(JSON.parse(response)[0]);
                                                                        save.style = "display:none;"
                                                                        edit.style = "display:block;"
                                                                        deleteT.style = "display:block;"
                                                                        Description.disabled = true;
                                                                        tokens.disabled = true;
                                                                        value.disabled = true;
                                                                        discount.disabled = true;
                                                                        
                                                                       console.log(response);
                                                                    }
                                                                };       
                                                                xhttp.open("POST", "tokenman.php", true); 
                                                                xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                                                                xhttp.send("ID="+id+"&DESCRIPTION="+Description.value+"&VALUE="+value.value+"&DISCOUNT="+discount.value+"&TOKENS="+tokens.value+"&ACTION=DELETE");    
                                                                
                                                                $('#r'+id).remove();
                                                                
                                                            }
                                                        </script>
                                                        <td><a href="#" style="display:none;"  id="save<?php echo $row['id'] ?>" onclick="saveRow(<?php echo $row['id'] ?>)" ><i data-feather="upload" ></i></a>
                                                            <a href="#" id="edit<?php echo $row['id'] ?>" onclick="editRow($(this).closest('tr'),<?php echo $row['id'] ?>)"><i data-feather="edit-2" ></i></a>
                                                            <a href="#" id="delete<?php echo $row['id'] ?>" onclick="deleteRow(<?php echo $row['id'] ?>)"><i data-feather="trash-2" style = "color:red"></a>
                                                        </td>                                                                                                                                                                                                                                   
                                                    </tr>  
                                                    <?php }?>                                                                                             
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div>    
                                   <ul class="pagination">
                                        <?php for($page = 1; $page<= $number_of_page; $page++) { ?>
                                        <li class="page-item"><a class="page-link" href="users.php?page=<?php echo $page; ?>"><?php echo $page; ?></a></li>
                                        <?php } ?>
                                    </ul>
                               </div>
                            </div>                           
                        </div>
                        <!-- end row -->                        
                    </div> <!-- container-fluid -->                  
                </div> <!-- content -->                
                <!-- Footer Start -->
                <?php //include 'footer.php'; ?>
                <!-- end Footer -->
            </div>
            <!-- ============================================================== -->
            <!-- End Page content -->
            <!-- ============================================================== -->
        </div>
        <!-- END wrapper -->
        <!-- Right Sidebar -->
        
        <!-- /Right-bar -->
        <!-- Right bar overlay-->
        <div class="rightbar-overlay"></div>
        <!-- Vendor js -->
        <script src="assets/js/vendor.min.js"></script>
        <!-- App js -->
        <script src="assets/js/app.min.js"></script>       
        <script>
        
        $('.mySelect').change(function(){ 
           var value = $(this).val();
           var myId = $(this).attr('id');
          // alert( myId );
          // alert(value);
          var xhttp = new XMLHttpRequest();
          xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                var response = this.responseText;  
               // var row = JSON.parse(response);
               // console.log(row[0]['name']);
               // console.log(JSON.parse(response)[0]);
               console.log(response);
            }
        };       
        xhttp.open("POST", "status.php", true); 
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send("id="+myId+"&status="+value);
        });
        
        </script> 
        
    </body>
</html>