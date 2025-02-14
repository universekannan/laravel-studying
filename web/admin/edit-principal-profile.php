<?php
session_start();

$page = "users";
include "timeout.php";
include "config.php";
if ($_SESSION['user_type'] != "principal")  header("location: index.php");
$id = $_GET['id'];
$msg = "";
$msg_color = "";
$full_name = "";
$email = "";
$status = "Active";
$password = "";
$user_type = "";
$mobile = "";
$address = "";
$gender ="";
$dob="";
$joining="";
if (isset($_GET['mode']) and $_GET['mode'] == "delete_quali") {
    $delete_id = $_GET['delete_id'];
    $sql = "delete FROM staff_academic_qualification WHERE id=$delete_id";
    mysqli_query($conn, $sql);
    header("location: edit-principal-profile.php?id=$id");
}
if (isset($_GET['mode']) and $_GET['mode'] == "delete_teaching") {
    $delete_id = $_GET['delete_id'];
    $sql = "delete FROM teaching_experience WHERE id=$delete_id";
    mysqli_query($conn, $sql);
    header("location: edit-principal-profile.php?id=$id");
}
if (isset($_GET['mode']) and $_GET['mode'] == "delete_industry") {
    $delete_id = $_GET['delete_id'];
    $sql = "delete FROM other_experience WHERE id=$delete_id";
    mysqli_query($conn, $sql);
    header("location: edit-principal-profile.php?id=$id");
}
if (isset($_GET['mode']) and $_GET['mode'] == "delete_journal") {
    $delete_id = $_GET['delete_id'];
    $sql = "delete FROM journal_publications WHERE id=$delete_id";
    mysqli_query($conn, $sql);
    header("location: edit-principal-profile.php?id=$id");
}
if (isset($_GET['mode']) and $_GET['mode'] == "delete_conference") {
    $delete_id = $_GET['delete_id'];
    $sql = "delete FROM conference_publications WHERE id=$delete_id";
    mysqli_query($conn, $sql);
    header("location: edit-principal-profile.php?id=$id");
}
if (isset($_GET['mode']) and $_GET['mode'] == "delete_workshop") {
    $delete_id = $_GET['delete_id'];
    $sql = "delete FROM workshops WHERE id=$delete_id";
    mysqli_query($conn, $sql);
    header("location: edit-principal-profile.php?id=$id");
}
if (isset($_GET['mode']) and $_GET['mode'] == "delete_participate") {
    $delete_id = $_GET['delete_id'];
    $sql = "delete FROM conference_participated WHERE id=$delete_id";
    mysqli_query($conn, $sql);
    header("location: edit-principal-profile.php?id=$id");
}
if (isset($_GET['mode']) and $_GET['mode'] == "delete_awards") {
    $delete_id = $_GET['delete_id'];
    $sql = "delete FROM staff_awards_received WHERE id=$delete_id";
    mysqli_query($conn, $sql);
    header("location: edit-principal-profile.php?id=$id");
}
if (isset($_GET['mode']) and $_GET['mode'] == "delete_books") {
    $delete_id = $_GET['delete_id'];
    $sql = "delete FROM books_published WHERE id=$delete_id";
    mysqli_query($conn, $sql);
    header("location: edit-principal-profile.php?id=$id");
}
if (isset($_GET['mode']) and $_GET['mode'] == "delete_fund") {
    $delete_id = $_GET['delete_id'];
    $sql = "delete FROM funded_project WHERE id=$delete_id";
    mysqli_query($conn, $sql);
    header("location: edit-principal-profile.php?id=$id");

}
if (isset($_GET['mode']) and $_GET['mode'] == "delete_patents") {
    $delete_id = $_GET['delete_id'];
    $sql = "delete FROM patents_owned WHERE id=$delete_id";
    mysqli_query($conn, $sql);
    header("location: edit-principal-profile.php?id=$id");
}
if (isset($_GET['mode']) and $_GET['mode'] == "delete_consult") {
    $delete_id = $_GET['delete_id'];
    $sql = "delete FROM consultancy WHERE id=$delete_id";
    mysqli_query($conn, $sql);
    header("location: edit-principal-profile.php?id=$id");
}
if (isset($_GET['mode']) and $_GET['mode'] == "delete_activites") {
    $delete_id = $_GET['delete_id'];
    $sql = "delete FROM staff_other_activites WHERE id=$delete_id";
    mysqli_query($conn, $sql);
    header("location: edit-principal-profile.php?id=$id");
}
if (isset($_POST['submit1'])) {
 
    $full_name = trim($_POST['full_name']);

    $status = $_POST['status'];
    $password = trim($_POST['password']);
    $user_type="staff";
    $mobile = trim($_POST['mobile']);
    $address = trim($_POST['address']);
	$gender = trim($_POST['gender']);
    $dob = to_sql_date(trim($_POST['dob']));
    $joining = trim($_POST['joining']);

    $sql = "SELECT * FROM users WHERE trim(email)='$email' and id<>$id";
    $result = mysqli_query($conn, $sql);
    $count = mysqli_num_rows($result);

    if ($count >= 1) {
        $msg = "Username or Email already in use";
        $msg_color = "red";
    } else {
        $msg_color = "green";
        if($_SESSION['user_type']=="hod") {
            $msg = "Staff updated successfully";
        }
        $stmt = $conn->prepare("update users set full_name=?,status=?,password=?,mobile=?,address=?,dob=?,gender=?,joining=? where id=?");
        $stmt->bind_param("sssssssss", $full_name, $status, $password, $mobile, $address,$dob,$gender,$joining, $id);
        $stmt->execute();

        $file_name = $_FILES['photo']['name'];
        if (trim($file_name) != "") {
            $ext = pathinfo($file_name, PATHINFO_EXTENSION);
            $file_name = $id . "." . $ext;
            $query = "update users set photo = '" . $file_name . "' where id=$id";
            mysqli_query($conn, $query);
            $target_path = "photo/";
            $target_path = $target_path . $file_name;
            move_uploaded_file($_FILES['photo']['tmp_name'], $target_path);
        }

        header("location: department-staff.php");
    }

}
if (isset($_POST['submit2'])) {
    
    $qualification  = trim($_POST['qualification']);
    $specialization  = $_POST['specialization'];
    $school_college= trim($_POST['school_college']);
    $board_university= trim($_POST['board_university']);
    $year_of_passing = trim($_POST['year_of_passing']);
    $percentage = trim($_POST['percentage']);
    if ($_POST['submit2'] == "Update") {
        $edit_id = $_GET['edit_id'];
        $stmt = $conn->prepare("update staff_academic_qualification set qualification=?,specialization=?,school_college=?,board_university=?,year_of_passing=?,percentage=? where id=?");
        $stmt->bind_param("sssssss",$qualification,$specialization,$school_college,$board_university,$year_of_passing,$percentage, $edit_id);
       
        $stmt->execute();
    } 
   if ($_POST['submit2'] == "Save") {
         $stmt = $conn->prepare("insert into staff_academic_qualification (staff_id,qualification,specialization,school_college,board_university,year_of_passing,percentage) values (?,?,?,?,?,?,?) ");
        $stmt->bind_param("sssssss",$id,$qualification,$specialization,$school_college,$board_university,$year_of_passing,$percentage);
        $stmt->execute() or die($stmt->error());
       
    }
    header("location: edit-principal-profile.php?id=$id");    
}    
if (isset($_POST['submit3'])) {
    
    $institution  = trim($_POST['institution']);
    $designation  = $_POST['designation'];
    $duration= trim($_POST['duration']);
    $experience= trim($_POST['experience']);
     if ($_POST['submit3'] == "Update") {
        $edit_id = $_GET['edit_id'];

        $stmt = $conn->prepare("update teaching_experience set institution=?,designation=?,duration=?,experience=? where id=?");
        $stmt->bind_param("sssss",$institution,$designation,$duration,$experience, $edit_id);
       
        $stmt->execute();
    } 
	if ($_POST['submit3'] == "Save") {
         $stmt = $conn->prepare("insert into teaching_experience (staff_id,institution,designation,duration,experience) values (?,?,?,?,?) ");
        $stmt->bind_param("sssss",$id,$institution,$designation,$duration,$experience);
        $stmt->execute() or die($stmt->error());
       
    }
header("location: edit-principal-profile.php?id=$id");    
}    
if (isset($_POST['submit4'])) {
    
    $employer_name  = trim($_POST['employer_name']);
    $designation  = $_POST['designation'];
    $duration= trim($_POST['duration']);
    $experience= trim($_POST['experience']);
    
if ($_POST['submit4'] == "Update") {
        $edit_id = $_GET['edit_id'];
        $stmt = $conn->prepare("update other_experience set employer_name=?,designation=?,duration=?,experience=? where id=?");
        $stmt->bind_param("sssss",$employer_name,$designation,$duration,$experience, $edit_id);
       
        $stmt->execute();
    } 
	if ($_POST['submit4'] == "Save") {
         $stmt = $conn->prepare("insert into other_experience (staff_id,employer_name,designation,duration,experience) values (?,?,?,?,?) ");
        $stmt->bind_param("sssss",$id,$employer_name,$designation,$duration,$experience);
        $stmt->execute() or die($stmt->error());
       
    }
   header("location: edit-principal-profile.php?id=$id");    
}    
if (isset($_POST['submit5'])) {
    
    $title_name  = trim($_POST['title_name']);
    $journal_name  = $_POST['journal_name'];
    $authors_name= trim($_POST['authors_name']);
    $published_date= trim($_POST['published_date']);
    $national_international= trim($_POST['national_international']);
    $indexed_in= trim($_POST['indexed_in']);
	if ($_POST['submit5'] == "Update") {
        $edit_id = $_GET['edit_id'];

        $stmt = $conn->prepare("update journal_publications set title_name=?,journal_name=?,authors_name=?,published_date=?,national_international=?,indexed_in=? where id=?");
        $stmt->bind_param("sssssss",$title_name,$journal_name,$authors_name,$published_date,$national_international,$indexed_in,$edit_id);
       
        $stmt->execute();
    } 
	if ($_POST['submit5'] == "Save") {
         $stmt = $conn->prepare("insert into journal_publications (staff_id,title_name,journal_name,authors_name,published_date,national_international,indexed_in) values (?,?,?,?,?,?,?) ");
        $stmt->bind_param("sssssss",$id,$title_name,$journal_name,$authors_name,$published_date,$national_international,$indexed_in);
        $stmt->execute() or die($stmt->error());
       
    }
   header("location: edit-principal-profile.php?id=$id");    
}    
if (isset($_POST['submit6'])) {
    
    $title_name  = trim($_POST['title_name']);
    $authors_name= trim($_POST['authors_name']);
    $conference_name  = $_POST['conference_name'];
    $venue= trim($_POST['venue']);
    $date= trim($_POST['date']);
    $national_international= trim($_POST['national_international']);
    
    if ($_POST['submit6'] == "Update") {
        $edit_id = $_GET['edit_id'];

        $stmt = $conn->prepare("update conference_publications set title_name=?,authors_name=?,conference_name=?,venue=?,date=?,national_international=? where id=?");
        $stmt->bind_param("sssssss",$title_name,$authors_name,$conference_name,$venue,$date,$national_international,$edit_id);
       
        $stmt->execute();
    }
	if ($_POST['submit6'] == "Save") {
         $stmt = $conn->prepare("insert into conference_publications (staff_id,title_name,authors_name,conference_name,venue,date,national_international) values (?,?,?,?,?,?,?) ");
        $stmt->bind_param("sssssss",$id,$title_name,$authors_name,$conference_name,$venue,$date,$national_international);
        $stmt->execute() or die($stmt->error());
       
    }
    header("location:edit-principal-profile.php?id=$id");    
}    
if (isset($_POST['submit7'])) {
    
    $event_type  = trim($_POST['event_type']);
    $event_name= trim($_POST['event_name']);
    $role  = $_POST['role'];
    $date= trim($_POST['date']);
    $venue= trim($_POST['venue']);
    $national_international= trim($_POST['national_international']);
    if ($_POST['submit7'] == "Update") {
        $edit_id = $_GET['edit_id'];

        $stmt = $conn->prepare("update workshops set event_type=?,event_name=?,role=?,date=?,venue=?,national_international=? where id=?");
        $stmt->bind_param("sssssss",$event_type,$event_name,$role,$date,$venue,$national_international,$edit_id);
       
        $stmt->execute();
    }  if ($_POST['submit7'] == "Save") {
         $stmt = $conn->prepare("insert into workshops (staff_id,event_type,event_name,role,date,venue,national_international) values (?,?,?,?,?,?,?) ");
        $stmt->bind_param("sssssss",$id,$event_type,$event_name,$role,$date,$venue,$national_international);
        $stmt->execute() or die($stmt->error());
       
    }
    header("location:edit-principal-profile.php?id=$id");   
}   
if (isset($_POST['submit8'])) {
    
    $event_type  = trim($_POST['event_type']);
    $event_name= trim($_POST['event_name']);
    $role  = $_POST['role'];
    $date= trim($_POST['date']);
    $venue= trim($_POST['venue']);
    $national_international= trim($_POST['national_international']);
    if ($_POST['submit8'] == "Update") {
        $edit_id = $_GET['edit_id'];
        $stmt = $conn->prepare("update conference_participated set event_type=?,event_name=?,role=?,date=?,venue=?,national_international=? where id=?");
        $stmt->bind_param("sssssss",$event_type,$event_name,$role,$date,$venue,$national_international,$edit_id);
       
        $stmt->execute();
    } 
	 if ($_POST['submit8'] == "Save") {
         $stmt = $conn->prepare("insert into conference_participated (staff_id,event_type,event_name,role,date,venue,national_international) values (?,?,?,?,?,?,?) ");
        $stmt->bind_param("sssssss",$id,$event_type,$event_name,$role,$date,$venue,$national_international);
        $stmt->execute() or die($stmt->error());
       
    }
     header("location:edit-principal-profile.php?id=$id");    
}   
if (isset($_POST['submit9'])) {
$event_name  = trim($_POST['event_name']);
    $place  = $_POST['place'];
    $date= trim($_POST['date']);
    $awards_won=trim($_POST['awards_won']);
    if ($_POST['submit9'] == "Update") {
        $edit_id = $_GET['edit_id'];
        $stmt = $conn->prepare("update staff_awards_received set event_name=?,place=?,date=?,awards_won=? where id=?");
        $stmt->bind_param("sssss",$event_name,$place,$date,$awards_won,$edit_id);
       
        $stmt->execute();
    } 
   if ($_POST['submit9'] == "Save") {
         $stmt = $conn->prepare("insert into staff_awards_received(staff_id	,event_name,place,date,awards_won) values (?,?,?,?,?)");
        $stmt->bind_param("sssss",$id,$event_name,$place,$date,$awards_won);
        $stmt->execute() or die($stmt->error());
       
    }
    header("location: edit-principal-profile.php?id=$id");    
}    
if (isset($_POST['submit10'])) {
    
    $title  = trim($_POST['title']);
    $author  = $_POST['author'];
    $publisher= trim($_POST['publisher']);
    $isbn_no= trim($_POST['isbn_no']);
    $year_of_passing = trim($_POST['year_of_passing']);
    $percentage = trim($_POST['percentage']);
    if ($_POST['submit10'] == "Update") {
        $edit_id = $_GET['edit_id'];
        $stmt = $conn->prepare("update books_published set title=?,author=?,publisher=?,isbn_no=? where id=?");
        $stmt->bind_param("sssss",$title,$author,$publisher,$isbn_no,$edit_id);
       
        $stmt->execute();
    } 
   if ($_POST['submit10'] == "Save") {
         $stmt = $conn->prepare("insert into books_published (staff_id,title,author,publisher,isbn_no) values (?,?,?,?,?) ");
        $stmt->bind_param("sssss",$id,$title,$author,$publisher,$isbn_no);
        $stmt->execute() or die($stmt->error());
       
    }
    header("location: edit-principal-profile.php?id=$id");    
}    
if (isset($_POST['submit11'])) {
    
    $title  = trim($_POST['title']);
    $agency  = $_POST['agency'];
    $approval_date= trim($_POST['approval_date']);
    
    if ($_POST['submit11'] == "Update") {
        $edit_id = $_GET['edit_id'];
        $stmt = $conn->prepare("update funded_project set title=?,agency=?,approval_date=? where id=?");
        $stmt->bind_param("ssss",$title,$agency,$approval_date,$edit_id);
       
        $stmt->execute();
    } 
   if ($_POST['submit11'] == "Save") {
         $stmt = $conn->prepare("insert into funded_project (staff_id,title,agency,approval_date) values (?,?,?,?) ");
        $stmt->bind_param("ssss",$id,$title,$agency,$approval_date);
        $stmt->execute() or die($stmt->error());
       
    }
    header("location: edit-principal-profile.php?id=$id");    
}    
if (isset($_POST['submit12'])) {
    
    $inventor  = trim($_POST['inventor']);
    $title  = $_POST['title'];
    $reg_no= trim($_POST['reg_no']);
    $national_international=trim($_POST['national_international']);
    if ($_POST['submit12'] == "Update") {
        $edit_id = $_GET['edit_id'];
        $stmt = $conn->prepare("update patents_owned set inventor=?,title=?,reg_no=?,national_international=? where id=?");
        $stmt->bind_param("sssss",$inventor,$title,$reg_no,$national_international,$edit_id);
       
        $stmt->execute();
    } 
   if ($_POST['submit12'] == "Save") {
         $stmt = $conn->prepare("insert into patents_owned (staff_id,inventor,title,reg_no,national_international) values (?,?,?,?,?) ");
        $stmt->bind_param("sssss",$id,$inventor,$title,$reg_no,$national_international);
        $stmt->execute() or die($stmt->error());
       
    }
    header("location: edit-principal-profile.php?id=$id");    
}
if (isset($_POST['submit13'])) {

    $consultant = trim($_POST['consultant']);
    $wrk_title = trim($_POST['wrk_title']);
    $place = trim($_POST['place']);
    $duration = trim($_POST['duration']);
    $fund_generator = trim($_POST['fund_generator']);

    if ($_POST['submit13'] == "Update") {
        $edit_id = $_GET['edit_id'];


        $stmt = $conn->prepare("update consultancy set consultant=?,wrk_title=?,place=?,duration=?,fund_generator=? where id=?");
        $stmt->bind_param("ssssss", $consultant,$wrk_title, $place, $duration, $fund_generator, $edit_id);

        $stmt->execute();
    }
    if ($_POST['submit13'] == "Save"){
        $stmt = $conn->prepare("insert into consultancy (staff_id,consultant,wrk_title,place,duration,fund_generator) values (?,?,?,?,?,?) ");
        $stmt->bind_param("ssssss", $id, $consultant, $wrk_title,$place, $duration, $fund_generator);
        $stmt->execute() or die($stmt->error());

    }
    header("location: edit-principal-profile.php?id=$id");
}
if (isset($_POST['submit14'])) {

    $name = trim($_POST['name']);
    $place = trim($_POST['place']);
    $date = trim($_POST['date']);
    $participated = trim($_POST['participated']);

if ($_POST['submit14'] == "Update") {
    $edit_id = $_GET['edit_id'];


        $stmt = $conn->prepare("update staff_other_activites set name=?,place=?,date=?,participated=? where id=?");
        $stmt->bind_param("sssss", $name, $place, $date, $participated, $edit_id);

        $stmt->execute();
    }
	if ($_POST['submit14'] == "Save"){
        $stmt = $conn->prepare("insert into staff_other_activites (staff_id,name,place,date,participated) values (?,?,?,?,?) ");
        $stmt->bind_param("sssss", $id, $name, $place, $date, $participated);
        $stmt->execute() or die($stmt->error());

    }
    header("location: edit-principal-profile.php?id=$id");
}
$sql = "select * from users where id=$id";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);


