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


                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">

                                <h4 class="mb-3 header-title">{{ $test_data->test_title}} - {{ $test_data->test_code}}</h4>

                                <form class="form-horizontal" id="submit_form">
                                    <?php
                                    $field_set = explode(',', $test_type->test_field);
                                    ?>
                                    <?php foreach ($field_set as $key => $value) {
                                        $current_val = '';
                                        if($test_data->results){
                                            $valueArray = json_decode($test_data->results);
                                        
                                            if($valueArray->$value){
                                                $current_val = $valueArray->$value;
                                            }
                                        }
                                        
                                    ?>
                                        <div class="row mb-3">
                                            <label for="inputEmail3" class="col-4 col-xl-3 col-form-label">{{ $value }}</label>
                                            <div class="col-8 col-xl-9">

                                                <input type="text" class="form-control" id="inputEmail3"  name="{{ $value }}" value="{{$current_val}}">
                                            </div>
                                        </div>
                                    <?php

                                    } ?>

                                    <input type="hidden" name="id" value="{{$test_data->id}}">
                                    <input type="hidden" name="test_id" value="{{$test_data->test_id}}">
                                    
                                    <div class="justify-content-end row">
                                        <div class="col-8 col-xl-9">
                                            <button type="submit" class="btn btn-info waves-effect waves-light">Update</button>
                                        </div>
                                    </div>
                                </form>

                            </div> <!-- end card-body -->
                        </div> <!-- end card -->
                    </div> <!-- end col -->

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

<script>
    $('#submit_form').on('submit', function(e) {

        e.preventDefault();

        $.ajax({
            type: "POST",
            url: '/result-update',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: $(this).serialize(),
            success: function(msg) {

                if (msg[0].response_code == 200) {
                    swal({
                        title: 'Success!',
                        text: msg[0].response_text,
                        icon: 'success',
                        timer: 2000,
                        button: false
                    });

                    location.href = "appointment-verify-pending-list";

                } else {
                    swal({
                        title: 'Error!',
                        text: msg[0].response_text,
                        icon: 'error',
                        timer: 2000,
                        button: false
                    }).then(
                        function() {},
                        function(dismiss) {
                            if (dismiss === 'timer') {}
                        }
                    )
                }

            }
        });

    });
</script>

</body>

</html>