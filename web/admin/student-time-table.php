<?php
session_start();
$page = "Students";
$page1 = "Student Time Table";
include "timeout.php";
include "config.php";
$msg = "";
$msg_color = "";
$user_id_id=$_SESSION['user_id'];
$class_id=$_GET['id'];

$msg = "";
$msg_color = "";
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Student Time Table</title>
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
             <center> <h3 class="box-title">View Fees Detail</h3> </center>
            </div>

                         <table id="" class="table table-bordered table-striped">
                    <thead>
                         <tr style="background-color: #81888c;color:white">
                            <th>Days</th>
                            <th>Pried 1</th>
                            <th>Pried 2</th>
                            <th>Pried 3</th>
                            <th>Pried 4</th>
                            <th>Pried 5</th>
                            <th>Pried 6</th>
                            <th>Pried 7</th>
                            <th>Pried 8</th>
                                        </tr>
                                    </thead>
                                       <tbody>
<style>
 .pu{
width: 105px;
}
    </style>
						<!--<?php
						$sql = "select a.*,b.day_name,c.full_name from staff_time_table a,days b,users c where a.day_id=b.id and a.staff_id=c.id and a.class_id='$class_id'  order by id";
                        $result = mysqli_query($conn, $sql);
                        while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                            <tr>
                                <td><?php echo $row['day_name']; ?></td>
                                <td><a class="btn btn-info pu" href="add_time_tabil.php?id=<?php echo $row['pried_1']; ?>"  title="<?php echo $row['full_name']; ?> "> <?php echo $row['pried_1']; ?></td>
                                <td><a class="btn btn-info pu" href="add_time_tabil.php?id=<?php echo $row['pried_1']; ?>"  title="<?php echo $row['full_name']; ?>"> <?php echo $row['pried_2']; ?></td>
								<td><a class="btn btn-info pu" href="add_time_tabil.php?id=<?php echo $row['pried_1']; ?>"  title="<?php echo $row['full_name']; ?>"> <?php echo $row['pried_3']; ?></td>
								<td><a class="btn btn-info pu" href="add_time_tabil.php?id=<?php echo $row['pried_1']; ?>"  title="<?php echo $row['full_name']; ?>"> <?php echo $row['pried_4']; ?></td>
								<td><a class="btn btn-info pu" href="add_time_tabil.php?id=<?php echo $row['pried_1']; ?>"  title="<?php echo $row['full_name']; ?>"> <?php echo $row['pried_5']; ?></td>
								<td><a class="btn btn-info pu" href="add_time_tabil.php?id=<?php echo $row['pried_1']; ?>"  title="<?php echo $row['full_name']; ?> "> <?php echo $row['pried_6']; ?></td>
								<td><a class="btn btn-info pu" href="add_time_tabil.php?id=<?php echo $row['pried_1']; ?>"  title="<?php echo $row['full_name']; ?>"> <?php echo $row['pried_7']; ?></td>
								<td><a class="btn btn-info pu" href="add_time_tabil.php?id=<?php echo $row['pried_1']; ?>"  title="<?php echo $row['full_name']; ?> "> <?php echo $row['pried_8']; ?></td>
								
							</tr>
						 <?php }  ?>-->
						 
						 
						 
						 
						 
						  <tr>
							    <td>
						<?php
						$sql2 = "select a.*,b.day_name from staff_time_table a,days b where a.day_id=b.id and a.day_id='2' and a.class_id='$class_id' GROUP BY a.day_id";
                        $result2 = mysqli_query($conn, $sql2);
                        while ($row2 = mysqli_fetch_assoc($result2)) {
                        ?>
                              <?php echo $row2['day_name']; ?>
							   <?php }  ?>
							    </td>
							    <td>
					<?php
						$sql2 = "select a.*,b.full_name from staff_time_table a,users b where a.staff_id=b.id and a.day_id='2' and a.pried_1 <>'0' and a.class_id='$class_id'  order by id";

						//$sql2 = "select * from staff_time_table where day_id='2' and pried_1<>'0' and class_id='$class_id' order by id";
                        $result2 = mysqli_query($conn, $sql2);
                        while ($row2 = mysqli_fetch_assoc($result2)) {
                        ?>
						<a class="btn btn-info pu" href="class_time_tabil_1.php?id=<?php echo $row['id']; ?>"  title="<?php echo $row2['full_name']; ?>"> <?php echo $row2['subject_1']; ?>
							   <?php }  ?>
							    </td>
							    <td>
					<?php
						$sql2 = "select a.*,b.full_name from staff_time_table a,users b where a.staff_id=b.id and a.day_id='2' and a.pried_2 <>'0' and a.class_id='$class_id'  order by id";
                        $result2 = mysqli_query($conn, $sql2);
                        while ($row2 = mysqli_fetch_assoc($result2)) {
                        ?>
						 <a class="btn btn-info pu" href="class_time_tabil_1.php?id=<?php echo $row['id']; ?>"  title="<?php echo $row2['full_name']; ?>"> <?php echo $row2['subject_2']; ?>
							   <?php }  ?>
				 </td>
							    <td>
                                <?php
						$sql2 = "select a.*,b.full_name from staff_time_table a,users b where a.staff_id=b.id and a.day_id='2' and a.pried_3 <>'0' and a.class_id='$class_id'  order by id";
                        $result2 = mysqli_query($conn, $sql2);
                        while ($row2 = mysqli_fetch_assoc($result2)) {
                        ?>
						 <a class="btn btn-info pu" href="class_time_tabil_1.php?id=<?php echo $row['id']; ?>"  title="<?php echo $row2['full_name']; ?>"> <?php echo $row2['subject_3']; ?>
							   <?php }  ?>
				 </td>
							    <td>
                                <?php
						$sql2 = "select a.*,b.full_name from staff_time_table a,users b where a.staff_id=b.id and a.day_id='2' and a.pried_4 <>'0' and a.class_id='$class_id'  order by id";
                        $result2 = mysqli_query($conn, $sql2);
                        while ($row2 = mysqli_fetch_assoc($result2)) {
                        ?>
						 <a class="btn btn-info pu" href="class_time_tabil_1.php?id=<?php echo $row['id']; ?>"  title="<?php echo $row2['full_name']; ?>"> <?php echo $row2['subject_4']; ?>
							   <?php }  ?>	
 </td>
							    <td>							   
                                <?php
						$sql2 = "select a.*,b.full_name from staff_time_table a,users b where a.staff_id=b.id and a.day_id='2' and a.pried_5 <>'0' and a.class_id='$class_id'  order by id";
                        $result2 = mysqli_query($conn, $sql2);
                        while ($row2 = mysqli_fetch_assoc($result2)) {
                        ?>
						 <a class="btn btn-info pu" href="class_time_tabil_1.php?id=<?php echo $row['id']; ?>"  title="<?php echo $row2['full_name']; ?>"> <?php echo $row2['subject_5']; ?>
							   <?php }  ?>	
 </td>
							    <td>							   
                                <?php
						$sql2 = "select a.*,b.full_name from staff_time_table a,users b where a.staff_id=b.id and a.day_id='2' and a.pried_6 <>'0' and a.class_id='$class_id'  order by id";
                        $result2 = mysqli_query($conn, $sql2);
                        while ($row2 = mysqli_fetch_assoc($result2)) {
                        ?>
						<a class="btn btn-info pu" href="class_time_tabil_1.php?id=<?php echo $row['id']; ?>"  title="<?php echo $row2['full_name']; ?>"> <?php echo $row2['subject_6']; ?>
							   <?php }  ?>	
 </td>
							    <td>							   
                                <?php
						$sql2 = "select a.*,b.full_name from staff_time_table a,users b where a.staff_id=b.id and a.day_id='2' and a.pried_7 <>'0' and a.class_id='$class_id'  order by id";
                        $result2 = mysqli_query($conn, $sql2);
                        while ($row2 = mysqli_fetch_assoc($result2)) {
                        ?>
						 <a class="btn btn-info pu" href="class_time_tabil_1.php?id=<?php echo $row['id']; ?>"  title="<?php echo $row2['full_name']; ?>"> <?php echo $row2['subject_7']; ?>
							   <?php }  ?>		
 </td>
