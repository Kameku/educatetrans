<?php
    //----------academic_sasps----------//
    if(isset($_POST["sasp_id"])){
        $output = "";        
        $connection = mysqli_connect("localhost", "root", "mysql", "educate_tutoring");
        $sasp_id    = $_POST["sasp_id"];    
        $query  = "SELECT academic_sasps.*";
        $query .= ", DATE_FORMAT(academic_sasps.sasp_date_created,'%d/%m/%Y') AS sasp_date_created";
        $query .= ", DATE_FORMAT(academic_sasps.sasp_scheduled_date,'%d/%m/%Y') AS sasp_scheduled_date";
        $query .= ", CONCAT(admin_student_registration.student_firstname, ' ', admin_student_registration.student_lastname) AS sasp_student";
        $query .= ", CONCAT(admin_employees.employee_firstname, ' ', admin_employees.employee_lastname) AS sasp_tutor ";
        $query .= "FROM academic_sasps ";
        $query .= "JOIN admin_student_registration ON academic_sasps.sasp_student_id = admin_student_registration.student_id ";
        $query .= "JOIN admin_employees ON academic_sasps.sasp_tutor_id = admin_employees.employee_id ";
        $query .= "WHERE academic_sasps.sasp_id = {$sasp_id}";
        $select_sasp = mysqli_query($connection, $query);
        while($row = mysqli_fetch_array($select_sasp)){
            $sasp_id               = $row['sasp_id'];
            $sasp_date_created     = $row['sasp_date_created'];
            $sasp_year             = $row['sasp_year'];
            $sasp_term             = $row['sasp_term'];
            $sasp_student          = $row['sasp_student'];
            $sasp_tutor            = $row['sasp_tutor'];
            $sasp_lesson           = $row['sasp_lesson'];
            $sasp_scheduled_date   = $row['sasp_scheduled_date'];
            $sasp_scheduled_time   = $row['sasp_scheduled_time'];
            $sasp_attendance       = $row['sasp_attendance'];
            $sasp_student_homework = $row['sasp_student_homework'];
            $sasp_weekly_lesson    = $row['sasp_weekly_lesson'];
            $sasp_wha              = $row['sasp_wha'];
            $sasp_email            = $row['sasp_email'];
            $sasp_notes            = $row['sasp_notes'];
            $sasp_status           = $row['sasp_status'];
            $output .= "
                <div class='container-fluid'>
                    <div class='row'>
                        <div class='col-lg-4'>ID</div>
                        <div class='col-lg-8'>$sasp_id</div>
                    </div>
                    <div class='row'>
                        <div class='col-lg-4'>Date Created</div>
                        <div class='col-lg-8'>$sasp_date_created</div>
                    </div>
                    <div class='row'>
                        <div class='col-lg-4'>Status</div>
            ";
            echo $output;
                    if($sasp_status == 'Posted'){
                        echo "<div class='col-lg-8'><span class='btn-success'>&nbsp $sasp_status &nbsp</span></div>";
                    }else{
                        echo "<div class='col-lg-8'><span class='btn-warning'>&nbsp $sasp_status &nbsp</span></div>";
                    }
            $output = "
                    </div>
                    <hr />
                    <div class='row'>
                        <div class='col-lg-4'>Tutor</div>
                        <div class='col-lg-8'>$sasp_tutor</div>
                    </div>
                    <div class='row'>
                        <div class='col-lg-4'>Student</div>
                        <div class='col-lg-8'><strong>$sasp_student</strong></div>
                    </div>
                    <div class='row'>
                        <div class='col-lg-4'>Year</div>
                        <div class='col-lg-8'>$sasp_year</div>
                    </div>
                    <div class='row'>
                        <div class='col-lg-4'>School Term</div>
                        <div class='col-lg-8'>$sasp_term</div>
                    </div>
                    <div class='row'>
                        <div class='col-lg-4'>Lesson No.</div>
                        <div class='col-lg-8'><strong>$sasp_lesson</strong></div>
                    </div>
                    <div class='row'>
                        <div class='col-lg-4'>Scheduled Date</div>
                        <div class='col-lg-8'>$sasp_scheduled_date</div>
                    </div>
                    <div class='row'>
                        <div class='col-lg-4'>Scheduled Time</div>
                        <div class='col-lg-8'>$sasp_scheduled_time</div>
                    </div>
                    <hr />
                    <div class='row'>
                        <div class='col-lg-4'>Student Attendance</div>
                        <div class='col-lg-8'>$sasp_attendance</div>
                    </div>
                    <div class='row'>
                        <div class='col-lg-4'>Student Homework</div>
                        <div class='col-lg-8'>$sasp_student_homework</div>
                    </div>
                    <div class='row'>
                        <div class='col-lg-4'>Weekly Lesson</div>
                        <div class='col-lg-8'>$sasp_weekly_lesson</div>
                    </div>
                    <div class='row'>
                        <div class='col-lg-4'>Weekly H/W Assignment</div>
                        <div class='col-lg-8'>$sasp_wha</div>
                    </div>
                    <div class='row'>
                        <div class='col-lg-4'>Email to School Teacher</div>
                        <div class='col-lg-8'>$sasp_email</div>
                    </div>
                    <hr />
                    <div class='row'>
                        <div class='col-lg-4'>Notes</div>
                        <div class='col-lg-8'>$sasp_notes</div>
                    </div>
                </div>          
            ";
        }
        echo $output;
    }
?>

