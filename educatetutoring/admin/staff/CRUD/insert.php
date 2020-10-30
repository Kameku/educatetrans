<?php 
    function replace($string){
        global $connection; //check point
        $search = array('\r\n', '\\', '"', '\'');
        $replace = array('<br/>', '', '&quot;', '&#039;');
        return str_replace($search, $replace, $string);
    }
?>

<?php
    //----------academic_sasps----------//
    $connection = mysqli_connect("localhost", "root", "mysql", "educate_tutoring");
    if(isset($_POST['sasp_id'])){
        $output          = '';
        $sasp_year             = mysqli_real_escape_string($connection, trim($_POST['sasp_year']));
        $sasp_term             = mysqli_real_escape_string($connection, trim($_POST['sasp_term']));
        $sasp_student_id       = mysqli_real_escape_string($connection, trim($_POST['sasp_student']));
        $sasp_tutor_id         = mysqli_real_escape_string($connection, trim($_POST['sasp_tutor']));
        $sasp_lesson           = mysqli_real_escape_string($connection, trim($_POST['sasp_lesson']));
        $sasp_scheduled_date   = mysqli_real_escape_string($connection, trim($_POST['sasp_scheduled_date']));
        $sasp_scheduled_time   = mysqli_real_escape_string($connection, trim($_POST['sasp_scheduled_time']));
        $sasp_attendance       = mysqli_real_escape_string($connection, trim($_POST['sasp_attendance']));
        $sasp_student_homework = mysqli_real_escape_string($connection, trim($_POST['sasp_student_homework']));
        $sasp_weekly_lesson    = mysqli_real_escape_string($connection, trim($_POST['sasp_weekly_lesson']));
        $sasp_wha              = mysqli_real_escape_string($connection, trim($_POST['sasp_wha']));
        $sasp_email            = mysqli_real_escape_string($connection, trim($_POST['sasp_email']));
        $sasp_notes            = replace(mysqli_real_escape_string($connection, trim($_POST['sasp_notes'])));
        $sasp_status           = mysqli_real_escape_string($connection, trim($_POST['sasp_status']));
        
        //-------------------- Update --------------------//
        if($_POST['sasp_id'] !== ''){
            $sasp_id           = mysqli_real_escape_string($connection, trim($_POST['sasp_id']));
            $sasp_date_created = mysqli_real_escape_string($connection, trim($_POST['sasp_date_created']));
            $stmt = mysqli_prepare($connection, "UPDATE academic_sasps SET sasp_year = ?, sasp_term = ?, sasp_date_created = ?, sasp_student_id = ?, sasp_tutor_id = ?, sasp_lesson = ?, sasp_scheduled_date = ?, sasp_scheduled_time = ?, sasp_attendance = ?, sasp_student_homework = ?, sasp_weekly_lesson = ?, sasp_wha = ?, sasp_email = ?, sasp_notes = ?, sasp_status = ? WHERE sasp_id = ? ");
            mysqli_stmt_bind_param($stmt, 'sssiissssssssssi', $sasp_year, $sasp_term, $sasp_date_created, $sasp_student_id, $sasp_tutor_id, $sasp_lesson, $sasp_scheduled_date, $sasp_scheduled_time, $sasp_attendance, $sasp_student_homework, $sasp_weekly_lesson, $sasp_wha, $sasp_email, $sasp_notes, $sasp_status, $sasp_id);
        
        }else{
        //-------------------- Create --------------------//
            $sasp_date_created = date("Y/m/d");
            $stmt = mysqli_prepare($connection, "INSERT INTO academic_sasps(sasp_year, sasp_term, sasp_date_created, sasp_student_id, sasp_tutor_id, sasp_lesson, sasp_scheduled_date, sasp_scheduled_time, sasp_attendance, sasp_student_homework, sasp_weekly_lesson, sasp_wha, sasp_email, sasp_notes, sasp_status) VALUE(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?) ");
            mysqli_stmt_bind_param($stmt, 'sssiissssssssss', $sasp_year, $sasp_term, $sasp_date_created, $sasp_student_id, $sasp_tutor_id, $sasp_lesson, $sasp_scheduled_date, $sasp_scheduled_time, $sasp_attendance, $sasp_student_homework, $sasp_weekly_lesson, $sasp_wha, $sasp_email, $sasp_notes, $sasp_status);
        }
        //-------------------- for both Create & Update --------------------//
        if(mysqli_stmt_execute($stmt)){
            mysqli_stmt_close($stmt);
            echo $output;
        }else{
            die('Query Failed' . mysqli_error($connection));
        }
    }
?>