?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
    <meta name="verify-v1" content="6B3y4s/8lqrlu1M/yeMugXMxLtqtqvwOXzLbITqJ/uo="/>
    <meta name="google-site-verification" content="googlebd8cfab076918140.html"/>
    <meta name="msvalidate.01" content="D1CE168B57E8F9F05ADC116577A326D6"/>
    <meta name="y_key" content="df78493c50835a76"/>
    <meta name="p:domain_verify" content="9e5459b8f3ce92678554bccd357e8965"/>

    <meta name="keywords" content="Department of EEE,EEE department St.Xaviers,EEE dept St.xaviers"/>
    <meta name="description" content="Department of EEE,St.Xavier's Catholic College of Engineering "/>
    <meta name="author" content=""/>
    <meta name="keyphrases" content=""/>
    <meta name="copyright" content="2016 EEE Department,St.Xavier's"/>
    <meta name="url" content="index.html"/>
    <meta name="identifier-URL" content="index.html"/>

    <meta name="RankWords" content=""/>
    <meta name="googlebot" content="noodp"/>
    <meta name="Slurp" content="noydir, noodp"/>
    <meta name="msnbot" content="noodp"/>
    <meta name="robots" content="index,follow"/>

    <meta name="og:title" content="Department of EEE|St.Xavier's Catholic College of Engineering">
    <meta name="og:url" content="index.html">
    <meta name="og:description" content="">
    <meta name="og:type" content="article">
    <meta name="og:image" content="">
    <meta name="og:site_name" content="2016 EEE Department,St.Xavier's">
    <meta name="HandheldFriendly" content="True"/>
    <meta name="MobileOptimized" content="320"/>

    <meta name="DC.title" content="Department of EEE|St.Xavier's Catholic College of Engineering"/>
    <meta name="DC.description" content=""/>
    <meta name="DC.creator" content=""/>
    <meta name="DC.publisher" content=""/>

    <title>Edit Staff St.Xavier's Catholic College of Engineering-Chunkankadai</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/custom.css" rel="stylesheet">
    <link href="css/homebanner.css" rel="stylesheet">
    <link href="css/screens.css" rel="stylesheet">

    <noscript>
        <link rel="stylesheet" type="text/css" href="css/nojs.css"/>
    </noscript>

    <!-- Custom Fonts -->
    <link href="css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <script src="js/html5shiv.js"></script>
    <script src="js/respond.js"></script>
    <![endif]-->
    <link href="images/favicon.ico" rel="shortcut icon" type="image/x-icon"/>

