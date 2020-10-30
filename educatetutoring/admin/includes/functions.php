<?php
function staff_login($username, $user_password){
    global $connection; //check point
    $username      = trim($username);
    $user_password = trim($user_password);
    
    $username      = mysqli_real_escape_string($connection, $username);
    $user_password = mysqli_real_escape_string($connection, $user_password);
    
    $query  = "SELECT admin_employee_users.*";
    $query .= ", admin_employees.employee_firstname ";
    $query .= ", settings_user_roles.role ";
    $query .= "FROM admin_employee_users ";
    $query .= "JOIN admin_employees ON admin_employee_users.user_employee_id = admin_employees.employee_id ";
    $query .= "JOIN settings_user_roles ON admin_employee_users.user_role_id = settings_user_roles.role_id ";
    $query .= "WHERE admin_employee_users.username = '{$username}'";
    $select_user_query = mysqli_query($connection, $query);
    
    if(!$select_user_query){
        die("Query Failed." . mysqli_error($connection));
    }
    while($row = mysqli_fetch_assoc($select_user_query)){
        $db_employee_user_id  = $row['employee_user_id'];
        $db_user_employee_id  = $row['user_employee_id'];
        $db_user_firstname    = $row['employee_firstname'];
        $db_username          = $row['username'];
        $db_user_password     = $row['user_password'];
        $db_user_role         = $row['role'];
    }
    if(password_verify($user_password, $db_user_password)){
        $_SESSION['user_id']          = $db_employee_user_id;
        $_SESSION['user_employee_id'] = $db_user_employee_id;
        $_SESSION['user_firstname']   = $db_user_firstname;
        $_SESSION['user_password']    = $db_user_password;
        $_SESSION['username']         = $db_username;
        $_SESSION['user_role']        = $db_user_role;
        if($_SESSION['user_role'] == 'Manager' || $_SESSION['user_role'] == 'Director'){
            header("Location: ../admin/staff/index.php");
        }else{
            header("Location: ../welcome.php");
        }
    }else{
        header("Location: ../welcome.php");
    }
} //staff_login

function tutor_login($username, $user_password){
    global $connection; //check point
    $username      = trim($username);
    $user_password = trim($user_password);
    
    $username      = mysqli_real_escape_string($connection, $username);
    $user_password = mysqli_real_escape_string($connection, $user_password);
    
    $query  = "SELECT admin_employee_users.*";
    $query .= ", admin_employees.employee_firstname ";
    $query .= ", settings_user_roles.role ";
    $query .= "FROM admin_employee_users ";
    $query .= "JOIN admin_employees ON admin_employee_users.user_employee_id = admin_employees.employee_id ";
    $query .= "JOIN settings_user_roles ON admin_employee_users.user_role_id = settings_user_roles.role_id ";
    $query .= "WHERE admin_employee_users.username = '{$username}'";
    $select_user_query = mysqli_query($connection, $query);
    
    if(!$select_user_query){
        die("Query Failed." . mysqli_error($connection));
    }
    while($row = mysqli_fetch_assoc($select_user_query)){
        $db_employee_user_id = $row['employee_user_id'];
        $db_user_employee_id = $row['user_employee_id'];
        $db_user_firstname   = $row['employee_firstname'];
        $db_username         = $row['username'];
        $db_user_password    = $row['user_password'];
        $db_user_role        = $row['role'];
    }
    if(password_verify($user_password, $db_user_password)){
        $_SESSION['user_id']          = $db_employee_user_id;
        $_SESSION['user_employee_id'] = $db_user_employee_id;
        $_SESSION['user_firstname']   = $db_user_firstname;
        $_SESSION['user_password']    = $db_user_password;
        $_SESSION['username']         = $db_username;
        $_SESSION['user_role']        = $db_user_role;
        if($_SESSION['user_role'] == 'Tutor' || $_SESSION['user_role'] == 'Director'){
            header("Location: ../admin/tutors/sasps.php");
        }else{
            header("Location: ../welcome.php");
        }
    }else{
        header("Location: ../welcome.php");
    }
} //tutor_login

