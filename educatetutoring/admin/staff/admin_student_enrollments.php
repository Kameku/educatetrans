<?php include "../includes/header.php"; ?>
<?php
    $query  = "SELECT admin_student_enrollments.*";
    $query .= ", CONCAT(admin_student_registration.student_firstname, ' ', admin_student_registration.student_lastname) AS enroll_student_fullname ";
    $query .= "FROM admin_student_enrollments ";
    $query .= "JOIN admin_student_registration ON admin_student_enrollments.enroll_student_id = admin_student_registration.student_id ";
    $query .= "ORDER BY enroll_date DESC, enroll_student_fullname ASC";
    $select_enrollments  = mysqli_query($connection, $query);
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
                        Student Enrollments
                        <div class="pull-right">
                            <button type="button" class="btn btn-success btn-md" name="student_enroll_add" id="student_enroll_add" data-target="#student_enroll_editable_modal" data-backdrop="static" data-keyboard="false" data-toggle="modal">
                                <span><i class="fas fa-plus"></i></span>  Add New
                            </button>
                        </div>
                    </h1>
                </div>
            </div> <!-- /.row -->
            <div class="row">
                <div class="col-lg-12"  id="student_enrollments_table">
                    <table class="table table-bordered table-striped table-hover" id="admin_student_enrollments"> <!-- id for DataTable -->
                        <thead class="bg-primary">
                            <tr>
                                <th>Date</th>
                                <th>Student Name</th>
                                <th>Grade</th>
                                <th>Parent/Guardian</th>
                                <th>Parent Mobile</th>
                                <th>Parent Email</th>
<!--
                                <th>ICE Name</th>
                                <th>ICE Mobile</th>
