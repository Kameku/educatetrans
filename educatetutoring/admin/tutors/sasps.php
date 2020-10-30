<?php include "../includes/header.php"; ?>
<?php
    $query  = "SELECT academic_sasps.*";
    $query .= ", CONCAT(admin_student_registration.student_firstname, ' ', admin_student_registration.student_lastname) AS sasp_student";
    $query .= ", CONCAT(admin_employees.employee_firstname, ' ', admin_employees.employee_lastname) AS sasp_tutor ";
    $query .= "FROM academic_sasps ";
    $query .= "JOIN admin_student_registration ON academic_sasps.sasp_student_id = admin_student_registration.student_id ";
    $query .= "JOIN admin_employees ON academic_sasps.sasp_tutor_id = admin_employees.employee_id ";
    $query .= "WHERE academic_sasps.sasp_tutor_id = '{$_SESSION['user_employee_id']}' ";
    $query .= "ORDER BY sasp_year DESC, sasp_term DESC, sasp_lesson DESC, sasp_student ASC";
    $select_sasps  = mysqli_query($connection, $query);
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
                        Student Attendance &amp; Service Provisions
                        <div class="pull-right">
                            <button type="button" class="btn btn-success btn-md" name="academic_sasps_add" id="academic_sasps_add" data-target="#academic_sasps_editable_modal" data-backdrop="static" data-keyboard="false" data-toggle="modal">
                                <span><i class="fas fa-plus"></i></span>  Add New
                            </button>
                        </div>
                    </h1>
                </div>
            </div> <!-- /.row -->
            <div class="row">
                <div class="col-lg-12"  id="academic_saspss_table">
                    <table class="table table-bordered table-striped table-hover" id="academic_sasps"> <!-- id for DataTable -->
                        <thead class="bg-primary">
                            <tr>
                                <th width="10%">Date Scheduled</th>
                                <th width="4%" class="text-center">Term</th>
                                <th width="4%">Lesson</th>
                                <th width="12%">Student</th>
<!--
                                <th>Schedule Date</th>
                                <th>Schedule Time</th>