function student_login($username, $user_password){
    global $connection; //check point
    $username      = trim($username);
    $user_password = trim($user_password);
    
    $username      = mysqli_real_escape_string($connection, $username);
    $user_password = mysqli_real_escape_string($connection, $user_password);
    
    $query  = "SELECT admin_student_users.*";
    $query .= ", settings_user_roles.role ";
    $query .= "FROM admin_student_users ";
    $query .= "JOIN settings_user_roles ON admin_student_users.user_role_id = settings_user_roles.role_id ";
    $query .= "WHERE admin_student_users.username = '{$username}'";
    $select_user_query = mysqli_query($connection, $query);
    
    if(!$select_user_query){
        die("Query Failed." . mysqli_error($connection));
    }
    while($row = mysqli_fetch_assoc($select_user_query)){
        $db_student_user_id = $row['student_user_id'];
        $db_user_student_id = $row['user_student_id'];
        $db_username        = $row['username'];
        $db_user_password   = $row['user_password'];
        $db_user_role       = $row['role'];
    }
    if(password_verify($user_password, $db_user_password)){
        $_SESSION['user_id']        = $db_student_user_id;
        $_SESSION['username']       = $db_username;
        $_SESSION['user_password']  = $db_user_password;
        $_SESSION['user_role']      = $db_user_role;
        
        if($_SESSION['user_role'] == 'Student'){
            header("Location: ../admin/students/index.php");
        }else{
            header("Location: ../welcome.php");
        }
    }else{
        header("Location: ../welcome.php");
    }
} //student_login

function replace($string){
    global $connection; //check point
    $search = array('\r\n', '\\', '"', '\'');
    $replace = array('<br/>', '', '&quot;', '&#039;');
    return str_replace($search, $replace, $string);
} //relace_string
?>

<?php
    //----------users_employee_users check_username_exists----------//
    if(isset($_GET["employee_username"]) && $_GET["employee_username"] !==""){
        $connection = mysqli_connect("localhost", "root", "mysql", "educate_tutoring");
        $employee_username = $_GET["employee_username"];
        $employee_username = mysqli_real_escape_string($connection, trim($employee_username));
        $query             = "SELECT username FROM admin_employee_users WHERE username = '$employee_username'";
        $select_username   = mysqli_query($connection, $query);
        $result_cnt        = mysqli_num_rows($select_username);
        if($result_cnt > 0){
//            echo 1;
            echo "<span class='text-danger'><i class='far fa-times-circle'></i>  Username already exists!</span>";
        }else{
            $query           = "SELECT username FROM admin_student_users WHERE username = '$employee_username'";
            $select_username = mysqli_query($connection, $query);
            $result_cnt      = mysqli_num_rows($select_username);
            if($result_cnt > 0){
//                echo 1;
                echo "<span class='text-danger'><i class='far fa-times-circle'></i>  Username already exists!</span>";
            }else{
                echo "<span class='text-success'><i class='far fa-check-circle'></i>  This username is available!</span>";
//                echo 0;
            }
        }
    }
    
    //----------users_student_users check_username_exists----------//
    if(isset($_GET["student_username"]) && $_GET["student_username"] !==""){
        $connection       = mysqli_connect("localhost", "root", "mysql", "educate_tutoring");
        $student_username = $_GET["student_username"];
        $student_username = mysqli_real_escape_string($connection, trim($student_username));
        $query            = "SELECT username FROM admin_student_users WHERE username = '$student_username'";
        $select_username  = mysqli_query($connection, $query);
        $result_cnt       = mysqli_num_rows($select_username);
        if($result_cnt > 0){
//            echo 1;
            echo "<span class='text-danger'><i class='far fa-times-circle'></i>  Username already exists!</span>";
        }else{
            $query           = "SELECT username FROM admin_employee_users WHERE username = '$student_username'";
            $select_username = mysqli_query($connection, $query);
            $result_cnt      = mysqli_num_rows($select_username);
            if($result_cnt > 0){
//                echo 1;
                echo "<span class='text-danger'><i class='far fa-times-circle'></i>  Username already exists!</span>";
            }else{
                echo "<span class='text-success'><i class='far fa-check-circle'></i>  This username is available!</span>";
//                echo 0;
            }
        }
    }

    //----------academic_slpes----------//
    //---student---//
