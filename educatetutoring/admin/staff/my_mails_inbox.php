<?php include "../includes/header.php"; ?>
<?php
 
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
                        My Mails: Inbox
                        <div class="pull-right">
<!--                            <a href="my_mails_compose.php" class="btn btn-success btn-md" name="mail_compose" id="mail_compose">-->
                            <a href="#compose_mail_modal" class="btn btn-success btn-md" name="btn_compose_mail" id="btn_compose_mail" data-backdrop="static" data-keyboard="false" data-toggle="modal">
                                <span><i class="fas fa-pencil-alt"></i></span> Compose
                            </a>
                        </div>
                    </h1>
                </div>
            </div> <!-- /.row -->
            <div class="row">
                <div class="col-lg-2">
                    <div class="mail_sidemenu">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <ul class="nav" id="side-menu">
                                    <li>
                                        <a href="my_mails_inbox.php">
                                            <i class="fas fa-inbox"></i> Inbox &nbsp; <sup><span class="label label-danger">2</span></sup>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="my_mails_drafts.php">
                                            <span><i class="far fa-file"></i></span> Drafts
                                        </a>
                                    </li>
                                    <li>
                                        <a href="my_mails_sent.php">
                                            <span><i class="far fa-paper-plane"></i></span> Sent Mails
                                        </a>
                                    </li>
                                    <hr />
                                    <li>
                                        <a href="#">
                                            <span><i class="fas fa-arrow-right"></i></span> Frequent mailing list
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#compose_mail_modal" id="btn_compose_frequent" data-backdrop="static" data-keyboard="false" data-toggle="modal">&nbsp;&nbsp;&nbsp;&nbsp;Katrina</a>
                                    </li>
                                    <li>
                                        <a href="#compose_mail_modal" id="btn_compose_frequent" data-backdrop="static" data-keyboard="false" data-toggle="modal">&nbsp;&nbsp;&nbsp;&nbsp;Jenni</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-10"  id="mail_content">
                    <div class="inbox-body">
<!--
                        <div class="mail_option">
                            <div class="select_all">
                                <input type="checkbox" class="mail-checkbox mail-group-checkbox">
                                <div class="btn-group">
                                    <a data-toggle="dropdown" href="#" class="btn mini all" aria-expanded="false"><i class="fa fa-angle-down"></i></a>
                                    <ul class="dropdown-menu">
                                        <li><a href="#"> All</a></li>
                                        <li><a href="#"> None</a></li>
                                        <li><a href="#"> Read</a></li>
                                        <li><a href="#"> Unread</a></li>
                                    </ul> &nbsp;
                                        <button type="button" class="btn btn-default btn-xs" name="btn_refresh_mails" id="btn_refresh_mails">
                                            <span><i class="fas fa-sync"></i></span>  Refresh
                                        </button>
                                </div>
                            </div>
                        </div>
-->
                        <table class="table table-inbox table-hover" id="mails_inbox">
                            <thead class="bg-primary">
                                <tr>
                                    <th></th>
                                    <th>Title</th>
                                    <th width="5%">Priority</th>     
                                    <th>Contents</th>
                                    <th>Attachment</th>
                                    <th class="text-right">Time Received</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="unread">
                                    <td class="inbox-small-cells">
                                        <input type="checkbox" class="mail-checkbox">
                                    </td>
<!--                                    <td class="inbox-small-cells"><i class="fa fa-star"></i></td>-->
                                    <td class="view-message  dont-show">PHPClass</td>
                                    <td><span class="label label-danger">High</span></td>
                                    <td class="view-message ">Added a new class: Login Class Fast Site</td>
                                    <td class="view-message  inbox-small-cells"><i class="fa fa-paperclip"></i></td>
                                    <td class="view-message  text-right">9:27 AM</td>
                                </tr>
                                <tr class="unread">
                                    <td class="inbox-small-cells">
                                        <input type="checkbox" class="mail-checkbox">
                                    </td>
<!--                                  <td class="inbox-small-cells"><i class="fa fa-star"></i></td>-->
                                    <td class="view-message dont-show">Google Webmaster </td>
                                    <td><span class="label label-warning">Medium</span></td>
                                    <td class="view-message">Improve the search presence of WebSite</td>
                                    <td class="view-message inbox-small-cells"></td>
                                    <td class="view-message text-right">March 15</td>
                                </tr>
                                <tr class="">
                                    <td class="inbox-small-cells">
                                        <input type="checkbox" class="mail-checkbox">
                                    </td>
<!--                                  <td class="inbox-small-cells"><i class="fa fa-star inbox-started"></i></td>-->
                                    <td class="view-message dont-show">Freelancer.com</td>
                                    <td><span class="label label-success">Low</span></td>
                                    <td class="view-message">We need to discuss about the website</td>
                                    <td class="view-message inbox-small-cells"></td>
                                    <td class="view-message text-right">May 23</td>
                                </tr>
                                <tr class="">
                                    <td class="inbox-small-cells">
                                        <input type="checkbox" class="mail-checkbox">
                                    </td>
<!--                                  <td class="inbox-small-cells"><i class="fa fa-star"></i></td>-->
                                    <td class="view-message dont-show">Drupal Community</td>
                                    <td><span class="label label-warning">Medium</span></td>
                                    <td class="view-message view-message">Welcome to the Drupal Community</td>
                                    <td class="view-message inbox-small-cells"></td>
                                    <td class="view-message text-right">March 04</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div> <!-- /.row -->
        </div> <!-- /.container-fluid -->
    </div> <!-- /#page-wrapper -->
</div> <!-- /#wrapper -->

<!-- Modal compose_mail -->
<div class="modal fade" id="compose_mail_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                <h4 class="modal-title">Compose</h4>
            </div>
            <div class="modal-body">
                <form role="form" class="form-horizontal">
                    <div class="form-group">
                        <label class="col-lg-2 control-label">To</label>
                        <div class="col-lg-10">
                            <input type="text" placeholder="" id="inputEmail1" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label">Cc / Bcc</label>
                        <div class="col-lg-10">
                            <input type="text" placeholder="" id="cc" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label">Subject</label>
                        <div class="col-lg-10">
                            <input type="text" placeholder="" id="inputPassword1" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label">Message</label>
                        <div class="col-lg-10">
                            <textarea rows="10" cols="30" class="form-control" id="" name=""></textarea>
                        </div>
                    </div>
                    <hr />
                    <div class="form-group text-right">
                        <label class="col-lg-2 control-label"></label>
                        <div class="col-lg-10">
                            <input class="btn btn-warning" type="submit" name="compose_mail_as_draft" id="compose_mail_as_draft" value="Save as draft" />
                            <button type="button" class="btn btn-default" data-dismiss="modal" id="compose_mail_cancel">Cancel</button>
                            <input class="btn btn-success" type="submit" name="compose_mail_send" id="compose_mail_send" value="Send" />
                        </div>
                    </div>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script>
    $(document).ready(function(){
        //-------------------- DataTable --------------------//
        $("#mails_inbox").DataTable({
            "order":[[0, "desc"]]
        }); 
    });      
</script>

<?php include "../includes/footer.php"; ?>