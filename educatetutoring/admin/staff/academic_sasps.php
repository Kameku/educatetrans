<?php include "../includes/header.php"; ?>
<?php
    $query  = "SELECT academic_sasps.*";
    $query .= ", CONCAT(admin_student_registration.student_firstname, ' ', admin_student_registration.student_lastname) AS sasp_student";
    $query .= ", CONCAT(admin_employees.employee_firstname, ' ', admin_employees.employee_lastname) AS sasp_tutor ";
    $query .= "FROM academic_sasps ";
    $query .= "JOIN admin_student_registration ON academic_sasps.sasp_student_id = admin_student_registration.student_id ";
    $query .= "JOIN admin_employees ON academic_sasps.sasp_tutor_id = admin_employees.employee_id ";
    $query .= "ORDER BY sasp_year DESC, sasp_term DESC, sasp_lesson DESC, sasp_scheduled_date DESC, sasp_student ASC";
    $select_sasps  = mysqli_query($connection, $query);
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
                        Student Attendance &amp; Service Provisions
                    </h1>
                </div>
            </div> <!-- /.row -->
            <div class="row">
                <div class="col-lg-12"  id="academic_saspss_table">
                    <table class="table table-bordered table-striped table-hover" id="academic_sasps"> <!-- id for DataTable -->
                        <thead class="bg-primary">
                            <tr>
                                <th width="10%">Date Scheduled</th>
                                <th width="4%" class="text-center">Term</th>
                                <th width="4%" class="text-center">Lesson</th>
                                <th width="10%" class="text-center">Schedule Date</th>
                                <th width="10%"class="text-center">Schedule Time</th>
                                <th width="12%">Student</th>
                                <th>Attendance</th>
                                <th>Weekly Lesson</th>
                                <th width="5%">Status</th>
                                <th width="4%" class="text-center">Id</th>
                                <th width="5%" class="text-center">View</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                while($row = mysqli_fetch_assoc($select_sasps)){
                                    $sasp_id               = $row['sasp_id'];
                                    $sasp_year             = $row['sasp_year'];
                                    $sasp_scheduled_date   = $row['sasp_scheduled_date'];
                                    $sasp_term             = $row['sasp_term'];
                                    $sasp_student          = $row['sasp_student'];
                                    $sasp_lesson           = $row['sasp_lesson'];
                                    $sasp_scheduled_date   = $row['sasp_scheduled_date'];
                                    $sasp_scheduled_time   = $row['sasp_scheduled_time'];
                                    $sasp_attendance       = $row['sasp_attendance'];
                                    $sasp_weekly_lesson    = $row['sasp_weekly_lesson'];
                                    $sasp_status           = $row['sasp_status'];
                            ?>
                                <tr>
                                    <td><?php echo $sasp_scheduled_date; ?></td>
                                    <td class="text-center"><?php echo $sasp_term; ?></td>
                                    <td class="text-center"><?php echo $sasp_lesson; ?></td>
                                    <td class="text-center"><?php echo $sasp_scheduled_date; ?></td>
                                    <td class="text-center"><?php echo $sasp_scheduled_time; ?></td>
                                    <td><?php echo $sasp_student; ?></td>
                                    <td><?php echo $sasp_attendance; ?></td>
                                    <td><?php echo $sasp_weekly_lesson; ?></td>
                                    <td class="text-center">
                                        <?php
                                            if ($sasp_status == "Posted"){
                                                echo "<span type='button' class='btn-success btn-block'>$sasp_status</span>";
                                            }else{
                                                echo "<span type='button' class='btn-warning btn-block'>$sasp_status</span>";
                                            }
                                        ?>
                                    </td>
                                    <td class="text-center"><?php echo $sasp_id; ?></td>
                                    <td class="text-center">
                                        <span type="button" class="btn btn-info btn-xs sasp_view" name="sasp_view" id="<?php echo $row['sasp_id']; ?>">
                                            <i class='fas fa-search-plus'></i>
                                        </span>
                                    </td>
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
<div class="modal fade" id="academic_sasps_readonly_modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div id="sasp_printSection">
                <div class="modal-header bg-primary">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Student Attendance &amp; Service Provision</h4>
                </div>
                <div class="modal-body" id="academic_sasps_details">
                    <!--show data here-->
                </div>
            </div>
<!--
                <div class="modal-footer">
                    <button id="sasp_btnPrint" type="button" class="btn btn-primary">Print</button>
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
        })
        //-------------------- DataTable --------------------//
        $("#academic_sasps").DataTable({
            "order":[[0, "desc"]]
        }); 
        //-------------------- printing modal --------------------//
//        document.getElementById("sasp_btnPrint").onclick = function(){
//            document.getElementById("wrapper").style.display = "none";
//            printElement(document.getElementById("sasp_printSection"));
//        }
//        function printElement(elem, append, delimiter){
//            var domClone = elem.cloneNode(true);
//            var $sasp_printSection = document.getElementById("sasp_printSection");
//            if (!$sasp_printSection){
//                var $sasp_printSection = document.createElement("div");
//                $sasp_printSection.id = "sasp_printSection";
//                document.body.appendChild($sasp_printSection);
//            }
//            if (append !== true){
//                $sasp_printSection.innerHTML = "";
//            }else if (append ===true){
//                if (typeof (delimiter) === "string"){
//                    $sasp_printSection.innerHTML += delimiter;
//                }else if (typeof (delimiter) === "object"){
//                $sasp_printSection.appendChlid(delimiter);
//                }
//            }
//            $sasp_printSection.appendChild(domClone);
//            window.print();
//            location.reload();
//        }
    }); 
    
    //++++++++++++++++++++ academic_sasps CRUD +++++++++++++++++++//
    $(document).ready(function(){
        //-------------------- view_button --------------------//
        $(document).on("click", ".sasp_view", function(){
            var sasp_id = $(this).attr("id");
            $.ajax({
                url:"CRUD/read.php",
                method:"POST",
                data:{sasp_id:sasp_id},
                success:function(data){
                    $("#academic_sasps_details").html(data);
                    $("#academic_sasps_readonly_modal").modal("show");
                }
            });
        });
    });      
</script>

<?php include "../includes/footer.php"; ?>