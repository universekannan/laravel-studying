<?php
session_start();
$page = "Students";
$page1 = "Student Admission";
include "timeout.php";
include "config.php";
if (($_SESSION['user_type'] != "admin") && ($_SESSION['user_type'] != "principal") && ($_SESSION['user_type'] != "staff") && ($_SESSION['user_type'] != "student")) header("location: index.php");
$id = $_GET['id'];

$msg = "";
$msg_color = "";

$school_id = "";
$full_name = "";
$father_name = "";
$date_of_join = "";
$date_of_birth = "";
$blood_group = "";
$email = "";
$password = "";
$mobile = "";
$address = "";
$class_id = "";
$religion = "";
$mother_tongue = "";
$second_language = "";
$physical_status = "";
$photo = "";
$admission_no = "";
$gender = "";
$age = "";
$medium = "";
$sub_cast = "";
$first_language = "";
$hostler = "";
$nationality = "";
$status = "";
$user_id = "";
$date = date('y/m/d');

if (isset($_POST['submit'])) {
        $school_id = trim($_POST['school_id']);
        $full_name = trim($_POST['full_name']);
        $father_name = trim($_POST['father_name']);
        $date_of_join= $_POST['date_of_join'];
        $date_of_birth = trim($_POST['date_of_birth']);
        $blood_group = trim($_POST['blood_group']);
        $email = trim($_POST['email']);
        $password = trim($_POST['password']);
        $mobile = trim($_POST['mobile']);
        $address = trim($_POST['address']);
        $class_id = trim($_POST['class_id']);
        $religion = trim($_POST['religion']);
         $mother_tongue = trim($_POST['mother_tongue']);
         $second_language = trim($_POST['second_language']);
         $physical_status = trim($_POST['physical_status']);
         $admission_no = trim($_POST['admission_no']);
         $gender = trim($_POST['gender']);
         $age = trim($_POST['age']);
         $medium = trim($_POST['medium']);     
         $sub_cast = trim($_POST['sub_cast']);     
         $first_language = trim($_POST['first_language']);     
         $hostler = trim($_POST['hostler']);     
         $nationality = trim($_POST['nationality']);     
         $status = trim($_POST['status']);     
         $user_id = $_SESSION['user_id'];     

		$stmt = $conn->prepare("update users set full_name=?,email=?,status=?,password=?,mobile=?,address=? where id=?");
        $stmt->bind_param("sssssss", $full_name, $email, $status, $password, $mobile, $address,$id);
        $stmt->execute();
		
    $stmt = $conn->prepare("INSERT INTO student_record (school_id,full_name,father_name,date_of_join,date_of_birth,blood_group,email,password,mobile,address,class_id,religion,mother_tongue,second_language,physical_status,admission_no,gender,age,medium,sub_cast,first_language,hostler,nationality,user_id,date,photo) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");

        $stmt->bind_param("ssssssssssssssssssssssssss", $school_id,$full_name,$father_name,$date_of_join, $date_of_birth,$blood_group, $email,$password,$mobile,$address,$class_id,$religion,$mother_tongue,$second_language,$physical_status,$admission_no,$gender,$age,$medium,$sub_cast,$first_language,$hostler,$nationality,$user_id,$date,$photo);
		
        //$stmt = $conn->prepare("update student_record set school_id=?,full_name=?,father_name=?,date_of_join=?,date_of_birth=?,blood_group=?,email=?,password=?,mobile=?,address=?,class_id=?,religion=?,mother_tongue=?,second_language=?,physical_status=?,photo=?,admission_no=?,gender=?,age=?,medium=?,sub_cast=?,first_language=?,hostler=?,nationality=?,user_id=?,date=? where school_id=?");
        //$stmt->bind_param("sssssssssssssssssssssssssss", $school_id, $full_name,$father_name,$date_of_join, $date_of_birth, $blood_group,$email,$password,$mobile,$address,$class_id,$religion,$mother_tongue,$second_language,$physical_status,$photo,$admission_no,$gender,$age,$medium,$sub_cast,$first_language,$hostler,$nationality,$user_id,$date,$school_id);
		
        $stmt->execute() or die($stmt->error);
         $file_name = $_FILES['photo']['name'];
        if (trim($file_name) != "") {
            $ext = pathinfo($file_name, PATHINFO_EXTENSION);
            $file_name = $id . "." . $ext;
            $query = "update student_record set photo = '" . $file_name . "' where id =$id";
            mysqli_query($conn, $query);
            $target_path = "photo/";
            $target_path = $target_path . $file_name;
            move_uploaded_file($_FILES['photo']['tmp_name'], $target_path);
        }

        header("location: student-record.php");
    }

