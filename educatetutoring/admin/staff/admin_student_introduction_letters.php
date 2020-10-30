<?php include "../includes/header.php"; ?>
<?php
    $query  = "SELECT * FROM admin_student_intro_letter ORDER BY letter_id ASC, letter_student_id ASC";
    $select_students  = mysqli_query($connection, $query);
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
                    <h1 class="page-header">
                        Student Introduction Letters
                        <div class="pull-right">
                            <button type="button" class="btn btn-success btn-md" name="student_intro_letter_add" id="student_intro_letter_add" data-target="#student_intro_letter_editable_modal" data-backdrop="static" data-keyboard="false" data-toggle="modal">
                                <span><i class="fas fa-plus"></i></span>  Add New
                            </button>
                        </div>
                    </h1>
                </div>
            </div> <!-- /.row -->
            <div class="row">
                <div class="col-lg-12"  id="student_intro_letter_table">
                    <table class="table table-bordered table-striped table-hover" id="admin_student_intro_letter"> <!-- id for DataTable -->
                        <thead class="bg-primary">
                            <tr>
                                <th>First Name</th>           
                                <th>Last Name</th>
                                <th class="text-center">Current</th>
                                <th width="5%" class="text-center">Id</th>
                                <th width="5%" class="text-center">View</th>
                                <th width="5%" class="text-center">Update</th>
                                <th width="5%" class="text-center">Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                while($row = mysqli_fetch_assoc($select_students)){
                                    $student_id        = $row['student_id'];
                                    $student_firstname = $row['student_firstname'];
                                    $student_lastname  = $row['student_lastname'];
                                    $student_current   = $row['student_current'];
                            ?>
                                <tr>
                                    <td><?php echo $student_firstname; ?></td>
                                    <td><?php echo $student_lastname; ?></td>
                                    <td class="text-center">
                                        <?php
                                        if($student_current == 'Yes'){
                                            echo "<span class='text-success'><i class='fas fa-check'></i>  {$student_current}</span>";
                                        }else{
                                            echo "<span class='text-danger'><i class='fas fa-times'></i>  {$student_current}</span>";
                                        }                
                                        ?>
                                    </td>
                                    <td class="text-center"><?php echo $student_id; ?></td>
                                    <td class="text-center">
                                        <span type="button" class="btn btn-info btn-xs student_intro_letter_view" name="student_intro_letter_view" id="<?php echo $row['student_id']; ?>">
                                            <i class='fas fa-search-plus'></i>
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <span type="button" class="btn btn-warning btn-xs student_intro_letter_update" name="student_intro_letter_update" id="<?php echo $row['student_id']; ?>">
                                            <i class='far fa-edit'></i>
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <span type="button" class="btn btn-danger btn-xs student_intro_letter_delete" name="student_intro_letter_delete" id="<?php echo $row['student_id']; ?>">
                                            <i class='far fa-trash-alt'></i>
                                        </span>
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

<!-- editable_modal -->
<div class="modal fade" id="student_intro_letter_editable_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
<!--                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>-->
                <h4 class="modal-title" id="myModalLabel">Introduction Letter Data Input</h4>
            </div>
            <div class="modal-body">
                <form method="post" id="student_intro_letter_insert_form">
                    <input type="hidden" name="student_id" id="student_id" />
                    <div class="form-group">
                        <label for="student_firstname">Student Firstname *</label>
                        <input type="text" class="form-control" name="student_firstname" id="student_firstname" required />
                    </div>
                    <div class="form-group">
                        <label for="student_lastname">Student Lastname *</label>
                        <input type="text" class="form-control" name="student_lastname" id="student_lastname" required />
                    </div>
                    <div class="form-group">
                        <label for="student_current">Current *</label>
                        <select class="form-control" name="student_current" id="student_current" required>
                            <option value="">------ Select ------</option>
                            <option value="Yes">Yes</option>
                            <option value="No">No</option>
                        </select>
                    </div>
                    <hr />
                    <div class="form-group text-right">
                        <button type="button" class="btn btn-default" data-dismiss="modal" id="student_intro_letter_insert_cancel">Cancel</button>
                        <input class="btn btn-success" type="submit" name="student_intro_letter_insert" id="student_intro_letter_insert" value="" />
                    </div>
                </form>
            </div>
        </div> <!-- /.modal-content -->
    </div> <!-- /.modal-dialog -->
</div> <!-- /.modal -->

<!-- readonly_modal -->
<div class="modal fade" id="student_intro_letter_readonly_modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Student Introduction Letter</h4>
            </div>
            <div class="modal-body" id="student_intro_letter_details">
                <!--show data here-->
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function(){
        
    });      
</script>

<?php include "../includes/footer.php"; ?>