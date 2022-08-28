<?php
session_start();

include ('../path.php');

unset($_SESSION['userAssessmentDMS']);
header('location: ' . BASE_URL . '/index');
?>