</head>

<body>
<!-- Top Section -->
<script language="javascript" type="text/javascript">


    function formHandler(form) {
        var URL = document.form1.year.options[document.form1.year.selectedIndex].value;
        window.location.href = URL;
    }
    // End -->
</script>
<?php include("login-header.php"); ?>

<!-- Navigation Section-->
<?php include("login-menu.php"); ?>
<br/>
<div class="container">
    <div class="row">

        <div class="col-md-12">
            <div class="panel-group panel-dark" id="accordion">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#a" class="collapsed">
                                <i class="glyphicon glyphicon-chevron-down"></i>User Profile
													</a>
												</h4>
											</div>
											
											<div id="a" class="panel-collapse collapse">
											<form method="post" action="" enctype="multipart/form-data">	
												<div class="panel-body">
		
                                        <div class="form-group">
                                            <label for="full_name required"
                                                class="control-label required">Staff Name</label>
                                                    <input value="<?php echo $row['full_name']; ?>" required="required" type="text"
                                                           maxlength="50"
                                                           name="full_name" id="full_name" class="form-control"
                                                           placeholder="Full Name">
                                        </div>
										<div class="form-group">
                                            <label for="gender" class="control-label required">Gender</label>
                                            <input value="<?php echo $row['gender']; ?>" required="required" maxlength="50" type="text"
                                                   name="gender" class="form-control" placeholder="Gender">
                                        </div>
										
										<div class="form-group">
                                            <label for="dob" class="control-label required">Date of Birth</label>
                                            <input readonly value="<?php echo $row['dob']; ?>" required="required" maxlength="50" type="text"
                                                   name="dob" class="form-control" placeholder="Date of Birth">
                                        </div>
                                        <div class="form-group">
                                            <label for="email" class="control-label required">Email</label>
                                            <input readonly value="<?php echo $row['email']; ?>" required="required" maxlength="50" type="text"
                                                   name="email" class="form-control" placeholder="Email">
                                        </div>

                                        <div class="form-group">
                                            <label for="password" class="control-label required">Password</label>
                                            <input value="<?php echo $row['password']; ?>" required="required" type="text" maxlength="20"
                                                   name="password" id="password" class="form-control"
                                                   placeholder="Password">
                                        </div>

                                        
                                        <div class="form-group">
                                            <label for="mobile" class="control-label">Mobile</label>
                                            <input value="<?php echo $row['mobile']; ?>" maxlength="20"
                                                   name="mobile" class="form-control" placeholder="Mobile">
                                        </div>

                                        <div class="form-group">
                                            <label for="mobile" class="control-label">Address</label>
                                            <textarea maxlength="200" name="address" class="form-control"
                                                      placeholder="Address"><?php echo $row['address']; ?></textarea>
                                        </div>
										<div class="form-group">
                                            <label for="joining" class="control-label required">Joining Year</label>
                                            <input readonly value="<?php echo $row['joining']; ?>" required="required" maxlength="50" type="text"
                                                   name="joining" class="form-control" placeholder="joining year">
                                        </div>

                                         <div class="form-group">
                                                <label for="status" class="control-label required">Status</label>
                                                <select name="status" id="status" class="form-control">
                                                    <option <?php if ($row['status'] == "Active") echo " selected='selected'"; ?>
                                                        value="Active">Active
                                                    </option>
                                                    <option <?php if ($row['status'] == "Alumni") echo " selected='selected'"; ?>
                                                        value="Alumni">Alumni
                                                    </option>
                                                </select>
                                            </div>
                                          <div class="form-group">

                                            <label for="photo" class="control-label">Photo</label>

                                            <input name="photo" class="form-control" type="file">

                                        </div>
									
										
                                         <div class="form-group text-center">
                                        <?php
                                        if (isset($_GET['mode']) and $_GET['mode'] == "edit_quali") {
                                            ?>
                                            <input required="required" class="btn btn-info"
                                                   type="submit"
                                                   name="submit1" value="Update"/>
                                            <?php
                                        } else {
                                            ?>
                                            <input required="required" class="btn btn-info"
                                                   type="submit"
                                                   name="submit1" value="Save"/>
                                            <?php
                                        }
                                        ?>
                                        <a href="edit-principal-profile.php" class="btn btn-info">Back</a>
                                </div>
                            </div>

                    </div>
                </div>

                </form>

               <?php
                $qualification = "";
				$specialization = "";
                $school_college = "";
                $board_university = "";
                $year_of_passing = "";
                $percentage = "";
                if (isset($_GET['mode']) and $_GET['mode'] == "edit_quali") {
                    $edit_id = $_GET['edit_id'];
                    $sql = "select * from staff_academic_qualification where id=$edit_id";
                    $result = mysqli_query($conn, $sql);
                    $row = mysqli_fetch_assoc($result);
                    $qualification = $row['qualification'];
					$specialization = $row['specialization'];
                    $school_college = $row['school_college'];
                    $board_university = $row['board_university'];
                    $year_of_passing = $row['year_of_passing'];
                    $percentage = $row['percentage'];
                }
?>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" class="collapsed">
                                <i class="glyphicon glyphicon-chevron-down"></i>Academic Qualifications :
                            </a>
                        </h4>
						
                    </div>

                    <div id="collapseOne" class="panel-collapse collapse">
                        <form method="post" action="" enctype="multipart/form-data">
                         <div class="col-md-12"><br>
                    <div class="table-responsive">
						<table class="table table-bordered table-striped">
                                <thead>
                        <tr style="background-color: #81888c;color:white" >
                                    <th>Qualification</th>
									<th>Specialization</th>
                                    <th>Name Of the School/College</th>
                                    <th>Board/University</th>
                                    <th>Year of passing</th>
                                    <th>Percentage</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $sql = "select * from staff_academic_qualification where staff_id=$id";
                                $result = mysqli_query($conn, $sql);
                                while ($row = mysqli_fetch_assoc($result)) {
                                    ?>
                                    <tr>
                                        <td><?php echo $row['qualification']; ?></td>
										<td><?php echo $row['specialization']; ?></td>
                                        <td><?php echo $row['school_college']; ?></td>
                                        <td><?php echo $row['board_university']; ?></td>
                                        <td><?php echo $row['year_of_passing']; ?></td>

                                        <td><?php echo $row['percentage']; ?></td>
                                        <td width="50px" style="text-align:right"><a class="btn btn-info"
                                                                                     href="edit-principal-profile.php?id=<?php echo $id; ?>&mode=edit_quali&edit_id=<?php echo $row['id']; ?>">
                                                &nbsp;Edit</a></td>
                                        <td width="50px" style="text-align:right"><a class="btn btn-danger"
                                                                                     href="edit-principal-profile.php?id=<?php echo $id; ?>&mode=delete_quali&delete_id=<?php echo $row['id']; ?>">
                                                &nbsp;Delete</a></td>

                                    </tr>
                                    <?php
                                }
                                ?>
                                </tbody>
                            </table>
                            <div class="panel-body">


                                <div class="form-group">
                                        <div class="form-group">
                                            <label for="qualification required"
                                                   class="control-label required"> Qualification</label>
                                            <input value="<?php echo $qualification; ?>" required="required" type="text"
                                                   maxlength="50"
                                                   name="qualification" id="qualification" class="form-control"
                                                   placeholder="qualification">
                                        </div>
                                    
                                        <div class="form-group">
                                            <label for="specialization" class="control-label required">Specialization</label>
                                            <input value="<?php echo $specialization; ?>" required="required" maxlength="50" type="text"
                                                   name="specialization" class="form-control" placeholder="specialization">
                                        </div>

                                        <div class="form-group">
                                            <label for="school_college" class="control-label required">School/College</label>
                                            <input value="<?php echo $school_college; ?>" required="required" type="text" maxlength="20"
                                                   name="school_college" id="school_college" class="form-control"
                                                   placeholder="School/College">
                                        </div>

                                      
                                        
                                        <div class="form-group">
                                            <label for="board_university" class="control-label">Board/University</label>
                                            <input value="<?php echo $board_university; ?>" maxlength="20"
                                                   name="board_university" class="form-control" placeholder="Board/University">
                                        </div>

                                        <div class="form-group">
                                            <label for="year_of_passing" class="control-label">Year of passing</label>
                                            <input type="text" value="<?php echo $year_of_passing; ?>" maxlength="20" name="year_of_passing" class="form-control"
                                                      placeholder="Year of passing">
                                        </div>
										
										<div class="form-group">
                                            <label for="percentage" class="control-label">Percentage</label>
                                            <input type="number" value="<?php echo $percentage; ?>" maxlength="20" name="percentage" class="form-control"
                                                      placeholder="percentage">
                                        </div>
										
                                         <div class="form-group text-center">
                                        <?php
                                        if (isset($_GET['mode']) and $_GET['mode'] == "edit_quali") {
                                            ?>
                                            <input required="required" class="btn btn-info"
                                                   type="submit"
                                                   name="submit2" value="Update"/>
                                            <?php
                                        } else {
                                            ?>
                                            <input required="required" class="btn btn-info"
                                                   type="submit"
                                                   name="submit2" value="Save"/>
                                            <?php
                                        }
                                        ?>
                                        <a href="edit-principal-profile.php" class="btn btn-info">Back</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                   </div>
			   </form>
            </div>
        </div>


               <?php   
               $institution  = "";
               $designation  = "";
               $duration= "";
               $experience= "";
               if (isset($_GET['mode']) and $_GET['mode'] == "edit_teaching") {
                    $edit_id = $_GET['edit_id'];
                    $sql = "select * from teaching_experience where id=$edit_id";
                    $result = mysqli_query($conn, $sql);
                    $row = mysqli_fetch_assoc($result);
                    $institution = $row['institution'];
					$designation = $row['designation'];
                    $duration = $row['duration'];
                    $experience = $row['experience'];
	 }
