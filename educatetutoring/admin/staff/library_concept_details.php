<?php include "../includes/header.php"; ?>
<?php
    $query  = "SELECT library_concept_details.*";
    $query .= ", library_concepts.concept ";
    $query .=  "FROM library_concept_details ";
    $query .= "JOIN library_concepts ON library_concept_details.concept_detail_concept_id = library_concepts.concept_id ";
    $query .= "ORDER BY concept ASC, concept_detail ASC";
    $select_concept_details = mysqli_query($connection, $query);
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
                        Library: Concept Details
                        <div class="pull-right">
                            <button type="button" class="btn btn-success btn-md" name="concept_detail_add" id="concept_detail_add" data-target="#concept_detail_editable_modal" data-backdrop="static" data-keyboard="false" data-toggle="modal">
                                <span><i class="fas fa-plus"></i></span>  Add New
                            </button>
                        </div>
                    </h1>
                </div>
            </div> <!-- /.row -->
            <div class="row">
                <div class="col-lg-12"  id="concept_details_table">
                    <table class="table table-bordered table-striped table-hover" id="library_concept_details"> <!-- id for DataTable -->
                        <thead  class="bg-primary">
                            <tr>
                                <th>Concept</th>
                                <th>Concept Detail</th>
                                <th width="5%" class="text-center">Id</th>
                                <th width="5%" class="text-center">Update</th>
                                <th width="5%" class="text-center">Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                while($row = mysqli_fetch_assoc($select_concept_details)){
                            ?>
                                <tr>
                                    <td><?php echo $row['concept']; ?></td>
                                    <td><?php echo $row['concept_detail']; ?></td>
                                    <td class="text-center"><?php echo $row['concept_detail_id']; ?></td>
                                    <td class="text-center">
                                        <span type="button" class="btn btn-warning btn-xs concept_detail_update" name="concept_detail_update" id="<?php echo $row['concept_detail_id']; ?>">
                                            <i class='far fa-edit'></i>
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <span type="button" class="btn btn-danger btn-xs concept_detail_delete" name="concept_detail_delete" id="<?php echo $row['concept_detail_id']; ?>">
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
<div class="modal fade" id="concept_detail_editable_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
<!--                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>-->
                <h4 class="modal-title" id="myModalLabel">Library</h4>
            </div>
            <div class="modal-body">
                <form method="post" id="concept_detail_insert_form">
                    <div class="form-group">
                        <label for="concept">Concept Detail</label>
                        <input class="form-control" type="text" name="concept_detail" id="concept_detail" required />
                    </div>
                    <div class="form-group">
                        <label for="concept_detail_concept">Concept</label>
                        <select class="form-control" name="concept_detail_concept" id="concept_detail_concept" required>
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
                        <input type="hidden" name="concept_detail_id" id="concept_detail_id" />
                    </div>                    
                    <div class="form-group text-right">
                        <button type="button" class="btn btn-default" data-dismiss="modal" id="concept_detail_insert_cancel">Cancel</button>
                        <input class="btn btn-success" type="submit" name="concept_detail_insert" id="concept_detail_insert" value="" />
                    </div>
                </form>
            </div>
        </div> <!-- /.modal-content -->
    </div> <!-- /.modal-dialog -->
</div> <!-- /.modal -->

<script>
    $(document).ready(function(){
        //DataTable
        $('#library_concept_details').DataTable();
    });
    
    //++++++++++++++++++++ library_concept_details CRUD +++++++++++++++++++//
    $(document).ready(function(){
        //-------------------- add_new_button --------------------//
        $('#concept_detail_add').click(function(){
            $('#concept_detail_insert').val("Add");
            $('#concept_detail_insert_form')[0].reset();
        });
        //-------------------- update_button(fetch data) --------------------//
        $(document).on('click', '.concept_detail_update', function(){
            var concept_detail_id = $(this).attr("id");
            $.ajax({
                url:"CRUD/fetch.php",
                method:"POST",
                data:{concept_detail_id:concept_detail_id},
                dataType:"json",
                success:function(data){
                    $('#concept_detail').val(data.concept_detail);
                    $('#concept_detail_concept').val(data.concept_detail_concept_id);
                    $('#concept_detail_id').val(data.concept_detail_id);
                    $('#concept_detail_insert').val("Update");
                    $("#concept_detail_editable_modal").modal({backdrop:'static', keyboard: false});
                    $('#concept_detail_editable_modal').modal('show');
                }
            });
        });
        //-------------------- for both add_submit & update_submit buttons in editable_modal --------------------//
        $('#concept_detail_insert_form').on("submit", function(event){
            event.preventDefault();
            $.ajax({
                url:"CRUD/insert.php",
                method:"POST",
                data:$('#concept_detail_insert_form').serialize(),
                success:function(data){
                    $('#concept_detail_insert_form')[0].reset();
                    $('#concept_detail_editable_modal').modal('hide');
                    $('#concept_details_table').html(data);
                    location.reload(); //check_point: must have!
                }
            });
        });
        $("#concept_detail_insert_cancel").on("click", function(event){
            $("#concept_detail_insert_form")[0].reset();
            location.reload(); //check_point: must have!
        });
        //-------------------- delete_button --------------------//
        $(document).on('click', '.concept_detail_delete', function(event){
            event.preventDefault();
            var concept_detail_id = $(this).attr("id");
            if(confirm("Are you sure to delete this record ?")){
                $.ajax({
                    url:"CRUD/delete.php",
                    method:"POST",
                    data:{concept_detail_id:concept_detail_id},
                    success:function(){
                        location.reload();
                    }
                });
            }
        });
    });    
</script>

<?php include "../includes/footer.php"; ?>