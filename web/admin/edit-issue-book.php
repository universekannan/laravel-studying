<?php

session_start();

$page = "edit-principal-record";

include "timeout.php";

include "config.php";

if (($_SESSION['user_type'] != "admin") && ($_SESSION['user_type'] != "principal") && ($_SESSION['user_type'] != "library")) header("location: index.php");
$user_id=$_SESSION['user_id'];
$id = $_GET['id'];


$msg = "";

$msg_color = "";

$school_id = "";
$class_id = "";
$book_id = "";
$book_name = "";
$author_name = "";
$return_date = "";
$status = 'Active';
$date = date('y/m/d');   


if (isset($_POST['submit'])) {

    
        $school_id= trim($_POST['school_id']);
        $class_id= trim($_POST['class_id']);
        $book_id= trim($_POST['book_id']);
        $book_name= trim($_POST['book_name']);        
        $author_name= trim($_POST['author_name']);
        $return_date= trim($_POST['return_date']);
        $status= trim($_POST['status']);
    

        $stmt = $conn->prepare("update issue_book set school_id=?,class_id=?,book_id=?,book_name=?,author_name=?,return_date=?,status=?,user_id=?,date=? where id=?");

        $stmt->bind_param("ssssssssss", $school_id,$class_id, $book_id,$book_name, $author_name,$return_date,$status,$user_id,$date,$id);

        $stmt->execute() or die($stmt->error);

       


        header("location: issue-book.php");

    }
    $sql = "select * from issue_book where id=$id";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    

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
        <link rel="stylesheet" href="css/jquery.datepicker.css">
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
                                <h1 class="panel-title">Edit Issue Book...</h1>
                            </div>
                            <div class="panel-body">
                                <div class="row">
                            <form method="post" action="" enctype="multipart/form-data">

                            <div class="panel-body">

                                <div class="row">

                                    <div class="col-md-12">

                                <div class="col-md-6">
                                        <div class="form-group">

                                            <label for="full_name" class="control-label required">School Id</label>

                                            <input readonly value="<?php echo $row['school_id']; ?>" required="required" maxlength="50" type="text"

                                                   name="school_id" class="form-control" placeholder="School Id">

                                        </div>



                                        

                                        <div class="form-group">

                                            <label for="class_id" class="control-label">Class Id</label>

                                            <input readonly value="<?php echo $row['class_id']; ?>" maxlength="20" type="text"

                                                   name="class_id" class="form-control" placeholder="Class Id">

                                        </div>


										<div class="form-group">

                                            <label for="Register_no" class="control-label required">Book Id</label>

                                            <input value="<?php echo $row['book_id']; ?>" required="required" type="text" maxlength="20"

                                                   name="book_id" id="book_id" class="form-control"

                                                   placeholder="Book Id">

                                        </div>

                                        
                                         
                                        </div>
									

                                <div class="col-md-6">
                                
                               
                                        
                                        

											
										<div class="form-group">

                                            <label for="book_name" class="control-label required">Book Name </label>

                                            <input value="<?php echo $row['book_name']; ?>" required="required" maxlength="50" type="text"

                                                   name="book_name" class="form-control" placeholder="Book Name ">

                                        </div>
                                    
									<div class="form-group">

                                            <label for="author_name" class="control-label required">Author Name</label>

                                            <input value="<?php echo $row['author_name']; ?>" required="required" type="text" maxlength="200"

                                                   name="author_name" id="author_name" class="form-control"

                                                   placeholder="Author Name">

                                        </div>
                                        </div>
										
										 <div class="col-md-3">
                                     <div class="form-group">
   
                                        
                                               <label>Return Date</label>
                                   
<div class="input-group">

						<input value="<?php echo $row['return_date']; ?>" type="text" class="form-control" name="return_date" id="return_date" data-select="datepicker" data-locked="25/12/2014;1/1/2015">
						<span class="input-group-btn"><button type="button" class="btn btn-primary" data-toggle="datepicker"><i class="fa fa-calendar"></i></button></span>
					</div>
					</div>
					</div>
					 <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="status" class="control-label required">Status</label>
                                            <select name="status" id="status" class="form-control">
                                                <option <?php if ($row['status'] == "Active") echo " selected='selected'"; ?>
                                                    value="Active">Active
                                                </option>
                                                <option <?php if ($row['status'] == "Inactive") echo " selected='selected'"; ?>
                                                    value="Inactive">Inactive
                                                </option>
                                            </select>
                                        </div>
                                </div>

                                </div>
                                </div>

                                <div class="form-group text-center">
                                <input required="required" class="btn btn-info fa fa-upload"
                                       type="submit"
                                       name="submit" value="Update"/>
                                <a href="issue-book.php" class="btn btn-info fa fa-refresh">&nbsp;Back</a>
                            </div>

                                    </div>



                                </div>

                            </div>

                        </form>
								</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

    </section>	<?php include "footer.php"; ?>
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
<script type="text/javascript" src="js/jquery.datepicker.js"></script>
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
