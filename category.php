<?php 
    // session_start();
    include 'path.php'; 
    include (ROOT_PATH . '/init.php');    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Category - Document Management System</title>
    <?php include (ROOT_PATH . "/includes/head.php"); ?>
</head>
<body id="page-top">
    <div id="wrapper">
        <?php 
            $page = "category";
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
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Category</h1>       
                        <a href="#" data-toggle="modal" data-target="#addCategory" class="btn btn-sm btn-bg-primary text-white shadow-sm">
                            <i class="fas fa-fw fa-table fa-sm text-white"></i> Add Category
                        </a>                 
                    </div>

                    <!-- Content Row -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold primary-text-color">Added Category</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive" id="showCategory">
                                <p>Loading categories... </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <?php include (ROOT_PATH . '/includes/modals.php')?>
            <!-- Footer -->
            <?php include (ROOT_PATH . '/includes/footer.php')?>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->
    </div>

    <?php include (ROOT_PATH . "/includes/scripts.php"); ?>
    <script src="<?= BASE_URL . '/assets/js/category.js'; ?>"></script>
</body>
</html>