<?php 
    // session_start();
    include 'path.php'; 
    include (ROOT_PATH . '/init.php');

    $count = new Auth();    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Dashboard - Document Management System</title>
    <?php include (ROOT_PATH . "/includes/head.php"); ?>
</head>
<body id="page-top">
    <div id="wrapper">
        <?php 
            $page = "dashboard";
            include (ROOT_PATH . "/includes/aside.php"); 
        ?>
                
        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <?php include (ROOT_PATH . "/includes/topbar.php")?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>                        
                    </div>

                    <?php 
                        if ($cuser_type === 'admin') { ?>
                            <div class="row">
        
                                <div class="col-xl-3 col-md-6 mb-4">
                                    <div class="card border-left-primary shadow h-100 py-2">
                                        <div class="card-body">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col mr-2">
                                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                        Total Verified Users</div>
                                                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $count->counting_things('users', 'verified', 1); ?></div>
                                                </div>                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
        
                                <div class="col-xl-3 col-md-6 mb-4">
                                    <div class="card border-left-success shadow h-100 py-2">
                                        <div class="card-body">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col mr-2">
                                                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                        Total Pending Users
                                                    </div>
                                                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $count->counting_things('users', 'verified', 0); ?></div>
                                                </div>                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
        
                                <div class="col-xl-3 col-md-6 mb-4">
                                    <div class="card border-left-info shadow h-100 py-2">
                                        <div class="card-body">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col mr-2">
                                                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Total Category
                                                    </div>
                                                    <div class="row no-gutters align-items-center">
                                                        <div class="col-auto">
                                                            <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?= $count->counting_rows('category'); ?></div>
                                                        </div>                                                    
                                                    </div>
                                                </div>                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
        
                                <div class="col-xl-3 col-md-6 mb-4">
                                    <div class="card border-left-warning shadow h-100 py-2">
                                        <div class="card-body">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col mr-2">
                                                    <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                                        Total Documents</div>
                                                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $count->counting_rows('documents'); ?></div>
                                                </div>                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    <?php }else { ?>
                            <div class="row">
                                <div class="col-xl-4 col-md-6 mb-4">
                                    <div class="card border-left-primary shadow h-100 py-2">
                                        <div class="card-body">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col mr-2">
                                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                        Total Documents</div>
                                                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $count->counting_things('documents', 'uid', $cid); ?></div>
                                                </div>
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
        
                                <div class="col-xl-4 col-md-6 mb-4">
                                    <div class="card border-left-success shadow h-100 py-2">
                                        <div class="card-body">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col mr-2">
                                                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                        Total Categories</div>
                                                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $count->counting_rows('category'); ?></div>
                                                </div>                                               
                                            </div>
                                        </div>
                                    </div>
                                </div>
        
                                <div class="col-xl-4 col-md-6 mb-4">
                                    <div class="card border-left-info shadow h-100 py-2">
                                        <div class="card-body">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col mr-2">
                                                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Total Recycles
                                                    </div>
                                                    <div class="row no-gutters align-items-center">
                                                        <div class="col-auto">
                                                            <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?= $count->second_counting_things('documents', 'uid', $cid, 'deleted', 1); ?></div>
                                                        </div>                                                        
                                                    </div>
                                                </div>                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                    <?php }
                    ?>
                    <!-- Content Row -->
                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <?php include (ROOT_PATH . '/includes/footer.php')?>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->
    </div>

    <?php include (ROOT_PATH . "/includes/scripts.php"); ?>
</body>
</html>