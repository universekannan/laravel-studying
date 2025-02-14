<?php
session_start();
$page = "Dashboard";
$page1 = "Dashboard1";
include "timeout.php";
include "config.php";
if (($_SESSION['user_type'] != "admin") && ($_SESSION['user_type'] != "principal") && ($_SESSION['user_type'] != "staff") && ($_SESSION['user_type'] != "student") && ($_SESSION['user_type'] != "library") && ($_SESSION['user_type'] != "transport")) header("location: index.php");
$msg = "";
$msg_color = "";
    $staff_id = $_SESSION['user_id'];

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
      <!-- Small boxes (Stat box) -->
      <div class="row">

        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
            <?php
    $notification_count=0;
  	if($_SESSION['user_type']=="admin"){ 
    $notification_sql = "select * from principal_record";
	
	
  	}else 
	  {
      $user_id=$_SESSION['user_id'];
      $notification_sql = "select * from principal_record";
	
	  }
      $notification_result = mysqli_query($conn, $notification_sql);
        while ($notification_row = mysqli_fetch_assoc($notification_result)) {
      
            $notification_count++;
        }
    
	?>
             

              <h4>No Of Principal</h4>
              <h3><?php echo $notification_count; ?></h3>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">

            <?php
    $notification_count=0;
  	if($_SESSION['user_type']=="admin"){ 
    $notification_sql = "select * from staff_record";
	
	
  	}else 
	  {
      $user_id=$_SESSION['user_id'];
      $notification_sql = "select * from staff_record";
	
	  }
      $notification_result = mysqli_query($conn, $notification_sql);
        while ($notification_row = mysqli_fetch_assoc($notification_result)) {
      
            $notification_count++;
        }
    
	?>
             

              <h4>Total No OF Staff</h4>
              <h3><?php echo $notification_count; ?></h3>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="#" class="small-box-footer">More info<i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
            <?php
    $notification_count=0;
  	if($_SESSION['user_type']=="admin"){ 
    $notification_sql = "select * from student_record";
	
	
  	}else 
	  {
      $user_id=$_SESSION['user_id'];
      $notification_sql = "select * from student_record";
	
	  }
      $notification_result = mysqli_query($conn, $notification_sql);
        while ($notification_row = mysqli_fetch_assoc($notification_result)) {
      
            $notification_count++;
        }
    
	?>
                <h4>No OF Students</h4>

              <h3><?php echo $notification_count; ?></h3>

            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
            <?php
            $notification_count=0;
            if($_SESSION['user_type']=="admin"){ 
            $notification_sql = "select * from transport";
          
          
            }else 
            {
              $user_id=$_SESSION['user_id'];
              $notification_sql = "select * from transport";
          
            }
              $notification_result = mysqli_query($conn, $notification_sql);
                while ($notification_row = mysqli_fetch_assoc($notification_result)) {
              
                    $notification_count++;
                }
            
          ?>
                        <h4>No OF Transport</h4>
        
                      <h3><?php echo $notification_count; ?></h3>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>

      <div class="row">
        <!-- Left col -->

				

        <!-- right col -->
      </div>
      </div>
      <!-- /.row (main row) -->


      <div class="row">               
			 <div class="col-xs-12">
				
		                   <div class="login-panel panel panel-default">

						<div class="table-responsive">


                         <table id="" class="table table-bordered table-striped">
                    <thead>
                         <tr style="background-color: #81888c;color:white">
                            <th>Days</th> 

                            <th><a class="btn btn-info pu" href="class_time_tabil_1.php?id=<?php echo $_SESSION['user_id']; ?>">Pried 1</a></th>
                            <th><a class="btn btn-info pu" href="class_time_tabil_2.php?id=<?php echo $_SESSION['user_id']; ?>">Pried 2</a></th>
                            <th><a class="btn btn-info pu" href="class_time_tabil_3.php?id=<?php echo $_SESSION['user_id']; ?>">Pried 3</a></th>
                            <th><a class="btn btn-info pu" href="class_time_tabil_4.php?id=<?php echo $_SESSION['user_id']; ?>">Pried 4</a></th>
                            <th><a class="btn btn-info pu" href="class_time_tabil_5.php?id=<?php echo $_SESSION['user_id']; ?>">Pried 5</a></th>
                            <th><a class="btn btn-info pu" href="class_time_tabil_6.php?id=<?php echo $_SESSION['user_id']; ?>">Pried 6</a></th>
                            <th><a class="btn btn-info pu" href="class_time_tabil_7.php?id=<?php echo $_SESSION['user_id']; ?>">Pried 7</a></th>
                            <th><a class="btn btn-info pu" href="class_time_tabil_8.php?id=<?php echo $_SESSION['user_id']; ?>">Pried 8</a></th>
                           
                                        </tr>
                                    </thead>
                                       <tbody>
