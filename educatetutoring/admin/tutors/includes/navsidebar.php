    <div class="navbar-default sidebar sticky" role="navigation">
        <div class="sidebar-nav navbar-collapse">
            <ul class="nav" id="side-menu">
<!--
                <li class="sidebar-search">
                    <div class="input-group custom-search-form">
                        <input type="text" class="form-control" placeholder="Search...">
                        <span class="input-group-btn">
                            <button class="btn btn-default" type="button">
                                <i class="fa fa-search"></i>
                            </button>
                        </span>
                    </div>
                </li>
-->
                <br>
<!--
                <li>
                    <a href="./index.php"><i class="fas fa-chart-bar"></i> Dashboard</a>
                </li> 
                <li>
                    <a href="#"><i class="fas fa-calendar-alt"></i> Schedules<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="#"><i class="far fa-calendar-alt"></i> Calendar View</a>
                        </li>
                        <li>
                            <a href="#"><i class="fas fa-th-list"></i> Table View</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#"><i class="fas fa-user-graduate"></i> Students</a>
                </li>
-->
                <li>
                    <?php
                        if($_SESSION['user_firstname'] == 'Naomi'){
                            echo "<a href='https://outlook.office365.com/owa/calendar/a9b23ebacf7444f8b7a93c3abd64753f@educatetutoring.onmicrosoft.com/0c071967bb374db393c5abd220d7089412378588541683203562/calendar.html' target='_blank'><i class='far fa-calendar-alt'></i> My Calendar</a>";
                        }else if($_SESSION['user_firstname'] == 'Jenni'){
                            echo "<a href='https://outlook.office365.com/owa/calendar/a9b23ebacf7444f8b7a93c3abd64753f@educatetutoring.onmicrosoft.com/16c883be991443f3820496420c64da9c880255454997510400/calendar.html' target='_blank'><i class='far fa-calendar-alt'></i> My Calendar</a>";
                        }else if($_SESSION['user_firstname'] == 'Merrie'){
                            echo "<a href='https://outlook.office365.com/owa/calendar/a9b23ebacf7444f8b7a93c3abd64753f@educatetutoring.onmicrosoft.com/d933a16f21da4166978428edbf01a9db16049738927795134430/calendar.html' target='_blank'><i class='far fa-calendar-alt'></i> My Calendar</a>";
                        }else if($_SESSION['user_firstname'] == 'Rosemary'){
                            echo "<a href='https://outlook.office365.com/owa/calendar/a9b23ebacf7444f8b7a93c3abd64753f@educatetutoring.onmicrosoft.com/93bf247955f4474c9e37dd22ec68d40717451133299320248305/calendar.html' target='_blank'><i class='far fa-calendar-alt'></i> My Calendar</a>";
                        }else if($_SESSION['user_firstname'] == 'Patrick'){
                            echo "<a href='https://outlook.office365.com/owa/calendar/a9b23ebacf7444f8b7a93c3abd64753f@educatetutoring.onmicrosoft.com/88ecf376332c4ae294eb8c6743aa34fc7408993978254964806/calendar.html' target='_blank'><i class='far fa-calendar-alt'></i> My Calendar</a>";
                        }else{
                            echo "<a href='#'></i> My Calendar</a>";
                        }
                    ?>
                </li> <!-- calendar -->
                <li>
                    <a href="./sasps.php"><i class="fas fa-clipboard-check"></i> Attendances &amp; Provisions</a>
                </li> <!-- SASPs-->
                <li>
                    <a href="./slpes.php"><i class="fas fa-clone"></i> Learning Plans</a>
                </li> <!-- SLPEs-->
<!--
                <li>
                    <a href="#"><i class="fas fa-copy"></i> Student Reports</a>
                </li>
                <li>
                    <a href="#"><i class="fas fa-suitcase"></i> Tools<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="#"><i class="fa fa-edit fa-fw"></i> Forms</a>
                        </li>
                        <li>
                            <a href="#"><i class="far fa-sticky-note"></i> Notes</a>
                        </li>
                    </ul>
                </li>
                <br>
                <br>
                <li>
                    <a href="#"><i class="fa fa-tasks fa-fw"></i> My Tasks</a>
                </li> 
                <li>
                    <a href="#"><i class="fa fa-envelope fa-fw"></i> My Messages</a>
                </li> 
                <li>
                    <a href="#"><i class="fa fa-bell fa-fw"></i> My Notifications</a>
                </li> 
                <li>
                    <a href="#"><i class="fas fa-user"></i> My Profile</a>
                </li>
-->
                <br>
                <br>
                <li>
                    <a href="../../includes/logout.php"><i class="fas fa-sign-out-alt"></i> Log out</a>
                </li><!-- /.logout-->
            </ul>
        </div> <!-- /.sidebar-collapse -->
    </div> <!-- /.navbar-static-side -->
</nav>