<?php
    //----------academic_slpes----------//
    if(isset($_POST["slpe_id"])){
        $output = "";        
        $connection = mysqli_connect("localhost", "root", "mysql", "educate_tutoring");
        $slpe_id    = $_POST["slpe_id"];    
        $query  = "SELECT academic_slpes.*";
        $query .= ", DATE_FORMAT(academic_slpes.date,'%d/%m/%Y') AS date";
        $query .= ", CONCAT(admin_student_registration.student_firstname, ' ', admin_student_registration.student_lastname) AS student";
        $query .= ", CONCAT(admin_employees.employee_firstname, ' ', admin_employees.employee_lastname) AS tutor";
        $query .= ", library_subjects.subject";
        $query .= ", library_concepts.concept";
        $query .= ", library_concept_details.concept_detail";
        $query .= ", library_learning_activities.learning_activity ";
        $query .= "FROM academic_slpes ";
        $query .= "JOIN admin_student_registration ON academic_slpes.slpe_student_id = admin_student_registration.student_id ";
        $query .= "JOIN admin_employees ON academic_slpes.slpe_tutor_id = admin_employees.employee_id ";
        $query .= "JOIN library_subjects ON academic_slpes.slpe_subject_id = library_subjects.subject_id "; 
        $query .= "JOIN library_concepts ON academic_slpes.slpe_concept_id = library_concepts.concept_id ";
        $query .= "JOIN library_concept_details ON academic_slpes.slpe_concept_detail_id = library_concept_details.concept_detail_id ";
        $query .= "JOIN library_learning_activities ON academic_slpes.slpe_learning_activity_id = library_learning_activities.learning_activity_id ";
        $query .= "WHERE academic_slpes.slpe_id = {$slpe_id}";
        $select_slpe = mysqli_query($connection, $query);
        while($row = mysqli_fetch_array($select_slpe)){
            $slpe_id                   = $row['slpe_id'];
            $year                      = $row['year'];
            $term                      = $row['term'];
            $lesson                    = $row['lesson'];
            $date                      = $row['date'];
            $slpe_student              = $row['student'];
            $slpe_tutor                = $row['tutor'];
            $slpe_subject              = $row['subject'];
            $slpe_concept              = $row['concept'];
            $slpe_concept_detail       = $row['concept_detail'];
            $slpe_learning_activity    = $row['learning_activity'];
            $tutor_evaluation          = $row['tutor_evaluation'];
            $student_self_assessment   = $row['student_self_assessment'];
            $comments_homework         = $row['comments_homework'];
            $slpe_status               = $row['slpe_status'];
            $output .= "
                <div class='container-fluid'>
                    <div class='row'>
                        <div class='col-lg-4'>ID</div>
                        <div class='col-lg-8'>$slpe_id</div>
                    </div>
                    <div class='row'>
                        <div class='col-lg-4'>Date Created</div>
                        <div class='col-lg-8'>$date</div>
                    </div>
                    <div class='row'>
                        <div class='col-lg-4'>Status</div>
            ";
            echo $output;
                    if($slpe_status == 'Posted'){
                        echo "<div class='col-lg-8'><span class='btn-success'>&nbsp $slpe_status &nbsp</span></div>";
                    }else{
                        echo "<div class='col-lg-8'><span class='btn-warning'>&nbsp $slpe_status &nbsp</span></div>";
                    }
            $output = "
                    </div>
                    <hr />
                    <div class='row'>
                        <div class='col-lg-4'>Tutor</div>
                        <div class='col-lg-8'>$slpe_tutor</div>
                    </div>
                    <div class='row'>
                        <div class='col-lg-4'>Student</div>
                        <div class='col-lg-8'>$slpe_student</div>
                    </div>
                    <div class='row'>
                        <div class='col-lg-4'>Year</div>
                        <div class='col-lg-8'>$year</div>
                    </div>
                    <div class='row'>
                        <div class='col-lg-4'>School Term</div>
                        <div class='col-lg-8'>$term</div>
                    </div>
                    <div class='row'>
                        <div class='col-lg-4'>Lesson No.</div>
                        <div class='col-lg-8'>$lesson</div>
                    </div>
                    <hr />
                    <div class='row'>
                        <div class='col-lg-4'>Subject</div>
                        <div class='col-lg-8'>$slpe_subject</div>
                    </div>
                    <div class='row'>
                        <div class='col-lg-4'>Concept</div>
                        <div class='col-lg-8'>$slpe_concept</div>
                    </div>
                    <div class='row'>
                        <div class='col-lg-4'>Concept Detail</div>
                        <div class='col-lg-8'>$slpe_concept_detail</div>
                    </div>
                    <div class='row'>
                        <div class='col-lg-4'>Learning Activity</div>
                        <div class='col-lg-8'>$slpe_learning_activity</div>
                    </div>
                    <hr />
                    <div class='row'>
                        <div class='col-lg-4'>Tutor Evaluation</div>
                        <div class='col-lg-8'>$tutor_evaluation</div>
                    </div>
                    <div class='row'>
                        <div class='col-lg-4'>Student Self Assessment</div>
                        <div class='col-lg-8'>$student_self_assessment</div>
                    </div>
                    <div class='row'>
                        <div class='col-lg-4'>Comments/Homework</div>
                        <div class='col-lg-8'>$comments_homework</div>
                    </div>
                </div>          
            ";
        }
        echo $output;
    }
?>

<?php
    //----------admin_employees----------//
    if(isset($_POST["employee_id"])){
        $output = "";        
        $connection  = mysqli_connect("localhost", "root", "mysql", "educate_tutoring");
        $employee_id = $_POST["employee_id"];    
        $query       = "SELECT admin_employees.*";
        $query      .= ", DATE_FORMAT(admin_employees.employee_DOB,'%d/%m/%Y') AS employee_DOB";
        $query      .= ", settings_user_roles.role ";
        $query      .= "FROM admin_employees ";
        $query      .= "JOIN settings_user_roles ON admin_employees.employee_role_id = settings_user_roles.role_id ";
        $query      .= "WHERE admin_employees.employee_id = {$employee_id}";
        $select_employee = mysqli_query($connection, $query);
        $output .= "
            <div class='table-responsive'>
            <table class='table table-bordered'>";
        while($row = mysqli_fetch_array($select_employee)){
            $employee_id        = $row['employee_id'];
            $employee_firstname = $row['employee_firstname'];
            $employee_lastname  = $row['employee_lastname'];
            $employee_email     = $row['employee_email'];
            $employee_mobile    = $row['employee_mobile'];
            $employee_role      = $row['role'];
            $employee_dob       = $row['employee_DOB'];
            $employee_current   = $row['employee_current'];
            $output .= "
                <tr>
                    <td width='30%'><label>ID</label></td>
                    <td width='70%'>$employee_id</td>
                </tr>
                <tr>
                    <td width='30%'><label>First Name</label></td>
                    <td width='70%'>$employee_firstname</td>
                </tr>                
                <tr>
                    <td width='30%'><label>Last Nameame</label></td>
                    <td width='70%'>$employee_lastname</td>
                </tr>
                <tr>
                    <td width='30%'><label>Email</label></td>
                    <td width='70%'>$employee_email</td>
                </tr>
                <tr>
                    <td width='30%'><label>Mobile</label></td>
                    <td width='70%'>$employee_mobile</td>
                </tr>
                <tr>
                    <td width='30%'><label>Role</label></td>
                    <td width='70%'>$employee_role</td>
                </tr>
                <tr>
                    <td width='30%'><label>Date of Birth</label></td>
                    <td width='70%'>$employee_dob</td>
                </tr>
                <tr>
                    <td width='30%'><label>Current</label></td>
                    <td width='70%'>$employee_current</td>
                </tr>
            ";
        }
        $output .= "</table></div>";
        echo $output;
    }