$sql1 = "select * from users where id=$id";
$result1 = mysqli_query($conn, $sql1);
$row1 = mysqli_fetch_assoc($result1);
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Edit Student Record</title>
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
                                <h1 class="panel-title">Edit Student Record</h1>
                            </div>
                            <div class="panel-body">
                                <div class="row">
                            <form method="post" action="" enctype="multipart/form-data">

                            <div class="panel-body">

                                <div class="row">

                                    <div class="col-md-12">

<div class="col-md-6">
        <div class="form-group">

            <label for="school_id" class="control-label required">Student Id</label>

            <input readonly value="<?php echo $row1['id']; ?>" required="required" maxlength="50" type="text"

                name="school_id" class="form-control" placeholder="Student Id">

        </div>


        <div class="form-group">

            <label for="First Name" class="control-label required">Student Name</label>

            <input value="<?php echo $row1['full_name']; ?>" required="required" type="text" maxlength="20"

                name="full_name" id="full_name" class="form-control"

                placeholder="Student Name">

        </div>
		
		<div class="form-group">

            <label for="Father Name" class="control-label required">Father Name</label>

            <input value="<?php echo $row['father_name']; ?>" required="required" type="text" maxlength="20"

                name="father_name" id="father_name" class="form-control"

                placeholder="Father Name">

        </div>
        
        
 <div class="form-group">
       <label>Date Of Join</label>


<div class="input-group">

						<input value="<?php echo $row['date_of_join']; ?>" type="text" class="form-control" name="date_of_join" id="date_of_join" data-select="datepicker" data-locked="25/12/2014;1/1/2015">
						<span class="input-group-btn"><button type="button" class="btn btn-primary" data-toggle="datepicker"><i class="fa fa-calendar"></i></button></span>
					</div>
					</div>

                                        
                              <div class="form-group">           
                                               <label>Date Of Birth</label>
                                   
<div class="input-group">

						<input value="<?php echo $row['date_of_birth']; ?>" type="text" class="form-control" name="date_of_birth" id="date_of_birth" data-select="datepicker" data-locked="25/12/2014;1/1/2015">
						<span class="input-group-btn"><button type="button" class="btn btn-primary" data-toggle="datepicker"><i class="fa fa-calendar"></i></button></span>
					</div>
					</div>
					
					 
		 <div class="form-group">

            <label for="Last Name" class="control-label required">Email</label>

            <input value="<?php echo $row1['email']; ?>" required="required" type="text" maxlength="50"

                name="email" id="email" class="form-control"

                placeholder="Email">

        </div>
		
		<div class="form-group">

            <label for="Last Name" class="control-label required">Password</label>

            <input value="<?php echo $row1['password']; ?>" required="required" type="text" maxlength="20"

                name="password" id="password" class="form-control"

                placeholder="Password">

        </div>
		
		 <div class="form-group">

            <label for="Last Name" class="control-label required">Mobile</label>

            <input value="<?php echo $row1['mobile']; ?>" required="required" type="text" maxlength="20"

                name="mobile" id="mobile" class="form-control"

                placeholder="Mobile">

        </div>
    
	<div class="form-group">

            <label for="Last Name" class="control-label required">Address</label>

            <textarea value="" rows="4" required="required" type="text" maxlength="20"

                name="address" id="address" class="form-control"

                placeholder="Address"><?php echo $row1['address']; ?></textarea>

        </div>
	
	
        <div class="form-group">
        
            <label for="blood_group" class="control-label required">Blood Group</label>
        
                <select name="blood_group" id="blood_group" class="form-control">
                    <option>-----Select------</option>
                    <option <?php if ($row['id'] == "A+") ?>
                                                                <?php if ($row['blood_group'] == $row['id']) echo " selected='selected'"; ?>
        
                    value="A+">A+
        
                    </option>
        
                    <option <?php if ($row['blood_group'] == "A-") echo " selected='selected'"; ?>
        
                    value="A-">A-
        
                    </option>
                    <option <?php if ($row['blood_group'] == "B+") echo " selected='selected'"; ?>
        
                    value="B+">B+
        
                    </option>
                    <option <?php if ($row['blood_group'] == "B-") echo " selected='selected'"; ?>
        
                    value="B-">B-
        
                    </option>
                    <option <?php if ($row['blood_group'] == "AB+") echo " selected='selected'"; ?>
        
                    value="AB+">AB+
        
                    </option>
                    <option <?php if ($row['blood_group'] == "AB-") echo " selected='selected'"; ?>
        
                    value="AB-">AB-
        
                    </option>
                    <option <?php if ($row['blood_group'] == "O+") echo " selected='selected'"; ?>
        
                    value="O+">O+
        
                    </option>
                    <option <?php if ($row['blood_group'] == "O-") echo " selected='selected'"; ?>
        
                    value="O-">O-
        
                    </option>
        
                    </select>
        
        </div>
        <div class="form-group">

            <label for="class_name" class="control-label required">Class Name</label>

            <select name="class_id"  required class="form-control">
            <option>-----Select------</option>
            <?php
            $sql2 = "select * from class";
            $result2 = mysqli_query($conn, $sql2);
            while ($row2 = mysqli_fetch_assoc($result2)) {
                ?>
                <option
                    value="<?php echo $row2['id']; ?>"
					<?php if ($row['class_id'] == $row2['id']) echo " selected "; ?>
                ><?php echo $row2['standard']; ?><?php echo $row2['section_name']; ?></option>
                <?php
            }
            ?>
        </select>

        </div>
        <div class="form-group">

            <label for="religion" class="control-label required">Religion</label>

            <select name="religion" id="religion" class="form-control">
            <option>-----Select------</option>

                <option <?php if ($row['religion'] == "Hindu") echo " selected='selected'";?> 

                    value="Hindu">Hindu

                </option>

                <option <?php if ($row['religion'] == "Chiristian") echo " selected='selected'"; ?>

                    value="Chiristian">Chiristian

                </option>

                <option <?php if ($row['religion'] == "Muslim") echo " selected='selected'"; ?>

                    value="Muslim">Muslim

                </option>
            </select>

        </div>
        
        
    

