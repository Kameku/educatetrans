<?php include "../includes/header.php"; ?>
<?php
    $query  = "SELECT library_concepts.*";
    $query .= ", library_subjects.subject ";
    $query .=  "FROM library_concepts ";
    $query .= "JOIN library_subjects ON library_concepts.concept_subject_id = library_subjects.subject_id ";
    $query .= "ORDER BY subject ASC, concept ASC";
    $select_concepts = mysqli_query($connection, $query);
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
                        Library: Concepts
                        <div class="pull-right">
                            <button type="button" class="btn btn-success btn-md" name="concept_add" id="concept_add" data-target="#concept_editable_modal" data-backdrop="static" data-keyboard="false" data-toggle="modal">
                                <span><i class="fas fa-plus"></i></span>  Add New
                            </button>
                        </div>
                    </h1>
                </div>
            </div> <!-- /.row -->
            <div class="row">
                <div class="col-lg-12"  id="concepts_table">
                    <table class="table table-bordered table-striped table-hover" id="library_concepts"> <!-- id for DataTable -->
                        <thead  class="bg-primary">
                            <tr>
                                <th>Subject</th>
                                <th>Concept</th>
                                <th width="5%" class="text-center">Id</th>
                                <th width="5%" class="text-center">Update</th>
                                <th width="5%" class="text-center">Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                while($row = mysqli_fetch_assoc($select_concepts)){
                            ?>
                                <tr>
                                    <td><?php echo $row['subject']; ?></td>
                                    <td><?php echo $row['concept']; ?></td>
                                    <td class="text-center"><?php echo $row['concept_id']; ?></td>
                                    <td class="text-center">
                                        <span type="button" class="btn btn-warning btn-xs concept_update" name="concept_update" id="<?php echo $row['concept_id']; ?>">
                                            <i class='far fa-edit'></i>
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <span type="button" class="btn btn-danger btn-xs concept_delete" name="concept_delete" id="<?php echo $row['concept_id']; ?>">
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
<div class="modal fade" id="concept_editable_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
<!--                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>-->
                <h4 class="modal-title" id="myModalLabel">Library</h4>
            </div>
            <div class="modal-body">
                <form method="post" id="concept_insert_form">
                    <div class="form-group">
                        <label for="concept">Concept</label>
                        <input class="form-control" type="text" name="concept" id="concept" required />
                    </div>
                    <div class="form-group">
                        <label for="concept_subject">Subject</label>
                        <select class="form-control" name="concept_subject" id="concept_subject" required>
                            <option value="">------ Select ------</option>
                            <?php
                                $query = "SELECT * FROM library_subjects ORDER BY subject ASC"; 
                                $select_subject = mysqli_query($connection, $query);
                                while($row      = mysqli_fetch_assoc($select_subject)){
                                    $subject_id = $row['subject_id'];
                                    $subject    = $row['subject'];
                                    echo "<option value='$subject_id'>{$subject}</option>";
                                }
                            ?>
                        </select>
                        <input type="hidden" name="concept_id" id="concept_id" />
                    </div>                    
                    <div class="form-group text-right">
                        <button type="button" class="btn btn-default" data-dismiss="modal" id="concept_insert_cancel">Cancel</button>
                        <input class="btn btn-success" type="submit" name="concept_insert" id="concept_insert" value="" />
                    </div>
                </form>
            </div>
        </div> <!-- /.modal-content -->
    </div> <!-- /.modal-dialog -->
</div> <!-- /.modal -->

<script>
    $(document).ready(function(){
        //DataTable
        $('#library_concepts').DataTable();
    });
    
    //++++++++++++++++++++ library_concepts CRUD +++++++++++++++++++//
    $(document).ready(function(){
        //-------------------- add_new_button --------------------//
        $('#concept_add').click(function(){
            $('#concept_insert').val("Add");
            $('#concept_insert_form')[0].reset();
        });
        //-------------------- update_button(fetch data) --------------------//
        $(document).on('click', '.concept_update', function(){
            var concept_id = $(this).attr("id");
            $.ajax({
                url:"CRUD/fetch.php",
                method:"POST",
                data:{concept_id:concept_id},
                dataType:"json",
                success:function(data){
                    $('#concept').val(data.concept);
                    $('#concept_subject').val(data.concept_subject_id);
                    $('#concept_id').val(data.concept_id);
                    $('#concept_insert').val("Update");
                    $("#concept_editable_modal").modal({backdrop:'static', keyboard: false});
                    $('#concept_editable_modal').modal('show');
                }
            });
        });
        //-------------------- for both add_submit & update_submit buttons in editable_modal --------------------//
        $('#concept_insert_form').on("submit", function(event){
            event.preventDefault();
            $.ajax({
                url:"CRUD/insert.php",
                method:"POST",
                data:$('#concept_insert_form').serialize(),
                success:function(data){
                    $('#concept_insert_form')[0].reset();
                    $('#concept_editable_modal').modal('hide');
                    $('#concepts_table').html(data);
                    location.reload(); //check_point: must have!
                }
            });
        });
        $("#concept_insert_cancel").on("click", function(event){
            $("#concept_insert_form")[0].reset();
            location.reload(); //check_point: must have!
        });
        //-------------------- delete_button --------------------//
        $(document).on('click', '.concept_delete', function(event){
            event.preventDefault();
            var concept_id = $(this).attr("id");
            if(confirm("Are you sure to delete this record ?")){
                $.ajax({
                    url:"CRUD/delete.php",
                    method:"POST",
                    data:{concept_id:concept_id},
                    success:function(){
                        location.reload();
                    }
                });
            }
        });
    });    
</script>

<?php include "../includes/footer.php"; ?>