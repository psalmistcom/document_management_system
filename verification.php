<?php 
    // session_start();
    include 'path.php'; 
    include (ROOT_PATH . '/core/session.php');

    if ($verified === 'YES') {
        header('location:' . BASE_URL . '/dashboard');
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
            <div class="row justify-content-center">
                <div class="col-xl-6 col-lg-6 col-md-7">
                    <div class="card o-hidden border-0 shadow-lg my-5">
                        <div class="card-body p-0">
                            <div class="p-5">
                                <div class="text-center">
                                    <h3>Congratulations! <br/> Your account has been created</h3>
                                    <h1 class="h4 text-gray-900 my-4">Waiting for Admin  Approval </h1>
                                </div>
                                <div class="text-center">
                                    <p>Kindly wait for the admin's approval which will not take up tp 24hours if your details are filled correctly</p>
                                </div>                        
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>




    <?php include (ROOT_PATH . "/includes/scripts.php"); ?>    
</body>
</html>