?>

<?php
    //----------admin_student_registration----------//
    if(isset($_POST["student_id"])){
        $output = "";        
        $connection  = mysqli_connect("localhost", "root", "mysql", "educate_tutoring");
        $student_id = $_POST["student_id"];
        $query      = "SELECT * FROM admin_student_registration WHERE student_id = {$student_id}";
        $select_student = mysqli_query($connection, $query);
        $output .= "
            <div class='table-responsive'>
            <table class='table table-bordered'>";
        while($row = mysqli_fetch_array($select_student)){
            $student_id        = $row['student_id'];
            $student_firstname = $row['student_firstname'];
            $student_lastname  = $row['student_lastname'];
            
            $output .= "
                <tr>
                    <td width='30%'><label>Student ID</label></td>
                    <td width='70%'>$student_id</td>
                </tr>
                <tr>
                    <td width='30%'><label>First Name</label></td>
                    <td width='70%'>$student_firstname</td>
                </tr>
                <tr>
                    <td width='30%'><label>Last Name</label></td>
                    <td width='70%'>$student_lastname</td>
                </tr>
            ";
        }
        $output .= "</table></div>";
        echo $output;
    }
?>

<?php
    //----------admin_student_enquiries----------//
    if(isset($_POST["enquiry_id"])){
        $output = "";        
        $connection     = mysqli_connect("localhost", "root", "mysql", "educate_tutoring");
        $enquiry_id     = $_POST["enquiry_id"];    
        $query          = "SELECT admin_student_enquiries.*";
        $query         .= ", DATE_FORMAT(admin_student_enquiries.enquiry_date,'%d/%m/%Y') AS enquiry_date";
        $query         .= ", CONCAT(admin_student_registration.student_firstname, ' ', admin_student_registration.student_lastname) AS enquiry_student_fullname ";
        $query         .= "FROM admin_student_enquiries ";
        $query         .= "JOIN admin_student_registration ON admin_student_enquiries.enquiry_student_id = admin_student_registration.student_id ";
        $query         .= "WHERE admin_student_enquiries.enquiry_id = {$enquiry_id}";
        $select_enquiry = mysqli_query($connection, $query);
        while($row = mysqli_fetch_array($select_enquiry)){
            $enquiry_id                     = $row['enquiry_id'];
            $enquiry_outcome                = $row['enquiry_outcome'];
            $enquiry_date                   = $row['enquiry_date'];
            $enquirer_name                  = $row['enquirer_name'];
            $enquiry_student_fullname       = $row['enquiry_student_fullname'];
            $enquiry_number                 = $row['enquiry_number'];
            $enquiry_email                  = $row['enquiry_email'];
            $enquiry_hear_about_us          = $row['enquiry_hear_about_us'];
            $enquiry_psychologist           = $row['enquiry_psychologist'];
            $enquiry_optometrist            = $row['enquiry_optometrist'];
            $enquiry_educational_assistance = $row['enquiry_educational_assistance'];
            $enquiry_concerns               = $row['enquiry_concerns'];
            $enquiry_goals                  = $row['enquiry_goals'];
            $enquiry_notes                  = $row['enquiry_notes'];
            $output .= "
                <div class='container-fluid'>
                    <div class='row'>
                        <div class='col-lg-5'>Enquiry ID</div>
                        <div class='col-lg-7'>$enquiry_id</div>
                    </div>
            ";
            echo $output;         
                    echo "<div class='row'>";
                        echo "<div class='col-lg-5'>Enquiry Outcome</div>";
                        if ($enquiry_outcome == "Enrolled"){
                            echo "<div class='col-lg-7'><span class='btn-success'>&nbsp $enquiry_outcome &nbsp</span></div>";
                        }else if($enquiry_outcome == "Ceased"){
                            echo "<div class='col-lg-7'><span class='btn-danger'>&nbsp $enquiry_outcome &nbsp</span></div>";
                        }else if($enquiry_outcome == "Need Follow-up"){
                            echo "<div class='col-lg-7'><span class='btn-warning'>&nbsp $enquiry_outcome &nbsp</span></div>";
                        }else{
                            echo "<div class='col-lg-7'><span class='btn-default'>&nbsp $enquiry_outcome &nbsp</span></div>";
                        }
                    echo "</div>";
            $output = "
                    <div class='row'>
                        <div class='col-lg-5'>Date</div>
                        <div class='col-lg-7'>$enquiry_date</div>
                    </div>
                    <div class='row'>
                        <div class='col-lg-5'>Enquirer Name</div>
                        <div class='col-lg-7'>$enquirer_name</div>
                    </div>
                    <div class='row'>
                        <div class='col-lg-5'><strong>Student Name</strong></div>
                        <div class='col-lg-7'><strong>$enquiry_student_fullname</strong></div>
                    </div>
                    <div class='row'>
                        <div class='col-lg-5'>Contact Number</div>
                        <div class='col-lg-7'>$enquiry_number</div>
                    </div>
                    <div class='row'>
                        <div class='col-lg-5'>Email</div>
                        <div class='col-lg-7'>$enquiry_email</div>
                    </div>
                    <div class='row'>
                        <div class='col-lg-5'>Where did they hear about us?</div>
                        <div class='col-lg-7'>$enquiry_hear_about_us</div>
                    </div>
                    <hr />
                    <div class='row'>
                        <div class='col-lg-10'>Has the child been assessed by a school psychologist or equivalent?</div>
                        <div class='col-lg-2'>$enquiry_psychologist</div>
                    </div>
                    <div class='row'>
                        <div class='col-lg-10'>Has the child been assessed by an optometrist or ophthalmologist?</div>
                        <div class='col-lg-2'>$enquiry_optometrist</div>
                    </div>
                    <div class='row'>
                        <div class='col-lg-10'>Has the child received any educational assistance prior to this time?</div>
                        <div class='col-lg-2'>$enquiry_educational_assistance</div>
                    </div>
                    <hr />
                    <div class='row'>
                        <div class='col-lg-2'><strong>Concerns</strong></div>
                        <div class='col-lg-10'>$enquiry_concerns</div>
                    </div>
                    <hr />
                    <div class='row'>
                        <div class='col-lg-2'><strong>Goals</strong></div>
                        <div class='col-lg-10'>$enquiry_goals</div>
                    </div>
                    <hr />
                    <div class='row'>
                        <div class='col-lg-2'><strong>Notes</strong></div>
                        <div class='col-lg-10'>$enquiry_notes</div>
                    </div>
                </div>           
            ";
        }
        echo $output;
    }
