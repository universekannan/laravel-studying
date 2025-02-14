<?php
//alter table jobs add to_experience int(11) not null;
ob_start();
$app = "";
$out = "";
$error = "";
$res = "";
include("config.php");
session_start();


    $school_id = "";
    $search_in = "";
    $advance_search_submit = "";
	

    
    $queryCondition = "";
    if(!empty($_POST["search"])) {
        $advance_search_submit = $_POST["advance_search_submit"];
        foreach($_POST["search"] as $k=>$v){
            if(!empty($v)) {

                $queryCases = array("school_id");
                if(in_array($k,$queryCases)) {
                    if(!empty($queryCondition)) {
                        $queryCondition .= " AND ";
                    } else {
                        $queryCondition .= " WHERE ";
                    }
                }
                switch($k) {
                    case "school_id":
                        $school_id = $v;
                        $wordsAry = explode(" ", $v);
                        $wordsCount = count($wordsAry);
                        for($i=0;$i<$wordsCount;$i++) {
                            if(!empty($_POST["search"]["search_in"])) {
                                $queryCondition .= $_POST["search"]["search_in"] . " LIKE '%" . $wordsAry[$i] . "%'";
                            } else {
                                $queryCondition .= "school_id LIKE '" . $wordsAry[$i] . "%' OR school_id LIKE '" . $wordsAry[$i] . "%'";
                            }
                            if($i!=$wordsCount-1) {
                                $queryCondition .= " OR ";
                            }
                        }
                        break;
                    
						
                    case "search_in":
                        $search_in = $_POST["search"]["search_in"];
                        break;
                }
            }
        }
    }
    $orderby = " ORDER BY id desc"; 
    $sql = "SELECT * FROM student_record " . $queryCondition;
    $result = mysqli_query($conn,$sql);
	
	
	
?>




<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Add Issue Book </title>
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
                                <h1 class="panel-title">Add Issue Book</h1>
                            </div>
                            <div class="panel-body">
                                <div class="row">
        
    <script>
        function showHideAdvanceSearch() {
            if(document.getElementById("advanced-search-box").style.display=="none") {
                document.getElementById("advanced-search-box").style.display = "block";
                document.getElementById("advance_search_submit").value= "1";
            } else {
                document.getElementById("advanced-search-box").style.display = "none";
                document.getElementById("school_id").value= "";
                document.getElementById("search_in").value= "";
                document.getElementById("advance_search_submit").value= "";
            }
        }
    </script>
    </head>
    <body>
        
    <div>      
            <form name="frmSearch" method="post" action="search-issue-book.php">
            <input type="hidden" id="advance_search_submit" name="advance_search_submit" value="<?php echo $advance_search_submit; ?>">
                       
                <div class="panel-body">

                                <div class="row">

                                    <div class="col-md-12">

                                       

                                            <div class="form-group">

                                                <label for="full_name required"

                                                       class="control-label required">Student Id </label>

                                                <input value="<?php echo $school_id; ?>" required="required" type="text"

                                                       maxlength="50"

                                                       name="search[school_id]" id="search[school_id]" class="form-control"

                                                       placeholder="Student Id">

                                            </div>
                                        </div>
                                   </div>
                                </div>
             
			
										<div class="form-group text-center">

                                            <input required="required" class="btn btn-info"

                                                   type="submit"

                                                   name="go" value="Search"></input>

                                           

                                        </div>
                    
                
            <?php if($row = mysqli_fetch_assoc($result)) { ?>
            <div>
			                <table class="table">
                    <thead>
                    <tr>

			<th>Photo</th>
                        <th>Student Name</th>
                        <th>Father Name</th>
                        <th>mobile</th>
                        <th>Gender</th>
                        <th>Date Of Birth</th>
                        <th>Address</th>
                        <th>Action</th>
                        
						
				 </tr>
                    </thead>
                    <tbody>
                    <?php echo $out; ?>
                    </tbody>
                
				
 
				<tr>
				<td>
                                <center> 
                                <img width="20" height="25" src="photo/<?php echo $row['photo']; ?>?<?php echo rand(); ?>"/>
                                </center>
                                </td>
                <td><div><strong><?php echo $row["full_name"]; ?></strong></div></td>
              
               <td> <div class="result-description"><?php echo $row["father_name"]; ?></div></td>
               <td> <div class="result-description"><?php echo $row["mobile"]; ?></div></td>
                <td> <div class="result-description"><?php echo $row["gender"]; ?></div></td>
                <td> <div class="result-description"><?php echo $row["date_of_birth"]; ?></div></td>
                 <td> <div class="result-description"><?php echo $row["address"]; ?></div></td>
               <td>  <a href="add-issue-book.php?id=<?php echo $row['id']; ?>" class="btn btn-info"><i class="fa fa-book"></i></a></td>
                
			

			
            <?php } ?>
        </div>
       
		</form>
		</table>
		
   
       
    <!-- /.content -->
  </div>
  </div>
  </div>
  </div>
  </div>
	

  <!-- Control Sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->
</section>	<?php include "footer.php"; ?>
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
