<?php
session_start();
$page = "Fees Details";
$page1 = "Add Fees Details";
include "timeout.php";
include "config.php";
if (($_SESSION['user_type'] != "admin") && ($_SESSION['user_type'] != "principal") && ($_SESSION['user_type'] != "ofstaff") && ($_SESSION['user_type'] != "staff") && ($_SESSION['user_type'] != "student")) header("location: index.php");
$user_id=$_SESSION['user_id'];
$msg = "";
$msg_color = "";
$amount="";
$class_id="";
$fees_id="";
if (isset($_POST['submit'])) {
	$date = date('y/m/d');   
    $amount = trim($_POST['amount']);
    $class_id = trim($_POST['class_id']);
    $fees_id = trim($_POST['fees_id']);
   

        $stmt = $conn->prepare("INSERT INTO fees_detail (fees_id,class_id,amount,user_id,date) VALUES (?,?,?,?,?)");
        $stmt->bind_param("sssss",$fees_id,$class_id,$amount,$user_id,$date);
        $stmt->execute() or die ($stmt->error);
		$id = $stmt->insert_id;
       
        header("location: view_fees_details.php");
    
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Add Fees Details</title>
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
                                <h1 class="panel-title">Add Fees Details</h1>
                            </div>
                            <div class="panel-body">
                                <div class="row">
                            <form method="post" action="" enctype="multipart/form-data">

                            <div class="panel-body">

                                <div class="row">

                                    <div class="col-md-12">
									
										<div class="form-group">
                                            <label for="class_id required"
                                                   class="control-label required">Class Name</label>
                                            <select name="class_id" class="form-control" required="required" >
                                                <option value="">-----Select------</option>
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

                                            <label for="class_name" class="control-label required">Fees Name</label>

                                            <select name="fees_id" id="fees_id" class="form-control">
                                            <option value="">-----Select------</option>
                                            <?php
                                            $sql = "select * from fees order by fees_name";
                                            $result = mysqli_query($conn, $sql);
                                            while ($row = mysqli_fetch_assoc($result)) {
                                                ?>
                                                <option
                                                    value="<?php echo $row['id']; ?>"
                                                    <?php if($fees_id==$row['fees_name']) echo " selected "; ?>
                                                ><?php echo $row['fees_name']; ?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                        </div>
										<div class="form-group">
                                                <label for="amount required"
                                                       class="control-label required">Amount</label>
                                                <input value="<?php echo $amount; ?>" required="required" type="text"
                                                       maxlength="50"
                                                       name="amount" id="amount" class="form-control"
                                                       placeholder="Amount">
                                            </div>
										
                                        <div class="form-group text-center">
                                            <input required="required" class="btn btn-info"
                                                   type="submit"
                                                   name="submit" value="Save"/>
                                            <a href="view_class.php" class="btn btn-info">Back</a>
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
