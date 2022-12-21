<!DOCTYPE html>
<html lang="en">
    <head>

        @include("admin-portal/partials/title-meta")

        @include('admin-portal/partials/head-css')

    </head>

    @include('admin-portal/partials/body')

        <!-- Begin page -->
        <div id="wrapper">


            @include('admin-portal/partials/topbar')

            @include('admin-portal/partials/left-sidebar')

            <!-- ============================================================== -->
            <!-- Start Page Content here -->
            <!-- ============================================================== -->
         
            <div class="content-page">
                <div class="content">

                    <!-- Start Content-->
                    <div class="container-fluid">

                        <div class="row">

                            <div class="col-xl-3 col-md-6">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="dropdown float-end">
                                        </div>
    
                                        <h4 class="header-title mt-0 mb-4">Registered Patients</h4>
    
                                        <div class="widget-chart-1">
                                            
    
                                            <div class="widget-detail-1 text-end">
                                                <h2 class="fw-normal pt-2 mb-1"> {{$total_patient_count}} </h2>
                                                <p class="text-muted mb-1"></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- end col -->

                            <div class="col-xl-3 col-md-6">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="dropdown float-end">
                                            
                                        </div>
    
                                        <h4 class="header-title mt-0 mb-3">Active Appointment</h4>
    
                                        <div class="widget-box-2">
                                            <div class="widget-detail-2 text-end">
                                                
                                                <h2 class="fw-normal mb-1"> {{$pending_appoinment_count}} </h2>
                                               
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>
                            </div><!-- end col -->

                            <div class="col-xl-3 col-md-6">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="dropdown float-end">
                                           
                                           
                                        </div>
    
                                        <h4 class="header-title mt-0 mb-4">Total Revenue</h4>
    
                                        <div class="widget-chart-1">
                                            
                                            <div class="widget-detail-1 text-end">
                                                <h2 class="fw-normal pt-2 mb-1"> {{$total_revenue}} LKR</h2>
                                                <p class="text-muted mb-1"></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- end col -->

                            <div class="col-xl-3 col-md-6">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="dropdown float-end">
                                           
                                        </div>
    
                                        <h4 class="header-title mt-0 mb-3">Daily Sales</h4>
    
                                        <div class="widget-box-2">
                                            <div class="widget-detail-2 text-end">
                                                <h2 class="fw-normal mb-1"> {{$daily_sale}} </h2>
                                                <p class="text-muted mb-3">Revenue today</p>
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>
                                
                            </div><!-- end col -->

                        </div>
                        <!-- end row -->

                         
                        
                    </div> <!-- container-fluid -->

                </div> <!-- content -->

                @include('admin-portal/partials/footer')

            </div>
            <!-- ============================================================== -->
            <!-- End Page content -->
            <!-- ============================================================== -->


        </div>
        <!-- END wrapper -->

        @include('admin-portal/partials/right-sidebar')

        @include('admin-portal/partials/vendor')

        <!-- knob plugin -->
        <script src="{{ asset('admin/assets/libs/jquery-knob/jquery.knob.min.js')}}"></script>

        <!--Morris Chart-->
        <script src="{{ asset('admin/assets/libs/morris.js06/morris.min.js')}}"></script>
        <script src="{{ asset('admin/assets/libs/raphael/raphael.min.js')}}"></script>
  
        <!-- Dashboar init js-->
        <script src="{{ asset('admin/assets/js/pages/dashboard.init.js')}}"></script>

        <!-- App js-->
        <script src="{{ asset('admin/assets/js/app.min.js')}}"></script>
        
    </body>
</html>