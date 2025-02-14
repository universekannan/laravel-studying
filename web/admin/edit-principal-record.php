<?php

session_start();

$page = "edit-principal-record";

include "timeout.php";

include "config.php";

if ($_SESSION['user_type'] != "principal") header("location: index.php");
$user_id=$_SESSION['user_id'];
$school_id = $_GET['id'];


$msg = "";

$msg_color = "";

$full_name = "";
$father_name = "";
$date_of_join = "";
$date_of_birth = "";
$blood_group = "";
$cast = "";
$pincode = "";
$address = "";
$state = "";
$mobile = "";
$email = "";
$photo = "";
$study = "";
$university = "";
$pass_out = "";
$principal_id = "";
$other = "";
$gender = "";
$basic_salary = "";
$religion = "";
$country = "";
$physical_status = "";
$institute_name = "";
$percentage = "";
$marksheet_no = "";
$year_of_exp = "";
$status = "";
$date = date('y/m/d');

if (isset($_POST['submit'])) {
    $full_name = trim($_POST['full_name']);
    $father_name = trim($_POST['father_name']);
    $date_of_join= $_POST['date_of_join'];
    $date_of_birth = trim($_POST['date_of_birth']);
    $blood_group = trim($_POST['blood_group']);
    $cast = trim($_POST['cast']);
    $pincode = trim($_POST['pincode']);
     $address = trim($_POST['address']);
     $state = trim($_POST['state']);
     $mobile = trim($_POST['mobile']);
     $email = trim($_POST['email']);
    // $photo = trim($_POST['photo']);
     $study = trim($_POST['study']);
     $university = trim($_POST['university']);
     $pass_out = trim($_POST['pass_out']);
     $principal_id = trim($_POST['principal_id']);     
     $other = trim($_POST['other']);     
     $gender = trim($_POST['gender']);     
     $basic_salary = trim($_POST['basic_salary']);     
     $religion = trim($_POST['religion']);     
     $country = trim($_POST['country']);     
     $physical_status = trim($_POST['physical_status']);     
     $institute_name = trim($_POST['institute_name']);     
     $percentage = trim($_POST['percentage']);  
     $marksheet_no = trim($_POST['marksheet_no']);    
     $year_of_exp = trim($_POST['year_of_exp']);     
     $status = trim($_POST['status']);     
     

        $stmt = $conn->prepare("update principal_record set full_name=?,father_name=?,date_of_join=?,date_of_birth=?,blood_group=?,cast=?,pincode=?,address=?,state=?,mobile=?,email=?,photo=?,study=?,university=?,pass_out=?,principal_id=?,other=?,gender=?,basic_salary=?,religion=?,country=?,physical_status=?,institute_name=?,percentage=?,marksheet_no=?,year_of_exp=?,status=?,user_id=?,date=? where school_id=?");

        $stmt->bind_param("ssssssssssssssssssssssssssssss", $full_name,$father_name,$date_of_join, $date_of_birth,$blood_group, $cast,$pincode,$address,$state,$mobile,$email,$photo,$study,$university,$pass_out,$principal_id,$other,$gender,$basic_salary,$religion,$country,$physical_status,$institute_name,$percentage,$marksheet_no,$year_of_exp,$status,$user_id,$date,$school_id );

        $stmt->execute() or die($stmt->error);

        //$id=$stmt->insert_id;
		$file_name = $_FILES['photo']['name'];

        if (trim($file_name) != "") {

            $ext = pathinfo($file_name, PATHINFO_EXTENSION);

            $file_name = $id . "." . $ext;

            $query = "update principal_record set photo = '" . $file_name . "' where id=$id";

            mysqli_query($conn, $query);

            $target_path = "photo/";

            $target_path = $target_path . $file_name;

            move_uploaded_file($_FILES['photo']['tmp_name'], $target_path);

        }


        header("location: principal-record.php");

    }
    $sql = "select * from principal_record where school_id=$school_id ";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    

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

      <!-- SELECT2 EXAMPLE -->
       <div class="row">
                  <div class="col-lg-12">
                        <div class="panel panel-primary">
                            <div class="panel-heading" align="center">
                                <h1 class="panel-title">Edit principal Record...</h1>
                            </div>
                            <div class="panel-body">
                                <div class="row">
                            <form method="post" action="" enctype="multipart/form-data">

                            <div class="panel-body">

                                <div class="row">

                                    <div class="col-md-12">

                                <div class="col-md-6">
                                        <div class="form-group">

                                            <label for="full_name" class="control-label required">Full Name</label>

                                            <input value="<?php echo $row['full_name']; ?>" required="required" maxlength="50" type="text"

                                                   name="full_name" class="form-control" placeholder="Principal Name">

                                        </div>



                                        <div class="form-group">

                                            <label for="Father Name" class="control-label required">Father Name</label>

                                            <input value="<?php echo $row['father_name']; ?>" required="required" type="text" maxlength="20"

                                                   name="father_name" id="father_name" class="form-control"

                                                   placeholder="Father Name">

                                        </div>

                                       <label>Date Of Join</label>


