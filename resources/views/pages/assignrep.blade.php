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
                <!-- Revenue, Hit Rate & Deals -->
                <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Assign Representative</h4>
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
                                                    <label for="turnno"><small class="text-dark">DateOn</small></label>
                                                    <input type="date" name="turnno" id="" class="form-control"
                                                        placeholder="DateOn">
                                                </div>
                                                <div class="col-md-4">
                                                    <label for="turnno"><small class="text-dark">From
                                                            Time</small></label>
                                                    <input type="time" name="turnno" id="" class="form-control"
                                                        placeholder="From Time">
                                                </div>
                                                <div class="col-md-4">
                                                    <label for="turnno"><small class="text-dark">To
                                                            Time</small></label>
                                                    <input type="time" name="turnno" id="" class="form-control"
                                                        placeholder="To Time">
                                                </div>

                                            </div>
                                            <hr>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <label for="turnno"><small class="text-dark">To
                                                            Time</small></label>
                                                    <select name="userrole" class="form-control" data-live-search="true">
                                                        <option value="volvo">Driver</option>
                                                        <option value="saab">Driver</option>

                                                    </select>
                                                </div>
                                            </div>
                                            <hr>
                                <div class="row d-flex justify-content-center mb-2">
                                    <input class="btn btn-success mr-2" type="submit" value="Submit">
                                    <input class="btn btn-danger ml-2" type="reset" value="Reset">
                                </div>

                                        </div>


                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Today Shift Rep List</h4>
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
                                                <th>Representative Name</th>
                                                <th>Active Time</th>
                                                <th>Action</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>Withanage Padmasiri</td>
                                                <td>00:00 - 00:00</td>
                                                <td><a href=""><i class="la la-edit mr-1 " style="color: green;"></i></a>
                                                    <span><a href=""><i class="la la-trash"
                                                                style="color:red;"></i></a></span>
                                                </td>

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