//    if (isset($_POST['term'])){
//        $connection = mysqli_connect("localhost", "root", "mysql", "educate_tutoring");
//        $year   = date('Y');
//        $tutor  = $_SESSION['user_employee_id'];
//        $query  = "SELECT admin_student_schedules.*";
//        $query .= ", CONCAT(admin_student_registration.student_firstname, ' ', admin_student_registration.student_lastname) AS student ";
//        $query .= "FROM admin_student_schedules ";
//        $query .= "JOIN admin_student_registration ON admin_student_schedules.schedule_student_id = admin_student_registration.student_id ";
//        $query .= "WHERE schedule_tutor_id = '{$tutor}' ";
//        $query .= "AND schedule_year = '{$year}' ";
//        $query .= "AND schedule_term = '{$_POST['term']}' ";
//        $query .= "ORDER BY student ASC";
//        $select_students  = mysqli_query($connection, $query);
//        if(mysqli_num_rows($select_students) > 0){
//            echo '<option value="">------ Select ------</option>';
//            while($row        = mysqli_fetch_assoc($select_students)){
//                $student_id   = $row['schedule_student_id'];
//                $student_name = $row['student'];
//                echo "<option value='$student_id'>{$student_name}</option>"; 
//            }
//        }else{
//            echo '<option value="">No Record</option>';
//        }
//    }

    //---concept---//
    if (isset($_POST['subject_id'])){
        $connection = mysqli_connect("localhost", "root", "mysql", "educate_tutoring");
        $query = "SELECT * FROM library_concepts WHERE concept_subject_id = '{$_POST['subject_id']}' ORDER BY concept";
        $select_concepts  = mysqli_query($connection, $query);
        if(mysqli_num_rows($select_concepts) > 0){
            echo '<option value="">------- Select -------</option>';
            while($row      = mysqli_fetch_assoc($select_concepts)){
                $concept_id = $row['concept_id'];
                $concept    = $row['concept'];
                echo "<option value='$concept_id'>{$concept}</option>";
            }
        }else{
            echo '<option value="">No Record</option>';
        }
    }else if(isset($_POST['concept_id'])){
        $connection = mysqli_connect("localhost", "root", "mysql", "educate_tutoring");
        $query = "SELECT * FROM library_concept_details WHERE concept_detail_concept_id = '{$_POST['concept_id']}' ORDER BY concept_detail";
        $select_concept_details = mysqli_query($connection, $query);
        if(mysqli_num_rows($select_concept_details) > 0){
            echo '<option value="">------- Select -------</option>';
            while($row = mysqli_fetch_assoc($select_concept_details)){
                $concept_detail_id = $row['concept_detail_id'];
                $concept_detail    = $row['concept_detail'];
                echo "<option value='$concept_detail_id'>{$concept_detail}</option>";
            }
        }else{
            echo '<option value="">No Record</option>';
        }
    }else if(isset($_POST['concept_hidden_id'])){
        $connection = mysqli_connect("localhost", "root", "mysql", "educate_tutoring");
        $query = "SELECT * FROM library_learning_activities WHERE learning_activity_concept_id = '{$_POST['concept_hidden_id']}' ORDER BY learning_activity";
        $select_learning_activities = mysqli_query($connection, $query);
        if(mysqli_num_rows($select_learning_activities) > 0) {
            echo '<option value="">------- Select -------</option>';
            while($row = mysqli_fetch_assoc($select_learning_activities)){
                $learning_activity_id = $row['learning_activity_id'];
                $learning_activity    = $row['learning_activity'];
                echo "<option value='$learning_activity_id'>{$learning_activity}</option>";
            }
        }else{
            echo '<option value="">No Record</option>';
        }
    }
    //---enrollment_procedure enquiry_id student_name---//
    if (isset($_POST['procedure_enquiry_id'])){
        $connection = mysqli_connect("localhost", "root", "mysql", "educate_tutoring");
        $query  = "SELECT admin_student_enquiries.*";
        $query .= ", CONCAT(admin_student_registration.student_firstname, ' ', admin_student_registration.student_lastname) AS student_fullname ";
        $query .= "FROM admin_student_enquiries ";
        $query .= "JOIN admin_student_registration ON admin_student_enquiries.enquiry_student_id = admin_student_registration.student_id ";
        $query .= "WHERE enquiry_id = '{$_POST['procedure_enquiry_id']}'";
        $select_student  = mysqli_query($connection, $query);
        if(mysqli_num_rows($select_student) > 0){
            while($row            = mysqli_fetch_assoc($select_student)){
                $student_id       = $row['enquiry_student_id'];
                $student_fullname = $row['student_fullname'];
                echo "<option value='$student_id'>{$student_fullname}</option>";
            }
        }else{
            echo '<option value="">No Record</option>';
        }
    }
