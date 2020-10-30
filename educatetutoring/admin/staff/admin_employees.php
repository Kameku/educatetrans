<?php include "../includes/header.php"; ?>
<?php
    $query  = "SELECT admin_employees.*";
    $query .= ", DATE_FORMAT(admin_employees.employee_DOB,'%d/%m/%Y') AS employee_DOB";
    $query .= ", settings_user_roles.role ";
    $query .= "FROM admin_employees ";
    $query .= "JOIN settings_user_roles ON admin_employees.employee_role_id = settings_user_roles.role_id ";
    $query .= "ORDER BY employee_firstname ASC, employee_lastname ASC";
    $select_employees  = mysqli_query($connection, $query);
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
                        Employees
                        <div class="pull-right">
                            <button type="button" class="btn btn-success btn-md" name="employee_add" id="employee_add" data-target="#employee_editable_modal" data-backdrop="static" data-keyboard="false" data-toggle="modal">
                                <span><i class="fas fa-plus"></i></span>  Add New
                            </button>
                        </div>
                    </h1>
                </div>
            </div> <!-- /.row -->
            <div class="row">
                <div class="col-lg-12"  id="employees_table">
                    <table class="table table-bordered table-striped table-hover" id="admin_employees"> <!-- id for DataTable -->
                        <thead class="bg-primary">
                            <tr>
                                <th>First Name</th>           
                                <th>Last Name</th>
                                <th>Email</th>
                                <th class="text-center">Mobile</th>
                                <th class="text-center">Role</th>
                                <th class="text-center">Date of Birth</th>
                                <th class="text-center">Current</th>
                                <th width="5%" class="text-center">Id</th>
                                <th width="5%" class="text-center">View</th>
                                <th width="5%" class="text-center">Update</th>
                                <th width="5%" class="text-center">Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                while($row = mysqli_fetch_assoc($select_employees)){
                                    $employee_id        = $row['employee_id'];
                                    $employee_firstname = $row['employee_firstname'];
                                    $employee_lastname  = $row['employee_lastname'];
                                    $employee_email     = $row['employee_email'];
                                    $employee_mobile    = $row['employee_mobile'];
                                    $employee_role      = $row['role'];
                                    $employee_dob       = $row['employee_DOB'];
                                    $employee_current   = $row['employee_current'];
                            ?>
                                <tr>
                                    <td><?php echo $employee_firstname; ?></td>
                                    <td><?php echo $employee_lastname; ?></td>
                                    <td><?php echo $employee_email; ?></td>
                                    <td class="text-center"><?php echo $employee_mobile; ?></td>
                                    <td class="text-center"><?php echo $employee_role; ?></td>
                                    <td class="text-center"><?php echo $employee_dob; ?></td>
                                    <td class="text-center">
                                        <?php
                                        if($employee_current == 'Yes'){
                                            echo "<span class='text-success'><i class='fas fa-check'></i>  {$employee_current}</span>";
                                        }else{
                                            echo "<span class='text-danger'><i class='fas fa-times'></i>  {$employee_current}</span>";
                                        }                
                                        ?>
                                    </td>
                                    <td class="text-center"><?php echo $employee_id; ?></td>
                                    <td class="text-center">
                                        <span type="button" class="btn btn-info btn-xs employee_view" name="employee_view" id="<?php echo $row['employee_id']; ?>">
                                            <i class='fas fa-search-plus'></i>
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <span type="button" class="btn btn-warning btn-xs employee_update" name="employee_update" id="<?php echo $row['employee_id']; ?>">
                                            <i class='far fa-edit'></i>
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <span type="button" class="btn btn-danger btn-xs employee_delete" name="employee_delete" id="<?php echo $row['employee_id']; ?>">
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
<div class="modal fade" id="employee_editable_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
<!--                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>-->
                <h4 class="modal-title" id="myModalLabel">Employee Details</h4>
            </div>
            <div class="modal-body">
                <form method="post" id="employee_insert_form">
                    <div class="form-group">
                        <label for="employee_firstname">First Name *</label>
                        <input type="text" class="form-control" name="employee_firstname" id="employee_firstname" required />
                    </div>
                    <div class="form-group">
                        <label for="employee_lastname">Last Name *</label>
                        <input type="text" class="form-control" name="employee_lastname" id="employee_lastname" required />
                    </div>
                    <div class="form-group">
                        <label for="employee_email">Email *</label>
                        <input type="email" class="form-control" name="employee_email" id="employee_email" required />
                    </div>
                    <div class="form-group">
                        <label for="employee_mobile">Mobile *</label>
                        <input type="number" class="form-control" name="employee_mobile" id="employee_mobile" required />
                    </div>
                    <div class="form-group">                    
                        <label for="employee_role">Role *</label>
                        <select class="form-control" name="employee_role" id="employee_role" required>
                            <option value="">------ Select ------</option>
                            <?php
                                $query       = "SELECT * FROM settings_user_roles ORDER BY role ASC"; 
                                $select_role = mysqli_query($connection, $query);
                                while($row   = mysqli_fetch_assoc($select_role)){
                                    $role_id = $row['role_id'];
                                    $role    = $row['role'];
                                    if($role_id == $user_role_id){
                                        echo "<option selected value='$role_id'>{$role}</option>"; //current selection
                                    }else{
                                        echo "<option value='$role_id'>{$role}</option>"; //full selections
                                    }
                                }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="employee_DOB">Date of Birth</label>
                        <input type="text" class="form-control datepicker" name="employee_DOB" id="employee_DOB" readonly />
                    </div>                    
                    <div class="form-group">
                        <label for="employee_current">Current *</label>
                        <select class="form-control" name="employee_current" id="employee_current" required>
                            <option value="">------ Select ------</option>
                            <option value="Yes">Yes</option>
                            <option value="No">No</option>
                        </select>
                        <input type="hidden" name="employee_id" id="employee_id" />
                    </div>
                    <div class="form-group text-right">
                        <button type="button" class="btn btn-default" data-dismiss="modal" id="employee_insert_cancel">Cancel</button>
                        <input class="btn btn-success" type="submit" name="employee_insert" id="employee_insert" value="" />
                    </div>
                </form>
            </div>
        </div> <!-- /.modal-content -->
    </div> <!-- /.modal-dialog -->
</div> <!-- /.modal -->

<!-- readonly_modal -->
<div class="modal fade" id="employee_readonly_modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Employee Details</h4>
            </div>
            <div class="modal-body" id="employee_details">
                <!--show data here-->
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function(){
        //-------------------- datepicker --------------------//
        $(".datepicker").datepicker({
            weekStart: 1,
            format: "yyyy-mm-dd",
        })
        //-------------------- DataTable --------------------//
        $("#admin_employees").DataTable();
    }); 
    
    //++++++++++++++++++++ admin_employees CRUD +++++++++++++++++++//
    $(document).ready(function(){
        //-------------------- add_new_button --------------------//
        $("#employee_add").click(function(){
            $("#employee_insert").val("Add");
            $("#employee_insert_form")[0].reset();
        });
        //-------------------- update_button(fetch data) --------------------//
        $(document).on("click", ".employee_update", function(){
            var employee_id = $(this).attr("id");
            $.ajax({
                url:"CRUD/fetch.php",
                method:"POST",
                data:{employee_id:employee_id},
                dataType:"json",
                success:function(data){
                    $("#employee_id").val(data.employee_id);
                    $("#employee_firstname").val(data.employee_firstname);
                    $("#employee_lastname").val(data.employee_lastname);
                    $("#employee_email").val(data.employee_email);
                    $("#employee_mobile").val(data.employee_mobile);
                    $("#employee_role").val(data.employee_role_id);
                    $("#employee_DOB").val(data.employee_DOB);
                    $("#employee_current").val(data.employee_current);  
                    $("#employee_insert").val("Update");
                    $("#employee_editable_modal").modal({backdrop:'static', keyboard: false});
                    $("#employee_editable_modal").modal("show");
                }
            });
        });
        //-------------------- for both add_submit & update_submit buttons in editable_modal --------------------//
        $("#employee_insert_form").on("submit", function(event){
            event.preventDefault();
            if ($("#employee_password_confirm").val() == $("#employee_password").val()) {
                $.ajax({
                    url:"CRUD/insert.php",
                    method:"POST",
                    data:$("#employee_insert_form").serialize(),
                    success:function(data){
                        $("#employee_insert_form")[0].reset();
                        $("#employee_editable_modal").modal("hide");
                        $("#employees_table").html(data);
                        location.reload(); //check_point: must have!
                    }
                });
            }
        });
        $("#employee_insert_cancel").on("click", function(event){
            $("#employee_insert_form")[0].reset();
            location.reload(); //check_point: must have!
        });
        //-------------------- view_button --------------------//
        $(document).on("click", ".employee_view", function(){
            var employee_id = $(this).attr("id");
            $.ajax({
                url:"CRUD/read.php",
                method:"POST",
                data:{employee_id:employee_id},
                success:function(data){
                    $("#employee_details").html(data);
                    $("#employee_readonly_modal").modal("show");
                }
            });
        });
        //-------------------- delete_button --------------------//
        $(document).on("click", ".employee_delete", function(event){
            event.preventDefault();
            var employee_id = $(this).attr("id");
            if(confirm("Are you sure to delete this record ?")){
                $.ajax({
                    url:"CRUD/delete.php",
                    method:"POST",
                    data:{employee_id:employee_id},
                    success:function(){
                        location.reload();
                    }
                });
            }
        });
    });      
</script>

<?php include "../includes/footer.php"; ?>