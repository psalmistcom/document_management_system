<?php
    session_start();
    require_once 'auth.php';
    $user = new Auth();

    if(isset($_POST['action']) && $_POST['action'] ==='register') {
        unset($_POST['action']);
        // var_dump($_POST);

        $name = $user->test_input($_POST['userName']);
        $email = $user->test_input($_POST['userEmail']);
        $password = $user->test_input($_POST['userPassword']);
        $confUserPassword = $user->test_input($_POST['confUserPassword']);

        if (!empty($name) && !empty($email) && !empty($password)) {            
            if ($confUserPassword !== $password) {
                echo $user->showMessage('danger','Password Not Match!');
            }else {
                $hpass = password_hash($password, PASSWORD_DEFAULT);
                if ($user->alreadyExist('users', $email, 'email')){
                    echo $user->showMessage('Warning', 'This Email is already registered');
                }else {
                    if($user->register($name,$email,$hpass)){
                        echo 'register' ;
                        $_SESSION['userAssessmentDMS'] = $email;
                    }else {
                        echo $user->showMessage('danger','Something went wrong! Try again later!');
                    }
                }
            }
        }else {
            echo $user->showMessage('danger','All fields are required!');
        }
    }

    if (isset($_POST['action']) && $_POST['action'] === 'login') {
        unset($_POST['action']);
        // var_dump($_POST);
        $loginEmail = $user->test_input($_POST['loginEmail']);
        $loginPasswor = $user->test_input($_POST['loginPasswor']);

        $loggedInUser = $user->login($loginEmail);
        if($loggedInUser != null){
            if(password_verify($loginPasswor, $loggedInUser['password'])){                
                echo 'userLogin';
                $_SESSION['userAssessmentDMS'] = $loginEmail;
            }else {
                echo $user->showMessage('danger', 'Password is incorrect');
            }
        }else {
            echo $user->showMessage('danger', 'User Not Found!');
        }

    }