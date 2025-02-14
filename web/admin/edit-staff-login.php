<?php
session_start();
$page = "Staff";
$page1 = "Staff Records";
include "timeout.php";
include "config.php";
if (($_SESSION['user_type'] != "admin")&&($_SESSION['user_type'] != "principal"))header("location: index.php");
$id = $_GET['id'];
$msg = "";
$msg_color = "";

$school_id = "";
$full_name = "";
$email = "";
$status = "";
$user_type = "";
$password = "";
$mobile = "";
$address = "";
if (isset($_POST['submit'])) {
	
	 $school_id = trim($_POST['school_id']);
    $full_name = trim($_POST['full_name']);
    $email = trim($_POST['email']);
    $status = $_POST['status'];
    $password = trim($_POST['password']);
    $mobile = trim($_POST['mobile']);
    $address = trim($_POST['address']);
    $user_type = trim($_POST['user_type']);


   
        $stmt = $conn->prepare("update users set full_name=?,email=?,status=?,password=?,mobile=?,address=? where id=?");
        $stmt->bind_param("sssssss", $full_name, $email, $status, $password, $mobile, $address,$id);
        $stmt->execute();
	
	$stmt = $conn->prepare("INSERT INTO staff_record(school_id,full_name,email,status,password,mobile,address,photo) VALUES (?,?,?,?,?,?,?,?)");

        $stmt->bind_param("ssssssss", $school_id,$full_name,$email,$status, $password,$mobile, $address,$photo);

        $stmt->execute();	

         $file_name = $_FILES['photo']['name'];

        if (trim($file_name) != "") {

            $ext = pathinfo($file_name, PATHINFO_EXTENSION);

            $file_name = $id . "." . $ext;

            $query = "update users set photo = '" . $file_name . "' where id =$id";

            mysqli_query($conn, $query);

            $target_path = "photo/";

            $target_path = $target_path . $file_name;

            move_uploaded_file($_FILES['photo']['tmp_name'], $target_path);

        }

        header("location: staff-record.php");
    }


$sql = "select * from users where id=$id";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);


?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Edit Staff Records</title>
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

      <!-- SELECT2 EXAMPLE -->
       <div class="row">
                  <div class="col-lg-12">
                        <div class="panel panel-primary">
                            <div class="panel-heading" align="center">
                                <h1 class="panel-title">Edit Staff Record</h1>
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
                                                           class="control-label required"> ID</label>
                                                    <input readonly value="<?php echo $row['id']; ?>" required="required" type="text"
                                                           
                                                           name="school_id" id="school_id" class="form-control"
                                                           placeholder="">
                                                </div>

												  <div class="form-group">
                                                    <label for="full_name required"
                                                           class="control-label required"> Name</label>
                                                    <input value="<?php echo $row['full_name']; ?>" required="required" type="text"
                                                           
                                                           name="full_name" id="full_name" class="form-control"
                                                           placeholder="Full Name">
                                                </div>
										


                                        <div class="form-group">
                                            <label for="email" class="control-label required">Email</label>
                                            <input value="<?php echo $row['email']; ?>" required="required"  type="email"
                                                   name="email" class="form-control" placeholder="Email">
                                        </div>

                                        <div class="form-group">
                                            <label for="password" class="control-label required">Password</label>
                                            <input value="<?php echo $row['password']; ?>" required="required" type="text" 
                                                   name="password" id="password" class="form-control"
                                                   placeholder="Password">
                                        </div>

                                        
                                        <div class="form-group">
                                            <label for="mobile" class="control-label">Mobile</label>
                                            <input value="<?php echo $row['mobile']; ?>" 
                                                   name="mobile" class="form-control" placeholder="Mobile">
                                        </div>

                                </div>
                                <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="mobile" class="control-label">Address</label>
                                            <textarea rows='5' maxlength="200" name="address" class="form-control"
                                                      placeholder="Address"><?php echo $row['address']; ?></textarea>
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
					 <div class="form-group">
                                            <label for="mobile" class="control-label">User Type</label>
                                            <input value="<?php echo $row['user_type']; ?>" 
                                                   name="user_type" class="form-control" placeholder="user_type">
                                        </div>
                                         <div class="form-group">

                                                <label for="photo" class="control-label">Photo</label>

                                                <input name="photo" class="form-control" type="file">

                                            </div>
									</div>	
                                        <div class="form-group text-center">
                                            <input required="required" class="btn btn-info"
                                                   type="submit"
                                                   name="submit" value="Update"/>
                                            <a href="users.php" class="btn btn-info">Back</a>
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
				</div><?php include "footer.php"; ?>
			
		
				

	
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