</div>
    

<div class="col-md-6">
<div class="form-group">

            <label for="mother_tongue" class="control-label required">Mother Tongue</label>

            <select name="mother_tongue" id="mother_tongue" class="form-control">
            <option>-----Select------</option>

                <option <?php if ($row['mother_tongue'] == "Tamil") echo " selected='selected'"; ?>

                    value="Tamil">Tamil

                </option>

                <option <?php if ($row['mother_tongue'] == "Malayalam") echo " selected='selected'"; ?>

                    value="Malayalam">Malayalam

                </option>

                <option <?php if ($row['mother_tongue'] == "English") echo " selected='selected'"; ?>

                    value="English">English

                </option>

                <option <?php if ($row['mother_tongue'] == "Telugu") echo " selected='selected'"; ?>

                    value="Telugu">Telugu

                </option>

                <option <?php if ($row['mother_tongue'] == "Kannadam") echo " selected='selected'"; ?>

                    value="Kannadam">Kannadam

                </option>

                <option <?php if ($row['mother_tongue'] == "Hindi") echo " selected='selected'"; ?>

                    value="Hindi">Hindi

                </option>

            </select>

        </div>
<div class="form-group">

            <label for="second_language" class="control-label required">Second Language</label>

            <select name="second_language" id="second_language" class="form-control">
            <option>-----Select------</option>

                <option <?php if ($row['second_language'] == "Tamil") echo " selected='selected'"; ?>

                    value="Tamil">Tamil

                </option>

                <option <?php if ($row['second_language'] == "Malayalam") echo " selected='selected'"; ?>

                    value="Malayalam">Malayalam

                </option>

                <option <?php if ($row['second_language'] == "English") echo " selected='selected'"; ?>

                    value="English">English

                </option>

                <option <?php if ($row['second_language'] == "Telugu") echo " selected='selected'"; ?>

                    value="Telugu">Telugu

                </option>

                <option <?php if ($row['second_language'] == "Kannadam") echo " selected='selected'"; ?>

                    value="Kannadam">Kannadam

                </option>

                <option <?php if ($row['second_language'] == "Hindi") echo " selected='selected'"; ?>

                    value="Hindi">Hindi

                </option>

            </select>

        </div>
        

        <div class="form-group">

            <label for="photo"

                class="control-label">Image(400x100)</label>

            <input type="file"

                name="photo" id="photo" class="form-control">

        </div>
