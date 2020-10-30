<?php include "../includes/header.php"; ?>
<?php
    $query  = "SELECT CONCAT(student_firstname, ' ', student_lastname) AS student_name, student_id FROM admin_student_registration";
    $select_student  = mysqli_query($connection, $query);
?>

<div id="wrapper">
    <!-- Navigation -->
    <?php include "includes/navtopbar.php"; ?>
    <?php include "includes/navsidebar.php"; ?>
    <!-- Page Content -->
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Student Summaries</h1>
                </div>
            </div> <!-- /.row -->
            <div class="row">
                <div class="col-lg-12"  id="student_summary_table">
                    <table class="table table-bordered table-striped table-hover" id="admin_student_summary"> <!-- id for DataTable -->
                        <thead class="bg-primary">
                            <tr>
                                <th>Student Name</th>
                                <th width="5%" class="text-center">Id</th>
                                <th width="5%" class="text-center">View</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                while($row = mysqli_fetch_assoc($select_student)){
                                    $student_id   = $row['student_id'];
                                    $student_name = $row['student_name'];
                            ?>
                                <tr>
                                    <td><?php echo $student_name; ?></td>
                                    <td class="text-center"><?php echo $student_id; ?></td>
                                    <td class="text-center">
                                        <a class="btn btn-xs btn-info" href="admin_student_summary.php?id=<?php echo $student_id; ?>"> <!--target="_blank"-->
                                            <i class='fas fa-search-plus'></i>
                                        </a>
                                    </td>
                                </tr>
                            <?php
                                }
                            ?>
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
        //-------------------- DataTable --------------------//
        $("#admin_student_summary").DataTable();
    });   
</script>

<?php include "../includes/footer.php"; ?>