<?php
session_start();
$page = "Students";
$page1 = "Class";
include "timeout.php";
include "config.php";
if (($_SESSION['user_type'] != "admin") && ($_SESSION['user_type'] != "principal") && ($_SESSION['user_type'] != "staff") && ($_SESSION['user_type'] != "student")) header("location: index.php");
$msg = "";
$msg_color = "";
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>View Student Record</title>
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
 <br /> 
               
                <?php
                $school_id=$_GET['id'];
                $sql = "SELECT a.*,b.section_name,standard FROM student_record a,class b WHERE a.class_id=b.id and school_id=$school_id";
                $result = mysqli_query($conn, $sql);
                $row = mysqli_fetch_assoc($result);
                ?>
        
                <div class="col-md-3">
                </div>
                <div class="col-md-6">
        <style>table{font-size:13px;font-weight:bold;font-style:italic;}</style>
        
                    <table class="table" style="margin-top: 20px;">
        
        
                        <style>
                            th{
                                color:blue;
                            }
                        </style>
                        <thead>
                       
        
                        <tr>
                            <th colspan="2" style="font-size:25px" align="center">Student Record Details...</th>
        
                        </tr>
                        <tr>
                            <td>Register Number</td><td>SMRV<?php echo $row['standard']; ?><?php echo $row['section_name']; ?><?php echo $row['id']; ?></td>
                        </tr>
                        <tr>
                            <td>Student Name</td><td><?php echo $row['full_name']; ?></td>
                        </tr>
                        <tr>
                            <td>Date Of Join</td><td><?php echo $row['date_of_join']; ?></td>
                        </tr>
                        <tr>
                            <td>Date Of Birth</td><td><?php echo $row['date_of_birth']; ?></td>
                        </tr>
                        <tr>
                            <td>Blood Group</td><td><?php echo $row['blood_group']; ?></td>
                        </tr>
                       
                        <tr>
                            <td>Class </td><td><?php echo $row['standard']; ?><?php echo $row['section_name']; ?></td>
                        </tr>
                        <tr>
                            <td>Religion</td><td><?php echo $row['religion']; ?></td>
                        </tr>
        
                        <tr>
                            <td>Mother Tongue</td><td><?php echo $row['mother_tongue']; ?></td>
                        </tr>
                        <tr>
                            <td>Second Language</td><td><?php echo $row['second_language']; ?></td>
                        </tr>
        
                        <tr>
                            <td>Physical Status</td><td><?php echo $row['physical_status']; ?></td>
                        </tr>
                        <tr>
                            <td>Photo</td><td><?php echo $row['photo']; ?></td>
                        </tr>
                        <tr>
                            <td>Admission Number</td><td><?php echo $row['admission_no']; ?></td>
                        </tr>
                        <tr>
                            <td>Last Name</td><td><?php echo $row['last_name']; ?></td>
                        </tr>
                        <tr>
                            <td>Gender</td><td><?php echo $row['gender']; ?></td>
                        </tr>
                        <tr>
                            <td>Age</td><td><?php echo $row['age']; ?></td>
                        </tr>
                        <tr>
                            <td>Medium</td><td><?php echo $row['medium']; ?></td>
                        </tr>
                        
                        <tr>
                            <td>Sub Cast</td><td><?php echo $row['sub_cast']; ?></td>
                        </tr>
                        <tr>
                            <td>First Language</td><td><?php echo $row['first_language']; ?></td>
                        </tr>
                        <tr>
                        <td>Hostler</td><td><?php echo $row['hostler']; ?></td>
                    </tr>
                    <tr>
                        <td>Nationality</td><td><?php echo $row['nationality']; ?></td>
                    </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
									<!-- /.box -->
 </div>
            </div>
          
          <!-- /.box -->
        </div>
        <!-- /.col -->
        <?php include "footer.php"; ?>
      </div>
      
      <!-- /.row -->
    </section>
    
    <!-- /.content -->
  </div>

      

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
