<?php
session_start();
$page = "transport";
include "timeout.php";
include "config.php";
if (($_SESSION['user_type'] != "admin") && ($_SESSION['user_type'] != "principal") && ($_SESSION['user_type'] != "transport")) header("location: index.php");
$id = $_GET['id'];
$msg = "";
$msg_color = "";
$full_name = "";
$age = "";
$dob = "";
$father_name = "";
$doj = "";
$blood_group = "";
$mobile = "";
$email = "";
$password = "";
$address = "";
$pincode = "";
$photo = "";
$id_no = "";
$gender = "";
$salary = "";
$region = "";
$country = "";
$experience = "";
$status = "";
$date = date('y/m/d');

if (isset($_POST['submit'])) {

    $full_name = trim($_POST['full_name']);
    $age = trim($_POST['age']);
    $dob = $_POST['dob'];
    $father_name = trim($_POST['father_name']);
    $doj = trim($_POST['doj']);
    $blood_group = trim($_POST['blood_group']);
    $mobile = trim($_POST['mobile']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $address = trim($_POST['address']);
    $pincode = trim($_POST['pincode']);
    //$photo = trim($_POST['photo']);
    $id_no = trim($_POST['id_no']);
    $status = trim($_POST['status']);
    $gender = trim($_POST['gender']);
    $salary = trim($_POST['salary']);
    $region = trim($_POST['region']);
    $country = trim($_POST['country']);
    $experience = trim($_POST['experience']);
    
	

        $stmt = $conn->prepare("update transport set full_name=?,age=?,dob=?,father_name=?,doj=?,blood_group=?,mobile=?,email=?,password=?,address=?,pincode=?,photo=?,id_no=?,gender=?,salary=?,region=?,country=?,status=?,experience=?  where id=?");
        $stmt->bind_param("ssssssssssssssssssss", $full_name,$age,$dob,$father_name,$doj,$blood_group,$mobile,$email,$password,$address,$pincode,$photo,$id_no,$gender,$salary,$region,$country,$status,$experience,$id);
        $stmt->execute();
         
		 $stmt1 = $conn->prepare("update users set full_name=?,email=?,status=?,password=?,mobile=?,address=? where id=?");
        $stmt1->bind_param("sssssss", $full_name, $email, $status, $password, $mobile, $address,$id);
        $stmt1->execute();

        header("location: transport-records.php");
    }


$sql = "select * from transport where id=$id";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);


?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 2 | Data Tables</title>
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
		<link rel="stylesheet" href="css/jquery.datepicker.css">
</head>
<body class="hold-transition skin-blue sidebar-mini">
	<div class="wrapper">

     <?php include "header.php"; ?>

  
    <?php include "menu.php"; ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <section class="content">
      <div class="row">
 <br /> <br />
				<div class="row">
					<div class="col-lg-12">				
									<div class="panel panel-primary">
							<div class="panel-heading" align="center">
								<h1 class="panel-title">Edit Transport Records...</h1>
							</div>
							<div class="panel-body">
								<div class="row">

                        <form method="post" action="" enctype="multipart/form-data">
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-12">
                                    <div class="col-md-6">
									
                                 
												  <div class="form-group">
                                                    <label for="full_name required"
                                                           class="control-label required">Name</label>
                                                    <input value="<?php echo $row['full_name']; ?>" required="required" type="text"
                                                           
                                                           name="full_name" id="full_name" class="form-control"
                                                           placeholder="Name">
                                                </div>
												<div class="form-group">
                                                    <label for="age required"
                                                           class="control-label required">Age</label>
                                                    <input value="<?php echo $row['age']; ?>" required="required" type="number"
                                                           
                                                           name="age" id="age" class="form-control"
                                                           placeholder="Age">
                                                </div>
												
												<div class="form-group">
                                                 <label>Date Of Birth</label>
                                   
<div class="input-group">

						<input readonly value="<?php echo $row['dob']; ?>"type="text" class="form-control" name="dob" id="dob" data-select="datepicker" data-locked="25/12/2014;1/1/2015">
						<span class="input-group-btn"><button type="button" class="btn btn-primary" data-toggle="datepicker"><i class="fa fa-calendar"></i></button></span>
					</div>
					</div>
												<div class="form-group">
                                                    <label for="father_name required"
                                                           class="control-label required">Father Name</label>
                                                    <input value="<?php echo $row['father_name']; ?>" required="required" type="text"
                                                           
                                                           name="father_name" id="father_name" class="form-control"
                                                           placeholder="Father Name">
                                                </div>
												
												<div class="form-group">
												<label>Date Of Join</label>


