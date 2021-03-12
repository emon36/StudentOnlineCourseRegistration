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
                    $department=$_POST['department'];
                    $ret=mysqli_query($con,"insert into departments (department) values('$department')");
                    if($ret)
                        {
                            $_SESSION['msg']="Department Created Successfully !!";
                        }
                    else
                        {
                            $_SESSION['msg']="Error : Department not created";
                        }
                }
            
                if(isset($_GET['del']))
                        {
                            mysqli_query($con,"delete from departments where id = '".$_GET['id']."'");
                            $_SESSION['delmsg']="Department Deleted !";
                        }
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Advisor | Department</title>
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
                        <h3 class="page-head-line text-center">Departments  </h3>
                        <hr>
                    </div>
                </div>
                <div class="row" >
                  <div class="col-md-3"></div>
                    <div class="col-md-6">
                        <div class="panel panel-primary ">
                        <div class="panel-heading text-center">
                           Add Department 
                        </div>
<font color="green" align="center"><?php echo htmlentities($_SESSION['msg']);?><?php echo htmlentities($_SESSION['msg']="");?></font>


                        <div class="panel-body">
                       <form name="dept" method="post">
   <div class="form-group">
    <label for="department">Department Name  </label>
    <input type="text" class="form-control" id="department" name="department" placeholder="Example : CSE" required />
  </div>
 <button type="submit" name="submit" class="btn btn-primary"><i class="far fa-check-circle"></i> Submit</button>
</form>
                            </div>
                            </div>
                    </div>
                  
                </div>
                <font color="red" align="center"><?php echo htmlentities($_SESSION['delmsg']);?><?php echo htmlentities($_SESSION['delmsg']="");?></font>
                <div class="col-md-12">
                   
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            Manage Session
                        </div>
                   
                        <div class="panel-body">
                            <div class="table-responsive table-bordered text-center">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Department</th>
                                            <th>Creation Date & Time</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
<?php
        $sql=mysqli_query($con,"select * from departments");
        $cnt=1;
        while($row=mysqli_fetch_array($sql))
{
?>
        <tr>
            <td><?php echo $cnt;?></td>
            <td><?php echo htmlentities($row['department']);?></td>
            <td><?php echo htmlentities($row['creationDate']);?></td>
            <td>
                <a href="Add-Department.php?id=<?php echo $row['id']?>&del=delete" onClick="return confirm('Are You Sure To Delete This Department ?')">
                    <button class="btn btn-danger"><i class="fas fa-trash-alt"></i>  Delete</button>
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
                </div>
            </div>
        </div>
    </div>


  <?php include('partials/footer.php');?>

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
