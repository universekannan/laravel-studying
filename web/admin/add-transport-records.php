<?php
session_start();
include "timeout.php";
include "config.php";
if (($_SESSION['user_type'] != "admin") && ($_SESSION['user_type'] != "principal") && ($_SESSION['user_type'] != "transport")) header("location: index.php");
$user_id=$_SESSION['user_id'];
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
$user_type = "transport";
$status = "Active";
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
    $gender = trim($_POST['gender']);
    $salary = trim($_POST['salary']);
    $region = trim($_POST['region']);
    $country = trim($_POST['country']);
    $experience = trim($_POST['experience']);
    


        $stmt = $conn->prepare("INSERT INTO transport(full_name,age,dob,father_name,doj,blood_group,mobile,email,password,address,pincode,photo,id_no,gender,salary,region,country,experience,status,user_type,user_id,date) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
        $stmt->bind_param("ssssssssssssssssssssss", $full_name,$age,$dob,$father_name,$doj,$blood_group,$mobile,$email,$password,$address,$pincode,$photo,$id_no,$gender,$salary,$region,$country,$experience,$status,$user_type,$user_id,$date);
        $stmt->execute() or die($stmt->error);
		
		$stmt1 = $conn->prepare("INSERT INTO users (full_name,email,status,password,mobile,address,user_type,photo) VALUES (?,?,?,?,?,?,?,?)");

        $stmt1->bind_param("ssssssss", $full_name,$email,$status, $password,$mobile, $address,$user_type,$photo);

        $stmt1->execute();
		
		$id = $stmt->insert_id;
        $file_name = $_FILES['photo']['name'];

        if (trim($file_name) != "") {

            $ext = pathinfo($file_name, PATHINFO_EXTENSION);

            $file_name = $id . "." . $ext;

            $query = "update transport set photo = '" . $file_name . "' where id=$id";

            mysqli_query($conn, $query);

            $target_path = "photo/";

            $target_path = $target_path . $file_name;

            move_uploaded_file($_FILES['photo']['tmp_name'], $target_path);

        }

        header("location: transport-records.php");
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Add Project</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
  <!-- daterange picker -->
  <link rel="stylesheet" href="bower_components/bootstrap-daterangepicker/daterangepicker.css">
  <!-- bootstrap datepicker -->
  <link rel="stylesheet" href="bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="plugins/iCheck/all.css">
  <!-- Bootstrap Color Picker -->
  <link rel="stylesheet" href="bower_components/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css">
  <!-- Bootstrap time Picker -->
  <link rel="stylesheet" href="plugins/timepicker/bootstrap-timepicker.min.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="bower_components/select2/dist/css/select2.min.css">
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
  <!-- Left side column. contains the logo and sidebar -->
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <section class="content">

      <!-- SELECT2 EXAMPLE -->
       <div class="row">
                  <div class="col-lg-12">
                        <div class="panel panel-primary">
                            <div class="panel-heading" align="center">
                                <h1 class="panel-title">Add Transport Record</h1>
                            </div>
                            <div class="panel-body">
                                <div class="row">
                            <form method="post" action="" enctype="multipart/form-data">

                            <div class="panel-body">

                                <div class="row">

                                    <div class="col-md-12">
                                    <div class="col-md-6">

                                        <div class="form-group">
                                                <label>Name</label>
                                                <input value="<?php echo $full_name; ?>" class="form-control" name="full_name" type="text" id="full_name"  class="validate[required,length[0,100]] text-input" placeholder="Name" required aria-required="true" pattern="[A-Za-z]+\[A-Za-z]+">
                                            </div>
											<div class="form-group">
                                                <label>Age</label>
                                                <input value="<?php echo $age; ?>" class="form-control" name="age" type="text" id="age" placeholder="Age" required aria-required="true" pattern="[0-9]{2}">
                                            </div>
											
											<div class="form-group">
                                            <label>Date Of Birth</label>
                                   
<div class="input-group">

						<input type="text" readonly class="form-control" placeholder="DOB" name="dob" id="dob" data-select="datepicker" data-locked="25/12/2014;1/1/2015">
						<span class="input-group-btn"><button type="button" class="btn btn-primary" data-toggle="datepicker"><i class="fa fa-calendar"></i></button></span>
					</div>
					</div>
						
											<div class="form-group">
                                                <label>Father Name</label>
                                                <input value="<?php echo $father_name; ?>" class="form-control" name="father_name" type="text" id="father_name" placeholder="Father Name" class="validate[required,length[0,100]] text-input"  required aria-required="true" pattern="[A-Za-z]+\[A-Za-z]+">
                                            </div>
											<div class="form-group">
											<label>Date Of Join</label>


<div class="input-group">

						<input type="text" readonly class="form-control" placeholder="Date Of Join" name="doj" id="doj" data-select="datepicker" data-locked="25/12/2014;1/1/2015">
						<span class="input-group-btn"><button type="button" class="btn btn-primary" data-toggle="datepicker"><i class="fa fa-calendar"></i></button></span>
					</div>
					</div>
                                            <div class="form-group">
                                                <label>Blood Group</label>
                                                <input value="<?php echo $blood_group; ?>" class="form-control" name="blood_group" type="text" id="blood_group"  placeholder="Blood Group" class="validate[required,length[0,200]] text-input"  required aria-required="true" pattern="[A-Za-z]+\[A-Za-z]+">
                                            </div>
								           <div class="form-group">
                                                <label>Mobile</label>
                                                <input value="<?php echo $mobile; ?>" class="form-control" name="mobile" maxlength="10" pattern="[0-9]{10,10}" id="mobile"  placeholder="Mobile"  required aria-required="true">
                                            </div>
											 
											 <div class="form-group">
                                                <label>Email</label>
                                                <input value="<?php echo $email; ?>" class="form-control" name="email" type="email" id="email" placeholder="Email" class="validate[required,length[0,200]] text-input"  required aria-required="true" pattern="[A-Za-z]+\[A-Za-z]+">
                                            </div>
											
											 <div class="form-group">
                                                <label>Password</label>
                                                <input value="<?php echo $password; ?>" class="form-control" name="password" type="password" id="password" placeholder="password" class="validate[required,length[0,200]] text-input"  required aria-required="true" pattern="[A-Za-z]+\[A-Za-z]+">
                                            </div>
                                            <div class="form-group">
                                                <label>Gender</label>
												<select name="gender" class="form-control" required="required" >
												 <option value="">---Select---</option>
                                                    <option>Male</option>
                                                    <option>Female</option>
                                                </select>
                                            </div>
                                    </div>
                                    <div class="col-md-6">
									
									
											 <div class="form-group">
                                                <label>Address</label>
                                                <textarea rows="5" value="<?php echo $address; ?>" class="form-control" name="address" type="text" id="address" placeholder="Address" class="validate[required,length[0,200]] text-input"  required aria-required="true" pattern="[A-Za-z]+\[A-Za-z]+"></textarea>
                                            </div>
											 <div class="form-group">
                                                <label>Pincode</label>
                                                <input value="<?php echo $pincode; ?>" class="form-control" name="pincode" id="pincode" placeholder="Pincode" required aria-required="true" maxlength="6" pattern="[0-9]{6,6}">
                                            </div>
											<div class="form-group">
                                            <label for="photo"
                                             class="control-label ">Photo</label>	   
											 <input name="photo" class="form-control" type="file">
                                            </div>
											 <div class="form-group">
                                                <label>Id Number</label>
                                                <input value="<?php echo $id_no; ?>" class="form-control" name="id_no" type="text" id="id_no" placeholder="ID Number" class="validate[required,length[0,200]] text-input"  required aria-required="true" pattern="[A-Za-z]+\[A-Za-z]+">
                                            </div>
											
											 <div class="form-group">
                                                <label>Salary</label>
                                                <input value="<?php echo $salary; ?>" class="form-control" name="salary" type="text" id="salary"  placeholder="Salary" class="validate[required,length[0,200]] text-input"  required aria-required="true" pattern="[A-Za-z]+\[A-Za-z]+">
                                            </div>
											 <div class="form-group">
                                                <label>Region</label>
                                                <input value="<?php echo $region; ?>" class="form-control" name="region" type="text" id="region" placeholder="Region" class="validate[required,length[0,200]] text-input"  required aria-required="true" pattern="[A-Za-z]+\[A-Za-z]+">
                                            </div>
											<div class="form-group">
                                                <label>Country</label>
                                                <input value="<?php echo $country; ?>" class="form-control" name="country" type="text" id="country" placeholder="Country" class="validate[required,length[0,200]] text-input"  required aria-required="true" pattern="[A-Za-z]+\[A-Za-z]+">
                                            </div>
											 <div class="form-group">
                                                <label>Experience</label>
                                                <input value="<?php echo $experience; ?>" class="form-control" name="experience" type="text" placeholder="Experience" id="experience"  class="validate[required,length[0,200]] text-input"  required aria-required="true" pattern="[A-Za-z]+\[A-Za-z]+">
                                            </div>
											</div> 
                                </div>
                                <div class="col-md-12 text-center">
                                    <input required="required" class="btn btn-info"
                                           type="submit"
                                           name="submit" value="Save"/>
                                    <a href="tranport.php" class="btn btn-info">Back</a>
                                </div>
                            </div>
                    </div>
                    </form>
      </div>

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
      <?php include "footer.php"; ?>

  <!-- Control Sidebar -->
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- Select2 -->
<script src="bower_components/select2/dist/js/select2.full.min.js"></script>
<!-- InputMask -->
<script src="plugins/input-mask/jquery.inputmask.js"></script>
<script src="plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
<script src="plugins/input-mask/jquery.inputmask.extensions.js"></script>
<!-- date-range-picker -->
<script src="bower_components/moment/min/moment.min.js"></script>
<script src="bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
<!-- bootstrap datepicker -->
<script src="bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<!-- bootstrap color picker -->
<script src="bower_components/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js"></script>
<!-- bootstrap time picker -->
<script src="plugins/timepicker/bootstrap-timepicker.min.js"></script>
<!-- SlimScroll -->
<script src="bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- iCheck 1.0.1 -->
<script src="plugins/iCheck/icheck.min.js"></script>
<!-- FastClick -->
<script src="bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<!-- Page script -->
<script type="text/javascript" src="js/jquery.datepicker.js"></script>
<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

    //Datemask dd/mm/yyyy
    $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
    //Datemask2 mm/dd/yyyy
    $('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
    //Money Euro
    $('[data-mask]').inputmask()

    //Date range picker
    $('#reservation').daterangepicker()
    //Date range picker with time picker
    $('#reservationtime').daterangepicker({ timePicker: true, timePickerIncrement: 30, format: 'MM/DD/YYYY h:mm A' })
    //Date range as a button
    $('#daterange-btn').daterangepicker(
      {
        ranges   : {
          'Today'       : [moment(), moment()],
          'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
          'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
          'Last 30 Days': [moment().subtract(29, 'days'), moment()],
          'This Month'  : [moment().startOf('month'), moment().endOf('month')],
          'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        startDate: moment().subtract(29, 'days'),
        endDate  : moment()
      },
      function (start, end) {
        $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
      }
    )

    //Date picker
    $('#datepicker').datepicker({
      autoclose: true
    })

    //iCheck for checkbox and radio inputs
    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
      checkboxClass: 'icheckbox_minimal-blue',
      radioClass   : 'iradio_minimal-blue'
    })
    //Red color scheme for iCheck
    $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
      checkboxClass: 'icheckbox_minimal-red',
      radioClass   : 'iradio_minimal-red'
    })
    //Flat red color scheme for iCheck
    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
      checkboxClass: 'icheckbox_flat-green',
      radioClass   : 'iradio_flat-green'
    })

    //Colorpicker
    $('.my-colorpicker1').colorpicker()
    //color picker with addon
    $('.my-colorpicker2').colorpicker()

    //Timepicker
    $('.timepicker').timepicker({
      showInputs: false
    })
  })
</script>
</body>
</html>
