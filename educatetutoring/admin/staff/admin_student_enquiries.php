<?php include "../includes/header.php"; ?>
<?php
    $query  = "SELECT admin_student_enquiries.*";
    $query .= ", CONCAT(admin_student_registration.student_firstname, ' ', admin_student_registration.student_lastname) AS enquiry_student_fullname ";
    $query .= "FROM admin_student_enquiries ";
    $query .= "JOIN admin_student_registration ON admin_student_enquiries.enquiry_student_id = admin_student_registration.student_id ";
    $query .= "ORDER BY enquiry_date DESC, enquiry_student_fullname ASC";
    $select_enquiries  = mysqli_query($connection, $query);
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
                        Student Enquiries
                        <div class="pull-right">
                            <button type="button" class="btn btn-success btn-md" name="student_enquiry_add" id="student_enquiry_add" data-target="#student_enquiry_editable_modal" data-backdrop="static" data-keyboard="false" data-toggle="modal">
                                <span><i class="fas fa-plus"></i></span>  Add New
                            </button>
                        </div>
                    </h1>
                </div>
            </div> <!-- /.row -->
            <div class="row">
                <div class="col-lg-12"  id="student_enquiries_table">
                    <table class="table table-bordered table-striped table-hover" id="admin_student_enquiries"> <!-- id for DataTable -->
                        <thead class="bg-primary">
                            <tr>
                                <th>Date</th>
                                <th>Student Name</th>       
                                <th>Enquirer Name</th>
                                <th class="text-center">Contact Number</th>
                                <th class="text-center">Email</th>
                                <th width="10%" class="text-center">Outcome</th>
                                <th width="5%" class="text-center">Id</th>
                                <th width="5%" class="text-center">View</th>
                                <th width="5%" class="text-center">Update</th>
                                <th width="5%" class="text-center">Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                while($row = mysqli_fetch_assoc($select_enquiries)){
                                    $enquiry_id               = $row['enquiry_id'];
                                    $enquiry_date             = $row['enquiry_date'];
                                    $enquiry_student_fullname = $row['enquiry_student_fullname'];
                                    $enquirer_name            = $row['enquirer_name'];
                                    $enquiry_number           = $row['enquiry_number'];
                                    $enquiry_email            = $row['enquiry_email'];
                                    $enquiry_outcome          = $row['enquiry_outcome'];
                            ?>
                                <tr>
                                    <?php
                                        if ($enquiry_outcome == "Need Follow-up"){
                                            echo "<td><strong>$enquiry_date</strong></td>";
                                            echo "<td><strong>$enquiry_student_fullname</strong></td>";
                                            echo "<td><strong>$enquirer_name</strong></td>";
                                            echo "<td class='text-center'><strong>$enquiry_number</strong></td>";
                                            echo "<td><strong><a href='mailto:$enquiry_email'>$enquiry_email</a></strong></td>";
                                        }else{
                                            echo "<td>$enquiry_date</td>";
                                            echo "<td>$enquiry_student_fullname</td>";
                                            echo "<td>$enquirer_name</td>";
                                            echo "<td class='text-center'>$enquiry_number</td>";
                                            echo "<td><a href='mailto:$enquiry_email'>$enquiry_email</a></td>";
                                        }
                                    ?>
                                    <td class="text-center">
                                        <?php
                                            if ($enquiry_outcome == "Need Follow-up"){
                                                echo "<span type='button' class='btn-warning btn-block enquiry_outcome'>$enquiry_outcome</span>";
                                            }else if($enquiry_outcome == "Enrolled" || $enquiry_outcome == "Completed/Resolved"){
                                                echo "<span type='button' class='btn-success btn-block enquiry_outcome'>$enquiry_outcome</span>";
                                            }else if($enquiry_outcome == "Ceased"){
                                                echo "<span type='button' class='btn-danger btn-block enquiry_outcome'>$enquiry_outcome</span>";
                                            }else{
                                                echo "<span type='button' class='btn-default btn-block enquiry_outcome'>$enquiry_outcome</span>";
                                            }
                                        ?>
                                    </td>
                                    <?php
                                        if ($enquiry_outcome == "Need Follow-up"){
                                            echo "<td class='text-center'><strong>$enquiry_id</strong></td>";
                                        }else{
                                            echo "<td class='text-center'>$enquiry_id</td>";
                                        }
                                    ?>
                                    <td class="text-center">
                                        <span type="button" class="btn btn-info btn-xs enquiry_view" name="enquiry_view" id="<?php echo $enquiry_id; ?>">
                                            <i class='fas fa-search-plus'></i>
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <span type="button" class="btn btn-warning btn-xs enquiry_update" name="enquiry_update" id="<?php echo $enquiry_id; ?>">
                                            <i class='far fa-edit'></i>
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <span type="button" class="btn btn-danger btn-xs enquiry_delete" name="enquiry_delete" id="<?php echo $enquiry_id; ?>">
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

<?php include "admin_student_enquiries_modals.php"; ?>

<script>
    $(document).ready(function(){
        //-------------------- datepicker --------------------//
        $(".datepicker").datepicker({
            weekStart: 1,
            format: "yyyy-mm-dd",
        })
        //-------------------- DataTable --------------------//
        $("#admin_student_enquiries").DataTable({
            "order":[[0, "desc"]]
        }); 
        //-------------------- printing modal --------------------//
//        document.getElementById("enquiry_btnPrint").onclick = function(){
//            document.getElementById("wrapper").style.display = "none";
//            printElement(document.getElementById("enquiry_printSection"));
//        }
//        function printElement(elem, append, delimiter){
//            var domClone = elem.cloneNode(true);
//            var $enquiry_printSection = document.getElementById("enquiry_printSection");
//            if (!$enquiry_printSection){
//                var $enquiry_printSection = document.createElement("div");
//                $enquiry_printSection.id = "enquiry_printSection";
//                document.body.appendChild($enquiry_printSection);
//            }
//            if (append !== true){
//                $enquiry_printSection.innerHTML = "";
//            }else if (append ===true){
//                if (typeof (delimiter) === "string"){
//                    $enquiry_printSection.innerHTML += delimiter;
//                }else if (typeof (delimiter) === "object"){
//                $enquiry_printSection.appendChlid(delimiter);
//                }
//            }
//            $enquiry_printSection.appendChild(domClone);
//            window.print();
//            location.reload();
//        }
    });
    //++++++++++++++++++++ admin_student_enquiries CRUD +++++++++++++++++++//
    $(document).ready(function(){
        //-------------------- add_new_button --------------------//
        $("#student_enquiry_add").click(function(){
            $("#student_enquiry_insert").val("Add");
            $("#student_enquiry_insert_form")[0].reset();
        });
        //-------------------- update_button(fetch data) --------------------//
        $(document).on("click", ".enquiry_update", function(){
            var enquiry_id = $(this).attr("id");
            $.ajax({
                url:"CRUD/fetch.php",
                method:"POST",
                data:{enquiry_id:enquiry_id},
                dataType:"json",
                success:function(data){
                    $("#enquiry_id").val(data.enquiry_id);
                    $("#enquiry_outcome").val(data.enquiry_outcome);
                    $("#enquiry_date").val(data.enquiry_date);
                    $("#enquirer_name").val(data.enquirer_name);
                    $("#enquiry_student_fullname").val(data.enquiry_student_id); 
                    $("#enquiry_number").val(data.enquiry_number);
                    $("#enquiry_email").val(data.enquiry_email);
                    $("#enquiry_hear_about_us").val(data.enquiry_hear_about_us);
                    $("#enquiry_psychologist").val(data.enquiry_psychologist);
                    $("#enquiry_optometrist").val(data.enquiry_optometrist);
                    $("#enquiry_educational_assistance").val(data.enquiry_educational_assistance);
                    $("#enquiry_concerns").val(data.enquiry_concerns);
                    $("#enquiry_goals").val(data.enquiry_goals);
                    $("#enquiry_notes").val(data.enquiry_notes);
                    $("#student_enquiry_insert").val("Update");
                    $("#student_enquiry_editable_modal").modal({backdrop:'static', keyboard: false});
                    $("#student_enquiry_editable_modal").modal("show");
                }
            });
        });
        //-------------------- for submit button in editable_modal --------------------//
        $("#student_enquiry_insert_form").on("submit", function(event){
            event.preventDefault();
            $.ajax({
                url:"CRUD/insert.php",
                method:"POST",
                data:$("#student_enquiry_insert_form").serialize(),
                success:function(data){
                    $("#student_enquiry_insert_form")[0].reset();
                    $("#student_enquiry_editable_modal").modal("hide");
                    $("#student_enquiries_table").html(data);
                    location.reload(); //check_point: must have!
                }
            });
        });
        //-------------------- for cancel button in editable_modal --------------------//
        $("#student_enquiry_insert_cancel").on("click", function(event){
            $("#student_enquiry_insert_form")[0].reset();
            location.reload(); //check_point: must have!
        });
        //-------------------- view_button --------------------//
        $(document).on("click", ".enquiry_view", function(){
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
        //-------------------- delete_button --------------------//
        $(document).on("click", ".enquiry_delete", function(event){
            event.preventDefault();
            var enquiry_id = $(this).attr("id");
            if(confirm("Are you sure to delete this record ?")){
                $.ajax({
                    url:"CRUD/delete.php",
                    method:"POST",
                    data:{enquiry_id:enquiry_id},
                    success:function(){
                        location.reload();
                    }
                });
            }
        });
    });      
</script>

<?php include "../includes/footer.php"; ?>