?>

<?php
function confirm_query($result){
    global $connection; //check point
    if(!$result) {
        die("Query failed." . mysqli_error($connection));
    }
} //error handling

function escape($string){
    global $connection; //check point
    return mysqli_real_escape_string($connection, trim($string));
} //security

function select_all_count($table){
    global $connection; //check point
    $query = "SELECT * FROM " . $table;
    $select_all = mysqli_query($connection,$query);
    $result = mysqli_num_rows($select_all);
    confirm_query($result);
    return $result;
}

function select_condition_count($table, $column, $condition){
    global $connection; //check point
    $query = "SELECT * FROM $table WHERE $column = '{$condition}'";
    $select_all_condition = mysqli_query($connection,$query);
    $result = mysqli_num_rows($select_all_condition);
    confirm_query($result);
    return $result;
}

function is_admin($username = ''){
    global $connection; //check point
    $query  = "SELECT user_role FROM admin_users WHERE username = '$username'";
    $result = mysqli_query($connection, $query);
    confirm_query($result);
    $row = mysqli_fetch_array($result);
    if($row['user_role'] == 'Director'){
        return true;
    }else{
        return false;
    }
} //detect user_role

function username_exists($username){
    global $connection; //check point
    $query  = "SELECT username FROM admin_users WHERE username = '$username'";
    $result = mysqli_query($connection, $query);
    if(mysqli_num_rows($result) > 0){
        return true;
    }else{
        return false;
    }
} //user_registration

function user_email_exists($user_email){
    global $connection; //check point
    $query  = "SELECT user_email FROM admin_users WHERE user_email = '$user_email'";
    $result = mysqli_query($connection, $query);
    if(mysqli_num_rows($result) > 0){
        return true;
    }else{
        return false;
    }
} //user_registration

function register_user($username, $user_password, $user_email){
    global $connection; //check point
    $username      = mysqli_real_escape_string($connection, $username);
    $user_password = mysqli_real_escape_string($connection, $user_password);
    $user_email    = mysqli_real_escape_string($connection, $user_email);
    
    $user_password = password_hash($user_password, PASSWORD_BCRYPT, array('cost' => 10));
    
    $query  = "INSERT INTO admin_users (username, user_password, user_email, user_role_id, date_created) ";
    $query .= "VALUES('{$username}','{$user_password}','{$user_email}',3,now()) "; 
    $regist_user_query = mysqli_query($connection, $query); 
    
    if(!$regist_user_query){
        die("Query Failed" . mysqli_error($connection));
    } 
} //user_registration






//library functions
function library_read(){
    global $connection; //check point
    $query  = "SELECT library.*";
    $query .= ", library_subjects.subject";
    $query .= ", library_concepts.concept";
    $query .= ", library_concept_details.concept_detail ";
//    $query .= ", library_learning_activities.learning_activity ";
    $query .= "FROM library ";
    $query .= "JOIN library_subjects ON library.subject_id = library_subjects.subject_id ";
    $query .= "JOIN library_concepts ON library.concept_id = library_concepts.concept_id ";
    $query .= "JOIN library_concept_details ON library.concept_detail_id = library_concept_details.concept_detail_id ";
//    $query .= "JOIN library_learning_activities ON library.learning_activity_id = library_learning_activities.learning_activity_id ";
    $query .= "ORDER BY subject ASC, concept ASC, concept_detail ASC";
    
    $select_library = mysqli_query($connection, $query);
    while($row = mysqli_fetch_assoc($select_library)){
        $id                      = $row['id'];
        $subject                 = $row['subject'];        
        $concept                 = $row['concept']; 
        $concept_detail          = $row['concept_detail']; 
//        $learning_activity       = $row['learning_activity'];
        echo "<tr>";
        echo "<td>{$subject}</td>";
        echo "<td>{$concept}</td>";
        echo "<td>{$concept_detail}</td>";
        echo "<td>{$id}</td>";        
//        echo "<td>{$learning_activity}</td>";
        echo "</tr>";
    }
}

