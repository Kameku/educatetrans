<?php include "../includes/header.php"; ?>

<div id="wrapper">
    <!-- Navigation -->
    <?php include "includes/navtopbar.php"; ?>
    <?php include "includes/navsidebar.php"; ?>
    <!-- Page Content -->
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Library</h1>
                </div>
            </div> <!-- /.row -->  
            <div class="row">
                <div class="col-lg-12">
                    <table class="table table-bordered table-striped table-hover" id="library"> <!-- id for DataTable -->
                        <thead>
                            <tr>
                                <th>Subject</th>
                                <th>Concept</th>
                                <th>Concept Detail</th>
                                <th>Id</th>
<!--                                <th>Learning Activity</th>-->
                            </tr>
                        </thead>
                        <tbody>
                            <?php library_read(); ?>
                        </tbody>
                    </table>
                    <hr>
                </div> <!-- col-lg-12 -->
            </div> <!-- /.row --> 
        </div> <!-- /.container-fluid -->
    </div> <!-- /#page-wrapper -->
</div> <!-- /#wrapper -->

<script>
    $(document).ready(function(){
        //DataTable
        $('#library').DataTable();
    });    
</script>   

<?php include "../includes/footer.php"; ?>