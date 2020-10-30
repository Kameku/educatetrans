<?php include "../includes/header.php"; ?>
<?php
    $query  = "SELECT admin_student_users.*";
    $query .= ", CONCAT(admin_student_registration.student_firstname, ' ', admin_student_registration.student_lastname) AS user_fullname";
    $query .= ", settings_user_roles.role ";
    $query .= "FROM admin_student_users ";
    $query .= "JOIN admin_student_registration ON admin_student_users.user_student_id = admin_student_registration.student_id ";
    $query .= "JOIN settings_user_roles ON admin_student_users.user_role_id = settings_user_roles.role_id ";
    $query .= "ORDER BY user_fullname ASC, username ASC";
    $select_student_users  = mysqli_query($connection, $query);
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
                        Student Users
                        <div class="pull-right">
                            <button type="button" class="btn btn-success btn-md" name="student_user_add" id="student_user_add" data-target="#student_user_editable_modal" data-backdrop="static" data-keyboard="false" data-toggle="modal">
                                <span><i class="fas fa-plus"></i></span>  Add New
                            </button>
                        </div>
                    </h1>
                </div>
            </div> <!-- /.row -->
            <div class="row">
                <div class="col-lg-12"  id="student_users_table">
                    <table class="table table-bordered table-striped table-hover" id="admin_student_users"> <!-- id for DataTable -->
                        <thead class="bg-primary">
                            <tr>
                                <th>Name</th>           
                                <th>Username</th>
                                <th>Role</th>
                                <th class="text-center">Date Created</th>
                                <th class="text-center">Current</th>
                                <th width="5%" class="text-center">Id</th>
                                <th width="5%" class="text-center">View</th>
                                <th width="5%" class="text-center">Update</th>
                                <th width="5%" class="text-center">Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                while($row = mysqli_fetch_assoc($select_student_users)){
                                    $student_fullname      = $row['user_fullname'];
                                    $student_username      = $row['username'];
                                    $student_user_role     = $row['role'];
                                    $student_date_created  = $row['date_created'];
                                    $student_user_current  = $row['user_current'];
                                    $student_user_id       = $row['student_user_id'];
                            ?>
                                <tr>
                                    <td><?php echo $student_fullname; ?></td>
                                    <td><?php echo $student_username; ?></td>
                                    <td><?php echo $student_user_role; ?></td>
                                    <td class="text-center"><?php echo $student_date_created; ?></td>
                                    <td class="text-center">
                                        <?php
                                        if($student_user_current == 'Yes'){
                                            echo "<span class='text-success'><i class='fas fa-check'></i>  {$student_user_current}</span>";
                                        }else{
                                            echo "<span class='text-danger'><i class='fas fa-times'></i>  {$student_user_current}</span>";
                                        }                
                                        ?>
                                    </td>
                                    <td class="text-center"><?php echo $student_user_id; ?></td>
                                    <td class="text-center">
                                        <span type="button" class="btn btn-info btn-xs student_user_view" name="student_user_view" id="<?php echo $row['student_user_id']; ?>">
                                            <i class='fas fa-search-plus'></i>
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <span type="button" class="btn btn-warning btn-xs student_user_update" name="student_user_update" id="<?php echo $row['student_user_id']; ?>">
                                            <i class='far fa-edit'></i>
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <span type="button" class="btn btn-danger btn-xs student_user_delete" name="student_user_delete" id="<?php echo $row['student_user_id']; ?>">
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
<div class="modal fade" id="student_user_editable_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
<!--                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>-->
                <h4 class="modal-title" id="myModalLabel">Student User Details</h4>
            </div>
            <div class="modal-body">
                <form method="post" id="student_user_insert_form">
                    <div class="form-group">
                        <label for="student_fullname">Name *</label>
                        <select class="form-control" name="student_fullname" id="student_fullname" required>
                            <option value="">------ Select ------</option>
                            <?php
                                $query = "SELECT student_id, CONCAT(admin_student_registration.student_firstname, ' ', admin_student_registration.student_lastname) AS student_fullname FROM admin_student_registration ORDER BY student_fullname ASC";
                                $select_student_fullname = mysqli_query($connection, $query);
                                while($row   = mysqli_fetch_assoc($select_student_fullname)){
                                    $student_id       = $row['student_id'];
                                    $student_fullname = $row['student_fullname'];
                                    echo "<option value='$student_id'>{$student_fullname}</option>";
                                }
                            ?>
                        </select>
                        <input type="hidden" name="date_created" id="date_created" />
                    </div>                   
                    <div class="form-group">
                        <label for="student_username">Username *</label>
                        <span id="student_username_message"></span>
                        <input type="text" class="form-control" name="student_username" id="student_username" required />
                    </div>
                    <div class="form-group">
                        <label for="student_user_password">Password *</label>
                        <input type="password" class="form-control" name="student_user_password" id="student_user_password" required />
                    </div>
                    <div class="form-group">
                        <label for="repeat_student_user_password">Repeat Password *</label>
                        <span id="student_user_password_message"></span>
                        <input type="password" class="form-control" name="student_user_password_confirm" id="student_user_password_confirm" required />
                    </div>
                    <div class="form-group">
                        <label for="student_user_role">Role *</label>
                        <select class="form-control" name="student_user_role" id="student_user_role" required>
                            <option selected value= 6>Student</option> <!--hardwire-->
<!--                            <option value="">------ Select ------</option>-->
                            <?php
//                                $query       = "SELECT * FROM settings_user_roles ORDER BY role ASC"; 
//                                $select_role = mysqli_query($connection, $query);
//                                while($row   = mysqli_fetch_assoc($select_role)){
//                                    $role_id = $row['role_id'];
//                                    $role    = $row['role'];
//                                    if($role_id == $user_role_id){
//                                        echo "<option selected value='$role_id'>{$role}</option>"; //current selection
//                                    }else{
//                                        echo "<option value='$role_id'>{$role}</option>"; //full selections
//                                    }
//                                }
                            ?>
                        </select>
                        <input type="hidden" name="student_date_created" id="student_date_created" />
                    </div>
                    <div class="form-group">
                        <label for="student_user_current">Current *</label>
                        <select class="form-control" name="student_user_current" id="student_user_current" required>
                            <option value="">------ Select ------</option>
                            <option value="Yes">Yes</option>
                            <option value="No">No</option>
                        </select>
                        <input type="hidden" name="student_user_id" id="student_user_id" />
                    </div>
                    <div class="form-group text-right">
                        <button type="button" class="btn btn-default" data-dismiss="modal" id="student_user_insert_cancel">Cancel</button>
                        <input class="btn btn-success" type="submit" name="student_user_insert" id="student_user_insert" value="" />
                    </div>
                </form>
            </div>
        </div> <!-- /.modal-content -->
    </div> <!-- /.modal-dialog -->
</div> <!-- /.modal -->

<!-- readonly_modal -->
<div class="modal fade" id="student_user_readonly_modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Student User Details</h4>
            </div>
            <div class="modal-body" id="student_user_details">
                <!--show data here-->
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function(){
        //-------------------- student_username_check --------------------//
        $("#student_username").on("keyup", function (){
            var student_username = $(this).val();
            $.ajax({
                url:"../includes/functions.php",
                methord:"GET",
                data:{student_username: student_username},
                success:function(data){
//                    if($("#student_username_message").val(data) == 0){
//                        $("#student_user_password").removeAttr("disabled");
//                    }
                    $("#student_username_message").html(data);
                }
            })
        });
        //-------------------- student_user_password_confirm --------------------//
        $("#student_user_password_confirm").on("keyup", function (){
            if($(this).val() == $("#student_user_password").val()){
                $("#student_user_password_message").html("  <i class='far fa-check-circle'></i>").css("color", "green");
            }else{
                $("#student_user_password_message").html("  not matching").css("color", "red");
            }
        });
        //-------------------- datepicker --------------------//
        $(".datepicker").datepicker({
            weekStart: 1,
            format: "yyyy-mm-dd",
        })
        //-------------------- DataTable --------------------//
        $("#admin_student_users").DataTable();
    }); 
    
    //++++++++++++++++++++ admin_student_users CRUD +++++++++++++++++++//
    $(document).ready(function(){
        //-------------------- add_new_button --------------------//
        $("#student_user_add").click(function(){
            $("#student_user_insert").val("Add");
            $("#student_user_insert_form")[0].reset();
        });
        //-------------------- update_button(fetch data) --------------------//
        $(document).on("click", ".student_user_update", function(){
            var student_user_id = $(this).attr("id");
            $.ajax({
                url:"CRUD/fetch.php",
                method:"POST",
                data:{student_user_id:student_user_id},
                dataType:"json",
                success:function(data){
                    $("#student_user_id").val(data.student_user_id);
                    $("#student_fullname").val(data.user_student_id);
                    $("#student_username").val(data.username);
                    $("#student_user_role").val(data.user_role_id);
                    $("#student_date_created").val(data.date_created);
                    $("#student_user_current").val(data.user_current);  
                    $("#student_user_insert").val("Update");
                    $("#student_user_editable_modal").modal({backdrop:'static', keyboard: false});
                    $("#student_user_editable_modal").modal("show");
                }
            });
        });
        //-------------------- for both add_submit & update_submit buttons in editable_modal --------------------//
        $("#student_user_insert_form").on("submit", function(event){
            event.preventDefault();
            if ($("#student_user_password_confirm").val() == $("#student_user_password").val()) {
                $.ajax({
                    url:"CRUD/insert.php",
                    method:"POST",
                    data:$("#student_user_insert_form").serialize(),
                    success:function(data){
                        $("#student_user_insert_form")[0].reset();
                        $("#student_user_editable_modal").modal("hide");
                        $("#student_users_table").html(data);
                        location.reload(); //check_point: must have!
                    }
                });
            }
        });
        $("#student_user_insert_cancel").on("click", function(event){
            $("#student_user_insert_form")[0].reset();
            location.reload(); //check_point: must have!
        });
        //-------------------- view_button --------------------//
        $(document).on("click", ".student_user_view", function(){
            var student_user_id = $(this).attr("id");
            $.ajax({
                url:"CRUD/read.php",
                method:"POST",
                data:{student_user_id:student_user_id},
                success:function(data){
                    $("#student_user_details").html(data);
                    $("#student_user_readonly_modal").modal("show");
                }
            });
        });
        //-------------------- delete_button --------------------//
        $(document).on("click", ".student_user_delete", function(event){
            event.preventDefault();
            var student_user_id = $(this).attr("id");
            if(confirm("Are you sure to delete this record ?")){
                $.ajax({
                    url:"CRUD/delete.php",
                    method:"POST",
                    data:{student_user_id:student_user_id},
                    success:function(){
                        location.reload();
                    }
                });
            }
        });
    });      
</script>

<?php include "../includes/footer.php"; ?>