<?php
//    //----------academic_slpes----------//
//    $connection = mysqli_connect("localhost", "root", "mysql", "educate_tutoring");
//    if(isset($_POST['slpe_id'])){
//        $output          = '';
//        $year                      = mysqli_real_escape_string($connection, trim($_POST['year']));
//        $term                      = mysqli_real_escape_string($connection, trim($_POST['term']));
//        $lesson                    = mysqli_real_escape_string($connection, trim($_POST['lesson']));
//        $slpe_student_id           = mysqli_real_escape_string($connection, trim($_POST['student']));
//        $slpe_tutor_id             = mysqli_real_escape_string($connection, trim($_POST['tutor']));
//        $slpe_subject_id           = mysqli_real_escape_string($connection, trim($_POST['subject']));
//        $slpe_concept_id           = mysqli_real_escape_string($connection, trim($_POST['concept']));
//        $slpe_concept_hidden_id    = mysqli_real_escape_string($connection, trim($_POST['concept_hidden']));
//        $slpe_concept_detail_id    = mysqli_real_escape_string($connection, trim($_POST['concept_detail']));
//        $slpe_learning_activity_id = mysqli_real_escape_string($connection, trim($_POST['learning_activity']));
//        $tutor_evaluation          = mysqli_real_escape_string($connection, trim($_POST['tutor_evaluation']));
//        $student_self_assessment   = mysqli_real_escape_string($connection, trim($_POST['student_self_assessment']));
//        $comments_homework         = replace(mysqli_real_escape_string($connection, trim($_POST['comments_homework'])));
//        $slpe_status               = mysqli_real_escape_string($connection, trim($_POST['slpe_status']));
//        
//        //-------------------- Update --------------------//
//        if($_POST['slpe_id'] !== ''){
//            $slpe_id = mysqli_real_escape_string($connection, trim($_POST['slpe_id']));
//            $date    = mysqli_real_escape_string($connection, trim($_POST['date']));
//            $stmt    = mysqli_prepare($connection, "UPDATE academic_slpes SET year = ?, term = ?, lesson = ?, date = ?, slpe_student_id = ?, slpe_tutor_id = ?, slpe_subject_id = ?, slpe_concept_id = ?, slpe_concept_hidden_id = ?, slpe_concept_detail_id = ?, slpe_learning_activity_id = ?, tutor_evaluation = ?, student_self_assessment = ?, comments_homework = ?, slpe_status = ? WHERE slpe_id = ? ");
//            mysqli_stmt_bind_param($stmt, 'ssssiiiiiiissssi', $year, $term, $lesson, $date, $slpe_student_id, $slpe_tutor_id, $slpe_subject_id, $slpe_concept_id, $slpe_concept_hidden_id, $slpe_concept_detail_id, $slpe_learning_activity_id, $tutor_evaluation, $student_self_assessment, $comments_homework, $slpe_status, $slpe_id);
//        
//        }else{
//        //-------------------- Create --------------------//
//            $date = date("Y/m/d");
//            $stmt = mysqli_prepare($connection, "INSERT INTO academic_slpes(year, term, lesson, date, slpe_student_id, slpe_tutor_id, slpe_subject_id, slpe_concept_id, slpe_concept_hidden_id, slpe_concept_detail_id, slpe_learning_activity_id, tutor_evaluation, student_self_assessment, comments_homework, slpe_status) VALUE(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?) ");
//            mysqli_stmt_bind_param($stmt, 'ssssiiiiiiissss', $year, $term, $lesson, $date, $slpe_student_id, $slpe_tutor_id, $slpe_subject_id, $slpe_concept_id, $slpe_concept_hidden_id, $slpe_concept_detail_id, $slpe_learning_activity_id, $tutor_evaluation, $student_self_assessment, $comments_homework, $slpe_status);
//        }
//        //-------------------- for both Create & Update --------------------//
//        if(mysqli_stmt_execute($stmt)){
//            mysqli_stmt_close($stmt);
//            echo $output;
//        }else{
//            die('Query Failed' . mysqli_error($connection));
//        }
//    }
?>

<?php
    //----------admin_employees----------//
    $connection = mysqli_connect("localhost", "root", "mysql", "educate_tutoring");
    if(isset($_POST['employee_id'])){
        $output          = '';
        $employee_firstname    = mysqli_real_escape_string($connection, trim($_POST['employee_firstname']));
        $employee_lastname     = mysqli_real_escape_string($connection, trim($_POST['employee_lastname']));
        $employee_DOB          = mysqli_real_escape_string($connection, trim($_POST['employee_DOB']));
        $employee_mobile       = mysqli_real_escape_string($connection, trim($_POST['employee_mobile']));
        $employee_email        = mysqli_real_escape_string($connection, trim($_POST['employee_email']));
        $employee_role_id      = mysqli_real_escape_string($connection, trim($_POST['employee_role']));
        $employee_current      = mysqli_real_escape_string($connection, trim($_POST['employee_current']));
        
        //-------------------- Update --------------------//
        if($_POST['employee_id'] !== ''){
            $employee_id = mysqli_real_escape_string($connection, trim($_POST['employee_id']));
            $stmt        = mysqli_prepare($connection, "UPDATE admin_employees SET employee_firstname = ?, employee_lastname = ?, employee_DOB = ?, employee_mobile = ?, employee_email = ?, employee_role_id = ?, employee_current = ? WHERE employee_id = ? ");
            mysqli_stmt_bind_param($stmt, 'sssssisi', $employee_firstname, $employee_lastname, $employee_DOB, $employee_mobile, $employee_email, $employee_role_id, $employee_current, $employee_id);
        //-------------------- Create --------------------//
        }else{
            $stmt         = mysqli_prepare($connection, "INSERT INTO admin_employees(employee_firstname, employee_lastname, employee_DOB, employee_mobile, employee_email, employee_role_id, employee_current) VALUE(?, ?, ?, ?, ?, ?, ?) ");
            mysqli_stmt_bind_param($stmt, 'sssssis', $employee_firstname, $employee_lastname, $employee_DOB, $employee_mobile, $employee_email, $employee_role_id, $employee_current);
        }
        //-------------------- for both Create & Update --------------------//
        if(mysqli_stmt_execute($stmt)){
            mysqli_stmt_close($stmt);
            echo $output;
        }else{
            die('Query Failed' . mysqli_error($connection));
        }
    }
?>

