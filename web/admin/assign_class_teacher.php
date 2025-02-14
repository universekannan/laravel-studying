<?php
session_start();
$page = "Assign";
$page1 = "Assign Class Teacher";
include "timeout.php";
include "config.php";
if (($_SESSION['user_type'] != "admin") && ($_SESSION['user_type'] != "principal")) header("location: index.php");
$user_id=$_SESSION['user_id'];
$msg = "";
$msg_color = "";
$staff_id="";
$class_id="";
$status="";
$subject_id="";
if (isset($_POST['submit'])) {
	$date = date('y/m/d');   
	$class_id = trim($_POST['class_id']);
	$staff_id = trim($_POST['staff_id']);
	$subject_id = trim($_POST['subject_id']);
	$status = trim($_POST['status']);

   $sql = "SELECT * FROM assign_staff WHERE trim(staff_id)='$staff_id' AND trim(class_id)='$class_id'";

    $result = mysqli_query($conn, $sql);

    $count = mysqli_num_rows($result);



    if ($count >= 1) {

        $msg = "Staff Name And Class already in use";

        $msg_color = "red";

    } else {

        $msg_color = "green";

        if($_SESSION['user_type']=="admin") {

            $msg = "Staff Name And Class added successfully";

        }else{

            $msg = "Staff Name And Class added successfully";

        }

        $stmt = $conn->prepare("INSERT INTO assign_staff (class_id,staff_id,subject_id,status,user_id,date) VALUES (?,?,?,?,?,?)");
        $stmt->bind_param("ssssss",$class_id,$staff_id,$subject_id,$status,$user_id,$date);
        $stmt->execute() or die ($stmt->error);
		$id = $stmt->insert_id;
       
        header("location: view_class_teacher.php");
    }
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Assign Staff</title>
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
                                <h1 class="panel-title">Assign Class Teacher</h1>
                            </div>
                            <div class="panel-body">
                                <div class="row">
                            <form method="post" action="" enctype="multipart/form-data">

                            <div class="panel-body">

                                <div class="row">

                                    <div class="col-md-12">
                                          <div class="form-group">
                                            <label for="staff_id required"
                                                   class="control-label required">Staff Name</label>
                                            <select name="staff_id" class="form-control" required="required" >
                                                <option value="">----- Select -----</option>
                                                <?php
                                                $sql2 = "select * from users where user_type='staff' ";
                                                $result2 = mysqli_query($conn, $sql2);
                                                while ($row2 = mysqli_fetch_assoc($result2)) {
                                                    ?>
                                                    <option value="<?php echo $row2['id']; ?>" ><?php echo $row2['full_name']; ?></option>
												<?php }?>
												</select>
    
                                        </div>  
                                        <div class="form-group">
                                            <label for="class_id required"
                                                   class="control-label required">Class Name</label>
                                            <select name="class_id" class="form-control" required="required" >
                                                <option value="">----- Select -----</option>
                                                <?php
                                                 $sql2 = "select * from class";

                                                $result2 = mysqli_query($conn, $sql2);
                                                while ($row2 = mysqli_fetch_assoc($result2)) {
                                                    ?>
                                                    <option value="<?php echo $row2['id']; ?>" ><?php echo $row2['standard']; ?> <?php echo $row2['section_name']; ?></option>
												<?php }?>
                                          </select>
                                        </div>
										
										<div class="form-group">
                                                <label for="status" class="control-label required">Status</label>
                                                <select name="status" id="status" class="form-control">
<option 
                                                        value="">----- Select -----
                                                    </option>
                                                    <option 
                                                        value="class_teacher">Class Teacher
                                                    </option>
                                                    <option value="class">Teacher
                                                    </option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="subject_id" class="control-label required">Subject</label>
                                                <select name="subject_id" id="subject_id" class="form-control">
<option 
                                                        value="">----- Select -----
                                                    </option>
                                                     <?php
                                                 $sql2 = "select * from subject";

                                                $result2 = mysqli_query($conn, $sql2);
                                                while ($row2 = mysqli_fetch_assoc($result2)) {
                                                    ?>
                                                    <option value="<?php echo $row2['id']; ?>" ><?php echo $row2['sub_name']; ?></option>
												<?php }?>
                                                </select>
                                            </div>
                                        <div class="form-group text-center">
                                            <input required="required" class="btn btn-info"
                                                   type="submit"
                                                   name="submit" value="Save"/>
                                            <a href="view_class_teacher.php" class="btn btn-info">Back</a>
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
    </section>
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