?>         
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" class="collapsed">
                                <i class="glyphicon glyphicon-chevron-down"></i> Teaching Experience 
                            </a>
                        </h4>
                    </div>
                    <div id="collapseTwo" class="panel-collapse collapse">
                        <form method="post" action="" enctype="multipart/form-data">
                    <div class="col-md-12"><br>
                    <div class="table-responsive">
						<table class="table table-bordered table-striped">
                                <thead>
                        <tr style="background-color: #81888c;color:white" >
                                   <th>Name of the institution</th>
									<th>Designation</th>
                                    <th>Duration</th>
                                    <th>Experience in Years</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $sql = "select * from teaching_experience where staff_id=$id";
                                $result = mysqli_query($conn, $sql);
                                while ($row = mysqli_fetch_assoc($result)) {
                                    ?>
                                    <tr>
                                        <td><?php echo $row['institution']; ?></td>
										<td><?php echo $row['designation']; ?></td>
                                        <td><?php echo $row['duration']; ?></td>
                                        
                                        <td><?php echo $row['experience']; ?></td>

                                        <td width="50px" style="text-align:right"><a class="btn btn-info"
                                                                                     href="edit-principal-profile.php?id=<?php echo $id; ?>&mode=edit_teaching&edit_id=<?php echo $row['id']; ?>">
                                                &nbsp;Edit</a></td>
                                        <td width="50px" style="text-align:right"><a class="btn btn-danger"
                                                                                     href="edit-principal-profile.php?id=<?php echo $id; ?>&mode=delete_teaching&delete_id=<?php echo $row['id']; ?>">
                                                &nbsp;Delete</a></td>

                                    </tr>
                                    <?php
                                }
                                ?>
                                </tbody>
                            </table>
                            <div class="panel-body">

                                <div class="form-group">
                                       
                                         <div class="form-group">
                                            <label for="institution" class="control-label required">Institution</label>
                                            <input value="<?php echo $institution; ?>" required="required" type="text" maxlength="20"
                                                   name="institution" id="institution" class="form-control"
                                                   placeholder="Institution">
                                        </div>

                                        <div class="form-group">
                                            <label for="designation" class="control-label required">Designation</label>
                                            <input value="<?php echo $designation; ?>" required="required" maxlength="50" type="text"
                                                   name="designation" class="form-control" placeholder="designation">
                                        </div>

                                        <div class="form-group">
                                            <label for="Duration" class="control-label required">Duration</label>
                                            <input value="<?php echo $duration; ?>" required="required" type="text" maxlength="20"
                                                   name="duration" id="duration" class="form-control"
                                                   placeholder="Duration">
                                        </div>

                                      
                                        
                                        <div class="form-group">
                                            <label for="Experience" class="control-label">Experience in Years</label>
                                            <input value="<?php echo $experience; ?>" maxlength="20" type="number"
                                                   name="experience" class="form-control" placeholder="Experience">
                                        </div>

                                         <div class="form-group text-center">
                                        <?php
                                        if (isset($_GET['mode']) and $_GET['mode'] == "edit_teaching") {
                                            ?>
                                            <input required="required" class="btn btn-info"
                                                   type="submit"
                                                   name="submit3" value="Update"/>
                                            <?php
                                        } else {
                                            ?>
                                            <input required="required" class="btn btn-info"
                                                   type="submit"
                                                   name="submit3" value="Save"/>
                                            <?php
                                        }
                                        ?>
                                        <a href="edit-principal-profile.php" class="btn btn-info">Back</a>
                                     </div>
                                </div>
                            </div>
                        </div>
                   </div>
			   </form>
            </div>
        </div>

                <?php   
                $employer_name  = "";
                $designation  = "";
                $duration= "";
                $experience= "";
                if (isset($_GET['mode']) and $_GET['mode'] == "edit_industry") {
                    $edit_id = $_GET['edit_id'];
                    $sql = "select * from other_experience where id=$edit_id";
                    $result = mysqli_query($conn, $sql);
                    $row = mysqli_fetch_assoc($result);
                    $employer_name = $row['employer_name'];
					$designation = $row['designation'];
                    $duration = $row['duration'];
                    $experience = $row['experience'];
	}
?>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree" class="collapsed">
                                <i class="glyphicon glyphicon-chevron-down"></i> Industry / other Experience
                            </a>
                        </h4>
                    </div>
                    <div id="collapseThree" class="panel-collapse collapse">
                        <form method="post" action="" enctype="multipart/form-data">
                            <div class="col-md-12"><br>
                    <div class="table-responsive">
						<table class="table table-bordered table-striped">
                                <thead>
                        <tr style="background-color: #81888c;color:white" >
                                    <th>Name of the Employer</th>
									<th>Designation</th>
                                    <th>Duration</th>
                                    <th>Experience in Years</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $sql = "select * from other_experience where staff_id=$id";
                                $result = mysqli_query($conn, $sql);
                                while ($row = mysqli_fetch_assoc($result)) {
                                    ?>
                                    <tr>
                                        <td><?php echo $row['employer_name']; ?></td>
										<td><?php echo $row['designation']; ?></td>
                                        <td><?php echo $row['duration']; ?></td>
                                        
                                        <td><?php echo $row['experience']; ?></td>

                                        <td width="50px" style="text-align:right"><a class="btn btn-info"
                                                                                     href="edit-principal-profile.php?id=<?php echo $id; ?>&mode=edit_industry&edit_id=<?php echo $row['id']; ?>">
                                                &nbsp;Edit</a></td>
                                        <td width="50px" style="text-align:right"><a class="btn btn-danger"
                                                                                     href="edit-principal-profile.php?id=<?php echo $id; ?>&mode=delete_industry&delete_id=<?php echo $row['id']; ?>">
                                                &nbsp;Delete</a></td>

                                    </tr>
                                    <?php
                                }
                                ?>
                                </tbody>
                            </table>
                            <div class="panel-body">

                                <div class="form-group">
                                        <div class="form-group">
                                           <label for="employer_name required"
                                                       class="control-label required"> Name of the Employer</label>
                                                <input value=" <?php echo $employer_name; ?>"required="required" type="text"
                                                       maxlength="50"
                                                       name="employer_name" id="employer_name" class="form-control"
                                                       placeholder="Name of the Employer">
                                            </div>
                                        <div class="form-group">
                                            <label for="designation" class="control-label required">Designation</label>
                                            <input value="<?php echo $designation; ?>" required="required" maxlength="50" type="text"
                                                   name="designation" class="form-control" placeholder="designation">
                                        </div>

                                        <div class="form-group">
                                            <label for="Duration" class="control-label required">Duration</label>
                                            <input value="<?php echo $duration; ?>" required="required" type="text" maxlength="20"
                                                   name="duration" id="duration" class="form-control"
                                                   placeholder="Duration">
                                        </div>

                                      
                                        
                                        <div class="form-group">
                                            <label for="Experience" class="control-label">Experience in Years</label>
                                            <input value="<?php echo $experience; ?>" maxlength="20" type="number"
                                                   name="experience" class="form-control" placeholder="Experience">
                                        </div>
                                       <div class="form-group text-center">
                                        <?php
                                        if (isset($_GET['mode']) and $_GET['mode'] == "edit_industry") {
                                            ?>
                                            <input required="required" class="btn btn-info"
                                                   type="submit"
                                                   name="submit4" value="Update"/>
                                            <?php
                                        } else {
                                            ?>
                                            <input required="required" class="btn btn-info"
                                                   type="submit"
                                                   name="submit4" value="Save"/>
                                            <?php
                                        }
                                        ?>
                                        <a href="edit-principal-profile.php" class="btn btn-info">Back</a>
                                     </div>
                                </div>
                            </div>
                        </div>
                   </div>
			   </form>
            </div>
        </div>

               <?php   
               $title_name  = "";
               $journal_name  = "";
               $authors_name= "";
               $published_date= "";
               $national_international= "";
               $indexed_in= "";
		if (isset($_GET['mode']) and $_GET['mode'] == "edit_journal") {
                    $edit_id = $_GET['edit_id'];
                    $sql = "select * from journal_publications where id=$edit_id";
                    $result = mysqli_query($conn, $sql);
                    $row = mysqli_fetch_assoc($result);
                    $title_name = $row['title_name'];
					$journal_name = $row['journal_name'];
                    $authors_name = $row['authors_name'];
                    $published_date = $row['published_date'];
					$national_international = $row['national_international'];
					$indexed_in = $row['indexed_in'];
		}
?>   	
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseFour" class="collapsed">
                                <i class="glyphicon glyphicon-chevron-down"></i> Journal Publications
                            </a>
                        </h4>
                    </div>
                    <div id="collapseFour" class="panel-collapse collapse">
                        <form method="post" action="" enctype="multipart/form-data">
                            <div class="col-md-12"><br>
                    <div class="table-responsive">
						<table class="table table-bordered table-striped">
                                <thead>
                        <tr style="background-color: #81888c;color:white" >
                                    <th>Name of the Title</th>
									<th>Journal Name</th>
                                    <th>Name of the Authors</th>
                                    <th>Published Date</th>
									<th>National/International</th>
									<th>Indexed In</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $sql = "select * from journal_publications where staff_id=$id";
                                $result = mysqli_query($conn, $sql);
                                while ($row = mysqli_fetch_assoc($result)) {
                                    ?>
                                    <tr>
                                        <td><?php echo $row['title_name']; ?></td>
										<td><?php echo $row['journal_name']; ?></td>
                                        <td><?php echo $row['authors_name']; ?></td>
                                        <td><?php echo $row['published_date']; ?></td>
                                        <td><?php echo $row['national_international']; ?></td>
										<td><?php echo $row['indexed_in']; ?></td>
                                        <td width="50px" style="text-align:right"><a class="btn btn-info"
                                                                                     href="edit-principal-profile.php?id=<?php echo $id; ?>&mode=edit_journal&edit_id=<?php echo $row['id']; ?>">
                                                &nbsp;Edit</a></td>
                                        <td width="50px" style="text-align:right"><a class="btn btn-danger"
                                                                                     href="edit-principal-profile.php?id=<?php echo $id; ?>&mode=delete_journal&delete_id=<?php echo $row['id']; ?>">
                                                &nbsp;Delete</a></td>

                                    </tr>
                                    <?php
                                }
                                ?>
                                </tbody>
                            </table>
                            <div class="panel-body">

                                <div class="form-group">
                                        <div class="form-group">
                                            <label for="title_name required"
                                                       class="control-label required"> Name of the Title</label>
                                                <input value=" <?php echo $title_name; ?>"required="required" type="text"
                                                       maxlength="50"
                                                       name="title_name" id="title_name" class="form-control"
                                                       placeholder="Name of the Title">
                                            </div>
                                        <div class="form-group">
                                            <label for="journal_name" class="control-label required">Journal Name</label>
                                            <input value="<?php echo $journal_name; ?>" required="required" maxlength="50" type="text"
                                                   name="journal_name" class="form-control" placeholder="journal_name">
                                        </div>

                                        <div class="form-group">
                                            <label for="authors_name" class="control-label required">Name of the Authors</label>
                                            <input value="<?php echo $authors_name; ?>" required="required" type="text" maxlength="20"
                                                   name="authors_name" id="authors_name" class="form-control"
                                                   placeholder="Name of the Authors">
                                        </div>

                                      
                                        
                                        <div class="form-group">
                                    <label for="published_date" class="control-label">Published Date</label>
                                            <input  readonly id="datepicker3" value="<?php echo $published_date; ?>" maxlength="20"
                                                   name="published_date" class="form-control" placeholder="Published Date">
                                        </div>

                                         <div class="form-group">
                                                <label for="national_international" class="control-label required">National/International</label>
                                                <select name="national_international" id="national_international" class="form-control">
                                                    <option <?php if ($row['national_international'] == "National") echo " selected='selected'"; ?>
                                                        value="National">National
                                                    </option>
                                                    <option <?php if ($row['national_international'] == "International") echo " selected='selected'"; ?>
                                                        value="International">International
                                                    </option>
                                                </select>
                                            </div>

										
                                        <div class="form-group">
                                            <label for="indexed_in" class="control-label">
                                                Indexed In</label>
                                            <input value="<?php echo $indexed_in; ?>" maxlength="20"
                                                   name="indexed_in" class="form-control" placeholder="indexed_in">
                                        </div>
										<div class="form-group text-center">
                                        <?php
                                        if (isset($_GET['mode']) and $_GET['mode'] == "edit_journal") {
                                            ?>
                                            <input required="required" class="btn btn-info"
                                                   type="submit"
                                                   name="submit5" value="Update"/>
                                            <?php
                                        } else {
                                            ?>
                                            <input required="required" class="btn btn-info"
                                                   type="submit"
                                                   name="submit5" value="Save"/>
                                            <?php
                                        }
                                        ?>
                                        <a href="edit-principal-profile.php" class="btn btn-info">Back</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                   </div>
			   </form>
            </div>
        </div>

                <?php   
                $title_name  = "";
                $authors_name= "";
                $conference_name  = "";
                $venue= "";
                $date= "";
                $national_international= "";
                if (isset($_GET['mode']) and $_GET['mode'] == "edit_conference") {
                    $edit_id = $_GET['edit_id'];
                    $sql = "select * from conference_publications where id=$edit_id";
                    $result = mysqli_query($conn, $sql);
                    $row = mysqli_fetch_assoc($result);
                    $title_name = $row['title_name'];
                    $authors_name = $row['authors_name'];
					$conference_name  = $row['conference_name'];
					$venue = $row['venue'];
                    $date = $row['date'];
					$national_international = $row['national_international'];
					
	}

