<?php
session_start();
$page = "users";
include "timeout.php";
include "config.php";
if (($_SESSION['user_type'] != "staff")) header("location: index.php");
$user_id=$_SESSION['user_id'];
$msg = "";
$msg_color = "";
$pass_mark="";
$class_id="";
$exam_time="";
$subject_id="";
$exam_date="";
$total_mark="";
$description="";
if (isset($_POST['submit'])) {
	$date = date('y/m/d');   
	$class_id = trim($_POST['class_id']);
    $subject_id = trim($_POST['subject_id']);
	$exam_date = trim($_POST['exam_date']);
	$exam_time = trim($_POST['exam_time']);
	$description = trim($_POST['description']);
	$pass_mark = trim($_POST['pass_mark']);
	$total_mark = trim($_POST['total_mark']);
   
		 $stmt = $conn->prepare("INSERT INTO exam_schedule (class_id,subject_id,exam_date,exam_time,description,pass_mark,total_mark,user_id,date) VALUES (?,?,?,?,?,?,?,?,?)");
        $stmt->bind_param("sssssssss",$class_id,$subject_id,$exam_date,$exam_time,$description,$pass_mark,$total_mark,$user_id,$date);
		
        $stmt->execute() or die($stmt->error);
		$id = $stmt->insert_id;
       
        header("location: view_examschedule.php");
    
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Add Exam Schedule</title>
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

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

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
 <br /> <br />
 
				        <div class="panel-heading text-center">
                            <b>Exam Schedule</b>
                        </div>
        <div class="col-xs-12">
		                   <div class="login-panel panel panel-default">
 <form method="post" action="" enctype="multipart/form-data">
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-12">
                                            
                                        <div class="form-group">
                                            <label for="class_id required"
                                                   class="control-label required">Class </label>
                                            <select name="class_id" class="form-control" required="required" >
                                                <option value="">Select</option>
                                                <?php
                                                $sql2 = "select * from class order by class_name";
                                                $result2 = mysqli_query($conn, $sql2);
                                                while ($row2 = mysqli_fetch_assoc($result2)) {
                                                    ?>
                                                    <option value="<?php echo $row2['id']; ?>" ><?php echo $row2['class_name']; ?></option>
												<?php }?>
                                          </select>
                                        </div>
	
										 <div class="form-group">
                                            <label for="subject_id required"
                                                   class="control-label required">Subject </label>
                                            <select name="subject_id" class="form-control" required="required" >
                                                <option value="">Select</option>
                                                <?php
                                                $sql2 = "select * from subject order by sub_name";
                                                $result2 = mysqli_query($conn, $sql2);
                                                while ($row2 = mysqli_fetch_assoc($result2)) {
                                                    ?>
                                                    <option value="<?php echo $row2['id']; ?>" ><?php echo $row2['sub_name']; ?></option>
												<?php }?>
												</select>
    
                                        </div>
										
										
										<div class="form-group">
                                            <label for="exam_date" class="control-label required"> Exam Date</label>
                                            <input value="<?php echo $exam_date; ?>" maxlength="50" type="date"
                                                   name="exam_date" class="form-control" placeholder="Exam Date">
                                        </div>
										<div class="form-group">
                                            <label for="exam_time" class="control-label required"> Exam Time</label>
                                            <input value="<?php echo $exam_time; ?>" maxlength="50" type="text"
                                                   name="exam_time" class="form-control" placeholder="Exam Time">
                                        </div>
										<div class="form-group">
                                            <label for="pass_mark" class="control-label required"> Pass Mark</label>
                                            <input value="<?php echo $pass_mark; ?>" maxlength="50" type="text"
                                                   name="pass_mark" class="form-control" placeholder="Pass Mark">
                                        </div>
										<div class="form-group">
                                            <label for="total_mark" class="control-label required"> Total Mark</label>
                                            <input value="<?php echo $total_mark; ?>" maxlength="50" type="text"
                                                   name="total_mark" class="form-control" placeholder="Total Mark">
                                        </div>
										<div class="form-group">
                                            <label for="description" class="control-label required">Description</label>
                                            <input value="<?php echo $description; ?>" maxlength="50" type="text"
                                                   name="description" class="form-control" placeholder=" Description">
                                        </div>
										
                                        <div class="form-group text-center">
                                            <input required="required" class="btn btn-info"
                                                   type="submit"
                                                   name="submit" value="Save"/>
                                            <a href="view_examschedule.php" class="btn btn-info">Back</a>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </form>						
            </div>
          
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </group_name>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
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
