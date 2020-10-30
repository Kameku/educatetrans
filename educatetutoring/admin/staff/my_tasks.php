<?php include "../includes/header.php"; ?>
<?php
if(!isset($_SESSION['user_employee_id'])){
    header ("Location: index.php");
}
?>
<?php
    $query  = "SELECT admin_tasks.* ";
    $query .= ", CONCAT(employees_from.employee_firstname, ' ', employees_from.employee_lastname) AS task_from_fullname ";
    $query .= ", CONCAT(employees_to.employee_firstname, ' ', employees_to.employee_lastname) AS task_to_fullname ";
    $query .= "FROM admin_tasks ";
    $query .= "JOIN admin_employees AS employees_from ON admin_tasks.task_from = employees_from.employee_id ";
    $query .= "JOIN admin_employees AS employees_to ON admin_tasks.task_to = employees_to.employee_id ";
    $query .= "WHERE task_from = '{$_SESSION['user_employee_id']}' or task_to = '{$_SESSION['user_employee_id']}' ";
    $query .= "ORDER BY task_date_created DESC, task_date_due ASC";
    $select_tasks  = mysqli_query($connection, $query);
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
                        My Tasks
                        <div class="pull-right">
                            <button type="button" class="btn btn-success btn-md" name="admin_task_add" id="admin_task_add" data-target="#admin_task_editable_modal"  data-backdrop="static" data-keyboard="false" data-toggle="modal">
                                <span><i class="fas fa-plus"></i></span>  Add New
                            </button>
                        </div>
                    </h1>
                </div>
            </div> <!-- /.row -->
            <div class="row">
                <div class="col-lg-12"  id="admin_tasks_table">
                    <table class="table table-striped table-hover" id="admin_tasks"> <!-- id for DataTable -->
                        <thead class="bg-primary">
                            <tr>
                                <th width="4%">Id</th>
                                <th width="8%" class="text-center">Due Date</th>
                                <th width="5%" class="text-center">Priority</th>
                                <th width="8%">From</th>
                                <th width="8%">To</th>
                                <th width="6%">Group</th>
                                <th class="text-center">Title</th>
                                <th width="10%" class="text-center">Progress</th>
                                <th width="5%" class="text-center">View</th>
                                <th width="5%" class="text-center">Update</th>
                                <th width="5%" class="text-center">Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                while($row = mysqli_fetch_assoc($select_tasks)){
                                    $task_id           = $row['task_id'];
                                    $task_date_created = $row['task_date_created'];
                                    $task_from         = $row['task_from_fullname'];
                                    $task_to           = $row['task_to_fullname'];
                                    $task_group        = $row['task_group'];
                                    $task_title        = $row['task_title'];
                                    $task_priority     = $row['task_priority'];
                                    $task_status       = $row['task_status'];
                                    $task_date_due     = $row['task_date_due'];
                            ?>
                                <tr>
                                    <td><?php echo $task_id; ?></td>
                                    <td class="text-center">
                                        <?php 
                                            if ($task_date_due == '0000-00-00'){
                                                echo "N/A";
                                            }else{
                                                echo $task_date_due;
                                            }
                                        ?>
                                    </td><!--Due Date-->
                                    <td class="text-center">
                                        <?php 
                                            if ($task_priority == 'High'){
                                                echo "<span class='text-danger'><i class='fas fa-exclamation'></i>  <i class='fas fa-exclamation'></i>  <i class='fas fa-exclamation'></i></span>";
                                            }else if($task_priority == 'Medium'){
                                                echo "<span class='text-danger'><i class='fas fa-exclamation'></i>  <i class='fas fa-exclamation'></i></span>";
                                            }else if($task_priority == 'Low'){
                                                echo "<span class='text-danger'><i class='fas fa-exclamation'></i></span>";
                                            }
                                        ?>
                                    </td><!--Priority-->
                                    <td><?php echo $task_from; ?></td>
                                    <td><?php echo $task_to; ?></td>
                                    <td><?php echo $task_group; ?></td>
                                    <td>
                                        <?php
                                            if ($task_status == '100%'){
                                                echo "<span><s>$task_title</s></span>";
                                            }else{
                                                echo $task_title; 
                                            }
                                        ?>
                                    </td><!--Title-->
                                    <td>
                                        <div class="progress progress-striped active">
                                            <?php
                                                if ($task_status == '100%'){
                                                    echo "<div class='progress-bar progress-bar-success' role='progressbar' aria-valuenow='' aria-valuemin='0' aria-valuemax='100' style='width:100%'";
                                                }else{
                                                    echo"<div class='progress-bar progress-bar-primary' role='progressbar' aria-valuenow='' aria-valuemin='0' aria-valuemax='100' style='width:$task_status'";
                                                }
                                            ?>
                                            <span class="sr-only"><?php echo $task_status; ?></span>
                                        </div>
                                    </td><!--Status-->
                                    <td class="text-center">
                                        <span type="button" class="btn btn-info btn-xs task_view" name="task_view" id="<?php echo $row['task_id']; ?>">
                                            <i class='fas fa-search-plus'></i>
                                        </span>
                                    </td><!--View-->
                                    <td class="text-center">
                                        <span type="button" class="btn btn-warning btn-xs task_update" name="task_update" id="<?php echo $row['task_id']; ?>">
                                            <i class='far fa-edit'></i>
                                        </span>
                                    </td><!--Update-->
                                    <td class="text-center">
                                        <span type="button" class="btn btn-danger btn-xs task_delete" name="task_delete" id="<?php echo $row['task_id']; ?>">
                                            <i class='far fa-trash-alt'></i>
                                        </span>
                                    </td><!--Delete-->
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

<?php include "my_tasks_modals.php"; ?>

<script>
    $(document).ready(function(){
        //-------------------- datepicker --------------------//
        $(".datepicker").datepicker({
            weekStart: 1,
            format: "yyyy-mm-dd",
        });
        //-------------------- DataTable --------------------//
        $("#admin_tasks").DataTable({
            "order":[[0, "desc"]]
        }); 
        //-------------------- printing modal --------------------//
//        document.getElementById("task_btnPrint").onclick = function(){
//            document.getElementById("wrapper").style.display = "none";
//            printElement(document.getElementById("task_printSection"));
//        }
//        function printElement(elem, append, delimiter){
//            var domClone = elem.cloneNode(true);
//            var $task_printSection = document.getElementById("task_printSection");
//            if (!$task_printSection){
//                var $task_printSection = document.createElement("div");
//                $task_printSection.id = "task_printSection";
//                document.body.appendChild($task_printSection);
//            }
//            if (append !== true){
//                $task_printSection.innerHTML = "";
//            }else if (append ===true){
//                if (typeof (delimiter) === "string"){
//                    $task_printSection.innerHTML += delimiter;
//                }else if (typeof (delimiter) === "object"){
//                $task_printSection.appendChlid(delimiter);
//                }
//            }
//            $task_printSection.appendChild(domClone);
//            window.print();
//            location.reload();
//        }
    }); 
    
    //++++++++++++++++++++ admin_tasks CRUD +++++++++++++++++++//
    $(document).ready(function(){
        //-------------------- add_new_button --------------------//
        $("#admin_task_add").click(function(){
            $("#admin_task_insert").val("Add");
            $("#admin_task_insert_form")[0].reset();
        });
        //-------------------- update_button(fetch data) --------------------//
        $(document).on("click", ".task_update", function(){
            var task_id = $(this).attr("id");
            $.ajax({
                url:"CRUD/fetch.php",
                method:"POST",
                data:{task_id:task_id},
                dataType:"json",
                success:function(data){
                    $("#task_id").val(data.task_id);
                    $("#task_date_created").val(data.task_date_created);
                    $("#task_from_fullname").val(data.task_from); 
                    $("#task_to_fullname").val(data.task_to);
                    $("#task_group").val(data.task_group);
                    $("#task_title").val(data.task_title);
                    $("#task_content").val(data.task_content);
                    $("#task_priority").val(data.task_priority);
                    $("#task_status").val(data.task_status);
                    $("#task_date_due").val(data.task_date_due);
                    $("#task_notes").val(data.task_notes);
                    $("#admin_task_insert").val("Update");
                    $("#admin_task_editable_modal").modal({backdrop:'static', keyboard: false});
                    $("#admin_task_editable_modal").modal("show");
                }
            });
        });
        //-------------------- for submit button in editable_modal --------------------//
        $("#admin_task_insert_form").on("submit", function(event){
            event.preventDefault();
            $.ajax({
                url:"CRUD/insert.php",
                method:"POST",
                data:$("#admin_task_insert_form").serialize(),
                success:function(data){
                    $("#admin_task_insert_form")[0].reset();
                    $("#admin_task_editable_modal").modal("hide");
                    $("#admin_tasks_table").html(data);
                    location.reload(); //check_point: must have!
                }
            });
        });
        //-------------------- for cancel button in editable_modal --------------------//
        $("#admin_task_insert_cancel").on("click", function(event){
            $("#admin_task_insert_form")[0].reset();
            location.reload(); //check_point: must have!
        });
        //-------------------- view_button --------------------//
        $(document).on("click", ".task_view", function(){
            var task_id = $(this).attr("id");
            $.ajax({
                url:"CRUD/read.php",
                method:"POST",
                data:{task_id:task_id},
                success:function(data){
                    $("#admin_task_details").html(data);
                    $("#admin_task_readonly_modal").modal("show");
                }
            });
        });
        //-------------------- delete_button --------------------//
        $(document).on("click", ".task_delete", function(event){
            event.preventDefault();
            var task_id = $(this).attr("id");
            if(confirm("Are you sure to delete this record ?")){
                $.ajax({
                    url:"CRUD/delete.php",
                    method:"POST",
                    data:{task_id:task_id},
                    success:function(){
                        location.reload();
                    }
                });
            }
        });
    });      
</script>

<?php include "../includes/footer.php"; ?>