?>  
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseFive" class="collapsed">
                                <i class="glyphicon glyphicon-chevron-down"></i> Conference Publications
                            </a>
                        </h4>
                    </div>
                    <div id="collapseFive" class="panel-collapse collapse">
                        <form method="post" action="" enctype="multipart/form-data">
                            <div class="col-md-12"><br>
                    <div class="table-responsive">
						<table class="table table-bordered table-striped">
                                <thead>
                        <tr style="background-color: #81888c;color:white" >
                                    <th>Name of the Title</th>
                                    <th>Name of the Authors</th>
									<th>Conference Name</th>
									<th>Venue</th>
                                    <th>Date</th>
									<th>National/International</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $sql = "select * from conference_publications where staff_id=$id";
                                $result = mysqli_query($conn, $sql);
                                while ($row = mysqli_fetch_assoc($result)) {
                                    ?>
                                    <tr>
                                        <td><?php echo $row['title_name']; ?></td>
                                        <td><?php echo $row['authors_name']; ?></td>
										<td><?php echo $row['conference_name']; ?></td>
										<td><?php echo $row['venue']; ?></td>
                                        <td><?php echo $row['date']; ?></td>
                                        <td><?php echo $row['national_international']; ?></td>
										
                                        <td width="50px" style="text-align:right"><a class="btn btn-info"
                                                                                     href="edit-principal-profile.php?id=<?php echo $id; ?>&mode=edit_conference&edit_id=<?php echo $row['id']; ?>">
                                                &nbsp;Edit</a></td>
                                        <td width="50px" style="text-align:right"><a class="btn btn-danger"
                                                                                     href="edit-principal-profile.php?id=<?php echo $id; ?>&mode=delete_conference&delete_id=<?php echo $row['id']; ?>">
                                                &nbsp;Delete</a></td>

                                    </tr>
                                    <?php
                                }
                                ?>
                                </tbody>
                            </table>
                            <div class="panel-body">
                                <div class="form-group">
                                        <div class="form-group">
                                           <label for="title_name required"
                                                       class="control-label required"> Name of the Title</label>
                                                <input value=" <?php echo $title_name; ?>"required="required" type="text"
                                                       maxlength="50"
                                                       name="title_name" id="title_name" class="form-control"
                                                       placeholder="Name of the Title">
                                            </div>
                                        <div class="form-group">
                                            <label for="authors_name" class="control-label required">Name of the Authors</label>
                                            <input value="<?php echo $authors_name; ?>" required="required" type="text" maxlength="20"
                                                   name="authors_name" id="authors_name" class="form-control"
                                                   placeholder="Name of the Authors">
                                        </div>
                                        <div class="form-group">
                                            <label for="conference_name" class="control-label required">Conference Name</label>
                                            <input value="<?php echo $conference_name; ?>" required="required" maxlength="50" type="text"
                                                   name="conference_name" class="form-control" placeholder="Conference Name">
                                        </div>


                                      <div class="form-group">
                                            <label for="Venue" class="control-label">
                                               Venue</label>
                                            <input value="<?php echo $venue; ?>" maxlength="20"
                                                   name="venue" class="form-control" placeholder="venue">
                                        </div>

                                        
                                        <div class="form-group">
                                    <label for="date" class="control-label">Date</label>
                                            <input value="<?php echo $date; ?>" maxlength="20"
                                                   name="date"  readonly id="datepicker4"class="form-control" placeholder="Date">
                                        </div>

                                         <div class="form-group">
                                                <label for="national_international" class="control-label required">National/International</label>
                                                <select name="national_international" id="national_international" class="form-control">
                                                    <option <?php if ($row['national_international'] == "National") echo " selected='selected'"; ?>
                                                        value="National">National
                                                    </option>
                                                    <option <?php if ($row['national_international'] == "International") echo " selected='selected'"; ?>
                                                        value="International">International
                                                    </option>
                                                </select>
                                            </div>

                                        <div class="form-group text-center">
                                        <?php
                                        if (isset($_GET['mode']) and $_GET['mode'] == "edit_conference") {
                                            ?>
                                            <input required="required" class="btn btn-info"
                                                   type="submit"
                                                   name="submit6" value="Update"/>
                                            <?php
                                        } else {
                                            ?>
                                            <input required="required" class="btn btn-info"
                                                   type="submit"
                                                   name="submit6" value="Save"/>
                                            <?php
                                        }
                                        ?>
                                        <a href="edit-principal-profile.php" class="btn btn-info">Back</a>
                                      </div>
                                </div>
                            </div>
                        </div>
                   </div>
			   </form>
            </div>
        </div>
                <?php   
                $event_type  ="";
                $event_name= "";
                $role  = "";
                $date= "";
                $venue= "";
                $national_international= "";
                if (isset($_GET['mode']) and $_GET['mode'] == "edit_workshop") {
                    $edit_id = $_GET['edit_id'];
                    $sql = "select * from workshops where id=$edit_id";
                    $result = mysqli_query($conn, $sql);
                    $row = mysqli_fetch_assoc($result);
                    $event_type = $row['event_type'];
                    $event_name = $row['event_name'];
					$role  = $row['role'];
                    $date = $row['date'];
					$venue = $row['venue'];
					$national_international = $row['national_international'];
					
	}

?>  
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseSix" class="collapsed">
                                <i class="glyphicon glyphicon-chevron-down"></i> Workshops/seminars/FDPs/Conference organized
                            </a>
                        </h4>
                    </div>
                    <div id="collapseSix" class="panel-collapse collapse">
                        <form method="post" action="" enctype="multipart/form-data">
                           <div class="col-md-12"><br>
                    <div class="table-responsive">
						<table class="table table-bordered table-striped">
                                <thead>
                        <tr style="background-color: #81888c;color:white" >
                                     <th>Event Type</th>
                                    <th>Name of the Event</th>
									<th>Role</th>
                                    <th>Date</th>
									<th>Venue</th>
									<th>National/International</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                                </thead>
                                <tbody>
                               <?php
                                $sql = "select * from workshops where staff_id=$id";
                                $result = mysqli_query($conn, $sql);
                                while ($row = mysqli_fetch_assoc($result)) {
                                    ?>
                                    <tr>
                                        <td><?php echo $row['event_type']; ?></td>
                                        <td><?php echo $row['event_name']; ?></td>
										<td><?php echo $row['role']; ?></td>
                                        <td><?php echo $row['date']; ?></td>
										<td><?php echo $row['venue']; ?></td>
                                        <td><?php echo $row['national_international']; ?></td>
										
                                        <td width="50px" style="text-align:right"><a class="btn btn-info"
                                                                                     href="edit-principal-profile.php?id=<?php echo $id; ?>&mode=edit_workshop&edit_id=<?php echo $row['id']; ?>">
                                                &nbsp;Edit</a></td>
                                        <td width="50px" style="text-align:right"><a class="btn btn-danger"
                                                                                     href="edit-principal-profile.php?id=<?php echo $id; ?>&mode=delete_workshop&delete_id=<?php echo $row['id']; ?>">
                                                &nbsp;Delete</a></td>

                                    </tr>
                                    <?php
                                }
                                ?>
                                </tbody>
                            </table>
                            <div class="panel-body">
                                <div class="form-group">
                                        <div class="form-group">
                                            <label for="event_type required"
                                                       class="control-label required"> Event Type</label>
                                                <input value=" <?php echo $event_type; ?>"required="required" type="text"
                                                       maxlength="50"
                                                       name="event_type" id="event_type" class="form-control"
                                                       placeholder="Event Type">
                                            </div>
                                        <div class="form-group">
                                            <label for="event_name" class="control-label required">Name of the Event</label>
                                            <input value="<?php echo $event_name; ?>" required="required" type="text" maxlength="20"
                                                   name="event_name" id="event_name" class="form-control"
                                                   placeholder="Name of the Event">
                                        </div>
                                        <div class="form-group">
                                            <label for="role" class="control-label required">Your Role</label>
                                            <input value="<?php echo $role; ?>" required="required" maxlength="50" type="text"
                                                   name="role" class="form-control" placeholder="Role">
                                        </div>
    
                                        <div class="form-group">
                                    <label for="date" class="control-label">Date</label>
                                            <input value="<?php echo $date; ?>" maxlength="20"
                                                   name="date"  readonly id="datepicker5"class="form-control" placeholder="Date">
                                        </div>
                                        <div class="form-group">
                                            <label for="Venue" class="control-label">
                                               Venue</label>
                                            <input value="<?php echo $venue; ?>" maxlength="20"
                                                   name="venue" class="form-control" placeholder="venue">
                                        </div>
                                            <div class="form-group">
                                                <label for="national_international" class="control-label required">National/International</label>
                                                <select name="national_international" id="national_international" class="form-control">
                                                    <option <?php if ($row['national_international'] == "National") echo " selected='selected'"; ?>
                                                        value="National">National
                                                    </option>
                                                    <option <?php if ($row['national_international'] == "International") echo " selected='selected'"; ?>
                                                        value="International">International
                                                    </option>
                                                </select>
                                            </div>
										<div class="form-group text-center">
                                        <?php
                                        if (isset($_GET['mode']) and $_GET['mode'] == "edit_workshop") {
                                            ?>
                                            <input required="required" class="btn btn-info"
                                                   type="submit"
                                                   name="submit7" value="Update"/>
                                            <?php
                                        } else {
                                            ?>
                                            <input required="required" class="btn btn-info"
                                                   type="submit"
                                                   name="submit7" value="Save"/>
                                            <?php
                                        }
                                        ?>
                                        <a href="edit-principal-profile.php" class="btn btn-info">Back</a>
                                     </div>
                                </div>
                            </div>
                        </div>
                   </div>
			   </form>
            </div>
        </div>
               <?php   
               $event_type  ="";
               $event_name= "";
               $role  = "";
               $date= "";
               $venue= "";
               $national_international= "";
               if (isset($_GET['mode']) and $_GET['mode'] == "edit_participate") {
                    $edit_id = $_GET['edit_id'];
                    $sql = "select * from conference_participated where id=$edit_id";
                    $result = mysqli_query($conn, $sql);
                    $row = mysqli_fetch_assoc($result);
                    $event_type = $row['event_type'];
                    $event_name = $row['event_name'];
					$role  = $row['role'];
                    $date = $row['date'];
					$venue = $row['venue'];
					$national_international = $row['national_international'];
	}