<style>
 .pu{
width: 105px;
}
    </style>
		
                            <tr>
							    <td>
						<?php
						$sql2 = "select a.*,b.day_name from staff_time_table a,days b where a.day_id=b.id and a.day_id='2' and a.staff_id='$staff_id' GROUP BY a.day_id";
                        $result2 = mysqli_query($conn, $sql2);
                        while ($row2 = mysqli_fetch_assoc($result2)) {
                        ?>
                              <?php echo $row2['day_name']; ?>
							   <?php }  ?>
							    </td>
							    <td>
					<?php
						$sql2 = "select * from staff_time_table where day_id='2' and pried_1<>'0' and staff_id='$staff_id' order by id";
                        $result2 = mysqli_query($conn, $sql2);
                        while ($row2 = mysqli_fetch_assoc($result2)) {
                        ?>
						<a class="btn btn-info pu" href="class_time_tabil_1.php?id=<?php echo $row['id']; ?>"  title="<?php echo $row2['subject_1']; ?>"> <?php echo $row2['pried_1']; ?>
							   <?php }  ?>
							    </td>
							    <td>
					<?php
						$sql2 = "select * from staff_time_table where day_id='2' and pried_2<>'0' and staff_id='$staff_id' order by id";
                        $result2 = mysqli_query($conn, $sql2);
                        while ($row2 = mysqli_fetch_assoc($result2)) {
                        ?>
						 <a class="btn btn-info pu" href="class_time_tabil_1.php?id=<?php echo $row['id']; ?>"  title="<?php echo $row2['subject_2']; ?>"> <?php echo $row2['pried_2']; ?>
							   <?php }  ?>
				 </td>
							    <td>
                                <?php
						$sql2 = "select * from staff_time_table where day_id='2' and pried_3<>'0' and staff_id='$staff_id' order by id";
                        $result2 = mysqli_query($conn, $sql2);
                        while ($row2 = mysqli_fetch_assoc($result2)) {
                        ?>
						 <a class="btn btn-info pu" href="class_time_tabil_1.php?id=<?php echo $row['id']; ?>"  title="<?php echo $row2['subject_3']; ?>"> <?php echo $row2['pried_3']; ?>
							   <?php }  ?>
				 </td>
							    <td>
                                <?php
						$sql2 = "select * from staff_time_table where day_id='2' and pried_4<>'0' and staff_id='$staff_id' order by id";
                        $result2 = mysqli_query($conn, $sql2);
                        while ($row2 = mysqli_fetch_assoc($result2)) {
                        ?>
						 <a class="btn btn-info pu" href="class_time_tabil_1.php?id=<?php echo $row['id']; ?>"  title="<?php echo $row2['subject_4']; ?>"> <?php echo $row2['pried_4']; ?>
							   <?php }  ?>	
 </td>
							    <td>							   
                                <?php
						$sql2 = "select * from staff_time_table where day_id='2' and pried_5<>'0' and staff_id='$staff_id' order by id";
                        $result2 = mysqli_query($conn, $sql2);
                        while ($row2 = mysqli_fetch_assoc($result2)) {
                        ?>
						 <a class="btn btn-info pu" href="class_time_tabil_1.php?id=<?php echo $row['id']; ?>"  title="<?php echo $row2['subject_5']; ?>"> <?php echo $row2['pried_5']; ?>
							   <?php }  ?>	
 </td>
							    <td>							   
                                <?php
						$sql2 = "select * from staff_time_table where day_id='2' and pried_6<>'0' and staff_id='$staff_id' order by id";
                        $result2 = mysqli_query($conn, $sql2);
                        while ($row2 = mysqli_fetch_assoc($result2)) {
                        ?>
						<a class="btn btn-info pu" href="class_time_tabil_1.php?id=<?php echo $row['id']; ?>"  title="<?php echo $row2['subject_6']; ?>"> <?php echo $row2['pried_6']; ?>
							   <?php }  ?>	
 </td>
							    <td>							   
                                <?php
						$sql2 = "select * from staff_time_table where day_id='2' and pried_7<>'0' and staff_id='$staff_id' order by id";
                        $result2 = mysqli_query($conn, $sql2);
                        while ($row2 = mysqli_fetch_assoc($result2)) {
                        ?>
						 <a class="btn btn-info pu" href="class_time_tabil_1.php?id=<?php echo $row['id']; ?>"  title="<?php echo $row2['subject_7']; ?>"> <?php echo $row2['pried_7']; ?>
							   <?php }  ?>		
 </td>