<div class="input-group">

						<input value="<?php echo $row['date_of_join']; ?>" type="text" class="form-control" name="date_of_join" id="date_of_join" data-select="datepicker" data-locked="25/12/2014;1/1/2015">
						<span class="input-group-btn"><button type="button" class="btn btn-primary" data-toggle="datepicker"><i class="fa fa-calendar"></i></button></span>
					</div>

                                        
                                        
                                               <label>Date Of Birth</label>
                                   
<div class="input-group">

						<input value="<?php echo $row['date_of_birth']; ?>" type="text" class="form-control" name="date_of_birth" id="date_of_birth" data-select="datepicker" data-locked="25/12/2014;1/1/2015">
						<span class="input-group-btn"><button type="button" class="btn btn-primary" data-toggle="datepicker"><i class="fa fa-calendar"></i></button></span>
					</div>
                                       
                                         <div class="form-group">
                                         
                                             <label for="blood_group" class="control-label required">Blood Group</label>
                                         
                                                 <select name="blood_group" id="blood_group" class="form-control">
                                                    <option>-----Select------</option>
                                                    <option <?php if ($row['blood_group'] == "A+") echo " selected='selected'"; ?>
                                         
                                                      value="A+">A+
                                         
                                                      </option>
                                         
                                                     <option <?php if ($row['blood_group'] == "A-") echo " selected='selected'"; ?>
                                         
                                                      value="A-">A-
                                         
                                                     </option>
                                                     <option <?php if ($row['blood_group'] == "B+") echo " selected='selected'"; ?>
                                         
                                                      value="B+">B+
                                         
                                                     </option>
                                                     <option <?php if ($row['blood_group'] == "B-") echo " selected='selected'"; ?>
                                         
                                                      value="B-">B-
                                         
                                                     </option>
                                                     <option <?php if ($row['blood_group'] == "AB+") echo " selected='selected'"; ?>
                                         
                                                      value="AB+">AB+
                                         
                                                     </option>
                                                     <option <?php if ($row['blood_group'] == "AB-") echo " selected='selected'"; ?>
                                         
                                                      value="AB-">AB-
                                         
                                                     </option>
                                                     <option <?php if ($row['blood_group'] == "O+") echo " selected='selected'"; ?>
                                         
                                                      value="O+">O+
                                         
                                                     </option>
                                                     <option <?php if ($row['blood_group'] == "O-") echo " selected='selected'"; ?>
                                         
                                                      value="O-">O-
                                         
                                                     </option>
                                         
                                                     </select>
                                         
                                        </div>

                                        <div class="form-group">

                                            <label for="cast" class="control-label required">Cast </label>

                                            <input value="<?php echo $row['cast']; ?>" required="required" maxlength="50" type="text"

                                                   name="cast" class="form-control" placeholder="cast ">

                                        </div>

                                        <div class="form-group">

                                            <label for="pincode" class="control-label required">Pincode</label>

                                            <input value="<?php echo $row['pincode']; ?>" required="required"  maxlength="6" pattern="[0-9]{6,6}"

                                                   name="pincode" pattern="[0-9]{6}" class="form-control" placeholder="pincode ">

                                        </div>

                                        <div class="form-group">

                                            <label for="address" class="control-label required">Address </label>

                                            <input value="<?php echo $row['address']; ?>" required="required" maxlength="50" type="text"

                                                   name="address" class="form-control" placeholder="Address ">

                                        </div>

                                        <div class="form-group">

                                            <label for="state" class="control-label required">State </label>

                                            <input value="<?php echo $row['state']; ?>" required="required" maxlength="50" type="text"

                                                   name="state" class="form-control" placeholder="State ">

                                        </div>
                                       

                                        <div class="form-group">

                                            <label for="mobile" class="control-label required">Mobile </label>

                                            <input value="<?php echo $row['mobile']; ?>" required="required" maxlength="10" pattern="[0-9]{10,10}" type="number"

                                                   name="mobile" class="form-control" placeholder="Mobile">

                                        </div>



                                        <div class="form-group">

                                            <label for="email" class="control-label required">Email </label>

                                            <input value="<?php echo $row['email']; ?>" required="required" maxlength="50" type="email"

                                                   name="email" class="form-control" placeholder="Email">

                                        </div>

                                         <div class="form-group">

                                            <label for="study" class="control-label required">Study</label>

                                            <input value="<?php echo $row['study']; ?>" required="required" maxlength="50" type="text"

                                                   name="study" class="form-control" placeholder="Study ">

                                        </div>
										<div class="form-group">

                                            <label for="university" class="control-label required">University</label>

                                            <input value="<?php echo $row['university']; ?>" required="required" type="text" maxlength="200"

                                                   name="university" id="university" class="form-control"

                                                   placeholder="University">

                                        </div>

                                        <div class="form-group">

                                            <label for="passout" class="control-label required">Pass Out Year </label>

                                            <input value="<?php echo $row['pass_out']; ?>" required="required" type="text" maxlength="200"

                                                   name="pass_out" id="pass_out" class="form-control"

                                                   placeholder="Pass Out Year">

                                        </div>

                                        </div>
									

                                <div class="col-md-6">



                                        <div class="form-group">

                                            <label for="staff" class="control-label required">Principal Id</label>

                                            <input value="<?php echo $row['principal_id']; ?>" required="required" type="text" maxlength="200"

                                                   name="principal_id" id="principal_id" class="form-control"

                                                   placeholder="Principal Id">

                                        </div>
                                        <div class="form-group">
                                        
                                            <label for="staff" class="control-label required">Other</label>

                                            <input value="<?php echo $row['other']; ?>" required="required" type="text" maxlength="200"

                                                    name="other" id="other" class="form-control"

                                                    placeholder="Others">

                                        </div>

                                        <div class="form-group">

                                            <label for="gender" class="control-label required">Gender</label>

                                            <select name="gender" id="gender" class="form-control">
                                            <option>-----Select------</option>

                                                <option <?php if ($row['gender'] == "Male") echo " selected='selected'"; ?>

                                                    value="Male">Male

                                                </option>

                                                <option <?php if ($row['gender'] == "Female") echo " selected='selected'"; ?>

                                                    value="Female">Female

                                                </option>
                                            </select>

                                        </div>

                                        <div class="form-group">
                                        <label for="age" class="control-label required">Basic Salry</label>

                                            <input value="<?php echo $row['basic_salary']; ?>" required="required" maxlength="50" type="text"

                                                   name="basic_salary" class="form-control" placeholder="Basic Salary">

                                        </div>


                                        <div class="form-group">

                                            <label for="religion" class="control-label required">Religion</label>

                                            <select name="religion" id="religion" class="form-control">
                                            <option>-----Select------</option>

                                                <option <?php if ($row['religion'] == "Hindu") echo " selected='selected'"; ?>

                                                    value="Hindu">Hindu

                                                </option>

                                                <option <?php if ($row['religion'] == "Chiristian") echo " selected='selected'"; ?>

                                                    value="Chiristian">Chiristian

                                                </option>

                                                <option <?php if ($row['religion'] == "Muslim") echo " selected='selected'"; ?>

                                                    value="Muslim">Muslim

                                                </option>

                                            </select>

                                        </div>

                                        

                                        <div class="form-group">
                                        <label for="country" class="control-label required"> Country</label>

                                            <input value="<?php echo $row['country']; ?>" required="required" maxlength="50" type="text"

                                                   name="country" class="form-control" placeholder="Country">

                                        </div>

                                        
                                        <br>
                                        <div class="form-group">
                                        <label for="hostler" class="control-label required">Physical Status</label>

                                            <input value="<?php echo $row['physical_status']; ?>" required="required" maxlength="50" type="text"

                                                   name="physical_status" class="form-control" placeholder="Physical Status">

                                        </div>

                                        <div class="form-group">
                                        <label for="Institute" class="control-label required">Institute Name</label>

                                            <input value="<?php echo $row['institute_name']; ?>" required="required" maxlength="50" type="text"

                                                   name="institute_name" class="form-control" placeholder="Institute Name">

                                        </div>
                                        
                                        <div class="form-group">
                                        <label for="percentage" class="control-label required">Percentage </label>

                                            <input value="<?php echo $row['percentage']; ?>" required="required" maxlength="50" type="text"

                                                   name="percentage" class="form-control" placeholder="Percentage ">

                                        </div>
                                        <div class="form-group">
                                        <label for="marksheet_no" class="control-label required">Marksheet No </label>

                                            <input value="<?php echo $row['marksheet_no']; ?>" required="required" maxlength="50" type="text"

                                                   name="marksheet_no" class="form-control" placeholder="Marksheet No">

                                        </div>

                                        <div class="form-group">
                                        <label for="year" class="control-label required">Experience</label>

                                            <input value="<?php echo $row['year_of_exp']; ?>" required="required" maxlength="50" type="text"

                                                   name="year_of_exp" class="form-control" placeholder="Experience ">

                                        </div>
										<div class="form-group">

                                            <label for="status" class="control-label required">Status</label>

                                            <select name="status" id="status" class="form-control">
                                            <option>-----Select------</option>

                                                <option <?php if ($row['status'] == "Active") echo " selected='selected'"; ?>

                                                    value="Active">Active

                                                </option>

                                                <option <?php if ($row['status'] == "Inactive") echo " selected='selected'"; ?>

                                                    value="Inactive">Inactive

                                                </option>
                                            </select>

                                        </div>
                                        <div class="form-group">

                                            <label for="photo"

                                                   class="control-label">Image(400x100)</label>

                                            <input type="file"

                                                   name="photo" id="photo" class="form-control">

                                        </div>

                                </div>

                                <div class="form-group text-center">
                                <input required="required" class="btn btn-info fa fa-upload"
                                       type="submit"
                                       name="submit" value="Update"/>
                                <a href="student-record.php" class="btn btn-info fa fa-refresh">&nbsp;Back</a>
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

    </section>	<?php include "footer.php"; ?>
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
