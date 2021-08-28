            <div class="navbar-header">
                    <div class="d-flex">
                        <!-- LOGO -->
                        <div class="navbar-brand-box" >
                            <a href="index.php" class="logo logo-light " style="margin-top:30px;">
                                <span class="logo-sm">
                                    <img src="assets/images/logo-light.svg" alt="" height="22">
                                </span>
                                <span class="logo-lg" >
                                    <img src="assets/images/WarnasiriIconLogo.jpeg" alt="" height="150">
                                </span>
                            </a>
                        </div>

                        <button type="button" class="btn btn-sm px-3 font-size-16 header-item waves-effect" id="vertical-menu-btn">
                            <i class="fa fa-fw fa-bars"></i>
                        </button>

                        <!-- App Search-->
                    </div>

                    <div class="d-flex">

                        

<!--                        <div class="dropdown d-inline-block">-->
<!--                            <button type="button" class="btn header-item waves-effect"-->
<!--                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" title="language">-->
<!--                                <img class="" src="assets/images/flags/us.jpg" alt="Header Language" height="16">-->
<!--                            </button>-->
<!--                            <div class="dropdown-menu dropdown-menu-right">-->
<!--                    -->
<!--                                <!-- item-->-->
<!--                                <a href="javascript:void(0);" class="dropdown-item notify-item">-->
<!--                                    <img src="assets/images/flags/us.jpg" alt="user-image" class="mr-1" height="12"> <span class="align-middle" title="language">English</span>-->
<!--                                </a>-->
<!---->
<!--                                -->
<!--                            </div>-->
<!--                        </div>-->

                        

                        <div class="dropdown d-none d-lg-inline-block ml-1">
                            <button type="button" class="btn header-item noti-icon waves-effect" data-toggle="fullscreen" title="Full Screen">
                                <i class="bx bx-fullscreen"></i>
                            </button>
                        </div>

                        <div class="dropdown d-inline-block">
                          
<!--                            <button type="button" class="btn header-item noti-icon waves-effect" id="page-header-notifications-dropdown"-->
<!--                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">-->
<!--                                 <i class="bx bx-bell bx-tada" title="New Orders"></i>-->
<!--                                <span class="badge badge-danger badge-pill"  >-->
<!--                                    --><?php
//
//                                    getNewOrdersNotification();
//
//                                    ?>
<!--                                    -->
<!--                                    -->
<!--                                </span>-->
<!--                            </button>-->
                            
                        </div>

                        <div class="dropdown d-inline-block">
                            <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img class="rounded-circle header-profile-user" src="assets/images/users/avatar-1.png"
                                    alt="Header Avatar">
                                <span class="d-none d-xl-inline-block ml-1">Admin</span>
                                <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-right">
                                <!-- item-->
                                <a class="dropdown-item" href="myprofile.php"><i class="bx bx-user font-size-16 align-middle mr-1"></i> Profile</a>
                               
                                
                                <a class="dropdown-item text-danger" href="assets/functions/functionLogoutAdmin.php"><i class="bx bx-power-off font-size-16 align-middle mr-1 text-danger"></i> Logout</a>
                            </div>
                        </div>
                    </div>
                </div>