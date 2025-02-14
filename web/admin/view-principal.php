<?php
session_start();
$page = "Students";
$page1 = "Class";
include "timeout.php";
include "config.php";
if (($_SESSION['user_type'] != "admin") && ($_SESSION['user_type'] != "principal") && ($_SESSION['user_type'] != "staff") && ($_SESSION['user_type'] != "student")) header("location: index.php");
$msg = "";
$msg_color = "";
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>View Student Record</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="css/dataTables.responsive.css">
<script src="css/dataTables.responsive.js"></script>
  <link rel="stylesheet" href="css/dataTables.responsive.scss">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">

  <!-- Google Font -->
  <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

     <?php include "header.php"; ?>

    <?php include "menu.php"; ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <section class="content">
        
          <div class="row">
		                     <div class="col-lg-12">
                        <div class="panel panel-primary">
                            <div class="panel-heading" align="center">
                                <h1 class="panel-title">View Principal</h1>
                            </div>
                             <div class="panel-body">
                                 <table>
  <tr>
    <th>Full Name</th>
    <th>abi </th>
    
  </tr>
  
     <tr>
    <th>Username or Email</th>
    <th>abi@gmail.com </th>
    
  </tr>
  <tr>
    <th>Password</th>
    <th>  12345</th>
    
  </tr>
   <tr>
    <th>Confirm Password</th>
    <th>  12345</th>
    
  </tr>
  <tr>
    <th>Rg No</th>
    <th>  001</th>
    
  </tr>
   <tr> 
   <th> Gender</th>
    <td>   Female</th>
    </tr>
	<tr> 
    <th>Father Name</th>
    <th> </th>
    </tr>
        <tr>
    <th>Date of birth</th>
    <th>21/2/2018 </th>
    
  </tr>
  <tr>
    <th>Qualification</th>
    <th>  Phd</th>
    
  </tr> 

   <tr>
    <th>Mobile</th>
    <th>1234536789 </th>
    
  </tr>
  <tr>
    <th>Experience</th>
    <th>  5</th>
    
  </tr>
   <tr>
    <th>Date of Join</th>
    <th>0000-00-00 </th>
    
  </tr>
  <tr>
    <th>Blood Group</th>
    <th>  </th>
    
  </tr>
   <tr>
    <th>Address</th>
    <th>xscvcv </th>
    
  </tr>
  <tr>
    <th>Pincode</th>
    <th>  sdfg</th>
    
  </tr>
   <tr>
    <th>State</th>
    <th>tamilnadu </th>
    
  </tr>
  <tr>
    <th>Study</th>
    <th>  </th>
    
  </tr>
   <tr>
    <th>University</th>
    <th>annq </th>
    
  </tr>
  <tr>
    <th>Passout year</th>
    <th>  </th>
    
  </tr>
   <tr>
    <th>Percentage</th>
    <th>80 </th>
    
  </tr>
  <tr>
    <th>Basic salary</th>
    <th>  </th>
    
  </tr>
  <tr>
    <th>Religion</th>
    <th> </th>
    
  </tr>
  <tr>
    <th>Physical status</th>
    <th>  </th>
    
  </tr>
  
 
        
    </tr>