<?php
    //----------admin_student_registration----------//
    $connection = mysqli_connect("localhost", "root", "mysql", "educate_tutoring");
    if(isset($_POST['student_id'])){
        $output          = '';
        $student_firstname    = mysqli_real_escape_string($connection, trim($_POST['student_firstname']));
        $student_lastname     = mysqli_real_escape_string($connection, trim($_POST['student_lastname']));
        $student_current      = mysqli_real_escape_string($connection, trim($_POST['student_current']));
        
        //-------------------- Update --------------------//
        if($_POST['student_id'] !== ''){
            $student_id = mysqli_real_escape_string($connection, trim($_POST['student_id']));
            $stmt        = mysqli_prepare($connection, "UPDATE admin_student_registration SET student_firstname = ?, student_lastname = ?, student_current = ? WHERE student_id = ? ");
            mysqli_stmt_bind_param($stmt, 'sssi', $student_firstname, $student_lastname, $student_current, $student_id);
        //-------------------- Create --------------------//
        }else{
            $stmt         = mysqli_prepare($connection, "INSERT INTO admin_student_registration(student_firstname, student_lastname, student_current) VALUE(?, ?, ?) ");
            mysqli_stmt_bind_param($stmt, 'sss', $student_firstname, $student_lastname, $student_current);
        }
        //-------------------- for both Create & Update --------------------//
        if(mysqli_stmt_execute($stmt)){
            mysqli_stmt_close($stmt);
            echo $output;
        }else{
            die('Query Failed' . mysqli_error($connection));
        }
    }
?>

<?php
    //----------admin_student_enquiries----------//
    $connection = mysqli_connect("localhost", "root", "mysql", "educate_tutoring");
    if(isset($_POST['enquiry_id'])){
        $output          = '';
        $enquiry_outcome               = mysqli_real_escape_string($connection, trim($_POST['enquiry_outcome']));
        $enquirer_name                  = mysqli_real_escape_string($connection, trim($_POST['enquirer_name']));
        $enquiry_student_id             = mysqli_real_escape_string($connection, trim($_POST['enquiry_student_fullname']));
        $enquiry_number                 = mysqli_real_escape_string($connection, trim($_POST['enquiry_number']));
        $enquiry_email                  = mysqli_real_escape_string($connection, trim($_POST['enquiry_email']));
        $enquiry_hear_about_us          = mysqli_real_escape_string($connection, trim($_POST['enquiry_hear_about_us']));
        $enquiry_psychologist           = mysqli_real_escape_string($connection, trim($_POST['enquiry_psychologist']));
        $enquiry_optometrist            = mysqli_real_escape_string($connection, trim($_POST['enquiry_optometrist']));
        $enquiry_educational_assistance = mysqli_real_escape_string($connection, trim($_POST['enquiry_educational_assistance']));
        $enquiry_concerns               = replace(mysqli_real_escape_string($connection, trim($_POST['enquiry_concerns'])));
        $enquiry_goals                  = replace(mysqli_real_escape_string($connection, trim($_POST['enquiry_goals'])));
        $enquiry_notes                  = replace(mysqli_real_escape_string($connection, trim($_POST['enquiry_notes'])));
        
        //-------------------- Update --------------------//
        if($_POST['enquiry_id'] !== ''){
            $enquiry_id = mysqli_real_escape_string($connection, trim($_POST['enquiry_id']));
            $stmt       = mysqli_prepare($connection, "UPDATE admin_student_enquiries SET enquiry_outcome = ?, enquirer_name = ?, enquiry_student_id = ?, enquiry_number = ?, enquiry_email = ?, enquiry_hear_about_us = ?, enquiry_psychologist = ?, enquiry_optometrist = ?, enquiry_educational_assistance = ?, enquiry_concerns = ?, enquiry_goals = ?, enquiry_notes = ? WHERE enquiry_id = ? ");
            mysqli_stmt_bind_param($stmt, 'ssisssssssssi', $enquiry_outcome, $enquirer_name, $enquiry_student_id, $enquiry_number, $enquiry_email, $enquiry_hear_about_us, $enquiry_psychologist, $enquiry_optometrist, $enquiry_educational_assistance, $enquiry_concerns, $enquiry_goals, $enquiry_notes, $enquiry_id);
        //-------------------- Create --------------------//
        }else{
            $enquiry_date = date("Y/m/d");
            $stmt         = mysqli_prepare($connection, "INSERT INTO admin_student_enquiries(enquiry_date, enquiry_outcome, enquirer_name, enquiry_student_id, enquiry_number, enquiry_email, enquiry_hear_about_us, enquiry_psychologist, enquiry_optometrist, enquiry_educational_assistance, enquiry_concerns, enquiry_goals, enquiry_notes) VALUE(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?) ");
            mysqli_stmt_bind_param($stmt, 'sssisssssssss', $enquiry_date, $enquiry_outcome, $enquirer_name, $enquiry_student_id, $enquiry_number, $enquiry_email, $enquiry_hear_about_us, $enquiry_psychologist, $enquiry_optometrist, $enquiry_educational_assistance, $enquiry_concerns, $enquiry_goals, $enquiry_notes);
        }
        //-------------------- for both Create & Update --------------------//
        if(mysqli_stmt_execute($stmt)){
            mysqli_stmt_close($stmt);
            echo $output;
        }else{
            die('Query Failed' . mysqli_error($connection));
        }
    }
?>