<div class="form-group">

            <label for="physical_status" class="control-label required">Physical Status</label>

            <input value="<?php echo $row['physical_status']; ?>" required="required" maxlength="50" type="text"

                name="physical_status" class="form-control" placeholder="Physical Status">

        </div>

        <div class="form-group">

            <label for="admission_no" class="control-label required">Admission No</label>

            <input value="<?php echo $row['admission_no']; ?>" required="required" maxlength="50" type="text"

                name="admission_no" class="form-control" placeholder="Admission No">

        </div>




        <div class="form-group">

            <label for="gender" class="control-label required">Gender</label>

            <select name="gender" id="gender" class="form-control">
            <option>-----Select------</option>

                <option <?php if ($row['gender'] == "Male") echo " selected='selected'"; ?>

                    value="Male">Male

                </option>

                <option <?php if ($row['gender'] == "Female") echo " selected='selected'"; ?>

                    value="Female">Female

                </option>
            </select>

        </div>

        <div class="form-group">
        <label for="age" class="control-label required">Age</label>

            <input value="<?php echo $row['age']; ?>" required="required" maxlength="2" pattern="[0-9]{0,2}"

                name="age" class="form-control" placeholder="Age">

        </div>


        <div class="form-group">

            <label for="medium" class="control-label required">Medium</label>

            <select name="medium" id="medium" class="form-control">
            <option>-----Select------</option>

                <option <?php if ($row['medium'] == "Tamil") echo " selected='selected'"; ?>

                    value="Tamil">Tamil

                </option>

                <option <?php if ($row['medium'] == "Malayalam") echo " selected='selected'"; ?>

                    value="Malayalam">Malayalam

                </option>

                <option <?php if ($row['medium'] == "English") echo " selected='selected'"; ?>

                    value="English">English

                </option>

                <option <?php if ($row['medium'] == "Telugu") echo " selected='selected'"; ?>

                    value="Telugu">Telugu

                </option>

                <option <?php if ($row['medium'] == "Kannadam") echo " selected='selected'"; ?>

                    value="Kannadam">Kannadam

                </option>

                <option <?php if ($row['medium'] == "Hindi") echo " selected='selected'"; ?>

                    value="Hindi">Hindi

                </option>

            </select>

        </div>

       
        

       <div class="form-group">

            <label for="sub_cast" class="control-label required">Sub Cast</label>

            <input value="<?php echo $row['sub_cast']; ?>" required="required" maxlength="50" type="text"

                name="sub_cast" class="form-control" placeholder="Sub Cast">

        </div>

        <div class="form-group">

            <label for="first_language" class="control-label required">First Language</label>

            <select name="first_language" id="first_language" class="form-control">
            <option>-----Select------</option>

                <option <?php if ($row['first_language'] == "Tamil") echo " selected='selected'"; ?>

                    value="Tamil">Tamil

                </option>

                <option <?php if ($row['first_language'] == "Malayalam") echo " selected='selected'"; ?>

                    value="Malayalam">Malayalam

                </option>

                <option <?php if ($row['first_language'] == "English") echo " selected='selected'"; ?>

                    value="English">English

                </option>

                <option <?php if ($row['first_language'] == "Telugu") echo " selected='selected'"; ?>

                    value="Telugu">Telugu

                </option>

                <option <?php if ($row['first_language'] == "Kannadam") echo " selected='selected'"; ?>

                    value="Kannadam">Kannadam

                </option>

                <option <?php if ($row['first_language'] == "Hindi") echo " selected='selected'"; ?>

                    value="Hindi">Hindi

                </option>

            </select>

        </div>

                                <div class="form-group">
                                <label for="hostler" class="control-label required">Hostler</label>

                                    <input value="<?php echo $row['hostler']; ?>" required="required" maxlength="50" type="text"

                                            name="hostler" class="form-control" placeholder="Hostler">

                                </div>
								

                                <div class="form-group">
                                <label for="nationality" class="control-label required">Nationality</label>

                                    <input value="<?php echo $row['nationality']; ?>" required="required" maxlength="50" type="text"

                                            name="nationality" class="form-control" placeholder="Nationality">

                                </div>
								  <div class="form-group">
                                                <label for="status" class="control-label required">Admission Status</label>
                                                <select name="status" id="status" class="form-control">
                                                    <option <?php if ($row1['status'] == "Active") echo " selected='selected'"; ?>
                                                        value="Active">Admission
                                                    </option>
                                                    <option <?php if ($row1['status'] == "Inactive") echo " selected='selected'"; ?>
                                                        value="Inactive">Bending
                                                    </option>
                                                </select>
                                            </div>

                        </div><br>
                                        <div class="form-group text-center">
                                            <input required="required" class="btn btn-info fa fa-upload"
                                                   type="submit"
                                                   name="submit" value="Update"/>
                                            <a href="student-record.php" class="btn btn-info fa fa-refresh">&nbsp;Back</a>
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
