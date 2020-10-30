<?php ob_start(); ?>
<?php session_start(); ?>
<?php include "connection.php"; ?>
<?php include "functions.php"; ?>

<?php
    if(!isset($_SESSION['username'])){
        header ("Location: ../../welcome.php");
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    
    <title>Educate Tutoring</title>
    
    <!-- Bootstrap Core CSS -->
    <link href="../../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../../vendor/bootstrap/css/bootstrap.css" rel="stylesheet">
    
    <!-- jQuery -->
    <script src="../../vendor/jquery/jquery.min.js"></script>
    
    <!-- MetisMenu CSS -->
    <link href="../../vendor/metisMenu/metisMenu.min.css" rel="stylesheet">
    
    <!-- Custom CSS -->
    <link href="../../dist/css/sb-admin-2.css" rel="stylesheet">
    <link href="../../dist/css/styles.css" rel="stylesheet"> <!--added 20180429-->
    
    <!-- Morris Charts CSS -->
    <link href="../../vendor/morrisjs/morris.css" rel="stylesheet">
    
    <!-- Custom Fonts -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
        
    <!-- ckeditor for textarea -->
    <script src="../../vendor/ckeditor/ckeditor.js"></script> <!--local added 20180502-->
    
    <!-- DataTables CSS -->
    <link href="../../vendor/datatables/datatables.min.css" rel="stylesheet" type="text/css"> <!--local added 20180505-->
    <script src="../../vendor/datatables/datatables.min.js" type="text/javascript"></script> <!--local added 20180505-->
    
    <!-- datepicker -->
    <link href="../../vendor/datepicker/css/datepicker.css" rel="stylesheet"> <!--local added 20180507-->
    <script src="../../vendor/datepicker/js/bootstrap-datepicker.js"></script> <!--local added 20180507-->
    
    <!-- bootstrap-float-label -->
    <link href="../../vendor/bootstrap-float-label-master/bootstrap-float-label.css" rel="stylesheet"> <!--local added 20180508-->
    <script src="../../vendor/bootstrap-float-label-master/bootstrap-float-label.js"></script> <!--local added 20180508-->
    
    <!-- jqBootstrapValidation -->
    <script src="../../vendor/jqBootstrapValidation-master/src/jqBootstrapValidation.js"></script>
    
    <!-- bootstrap-select --> <!-- http://silviomoreto.github.io/bootstrap-select/ -->
<!--
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/css/bootstrap-select.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/js/bootstrap-select.min.js"></script>
-->
    
    <!-- My Scripts -->
    <script src="../../js/myscripts.js"></script>
    
</head>

<body>