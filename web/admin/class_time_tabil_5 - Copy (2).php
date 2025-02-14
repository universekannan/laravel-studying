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
$pried_5 = "";
$subject_5 = "";
if (isset($_POST['submit'])) {

    $day_id = trim($_POST['day_id']);
    $class_id = trim($_POST['class_id']);
    $pried_5 = trim($_POST['pried_5']);
    $subject_5 = trim($_POST['subject_5']);

        $stmt = $conn->prepare("INSERT INTO staff_time_table (day_id,class_id,staff_id,pried_5,subject_5) VALUES (?,?,?,?,?)");
        $stmt->bind_param("sssss",$day_id, $class_id, $staff_id=$staff_id, $pried_5,$subject_5);
        $stmt->execute() or die($stmt->error);
        $id=$stmt->insert_id;
		
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
                            <th><a class="btn btn-info pu" href="class_time_tabil_1.php?id=<?php echo $_GET['id']; ?>">Pried 1</a></th>
                            <th><a class="btn btn-info pu" href="class_time_tabil_2.php?id=<?php echo $_GET['id']; ?>">Pried 2</a></th>
                            <th><a class="btn btn-info pu" href="class_time_tabil_3.php?id=<?php echo $_GET['id']; ?>">Pried 3</a></th>
                            <th><a class="btn btn-info pu" href="class_time_tabil_4.php?id=<?php echo $_GET['id']; ?>">Pried 4</a></th>
                            <th><a class="btn btn-info pu" href="class_time_tabil_5.php?id=<?php echo $_GET['id']; ?>">Pried 5</a></th>
                            <th><a class="btn btn-info pu" href="class_time_tabil_6.php?id=<?php echo $_GET['id']; ?>">Pried 6</a></th>
                            <th><a class="btn btn-info pu" href="class_time_tabil_7.php?id=<?php echo $_GET['id']; ?>">Pried 7</a></th>
                            <th><a class="btn btn-info pu" href="class_time_tabil_8.php?id=<?php echo $_GET['id']; ?>">Pried 8</a></th>
                           
                                        </tr>
                                    </thead>
                                       <tbody>
<style>
 .pu{
width: 105px;
}
    </style>
		
                            <tr>
						<?php
						$sql2 = "select a.*,b.day_name from staff_time_table a,days b where a.day_id=b.id and a.day_id='2' and a.staff_id='$staff_id' GROUP BY a.day_id";

                        $result2 = mysqli_query($conn, $sql2);
                        while ($row2 = mysqli_fetch_assoc($result2)) {
                        ?>
                               <td><?php echo $row2['day_name']; ?></td>
							   <?php }  ?>
					<?php
						$sql2 = "select * from staff_time_table where day_id='2' and pried_1<>'0' and staff_id='$staff_id' order by id";
                        $result2 = mysqli_query($conn, $sql2);
                        while ($row2 = mysqli_fetch_assoc($result2)) {
                        ?>
						 <td><a class="btn btn-info pu" href="class_time_tabil_1.php?id=<?php echo $row['id']; ?>"  title="<?php echo $row2['subject_1']; ?>"> <?php echo $row2['pried_1']; ?></td>
							   <?php }  ?>
					<?php
						$sql2 = "select * from staff_time_table where day_id='2' and pried_2<>'0' and staff_id='$staff_id' order by id";
                        $result2 = mysqli_query($conn, $sql2);
                        while ($row2 = mysqli_fetch_assoc($result2)) {
                        ?>
						 <td><a class="btn btn-info pu" href="class_time_tabil_1.php?id=<?php echo $row['id']; ?>"  title="<?php echo $row2['subject_2']; ?>"> <?php echo $row2['pried_2']; ?></td>
							   <?php }  ?>
				
                                <?php
						$sql2 = "select * from staff_time_table where day_id='2' and pried_3<>'0' and staff_id='$staff_id' order by id";
                        $result2 = mysqli_query($conn, $sql2);
                        while ($row2 = mysqli_fetch_assoc($result2)) {
                        ?>
						 <td><a class="btn btn-info pu" href="class_time_tabil_1.php?id=<?php echo $row['id']; ?>"  title="<?php echo $row2['subject_3']; ?>"> <?php echo $row2['pried_3']; ?></td>
							   <?php }  ?>
				
                                <?php
						$sql2 = "select * from staff_time_table where day_id='2' and pried_4<>'0' and staff_id='$staff_id' order by id";
                        $result2 = mysqli_query($conn, $sql2);
                        while ($row2 = mysqli_fetch_assoc($result2)) {
                        ?>
						 <td><a class="btn btn-info pu" href="class_time_tabil_1.php?id=<?php echo $row['id']; ?>"  title="<?php echo $row2['subject_4']; ?>"> <?php echo $row2['pried_4']; ?></td>
							   <?php }  ?>				
                                <?php
						$sql2 = "select * from staff_time_table where day_id='2' and pried_5<>'0' and staff_id='$staff_id' order by id";
                        $result2 = mysqli_query($conn, $sql2);
                        while ($row2 = mysqli_fetch_assoc($result2)) {
                        ?>
						 <td><a class="btn btn-info pu" href="class_time_tabil_1.php?id=<?php echo $row['id']; ?>"  title="<?php echo $row2['subject_5']; ?>"> <?php echo $row2['pried_5']; ?></td>
							   <?php }  ?>				
                                <?php
						$sql2 = "select * from staff_time_table where day_id='2' and pried_6<>'0' and staff_id='$staff_id' order by id";
                        $result2 = mysqli_query($conn, $sql2);
                        while ($row2 = mysqli_fetch_assoc($result2)) {
                        ?>
						 <td><a class="btn btn-info pu" href="class_time_tabil_1.php?id=<?php echo $row['id']; ?>"  title="<?php echo $row2['subject_6']; ?>"> <?php echo $row2['pried_6']; ?></td>
							   <?php }  ?>				
                                <?php
						$sql2 = "select * from staff_time_table where day_id='2' and pried_7<>'0' and staff_id='$staff_id' order by id";
                        $result2 = mysqli_query($conn, $sql2);
                        while ($row2 = mysqli_fetch_assoc($result2)) {
                        ?>
						 <td><a class="btn btn-info pu" href="class_time_tabil_1.php?id=<?php echo $row['id']; ?>"  title="<?php echo $row2['subject_7']; ?>"> <?php echo $row2['pried_7']; ?></td>
							   <?php }  ?>				
                                <?php
						$sql2 = "select * from staff_time_table where day_id='2' and pried_8<>'0' and staff_id='$staff_id' order by id";
                        $result2 = mysqli_query($conn, $sql2);
                        while ($row2 = mysqli_fetch_assoc($result2)) {
                        ?>
						 <td><a class="btn btn-info pu" href="class_time_tabil_1.php?id=<?php echo $row['id']; ?>"  title="<?php echo $row2['subject_8']; ?>"> <?php echo $row2['pried_8']; ?></td>
							   <?php }  ?>
                                
							</tr>
							 <tr>
						<?php
						$sql2 = "select a.*,b.day_name from staff_time_table a,days b where a.day_id=b.id and a.day_id='3' and a.staff_id='$staff_id' GROUP BY a.day_id";

						//$sql2 = "select * from staff_time_table where day_id='3' and staff_id='$staff_id' GROUP BY day_id";
                        $result2 = mysqli_query($conn, $sql2);
                        while ($row2 = mysqli_fetch_assoc($result2)) {
                        ?>
                               <td><?php echo $row2['day_name']; ?></td>
							   <?php }  ?>
					<?php
						$sql2 = "select * from staff_time_table where day_id='3' and pried_1<>'0' and staff_id='$staff_id' order by id";
                        $result2 = mysqli_query($conn, $sql2);
                        while ($row2 = mysqli_fetch_assoc($result2)) {
                        ?>
						 <td><a class="btn btn-info pu" href="class_time_tabil_1.php?id=<?php echo $row['id']; ?>"  title="<?php echo $row2['subject_1']; ?>"> <?php echo $row2['pried_1']; ?></td>
							   <?php }  ?>
					<?php
						$sql2 = "select * from staff_time_table where day_id='3' and pried_2<>'0' and staff_id='$staff_id' order by id";
                        $result2 = mysqli_query($conn, $sql2);
                        while ($row2 = mysqli_fetch_assoc($result2)) {
                        ?>
						 <td><a class="btn btn-info pu" href="class_time_tabil_1.php?id=<?php echo $row['id']; ?>"  title="<?php echo $row2['subject_2']; ?>"> <?php echo $row2['pried_2']; ?></td>
							   <?php }  ?>
				
                                <?php
						$sql2 = "select * from staff_time_table where day_id='3' and pried_3<>'0' and staff_id='$staff_id' order by id";
                        $result2 = mysqli_query($conn, $sql2);
                        while ($row2 = mysqli_fetch_assoc($result2)) {
                        ?>
						 <td><a class="btn btn-info pu" href="class_time_tabil_1.php?id=<?php echo $row['id']; ?>"  title="<?php echo $row2['subject_3']; ?>"> <?php echo $row2['pried_3']; ?></td>
							   <?php }  ?>
				
                                <?php
						$sql2 = "select * from staff_time_table where day_id='3' and pried_4<>'0' and staff_id='$staff_id' order by id";
                        $result2 = mysqli_query($conn, $sql2);
                        while ($row2 = mysqli_fetch_assoc($result2)) {
                        ?>
						 <td><a class="btn btn-info pu" href="class_time_tabil_1.php?id=<?php echo $row['id']; ?>"  title="<?php echo $row2['subject_4']; ?>"> <?php echo $row2['pried_4']; ?></td>
							   <?php }  ?>				
                                <?php
						$sql2 = "select * from staff_time_table where day_id='3' and pried_5<>'0' and staff_id='$staff_id' order by id";
                        $result2 = mysqli_query($conn, $sql2);
                        while ($row2 = mysqli_fetch_assoc($result2)) {
                        ?>
						 <td><a class="btn btn-info pu" href="class_time_tabil_1.php?id=<?php echo $row['id']; ?>"  title="<?php echo $row2['subject_5']; ?>"> <?php echo $row2['pried_5']; ?></td>
							   <?php }  ?>				
                                <?php
						$sql2 = "select * from staff_time_table where day_id='3' and pried_6<>'0' and staff_id='$staff_id' order by id";
                        $result2 = mysqli_query($conn, $sql2);
                        while ($row2 = mysqli_fetch_assoc($result2)) {
                        ?>
						 <td><a class="btn btn-info pu" href="class_time_tabil_1.php?id=<?php echo $row['id']; ?>"  title="<?php echo $row2['subject_6']; ?>"> <?php echo $row2['pried_6']; ?></td>
							   <?php }  ?>				
                                <?php
						$sql2 = "select * from staff_time_table where day_id='3' and pried_7<>'0' and staff_id='$staff_id' order by id";
                        $result2 = mysqli_query($conn, $sql2);
                        while ($row2 = mysqli_fetch_assoc($result2)) {
                        ?>
						 <td><a class="btn btn-info pu" href="class_time_tabil_1.php?id=<?php echo $row['id']; ?>"  title="<?php echo $row2['subject_7']; ?>"> <?php echo $row2['pried_7']; ?></td>
							   <?php }  ?>				
                                <?php
						$sql2 = "select * from staff_time_table where day_id='3' and pried_8<>'0' and staff_id='$staff_id' order by id";
                        $result2 = mysqli_query($conn, $sql2);
                        while ($row2 = mysqli_fetch_assoc($result2)) {
                        ?>
						 <td><a class="btn btn-info pu" href="class_time_tabil_1.php?id=<?php echo $row['id']; ?>"  title="<?php echo $row2['subject_8']; ?>"> <?php echo $row2['pried_8']; ?></td>
							   <?php }  ?>
                                
							</tr>
 <tr>
						<?php
						$sql2 = "select a.*,b.day_name from staff_time_table a,days b where a.day_id=b.id and a.day_id='4' and a.staff_id='$staff_id' GROUP BY a.day_id";

                        $result2 = mysqli_query($conn, $sql2);
                        while ($row2 = mysqli_fetch_assoc($result2)) {
                        ?>
                               <td><?php echo $row2['day_name']; ?></td>
							   <?php }  ?>
					<?php
						$sql2 = "select * from staff_time_table where day_id='4' and pried_1<>'0' and staff_id='$staff_id' order by id";
                        $result2 = mysqli_query($conn, $sql2);
                        while ($row2 = mysqli_fetch_assoc($result2)) {
                        ?>
						 <td><a class="btn btn-info pu" href="class_time_tabil_1.php?id=<?php echo $row['id']; ?>"  title="<?php echo $row2['subject_1']; ?>"> <?php echo $row2['pried_1']; ?></td>
							   <?php }  ?>
					<?php
						$sql2 = "select * from staff_time_table where day_id='4' and pried_2<>'0' and staff_id='$staff_id' order by id";
                        $result2 = mysqli_query($conn, $sql2);
                        while ($row2 = mysqli_fetch_assoc($result2)) {
                        ?>
						 <td><a class="btn btn-info pu" href="class_time_tabil_1.php?id=<?php echo $row['id']; ?>"  title="<?php echo $row2['subject_2']; ?>"> <?php echo $row2['pried_2']; ?></td>
							   <?php }  ?>
				
                                <?php
						$sql2 = "select * from staff_time_table where day_id='4' and pried_3<>'0' and staff_id='$staff_id' order by id";
                        $result2 = mysqli_query($conn, $sql2);
                        while ($row2 = mysqli_fetch_assoc($result2)) {
                        ?>
						 <td><a class="btn btn-info pu" href="class_time_tabil_1.php?id=<?php echo $row['id']; ?>"  title="<?php echo $row2['subject_3']; ?>"> <?php echo $row2['pried_3']; ?></td>
							   <?php }  ?>
				
                                <?php
						$sql2 = "select * from staff_time_table where day_id='4' and pried_4<>'0' and staff_id='$staff_id' order by id";
                        $result2 = mysqli_query($conn, $sql2);
                        while ($row2 = mysqli_fetch_assoc($result2)) {
                        ?>
						 <td><a class="btn btn-info pu" href="class_time_tabil_1.php?id=<?php echo $row['id']; ?>"  title="<?php echo $row2['subject_4']; ?>"> <?php echo $row2['pried_4']; ?></td>
							   <?php }  ?>				
                                <?php
						$sql2 = "select * from staff_time_table where day_id='4' and pried_5<>'0' and staff_id='$staff_id' order by id";
                        $result2 = mysqli_query($conn, $sql2);
                        while ($row2 = mysqli_fetch_assoc($result2)) {
                        ?>
						 <td><a class="btn btn-info pu" href="class_time_tabil_1.php?id=<?php echo $row['id']; ?>"  title="<?php echo $row2['subject_5']; ?>"> <?php echo $row2['pried_5']; ?></td>
							   <?php }  ?>				
                                <?php
						$sql2 = "select * from staff_time_table where day_id='4' and pried_6<>'0' and staff_id='$staff_id' order by id";
                        $result2 = mysqli_query($conn, $sql2);
                        while ($row2 = mysqli_fetch_assoc($result2)) {
                        ?>
						 <td><a class="btn btn-info pu" href="class_time_tabil_1.php?id=<?php echo $row['id']; ?>"  title="<?php echo $row2['subject_6']; ?>"> <?php echo $row2['pried_6']; ?></td>
							   <?php }  ?>				
                                <?php
						$sql2 = "select * from staff_time_table where day_id='4' and pried_7<>'0' and staff_id='$staff_id' order by id";
                        $result2 = mysqli_query($conn, $sql2);
                        while ($row2 = mysqli_fetch_assoc($result2)) {
                        ?>
						 <td><a class="btn btn-info pu" href="class_time_tabil_1.php?id=<?php echo $row['id']; ?>"  title="<?php echo $row2['subject_7']; ?>"> <?php echo $row2['pried_7']; ?></td>
							   <?php }  ?>				
                                <?php
						$sql2 = "select * from staff_time_table where day_id='4' and pried_8<>'0' and staff_id='$staff_id' order by id";
                        $result2 = mysqli_query($conn, $sql2);
                        while ($row2 = mysqli_fetch_assoc($result2)) {
                        ?>
						 <td><a class="btn btn-info pu" href="class_time_tabil_1.php?id=<?php echo $row['id']; ?>"  title="<?php echo $row2['subject_8']; ?>"> <?php echo $row2['pried_8']; ?></td>
							   <?php }  ?>
                                
							</tr>
 <tr>
						<?php
						$sql2 = "select a.*,b.day_name from staff_time_table a,days b where a.day_id=b.id and a.day_id='5' and a.staff_id='$staff_id' GROUP BY a.day_id";

                        $result2 = mysqli_query($conn, $sql2);
                        while ($row2 = mysqli_fetch_assoc($result2)) {
                        ?>
                               <td><?php echo $row2['day_name']; ?></td>
							   <?php }  ?>
					<?php
						$sql2 = "select * from staff_time_table where day_id='5' and pried_1<>'0' and staff_id='$staff_id' order by id";
                        $result2 = mysqli_query($conn, $sql2);
                        while ($row2 = mysqli_fetch_assoc($result2)) {
                        ?>
						 <td><a class="btn btn-info pu" href="class_time_tabil_1.php?id=<?php echo $row['id']; ?>"  title="<?php echo $row2['subject_1']; ?>"> <?php echo $row2['pried_1']; ?></td>
							   <?php }  ?>
					<?php
						$sql2 = "select * from staff_time_table where day_id='5' and pried_2<>'0' and staff_id='$staff_id' order by id";
                        $result2 = mysqli_query($conn, $sql2);
                        while ($row2 = mysqli_fetch_assoc($result2)) {
                        ?>
						 <td><a class="btn btn-info pu" href="class_time_tabil_1.php?id=<?php echo $row['id']; ?>"  title="<?php echo $row2['subject_2']; ?>"> <?php echo $row2['pried_2']; ?></td>
							   <?php }  ?>
				
                                <?php
						$sql2 = "select * from staff_time_table where day_id='5' and pried_3<>'0' and staff_id='$staff_id' order by id";
                        $result2 = mysqli_query($conn, $sql2);
                        while ($row2 = mysqli_fetch_assoc($result2)) {
                        ?>
						 <td><a class="btn btn-info pu" href="class_time_tabil_1.php?id=<?php echo $row['id']; ?>"  title="<?php echo $row2['subject_3']; ?>"> <?php echo $row2['pried_3']; ?></td>
							   <?php }  ?>
				
                                <?php
						$sql2 = "select * from staff_time_table where day_id='5' and pried_4<>'0' and staff_id='$staff_id' order by id";
                        $result2 = mysqli_query($conn, $sql2);
                        while ($row2 = mysqli_fetch_assoc($result2)) {
                        ?>
						 <td><a class="btn btn-info pu" href="class_time_tabil_1.php?id=<?php echo $row['id']; ?>"  title="<?php echo $row2['subject_4']; ?>"> <?php echo $row2['pried_4']; ?></td>
							   <?php }  ?>				
                                <?php
						$sql2 = "select * from staff_time_table where day_id='5' and pried_5<>'0' and staff_id='$staff_id' order by id";
                        $result2 = mysqli_query($conn, $sql2);
                        while ($row2 = mysqli_fetch_assoc($result2)) {
                        ?>
						 <td><a class="btn btn-info pu" href="class_time_tabil_1.php?id=<?php echo $row['id']; ?>"  title="<?php echo $row2['subject_5']; ?>"> <?php echo $row2['pried_5']; ?></td>
							   <?php }  ?>				
                                <?php
						$sql2 = "select * from staff_time_table where day_id='5' and pried_6<>'0' and staff_id='$staff_id' order by id";
                        $result2 = mysqli_query($conn, $sql2);
                        while ($row2 = mysqli_fetch_assoc($result2)) {
                        ?>
						 <td><a class="btn btn-info pu" href="class_time_tabil_1.php?id=<?php echo $row['id']; ?>"  title="<?php echo $row2['subject_6']; ?>"> <?php echo $row2['pried_6']; ?></td>
							   <?php }  ?>				
                                <?php
						$sql2 = "select * from staff_time_table where day_id='5' and pried_7<>'0' and staff_id='$staff_id' order by id";
                        $result2 = mysqli_query($conn, $sql2);
                        while ($row2 = mysqli_fetch_assoc($result2)) {
                        ?>
						 <td><a class="btn btn-info pu" href="class_time_tabil_1.php?id=<?php echo $row['id']; ?>"  title="<?php echo $row2['subject_7']; ?>"> <?php echo $row2['pried_7']; ?></td>
							   <?php }  ?>				
                                <?php
						$sql2 = "select * from staff_time_table where day_id='5' and pried_8<>'0' and staff_id='$staff_id' order by id";
                        $result2 = mysqli_query($conn, $sql2);
                        while ($row2 = mysqli_fetch_assoc($result2)) {
                        ?>
						 <td><a class="btn btn-info pu" href="class_time_tabil_1.php?id=<?php echo $row['id']; ?>"  title="<?php echo $row2['subject_8']; ?>"> <?php echo $row2['pried_8']; ?></td>
							   <?php }  ?>
                                
							</tr>
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
                                            <label for="pried_5 required"
                                                   class="control-label required">Pried 1</label>
                                            <select name="pried_5" class="form-control" required="required" >
                                                <option value="">-----Select------</option>
													<option value="Leisure Time">Leisure Time</option>

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
                                            <label for="subject_5 required"
                                                   class="control-label required">Subject</label>
                                            <select name="subject_5" class="form-control" required="required" >
                                                <option value="">-----Select------</option>
													<option value="Leisure Time">Leisure Time</option>
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
