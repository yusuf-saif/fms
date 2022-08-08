    <nav class="navbar">
        <div class="container-fluid">
            <div class="navbar-header">
                <a href="javascript:void(0);" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false"></a>
                <a href="javascript:void(0);" class="bars"></a>
                <a class="navbar-brand" href="index.php"> FLEET MANAGEMENT SYSTEM <br><small>ksl</small> </a>
            </div>

        </div>
    </nav>
    <!-- #Top Bar -->
    <section>
        <!-- Left Sidebar -->
        <aside id="leftsidebar" class="sidebar">
            <!-- User Info -->
            <div class="user-info">
                <div class="image">
                    <img src="../images/user.png" width="48" height="48" alt="User" />
                </div>
                <div class="info-container">
                    <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Admin</div>
                    <div class="email"></div>
                    <div class="btn-group user-helper-dropdown">
                        <i class="material-icons" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">keyboard_arrow_down</i>
                        <ul class="dropdown-menu pull-right">
                            <li><a href="javascript:void(0);"><i class="material-icons">person</i>Profile</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="../logout.php"><i class="material-icons">input</i>Sign Out</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- #User Info -->
            <!-- Menu -->
            <div class="menu">
                <ul class="list">
                    <li class="header">MAIN NAVIGATION</li>
                    <li >
                        <a href="index.php">
                            <i class="material-icons">home</i>
                            <span>HOME</span>
                        </a>
                    </li>
                    
                    <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">directions_car</i>
                            <span>Vehicle</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a href="vehicle_reg.php">
                                    <i class="material-icons">assignment</i>
                                    <span>Vehicle Registration</span>
                                </a>
                            </li>
                             <li>
                                <a href="vehicle_view.php">
                                    <i class="material-icons">assignment</i>
                                    <span>Vehicle report </span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li>
                    <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">people</i>
                            <span>DRIVER</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a href="driver_reg.php">
                                    <i class="material-icons">assignment</i>
                                    <span>Driver Registration</span>
                                </a>
                            </li>
                             <li>
                                <a href="driver_view.php">
                                    <i class="material-icons">assignment</i>
                                    <span>Driver report </span>
                                </a>
                            </li>
                             <li> 
                                <a href=" assignDriver.php">
                                    <i class="material-icons">assignment</i>
                                    <span>Driver assignment </span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li> 
                    <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">add_alert</i>
                            <span>ISSUES</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a href="add_issue.php">
                                    <i class="material-icons">assignment</i>
                                    <span>Issue registration</span>
                                </a>
                            </li>
                             <li>
                                <a href="view_issue.php">
                                    <i class="material-icons">assignment</i>
                                    <span>Issue report </span>
                                </a>
                            </li>
                        </ul>
                    </li>   
                    <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">person</i>
                            <span>USER</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a href="add_user.php">
                                    <i class="material-icons">person_add</i>
                                    <span>ADD NEW USER</span>
                                </a>
                            </li>
                            <li>
                                <a href="view_user.php">
                                    <i class="material-icons">layers</i>
                                    <span>VIEW USERS</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li>
                      
                        <a href="../logout.php">
                            <i class="material-icons">input</i>
                            <span>LOGOUT</span>
                        </a>
                    </li>
                </ul>
            </div>
            <!-- #Menu -->
            <!-- Footer -->
            <div class="legal">
                <div class="copyright">
                    &copy; 2022 <a href="javascript:void(0);">FMS</a>
                </div>
                <div class="version">
                    <b>Version: </b> 1.0.0
                </div>
            </div>
            <!-- #Footer -->
        </aside>
        <!-- #END# Left Sidebar -->
    </section>
