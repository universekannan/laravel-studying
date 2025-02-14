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
$fees_id="";
$amount="";
$paid_amount="";
$balance="";
$date = date('y/m/d');

if (isset($_POST['sub'])) {

	$school_id = trim($_POST['school_id']);
    $class_id = trim($_POST['class_id']);
    $fees_id = $_POST['fees_id'];
    $amount = trim($_POST['amount']);
    $paid_amount = trim($_POST['paid_amount']);
    $balance = trim($_POST['balance']);
  
       
		 $stmt = $conn->prepare("UPDATE pay  set amount=?,paid_amount=?,balance=?,user_id=?,date=? where id=?");
        $stmt->bind_param("ssssss",$amount,$paid_amount,$balance,$user_id,$date,$id);
        $stmt->execute();
		
		$sql1="insert into pay_details (school_id,class_id,fees_id,amount,paid_amount,balance,user_id,date) values('$school_id','$class_id','$fees_id','$amount','$paid_amount','$balance','$user_id','$date')";
		mysqli_query($conn,$sql1);
   }
 $sql = "select * from pay where id=$id";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Add Fees</title>
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
                                <h1 class="panel-title">Add Student Fees List...</h1>
                            </div>
			<form method="post" action="" enctype="multipart/form-data">
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-12">
									 <div class="col-md-6">
                                        <div class="form-group">
                                                <label>Student Name</label>
                                         <select  readonly name="school_id"  class="form-control select2" >
                                    <?php
                                    $sql11 = "select a.*,b.full_name from pay a,student_record b where  a.school_id=b.school_id";
                                    $result11 = mysqli_query($conn, $sql11);
                                    while ($row11 = mysqli_fetch_assoc($result11)) {
                                        ?>
                                        <option
                                            value="<?php echo $row11['school_id']; ?>"
                                            <?php if($row['school_id']==$row11['school_id']) echo " selected "; ?>
                                        ><?php echo $row11['full_name']; ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                                            </div>
                                            </div>
											<div class="col-md-6">
										
											  <div class="form-group">
                                                <label>Class Id</label>
                                                <select  readonly name="class_id"  class="form-control select2" >
                                    <?php
                                    $sql12 = "select a.*,b.standard,section_name from fees_detail a,class b where  a.class_id=b.id";
                                    $result12 = mysqli_query($conn, $sql12);
                                    if ($row12 = mysqli_fetch_assoc($result12)) {
                                        ?>
                                        <option
                                            value="<?php echo $row12['id']; ?>"
                                            <?php if($row['class_id']==$row12['id']) echo " selected "; ?>
                                        ><?php echo $row12['standard']; ?><?php echo $row12['section_name']; ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                                            </div>
									
										</div>
										<div class="col-md-3">
										
											<div class="form-group">
                                                <label>Fees Name</label>
                                                <select  readonly name="fees_id"  class="form-control select2" >
                                    <?php
                                    $sql2 = "select a.*,b.fees_name from fees_detail a,fees b where  a.fees_id=b.id";
										$result2 = mysqli_query($conn, $sql2);
									while ($row2= mysqli_fetch_assoc($result2)) {
										?>
                                        <option
                                            value="<?php echo $row2['fees_id']; ?>"
                                            <?php if($row['fees_id']==$row2['fees_id']) echo " selected "; ?>
                                        ><?php echo $row2['fees_name']; ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                                            </div>
									
                                            </div>
											<div class="col-md-3">
											<div class="form-group">
                                                <label>Old Balance</label>
                                                <input readonly value="<?php echo $row['balance']; ?>" class="form-control" name="amount" type="text" id="amount"  class="validate[required,length[0,100]] text-input"  required aria-required="true" pattern="[A-Za-z]+\[A-Za-z]+">
                                            </div>
                                            </div>
											<div class="col-md-3">
											<div class="form-group">
                                                <label>Paid Amount</label>
                                                <input onkeypress="return runScript2(event)" onkeyup="calculate_amount()" value="<?php echo $paid_amount; ?>" class="form-control" name="paid_amount" type="text" id="paid_amount"  class="validate[required,length[0,100]] text-input"  required aria-required="true" pattern="[A-Za-z]+\[A-Za-z]+">
                                            </div>
                                            </div>
											<div class="col-md-3">
											<div class="form-group">
                                                <label>Balance</label>
                                                <input readonly onkeyup="calculate_balance();" value="<?php echo $balance; ?>" class="form-control" name="balance" type="text" id="balance"  class="validate[required,length[0,100]] text-input"  required aria-required="true" pattern="[A-Za-z]+\[A-Za-z]+">
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

	<script>
      function runScript(e) {
    if (e.keyCode == 13) {
        $("input[name='paid_amount']").focus();
    }
    }

    function runScript2(e) {
    if (e.keyCode == 13) {
        var paid_amount = ~~parseInt($('#paid_amount').val());
        var amount= ~~parseInt($('#amount').val());
		var amount= ~~parseInt($('#amount').val());
        var balance=amount+amount-paid_amount;
        if(amount>0){
            add_row();
        }
    }
    }



     function  calculate_amount() {
        var paid_amount = ~~parseInt($('#paid_amount').val());
        var amount= ~~parseInt($('#amount').val());
		var amount= ~~parseInt($('#amount').val());
        var balance=amount-paid_amount;
        $('#balance').val(balance);
    }

    function  calculate_balance() {
        var balance = ~~parseInt($('#balance').val());
        var balance=0;
        var amount = $('input[name="amount[]"]');
		var amount = $('input[name="amount[]"]');
        for(var j=0;j<i;j++){
            balance=balance+parseInt(amount.eq(j)+ amount.eq(j).val());
        }
        balance=amount+amount-paid_amount;
        $('#balance').val(balance);
    }


</script>
</body>
</html>

