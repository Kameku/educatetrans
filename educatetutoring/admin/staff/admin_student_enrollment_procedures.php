<?php include "../includes/header.php"; ?>
<?php
    $query  = "SELECT admin_student_eprocedures.*";
    $query .= ", CONCAT(admin_student_registration.student_firstname, ' ', admin_student_registration.student_lastname) AS procedure_student_fullname ";
    $query .= "FROM admin_student_eprocedures ";
    $query .= "JOIN admin_student_registration ON admin_student_eprocedures.procedure_student_id = admin_student_registration.student_id ";
    $query .= "ORDER BY procedure_enquiry_id DESC";
    $select_eprocedures = mysqli_query($connection, $query);
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
                        Student Enrollment Procedures
                        <div class="pull-right">
                            <button type="button" class="btn btn-success btn-md" name="student_procedure_add" id="student_procedure_add" data-target="#student_procedure_editable_modal" data-backdrop="static" data-keyboard="false" data-toggle="modal">
                                <span><i class="fas fa-plus"></i></span>  Add New
                            </button>
                        </div>
                    </h1>
                </div>
            </div> <!-- /.row -->
            <div class="row">
                <div class="col-lg-12"  id="student_eprocedures_table">
                    <table class="table table-bordered table-striped table-hover" id="admin_student_eprocedures"> <!-- id for DataTable -->
                        <thead class="bg-primary">
                            <tr>
                                <th width="7%" class="text-center">Enquiry Id</th>
                                <th>Student Name</th>
                                <th class="text-center">Email Introduction Letter</th>
                                <th class="text-center">Holding Deposit</th>
                                <th class="text-center">PIS Date </th>
                                <th class="text-center">PIS Status</th>
                                <th class="text-center">Send Confirmation Letter</th>
                                <th width="5%" class="text-center">Id</th>
                                <th width="5%" class="text-center">View</th>
                                <th width="5%" class="text-center">Update</th>
                                <th width="5%" class="text-center">Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                while($row = mysqli_fetch_assoc($select_eprocedures)){
                                    $procedure_student_id          = $row['procedure_student_id'];
                                    $procedure_student_fullname    = $row['procedure_student_fullname'];
                                    $procedure_enquiry_id          = $row['procedure_enquiry_id'];
                                    $procedure_introduction_letter = $row['procedure_introduction_letter'];
                                    $procedure_deposit             = $row['procedure_deposit'];
                                    $procedure_pis_date            = $row['procedure_pis_date'];
                                    $procedure_pis_status          = $row['procedure_pis_status'];
                                    $procedure_confirmation        = $row['procedure_confirmation'];
                                    $procedure_id                  = $row['procedure_id'];
                            ?>
                                <tr>
                                    <td class="text-center">
                                        <span type="button" class="btn btn-info btn-xs procedure_enquiry_view" name="procedure_enquiry_view" id="<?php echo $procedure_enquiry_id; ?>">
                                            <?php echo $procedure_enquiry_id; ?>
                                        </span>
                                    </td>
                                    <td><?php echo $procedure_student_fullname; ?></td>
                                    <td class="text-center">
                                        <?php
                                            if ($procedure_introduction_letter == "Completed"){
                                                echo "<span type='button' class='btn btn-success btn-xs introduction_letter_view' name='introduction_letter_view' id='$procedure_enquiry_id'>$procedure_introduction_letter</span>";
                                            }else{
                                                echo "<span type='button' class='btn btn-warning btn-xs introduction_letter_view' name='introduction_letter_view' id='$procedure_enquiry_id'>$procedure_introduction_letter</span>";
                                            }
                                        ?>
                                    </td>
                                    <td class="text-center">
                                        <?php
                                            if ($procedure_deposit == "Received"){
                                                echo "<span class='text-success'>$procedure_deposit</span>";
                                            }else{
                                                echo "<span class='text-warning'>$procedure_deposit</span>";
                                            }
                                        ?>
                                    </td>
                                    <td class="text-center">
                                        <?php 
                                            if ($procedure_pis_date == '0000-00-00'){
                                                echo "N/A";
                                            }else{
                                                echo $procedure_pis_date;
                                            }
                                        ?>
                                    </td>
                                    <td class="text-center">
                                        <?php
                                            if ($procedure_pis_status == "Completed"){
                                                echo "<span class='text-success'>$procedure_pis_status</span>";
                                            }else if($procedure_pis_status == "Confirmed"){
                                                echo "<span class='text-primary'>$procedure_pis_status</span>";
                                            }else{
                                                echo "<span class='text-warning'>$procedure_pis_status</span>";
                                            }
                                        ?>
                                    </td>
                                    <td class="text-center">
                                        <?php
                                            if ($procedure_confirmation == "Completed"){
                                                echo "<span type='button' class='btn btn-success btn-xs confirmation_letter_view' name='confirmation_letter_view' id='$procedure_enquiry_id'>$procedure_confirmation</span>";
                                            }else{
                                                echo "<span type='button' class='btn btn-warning btn-xs confirmation_letter_view' name='confirmation_letter_view' id='$procedure_enquiry_id'>$procedure_confirmation</span>";
                                            }
                                        ?>
                                    </td>
                                    <td class="text-center"><?php echo $procedure_id; ?></td>
                                    <td class="text-center">
                                        <span type="button" class="btn btn-info btn-xs procedure_view" name="procedure_view" id="<?php echo $procedure_id; ?>">
                                            <i class='fas fa-search-plus'></i>
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <span type="button" class="btn btn-warning btn-xs procedure_update" name="procedure_update" id="<?php echo $procedure_id; ?>">
                                            <i class='far fa-edit'></i>
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <span type="button" class="btn btn-danger btn-xs procedure_delete" name="procedure_delete" id="<?php echo $procedure_id; ?>">
                                            <i class='far fa-trash-alt'></i>
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

<?php include "admin_student_enrollment_pro_modals.php"; ?>
<?php include "admin_student_enquiries_modals.php"; ?>

<!-- introduction_letters readonly_modal -->
<div class="modal fade" id="introduction_letter_readonly_modal">
    <div class="modal-dialog  modal-lg">
        <div class="modal-content">
            <div id="introduction_letter_printSection">
                <div class="modal-header bg-primary">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Introduction Letter</h4>
                </div>
                <div class="modal-body" id="introduction_letter_details">
                    <!--show data here-->
                </div>
            </div>
<!--
                <div class="modal-footer">
                    <button id="introduction_letter_btnPrint" type="button" class="btn btn-primary">Print</button>
                    <button class="btn btn-primary" data-dismiss="modal" aria-hidden="true" onclick="copy_to_clipboard()">Copy</button>
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
        $("#admin_student_eprocedures").DataTable({
            "order":[[0, "desc"]]
        }); 
        //-------------------- printing modal --------------------//
//        document.getElementById("procedure_btnPrint").onclick = function(){
//            document.getElementById("wrapper").style.display = "none";
//            printElement(document.getElementById("procedure_printSection"));
//        }
//        function printElement(elem, append, delimiter){
//            var domClone = elem.cloneNode(true);
//            var $procedure_printSection = document.getElementById("procedure_printSection");
//            if (!$procedure_printSection){
//                var $procedure_printSection = document.createElement("div");
//                $procedure_printSection.id = "procedure_printSection";
//                document.body.appendChild($procedure_printSection);
//            }
//            if (append !== true){
//                $procedure_printSection.innerHTML = "";
//            }else if (append ===true){
//                if (typeof (delimiter) === "string"){
//                    $procedure_printSection.innerHTML += delimiter;
//                }else if (typeof (delimiter) === "object"){
//                $procedure_printSection.appendChlid(delimiter);
//                }
//            }
//            $procedure_printSection.appendChild(domClone);
//            window.print();
//            location.reload();
//        }
    }); 
    //-------------------- enquiry_id_button --------------------//
    $(document).ready(function(){
        $(document).on("click", ".procedure_enquiry_view", function(){
            var enquiry_id = $(this).attr("id");
            $.ajax({
                url:"CRUD/read.php",
                method:"POST",
                data:{enquiry_id:enquiry_id},
                success:function(data){
                    $("#student_enquiry_details").html(data);
                    $("#student_enquiry_readonly_modal").modal("show");
                }
            });
        });
    });
    //-------------------- introduction_letter_button --------------------//
    $(document).ready(function(){
        $(document).on("click", ".introduction_letter_view", function(){
            var introduction_letter_id = $(this).attr("id");
            $.ajax({
                url:"CRUD/read.php",
                method:"POST",
                data:{introduction_letter_id:introduction_letter_id},
                success:function(data){
                    $("#introduction_letter_details").html(data);
                    $("#introduction_letter_readonly_modal").modal("show");
                }
            });
        });
//        function copy_to_clipboard(){
//            var copyText = document.getElementById("introduction_letter_details");
//            copyText.select();
//            document.execCommand("copy");
//            alert("Copied to clipboard!");
//        }
    });
    //++++++++++++++++++++ admin_student_eprocedures CRUD +++++++++++++++++++//
    $(document).ready(function(){
        //-------------------- add_new_button --------------------//
        $("#student_procedure_add").click(function(){
            $("#student_procedure_insert").val("Add");
            $("#student_procedure_insert_form")[0].reset();
        });
        //-------------------- update_button(fetch data) --------------------//
        $(document).on("click", ".procedure_update", function(){
            var procedure_id = $(this).attr("id");
            $.ajax({
                url:"CRUD/fetch.php",
                method:"POST",
                data:{procedure_id:procedure_id},
                dataType:"json",
                success:function(data){
                    $("#procedure_id").val(data.procedure_id);
                    $("#procedure_date").val(data.procedure_date);
                    $("#procedure_student_fullname").val(data.procedure_student_id); 
                    $("#procedure_enquiry_id").val(data.procedure_enquiry_id);
                    $("#procedure_introduction_letter").val(data.procedure_introduction_letter);
                    $("#procedure_deposit").val(data.procedure_deposit);
                    $("#procedure_pis_date").val(data.procedure_pis_date);
                    $("#procedure_pis_status").val(data.procedure_pis_status);
                    $("#procedure_enrollment").val(data.procedure_enrollment);
                    $("#procedure_schedule").val(data.procedure_schedule);
                    $("#procedure_confirmation").val(data.procedure_confirmation);
                    $("#procedure_xero").val(data.procedure_xero);
                    $("#procedure_invoice").val(data.procedure_invoice);
                    $("#procedure_ezidebit").val(data.procedure_ezidebit);
                    $("#procedure_folder").val(data.procedure_folder);
                    $("#procedure_notes").val(data.procedure_notes);
                    $("#student_procedure_insert").val("Update");
                    $("#student_procedure_editable_modal").modal({backdrop:'static', keyboard: false});
                    $("#student_procedure_editable_modal").modal("show");
                }
            });
        });
        //-------------------- for submit button in editable_modal --------------------//
        $("#student_procedure_insert_form").on("submit", function(event){
            event.preventDefault();
            $.ajax({
                url:"CRUD/insert.php",
                method:"POST",
                data:$("#student_procedure_insert_form").serialize(),
                success:function(data){
                    $("#student_procedure_insert_form")[0].reset();
                    $("#student_procedure_editable_modal").modal("hide");
                    $("#student_eprocedures_table").html(data);
                    location.reload(); //check_point: must have!
                }
            });
        });
        //-------------------- for cancel button in editable_modal --------------------//
        $("#student_procedure_insert_cancel").on("click", function(event){
            $("#student_procedure_insert_form")[0].reset();
            location.reload(); //check_point: must have!
        });
        //-------------------- view_button --------------------//
        $(document).on("click", ".procedure_view", function(){
            var procedure_id = $(this).attr("id");
            $.ajax({
                url:"CRUD/read.php",
                method:"POST",
                data:{procedure_id:procedure_id},
                success:function(data){
                    $("#student_procedure_details").html(data);
                    $("#student_procedure_readonly_modal").modal("show");
                }
            });
        });
        //-------------------- delete_button --------------------//
        $(document).on("click", ".procedure_delete", function(event){
            event.preventDefault();
            var procedure_id = $(this).attr("id");
            if(confirm("Are you sure to delete this record ?")){
                $.ajax({
                    url:"CRUD/delete.php",
                    method:"POST",
                    data:{procedure_id:procedure_id},
                    success:function(){
                        location.reload();
                    }
                });
            }
        });
    });
</script>



<script>

</script>    


<?php include "../includes/footer.php"; ?>