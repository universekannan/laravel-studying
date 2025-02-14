<?php
session_start();
include "timeout.php";
include "config.php";
if (($_SESSION['user_type'] != "admin") && ($_SESSION['user_type'] != "principal") && ($_SESSION['user_type'] != "library")) header("location: index.php");
$msg = "";
$user_id=$_SESSION['user_id'];
$id=$_GET['id'];

$msg_color = "";
$school_id = "";
$class_id = "";
$book_id = "";
$book_name = "";
$author_name = "";
$return_date = "";
$status = 'Active';
$date = date('y/m/d');   


if (isset($_POST['submit1'])) {

    
        $school_id= trim($_POST['school_id']);
        $class_id= trim($_POST['class_id']);
        $book_id= trim($_POST['book_id']);
        $book_name= trim($_POST['book_name']);        
        $author_name= trim($_POST['author_name']);
        $return_date= trim($_POST['return_date']);
        $status= trim($_POST['status']);
    
    
  
        $stmt = $conn->prepare("INSERT INTO issue_book (school_id,class_id,book_id,book_name,author_name,return_date,status,user_id,date) VALUES (?,?,?,?,?,?,?,?,?)");
        $stmt->bind_param("sssssssss",$school_id,$class_id,$book_id,$book_name,$author_name,$return_date,$status,$user_id,$date);
        $stmt->execute() or die($stmt->error);


        header("location: issue-book.php");
		
   

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
  <title>Issue Library</title>
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
    <!-- Content Header (Page header) -->
    
<br>
<br>

    <!-- Main content -->
    <section class="content">

      <!-- SELECT2 EXAMPLE -->
      <div class="box box-default">
        <div class="box-header with-border">
          <center><h3 class="box-title">Issue Book</h3></center>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
          </div>
        </div>
    <form method="post" action="" enctype="multipart/form-data">
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-12">
                                    <div class="col-md-6">
									<div class="form-group">

                                                <label for="school_id required"

                                                       class="control-label required">Student ID</label>

                                                <input readonly value="<?php echo $row['school_id']; ?>" required="required" type="text"

                                                       name="school_id" id="school_id" class="form-control"

                                                       placeholder="School Id">

                                            </div>
											
											

                                            
                                      <div class="form-group">

                                                <label for="book_id required"

                                                       class="control-label required">Book ID</label>

                                                <input value="<?php echo $book_id; ?>" required="required" type="text"

                                                       name="book_id" id="book_id" class="form-control"

                                                       placeholder="Book Id">

                                            </div>

                                     
                                        <div class="form-group">

                                                <label for="author_name required"

                                                       class="control-label required">Author Name</label>

                                                <input value="<?php echo $author_name; ?>" required="required" type="text"

                                                       name="author_name" id="author_name" class="form-control"

                                                       placeholder="Author Name">

                                            </div>
                                   
                                            
                                            </div>
                                        <div class="col-md-6">

										<div class="form-group">

                                                <label for="class_id required"

                                                       class="control-label required">Class ID</label>

                                                <input readonly value="<?php echo $row['class_id']; ?>" required="required" type="text"

                                                       name="class_id" id="class_id" class="form-control"

                                                       placeholder="class id">

                                            </div>
											
										 <div class="form-group">

                                                <label for="book_name required"

                                                       class="control-label required">Book Name</label>

                                                <input value="<?php echo $book_name; ?>" required="required" type="text"

                                                       name="book_name" id="datepicker" class="form-control"

                                                       placeholder="Book Name">

                                            </div>
											
                                    
                                            </div>

											<div class="col-md-3">
                                        <div class="form-group">
                                               <label>Return Date</label>
                                   
<div class="input-group">

						<input type="text" class="form-control" name="return_date" id="return_date" data-select="datepicker" data-locked="25/12/2014;1/1/2015">
						<span class="input-group-btn"><button type="button" class="btn btn-primary" data-toggle="datepicker"><i class="fa fa-calendar"></i></button></span>
					</div>           
					</div>           
					</div>           
                                            
									<div class="col-md-3">
										<div class="form-group">
                                            <label for="status" class="control-label required">Status</label>
                                            <select name="status" id="status" class="form-control">
                                                <option <?php if ($status == "Active") echo " selected='selected'"; ?>
                                                    value="Active">Active
                                                </option>
                                                <option <?php if ($status == "Inactive") echo " selected='selected'"; ?>
                                                    value="Inactive">Inactive
                                                </option>
                                            </select>
                                        </div>
                                </div>
                                </div>
                                <div class="col-md-12 text-center">
                                    <input required="required" class="btn btn-info"
                                           type="submit"
                                           name="submit1" value="Submit"/>
                                    <a href="issue-book.php" class="btn btn-info">Back</a>
                                </div>
                            </div>
                    </div>
                    </form>
      </div>
      </div>

    </section>
    <!-- /.content -->
    <?php include "footer.php"; ?>

  </div>
  <!-- /.content-wrapper -->

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

<script type="text/javascript" src="js/jquery.datepicker.js"></script>

</body>
</html>