<td>							   
                                <?php
						$sql2 = "select * from staff_time_table where day_id='2' and pried_8<>'0' and staff_id='$staff_id' order by id";
                        $result2 = mysqli_query($conn, $sql2);
                        while ($row2 = mysqli_fetch_assoc($result2)) {
                        ?>
						 <a class="btn btn-info pu" href="class_time_tabil_1.php?id=<?php echo $row['id']; ?>"  title="<?php echo $row2['subject_8']; ?>"> <?php echo $row2['pried_8']; ?>
							   <?php }  ?>
							  </td>
							</tr>
							 <tr>
							 <td>	
							 <?php
						$sql2 = "select a.*,b.day_name from staff_time_table a,days b where a.day_id=b.id and a.day_id='3' and a.staff_id='$staff_id' GROUP BY a.day_id";
                        $result2 = mysqli_query($conn, $sql2);
                        while ($row2 = mysqli_fetch_assoc($result2)) {
                        ?>
                               <?php echo $row2['day_name']; ?>
							   <?php }  ?>
							    </td>
                                 <td>	
					<?php
						$sql2 = "select * from staff_time_table where day_id='3' and pried_1<>'0' and staff_id='$staff_id' order by id";
                        $result2 = mysqli_query($conn, $sql2);
                        while ($row2 = mysqli_fetch_assoc($result2)) {
                        ?>
						 <a class="btn btn-info pu" href="class_time_tabil_1.php?id=<?php echo $row['id']; ?>"  title="<?php echo $row2['subject_1']; ?>"> <?php echo $row2['pried_1']; ?>
							   <?php }  ?>
							    </td>
                                 <td>	
								 <?php
						$sql2 = "select * from staff_time_table where day_id='3' and pried_2<>'0' and staff_id='$staff_id' order by id";
                        $result2 = mysqli_query($conn, $sql2);
                        while ($row2 = mysqli_fetch_assoc($result2)) {
                        ?>
						 <a class="btn btn-info pu" href="class_time_tabil_1.php?id=<?php echo $row['id']; ?>"  title="<?php echo $row2['subject_2']; ?>"> <?php echo $row2['pried_2']; ?>
							   <?php }  ?>
							    </td>
                                 <td>	
                                <?php
						$sql2 = "select * from staff_time_table where day_id='3' and pried_3<>'0' and staff_id='$staff_id' order by id";
                        $result2 = mysqli_query($conn, $sql2);
                        while ($row2 = mysqli_fetch_assoc($result2)) {
                        ?>
						 <a class="btn btn-info pu" href="class_time_tabil_1.php?id=<?php echo $row['id']; ?>"  title="<?php echo $row2['subject_3']; ?>"> <?php echo $row2['pried_3']; ?>
							   <?php }  ?>
							    </td>
                                 <td>	
                                <?php
						$sql2 = "select * from staff_time_table where day_id='3' and pried_4<>'0' and staff_id='$staff_id' order by id";
                        $result2 = mysqli_query($conn, $sql2);
                        while ($row2 = mysqli_fetch_assoc($result2)) {
                        ?>
						 <a class="btn btn-info pu" href="class_time_tabil_1.php?id=<?php echo $row['id']; ?>"  title="<?php echo $row2['subject_4']; ?>"> <?php echo $row2['pried_4']; ?>
							   <?php }  ?>	
							    </td>
                                 <td>	
                                <?php
						$sql2 = "select * from staff_time_table where day_id='3' and pried_5<>'0' and staff_id='$staff_id' order by id";
                        $result2 = mysqli_query($conn, $sql2);
                        while ($row2 = mysqli_fetch_assoc($result2)) {
                        ?>
						 <a class="btn btn-info pu" href="class_time_tabil_1.php?id=<?php echo $row['id']; ?>"  title="<?php echo $row2['subject_5']; ?>"> <?php echo $row2['pried_5']; ?>
							   <?php }  ?>	
							    </td>
                                 <td>	
                                <?php
						$sql2 = "select * from staff_time_table where day_id='3' and pried_6<>'0' and staff_id='$staff_id' order by id";
                        $result2 = mysqli_query($conn, $sql2);
                        while ($row2 = mysqli_fetch_assoc($result2)) {
                        ?>
						 <a class="btn btn-info pu" href="class_time_tabil_1.php?id=<?php echo $row['id']; ?>"  title="<?php echo $row2['subject_6']; ?>"> <?php echo $row2['pried_6']; ?>
							   <?php }  ?>		
							    </td>
                                 <td>	
                                <?php
						$sql2 = "select * from staff_time_table where day_id='3' and pried_7<>'0' and staff_id='$staff_id' order by id";
                        $result2 = mysqli_query($conn, $sql2);
                        while ($row2 = mysqli_fetch_assoc($result2)) {
                        ?>
						 <a class="btn btn-info pu" href="class_time_tabil_1.php?id=<?php echo $row['id']; ?>"  title="<?php echo $row2['subject_7']; ?>"> <?php echo $row2['pried_7']; ?>
							   <?php }  ?>	
							    </td>
                                 <td>	
								 <?php
						$sql2 = "select * from staff_time_table where day_id='3' and pried_8<>'0' and staff_id='$staff_id' order by id";
                        $result2 = mysqli_query($conn, $sql2);
                        while ($row2 = mysqli_fetch_assoc($result2)) {
                        ?>
						 <a class="btn btn-info pu" href="class_time_tabil_1.php?id=<?php echo $row['id']; ?>"  title="<?php echo $row2['subject_8']; ?>"> <?php echo $row2['pried_8']; ?>
							   <?php }  ?>
							 </td>
                                
