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
                                <h4 class="header-title">Update Patient Data</h4>
                                <p class="text-muted font-13"></p>

                                <form id="register_form">
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="inputEmail4" class="form-label">First Name</label>
                                            <input type="text" class="form-control" id="inputEmail4" name="first_name" value="<?php echo $patientData->first_name ?>">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="inputPassword4" class="form-label">Last Name</label>
                                            <input type="text" class="form-control" id="inputPassword4" name="last_name" value="<?php echo $patientData->last_name ?>">
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="inputEmail4" class="form-label">NIC</label>
                                            <input type="text" class="form-control" id="inputEmail4" name="nic" value="<?php echo $patientData->nic ?>">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="inputPassword4" class="form-label">Mobile<small> (Please enter the 9 digit mobile number e.g 77xxxxxxx, 76xxxxxxx, 78xxxxxxx, 71xxxxxxx.)</small></label>
                                            <input type="number" class="form-control" id="inputPassword4" name="mobile" value="<?php echo $patientData->mobile ?>">
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4 mb-3">
                                            <label for="inputEmail4" class="form-label">Email</label>
                                            <input type="email" class="form-control" id="inputEmail4" name="email" value="<?php echo $patientData->email ?>">
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label for="inputPassword4" class="form-label">DOB</label>
                                            <input type="date" class="form-control" id="inputPassword4" name="dob" value="<?php echo $patientData->date_of_birth ?>">
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label for="inputPassword4" class="form-label">Gender</label>
                                            <select name="gender" class="form-select">
                                                <option>Select Gender</option>
                                                <option value="Male" <?php echo($patientData->gender == 'male'?'selected':'') ?>>Male</option>
                                                <option value="Female" <?php echo($patientData->gender == 'female'?'selected':'') ?>>Female</option>
                                            </select>
                                        </div>
                                    </div>
                                    <input type="hidden" name="id" value="<?php echo $patientData->id ?>">

                                    <button type="submit" class="btn btn-primary waves-effect waves-light">Update</button>

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
            url: '/update-patient',
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

                    setTimeout(function(){
                        location.href="patients-list";
                    },1500);

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