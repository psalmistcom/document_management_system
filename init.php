<?php 
    include (ROOT_PATH . '/core/session.php');

    if ($verified === 'NOT') {
        header('location:' . BASE_URL . '/verification');
    }    

    // DOwnload doc
    if (isset($_GET['download_doc_id'])) {
        $id = $_GET['download_doc_id'];

        $download = $cuser->download_doc($id);
        $filepath = 'assets/docs/' . $download['main_doc'];

        if (file_exists($filepath)) {
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename=' . basename($filepath));
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize('assets/docs/' . $download['main_doc']));
            readfile('assets/docs/' . $download['main_doc']);
        }else {
            echo "Something went wrong";
        }
    }