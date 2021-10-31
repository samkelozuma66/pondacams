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
                                <h4 class="mb-1 mt-0">Escorts</h4>
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
                                            <table class="table m-0">
                                                <thead>
                                                    <tr>
                                                        <th>Name</th> 
                                                        <th>Status</th>                                                    
                                                        <th>Display Name</th>                                                      
                                                        <th>Email</th>
                                                        <th>Phone Number</th>                                                       
                                                        <th>gender</th>
                                                        <th>age</th>                                                       
                                                        <th>country</th>   
                                                        <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Action&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>                                                          
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    
                                                    
                                                    
                                                        
                                                        if(isset($_GET['delete'])){
                                                            $conn ->deleteRow('escort',['id'=>$_GET['delete']]);  
                                                        }
                                                        if (!isset ($_GET['page']) ) {  
                                                            $page = 1;  
                                                        } else {  
                                                            $page = $_GET['page'];  
                                                        } 
                                                        $searchsql = ""; 
                                                        if(isset($_GET['search'])){
                                                            $name = $_GET['search'];
                                                            $searchsql =  " WHERE full_name LIKE '%{$name}%' OR display_name LIKE '%{$name}%'";
                                                        }                                                                  
                                                        $results_per_page = 100;  
                                                        $page_first_result = ($page-1) * $results_per_page; 
                                                        $modsql = "SELECT * FROM escort";
                                                        $connection = $conn->connect(); 
                                                        $brndres = $connection->query($modsql);                                                             
                                                        $number_of_result = mysqli_num_rows($brndres);
                                                        $number_of_page = ceil ($number_of_result / $results_per_page);
                                                                                                                        if(isset($_GET['activeModels'])){
                                                        //do 
                                                        $sql = "SELECT * FROM escort LIMIT ".$page_first_result.",".$results_per_page;   
                                                        
                                                        }
                                                        elseif(isset($_GET['pendingEscort']))
                                                        {
                                                            //do 
                                                        $sql = "SELECT * FROM escort  WHERE status = 'pending'  LIMIT ".$page_first_result.",".$results_per_page;
                                                        }
                                                        elseif(isset($_GET['activeEscort']))
                                                        {
                                                            //do 
                                                        $sql = "SELECT * FROM escort  WHERE status = 'approved' LIMIT ".$page_first_result.",".$results_per_page;
                                                        }
                                                        else
                                                        {
                                                        $sql = "SELECT * FROM escort ".$searchsql." LIMIT ".$page_first_result.",".$results_per_page;      
                                                        }
                                                        
                                                        $res = $connection->query($sql);
                                                        while($row = $res->fetch_assoc()){                                                                                                                                                                      
                                                    ?>
                                                    <tr>                                                                  
                                                        <td> <a href="escort_profile.php?view=<?php echo $row['id'] ?>"><?php echo $row['full_name'] ?></a></td>  
                                                        <td>                            
                                                            <select name="status" id = "<?php echo $row['id'] ?>" class ="mySelect">
                                                                <option value="pending"<?php if($row['status']=="pending"){ echo "selected";} ?>>Pending</a></option>
                                                                <option value="approved"<?php if($row['status']=="approved"){ echo "selected";} ?>>Approved</option>
                                                                <option value="rejected" <?php if($row['status']=="rejected"){ echo "selected";} ?>>Rejected</option>
                                                            </select>
                                                        </td>                          
                                                        <td><?php echo $row['display_name'] ?></td>                                       
                                                        <td><?php echo $row['email'] ?></td>                                                                                                                                                                                 
                                                        <td><?php echo $row['phone_number'] ?></td>                                                                                                                                    
                                                        <td><?php echo $row['gender'] ?></td>                                                                                                                                  
                                                        <td><?php echo $row['age'] ?></td>                                                                                                                                                                       
                                                        <td><?php echo $row['country'] ?></td> 
                                                        <td><a href="escort_profile.php?view=<?php echo $row['id'] ?>"><i data-feather="eye"></i></a> <a href="escorts.php?edit=<?php echo $row['id']?>"><i data-feather="edit-2" ></i></a>
                                                        <a href="escorts.php?delete=<?php echo $row['id']?>"><i data-feather="trash-2" style = "color:red"></a></td>                                                                                                                                                                                                                                   
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