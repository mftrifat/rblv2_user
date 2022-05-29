<!-- ============================================================== -->
<!-- Topbar header -->
<!-- ============================================================== -->
<header class="topbar" data-navbarbg="skin5">
    <nav class="navbar top-navbar navbar-expand-md navbar-dark">
        <div class="navbar-header" data-logobg="skin5">
            <!-- ============================================================== -->
            <!-- Logo -->
            <!-- ============================================================== -->
            <a class="navbar-brand" href="<?php echo base_url();?>home">
                <!-- Logo icon -->
                <b class="logo-icon">
                    <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
                    <!-- Dark Logo icon -->
                    <img src="<?php echo base_url();?>assets/img/logo.png" alt="homepage" class="dark-logo"/>
                    <!-- Light Logo icon -->
                    <img src="<?php echo base_url();?>assets/img/logo_white.png" alt="homepage" class="light-logo"/>
                </b>
                <!--End Logo icon -->
                <!-- Logo text -->
                <span class="logo-text">
                    <!-- dark Logo text -->
                    <img src="<?php echo base_url();?>assets/img/logo.png" alt="homepage" class="dark-logo" />
                    <!-- Light Logo text -->
                    <!-- <img src="<?php echo base_url();?>assets/img/logo-light.png" class="light-logo" alt="homepage" /> -->
                    RBL | User
                </span>
            </a>
            <!-- ============================================================== -->
            <!-- End Logo -->
            <!-- ============================================================== -->
            <!-- This is for the sidebar toggle which is visible on mobile only -->
            <a class="nav-toggler waves-effect waves-light d-block d-md-none" href="javascript:void(0)"><i
                    class="ti-menu ti-close"></i></a>
        </div>
        <!-- ============================================================== -->
        <!-- End Logo -->
        <!-- ============================================================== -->

        <div class="navbar-collapse collapse" id="navbarSupportedContent" data-navbarbg="skin5">
            <!-- ============================================================== -->
            <!-- toggle and nav items -->
            <!-- ============================================================== -->
            <ul class="navbar-nav float-start me-auto">
                <!-- <li class="nav-item d-none d-md-block">
                    <a class="nav-link sidebartoggler waves-effect waves-light" href="javascript:void(0)" data-sidebartype="mini-sidebar">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-menu feather-sm">
                            <line x1="3" y1="12" x2="21" y2="12"></line>
                            <line x1="3" y1="6" x2="21" y2="6"></line>
                            <line x1="3" y1="18" x2="21" y2="18"></line>
                        </svg>
                    </a>
                </li> -->
                <!-- ============================================================== -->
                <!-- Search -->
                <!-- ============================================================== -->
                <!-- <li class="nav-item search-box"> <a class="nav-link waves-effect waves-dark"
                        href="javascript:void(0)"><i class="ti-search"></i></a>
                    <form class="app-search position-absolute">
                        <input type="text" class="form-control" placeholder="Search &amp; enter"> <a
                            class="srh-btn"><i class="ti-close"></i></a>
                    </form>
                </li> -->
            </ul>

            <!-- ============================================================== -->
            <!-- Right side toggle and nav items -->
            <!-- ============================================================== -->
            <ul class="navbar-nav float-end">                
                <!-- ============================================================== -->
                <!-- User profile -->
                <!-- ============================================================== -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark pro-pic" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="<?php echo base_url().$this->session->userdata('photo');?>" alt="user" class="rounded-circle" width="35">
                        <!-- <span>
                        <small>Welcome,</small>
                        <?php //echo $this->session->userdata('user_name');?>
                        </span> -->

                        <!-- <i class="ace-icon fa fa-caret-down"></i> -->
                    </a>
                    <ul class="dropdown-menu dropdown-menu-right user-dd animated" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="<?php echo base_url();?>userprofile"><i class="ti-user m-r-5 m-l-5"></i>
                            User Profile</a>
                        <a class="dropdown-item" href="<?php echo base_url();?>userprofilepic"><i class="m-r-5 m-l-5 mdi mdi-account-box"></i>
                            Profile Picture</a>
                        <a class="dropdown-item" href="<?php echo base_url();?>changepassword"><i class="m-r-5 m-l-5 mdi mdi-key-change"></i>
                            Change Password</a>
                        <li class="dropdown-divider"></li>
                        <a class="dropdown-item" href="<?php echo base_url();?>logout"><i class="m-r-5 m-l-5 mdi mdi-power"></i>
                            Logout</a>
                    </ul>
                </li>
                <!-- ============================================================== -->
                <!-- User profile and search -->
                <!-- ============================================================== -->
            </ul>
        </div>
    </nav>
