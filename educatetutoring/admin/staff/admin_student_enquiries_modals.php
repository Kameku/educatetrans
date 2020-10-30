<!-- editable_modal -->
<div class="modal fade" id="student_enquiry_editable_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
<!--                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>-->
                <h4 class="modal-title" id="myModalLabel">Enquiry</h4>
            </div>
            <div class="modal-body">
                <form method="post" id="student_enquiry_insert_form">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#contact" data-toggle="tab">Contact</a></li>
                        <li><a href="#previous_assessment" data-toggle="tab">Previous Assessment</a></li>
                        <li><a href="#concerns_goals" data-toggle="tab">Concerns &amp; Goals</a></li>
                        <li><a href="#notes" data-toggle="tab">Notes</a></li>
                    </ul>                            
                    <div class="tab-content">
                        <div class="tab-pane fade in active" id="contact">
                            <br />
                            <input type="hidden" name="enquiry_id" id="enquiry_id" />
                            <div class="form-group">
                                <label for="enquiry_outcome">Outcome *</label>
                                <select type="text" class="form-control" name="enquiry_outcome" id="enquiry_outcome" required>
                                    <option value="">------- Select -------</option>
                                    <?php
                                        $query = "SELECT * FROM settings_enquiry_outcome ORDER BY outcome_id ASC";
                                        $select_item = mysqli_query($connection, $query);
                                        while($row   = mysqli_fetch_assoc($select_item)){
                                            $outcome = $row['outcome'];
                                            echo "<option value='$outcome'>{$outcome}</option>";
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="enquirer_name">Enquirer Name</label>
                                <input type="text" class="form-control" name="enquirer_name" id="enquirer_name" />
                            </div>
                            <div class="form-group">
                                <label for="enquiry_student_fullname">Student Name </label>
                                <select class="form-control" name="enquiry_student_fullname" id="enquiry_student_fullname" required>
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
                                <label for="enquiry_number">Contact Number </label>
                                <input type="number" class="form-control" name="enquiry_number" id="enquiry_number" />
                            </div>
                            <div class="form-group">
                                <label for="enquiry_email">Email</label>
                                <input type="email" class="form-control" name="enquiry_email" id="enquiry_email" />
                            </div>
                        </div>
                        <div class="tab-pane fade" id="previous_assessment">
                            <br />
                            <div class="form-group">
                                <label for="enquiry_hear_about_us">Where did you hear about us?</label>
                                <select type="text" class="form-control" name="enquiry_hear_about_us" id="enquiry_hear_about_us">
                                    <option value="">------- Select -------</option>
                                    <?php
                                        $query = "SELECT * FROM settings_hearaboutus ORDER BY hearaboutus ASC";
                                        $select_item = mysqli_query($connection, $query);
                                        while($row   = mysqli_fetch_assoc($select_item)){
                                            $hearaboutus    = $row['hearaboutus'];
                                            echo "<option value='$hearaboutus'>{$hearaboutus}</option>";
                                        }
                                    ?>
                                </select>
                            </div>
<!--
                            <div class="form-group">
                                <label for="enquiry_psychologist">Has your child been assessed by a school psychologist or equivalent?</label>
                                <div class="text-right">
                                    <label class="radio-inline">
                                        <input type="radio" name="enquiry_psychologist" id="enquiry_psychologist" value="Yes" />Yes
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="enquiry_psychologist" id="enquiry_psychologist" value="No" />No
                                    </label>
                                </div>
                            </div>
-->
                            <div class="form-group">
                                <label for="enquiry_psychologist">Has your child been assessed by a school psychologist or equivalent?</label>
                                <select type="text" class="form-control" name="enquiry_psychologist" id="enquiry_psychologist">
                                    <?php
                                        $query = "SELECT * FROM settings_yesnona ORDER BY yesnona ASC";
                                        $select_item = mysqli_query($connection, $query);
                                        while($row   = mysqli_fetch_assoc($select_item)){
                                            $yesnona    = $row['yesnona'];
                                            echo "<option value='$yesnona'>{$yesnona}</option>";
                                        }
                                    ?>
                                </select>
                            </div>
<!--
                            <div class="form-group">
                                <label for="enquiry_optometrist">Has your child been assessed by an optometrist or ophthalmologist?</label>
                                <div class="text-right">
                                    <label class="radio-inline">
                                        <input type="radio" name="enquiry_optometrist" id="enquiry_optometrist" value="Yes" />Yes
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="enquiry_optometrist" id="enquiry_optometrist" value="No" />No
                                    </label>
                                </div>
                            </div>
-->
                            <div class="form-group">
                                <label for="enquiry_optometrist">Has your child been assessed by an optometrist or ophthalmologist?</label>
                                <select type="text" class="form-control" name="enquiry_optometrist" id="enquiry_optometrist">
                                    <?php
                                        $query = "SELECT * FROM settings_yesnona ORDER BY yesnona ASC";
                                        $select_item = mysqli_query($connection, $query);
                                        while($row   = mysqli_fetch_assoc($select_item)){
                                            $yesnona    = $row['yesnona'];
                                            echo "<option value='$yesnona'>{$yesnona}</option>";
                                        }
                                    ?>
                                </select>
                            </div>
<!--
                            <div class="form-group">
                                <label for="enquiry_educational_assistance">Has your child received any educational assistance prior to this time?</label>
                                <div class="text-right">
                                    <label class="radio-inline">
                                        <input type="radio" name="enquiry_educational_assistance" id="enquiry_educational_assistance" value="Yes" />Yes
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="enquiry_educational_assistance" id="enquiry_educational_assistance" value="No" />No
                                    </label>
                                </div>
                            </div>
-->
                            <div class="form-group">
                                <label for="enquiry_educational_assistance">Has your child received any educational assistance prior to this time?</label>
                                <select type="text" class="form-control" name="enquiry_educational_assistance" id="enquiry_educational_assistance">
                                    <?php
                                        $query = "SELECT * FROM settings_yesnona ORDER BY yesnona ASC";
                                        $select_item = mysqli_query($connection, $query);
                                        while($row   = mysqli_fetch_assoc($select_item)){
                                            $yesnona    = $row['yesnona'];
                                            echo "<option value='$yesnona'>{$yesnona}</option>";
                                        }
                                    ?>
                                </select>
                            </div>
                            <hr />
                            <div>
                                <p>Please bring relevant paperwork with you to parent induction if the answer to any of the three questions above is "Yes".</p>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="concerns_goals">
                            <br />
                            <div class="form-group">
                                <label for="enquiry_concerns">What are your key concerns?</label>
                                <textarea class="form-control" name="enquiry_concerns" id="enquiry_concerns" rows="6"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="enquiry_goals">What are your specific goals for tutoring?</label>
                                <textarea class="form-control" name="enquiry_goals" id="enquiry_goals" rows="6"></textarea>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="notes">
                            <br />
                            <div class="form-group">
                                <label for="enquiry_notes">Notes</label>
                                <textarea class="form-control" name="enquiry_notes" id="enquiry_notes" rows="15"></textarea>
<!--
                                <script>
                                    ClassicEditor
                                        .create( document.querySelector( '#enquiry_notes' ) ) //match point "id" in textarea
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
                        <button type="button" class="btn btn-default" data-dismiss="modal" id="student_enquiry_insert_cancel">Cancel</button>
                        <input class="btn btn-success" type="submit" name="student_enquiry_insert" id="student_enquiry_insert" value="" />
                    </div>
                </form>
            </div>
        </div> <!-- /.modal-content -->
    </div> <!-- /.modal-dialog -->
</div> <!-- /.modal -->

<!-- readonly_modal -->
<div class="modal fade" id="student_enquiry_readonly_modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div id="enquiry_printSection">
                <div class="modal-header bg-primary">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Enquiry Details</h4>
                </div>
                <div class="modal-body" id="student_enquiry_details">
                    <!--show data here-->
                </div>
            </div>
<!--
                <div class="modal-footer">
                    <button id="enquiry_btnPrint" type="button" class="btn btn-primary">Print</button>
                    <button class="btn btn-default" data-dismiss="modal" aria-hidden="true">Close</button>
                </div>
-->
        </div>
    </div>
</div>