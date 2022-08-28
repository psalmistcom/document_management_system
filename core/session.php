<?php 
    session_start();
    require_once 'auth.php';

    $cuser = new Auth();

    if (!isset($_SESSION['userAssessmentDMS'])) {
        header('location:' . BASE_URL . '/index');
        die;
    }

    $cemail = $_SESSION['userAssessmentDMS'];
    $data = $cuser->currentUser($cemail);

    $cid = $data['id'];
    $cname = $data['name'];
    $cpassword = $data['password'];
    $cuser_type = $data['user_type'];
    $verified = $data['verified'];
    $created_at = $data['created_at'];
    $deleted = $data['deleted'];

    if($verified == 0){
        $verified = 'NOT';
    }else {
        $verified = 'YES';
    }
    $getCategories = $cuser->get_all('category');