<?php
    //----------admin_student_eprocedures----------//
    $connection = mysqli_connect("localhost", "root", "mysql", "educate_tutoring");
    if(isset($_POST['procedure_id'])){
        $output          = '';
        $procedure_student_id          = mysqli_real_escape_string($connection, trim($_POST['procedure_student_fullname']));
        $procedure_enquiry_id          = mysqli_real_escape_string($connection, trim($_POST['procedure_enquiry_id']));
        $procedure_introduction_letter = mysqli_real_escape_string($connection, trim($_POST['procedure_introduction_letter']));
        $procedure_deposit             = mysqli_real_escape_string($connection, trim($_POST['procedure_deposit']));
        $procedure_pis_date            = mysqli_real_escape_string($connection, trim($_POST['procedure_pis_date']));
        $procedure_pis_status          = mysqli_real_escape_string($connection, trim($_POST['procedure_pis_status']));
        $procedure_enrollment          = mysqli_real_escape_string($connection, trim($_POST['procedure_enrollment']));
        $procedure_schedule            = mysqli_real_escape_string($connection, trim($_POST['procedure_schedule']));
        $procedure_confirmation        = mysqli_real_escape_string($connection, trim($_POST['procedure_confirmation']));
        $procedure_xero                = mysqli_real_escape_string($connection, trim($_POST['procedure_xero']));
        $procedure_invoice             = mysqli_real_escape_string($connection, trim($_POST['procedure_invoice']));
        $procedure_ezidebit            = mysqli_real_escape_string($connection, trim($_POST['procedure_ezidebit']));
        $procedure_folder              = mysqli_real_escape_string($connection, trim($_POST['procedure_folder']));
        $procedure_notes               = replace(mysqli_real_escape_string($connection, trim($_POST['procedure_notes'])));
        //-------------------- Update --------------------//
        if($_POST['procedure_id'] !== ''){
            $procedure_id   = mysqli_real_escape_string($connection, trim($_POST['procedure_id']));
            $procedure_date = mysqli_real_escape_string($connection, trim($_POST['procedure_date']));
            $stmt = mysqli_prepare($connection, "UPDATE admin_student_eprocedures SET procedure_date = ?, procedure_student_id = ?, procedure_enquiry_id = ?, procedure_introduction_letter = ?, procedure_deposit = ?, procedure_pis_date = ?, procedure_pis_status = ?, procedure_enrollment = ?, procedure_schedule = ?, procedure_confirmation = ?, procedure_xero = ?, procedure_invoice = ?, procedure_ezidebit = ?, procedure_folder = ?, procedure_notes = ? WHERE procedure_id = ? ");
            mysqli_stmt_bind_param($stmt, 'siissssssssssssi', $procedure_date, $procedure_student_id, $procedure_enquiry_id, $procedure_introduction_letter, $procedure_deposit, $procedure_pis_date, $procedure_pis_status, $procedure_enrollment, $procedure_schedule, $procedure_confirmation, $procedure_xero, $procedure_invoice, $procedure_ezidebit, $procedure_folder, $procedure_notes, $procedure_id);
        }else{
        //-------------------- Create --------------------//
            $procedure_date = date("Y/m/d");
            $stmt = mysqli_prepare($connection, "INSERT INTO admin_student_eprocedures(procedure_date, procedure_student_id, procedure_enquiry_id, procedure_introduction_letter, procedure_deposit, procedure_pis_date, procedure_pis_status, procedure_enrollment, procedure_schedule, procedure_confirmation, procedure_xero, procedure_invoice, procedure_ezidebit, procedure_folder, procedure_notes) VALUE(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?) ");
            mysqli_stmt_bind_param($stmt, 'siissssssssssss', $procedure_date, $procedure_student_id, $procedure_enquiry_id, $procedure_introduction_letter, $procedure_deposit, $procedure_pis_date, $procedure_pis_status, $procedure_enrollment, $procedure_schedule, $procedure_confirmation, $procedure_xero, $procedure_invoice, $procedure_ezidebit, $procedure_folder, $procedure_notes);
        }
        //-------------------- for both Create & Update --------------------//
        if(mysqli_stmt_execute($stmt)){
            mysqli_stmt_close($stmt);
            echo $output;
        }else{
            die('Query Failed' . mysqli_error($connection));
        }
    }
?>