?> 
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseSeven" class="collapsed">
                                <i class="glyphicon glyphicon-chevron-down"></i>Workshops/seminars/FDPs/conference Participated

                            </a>
                        </h4>
                    </div>
                    <div id="collapseSeven" class="panel-collapse collapse">
                        <form method="post" action="" enctype="multipart/form-data">
                            <form method="post" action="" enctype="multipart/form-data">
                               <div class="col-md-12"><br>
                    <div class="table-responsive">
						<table class="table table-bordered table-striped">
                                <thead>
                        <tr style="background-color: #81888c;color:white" >
                                    <th>Event Type</th>
                                    <th>Name of the Event</th>
									<th>Your Role</th>
                                    <th>Date</th>
									<th>Venue</th>
									<th>National/International</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                     <?php
                                $sql = "select * from conference_participated where staff_id=$id";
                                $result = mysqli_query($conn, $sql);
                                while ($row = mysqli_fetch_assoc($result)) {
                                    ?>
                                    <tr>
                                        <td><?php echo $row['event_type']; ?></td>
                                        <td><?php echo $row['event_name']; ?></td>
										<td><?php echo $row['role']; ?></td>
                                        <td><?php echo $row['date']; ?></td>
										<td><?php echo $row['venue']; ?></td>
                                        <td><?php echo $row['national_international']; ?></td>
										
                                        <td width="50px" style="text-align:right"><a class="btn btn-info"
                                                                                     href="edit-principal-profile.php?id=<?php echo $id; ?>&mode=edit_participate&edit_id=<?php echo $row['id']; ?>">
                                                &nbsp;Edit</a></td>
                                        <td width="50px" style="text-align:right"><a class="btn btn-danger"
                                                                                     href="edit-principal-profile.php?id=<?php echo $id; ?>&mode=delete_participate&delete_id=<?php echo $row['id']; ?>">
                                                &nbsp;Delete</a></td>

                                    </tr>
                                    <?php
                                }
                                ?>
                                </tbody>
                            </table>
                            <div class="panel-body">
                                <div class="form-group">
                                        <div class="form-group">
                                             <label for="event_type required"
                                                       class="control-label required"> Event Type</label>
                                                <input value=" <?php echo $event_type; ?>"required="required" type="text"
                                                       maxlength="50"
                                                       name="event_type" id="event_type" class="form-control"
                                                       placeholder="Event Type">
                                            </div>
                                        <div class="form-group">
                                            <label for="event_name" class="control-label required">Name of the Event</label>
                                            <input value="<?php echo $event_name; ?>" required="required" type="text" maxlength="20"
                                                   name="event_name" id="event_name" class="form-control"
                                                   placeholder="Name of the Event">
                                        </div>
                                        <div class="form-group">
                                            <label for="role" class="control-label required">Your Role</label>
                                            <input value="<?php echo $role; ?>" required="required" maxlength="50" type="text"
                                                   name="role" class="form-control" placeholder="Role">
                                        </div>
    
                                        <div class="form-group">
                                    <label for="date" class="control-label">Date</label>
                                            <input value="<?php echo $date; ?>" maxlength="20"
                                                   name="date" readonly id="datepicker6" class="form-control" placeholder="Date">
                                        </div>
                                        <div class="form-group">
                                            <label for="Venue" class="control-label">
                                               Venue</label>
                                            <input value="<?php echo $venue; ?>" maxlength="20"
                                                   name="venue" class="form-control" placeholder="venue">
                                        </div>

                                        <div class="form-group">
                                                <label for="national_international" class="control-label required">National/International</label>
                                                <select name="national_international" id="national_international" class="form-control">
                                                    <option <?php if ($row['national_international'] == "National") echo " selected='selected'"; ?>
                                                        value="National">National
                                                    </option>
                                                    <option <?php if ($row['national_international'] == "International") echo " selected='selected'"; ?>
                                                        value="International">International
                                                    </option>
                                                </select>
                                            </div>

                                        <div class="form-group text-center">
                                        <?php
                                        if (isset($_GET['mode']) and $_GET['mode'] == "edit_participate") {
                                            ?>
                                            <input required="required" class="btn btn-info"
                                                   type="submit"
                                                   name="submit8" value="Update"/>
                                            <?php
                                        } else {
                                            ?>
                                            <input required="required" class="btn btn-info"
                                                   type="submit"
                                                   name="submit8" value="Save"/>
                                            <?php
                                        }
                                        ?>
                                        <a href="edit-principal-profile.php" class="btn btn-info">Back</a>
                                    </div>
                                    </div>
                                 </div>
                            </div>
				         </div>
                    </div>
                </div>
                </form>
				<?php				
				$event_name  = "";
				$place  = "";
				$date= "";
				$awards_won="";
	
                if (isset($_GET['mode']) and $_GET['mode'] == "edit_awards") {
                    $edit_id = $_GET['edit_id'];
                    $sql = "select * from staff_awards_received where id=$edit_id";
                    $result = mysqli_query($conn, $sql);
                    $row = mysqli_fetch_assoc($result);
                    $event_name = $row['event_name'];
                   
					$place  = $row['place'];
					$date  = $row['date'];
					$awards_won  = $row['awards_won'];
                }
	

?> 
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapsEight" class="collapsed">
                                <i class="glyphicon glyphicon-chevron-down"></i> Awards/Incentives received
                            </a>
                        </h4>
                    </div>
                    <div id="collapsEight" class="panel-collapse collapse">
                        <form method="post" action="" enctype="multipart/form-data">
                            <div class="col-md-12"><br>
                    <div class="table-responsive">
						<table class="table table-bordered table-striped">
                                <thead>
                        <tr style="background-color: #81888c;color:white" >
                                    <th>Name of the Event</th>
                                    <th>Place</th>
                                    <th>Date of Visit</th>
                                    <th>Awards Won</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                                </thead>
                                <tbody>
                                 <?php
                                $sql = "select * from  staff_awards_received where staff_id=$id";
                                $result = mysqli_query($conn, $sql);
                                while ($row = mysqli_fetch_assoc($result)) {
                                    ?>
                                    <tr>
                                        <td><?php echo $row['event_name']; ?></td>
                                        <td><?php echo $row['place']; ?></td>
                                        <td><?php echo $row['date']; ?></td>
                                        <td><?php echo $row['awards_won']; ?></td>

                                        <td width="50px" style="text-align:right"><a class="btn btn-info"
                                                                                     href="edit-principal-profile.php?id=<?php echo $id; ?>&mode=edit_awards&edit_id=<?php echo $row['id']; ?>">
                                                &nbsp;Edit</a></td>
                                        <td width="50px" style="text-align:right"><a class="btn btn-danger"
                                                                                     href="edit-principal-profile.php?id=<?php echo $id; ?>&mode=delete_awards&delete_id=<?php echo $row['id']; ?>">
                                                &nbsp;Delete</a></td>

                                    </tr>
                                    <?php
                                }
                                ?>
                                </tbody>
                            </table>
                            <div class="panel-body">

                                <div class="form-group">
                                        <div class="form-group">
                                           <label for="event_name" class="control-label required">Name of the Event</label>
                                            <input value="<?php echo $event_name; ?>" required="required" type="text" maxlength="20"
                                                   name="event_name" id="event_name" class="form-control"
                                                   placeholder="Name of the Event">
                                        </div>
                                        <div class="form-group">
                                            <label for="place" class="control-label required">Place</label>
                                            <input value="<?php echo $place; ?>" required="required" maxlength="50" type="text"
                                                   name="place" class="form-control" placeholder="place">
                                        </div>
    
                                        <div class="form-group">
                                    <label for="date" class="control-label">Date of Event</label>
                                            <input value="<?php echo $date; ?>" maxlength="20"
                                                   name="date" readonly id="datepicker7" class="form-control" placeholder="Date">
                                        </div>
                                        <div class="form-group">
                                            <label for="awardswon" class="control-label">
                                               Awards Won</label>
                                            <input value="<?php echo $awards_won; ?>" maxlength="20"
                                                   name="awards_won" class="form-control" placeholder="Awards Own">
                                        </div>

                                        
                                       
                                    <div class="form-group text-center">
                                        <?php
                                        if (isset($_GET['mode']) and $_GET['mode'] == "edit_awards") {
                                            ?>
                                            <input required="required" class="btn btn-info"
                                                   type="submit"
                                                   name="submit9" value="Update"/>
                                            <?php
                                        } else {
                                            ?>
                                            <input required="required" class="btn btn-info"
                                                   type="submit"
                                                   name="submit9" value="Save"/>
                                            <?php
                                        }
                                        ?>
                                        <a href="edit-principal-profile.php" class="btn btn-info">Back</a>
                                     </div>
                                </div>
                            </div>
                        </div>
                   </div>
			   </form>
            </div>
        </div>

               <?php
                $title = "";
				$author = "";
                $publisher = "";
                $isbn_no = "";
               
                if (isset($_GET['mode']) and $_GET['mode'] == "edit_books") {
                    $edit_id = $_GET['edit_id'];
                    $sql = "select * from books_published where id=$edit_id";
                    $result = mysqli_query($conn, $sql);
                    $row = mysqli_fetch_assoc($result);
                    $title = $row['title'];
					$author = $row['author'];
                    $publisher = $row['publisher'];
                    $isbn_no = $row['isbn_no'];
                
                }


