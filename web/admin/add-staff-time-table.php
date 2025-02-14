<?php
session_start();
$page = "Staff";
$page1 = "Staff Records";
include "timeout.php";
include "config.php";
$msg = "";
$msg_color = "";
$staff_id=$_GET['id'];
$day_id = "";
$class_id = "";
if (isset($_POST['submit'])) {

    $day_id = trim($_POST['day_id']);
    $class_id = trim($_POST['class_id']);

    $sql = "SELECT * FROM staff_time_table WHERE trim(day_id)='$day_id' AND trim(class_id)='$class_id' AND trim(staff_id)='$staff_id'";
    $result = mysqli_query($conn, $sql);
    $count = mysqli_num_rows($result);

    if ($count >= 1) {
        $msg = "Time Table already in use";
        $msg_color = "red";
    } else {
        $msg_color = "green";
        if($_SESSION['user_type']=="superadmin") {
            $msg = "Time Table added successfully";
        }else{
            $msg = "Time Table added successfully";
        }
        $stmt = $conn->prepare("INSERT INTO staff_time_table (day_id,class_id,staff_id) VALUES (?,?,?)");
        $stmt->bind_param("sss",$day_id, $class_id, $staff_id);
        $stmt->execute() or die($stmt->error);
        $id=$stmt->insert_id;

        

    }

}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Users</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.css">
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
 <br /> 
               
				 <div class="col-xs-12">
				
		                   <div class="login-panel panel panel-default">

						<div class="table-responsive">
       <div class="box-header">
             <center> <h3 class="box-title">View Time Tabil</h3> </center>
            </div>

                         <table id="" class="table table-bordered table-striped">
                    <thead>
                         <tr style="background-color: #81888c;color:white">
                            <th>Days</th>
							
                            <th><a class="btn btn-info pu" href="class_time_tabil_1.php?id=1">Pried 1</a></th>
                            <th>Pried 2</th>
                            <th>Pried 3</th>
                            <th>Pried 4</th>
                            <th>Pried 5</th>
                            <th>Pried 6</th>
                            <th>Pried 7</th>
                            <th>Pried 8</th>
                            <th>Edit</th>
                                        </tr>
                                    </thead>
                                       <tbody>
<style>
 .pu{
width: 105px;
}
    </style>
						<?php
						$sql = "select a.*,b.day_name from staff_time_table a,days b where a.day_id=b.id GROUP BY a.day_id";
                        $result = mysqli_query($conn, $sql);
                        while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                            <tr>
                               <td><?php echo $row['day_name']; ?></td>
                                <td><a class="btn btn-info pu" href="class_time_tabil_1.php?id=<?php echo $row['id']; ?>"  title="<?php echo $row['subject_1']; ?>"> <?php echo $row['pried_1']; ?></td>
                                <td><a class="btn btn-info pu" href="class_time_tabil_2.php?id=<?php echo $row['id']; ?>"  title="<?php echo $row['subject_2']; ?>"> <?php echo $row['pried_2']; ?></td>
								<td><a class="btn btn-info pu" href="class_time_tabil_3.php?id=<?php echo $row['id']; ?>"  title="<?php echo $row['subject_3']; ?>"> <?php echo $row['pried_3']; ?></td>
								<td><a class="btn btn-info pu" href="class_time_tabil_4.php?id=<?php echo $row['id']; ?>"  title="<?php echo $row['subject_4']; ?>"> <?php echo $row['pried_4']; ?></td>
								<td><a class="btn btn-info pu" href="class_time_tabil_5.php?id=<?php echo $row['id']; ?>"  title="<?php echo $row['subject_5']; ?>"> <?php echo $row['pried_5']; ?></td>
								<td><a class="btn btn-info pu" href="class_time_tabil_6.php?id=<?php echo $row['id']; ?>"  title="<?php echo $row['subject_6']; ?>"> <?php echo $row['pried_6']; ?></td>
								<td><a class="btn btn-info pu" href="class_time_tabil_7.php?id=<?php echo $row['id']; ?>"  title="<?php echo $row['subject_7']; ?>"> <?php echo $row['pried_7']; ?></td>
								<td><a class="btn btn-info pu" href="class_time_tabil_8.php?id=<?php echo $row['id']; ?>"  title="<?php echo $row['subject_8']; ?>"> <?php echo $row['pried_8']; ?></td>
								<td>
								<a class="btn btn-info fa fa-edit" href="edit-staff-time-table.php?id=<?php echo $row['id']; ?>" title="Edit Time Table"></a></td>

							</tr>
						 <?php }  ?>
						
                        </tbody>
                                        </tbody>
									</table>
									<!-- /.box -->
									
 </div>
            </div>
          
          <!-- /.box -->
        </div>
		
		 <div class="col-xs-12">
				
		                   <div class="login-panel panel panel-default">

						<div class="table-responsive">
       <div class="box-header">
             <center> <h3 class="box-title">Add Time Tabil</h3> </center>
            </div>
						       <form method="post" action="" enctype="multipart/form-data">

                         <table id="" class="table table-bordered table-striped">

                                       <tbody>
<style>
 .pu{
width: 105px;
}
    </style>

                            <tr>

								 <td>
								<div class="form-group">
                                            <label for="day_id required"
                                                   class="control-label required">Days</label>
                                            <select name="day_id" class="form-control" required="required" >
                                                <option value="">-----Select------</option>
                                                <?php
                                                 $sql2 = "select * from days";

                                                $result2 = mysqli_query($conn, $sql2);
                                                while ($row2 = mysqli_fetch_assoc($result2)) {
                                                    ?>
                                                    <option value="<?php echo $row2['id']; ?>" > <?php echo $row2['day_name']; ?></option>
												<?php }?>
                                          </select>
                                        </div>
										</td>
 <td>
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
										</td>
										<td>
                               <div class="form-group">
                                            <label for="pried_1 required"
                                                   class="control-label required">Pried 1</label>
                                            <select name="pried_1" class="form-control" required="required" >
                                                <option value="">-----Select------</option>
													<option value="">Leisure Time</option>

                                                <?php
                                                 $sql2 = "select * from class";

                                                $result2 = mysqli_query($conn, $sql2);
                                                while ($row2 = mysqli_fetch_assoc($result2)) {
                                                    ?>
                                                    <option value="<?php echo $row2['standard']; ?> <?php echo $row2['section_name']; ?>" ><?php echo $row2['standard']; ?> <?php echo $row2['section_name']; ?></option>

												<?php }?>
                                          </select>
                                        </div>
										</td>
                             <td>
								<div class="form-group">
                                            <label for="subject_1 required"
                                                   class="control-label required">Subject</label>
                                            <select name="subject_1" class="form-control" required="required" >
                                                <option value="">-----Select------</option>
													<option value="">Leisure Time</option>
													<?php
                                                 $sql2 = "select * from subject";

                                                $result2 = mysqli_query($conn, $sql2);
                                                while ($row2 = mysqli_fetch_assoc($result2)) {
                                                    ?>
                                                    <option value="<?php echo $row2['sub_name']; ?>" ><?php echo $row2['sub_name']; ?></option>
												<?php }?>
                                          </select>
                                        </div>
										</td>
							</tr>
						
                        </tbody>
                                        </tbody>
									</table>
									<div class="form-group text-center">
                                            <input required="required" class="btn btn-info"
                                                   type="submit"
                                                   name="submit" value="Save"/>
                                            <a href="view_class.php" class="btn btn-info">Back</a>
                                        </div>
										                        </form>	
									<!-- /.box -->
									
 </div>
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
