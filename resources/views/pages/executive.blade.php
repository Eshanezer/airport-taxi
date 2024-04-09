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
                                <h4 class="card-title">Executive</h4>
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
                                        <table class="table" id="executiveTable">
                                            <thead>
                                                <tr>
                                                    <th>Executive</th>
                                                    <th>Address</th>
                                                    <th>City</th>
                                                    <th>Contact No</th>
                                                    <th>Status</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <form action="{{ route('admin.executives.enroll') }}" method="POST" id="executive_form"
                            enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" id="isnew" name="isnew" value="{{ old('isnew') ? old('isnew') : '1' }}">
                            <input type="hidden" id="record" name="record"
                                value="{{ old('record') ? old('record') : '' }}">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Add/Edit Executive </h4>
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
                                                <label for="first_name"><small class="text-dark">First
                                                        Name{!! required_mark() !!}</small></label>
                                                <input type="text" value="{{ old('first_name') }}" name="first_name"
                                                    id="first_name" class="form-control" placeholder="First Name">
                                                @error('first_name')
                                                    <span class="text-danger"><small>{{ $message }}</small></span>
                                                @enderror
                                            </div>
                                            <div class="col-md-6">
                                                <label for="last_name"><small class="text-dark">Last
                                                        Name{!! required_mark() !!}</small></label>
                                                <input type="text" value="{{ old('last_name') }}" name="last_name"
                                                    id="last_name" class="form-control" placeholder="Last Name">
                                                @error('last_name')
                                                    <span class="text-danger"><small>{{ $message }}</small></span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row mt-1">
                                            <div class="col-md-12">
                                                <label for="address_1"><small class="text-dark">Address
                                                        1{!! required_mark() !!}</small></label>
                                                <input type="text" value="{{ old('address_1') }}" name="address_1"
                                                    id="address_1" class="form-control" placeholder="Address 1">
                                                @error('address_1')
                                                    <span class="text-danger"><small>{{ $message }}</small></span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row mt-1">
                                            <div class="col-md-12">
                                                <label for="address_2"><small class="text-dark">Address
                                                        2</small></label>
                                                <input type="text" value="{{ old('address_2') }}" name="address_2"
                                                    id="address_2" class="form-control" placeholder="Address 2">
                                                @error('address_2')
                                                    <span class="text-danger"><small>{{ $message }}</small></span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row mt-1">
                                            <div class="col-md-6">
                                                <label for="city"><small
                                                        class="text-dark">City{!! required_mark() !!}</small></label>
                                                <input type="text" value="{{ old('city') }}" name="city" id="city"
                                                    class="form-control" placeholder="City">
                                                @error('city')
                                                    <span class="text-danger"><small>{{ $message }}</small></span>
                                                @enderror
                                            </div>
                                            <div class="col-md-6">
                                                <label for="mobile_number"><small class="text-dark">Mobile
                                                        Number{!! required_mark() !!}</small></label>
                                                <input type="text" value="{{ old('mobile_number') }}"
                                                    name="mobile_number" id="mobile_number" class="form-control"
                                                    placeholder="Mobile Number">
                                                @error('mobile_number')
                                                    <span class="text-danger"><small>{{ $message }}</small></span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row mt-1">
                                            <div class="col-md-12">
                                                <label for="email"><small
                                                        class="text-dark">Email{!! required_mark() !!}</small></label>
                                                <input type="text" value="{{ old('email') }}" name="email" id="email"
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
                                                    type="button" form="executive_form" id="resetbtn" value="Reset"></div>
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
    <!-- END: Content-->



    @include('layouts.footer')
    @include('layouts.scripts')

    <script>
        let listTable = $('#executiveTable').DataTable({
            lengthMenu: [
                [10, 25, 50, -1],
                [10, 25, 50, "All"]
            ],
            serverSide: true,
            responsive: true,
            language: {
                searchPlaceholder: "Search By Name"
            },
            ajax: "{{ route('admin.executives.list') }}",
            columns: [{
                    name: 'first_name'
                },
                {
                    name: 'address',
                    orderable: false,
                    searchable: false
                },
                {
                    name: 'city',
                    orderable: false,
                    searchable: false
                },
                {
                    name: 'mobile_number',
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
                $(cells).addClass(' align-middle datatables-sm');
            }
        });

        function doEdit(id) {
            showAlert('Are you sure to edit this record ?', function() {
                $.ajax({
                    type: "GET",
                    url: "{{ route('admin.executives.get.one') }}",
                    data: {
                        'id': id
                    },
                    success: function(response) {
                        $('#first_name').val(response.first_name);
                        $('#last_name').val(response.last_name);
                        $('#address_1').val(response.address1);
                        $('#address_2').val(response.address2);
                        $('#city').val(response.city);
                        $('#mobile_number').val(response.mobile_number);
                        $('#email').val(response.email);
                        $('#status').val(response.status);
                        $('#record').val(response.id);
                        $('#isnew').val('2').trigger('change');
                    }
                });
            });
        }

        function doDelete(id) {
            showAlert('Are you sure to delete this record ?', function() {
                window.location = "{{ route('admin.executives.delete.one') }}?id=" + id;
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
