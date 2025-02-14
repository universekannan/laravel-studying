<?php

 $user_id=$_SESSION['user_id'];
 ?>
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <ul class="sidebar-menu" data-widget="tree">

               <li class="<?php if($page=="Dashboard") echo "active"; ?>"><a href="staff-dashboard.php"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a>
			   <ul class="treeview  <?php if($page1=="Dashboard1") echo "active"; ?>">
			     </ul>
</li>

      
		<?php if(($_SESSION['user_type']=="admin")) { ?>
          <li class="treeview <?php if($page=="Principal") echo "active"; ?>">
 <a href="#">
            <i class="fa fa-user-o"></i> <span>Principal</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
              <li <?php if($page1=="Principal Records") echo "class='active'"; ?>><a href="principal-record.php"><i class="fa fa-circle-o"></i> Principal Records</a></li>
           <li <?php if($page1=="Add Principal") echo "class='active'"; ?>><a href="add-principal.php"><i class="fa fa-circle-o"></i> Add Principal </a></li>
          </ul>
        </li>
       <?php } ?>
	<?php if(($_SESSION['user_type']=="admin") || ($_SESSION['user_type']=="principal")) { ?>
          <li class="treeview <?php if($page=="Staff") echo "active"; ?>">
          <a href="#">
            <i class="fa fa-user-plus"></i>
            <span>Staff </span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li <?php if($page1=="Staff Records") echo "class='active'"; ?>><a href="staff-record.php"><i class="fa fa-circle-o"></i> Staff Records</a></li>
             <li <?php if($page1=="Add Staff") echo "class='active'"; ?>><a href="add-staff.php"><i class="fa fa-circle-o"></i> Add Staff </a></li>
<li <?php if($page1=="Staff Attendance") echo "class='active'"; ?>><a href="staff-list.php"><i class="fa fa-circle-o text-orange"></i> Staff Attendance</a></li>
          </ul>
        </li>
        <?php } ?>
       
       <?php if(($_SESSION['user_type']=="admin") || ($_SESSION['user_type']=="principal") || ($_SESSION['user_type']=="staff")) { ?>
          <li class="treeview <?php if($page=="Students") echo "active"; ?>">
          <a href="#">
            <i class="fa fa-user-circle-o"></i>
            <span>Students</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
             <li <?php if($page1=="Class") echo "class='active'"; ?>><a href="class-list.php"><i class="fa fa-circle-o"></i>Class</a></li>
            <?php if(($_SESSION['user_type']=="office") || ($_SESSION['user_type']=="staff")) { ?>
            <li <?php if($page1=="Student Admission") echo "class='active'"; ?>><a href="add-student.php"><i class="fa fa-circle-o"></i>Student Admission</a></li>
            <li <?php if($page1=="View Student") echo "class='active'"; ?>><a href="student-record.php"><i class="fa fa-circle-o"></i> Student Record ??</a></li>
            <?php } ?>
            <li <?php if($page1=="Student Attendance") echo "class='active'"; ?>><a href="attendance.php"><i class="fa fa-circle-o text-orange"></i> Student Attendance</a></li>
            
            <?php if(($_SESSION['user_type']=="admin") || ($_SESSION['user_type']=="principal") || ($_SESSION['user_type']=="staff")) { ?>
            <!--<li><a href="student-attendance-report.php"><i class="fa fa-circle-o text-blue"></i> Student Attendance Reports</a></li>
            <li <?php if($page1=="Student MarkList Details") echo "class='active'"; ?>><a href="student-markdetails.php"><i class="fa fa-circle-o text-green"></i> Student MarkList Details</a></li>-->
            <?php } ?>
            <?php if($_SESSION['user_type']=="student") { ?>
              <li <?php if($page1=="Student MarkList Details") echo "class='active'"; ?>><a href="student-markdetail.php"><i class="fa fa-circle-o text-green"></i> Student MarkList Details</a></li>
            <?php } ?>
            <?php if(($_SESSION['user_type']=="admin") || ($_SESSION['user_type']=="principal") || ($_SESSION['user_type']=="staff")) { ?>
            <li <?php if($page1=="Add Student Time Table") echo "class='active'"; ?>><a href="add-student-timetable.php"><i class="fa fa-circle-o text-green"></i> Add Student Time Table ??</a></li>
            <?php } ?>
            <li <?php if($page1=="Student Time Table") echo "class='active'"; ?>><a href="student-time-table.php"><i class="fa fa-circle-o text-green"></i> Student Time Table</a></li>
            <?php if(($_SESSION['user_type']=="admin") || ($_SESSION['user_type']=="principal") || ($_SESSION['user_type']=="staff")) { ?>
            <!--<li><a href="student-search.php"><i class="fa fa-circle-o text-green"></i> Student Reports</a></li>-->
            <?php } ?>


          </ul>
        </li>
<?php } ?>
		
  <li class="treeview <?php if($page=="Fees Details") echo "active"; ?>">
          <a href="#">
            <i class="fa fa-inr"></i>
            <span>Fees Details</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
	
          <ul class="treeview-menu">
		  <?php if(($_SESSION['user_type']=="admin") || ($_SESSION['user_type']=="principal")) { ?>
<li <?php if($page1=="Fees") echo "class='active'"; ?>><a href="fees.php"><i class="fa fa-circle-o text-red "></i> Add & View Fees</a></li>
    
<li <?php if($page1=="Add Fees Details") echo "class='active'"; ?>><a href="add_fees_details.php"><i class="fa fa-circle-o text-red "></i> Add Fees Details</a></li>
         
 <li <?php if($page1=="View Fees Details") echo "class='active'"; ?>><a href="view_fees_details.php"><i class="fa fa-circle-o text-red "></i> View Fees Details</a></li>
	<?php } ?>
          <li <?php if($page1=="Pay Fees") echo "class='active'"; ?>><a href="class-fees-list.php"><i class="fa fa-circle-o text-red "></i> Pay Fees</a></li>
          </ul>
        </li>
        
        <?php if(($_SESSION['user_type']=="admin") || ($_SESSION['user_type']=="principal")) { ?>
          <li class="treeview <?php if($page=="Study Details") echo "active"; ?>">
          <a href="#">
            <i class="fa fa-book"></i>
            <span>Study Details</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
          <li <?php if($page1=="Add Class") echo "class='active'"; ?>><a href="add_class.php"><i class="fa fa-circle-o text-red"></i> Add Class</a></li>
          <li <?php if($page1=="View Class") echo "class='active'"; ?>><a href="view_class.php"><i class="fa fa-circle-o text-aqua"></i> View Class</a></li>
          <li <?php if($page1=="Add Section") echo "class='active'"; ?>><a href="add_section.php"><i class="fa fa-circle-o text-red"></i> Add Section</a></li>
            <li <?php if($page1=="View Section") echo "class='active'"; ?>><a href="view_section.php"><i class="fa fa-circle-o text-aqua"></i> View Section</a></li>
             <li <?php if($page1=="Add Subject") echo "class='active'"; ?>><a href="add_subject.php"><i class="fa fa-circle-o text-red"></i> Add Subject</a></li>
            <li <?php if($page1=="View Subject") echo "class='active'"; ?>><a href="view_subject.php"><i class="fa fa-circle-o text-aqua"></i> View Subject</a></li>
            <li <?php if($page1=="Add Exam") echo "class='active'"; ?>><a href="add-examname.php"><i class="fa fa-circle-o text-red"></i> Add Exam</a></li>
            <li <?php if($page1=="View Exam") echo "class='active'"; ?>><a href="view-examname.php"><i class="fa fa-circle-o text-aqua"></i> View Exam</a></li>
          
          </ul>
        </li>
		<?php } ?>
