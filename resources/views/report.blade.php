<!DOCTYPE html>
<html lang="en">

<head>

</head>

<!-- Begin page -->
<div id="wrapper">


    <!-- ============================================================== -->
    <!-- Start Page Content here -->
    <!-- ============================================================== -->

    <div class="content-page">
        <div class="content">

            <!-- Start Content-->
            <div class="container-fluid">

                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">

                                <div class="panel-body">
                                    <div class="clearfix">
                                        <div class="float-start">
                                            <h3>Adminto</h3>
                                        </div>
                                        <div class="float-end">
                                            @php
                                            $generatorPNG = new Picqer\Barcode\BarcodeGeneratorPNG();
                                            @endphp

                                            <img src="data:image/png;base64,{{ base64_encode($generatorPNG->getBarcode($barcode, $generatorPNG::TYPE_CODE_128)) }}">

                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-12">

                                            <div class="float-start mt-3">
                                                <address>
                                                    <strong>{{ $patient_data->first_name.' '.$patient_data->last_name }}</strong><br>

                                                    <abbr title="Phone">P:</abbr> {{ $patient_data->mobile }}
                                                </address>
                                            </div>
                                            <div class="float-end mt-3">
                                                <p><strong>Appointment Date: </strong> {{ $order_data->appointment_time }}</p>

                                            </div>
                                        </div><!-- end col -->
                                    </div>
                                    <!-- end row -->

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="table-responsive">
                                                <h3>{{$test_type_data->test_title}} - {{$test_type_data->test_code}}</h3>
                                                <table class="table mt-4">
                                                    <thead>
                                                        <tr>
                                                            <th>Item</th>
                                                            <th>Result</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        $field_set = explode(',', $test_type_data->test_field);
                                                        ?>
                                                        <?php foreach ($field_set as $key => $value) {
                                                            $current_val = '';
                                                            if ($order_data->results) {
                                                                $valueArray = json_decode($order_data->results);

                                                                if ($valueArray->$value) {
                                                                    $current_val = $valueArray->$value;
                                                                }
                                                            }

                                                        ?>
                                                            <tr>
                                                                <td>{{ $value }}</td>
                                                                <td>{{$current_val}}</td>
                                                            </tr>

                                                        <?php

                                                        } ?>



                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>

                                    <hr>

                                </div>
                            </div>
                        </div>

                    </div>

                </div>
                <!-- end row -->

            </div>
            <!-- container-fluid -->

        </div> <!-- content -->


    </div>
    <!-- ============================================================== -->
    <!-- End Page content -->
    <!-- ============================================================== -->


</div>
<!-- END wrapper -->

</body>

</html>