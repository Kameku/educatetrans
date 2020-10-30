<!-- editable_modal -->
<div class="modal fade" id="student_procedure_editable_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
<!--                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>-->
                <h4 class="modal-title" id="myModalLabel">Student Enrollment Procedure</h4>
            </div>
            <div class="modal-body">
                <form method="post" id="student_procedure_insert_form">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#pre_induction" data-toggle="tab">Pre Parent Induction</a></li>
                        <li><a href="#post_induction" data-toggle="tab">Post Parent Induction</a></li>
                        <li><a href="#notes" data-toggle="tab">Notes</a></li>
                    </ul>                            
                    <div class="tab-content">
                        <div class="tab-pane fade in active" id="pre_induction">
                            <br />
                            <input type="hidden" name="procedure_id" id="procedure_id" />
                            <div class="form-group">
                                <label for="procedure_date">Date Created</label>
                                <input type="text" class="form-control datepicker" name="procedure_date" id="procedure_date" value="<?php echo date("Y/m/d")?>" readonly />
                            </div>
                            <div class="form-group">
                                <label for="procedure_student_fullname">Student Name </label>
                                <select class="form-control" name="procedure_student_fullname" id="procedure_student_fullname" required>
                                    <option value="">------- Select -------</option>
                                    <?php
                                        $query = "SELECT student_id, CONCAT(admin_student_registration.student_firstname, ' ', admin_student_registration.student_lastname) AS student_fullname FROM admin_student_registration ORDER BY student_fullname ASC";
                                        $select_student_fullname = mysqli_query($connection, $query);
                                        while($row   = mysqli_fetch_assoc($select_student_fullname)){
                                            $student_id       = $row['student_id'];
                                            $student_fullname = $row['student_fullname'];
                                            echo "<option value='$student_id'>{$student_fullname}</option>";
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="procedure_enquiry_id">Enquiry ID</label>
                                <input type="number" class="form-control" name="procedure_enquiry_id" id="procedure_enquiry_id" value="" />
                            </div>
                            <div class="form-group">
                                <label for="procedure_introduction_letter">Email Introduction Letter</label>
                                <select type="text" class="form-control" name="procedure_introduction_letter" id="procedure_introduction_letter">
                                    <option value="To Be Completed">To Be Completed</option>
                                    <option value="Completed">Completed</option>
                                    <option value="N/A">N/A</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="procedure_deposit">Holding Deposit</label>
                                <select type="text" class="form-control" name="procedure_deposit" id="procedure_deposit">
                                    <option value="N/A">N/A</option>
                                    <option value="Received">Received</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="procedure_pis_date">Parent Information Session Date</label>
                                <input type="text" class="form-control datepicker" name="procedure_pis_date" id="procedure_pis_date" value="" readonly />
                            </div>
                            <div class="form-group">
                                <label for="procedure_pis_status">Parent Information Session Status</label>
                                <select type="text" class="form-control" name="procedure_pis_status" id="procedure_pis_status">
                                    <option value="">------- Select -------</option>
                                    <?php
                                        $query = "SELECT * FROM settings_pis_status ORDER BY pis_id ASC";
                                        $select_item = mysqli_query($connection, $query);
                                        while($row   = mysqli_fetch_assoc($select_item)){
                                            $pis_status    = $row['pis_status'];
                                            echo "<option value='$pis_status'>{$pis_status}</option>";
                                        }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="post_induction">
                            <br />
                            <div class="form-group">
                                <label for="procedure_enrollment">Enrollment Form data entry</label>
                                <select type="text" class="form-control" name="procedure_enrollment" id="procedure_enrollment">
                                    <option value="To Be Completed">To Be Completed</option>
                                    <option value="Completed">Completed</option>
                                    <option value="N/A">N/A</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="procedure_schedule">Schedule data entry</label>
                                <select type="text" class="form-control" name="procedure_schedule" id="procedure_schedule">
                                    <option value="To Be Completed">To Be Completed</option>
                                    <option value="Completed">Completed</option>
                                    <option value="N/A">N/A</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="procedure_confirmation">Send Enrollment Confirmation Letter</label>
                                <select type="text" class="form-control" name="procedure_confirmation" id="procedure_confirmation">
                                    <option value="To Be Completed">To Be Completed</option>
                                    <option value="Completed">Completed</option>
                                    <option value="N/A">N/A</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="procedure_xero">Xero data entry</label>
                                <select type="text" class="form-control" name="procedure_xero" id="procedure_xero">
                                    <option value="To Be Completed">To Be Completed</option>
                                    <option value="Completed">Completed</option>
                                    <option value="N/A">N/A</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="procedure_invoice">Create term invoice</label>
                                <select type="text" class="form-control" name="procedure_invoice" id="procedure_invoice">
                                    <option value="To Be Completed">To Be Completed</option>
                                    <option value="Completed">Completed</option>
                                    <option value="N/A">N/A</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="procedure_ezidebit">Ezidebit data entry</label>
                                <select type="text" class="form-control" name="procedure_ezidebit" id="procedure_ezidebit">
                                    <option value="To Be Completed">To Be Completed</option>
                                    <option value="Completed">Completed</option>
                                    <option value="N/A">N/A</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="procedure_folder">Create student folder and place on tutor's shelf</label>
                                <select type="text" class="form-control" name="procedure_folder" id="procedure_folder">
                                    <option value="To Be Completed">To Be Completed</option>
                                    <option value="Completed">Completed</option>
                                    <option value="N/A">N/A</option>
                                </select>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="notes">
                            <br />
                            <div class="form-group">
                                <label for="procedure_notes">Notes</label>
                                <textarea class="form-control" name="procedure_notes" id="procedure_notes" rows="15"></textarea>
<!--
                                <script>
                                    ClassicEditor
                                        .create( document.querySelector( '#procedure_notes' ) ) //match point "id" in textarea
                                        .catch( error => {
                                            console.error( error );
                                        } );
                                </script>
-->
                            </div>
                        </div>
                    </div>
                    <hr />
                    <div class="form-group text-right">
                        <button type="button" class="btn btn-default" data-dismiss="modal" id="student_procedure_insert_cancel">Cancel</button>
                        <input class="btn btn-success" type="submit" name="student_procedure_insert" id="student_procedure_insert" value="" />
                    </div>
                </form>
            </div>
        </div> <!-- /.modal-content -->
    </div> <!-- /.modal-dialog -->
</div> <!-- /.modal -->

<!-- readonly_modal -->
<div class="modal fade" id="student_procedure_readonly_modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div id="procedure_printSection">
                <div class="modal-header bg-primary">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Student Enrollment Procedure Details</h4>
                </div>
                <div class="modal-body" id="student_procedure_details">
                    <!--show data here-->
                </div>
            </div>
<!--
                <div class="modal-footer">
                    <button id="procedure_btnPrint" type="button" class="btn btn-primary">Print</button>
                    <button class="btn btn-default" data-dismiss="modal" aria-hidden="true">Close</button>
                </div>
-->
        </div>
    </div>
</div>