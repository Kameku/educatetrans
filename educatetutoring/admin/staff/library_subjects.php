<?php include "../includes/header.php"; ?>
<?php
    $query            = "SELECT * FROM library_subjects ORDER BY subject ASC";
    $select_subjects  = mysqli_query($connection, $query);
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
                        Library: Subjects
                        <div class="pull-right">
                            <button type="button" class="btn btn-success btn-md" name="subject_add" id="subject_add" data-target="#subject_editable_modal" data-backdrop="static" data-keyboard="false" data-toggle="modal">
                                <span><i class="fas fa-plus"></i></span>  Add New
                            </button>
                        </div>
                    </h1>
                </div>
            </div> <!-- /.row -->
            <div class="row">
                <div class="col-lg-12"  id="subjects_table">
                    <table class="table table-bordered table-striped table-hover" id="library_subjects"> <!-- id for DataTable -->
                        <thead  class="bg-primary">
                            <tr>
                                <th>Subject</th>
                                <th width="5%" class="text-center">Id</th>
                                <th width="5%" class="text-center">Update</th>
                                <th width="5%" class="text-center">Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                while($row = mysqli_fetch_assoc($select_subjects)){
                            ?>
                                <tr>
                                    <td><?php echo $row['subject']; ?></td>
                                    <td class="text-center"><?php echo $row['subject_id']; ?></td>
                                    <td class="text-center">
                                        <span type="button" class="btn btn-warning btn-xs subject_update" name="subject_update" id="<?php echo $row['subject_id']; ?>">
                                            <i class='far fa-edit'></i>
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <span type="button" class="btn btn-danger btn-xs subject_delete" name="subject_delete" id="<?php echo $row['subject_id']; ?>">
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
<div class="modal fade" id="subject_editable_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
<!--                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>-->
                <h4 class="modal-title" id="myModalLabel">Library</h4>
            </div>
            <div class="modal-body">
                <form method="post" id="subject_insert_form">
                    <div class="form-group">
                        <label for="subject">Subject</label>
                        <input class="form-control" type="text" name="subject" id="subject" required />
                        <input type="hidden" name="subject_id" id="subject_id" />
                    </div>
                    <div class="form-group text-right">
                        <button type="button" class="btn btn-default" data-dismiss="modal" id="subject_insert_cancel">Cancel</button>
                        <input class="btn btn-success" type="submit" name="subject_insert" id="subject_insert" value="" />
                    </div>
                </form>
            </div>
        </div> <!-- /.modal-content -->
    </div> <!-- /.modal-dialog -->
</div> <!-- /.modal -->

<script>    
    $(document).ready(function(){
        //DataTable
        $('#library_subjects').DataTable();
    });
    
    //++++++++++++++++++++ library_subjects CRUD +++++++++++++++++++//
    $(document).ready(function(){
        //-------------------- add_new_button --------------------//
        $('#subject_add').click(function(){
            $('#subject_insert').val("Add");
            $('#subject_insert_form')[0].reset();
        });
        //-------------------- update_button(fetch data) --------------------//
        $(document).on('click', '.subject_update', function(){
            var subject_id = $(this).attr("id");
            $.ajax({
                url:"CRUD/fetch.php",
                method:"POST",
                data:{subject_id:subject_id},
                dataType:"json",
                success:function(data){
                    $('#subject').val(data.subject);
                    $('#subject_id').val(data.subject_id);
                    $('#subject_insert').val("Update");
                    $("#subject_editable_modal").modal({backdrop:'static', keyboard: false});
                    $('#subject_editable_modal').modal('show');
                }
            });
        });
        //-------------------- for both add_submit & update_submit buttons in editable_modal --------------------//
        $('#subject_insert_form').on("submit", function(event){
            event.preventDefault();
            $.ajax({
                url:"CRUD/insert.php",
                method:"POST",
                data:$('#subject_insert_form').serialize(),
                success:function(data){
                    $('#subject_insert_form')[0].reset();
                    $('#subject_editable_modal').modal('hide');
                    $('#subjects_table').html(data);
                    location.reload(); //check_point: must have!
                }
            });
        });
        $("#subject_insert_cancel").on("click", function(event){
            $("#subject_insert_form")[0].reset();
            location.reload(); //check_point: must have!
        });
        //-------------------- delete_button --------------------//
        $(document).on('click', '.subject_delete', function(event){
            event.preventDefault();
            var subject_id = $(this).attr("id");
            if(confirm("Are you sure to delete this record ?")){
                $.ajax({
                    url:"CRUD/delete.php",
                    method:"POST",
                    data:{subject_id:subject_id},
                    success:function(){
                        location.reload();
                    }
                });
            }
        });
    });
</script>

<?php include "../includes/footer.php"; ?>