<?php
    //----------admin_student_enrollments----------//
    $connection = mysqli_connect("localhost", "root", "mysql", "educate_tutoring");
    if(isset($_POST['enroll_id'])){
        $output          = '';
        $enroll_student_id        = mysqli_real_escape_string($connection, trim($_POST['enroll_student_fullname']));
        $enroll_date              = mysqli_real_escape_string($connection, trim($_POST['enroll_date']));
        $enroll_student_DOB       = mysqli_real_escape_string($connection, trim($_POST['enroll_student_DOB']));
        $enroll_student_address   = mysqli_real_escape_string($connection, trim($_POST['enroll_student_address']));
        $enroll_student_suburb    = mysqli_real_escape_string($connection, trim($_POST['enroll_student_suburb']));
        $enroll_student_postcode  = mysqli_real_escape_string($connection, trim($_POST['enroll_student_postcode']));
        $enroll_student_phone     = mysqli_real_escape_string($connection, trim($_POST['enroll_student_phone']));
        $enroll_student_language  = mysqli_real_escape_string($connection, trim($_POST['enroll_student_language']));
        $enroll_school            = mysqli_real_escape_string($connection, trim($_POST['enroll_school']));
        $enroll_school_grade      = mysqli_real_escape_string($connection, trim($_POST['enroll_school_grade']));
        $enroll_school_teacher    = mysqli_real_escape_string($connection, trim($_POST['enroll_school_teacher']));
        $enroll_school_contact    = mysqli_real_escape_string($connection, trim($_POST['enroll_school_contact']));
        $enroll_parent            = mysqli_real_escape_string($connection, trim($_POST['enroll_parent']));
        $enroll_parent_mobile     = mysqli_real_escape_string($connection, trim($_POST['enroll_parent_mobile']));
        $enroll_parent_home_phone = mysqli_real_escape_string($connection, trim($_POST['enroll_parent_home_phone']));
        $enroll_parent_email      = mysqli_real_escape_string($connection, trim($_POST['enroll_parent_email']));
        $enroll_parent_address    = mysqli_real_escape_string($connection, trim($_POST['enroll_parent_address']));
        $enroll_parent_employer   = mysqli_real_escape_string($connection, trim($_POST['enroll_parent_employer']));
        $enroll_parent_work_phone = mysqli_real_escape_string($connection, trim($_POST['enroll_parent_work_phone']));
        $enroll_ice_name          = mysqli_real_escape_string($connection, trim($_POST['enroll_ice_name']));
        $enroll_ice_relationship  = mysqli_real_escape_string($connection, trim($_POST['enroll_ice_relationship']));
        $enroll_ice_mobile        = mysqli_real_escape_string($connection, trim($_POST['enroll_ice_mobile']));
        $enroll_ice_home_phone    = mysqli_real_escape_string($connection, trim($_POST['enroll_ice_home_phone']));
        $enroll_psychologist      = mysqli_real_escape_string($connection, trim($_POST['enroll_psychologist']));
        $enroll_optometrist       = mysqli_real_escape_string($connection, trim($_POST['enroll_optometrist']));
        $enroll_support           = mysqli_real_escape_string($connection, trim($_POST['enroll_support']));
        $enroll_custody           = mysqli_real_escape_string($connection, trim($_POST['enroll_custody']));
        $enroll_allergy           = mysqli_real_escape_string($connection, trim($_POST['enroll_allergy']));
        $enroll_sweets            = mysqli_real_escape_string($connection, trim($_POST['enroll_sweets']));
        $enroll_notes             = replace(mysqli_real_escape_string($connection, trim($_POST['enroll_notes'])));
        
        //-------------------- Update --------------------//
        if($_POST['enroll_id'] !== ''){
            $enroll_id   = mysqli_real_escape_string($connection, trim($_POST['enroll_id']));  
            $stmt        = mysqli_prepare($connection, "UPDATE admin_student_enrollments SET enroll_date = ?, enroll_student_id = ?, enroll_student_DOB = ?, enroll_student_address = ?, enroll_student_suburb = ?, enroll_student_postcode = ?, enroll_student_phone = ?, enroll_student_language = ?, enroll_school = ?, enroll_school_grade = ?, enroll_school_teacher = ?, enroll_school_contact = ?, enroll_parent = ?, enroll_parent_mobile = ?, enroll_parent_home_phone = ?, enroll_parent_email = ?, enroll_parent_address = ?, enroll_parent_employer = ?, enroll_parent_work_phone = ?, enroll_ice_name = ?, enroll_ice_relationship = ?, enroll_ice_mobile = ?, enroll_ice_home_phone = ?, enroll_psychologist = ?, enroll_optometrist = ?, enroll_support = ?, enroll_custody = ?, enroll_allergy = ?, enroll_sweets = ?, enroll_notes = ? WHERE enroll_id = ? ");
            mysqli_stmt_bind_param($stmt, 'sissssssssssssssssssssssssssssi', $enroll_date, $enroll_student_id, $enroll_student_DOB, $enroll_student_address, $enroll_student_suburb, $enroll_student_postcode, $enroll_student_phone, $enroll_student_language, $enroll_school, $enroll_school_grade, $enroll_school_teacher, $enroll_school_contact, $enroll_parent, $enroll_parent_mobile, $enroll_parent_home_phone, $enroll_parent_email, $enroll_parent_address, $enroll_parent_employer, $enroll_parent_work_phone, $enroll_ice_name, $enroll_ice_relationship, $enroll_ice_mobile, $enroll_ice_home_phone, $enroll_psychologist, $enroll_optometrist, $enroll_support, $enroll_custody, $enroll_allergy, $enroll_sweets, $enroll_notes, $enroll_id);
        //-------------------- Create --------------------//
        }else{
            $stmt        = mysqli_prepare($connection, "INSERT INTO admin_student_enrollments(enroll_date, enroll_student_id, enroll_student_DOB, enroll_student_address, enroll_student_suburb, enroll_student_postcode, enroll_student_phone, enroll_student_language, enroll_school, enroll_school_grade, enroll_school_teacher, enroll_school_contact, enroll_parent, enroll_parent_mobile, enroll_parent_home_phone, enroll_parent_email, enroll_parent_address, enroll_parent_employer, enroll_parent_work_phone, enroll_ice_name, enroll_ice_relationship, enroll_ice_mobile, enroll_ice_home_phone, enroll_psychologist, enroll_optometrist, enroll_support, enroll_custody, enroll_allergy, enroll_sweets, enroll_notes) VALUE(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?) ");
            mysqli_stmt_bind_param($stmt, 'sissssssssssssssssssssssssssss', $enroll_date, $enroll_student_id, $enroll_student_DOB, $enroll_student_address, $enroll_student_suburb, $enroll_student_postcode, $enroll_student_phone, $enroll_student_language, $enroll_school, $enroll_school_grade, $enroll_school_teacher, $enroll_school_contact, $enroll_parent, $enroll_parent_mobile, $enroll_parent_home_phone, $enroll_parent_email, $enroll_parent_address, $enroll_parent_employer, $enroll_parent_work_phone, $enroll_ice_name, $enroll_ice_relationship, $enroll_ice_mobile, $enroll_ice_home_phone, $enroll_psychologist, $enroll_optometrist, $enroll_support, $enroll_custody, $enroll_allergy, $enroll_sweets, $enroll_notes);
        }
        //-------------------- for both Create & Update --------------------//
        if(mysqli_stmt_execute($stmt)){
            mysqli_stmt_close($stmt);
            echo $output;
        }else{
            die('Query Failed' . mysqli_error($connection));
        }
    }
