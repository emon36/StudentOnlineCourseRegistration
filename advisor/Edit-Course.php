<?php
session_start();
include('includes/config.php');

  if(strlen($_SESSION['alogin'])==0)
      {   
        header('location:index.php');
      }
  else
      {
        $id=intval($_GET['id']);
        if(isset($_POST['submit']))
          {
            $coursecode=$_POST['coursecode'];
            $coursename=$_POST['coursename'];
            $courseunit=$_POST['courseunit'];
            $seatlimit=$_POST['seatlimit'];
            $ret = mysqli_query($con,"update course set courseCode='$coursecode',courseName='$coursename',courseUnit='$courseunit',noofSeats='$seatlimit',updationDate='$currentTime' where id='$id'");
            
            if($ret)
              {
                $_SESSION['msg']="Course Updated Successfully !";
                header('location:Add-Course.php');
                
              }
        else
            {
              $_SESSION['msg']="Error : Course Not Updated";
            }
          }
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <title>Teacher | Course</title>
    <link rel="icon" href="../MDB/img/favicon.png" />
       <!-- Font Awesome -->
    <link
      rel="stylesheet"
      href="https://use.fontawesome.com/releases/v5.8.2/css/all.css"
    />
    <!-- Bootstrap core CSS -->
    <link href="/MDB/css/bootstrap.min.css" rel="stylesheet" />
    <!-- Material Design Bootstrap -->
    <link href="/MDB/css/mdb.min.css" rel="stylesheet" />
    <!-- Your custom styles (optional) -->
    <link href="/MDB/css/mdb.css" rel="stylesheet" />
    <script src="https://kit.fontawesome.com/21dd78019e.js"></script>

</head>

<body>
<?php 
  if($_SESSION['alogin']!="")
    {
       include('includes/menubar.php');
    }
 ?>

    <div class="content-wrapper">
        <div class="container">
              <div class="row">
                    <div class="col-md-12">
                        <hr>
                        <h3 class="page-head-line text-center">Edit Course  </h3>
                        <hr>
                    </div>
                </div>
                <div class="row" >
                  <div class="col-md-3"></div>
                    <div class="col-md-6">
                        <div class="panel panel-primary">

              <font color="green" align="center"><?php echo htmlentities($_SESSION['msg']);?><?php echo htmlentities($_SESSION['msg']="");?></font>
                        <div class="panel-body">
                       <form name="dept" method="post">
<?php

  $sql = mysqli_query($con,"select * from course where id='$id'");
  $cnt=1;
  while($row=mysqli_fetch_array($sql))            
    {
?>
    <p><b>Last Updated at</b> :<?php echo htmlentities($row['updationDate']);?></>
      <div class="form-group">
        <label for="coursecode">Course Code  </label>
        <input type="text" class="form-control" id="coursecode" name="coursecode" placeholder="Course Code" value="<?php echo htmlentities($row['courseCode']);?>" required />
    </div>

    <div class="form-group">
    <label for="coursename">Course Name  </label>
    <input type="text" class="form-control" id="coursename" name="coursename" placeholder="Course Name" value="<?php echo htmlentities($row['courseName']);?>" required />
  </div>

  <div class="form-group">
    <label for="courseunit">Course unit  </label>
    <input type="text" class="form-control" id="courseunit" name="courseunit" placeholder="Course Unit" value="<?php echo htmlentities($row['courseUnit']);?>" required />
  </div>  

<div class="form-group">
    <label for="seatlimit">Seat limit  </label>
    <input type="text" class="form-control" id="seatlimit" name="seatlimit" placeholder="Seat limit" value="<?php echo htmlentities($row['noofSeats']);?>" required />
  </div>  
  <?php 
  } ?>
 
    <button type="submit" name="submit" class="btn btn-primary"><i class=" fa fa-refresh "></i> Update</button>
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
<script type="text/javascript" src="/MDB/js/jquery-3.4.1.min.js"></script>
<!-- Bootstrap tooltips -->
<script type="text/javascript" src="/MDB/js/popper.min.js"></script>
<!-- Bootstrap core JavaScript -->
<script type="text/javascript" src="/MDB/js/bootstrap.min.js"></script>
<!-- MDB core JavaScript -->
<script type="text/javascript" src="/MDB/js/mdb.min.js"></script>
</body>
</html>
<?php 
} ?>
