<?php include "../includes/header.php"; ?>

<div id="wrapper">
    <!-- Navigation -->
    <?php include "includes/navtopbar.php"; ?>
    <?php include "includes/navsidebar.php"; ?>
    <!-- Page Content -->
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Welcome <?php echo "{$_SESSION['user_firstname']}"; ?></h1>
                </div> <!-- /.col-lg-12 -->
            </div> <!-- /.row --><!-- page title -->          
            
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-user-graduate fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge">46</div>
                                    <div>Current Students</div>
                                </div>
                            </div>
                        </div>
<!--
                        <div class="panel-body">
                            <span class="pull-left text-primary">Total Students</span>
                            <span class="pull-right text-primary">140</span>
                            <div class="clearfix"></div>
                        </div>
-->
                        <div class="panel-footer">
                            <a href="admin_student_registration.php">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </a>
                        </div>
                    </div>
                </div> <!-- Students -->
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-green">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-id-badge fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge">6</div>
                                    <div>Current Tutors</div>
                                </div>
                            </div>
                        </div>
<!--
                        <div class="panel-body">
                            <span class="pull-left text-success">Tutors unavailable</span>
                            <span class="pull-right text-success">1</span>
                            <div class="clearfix"></div>
                        </div>
-->
                        <a href="admin_employees.php">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div> <!-- Tutors -->
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-yellow">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fas fa-dollar-sign fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge">18</div>
                                    <div>Financial Items</div>
                                </div>
                            </div>
                        </div>
                        <a href="#">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div> <!-- fiancials -->
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-red">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-folder-open fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge">24</div>
                                    <div>Documents</div>
                                </div>
                            </div>
                        </div>
                        <a href="#">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div> <!-- documents -->
            </div> <!-- /.row -->
            
            <div class="row">
                <div class="col-lg-8">  
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <i class="fa fa-tasks fa-fw"></i> My Tasks
                                    <div class="pull-right">
                                        <a href="my_tasks.php" class="btn btn-default btn-xs">View Details</a>
                                    </div>
                                </div><!-- /.panel-heading -->
                                <div class="panel-body index_my_tasks">
                                    <?php
                                        $query  = "SELECT admin_tasks.* ";
                                        $query .= ", CONCAT(employees_from.employee_firstname, ' ', employees_from.employee_lastname) AS task_from_fullname ";
                                        $query .= ", CONCAT(employees_to.employee_firstname, ' ', employees_to.employee_lastname) AS task_to_fullname ";
                                        $query .= "FROM admin_tasks ";
                                        $query .= "JOIN admin_employees AS employees_from ON admin_tasks.task_from = employees_from.employee_id ";
                                        $query .= "JOIN admin_employees AS employees_to ON admin_tasks.task_to = employees_to.employee_id ";
                                        $query .= "WHERE task_status != '100%' AND task_from = '{$_SESSION['user_employee_id']}' OR task_to = '{$_SESSION['user_employee_id']}' ";
                                        $query .= "ORDER BY task_date_due ASC, task_id DESC";
                                        $select_tasks  = mysqli_query($connection, $query);
                                        if(mysqli_num_rows($select_tasks) > 0){
                                    ?>
                                    <table class="table table-bordered table-striped table-hover">
                                        <thead>
                                            <tr>
                                                <th width="5%">Id</th>
                                                <th width="10%" class="text-center">Due Date</th>
                                                <th width="10%" class="text-center">Priority</th>
                                                <th class="text-center">Title</th>
                                                <th width="10%" class="text-center">Progress</th>
                                                <th width="10%" class="text-center">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                while($row = mysqli_fetch_assoc($select_tasks)){
                                                    $task_id           = $row['task_id'];
                                                    $task_date_due     = $row['task_date_due'];
                                                    $task_priority     = $row['task_priority'];
                                                    $task_title        = $row['task_title'];
                                                    $task_status       = $row['task_status'];
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
                                                    <td><?php echo $task_title; ?></td><!--Title-->
                                                    <td class="text-center"><?php echo $task_status; ?></td><!--Status-->
                                                    <td class="text-center">
                                                        <span title="View" type="button" class="btn btn-info btn-xs task_view" name="task_view" id="<?php echo $row['task_id']; ?>">
                                                            <i class='fas fa-search-plus'></i>
                                                        </span>
                                                        <span title="Update" type="button" class="btn btn-warning btn-xs task_update" name="task_update" id="<?php echo $row['task_id']; ?>">
                                                            <i class='far fa-edit'></i>
                                                        </span>
                                                    </td><!--Actions-->
                                                </tr>
                                            <?php
                                                }
                                            ?>
                                        </tbody>
                                    </table>
                                    <?php
                                        }else{
                                            echo "<div class='alert alert-success text-center'>";
                                            echo "No record found.<a href='my_tasks.php' class='alert-link'> Click here for details.</a>";
                                            echo "</div>";
                                        }
                                    ?>
                                </div><!-- /.panel-body -->
                            </div><!-- /.panel my_tasks-->
                        </div><!-- /.col-lg -->
                    </div><!-- /.row -->
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <i class="fas fa-comment-dots"></i> Enquiries
                                    <div class="pull-right">
                                        <a href="admin_student_enquiries.php" class="btn btn-default btn-xs">View Details</a>
                                    </div>
                                </div><!-- /.panel-heading -->
                                <div class="panel-body index_enquiries">
                                    <?php
                                        $query  = "SELECT admin_student_enquiries.*";
                                        $query .= ", CONCAT(admin_student_registration.student_firstname, ' ', admin_student_registration.student_lastname) AS enquiry_student_fullname ";
                                        $query .= "FROM admin_student_enquiries ";
                                        $query .= "JOIN admin_student_registration ON admin_student_enquiries.enquiry_student_id = admin_student_registration.student_id ";
                                        $query .= "WHERE admin_student_enquiries.enquiry_outcome = 'Need Follow-up' ";
                                        $query .= "ORDER BY enquiry_date DESC, enquiry_student_fullname ASC";
                                        $select_enquiries  = mysqli_query($connection, $query);
                                        if(mysqli_num_rows($select_enquiries) > 0){
                                    ?>
                                    <table class="table table-bordered table-striped table-hover">
                                        <thead>
                                            <tr>
                                                <th class="text-center">Id</th>
                                                <th>Student Name</th>      
                                                <th>Enquirer Name</th>
                                                <th class="text-center">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                while($row = mysqli_fetch_assoc($select_enquiries)){
                                                    $enquiry_id               = $row['enquiry_id'];
                                                    $enquiry_student_fullname = $row['enquiry_student_fullname'];
                                                    $enquirer_name            = $row['enquirer_name'];
                                            ?>
                                                <tr>
                                                    <?php
                                                        echo "<td class='text-center'>$enquiry_id</td>";
                                                        echo "<td>$enquiry_student_fullname</td>";
                                                        echo "<td>$enquirer_name</td>";
                                                    ?>
                                                    <td class="text-center">
                                                        <span title="View" type="button" class="btn btn-info btn-xs enquiry_view" name="enquiry_view" id="<?php echo $enquiry_id; ?>">
                                                            <i class='fas fa-search-plus'></i>
                                                        </span>
                                                        <span title="Update" type="button" class="btn btn-warning btn-xs enquiry_update" name="enquiry_update" id="<?php echo $enquiry_id; ?>">
                                                            <i class='far fa-edit'></i>
                                                        </span>
                                                    </td><!--Actions-->
                                                </tr>
                                            <?php
                                                }
                                            ?>
                                        </tbody>
                                    </table>
                                    <?php
                                        }else{
                                            echo "<div class='alert alert-success text-center'>";
                                            echo "No enquiries need follow-up.<a href='admin_student_enquiries.php' class='alert-link'> Click here for details.</a>";
                                            echo "</div>";
                                        }
                                    ?>
                                </div><!-- /.panel-body -->
                            </div> <!-- /.panel enquiries-->
                        </div><!-- /.col-lg -->
                        <div class="col-lg-6">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <i class="fas fa-list-ol"></i> Enrollment Procedures
                                    <div class="pull-right">
                                        <a href="admin_student_enrollment_procedures.php" class="btn btn-default btn-xs">View Details</a>
                                    </div>
                                </div><!-- /.panel-heading -->
                                <div class="panel-body index_enrollment_procedures">
                                    <?php
                                        $query  = "SELECT admin_student_eprocedures.*";
                                        $query .= ", CONCAT(admin_student_registration.student_firstname, ' ', admin_student_registration.student_lastname) AS procedure_student_fullname ";
                                        $query .= "FROM admin_student_eprocedures ";
                                        $query .= "JOIN admin_student_registration ON admin_student_eprocedures.procedure_student_id = admin_student_registration.student_id ";
                                        $query .= "WHERE admin_student_eprocedures.procedure_folder = 'To Be Completed' ";
                                        $query .= "ORDER BY procedure_enquiry_id ASC";
                                        $select_eprocedures = mysqli_query($connection, $query);
                                        if(mysqli_num_rows($select_eprocedures) > 0){
                                    ?>
                                    <table class="table table-bordered table-striped table-hover">
                                        <thead>
                                            <tr>
                                                <th class="text-center">Id</th>
                                                <th>Student Name</th>
                                                <th class="text-center">PIS Date </th>
                                                <th class="text-center">PIS Status</th>
                                                <th class="text-center">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                while($row = mysqli_fetch_assoc($select_eprocedures)){
                                                    $procedure_id                  = $row['procedure_id'];
                                                    $procedure_student_fullname    = $row['procedure_student_fullname'];
                                                    $procedure_pis_date            = $row['procedure_pis_date'];
                                                    $procedure_pis_status          = $row['procedure_pis_status'];
                                            ?>
                                                <tr>
                                                    <td class="text-center"><?php echo $procedure_id; ?></td>
                                                    <td><?php echo $procedure_student_fullname; ?></td>
                                                    <td class="text-center">
                                                        <?php 
                                                            if ($procedure_pis_date == '0000-00-00'){
                                                                echo "N/A";
                                                            }else{
                                                                echo $procedure_pis_date;
                                                            }
                                                        ?>
                                                    </td>
                                                    <td class="text-center">
                                                        <?php
                                                            if ($procedure_pis_status == "Completed"){
                                                                echo "<span class='text-success'>$procedure_pis_status</span>";
                                                            }else if($procedure_pis_status == "Confirmed"){
                                                                echo "<span class='text-primary'>$procedure_pis_status</span>";
                                                            }else{
                                                                echo "<span class='text-warning'>$procedure_pis_status</span>";
                                                            }
                                                        ?>
                                                    </td>
                                                    <td class="text-center">
                                                        <span title="View" type="button" class="btn btn-info btn-xs procedure_view" name="procedure_view" id="<?php echo $procedure_id; ?>">
                                                            <i class='fas fa-search-plus'></i>
                                                        </span>
                                                        <span title="Update" type="button" class="btn btn-warning btn-xs procedure_update" name="procedure_update" id="<?php echo $procedure_id; ?>">
                                                            <i class='far fa-edit'></i>
                                                        </span>
                                                    </td><!--Actions-->
                                                </tr>
                                            <?php
                                                }
                                            ?>
                                        </tbody>
                                    </table>
                                    <?php
                                        }else{
                                            echo "<div class='alert alert-success text-center'>";
                                            echo "No procedures to be completed.<a href='admin_student_enrollment_procedures.php' class='alert-link'> Click here for details.</a>";
                                            echo "</div>";
                                        }
                                    ?>
                                </div><!-- /.panel-body -->
                            </div> <!-- /.panel enrollment_procedures-->
                        </div><!-- /.col-lg -->
                    </div><!-- /.row -->
                </div><!-- /.col-lg-8-->
                
                <div class="col-lg-4">
                    <div class="chat-panel panel panel-default">
                        <div class="panel-heading" id="chat_panel">
                            <i class="fa fa-comments fa-fw"></i> My Chat
                            <div class="btn-group pull-right" role="group">
                                <select class="select_chat_to" id="select_chat_to" required>
                                    <option value="">To:</option>
                                    <?php
                                        $query = "SELECT * FROM admin_employees WHERE employee_current = 'Yes' AND employee_id != '{$_SESSION['user_employee_id']}' ORDER BY employee_firstname ASC";
                                        $select_employees = mysqli_query($connection, $query);
                                        while($row = mysqli_fetch_assoc($select_employees)){
                                            $employee_id        = $row['employee_id'];
                                            $employee_firstname = $row['employee_firstname'];
                                            $employee_current   = $row['employee_current'];
                                            echo "<option value='$employee_id'>$employee_firstname</option>";
                                        }
                                    ?>
                                </select>
                            </div>
                        </div><!-- /.panel-heading -->
                        <div class="panel-body index_chat">
                            <?php
                                $query  = "SELECT admin_chat.* ";
                                $query .= ", CONCAT(employees_from.employee_firstname, ' ', employees_from.employee_lastname) AS chat_from_fullname ";
                                $query .= ", CONCAT(employees_to.employee_firstname, ' ', employees_to.employee_lastname) AS chat_to_fullname ";
                                $query .= "FROM admin_chat ";
                                $query .= "JOIN admin_employees AS employees_from ON admin_chat.chat_from_id = employees_from.employee_id ";
                                $query .= "JOIN admin_employees AS employees_to ON admin_chat.chat_to_id = employees_to.employee_id ";
                                $query .= "WHERE chat_from_id = '{$_SESSION['user_employee_id']}' or chat_to_id = '{$_SESSION['user_employee_id']}' ";
                                $query .= "ORDER BY chat_time DESC";
                                $select_chat  = mysqli_query($connection, $query);
                                while($row = mysqli_fetch_assoc($select_chat)){
                                    $chat_id      = $row['chat_id'];
                                    $chat_from    = $row['chat_from_fullname'];
                                    $chat_from_id = $row['chat_from_id'];
                                    $chat_to      = $row['chat_to_fullname'];
                                    $chat_to_id   = $row['chat_to_id'];
                                    $chat_message = $row['chat_message'];
                                    $chat_time    = $row['chat_time'];
                                    if($chat_from_id == $_SESSION['user_employee_id']){
                                        echo "<div class='header text-right'>";
                                            echo "<small class='text-muted'><i class='far fa-clock'></i>&nbsp; $chat_time &nbsp;</small>";
                                            echo "<strong class='primary-font'>Me</strong>";
                                        echo "</div>";
                                        echo "<div class='alert alert-success text-right'>";
                                            echo "$chat_message";
                                        echo "</div>";
                                    }else if($chat_to_id == $_SESSION['user_employee_id']){
                                        echo "<div class='header'>";
                                            echo "<strong class='primary-font'>$chat_from &nbsp;</strong>";
                                            echo "<small class='text-muted'><i class='far fa-clock'></i>$chat_time</small>";
                                        echo "</div>";
                                        echo "<div class='alert alert-info'>";
                                            echo "$chat_message";
                                        echo "</div>";
                                    }
                                }
                            ?>
                        </div><!-- /.panel-body -->
                        <div class="panel-footer">
                            <div class="input-group">
                                <input id="input_chat" type="text" class="form-control input-sm" placeholder="Type your message here..." />
                                <span class="input-group-btn">
                                    <button class="btn btn-success btn-sm" id="btn_send_chat">Send</button>
                                </span>
                            </div>
                        </div><!-- /.panel-footer -->
                    </div> <!-- /.panel my_chat-->
                </div><!-- /.col-lg-4 -->
            </div><!-- /.row -->
            
