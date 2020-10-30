<?php include "../includes/header.php"; ?>
<?php
    $query  = "SELECT admin_student_schedules.*";
    $query .= ", CONCAT(admin_student_registration.student_firstname, ' ', admin_student_registration.student_lastname) AS schedule_student_fullname ";
    $query .= ", CONCAT(admin_employees.employee_firstname, ' ', admin_employees.employee_lastname) AS schedule_tutor_fullname ";
    $query .= "FROM admin_student_schedules ";
    $query .= "JOIN admin_student_registration ON admin_student_schedules.schedule_student_id = admin_student_registration.student_id ";
    $query .= "JOIN admin_employees ON admin_student_schedules.schedule_tutor_id = admin_employees.employee_id ";
    $query .= "ORDER BY schedule_year DESC, schedule_term DESC, schedule_tutor_fullname ASC, schedule_student_fullname ASC";
    $select_schedules  = mysqli_query($connection, $query);
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
                        Student Schedules
                        <div class="pull-right">
                            <button type="button" class="btn btn-success btn-md" name="student_schedule_add" id="student_schedule_add" data-target="#student_schedule_editable_modal" data-backdrop="static" data-keyboard="false" data-toggle="modal">
                                <span><i class="fas fa-plus"></i></span>  Add New
                            </button>
                        </div>
                    </h1>
                </div>
            </div> <!-- /.row -->
            <div class="row">
                <div class="col-lg-12"  id="student_schedules_table">
                    <table class="table table-bordered table-striped table-hover" id="admin_student_schedules"> <!-- id for DataTable -->
                        <thead class="bg-primary">
                            <tr>
                                <th>Year</th>
                                <th>Term</th>
                                <th>Tutor</th>
                                <th>Student Name</th>
                                <th>Package</th>
                                <th>Subject</th>
                                <th>Week Day</th>
                                <th>Time</th>
                                <th>Room</th>
                                <th width="5%" class="text-center">Id</th>
                                <th width="5%" class="text-center">FastAdd</th>
                                <th width="5%" class="text-center">View</th>
                                <th width="5%" class="text-center">Update</th>
                                <th width="5%" class="text-center">Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                while($row = mysqli_fetch_assoc($select_schedules)){
                                    $schedule_id               = $row['schedule_id'];
                                    $schedule_student_fullname = $row['schedule_student_fullname'];
                                    $schedule_year             = $row['schedule_year'];
                                    $schedule_term             = $row['schedule_term'];
                                    $schedule_tutor_fullname   = $row['schedule_tutor_fullname'];
                                    $schedule_package          = $row['schedule_package'];
                                    $schedule_subject          = $row['schedule_subject'];
                                    $schedule_weekday          = $row['schedule_weekday'];
                                    $schedule_time             = $row['schedule_time'];
                                    $schedule_room             = $row['schedule_room'];
                            ?>
                                <tr>
                                    <td><?php echo $schedule_year; ?></td>
                                    <td><?php echo $schedule_term; ?></td>
                                    <td><?php echo $schedule_tutor_fullname; ?></td>
                                    <td><?php echo $schedule_student_fullname; ?></td>
                                    <td><?php echo $schedule_package; ?></td>
                                    <td><?php echo $schedule_subject; ?></td>
                                    <td><?php echo $schedule_weekday; ?></td>
                                    <td><?php echo $schedule_time; ?></td>
                                    <td><?php echo $schedule_room; ?></td>
                                    <td class="text-center"><?php echo $schedule_id; ?></td>
                                    <td class="text-center">
                                        <span type="button" class="btn btn-success btn-xs schedule_fast_add" name="schedule_fast_add" id="<?php echo $row['schedule_id']; ?>">
                                            <i class="fas fa-bolt"></i>
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <span type="button" class="btn btn-info btn-xs schedule_view" name="schedule_view" id="<?php echo $row['schedule_id']; ?>">
                                            <i class='fas fa-search-plus'></i>
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <span type="button" class="btn btn-warning btn-xs schedule_update" name="schedule_update" id="<?php echo $row['schedule_id']; ?>">
                                            <i class='far fa-edit'></i>
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <span type="button" class="btn btn-danger btn-xs schedule_delete" name="schedule_delete" id="<?php echo $row['schedule_id']; ?>">
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
<div class="modal fade" id="student_schedule_editable_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
<!--                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>-->
                <h4 class="modal-title" id="myModalLabel">Schedule</h4>
            </div>
            <div class="modal-body">
                <form method="post" id="student_schedule_insert_form">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#booking" data-toggle="tab">Booking</a></li>
                        <li><a href="#package" data-toggle="tab">Package</a></li>
                        <li><a href="#notes" data-toggle="tab">Notes</a></li>
                    </ul>                            
                    <div class="tab-content">
                        <div class="tab-pane fade in active" id="booking">
                            <br />
                            <input type="hidden" name="schedule_id" id="schedule_id" />
                            <div class="form-group">
                                <label for="schedule_year">Year</label>
<!--                                <input class="form-control" type="number" name="schedule_year" id="schedule_year" value="YEAR(date())" />-->
                                <input type="number" class="form-control" name="schedule_year" id="schedule_year" value="<?php echo date('Y'); ?>" />
                            </div>
                            <div class="form-group">
                                <label for="schedule_student_fullname">Student Name *</label>
                                <select class="form-control" name="schedule_student_fullname" id="schedule_student_fullname" required>
                                    <option value="">------- Select -------</option>
                                    <?php
                                        $query = "SELECT student_id, CONCAT(admin_student_registration.student_firstname, ' ', admin_student_registration.student_lastname) AS student_fullname FROM admin_student_registration ORDER BY student_fullname ASC";
                                        $select_student_fullname = mysqli_query($connection, $query);
                                        while($row               = mysqli_fetch_assoc($select_student_fullname)){
                                            $student_id          = $row['student_id'];
                                            $student_fullname    = $row['student_fullname'];
                                            echo "<option value='$student_id'>{$student_fullname}</option>";
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="schedule_term">School Term</label>
                                <select class="form-control" name="schedule_term" id="schedule_term">
                                    <option value="">------- Select -------</option>
                                    <?php
                                        $query = "SELECT * FROM settings_school_terms ORDER BY term ASC";
                                        $select_term = mysqli_query($connection, $query);
                                        while($row   = mysqli_fetch_assoc($select_term)){
                                            $term    = $row['term'];
                                            echo "<option value='$term'>{$term}</option>";
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="schedule_tutor_fullname">Tutor Name</label>
                                <select class="form-control" name="schedule_tutor_fullname" id="schedule_tutor_fullname">
                                    <option value="">------- Select -------</option>
                                    <?php
                                        $query  = "SELECT *, CONCAT(employee_firstname, ' ', employee_lastname) AS employee_fullname FROM admin_employees ";
                                        $query .= "WHERE employee_role_id = 1 or employee_role_id = 3 ORDER BY employee_fullname ASC";
                                        $select_employee_fullname = mysqli_query($connection, $query);
                                        while($row                = mysqli_fetch_assoc($select_employee_fullname)){
                                            $employee_id          = $row['employee_id'];
                                            $employee_fullname    = $row['employee_fullname'];
                                            echo "<option value='$employee_id'>{$employee_fullname}</option>";
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="schedule_room">Room</label>
                                <select class="form-control" name="schedule_room" id="schedule_room">
                                    <option value="">------- Select -------</option>
                                    <?php
                                        $query = "SELECT * FROM settings_rooms ORDER BY room ASC";
                                        $select_room = mysqli_query($connection, $query);
                                        while($row   = mysqli_fetch_assoc($select_room)){
                                            $room    = $row['room'];
                                            echo "<option value='$room'>{$room}</option>";
                                        }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="package">
                            <br />
                            <div class="form-group">
                                <label for="schedule_subject">Subject</label>
                                <select class="form-control" name="schedule_subject" id="schedule_subject">
                                    <option value="">------- Select -------</option>
                                    <?php
                                        $query = "SELECT * FROM settings_subjects ORDER BY schedule_subject ASC";
                                        $select_subject = mysqli_query($connection, $query);
                                        while($row      = mysqli_fetch_assoc($select_subject)){
                                            $subject    = $row['schedule_subject'];
                                            echo "<option value='$subject'>{$subject}</option>";
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="schedule_package">Package</label>
                                <select class="form-control" name="schedule_package" id="schedule_package">
                                    <option value="">------- Select -------</option>
                                    <?php
                                        $query = "SELECT * FROM settings_packages ORDER BY package ASC";
                                        $select_package = mysqli_query($connection, $query);
                                        while($row      = mysqli_fetch_assoc($select_package)){
                                            $package    = $row['package'];
                                            echo "<option value='$package'>{$package}</option>";
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="schedule_lessons">Number of Lessons</label>
                                <input type="text" class="form-control" name="schedule_lessons" id="schedule_lessons" value="10" />
                            </div>
                            <div class="form-group">
                                <label for="schedule_first_lesson">Date of First Lesson</label>
                                <input type="text" class="form-control datepicker" name="schedule_first_lesson" id="schedule_first_lesson" readonly />
                            </div>
                            <div class="form-group">
                                <label for="schedule_weekday">Booking Week Day</label>
                                <select class="form-control" name="schedule_weekday" id="schedule_weekday">
                                    <option value="">------- Select -------</option>
                                    <option value="Monday">Monday</option>
                                    <option value="Tuesday">Tuesday</option>
                                    <option value="Wednesday">Wednesday</option>
                                    <option value="Thursday">Thursday</option>
                                    <option value="Friday">Friday</option>
                                    <option value="Saturday">Saturday</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="schedule_time">Booking Time</label>
                                <input type="text" class="form-control" name="schedule_time" id="schedule_time" placeholder="hh:mm"/>
                            </div>
                            <div class="form-group">
                                <label for="schedule_duration">Lesson Duration</label>
                                <select class="form-control" name="schedule_duration" id="schedule_duration">
                                    <option value="60 minutes">60 minutes</option>
                                    <option value="45 minutes">45 minutes</option>
                                    <option value="Other">Other</option>
                                </select>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="notes">
                            <br />
                            <div class="form-group">
                                <label for="schedule_notes">Notes</label>
                                <textarea class="form-control" name="schedule_notes" id="schedule_notes" rows="20"></textarea>
                            </div>
                        </div>                        
                    </div>
                    <hr />
                    <div class="form-group text-right">
                        <button type="button" class="btn btn-default" data-dismiss="modal" id="student_schedule_insert_cancel">Cancel</button>
                        <input class="btn btn-success" type="submit" name="student_schedule_insert" id="student_schedule_insert" value="" />
                    </div>
                </form>
            </div>
        </div> <!-- /.modal-content -->
    </div> <!-- /.modal-dialog -->
</div> <!-- /.modal -->

<!-- readonly_modal -->

<div class="modal fade" id="student_schedule_readonly_modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div id="schedule_printSection">
                <div class="modal-header bg-primary">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Schedule Details</h4>
                </div>
                <div class="modal-body" id="student_schedule_details">
                    <!--show data here-->
                </div>
            </div>
<!--
                <div class="modal-footer">
                    <button id="schedule_btnPrint" type="button" class="btn btn-primary">Print</button>
                    <button class="btn btn-default" data-dismiss="modal" aria-hidden="true">Close</button>
                </div>
-->
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
        $("#admin_student_schedules").DataTable({
            "order":[[0, "desc"]]
        }); 
        //-------------------- printing modal --------------------//
//        document.getElementById("schedule_btnPrint").onclick = function(){
//            document.getElementById("wrapper").style.display = "none";
//            printElement(document.getElementById("schedule_printSection"));
//        }
//        function printElement(elem, append, delimiter){
//            var domClone = elem.cloneNode(true);
//            var $schedule_printSection = document.getElementById("schedule_printSection");
//            if (!$schedule_printSection){
//                var $schedule_printSection = document.createElement("div");
//                $schedule_printSection.id = "schedule_printSection";
//                document.body.appendChild($schedule_printSection);
//            }
//            if (append !== true){
//                $schedule_printSection.innerHTML = "";
//            }else if (append ===true){
//                if (typeof (delimiter) === "string"){
//                    $schedule_printSection.innerHTML += delimiter;
//                }else if (typeof (delimiter) === "object"){
//                $schedule_printSection.appendChlid(delimiter);
//                }
//            }
//            $schedule_printSection.appendChild(domClone);
//            window.print();
//            location.reload();
//        }
    }); 
    
    //++++++++++++++++++++ admin_student_schedules CRUD +++++++++++++++++++//
    $(document).ready(function(){
        //-------------------- add_new_button --------------------//
        $("#student_schedule_add").click(function(){
            $("#student_schedule_insert").val("Add");
            $("#student_schedule_insert_form")[0].reset();
        });
        //-------------------- fastadd_button(fetch data)-------------------//
        $(document).on("click", ".schedule_fast_add", function(){
            var schedule_id = $(this).attr("id");
            $.ajax({
                url:"CRUD/fetch.php",
                method:"POST",
                data:{schedule_id:schedule_id},
                dataType:"json",
                success:function(data){
                    $("#schedule_student_fullname").val(data.schedule_student_id); 
                    $("#schedule_year").val(data.schedule_year);
                    $("#schedule_term").val(data.schedule_term);
                    $("#schedule_tutor_fullname").val(data.schedule_tutor_id);
                    $("#schedule_subject").val(data.schedule_subject);
                    $("#schedule_package").val(data.schedule_package);
                    $("#schedule_lessons").val(data.schedule_lessons);
                    $("#schedule_first_lesson").val(data.schedule_first_lesson);
                    $("#schedule_weekday").val(data.schedule_weekday);
                    $("#schedule_time").val(data.schedule_time);
                    $("#schedule_duration").val(data.schedule_duration);
                    $("#schedule_room").val(data.schedule_room);
                    $("#schedule_notes").val(data.schedule_notes);
                    $("#student_schedule_insert").val("Fast Add");
                    $("#student_schedule_editable_modal").modal({backdrop:'static', keyboard: false});
                    $("#student_schedule_editable_modal").modal("show");
                }
            });
        });
        //-------------------- update_button(fetch data) --------------------//
        $(document).on("click", ".schedule_update", function(){
            var schedule_id = $(this).attr("id");
            $.ajax({
                url:"CRUD/fetch.php",
                method:"POST",
                data:{schedule_id:schedule_id},
                dataType:"json",
                success:function(data){
                    $("#schedule_id").val(data.schedule_id);
                    $("#schedule_student_fullname").val(data.schedule_student_id); 
                    $("#schedule_year").val(data.schedule_year);
                    $("#schedule_term").val(data.schedule_term);
                    $("#schedule_tutor_fullname").val(data.schedule_tutor_id);
                    $("#schedule_subject").val(data.schedule_subject);
                    $("#schedule_package").val(data.schedule_package);
                    $("#schedule_lessons").val(data.schedule_lessons);
                    $("#schedule_first_lesson").val(data.schedule_first_lesson);
                    $("#schedule_weekday").val(data.schedule_weekday);
                    $("#schedule_time").val(data.schedule_time);
                    $("#schedule_duration").val(data.schedule_duration);
                    $("#schedule_room").val(data.schedule_room);
                    $("#schedule_notes").val(data.schedule_notes);
                    $("#student_schedule_insert").val("Update");
                    $("#student_schedule_editable_modal").modal({backdrop:'static', keyboard: false});
                    $("#student_schedule_editable_modal").modal("show");
                }
            });
        });
        //-------------------- for submit button in editable_modal --------------------//
        $("#student_schedule_insert_form").on("submit", function(event){
            event.preventDefault();
            $.ajax({
                url:"CRUD/insert.php",
                method:"POST",
                data:$("#student_schedule_insert_form").serialize(),
                success:function(data){
                    $("#student_schedule_insert_form")[0].reset();
                    $("#student_schedule_editable_modal").modal("hide");
                    $("#student_schedules_table").html(data);
                    location.reload(); //check_point: must have!
                }
            });
        });
        //-------------------- for cancel button in editable_modal --------------------//
        $("#student_schedule_insert_cancel").on("click", function(event){
            $("#student_schedule_insert_form")[0].reset();
            location.reload(); //check_point: must have!
        });
        //-------------------- view_button --------------------//
        $(document).on("click", ".schedule_view", function(){
            var schedule_id = $(this).attr("id");
            $.ajax({
                url:"CRUD/read.php",
                method:"POST",
                data:{schedule_id:schedule_id},
                success:function(data){
                    $("#student_schedule_details").html(data);
                    $("#student_schedule_readonly_modal").modal("show");
                }
            });
        });
        //-------------------- delete_button --------------------//
        $(document).on("click", ".schedule_delete", function(event){
            event.preventDefault();
            var schedule_id = $(this).attr("id");
            if(confirm("Are you sure to delete this record ?")){
                $.ajax({
                    url:"CRUD/delete.php",
                    method:"POST",
                    data:{schedule_id:schedule_id},
                    success:function(){
                        location.reload();
                    }
                });
            }
        });
    });      
</script>

<?php include "../includes/footer.php"; ?>