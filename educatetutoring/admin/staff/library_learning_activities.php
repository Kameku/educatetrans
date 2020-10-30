<?php include "../includes/header.php"; ?>
<?php
    $query  = "SELECT library_learning_activities.*";
    $query .= ", library_concepts.concept ";
    $query .=  "FROM library_learning_activities ";
    $query .= "JOIN library_concepts ON library_learning_activities.learning_activity_concept_id = library_concepts.concept_id ";
    $query .= "ORDER BY concept ASC, learning_activity ASC";
    $select_learning_activities = mysqli_query($connection, $query);
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
                        Library: Learning Activities
                        <div class="pull-right">
                            <button type="button" class="btn btn-success btn-md" name="learning_activity_add" id="learning_activity_add" data-target="#learning_activity_editable_modal" data-backdrop="static" data-keyboard="false" data-toggle="modal">
                                <span><i class="fas fa-plus"></i></span>  Add New
                            </button>
                        </div>
                    </h1>
                </div>
            </div> <!-- /.row -->
            <div class="row">
                <div class="col-lg-12"  id="learning_activities_table">
                    <table class="table table-bordered table-striped table-hover" id="library_learning_activities"> <!-- id for DataTable -->
                        <thead  class="bg-primary">
                            <tr>
                                <th>Concept</th>
                                <th>Learning Activity</th>
                                <th width="5%" class="text-center">Id</th>
                                <th width="5%" class="text-center">Update</th>
                                <th width="5%" class="text-center">Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                while($row = mysqli_fetch_assoc($select_learning_activities)){
                            ?>
                                <tr>
                                    <td><?php echo $row['concept']; ?></td>
                                    <td><?php echo $row['learning_activity']; ?></td>
                                    <td class="text-center"><?php echo $row['learning_activity_id']; ?></td>
                                    <td class="text-center">
                                        <span type="button" class="btn btn-warning btn-xs learning_activity_update" name="learning_activity_update" id="<?php echo $row['learning_activity_id']; ?>">
                                            <i class='far fa-edit'></i>
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <span type="button" class="btn btn-danger btn-xs learning_activity_delete" name="learning_activity_delete" id="<?php echo $row['learning_activity_id']; ?>">
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
<div class="modal fade" id="learning_activity_editable_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
<!--                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>-->
                <h4 class="modal-title" id="myModalLabel">Library</h4>
            </div>
            <div class="modal-body">
                <form method="post" id="learning_activity_insert_form">
                    <div class="form-group">
                        <label for="concept">Learning Activity</label>
                        <input class="form-control" type="text" name="learning_activity" id="learning_activity" required />
                    </div>
                    <div class="form-group">
                        <label for="learning_activity_concept">Concept</label>
                        <select class="form-control" name="learning_activity_concept" id="learning_activity_concept" required>
                            <option value="">------ Select ------</option>
                            <?php
                                $query = "SELECT * FROM library_concepts ORDER BY concept ASC"; 
                                $select_concept = mysqli_query($connection, $query);
                                while($row      = mysqli_fetch_assoc($select_concept)){
                                    $concept_id = $row['concept_id'];
                                    $concept    = $row['concept'];
                                    echo "<option value='$concept_id'>{$concept}</option>";
                                }
                            ?>
                        </select>
                        <input type="hidden" name="learning_activity_id" id="learning_activity_id" />
                    </div>                    
                    <div class="form-group text-right">
                        <button type="button" class="btn btn-default" data-dismiss="modal" id="learning_activity_insert_cancel">Cancel</button>
                        <input class="btn btn-success" type="submit" name="learning_activity_insert" id="learning_activity_insert" value="" />
                    </div>
                </form>
            </div>
        </div> <!-- /.modal-content -->
    </div> <!-- /.modal-dialog -->
</div> <!-- /.modal -->

<script>
    $(document).ready(function(){
        //DataTable
        $('#library_learning_activities').DataTable();
    });
    
    //++++++++++++++++++++ library_learning_activities CRUD +++++++++++++++++++//
    $(document).ready(function(){
        //-------------------- add_new_button --------------------//
        $('#learning_activity_add').click(function(){
            $('#learning_activity_insert').val("Add");
            $('#learning_activity_insert_form')[0].reset();
        });
        //-------------------- update_button(fetch data) --------------------//
        $(document).on('click', '.learning_activity_update', function(){
            var learning_activity_id = $(this).attr("id");
            $.ajax({
                url:"CRUD/fetch.php",
                method:"POST",
                data:{learning_activity_id:learning_activity_id},
                dataType:"json",
                success:function(data){
                    $('#learning_activity').val(data.learning_activity);
                    $('#learning_activity_concept').val(data.learning_activity_concept_id);
                    $('#learning_activity_id').val(data.learning_activity_id);
                    $('#learning_activity_insert').val("Update");
                    $("#learning_activity_editable_modal").modal({backdrop:'static', keyboard: false});
                    $('#learning_activity_editable_modal').modal('show');
                }
            });
        });
        //-------------------- for both add_submit & update_submit buttons in editable_modal --------------------//
        $('#learning_activity_insert_form').on("submit", function(event){
            event.preventDefault();
            $.ajax({
                url:"CRUD/insert.php",
                method:"POST",
                data:$('#learning_activity_insert_form').serialize(),
                success:function(data){
                    $('#learning_activity_insert_form')[0].reset();
                    $('#learning_activity_editable_modal').modal('hide');
                    $('#learning_activities_table').html(data);
                    location.reload(); //check_point: must have!
                }
            });
        });
        $("#learning_activity_insert_cancel").on("click", function(event){
            $("#learning_activity_insert_form")[0].reset();
            location.reload(); //check_point: must have!
        });
        //-------------------- delete_button --------------------//
        $(document).on('click', '.learning_activity_delete', function(event){
            event.preventDefault();
            var learning_activity_id = $(this).attr("id");
            if(confirm("Are you sure to delete this record ?")){
                $.ajax({
                    url:"CRUD/delete.php",
                    method:"POST",
                    data:{learning_activity_id:learning_activity_id},
                    success:function(){
                        location.reload();
                    }
                });
            }
        });
    });    
</script>

<?php include "../includes/footer.php"; ?>