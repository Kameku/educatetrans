<?php include "../includes/header.php"; ?>
<?php
    if(!isset($_SESSION['user_employee_id'])){
        header ("Location: index.php");
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
                        Student Learning Plan &amp; Evaluation: Fast Add
                    </h1>
                </div>
            </div> <!-- /.row -->
            <?php
                //----------fetch----------//
                if(isset($_GET['fastadd'])){
                    $the_slpe_id = $_GET['fastadd'];
                    $query  = "SELECT academic_slpes.*";
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
                    $query .= "WHERE slpe_id = {$the_slpe_id}";
                    $select_slpe = mysqli_query($connection, $query);
                    while($row   = mysqli_fetch_assoc($select_slpe)){
                        $year                      = $row['year'];
                        $term                      = $row['term'];
                        $lesson                    = $row['lesson'];
                        $slpe_student_id           = $row['slpe_student_id'];
                        $slpe_student              = $row['student'];
                        $slpe_tutor_id             = $row['slpe_tutor_id'];
                        $slpe_subject_id           = $row['slpe_subject_id'];
                        $subject                   = $row['subject'];
                        $slpe_concept_id           = $row['slpe_concept_id'];
                        $concept                   = $row['concept'];
                        $slpe_concept_hidden_id    = $row['slpe_concept_hidden_id'];
                        $slpe_concept_detail_id    = $row['slpe_concept_detail_id'];
                        $concept_detail            = $row['concept_detail'];
                        $slpe_learning_activity_id = $row['slpe_learning_activity_id'];
                        $learning_activity         = $row['learning_activity'];
                        $tutor_evaluation          = $row['tutor_evaluation'];
                        $student_self_assessment   = $row['student_self_assessment'];
                        $comments_homework         = $row['comments_homework'];
                        $slpe_status               = $row['slpe_status'];
                    }
                }
            ?>
            <div class="row">
                <div class="col-lg-12">
                    <form method="post" id="academic_slpe_insert_form">
                        <div class="row">
                            <div class="col-lg-6">
                                <input type="hidden" name="year" id="year" value="<?php echo $year; ?>" />
                                <input type="hidden" name="date" id="date" value="<?php echo date('Y/m/d'); ?>" />
                                <div class="form-group">
                                    <label for="slpe_status">Save this record as</label>
                                    <select class="form-control" name="slpe_status" id="slpe_status">
                                        <?php
                                            $query = "SELECT * FROM settings_post_status ORDER BY status ASC";
                                            $select_status = mysqli_query($connection, $query);
                                            while($row     = mysqli_fetch_assoc($select_status)){
                                                $status    = $row['status'];
                                                if($status == $slpe_status){
                                                    echo "<option selected value='$status'>{$status}</option>"; //current selection
                                                }else{
                                                    echo "<option value='$status'>{$status}</option>"; //full selections
                                                }
                                            }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="student">Student</label>
                                    <select class="form-control" name="student" id="student">
                                        <option value="">------- Select -------</option>
                                        <?php
                                            $year   = date('Y');
                                            $query  = "SELECT DISTINCT admin_student_schedules.schedule_student_id";
                                            $query .= ", CONCAT(admin_student_registration.student_firstname, ' ', admin_student_registration.student_lastname) AS student ";
                                            $query .= "FROM admin_student_schedules ";
                                            $query .= "JOIN admin_student_registration ON admin_student_schedules.schedule_student_id = admin_student_registration.student_id ";
                                            $query .= "WHERE schedule_tutor_id = '{$slpe_tutor_id}' ";
                                            $query .= "AND schedule_year = '{$year}' ";
                                            $query .= "ORDER BY student ASC";
                                            $select_students  = mysqli_query($connection, $query);
                                            if(mysqli_num_rows($select_students) > 0){
                                                while($row        = mysqli_fetch_assoc($select_students)){
                                                    $student_id   = $row['schedule_student_id'];
                                                    $student_name = $row['student'];
                                                    if($student_id == $slpe_student_id){
                                                        echo "<option selected value='$student_id'>{$student_name}</option>"; //current selection
                                                    }else{
                                                        echo "<option value='$student_id'>{$student_name}</option>"; //full selections
                                                    }
                                                }
                                            }else{
                                                echo '<option value="">No Record</option>';
                                            }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="term">School Term</label>
                                    <select class="form-control" name="term" id="term">
                                        <option value="">------- Select -------</option>
                                        <?php
                                            $query = "SELECT * FROM settings_school_terms ORDER BY term ASC";
                                            $select_term = mysqli_query($connection, $query);
                                            while($row   = mysqli_fetch_assoc($select_term)){
                                                $settings_school_term = $row['term'];
                                                if($settings_school_term == $term){
                                                    echo "<option selected value='$settings_school_term'>{$settings_school_term}</option>"; //current selection
                                                }else{
                                                    echo "<option value='$settings_school_term'>{$settings_school_term}</option>"; //full selections
                                                }
                                            }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="lesson">Lesson No.</label>
                                    <select class="form-control" name="lesson" id="lesson">
                                        <option value="">------- Select -------</option>
                                        <?php
                                            $query = "SELECT * FROM settings_lessons ORDER BY lesson_id ASC";
                                            $select_lesson = mysqli_query($connection, $query);
                                            while($row     = mysqli_fetch_assoc($select_lesson)){
                                                $settings_lesson  = $row['lesson'];
                                                if($settings_lesson == $lesson){
                                                    echo "<option selected value='$settings_lesson'>{$settings_lesson}</option>"; //current selection
                                                }else{
                                                    echo "<option value='$settings_lesson'>{$settings_lesson}</option>"; //full selections
                                                }
                                            }
                                        ?>
                                    </select>
                                </div>
                                <input type="hidden" name="tutor" id="tutor" value="<?php echo $slpe_tutor_id; ?>" />
                                <div class="form-group">
                                    <label for="subject">Subject *</label>
                                    <select class="form-control" name="subject" id="subject" required>
                                        <option value="">------- Select -------</option>
                                        <?php
                                            $query = "SELECT * FROM library_subjects ORDER BY subject";
                                            $select_subjects  = mysqli_query($connection, $query);
                                            while($row = mysqli_fetch_assoc($select_subjects)){
                                                $the_subject_id = $row['subject_id'];
                                                $the_subject    = $row['subject'];
                                                if($the_subject_id == $slpe_subject_id){
                                                    echo "<option selected value='$the_subject_id'>{$the_subject}</option>"; //current selection
                                                }else{
                                                    echo "<option value='$the_subject_id'>{$the_subject}</option>"; //full selections
                                                }
                                            }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-9">
                                            <label for="concept">Concept *</label>
                                            <select class="form-control" name="concept" id="concept" required>
                                                <option value="">------- Select -------</option>
                                                <?php
                                                    $query = "SELECT * FROM library_concepts WHERE concept_subject_id = {$slpe_subject_id} ORDER BY concept";
                                                    $select_concepts  = mysqli_query($connection, $query);
                                                    if(mysqli_num_rows($select_concepts) > 0){
                                                        while($row      = mysqli_fetch_assoc($select_concepts)){
                                                            $the_concept_id = $row['concept_id'];
                                                            $the_concept    = $row['concept'];
                                                            if($the_concept_id == $slpe_concept_id){
                                                                echo "<option selected value='$the_concept_id'>{$the_concept}</option>"; //current selection
                                                            }else{
                                                                echo "<option value='$the_concept_id'>{$the_concept}</option>"; //full selections
                                                            }
                                                        }
                                                    }else{
                                                        echo '<option value="">No Record</option>';
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="col-lg-3">
                                            <label for="concept_hidden">Concept ID</label>
                                            <input class="form-control" name="concept_hidden" id="concept_hidden" value="<?php echo $slpe_concept_hidden_id; ?>" readonly/> <!-- for learning_activity -->
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="concept_detail">Concept Detail *</label>
                                    <select class="form-control" name="concept_detail" id="concept_detail" required>
                                        <option value="">------- Select -------</option>
                                        <?php
                                            $query = "SELECT * FROM library_concept_details WHERE concept_detail_concept_id = {$slpe_concept_id} ORDER BY concept_detail";
                                            $select_concept_details = mysqli_query($connection, $query);
                                            if(mysqli_num_rows($select_concept_details) > 0){
                                                while($row = mysqli_fetch_assoc($select_concept_details)){
                                                    $the_concept_detail_id = $row['concept_detail_id'];
                                                    $the_concept_detail    = $row['concept_detail'];
                                                    if($the_concept_detail_id == $slpe_concept_detail_id){
                                                        echo "<option selected value='$the_concept_detail_id'>{$the_concept_detail}</option>"; //current selection
                                                    }else{
                                                        echo "<option value='$the_concept_detail_id'>{$the_concept_detail}</option>"; //full selections
                                                    }
                                                }
                                            }else{
                                                echo '<option value="">No Record</option>';
                                            }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="learning_activity">Learning Activity *</label>
                                    <select class="form-control" name="learning_activity" id="learning_activity" required>
                                        <option value="">------- Select -------</option>
                                        <?php
                                            $query = "SELECT * FROM library_learning_activities WHERE learning_activity_concept_id = {$slpe_concept_hidden_id} ORDER BY learning_activity";
                                            $select_learning_activities = mysqli_query($connection, $query);
                                            if(mysqli_num_rows($select_learning_activities) > 0) {
                                                while($row = mysqli_fetch_assoc($select_learning_activities)){
                                                    $the_learning_activity_id = $row['learning_activity_id'];
                                                    $the_learning_activity    = $row['learning_activity'];
                                                    if($the_learning_activity_id == $slpe_learning_activity_id){
                                                        echo "<option selected value='$the_learning_activity_id'>{$the_learning_activity}</option>"; //current selection
                                                    }else{
                                                        echo "<option value='$the_learning_activity_id'>{$the_learning_activity}</option>"; //full selections
                                                    }
                                                }
                                            }else{
                                                echo '<option value="">No Record</option>';
                                            }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="tutor_evaluation">Tutor Evaluation</label>
                                    <select class="form-control" name="tutor_evaluation" id="tutor_evaluation">
                                        <option value="">------- Select -------</option>
                                        <?php
                                            $query = "SELECT * FROM settings_assessments ORDER BY assessment";
                                            $select_evaluations  = mysqli_query($connection, $query);
                                            while($row = mysqli_fetch_assoc($select_evaluations)){
                                                $evaluation = $row['assessment'];
                                                if($evaluation == $tutor_evaluation){
                                                    echo "<option selected value='$evaluation'>{$evaluation}</option>"; //current selection
                                                }else{
                                                    echo "<option value='$evaluation'>{$evaluation}</option>"; //full selections
                                                }
                                            }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="student_self_assessment">Student Self Assessment</label>
                                    <select class="form-control" name="student_self_assessment" id="student_self_assessment">
                                        <option value="">------- Select -------</option>
                                        <?php
                                            $query = "SELECT * FROM settings_assessments ORDER BY assessment";
                                            $select_assessments  = mysqli_query($connection, $query);
                                            while($row = mysqli_fetch_assoc($select_assessments)){
                                                $assessment = $row['assessment'];
                                                if($assessment == $student_self_assessment){
                                                    echo "<option selected value='$assessment'>{$assessment}</option>"; //current selection
                                                }else{
                                                    echo "<option value='$assessment'>{$assessment}</option>"; //full selections
                                                }
                                            }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="comments_homework">Comments/Homework</label>
                                    <textarea class="form-control" name="comments_homework" id="comments_homework" rows="34"><?php echo $comments_homework; ?></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group text-right">
                                    <a class="btn btn-default" name="academic_slpe_fastadd_cancel" id="academic_slpe_fastadd_cancel" href="slpes.php">Cancel</a>
                                    <input class="btn btn-success" type="submit" name="academic_slpe_fastadd" id="academic_slpe_fastadd" value="Fast Add" />
                                </div>
                            </div>
                        </div>
                    </form>
                </div> <!-- col-lg -->
            </div> <!-- /.row -->
            <?php
                //----------update----------//
                if(isset($_POST['academic_slpe_fastadd'])){
                    $date                      = mysqli_real_escape_string($connection, trim($_POST['date']));
                    $year                      = mysqli_real_escape_string($connection, trim($_POST['year']));
                    $term                      = mysqli_real_escape_string($connection, trim($_POST['term']));
                    $lesson                    = mysqli_real_escape_string($connection, trim($_POST['lesson']));
                    $slpe_student_id           = mysqli_real_escape_string($connection, trim($_POST['student']));
                    $slpe_tutor_id             = mysqli_real_escape_string($connection, trim($_POST['tutor']));
                    $slpe_subject_id           = mysqli_real_escape_string($connection, trim($_POST['subject']));
                    $slpe_concept_id           = mysqli_real_escape_string($connection, trim($_POST['concept']));
                    $slpe_concept_hidden_id    = mysqli_real_escape_string($connection, trim($_POST['concept_hidden']));
                    $slpe_concept_detail_id    = mysqli_real_escape_string($connection, trim($_POST['concept_detail']));
                    $slpe_learning_activity_id = mysqli_real_escape_string($connection, trim($_POST['learning_activity']));
                    $tutor_evaluation          = mysqli_real_escape_string($connection, trim($_POST['tutor_evaluation']));
                    $student_self_assessment   = mysqli_real_escape_string($connection, trim($_POST['student_self_assessment']));
                    $comments_homework         = replace(mysqli_real_escape_string($connection, trim($_POST['comments_homework'])));
                    $slpe_status               = mysqli_real_escape_string($connection, trim($_POST['slpe_status']));
                    
                    $stmt = mysqli_prepare($connection, "INSERT INTO academic_slpes(year, term, lesson, date, slpe_student_id, slpe_tutor_id, slpe_subject_id, slpe_concept_id, slpe_concept_hidden_id, slpe_concept_detail_id, slpe_learning_activity_id, tutor_evaluation, student_self_assessment, comments_homework, slpe_status) VALUE(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?) ");
                    mysqli_stmt_bind_param($stmt, 'ssssiiiiiiissss', $year, $term, $lesson, $date, $slpe_student_id, $slpe_tutor_id, $slpe_subject_id, $slpe_concept_id, $slpe_concept_hidden_id, $slpe_concept_detail_id, $slpe_learning_activity_id, $tutor_evaluation, $student_self_assessment, $comments_homework, $slpe_status);
                    mysqli_stmt_execute($stmt);
                    if(!$stmt){
                        die("QUERY FAILED" . mysqli_error($connection));
                    }
                    mysqli_stmt_close($stmt);
                    header ("Location: slpes.php");
                }
            ?>
        </div> <!-- /.container-fluid -->
    </div> <!-- /#page-wrapper -->
</div> <!-- /#wrapper -->

<script> 
    //-------------------- academic_input --------------------//
    $(document).ready(function(){
        //------for student list------//
//        $(document).on('change','#term', function(){
//            var term  = $(this).val();
//            if(term != ""){
//                $.ajax({
//                    url:"../includes/functions.php",
//                    type:'POST',
//                    data:{term:term},
//                    success:function(response){
//                        if(response != ''){
//                            $("#student").removeAttr('disabled','disabled').html(response);
//                        }else{
//                            $("#student").attr('disabled','disabled').html("<option value=''>------ Select --------</option>");
//                        }
//                    }
//                });
//            }
//        });
        //------concept------//
        $(document).on('change','#subject', function(){
            var subject_id = $(this).val();
            if(subject_id != ""){
                $.ajax({
                    url:"../includes/functions.php",
                    type:'POST',
                    data:{subject_id:subject_id},
                    success:function(response){
                        if(response != ''){
                            $("#concept").html(response);
                        }
                    }
                });
            }else{
                $("#concept, #concept_detail, #learning_activity").html("<option value=''>------- Select --------</option>");
            }
        });
        //------concept_detail------//
        $(document).on('change','#concept', function(){
            var concept_id = $(this).val();
            if(concept_id != ""){
                $.ajax({
                    url:"../includes/functions.php",
                    type:'POST',
                    data:{concept_id:concept_id},
                    success:function(response){
                        if(response != ''){
                            $("#concept_detail").html(response);
                        }
                    }
                });
            }else{
                $("#concept_detail, #learning_activity").html("<option value=''>------- Select --------</option>");
            }
        });
        //------learning_activity------//
        var concept_hidden = document.getElementById("concept_hidden");
        $("#concept").blur(function(){
            concept_hidden.value = this.value;
            document.getElementById("concept_hidden").focus();
            document.getElementById("concept_hidden").blur();
        });
        $(document).on('blur','#concept_hidden', function(){
            var concept_hidden_id = $(this).val();
            if(concept_hidden_id != ""){
                $.ajax({
                    url:"../includes/functions.php",
                    type:'POST',
                    data:{concept_hidden_id:concept_hidden_id},
                    success:function(response){
                        if(response != ''){
                            $("#learning_activity").html(response);
                        }
                    }
                });
            }else{
                $("#learning_activity").html("<option value=''>------ Select --------</option>");
            }
        });
    });
</script>

<?php include "../includes/footer.php"; ?>