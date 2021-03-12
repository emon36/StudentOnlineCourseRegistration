<?php
session_start();
include('partials/config.php');
error_reporting(0);
if(strlen($_SESSION['alogin'])==0)
    {   
header('location:index.php');
}
else{
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, maximum-scale=1"
    />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Registration History</title>
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
     <link href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.min.css" rel="stylesheet" >
    <script src="https://kit.fontawesome.com/21dd78019e.js"></script>
    
  </head>

  <body>
    <?php include('partials/menubar.php');?>

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
            <h3 class="page-head-line text-center"> Student Course Registration </h3>
            <hr>
          </div>
        </div>
        <br><br>
        <div class="row">
          <div class="col-md-12">
            <!--    Bordered Table  -->
            <div class="panel panel-primary">
              <!-- /.panel-heading -->
              <div class="panel-body">
                <div class="table-responsive table-bordered text-center">
                  <table id="student_data" class="table">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Students ID</th>
                       <!--  <th>Course Name</th>
                        <th>Session</th>
                        <th>Department</th>
                        <th>Level</th>
                        <th>Semester</th>
                        <th>Registration Date & Time</th> -->
                        <th> Students Name</th>
                        <th>Actions</th>
                        
                      </tr>
                    </thead>
                    <tbody>
                      <?php
$sql=mysqli_query($con,"select  DISTINCT studentRegno  from courseenrolls");
$cnt=1;
while($row=mysqli_fetch_array($sql))
{
?>

                      <tr>
                        <td><?php echo $cnt;?></td>
                        <td><?php echo htmlentities($row['studentRegno']);?></td>
                        <?php 
                        $id = $row['studentRegno'];
                        $sql1=mysqli_query($con,"select studentName from students where StudentRegno= '$id'");
                        $row1=mysqli_fetch_array($sql1);
                        ?>
                       <td><?php echo htmlentities($row1['studentName']);?></td>



                       
                        <td>
                          <a
                            href="viewStudentCourse.php?id=<?php echo $row['studentRegno']?>"
                            target="_blank"
                          >
                            <button class="btn btn-primary">
                              <i class="fas fa-eye"></i> View
                            </button>
                          </a>
                        </td>
                       
                      </tr>
                      <?php 
$cnt++;
} ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
            <!--  End  Bordered Table  -->
          </div>
        </div>
      </div>
    </div>
    <br><br><br><br>

    <!-- CONTENT-WRAPPER SECTION END-->
    <?php include('partials/footer.php');?>

<!-- SCRIPTS -->
<!-- JQuery -->
<script type="text/javascript" src="../public/js/jquery-3.4.1.min.js"></script>
<!-- Bootstrap tooltips -->
<script type="text/javascript" src="../public/js/popper.min.js"></script>
<!-- Bootstrap core JavaScript -->
<script type="text/javascript" src="../public/js/bootstrap.min.js"></script>
<!-- MDB core JavaScript -->
<script type="text/javascript" src="../public/js/mdb.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js" ></script>
  </body>
</html>
<?php } ?>

<script>
$(document).ready(function(){  
      $('#student_data').DataTable();  
 });  
 </script>  
