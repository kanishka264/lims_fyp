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

                        
                        

                         
                        
                    </div> 
                    <!-- container-fluid -->

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