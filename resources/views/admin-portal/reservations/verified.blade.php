<!DOCTYPE html>
<html lang="en">

<head>

    @include("admin-portal/partials/title-meta")
    <!-- third party css -->
    <link href="{{ asset('admin/assets/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin/assets/libs/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin/assets/libs/datatables.net-buttons-bs5/css/buttons.bootstrap5.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin/assets/libs/datatables.net-select-bs5/css//select.bootstrap5.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- third party css end -->
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
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">

                                <h4 class="mt-0 header-title">Receptionist List </h4>

                                <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap">
                                    <thead>
                                        <tr>
                                            <th>Patient Name</th>
                                            <th>Test Name</th>
                                            <th>Appointment Date</th>
                                            <th>Age</th>
                                            <th>Verified Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>


                                    <tbody id="contentbody">
                                        <?php
                                        foreach ($reportList as $key => $value) {
                                        ?>
                                            <tr>
                                                <td><?php echo ucwords($value->patient_name) ?></td>
                                                <td><?php echo ucwords($value->test_title) ?> - <?php echo strtoupper($value->test_code) ?></td>
                                                <td><?php echo $value->appointment_time ?></td>
                                                <td><?php echo $value->age ?></td>
                                                <?php if($value->verified_status == 1){
                                                    $msg = 'Verified';
                                                }else{
                                                    $msg = 'Pending';
                                                }
                                                    ?>
                                                <td>{{ $msg }}</td>
                                                <td>
                                                <a href="{{url('/barchode-print?id=')}}{{$value->barcode}}" target="_blank" class="btn btn-info">Barcode</a>
                                                    <a href="{{url('/report-print?id=')}}{{$value->barcode}}" target="_blank"  class="btn btn-warning">Print</a>
                                                </td>
                                            </tr>

                                        <?php
                                        }

                                        ?>

                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                </div>

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

<!-- third party js -->
<script src="{{ asset('admin/assets/libs/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{ asset('admin/assets/libs/datatables.net-bs5/js/dataTables.bootstrap5.min.js')}}"></script>
<script src="{{ asset('admin/assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{ asset('admin/assets/libs/datatables.net-responsive-bs5/js/responsive.bootstrap5.min.js')}}"></script>
<script src="{{ asset('admin/assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js')}}"></script>
<script src="{{ asset('admin/assets/libs/datatables.net-buttons-bs5/js/buttons.bootstrap5.min.js')}}"></script>
<script src="{{ asset('admin/assets/libs/datatables.net-buttons/js/buttons.html5.min.js')}}"></script>
<script src="{{ asset('admin/assets/libs/datatables.net-buttons/js/buttons.flash.min.js')}}"></script>
<script src="{{ asset('admin/assets/libs/datatables.net-buttons/js/buttons.print.min.js')}}"></script>
<script src="{{ asset('admin/assets/libs/datatables.net-keytable/js/dataTables.keyTable.min.js')}}"></script>
<script src="{{ asset('admin/assets/libs/datatables.net-select/js/dataTables.select.min.js')}}"></script>
<script src="{{ asset('admin/assets/libs/pdfmake/build/pdfmake.min.js')}}"></script>
<script src="{{ asset('admin/assets/libs/pdfmake/build/vfs_fonts.js')}}"></script>
<!-- third party js ends -->
<script src="{{ asset('admin/assets/js/pages/datatables.init.js')}}"></script>


</body>

</html>