@extends('layouts.app')

@section('content')

    @include('layouts.navbar')
    @include('layouts.sidebar')
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <div class="row">
                    <div class="col-md-6">
                        <form action="{{ route('admin.vehicletypes.enroll') }}" method="POST" id="vehicle_type_form"
                            enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" id="isnew" name="isnew" value="{{ old('isnew') ? old('isnew') : '1' }}">
                            <input type="hidden" id="record" name="record"
                                value="{{ old('record') ? old('record') : '' }}">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Add/Edit Vehicle</h4>
                                    <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                                    <div class="heading-elements">
                                        <ul class="list-inline mb-0">
                                            <li><label for="resetbtn"><a data-action="reload"><i
                                                            class="ft-rotate-cw"></i></a></label></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="card-content collapse show">
                                    <div class="card-body pt-0">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <label for="vehicle_type"><small class="text-dark">Vehicle
                                                                Type</small></label>
                                                        <input value="{{ old('vehicle_type') }}" type="text"
                                                            name="vehicle_type" id="vehicle_type" class="form-control"
                                                            placeholder="Vehicle Type">
                                                        @error('vehicle_type')
                                                            <span class="text-danger">
                                                                <small>{{ $message }}</small>
                                                            </span>
                                                        @enderror
                                                    </div>

                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12 mt-1">
                                                        <label for="description"><small
                                                                class="text-dark">Description</small></label>
                                                        <textarea class="form-control" placeholder="Description Here .."
                                                            name="description" id="description" cols="30"
                                                            rows="5">{{ old('description') }}</textarea>
                                                        @error('description')
                                                            <span class="text-danger">
                                                                <small>{{ $message }}</small>
                                                            </span>
                                                        @enderror
                                                    </div>

                                                </div>

                                                <div class="row mt-1">
                                                    <div class="col-md-4">
                                                        <label for="turnno"><small
                                                                class="text-dark">Image (150 x 96)</small></label><br>
                                                        <label for="image">
                                                            <div class="file-field">
                                                                <div class="z-depth-1-half">
                                                                    <img id="imageview"
                                                                        src="https://mdbootstrap.com/img/Photos/Others/placeholder.jpg"
                                                                        class="img-fluid img-thumbnail rounded mx-auto d-block"
                                                                        alt="Responsive image">
                                                                </div>
                                                            </div>
                                                        </label>
                                                        <input class="d-none" name="image" type="file" id="image">
                                                        <label for="image" class="btn btn-primary w-100">Choose</label>
                                                    </div>
                                                </div>
                                                <div class="row mt-2">
                                                    <div class="col-md-12">
                                                        <label for="status"><small>Status
                                                                {!! required_mark() !!}</small></label>
                                                        <select class="form-control" name="status" id="status">
                                                            <option {{ old('status') == 1 ? 'selected' : '' }} value="1">
                                                                Active
                                                            </option>
                                                            <option {{ old('status') == 2 ? 'selected' : '' }} value="2">
                                                                Inactive
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
                                                            class="btn btn-success w-100" type="submit"
                                                            value="Submit">
                                                    </div>
                                                    <div class="col-md-6 mt-md-0 mt-1"><input
                                                            class="btn btn-danger w-100" type="button"
                                                            form="vehicle_type_form" id="resetbtn" value="Reset"></div>
                                                </div>

                                            </div>


                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Vehicle Type List</h4>
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
                                    <div class="table-responsive">
                                        <table class="table" id="vehicleTypeTable">
                                            <thead>
                                                <tr>
                                                    <th>Image</th>
                                                    <th>Vehicle Type</th>
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
        let listTable = $('#vehicleTypeTable').DataTable({
            lengthMenu: [
                [10, 25, 50, -1],
                [10, 25, 50, "All"]
            ],
            serverSide: true,
            responsive: true,
            language: {
                searchPlaceholder: "Search By Vehicle Type"
            },
            ajax: "{{ route('admin.vehicletypes.list') }}",
            columns: [{
                    name: 'path',
                    orderable: false,
                    searchable: false
                },
                {
                    name: 'type'
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
                    url: "{{ route('admin.vehicletypes.get.one') }}",
                    data: {
                        'id': id
                    },
                    success: function(response) {
                        $('#vehicle_type').val(response.type);
                        $('#vehicle_no').val(response.number);
                        $('#imageview').attr('src', response.path);
                        $('#status').val(response.status);
                        $('#description').val(response.description);
                        $('#record').val(response.id);
                        $('#isnew').val('2').trigger('change');
                    }
                });
            });
        }

        function doDelete(id) {
            showAlert('Are you sure to delete this record ?', function() {
                window.location = "{{ route('admin.vehicletypes.delete.one') }}?id=" + id;
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