//Settings functions
function lesson_create(){    
    global $connection; //check point    
    if(isset($_POST['submit'])){
        $lesson = mysqli_real_escape_string($connection, trim($_POST['lesson']));
        if($lesson == "" || empty($lesson)){
            echo "This field should not be empty";
        }else{
            $stmt = mysqli_prepare($connection, "INSERT INTO settings_lessons(lesson) VALUE(?) ");
            mysqli_stmt_bind_param($stmt, 's', $lesson);
            mysqli_stmt_execute($stmt);
            if(!$stmt){
                die('Query Failed' . mysqli_error($connection));
            mysqli_stmt_close($stmt);
            }
            header ("Location: ./settings.php");
        }
    }
}

function lessons_find_all(){    
    global $connection; //check point    
    $query             = "SELECT * FROM settings_lessons ORDER BY lesson_id ASC";
    $select_categories = mysqli_query($connection, $query);
    
    while($row = mysqli_fetch_assoc($select_categories)){
        $lesson_id   = $row['lesson_id'];
        $lesson      = $row['lesson'];
        
        echo "<tr>";
        echo "<td>{$lesson_id}</td>";
        echo "<td>{$lesson}</td>";
        echo "<td><a class='btn btn-primary btn-xs btn-block' href='settings.php?edit={$lesson_id}'>Edit</a></td>";
        echo "</tr>";
    }       
}

function lesson_update(){    
    global $connection; //check point    
    if(isset($_GET['edit'])){
        $lesson_id = $_GET['edit'];
        include "includes/settings_lesson_update.php";    
    }
}

//Posts functions
function delete_post(){    
    global $connection; //check point    
    if(isset($_GET['delete'])){
        $the_post_id  = $_GET['delete'];
        $query        = "DELETE FROM posts WHERE post_id = {$the_post_id}";
        $delete_query = mysqli_query($connection,$query);
        header("Location: posts.php"); //refleshing page
    }
}

function reset_post_view_counts(){    
    global $connection; //check point    
    if(isset($_GET['viewcountsreset'])){
        $the_post_id  = $_GET['viewcountsreset'];
        $query        = "UPDATE posts SET post_view_count = 0 WHERE post_id = " . mysqli_real_escape_string($connection, $the_post_id) . " "; 
        $rest_post_view_counts_query = mysqli_query($connection,$query);
        header("Location: posts.php"); //refleshing page
    }
}

function switch_post_bulk_options(){
    global $connection; //check point 
    if(isset($_POST['checkBoxArray'])){
        foreach($_POST['checkBoxArray'] as $postValueId){
            $bulk_options = $_POST['bulk_options']; 
            
            switch($bulk_options){
                case 'Published':
                    $query = "UPDATE posts SET post_status = '{$bulk_options}' WHERE post_id = {$postValueId}";
                    $bulk_publish_query = mysqli_query($connection,$query);
                    
                    confirm_query($bulk_publish_query);
                    header("Location: posts.php");
                break;
                
                case 'Draft':
                    $query = "UPDATE posts SET post_status = '{$bulk_options}' WHERE post_id = {$postValueId}";
                    $bulk_draft_query = mysqli_query($connection,$query);
                    
                    confirm_query($bulk_draft_query);
                    header("Location: posts.php");                                
                break;
                
                case 'Delete':
                    $query = "DELETE FROM posts WHERE post_id = {$postValueId}";
                    $bulk_delete_query = mysqli_query($connection,$query);
                    
                    confirm_query($bulk_delete_query);
                    header("Location: posts.php");   
                break;    
                
                case 'Clone':
                    $query = "SELECT * FROM posts WHERE post_id = {$postValueId}"; 
                    $bulk_select_query = mysqli_query($connection, $query);
                    
                    while($row = mysqli_fetch_assoc($bulk_select_query)){
                        $post_author_id      = $row['post_author_id'];
                        $post_title          = $row['post_title'];
                        $post_category_id    = $row['post_category_id'];
                        $post_status         = $row['post_status'];        
                        $post_image          = $row['post_image'];        
                        $post_tags           = $row['post_tags'];  
                        $post_content        = $row['post_content'];   
                    }
                    
                    $query = "INSERT INTO posts(post_category_id, post_title, post_author_id, post_date,post_image,post_content,post_tags,post_status) ";
                    $query .= "VALUES({$post_category_id},'{$post_title}','{$post_author_id}',now(),'{$post_image}','{$post_content}','{$post_tags}', '{$post_status}') "; 
                    
                    $clone_post_query = mysqli_query($connection, $query);  
                    
                    confirm_query($clone_post_query);
                    header("Location: posts.php");   
                break;  
            }
        }
    }    
}


