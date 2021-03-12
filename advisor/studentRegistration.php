<?php
session_start();
include("partials/config.php");

  if(strlen($_SESSION['alogin'])==0)
    {   
      header('location:../index.php');
    }
  else
    {
  if(isset($_POST['submit']))
    {
      $studentname=$_POST['studentname'];
      $studentregno=$_POST['studentregno'];
      $password= ($_POST['password']);

      $sql_r = "SELECT * FROM students WHERE StudentRegno='$studentregno'";
       $res = mysqli_query($con, $sql_r);

      if (mysqli_num_rows($res) > 0) {
      $id_error = "Sorry... ID already taken";  
    }

    else{

      $ret=mysqli_query($con,"INSERT INTO students (studentName,StudentRegno,password) values('$studentname','$studentregno','$password')");
      if($ret)
        {
          $_SESSION['msg']="Student Registered Successfully !!";
           header('location:Manage-Students.php');
        }
      else
        {
          $_SESSION['msg']="Error : Student  Not Register";
        }
    }
  }
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <title>Advisor | Student Registration</title>
    <link rel="icon" href="../public/img/favicon.png" />
       <!-- Font Awesome -->
    <link
      rel="stylesheet"
      href="https://use.fontawesome.com/releases/v5.8.2/css/all.css"
    />
    <!-- Bootstrap core CSS -->
    <link href="public/css/bootstrap.min.css" rel="stylesheet" />
    <!-- Material Design Bootstrap -->
    <link href="public/css/mdb.min.css" rel="stylesheet" />
    <!-- Your custom styles (optional) -->
    <link href="public/css/mdb.css" rel="stylesheet" />
    <script src="https://kit.fontawesome.com/21dd78019e.js"></script>

</head>

<body>

<?php 
  if($_SESSION['alogin']!="")
    {
      include('partials/menubar.php');
    }
?>
    <div class="content-wrapper">
        <div class="container">
              <div class="row">
                    <div class="col-md-12">
                        <hr>
                        <h3 class="page-head-line text-center">Student Registration  </h3>
                        <hr>
                    </div>
                </div>
                <div class="row" >
                  <div class="col-md-3"></div>
                    <div class="col-md-6">
                        <div class="panel panel-primary">
                        <div class="panel-heading text-center">
                        Register Student 
                        </div>
   <div>   <font color="green" align="center"><?php if( isset($_SESSION['msg']));?><?php echo htmlentities($_SESSION['msg']="");?></font> </div>

                        <div class="panel-body">
                       <form name="dept" method="post">
   <div class="form-group">
    <label for="studentname">Student Name  </label>
    <input type="text" class="form-control" id="studentname" name="studentname" placeholder="Example : MS Emon" required />
  </div>

 <div class="form-group">
    <label for="studentregno">Student Reg No   </label>
    <input type="text" class="form-control" id="studentregno" name="studentregno"  placeholder="Example : 162-15-7789" required />
     <?php if (isset($id_error)): ?>
        <span class="alert-danger" ><?php echo $id_error; ?></span>
      <?php endif ?>
  </div>

<div class="form-group">
    <label for="password">Password  </label>
    <input type="password" class="form-control" id="password" name="password" placeholder="Enter password" required />
  </div>   

 <button type="submit" name="submit" id="submit" class="btn btn-primary"><i class="far fa-check-circle"></i> Submit</button>
</form>
                          </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br><br><br><br>
    
  <?php include('partials/footer.php');?>
    

  <script>
    function userAvailability() 
    {
      $("#loaderIcon").show();
      jQuery.ajax(
        {
          url: "check_availability.php",
          data:'regno='+$("#studentregno").val(),
          type: "POST",success:function(data)
              {
                $("#user-availability-status1").html(data);
                $("#loaderIcon").hide();
              },
          error:function ()
          {

          }
        });
    }
  </script>

<!-- SCRIPTS -->
<!-- JQuery -->
<script type="text/javascript" src="public/js/jquery-3.4.1.min.js"></script>
<!-- Bootstrap tooltips -->
<script type="text/javascript" src="public/js/popper.min.js"></script>
<!-- Bootstrap core JavaScript -->
<script type="text/javascript" src="public/js/bootstrap.min.js"></script>
<!-- MDB core JavaScript -->
<script type="text/javascript" src="public/js/mdb.min.js"></script>
</body>
</html>
  <?php 
} 
  ?>
