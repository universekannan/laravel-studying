<?php
$date=date("Y-m-d");
$user_id = $_SESSION['user_id'];
$time=date('h:iA');

if (isset($_POST['time_in'])) {
    $date=date("Y-m-d");
    $user_id = $_SESSION['user_id'];
    $time_in=date('h:iA');
    $stmt = $conn->prepare("INSERT INTO attendance (user_id,date,time_in) VALUES (?,?,?)");
    $stmt->bind_param("sss",$user_id,$date,$time_in);
    $stmt->execute()or die($stmt->error);
}
if (isset($_POST['time_out'])) {
    $stmt = $conn->prepare("update attendance set time_out=? where date=? and user_id=?");
    $stmt->bind_param("sss",$time,$date,$user_id);
    $stmt->execute() or die($stmt->error);
}

?>
<header class="main-header">
    <!-- Logo -->
    <a href="../../index2.html" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>S</b>M</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>School</b>&nbsp;Management</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>

      <div class="navbar-custom-menu">
	  
        <ul class="nav navbar-nav">
          <!-- Messages: style can be found in dropdown.less-->
		   <br/>
		   <?php if(($_SESSION['user_type']=="admin") || ($_SESSION['user_type']=="principal") || ($_SESSION['user_type']=="staff") ||($_SESSION['user_type']=="transport")) { ?>
		  <li class="dropdown">
		  <form method="post">
                <?php
                $sql_att = "SELECT * FROM attendance WHERE date='$date' and user_id=$user_id";
                $result_att = mysqli_query($conn, $sql_att);
                $count = mysqli_num_rows($result_att);
               if ($count >= 1) {
                    $row_att = mysqli_fetch_assoc($result_att);
                    if($row_att['time_out']==""){
                        echo " <input class='btn btn-danger1' type='' name='' value='Attendance Time In'/>
				  <input class='btn btn-danger' type='submit' name='time_out' value='Attendance Time Out'/>";
                    }
                } else {
                    echo " <input class='btn btn-danger' type='submit' name='time_in' value='Attendance Time In'/>
				  <input class='btn btn-danger1' type='' name='' value='Attendance Time Out'/>";
                }
                ?>
            </form>
			</li>
		   <?php } ?>



          <?php
						$user_id = $_SESSION['user_id'];

                            $sql5 = "select * from users where id=$user_id";
                        $result5 = mysqli_query($conn, $sql5);
                        while ($row5 = mysqli_fetch_assoc($result5)) {
                            ?>   
			 
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <span class="hidden-xs">
              <?php echo $row5['full_name']; ?>&nbsp;<div class="caret"></div>
                </span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              
              <li class="user-header">
              <img src="photo/<?php echo $row5['photo']; ?>?<?php echo rand(); ?>"/>

                <p>
                <?php echo $row5['full_name']; ?>
                </p>
              </li>
              <!-- Menu Body -->
              <!-- Menu Footer-->
    <li class="user-footer">
 <?php if(($_SESSION['user_type']=="admin")) { ?>
              <b><a class="btn btn-default btn-flat" href="edit-admin-record.php?id=<?php echo $row5['id']; ?>">Profile</a></b>
 <?php } ?>
  <?php if(($_SESSION['user_type']=="principal")) { ?>

              <b><a class="btn btn-default btn-flat" href="edit-principal-record.php?id=<?php echo $row5['id']; ?>">Profile</a></b>
 <?php } ?>
  <?php if(($_SESSION['user_type']=="staff")) { ?>

              <b><a class="btn btn-default btn-flat" href="edit-staff-record.php?id=<?php echo $row5['id']; ?>">Profile</a></b>
 <?php } ?>
 <?php if(($_SESSION['user_type']=="student")) { ?>

              <b><a class="btn btn-default btn-flat" href="view-student-record.php?id=<?php echo $row5['id']; ?>">Profile</a></b>
 <?php } ?>
             <div class="pull-right">
                  <a href="logout.php" class="btn btn-default btn-flat">Logout</a>
                </div>
              </li>
			               <?php } ?>

            </ul>
          </li>
          
          <!-- Control Sidebar Toggle Button -->
         <!-- <li>
            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
          </li>-->
        </ul>
      </div>
    </nav>
  </header>