<?php include "header.php"; ?>

<div id="wrapper">
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Test Log</h1>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">            
                    <div class="panel-group" id="panel1">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#panel1" href="#body1">Datepicker</a>
                                </h4>
                            </div>
                            <div id="body1" class="panel-collapse collapse in">
                                <div class="panel-body">
                                    <h4>Test Notes</h4>
                                    <ul>
                                        <li><p>Past test and added on 20180507.</p></li>
                                        <li><p>Required in header to run:</p></li>
                                        <ul>
                                            <li><p>href="filepath/datepicker/css/datepicker.css" rel="stylesheet"</p></li>
                                            <li><p>src="filepath/datepicker/js/bootstrap-datepicker.js"</p></li>
                                        </ul>
                                        <li><p>.datepicker</p></li>
                                        <li><p>Javascript at the end of the page.</p></li>
                                        <li><p>Added "z-index" in datepicker.css to bring the picker in the front if used in modal.</p></li>
                                    </ul>
                                    <hr>
                                    <h4>Tested Item</h4>
                                    <form method="post" action="">
                                        Date <input class="form-control datepicker" name="event_date" readonly type="text">
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="panel-group" id="panel2">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#panel2" href="#body2">Duplicate Input</a>
                                </h4>
                            </div>
                            <div id="body2" class="panel-collapse collapse in">
                                <div class="panel-body">
                                    <h4>Test Notes</h4>
                                    <ul>
                                        <li><p>Past test and added on 20180508.</p></li>
                                        <li><p>Javascript at the end of the page.</p></li>
                                    </ul>
                                    <hr>
                                    <h4>Tested Item</h4>
                                    <form method="post" action="" id="duplicate_input">
                                        Input 1 <input class="form-control" id="input1" name="item1" type="text">
                                        Input 2 <input class="form-control" id="input2" name="item2" readonly type="text" >
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="panel-group" id="panel3">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#panel3" href="#body3">Float Label</a>
                                </h4>
                            </div>
                            <div id="body3" class="panel-collapse collapse in">
                                <div class="panel-body">
                                    <h4>Test Notes</h4>
                                    <ul>
                                        <li><p>Past test and added on 20180508.</p></li>
                                        <li><p>Required in header to run:</p></li>
                                        <ul>
                                            <li><p>href="filepath/bootstrap-float-label-master/bootstrap-float-label.css" rel="stylesheet"</p></li>
                                            <li><p>src="filepath/bootstrap-float-label-master/bootstrap-float-label.js"</p></li>
                                        </ul>
                                        <li><p>.float-label</p></li>
                                        <li><p>Javascript at the end of the page.</p></li>
                                    </ul>
                                    <hr>
                                    <h4>Tested Item</h4>
                                    <form>
                                        <div class="form-group float-label">
                                            <label for="float_label_example1">Username</label>
                                            <input class="form-control" id="float_label_example1" type="text">
                                        </div>
                                        <div class="form-group float-label">
                                            <label for="float_label_example2">Email</label>
                                            <input class="form-control" id="float_label_example2" type="email">                                            
                                        </div>
                                    </form>                                    
                                </div>
                            </div>
                        </div>
                    </div><!-- bootstrap-float-label -->
                    
                    <div class="panel-group" id="panel4">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#panel4" href="#body4">jqBootstrapValidation</a>
                                </h4>
                            </div>
                            <div id="body4" class="panel-collapse collapse in">
                                <div class="panel-body">
                                    <h4>Test Notes</h4>
                                    <ul>
                                        <li><p>Past test and added on .</p></li>
                                        <li><p>Required in header to run:</p></li>
                                        <ul>
                                            <li><p></p></li>
                                            <li><p></p></li>
                                        </ul>
                                        <li><p></p></li>
                                        <li><p>Javascript at the end of the page.</p></li>
                                    </ul>
                                    <hr>
                                    <h4>Tested Item</h4>
                                    <form class="form-horizontal">
                                        <div class="control-group">
                                            <label class="control-label">Username</label>
                                            <div class="controls">
                                                <input class="form-control" type="text" required />
                                                <p class="help-block"></p>
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">Email</label>
                                            <div class="controls">
                                                <input class="form-control" type="email" required />
                                                <p class="help-block"></p>
                                            </div>                                      
                                        </div>
                                        <div class="control-group text-right">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                            <input class="btn btn-success" type="submit" name="" value="Save" />
                                        </div>   
                                    </form>                                     
                                </div>
                            </div>
                        </div>
                    </div><!-- template -->    
                    
                    <div class="panel-group" id="panel5">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#panel5" href="#body5">Test Template</a>
                                </h4>
                            </div>
                            <div id="body5" class="panel-collapse collapse in">
                                <div class="panel-body">
                                    <h4>Test Notes</h4>
                                    <ul>
                                        <li><p>Past test and added on .</p></li>
                                        <li><p>Required in header to run:</p></li>
                                        <ul>
                                            <li><p></p></li>
                                            <li><p></p></li>
                                        </ul>
                                        <li><p></p></li>
                                        <li><p>Javascript at the end of the page.</p></li>
                                    </ul>
                                    <hr>
                                    <h4>Tested Item</h4>
                                        
                                </div>
                            </div>
                        </div>
                    </div><!-- template -->                                                        
                 
                </div> <!-- col-lg-12 -->
            </div> <!-- /.row --> 
        </div> <!-- /.container-fluid -->
    </div> <!-- /#page-wrapper -->
</div> <!-- /#wrapper -->


<script type="text/javascript">
    //datepicker
    $('.datepicker').datepicker({
        weekStart: 1,
        format: 'yyyy-mm-dd'
    })
    
    //Duplicate Input
    var input2 = document.getElementById("input2");
    $("#input1").keyup(function() {
        input2.value = this.value;
    });
//    $("#input1").blur(function() {
//        $input2.val( this.value );
//    });
    
    //bootstrap-float-label
    $.bootstrapFloatLabel();
    
    //jqBootstrapValidation
    $(function() {
        $("input,select,textarea").not("[type=submit]").jqBootstrapValidation(); 
    });
</script>

<?php include "footer.php"; ?>