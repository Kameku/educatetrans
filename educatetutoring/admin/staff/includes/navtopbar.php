<nav class="navbar navbar-default navbar-fixed-top" role="navigation" style="margin-bottom: 0">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="./index.php">Educate Tutoring Management System v2.0</a> <!-- todo -->
    </div> <!-- /.navbar-header -->
    
    <ul class="nav navbar-top-links navbar-right">
        <li title="My Mails">
            <span>
                <a href="./my_mails_inbox.php"><i class="fa fa-envelope fa-fw"></i></a><sup><span class="label label-danger"></span></sup>
            </span>
        </li><!-- /.my_mails -->
        <li title="My Chat">
            <span>
                <a href="./index.php#chat_panel"><i class="fa fa-comments fa-fw"></i></a><sup><span class="label label-danger">New</span></sup>
            </span>
        </li><!-- /.my_chat -->
        <li title="My Tasks">
            <span>
                <a href="./my_tasks.php"><i class="fa fa-tasks fa-fw"></i></a>
            </span>
        </li><!-- /.my_tasks -->
        <li class="dropdown" data-toggle="tooltip" data-placement="bottom" title="My Alerts">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                <i class="fa fa-bell fa-fw"></i> <i class="fa fa-caret-down"></i>
            </a>
            <ul class="dropdown-menu dropdown-alerts">
                <li>
                    <a href="#">
                        <div>
                            <i class="fa fa-comment fa-fw"></i> New Comment
                            <span class="pull-right text-muted small">4 minutes ago</span>
                        </div>
                    </a>
                </li>
                <li class="divider"></li>
                <li>
                    <a href="#">
                        <div>
                            <i class="fa fa-twitter fa-fw"></i> 3 New Followers
                            <span class="pull-right text-muted small">12 minutes ago</span>
                        </div>
                    </a>
                </li>
                <li class="divider"></li>
                <li>
                    <a href="#">
                        <div>
                            <i class="fa fa-envelope fa-fw"></i> Message Sent
                            <span class="pull-right text-muted small">4 minutes ago</span>
                        </div>
                    </a>
                </li>
                <li class="divider"></li>
                <li>
                    <a href="#">
                        <div>
                            <i class="fa fa-tasks fa-fw"></i> New Task
                            <span class="pull-right text-muted small">4 minutes ago</span>
                        </div>
                    </a>
                </li>
                <li class="divider"></li>
                <li>
                    <a href="#">
                        <div>
                            <i class="fa fa-upload fa-fw"></i> Server Rebooted
                            <span class="pull-right text-muted small">4 minutes ago</span>
                        </div>
                    </a>
                </li>
                <li class="divider"></li>
                <li>
                    <a class="text-center" href="./my_alerts.php">
                        <strong>See All Alerts</strong>
                        <i class="fa fa-angle-right"></i>
                    </a>
                </li>
            </ul>
            <!-- /.dropdown-alerts -->
        </li> <!-- /.my_alerts -->
        <li data-toggle="tooltip" data-placement="bottom" title="My Profile">
            <a href="./my_profile.php"><i class="fa fa-user"></i></a>
        </li><!-- /.my_profile -->       
        <li data-toggle="tooltip" data-placement="bottom" title="Logout">
            <a href="../../includes/logout.php"><i class="fas fa-sign-out-alt"></i></a>
        </li><!-- /.logout-->
    </ul> <!-- /.navbar-top-links -->