<div class="input-group">

						<input readonly value="<?php echo $row['doj']; ?>" type="text" class="form-control" name="doj" id="doj" data-select="datepicker" data-locked="25/12/2014;1/1/2015">
						<span class="input-group-btn"><button type="button" class="btn btn-primary" data-toggle="datepicker"><i class="fa fa-calendar"></i></button></span>
					</div>
					</div>
												<div class="form-group">
                                                    <label for="blood_group required"
                                                           class="control-label required">Blood Group</label>
                                                    <input  value="<?php echo $row['blood_group']; ?>" required="required" type="text"
                                                           
                                                           name="blood_group" id="blood_group" class="form-control"
                                                           placeholder="Blood Group">
                                                </div>
												<div class="form-group">
                                                    <label for="mobile required"
                                                           class="control-label required">Mobile</label>
                                                    <input value="<?php echo $row['mobile']; ?>" required="required" type="number"
                                                           
                                                           name="mobile" id="mobile" class="form-control"
                                                           placeholder="Mobile">
                                                </div>
												<div class="form-group">
                                                    <label for="email required"
                                                           class="control-label required">Email</label>
                                                    <input value="<?php echo $row['email']; ?>" required="required" type="email"
                                                           
                                                           name="email" id="email" class="form-control"
                                                           placeholder="Email">
                                                </div>
												<div class="form-group">
                                                    <label for="address required"
                                                           class="control-label required">Address</label>
                                                    <input value="<?php echo $row['address']; ?>" required="required" type="text"
                                                           
                                                           name="address" id="address" class="form-control"
                                                           placeholder="Address">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
												<div class="form-group">
                                                    <label for="pincode required"
                                                           class="control-label required">Pin Code</label>
                                                    <input value="<?php echo $row['pincode']; ?>" required="required" type="number"
                                                           
                                                           name="pincode" id="pincode" class="form-control"
                                                           placeholder="Pincode">
                                                </div>
												<div class="form-group">
                                            <label for="photo"
                                             class="control-label ">Photo</label>	   
											 <input name="photo" class="form-control" type="file">
                                            </div>
											<div class="form-group">
                                                    <label for="id_no required"
                                                           class="control-label required">Id Number</label>
                                                    <input value="<?php echo $row['id_no']; ?>" required="required" type="text"
                                                           
                                                           name="id_no" id="id_no" class="form-control"
                                                           placeholder="Id Number">
                                                </div>
												<div class="form-group">
                                                <label>Gender</label>
												<select name="gender" class="form-control" required="required" >
												 <option value="">---Select---</option>
                                                             <option <?php if ($row['gender'] == "Male") echo " selected='selected'"; ?>
                                                        value="Male">Male
                                                    </option>
                                                    <option <?php if ($row['gender'] == "Female") echo " selected='selected'"; ?>
                                                        value="Female">Female
                                                    </option>																				 </select>
                                            </div>
											<div class="form-group">
                                                    <label for="salary required"
                                                           class="control-label required">Salary</label>
                                                    <input value="<?php echo $row['salary']; ?>" required="required" type="text"
                                                           
                                                           name="salary" id="salary" class="form-control"
                                                           placeholder="Salary">
                                                </div>
												<div class="form-group">
                                                    <label for="region required"
                                                           class="control-label required">Region</label>
                                                    <input value="<?php echo $row['region']; ?>" required="required" type="text"
                                                           
                                                           name="region" id="region" class="form-control"
                                                           placeholder="Region">
                                                </div>
												<div class="form-group">
                                                    <label for="country required"
                                                           class="control-label required">country</label>
                                                    <input value="<?php echo $row['country']; ?>" required="required" type="text"
                                                           
                                                           name="country" id="country" class="form-control"
                                                           placeholder="Country">
                                                </div>
												<div class="form-group">
                                                    <label for="experience required"
                                                           class="control-label required">Experience</label>
                                                    <input value="<?php echo $row['experience']; ?>" required="required" type="text"
                                                           
                                                           name="experience" id="experience" class="form-control"
                                                           placeholder="Experience">
                                                </div>



                                         <div class="form-group">
                                                <label for="status" class="control-label required">Status</label>
                                                <select name="status" id="status" class="form-control">
                                                    <option <?php if ($row['status'] == "Active") echo " selected='selected'"; ?>
                                                        value="Active">Active
                                                    </option>
                                                    <option <?php if ($row['status'] == "Inactive") echo " selected='selected'"; ?>
                                                        value="Inactive">Inactive
                                                    </option>
                                                </select>
                                            </div>
                                         <!--<div class="form-group">

                                                <label for="photo" class="control-label">Photo</label>

                                                <input name="photo" class="form-control" type="file">

                                            </div>-->
										</div>
                                        <div class="form-group text-center">
                                            <input required="required" class="btn btn-info"
                                                   type="submit"
                                                   name="submit" value="Update"/>
                                            <a href="transport-records.php" class="btn btn-info">Back</a>
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
			</div>
			<?php include "footer.php"; ?>
		</div>
				

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
<script type="text/javascript" src="js/jquery.datepicker.js"></script>
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