?>

<?php
    //----------admin_student_eprocedures----------//
    if(isset($_POST["procedure_id"])){
        echo "";        
        $connection   = mysqli_connect("localhost", "root", "mysql", "educate_tutoring");
        $procedure_id = $_POST["procedure_id"];    
        $query  = "SELECT admin_student_eprocedures.*";
        $query .= ", DATE_FORMAT(admin_student_eprocedures.procedure_date,'%d/%m/%Y') AS procedure_date";
        $query .= ", DATE_FORMAT(admin_student_eprocedures.procedure_pis_date,'%d/%m/%Y') AS procedure_pis_date";
        $query .= ", CONCAT(admin_student_registration.student_firstname, ' ', admin_student_registration.student_lastname) AS procedure_student_fullname ";
        $query .= "FROM admin_student_eprocedures ";
        $query .= "JOIN admin_student_registration ON admin_student_eprocedures.procedure_student_id = admin_student_registration.student_id ";
        $query .= "WHERE admin_student_eprocedures.procedure_id = {$procedure_id}";
        $select_procedure = mysqli_query($connection, $query);
        while($row = mysqli_fetch_array($select_procedure)){
            $procedure_id                  = $row['procedure_id'];
            $procedure_date                = $row['procedure_date'];
            $procedure_student_fullname    = $row['procedure_student_fullname'];
            $procedure_enquiry_id          = $row['procedure_enquiry_id'];
            $procedure_introduction_letter = $row['procedure_introduction_letter'];
            $procedure_deposit             = $row['procedure_deposit'];
            $procedure_pis_date            = $row['procedure_pis_date'];
            $procedure_pis_status          = $row['procedure_pis_status'];
            $procedure_enrollment          = $row['procedure_enrollment'];
            $procedure_schedule            = $row['procedure_schedule'];
            $procedure_confirmation        = $row['procedure_confirmation'];
            $procedure_xero                = $row['procedure_xero'];
            $procedure_invoice             = $row['procedure_invoice'];
            $procedure_ezidebit            = $row['procedure_ezidebit'];
            $procedure_folder              = $row['procedure_folder'];
            $procedure_notes               = $row['procedure_notes'];
            echo "<div class='container-fluid'>";
                echo "<div class='row'>";
                    echo "<div class='col-lg-5'>ID</div>";
                    echo "<div class='col-lg-7'>$procedure_id</div>";
                echo "</div>";
                echo "<div class='row'>";
                    echo "<div class='col-lg-5'>Date Created</div>";
                    echo "<div class='col-lg-7'>$procedure_date</div>";
                echo "</div>";
                echo "<div class='row'>";
                    echo "<div class='col-lg-5'>Student</div>";
                    echo "<div class='col-lg-7'>$procedure_student_fullname</div>";
                echo "</div>";
                echo "<div class='row'>";
                    echo "<div class='col-lg-5'>Enquiry ID</div>";
                    echo "<div class='col-lg-7'>$procedure_enquiry_id</div>";
                echo "</div>";
                echo "<hr />";
                echo "<div class='row'>";
                    echo "<div class='col-lg-5'>Email Introduction Letter</div>";
                    if ($procedure_introduction_letter == "Completed"){
                        echo "<div class='col-lg-7'><span class='btn-success'>&nbsp $procedure_introduction_letter &nbsp</span></div>";
                    }else{
                        echo "<div class='col-lg-7'><span class='btn-warning'>$procedure_introduction_letter</span></div>";
                    }
                echo "</div>";
                echo "<div class='row'>";
                    echo "<div class='col-lg-5'>Holding Deposit</div>";
                    if ($procedure_deposit == "Received"){
                        echo "<div class='col-lg-7'><span class='btn-success'>&nbsp $procedure_deposit &nbsp</span></div>";
                    }else{
                        echo "<div class='col-lg-7'><span class='btn-warning'>$procedure_deposit</span></div>";
                    }
                echo "</div>";
                echo "<div class='row'>";
                    echo "<div class='col-lg-5'>Parent Information Session Date</div>";
                    if ($procedure_pis_date == "00/00/0000"){
                        echo "<div class='col-lg-7'><span class='btn-warning'>N/A</span></div>";
                    }else{
                        echo "<div class='col-lg-7'>$procedure_pis_date</div>";
                    }
                echo "</div>";
                echo "<div class='row'>";
                    echo "<div class='col-lg-5'>Parent Information Session</div>";
                    if ($procedure_pis_status == "Completed"){
                        echo "<div class='col-lg-7'><span class='btn-success'>&nbsp $procedure_pis_status &nbsp</span></div>";
                    }else{
                        echo "<div class='col-lg-7'><span class='btn-warning'>$procedure_pis_status</span></div>";
                    }
                echo "</div>";
                echo "<hr />";
                echo "<div class='row'>";
                    echo "<div class='col-lg-5'>Enrollment Form data entry</div>";
                    if ($procedure_enrollment == "Completed"){
                        echo "<div class='col-lg-7'><span class='btn-success'>&nbsp $procedure_enrollment &nbsp</span></div>";
                    }else{
                        echo "<div class='col-lg-7'><span class='btn-warning'>$procedure_enrollment</span></div>";
                    }
                echo "</div>";
                echo "<div class='row'>";
                    echo "<div class='col-lg-5'>Schedule data entry</div>";
                    if ($procedure_schedule == "Completed"){
                        echo "<div class='col-lg-7'><span class='btn-success'>&nbsp $procedure_schedule &nbsp</span></div>";
                    }else{
                        echo "<div class='col-lg-7'><span class='btn-warning'>$procedure_schedule</span></div>";
                    }
                echo "</div>";
                echo "<div class='row'>";
                    echo "<div class='col-lg-5'>Send Confirmation Letter</div>";
                    if ($procedure_confirmation == "Completed"){
                        echo "<div class='col-lg-7'><span class='btn-success'>&nbsp $procedure_confirmation &nbsp</span></div>";
                    }else{
                        echo "<div class='col-lg-7'><span class='btn-warning'>$procedure_confirmation</span></div>";
                    }
                echo "</div>";
                echo "<div class='row'>";
                    echo "<div class='col-lg-5'>Xero data entry</div>";
                    if ($procedure_xero == "Completed"){
                        echo "<div class='col-lg-7'><span class='btn-success'>&nbsp $procedure_xero &nbsp</span></div>";
                    }else{
                        echo "<div class='col-lg-7'><span class='btn-warning'>$procedure_xero</span></div>";
                    }
                echo "</div>";
                echo "<div class='row'>";
                    echo "<div class='col-lg-5'>Create term invoice</div>";
                    if ($procedure_invoice == "Completed"){
                        echo "<div class='col-lg-7'><span class='btn-success'>&nbsp $procedure_invoice &nbsp</span></div>";
                    }else{
                        echo "<div class='col-lg-7'><span class='btn-warning'>$procedure_invoice</span></div>";
                    }
                echo "</div>";
                echo "<div class='row'>";
                    echo "<div class='col-lg-5'>Ezidebit data entry</div>";
                    if ($procedure_ezidebit == "Completed"){
                        echo "<div class='col-lg-7'><span class='btn-success'>&nbsp $procedure_ezidebit &nbsp</span></div>";
                    }else{
                        echo "<div class='col-lg-7'><span class='btn-warning'>$procedure_ezidebit</span></div>";
                    }
                echo "</div>";
                echo "<div class='row'>";
                    echo "<div class='col-lg-5'>Student folder on tutor's shelf</div>";
                    if ($procedure_folder == "Completed"){
                        echo "<div class='col-lg-7'><span class='btn-success'>&nbsp $procedure_folder &nbsp</span></div>";
                    }else{
                        echo "<div class='col-lg-7'><span class='btn-warning'>$procedure_folder</span></div>";
                    }
                echo "</div>";
                echo "<hr />";
                echo "<div class='row'>";
                    echo "<div class='col-lg-5'>Notes</div>";
                    echo "<div class='col-lg-7'>$procedure_notes</div>";
                echo "</div>";
            echo "</div>";
        }
    }
