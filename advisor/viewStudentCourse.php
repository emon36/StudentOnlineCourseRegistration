<?php
session_start();
include('partials/config.php');
error_reporting(0);

  if(strlen($_SESSION['alogin'])==0)
      {   
        header('location:login.php');
      }
else{
        if(isset($_GET['accpt']))
            {
              $id = $_GET['id'];

              $course = $_GET['course'];
              $queries = [
                "update courseenrolls set status='1' where id = '$id'",

                "update courses course set course.noofseats = course.noofseats-1 where course.courseName = '$course' "

              ];

              foreach ($queries as $query) {
               $stmt = $con->prepare($query);
           $stmt->execute();
             }

            

              $_SESSION['accptmsg']="Student student status updated !!";
              header('Location:' . $_SERVER['HTTP_REFERER']);
            
            }
            unset($_SESSION['accptmsg']);

            if(isset($_GET['del']))
            {
              $id = $_GET['id'];
              mysqli_query($con,"update courseenrolls set status='2' where id = '$id'");
              $_SESSION['delmsg']="Student record deleted !!";

               header('Location:' . $_SERVER['HTTP_REFERER']);
            }
     
            
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
    <title>Advisor | Manage Student</title>
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
    <link href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.min.css" rel="stylesheet" >
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
            <h3 class="page-head-line text-center">Enrolled Course</h3>
            <hr>
          </div>
        </div>
        <br><br><br>

       

          <?php

$id = $_GET['id'];

    $sql=mysqli_query($con,"select * from students where StudentRegno = '$id'");
    
    $row=mysqli_fetch_array($sql);
        
?>

           <h5> <b> Student Name :</b> <?php echo $row['studentName'];  ?>  </h5>


        <div class="row">
          <font color="red" align="center"
            ><?php echo htmlentities($_SESSION['accptmsg']);?><?php echo htmlentities($_SESSION['delmsg']="");?></font
          >
          
          <div class="col-md-12">
            <!--    Bordered Table  -->
            <div class="panel panel-primary">
              <div class="panel-body">
                <div class="table-responsive table-bordered text-center">
                  <table id="student_data" class="table">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Course Name</th>
                        <th>session</th>
                        <th>Department </th>
                        <th>Semester</th>
                        <th>Registration Date</th>
                        <th>Actions</th>
                      </tr>
                    </thead>
                    <tbody>
                    
<?php

$id = $_GET['id'];

    $sql=mysqli_query($con,"select * from courseenrolls where StudentRegno = '$id'");
    $cnt=1;
    while($row=mysqli_fetch_array($sql))
        {
?>

                      <tr>
                        <td><?php echo $cnt;?></td>
                        <td><?php echo htmlentities($row['course']);?></td>
                        <td><?php echo htmlentities($row['session']);?></td>
                        
                        <td><?php echo htmlentities($row['department']);?></td>
                        <td> <?php echo htmlentities($row['semester']);?></td>
                      <td>  <?php echo htmlentities($row['edate']);?></td>
                          <td>

                        <?php  

                        if($row['status'] == 0 )
                           {
                            ?>

                          <a
                            href="viewStudentCourse.php?id=<?php echo $row['id']?>&course=<?php echo $row['course']?>&accpt=accept"
                          >
                            <button class="btn btn-primary">
                              <i class="fa fa-edit "></i> Accept
                            </button>
                          </a>
                          <a
                            href="viewStudentCourse.php?id=<?php echo $row['id']?>&del=delete"
                            onClick="return confirm('Are You Sure ?')"
                          >
                            <button class="btn btn-danger"><i class="fas fa-trash-alt"></i>  Cancel</button>
                          </a>
                         <?php
                        }elseif($row['status'] == 1 ) {
                           ?>                   
                            <button class="btn btn-primary">
                             <i class="fas fa-check"></i> Accepted
                            </button>
                           

                          <?php 
                        }else{

                        ?>
                          
                            <button class="btn btn-danger"><i class="fas fa-trash-alt"></i>  Canceled</button> 

                          <?php
                        }
                          ?>
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
    <?php include('partials/footer.php');?>

<!-- SCRIPTS -->
<!-- JQuery -->
<script type="text/javascript" src="public/js/jquery-3.4.1.min.js"></script>

<!-- Bootstrap tooltips -->
<script type="text/javascript" src="public/js/popper.min.js"></script>
<!-- Bootstrap core JavaScript -->
<script type="text/javascript" src="public/js/bootstrap.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js" ></script>
<!-- MDB core JavaScript -->
<script type="text/javascript" src="public/js/mdb.min.js"></script>

  </body>
</html>
<?php } ?>

<script>
$(document).ready(function(){  
      $('#student_data').DataTable();  
 });  
 </script>  
