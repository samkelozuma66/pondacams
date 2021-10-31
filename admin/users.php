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
                                <h4 class="mb-1 mt-0">Users</h4>
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
                                                                      
                                        <div class="table-responsive">
                                            <table class="table m-0">
                                                <thead>
                                                    <tr>                                                        
                                                        <th>ID Image</th>                                                      
                                                        <th>Name</th>
                                                        <th>Email</th>                                                       
                                                        <th>Languages</th>
                                                        <th>Country</th>                                                       
                                                        <th>City</th>                                                      
                                                        <th>Address</th>                                                                                                 
                                                        <th>Phone</th>
                                                        <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Action&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>                                                          
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                        if(isset($_GET['delete'])){
                                                            $conn ->deleteRow('chatmodels',['id'=>$_GET['delete']]);  
                                                        }
                                                        if (!isset ($_GET['page']) ) {  
                                                            $page = 1;  
                                                        } else {  
                                                            $page = $_GET['page'];  
                                                        } 
                                                        $searchsql = ""; 
                                                        if(isset($_GET['search'])){
                                                            $name = $_GET['search'];
                                                            $searchsql =  " WHERE user LIKE '%{$name}%' OR language1 LIKE '%{$name}%'";
                                                        }                                                                  
                                                        $results_per_page = 100;  
                                                        $page_first_result = ($page-1) * $results_per_page; 
                                                        $modsql = "SELECT * FROM users";
                                                        $connection = $conn->connect(); 
                                                        $brndres = $connection->query($modsql);                                                             
                                                        $number_of_result = mysqli_num_rows($brndres);
                                                        $number_of_page = ceil ($number_of_result / $results_per_page);                                                                                                                        
                                                        $sql = "SELECT * FROM users".$searchsql." LIMIT ".$page_first_result.",".$results_per_page;                                                                                                
                                                        $res = $connection->query($sql);
                                                        while($row = $res->fetch_assoc()){                                                                                                                                                                      
                                                    ?>
                                                    <tr>                                                                  
                                                        <td> <a href="users.php?view=<?php echo $row['id'] ?>"><img src="act_image/<?php echo $row['actImage']?>" alt="img" width="100" height="120"></a></td>                                    
                                                        <td><?php echo $row['user'] ?></td>                                       
                                                        <td><?php echo $row['email'] ?></td>                                                                                                                                     
                                                        <td><?php echo $row['language1'].", ".$row['language2'].", ".$row['language3'].", ".$row['language4'] ?></td>                                                                                                                                                                                                                                                                                                                                                                                                                                                         
                                                        <td><?php echo $row['country'] ?></td>                                                                                                                                    
                                                        <td><?php echo $row['city'] ?></td>                                                                                                                                  
                                                        <td><?php echo $row['adress'] ?></td>                                                                                                                                                                       
                                                        <td><?php echo $row['phone'] ?></td> 
                                                        <td><a href="model_detail.php?view=<?php echo $row['id'] ?>"><i data-feather="eye"></i></a> <a href="model_edit.php?edit=<?php echo $row['id']?>"><i data-feather="edit-2" ></i></a>
                                                        <a href="models.php?delete=<?php echo $row['id']?>"><i data-feather="trash-2" style = "color:red"></a></td>                                                                                                                                 
                                                                                                                                      
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
                                        <li class="page-item"><a class="page-link" href="models.php?page=<?php echo $page; ?>"><?php echo $page; ?></a></li>
                                        <?php } ?>
                                    </ul>
                               </div>
                            </div>                           
                        </div>
                        <!-- end row -->                        
                    </div> <!-- container-fluid -->                  
                </div> <!-- content -->                
                <!-- Footer Start -->
                <?php include 'footer.php'; ?>
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
    </body>
</html>