<?php include "../includes/header.php"; ?>
<?php
if(!isset($_SESSION['user_employee_id'])){
    header ("Location: index.php");
}
?>
<?php
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
    //$query .= "WHERE academic_slpes.slpe_tutor_id = '{$_SESSION['user_employee_id']}' "; //for tutors
    $query .= "ORDER BY year DESC, term DESC, lesson DESC, tutor ASC, student ASC";
    $select_slpes  = mysqli_query($connection, $query);
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
                        Student Learning Plans &amp; Evaluations
                    </h1>
                </div>
            </div> <!-- /.row -->
            <div class="row">
                <div class="col-lg-12"  id="academic_slpes_table">
                    <table class="table table-bordered table-striped table-hover" id="academic_slpes"> <!-- id for DataTable -->
                        <thead class="bg-primary">
                            <tr>
                                <th width="10%">Date Created</th>
                                <th width="4%" class="text-center">Term</th>
                                <th width="4%" class="text-center">Lesson</th>
                                <th width="10%">Tutor</th>
                                <th width="12%">Student</th>
                                <th width="12%">Subject</th>
                                <th>Concept</th>
                                <th width="5%">Status</th>
                                <th width="4%" class="text-center">Id</th>
                                <th width="5%" class="text-center">View</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                while($row = mysqli_fetch_assoc($select_slpes)){
                                    $slpe_id         = $row['slpe_id'];
                                    $slpe_student_id = $row['slpe_student_id'];
                                    $year            = $row['year'];
                                    $date            = $row['date'];
                                    $term            = $row['term'];
                                    $tutor           = $row['tutor'];
                                    $student         = $row['student'];
                                    $lesson          = $row['lesson'];
                                    $subject         = $row['subject'];        
                                    $concept         = $row['concept'];
                                    $slpe_status     = $row['slpe_status'];
                            ?>
                                <tr>
                                    <td><?php echo $date; ?></td>
                                    <td class="text-center"><?php echo $term; ?></td>
                                    <td class="text-center"><?php echo $lesson; ?></td>
                                    <td><?php echo $tutor; ?></td>
                                    <td>
                                        <a href='academic_slpes_summary.php?id=<?php echo $slpe_student_id; ?>'>
                                            <?php echo $student; ?>
                                        </a>
                                    </td><!--link to learning plans summary--> <!--target="_blank"-->
                                    <td><?php echo $subject; ?></td>
                                    <td><?php echo $concept; ?></td>
                                    <td class="text-center">
                                        <?php
                                            if ($slpe_status == "Posted"){
                                                echo "<span type='button' class='btn-success btn-block'>$slpe_status</span>";
                                            }else{
                                                echo "<span type='button' class='btn-warning btn-block'>$slpe_status</span>";
                                            }
                                        ?>
                                    </td>
                                    <td class="text-center"><?php echo $slpe_id; ?></td>
                                    <td class="text-center">
                                        <span type="button" class="btn btn-info btn-xs slpe_view" name="slpe_view" id="<?php echo $slpe_id; ?>">
                                            <i class='fas fa-search-plus'></i>
                                        </span>
                                    </td><!--View-->
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

<!-- readonly_modal -->
<div class="modal fade" id="academic_slpe_readonly_modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div id="slpe_printSection">
                <div class="modal-header bg-primary">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Student Learning Plan & Evaluation Details</h4>
                </div>
                <div class="modal-body" id="academic_slpe_details">
                    <!--show data here-->
                </div>
            </div>
<!--
                <div class="modal-footer">
                    <button id="slpe_btnPrint" type="button" class="btn btn-primary">Print</button>
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
        });
        //-------------------- DataTable --------------------//
        $("#academic_slpes").DataTable({
            "order":[[0, "desc"]]
        }); 
        //-------------------- printing modal --------------------//
//        document.getElementById("slpe_btnPrint").onclick = function(){
//            document.getElementById("wrapper").style.display = "none";
//            printElement(document.getElementById("slpe_printSection"));
//        }
//        function printElement(elem, append, delimiter){
//            var domClone = elem.cloneNode(true);
//            var $slpe_printSection = document.getElementById("slpe_printSection");
//            if (!$slpe_printSection){
//                var $slpe_printSection = document.createElement("div");
//                $slpe_printSection.id = "slpe_printSection";
//                document.body.appendChild($slpe_printSection);
//            }
//            if (append !== true){
//                $slpe_printSection.innerHTML = "";
//            }else if (append ===true){
//                if (typeof (delimiter) === "string"){
//                    $slpe_printSection.innerHTML += delimiter;
//                }else if (typeof (delimiter) === "object"){
//                $slpe_printSection.appendChlid(delimiter);
//                }
//            }
//            $slpe_printSection.appendChild(domClone);
//            window.print();
//            location.reload();
//        }
    });
    //++++++++++++++++++++ academic_slpes CRUD +++++++++++++++++++//
    $(document).ready(function(){
        //-------------------- view_button --------------------//
        $(document).on("click", ".slpe_view", function(){
            var slpe_id = $(this).attr("id");
            $.ajax({
                url:"CRUD/read.php",
                method:"POST",
                data:{slpe_id:slpe_id},
                success:function(data){
                    $("#academic_slpe_details").html(data);
                    $("#academic_slpe_readonly_modal").modal("show");
                }
            });
        });
    });
</script>

<?php include "../includes/footer.php"; ?>