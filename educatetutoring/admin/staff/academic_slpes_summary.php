<?php include "../includes/header.php"; ?>
<?php
if(!isset($_GET['id'])){
    header ("Location: academic_slpes_summaries.php");
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
                        <?php
                            $query  = "SELECT CONCAT(student_firstname, ' ', student_lastname) AS student_name, student_id FROM admin_student_registration ";
                            $query .= "WHERE student_id = '{$_GET['id']}'";
                            $select_student   = mysqli_query($connection, $query);
                            while($row = mysqli_fetch_assoc($select_student)){
                                $student_id   = $row['student_id'];
                                $student_name = $row['student_name'];
                            }
                            echo "Learning Plans Summary";
                        ?>
                    </h1>
                </div>
            </div> <!-- /.row -->
            
            <div class="row">
                <div class="col-lg-10">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h4 class="panel-title" id="enquiries">
                            <?php echo "$student_name <small>(Student ID: $student_id)</small>"; ?>
                            </h4>
                        </div>
                        <div class="panel-body">
                            <?php
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
                                //$query .= "WHERE academic_slpes.slpe_tutor_id = '{$_SESSION['user_employee_id']}' "; //for tutors
                                $query .= "WHERE academic_slpes.slpe_student_id = '{$_GET['id']}'";
                                $query .= "ORDER BY year DESC, term DESC, lesson DESC, tutor ASC, student ASC";
                                $select_slpes  = mysqli_query($connection, $query);
                                if (mysqli_num_rows($select_slpes) < 1){
                                    echo "No record available!";
                                }else{
                                    while($row = mysqli_fetch_assoc($select_slpes)){
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
                            ?>
                                        <div class='container-fluid'>
                                            <div class="panel panel-default">
                                                <div class="panel-heading">
                                                    <h4 class="panel-title">
                                                        <?php echo "Term $term Lesson $lesson"; ?>
                                                        <div class="pull-right">
                                                            <?php echo "Date: $date"; ?>
                                                        </div>
                                                    </h4>
                                                </div>
                                                <div class="panel-body">
                                                    <div class='row'>
                                                        <div class='col-lg-2'>Subject</div>
                                                        <div class='col-lg-10'><?php echo "$slpe_subject"; ?></div>
                                                    </div>
                                                    <div class='row'>
                                                        <div class='col-lg-2'>Concept</div>
                                                        <div class='col-lg-10'><?php echo "$slpe_concept"; ?></div>
                                                    </div>
                                                    <div class='row'>
                                                        <div class='col-lg-2'>Concept Detail</div>
                                                        <div class='col-lg-10'><?php echo "$slpe_concept_detail"; ?></div>
                                                    </div>
                                                    <div class='row'>
                                                        <div class='col-lg-2'>Learning Activity</div>
                                                        <div class='col-lg-10'><?php echo "$slpe_learning_activity"; ?></div>
                                                    </div>
                                                    <hr />
                                                    <div class='row'>
                                                        <div class='col-lg-2'>Tutor Evaluation</div>
                                                        <div class='col-lg-10'><?php echo "$tutor_evaluation"; ?></div>
                                                    </div>
                                                    <div class='row'>
                                                        <div class='col-lg-2'>Student Self Assessment</div>
                                                        <div class='col-lg-10'><?php echo "$student_self_assessment"; ?></div>
                                                    </div>
                                                    <div class='row'>
                                                        <div class='col-lg-2'>Comments/Homework</div>
                                                        <div class='col-lg-10'><?php echo "$comments_homework"; ?></div>
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
                </div> <!-- col-lg -->
            </div> <!-- /.row --> 
        </div> <!-- /.container-fluid -->
    </div> <!-- /#page-wrapper -->
</div> <!-- /#wrapper -->

<script>
    
</script>

<?php include "../includes/footer.php"; ?>