?>

<?php
    //----------introduction_letters----------//
    if(isset($_POST["introduction_letter_id"])){
        $output = "";        
        $connection     = mysqli_connect("localhost", "root", "mysql", "educate_tutoring");
        $enquiry_id     = $_POST["introduction_letter_id"];
        $query          = "SELECT admin_student_enquiries.*";
//        $query          = ", SUBSTRING_INDEX(admin_student_enquiries.enquirer_name, ' ', 1) AS enquirer_firstname";
        $query         .= ", admin_student_registration.student_firstname ";
        $query         .= "FROM admin_student_enquiries ";
        $query         .= "JOIN admin_student_registration ON admin_student_enquiries.enquiry_student_id = admin_student_registration.student_id ";
        $query         .= "WHERE admin_student_enquiries.enquiry_id = {$enquiry_id}";
        $select_enquiry = mysqli_query($connection, $query);
        while($row = mysqli_fetch_array($select_enquiry)){
            $enquiry_id                = $row['enquiry_id'];
            $enquirer_firstname        = $row['enquirer_name'];
//            $enquirer_firstname        = $row['enquirer_firstname'];
            $enquiry_student_firstname = $row['student_firstname'];
            $enquiry_email             = $row['enquiry_email'];
            $output .= "
                <div class='container-fluid'>
                    <div class='row'>
                        <div class='col-lg-12'>
                            <p>Dear $enquirer_firstname,
                                <br />
                                <br />
                                It was lovely to have conversation with you.
                                <br />
                                <br />
                                Educate Tutoring Pty Ltd is a small company, based in Kingston, providing tailored tutoring services to meet the specific needs of students and their families. All our tutors have teaching qualifications and experience in providing personalised programs for individuals and small groups of students. 
                                <br />
                                <br />
                                We offer two different packages:
                                <br />
                                <br />
                                    •	<strong>Academic Coaching</strong> is suitable for high school and college students and is designed to support their school based learning by assisting with assignments and homework.
                                <br />
                                    •	Our <strong>Intevention Support Program</strong> is ideal for students needing specialised help. For most of our students, this is in the areas of Literacy and/or Numeracy. 
                                <br />
                                <br />
                                Our Tutors
                                <br />
                                <strong>Naomi Wright</strong> – is our principal educator and specialises in teaching Literacy using a multi sensory approach to reading, writing and spelling. 
                                <br />
                                <strong>Jenni Fleming</strong> – specialises in early Literacy and Numeracy for students in early childhood and primary grades. Jenni has worked both as a classroom and support teacher and has over X years experience.
                                <br />
                                <strong>Merrie Wilson</strong> – trained in early childhood education and has over 22 years experience as a learning support teacher for students with a range of learning challenges and those with English as a second language.
                                <br />
                                <strong>Stephen Bradshaw</strong> – specialises in Mathematics and Science for upper primary and high school students.  Stephen has taught in schools in NSW, South America and Asia.
                                <br />
                                <strong>Rosemary Beswick</strong> – specialises in teaching Mathematics and Science for high school and college students. Rosemary has over x years of experience.
                                <br />
                                <br />
                                Following our conversation, we recommend {tutor name} to work with your child, $enquiry_student_firstname.
                                To see their current availability, <u>click here</u>.
                                <br />
                                <br />
                                Once a time has been selected, please contact the office at Educate Tutoring on 6229 8096 or by email. An initial payment of $79 will be required to secure your preferred day and time. This amount will be subtracted from the full invoice amount. We will schedule a Parent Information Session prior to commencing tutoring. 
                                <br />
                                <br />
                                Our preferred payment method is Ezidebit. Payments can be made weekly, fortnightly, monthly or by term. Please find attached the following documents:
                                <br />
                                -	Ezidebit form
                                <br />
                                -	Client Letter of Engagement
                                <br />
                                <br />
                                We look forward to hearing from you and welcoming $enquiry_student_firstname and your family to Educate Tutoring.  If you have any questions, please do not hesitate to contact the office on 6229 8096.
                                <br />
                                <br />
                                Warm Regards,
                                <br />
                                <br />
                                <br />
                                <br />
                                Katrina Dreissen
                                <br />
                                Educate Tutoring Pty Ltd
                                <br />
                                Admin and Office Manager
                            </p>
                        </div>
                    </div>
                </div>
            ";
        }
        echo $output;
    }