</table>

                                 
                                 
                                 
                                 
                         <!--       <div class="row">
                            <form method="post" action="" class="form-horizontal" enctype="multipart/form-data">

                            <div class="panel-body">

                                <div class="row">

                                    <div class="col-md-12">

                                       

                                            <div class="form-group">

                                                <label for="full_name required"

                                                       class="control-label  col-md-2">Full Name</label> <div class="col-md-6">

                                                abi
                                            </div>
											</div>
											
											<div class="form-group">

                                            <label for="rg_no" class="control-label col-md-2">rg no</label> <div class="col-md-6">

                                        001
                                        </div>
										</div>
										
										
											
											<div class="form-group">

                                            <label for="gender" class="control-label col-md-2">Gender</label> <div class="col-md-6">

                                        Female
                                        </div>
										</div>
										
											
											<div class="form-group">

                                            <label for="father_name" class="control-label col-md-2">Father_name</label> <div class="col-md-6">

                                        
                                        </div>
										</div>
										
											
											<div class="form-group">

                                            <label for="dob" class="control-label col-md-2">Date of birth</label> <div class="col-md-6">

                                        21/2/2018
                                        </div>
										</div>
										
											<div class="form-group">

                                            <label for="qualification" class="control-label col-md-2">Qualification</label> <div class="col-md-6">

                                        Phd
                                        </div>
										</div>



                                        <div class="form-group">

                                            <label for="email" class="control-label  col-md-2">Username or Email</label> <div class="col-md-6">

                                          abi@gmail.com
                                        </div>
										</div>



                                        <div class="form-group">

                                            <label for="password" class="control-label  col-md-2">Password</label> <div class="col-md-6">

                                      12345
                                        </div>
										</div>

                                        <div class="form-group">

                                            <label for="mobile" class="control-label col-md-2">Mobile</label> <div class="col-md-6">

                                       1234536789
                                        </div>
										</div>
										
										 <div class="form-group">

                                            <label for="experience" class="control-label col-md-2">Experience</label> <div class="col-md-6">

                                        5
                                        </div>
										</div>
										<div class="form-group">

                                            <label for="date_of_join" class="control-label col-md-2">Date of Join</label> <div class="col-md-6">

                                        0000-00-00
                                        </div>
										</div>
										<div class="form-group">

                                            <label for="blood_group" class="control-label col-md-2">Blood Group</label> <div class="col-md-6">

                                        
                                        </div>
										</div>
										<div class="form-group">

                                            <label for="address" class="control-label col-md-2">Address</label> <div class="col-md-6">

                                        xscvcv
                                        </div>
										</div>
										<div class="form-group">

                                            <label for="pincode" class="control-label col-md-2">Pincode</label> <div class="col-md-6">

                                        sdfg
                                        </div>
										</div>
										<div class="form-group">

                                            <label for="state" class="control-label col-md-2">State</label> <div class="col-md-6">

                                        tamilnadu
                                        </div>
										</div>
										<div class="form-group">

                                            <label for="study" class="control-label col-md-2">Study</label> <div class="col-md-6">

                                        
                                        </div>
										</div>
										<div class="form-group">

                                            <label for="university" class="control-label col-md-2">University</label> <div class="col-md-6">

                                        annq
                                        </div>
										</div>
										
										<div class="form-group">

                                            <label for="passout_year" class="control-label col-md-2">Passout year</label> <div class="col-md-6">

                                        
                                        </div>
										</div>
										<div class="form-group">

                                            <label for="percentage" class="control-label col-md-2">Percentage</label> <div class="col-md-6">

                                        80
                                        </div>
										</div>
										<div class="form-group">

                                            <label for="basic_salary" class="control-label col-md-2">Basic salary</label> <div class="col-md-6">

                                        
                                        </div>
										</div><div class="form-group">

                                            <label for="religion" class="control-label col-md-2">Religion</label> <div class="col-md-6">

                                        
                                        </div>
										</div>
										<div class="form-group">

                                            <label for="physical_status" class="control-label col-md-2">Physical status</label> <div class="col-md-6">

                                        
                                        </div>
										</div>
										<div class="form-group">

                                            <label for="staff_category" class="control-label col-md-2">Staff category</label> <div class="col-md-6">

                                        
                                        </div>
										</div>


                                       <div class="form-group">

                                            <label for="status" class="control-label required">Status</label>

                                            <select name="status" id="status" class="form-control">

                                                <option 
                                                    value="Active">Active

                                                </option>

                                                <option 
                                                    value="Inactive">Inactive

                                                </option>

                                            </select>

                                        </div>-->
										</div>
										
										<div class="form-group">


                                        <div class="form-group text-center">
										 <a href="principal-record.php" class="btn btn-info">Back</a>

                                            

                                        </div>

                                    </div>


						                                </div>

                            </div>

                        </form>
						
								</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

    </section>	
    
    <!-- /.content -->
  </div>

      

  <!-- Control Sidebar -->
     
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- DataTables -->
<script src="bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<!-- page script -->
<script>
  $(function () {
    $('#example1').DataTable()
    $('#example2').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    })
  })
</script>
</body>
</html>