<td>							   
                                <?php
						$sql2 = "select a.*,b.full_name from staff_time_table a,users b where a.staff_id=b.id and a.day_id='2' and a.pried_8 <>'0' and a.class_id='$class_id'  order by id";
                        $result2 = mysqli_query($conn, $sql2);
                        while ($row2 = mysqli_fetch_assoc($result2)) {
                        ?>
						 <a class="btn btn-info pu" href="class_time_tabil_1.php?id=<?php echo $row['id']; ?>"  title="<?php echo $row2['full_name']; ?>"> <?php echo $row2['subject_8']; ?>
							   <?php }  ?>
							  </td>
							</tr>
							 <tr>
							 <td>	
							 <?php
						$sql2 = "select a.*,b.day_name from staff_time_table a,days b where a.day_id=b.id and a.day_id='3' and a.class_id='$class_id' GROUP BY a.day_id";
                        $result2 = mysqli_query($conn, $sql2);
                        while ($row2 = mysqli_fetch_assoc($result2)) {
                        ?>
                               <?php echo $row2['day_name']; ?>
							   <?php }  ?>
							    </td>
                                 <td>	
					<?php
						$sql2 = "select a.*,b.full_name from staff_time_table a,users b where a.staff_id=b.id and a.day_id='3' and a.pried_1 <>'0' and a.class_id='$class_id'  order by id";
                        $result2 = mysqli_query($conn, $sql2);
                        while ($row2 = mysqli_fetch_assoc($result2)) {
                        ?>
						 <a class="btn btn-info pu" href="class_time_tabil_1.php?id=<?php echo $row['id']; ?>"  title="<?php echo $row2['full_name']; ?>"> <?php echo $row2['subject_1']; ?>
							   <?php }  ?>
							    </td>
                                 <td>	
								 <?php
						$sql2 = "select a.*,b.full_name from staff_time_table a,users b where a.staff_id=b.id and a.day_id='3' and a.pried_2 <>'0' and a.class_id='$class_id'  order by id";
                        $result2 = mysqli_query($conn, $sql2);
                        while ($row2 = mysqli_fetch_assoc($result2)) {
                        ?>
						 <a class="btn btn-info pu" href="class_time_tabil_1.php?id=<?php echo $row['id']; ?>"  title="<?php echo $row2['full_name']; ?>"> <?php echo $row2['subject_2']; ?>
							   <?php }  ?>
							    </td>
                                 <td>	
                                <?php
						$sql2 = "select a.*,b.full_name from staff_time_table a,users b where a.staff_id=b.id and a.day_id='3' and a.pried_3 <>'0' and a.class_id='$class_id'  order by id";
                        $result2 = mysqli_query($conn, $sql2);
                        while ($row2 = mysqli_fetch_assoc($result2)) {
                        ?>
						 <a class="btn btn-info pu" href="class_time_tabil_1.php?id=<?php echo $row['id']; ?>"  title="<?php echo $row2['full_name']; ?>"> <?php echo $row2['subject_3']; ?>
							   <?php }  ?>
							    </td>
                                 <td>	
                                <?php
						$sql2 = "select a.*,b.full_name from staff_time_table a,users b where a.staff_id=b.id and a.day_id='3' and a.pried_4 <>'0' and a.class_id='$class_id'  order by id";
                        $result2 = mysqli_query($conn, $sql2);
                        while ($row2 = mysqli_fetch_assoc($result2)) {
                        ?>
						 <a class="btn btn-info pu" href="class_time_tabil_1.php?id=<?php echo $row['id']; ?>"  title="<?php echo $row2['full_name']; ?>"> <?php echo $row2['subject_4']; ?>
							   <?php }  ?>	
							    </td>
                                 <td>	
                                <?php
						$sql2 = "select a.*,b.full_name from staff_time_table a,users b where a.staff_id=b.id and a.day_id='3' and a.pried_5 <>'0' and a.class_id='$class_id'  order by id";
                        $result2 = mysqli_query($conn, $sql2);
                        while ($row2 = mysqli_fetch_assoc($result2)) {
                        ?>
						 <a class="btn btn-info pu" href="class_time_tabil_1.php?id=<?php echo $row['id']; ?>"  title="<?php echo $row2['full_name']; ?>"> <?php echo $row2['subject_5']; ?>
							   <?php }  ?>	
							    </td>
                                 <td>	
                                <?php
						$sql2 = "select a.*,b.full_name from staff_time_table a,users b where a.staff_id=b.id and a.day_id='3' and a.pried_6 <>'0' and a.class_id='$class_id'  order by id";
                        $result2 = mysqli_query($conn, $sql2);
                        while ($row2 = mysqli_fetch_assoc($result2)) {
                        ?>
						 <a class="btn btn-info pu" href="class_time_tabil_1.php?id=<?php echo $row['id']; ?>"  title="<?php echo $row2['full_name']; ?>"> <?php echo $row2['subject_6']; ?>
							   <?php }  ?>		
							    </td>
                                 <td>	
                                <?php
						$sql2 = "select a.*,b.full_name from staff_time_table a,users b where a.staff_id=b.id and a.day_id='3' and a.pried_7 <>'0' and a.class_id='$class_id'  order by id";
                        $result2 = mysqli_query($conn, $sql2);
                        while ($row2 = mysqli_fetch_assoc($result2)) {
                        ?>
						 <a class="btn btn-info pu" href="class_time_tabil_1.php?id=<?php echo $row['id']; ?>"  title="<?php echo $row2['full_name']; ?>"> <?php echo $row2['subject_7']; ?>
							   <?php }  ?>	
							    </td>
                                 <td>	
								 <?php
						$sql2 = "select a.*,b.full_name from staff_time_table a,users b where a.staff_id=b.id and a.day_id='3' and a.pried_8 <>'0' and a.class_id='$class_id'  order by id";
                        $result2 = mysqli_query($conn, $sql2);
                        while ($row2 = mysqli_fetch_assoc($result2)) {
                        ?>
						 <a class="btn btn-info pu" href="class_time_tabil_1.php?id=<?php echo $row['id']; ?>"  title="<?php echo $row2['full_name']; ?>"> <?php echo $row2['subject_8']; ?>
							   <?php }  ?>
							 </td>
                                
