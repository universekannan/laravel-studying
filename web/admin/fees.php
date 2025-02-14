<?php
session_start();
$page = "Fees Details";
$page1 = "Fees";
include "timeout.php";
include "config.php";
if (($_SESSION['user_type'] != "admin") && ($_SESSION['user_type'] != "principal"))  header("location: index.php");
$msg = "";
$msg_color = "";
$fees_name="";
if (isset($_POST['submit'])) {
	$date = date('y/m/d');   
    $fees_name = trim($_POST['fees_name']);
	
	  $sql = "SELECT * FROM fees WHERE trim(fees_name)='$fees_name'";
    $result = mysqli_query($conn, $sql);
    $count = mysqli_num_rows($result);
   if ($count >= 1) {
        $msg = "Fees  already in use";
        $msg_color = "red";
    } else {
        $msg_color = "green";
        if($_SESSION['user_type']=="admin") {
            $msg = "Fees added successfully";
        }else{
            $msg = "Fees added successfully";
        }

        $stmt = $conn->prepare("INSERT INTO fees (fees_name,user_id,date) VALUES (?,?,?)");
        $stmt->bind_param("sss",$fees_name, $user_id,$date);
        $stmt->execute();
		$id = $stmt->insert_id;
       
        header("location: fees.php");
    
}}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title> View Fees</title>
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
      <div class="row">

				 <div class="col-xs-12">
				
		                   <div class="login-panel panel panel-default">

						<div class="table-responsive">
       <div class="box-header">
             <center> <h3>Fees Type List</h3> </center>
           <hr>
            </div>
   <div class="box-body">
                         <table id="example1" class="table table-bordered table-striped">
                    <thead>
                         <tr style="background-color: #2a6b90;color:white">
                            <th>Fess Name</th>
                            <th width="80px" style="text-align:right">Action</th>
                            
                                        </tr>
                                    </thead>
                                       <tbody>
                        <?php
                        if(($_SESSION['user_type']=="admin") || ($_SESSION['user_type'] == "principal")){
                            $sql = "select * from fees";
                        }
                        $result = mysqli_query($conn, $sql);
                        while ($row = mysqli_fetch_assoc($result)) {
                            ?>
                            <tr> 
                                 <td><?php echo $row['fees_name']; ?></td>
                                <td><a class="btn btn-info fa fa-edit" href="edit-fees.php?id=<?php echo $row['id']; ?>"></a>
                                <a class="btn btn-info fa fa-trash-o" href="delete-fees.php?id=<?php echo $row['id']; ?>"></a></td>
                            </tr>
                        <?php

                        }
                        ?>
                        </tbody>
                                        </tbody>
									</table>
									<!-- /.box -->
 </div>
            </div>
          
          <!-- /.box -->
        </div>
        <!-- /.col -->
     

				        <div class="panel-heading text-center">
                            <h3><b>Add Fees</b></h3>
							<center><br><span style="color:<?php echo $msg_color; ?>"><?php echo $msg; ?></span></center>
                        </div>
        <div class="col-xs-12">
		                   <div class="login-panel panel panel-default">
 <form method="post" action="" enctype="multipart/form-data">
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="fees_name required"
                                                       class="control-label required">Fees Name</label>
                                                <input value="<?php echo $fees_name; ?>" required="required" type="text"
                                                       maxlength="50"
                                                       name="fees_name" id="fees_name" class="form-control"
                                                       placeholder="Fees Name">
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
