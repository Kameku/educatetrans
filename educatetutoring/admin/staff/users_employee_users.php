<?php include "../includes/header.php"; ?>
<?php
    $query  = "SELECT admin_employee_users.*";
    $query .= ", CONCAT(admin_employees.employee_firstname, ' ', admin_employees.employee_lastname) AS user_fullname";
    $query .= ", settings_user_roles.role ";
    $query .= "FROM admin_employee_users ";
    $query .= "JOIN admin_employees ON admin_employee_users.user_employee_id = admin_employees.employee_id ";
    $query .= "JOIN settings_user_roles ON admin_employee_users.user_role_id = settings_user_roles.role_id ";
    $query .= "ORDER BY user_fullname ASC, username ASC";
    $select_employee_users  = mysqli_query($connection, $query);
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
                        Employee Users
                        <div class="pull-right">
                            <button type="button" class="btn btn-success btn-md" name="employee_user_add" id="employee_user_add" data-target="#employee_user_editable_modal" data-backdrop="static" data-keyboard="false" data-toggle="modal">
                                <span><i class="fas fa-plus"></i></span>  Add New
                            </button>
                        </div>
                    </h1>
                </div>
            </div> <!-- /.row -->
            <div class="row">
                <div class="col-lg-12"  id="employee_users_table">
                    <table class="table table-bordered table-striped table-hover" id="admin_employee_users"> <!-- id for DataTable -->
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
                                while($row = mysqli_fetch_assoc($select_employee_users)){
                                    $employee_fullname      = $row['user_fullname'];
                                    $employee_username      = $row['username'];
                                    $employee_user_role     = $row['role'];
                                    $employee_date_created  = $row['date_created'];
                                    $employee_user_current  = $row['user_current'];
                                    $employee_user_id       = $row['employee_user_id'];
                            ?>
                                <tr>
                                    <td><?php echo $employee_fullname; ?></td>
                                    <td><?php echo $employee_username; ?></td>
                                    <td><?php echo $employee_user_role; ?></td>
                                    <td class="text-center"><?php echo $employee_date_created; ?></td>
                                    <td class="text-center">
                                        <?php
                                        if($employee_user_current == 'Yes'){
                                            echo "<span class='text-success'><i class='fas fa-check'></i>  {$employee_user_current}</span>";
                                        }else{
                                            echo "<span class='text-danger'><i class='fas fa-times'></i>  {$employee_user_current}</span>";
                                        }                
                                        ?>
                                    </td>
                                    <td class="text-center"><?php echo $employee_user_id; ?></td>
                                    <td class="text-center">
                                        <span type="button" class="btn btn-info btn-xs employee_user_view" name="employee_user_view" id="<?php echo $row['employee_user_id']; ?>">
                                            <i class='fas fa-search-plus'></i>
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <span type="button" class="btn btn-warning btn-xs employee_user_update" name="employee_user_update" id="<?php echo $row['employee_user_id']; ?>">
                                            <i class='far fa-edit'></i>
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <span type="button" class="btn btn-danger btn-xs employee_user_delete" name="employee_user_delete" id="<?php echo $row['employee_user_id']; ?>">
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
<div class="modal fade" id="employee_user_editable_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
<!--                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>-->
                <h4 class="modal-title" id="myModalLabel">Employee User Details</h4>
            </div>
            <div class="modal-body">
                <form method="post" id="employee_user_insert_form">
                    <div class="form-group">
                        <label for="employee_fullname">Name *</label>
                        <select class="form-control" name="employee_fullname" id="employee_fullname" required>
                            <option value="">------ Select ------</option>
                            <?php
                                $query = "SELECT employee_id, CONCAT(admin_employees.employee_firstname, ' ', admin_employees.employee_lastname) AS employee_fullname FROM admin_employees ORDER BY employee_fullname ASC";
                                $select_employee_fullname = mysqli_query($connection, $query);
                                while($row   = mysqli_fetch_assoc($select_employee_fullname)){
                                    $employee_id       = $row['employee_id'];
                                    $employee_fullname = $row['employee_fullname'];
                                    echo "<option value='$employee_id'>{$employee_fullname}</option>";
                                }
                            ?>
                        </select>
                        <input type="hidden" name="date_created" id="date_created" />
                    </div>                   
                    <div class="form-group">
                        <label for="employee_username">Username *</label>
                        <span id="employee_username_message"></span>
                        <input type="text" class="form-control" name="employee_username" id="employee_username" required />
                    </div>
                    <div class="form-group">
                        <label for="employee_user_password">Password *</label>
                        <input type="password" class="form-control" name="employee_user_password" id="employee_user_password" required />
                    </div>
                    <div class="form-group">
                        <label for="repeat_employee_user_password">Repeat Password *</label>
                        <span id="employee_user_password_message"></span>
                        <input type="password" class="form-control" name="employee_user_password_confirm" id="employee_user_password_confirm" required />
                    </div>
                    <div class="form-group">
                        <label for="employee_user_role">Role *</label>
                        <select class="form-control" name="employee_user_role" id="employee_user_role" required>
                            <option value="">------ Select ------</option>
                            <?php
                                $query       = "SELECT * FROM settings_user_roles ORDER BY role ASC"; 
                                $select_role = mysqli_query($connection, $query);
                                while($row   = mysqli_fetch_assoc($select_role)){
                                    $role_id = $row['role_id'];
                                    $role    = $row['role'];
                                    echo "<option value='$role_id'>{$role}</option>";
                                }
                            ?>
                        </select>
                        <input type="hidden" name="employee_date_created" id="employee_date_created" />
                    </div>
                    <div class="form-group">
                        <label for="employee_user_current">Current *</label>
                        <select class="form-control" name="employee_user_current" id="employee_user_current" required>
                            <option value="">------ Select ------</option>
                            <option value="Yes">Yes</option>
                            <option value="No">No</option>
                        </select>
                        <input type="hidden" name="employee_user_id" id="employee_user_id" />
                    </div>
                    <div class="form-group text-right">
                        <button type="button" class="btn btn-default" data-dismiss="modal" id="employee_user_insert_cancel">Cancel</button>
                        <input class="btn btn-success" type="submit" name="employee_user_insert" id="employee_user_insert" value="" />
                    </div>
                </form>
            </div>
        </div> <!-- /.modal-content -->
    </div> <!-- /.modal-dialog -->
</div> <!-- /.modal -->

<!-- readonly_modal -->
<div class="modal fade" id="employee_user_readonly_modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Employee User Details</h4>
            </div>
            <div class="modal-body" id="employee_user_details">
                <!--show data here-->
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function(){
        //-------------------- employee_username_check --------------------//
        $("#employee_username").on("keyup", function (){
            var employee_username = $(this).val();
            $.ajax({
                url:"../includes/functions.php",
                methord:"GET",
                data:{employee_username: employee_username},
                success:function(data){
//                    if($("#employee_username_message").val(data) == 0){
//                        $("#employee_user_password").removeAttr("disabled");
//                    }
                    $("#employee_username_message").html(data);
                }
            })
        });
        //-------------------- employee_user_password_confirm --------------------//
        $("#employee_user_password_confirm").on("keyup", function (){
            if($(this).val() == $("#employee_user_password").val()){
                $("#employee_user_password_message").html("  <i class='far fa-check-circle'></i>").css("color", "green");
            }else{
                $("#employee_user_password_message").html("  not matching").css("color", "red");
            }
        });
        //-------------------- datepicker --------------------//
        $(".datepicker").datepicker({
            weekStart: 1,
            format: "yyyy-mm-dd",
        })
        //-------------------- DataTable --------------------//
        $("#admin_employee_users").DataTable();
    }); 
    
    //++++++++++++++++++++ admin_employee_users CRUD +++++++++++++++++++//
    $(document).ready(function(){
        //-------------------- add_new_button --------------------//
        $("#employee_user_add").click(function(){
            $("#employee_user_insert").val("Add");
            $("#employee_user_insert_form")[0].reset();
        });
        //-------------------- update_button(fetch data) --------------------//
        $(document).on("click", ".employee_user_update", function(){
            var employee_user_id = $(this).attr("id");
            $.ajax({
                url:"CRUD/fetch.php",
                method:"POST",
                data:{employee_user_id:employee_user_id},
                dataType:"json",
                success:function(data){
                    $("#employee_user_id").val(data.employee_user_id);
                    $("#employee_fullname").val(data.user_employee_id);
                    $("#employee_username").val(data.username);
                    $("#employee_user_role").val(data.user_role_id);
                    $("#employee_date_created").val(data.date_created);
                    $("#employee_user_current").val(data.user_current);  
                    $("#employee_user_insert").val("Update");
                    $("#employee_user_editable_modal").modal({backdrop:'static', keyboard: false});
                    $("#employee_user_editable_modal").modal("show");
                }
            });
        });
        //-------------------- for both add_submit & update_submit buttons in editable_modal --------------------//
        $("#employee_user_insert_form").on("submit", function(event){
            event.preventDefault();
            if ($("#employee_user_password_confirm").val() == $("#employee_user_password").val()) {
                $.ajax({
                    url:"CRUD/insert.php",
                    method:"POST",
                    data:$("#employee_user_insert_form").serialize(),
                    success:function(data){
                        $("#employee_user_insert_form")[0].reset();
                        $("#employee_user_editable_modal").modal("hide");
                        $("#employee_users_table").html(data);
                        location.reload(); //check_point: must have!
                    }
                });
            }
        });
        $("#employee_user_insert_cancel").on("click", function(event){
            $("#employee_user_insert_form")[0].reset();
            location.reload(); //check_point: must have!
        });
        //-------------------- view_button --------------------//
        $(document).on("click", ".employee_user_view", function(){
            var employee_user_id = $(this).attr("id");
            $.ajax({
                url:"CRUD/read.php",
                method:"POST",
                data:{employee_user_id:employee_user_id},
                success:function(data){
                    $("#employee_user_details").html(data);
                    $("#employee_user_readonly_modal").modal("show");
                }
            });
        });
        //-------------------- delete_button --------------------//
        $(document).on("click", ".employee_user_delete", function(event){
            event.preventDefault();
            var employee_user_id = $(this).attr("id");
            if(confirm("Are you sure to delete this record ?")){
                $.ajax({
                    url:"CRUD/delete.php",
                    method:"POST",
                    data:{employee_user_id:employee_user_id},
                    success:function(){
                        location.reload();
                    }
                });
            }
        });
    });      
</script>

<?php include "../includes/footer.php"; ?>