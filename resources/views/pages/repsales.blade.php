@extends('layouts.app')

@section('content')

    @include('layouts.navbar')
    @include('layouts.sidebar')
    <!-- END: Main Menu-->
    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Rep Sales (Search Options)</h4>
                                <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                                <div class="heading-elements">
                                   <ul class="list-inline mb-0">
                                        <li><a onclick="refreshTable()" data-action="reload"><i
                                                    class="ft-rotate-cw"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="card-content collapse show">
                                <div class="card-body pt-0">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label for="dcfdate"><small class="text-dark">From Date</small></label>
                                                    <input type="date" name="dcfdate" id="" class="form-control"
                                                        placeholder="From Date">
                                                </div>
                                                <div class="col-md-4">
                                                    <label for="dctdate"><small class="text-dark">To Date</small></label>
                                                    <input type="date" name="dcfdate" id="" class="form-control"
                                                        placeholder="To Date">
                                                </div>
                                                <div class="col-md-4">
                                                    <label for="turnno"><small class="text-dark">Representative</small></label>
                                                        <select class="form-control selectpicker" id="select-country" data-live-search="true">
                                                            <option data-tokens="china">125</option>
                                              <option data-tokens="malayasia">124</option>
                                              <option data-tokens="singapore">123</option>
                                                            </select>
                                                </div>

                                            </div>

                                            <hr>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="row d-flex justify-content-center mb-2">
                                                        <input class="btn btn-success mr-2" type="submit" value="View Data">

                                                    </div>
                                                </div>
                                            </div>





                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Reports List</h4>
                                <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                                <div class="heading-elements">
                                    <ul class="list-inline mb-0">
                                        <li><a onclick="refreshTable()" data-action="reload"><i
                                                    class="ft-rotate-cw"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="card-content collapse show">
                                <div class="card-body">
                                    <table class="table" id="assignrepTable">
                                        <thead>
                                            <tr>
                                                <th>Invoice Date</th>
                                                <th>Invoice No</th>
                                                <th>Destination</th>
                                                <th>Driver</th>
                                                <th>Driver Comission</th>
                                                <th>Company Comission</th>
                                                <th>Total Journey Price</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>2021-12-02 11:48:13</td>
                                                <td>0989</td>
                                                <td>AIRPORT - NEGOMBO CITY</td>
                                                <td>Maduranga .De Silva</td>
                                                <td>1,200.00</td>
                                                <td>300.00</td>
                                                <td>1,500.00</td>


                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>



                </div>
            </div>
        </div>

    </div>
    </div>
    </div>
    <!-- END: Content-->



    @include('layouts.footer')
    @include('layouts.scripts')

    <script>
        $('#assignrepTable').DataTable();
    </script>

    <script>
        $(function() {
            $('.selectpicker').selectpicker();
        });
    </script>


@endsection
