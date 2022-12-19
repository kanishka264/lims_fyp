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
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="header-title">Edit test</h4>
                                <p class="text-muted font-13"></p>

                                <form id="register_form">
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="inputEmail4" class="form-label">Title</label>
                                            <input type="text" class="form-control" id="inputEmail4" name="test_title" value="<?php echo $test_data->test_title ?>">
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <label for="inputPassword4" class="form-label">Test Code</label>
                                            <input type="text" class="form-control" id="inputPassword4" name="test_code" value="<?php echo $test_data->test_code ?>">
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <label for="inputPassword4" class="form-label">Amount</label>
                                            <input type="number" class="form-control" id="inputPassword4" name="amount" value="<?php echo $test_data->amount ?>">
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12 mb-3">
                                            <label for="inputEmail4" class="form-label">Feilds <small>Separate each field by comma</small></label>
                                            <input type="text" class="form-control" id="inputEmail4" name="test_field" value="<?php echo $test_data->test_field ?>">
                                        </div>
                                        
                                    </div>

                                    <input type="hidden" name="id" value="<?php echo $test_data->id ?>">

                                
                                    <button type="submit" class="btn btn-primary waves-effect waves-light">Create</button>

                                </form>

                            </div> <!-- end card-body -->
                        </div> <!-- end card-->
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
    $('#register_form').on('submit', function(e) {

        e.preventDefault();

        $.ajax({
            type: "POST",
            url: '/update-test',
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

                    setTimeout(function() {
                        location.reload();
                    }, 1500);

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