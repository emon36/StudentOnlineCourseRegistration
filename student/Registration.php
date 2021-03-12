<?php
session_start();
include('includes/config.php');
error_reporting(0);
if(strlen($_SESSION['login'])==0 )
    {   
header('location:index.php');
}
else{

if(isset($_POST['submit']))
{
$studentregno=$_POST['studentregno'];
$pincode=$_POST['Pincode'];
$session=$_POST['session'];
$dept=$_POST['department'];
$level=$_POST['level'];
$course=$_POST['course'];
$sem=$_POST['sem'];
$ret=mysqli_query($con,"insert into courseenrolls(studentRegno,session,department,level,course,semester) values('$studentregno','$session','$dept','$level','$course','$sem')");
if($ret)
{
$_SESSION['msg']="Registrtion Request Successfully !!";
header("location:Registration-History.php"); 
}
else
{
  $_SESSION['msg']="Error : Not Enroll";
}
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Registration Course</title>
    <link rel="icon" href="../MDB/img/favicon.png" />
       <!-- Font Awesome -->
    <link
      rel="stylesheet"
      href="https://use.fontawesome.com/releases/v5.8.2/css/all.css"
    />
    <!-- Bootstrap core CSS -->
    <link href="../public/css/bootstrap.min.css" rel="stylesheet" />
    <!-- Material Design Bootstrap -->
    <link href="../public/css/mdb.min.css" rel="stylesheet" />
    <!-- Your custom styles (optional) -->
    <link href="../public/css/mdb.css" rel="stylesheet" />
    <script src="https://kit.fontawesome.com/21dd78019e.js"></script>

</head>

<body>
    <!-- LOGO HEADER END-->
<?php if($_SESSION['login']!="")
{
 include('includes/menubar.php');
}
 ?>
    <!-- MENU SECTION END-->
    <div class="content-wrapper">
        <div class="container">
              <div class="row">
                    <div class="col-md-12">
                        <hr>
                        <h3 class="page-head-line text-center">Registration Course</h3>
                        <hr>
                    </div>
                </div>
                <div class="row" >
                  <div class="col-md-3"></div>
                    <div class="col-md-6">
                        <div class="panel panel-primary">

<font color="green" align="center"><?php echo htmlentities($_SESSION['msg']);?><?php echo htmlentities($_SESSION['msg']="");?></font>
<?php $sql=mysqli_query($con,"select * from students where StudentRegno='".$_SESSION['login']."'");
$cnt=1;
while($row=mysqli_fetch_array($sql))
{ ?>

                        <div class="panel-body">
                       <form name="dept" method="post" enctype="multipart/form-data">
   <div class="form-group">
    <label for="studentname">Student Name  </label>
    <input type="text" class="form-control" id="studentname" name="studentname" value="<?php echo htmlentities($row['studentName']);?>"  />
  </div>

 <div class="form-group">
    <label for="studentregno">Student Reg No   </label>
    <input type="text" class="form-control" id="studentregno" name="studentregno" value="<?php echo htmlentities($row['StudentRegno']);?>"  placeholder="Student Reg no" readonly />
    
  </div>



 


 <?php } ?>

<div class="form-group">
    <label for="Session">Session  </label>
    <select class="form-control" name="session" required="required">
   <option value="">Select Session</option>   
   <?php 
$sql=mysqli_query($con,"select * from sessions where is_active='1'");
while($row=mysqli_fetch_array($sql))
{
?>
<option value="<?php echo htmlentities($row['session']);?>"><?php echo htmlentities($row['session']);?></option>
<?php } ?>

    </select> 
  </div> 



<div class="form-group">
    <label for="Department">Department  </label>
    <select class="form-control" name="department" required="required">
   <option value="">Select Depertment</option>   
   <?php 
$sql=mysqli_query($con,"select * from departments");
while($row=mysqli_fetch_array($sql))
{
?>
<option value="<?php echo htmlentities($row['department']);?>"><?php echo htmlentities($row['department']);?></option>
<?php } ?>

    </select> 
  </div> 
<div class="form-group">
    <label for="Level">Level  </label>
    <select class="form-control" name="level" required="required">
   <option value="">Select Level</option>   
   <?php 
$sql=mysqli_query($con,"select * from levels");
while($row=mysqli_fetch_array($sql))
{
?>
<option value="<?php echo htmlentities($row['level']);?>"><?php echo htmlentities($row['level']);?></option>
<?php } ?>

    </select> 
  </div> 

  <div class="form-group">
    <label for="Course">Course  </label>
    <select class="form-control" name="course" id="course" onBlur="courseAvailability()" required="required">
   <option value="">Select Course</option>   
   <?php 
$sql=mysqli_query($con,"select * from courses");
while($row=mysqli_fetch_array($sql))
{
?>
<option value="<?php echo htmlentities($row['courseName']);?>"><?php echo htmlentities($row['courseName']);?></option>
<?php } ?>
    </select> 
    <span id="course-availability-status1" style="font-size:12px;">
  </div> 

<div class="form-group">
    <label for="Semester">Semester  </label>
    <select class="form-control" name="sem" required="required">
   <option value="">Select Semester</option>   
   <?php 
$sql=mysqli_query($con,"select * from semesters where is_active ='1' ");
while($row=mysqli_fetch_array($sql))
{
?>
<option value="<?php echo htmlentities($row['semester']);?>"><?php echo htmlentities($row['semester']);?></option>
<?php } ?>

    </select> 
  </div>






 <button type="submit" name="submit" id="submit" class="btn btn-primary"><i class="far fa-check-circle"></i> Register</button>
</form>
                            </div>
                            </div>
                    </div>
                  
                </div>

            </div>

        </div>
    </div>
  <?php include('includes/footer.php');?>




<script>
function courseAvailability() {
$("#loaderIcon").show();
jQuery.ajax({
url: "check_availability.php",
data:'cid='+$("#course").val(),
type: "POST",
success:function(data){
$("#course-availability-status1").html(data);
$("#loaderIcon").hide();
},
error:function (){}
});
}
</script>


<!-- SCRIPTS -->
<!-- JQuery -->
<script type="text/javascript" src="../public/js/jquery-3.4.1.min.js"></script>
<!-- Bootstrap tooltips -->
<script type="text/javascript" src="../public/js/popper.min.js"></script>
<!-- Bootstrap core JavaScript -->
<script type="text/javascript" src="../public/js/bootstrap.min.js"></script>
<!-- MDB core JavaScript -->
<script type="text/javascript" src="../public/js/mdb.min.js"></script>


</body>
</html>
<?php } ?>
