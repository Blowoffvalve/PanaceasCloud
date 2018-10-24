       <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php"><img src="https://babbage.cs.missouri.edu/~oamr6/NewDashboard/new/panacea.png" alt="panacea_logo" style="width:25%;height:200%;"></a>
            </div>
            <!-- Top Menu Items -->
            <ul class="nav navbar-right top-nav">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-envelope"></i> <b class="caret"></b></a>
                    <ul class="dropdown-menu message-dropdown">
                        <li class="message-preview">
                            <a href="#">
                                <div class="media">
                                    <span class="pull-left">
                                        <img class="media-object" src="https://placehold.it/50x50" alt="">
                                    </span>
                                    <div class="media-body">
                                        <h5 class="media-heading"><strong>Mark Vassell</strong>
                                        </h5>
                                        <p class="small text-muted"><i class="fa fa-clock-o"></i> Time i.e: June 10 at 10:01 AM</p>
                                        <p>Mark was here</p>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="message-preview">
                            <a href="#">
                                <div class="media">
                                    <span class="pull-left">
                                        <img class="media-object" src="https://placehold.it/50x50" alt="">
                                    </span>
                                    <div class="media-body">
                                        <h5 class="media-heading"><strong>Olivia Apperson</strong>
                                        </h5>
                                        <p class="small text-muted"><i class="fa fa-clock-o"></i> June 10 at 10:05 AM</p>
                                        <p>Olivia was here</p>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="message-preview">
                            <a href="#">
                                <div class="media">
                                    <span class="pull-left">
                                        <img class="media-object" src="https://placehold.it/50x50" alt="">
                                    </span>
                                    <div class="media-body">
                                        <h5 class="media-heading"><strong>John Doe</strong>
                                        </h5>
                                        <p class="small text-muted"><i class="fa fa-clock-o"></i> June 10 at 10:07 AM</p>
                                        <p>Message will be displayed</p>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="message-footer">
                            <a href="#">Read All New Messages</a>
                        </li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-bell"></i> <b class="caret"></b></a>
                    <ul class="dropdown-menu alert-dropdown">
                        <li>
                            <a href="#">Alert Name <span class="label label-default">Alert Badge</span></a>
                        </li>
                        <li>
                            <a href="#">Alert Name <span class="label label-primary">Alert Badge</span></a>
                        </li>
                        <li>
                            <a href="#">Alert Name <span class="label label-success">Alert Badge</span></a>
                        </li>
                        <li>
                            <a href="#">Alert Name <span class="label label-info">Alert Badge</span></a>
                        </li>
                        <li>
                            <a href="#">Alert Name <span class="label label-warning">Alert Badge</span></a>
                        </li>
                        <li>
                            <a href="#">Alert Name <span class="label label-danger">Alert Badge</span></a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">View All</a>
                        </li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?php echo $_SESSION['username'];?> <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="profile.php"><i class="fa fa-fw fa-user"></i> Profile</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-fw fa-envelope"></i> Inbox</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-fw fa-gear"></i> Settings</a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="logout.php"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                        </li>
                    </ul>
                </li>
            </ul>
            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                 
                    <li class="active">
                        <a href="index.php"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
                    </li>
                    <li>
                        <a href="javascript:;" data-toggle="collapse" data-target="#staff"><i class="fa fa-fw fa-user-md"></i> Staff <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="staff" class="collapse">
                            <li>
                                <a href="../content/staff.php"><i class = "fa fa-fw fa-list-alt"></i> View Staff</a>
                            </li>
                            <li>
                                <a href="../content/add_staff.php"><i class = "fa fa-fw fa-plus-square"></i> Add Staff</a>
                            </li>

                        </ul>
                    </li>   
                    <li>
                        <a href="javascript:;" data-toggle="collapse" data-target="#demo"><i class="fa fa-fw fa-exclamation-triangle"></i> Incidents <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="demo" class="collapse">
                            <li>
                                <a href="../content/incidents.php"><i class = "fa fa-fw fa-plus"></i> Add Incident</a>
                            </li>
                            <li>
                                <a href="../content/incidentlist.php"><i class = "fa fa-fw fa-folder-o"></i> View Incidents</a>
                            </li>
                            <li>
                                <a href="../content/test.php"><i class = "fa fa-fw fa-book"></i> View/Add Patinents</a>
                            </li>

                        </ul>
                    </li>
                    <li>
                        <a href="javascript:;" data-toggle="collapse" data-target="#facil"><i class="fa fa-fw fa-hospital-o"></i> Facilities <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="facil" class="collapse">
                            <li>
                                <a href="../content/facilities.php"><i class = "fa fa-fw fa-book"></i> Contact</a>
                            </li>

                            <li>
                                <a href="../content/bloodbag.php"><i class = "fa fa-fw fa-heartbeat"></i> Supplies</a>
                            </li>
                        </ul>
                    </li>

                    <li>
                        <a href = "glass_streams.php"><i class = "fa fa-fw fa-video-camera"></i> Video feeds</a>
                    </li>
                    <li>
                        <a href="../content/notifications.php"><i class="fa fa-fw fa-th-list"></i> Notifications</a>
                    </li>
                   <!-- <li>
                        <a href="javascript:;" data-toggle="collapse" data-target="#pat"><i class="fa fa-fw fa-hospital-o"></i> Patients <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="pat" class="collapse">
                            <li>
                                <a href="test.php"><i class = "fa fa-fw fa-book"></i> View Patinent</a>
                            </li>

                            <li>
                                <a href="add_patient.php"><i class = "fa fa-fw fa-heartbeat"></i> Add Patients </a>
                            </li>
                        </ul>
                    </li>-->
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </nav>
