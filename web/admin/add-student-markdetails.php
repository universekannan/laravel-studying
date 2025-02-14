<?php
session_start();
$page = "users";
include "timeout.php";
include "config.php";
if (($_SESSION['user_type'] != "admin") && ($_SESSION['user_type'] != "principal") && ($_SESSION['user_type'] != "staff")) header("location: index.php");
$user_id = $_SESSION['user_id'];
$id = $_GET['id'];

$school_id="";
$class_id="";
$exam_id="";
$subject_id="";
$mark="";
$date = date('y/m/d');

if (isset($_POST['sub'])) {

	$school_id = trim($_POST['school_id']);
    $class_id = trim($_POST['class_id']);
    $exam_id = $_POST['exam_id'];
    $subject_id = trim($_POST['subject_id']);
    $mark = trim($_POST['mark']);
  
       
		$sql="insert into student_marklist (school_id,class_id,exam_id,subject_id,mark,user_id,date) values('$school_id','$class_id','$exam_id','$subject_id','$mark','$user_id','$date')";
		mysqli_query($conn,$sql);
   }

   $sql = "select * from student_record where id=$id";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Add Mark</title>
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
</head>
<body class="hold-transition skin-blue sidebar-mini">
	<div class="wrapper">

     <?php include "header.php"; ?>

  
    <?php include "menu.php"; ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <section class="content">

<style>
    select{
        width:250px;
        padding:7px;
    }
</style>
      <!-- SELECT2 EXAMPLE -->
       <div class="row">
       <div class="col-lg-12">
                        <div class="panel panel-primary">
                            <div class="panel-heading" align="center">
                                <h1 class="panel-title">Add Student Mark List...</h1>
                            </div>
			<form method="post" action="" enctype="multipart/form-data">
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-12">
									 <div class="col-md-6">
                                        <div class="form-group">
                                                <label>Student Id</label>
                                                <input readonly value="<?php echo $row['school_id']; ?>" class="form-control" name="school_id" type="text" id="school_id"  class="validate[required,length[0,100]] text-input"  required aria-required="true" pattern="[A-Za-z]+\[A-Za-z]+">
                                            </div>
                                            </div>
											<div class="col-md-6">
											  <div class="form-group">
                                                <label>Class Id</label>
                                                <input readonly value="<?php echo $row['class_id']; ?>" class="form-control" name="class_id" type="text" id="class_id"  class="validate[required,length[0,100]] text-input"  required aria-required="true" pattern="[A-Za-z]+\[A-Za-z]+">
                                            </div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
                                                <label>Exam Name</label>
                                                <?php
														$query = "select * from exam";
														$result = mysqli_query($conn, $query);
														$selected_rows = mysqli_num_rows($result);
														if($selected_rows > 0) {
															?>
												<td>
													<select  name="exam_id" required="required">
										  <option>----------Select--------</option>
										  <?php
											
															while($row = mysqli_fetch_assoc($result)){
												?>
												<option value="<?php echo $row['id']; ?>"
												><?php echo $row['exam_name']; ?></option>
												<?php
											}}
											?>
											</select>
                                            </div>
                                            </div>
											<div class="col-md-4">
											<div class="form-group">
                                                <label>Subject Name</label>
                                                <?php
														$query = "select * from subject";
														$result = mysqli_query($conn, $query);
														$selected_rows = mysqli_num_rows($result);
														if($selected_rows > 0) {
															?>
												<td>
													<select  name="subject_id" required="required">
										  <option>----------Select--------</option>
										  <?php
											
															while($row = mysqli_fetch_assoc($result)){
												?>
												<option value="<?php echo $row['id']; ?>"
												><?php echo $row['sub_name']; ?></option>
												<?php
											}}
											?>
											</select>
                                            </div>
                                            </div>
											<div class="col-md-4">
											<div class="form-group">
                                                <label>Mark</label>
                                                <input value="<?php echo $mark; ?>" class="form-control" name="mark" type="text" id="mark"  class="validate[required,length[0,100]] text-input"  required aria-required="true" pattern="[A-Za-z]+\[A-Za-z]+">
                                            </div>
                                            </div>
											
											 
                                </div>
                                <div class="col-md-12 text-center">
                                    <input required="required" class="btn btn-info"
                                           type="submit"
                                           name="sub" value="Save"/>
                                    <a href="" class="btn btn-info">Back</a>
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
      <?php include "right-sidebar.php"; ?>
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

