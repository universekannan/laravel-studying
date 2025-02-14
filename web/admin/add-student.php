<?php
session_start();
$page = "Students";
$page1 = "Student Admission";
include "timeout.php";
include "config.php";
if(($_SESSION['user_type'] != "admin") && ($_SESSION['user_type'] != "principal") && ($_SESSION['user_type'] != "staff")) header("location: index.php");
$msg = "";
$msg_color = "";
$full_name = "";
$status = "Inactive";
$mobile = "";
$user_type = "student";
$photo = "";

if (isset($_POST['submit'])) {

    $full_name = trim($_POST['full_name']);
    $mobile = trim($_POST['mobile']);

        $stmt = $conn->prepare("INSERT INTO users (full_name,status,mobile,user_type,photo) VALUES (?,?,?,?,?)");

        $stmt->bind_param("sssss", $full_name,$status,$mobile,$user_type,$photo);
		
        $stmt->execute() or die ($stmt->error);

        $id=$stmt->insert_id;
		
		$file_name = $_FILES['photo']['name'];
        if (trim($file_name) != "") {
            $ext = pathinfo($file_name, PATHINFO_EXTENSION);
            $file_name = $id . "." . $ext;
            $query = "update users set photo = '" . $file_name . "' where id=$id";
            mysqli_query($conn, $query);
            $target_path = "photo/";
            $target_path = $target_path . $file_name;
            move_uploaded_file($_FILES['photo']['tmp_name'], $target_path);
        }
        header("location: add-student.php");
    }

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
                                <h1 class="panel-title">Add Student</h1>
                            </div>
                            <div class="panel-body">
                                <div class="row">
                            <form method="post" action="" enctype="multipart/form-data">

                            <div class="panel-body">

                                <div class="row">

                                    <div class="col-md-12">

                                       

                                            <div class="form-group">

                                                <label for="full_name required"

                                                       class="control-label required">Full Name</label>

                                                <input value="<?php echo $full_name; ?>" required="required" type="text"

                                                       maxlength="50"

                                                       name="full_name" id="full_name" class="form-control"

                                                       placeholder="Full Name">

                                            </div>

                                        <div class="form-group">

                                            <label for="mobile" class="control-label">Mobile</label>

                                            <input value="<?php echo $mobile; ?>" pattern="[0-9]+\[1-9]+" maxlength="50"

                                                   name="mobile" class="form-control" placeholder="Mobile">

                                        </div>


                                       			
										
										<div class="form-group">


                                        <div class="form-group text-center">

                                            <input required="required" class="btn btn-info"

                                                   type="submit"

                                                   name="submit" value="Save"/>

                                            <a href="users.php" class="btn btn-info">Back</a>

                                        </div>

                                    </div>



                                </div>

                            </div>

                        </form>
								</div>
                                </div>
                            </div>
							<div class="panel-heading" align="center">
                                <h1 class="panel-title">Admission Bending</h1>
                            </div>
							
 <div class="box-body">
                         <table id="example1" class="table table-bordered table-striped">
                    <thead>
                         <tr style="background-color: #2a6b90;color:white">
                            <th>Photo</th>
                            <th>RG Number</th>
                            <th>Student Name</th>
                            <th>Mobile</th>
                            <th width="80px">Action</th>

                         
                                        </tr>
                                    </thead>
                                       <tbody>
                        <?php
                        
                        $sql = "select * from users where user_type='student' and status='Inactive'";
			
                        $result = mysqli_query($conn, $sql);
                        while ($row = mysqli_fetch_assoc($result)) {
                            ?>
                            <tr>
							<td>
                                <center> 
                                <img width="20" height="25" src="photo/<?php echo $row['photo']; ?>?<?php echo rand(); ?>"/>
                                </center>
                                </td>
                                 <td><?php echo $row['id']; ?></td>

                                <td><?php echo $row['full_name']; ?></td>
                                <td><?php echo $row['mobile']; ?></td>
                                <td>
                                <a class="btn btn-info fa fa-edit" href="edit-student-login.php?id=<?php echo $row['id']; ?>"></a>
                                <a class="btn btn-info fa fa-trash-o" href="delete-student-record.php?id=<?php echo $row['id']; ?>"></a></td>
                            </tr>
                        <?php

                        }
                        ?>
                        </tbody>
                                        
									</table>
									<!-- /.box -->
 </div>
                    </div>
                    </div>
                </div>

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