?>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseNine" class="collapsed">
                                <i class="glyphicon glyphicon-chevron-down"></i> Books Published
                            </a>
                        </h4>
                    </div>
                    <div id="collapseNine" class="panel-collapse collapse">
                        <form method="post" action="" enctype="multipart/form-data">
                            <div class="col-md-12"><br>
                    <div class="table-responsive">
						<table class="table table-bordered table-striped">
                                <thead>
                        <tr style="background-color: #81888c;color:white" >
                                    <th>Title of the Book</th>
									<th>Author name</th>
                                    <th>Publisher Name</th>
                                    <th>ISBN</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $sql = "select * from books_published where staff_id=$id";
                                $result = mysqli_query($conn, $sql);
                                while ($row = mysqli_fetch_assoc($result)) {
                                    ?>
                                    <tr>
                                        <td><?php echo $row['title']; ?></td>
										<td><?php echo $row['author']; ?></td>
                                        <td><?php echo $row['publisher']; ?></td>
                                        <td><?php echo $row['isbn_no']; ?></td>
                                       
                                        <td width="50px" style="text-align:right"><a class="btn btn-info"
                                                                                     href="edit-principal-profile.php?id=<?php echo $id; ?>&mode=edit_books&edit_id=<?php echo $row['id']; ?>">
                                                &nbsp;Edit</a></td>
                                        <td width="50px" style="text-align:right"><a class="btn btn-danger"
                                                                                     href="edit-principal-profile.php?id=<?php echo $id; ?>&mode=delete_books&delete_id=<?php echo $row['id']; ?>">
                                                &nbsp;Delete</a></td>

                                    </tr>
                                    <?php
                                }
                                ?>
                                </tbody>
                            </table>
                            <div class="panel-body">

                                <div class="form-group">
                                        <div class="form-group">
                                            <label for="title" class="control-label required">Title of the Book</label>
                                            <input value="<?php echo $title; ?>" required="required" type="text" maxlength="20"
                                                   name="title" id="title" class="form-control"
                                                   placeholder="Title of the Book">
                                        </div>
                                        <div class="form-group">
                                            <label for="Author name" class="control-label required">Author name</label>
                                            <input value="<?php echo $author; ?>" required="required" maxlength="50" type="text"
                                                   name="author" class="form-control" placeholder="Author name">
                                        </div>
    
                                        <div class="form-group">
                                    <label for="publisher" class="control-label">Publisher Name</label>
                                            <input value="<?php echo $publisher; ?>" maxlength="20"
                                                   name="publisher" class="form-control" placeholder="Publisher Name">
                                        </div>
                                        <div class="form-group">
                                            <label for="isbn_no" class="control-label">
                                               ISBN No</label>
                                            <input value="<?php echo $isbn_no; ?>" maxlength="20"
                                                   name="isbn_no" class="form-control" placeholder="ISBN No">
                                        </div>
                                         <div class="form-group text-center">
                                        <?php
                                        if (isset($_GET['mode']) and $_GET['mode'] == "edit_books") {
                                            ?>
                                            <input required="required" class="btn btn-info"
                                                   type="submit"
                                                   name="submit10" value="Update"/>
                                            <?php
                                        } else {
                                            ?>
                                            <input required="required" class="btn btn-info"
                                                   type="submit"
                                                   name="submit10" value="Save"/>
                                            <?php
                                        }
                                        ?>
                                        <a href="edit-principal-profile.php" class="btn btn-info">Back</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                   </div>
			   </form>
            </div>
        </div>

                <?php				
                $title  = "";
                $agency= "";
                $approval_date  =""; 
                if (isset($_GET['mode']) and $_GET['mode'] == "edit_fund") {
                    $edit_id = $_GET['edit_id'];
                    $sql = "select * from funded_project where id=$edit_id";
                    $result = mysqli_query($conn, $sql);
                    $row = mysqli_fetch_assoc($result);
                     $title = $row['title'];
                    $agency = $row['agency'];
					$approval_date  = $row['approval_date'];
                }
	

?>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseTen" class="collapsed">
                                <i class="glyphicon glyphicon-chevron-down"></i> Funded Projects
                            </a>
                        </h4>
                    </div>
                    <div id="collapseTen" class="panel-collapse collapse">
                        <form method="post" action="" enctype="multipart/form-data">
                            <div class="col-md-12"><br>
                    <div class="table-responsive">
						<table class="table table-bordered table-striped">
                                <thead>
                        <tr style="background-color: #81888c;color:white" >
                                   <th>Title of the Project</th>
                                    <th>Funding agency</th>
									<th>Approval Date</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $sql = "select * from funded_project where staff_id=$id";
                                $result = mysqli_query($conn, $sql);
                                while ($row = mysqli_fetch_assoc($result)) {
                                    ?>
                                    <tr>
                                        <td><?php echo $row['title']; ?></td>
                                        <td><?php echo $row['agency']; ?></td>
										<td><?php echo $row['approval_date']; ?></td>
                                        
                                        <td width="50px" style="text-align:right"><a class="btn btn-info"
                                                                                     href="edit-principal-profile.php?id=<?php echo $id; ?>&mode=edit_fund&edit_id=<?php echo $row['id']; ?>">
                                                &nbsp;Edit</a></td>
                                        <td width="50px" style="text-align:right"><a class="btn btn-danger"
                                                                                     href="edit-principal-profile.php?id=<?php echo $id; ?>&mode=delete_fund&delete_id=<?php echo $row['id']; ?>">
                                                &nbsp;Delete</a></td>

                                    </tr>
                                    <?php
                                }
                                ?>
                                </tbody>
                            </table>
                            <div class="panel-body">
                                <div class="form-group">
                                        <div class="form-group">
                                           <label for="Title of the project" class="control-label required">Title of the project</label>
                                            <input value="<?php echo $title; ?>" required="required" type="text" maxlength="20"
                                                   name="title" id="title" class="form-control"
                                                   placeholder="Title of the project">
                                        </div>
                                        <div class="form-group">
                                            <label for="Funding agency" class="control-label required">Funding agency</label>
                                            <input value="<?php echo $agency; ?>" required="required" maxlength="50" type="text"
                                                   name="agency" class="form-control" placeholder="Funding agency">
                                        </div>
    
                                        <div class="form-group">
                                    <label for="date" class="control-label">Approval Date</label>
                                            <input value="<?php echo $approval_date; ?>" maxlength="20"
                                                   name="approval_date" readonly id="datepicker8"class="form-control" placeholder="Date of approval">
                                        </div>
                                     <div class="form-group text-center">
                                        <?php
                                        if (isset($_GET['mode']) and $_GET['mode'] == "edit_fund") {
                                            ?>
                                            <input required="required" class="btn btn-info"
                                                   type="submit"
                                                   name="submit11" value="Update"/>
                                            <?php
                                        } else {
                                            ?>
                                            <input required="required" class="btn btn-info"
                                                   type="submit"
                                                   name="submit11" value="Save"/>
                                            <?php
                                        }
                                        ?>
                                        <a href="edit-principal-profile.php" class="btn btn-info">Back</a>
                                      </div>
                                </div>
                            </div>
                        </div>
                   </div>
			   </form>
            </div>
        </div>
                <?php				
                $inventor  = "";
                $title= "";
                $reg_no  =""; 
                $national_international  =""; 
                if (isset($_GET['mode']) and $_GET['mode'] == "edit_patents") {
                    $edit_id = $_GET['edit_id'];
                    $sql = "select * from patents_owned where id=$edit_id";
                    $result = mysqli_query($conn, $sql);
                    $row = mysqli_fetch_assoc($result);
                    $inventor = $row['inventor'];
                    $title = $row['title'];
					$reg_no  = $row['reg_no'];
					$national_international  = $row['national_international'];
                }
