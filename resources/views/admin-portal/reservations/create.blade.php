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
                                <h4 class="header-title">Make Appointment</h4>
                                <p class="text-muted font-13"></p>

                                <form id="register_form">
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="inputEmail4" class="form-label">patient</label>
                                            <select name="patient_id" class="form-select">
                                                <option value="0">Select</option>
                                                <?php
                                                foreach ($patient_list as $key => $value) {
                                                    echo '<option value="' . $value->id . '">' . $value->first_name . ' ' . $value->last_name . '</option>';
                                                }
                                                ?>

                                            </select>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="inputPassword4" class="form-label">Select Test</label>
                                            <select name="test_id" class="form-select" onchange="getTestPrice(this.value)">
                                                <option value="0">Select</option>
                                                <?php
                                                foreach ($test_list as $key => $value) {
                                                    echo '<option value="'. $value->id.'">'. $value->test_title.'</option>';
                                                }
                                                ?>
                                            </select>

                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="inputEmail4" class="form-label">Amount</label>
                                            <input type="number" class="form-control"  name="paid_amount" readonly id="paid_amount">
                                        </div>
                                        
                                    </div>

                                    
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
            url: '/make-appointment',
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

    function getTestPrice($id){
        $.ajax({
            type: "POST",
            url: '/get-test-price',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: 'test_id='+$id,
            success: function(msg) {
                console.log(msg[0].amount)
                $('#paid_amount').val(msg[0].amount);
            }
        });
    }
</script>
</body>

</html>