?>

<?php
    //----------admin_student_enrollments----------//
    if(isset($_POST["enroll_id"])){
        $output = "";        
        $connection    = mysqli_connect("localhost", "root", "mysql", "educate_tutoring");
        $enroll_id     = $_POST["enroll_id"];    
        $query         = "SELECT admin_student_enrollments.*";
        $query        .= ", DATE_FORMAT(admin_student_enrollments.enroll_date,'%d/%m/%Y') AS enroll_date";
        $query        .= ", DATE_FORMAT(admin_student_enrollments.enroll_student_DOB,'%d/%m/%Y') AS enroll_student_DOB";
        $query        .= ", CONCAT(admin_student_registration.student_firstname, ' ', admin_student_registration.student_lastname) AS enroll_student_fullname ";
        $query        .= "FROM admin_student_enrollments ";
        $query        .= "JOIN admin_student_registration ON admin_student_enrollments.enroll_student_id = admin_student_registration.student_id ";
        $query        .= "WHERE admin_student_enrollments.enroll_id = {$enroll_id}";
        $select_enroll = mysqli_query($connection, $query);
        while($row = mysqli_fetch_array($select_enroll)){
            $enroll_id                = $row['enroll_id'];
            $enroll_date              = $row['enroll_date'];
            $enroll_student_fullname  = $row['enroll_student_fullname'];
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
            $output .= "
                <div class='container-fluid'>
                    <div class='row'>
                        <div class='col-lg-3'>
                            <strong>Student</strong>
                        </div>
                        <div class='col-lg-9'>
                            <div class='row'>
                                <div class='col-lg-4'>Enrollment ID</div>
                                <div class='col-lg-8'>$enroll_id</div>
                            </div>
                            <div class='row'>
                                <div class='col-lg-4'>Enrollment Date</div>
                                <div class='col-lg-8'>$enroll_date</div>
                            </div>
                            <div class='row'>
                                <div class='col-lg-4'>Name</div>
                                <div class='col-lg-8'><strong>$enroll_student_fullname</strong></div>
                            </div>
                            <div class='row'>
                                <div class='col-lg-4'>Date of Birth</div>
                                <div class='col-lg-8'>$enroll_student_DOB</div>
                            </div>
                            <div class='row'>
                                <div class='col-lg-4'>Address</div>
                                <div class='col-lg-8'>$enroll_student_address $enroll_student_suburb, $enroll_student_postcode</div>
                            </div>
                            <div class='row'>
                                <div class='col-lg-4'>Phone</div>
                                <div class='col-lg-8'>$enroll_student_phone</div>
                            </div>
                            <div class='row'>
                                <div class='col-lg-4'>Language at Home</div>
                                <div class='col-lg-8'>$enroll_student_language</div>
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
                                <div class='col-lg-8'>$enroll_school</div>
                            </div>
                            <div class='row'>
                                <div class='col-lg-4'>Grade</div>
                                <div class='col-lg-8'>$enroll_school_grade</div>
                            </div>
                            <div class='row'>
                                <div class='col-lg-4'>Teacher</div>
                                <div class='col-lg-8'>$enroll_school_teacher</div>
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
                                <div class='col-lg-8'>$enroll_parent</div>
                            </div>
                            <div class='row'>
                                <div class='col-lg-4'>Mobile</div>
                                <div class='col-lg-8'>$enroll_parent_mobile</div>
                            </div>
                            <div class='row'>
                                <div class='col-lg-4'>Home Phone</div>
                                <div class='col-lg-8'>$enroll_parent_home_phone</div>
                            </div>
                            <div class='row'>
                                <div class='col-lg-4'>Email</div>
                                <div class='col-lg-8'><a href='mailto:$enroll_parent_email'>$enroll_parent_email</a></div>
                            </div>
                            <div class='row'>
                                <div class='col-lg-4'>Address</div>
                                <div class='col-lg-8'>$enroll_parent_address</div>
                            </div>
                            <div class='row'>
                                <div class='col-lg-4'>Employer</div>
                                <div class='col-lg-8'>$enroll_parent_employer</div>
                            </div>
                            <div class='row'>
                                <div class='col-lg-4'>Work Phone</div>
                                <div class='col-lg-8'>$enroll_parent_work_phone</div>
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
                                <div class='col-lg-8'>$enroll_ice_name</div>
                            </div>
                            <div class='row'>
                                <div class='col-lg-4'>Relationship to Student</div>
                                <div class='col-lg-8'>$enroll_ice_relationship</div>
                            </div>
                            <div class='row'>
                                <div class='col-lg-4'>Mobile</div>
                                <div class='col-lg-8'>$enroll_ice_mobile</div>
                            </div>
                            <div class='row'>
                                <div class='col-lg-4'>Home Phone</div>
                                <div class='col-lg-8'>$enroll_ice_home_phone</div>
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
                                <div class='col-lg-11'>Have you provided us with relevant documentaion from psychologist or equivalent?</div>
                                <div class='col-lg-1'>$enroll_psychologist</div>
                            </div>
                            <div class='row'>
                                <div class='col-lg-11'>Have you provided us with relevant documentaion from optometrist or ophthalmologist?</div>
                                <div class='col-lg-1'>$enroll_optometrist</div>
                            </div>
                            <div class='row'>
                                <div class='col-lg-11'>Have you provided us with relevant documentaion regarding prior educational support?</div>
                                <div class='col-lg-1'>$enroll_support</div>
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
                                <div class='col-lg-11'>Are there any legal issues regarding child custody?</div>
                                <div class='col-lg-1'>$enroll_custody</div>
                            </div>
                            <div class='row'>
                                <div class='col-lg-11'>Are you happy for your child's school teacher to contact or be contacted by Educate</div>
                                <div class='col-lg-1'>$enroll_school_contact</div>
                            </div>
                            <div class='row'>
                                <div class='col-lg-11'>Dose your child have any allergies?</div>
                                <div class='col-lg-1'>$enroll_allergy</div>
                            </div>
                            <div class='row'>
                                <div class='col-lg-11'>Do you consent for your child to be given occasional chocolate/sweets?</div>
                                <div class='col-lg-1'>$enroll_sweets</div>
                            </div>
                        </div>
                    </div>
                    <hr />
                    <div class='row'>
                        <div class='col-lg-3'><strong>Notes</strong></div>
                        <div class='col-lg-9'>$enroll_notes</div>
                    </div>
                </div>           
            ";
        }
        echo $output;
    }