?>

<?php
    //----------admin_student_schedules----------//
    $connection = mysqli_connect("localhost", "root", "mysql", "educate_tutoring");
    if(isset($_POST['schedule_id'])){
        $output          = '';
        $schedule_student_id   = mysqli_real_escape_string($connection, trim($_POST['schedule_student_fullname']));
        $schedule_year         = mysqli_real_escape_string($connection, trim($_POST['schedule_year']));
        $schedule_term         = mysqli_real_escape_string($connection, trim($_POST['schedule_term']));
        $schedule_tutor_id     = mysqli_real_escape_string($connection, trim($_POST['schedule_tutor_fullname']));
        $schedule_subject      = mysqli_real_escape_string($connection, trim($_POST['schedule_subject']));
        $schedule_package      = mysqli_real_escape_string($connection, trim($_POST['schedule_package']));
        $schedule_lessons      = mysqli_real_escape_string($connection, trim($_POST['schedule_lessons']));
        $schedule_first_lesson = mysqli_real_escape_string($connection, trim($_POST['schedule_first_lesson']));
        $schedule_weekday      = mysqli_real_escape_string($connection, trim($_POST['schedule_weekday']));
        $schedule_time         = mysqli_real_escape_string($connection, trim($_POST['schedule_time']));
        $schedule_duration     = mysqli_real_escape_string($connection, trim($_POST['schedule_duration']));
        $schedule_room         = mysqli_real_escape_string($connection, trim($_POST['schedule_room']));
        $schedule_notes        = replace(mysqli_real_escape_string($connection, trim($_POST['schedule_notes'])));
        
        //-------------------- Update --------------------//
        if($_POST['schedule_id'] !== ''){
            $schedule_id = mysqli_real_escape_string($connection, trim($_POST['schedule_id']));
            $stmt        = mysqli_prepare($connection, "UPDATE admin_student_schedules SET schedule_student_id = ?, schedule_year = ?, schedule_term = ?, schedule_tutor_id = ?, schedule_subject = ?, schedule_package = ?, schedule_lessons = ?, schedule_first_lesson = ?, schedule_weekday = ?, schedule_time = ?, schedule_duration = ?, schedule_room = ?, schedule_notes = ? WHERE schedule_id = ? ");
            mysqli_stmt_bind_param($stmt, 'ississsssssssi', $schedule_student_id, $schedule_year, $schedule_term, $schedule_tutor_id, $schedule_subject, $schedule_package, $schedule_lessons, $schedule_first_lesson, $schedule_weekday, $schedule_time, $schedule_duration, $schedule_room, $schedule_notes, $schedule_id);
        //-------------------- Create --------------------//
        }else{
            $stmt = mysqli_prepare($connection, "INSERT INTO admin_student_schedules(schedule_student_id, schedule_year, schedule_term, schedule_tutor_id, schedule_subject, schedule_package, schedule_lessons, schedule_first_lesson, schedule_weekday, schedule_time, schedule_duration, schedule_room, schedule_notes) VALUE(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?) ");
            mysqli_stmt_bind_param($stmt, 'ississsssssss', $schedule_student_id, $schedule_year, $schedule_term, $schedule_tutor_id, $schedule_subject, $schedule_package, $schedule_lessons, $schedule_first_lesson, $schedule_weekday, $schedule_time, $schedule_duration, $schedule_room, $schedule_notes);
        }
        //-------------------- for both Create & Update --------------------//
        if(mysqli_stmt_execute($stmt)){
            mysqli_stmt_close($stmt);
            echo $output;
        }else{
            die('Query Failed' . mysqli_error($connection));
        }
    }
?>

<?php
    //----------admin_tasks----------//
    $connection = mysqli_connect("localhost", "root", "mysql", "educate_tutoring");
    if(isset($_POST['task_id'])){
        $output          = '';
        $task_from     = mysqli_real_escape_string($connection, trim($_POST['task_from_fullname']));
        $task_to       = mysqli_real_escape_string($connection, trim($_POST['task_to_fullname']));
        $task_group    = mysqli_real_escape_string($connection, trim($_POST['task_group']));
        $task_title    = mysqli_real_escape_string($connection, trim($_POST['task_title']));
        $task_content  = replace(mysqli_real_escape_string($connection, trim($_POST['task_content'])));
        $task_priority = mysqli_real_escape_string($connection, trim($_POST['task_priority']));
        $task_status   = mysqli_real_escape_string($connection, trim($_POST['task_status']));
        $task_date_due = mysqli_real_escape_string($connection, trim($_POST['task_date_due']));
        $task_notes    = replace(mysqli_real_escape_string($connection, trim($_POST['task_notes'])));
        
        //-------------------- Update --------------------//
        if($_POST['task_id'] !== ''){
            $task_id           = mysqli_real_escape_string($connection, trim($_POST['task_id']));
            $task_date_created = mysqli_real_escape_string($connection, trim($_POST['task_date_created']));
            $stmt              = mysqli_prepare($connection, "UPDATE admin_tasks SET task_date_created = ?, task_from = ?, task_to = ?, task_group = ?, task_title = ?, task_content = ?, task_priority = ?, task_status = ?, task_date_due = ?, task_notes = ? WHERE task_id = ? ");
            mysqli_stmt_bind_param($stmt, 'siisssssssi', $task_date_created, $task_from, $task_to, $task_group, $task_title, $task_content, $task_priority, $task_status, $task_date_due, $task_notes, $task_id);
        //-------------------- Create --------------------//
        }else{
            $task_date_created = date("Y/m/d");
            $stmt = mysqli_prepare($connection, "INSERT INTO admin_tasks(task_date_created, task_from, task_to, task_group, task_title, task_content, task_priority, task_status, task_date_due, task_notes) VALUE(?, ?, ?, ?, ?, ?, ?, ?, ?, ?) ");
            mysqli_stmt_bind_param($stmt, 'siisssssss', $task_date_created, $task_from, $task_to, $task_group, $task_title, $task_content, $task_priority, $task_status, $task_date_due, $task_notes);
        }
        //-------------------- for both Create & Update --------------------//
        if(mysqli_stmt_execute($stmt)){
            mysqli_stmt_close($stmt);
            echo $output;
        }else{
            die('Query Failed' . mysqli_error($connection));
        }
    }