<?php if(($_SESSION['user_type']=="admin") || ($_SESSION['user_type']=="principal")) { ?>
          <li class="treeview <?php if($page=="Assign") echo "active"; ?>">
          <a href="#">
            <i class="fa fa-check"></i>
            <span>Assign</span>
            <span class="pull-right-container">
              <span class="fa fa-angle-left pull-right"></span>
            </span>
          </a>
          <ul class="treeview-menu">
            <li <?php if($page1=="Assign Class Teacher") echo "class='active'"; ?>><a href="assign_class_teacher.php"><i class="fa fa-circle-o text-green"></i> Assign Class Teacher</a></li>
            <li <?php if($page1=="View Assign Class Teacher") echo "class='active'"; ?>><a href="view_class_teacher.php"><i class="fa fa-circle-o text-orange"></i> View Assign Class Teacher </a></li>
            
          </ul>
        </li>
	<?php } ?>
	
	<?php if(($_SESSION['user_type']=="admin") || ($_SESSION['user_type']=="principal")) { ?>	
          <li class="treeview <?php if($page=="Transport") echo "active"; ?>">
          <a href="#">
            <i class="fa fa-bus"></i> <span>Transport</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
           <li <?php if($page1=="Transport Records") echo "class='active'"; ?>><a href="transport-records.php"><i class="fa fa-circle-o text-aqua"></i> Transport Records</a></li>
            <li <?php if($page1=="Add Transport Records") echo "class='active'"; ?>><a href="add-transport-records.php"><i class="fa fa-circle-o text-red"></i> Add Transport Records</a></li>
            <li <?php if($page1=="Transport Attendance") echo "class='active'"; ?>><a href="transport-attendance.php"><i class="fa fa-circle-o text-orange"></i> Transport Attendance</a></li>
          <li <?php if($page1=="Add Vehicle") echo "class='active'"; ?>><a href="add-vechicle.php"><i class="fa fa-circle-o text-aqua"></i> Add Vehicle</a></li>
            <li <?php if($page1=="View Vehicle") echo "class='active'"; ?>><a href="vechicle.php"><i class="fa fa-circle-o text-red"></i> View Vehicle</a></li>
            <li <?php if($page1=="Add Route") echo "class='active'"; ?>><a href="#"><i class="fa fa-circle-o text-red"></i> Add Route</a></li>
            <li <?php if($page1=="View Route") echo "class='active'"; ?>><a href="#"><i class="fa fa-circle-o text-red"></i> View Route</a></li>
            <li <?php if($page1=="Manage Route") echo "class='active'"; ?>><a href="#"><i class="fa fa-circle-o text-red"></i> Manage Route</a></li>
            <li <?php if($page1=="Assign Driver") echo "class='active'"; ?>><a href="#"><i class="fa fa-circle-o text-red"></i> Assign Driver</a></li>
            <li <?php if($page1=="Add Mileage") echo "class='active'"; ?>><a href="#"><i class="fa fa-circle-o text-red"></i> Add Mileage</a></li>
            <li <?php if($page1=="Mileage Details") echo "class='active'"; ?>><a href="#"><i class="fa fa-circle-o text-red"></i> Mileage Details</a></li>
            <li <?php if($page1=="Vehicle Tracking") echo "class='active'"; ?>><a href="#"><i class="fa fa-circle-o text-red"></i> Vehicle Tracking</a></li>
          </ul>
        </li>
       <?php } ?>

          <li class="treeview <?php if($page=="Notification") echo "active"; ?>">
          <a href="#">
            <i class="fa fa-bell-o"></i>
            <span>Notification</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
          <li><a href="#"><i class="fa fa-circle-o text-red"></i> Add Notification Templates</a></li>
          <li><a href="#"><i class="fa fa-circle-o text-aqua"></i> Edit Notification Templates</a></li>
          <li><a href="#"><i class="fa fa-circle-o text-red"></i> Add Announcement Templates</a></li>
            <li><a href="#"><i class="fa fa-circle-o text-aqua"></i> Edit Announcement Templates</a></li>
            <li><a href="#"><i class="fa fa-circle-o text-red"></i> Send Notification</a></li>
            <li><a href="#"><i class="fa fa-circle-o text-aqua"></i> Send Announcement</a></li>
            <li><a href="#"><i class="fa fa-circle-o text-red"></i> Absent Notification</a></li>
            <li><a href="#"><i class="fa fa-circle-o text-aqua"></i> Bus Delay Notification</a></li>
          
          </ul>
        </li>
      

          <li class="treeview <?php if($page=="Notes") echo "active"; ?>">
          <a href="#">
            <i class="fa fa-sticky-note"></i>
            <span>Notes</span>
            <span class="pull-right-container">
              <span class="fa fa-angle-left pull-right"></span>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="#"><i class="fa fa-circle-o text-green"></i> Send Notes</a></li>
            <li><a href="#"><i class="fa fa-circle-o text-orange"></i> View Notes</a></li>
            
          </ul>
        </li>
       
        
          <li class="treeview <?php if($page=="Events") echo "active"; ?>">
          <a href="#">
            <i class="fa fa-calendar"></i> <span>Events</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="#"><i class="fa fa-circle-o text-red"></i> Add Events</a></li>
            <li><a href="#"><i class="fa fa-circle-o text-aqua"></i> Events Details</a></li>
            <li><a href="#"><i class="fa fa-circle-o text-red"></i> Assign</a></li>
            <li><a href="#"><i class="fa fa-circle-o text-green"></i> Details</a></li>
          </ul>
        </li>

       <?php if(($_SESSION['user_type']=="admin") || ($_SESSION['user_type']=="principal") || ($_SESSION['user_type']=="library")) { ?>
          <li class="treeview <?php if($page=="aaaaaa") echo "active"; ?>">
          <a href="#">
            <i class="fa fa-book"></i>
            <span>Library</span>
            <span class="pull-right-container">
              <span class="fa fa-angle-left pull-right"></span>
            </span>
          </a>
          <ul class="treeview-menu">
		  <li><a href="new_library_book.php"><i class="fa fa-circle-o text-red "></i>Add Library Book</a></li>
            <li><a href="library_book.php"><i class="fa fa-circle-o text-aqua"></i>Library Book</a></li>
            <li><a href="search-issue-book.php"><i class="fa fa-circle-o text-red"></i>Add Issue Book</a></li>
            <li><a href="issue-book.php"><i class="fa fa-circle-o text-aqua"></i>Issue Book</a></li>
            <li><a href="return-book.php"><i class="fa fa-circle-o text-green"></i>Return Book</a></li>
            <li><a href="penality.php"><i class="fa fa-circle-o text-aqua"></i>Penality</a></li>
            <li><a href="search-penality.php"><i class="fa fa-circle-o text-red"></i>Add Penality</a></li>

          </ul>
        </li>
            <?php } ?>

      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>