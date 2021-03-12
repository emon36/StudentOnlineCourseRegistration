<?php
  session_start();
  include('includes/config.php');
  error_reporting(0);

  if(strlen($_SESSION['login'])==0)
    {   
      header('location:index.php');
    }
  else
    {
      if(isset($_POST['submit']))
        {
            $studentname=$_POST['studentname'];
            $photo=$_FILES["photo"]["name"];
            $cgpa=$_POST['cgpa'];
            move_uploaded_file($_FILES["photo"]["tmp_name"],"studentphoto/".$_FILES["photo"]["name"]);
            $ret=mysqli_query($con,"update students set studentName='$studentname',studentPhoto='$photo',cgpa='$cgpa'  where StudentRegno='".$_SESSION['login']."'");
      if($ret)
            {
            $_SESSION['msg']="Student Record updated Successfully !!";
            }
      else
            {
            $_SESSION['msg']="Error : Student Record not update";
            }
        }
?>



<!DOCTYPE html>
<html >
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Student Profile</title>
    <link rel="icon" href="../public/img/favicon.png" />
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
                        <hr>
                        <h3 class="page-head-line text-center">My Profile </h3>
                        <hr>
                    </div>
                </div>

                <div class="row" >
                  <div class="col-md-3"></div>
                    <div class="col-md-6">
                        <div class="panel panel-primary">
                       

      <font color="green" align="center"><?php echo htmlentities($_SESSION['msg']);?><?php echo htmlentities($_SESSION['msg']="");?> </font>

      <?php $sql=mysqli_query($con,"select * from students where StudentRegno='".$_SESSION['login']."'");
      $cnt=1;
      while($row=mysqli_fetch_array($sql))
          {?>
  <div class="panel-body">
      <form name="dept" method="post" enctype="multipart/form-data">
          <div class="form-group">
                <label for="studentname">Student Name  </label>
                <input type="text" class="form-control" id="studentname" name="studentname" value="<?php echo htmlentities($row['studentName']);?>"  />
          </div>

      <div class="form-group">
          <label for="studentregno">Student Reg No</label>
          <input type="text" class="form-control" id="studentregno" name="studentregno" value="<?php echo htmlentities($row['StudentRegno']);?>"  placeholder="Student Reg no" readonly />
 
      </div>

      

      <div class="form-group">
          <label for="CGPA">CGPA  </label>
          <input type="text" class="form-control" id="cgpa" name="cgpa"  value="<?php echo htmlentities($row['cgpa']);?>" required />
      </div>  

      <div class="form-group">
          <label for="Pincode">Student Photo  </label>
   
          <?php if($row['studentPhoto']=="0")
          { ?>
            <img src="studentphoto/noimage.png" width="200" height="200"><?php } else {?>
             <img src="studentphoto/<?php echo htmlentities($row['studentPhoto']);?>" width="200" height="200">
          <?php } ?>
      </div>

    <div class="form-group">
           <label for="Pincode">Upload New Photo  </label>
            <input type="file" class="form-control" id="photo" name="photo"  value="<?php echo htmlentities($row['studentPhoto']);?>" />
        </div>
      <?php } ?>

    <button type="submit" name="submit" id="submit" class="btn btn-primary"><i class="fas fa-sync"></i> Update</button>

     </form>
                </div>
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
