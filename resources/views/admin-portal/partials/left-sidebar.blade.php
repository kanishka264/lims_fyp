<!-- ========== Left Sidebar Start ========== -->
<?php $log_user_data = App\Models\Common::getLoggedUser(); ?>

<div class="left-side-menu">

    <div class="h-100" data-simplebar>

        <!-- User box -->
        <div class="user-box text-center">

            <img src="admin/assets/images/users/user-1.jpg" alt="user-img" title="Mat Helme" class="rounded-circle img-thumbnail avatar-md">


            <p class="text-muted left-user-info">{{ $log_user_data->first_name }}</p>

            
        </div>

        <!--- Sidemenu -->
        <div id="sidebar-menu">

            <ul id="side-menu">

                <li class="menu-title">Dashboard</li>

                <li>
                    <a href="{{url('admin-portal')}}">
                        <i class="mdi mdi-view-dashboard-outline"></i>
                        <span class="badge bg-success rounded-pill float-end"></span>
                        <span> Dashboard </span>
                    </a>
                </li>

                <li class="menu-title mt-2">user management</li>
                <?php if($log_user_data->user_role == 'admin'): ?>
                <li>
                    <a href="#email" data-bs-toggle="collapse">
                        <i class="mdi mdi-email-outline"></i>
                        <span> Receptionist </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="email">
                        <ul class="nav-second-level">
                            <li>
                                <a href="create-receptionist">Add new receptionist </a>
                            </li>
                            <li>
                                <a href="receptionist-list">View receptionist list</a>
                            </li>
                        </ul>
                    </div>
                </li>
                <?php endif; ?>

                <li>
                    <a href="#patient" data-bs-toggle="collapse">
                        <i class="mdi mdi-email-outline"></i>
                        <span> Patients </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="patient">
                        <ul class="nav-second-level">
                            <li>
                                <a href="create-patient">Create new patient</a>
                            </li>
                            <li>
                                <a href="patients-list">View Patients list</a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="menu-title mt-2">appointments management</li>

                <li>
                    <a href="make-appoinment">
                        <i class="mdi mdi-view-dashboard-outline"></i>
                        <span class="badge bg-success rounded-pill float-end"></span>
                        <span> Make Appointment  </span>
                    </a>
                </li>
                    
                <?php if($log_user_data->user_role == 'admin'): ?>
                <li class="active">
                    <a href="appointment-verify-pending-list" >
                        <i class="mdi mdi-view-dashboard-outline"></i>
                        <span class="badge bg-success rounded-pill float-end"></span>
                        <span> Verification Pending  </span>
                    </a>
                </li>
                <li>
                    <a href="appointment-verified-list">
                        <i class="mdi mdi-view-dashboard-outline"></i>
                        <span class="badge bg-success rounded-pill float-end"></span>
                        <span> Verified Appointments </span>
                    </a>
                </li>
                <?php endif; ?>
                

                <?php if($log_user_data->user_role == 'receptionist'): ?>
                <li>
                    <a href="appointment-reciving-pending-list">
                        <i class="mdi mdi-view-dashboard-outline"></i>
                        <span class="badge bg-success rounded-pill float-end"></span>
                        <span> Reciving Pending Reports  </span>
                    </a>
                </li>
                <li>
                    <a href="appointment-recived-list">
                        <i class="mdi mdi-view-dashboard-outline"></i>
                        <span class="badge bg-success rounded-pill float-end"></span>
                        <span> Recived Reports </span>
                    </a>
                </li>
                <?php endif; ?>

                <li class="menu-title mt-2">test type management</li>
                <?php if($log_user_data->user_role == 'admin'): ?>
                <li class="active">
                    <a href="test-type-create" >
                        <i class="mdi mdi-view-dashboard-outline"></i>
                        <span class="badge bg-success rounded-pill float-end"></span>
                        <span> Test Create  </span>
                    </a>
                </li>
                <li>
                    <a href="test-type-list">
                        <i class="mdi mdi-view-dashboard-outline"></i>
                        <span class="badge bg-success rounded-pill float-end"></span>
                        <span> View Test </span>
                    </a>
                </li>
                <?php endif; ?>

            </ul>

        </div>
        <!-- End Sidebar -->

        <div class="clearfix"></div>

    </div>
    <!-- Sidebar -left -->

</div>
<!-- Left Sidebar End -->