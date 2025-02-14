<?php
session_start();
$page = "student-markdetails";
include "timeout.php";
include "config.php";
if (($_SESSION['user_type'] != "admin") && ($_SESSION['user_type'] != "principal")&& ($_SESSION['user_type'] != "staff") && ($_SESSION['user_type'] != "student")) header("location: index.php");
$msg = "";
$msg_color = "";
$school_id=$_GET['id'];
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Student Mark Details</title>
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
 <br /> <div class="container">
    <div class="row">

        <div class="col-md-12">
            <div class="panel-group panel-dark" id="accordion">
			      <?php
                         if($_SESSION['user_type']=="admin"){
                          $sql = "select a.*,b.section_name,standard,c.sub_name,d.full_name,e.exam_name from student_marklist a,class b,subject c,student_record d,exam e where a.class_id=b.id and a.subject_id=c.id  and a.exam_id=e.id and a.school_id=d.school_id";
                    }
					else if($_SESSION['user_type']=="principal"){
                          $sql = "select a.*,b.section_name,standard,c.sub_name,d.full_name,e.exam_name from student_marklist a,class b,subject c,student_record d,exam e where a.class_id=b.id and a.subject_id=c.id  and a.exam_id=e.id and a.school_id=d.school_id  and a.school_id=$school_id group by a.exam_id";
                    }
					else if($_SESSION['user_type']=="staff"){
                          $sql = "select a.*,b.section_name,standard,c.sub_name,d.full_name,e.exam_name from student_marklist a,class b,subject c,student_record d,exam e where a.class_id=b.id and a.subject_id=c.id  and a.exam_id=e.id and a.school_id=d.school_id  and a.school_id=$school_id group by a.exam_id";
                    }
                        $result = mysqli_query($conn, $sql);  
                        while ($row = mysqli_fetch_assoc($result)) {
                            ?>
			
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#<?php echo $row['exam_id']; ?>" class="collapsed">
                                <i class="glyphicon glyphicon-chevron-down"></i><?php echo $row['exam_name']; ?>
													</a>
												</h4>
											</div>
											
											<div id="<?php echo $row['exam_id']; ?>" class="panel-collapse collapse">
											<form method="post" action="" enctype="multipart/form-data">	
												<div class="panel-body">
		 
				
		                   <div class="login-panel panel panel-default">

						<div class="table-responsive">
       <div class="box-header">
             <center> <h3 class="box-title">View Student Mark Details...</h3> </center>
            </div>

                         <table id="example1" class="table table-bordered table-striped">
                    <thead>
                         <tr style="background-color: #81888c;color:white">
                         <th>Student Name</th>
                         <th>Class Name</th>
                         <th>Exam  Name</th>
                         
                            <th>Subject Name</th>
                            <th>Mark</th>
                            
                                        </tr>
                                    </thead>
                                       <tbody>
                      
                            <td><?php echo $row['full_name']; ?></td>
                            <td><?php echo $row['standard']; ?><?php echo $row['section_name']; ?></td>
                                <td><?php echo $row['exam_name']; ?></td>
                                <td><?php echo $row['sub_name']; ?></td>
                                <td><?php echo $row['mark']; ?></td>
                               
                              
                            </tr>
                      
                        </tbody>
                                        </tbody>
									</table>
									<!-- /.box -->
 </div>
            </div>
          
          <!-- /.box -->
        
                                      
                            </div>

                    </div>
                </div>

                </form>

               <?php
                }
?>
              
            </div>
        </div>
    </div>
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
