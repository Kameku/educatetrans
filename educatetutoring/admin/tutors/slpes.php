<?php include "../includes/header.php"; ?>
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
    $query .= "WHERE academic_slpes.slpe_tutor_id = '{$_SESSION['user_employee_id']}' ";
    $query .= "ORDER BY year DESC, term DESC, lesson DESC, student ASC";
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
                        <div class="pull-right">
<!--                            <button type="button" class="btn btn-success btn-md" name="academic_slpe_add" id="academic_slpe_add" data-target="#academic_slpe_editable_modal"  data-backdrop="static" data-keyboard="false" data-toggle="modal">-->
                            <a class="btn btn-success btn-md" name="academic_slpe_add" id="academic_slpe_add" href="slpe_create.php">
                                <span><i class="fas fa-plus"></i></span>  Add New
                            </a>
<!--                           </button>-->
                        </div>
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
                                <th width="4%">Lesson</th>
                                <th width="12%">Student</th>
                                <th width="10%">Subject</th>
                                <th>Concept</th>
                                <th width="5%">Status</th>
                                <th width="4%">Id</th>
                                <th width="5%" class="text-center">FastAdd</th>
                                <th width="5%" class="text-center">View</th>
                                <th width="5%" class="text-center">Update</th>
                                <th width="5%" class="text-center">Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                while($row = mysqli_fetch_assoc($select_slpes)){
                                    $slpe_id     = $row['slpe_id'];
                                    $date        = $row['date'];
                                    $term        = $row['term'];
                                    $lesson      = $row['lesson'];
                                    $student     = $row['student'];
                                    $subject     = $row['subject'];        
                                    $concept     = $row['concept'];
                                    $slpe_status = $row['slpe_status'];
                            ?>
                                <tr>
                                    <td><?php echo $date; ?></td>
                                    <td class="text-center"><?php echo $term; ?></td>
                                    <td class="text-center"><?php echo $lesson; ?></td>
                                    <td><?php echo $student; ?></td>
                                    <td><?php echo $subject; ?></td>
                                    <td><?php echo $concept; ?></td>
                                    <td>
                                        <?php
                                            if($slpe_status == 'Posted'){
                                                echo "<span class='text-success'>{$slpe_status}</span>";
                                            }else{
                                                echo "<span class='text-danger'>{$slpe_status}</span>";;
                                            }          
                                        ?>
                                    </td>
                                    <td><?php echo $slpe_id; ?></td>
                                    <td class="text-center">
                                        <a href='slpe_fastadd.php?fastadd=<?php echo $slpe_id; ?>'>
                                            <span type="button" class="btn btn-success btn-xs slpe_fast_add" name="slpe_fast_add" id="">
                                                <i class="fas fa-bolt"></i>
                                            </span>
                                        </a>
                                    </td><!--FastAdd-->
                                    <td class="text-center">
                                        <span type="button" class="btn btn-info btn-xs slpe_view" name="slpe_view" id="<?php echo $slpe_id; ?>">
                                           <i class='fas fa-search-plus'></i>
                                        </span>
                                    </td><!--View-->
                                    <td class="text-center">
                                        <a href='slpe_update.php?update=<?php echo $slpe_id; ?>'>
                                            <span type="button" class="btn btn-warning btn-xs slpe_update" name="slpe_update" id="">
                                                <i class='far fa-edit'></i>
                                            </span>
                                        </a>
                                    </td><!--Update-->
                                    <td class="text-center">
                                        <span type="button" class="btn btn-danger btn-xs slpe_delete" name="slpe_delete" id="<?php echo $slpe_id; ?>">
                                            <i class='far fa-trash-alt'></i>
                                        </span>
                                    </td><!--Delete-->
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
                    <h4 class="modal-title">Task Details</h4>
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
        //-------------------- add_new_button --------------------//
//        $("#academic_slpe_add").click(function(){
//            $("#academic_slpe_insert").val("Add");
//            $("#academic_slpe_insert_form")[0].reset();
//        });
        //-------------------- update_button(fetch data) --------------------//
//        $(document).on("click", ".slpe_update", function(){
//            $("#concept, #concept_detail, #learning_activity").removeAttr('disabled','disabled');
//            var slpe_id = $(this).attr("id");
//            $.ajax({
//                url:"../staff/CRUD/fetch.php",
//                method:"POST",
//                data:{slpe_id:slpe_id},
//                dataType:"json",
//                success:function(data){
//                    $("#slpe_id").val(data.slpe_id);
//                    $("#year").val(data.year);
//                    $("#term").val(data.term); 
//                    $("#lesson").val(data.lesson);
//                    $("#date").val(data.date);
//                    $("#student").val(data.slpe_student_id);
//                    $("#tutor").val(data.slpe_tutor_id);
//                    $("#subject").val(data.slpe_subject_id);
//                    $("#concept").val(data.slpe_concept_id);
//                    $("#concept_hidden").val(data.slpe_concept_hidden_id);
//                    $("#concept_detail").val(data.slpe_concept_detail_id);
//                    $("#learning_activity").val(data.slpe_learning_activity_id);
//                    $("#tutor_evaluation").val(data.tutor_evaluation);
//                    $("#student_self_assessment").val(data.student_self_assessment);
//                    $("#comments_homework").val(data.comments_homework);
//                    $("#slpe_status").val(data.slpe_status);
//                    $("#academic_slpe_insert").val("Update");
//                    $("#academic_slpe_editable_modal").modal({backdrop:'static', keyboard: false});
//                    $("#academic_slpe_editable_modal").modal("show");
//                }
//            });
//        });
        //-------------------- for submit button in editable_modal --------------------//
//        $("#academic_slpe_insert_form").on("submit", function(event){
//            event.preventDefault();
//            $.ajax({
//                url:"../staff/CRUD/insert.php",
//                method:"POST",
//                data:$("#academic_slpe_insert_form").serialize(),
//                success:function(data){
//                    $("#academic_slpe_insert_form")[0].reset();
//                    $("#academic_slpe_editable_modal").modal("hide");
//                    $("#academic_slpes_table").html(data);
//                    location.reload(); //check_point: must have!
//                }
//            });
//        });
        //-------------------- for cancel button in editable_modal --------------------//
//        $("#academic_slpe_insert_cancel").on("click", function(event){
//            $("#academic_slpe_insert_form")[0].reset();
//            location.reload(); //check_point: must have!
//        });
        //-------------------- view_button --------------------//
        $(document).on("click", ".slpe_view", function(){
            var slpe_id = $(this).attr("id");
            $.ajax({
                url:"../staff/CRUD/read.php",
                method:"POST",
                data:{slpe_id:slpe_id},
                success:function(data){
                    $("#academic_slpe_details").html(data);
                    $("#academic_slpe_readonly_modal").modal("show");
                }
            });
        });
        //-------------------- delete_button --------------------//
        $(document).on("click", ".slpe_delete", function(event){
            event.preventDefault();
            var slpe_id = $(this).attr("id");
            if(confirm("Are you sure to delete this record ?")){
                $.ajax({
                    url:"../staff/CRUD/delete.php",
                    method:"POST",
                    data:{slpe_id:slpe_id},
                    success:function(){
                        location.reload();
                    }
                });
            }
        });
    }); 
</script>

<?php include "../includes/footer.php"; ?>