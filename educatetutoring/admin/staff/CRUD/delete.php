<?php
//----------academic_sasps----------//
    $connection = mysqli_connect("localhost", "root", "mysql", "educate_tutoring");
    if(isset($_POST['sasp_id'])){
        $sasp_id = $_POST['sasp_id'];
        $query   = "DELETE FROM academic_sasps WHERE sasp_id = {$sasp_id}";
        mysqli_query($connection, $query);
    }
?>

<?php
//----------academic_slpes----------//
    $connection = mysqli_connect("localhost", "root", "mysql", "educate_tutoring");
    if(isset($_POST['slpe_id'])){
        $slpe_id = $_POST['slpe_id'];
        $query   = "DELETE FROM academic_slpes WHERE slpe_id = {$slpe_id}";
        mysqli_query($connection, $query);
    }
?>

<?php
//----------admin_employees----------//
    $connection = mysqli_connect("localhost", "root", "mysql", "educate_tutoring");
    if(isset($_POST['employee_id'])){
        $employee_id = $_POST['employee_id'];
        $query       = "DELETE FROM admin_employees WHERE employee_id = {$employee_id}";
        mysqli_query($connection, $query);
    }
?>

<?php
//----------admin_student_registration----------//
    $connection = mysqli_connect("localhost", "root", "mysql", "educate_tutoring");
    if(isset($_POST['student_id'])){
        $student_id = $_POST['student_id'];
        $query      = "DELETE FROM admin_student_registration WHERE student_id = {$student_id}";
        mysqli_query($connection, $query);
    }
?>

<?php
//----------admin_student_enquiries----------//
    $connection = mysqli_connect("localhost", "root", "mysql", "educate_tutoring");
    if(isset($_POST['enquiry_id'])){
        $enquiry_id = $_POST['enquiry_id'];
        $query      = "DELETE FROM admin_student_enquiries WHERE enquiry_id = {$enquiry_id}";
        mysqli_query($connection, $query);
    }
?>

<?php
//----------admin_student_enrollment_procedures----------//
    $connection = mysqli_connect("localhost", "root", "mysql", "educate_tutoring");
    if(isset($_POST['procedure_id'])){
        $procedure_id = $_POST['procedure_id'];
        $query        = "DELETE FROM admin_student_eprocedures WHERE procedure_id = {$procedure_id}";
        mysqli_query($connection, $query);
    }
?>

<?php
//----------admin_student_enrollments----------//
    $connection = mysqli_connect("localhost", "root", "mysql", "educate_tutoring");
    if(isset($_POST['enroll_id'])){
        $enroll_id = $_POST['enroll_id'];
        $query     = "DELETE FROM admin_student_enrollments WHERE enroll_id = {$enroll_id}";
        mysqli_query($connection, $query);
    }
?>

<?php
//----------admin_student_schedules----------//
    $connection = mysqli_connect("localhost", "root", "mysql", "educate_tutoring");
    if(isset($_POST['schedule_id'])){
        $schedule_id = $_POST['schedule_id'];
        $query       = "DELETE FROM admin_student_schedules WHERE schedule_id = {$schedule_id}";
        mysqli_query($connection, $query);
    }
?>

<?php
//----------admin_tasks----------//
    $connection = mysqli_connect("localhost", "root", "mysql", "educate_tutoring");
    if(isset($_POST['task_id'])){
        $task_id = $_POST['task_id'];
        $query   = "DELETE FROM admin_tasks WHERE task_id = {$task_id}";
        mysqli_query($connection, $query);
    }
?>

<?php
//----------users_employee_users----------//
    $connection = mysqli_connect("localhost", "root", "mysql", "educate_tutoring");
    if(isset($_POST['employee_user_id'])){
        $employee_user_id = $_POST['employee_user_id'];
        $query            = "DELETE FROM admin_employee_users WHERE employee_user_id = {$employee_user_id}";
        mysqli_query($connection, $query);
    }
?>

<?php
//----------users_student_users----------//
    $connection = mysqli_connect("localhost", "root", "mysql", "educate_tutoring");
    if(isset($_POST['student_user_id'])){
        $student_user_id = $_POST['student_user_id'];
        $query = "DELETE FROM admin_student_users WHERE student_user_id = {$student_user_id}";
        mysqli_query($connection, $query);
    }
?>

<?php
//----------library_subjects----------//
    $connection = mysqli_connect("localhost", "root", "mysql", "educate_tutoring");
    if(isset($_POST['subject_id'])){
        $subject_id = $_POST['subject_id'];
        $query      = "DELETE FROM library_subjects WHERE subject_id = {$subject_id}";
        mysqli_query($connection, $query);
    }
?>

<?php
//----------library_concepts----------//
    $connection = mysqli_connect("localhost", "root", "mysql", "educate_tutoring");
    if(isset($_POST['concept_id'])){
        $concept_id = $_POST['concept_id'];
        $query      = "DELETE FROM library_concepts WHERE concept_id = {$concept_id}";
        mysqli_query($connection, $query);
    }
?>

<?php
//----------library_concept_details----------//
    $connection = mysqli_connect("localhost", "root", "mysql", "educate_tutoring");
    if(isset($_POST['concept_detail_id'])){
        $concept_detail_id = $_POST['concept_detail_id'];
        $query = "DELETE FROM library_concept_details WHERE concept_detail_id = {$concept_detail_id}";
        mysqli_query($connection, $query);
    }
?>

<?php
//----------library_learning_activities----------//
    $connection = mysqli_connect("localhost", "root", "mysql", "educate_tutoring");
    if(isset($_POST['learning_activity_id'])){
        $learning_activity_id = $_POST['learning_activity_id'];
        $query = "DELETE FROM library_learning_activities WHERE learning_activity_id = {$learning_activity_id}";
        mysqli_query($connection, $query);
    }
?>