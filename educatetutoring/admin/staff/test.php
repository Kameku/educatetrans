<?php ob_start(); ?>
<?php session_start(); ?>


<?php
//if(!isset($_SESSION['username'])){
//    header ("Location: login.php");
//}
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
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.11/css/all.css" integrity="sha384-p2jx59pefphTFIpeqCcISO9MdVfIm4pNnsL08A6v5vaQc4owkQqxMV8kg4Yvhaw/" crossorigin="anonymous">
        
    <!-- ckeditor for textarea -->
    <script src="https://cdn.ckeditor.com/ckeditor5/10.0.0/classic/ckeditor.js"></script><!--local added 20180502-->
    
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
    
    <!-- My Scripts -->
    <script src="../../js/myscripts.js"></script>
    
</head>

<body>
                               <textarea class="form-control" name="enquiry_notes" id="enquiry_notes" rows="15"></textarea>
                                <script>
                                    ClassicEditor
                                        .create( document.querySelector( '#enquiry_notes' ) ) //match point "id" in textarea
                                        .catch( error => {
                                            console.error( error );
                                        } );
                                </script>
                                <?php include "../includes/footer.php"; ?>