-->
                                <th>Attendance</th>
                                <th>Weekly Lesson</th>
                                <th>Status</th>
                                <th width="5%" class="text-center">Id</th>
                                <th width="5%" class="text-center">FastAdd</th>
                                <th width="5%" class="text-center">View</th>
                                <th width="5%" class="text-center">Update</th>
                                <th width="5%" class="text-center">Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                while($row = mysqli_fetch_assoc($select_sasps)){
                                    $sasp_id               = $row['sasp_id'];
                                    $sasp_year             = $row['sasp_year'];
                                    $sasp_scheduled_date   = $row['sasp_scheduled_date'];
                                    $sasp_term             = $row['sasp_term'];
                                    $sasp_lesson           = $row['sasp_lesson'];
                                    $sasp_student          = $row['sasp_student'];
//                                    $sasp_scheduled_date   = $row['sasp_scheduled_date'];
//                                    $sasp_scheduled_time   = $row['sasp_scheduled_time'];
                                    $sasp_attendance       = $row['sasp_attendance'];
                                    $sasp_weekly_lesson    = $row['sasp_weekly_lesson'];
                                    $sasp_status           = $row['sasp_status'];
                            ?>
                                <tr>
                                    <td><?php echo $sasp_scheduled_date; ?></td>
                                    <td class="text-center"><?php echo $sasp_term; ?></td>
                                    <td class="text-center"><?php echo $sasp_lesson; ?></td>
                                    <td><?php echo $sasp_student; ?></td>
<!--
                                    <td><?php //echo $sasp_scheduled_date; ?></td>
                                    <td><?php //echo $sasp_scheduled_time; ?></td>
-->
                                    <td><?php echo $sasp_attendance; ?></td>
                                    <td>
                                        <?php
                                            if($sasp_weekly_lesson == 'To Be Completed'){
                                                echo "<span class='text-danger'>{$sasp_weekly_lesson}</span>";
                                            }else{
                                                echo $sasp_weekly_lesson;
                                            }          
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                            if($sasp_status == 'Posted'){
                                                echo "<span class='text-success'>{$sasp_status}</span>";
                                            }else{
                                                echo "<span class='text-danger'>{$sasp_status}</span>";;
                                            }          
                                        ?>
                                    </td>
                                    <td class="text-center"><?php echo $sasp_id; ?></td>
                                    <td class="text-center">
                                        <span type="button" class="btn btn-success btn-xs sasp_fast_add" name="sasp_fast_add" id="<?php echo $row['sasp_id']; ?>">
                                            <i class="fas fa-bolt"></i>
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <span type="button" class="btn btn-info btn-xs sasp_view" name="sasp_view" id="<?php echo $row['sasp_id']; ?>">
                                            <i class='fas fa-search-plus'></i>
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <span type="button" class="btn btn-warning btn-xs sasp_update" name="sasp_update" id="<?php echo $row['sasp_id']; ?>">
                                            <i class='far fa-edit'></i>
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <span type="button" class="btn btn-danger btn-xs sasp_delete" name="sasp_delete" id="<?php echo $row['sasp_id']; ?>">
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
<div class="modal fade" id="academic_sasps_editable_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
<!--                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>-->
                <h4 class="modal-title" id="myModalLabel">Student Attendance &amp; Service Provision</h4>
            </div>
            <div class="modal-body">
                <form method="post" id="academic_sasps_insert_form">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#booking" data-toggle="tab">Booking</a></li>
                        <li><a href="#attendance" data-toggle="tab">Student Attendance</a></li>
                        <li><a href="#provision" data-toggle="tab">Service Provision</a></li>
                        <li><a href="#notes" data-toggle="tab">Notes</a></li>
                    </ul>                            
                    <div class="tab-content">
                        <div class="tab-pane fade in active" id="booking">
                            <br />
                            <input type="hidden" name="sasp_id" id="sasp_id" value="" />
                            <input type="hidden" name="sasp_date_created" id="sasp_date_created" value="" />
                            <?php
                                $sasp_tutor= $_SESSION['user_employee_id'];
                                $sasp_year = date('Y');
                            ?>
                            <input type="hidden" name="sasp_year" id="sasp_year" value="<?php echo $sasp_year; ?>" />
                            <input type="hidden" name="sasp_tutor" id="sasp_tutor" value="<?php echo $sasp_tutor; ?>" />
                            <div class="form-group">
                                <label for="sasp_status">Save this record as</label>
                                <select class="form-control" name="sasp_status" id="sasp_status">
                                    <option value="">------- Select -------</option>
                                    <?php
                                        $query = "SELECT * FROM settings_post_status ORDER BY status ASC";
                                        $select_status = mysqli_query($connection, $query);
                                        while($row     = mysqli_fetch_assoc($select_status)){
                                            $status    = $row['status'];
                                            echo "<option value='$status'>{$status}</option>";
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="sasp_student">Student Name *</label>
                                <select class="form-control" name="sasp_student" id="sasp_student" required>
                                    <option value="">------- Select -------</option>
                                    <?php
                                        $query  = "SELECT DISTINCT admin_student_schedules.schedule_student_id";
                                        $query .= ", CONCAT(admin_student_registration.student_firstname, ' ', admin_student_registration.student_lastname) AS student ";
                                        $query .= "FROM admin_student_schedules ";
                                        $query .= "JOIN admin_student_registration ON admin_student_schedules.schedule_student_id = admin_student_registration.student_id ";
                                        $query .= "WHERE schedule_tutor_id = '{$sasp_tutor}' ";
                                        $query .= "AND schedule_year = '{$sasp_year}' ";
                                        $query .= "ORDER BY student ASC";
                                        $select_students  = mysqli_query($connection, $query);
                                        if(mysqli_num_rows($select_students) > 0){
                                            while($row        = mysqli_fetch_assoc($select_students)){
                                                $student_id   = $row['schedule_student_id'];
                                                $student_name = $row['student'];
                                                echo "<option value='$student_id'>{$student_name}</option>"; 
                                            }
                                        }else{
                                            echo '<option value="">No Record</option>';
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="sasp_term">School Term</label>
                                <select class="form-control" name="sasp_term" id="sasp_term">
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
                                    <label for="sasp_lesson">Lesson No.</label>
                                    <select class="form-control" name="sasp_lesson" id="sasp_lesson">
                                        <option value="">------- Select -------</option>
                                        <?php
                                            $query = "SELECT * FROM settings_lessons ORDER BY lesson_id ASC";
                                            $select_lesson = mysqli_query($connection, $query);
                                            while($row     = mysqli_fetch_assoc($select_lesson)){
                                                $lesson    = $row['lesson'];
                                                echo "<option value='$lesson'>{$lesson}</option>";
                                            }
                                        ?>
                                    </select>
                                </div>
                        </div>
                        <div class="tab-pane fade" id="attendance">
                            <br />
                            <div class="form-group">
                                <label for="sasp_scheduled_date">Scheduled Date</label>
                                <input type="text" class="form-control datepicker" name="sasp_scheduled_date" id="sasp_scheduled_date" readonly />
                            </div>
                            <div class="form-group">
                                <label for="sasp_scheduled_time">Scheduled Time</label>
                                <input type="text" class="form-control" name="sasp_scheduled_time" id="sasp_scheduled_time" placeholder="hh:mm"/>
                            </div>
                            <div class="form-group">
                                <label for="sasp_attendance">Student Attendance</label>
                                <select class="form-control" name="sasp_attendance" id="sasp_attendance">
                                    <?php
                                        $query = "SELECT * FROM settings_attendance ORDER BY attendance ASC";
                                        $select_attendance = mysqli_query($connection, $query);
                                        while($row         = mysqli_fetch_assoc($select_attendance)){
                                            $attendance    = $row['attendance'];
                                            echo "<option value='$attendance'>{$attendance}</option>";
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="sasp_student_homework">Student Homework Completed?</label>
                                <select class="form-control" name="sasp_student_homework" id="sasp_student_homework">
                                    <option value="">------- Select -------</option>
                                    <option value="Yes">Yes</option>
                                    <option value="No">No</option>
                                    <option value="Not returned">Not returned</option>
                                    <option value="N/A">N/A</option>
                                </select>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="provision">
                            <br />
                            <div class="form-group">
                                <label for="sasp_weekly_lesson">Weekly Lesson</label>
                                <select class="form-control" name="sasp_weekly_lesson" id="sasp_weekly_lesson">
                                    <option value="">------- Select -------</option>
                                    <?php
                                        $query = "SELECT * FROM settings_completion ORDER BY completion_id ASC";
                                        $select_item    = mysqli_query($connection, $query);
                                        while($row      = mysqli_fetch_assoc($select_item)){
                                            $completion = $row['completion'];
                                            echo "<option value='$completion'>{$completion}</option>";
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="sasp_wha">Weekly Homework Assignment</label>
                                <select class="form-control" name="sasp_wha" id="sasp_wha">
                                    <option value="">------- Select -------</option>
                                    <option value="Assigned">Assigned</option>
                                    <option value="To be assigned">To be assigned</option>
                                    <option value="N/A">N/A</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="sasp_email">Email to School Teacher</label>
                                <select class="form-control" name="sasp_email" id="sasp_email">
                                    <option value="">------- Select -------</option>
                                    <option value="Introductory">Introductory</option>
                                    <option value="Followup">Followup</option>
                                    <option value="N/A">N/A</option>
                                </select>
                            </div>
                        </div>  
                        <div class="tab-pane fade" id="notes">
                            <br />
                            <div class="form-group">
                                <label for="sasp_notes">Notes</label>
                                <textarea class="form-control" name="sasp_notes" id="sasp_notes" rows="15"></textarea>
                            </div>
                        </div>                        
                    </div>
                    <hr />
                    <div class="form-group text-right">
                        <button type="button" class="btn btn-default" data-dismiss="modal" id="academic_sasps_insert_cancel">Cancel</button>
                        <input class="btn btn-success" type="submit" name="academic_sasps_insert" id="academic_sasps_insert" value="" />
                    </div>
                </form>
            </div>
        </div> <!-- /.modal-content -->
    </div> <!-- /.modal-dialog -->
</div> <!-- /.modal -->

<!-- readonly_modal -->
<div class="modal fade" id="academic_sasps_readonly_modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div id="sasp_printSection">
                <div class="modal-header bg-primary">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Student Attendance &amp; Service Provision</h4>
                </div>
                <div class="modal-body" id="academic_sasps_details">
                    <!--show data here-->
                </div>
            </div>
<!--
                <div class="modal-footer">
                    <button id="sasp_btnPrint" type="button" class="btn btn-primary">Print</button>
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
        $("#academic_sasps").DataTable({
            "order":[[0, "desc"]]
        }); 
        //-------------------- printing modal --------------------//
//        document.getElementById("sasp_btnPrint").onclick = function(){
//            document.getElementById("wrapper").style.display = "none";
//            printElement(document.getElementById("sasp_printSection"));
//        }
//        function printElement(elem, append, delimiter){
//            var domClone = elem.cloneNode(true);
//            var $sasp_printSection = document.getElementById("sasp_printSection");
//            if (!$sasp_printSection){
//                var $sasp_printSection = document.createElement("div");
//                $sasp_printSection.id = "sasp_printSection";
//                document.body.appendChild($sasp_printSection);
//            }
//            if (append !== true){
//                $sasp_printSection.innerHTML = "";
//            }else if (append ===true){
//                if (typeof (delimiter) === "string"){
//                    $sasp_printSection.innerHTML += delimiter;
//                }else if (typeof (delimiter) === "object"){
//                $sasp_printSection.appendChlid(delimiter);
//                }
//            }
//            $sasp_printSection.appendChild(domClone);
//            window.print();
//            location.reload();
//        }
    }); 
    
    //++++++++++++++++++++ academic_sasps CRUD +++++++++++++++++++//
    $(document).ready(function(){
        //-------------------- add_new_button --------------------//
        $("#academic_sasps_add").click(function(){
            $("#academic_sasps_insert").val("Add");
            $("#academic_sasps_insert_form")[0].reset();
        });
        //-------------------- fastadd_button(fetch data)-------------------//
        $(document).on("click", ".sasp_fast_add", function(){
            var sasp_id = $(this).attr("id");
            $.ajax({
                url:"../staff/CRUD/fetch.php",
                method:"POST",
                data:{sasp_id:sasp_id},
                dataType:"json",
                success:function(data){
                    $("#sasp_date_created").val(data.sasp_date_created);
                    $("#sasp_year").val(data.sasp_year);
                    $("#sasp_term").val(data.sasp_term);
                    $("#sasp_tutor").val(data.sasp_tutor_id);
                    $("#sasp_student").val(data.sasp_student_id);
                    $("#sasp_lesson").val(data.sasp_lesson);
                    $("#sasp_scheduled_date").val(data.sasp_scheduled_date);
                    $("#sasp_scheduled_time").val(data.sasp_scheduled_time);
                    $("#sasp_attendance").val(data.sasp_attendance);
                    $("#sasp_student_homework").val(data.sasp_student_homework);
                    $("#sasp_weekly_lesson").val(data.sasp_weekly_lesson);
                    $("#sasp_wha").val(data.sasp_wha);
                    $("#sasp_email").val(data.sasp_email);
                    $("#sasp_notes").val(data.sasp_notes);
                    $("#sasp_status").val(data.sasp_status);
                    $("#academic_sasps_insert").val("Fast Add");
                    $("#academic_sasps_editable_modal").modal({backdrop:'static', keyboard: false});
                    $("#academic_sasps_editable_modal").modal("show");
                }
            });
        });
        //-------------------- update_button(fetch data) --------------------//
        $(document).on("click", ".sasp_update", function(){
            var sasp_id = $(this).attr("id");
            $.ajax({
                url:"../staff/CRUD/fetch.php",
                method:"POST",
                data:{sasp_id:sasp_id},
                dataType:"json",
                success:function(data){
                    $("#sasp_id").val(data.sasp_id);
                    $("#sasp_date_created").val(data.sasp_date_created);
                    $("#sasp_year").val(data.sasp_year);
                    $("#sasp_term").val(data.sasp_term);
                    $("#sasp_tutor").val(data.sasp_tutor_id);
                    $("#sasp_student").val(data.sasp_student_id);
                    $("#sasp_lesson").val(data.sasp_lesson);
                    $("#sasp_scheduled_date").val(data.sasp_scheduled_date);
                    $("#sasp_scheduled_time").val(data.sasp_scheduled_time);
                    $("#sasp_attendance").val(data.sasp_attendance);
                    $("#sasp_student_homework").val(data.sasp_student_homework);
                    $("#sasp_weekly_lesson").val(data.sasp_weekly_lesson);
                    $("#sasp_wha").val(data.sasp_wha);
                    $("#sasp_email").val(data.sasp_email);
                    $("#sasp_notes").val(data.sasp_notes);
                    $("#sasp_status").val(data.sasp_status);
                    $("#academic_sasps_insert").val("Update");
                    $("#academic_sasps_editable_modal").modal({backdrop:'static', keyboard: false});
                    $("#academic_sasps_editable_modal").modal("show");
                }
            });
        });
        //-------------------- for submit button in editable_modal --------------------//
        $("#academic_sasps_insert_form").on("submit", function(event){
            event.preventDefault();
            $.ajax({
                url:"../staff/CRUD/insert.php",
                method:"POST",
                data:$("#academic_sasps_insert_form").serialize(),
                success:function(data){
                    $("#academic_sasps_insert_form")[0].reset();
                    $("#academic_sasps_editable_modal").modal("hide");
                    $("#academic_saspss_table").html(data);
                    location.reload(); //check_point: must have!
                }
            });
        });
        //-------------------- for cancel button in editable_modal --------------------//
        $("#academic_sasps_insert_cancel").on("click", function(event){
            $("#academic_sasps_insert_form")[0].reset();
            location.reload(); //check_point: must have!
        });
        //-------------------- view_button --------------------//
        $(document).on("click", ".sasp_view", function(){
            var sasp_id = $(this).attr("id");
            $.ajax({
                url:"../staff/CRUD/read.php",
                method:"POST",
                data:{sasp_id:sasp_id},
                success:function(data){
                    $("#academic_sasps_details").html(data);
                    $("#academic_sasps_readonly_modal").modal("show");
                }
            });
        });
        //-------------------- delete_button --------------------//
        $(document).on("click", ".sasp_delete", function(event){
            event.preventDefault();
            var sasp_id = $(this).attr("id");
            if(confirm("Are you sure to delete this record ?")){
                $.ajax({
                    url:"../staff/CRUD/delete.php",
                    method:"POST",
                    data:{sasp_id:sasp_id},
                    success:function(){
                        location.reload();
                    }
                });
            }
        });
    });      
</script>

<?php include "../includes/footer.php"; ?>