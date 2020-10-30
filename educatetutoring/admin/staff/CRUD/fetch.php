<?php
    //----------academic_sasps----------//
    $connection = mysqli_connect("localhost", "root", "mysql", "educate_tutoring");
    if(isset($_POST['sasp_id'])){
        $sasp_id     = $_POST['sasp_id'];    
        $query       = "SELECT * FROM academic_sasps WHERE sasp_id = {$sasp_id}"; 
        $select_sasp = mysqli_query($connection, $query);
        $row         = mysqli_fetch_array($select_sasp);
        echo json_encode($row);
    }
?>   

<?php
    //----------academic_slpes----------//
//    $connection = mysqli_connect("localhost", "root", "mysql", "educate_tutoring");
//    if(isset($_POST['slpe_id'])){
//        $slpe_id     = $_POST['slpe_id'];    
//        $query       = "SELECT * FROM academic_slpes WHERE slpe_id = {$slpe_id}"; 
//        $select_slpe = mysqli_query($connection, $query);
//        $row         = mysqli_fetch_array($select_slpe);
//        echo json_encode($row);
//    }
?>

<?php
    //----------admin_employees----------//
    $connection = mysqli_connect("localhost", "root", "mysql", "educate_tutoring");
    if(isset($_POST['employee_id'])){
        $employee_id     = $_POST['employee_id'];    
        $query           = "SELECT * FROM admin_employees WHERE employee_id = {$employee_id}"; 
        $select_employee = mysqli_query($connection, $query);
        $row             = mysqli_fetch_array($select_employee);
        echo json_encode($row);
    }
?>

<?php
    //----------admin_student_registration----------//
    $connection = mysqli_connect("localhost", "root", "mysql", "educate_tutoring");
    if(isset($_POST['student_id'])){
        $student_id     = $_POST['student_id'];    
        $query          = "SELECT * FROM admin_student_registration WHERE student_id = {$student_id}"; 
        $select_student = mysqli_query($connection, $query);
        $row            = mysqli_fetch_array($select_student);
        echo json_encode($row);
    }
?>

<?php
    //----------admin_student_enquiries----------//
    $connection = mysqli_connect("localhost", "root", "mysql", "educate_tutoring");
    if(isset($_POST['enquiry_id'])){
        $enquiry_id     = $_POST['enquiry_id'];    
        $query          = "SELECT * FROM admin_student_enquiries WHERE enquiry_id = {$enquiry_id}"; 
        $select_enquiry = mysqli_query($connection, $query);
        $row            = mysqli_fetch_array($select_enquiry);
        echo json_encode($row);
    }
?>

<?php
    //----------admin_student_enrollment_procedures----------//
    $connection = mysqli_connect("localhost", "root", "mysql", "educate_tutoring");
    if(isset($_POST['procedure_id'])){
        $procedure_id     = $_POST['procedure_id'];    
        $query            = "SELECT * FROM admin_student_eprocedures WHERE procedure_id = {$procedure_id}"; 
        $select_procedure = mysqli_query($connection, $query);
        $row              = mysqli_fetch_array($select_procedure);
        echo json_encode($row);
    }
?>

<?php
    //----------admin_student_enrollments----------//
    $connection = mysqli_connect("localhost", "root", "mysql", "educate_tutoring");
    if(isset($_POST['enroll_id'])){
        $enroll_id         = $_POST['enroll_id'];    
        $query             = "SELECT * FROM admin_student_enrollments WHERE enroll_id = {$enroll_id}"; 
        $select_enrollment = mysqli_query($connection, $query);
        $row               = mysqli_fetch_array($select_enrollment);
        echo json_encode($row);
    }
?>

<?php
    //----------admin_student_schedules----------//
    $connection = mysqli_connect("localhost", "root", "mysql", "educate_tutoring");
    if(isset($_POST['schedule_id'])){
        $schedule_id     = $_POST['schedule_id'];    
        $query           = "SELECT * FROM admin_student_schedules WHERE schedule_id = {$schedule_id}"; 
        $select_schedule = mysqli_query($connection, $query);
        $row             = mysqli_fetch_array($select_schedule);
        echo json_encode($row);
    }
?>

<?php
    //----------admin_tasks----------//
    $connection = mysqli_connect("localhost", "root", "mysql", "educate_tutoring");
    if(isset($_POST['task_id'])){
        $task_id     = $_POST['task_id'];    
        $query       = "SELECT * FROM admin_tasks WHERE task_id = {$task_id}"; 
        $select_task = mysqli_query($connection, $query);
        $row         = mysqli_fetch_array($select_task);
        echo json_encode($row);
    }
?>

<?php
    //----------users_employee_users----------//
    $connection = mysqli_connect("localhost", "root", "mysql", "educate_tutoring");
    if(isset($_POST['employee_user_id'])){
        $employee_user_id = $_POST['employee_user_id'];    
        $query            = "SELECT * FROM admin_employee_users WHERE employee_user_id = {$employee_user_id}"; 
        $select_user      = mysqli_query($connection, $query);
        $row              = mysqli_fetch_array($select_user);
        echo json_encode($row);
    }
?>

<?php
    //----------users_student_users----------//
    $connection = mysqli_connect("localhost", "root", "mysql", "educate_tutoring");
    if(isset($_POST['student_user_id'])){
        $student_user_id = $_POST['student_user_id'];    
        $query           = "SELECT * FROM admin_student_users WHERE student_user_id = {$student_user_id}"; 
        $select_user     = mysqli_query($connection, $query);
        $row             = mysqli_fetch_array($select_user);
        echo json_encode($row);
    }
?> 

<?php
    //----------library_subjects----------//
    $connection = mysqli_connect("localhost", "root", "mysql", "educate_tutoring");
    if(isset($_POST['subject_id'])){
        $subject_id     = $_POST['subject_id'];    
        $query          = "SELECT * FROM library_subjects WHERE subject_id = {$subject_id}"; 
        $select_subject = mysqli_query($connection, $query);
        $row            = mysqli_fetch_array($select_subject);
        echo json_encode($row);
    }
?>

<?php
    //----------library_concepts----------//
    $connection = mysqli_connect("localhost", "root", "mysql", "educate_tutoring");
    if(isset($_POST['concept_id'])){
        $concept_id     = $_POST['concept_id'];    
        $query          = "SELECT * FROM library_concepts WHERE concept_id = {$concept_id}"; 
        $select_concept = mysqli_query($connection, $query);
        $row            = mysqli_fetch_array($select_concept);
        echo json_encode($row);
    }
?>

<?php
    //----------library_concept_details----------//
    $connection = mysqli_connect("localhost", "root", "mysql", "educate_tutoring");
    if(isset($_POST['concept_detail_id'])){
        $concept_detail_id     = $_POST['concept_detail_id'];    
        $query                 = "SELECT * FROM library_concept_details WHERE concept_detail_id = {$concept_detail_id}"; 
        $select_concept_detail = mysqli_query($connection, $query);
        $row                   = mysqli_fetch_array($select_concept_detail);
        echo json_encode($row);
    }
?>

<?php
    //----------library_learning_activities----------//
    $connection = mysqli_connect("localhost", "root", "mysql", "educate_tutoring");
    if(isset($_POST['learning_activity_id'])){
        $learning_activity_id     = $_POST['learning_activity_id'];    
        $query                    = "SELECT * FROM library_learning_activities WHERE learning_activity_id = {$learning_activity_id}"; 
        $select_learning_activity = mysqli_query($connection, $query);
        $row                      = mysqli_fetch_array($select_learning_activity);
        echo json_encode($row);
    }
?>