?>

<?php
    //----------admin_student_schedules----------//
    if(isset($_POST["schedule_id"])){
        $output = "";        
        $connection      = mysqli_connect("localhost", "root", "mysql", "educate_tutoring");
        $schedule_id     = $_POST["schedule_id"];    
        $query           = "SELECT admin_student_schedules.*";
        $query          .= ", DATE_FORMAT(admin_student_schedules.schedule_first_lesson,'%d/%m/%Y') AS schedule_first_lesson";
        $query          .= ", CONCAT(admin_student_registration.student_firstname, ' ', admin_student_registration.student_lastname) AS schedule_student_fullname ";
        $query          .= ", CONCAT(admin_employees.employee_firstname, ' ', admin_employees.employee_lastname) AS schedule_tutor_fullname ";
        $query          .= "FROM admin_student_schedules ";
        $query          .= "JOIN admin_student_registration ON admin_student_schedules.schedule_student_id = admin_student_registration.student_id ";
        $query          .= "JOIN admin_employees ON admin_student_schedules.schedule_tutor_id = admin_employees.employee_id ";
        $query          .= "WHERE admin_student_schedules.schedule_id = {$schedule_id}";
        $select_schedule = mysqli_query($connection, $query);
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
            $output .= "
                <div class='container-fluid'>
                    <div class='row'>
                        <div class='col-lg-3'>
                            <strong>Booking</strong>
                        </div>
                        <div class='col-lg-9'>
                            <div class='row'>
                                <div class='col-lg-5'>Schedule ID</div>
                                <div class='col-lg-7'>$schedule_id</div>
                            </div>
                            <div class='row'>
                                <div class='col-lg-5'>Year</div>
                                <div class='col-lg-7'>$schedule_year</div>
                            </div>
                            <div class='row'>
                                <div class='col-lg-5'>School Term</div>
                                <div class='col-lg-7'>$schedule_term</div>
                            </div>
                            <div class='row'>
                                <div class='col-lg-5'>Student Name</div>
                                <div class='col-lg-7'><strong>$schedule_student_fullname</strong></div>
                            </div>
                            <div class='row'>
                                <div class='col-lg-5'>Tutor</div>
                                <div class='col-lg-7'>$schedule_tutor_fullname</div>
                            </div>
                            <div class='row'>
                                <div class='col-lg-5'>Room</div>
                                <div class='col-lg-7'>$schedule_room</div>
                            </div>
                        </div>
                    </div>
                    <hr />
                    <div class='row'>
                        <div class='col-lg-3'>
                            <strong>Package</strong>
                        </div>
                        <div class='col-lg-9'>
                            <div class='row'>
                                <div class='col-lg-5'>Subject</div>
                                <div class='col-lg-7'>$schedule_subject</div>
                            </div>
                            <div class='row'>
                                <div class='col-lg-5'>Package</div>
                                <div class='col-lg-7'>$schedule_package</div>
                            </div>
                            <div class='row'>
                                <div class='col-lg-5'>Number of Lessons</div>
                                <div class='col-lg-7'>$schedule_lessons</div>
                            </div>
                            <div class='row'>
                                <div class='col-lg-5'>Date of First Lesson</div>
                                <div class='col-lg-7'>$schedule_first_lesson</div>
                            </div>
                            <div class='row'>
                                <div class='col-lg-5'>Booking Week Day</div>
                                <div class='col-lg-7'><strong>$schedule_weekday</strong></div>
                            </div>
                            <div class='row'>
                                <div class='col-lg-5'>Booking Time</div>
                                <div class='col-lg-7'><strong>$schedule_time</strong></div>
                            </div>
                            <div class='row'>
                                <div class='col-lg-5'>Lesson Duration</div>
                                <div class='col-lg-7'>$schedule_duration</div>
                            </div>
                        </div>
                    </div>
                    <hr />
                    <div class='row'>
                        <div class='col-lg-3'><strong>Notes</strong></div>
                        <div class='col-lg-9'>$schedule_notes</div>
                    </div>
                </div>          
            ";
        }
        echo $output;
    }
?>

