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
                    <h1 class="page-header">Settings</h1>
                </div> <!-- /.col-lg-12 -->
            </div> <!-- /.row --><!-- page title -->          
            
            <div class="row">
                <div class="col-lg-12">            
                    <div class="panel-group" id="accordion">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">Lessons</a>
                                </h4>
                            </div>
                            <div id="collapseOne" class="panel-collapse collapse in">
                                <div class="panel-body">
                                    <div class="col-xs-6"> <!-- table --> 
                                        <table class="table table-bordered table-striped table-hover">
                                            <thead>
                                                <tr>
                                                    <th>Id</th>
                                                    <th>Lesson</th>
                                                    <th class="text-center">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php lessons_find_all();?>
                                            </tbody> 
                                        </table>
                                    </div> <!-- end table -->
                                    <div class="col-xs-6"> <!-- add new-->
                                            <form action="" method="post">
                                                <div class="form-group">
                                                    <label for="lesson">Add New Lesson</label>
                                                    <input type="text" class="form-control" name="lesson">
                                                </div>
                                                <div class="form-group">
                                                    <input class="btn btn-success btn-block" type="submit" name="submit" value="Save">
                                                </div>
                                            </form>
                                            <?php lesson_create(); ?>
                                            <br/>
                                            <?php lesson_update(); ?>
                                    </div> <!-- end add new -->
                                </div>
                            </div>
                        </div>
                        
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">Collapsible Group Item #2</a>
                                </h4>
                            </div>
                            <div id="collapseTwo" class="panel-collapse collapse">
                                <div class="panel-body">
                                    Lorem ipsum dolor sit amet
                                </div>
                            </div>
                        </div>
                    </div> <!-- /.panel -->
                </div> <!-- /.col-lg-12 -->
            </div> <!-- /.row -->
        </div> <!-- /.container-fluid -->
    </div> <!-- /#page-wrapper -->
</div> <!-- /#wrapper -->

<?php include "../includes/footer.php"; ?>