-->
                                <th width="5%" class="text-center">Id</th>
                                <th width="5%" class="text-center">FastAdd</th>
                                <th width="5%" class="text-center">View</th>
                                <th width="5%" class="text-center">Update</th>
                                <th width="5%" class="text-center">Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                while($row = mysqli_fetch_assoc($select_enrollments)){
                                    $enroll_id               = $row['enroll_id'];
                                    $enroll_date             = $row['enroll_date'];
                                    $enroll_student_fullname = $row['enroll_student_fullname'];
                                    $enroll_school_grade     = $row['enroll_school_grade'];
                                    $enroll_parent           = $row['enroll_parent'];
                                    $enroll_parent_mobile    = $row['enroll_parent_mobile'];
                                    $enroll_parent_email     = $row['enroll_parent_email'];
//                                    $enroll_ice_name         = $row['enroll_ice_name'];
//                                    $enroll_ice_mobile       = $row['enroll_ice_mobile'];
                            ?>
                                <tr>
                                    <td><?php echo $enroll_date; ?></td>
                                    <td><?php echo $enroll_student_fullname; ?></td>
                                    <td><?php echo $enroll_school_grade; ?></td>
                                    <td><?php echo $enroll_parent; ?></td>
                                    <td><?php echo $enroll_parent_mobile; ?></td>
                                    <td><?php echo $enroll_parent_email; ?></td>
<!--
                                    <td><?php echo $enroll_ice_name; ?></td>
                                    <td><?php echo $enroll_ice_mobile; ?></td>
-->
                                    <td class="text-center"><?php echo $enroll_id; ?></td>
                                    <td class="text-center">
                                        <span type="button" class="btn btn-success btn-xs enroll_fast_add" name="enroll_fast_add" id="<?php echo $row['enroll_id']; ?>">
                                            <i class="fas fa-bolt"></i>
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <span type="button" class="btn btn-info btn-xs enroll_view" name="enroll_view" id="<?php echo $row['enroll_id']; ?>">
                                            <i class='fas fa-search-plus'></i>
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <span type="button" class="btn btn-warning btn-xs enroll_update" name="enroll_update" id="<?php echo $row['enroll_id']; ?>">
                                            <i class='far fa-edit'></i>
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <span type="button" class="btn btn-danger btn-xs enroll_delete" name="enroll_delete" id="<?php echo $row['enroll_id']; ?>">
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
<div class="modal fade" id="student_enroll_editable_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
<!--                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>-->
                <h4 class="modal-title" id="myModalLabel">Enrollment</h4>
            </div>
            <div class="modal-body">
                <form method="post" id="student_enroll_insert_form">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#student_info" data-toggle="tab">Student</a></li>
                        <li><a href="#schooling_info" data-toggle="tab">School</a></li>
                        <li><a href="#parent_info" data-toggle="tab">Parent</a></li>
                        <li><a href="#ice_info" data-toggle="tab">Emergency</a></li>
                        <li><a href="#intervention_info" data-toggle="tab">Interventions</a></li>
                        <li><a href="#notes" data-toggle="tab">Notes</a></li>
                    </ul>                            
                    <div class="tab-content">
                        <div class="tab-pane fade in active" id="student_info">
                            <br />
                            <input type="hidden" name="enroll_id" id="enroll_id" />
                            <div class="form-group">
                                <label for="enroll_date">Date of Enrollment</label>
                                <input type="text" class="form-control datepicker" name="enroll_date" id="enroll_date" value="<?php echo date("Y-m-d")?>" readonly />
                            </div>
                            <div class="form-group">
                                <label for="enroll_student_fullname">Student Name *</label>
                                <select class="form-control" name="enroll_student_fullname" id="enroll_student_fullname" required>
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
                            </div>
                            <div class="form-group">
                                <label for="enroll_student_DOB">Date of Birth</label>
                                <input type="text" class="form-control datepicker" name="enroll_student_DOB" id="enroll_student_DOB" readonly />
                            </div>
                            <div class="form-group">
                                <label for="enroll_student_address">Address</label>
                                <input type="text" class="form-control" name="enroll_student_address" id="enroll_student_address" />
                            </div>
                            <div class="form-group">
                                <label for="enroll_student_suburb">Suburb</label>
                                <select type="text" class="form-control" name="enroll_student_suburb" id="enroll_student_suburb">
                                    <option value="">------ Select ------</option>
                                    <?php
                                        $query = "SELECT * FROM settings_hobart_suburbs ORDER BY suburb ASC";
                                        $select_suburb = mysqli_query($connection, $query);
                                        while($row     = mysqli_fetch_assoc($select_suburb)){
                                            $suburb    = $row['suburb'];
                                            echo "<option value='$suburb'>{$suburb}</option>";
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="enroll_student_postcode">Post Code</label>
                                <input type="number" class="form-control" name="enroll_student_postcode" id="enroll_student_postcode" />
                            </div>
                            <div class="form-group">
                                <label for="enroll_student_phone">Student Phone</label>
                                <input type="number" class="form-control" name="enroll_student_phone" id="enroll_student_phone" />
                            </div>
                            <div class="form-group">
                                <label for="enroll_student_language">Language Spoken at Home</label>
                                <select type="text" class="form-control" name="enroll_student_language" id="enroll_student_language">
                                    <option value="English">English</option>
                                    <?php
                                        $query = "SELECT * FROM settings_language ORDER BY language ASC";
                                        $select_language = mysqli_query($connection, $query);
                                        while($row    = mysqli_fetch_assoc($select_language)){
                                            $language = $row['language'];
                                            echo "<option value='$language'>{$language}</option>";
                                        }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="schooling_info">
                            <br />
                            <div class="form-group">
                                <label for="enroll_school">School Attending</label>
                                <input type="text" class="form-control" name="enroll_school" id="enroll_school" />
                            </div>
                            <div class="form-group">
                                <label for="enroll_school_grade">Grade</label>
                                <input type="text" class="form-control" name="enroll_school_grade" id="enroll_school_grade" />
                            </div>
                            <div class="form-group">
                                <label for="enroll_school_teacher">Teacher Name</label>
                                <input type="text" class="form-control" name="enroll_school_teacher" id="enroll_school_teacher" />
                            </div>
                            <div class="form-group">
                                <label for="enroll_school_contact">I am happy for my child's school teacher to contact or be contacted by Educate</label>
                                <select type="text" class="form-control" name="enroll_school_contact" id="enroll_school_contact">
                                    <?php
                                        $query = "SELECT * FROM settings_yesnona ORDER BY yesnona ASC";
                                        $select_item = mysqli_query($connection, $query);
                                        while($row   = mysqli_fetch_assoc($select_item)){
                                            $yesnona    = $row['yesnona'];
                                            echo "<option value='$yesnona'>{$yesnona}</option>";
                                        }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="parent_info">
                            <br />
                            <div class="form-group">
                                <label for="enroll_parent">Parent/Guardian Name</label>
                                <input type="text" class="form-control" name="enroll_parent" id="enroll_parent" />
                            </div>
                            <div class="form-group">
                                <label for="enroll_parent_mobile">Parent Mobile</label>
                                <input type="number" class="form-control" name="enroll_parent_mobile" id="enroll_parent_mobile" />
                            </div>
                            <div class="form-group">
                                <label for="enroll_parent_home_phone">Parent Home Phone</label>
                                <input type="number" class="form-control" name="enroll_parent_home_phone" id="enroll_parent_home_phone" />
                            </div>
                            <div class="form-group">
                                <label for="enroll_parent_email">Parent Email</label>
                                <input type="email" class="form-control" name="enroll_parent_email" id="enroll_parent_email" />
                            </div>
                            <div class="form-group">
                                <label for="enroll_parent_address">Parent Address</label>
                                <input type="text" class="form-control" name="enroll_parent_address" id="enroll_parent_address" />
                            </div>
                            <div class="form-group">
                                <label for="enroll_parent_employer">Parent Employer</label>
                                <input type="text" class="form-control" name="enroll_parent_employer" id="enroll_parent_employer" />
                            </div>
                            <div class="form-group">
                                <label for="enroll_parent_work_phone">Parent Work Phone</label>
                                <input type="number" class="form-control" name="enroll_parent_work_phone" id="enroll_parent_work_phone" />
                            </div>
                        </div>
                        <div class="tab-pane fade" id="ice_info">
                            <br />
                            <div class="form-group">
                                <label for="enroll_ice_name">ICE Name</label>
                                <input type="text" class="form-control" name="enroll_ice_name" id="enroll_ice_name" />
                            </div>
                            <div class="form-group">
                                <label for="enroll_ice_relationship">ICE Relationship to Student</label>
                                <input type="text" class="form-control" name="enroll_ice_relationship" id="enroll_ice_relationship" />
                            </div>
                            <div class="form-group">
                                <label for="enroll_ice_mobile">ICE Mobile</label>
                                <input type="number" class="form-control" name="enroll_ice_mobile" id="enroll_ice_mobile" />
                            </div>
                            <div class="form-group">
                                <label for="enroll_ice_home_phone">ICE Home Phone</label>
                                <input type="number" class="form-control" name="enroll_ice_home_phone" id="enroll_ice_home_phone" />
                            </div>
                        </div>
                        <div class="tab-pane fade" id="intervention_info">
                            <br />
                            <div class="form-group">
                                <label for="enroll_psychologist">Have you provided us with relevant documentaion from psychologist or equivalent?</label>
                                <select type="text" class="form-control" name="enroll_psychologist" id="enroll_psychologist">
                                    <?php
                                        $query = "SELECT * FROM settings_yesnona ORDER BY yesnona ASC";
                                        $select_item = mysqli_query($connection, $query);
                                        while($row   = mysqli_fetch_assoc($select_item)){
                                            $yesnona    = $row['yesnona'];
                                            echo "<option value='$yesnona'>{$yesnona}</option>";
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="enroll_optometrist">Have you provided us with relevant documentaion from optometrist or ophthalmologist?</label>
                                <select type="text" class="form-control" name="enroll_optometrist" id="enroll_optometrist">
                                    <?php
                                        $query = "SELECT * FROM settings_yesnona ORDER BY yesnona ASC";
                                        $select_item = mysqli_query($connection, $query);
                                        while($row   = mysqli_fetch_assoc($select_item)){
                                            $yesnona    = $row['yesnona'];
                                            echo "<option value='$yesnona'>{$yesnona}</option>";
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="enroll_support">Have you provided us with relevant documentaion regarding prior educational support?</label>
                                <select type="text" class="form-control" name="enroll_support" id="enroll_support">
                                    <?php
                                        $query = "SELECT * FROM settings_yesnona ORDER BY yesnona ASC";
                                        $select_item = mysqli_query($connection, $query);
                                        while($row   = mysqli_fetch_assoc($select_item)){
                                            $yesnona    = $row['yesnona'];
                                            echo "<option value='$yesnona'>{$yesnona}</option>";
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="enroll_custody">Are there any legal issues regarding child custody?</label>
                                <select type="text" class="form-control" name="enroll_custody" id="enroll_custody">
                                    <?php
                                        $query = "SELECT * FROM settings_yesnona ORDER BY yesnona ASC";
                                        $select_item = mysqli_query($connection, $query);
                                        while($row   = mysqli_fetch_assoc($select_item)){
                                            $yesnona    = $row['yesnona'];
                                            echo "<option value='$yesnona'>{$yesnona}</option>";
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="enroll_allergy">Dose your child have any allergies?</label>
                                <select type="text" class="form-control" name="enroll_allergy" id="enroll_allergy">
                                    <?php
                                        $query = "SELECT * FROM settings_yesnona ORDER BY yesnona ASC";
                                        $select_item = mysqli_query($connection, $query);
                                        while($row   = mysqli_fetch_assoc($select_item)){
                                            $yesnona    = $row['yesnona'];
                                            echo "<option value='$yesnona'>{$yesnona}</option>";
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="enroll_sweets">Do you consent for your child to be given occasional chocolate/sweets?</label>
                                <select type="text" class="form-control" name="enroll_sweets" id="enroll_sweets">
                                    <?php
                                        $query = "SELECT * FROM settings_yesnona ORDER BY yesnona ASC";
                                        $select_item = mysqli_query($connection, $query);
                                        while($row   = mysqli_fetch_assoc($select_item)){
                                            $yesnona    = $row['yesnona'];
                                            echo "<option value='$yesnona'>{$yesnona}</option>";
                                        }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="notes">
                            <br />
                            <div class="form-group">
                                <label for="enroll_notes">Notes</label>
                                <textarea class="form-control" name="enroll_notes" id="enroll_notes" rows="20"></textarea>
                            </div>
                        </div>                        
                    </div>
                    <hr />
                    <div class="form-group text-right">
                        <button type="button" class="btn btn-default" data-dismiss="modal" id="student_enroll_insert_cancel">Cancel</button>
                        <input class="btn btn-success" type="submit" name="student_enroll_insert" id="student_enroll_insert" value="" />
                    </div>
                </form>
            </div>
        </div> <!-- /.modal-content -->
    </div> <!-- /.modal-dialog -->
</div> <!-- /.modal -->

<!-- readonly_modal -->

<div class="modal fade" id="student_enroll_readonly_modal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div id="enroll_printSection">
                <div class="modal-header bg-primary">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Enrollment Details</h4>
                </div>
                <div class="modal-body" id="student_enroll_details">
                    <!--show data here-->
                </div>
            </div>
<!--
                <div class="modal-footer">
                    <button id="enroll_btnPrint" type="button" class="btn btn-primary">Print</button>
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
        $("#admin_student_enrollments").DataTable({
            "order":[[0, "desc"]]
        }); 
        //-------------------- printing modal --------------------//
//        document.getElementById("enroll_btnPrint").onclick = function(){
//            document.getElementById("wrapper").style.display = "none";
//            printElement(document.getElementById("enroll_printSection"));
//        }
//        function printElement(elem, append, delimiter){
//            var domClone = elem.cloneNode(true);
//            var $enroll_printSection = document.getElementById("enroll_printSection");
//            if (!$enroll_printSection){
//                var $enroll_printSection = document.createElement("div");
//                $enroll_printSection.id = "enroll_printSection";
//                document.body.appendChild($enroll_printSection);
//            }
//            if (append !== true){
//                $enroll_printSection.innerHTML = "";
//            }else if (append ===true){
//                if (typeof (delimiter) === "string"){
//                    $enroll_printSection.innerHTML += delimiter;
//                }else if (typeof (delimiter) === "object"){
//                $enroll_printSection.appendChlid(delimiter);
//                }
//            }
//            $enroll_printSection.appendChild(domClone);
//            window.print();
//            location.reload();
//        }
    }); 
    
    //++++++++++++++++++++ admin_student_enrollments CRUD +++++++++++++++++++//
    $(document).ready(function(){
        //-------------------- add_new_button --------------------//
        $("#student_enroll_add").click(function(){
            $("#student_enroll_insert").val("Add");
            $("#student_enroll_insert_form")[0].reset();
        });
        //-------------------- fastadd_button(fetch data)-------------------//
        $(document).on("click", ".enroll_fast_add", function(){
            var enroll_id = $(this).attr("id");
            $.ajax({
                url:"CRUD/fetch.php",
                method:"POST",
                data:{enroll_id:enroll_id},
                dataType:"json",
                success:function(data){
                    $("#enroll_date").val(data.enroll_date);
                    $("#enroll_student_fullname").val(data.enroll_student_id); 
                    $("#enroll_student_DOB").val(data.enroll_student_DOB);
                    $("#enroll_student_address").val(data.enroll_student_address);
                    $("#enroll_student_suburb").val(data.enroll_student_suburb);
                    $("#enroll_student_postcode").val(data.enroll_student_postcode);
                    $("#enroll_student_phone").val(data.enroll_student_phone);
                    $("#enroll_student_language").val(data.enroll_student_language);
                    $("#enroll_school").val(data.enroll_school);
                    $("#enroll_school_grade").val(data.enroll_school_grade);
                    $("#enroll_school_teacher").val(data.enroll_school_teacher);
                    $("#enroll_school_contact").val(data.enroll_school_contact);
                    $("#enroll_parent").val(data.enroll_parent);
                    $("#enroll_parent_mobile").val(data.enroll_parent_mobile);
                    $("#enroll_parent_home_phone").val(data.enroll_parent_home_phone);
                    $("#enroll_parent_email").val(data.enroll_parent_email);
                    $("#enroll_parent_address").val(data.enroll_parent_address);
                    $("#enroll_parent_employer").val(data.enroll_parent_employer);
                    $("#enroll_parent_work_phone").val(data.enroll_parent_work_phone);
                    $("#enroll_ice_name").val(data.enroll_ice_name);
                    $("#enroll_ice_relationship").val(data.enroll_ice_relationship);
                    $("#enroll_ice_mobile").val(data.enroll_ice_mobile);
                    $("#enroll_ice_home_phone").val(data.enroll_ice_home_phone);
                    $("#enroll_psychologist").val(data.enroll_psychologist);
                    $("#enroll_optometrist").val(data.enroll_optometrist);
                    $("#enroll_support").val(data.enroll_support);
                    $("#enroll_custody").val(data.enroll_custody);
                    $("#enroll_allergy").val(data.enroll_allergy);
                    $("#enroll_sweets").val(data.enroll_sweets);
                    $("#enroll_notes").val(data.enroll_notes);
                    $("#student_enroll_insert").val("Fast Add");
                    $("#student_enroll_editable_modal").modal({backdrop:'static', keyboard: false});
                    $("#student_enroll_editable_modal").modal("show");
                }
            });
        });
        //-------------------- update_button(fetch data) --------------------//
        $(document).on("click", ".enroll_update", function(){
            var enroll_id = $(this).attr("id");
            $.ajax({
                url:"CRUD/fetch.php",
                method:"POST",
                data:{enroll_id:enroll_id},
                dataType:"json",
                success:function(data){
                    $("#enroll_id").val(data.enroll_id);
                    $("#enroll_date").val(data.enroll_date);
                    $("#enroll_student_fullname").val(data.enroll_student_id); 
                    $("#enroll_student_DOB").val(data.enroll_student_DOB);
                    $("#enroll_student_address").val(data.enroll_student_address);
                    $("#enroll_student_suburb").val(data.enroll_student_suburb);
                    $("#enroll_student_postcode").val(data.enroll_student_postcode);
                    $("#enroll_student_phone").val(data.enroll_student_phone);
                    $("#enroll_student_language").val(data.enroll_student_language);
                    $("#enroll_school").val(data.enroll_school);
                    $("#enroll_school_grade").val(data.enroll_school_grade);
                    $("#enroll_school_teacher").val(data.enroll_school_teacher);
                    $("#enroll_school_contact").val(data.enroll_school_contact);
                    $("#enroll_parent").val(data.enroll_parent);
                    $("#enroll_parent_mobile").val(data.enroll_parent_mobile);
                    $("#enroll_parent_home_phone").val(data.enroll_parent_home_phone);
                    $("#enroll_parent_email").val(data.enroll_parent_email);
                    $("#enroll_parent_address").val(data.enroll_parent_address);
                    $("#enroll_parent_employer").val(data.enroll_parent_employer);
                    $("#enroll_parent_work_phone").val(data.enroll_parent_work_phone);
                    $("#enroll_ice_name").val(data.enroll_ice_name);
                    $("#enroll_ice_relationship").val(data.enroll_ice_relationship);
                    $("#enroll_ice_mobile").val(data.enroll_ice_mobile);
                    $("#enroll_ice_home_phone").val(data.enroll_ice_home_phone);
                    $("#enroll_psychologist").val(data.enroll_psychologist);
                    $("#enroll_optometrist").val(data.enroll_optometrist);
                    $("#enroll_support").val(data.enroll_support);
                    $("#enroll_custody").val(data.enroll_custody);
                    $("#enroll_allergy").val(data.enroll_allergy);
                    $("#enroll_sweets").val(data.enroll_sweets);
                    $("#enroll_notes").val(data.enroll_notes);
                    $("#student_enroll_insert").val("Update");
                    $("#student_enroll_editable_modal").modal({backdrop:'static', keyboard: false});
                    $("#student_enroll_editable_modal").modal("show");
                }
            });
        });
        //-------------------- for submit button in editable_modal --------------------//
        $("#student_enroll_insert_form").on("submit", function(event){
            event.preventDefault();
            $.ajax({
                url:"CRUD/insert.php",
                method:"POST",
                data:$("#student_enroll_insert_form").serialize(),
                success:function(data){
                    $("#student_enroll_insert_form")[0].reset();
                    $("#student_enroll_editable_modal").modal("hide");
                    $("#student_enrollments_table").html(data);
                    location.reload(); //check_point: must have!
                }
            });
        });
        //-------------------- for cancel button in editable_modal --------------------//
        $("#student_enroll_insert_cancel").on("click", function(event){
            $("#student_enroll_insert_form")[0].reset();
            location.reload(); //check_point: must have!
        });
        //-------------------- view_button --------------------//
        $(document).on("click", ".enroll_view", function(){
            var enroll_id = $(this).attr("id");
            $.ajax({
                url:"CRUD/read.php",
                method:"POST",
                data:{enroll_id:enroll_id},
                success:function(data){
                    $("#student_enroll_details").html(data);
                    $("#student_enroll_readonly_modal").modal("show");
                }
            });
        });
        //-------------------- delete_button --------------------//
        $(document).on("click", ".enroll_delete", function(event){
            event.preventDefault();
            var enroll_id = $(this).attr("id");
            if(confirm("Are you sure to delete this record ?")){
                $.ajax({
                    url:"CRUD/delete.php",
                    method:"POST",
                    data:{enroll_id:enroll_id},
                    success:function(){
                        location.reload();
                    }
                });
            }
        });
    });      
</script>

<?php include "../includes/footer.php"; ?>