<?php
    //----------admin_tasks----------//
    if(isset($_POST["task_id"])){
        $output = "";        
        $connection = mysqli_connect("localhost", "root", "mysql", "educate_tutoring");
        $task_id    = $_POST["task_id"];    
        $query      = "SELECT admin_tasks.* ";
        $query     .= ", DATE_FORMAT(admin_tasks.task_date_created,'%d/%m/%Y') AS task_date_created";
        $query     .= ", DATE_FORMAT(admin_tasks.task_date_due,'%d/%m/%Y') AS task_date_due";
        $query     .= ", CONCAT(employees_from.employee_firstname, ' ', employees_from.employee_lastname) AS task_from_fullname ";
        $query     .= ", CONCAT(employees_to.employee_firstname, ' ', employees_to.employee_lastname) AS task_to_fullname ";
        $query     .= "FROM admin_tasks ";
        $query     .= "JOIN admin_employees AS employees_from ON admin_tasks.task_from = employees_from.employee_id ";
        $query     .= "JOIN admin_employees AS employees_to ON admin_tasks.task_to = employees_to.employee_id ";
        $query     .= "WHERE admin_tasks.task_id = {$task_id}";
        $select_task = mysqli_query($connection, $query);
        while($row = mysqli_fetch_array($select_task)){
            $task_id            = $row['task_id'];
            $task_date_created  = $row['task_date_created'];
            $task_from_fullname = $row['task_from_fullname'];
            $task_to_fullname   = $row['task_to_fullname'];
            $task_group         = $row['task_group'];
            $task_title         = $row['task_title'];
            $task_content       = $row['task_content'];
            $task_priority      = $row['task_priority'];
            $task_status        = $row['task_status'];
            $task_date_due      = $row['task_date_due'];
                if ($task_date_due == '00/00/0000'){
                    $task_date_due = "N/A";
                }
            $task_notes         = $row['task_notes'];
            $output .= "
                <div class='container-fluid'>
                    <div class='row'>
                        <div class='col-lg-3'>Task ID</div>
                        <div class='col-lg-9'>$task_id</div>
                    </div>
                    <div class='row'>
                        <div class='col-lg-3'>Date Created</div>
                        <div class='col-lg-9'>$task_date_created</div>
                    </div>
                    <div class='row'>
                        <div class='col-lg-3'>From</div>
                        <div class='col-lg-9'>$task_from_fullname</div>
                    </div>
                    <div class='row'>
                        <div class='col-lg-3'>To</div>
                        <div class='col-lg-9'>$task_to_fullname</div>
                    </div>
                    <div class='row'>
                        <div class='col-lg-3'>Task Group</div>
                        <div class='col-lg-9'>$task_group</div>
                    </div>
                    <div class='row'>
                        <div class='col-lg-3'>Priority</div>
                        <div class='col-lg-9'>$task_priority</div>
                    </div>
                    <div class='row'>
                        <div class='col-lg-3'>Completion</div>
                        <div class='col-lg-9'>$task_status</div>
                    </div>
                    <div class='row'>
                        <div class='col-lg-3'>Due Date</div>
                        <div class='col-lg-9'>$task_date_due</div>
                    </div>
                    <hr />
                    <div class='row'>
                        <div class='col-lg-3'>Title</div>
                        <div class='col-lg-9'>$task_title</div>
                    </div>
                    <hr />
                    <div class='row'>
                        <div class='col-lg-3'>Content</div>
                        <div class='col-lg-9'>$task_content</div>
                    </div>
                    <hr />
                    <div class='row'>
                        <div class='col-lg-3'>Notes</div>
                        <div class='col-lg-9'>$task_notes</div>
                    </div>
                </div>          
            ";
        }
        echo $output;
    }
?>

<?php
    //----------users_employee_users----------//
    if(isset($_POST["employee_user_id"])){
        $output = "";        
        $connection = mysqli_connect("localhost", "root", "mysql", "educate_tutoring");
        $employee_user_id = $_POST["employee_user_id"];    
        $query  = "SELECT admin_employee_users.*";
        $query .= ", DATE_FORMAT(admin_employee_users.date_created,'%d/%m/%Y') AS date_created";
        $query .= ", CONCAT(admin_employees.employee_firstname, ' ', admin_employees.employee_lastname) AS user_fullname";
        $query .= ", settings_user_roles.role ";
        $query .= "FROM admin_employee_users ";
        $query .= "JOIN admin_employees ON admin_employee_users.user_employee_id = admin_employees.employee_id ";
        $query .= "JOIN settings_user_roles ON admin_employee_users.user_role_id = settings_user_roles.role_id ";
        $query .= "WHERE admin_employee_users.employee_user_id = {$employee_user_id}";
        $select_user = mysqli_query($connection, $query);
        $output .= "
            <div class='table-responsive'>
            <table class='table table-bordered'>";
        while($row = mysqli_fetch_array($select_user)){
            $employee_user_id       = $row['employee_user_id'];
            $employee_fullname      = $row['user_fullname'];
            $employee_username      = $row['username'];
            $employee_user_role     = $row['role'];
            $employee_date_created  = $row['date_created'];
            $output .= "
                <tr>
                    <td width='30%'><label>ID</label></td>
                    <td width='70%'>$employee_user_id</td>
                </tr>
                <tr>
                    <td width='30%'><label>Name</label></td>
                    <td width='70%'>$employee_fullname</td>
                </tr>                
                <tr>
                    <td width='30%'><label>Username</label></td>
                    <td width='70%'>$employee_username</td>
                </tr>
                <tr>
                    <td width='30%'><label>Role</label></td>
                    <td width='70%'>$employee_user_role</td>
                </tr>
                <tr>
                    <td width='30%'><label>Date Created</label></td>
                    <td width='70%'>$employee_date_created</td>
                </tr>
            ";
        }
        $output .= "</table></div>";
        echo $output;
    }
?>

<?php
    //----------users_student_users----------//
    if(isset($_POST["student_user_id"])){
        $output = "";        
        $connection = mysqli_connect("localhost", "root", "mysql", "educate_tutoring");
        $student_user_id = $_POST["student_user_id"];    
        $query  = "SELECT admin_student_users.*";
        $query .= ", DATE_FORMAT(admin_student_users.date_created,'%d/%m/%Y') AS date_created";
        $query .= ", CONCAT(admin_student_registration.student_firstname, ' ', admin_student_registration.student_lastname) AS user_fullname";
        $query .= ", settings_user_roles.role ";
        $query .= "FROM admin_student_users ";
        $query .= "JOIN admin_student_registration ON admin_student_users.user_student_id = admin_student_registration.student_id ";
        $query .= "JOIN settings_user_roles ON admin_student_users.user_role_id = settings_user_roles.role_id ";
        $query .= "WHERE admin_student_users.student_user_id = {$student_user_id}";
        $select_user = mysqli_query($connection, $query);
        $output .= "
            <div class='table-responsive'>
            <table class='table table-bordered'>";
        while($row = mysqli_fetch_array($select_user)){
            $student_user_id       = $row['student_user_id'];
            $student_fullname      = $row['user_fullname'];
            $student_username      = $row['username'];
            $student_user_role     = $row['role'];
            $student_user_current  = $row['user_current'];
            $student_date_created  = $row['date_created'];
            $output .= "
                <tr>
                    <td width='30%'><label>ID</label></td>
                    <td width='70%'>$student_user_id</td>
                </tr>
                <tr>
                    <td width='30%'><label>Name</label></td>
                    <td width='70%'>$student_fullname</td>
                </tr>                
                <tr>
                    <td width='30%'><label>Username</label></td>
                    <td width='70%'>$student_username</td>
                </tr>
                <tr>
                    <td width='30%'><label>Role</label></td>
                    <td width='70%'>$student_user_role</td>
                </tr>
                <tr>
                    <td width='30%'><label>Current</label></td>
                    <td width='70%'>$student_user_current</td>
                </tr>
                <tr>
                    <td width='30%'><label>Date Created</label></td>
                    <td width='70%'>$student_date_created</td>
                </tr>
            ";
        }
        $output .= "</table></div>";
        echo $output;
    }
?>