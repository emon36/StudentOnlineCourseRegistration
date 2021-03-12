<?php
session_start();
include('partials/config.php');

    if(strlen($_SESSION['alogin'])==0)
        {   
            header('location:../index.php');
        }  
    else{
        if(isset($_POST['submit']))
            {
                $coursecode=$_POST['coursecode'];
                $coursename=$_POST['coursename'];
                $section =$_POST['section'];
                $seatlimit=$_POST['seatlimit'];
                $ret=mysqli_query($con,"insert into courses (courseCode,courseName,section,noofSeats) values('$coursecode','$coursename','$section','$seatlimit')");
                if($ret)
                    {
                        $_SESSION['msg']="Course Created Successfully !!";
                    }
                else
                    {
                        $_SESSION['msg']="Error : Course not created";
                    }
            }
                if(isset($_GET['del']))
                    {
                        mysqli_query($con,"delete from courses where id = '".$_GET['id']."'");
                        $_SESSION['delmsg']="Course deleted !!";
                    }
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />

    <title>Advisor | Course</title>
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
    <link href="../public/css/public.css" rel="stylesheet" />
    <script src="https://kit.fontawesome.com/21dd78019e.js"></script>







</head>

<body>

<?php if($_SESSION['alogin']!="")
{
 include('partials/menubar.php');
}
 ?>
    <!-- MENU SECTION END-->
    <div class="content-wrapper">
        <div class="container">
              <div class="row">
                    <div class="col-md-12">
                        <hr>
                        <h3 class="page-head-line text-center">Courses  </h3>
                        <hr>
                    </div>
                </div>
                <div class="row" >
                  <div class="col-md-3"></div>
                    <div class="col-md-6">
                        <div class="panel panel-primary">
                        <div class="panel-heading text-center">
                           Add Course 
                        </div>
<div> <font color="green" align="center"><?php echo htmlentities($_SESSION['msg']);?><?php echo htmlentities($_SESSION['msg']="");?></font> </div>


                        <div class="panel-body">
                       <form name="dept" method="post">
   <div class="form-group">
    <label for="coursecode">Course Code  </label>
    <input type="text" class="form-control" id="coursecode" name="coursecode" placeholder="Exampple : CSE 417" required />
  </div>

 <div class="form-group">
    <label for="coursename">Course Name  </label>
    <input type="text" class="form-control" id="coursename" name="coursename" placeholder="Example : Web Engineering" required />
  </div>

<div class="form-group">
     <label class="form-control-label"> Section <span class="text-danger">*</span></label>
                  <input class="form-control" type="text" name="section" id="section" data-role="tagsinput">
  </div> 

<div class="form-group">
    <label for="seatlimit">Seat Limit  </label>
    <input type="text" class="form-control" id="seatlimit" name="seatlimit" placeholder="Example : 40" required />
  </div>   

 <button type="submit" name="submit" class="btn btn-primary"><i class="far fa-check-circle"></i> Submit</button>
</form>
         </div>
        </div>
    </div>             
                </div>
                <font color="red" align="center"><?php echo htmlentities($_SESSION['delmsg']);?><?php echo htmlentities($_SESSION['delmsg']="");?></font>
                <div class="col-md-12">
                    <!--    Bordered Table  -->
                    <div class="panel panel-primary">
                        <div class="panel-heading text-center">
                            Manage Course
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive table-bordered text-center">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Course Code</th>
                                            <th>Course Name </th>
                                            <th>Section</th>
                                            <th>Seat limit</th>
                                             <th>Creation Date & Time</th>
                                             <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
<?php
    $sql=mysqli_query($con,"select * from courses");
    $cnt=1;
    while($row=mysqli_fetch_array($sql))
        {
?>
        <tr>
            <td><?php echo $cnt;?></td>
            <td><?php echo htmlentities($row['courseCode']);?></td>
            <td><?php echo htmlentities($row['courseName']);?></td>
            <td><?php echo htmlentities($row['section']);?></td>
            <td><?php echo htmlentities($row['noofSeats']);?></td>
            <td><?php echo htmlentities($row['creationDate']);?></td>
            <td>
                <a href="Edit-Course.php?id=<?php echo $row['id']?>">
                <button class="btn btn-primary">
                    <i class="fa fa-edit "></i> Edit</button>              
                </a> 

                <a href="Add-Course.php?id=<?php echo $row['id']?> &del=delete" onClick="return confirm('Are you sure you want to delete?')">
                <button class="btn btn-danger">
                    <i class="fas fa-trash-alt"></i> Delete</button> 
                    </a>
            </td>
        </tr>
    <?php 
         $cnt++;
}   ?>
                                
                 </tbody>
            </table>
            </div>
        </div>
    </div>
 </div>
</div>
        </div>
    </div>

  <?php include('partials/footer.php');?>
<!-- SCRIPTS -->
<!-- JQuery -->
<script type="text/javascript" src="../public/js/jquery-3.4.1.min.js"></script>

<!-- Bootstrap tooltips -->
<script type="text/javascript" src="../public/js/popper.min.js"></script>
<!-- Bootstrap core JavaScript -->
<script type="text/javascript" src="../public/js/bootstrap.min.js"></script>
<script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.min.js" crossorigin="anonymous"></script>

<!-- MDB core JavaScript -->
<script type="text/javascript" src="public/js/mdb.min.js"></script>
</body>
</html>
<?php } ?>

<script>
    $(function () {
        $('input[data-role=tagsinput]').tagsinput();
    }
    );
</script>

