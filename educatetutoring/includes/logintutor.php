<?php ob_start(); ?>
<?php session_start(); ?>
<?php include "../admin/includes/connection.php"; ?>
<?php include "../admin/includes/functions.php"; ?>
    
<?php 
    if (isset($_POST['login'])){
        tutor_login($_POST['username'], $_POST['password']);
    }
?>