</header>
<!-- ============================================================== -->
<!-- End Topbar header -->
<!-- ============================================================== -->

<!-- ============================================================== -->
<!-- Left Sidebar - style you can find in sidebar.scss  -->
<!-- ============================================================== -->
<aside class="left-sidebar" data-sidebarbg="skin5">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar">
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav">
                <!-- User Profile-->
                <li>
                    <!-- User Profile-->
                    <div class="user-profile d-flex no-block dropdown m-t-20">
                        <div class="user-pic"><img src="<?php echo base_url().$this->session->userdata('photo');?>" alt="users"
                                class="rounded-circle" width="40" /></div>
                        <div class="user-content m-l-10" style="margin: unset;">
                            <h5 class="m-b-0 user-name font-medium" style="margin: 10px;vertical-align: bottom;"><?php echo $this->session->userdata('user_full_name');?></h5>
                        </div>
                    </div>
                    <!-- End User Profile-->
                </li>
                
                <!-- Add Account-->
                <li class="sidebar-item">
                    <a class="sidebar-link has-arrow waves-effect waves-dark" href="#" aria-expanded="false">
                        <i class="mdi mdi-account-star"></i>
                        <span class="hide-menu">Add Account</span>
                    </a>
                    <ul aria-expanded="false" class="collapse first-level">
                        <li class="sidebar-item">
                            <a href="<?php echo base_url();?>add_account_single" class="sidebar-link waves-effect waves-dark">
                                <i class="m-r-10 mdi mdi-account-plus"></i>
                                <span class="hide-menu">Single Entry</span>
                            </a>
                        </li>
                        <!-- <li class="sidebar-item">
                            <a href="<?php //echo base_url();?>add_account_batch" class="sidebar-link waves-effect waves-dark">
                                <i class="m-r-10 mdi mdi-account-multiple-plus"></i>
                                <span class="hide-menu">Batch Entry</span>
                            </a>
                        </li> -->
                    </ul>
                </li>

                <!-- Status-->
                <li class="sidebar-item">
                    <a class="sidebar-link has-arrow waves-effect waves-dark" href="#" aria-expanded="false">
                        <i class="mdi mdi-account-check"></i>
                        <span class="hide-menu">Status</span>
                    </a>
                    <ul aria-expanded="false" class="collapse first-level">
                        <li class="sidebar-item">
                            <a href="<?php echo base_url();?>uploaded_accounts" class="sidebar-link waves-effect waves-dark">
                                <i class="m-r-10 mdi mdi-account-settings"></i>
                                <span class="hide-menu">Uploaded Accounts</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="<?php echo base_url();?>rejected_accounts" class="sidebar-link waves-effect waves-dark">
                                <i class="m-r-10 mdi mdi-account-off"></i>
                                <span class="hide-menu">Rejected Accounts</span>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Payment-->
                <li class="sidebar-item">
                    <a class="sidebar-link has-arrow waves-effect waves-dark" href="#" aria-expanded="false">
                        <i class="mdi mdi-cash-multiple"></i>
                        <span class="hide-menu">Payment</span>
                    </a>
                    <ul aria-expanded="false" class="collapse first-level">
                        <li class="sidebar-item">
                            <a href="<?php echo base_url();?>payment_request" class="sidebar-link waves-effect waves-dark">
                                <i class="m-r-10 mdi mdi-cash"></i>
                                <span class="hide-menu">Request Payment</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="<?php echo base_url();?>payment_status" class="sidebar-link waves-effect waves-dark">
                                <i class="m-r-10 mdi mdi-cash"></i>
                                <span class="hide-menu">Payment Status</span>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>

        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>
<!-- ============================================================== -->
<!-- End Left Sidebar - style you can find in sidebar.scss  -->
<!-- ==============================================================