?>

<?php
    //----------users_employee_users----------//
    $connection = mysqli_connect("localhost", "root", "mysql", "educate_tutoring");
    if(isset($_POST['employee_user_id'])){
        $output          = '';
        $employee_username        = mysqli_real_escape_string($connection, trim($_POST['employee_username']));
        $employee_user_password   = mysqli_real_escape_string($connection, trim($_POST['employee_user_password']));
        $employee_user_password   = password_hash($employee_user_password, PASSWORD_BCRYPT, array('cost' => 10));
        $employee_fullname_id     = mysqli_real_escape_string($connection, trim($_POST['employee_fullname']));
        $employee_user_current    = mysqli_real_escape_string($connection, trim($_POST['employee_user_current']));
        $employee_user_role_id    = mysqli_real_escape_string($connection, trim($_POST['employee_user_role']));

        //-------------------- Update --------------------//
        if($_POST['employee_user_id'] !== ''){
            $employee_user_id      = mysqli_real_escape_string($connection, trim($_POST['employee_user_id']));
            $employee_date_created = mysqli_real_escape_string($connection, trim($_POST['employee_date_created']));
            $stmt         = mysqli_prepare($connection, "UPDATE admin_employee_users SET user_employee_id = ?, username = ?, user_password = ?, user_role_id = ?, date_created = ?, user_current = ? WHERE employee_user_id = ? ");
            mysqli_stmt_bind_param($stmt, 'ississi', $employee_fullname_id, $employee_username, $employee_user_password, $employee_user_role_id, $employee_date_created, $employee_user_current, $employee_user_id);
        //-------------------- Create --------------------//
        }else{
            $employee_date_created = date("Y/m/d");
            $stmt         = mysqli_prepare($connection, "INSERT INTO admin_employee_users(user_employee_id, username, user_password, user_role_id, date_created, user_current) VALUE(?, ?, ?, ?, ?, ?) ");
            mysqli_stmt_bind_param($stmt, 'ississ', $employee_fullname_id, $employee_username, $employee_user_password, $employee_user_role_id, $employee_date_created, $employee_user_current);
        }
        //-------------------- for both Create & Update --------------------//
        if(mysqli_stmt_execute($stmt)){
            mysqli_stmt_close($stmt);
            echo $output;
        }else{
            die('Query Failed' . mysqli_error($connection));
        }
    }
?>

<?php
    //----------users_student_users----------//
    $connection = mysqli_connect("localhost", "root", "mysql", "educate_tutoring");
    if(isset($_POST['student_user_id'])){
        $output          = '';
        $student_username        = mysqli_real_escape_string($connection, trim($_POST['student_username']));
        $student_user_password   = mysqli_real_escape_string($connection, trim($_POST['student_user_password']));
        $student_user_password   = password_hash($student_user_password, PASSWORD_BCRYPT, array('cost' => 10));
        $student_fullname_id     = mysqli_real_escape_string($connection, trim($_POST['student_fullname']));
        $student_user_current    = mysqli_real_escape_string($connection, trim($_POST['student_user_current']));
        $student_user_role_id    = mysqli_real_escape_string($connection, trim($_POST['student_user_role']));

        //-------------------- Update --------------------//
        if($_POST['student_user_id'] !== ''){
            $student_user_id      = mysqli_real_escape_string($connection, trim($_POST['student_user_id']));
            $student_date_created = mysqli_real_escape_string($connection, trim($_POST['student_date_created']));
            $stmt         = mysqli_prepare($connection, "UPDATE admin_student_users SET user_student_id = ?, username = ?, user_password = ?, user_role_id = ?, date_created = ?, user_current = ? WHERE student_user_id = ? ");
            mysqli_stmt_bind_param($stmt, 'ississi', $student_fullname_id, $student_username, $student_user_password, $student_user_role_id, $student_date_created, $student_user_current, $student_user_id);
        //-------------------- Create --------------------//
        }else{
            $student_date_created = date("Y/m/d");
            $stmt         = mysqli_prepare($connection, "INSERT INTO admin_student_users(user_student_id, username, user_password, user_role_id, date_created, user_current) VALUE(?, ?, ?, ?, ?, ?) ");
            mysqli_stmt_bind_param($stmt, 'ississ', $student_fullname_id, $student_username, $student_user_password, $student_user_role_id, $student_date_created, $student_user_current);
        }
        //-------------------- for both Create & Update --------------------//
        if(mysqli_stmt_execute($stmt)){
            mysqli_stmt_close($stmt);
            echo $output;
        }else{
            die('Query Failed' . mysqli_error($connection));
        }
    }