?>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseEleven" class="collapsed">
                                <i class="glyphicon glyphicon-chevron-down"></i> Patents Owned
                            </a>
                        </h4>
                    </div>
                    <div id="collapseEleven" class="panel-collapse collapse">
                        <form method="post" action="" enctype="multipart/form-data">
                           <div class="col-md-12"><br>
                    <div class="table-responsive">
						<table class="table table-bordered table-striped">
                                <thead>
                        <tr style="background-color: #81888c;color:white" >
                                    <th>Inventor</th>
									<th>Title of the Patents</th>
                                    <th>Reg.No</th>
									<th>National/International</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $sql = "select * from patents_owned where staff_id=$id";
                                $result = mysqli_query($conn, $sql);
                                while ($row = mysqli_fetch_assoc($result)) {
                                    ?>
                                    <tr>
                                        <td><?php echo $row['inventor']; ?></td>
										<td><?php echo $row['title']; ?></td>
                                        <td><?php echo $row['reg_no']; ?></td>
                                        <td><?php echo $row['national_international']; ?></td>
                                        <td width="50px" style="text-align:right"><a class="btn btn-info"
                                                                                     href="edit-principal-profile.php?id=<?php echo $id; ?>&mode=edit_patents&edit_id=<?php echo $row['id']; ?>">
                                                &nbsp;Edit</a></td>
                                        <td width="50px" style="text-align:right"><a class="btn btn-danger"
                                                                                     href="edit-principal-profile.php?id=<?php echo $id; ?>&mode=delete_patents&delete_id=<?php echo $row['id']; ?>">
                                                &nbsp;Delete</a></td>

                                    </tr>
                                    <?php
                                }
                                ?>
                                </tbody>
                            </table>
                            <div class="panel-body">
                                <div class="form-group">
                                        <div class="form-group">
                                            <label for="Inventor" class="control-label required">Inventor</label>
                                            <input value="<?php echo $inventor; ?>" required="required" type="text" maxlength="20"
                                                   name="inventor" id="inventor" class="form-control"
                                                   placeholder="Inventor">
                                        </div>
                                        <div class="form-group">
                                            <label for="Title of the Patents" class="control-label required">Title of the Patents</label>
                                            <input value="<?php echo $title; ?>" required="required" maxlength="50" type="text"
                                                   name="title" class="form-control" placeholder="Title of the Patents">
                                        </div>
    
                                        <div class="form-group">
                                           <label for="Reg.No" class="control-label">Reg.No</label>
                                            <input value="<?php echo $reg_no; ?>" maxlength="20"
                                                   name="reg_no" class="form-control" placeholder="Reg.No">
                                        </div>
                                     
                                         <div class="form-group">
                                                <label for="national_international" class="control-label required">National/International</label>
                                                <select name="national_international" id="national_international" class="form-control">
                                                    <option <?php if ($row['national_international'] == "National") echo " selected='selected'"; ?>
                                                        value="National">National
                                                    </option>
                                                    <option <?php if ($row['national_international'] == "International") echo " selected='selected'"; ?>
                                                        value="International">International
                                                    </option>
                                                </select>
                                            </div>
                                      <div class="form-group text-center">
                                        <?php
                                        if (isset($_GET['mode']) and $_GET['mode'] == "edit_patents") {
                                            ?>
                                            <input required="required" class="btn btn-info"
                                                   type="submit"
                                                   name="submit12" value="Update"/>
                                            <?php
                                        } else {
                                            ?>
                                            <input required="required" class="btn btn-info"
                                                   type="submit"
                                                   name="submit12" value="Save"/>
                                            <?php
                                        }
                                        ?>
                                        <a href="edit-principal-profile.php" class="btn btn-info">Back</a>
                                     </div>
                                </div>
                            </div>
                        </div>
                   </div>
			   </form>
            </div>
        </div>
                <?php
                $consultant = "";
                $wrk_title = "";
                $place = "";
                $duration = "";
                $fund_generator = "";
                if (isset($_GET['mode']) and $_GET['mode'] == "edit_consult") {
                $edit_id = $_GET['edit_id'];
                $sql = "select * from consultancy where id=$edit_id";
                $result = mysqli_query($conn, $sql);
                $row = mysqli_fetch_assoc($result);
                $consultant = $row['consultant'];
                $wrk_title = $row['wrk_title'];
                $place = $row['place'];
                $duration = $row['duration'];
                $fund_generator = $row['fund_generator'];

                }

                ?>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwelve" class="collapsed">
                                <i class="glyphicon glyphicon-chevron-down"></i>
								Consultancy Works
                            </a>
                        </h4>
                    </div>
                    <div id="collapseTwelve" class="panel-collapse collapse">
                        <form method="post" action="" enctype="multipart/form-data">
                            <form method="post" action="" enctype="multipart/form-data">
                               <div class="col-md-12"><br>
                    <div class="table-responsive">
						<table class="table table-bordered table-striped">
                                <thead>
                        <tr style="background-color: #81888c;color:white" >
                                    <th>Consultant</th>
                                    <th>Title of work</th>
                                    <th>Place</th>
                                    <th>Duration</th>
                                    <th>Funds Generated</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                     <?php
                                         $sql = "select * from  consultancy where staff_id=$id";
                                         $result = mysqli_query($conn, $sql);
                                         while ($row = mysqli_fetch_assoc($result)) {
                                             ?>
                                             <tr>
                                                 <td><?php echo $row['consultant']; ?></td>
                                                 <td><?php echo $row['wrk_title']; ?></td>
                                                 <td><?php echo $row['place']; ?></td>
                                                 <td><?php echo $row['duration']; ?></td>
                                                 <td><?php echo $row['fund_generator']; ?></td>

                                                 <td width="50px" style="text-align:right"><a class="btn btn-info"
                                                                                              href="edit-principal-profile.php?id=<?php echo $id; ?>&mode=edit_consult&edit_id=<?php echo $row['id']; ?>">
                                                         &nbsp;Edit</a></td>
                                                 <td width="50px" style="text-align:right"><a class="btn btn-danger"
                                                                                              href="edit-principal-profile.php?id=<?php echo $id; ?>&mode=delete_consult&delete_id=<?php echo $row['id']; ?>">
                                                         &nbsp;Delete</a></td>

                                             </tr>
                                             <?php
                                         }
                                         ?>
                                         </tbody>
                                     </table>
                            <div class="panel-body">
                                <div class="form-group">
                                        <div class="form-group">
                                             <label for="Consultant" class="control-label required">Consultant</label>
                                            <input value="<?php echo $consultant; ?>" required="required" type="text" maxlength="20"
                                                   name="consultant" id="consultant" class="form-control"
                                                   placeholder="Consultant">
                                        </div>
                                        <div class="form-group">
                                            <label for="Title of work" class="control-label required">Title of work</label>
                                            <input value="<?php echo $wrk_title; ?>" required="required" maxlength="50" type="text"
                                                   name="wrk_title" class="form-control" placeholder="Title of work">
                                        </div>
    
                                        <div class="form-group">
                                           <label for="Place" class="control-label">Place</label>
                                            <input value="<?php echo $place; ?>" maxlength="20"
                                                   name="place" class="form-control" placeholder="Place">
                                        </div>
                                        <div class="form-group">
                                            <label for="Duration" class="control-label">Duration</label>
                                            <input value="<?php echo $duration; ?>" maxlength="20"
                                                   name="duration" class="form-control" placeholder="Funds Generated">
                                        </div>
                                     
                                          <div class="form-group">
                                            <label for="Funds Generated" class="control-label">Funds Generated</label>
                                            <input value="<?php echo $fund_generator; ?>" maxlength="20"
                                                   name="fund_generator" class="form-control" placeholder="Funds Generated">
                                        </div>
                                        
                                       
                                    <div class="form-group text-center">
                                        <?php
                                        if (isset($_GET['mode']) and $_GET['mode'] == "edit_consult") {
                                            ?>
                                            <input required="required" class="btn btn-info"
                                                   type="submit"
                                                   name="submit13" value="Update"/>
                                            <?php
                                        } else {
                                            ?>
                                            <input required="required" class="btn btn-info"
                                                   type="submit"
                                                   name="submit13" value="Save"/>
                                            <?php
                                        }
                                        ?>
                                        <a href="edit-principal-profile.php" class="btn btn-info">Back</a>
										</div>
                                </div>
                            </div>
                        </div>
                   </div>
			   </form>
			   
            </div>
			<?php  
                $name = "";
                $place = "";
                $date = "";
                $participated = "";
                if (isset($_GET['mode']) and $_GET['mode'] == "edit_activites") {
                    $edit_id = $_GET['edit_id'];
                    $sql = "select * from staff_other_activites where id=$edit_id";
                    $result = mysqli_query($conn, $sql);
                    $row = mysqli_fetch_assoc($result);
                    $name = $row['name'];
                    $place = $row['place'];
                    $date = $row['date'];
                    $participated = $row['participated'];

                } 

?> 
                        <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseThirteen" class="collapsed">
                                <i class="glyphicon glyphicon-chevron-down"></i>
								Other Activities
                            </a>
                        </h4>
                    </div>
                    <div id="collapseThirteen" class="panel-collapse collapse">
                        <form method="post" action="" enctype="multipart/form-data">
                            <form method="post" action="" enctype="multipart/form-data">
                               <div class="col-md-12"><br>
                    <div class="table-responsive">
						<table class="table table-bordered table-striped">
                                <thead>
                        <tr style="background-color: #81888c;color:white" >
                                    <th>Name of the Activity</th>
                                    <th>Place</th>
                                    <th>Date of Date</th>
                                    <th>Participated</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $sql = "select * from  staff_other_activites where staff_id=$id";
                                    $result = mysqli_query($conn, $sql);
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        ?>
                                        <tr>
                                            <td><?php echo $row['name']; ?></td>
                                            <td><?php echo $row['place']; ?></td>
                                            <td><?php echo $row['date']; ?></td>
                                            <td><?php echo $row['participated']; ?></td>

                                            <td width="50px" style="text-align:right"><a class="btn btn-info"
                                                                                         href="edit-principal-profile.php?id=<?php echo $id; ?>&mode=edit_activites&edit_id=<?php echo $row['id']; ?>">
                                                    &nbsp;Edit</a></td>
                                            <td width="50px" style="text-align:right"><a class="btn btn-danger"
                                                                                         href="edit-principal-profile.php?id=<?php echo $id; ?>&mode=delete_activites&delete_id=<?php echo $row['id']; ?>">
                                                    &nbsp;Delete</a></td>

                                        </tr>
                                        <?php
                                    }
                                    ?>
                                    </tbody>
                                </table>
                            <div class="panel-body">
                                <div class="form-group">
                                        <div class="form-group">
                                             <label for="Name of the Activity" class="control-label required">Name of the Activity</label>
                                            <input value="<?php echo $name; ?>" required="required" type="text" maxlength="20"
                                                   name="name" id="name" class="form-control"
                                                   placeholder="Name of the Activity">
                                        </div>                                        <div class="form-group">
                                           <label for="Place" class="control-label">Place</label>
                                            <input value="<?php echo $place; ?>" maxlength="20"
                                                   name="place" class="form-control" placeholder="Place">
                                        </div>
                                       
                                        <div class="form-group">
                                            <label for="Date of event" class="control-label required">Date of event</label>
                                            <input value="<?php echo $date; ?>" readonly id="datepicker9" required="required" maxlength="50" 
                                           type="text"
                                                   name="date" class="form-control" placeholder="Date of event">
                                        </div>
    
                                         <div class="form-group">
                                                <label for="participated" class="control-label required">Participated / won</label>
                                                <select name="participated" id="participated" class="form-control">
                                                    <option <?php if ($row['participated'] == "Participated") echo " selected='selected'"; ?>
                                                        value="Participated">Participated
                                                    </option>
                                                    <option <?php if ($row['participated'] == "Won") echo " selected='selected'"; ?>
                                                        value="Won">Won
                                                    </option>
                                                </select>
                                            </div>
                                    

                                    <div class="form-group text-center">
                                        <?php
                                        if (isset($_GET['mode']) and $_GET['mode'] == "edit_activites") {
                                            ?>
                                            <input required="required" class="btn btn-info"
                                                   type="submit"
                                                   name="submit14" value="Update"/>
                                            <?php
                                        } else {
                                            ?>
                                            <input required="required" class="btn btn-info"
                                                   type="submit"
                                                   name="submit14" value="Save"/>
                                            <?php
                                        }
                                        ?>
                                        <a href="edit-principal-profile.php" class="btn btn-info">Back</a>
										</div>
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

<?php include("footer.php"); ?>
<script src="assets/js/bootstrap-datepicker.js"></script>

<script>
$(document).ready(function () {
	
	$('#datepicker3').datepicker({
            format: "dd/mm/yyyy"
        });	
		
	$('#datepicker4').datepicker({
            format: "dd/mm/yyyy"
        });	
		
	$('#datepicker5').datepicker({
            format: "dd/mm/yyyy"
        });	
		
	$('#datepicker6').datepicker({
            format: "dd/mm/yyyy"
        });	
		
	$('#datepicker7').datepicker({
            format: "dd/mm/yyyy"
        });	
		
	$('#datepicker8').datepicker({
            format: "dd/mm/yyyy"
        });	
		
	$('#datepicker9').datepicker({
            format: "dd/mm/yyyy"
        });	
		
    });

</script>
</body>

</html>
