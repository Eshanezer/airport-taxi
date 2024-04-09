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
                    @include('layouts.flash')
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Drivers</h4>
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
                                    <div class="table-responsive">
                                        <table class="table w-100" id="driversTable">
                                            <thead>
                                                <tr>
                                                    <th>Turn No</th>
                                                    <th>Driver</th>
                                                    <th>License Number</th>
                                                    <th>Expiry Date</th>
                                                    <th>Contact Number</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <form action="{{ route('admin.drivers.enroll') }}" method="POST" id="driver_form">
                            @csrf
                            <input type="hidden" id="isnew" name="isnew" value="{{ old('isnew') ? old('isnew') : '1' }}">
                            <input type="hidden" id="record" name="record"
                                value="{{ old('record') ? old('record') : '' }}">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Add/Edit Driver </h4>
                                    <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                                    <div class="heading-elements">
                                        <ul class="list-inline mb-0">
                                            <li><label for="resetbtn"><a data-action="reload"><i
                                                class="ft-rotate-cw"></i></a></label></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="card-content collapse show">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label for="turnno"><small class="text-dark">Turn No
                                                        {!! required_mark() !!}</small></label>
                                                <div class="input-group">
                                                    <input value="{{ old('turnno') }}" type="text" class="form-control"
                                                        placeholder="Turn No" aria-label="Username" name="turnno"
                                                        id="turnno" aria-describedby="basic-turnno">

                                                    <div class="input-group-append">
                                                        <span class="input-group-text" id="basic-turnno"><i
                                                                class="la la-remove text-danger"
                                                                id="basic-turnno-visible"></i></span>
                                                    </div>
                                                </div>
                                                @error('turnno')
                                                    <span class="text-danger"><small>{{ $message }}</small></span>
                                                @enderror

                                            </div>
                                            <div class="col-md-6">
                                                <label for="nic"><small class="text-dark">NIC No
                                                        {!! required_mark() !!}</small></label>
                                                <input value="{{ old('nic') }}" type="text" name="nic" id="nic"
                                                    class="form-control" placeholder="NIC No">
                                                @error('nic')
                                                    <span class="text-danger"><small>{{ $message }}</small></span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row mt-1">
                                            <div class="col-md-6">
                                                <label for="fname"><small class="text-dark">First Name
                                                        {!! required_mark() !!}</small></label>
                                                <input value="{{ old('fname') }}" type="text" name="fname" id="fname"
                                                    class="form-control" placeholder="First Name">
                                                @error('fname')
                                                    <span class="text-danger"><small>{{ $message }}</small></span>
                                                @enderror
                                            </div>
                                            <div class="col-md-6">
                                                <label for="lname"><small class="text-dark">Last Name
                                                        {!! required_mark() !!}</small></label>
                                                <input value="{{ old('lname') }}" type="text" name="lname" id="lname"
                                                    class="form-control" placeholder="Last Name">
                                                @error('lname')
                                                    <span class="text-danger"><small>{{ $message }}</small></span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row mt-1">
                                            <div class="col-md-6">
                                                <label for="licensenumber"><small class="text-dark">License
                                                        Number {!! required_mark() !!}</small></label>
                                                <input value="{{ old('licensenumber') }}" type="text"
                                                    name="licensenumber" id="licensenumber" class="form-control"
                                                    placeholder="License Number">
                                                @error('licensenumber')
                                                    <span class="text-danger"><small>{{ $message }}</small></span>
                                                @enderror
                                            </div>
                                            <div class="col-md-6">
                                                <label for="license_expiry_date"><small class="text-dark">License
                                                        Expiry
                                                        Date {!! required_mark() !!}</small></label>
                                                <input value="{{ old('license_expiry_date') }}" type="date"
                                                    name="license_expiry_date" id="license_expiry_date"
                                                    class="form-control" placeholder="License Expiry Date">
                                                @error('license_expiry_date')
                                                    <span class="text-danger"><small>{{ $message }}</small></span>
                                                @enderror
                                            </div>

                                        </div>
                                        <div class="row mt-1">
                                            <div class="col-md-6">
                                                <label for="vehiclenumber"><small class="text-dark">Vehicle
                                                        Number{!! required_mark() !!}</small></label>
                                                <input value="{{ old('vehiclenumber') }}" type="text"
                                                    name="vehiclenumber" id="vehiclenumber" class="form-control"
                                                    placeholder="Vehicle Number">
                                                @error('vehiclenumber')
                                                    <span class="text-danger"><small>{{ $message }}</small></span>
                                                @enderror
                                            </div>
                                            <div class="col-md-6">
                                                <label for="joining_date"><small class="text-dark">Joining
                                                        Date{!! required_mark() !!}</small></label>
                                                <input value="{{ old('joining_date') }}" type="date" name="joining_date"
                                                    id="joining_date" class="form-control" placeholder="Joining Date">
                                                @error('joining_date')
                                                    <span class="text-danger"><small>{{ $message }}</small></span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row mt-1">
                                            <div class="col-md-12">
                                                <label for="address1"><small class="text-dark">Address
                                                        1{!! required_mark() !!}</small></label>
                                                <input value="{{ old('address1') }}" type="text" name="address1"
                                                    id="address1" class="form-control" placeholder="Address 1">
                                                @error('address1')
                                                    <span class="text-danger"><small>{{ $message }}</small></span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row mt-1">
                                            <div class="col-md-12">
                                                <label for="address2"><small class="text-dark">Address
                                                        2</small></label>
                                                <input value="{{ old('address2') }}" type="text" name="address2"
                                                    id="address2" class="form-control" placeholder="Address 2">
                                                @error('address2')
                                                    <span class="text-danger"><small>{{ $message }}</small></span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row mt-1">
                                            <div class="col-md-6">
                                                <label for="city"><small
                                                        class="text-dark">City{!! required_mark() !!}</small></label>
                                                <input value="{{ old('city') }}" type="text" name="city" id="city"
                                                    class="form-control" placeholder="City">
                                                @error('city')
                                                    <span class="text-danger"><small>{{ $message }}</small></span>
                                                @enderror
                                            </div>
                                            <div class="col-md-6">
                                                <label for="mobile_number"><small class="text-dark">Mobile
                                                        Number{!! required_mark() !!}</small></label>
                                                <input value="{{ old('mobile_number') }}" type="text"
                                                    name="mobile_number" id="mobile_number" class="form-control"
                                                    placeholder="Mobile Number">
                                                @error('mobile_number')
                                                    <span class="text-danger"><small>{{ $message }}</small></span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row mt-1">
                                            <div class="col-md-6">
                                                <label for="phone_number"><small class="text-dark">Phone
                                                        Number</small></label>
                                                <input value="{{ old('phone_number') }}" type="text" name="phone_number"
                                                    id="phone_number" class="form-control" placeholder="Phone Number">
                                                @error('phone_number')
                                                    <span class="text-danger"><small>{{ $message }}</small></span>
                                                @enderror
                                            </div>
                                            <div class="col-md-6">
                                                <label for="email"><small
                                                        class="text-dark">Email{!! required_mark() !!}</small></label>
                                                <input value="{{ old('email') }}" type="text" name="email" id="email"
                                                    class="form-control" placeholder="Email">
                                                @error('email')
                                                    <span class="text-danger"><small>{{ $message }}</small></span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row mt-1">
                                            <div class="col-md-12">
                                                <label for="status"><small>Status {!! required_mark() !!}</small></label>
                                                <select class="form-control" name="status" id="status">
                                                    <option {{ old('status') == 1 ? 'selected' : '' }} value="1">Active
                                                    </option>
                                                    <option {{ old('status') == 2 ? 'selected' : '' }} value="2">Inactive
                                                    </option>
                                                    <option {{ old('status') == 3 ? 'selected' : '' }} value="3">Blocked
                                                    </option>
                                                </select>
                                                @error('status')
                                                    <span class="text-danger">
                                                        <small>{{ $message }}</small>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <hr class="my-2">
                                        <div class="row">
                                            <div class="col-md-6"> <input id="submitbtn"
                                                    class="btn btn-success w-100" type="submit" value="Submit">
                                            </div>
                                            <div class="col-md-6 mt-md-0 mt-1"><input class="btn btn-danger w-100"
                                                    type="button" form="driver_form" id="resetbtn" value="Reset"></div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </form>
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
        let turnNo = $('#turnno');
        turnNo.keyup(function(e) {
            e.preventDefault();
            checkTurnNo();
        });

        function checkTurnNo() {
            if (turnNo.val() == '') {
                $('#basic-turnno-visible').removeClass(
                    'la la-check text-success la la-remove text-danger').addClass(
                    'la la-remove text-danger');
            } else {
                $.ajax({
                    type: "GET",
                    url: "{{ route('admin.drivers.validate.turnno') }}",
                    data: {
                        'turnno': turnNo.val(),
                        'type': $('#isnew').val(),
                        'record': $('#record').val(),
                    },
                    success: function(response) {
                        if (response == '1') {
                            $('#basic-turnno-visible').removeClass(
                                'la la-check text-success la la-remove text-danger').addClass(
                                'la la-check text-success');
                        } else {
                            $('#basic-turnno-visible').removeClass(
                                'la la-check text-success la la-remove text-danger').addClass(
                                'la la-remove text-danger');
                        }
                    }
                });
            }
        }

        let listTable=$('#driversTable').DataTable({
            lengthMenu: [
                [10, 25, 50, -1],
                [10, 25, 50, "All"]
            ],
            language: {
                searchPlaceholder: "Turn No"
            },
            serverSide: true,
            responsive: true,
            ajax: "{{ route('admin.drivers.list') }}",

            columns: [{
                    name: 'turnno'
                },
                {
                    name: 'name',
                    orderable: false,
                    searchable: false
                },
                {
                    name: 'license_number',
                    orderable: false,
                    searchable: false
                },
                {
                    name: 'license_date',
                    orderable: false,
                    searchable: false
                },
                {
                    name: 'tp1',
                    orderable: false,
                    searchable: false
                },
                {
                    name: 'status',
                    orderable: false,
                    searchable: false
                },
                {
                    name: 'action',
                    orderable: false,
                    searchable: false
                }
            ],
            createdRow: function(row, data, dataIndex, cells) {
                $(cells).addClass(' align-middle datatables-sm text-avoid-break');
            }
        });

        $(document).ready(function() {
            checkTurnNo();
        });

        function doEdit(id) {
            showAlert('Are you sure to edit this record ?', function() {
                $.ajax({
                    type: "GET",
                    url: "{{ route('admin.drivers.get.one') }}",
                    data: {
                        'id': id
                    },
                    success: function(response) {
                        $('#turnno').val(response.turnno);
                        $('#nic').val(response.nic);
                        $('#fname').val(response.fname);
                        $('#lname').val(response.lname);
                        $('#licensenumber').val(response.license_number);
                        $('#license_expiry_date').val(response.license_date);
                        $('#vehiclenumber').val(response.vehicle_number);
                        $('#joining_date').val(response.joining_date);
                        $('#address1').val(response.address1);
                        $('#address2').val(response.address2);
                        $('#city').val(response.city);
                        $('#mobile_number').val(response.tp1);
                        $('#phone_number').val(response.tp2);
                        $('#email').val(response.email);
                        $('#status').val(response.status);
                        $('#record').val(response.id);
                        $('#isnew').val('2').trigger('change');
                        checkTurnNo();
                    }
                });
            });
        }

        function doDelete(id) {
            showAlert('Are you sure to delete this record ?', function() {
                window.location = "{{ route('admin.drivers.delete.one') }}?id=" + id;
            });
        }

        function doBlock(id) {
            showAlert('Are you sure to block or unblock this record ?', function() {
                window.location = "{{ route('admin.drivers.block.one') }}?id=" + id;
            });
        }

        @if (old('record'))
            $('#record').val({{ old('record') }});
        @endif

        @if (old('isnew'))
            $('#isnew').val({{ old('isnew') }}).trigger('change');
        @endif
    </script>



@endsection