//Comments functions
function approve_comment(){
    global $connection; //check point    
    if(isset($_GET['approve'])){
        $the_comment_id  = $_GET['approve'];
        $query           = "UPDATE comments SET comment_status = 'approved' WHERE comment_id = {$the_comment_id}";
        $approve_comment_query = mysqli_query($connection,$query);
        header("Location: comments.php"); //refleshing page
    }    
}

function unapprove_comment(){
    global $connection; //check point    
    if(isset($_GET['unapprove'])){
        $the_comment_id  = $_GET['unapprove'];
        $query           = "UPDATE comments SET comment_status = 'unapproved' WHERE comment_id = {$the_comment_id}";
        $unapprove_comment_query = mysqli_query($connection,$query);
        header("Location: comments.php"); //refleshing page
    }    
}

function delete_comment(){
    global $connection; //check point    
    if(isset($_GET['delete'])){
        $the_comment_id  = $_GET['delete'];
        $query           = "DELETE FROM comments WHERE comment_id = {$the_comment_id}";
        $delete_query    = mysqli_query($connection,$query);
        header("Location: comments.php"); //refleshing page
    }    
}

function switch_comment_bulk_options(){
    global $connection; //check point 
    if(isset($_POST['checkBoxArray'])){
        foreach($_POST['checkBoxArray'] as $commentValueId){
            $bulk_options = $_POST['bulk_options']; 
            
            switch($bulk_options){
                case 'approved':
                    $query = "UPDATE comments SET comment_status = '{$bulk_options}' WHERE comment_id = {$commentValueId}";
                    $bulk_approve_query = mysqli_query($connection,$query);
                    
                    confirm_query($bulk_approve_query);
                    header("Location: comments.php");
                break;
                
                case 'unapproved':
                    $query = "UPDATE comments SET comment_status = '{$bulk_options}' WHERE comment_id = {$commentValueId}";
                    $bulk_unapprove_query = mysqli_query($connection,$query);
                    
                    confirm_query($bulk_unapprove_query);
                    header("Location: comments.php");                                
                break;
                
                case 'delete':
                    $query = "DELETE FROM comments WHERE comment_id = {$commentValueId}";
                    $bulk_delete_query = mysqli_query($connection,$query);
                    
                    confirm_query($bulk_delete_query);
                    header("Location: comments.php");   
                break;    
            }
        }
    }    
}


//Users functions
function delete_user(){    
    global $connection; //check point    
    if(isset($_GET['delete'])){
        if(isset($_SESSION['user_role']) && $_SESSION['user_role'] == 'Admin'){
            $the_user_id  = mysqli_real_escape_string($connection, $_GET['delete']);
            $query        = "DELETE FROM users WHERE user_id = {$the_user_id}";
            $delete_query = mysqli_query($connection,$query);
            header("Location: users.php"); //refleshing page
        }
    }
}

function switch_user_page_sources(){
    global $connection; //check point 
    if(isset($_GET['source'])){
        $source = $_GET['source'];
    }else{
        $source = "";
    }
    
    switch($source){
        case 'create_user';  
        include "includes/create_user.php"; 
        break;
     
        case 'update_user';  
        include "includes/update_user.php";
        break;    
     
        default:
        include "includes/view_all_users.php";   
        break;
    }
}

function switch_user_page_titles(){
    if(isset($_GET['source'])){
        $source = $_GET['source'];
    }else{
        $source = "";
    }
    
    switch($source){
        case 'create_user';  
        echo "Create User"; 
        break;
        
        case 'update_user';  
        echo "Update User";
        break;    
        
        default:
        echo "Users";   
        break;
    }
}

?>