?>

<?php
    //----------library_subjects----------//
    $connection = mysqli_connect("localhost", "root", "mysql", "educate_tutoring");
    if(isset($_POST['subject_id'])){
        $output  = '';
        $subject = mysqli_real_escape_string($connection, trim($_POST['subject']));
        //-------------------- Update --------------------//
        if($_POST['subject_id'] !== ''){           
            $subject_id = mysqli_real_escape_string($connection, trim($_POST['subject_id']));
            $stmt       = mysqli_prepare($connection, "UPDATE library_subjects SET subject = ? WHERE subject_id = ? ");
            mysqli_stmt_bind_param($stmt, 'si', $subject, $subject_id);
        //-------------------- Create --------------------//
        }else{           
            $stmt = mysqli_prepare($connection, "INSERT INTO library_subjects(subject) VALUE(?) ");
            mysqli_stmt_bind_param($stmt, 's', $subject);
        }
        //-------------------- for both Create & Update --------------------//
        if(mysqli_stmt_execute($stmt)){
            mysqli_stmt_close($stmt);
            echo $output;
        }else{
            die('Query Failed' . mysqli_error($connection));
        }
    }
?>

<?php
    //----------library_concepts----------//
    $connection = mysqli_connect("localhost", "root", "mysql", "educate_tutoring");
    if(isset($_POST['concept_id'])){
        $output             = '';
        $concept            = replace(mysqli_real_escape_string($connection, trim($_POST['concept'])));
        $concept_subject_id = mysqli_real_escape_string($connection, trim($_POST['concept_subject']));
        
        //-------------------- Update --------------------//
        if($_POST['concept_id'] !== ''){
            $concept_id = mysqli_real_escape_string($connection, trim($_POST['concept_id']));
            $stmt       = mysqli_prepare($connection, "UPDATE library_concepts SET concept = ?, concept_subject_id = ? WHERE concept_id = ? ");
            mysqli_stmt_bind_param($stmt, 'sii', $concept, $concept_subject_id, $concept_id);
        //-------------------- Create --------------------//
        }else{
        $stmt = mysqli_prepare($connection, "INSERT INTO library_concepts(concept, concept_subject_id) VALUE(?, ?) ");
        mysqli_stmt_bind_param($stmt, 'si', $concept, $concept_subject_id);
        }
        //-------------------- for both Create & Update --------------------//
        if(mysqli_stmt_execute($stmt)){
            mysqli_stmt_close($stmt);
            echo $output;
        }else{
            die('Query Failed' . mysqli_error($connection));
        }
    }
?>

<?php
    //----------library_concept_details----------//
    $connection = mysqli_connect("localhost", "root", "mysql", "educate_tutoring");
    if(isset($_POST['concept_detail_id'])){
        $output             = '';
        $concept_detail            = replace(mysqli_real_escape_string($connection, trim($_POST['concept_detail'])));
        $concept_detail_concept_id = mysqli_real_escape_string($connection, trim($_POST['concept_detail_concept']));
        
        //-------------------- Update --------------------//
        if($_POST['concept_detail_id'] !== ''){
            $concept_detail_id = mysqli_real_escape_string($connection, trim($_POST['concept_detail_id']));
            $stmt       = mysqli_prepare($connection, "UPDATE library_concept_details SET concept_detail = ?, concept_detail_concept_id = ? WHERE concept_detail_id = ? ");
            mysqli_stmt_bind_param($stmt, 'sii', $concept_detail, $concept_detail_concept_id, $concept_detail_id);
        //-------------------- Create --------------------//
        }else{
        $stmt = mysqli_prepare($connection, "INSERT INTO library_concept_details(concept_detail, concept_detail_concept_id) VALUE(?, ?) ");
        mysqli_stmt_bind_param($stmt, 'si', $concept_detail, $concept_detail_concept_id);
        }
        //-------------------- for both Create & Update --------------------//
        if(mysqli_stmt_execute($stmt)){
            mysqli_stmt_close($stmt);
            echo $output;
        }else{
            die('Query Failed' . mysqli_error($connection));
        }
    }
?>

<?php
    //----------library_learning_activities----------//
    $connection = mysqli_connect("localhost", "root", "mysql", "educate_tutoring");
    if(isset($_POST['learning_activity_id'])){
        $output             = '';
        $learning_activity            = replace(mysqli_real_escape_string($connection, trim($_POST['learning_activity'])));
        $learning_activity_concept_id = mysqli_real_escape_string($connection, trim($_POST['learning_activity_concept']));
        
        //-------------------- Update --------------------//
        if($_POST['learning_activity_id'] !== ''){
            $learning_activity_id = mysqli_real_escape_string($connection, trim($_POST['learning_activity_id']));
            $stmt       = mysqli_prepare($connection, "UPDATE library_learning_activities SET learning_activity = ?, learning_activity_concept_id = ? WHERE learning_activity_id = ? ");
            mysqli_stmt_bind_param($stmt, 'sii', $learning_activity, $learning_activity_concept_id, $learning_activity_id);
        //-------------------- Create --------------------//
        }else{
        $stmt = mysqli_prepare($connection, "INSERT INTO library_learning_activities(learning_activity, learning_activity_concept_id) VALUE(?, ?) ");
        mysqli_stmt_bind_param($stmt, 'si', $learning_activity, $learning_activity_concept_id);
        }
        //-------------------- for both Create & Update --------------------//
        if(mysqli_stmt_execute($stmt)){
            mysqli_stmt_close($stmt);
            echo $output;
        }else{
            die('Query Failed' . mysqli_error($connection));
        }
    }
?>