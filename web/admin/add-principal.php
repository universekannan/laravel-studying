<?php
session_start();
$page = "Principal";
$page1 = "Add Principal";
include "timeout.php";
include "config.php";
if($_SESSION['user_type'] != "admin") header("location: index.php");
error_reporting(1);
set_time_limit(0);
include "mailer/PHPMailerAutoload.php";
$msg = "";
$msg_color = "";
$full_name = "";
$email = "";
$status = "Active";
$password = "";
$mobile = "";
$address = "";
$user_type = "principal";
$photo = "";

if (isset($_POST['submit'])) {
	//echo "<pre>";
	//print_r($_FILES);
	//print_r($_POST);
	//echo "</pre>";
	//die;

    $full_name = trim($_POST['full_name']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $mobile = trim($_POST['mobile']);
    $address = trim($_POST['address']);

    $sql = "SELECT * FROM users WHERE trim(email)='$email'";
    $result = mysqli_query($conn, $sql);
    $count = mysqli_num_rows($result);

    if ($count >= 1) {
        $msg = "Username or Email already in use";
        $msg_color = "red";
    } else {
        $msg_color = "green";
        if($_SESSION['user_type']=="superadmin") {
            $msg = "Company added successfully";
        }else{
            $msg = "User added successfully";
        }

        $stmt = $conn->prepare("INSERT INTO users (full_name,email,status,password,mobile,address,user_type) VALUES (?,?,?,?,?,?,?)");

        $stmt->bind_param("sssssss", $full_name,$email,$status, $password,$mobile, $address,$user_type);
        $stmt->execute() or die($stmt->error);
        $id=$stmt->insert_id;
		
		$file_name = $_FILES['photo']['name'];
        if (trim($file_name) != "") {
            $ext = pathinfo($file_name, PATHINFO_EXTENSION);
            $file_name = $id . "-p" . "." . $ext;
            $query = "update users set photo = '" . $file_name . "' where id=$id";
            mysqli_query($conn, $query);
            $target_path = "photo/";
            $target_path = $target_path . $file_name;
            move_uploaded_file($_FILES['photo']['tmp_name'], $target_path);

        }

	$tag = "";
    $tag .= 'Welcome to  ' . $_POST['full_name'] . '<br>';
    $tag .= 'User Name ' . $_POST['email'] . '<br>';
    $tag .= 'Password ' . $_POST['password'] . '<br>';
    $tag .= 'Login Url' . 'http://adlineschool.com/web/admin/' . '<br>';
	
    $mail = new PHPMailer();
	$mail->IsSMTP();
	$mail->SMTPDebug = 0;
	$mail->SMTPAuth = true;
	$mail->SMTPSecure = "ssl";
	$mail->Host = "smtp.gmail.com";
	$mail->Port = 465;
	$mail->Username = "sukumar.inapp2@gmail.com";
	$mail->Password = "rails2020";
	$mail->SetFrom("sukumar.inapp2@gmail.com");
	$mail->Subject = "Schol Lofin Details";
	$mail->MsgHTML($tag);

	$mail->AddAddress("$email");
	if (!$mail->Send()) {
		echo "Mailer Error: " . $mail->ErrorInfo;
	} else {
		echo "Message has been sent";
	}
		        header("location: principal.php");

    }
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>New Users</title>
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

      <!-- SELECT2 EXAMPLE -->
       <div class="row">
                  <div class="col-lg-12">
                        <div class="panel panel-primary">
                            <div class="panel-heading" align="center">
                                <h1 class="panel-title">Add Principal</h1>
                                <h1 class="panel-title"><?php echo $msg; ?><?php echo $msg_color; ?></h1>
                            </div>
                            <div class="panel-body">
                                <div class="row">
                           <form method="post" action="" class="form-horizontal" enctype="multipart/form-data">

                            <div class="panel-body">

                                <div class="row">

                                    <div class="col-md-12">
									
									 <div class="col-md-6">
									

                                       

                                            <div class="form-group">

                                                <label for="full_name required"

                                                       class="control-label  col-md-3">Full Name<span class="mandatory">*</span></label> <div class="col-md-9">

                                                <input value="" required="required" type="text"

                                                       maxlength="50"

                                                       name="full_name" id="full_name" class="form-control"

                                                       placeholder="Full Name">

                                            </div>
											</div>
											
											

                                                
											
											<div class="form-group">

                                            <label for="email" class="control-label  col-md-3">Username or Email<span class="mandatory">*</span></label> <div class="col-md-9">

                                            <input value="" required="required" maxlength="50" type="email"

                                                   name="email" id="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" class="form-control" placeholder="Email">

                                        </div>
										</div>



                                        <div class="form-group">

                                            <label for="password" class="control-label  col-md-3">Password<span class="mandatory">*</span></label> <div class="col-md-9">

                                            <input value="" required="required" type="text" maxlength="20"

                                                   name="password" id="password" class="form-control"

                                                   placeholder="Password">

                                        </div>
										</div>

											
                                           
                                          
											
											<div class="form-group">

                                                <label for="confirm_password required"

                                                       class="control-label  col-md-3">Confirm password<span class="mandatory">*</span></label> <div class="col-md-9">

                                                <input value="" required="required" type="text"

                                                       maxlength="50"

                                                       name="confirm_password" id="confirm_password" class="form-control"

                                                       placeholder="Confirm password">

                                            </div>
											</div>
												<div class="form-group">

                                                <label for="rg_no required"

                                                       class="control-label  col-md-3">RG No<span class="mandatory">*</span></label> <div class="col-md-9">

                                                <input value="" required="required" type="text"

                                                       maxlength="50"

                                                       name="rg_no" id="rg_no" class="form-control"

                                                       placeholder="RG No">

                                            </div>
											</div>
											
											
											
                                            <div class="form-group">

                                                <label for="gender "

                                                       class="control-label  col-md-3">Gender</label> <div class="col-md-9">

                                                 <select name="gender" id="gender" class="form-control">
            <option>-----Select------</option>

                <option 
                    value="Male">Male

                </option>

                <option 
                    value="Female">Female

                </option>
            </select>
                                            </div>
											</div>
											
											
                                            <div class="form-group">

                                                <label for="father_name "

                                                       class="control-label  col-md-3">Father name</label> <div class="col-md-9">

                                                <input value=""  type="text"

                                                       maxlength="50"

                                                       name="father_name" id="father_name" class="form-control"

                                                       placeholder="Father name">

                                            </div>
											</div>
											
											<div class="form-group">

                                                <label for="dob required"

                                                       class="control-label  col-md-3">Date of birth<span class="mandatory">*</span></label> <div class="col-md-9">

                                                <input value="" required="required" type="text"

                                                       maxlength="50"

                                                       name="dob" id="dob" class="form-control"

                                                       placeholder="Date of birth">

                                            </div>
											</div>
											
											<div class="form-group">

                                                <label for="qualification required"

                                                       class="control-label  col-md-3">Qualification<span class="mandatory">*</span></label> <div class="col-md-9">

                                                <input value="" required="required" type="text"

                                                       maxlength="50"

                                                       name="qualification" id="qualification" class="form-control"

                                                       placeholder="Qualification">

                                            </div>
											</div>
                   



                                        
                                        <div class="form-group">

                                            <label for="mobile" class="control-label col-md-3">Mobile<span class="mandatory">*</span></label> <div class="col-md-9">

                                            <input value="" pattern="[0-9]+\[1-9]+" maxlength="50"

                                                   name="mobile" id="mobile" class="form-control" placeholder="Mobile">

                                        </div>
										</div>
										
										<div class="form-group">

                                                <label for="experience "

                                                       class="control-label  col-md-3">Experience</label> <div class="col-md-9">

                                                <input value=""  type="text"

                                                       maxlength="50"

                                                       name="experience" id="experience" class="form-control"

                                                       placeholder="Experience">

                                            </div>
											</div>
									
				<!--<div class="form-group">

                                                <label for="date_of_join required"

                                                       class="control-label  col-md-3">Date of Join</label> <div class="col-md-9">

                                                <input value="20/01/10" required="required" type="text"

                                                       maxlength="50"

                                                       name="date_of_join" id="date_of_join" class="form-control"

                                                       placeholder="Date of Join">

                                            </div>
					</div>-->
					         <div class="form-group">
                                              
										 <label for="date_of_join required"

                                                       class="control-label  col-md-3">Date of Join<span class="mandatory">*</span></label> <div class="col-md-9">	   
											   
                                   
               <div class="input-group">

						<input type="text" class="form-control" name="date_of_join" id="date_of_join" data-select="datepicker" data-locked="25/12/2014;1/1/2015" placeholder="Date of Join">
						<span class="input-group-btn"><button type="button" class="btn btn-primary" data-toggle="datepicker"><i class="fa fa-calendar"></i></button></span>
					</div>           
					</div>           
					        
                       </div>      
					
					
					
					
					
					
					
					
											
											</div>	
									
									
										 <div class="col-md-6">
									

											<div class="form-group">

                                                <label for="blood_group "

                                                       class="control-label  col-md-3">Blood Group</label> <div class="col-md-9">

                                                <input value=""  type="text"

                                                       maxlength="50"

                                                       name="blood_group" id="blood_group" class="form-control"

                                                       placeholder="Blood Group">

                                            </div>
											</div>

											<div class="form-group">

                                                <label for="address "

                                                       class="control-label  col-md-3">Address</label> <div class="col-md-9">

                                                <input value=""  type="text"

                                                       maxlength="50"

                                                       name="address" id="address" class="form-control"

                                                       placeholder="Address">

                                            </div>
											</div>
										<div class="form-group">

                                                <label for="pincode required"

                                                       class="control-label  col-md-3">Pincode<span class="mandatory">*</span></label> <div class="col-md-9">

                                                <input value="" required="required" type="text"

                                                       maxlength="50"

                                                       name="pincode" id="pincode" class="form-control"

                                                       placeholder="Pincode">

                                            </div>
											</div>

											<div class="form-group">

                                                <label for="state "

                                                       class="control-label  col-md-3">State</label> <div class="col-md-9">

                                                <input value=""  type="text"

                                                       maxlength="50"

                                                       name="state" id="state" class="form-control"

                                                       placeholder="State">

                                            </div>
											</div>

											<div class="form-group">

                                                <label for="study "

                                                       class="control-label  col-md-3">Study</label> <div class="col-md-9">

                                                <input value=""  type="text"

                                                       maxlength="50"

                                                       name="study" id="study" class="form-control"

                                                       placeholder="Study">

                                            </div>
											</div>
											
												<div class="form-group">

                                                <label for="university "

                                                       class="control-label  col-md-3">University<span class="mandatory">*</span></label> <div class="col-md-9">

                                                <input value=""  type="text"

                                                       maxlength="50"

                                                       name="university" id="university" class="form-control"

                                                       placeholder="University">

                                            </div>
											</div>
											
												<div class="form-group">

                                                <label for="passout_year "

                                                       class="control-label  col-md-3">Passout year</label> <div class="col-md-9">

                                                <input value=""  type="text"

                                                       maxlength="50"

                                                       name="passout_year" id="passout_year" class="form-control"

                                                       placeholder="Passout year">

                                            </div>
											</div>
											
												<div class="form-group">

                                                <label for="percentage required"

                                                       class="control-label  col-md-3">Percentage<span class="mandatory">*</span></label> <div class="col-md-9">

                                                <input value="" required="required" type="text"

                                                       maxlength="50"

                                                       name="percentage" id="percentage" class="form-control"

                                                       placeholder="Percentage">

                                            </div>
											</div>
											
											<div class="form-group">

                                                <label for="basic_salary "

                                                       class="control-label  col-md-3">Basic salary</label> <div class="col-md-9">

                                                <input value=""  type="text"

                                                       maxlength="50"

                                                       name="basic_salary" id="basic_salary" class="form-control"

                                                       placeholder="Basic salary">

                                            </div>
											</div>
												<div class="form-group">

                                                <label for="religion "

                                                       class="control-label  col-md-3">Religion</label> <div class="col-md-9">

                                                <input value=""  type="text"

                                                       maxlength="50"

                                                       name="religion" id="religion" class="form-control"

                                                       placeholder="Religion">

                                            </div>
											</div>
												<div class="form-group">

                                                <label for="physical_status "

                                                       class="control-label  col-md-3">Physical status</label> <div class="col-md-9">

                                                <input value=""  type="text"

                                                       maxlength="50"

                                                       name="physical_status" id="physical_status" class="form-control"

                                                       placeholder="Physical status">

                                            </div>
											</div>
											
											
                   </div>
				     </div>


                                        <!--<div class="form-group">

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
										
										
										<div class="form-group">


                                        <div class="form-group text-center">
										 <a href="principal-record.php" class="btn btn-info">Back</a>

                                            <input required="required" class="btn btn-info"

                                                   type="submit"

                                                   name="submit" value="Submit"/>

                                            <a href="add-principal.php" class="btn btn-info">Clear</a>

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
	
<?php include "footer.php"; ?>
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