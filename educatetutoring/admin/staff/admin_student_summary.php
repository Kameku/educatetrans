<?php include "../includes/header.php"; ?>
<?php
if(!isset($_GET['id'])){
    header ("Location: admin_student_summaries.php");
}
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
                        <!--Student Summary-->
                        <?php
                            $query  = "SELECT CONCAT(student_firstname, ' ', student_lastname) AS student_name, student_id FROM admin_student_registration ";
                            $query .= "WHERE student_id = '{$_GET['id']}'";
                            $select_student  = mysqli_query($connection, $query);
                            while($row = mysqli_fetch_assoc($select_student)){
                                $student_id   = $row['student_id'];
                                $student_name = $row['student_name'];
                            }
                            echo "$student_name <small>Student ID: $student_id</small>";
                        ?>
<!--
                        <div class="pull-right hide_when_print">
                            <a href="admin_student_summaries.php" class="btn btn-outline btn-primary">
                                <span><i class="far fa-arrow-alt-circle-left"></i></span>  Student Summaries
                            </a>
                        </div>
-->
                    </h1>
                </div>
            </div> <!-- /.row -->
            <div class="student_summary_sidebar hide_when_print">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <?php echo "$student_name"; ?>
                    </div>
                    <div class="panel-body">
                        <ul class="nav" id="side-menu">
                            <li><a href="#enquiries">Enquiries</a></li>
                            <li><a href="#enrollments">Enrollments</a></li>
                            <li><a href="#schedules">Schedules</a></li>
                            <li><a href="#documents">Documents</a></li>
                        </ul>
                    </div>
                </div>
            </div> <!-- /.student_summary_sidebar -->
            <div class="row">
                <div class="col-lg-10">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h4 class="panel-title" id="enquiries">Enquiries</h4>
                        </div>
                        <div class="panel-body">
                            <?php
                                $query          = "SELECT admin_student_enquiries.*";
                                $query         .= ", DATE_FORMAT(admin_student_enquiries.enquiry_date,'%d/%m/%Y') AS enquiry_date";
                                $query         .= ", CONCAT(admin_student_registration.student_firstname, ' ', admin_student_registration.student_lastname) AS enquiry_student_fullname ";
                                $query         .= "FROM admin_student_enquiries ";
                                $query         .= "JOIN admin_student_registration ON admin_student_enquiries.enquiry_student_id = admin_student_registration.student_id ";
                                $query         .= "WHERE admin_student_enquiries.enquiry_student_id = '{$_GET['id']}'";
                                $query         .= "ORDER BY enquiry_id DESC";
                                $select_enquiry = mysqli_query($connection, $query);
                                if (mysqli_num_rows($select_enquiry) < 1){
                                    echo "No record available!";
                                }else{
                                    while($row = mysqli_fetch_array($select_enquiry)){
                                        $enquiry_id                     = $row['enquiry_id'];
                                        $enquiry_date                   = $row['enquiry_date'];
                                        $enquirer_name                  = $row['enquirer_name'];
                                        $enquiry_number                 = $row['enquiry_number'];
                                        $enquiry_email                  = $row['enquiry_email'];
                                        $enquiry_hear_about_us          = $row['enquiry_hear_about_us'];
                                        $enquiry_psychologist           = $row['enquiry_psychologist'];
                                        $enquiry_optometrist            = $row['enquiry_optometrist'];
                                        $enquiry_educational_assistance = $row['enquiry_educational_assistance'];
                                        $enquiry_concerns               = $row['enquiry_concerns'];
                                        $enquiry_goals                  = $row['enquiry_goals'];
                                        $enquiry_notes                  = $row['enquiry_notes'];
                            ?>
                                        <div class='container-fluid'>
                                            <div class="panel panel-default">
                                                <div class="panel-heading">
                                                    <h4 class="panel-title"><?php echo "Enquiry ID: $enquiry_id"; ?></h4>
                                                </div>
                                                <div class="panel-body">
                                                    <div class='row'>
                                                        <div class='col-lg-5'>
                                                            <div class='row'>
                                                                <div class='col-lg-5'>Enquiry Date</div>
                                                                <div class='col-lg-7'><?php echo "$enquiry_date"; ?></div>
                                                            </div>
                                                            <div class='row'>
                                                                <div class='col-lg-5'>Enquirer Name</div>
                                                                <div class='col-lg-7'><?php echo "$enquirer_name"; ?></div>
                                                            </div>
                                                            <div class='row'>
                                                                <div class='col-lg-5'>Contact Number</div>
                                                                <div class='col-lg-7'><?php echo "$enquiry_number"; ?></div>
                                                            </div>
                                                            <div class='row'>
                                                                <div class='col-lg-5'>Email</div>
                                                                <div class='col-lg-7'><?php echo "$enquiry_email"; ?></div>
                                                            </div>
                                                        </div>    
                                                        <div class='col-lg-7'>
                                                            <div class='row'>
                                                                <div class='col-lg-9'>Where did you hear about us?</div>
                                                                <div class='col-lg-3'><?php echo "$enquiry_hear_about_us"; ?></div>
                                                            </div>
                                                            <div class='row'>
                                                                <div class='col-lg-9'>Has the child been assessed by a school psychologist or equivalent?</div>
                                                                <div class='col-lg-3'><?php echo "$enquiry_psychologist"; ?></div>
                                                            </div>
                                                            <div class='row'>
                                                                <div class='col-lg-9'>Has the child been assessed by an optometrist or ophthalmologist?</div>
                                                                <div class='col-lg-3'><?php echo "$enquiry_optometrist"; ?></div>
                                                            </div>
                                                            <div class='row'>
                                                                <div class='col-lg-9'>Has the child received any educational assistance prior to this time?</div>
                                                                <div class='col-lg-3'><?php echo "$enquiry_educational_assistance"; ?></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <hr />
                                                    <div class='row'>
                                                        <div class='col-lg-2'>Concerns</div>
                                                        <div class='col-lg-10'><?php echo "$enquiry_concerns"; ?></div>
                                                    </div>
                                                    <hr />
                                                    <div class='row'>
                                                        <div class='col-lg-2'>Goals</div>
                                                        <div class='col-lg-10'><?php echo "$enquiry_goals"; ?></div>
                                                    </div>
                                                    <hr />
                                                    <div class='row'>
                                                        <div class='col-lg-2'>Notes</div>
                                                        <div class='col-lg-10'><?php echo "$enquiry_notes"; ?></div>
                                                    </div>     
                                                </div>
                                            </div>
                                        </div>    
                            <?php
                                    }
                                }
                            ?>
                        </div><!-- /.panel-body-->
                    </div><!-- /.Enquiries-->
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h4 class="panel-title" id="enrollments">Enrollments</h4>
                        </div>
                        <div class="panel-body">
                            <?php       
                                $query         = "SELECT admin_student_enrollments.*";
                                $query        .= ", DATE_FORMAT(admin_student_enrollments.enroll_date,'%d/%m/%Y') AS enroll_date";
                                $query        .= ", DATE_FORMAT(admin_student_enrollments.enroll_student_DOB,'%d/%m/%Y') AS enroll_student_DOB";
                                $query        .= ", CONCAT(admin_student_registration.student_firstname, ' ', admin_student_registration.student_lastname) AS enroll_student_fullname ";
                                $query        .= "FROM admin_student_enrollments ";
                                $query        .= "JOIN admin_student_registration ON admin_student_enrollments.enroll_student_id = admin_student_registration.student_id ";
                                $query        .= "WHERE admin_student_enrollments.enroll_student_id = '{$_GET['id']}'";
                                $query        .= "ORDER BY enroll_id DESC";
                                $select_enroll = mysqli_query($connection, $query);
                                if (mysqli_num_rows($select_enroll) < 1){
                                    echo "No record available!";
                                }else{
                                    while($row = mysqli_fetch_array($select_enroll)){
                                        $enroll_id                = $row['enroll_id'];
                                        $enroll_date              = $row['enroll_date'];
                                        $enroll_student_DOB       = $row['enroll_student_DOB'];
                                        $enroll_student_address   = $row['enroll_student_address'];
                                        $enroll_student_suburb    = $row['enroll_student_suburb'];
                                        $enroll_student_postcode  = $row['enroll_student_postcode'];
                                        $enroll_student_phone     = $row['enroll_student_phone'];
                                        $enroll_student_language  = $row['enroll_student_language'];
                                        $enroll_school            = $row['enroll_school'];
                                        $enroll_school_grade      = $row['enroll_school_grade'];
                                        $enroll_school_teacher    = $row['enroll_school_teacher'];
                                        $enroll_school_contact    = $row['enroll_school_contact'];
                                        $enroll_parent            = $row['enroll_parent'];
                                        $enroll_parent_mobile     = $row['enroll_parent_mobile'];
                                        $enroll_parent_home_phone = $row['enroll_parent_home_phone'];
                                        $enroll_parent_email      = $row['enroll_parent_email'];
                                        $enroll_parent_address    = $row['enroll_parent_address'];
                                        $enroll_parent_employer   = $row['enroll_parent_employer'];
                                        $enroll_parent_work_phone = $row['enroll_parent_work_phone'];
                                        $enroll_ice_name          = $row['enroll_ice_name'];
                                        $enroll_ice_relationship  = $row['enroll_ice_relationship'];
                                        $enroll_ice_mobile        = $row['enroll_ice_mobile'];
                                        $enroll_ice_home_phone    = $row['enroll_ice_home_phone'];
                                        $enroll_psychologist      = $row['enroll_psychologist'];
                                        $enroll_optometrist       = $row['enroll_optometrist'];
                                        $enroll_support           = $row['enroll_support'];
                                        $enroll_custody           = $row['enroll_custody'];
                                        $enroll_allergy           = $row['enroll_allergy'];
                                        $enroll_sweets            = $row['enroll_sweets'];
                                        $enroll_notes             = $row['enroll_notes'];
                            ?>
                                        <div class='container-fluid'>
                                            <div class="panel panel-default">
                                                <div class="panel-heading">
                                                    <h4 class="panel-title"><?php echo "Enrollment ID: $enroll_id"; ?></h4>
                                                </div>
                                                <div class="panel-body">
                                                    <div class='row'>
                                                        <div class='col-lg-3'>
                                                            <strong>Student Information</strong>
                                                        </div>
                                                        <div class='col-lg-9'>
                                                            <div class='row'>
                                                                <div class='col-lg-4'>Enrollment Date</div>
                                                                <div class='col-lg-8'><?php echo "$enroll_date"; ?></div>
                                                            </div>
                                                            <div class='row'>
                                                                <div class='col-lg-4'>Date of Birth</div>
                                                                <div class='col-lg-8'><?php echo "$enroll_student_DOB"; ?></div>
                                                            </div>
                                                            <div class='row'>
                                                                <div class='col-lg-4'>Address</div>
                                                                <div class='col-lg-8'><?php echo "$enroll_student_address $enroll_student_suburb, $enroll_student_postcode"; ?></div>
                                                            </div>
                                                            <div class='row'>
                                                                <div class='col-lg-4'>Phone</div>
                                                                <div class='col-lg-8'><?php echo "$enroll_student_phone"; ?></div>
                                                            </div>
                                                            <div class='row'>
                                                                <div class='col-lg-4'>Language at Home</div>
                                                                <div class='col-lg-8'><?php echo "$enroll_student_language"; ?></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <hr />
                                                    <div class='row'>
                                                        <div class='col-lg-3'>
                                                            <strong>Schooling Information</strong>
                                                        </div>
                                                        <div class='col-lg-9'>
                                                            <div class='row'>
                                                                <div class='col-lg-4'>School Attending</div>
                                                                <div class='col-lg-8'><?php echo "$enroll_school"; ?></div>
                                                            </div>
                                                            <div class='row'>
                                                                <div class='col-lg-4'>Grade</div>
                                                                <div class='col-lg-8'><?php echo "$enroll_school_grade"; ?></div>
                                                            </div>
                                                            <div class='row'>
                                                                <div class='col-lg-4'>Teacher</div>
                                                                <div class='col-lg-8'><?php echo "$enroll_school_teacher"; ?></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <hr />
                                                    <div class='row'>
                                                        <div class='col-lg-3'>
                                                            <strong>Parent Information</strong>
                                                        </div>
                                                        <div class='col-lg-9'>
                                                            <div class='row'>
                                                                <div class='col-lg-4'>Parent/Guardian Name</div>
                                                                <div class='col-lg-8'><?php echo "$enroll_parent"; ?></div>
                                                            </div>
                                                            <div class='row'>
                                                                <div class='col-lg-4'>Mobile</div>
                                                                <div class='col-lg-8'><?php echo "$enroll_parent_mobile"; ?></div>
                                                            </div>
                                                            <div class='row'>
                                                                <div class='col-lg-4'>Home Phone</div>
                                                                <div class='col-lg-8'><?php echo "$enroll_parent_home_phone"; ?></div>
                                                            </div>
                                                            <div class='row'>
                                                                <div class='col-lg-4'>Email</div>
                                                                <div class='col-lg-8'><?php echo "$enroll_parent_email"; ?></div>
                                                            </div>
                                                            <div class='row'>
                                                                <div class='col-lg-4'>Address</div>
                                                                <div class='col-lg-8'><?php echo "$enroll_parent_address"; ?></div>
                                                            </div>
                                                            <div class='row'>
                                                                <div class='col-lg-4'>Employer</div>
                                                                <div class='col-lg-8'><?php echo "$enroll_parent_employer"; ?></div>
                                                            </div>
                                                            <div class='row'>
                                                                <div class='col-lg-4'>Work Phone</div>
                                                                <div class='col-lg-8'><?php echo "$enroll_parent_work_phone"; ?></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <hr />
                                                    <div class='row'>
                                                        <div class='col-lg-3'>
                                                            <strong>Emergency Contact</strong>
                                                        </div>
                                                        <div class='col-lg-9'>
                                                            <div class='row'>
                                                                <div class='col-lg-4'>Name</div>
                                                                <div class='col-lg-8'><?php echo "$enroll_ice_name"; ?></div>
                                                            </div>
                                                            <div class='row'>
                                                                <div class='col-lg-4'>Relationship to Student</div>
                                                                <div class='col-lg-8'><?php echo "$enroll_ice_relationship"; ?></div>
                                                            </div>
                                                            <div class='row'>
                                                                <div class='col-lg-4'>Mobile</div>
                                                                <div class='col-lg-8'><?php echo "$enroll_ice_mobile"; ?></div>
                                                            </div>
                                                            <div class='row'>
                                                                <div class='col-lg-4'>Home Phone</div>
                                                                <div class='col-lg-8'><?php echo "$enroll_ice_home_phone"; ?></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <hr />
                                                    <div class='row'>
                                                        <div class='col-lg-3'>
                                                            <strong>Previous Interventions</strong>
                                                        </div>
                                                        <div class='col-lg-9'>
                                                            <div class='row'>
                                                                <div class='col-lg-9'>Have you provided us with relevant documentaion from psychologist or equivalent?</div>
                                                                <div class='col-lg-3'><?php echo "$enroll_psychologist"; ?></div>
                                                            </div>
                                                            <div class='row'>
                                                                <div class='col-lg-9'>Have you provided us with relevant documentaion from optometrist or ophthalmologist?</div>
                                                                <div class='col-lg-3'><?php echo "$enroll_optometrist"; ?></div>
                                                            </div>
                                                            <div class='row'>
                                                                <div class='col-lg-9'>Have you provided us with relevant documentaion regarding prior educational support?</div>
                                                                <div class='col-lg-3'><?php echo "$enroll_support"; ?></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <hr />
                                                    <div class='row'>
                                                        <div class='col-lg-3'>
                                                            <strong>Other Questions</strong>
                                                        </div>
                                                        <div class='col-lg-9'>
                                                            <div class='row'>
                                                                <div class='col-lg-9'>Are there any legal issues regarding child custody?</div>
                                                                <div class='col-lg-3'><?php echo "$enroll_custody"; ?></div>
                                                            </div>
                                                            <div class='row'>
                                                                <div class='col-lg-9'>Are you happy for your child's school teacher to contact or be contacted by Educate</div>
                                                                <div class='col-lg-3'><?php echo "$enroll_school_contact"; ?></div>
                                                            </div>
                                                            <div class='row'>
                                                                <div class='col-lg-9'>Dose your child have any allergies?</div>
                                                                <div class='col-lg-3'><?php echo "$enroll_allergy"; ?></div>
                                                            </div>
                                                            <div class='row'>
                                                                <div class='col-lg-9'>Do you consent for your child to be given occasional chocolate/sweets?</div>
                                                                <div class='col-lg-3'><?php echo "$enroll_sweets"; ?></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <hr />
                                                    <div class='row'>
                                                        <div class='col-lg-3'><strong>Notes</strong></div>
                                                        <div class='col-lg-9'><?php echo "$enroll_notes"; ?></div>
                                                    </div>
                                                </div>
                                            </div>     
                                        </div>
                            <?php
                                    }
                                }
                            ?>
                        </div>
                    </div><!-- /.Enrollments-->
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h4 class="panel-title" id="schedules">Schedules</h4>
                        </div>
                        <div class="panel-body">
                            <?php       
                                $query           = "SELECT admin_student_schedules.*";
                                $query          .= ", DATE_FORMAT(admin_student_schedules.schedule_first_lesson,'%d/%m/%Y') AS schedule_first_lesson";
                                $query          .= ", CONCAT(admin_student_registration.student_firstname, ' ', admin_student_registration.student_lastname) AS schedule_student_fullname ";
                                $query          .= ", CONCAT(admin_employees.employee_firstname, ' ', admin_employees.employee_lastname) AS schedule_tutor_fullname ";
                                $query          .= "FROM admin_student_schedules ";
                                $query          .= "JOIN admin_student_registration ON admin_student_schedules.schedule_student_id = admin_student_registration.student_id ";
                                $query          .= "JOIN admin_employees ON admin_student_schedules.schedule_tutor_id = admin_employees.employee_id ";
                                $query          .= "WHERE admin_student_schedules.schedule_student_id = '{$_GET['id']}' ";
                                $query          .= "ORDER BY schedule_year DESC, schedule_term DESC";
                                $select_schedule = mysqli_query($connection, $query);
                                if (mysqli_num_rows($select_schedule) < 1){
                                    echo "No record available!";
                                }else{
                                    while($row = mysqli_fetch_array($select_schedule)){
                                        $schedule_id               = $row['schedule_id'];
                                        $schedule_student_fullname = $row['schedule_student_fullname'];
                                        $schedule_year             = $row['schedule_year'];
                                        $schedule_term             = $row['schedule_term'];
                                        $schedule_tutor_fullname   = $row['schedule_tutor_fullname'];
                                        $schedule_subject          = $row['schedule_subject'];
                                        $schedule_package          = $row['schedule_package'];
                                        $schedule_lessons          = $row['schedule_lessons'];
                                        $schedule_first_lesson     = $row['schedule_first_lesson'];
                                        $schedule_weekday          = $row['schedule_weekday'];
                                        $schedule_time             = $row['schedule_time'];
                                        $schedule_duration         = $row['schedule_duration'];
                                        $schedule_room             = $row['schedule_room'];
                                        $schedule_notes            = $row['schedule_notes'];
                            ?>
                                        <div class='container-fluid'>
                                            <div class="panel panel-default">
                                                <div class="panel-heading">
                                                    <h4 class="panel-title"><?php echo "Schedule ID: $schedule_id"; ?></h4>
                                                </div>
                                                <div class="panel-body">
                                                    <div class='row'>
                                                        <div class='col-lg-3'>
                                                            <strong>Booking Information</strong>
                                                        </div>
                                                        <div class='col-lg-9'>
                                                            <div class='row'>
                                                                <div class='col-lg-4'>Year</div>
                                                                <div class='col-lg-8'><?php echo "$schedule_year"; ?></div>
                                                            </div>
                                                            <div class='row'>
                                                                <div class='col-lg-4'>School Term</div>
                                                                <div class='col-lg-8'><?php echo "$schedule_term"; ?></div>
                                                            </div>
                                                            <div class='row'>
                                                                <div class='col-lg-4'>Tutor</div>
                                                                <div class='col-lg-8'><?php echo "$schedule_tutor_fullname"; ?></div>
                                                            </div>
                                                            <div class='row'>
                                                                <div class='col-lg-4'>Room</div>
                                                                <div class='col-lg-8'><?php echo "$schedule_room"; ?></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <hr />
                                                    <div class='row'>
                                                        <div class='col-lg-3'>
                                                            <strong>Package Information</strong>
                                                        </div>
                                                        <div class='col-lg-9'>
                                                            <div class='row'>
                                                                <div class='col-lg-4'>Subject</div>
                                                                <div class='col-lg-8'><?php echo "$schedule_subject"; ?></div>
                                                            </div>
                                                            <div class='row'>
                                                                <div class='col-lg-4'>Package</div>
                                                                <div class='col-lg-8'><?php echo "$schedule_package"; ?></div>
                                                            </div>
                                                            <div class='row'>
                                                                <div class='col-lg-4'>Number of Lessons</div>
                                                                <div class='col-lg-8'><?php echo "$schedule_lessons"; ?></div>
                                                            </div>
                                                            <div class='row'>
                                                                <div class='col-lg-4'>Date of First Lesson</div>
                                                                <div class='col-lg-8'><?php echo "$schedule_first_lesson"; ?></div>
                                                            </div>
                                                            <div class='row'>
                                                                <div class='col-lg-4'>Booking Week Day</div>
                                                                <div class='col-lg-8'><?php echo "$schedule_weekday"; ?></div>
                                                            </div>
                                                            <div class='row'>
                                                                <div class='col-lg-4'>Time</div>
                                                                <div class='col-lg-8'><?php echo "$schedule_time"; ?></div>
                                                            </div>
                                                            <div class='row'>
                                                                <div class='col-lg-4'>Lesson Duration</div>
                                                                <div class='col-lg-8'><?php echo "$schedule_duration"; ?></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <hr />
                                                    <div class='row'>
                                                        <div class='col-lg-3'><strong>Notes</strong></div>
                                                        <div class='col-lg-9'><?php echo "$schedule_notes"; ?></div>
                                                    </div>
                                                </div>
                                            </div>     
                                        </div>
                            <?php
                                    }
                                }
                            ?>
                        </div>
                    </div><!-- /.Schedules-->
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h4 class="panel-title" id="documents">Documents</h4>
                        </div>
                        <div class="panel-body">
                            
                        </div>
                    </div><!-- /.Documents-->
                </div> <!-- col-lg -->
            </div> <!-- /.row --> 
        </div> <!-- /.container-fluid -->
    </div> <!-- /#page-wrapper -->
</div> <!-- /#wrapper -->

<script>
    $(document).ready(function(){
        //-------------------- DataTable --------------------//
        $("#admin_student_summary").DataTable();
    });   
</script>

<?php include "../includes/footer.php"; ?>