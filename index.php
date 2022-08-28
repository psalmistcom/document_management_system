<?php 
    session_start();
    include 'path.php'; 
    
    if(isset($_SESSION['userAssessmentDMS'])){
        header('location:' . BASE_URL . '/verification');
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Document Management System - Authenticate</title>
    <?php include (ROOT_PATH . "/includes/head.php"); ?>
</head>
<body>
    <div class="container">
        <!-- Login starts here  -->
        <div id="login-box">
            <?php include (ROOT_PATH . "/includes/userLogin.php"); ?>
        </div>

        <!-- Create Account starts here  -->
        <div id="register-box" style="display:none">
            <?php include (ROOT_PATH . "/includes/userReg.php"); ?>
        </div>
    </div>




    <?php include (ROOT_PATH . "/includes/scripts.php"); ?>
    <script src="<?= BASE_URL . '/assets/js/authenticate.js'; ?>"></script>
    <script>
        $(function () {
            $("#register-link").click(function () {
                $("#login-box").hide();
                $("#register-box").show();
            });
            $("#login-link").click(function () {
                $("#login-box").show();
                $("#register-box").hide();
            });
        })
    </script>
</body>
</html>