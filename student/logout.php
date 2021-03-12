<?php
    session_start();
    include("includes/config.php");

    $_SESSION['login']=="0";
    date_default_timezone_set('Asia/Dhaka');
    $ldate=date( 'd-m-Y h:i:s A', time () );
    mysqli_query($con,"UPDATE userlog  SET logout = '$ldate' WHERE studentRegno = '".$_SESSION['login']."' ORDER BY id DESC LIMIT 1");
    //session_unset();
    session_destroy();
    $_SESSION['errmsg']="You Have Successfully Logout";
?>

    <script language="javascript">
    document.location="../index.php";
    </script>
