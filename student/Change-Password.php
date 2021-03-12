<?php
session_start();
include('includes/config.php');
error_reporting(0);

  if(strlen($_SESSION['login'])==0)
    {   
     
    }
  else{
    if(isset($_POST['submit']))
      {
        $sql = mysqli_query($con,"SELECT password FROM  students where password='".($_POST['cpass'])."' && studentRegno='".$_SESSION['login']."'");
        $num = mysqli_fetch_array($sql);
        if($num>0)
          {
            $con = mysqli_query($con,"update students set password='".($_POST['newpass'])."' where studentRegno='".$_SESSION['login']."'");
            $_SESSION['msg'] = "Password Changed Successfully !!";
          }
        else
          {
            $_SESSION['msg'] = "Current Password Didn't Match !!";
          }
      }
?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <title>Admin | Student Password</title>
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
    <script type="text/javascript">
    function valid() 
        {
          if(document.chngpwd.cpass.value=="")
            {
              alert("Current Password Filed is Empty !!");
              document.chngpwd.cpass.focus();
              return false;
            }
          else if(document.chngpwd.newpass.value=="")
            {
              alert("New Password Filed is Empty !!");
              document.chngpwd.newpass.focus();
              return false;
            }
          else if(document.chngpwd.cnfpass.value=="")
            {
              alert("Confirm Password Filed is Empty !!");
              document.chngpwd.cnfpass.focus();
              return false;
            }

          else if(document.chngpwd.newpass.value!= document.chngpwd.cnfpass.value)
            {
              alert("Password and Confirm Password Field do not match  !!");
              document.chngpwd.cnfpass.focus();
              return false;
            }
            return true;
        }
  </script>
<body>


<?php 
    if($_SESSION['login']!="")
      {
        include('includes/menubar.php');
      }
 ?>

    <div class="content-wrapper">
        <div class="container">
              <div class="row">
                    <div class="col-md-12">
                        <h4 class="page-head-line mt-" style="text-align: center;">Student Change Password </h4>
                    </div>
                </div>
                <div class="row" >
                  <div class="col-md-3"></div>
                    <div class="col-md-6">
                        <div class="panel panel-default">

<font color="green" align="center"><?php echo htmlentities($_SESSION['msg']);?><?php echo htmlentities($_SESSION['msg']="");?></font>


                        <div class="panel-body mt-3">
                       <form name="chngpwd" method="post" onSubmit="return valid();">
    <div class="form-group">
        <label for="exampleInputPassword1">Current Password</label>
        <input type="password" class="form-control" id="exampleInputPassword1" name="cpass" placeholder="Password" />
    </div>
   
    <div class="form-group">
        <label for="exampleInputPassword1">New Password</>
        <input type="password" class="form-control" id="exampleInputPassword2" name="newpass" placeholder="Password" />
    </div>

    <div class="form-group">
        <label for="exampleInputPassword1">Confirm Password</label>
        <input type="password" class="form-control" id="exampleInputPassword3" name="cnfpass" placeholder="Password" />
    </div>
 
    <button type="submit" name="submit" class="btn btn-primary">Submit</button>
          <hr/>
      </form>
                       </div>
                    </div>
                  </div>  
              </div>
        </div>
    </div>

    <?php include('includes/footer.php');?>

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
