<?php
session_start();
$page = "library_book";
include "timeout.php";
include "config.php";
if (($_SESSION['user_type'] != "admin") && ($_SESSION['user_type'] != "principal") && ($_SESSION['user_type'] != "library")) header("location: index.php");
$id = $_GET['id'];
$msg = "";
$msg_color = "";
$book_name = "";
$book_id = "";
$author_name = "";

$total_book = "";
$penality_amount = "";

$status = "Active";

if (isset($_POST['submit'])) {
    $book_id = trim($_POST['book_id']);
    $book_name = trim($_POST['book_name']);
    $author_name = trim($_POST['author_name']);
    
    $total_book = trim($_POST['total_book']);
    $penality_amount = trim($_POST['penality_amount']);
    
    $status = $_POST['status'];
	

        $stmt = $conn->prepare("update library set book_id=?,total_book=?,book_name=?,author_name=?,penality_amount=?,status=? where id=?");
        $stmt->bind_param("sssssss",$book_id,$total_book,$book_name,$author_name,$penality_amount,$status,$id);
        $stmt->execute();
         

        header("location: library_book.php");
    }


$sql = "select * from library where id=$id";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);


?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 2 | Data Tables</title>
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
 <br /> <br />
				<div class="row">
					<div class="col-lg-12">				
									<div class="panel panel-primary">
							<div class="panel-heading" align="center">
								<h1 class="panel-title">Edit Book</h1>
							</div>
							<div class="panel-body">
								<div class="row">

                        <form method="post" action="" enctype="multipart/form-data">
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-12">
									<div class="col-md-6">
									<div class="form-group">
                                                    <label for="book_id required"
                                                           class="control-label required">Book Id</label>
                                                    <input value="<?php echo $row['book_id']; ?>" required="required" type="text"
                                                           
                                                           name="book_id" id="book_id" class="form-control"
                                                           placeholder="Book Id">
                                                </div>
                                 
												  <div class="form-group">
                                                    <label for="book_name required"
                                                           class="control-label required">Book Name</label>
                                                    <input value="<?php echo $row['book_name']; ?>" required="required" type="text"
                                                           
                                                           name="book_name" id="book_name" class="form-control"
                                                           placeholder="Book Name">
                                                </div>
                                                <div class="form-group">
                                                    <label for="author_name required"
                                                           class="control-label required">Author Name</label>
                                                    <input value="<?php echo $row['author_name']; ?>" required="required" type="text"
                                                           
                                                           name="author_name" id="author_name" class="form-control"
                                                           placeholder="Author Name">
                                                </div>
                                                </div>
												<div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="total_book required"
                                                           class="control-label required">Total No Of  Name</label>
                                                    <input value="<?php echo $row['total_book']; ?>" required="required" type="number"
                                                           
                                                           name="total_book" id="total_book" class="form-control"
                                                           placeholder="Total Book">
                                                </div>
												
												<div class="form-group">
                                                    <label for="penality_amount required"
                                                           class="control-label required">Penality Amount</label>
                                                    <input value="<?php echo $row['penality_amount']; ?>" required="required" type="text"
                                                           
                                                           name="penality_amount" id="penality_amount" class="form-control"
                                                           placeholder="Penality Amount ">
                                                </div>

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
                                         
                                        <div class="form-group text-center">
                                            <input required="required" class="btn btn-info"
                                                   type="submit"
                                                   name="submit" value="Update"/>
                                            <a href="library_book.php" class="btn btn-info">Back</a>
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
			</div>
			<?php include "footer.php"; ?>
		</div>
				

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
