<!-- editable_modal -->
<div class="modal fade" id="admin_task_editable_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
<!--                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>-->
                <h4 class="modal-title" id="myModalLabel">My Task</h4>
            </div>
            <div class="modal-body">
                <form method="post" id="admin_task_insert_form">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#task" data-toggle="tab">Task</a></li>
                        <li><a href="#information" data-toggle="tab">Other Input</a></li>
                    </ul>                            
                    <div class="tab-content">
                        <div class="tab-pane fade in active" id="task">
                            <br />
                            <input type="hidden" name="task_id" id="task_id" />
                            <div class="form-group">
                                <label for="task_title">Title *</label>
                                <input type="text" class="form-control" name="task_title" id="task_title" required/>
                            </div>
                            <div class="form-group">
                                <label for="task_content">Content</label>
                                <textarea class="form-control" name="task_content" id="task_content" rows="5"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="task_notes">Notes</label>
                                <textarea class="form-control" name="task_notes" id="task_notes" rows="5"></textarea>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="information">
                            <br />
                            <input type="hidden" name="task_date_created" id="task_date_created" />
                            <div class="form-group">
                                <label for="task_group">Group</label>
                                <select class="form-control" name="task_group" id="task_group">
                                    <option value="General">General</option>
                                    <option value="Student">Student</option>
                                    <option value="Employee">Employee</option>
                                    <option value="Financial">Financial</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="task_priority">Priority</label>
                                <select class="form-control" name="task_priority" id="task_priority">
                                    <option value="Low">Low</option>
                                    <option value="Medium">Medium</option>
                                    <option value="High">High</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="task_date_due">Due Date</label>
                                <input type="text" class="form-control datepicker" name="task_date_due" id="task_date_due" readonly />
                            </div>
                            <div class="form-group">
                                <?php $task_from = $_SESSION["user_employee_id"]; ?>
                                <input type="hidden" name="task_from_fullname" id="task_from_fullname" value="<?php echo $task_from; ?>" />
                                <label for="task_to_fullname">Sign To</label>
                                <select class="form-control" name="task_to_fullname" id="task_to_fullname">
                                    <option value="<?php echo $task_from; ?>">Myself</option>
                                    <?php
                                        $query  = "SELECT *, CONCAT(employee_firstname, ' ', employee_lastname) AS employee_fullname FROM admin_employees ";
                                        $query .= "ORDER BY employee_fullname ASC";
                                        $select_employee_fullname = mysqli_query($connection, $query);
                                        while($row                = mysqli_fetch_assoc($select_employee_fullname)){
                                            $employee_id          = $row['employee_id'];
                                            $employee_fullname    = $row['employee_fullname'];
                                            echo "<option value='$employee_id'>{$employee_fullname}</option>";
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="task_status">Status</label>
                                <select class="form-control" name="task_status" id="task_status">
                                    <option value="0%">0% completed</option>
                                    <option value="25%">25% completed</option>
                                    <option value="50%">50% completed</option>
                                    <option value="75%">75% completed</option>
                                    <option value="100%">100% completed</option>
                                </select>
                            </div>
                            <hr />
                        </div>
                    </div>
                    <div class="form-group text-right">
                        <button type="button" class="btn btn-default" data-dismiss="modal" id="admin_task_insert_cancel">Cancel</button>
                        <input class="btn btn-success" type="submit" name="admin_task_insert" id="admin_task_insert" value="" />
                    </div>
                </form>
            </div>
        </div> <!-- /.modal-content -->
    </div> <!-- /.modal-dialog -->
</div> <!-- /.modal -->

<!-- readonly_modal -->
<div class="modal fade" id="admin_task_readonly_modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div id="task_printSection">
                <div class="modal-header bg-primary">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Task Details</h4>
                </div>
                <div class="modal-body" id="admin_task_details">
                    <!--show data here-->
                </div>
            </div>
<!--
                <div class="modal-footer">
                    <button id="task_btnPrint" type="button" class="btn btn-primary">Print</button>
                    <button class="btn btn-default" data-dismiss="modal" aria-hidden="true">Close</button>
                </div>
-->
        </div>
    </div>
</div>