<!--
            <div class="row">
                <div class="col-lg-12">
                    <hr />
                </div>
                <div class="col-lg-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fas fa-book-open"></i> Student Attendance &amp; Service Provision
                        </div>
                        <div class="panel-body index_sasp">
                            
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fas fa-book-open"></i> Student Learning Plans &amp; Evaluations
                        </div>
                        <div class="panel-body index_slpe">
                            
                        </div>
                    </div>
                </div>
            </div>
-->
        </div> <!-- /.container-fluid -->
    </div> <!-- /#page-wrapper -->
</div> <!-- /#wrapper -->

<?php include "my_tasks_modals.php"; ?>
<?php include "admin_student_enquiries_modals.php"; ?>
<?php include "admin_student_enrollment_pro_modals.php"; ?>

<script>
    $(document).ready(function(){
        //-------------------- datepicker --------------------//
        $(".datepicker").datepicker({
            weekStart: 1,
            format: "yyyy-mm-dd",
        });
    }); 

    //++++++++++++++++++++ index my_tasks +++++++++++++++++++//
    $(document).ready(function(){
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
    });
    
    //++++++++++++++++++++ admin_student_enquiries +++++++++++++++++++//
    $(document).ready(function(){
        //-------------------- view_button --------------------//
        $(document).on("click", ".enquiry_view", function(){
            var enquiry_id = $(this).attr("id");
            $.ajax({
                url:"CRUD/read.php",
                method:"POST",
                data:{enquiry_id:enquiry_id},
                success:function(data){
                    $("#student_enquiry_details").html(data);
                    $("#student_enquiry_readonly_modal").modal("show");
                }
            });
        });
        //-------------------- update_button(fetch data) --------------------//
        $(document).on("click", ".enquiry_update", function(){
            var enquiry_id = $(this).attr("id");
            $.ajax({
                url:"CRUD/fetch.php",
                method:"POST",
                data:{enquiry_id:enquiry_id},
                dataType:"json",
                success:function(data){
                    $("#enquiry_id").val(data.enquiry_id);
                    $("#enquiry_outcome").val(data.enquiry_outcome);
                    $("#enquiry_date").val(data.enquiry_date);
                    $("#enquirer_name").val(data.enquirer_name);
                    $("#enquiry_student_fullname").val(data.enquiry_student_id); 
                    $("#enquiry_number").val(data.enquiry_number);
                    $("#enquiry_email").val(data.enquiry_email);
                    $("#enquiry_hear_about_us").val(data.enquiry_hear_about_us);
                    $("#enquiry_psychologist").val(data.enquiry_psychologist);
                    $("#enquiry_optometrist").val(data.enquiry_optometrist);
                    $("#enquiry_educational_assistance").val(data.enquiry_educational_assistance);
                    $("#enquiry_concerns").val(data.enquiry_concerns);
                    $("#enquiry_goals").val(data.enquiry_goals);
                    $("#enquiry_notes").val(data.enquiry_notes);
                    $("#student_enquiry_insert").val("Update");
                    $("#student_enquiry_editable_modal").modal({backdrop:'static', keyboard: false});
                    $("#student_enquiry_editable_modal").modal("show");
                }
            });
        });
        //-------------------- for submit button in editable_modal --------------------//
        $("#student_enquiry_insert_form").on("submit", function(event){
            event.preventDefault();
            $.ajax({
                url:"CRUD/insert.php",
                method:"POST",
                data:$("#student_enquiry_insert_form").serialize(),
                success:function(data){
                    $("#student_enquiry_insert_form")[0].reset();
                    $("#student_enquiry_editable_modal").modal("hide");
                    $("#student_enquiries_table").html(data);
                    location.reload(); //check_point: must have!
                }
            });
        });
        //-------------------- for cancel button in editable_modal --------------------//
        $("#student_enquiry_insert_cancel").on("click", function(event){
            $("#student_enquiry_insert_form")[0].reset();
            location.reload(); //check_point: must have!
        });
    });
    
    //++++++++++++++++++++ admin_student_eprocedures CRUD +++++++++++++++++++//
    $(document).ready(function(){
        //-------------------- view_button --------------------//
        $(document).on("click", ".procedure_view", function(){
            var procedure_id = $(this).attr("id");
            $.ajax({
                url:"CRUD/read.php",
                method:"POST",
                data:{procedure_id:procedure_id},
                success:function(data){
                    $("#student_procedure_details").html(data);
                    $("#student_procedure_readonly_modal").modal("show");
                }
            });
        });
        //-------------------- update_button(fetch data) --------------------//
        $(document).on("click", ".procedure_update", function(){
            var procedure_id = $(this).attr("id");
            $.ajax({
                url:"CRUD/fetch.php",
                method:"POST",
                data:{procedure_id:procedure_id},
                dataType:"json",
                success:function(data){
                    $("#procedure_id").val(data.procedure_id);
                    $("#procedure_date").val(data.procedure_date);
                    $("#procedure_student_fullname").val(data.procedure_student_id); 
                    $("#procedure_enquiry_id").val(data.procedure_enquiry_id);
                    $("#procedure_introduction_letter").val(data.procedure_introduction_letter);
                    $("#procedure_deposit").val(data.procedure_deposit);
                    $("#procedure_pis_date").val(data.procedure_pis_date);
                    $("#procedure_pis_status").val(data.procedure_pis_status);
                    $("#procedure_enrollment").val(data.procedure_enrollment);
                    $("#procedure_schedule").val(data.procedure_schedule);
                    $("#procedure_confirmation").val(data.procedure_confirmation);
                    $("#procedure_xero").val(data.procedure_xero);
                    $("#procedure_invoice").val(data.procedure_invoice);
                    $("#procedure_ezidebit").val(data.procedure_ezidebit);
                    $("#procedure_folder").val(data.procedure_folder);
                    $("#procedure_notes").val(data.procedure_notes);
                    $("#student_procedure_insert").val("Update");
                    $("#student_procedure_editable_modal").modal({backdrop:'static', keyboard: false});
                    $("#student_procedure_editable_modal").modal("show");
                }
            });
        });
        //-------------------- for submit button in editable_modal --------------------//
        $("#student_procedure_insert_form").on("submit", function(event){
            event.preventDefault();
            $.ajax({
                url:"CRUD/insert.php",
                method:"POST",
                data:$("#student_procedure_insert_form").serialize(),
                success:function(data){
                    $("#student_procedure_insert_form")[0].reset();
                    $("#student_procedure_editable_modal").modal("hide");
                    $("#student_eprocedures_table").html(data);
                    location.reload(); //check_point: must have!
                }
            });
        });
        //-------------------- for cancel button in editable_modal --------------------//
        $("#student_procedure_insert_cancel").on("click", function(event){
            $("#student_procedure_insert_form")[0].reset();
            location.reload(); //check_point: must have!
        });
    });
</script>

<?php include "../includes/footer.php"; ?>