</tr>
 <tr>
                                 <td>	
						<?php
						$sql2 = "select a.*,b.day_name from staff_time_table a,days b where a.day_id=b.id and a.day_id='4' and a.staff_id='$staff_id' GROUP BY a.day_id";

                        $result2 = mysqli_query($conn, $sql2);
                        while ($row2 = mysqli_fetch_assoc($result2)) {
                        ?>
                               <?php echo $row2['day_name']; ?>
							   <?php }  ?>
							    </td>
                                 <td>	
								 <?php
						$sql2 = "select * from staff_time_table where day_id='4' and pried_1<>'0' and staff_id='$staff_id' order by id";
                        $result2 = mysqli_query($conn, $sql2);
                        while ($row2 = mysqli_fetch_assoc($result2)) {
                        ?>
						 <a class="btn btn-info pu" href="class_time_tabil_1.php?id=<?php echo $row['id']; ?>"  title="<?php echo $row2['subject_1']; ?>"> <?php echo $row2['pried_1']; ?>
							   <?php }  ?>
							    </td>
                                 <td>	
								 <?php
						$sql2 = "select * from staff_time_table where day_id='4' and pried_2<>'0' and staff_id='$staff_id' order by id";
                        $result2 = mysqli_query($conn, $sql2);
                        while ($row2 = mysqli_fetch_assoc($result2)) {
                        ?>
						 <a class="btn btn-info pu" href="class_time_tabil_1.php?id=<?php echo $row['id']; ?>"  title="<?php echo $row2['subject_2']; ?>"> <?php echo $row2['pried_2']; ?>
							   <?php }  ?>
							    </td>
                                 <td>	
                                <?php
						$sql2 = "select * from staff_time_table where day_id='4' and pried_3<>'0' and staff_id='$staff_id' order by id";
                        $result2 = mysqli_query($conn, $sql2);
                        while ($row2 = mysqli_fetch_assoc($result2)) {
                        ?>
						 <a class="btn btn-info pu" href="class_time_tabil_1.php?id=<?php echo $row['id']; ?>"  title="<?php echo $row2['subject_3']; ?>"> <?php echo $row2['pried_3']; ?>
							   <?php }  ?>
							    </td>
                                 <td>	
                                <?php
						$sql2 = "select * from staff_time_table where day_id='4' and pried_4<>'0' and staff_id='$staff_id' order by id";
                        $result2 = mysqli_query($conn, $sql2);
                        while ($row2 = mysqli_fetch_assoc($result2)) {
                        ?>
						 <a class="btn btn-info pu" href="class_time_tabil_1.php?id=<?php echo $row['id']; ?>"  title="<?php echo $row2['subject_4']; ?>"> <?php echo $row2['pried_4']; ?>
							   <?php }  ?>
							    </td>
                                 <td>	
                                <?php
						$sql2 = "select * from staff_time_table where day_id='4' and pried_5<>'0' and staff_id='$staff_id' order by id";
                        $result2 = mysqli_query($conn, $sql2);
                        while ($row2 = mysqli_fetch_assoc($result2)) {
                        ?>
						 <a class="btn btn-info pu" href="class_time_tabil_1.php?id=<?php echo $row['id']; ?>"  title="<?php echo $row2['subject_5']; ?>"> <?php echo $row2['pried_5']; ?>
							   <?php }  ?>	
							    </td>
                                 <td>	
                                <?php
						$sql2 = "select * from staff_time_table where day_id='4' and pried_6<>'0' and staff_id='$staff_id' order by id";
                        $result2 = mysqli_query($conn, $sql2);
                        while ($row2 = mysqli_fetch_assoc($result2)) {
                        ?>
						 <a class="btn btn-info pu" href="class_time_tabil_1.php?id=<?php echo $row['id']; ?>"  title="<?php echo $row2['subject_6']; ?>"> <?php echo $row2['pried_6']; ?>
							   <?php }  ?>	
							    </td>
                                 <td>	
								 <?php
						$sql2 = "select * from staff_time_table where day_id='4' and pried_7<>'0' and staff_id='$staff_id' order by id";
                        $result2 = mysqli_query($conn, $sql2);
                        while ($row2 = mysqli_fetch_assoc($result2)) {
                        ?>
						 <a class="btn btn-info pu" href="class_time_tabil_1.php?id=<?php echo $row['id']; ?>"  title="<?php echo $row2['subject_7']; ?>"> <?php echo $row2['pried_7']; ?>
							   <?php }  ?>	
							    </td>
                                 <td>	
                                <?php
						$sql2 = "select * from staff_time_table where day_id='4' and pried_8<>'0' and staff_id='$staff_id' order by id";
                        $result2 = mysqli_query($conn, $sql2);
                        while ($row2 = mysqli_fetch_assoc($result2)) {
                        ?>
						 <a class="btn btn-info pu" href="class_time_tabil_1.php?id=<?php echo $row['id']; ?>"  title="<?php echo $row2['subject_8']; ?>"> <?php echo $row2['pried_8']; ?>
							   <?php }  ?>
							    </td>
							</tr>
 <tr>
                                 <td>	
						<?php
						$sql2 = "select a.*,b.day_name from staff_time_table a,days b where a.day_id=b.id and a.day_id='5' and a.staff_id='$staff_id' GROUP BY a.day_id";

						//$sql2 = "select * from staff_time_table where day_id='3' and staff_id='$staff_id' GROUP BY day_id";
                        $result2 = mysqli_query($conn, $sql2);
                        while ($row2 = mysqli_fetch_assoc($result2)) {
                        ?>
                               <?php echo $row2['day_name']; ?>
							   <?php }  ?>
							    </td>
                                 <td>	
					<?php
						$sql2 = "select * from staff_time_table where day_id='5' and pried_1<>'0' and staff_id='$staff_id' order by id";
                        $result2 = mysqli_query($conn, $sql2);
                        while ($row2 = mysqli_fetch_assoc($result2)) {
                        ?>
						 <a class="btn btn-info pu" href="class_time_tabil_1.php?id=<?php echo $row['id']; ?>"  title="<?php echo $row2['subject_1']; ?>"> <?php echo $row2['pried_1']; ?>
							   <?php }  ?>
							    </td>
                                 <td>	
								 <?php
						$sql2 = "select * from staff_time_table where day_id='5' and pried_2<>'0' and staff_id='$staff_id' order by id";
                        $result2 = mysqli_query($conn, $sql2);
                        while ($row2 = mysqli_fetch_assoc($result2)) {
                        ?>
						 <a class="btn btn-info pu" href="class_time_tabil_1.php?id=<?php echo $row['id']; ?>"  title="<?php echo $row2['subject_2']; ?>"> <?php echo $row2['pried_2']; ?>
							   <?php }  ?>
							    </td>
                                 <td>	
                                <?php
						$sql2 = "select * from staff_time_table where day_id='5' and pried_3<>'0' and staff_id='$staff_id' order by id";
                        $result2 = mysqli_query($conn, $sql2);
                        while ($row2 = mysqli_fetch_assoc($result2)) {
                        ?>
						 <a class="btn btn-info pu" href="class_time_tabil_1.php?id=<?php echo $row['id']; ?>"  title="<?php echo $row2['subject_3']; ?>"> <?php echo $row2['pried_3']; ?>
							   <?php }  ?>
							    </td>
                                 <td>	
                                <?php
						$sql2 = "select * from staff_time_table where day_id='5' and pried_4<>'0' and staff_id='$staff_id' order by id";
                        $result2 = mysqli_query($conn, $sql2);
                        while ($row2 = mysqli_fetch_assoc($result2)) {
                        ?>
						 <a class="btn btn-info pu" href="class_time_tabil_1.php?id=<?php echo $row['id']; ?>"  title="<?php echo $row2['subject_4']; ?>"> <?php echo $row2['pried_4']; ?>
							   <?php }  ?>	
							    </td>
                                 <td>	
                                <?php
						$sql2 = "select * from staff_time_table where day_id='5' and pried_5<>'0' and staff_id='$staff_id' order by id";
                        $result2 = mysqli_query($conn, $sql2);
                        while ($row2 = mysqli_fetch_assoc($result2)) {
                        ?>
						 <a class="btn btn-info pu" href="class_time_tabil_1.php?id=<?php echo $row['id']; ?>"  title="<?php echo $row2['subject_5']; ?>"> <?php echo $row2['pried_5']; ?>
							   <?php }  ?>	
							    </td>
                                 <td>	
								 <?php
						$sql2 = "select * from staff_time_table where day_id='5' and pried_6<>'0' and staff_id='$staff_id' order by id";
                        $result2 = mysqli_query($conn, $sql2);
                        while ($row2 = mysqli_fetch_assoc($result2)) {
                        ?>
						 <a class="btn btn-info pu" href="class_time_tabil_1.php?id=<?php echo $row['id']; ?>"  title="<?php echo $row2['subject_6']; ?>"> <?php echo $row2['pried_6']; ?>
							   <?php }  ?>	
							    </td>
                                 <td>	
                                <?php
						$sql2 = "select * from staff_time_table where day_id='5' and pried_7<>'0' and staff_id='$staff_id' order by id";
                        $result2 = mysqli_query($conn, $sql2);
                        while ($row2 = mysqli_fetch_assoc($result2)) {
                        ?>
						 <a class="btn btn-info pu" href="class_time_tabil_1.php?id=<?php echo $row['id']; ?>"  title="<?php echo $row2['subject_7']; ?>"> <?php echo $row2['pried_7']; ?>
							   <?php }  ?>	
							    </td>
                                 <td>	
								 <?php
						$sql2 = "select * from staff_time_table where day_id='5' and pried_8<>'0' and staff_id='$staff_id' order by id";
                        $result2 = mysqli_query($conn, $sql2);
                        while ($row2 = mysqli_fetch_assoc($result2)) {
                        ?>
						 <a class="btn btn-info pu" href="class_time_tabil_1.php?id=<?php echo $row['id']; ?>"  title="<?php echo $row2['subject_8']; ?>"> <?php echo $row2['pried_8']; ?>
							   <?php }  ?>
							     </td>
							</tr>
							 <tr>
							 <td>	
							 	<?php
						$sql2 = "select a.*,b.day_name from staff_time_table a,days b where a.day_id=b.id and a.day_id='6' and a.staff_id='$staff_id' GROUP BY a.day_id";

                        $result2 = mysqli_query($conn, $sql2);
                        while ($row2 = mysqli_fetch_assoc($result2)) {
                        ?>
                               <?php echo $row2['day_name']; ?>
							   <?php }  ?>
							    </td>
                                 <td>	
					<?php
						$sql2 = "select * from staff_time_table where day_id='6' and pried_1<>'0' and staff_id='$staff_id' order by id";
                        $result2 = mysqli_query($conn, $sql2);
                        while ($row2 = mysqli_fetch_assoc($result2)) {
                        ?>
						 <a class="btn btn-info pu" href="class_time_tabil_1.php?id=<?php echo $row['id']; ?>"  title="<?php echo $row2['subject_1']; ?>"> <?php echo $row2['pried_1']; ?>
							   <?php }  ?>
							    </td>
                                 <td>	
								 <?php
						$sql2 = "select * from staff_time_table where day_id='6' and pried_2<>'0' and staff_id='$staff_id' order by id";
                        $result2 = mysqli_query($conn, $sql2);
                        while ($row2 = mysqli_fetch_assoc($result2)) {
                        ?>
						 <a class="btn btn-info pu" href="class_time_tabil_1.php?id=<?php echo $row['id']; ?>"  title="<?php echo $row2['subject_2']; ?>"> <?php echo $row2['pried_2']; ?>
							   <?php }  ?>
							    </td>
                                 <td>	
                                <?php
						$sql2 = "select * from staff_time_table where day_id='6' and pried_3<>'0' and staff_id='$staff_id' order by id";
                        $result2 = mysqli_query($conn, $sql2);
                        while ($row2 = mysqli_fetch_assoc($result2)) {
                        ?>
						 <a class="btn btn-info pu" href="class_time_tabil_1.php?id=<?php echo $row['id']; ?>"  title="<?php echo $row2['subject_3']; ?>"> <?php echo $row2['pried_3']; ?>
							   <?php }  ?>
							    </td>
                                 <td>	
                                <?php
						$sql2 = "select * from staff_time_table where day_id='6' and pried_4<>'0' and staff_id='$staff_id' order by id";
                        $result2 = mysqli_query($conn, $sql2);
                        while ($row2 = mysqli_fetch_assoc($result2)) {
                        ?>
						 <a class="btn btn-info pu" href="class_time_tabil_1.php?id=<?php echo $row['id']; ?>"  title="<?php echo $row2['subject_4']; ?>"> <?php echo $row2['pried_4']; ?>
							   <?php }  ?>	
							    </td>
                                 <td>	
                                <?php
						$sql2 = "select * from staff_time_table where day_id='6' and pried_5<>'0' and staff_id='$staff_id' order by id";
                        $result2 = mysqli_query($conn, $sql2);
                        while ($row2 = mysqli_fetch_assoc($result2)) {
                        ?>
						 <a class="btn btn-info pu" href="class_time_tabil_1.php?id=<?php echo $row['id']; ?>"  title="<?php echo $row2['subject_5']; ?>"> <?php echo $row2['pried_5']; ?>
							   <?php }  ?>	
							    </td>
                                 <td>	
								 <?php
						$sql2 = "select * from staff_time_table where day_id='6' and pried_6<>'0' and staff_id='$staff_id' order by id";
                        $result2 = mysqli_query($conn, $sql2);
                        while ($row2 = mysqli_fetch_assoc($result2)) {
                        ?>
						 <a class="btn btn-info pu" href="class_time_tabil_1.php?id=<?php echo $row['id']; ?>"  title="<?php echo $row2['subject_6']; ?>"> <?php echo $row2['pried_6']; ?>
							   <?php }  ?>	
							    </td>
                                 <td>	
                                <?php
						$sql2 = "select * from staff_time_table where day_id='6' and pried_7<>'0' and staff_id='$staff_id' order by id";
                        $result2 = mysqli_query($conn, $sql2);
                        while ($row2 = mysqli_fetch_assoc($result2)) {
                        ?>
						 <a class="btn btn-info pu" href="class_time_tabil_1.php?id=<?php echo $row['id']; ?>"  title="<?php echo $row2['subject_7']; ?>"> <?php echo $row2['pried_7']; ?>
							   <?php }  ?>	
							    </td>
                                 <td>	
								 <?php
						$sql2 = "select * from staff_time_table where day_id='6' and pried_8<>'0' and staff_id='$staff_id' order by id";
                        $result2 = mysqli_query($conn, $sql2);
                        while ($row2 = mysqli_fetch_assoc($result2)) {
                        ?>
						 <a class="btn btn-info pu" href="class_time_tabil_1.php?id=<?php echo $row['id']; ?>"  title="<?php echo $row2['subject_8']; ?>"> <?php echo $row2['pried_8']; ?>
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
		
		            	   				<?php include "chat-map.php"; ?>
										<iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15796.241989807046!2d77.4319196!3d8.1966608!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xbfff5535181af409!2sSree+Moolam+Rama+Varma+Hr.+Sec.+School!5e0!3m2!1sen!2sin!4v1520233781674" width="1200" height="500" frameborder="0" style="border:0" allowfullscreen></iframe>

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