</tr>
 <tr>
                                 <td>	
						<?php
						$sql2 = "select a.*,b.day_name from staff_time_table a,days b where a.day_id=b.id and a.day_id='4' and a.class_id='$class_id' GROUP BY a.day_id";

                        $result2 = mysqli_query($conn, $sql2);
                        while ($row2 = mysqli_fetch_assoc($result2)) {
                        ?>
                               <?php echo $row2['day_name']; ?>
							   <?php }  ?>
							    </td>
                                 <td>	
								 <?php
						$sql2 = "select a.*,b.full_name from staff_time_table a,users b where a.staff_id=b.id and a.day_id='4' and a.pried_1 <>'0' and a.class_id='$class_id'  order by id";
                        $result2 = mysqli_query($conn, $sql2);
                        while ($row2 = mysqli_fetch_assoc($result2)) {
                        ?>
						 <a class="btn btn-info pu" href="class_time_tabil_1.php?id=<?php echo $row['id']; ?>"  title="<?php echo $row2['full_name']; ?>"> <?php echo $row2['subject_1']; ?>
							   <?php }  ?>
							    </td>
                                 <td>	
								 <?php
						$sql2 = "select a.*,b.full_name from staff_time_table a,users b where a.staff_id=b.id and a.day_id='4' and a.pried_2 <>'0' and a.class_id='$class_id'  order by id";
                        $result2 = mysqli_query($conn, $sql2);
                        while ($row2 = mysqli_fetch_assoc($result2)) {
                        ?>
						 <a class="btn btn-info pu" href="class_time_tabil_1.php?id=<?php echo $row['id']; ?>"  title="<?php echo $row2['full_name']; ?>"> <?php echo $row2['subject_2']; ?>
							   <?php }  ?>
							    </td>
                                 <td>	
                                <?php
						$sql2 = "select a.*,b.full_name from staff_time_table a,users b where a.staff_id=b.id and a.day_id='4' and a.pried_3 <>'0' and a.class_id='$class_id'  order by id";
                        $result2 = mysqli_query($conn, $sql2);
                        while ($row2 = mysqli_fetch_assoc($result2)) {
                        ?>
						 <a class="btn btn-info pu" href="class_time_tabil_1.php?id=<?php echo $row['id']; ?>"  title="<?php echo $row2['full_name']; ?>"> <?php echo $row2['subject_3']; ?>
							   <?php }  ?>
							    </td>
                                 <td>	
                                <?php
						$sql2 = "select a.*,b.full_name from staff_time_table a,users b where a.staff_id=b.id and a.day_id='4' and a.pried_4 <>'0' and a.class_id='$class_id'  order by id";
                        $result2 = mysqli_query($conn, $sql2);
                        while ($row2 = mysqli_fetch_assoc($result2)) {
                        ?>
						 <a class="btn btn-info pu" href="class_time_tabil_1.php?id=<?php echo $row['id']; ?>"  title="<?php echo $row2['full_name']; ?>"> <?php echo $row2['subject_4']; ?>
							   <?php }  ?>
							    </td>
                                 <td>	
                                <?php
						$sql2 = "select a.*,b.full_name from staff_time_table a,users b where a.staff_id=b.id and a.day_id='4' and a.pried_5 <>'0' and a.class_id='$class_id'  order by id";
                        $result2 = mysqli_query($conn, $sql2);
                        while ($row2 = mysqli_fetch_assoc($result2)) {
                        ?>
						 <a class="btn btn-info pu" href="class_time_tabil_1.php?id=<?php echo $row['id']; ?>"  title="<?php echo $row2['full_name']; ?>"> <?php echo $row2['subject_5']; ?>
							   <?php }  ?>	
							    </td>
                                 <td>	
                                <?php
						$sql2 = "select a.*,b.full_name from staff_time_table a,users b where a.staff_id=b.id and a.day_id='4' and a.pried_6 <>'0' and a.class_id='$class_id'  order by id";
                        $result2 = mysqli_query($conn, $sql2);
                        while ($row2 = mysqli_fetch_assoc($result2)) {
                        ?>
						 <a class="btn btn-info pu" href="class_time_tabil_1.php?id=<?php echo $row['id']; ?>"  title="<?php echo $row2['full_name']; ?>"> <?php echo $row2['subject_6']; ?>
							   <?php }  ?>	
							    </td>
                                 <td>	
								 <?php
						$sql2 = "select a.*,b.full_name from staff_time_table a,users b where a.staff_id=b.id and a.day_id='4' and a.pried_7 <>'0' and a.class_id='$class_id'  order by id";
                        $result2 = mysqli_query($conn, $sql2);
                        while ($row2 = mysqli_fetch_assoc($result2)) {
                        ?>
						 <a class="btn btn-info pu" href="class_time_tabil_1.php?id=<?php echo $row['id']; ?>"  title="<?php echo $row2['full_name']; ?>"> <?php echo $row2['subject_7']; ?>
							   <?php }  ?>	
							    </td>
                                 <td>	
                                <?php
						$sql2 = "select a.*,b.full_name from staff_time_table a,users b where a.staff_id=b.id and a.day_id='4' and a.pried_8 <>'0' and a.class_id='$class_id'  order by id";
                        $result2 = mysqli_query($conn, $sql2);
                        while ($row2 = mysqli_fetch_assoc($result2)) {
                        ?>
						 <a class="btn btn-info pu" href="class_time_tabil_1.php?id=<?php echo $row['id']; ?>"  title="<?php echo $row2['full_name']; ?>"> <?php echo $row2['subject_8']; ?>
							   <?php }  ?>
							    </td>
							</tr>
 <tr>
                                 <td>	
						<?php
						$sql2 = "select a.*,b.day_name from staff_time_table a,days b where a.day_id=b.id and a.day_id='5' and a.class_id='$class_id' GROUP BY a.day_id";

						//$sql2 = "select * from staff_time_table where day_id='3' and class_id='$class_id' GROUP BY day_id";
                        $result2 = mysqli_query($conn, $sql2);
                        while ($row2 = mysqli_fetch_assoc($result2)) {
                        ?>
                               <?php echo $row2['day_name']; ?>
							   <?php }  ?>
							    </td>
                                 <td>	
					<?php
						$sql2 = "select a.*,b.full_name from staff_time_table a,users b where a.staff_id=b.id and a.day_id='5' and a.pried_1 <>'0' and a.class_id='$class_id'  order by id";
                        $result2 = mysqli_query($conn, $sql2);
                        while ($row2 = mysqli_fetch_assoc($result2)) {
                        ?>
						 <a class="btn btn-info pu" href="class_time_tabil_1.php?id=<?php echo $row['id']; ?>"  title="<?php echo $row2['full_name']; ?>"> <?php echo $row2['subject_1']; ?>
							   <?php }  ?>
							    </td>
                                 <td>	
								 <?php
						$sql2 = "select a.*,b.full_name from staff_time_table a,users b where a.staff_id=b.id and a.day_id='5' and a.pried_2 <>'0' and a.class_id='$class_id'  order by id";
                        $result2 = mysqli_query($conn, $sql2);
                        while ($row2 = mysqli_fetch_assoc($result2)) {
                        ?>
						 <a class="btn btn-info pu" href="class_time_tabil_1.php?id=<?php echo $row['id']; ?>"  title="<?php echo $row2['full_name']; ?>"> <?php echo $row2['subject_2']; ?>
							   <?php }  ?>
							    </td>
                                 <td>	
                                <?php
						$sql2 = "select a.*,b.full_name from staff_time_table a,users b where a.staff_id=b.id and a.day_id='5' and a.pried_3 <>'0' and a.class_id='$class_id'  order by id";
                        $result2 = mysqli_query($conn, $sql2);
                        while ($row2 = mysqli_fetch_assoc($result2)) {
                        ?>
						 <a class="btn btn-info pu" href="class_time_tabil_1.php?id=<?php echo $row['id']; ?>"  title="<?php echo $row2['full_name']; ?>"> <?php echo $row2['subject_3']; ?>
							   <?php }  ?>
							    </td>
                                 <td>	
                                <?php
						$sql2 = "select a.*,b.full_name from staff_time_table a,users b where a.staff_id=b.id and a.day_id='5' and a.pried_4 <>'0' and a.class_id='$class_id'  order by id";
                        $result2 = mysqli_query($conn, $sql2);
                        while ($row2 = mysqli_fetch_assoc($result2)) {
                        ?>
						 <a class="btn btn-info pu" href="class_time_tabil_1.php?id=<?php echo $row['id']; ?>"  title="<?php echo $row2['full_name']; ?>"> <?php echo $row2['subject_4']; ?>
							   <?php }  ?>	
							    </td>
                                 <td>	
                                <?php
						$sql2 = "select a.*,b.full_name from staff_time_table a,users b where a.staff_id=b.id and a.day_id='5' and a.pried_5 <>'0' and a.class_id='$class_id'  order by id";
                        $result2 = mysqli_query($conn, $sql2);
                        while ($row2 = mysqli_fetch_assoc($result2)) {
                        ?>
						 <a class="btn btn-info pu" href="class_time_tabil_1.php?id=<?php echo $row['id']; ?>"  title="<?php echo $row2['full_name']; ?>"> <?php echo $row2['subject_5']; ?>
							   <?php }  ?>	
							    </td>
                                 <td>	
								 <?php
						$sql2 = "select a.*,b.full_name from staff_time_table a,users b where a.staff_id=b.id and a.day_id='5' and a.pried_6 <>'0' and a.class_id='$class_id'  order by id";
                        $result2 = mysqli_query($conn, $sql2);
                        while ($row2 = mysqli_fetch_assoc($result2)) {
                        ?>
						 <a class="btn btn-info pu" href="class_time_tabil_1.php?id=<?php echo $row['id']; ?>"  title="<?php echo $row2['full_name']; ?>"> <?php echo $row2['subject_6']; ?>
							   <?php }  ?>	
							    </td>
                                 <td>	
                                <?php
						$sql2 = "select a.*,b.full_name from staff_time_table a,users b where a.staff_id=b.id and a.day_id='5' and a.pried_7 <>'0' and a.class_id='$class_id'  order by id";
                        $result2 = mysqli_query($conn, $sql2);
                        while ($row2 = mysqli_fetch_assoc($result2)) {
                        ?>
						 <a class="btn btn-info pu" href="class_time_tabil_1.php?id=<?php echo $row['id']; ?>"  title="<?php echo $row2['full_name']; ?>"> <?php echo $row2['subject_7']; ?>
							   <?php }  ?>	
							    </td>
                                 <td>	
								 <?php
						$sql2 = "select a.*,b.full_name from staff_time_table a,users b where a.staff_id=b.id and a.day_id='5' and a.pried_8 <>'0' and a.class_id='$class_id'  order by id";
                        $result2 = mysqli_query($conn, $sql2);
                        while ($row2 = mysqli_fetch_assoc($result2)) {
                        ?>
						 <a class="btn btn-info pu" href="class_time_tabil_1.php?id=<?php echo $row['id']; ?>"  title="<?php echo $row2['full_name']; ?>"> <?php echo $row2['subject_8']; ?>
							   <?php }  ?>
							     </td>
							</tr>
							 <tr>
							 <td>	
							 	<?php
						$sql2 = "select a.*,b.day_name from staff_time_table a,days b where a.day_id=b.id and a.day_id='6' and a.class_id='$class_id' GROUP BY a.day_id";

                        $result2 = mysqli_query($conn, $sql2);
                        while ($row2 = mysqli_fetch_assoc($result2)) {
                        ?>
                               <?php echo $row2['day_name']; ?>
							   <?php }  ?>
							    </td>
                                 <td>	
					<?php
						$sql2 = "select a.*,b.full_name from staff_time_table a,users b where a.staff_id=b.id and a.day_id='6' and a.pried_1 <>'0' and a.class_id='$class_id'  order by id";
                        $result2 = mysqli_query($conn, $sql2);
                        while ($row2 = mysqli_fetch_assoc($result2)) {
                        ?>
						 <a class="btn btn-info pu" href="class_time_tabil_1.php?id=<?php echo $row['id']; ?>"  title="<?php echo $row2['full_name']; ?>"> <?php echo $row2['subject_1']; ?>
							   <?php }  ?>
							    </td>
                                 <td>	
								 <?php
						$sql2 = "select a.*,b.full_name from staff_time_table a,users b where a.staff_id=b.id and a.day_id='6' and a.pried_2 <>'0' and a.class_id='$class_id'  order by id";
                        $result2 = mysqli_query($conn, $sql2);
                        while ($row2 = mysqli_fetch_assoc($result2)) {
                        ?>
						 <a class="btn btn-info pu" href="class_time_tabil_1.php?id=<?php echo $row['id']; ?>"  title="<?php echo $row2['full_name']; ?>"> <?php echo $row2['subject_2']; ?>
							   <?php }  ?>
							    </td>
                                 <td>	
                                <?php
						$sql2 = "select a.*,b.full_name from staff_time_table a,users b where a.staff_id=b.id and a.day_id='6' and a.pried_3 <>'0' and a.class_id='$class_id'  order by id";
                        $result2 = mysqli_query($conn, $sql2);
                        while ($row2 = mysqli_fetch_assoc($result2)) {
                        ?>
						 <a class="btn btn-info pu" href="class_time_tabil_1.php?id=<?php echo $row['id']; ?>"  title="<?php echo $row2['full_name']; ?>"> <?php echo $row2['subject_3']; ?>
							   <?php }  ?>
							    </td>
                                 <td>	
                                <?php
						$sql2 = "select a.*,b.full_name from staff_time_table a,users b where a.staff_id=b.id and a.day_id='6' and a.pried_4 <>'0' and a.class_id='$class_id'  order by id";
                        $result2 = mysqli_query($conn, $sql2);
                        while ($row2 = mysqli_fetch_assoc($result2)) {
                        ?>
						 <a class="btn btn-info pu" href="class_time_tabil_1.php?id=<?php echo $row['id']; ?>"  title="<?php echo $row2['full_name']; ?>"> <?php echo $row2['subject_4']; ?>
							   <?php }  ?>	
							    </td>
                                 <td>	
                                <?php
						$sql2 = "select a.*,b.full_name from staff_time_table a,users b where a.staff_id=b.id and a.day_id='6' and a.pried_5 <>'0' and a.class_id='$class_id'  order by id";
                        $result2 = mysqli_query($conn, $sql2);
                        while ($row2 = mysqli_fetch_assoc($result2)) {
                        ?>
						 <a class="btn btn-info pu" href="class_time_tabil_1.php?id=<?php echo $row['id']; ?>"  title="<?php echo $row2['full_name']; ?>"> <?php echo $row2['subject_5']; ?>
							   <?php }  ?>	
							    </td>
                                 <td>	
								 <?php
						$sql2 = "select a.*,b.full_name from staff_time_table a,users b where a.staff_id=b.id and a.day_id='6' and a.pried_6 <>'0' and a.class_id='$class_id'  order by id";
                        $result2 = mysqli_query($conn, $sql2);
                        while ($row2 = mysqli_fetch_assoc($result2)) {
                        ?>
						 <a class="btn btn-info pu" href="class_time_tabil_1.php?id=<?php echo $row['id']; ?>"  title="<?php echo $row2['full_name']; ?>"> <?php echo $row2['subject_6']; ?>
							   <?php }  ?>	
							    </td>
                                 <td>	
                                <?php
						$sql2 = "select a.*,b.full_name from staff_time_table a,users b where a.staff_id=b.id and a.day_id='6' and a.pried_7 <>'0' and a.class_id='$class_id'  order by id";
                        $result2 = mysqli_query($conn, $sql2);
                        while ($row2 = mysqli_fetch_assoc($result2)) {
                        ?>
						 <a class="btn btn-info pu" href="class_time_tabil_1.php?id=<?php echo $row['id']; ?>"  title="<?php echo $row2['full_name']; ?>"> <?php echo $row2['subject_7']; ?>
							   <?php }  ?>	
							    </td>
                                 <td>	
								 <?php
						$sql2 = "select a.*,b.full_name from staff_time_table a,users b where a.staff_id=b.id and a.day_id='6' and a.pried_8 <>'0' and a.class_id='$class_id'  order by id";
                        $result2 = mysqli_query($conn, $sql2);
                        while ($row2 = mysqli_fetch_assoc($result2)) {
                        ?>
						 <a class="btn btn-info pu" href="class_time_tabil_1.php?id=<?php echo $row['id']; ?>"  title="<?php echo $row2['full_name']; ?>"> <?php echo $row2['subject_8']; ?>
							   <?php }  ?>
                                 </td>
							</tr>
						
                        </tbody>
                                        </tbody>
									</table>
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
