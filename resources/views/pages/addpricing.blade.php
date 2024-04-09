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
                    @include('layouts.flash')
                    <div class="col-md-12">
                        <button class="btn btn-sm btn-success float-right ml-1" data-toggle="modal"
                            data-target="#importModal">Import Data</button>
                        <button id="exportbtn" class="btn btn-sm btn-danger float-right ml-1"
                            onclick="exportRecords()">Export
                            Data</button>
                    </div>
                    <div class="col-md-8 mt-2">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Add/Edit Pricing</h4>
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
                                        <table class="table" id="pricingTable">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Start Location</th>
                                                    <th>End Location</th>
                                                    <th>Route</th>
                                                    <th>Vehicle Type</th>
                                                    <th>Journey Price</th>
                                                    <th>Driver Price</th>
                                                    <th>KM</th>
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
                    <div class="col-md-4 mt-2">
                        <form action="{{ route('admin.pricing.enroll') }}" method="POST" id="pricing_form">
                            @csrf
                            <input type="hidden" id="isnew" name="isnew" value="{{ old('isnew') ? old('isnew') : '1' }}">
                            <input type="hidden" id="record" name="record"
                                value="{{ old('record') ? old('record') : '' }}">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Pricing List</h4>
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
                                                        <label for="start"><small class="text-dark">Start
                                                                Location{!! required_mark() !!}</small></label>
                                                        <select class="form-control select2reset" name="start" id="start">
                                                            <option selected disabled></option>
                                                            @foreach ($locations as $location)
                                                                <option
                                                                    {{ old('start') == $location->id ? 'selected' : '' }}
                                                                    value="{{ $location->id }}">
                                                                    {{ $location->location }}</option>
                                                            @endforeach
                                                        </select>
                                                        @error('start')
                                                            <span
                                                                class="text-danger"><small>{{ $message }}</small></span>
                                                        @enderror

                                                    </div>
                                                </div>
                                                <div class="row mt-1">
                                                    <div class="col-md-12">
                                                        <label for="end"><small class="text-dark">End
                                                                Location{!! required_mark() !!}</small></label>
                                                        <select class="form-control select2reset" name="end" id="end">
                                                            <option selected disabled></option>
                                                            @foreach ($locations as $location)
                                                                <option
                                                                    {{ old('end') == $location->id ? 'selected' : '' }}
                                                                    value="{{ $location->id }}">
                                                                    {{ $location->location }}</option>
                                                            @endforeach
                                                        </select>
                                                        @error('end')
                                                            <span
                                                                class="text-danger"><small>{{ $message }}</small></span>
                                                        @enderror

                                                    </div>
                                                </div>
                                                <div class="row mt-1">
                                                    <div class="col-md-12">
                                                        <label for="route"><small
                                                                class="text-dark">Route</small></label>
                                                        <select class="form-control select2reset" name="route" id="route">
                                                            <option selected disabled></option>
                                                            @foreach ($locations as $location)
                                                                <option
                                                                    {{ old('route') == $location->id ? 'selected' : '' }}
                                                                    value="{{ $location->id }}">
                                                                    {{ $location->location }}</option>
                                                            @endforeach
                                                        </select>
                                                        @error('route')
                                                            <span
                                                                class="text-danger"><small>{{ $message }}</small></span>
                                                        @enderror

                                                    </div>
                                                </div>
                                                <div class="row mt-1">
                                                    <div class="col-md-12">
                                                        <label for="vehicle_type"><small class="text-dark">Vehicle
                                                                Type{!! required_mark() !!}</small></label>
                                                        <select class="form-control select2reset" name="vehicle_type"
                                                            id="vehicle_type">
                                                            <option selected disabled></option>
                                                            @foreach ($vtypes as $vtype)
                                                                <option
                                                                    {{ old('vehicle_type') == $vtype->id ? 'selected' : '' }}
                                                                    value="{{ $vtype->id }}">
                                                                    {{ $vtype->type }}</option>
                                                            @endforeach
                                                        </select>
                                                        @error('vehicle_type')
                                                            <span
                                                                class="text-danger"><small>{{ $message }}</small></span>
                                                        @enderror

                                                    </div>
                                                </div>
                                                <div class="row mt-1">
                                                    <div class="col-md-12">
                                                        <label for="journey_price"><small class="text-dark">Journey
                                                                Price
                                                                {!! required_mark() !!}</small></label>
                                                        <input value="{{ old('journey_price') }}" type="number"
                                                            name="journey_price" id="journey_price" class="form-control"
                                                            placeholder="Journey Price">
                                                        @error('journey_price')
                                                            <span
                                                                class="text-danger"><small>{{ $message }}</small></span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="row mt-1">
                                                    <div class="col-md-12">
                                                        <label for="driver_price"><small class="text-dark">Driver
                                                                Price
                                                                {!! required_mark() !!}</small></label>
                                                        <input value="{{ old('driver_price') }}" type="number"
                                                            name="driver_price" id="driver_price" class="form-control"
                                                            placeholder="Driver Price">
                                                        @error('driver_price')
                                                            <span
                                                                class="text-danger"><small>{{ $message }}</small></span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="row mt-1">
                                                    <div class="col-md-12">
                                                        <label for="km"><small class="text-dark">Journey Distance
                                                                (KM)</small></label>
                                                        <input value="{{ old('km') }}" type="number" name="km" id="km"
                                                            class="form-control" placeholder="KM">
                                                        @error('km')
                                                            <span
                                                                class="text-danger"><small>{{ $message }}</small></span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="row mt-1">
                                                    <div class="col-md-12">
                                                        <label for="extra"><small class="text-dark">Extra KM (Price)</small></label>
                                                        <input value="{{ old('extra') }}" type="number" name="extra"
                                                            id="extra" class="form-control" placeholder="Extra KM">
                                                        @error('extra')
                                                            <span
                                                                class="text-danger"><small>{{ $message }}</small></span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="row mt-1">
                                                    <div class="col-md-12">
                                                        <label for="waiting"><small class="text-dark">Extra Waiting Per Hour (Price)</small></label>
                                                        <input value="{{ old('waiting') }}" type="number" name="waiting"
                                                            id="waiting" class="form-control" placeholder="Extra Waiting">
                                                        @error('waiting')
                                                            <span
                                                                class="text-danger"><small>{{ $message }}</small></span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="row mt-1">
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
                                                            form="pricing_form" id="resetbtn" value="Reset"></div>
                                                </div>
                                            </div>
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
    </div>
    <!-- END: Content-->

    <div class="modal fade" id="importModal" tabindex="-1" role="dialog" aria-labelledby="importModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form id="excel_import_form" method="post" enctype="multipart/form-data">
                <meta name="csrf-token" content="{{ csrf_token() }}" />
                <div class="modal-content">
                    <div class="modal-header border-bottom border-light">
                        <h5 class="modal-title" id="importModalLabel">Import Pricing Excel</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <div class="row">
                            <div class="col-md-12">
                                <p class="alert alert-danger"><small>Please recheck before import excel to avoid data
                                        failures
                                        and redundancies.</small></p>
                            </div>
                            <div class="col-md-12">
                                <input accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet"
                                    class="d-none" name="excel_file" type="file" id="excel_file">
                                <label for="excel_file" id="excel_file_chooser"
                                    class="btn btn-sm btn-primary w-100">Choose</label>
                            </div>
                            <div class="col-md-12">
                                <p class="alert alert-danger"><small>Do not try to refresh your page while imporing process.
                                        it
                                        will effect to your server interruption.</small></p>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer border-top border-light">
                        <button class="btn btn-info btn-sm" onclick="exportSample()">Import Sample</button>
                        <button type="submit" id="upload_excel_btn" class="btn btn-sm btn-success d-none">Start
                            Import</button>
                    </div>
            </form>
        </div>
    </div>
    </div>

    @include('layouts.footer')
    @include('layouts.scripts')

    <script>
        let exportableIds = [];
        let fillExportable = true;
        let exportbtn = $('#exportbtn');

        let listTable = $('#pricingTable').DataTable({
            lengthMenu: [
                [10, 25, 50, -1],
                [10, 25, 50, "All"]
            ],
            serverSide: true,
            responsive: true,
            ajax: "{{ route('admin.pricing.list') }}",
            columns: [{
                    name: 'id',
                    visible: false
                },
                {
                    name: 'start'
                },
                {
                    name: 'end'
                },
                {
                    name: 'route'
                },
                {
                    name: 'vehicletype'
                },
                {
                    name: 'journey_price'
                },
                {
                    name: 'driver_price'
                },
                {
                    name: 'km'
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
                if (fillExportable) {
                    fillExportable = false;
                    exportableIds = [];
                }
                exportableIds.push(data[0]);
                $(cells).addClass(' align-middle datatables-sm');
            },
            drawCallback: function(settings) {
                fillExportable = true;
            }
        });


        function doEdit(id) {
            showAlert('Are you sure to edit this record ?', function() {
                $.ajax({
                    type: "GET",
                    url: "{{ route('admin.pricing.get.one') }}",
                    data: {
                        'id': id
                    },
                    success: function(response) {
                        $('#start').val(response.start).trigger('change');
                        $('#end').val(response.end).trigger('change');
                        $('#route').val(response.route).trigger('change');
                        $('#km').val(response.km);
                        $('#extra').val(response.extra);
                        $('#waiting').val(response.waiting);
                        $('#vehicle_type').val(response.vehicletype).trigger('change');
                        $('#journey_price').val(response.journey_price);
                        $('#driver_price').val(response.driver_price);
                        $('#status').val(response.status);
                        $('#record').val(response.id);
                        $('#isnew').val('2').trigger('change');
                    }
                });
            });
        }

        function doDelete(id) {
            showAlert('Are you sure to delete this record ?', function() {
                window.location = "{{ route('admin.pricing.delete.one') }}?id=" + id;
            });
        }

        function exportRecords() {
            if (listTable.data().count()) {
                showAlert('Are you sure to export this records ?', function() {
                    window.location = "pricing/export/excel/" + JSON.stringify(exportableIds);;
                });
            } else {
                $.alert({
                    title: 'Alert!',
                    content: 'No Data To Export',
                });
            }
        }

        function exportSample() {
            window.location = "{{ route('admin.pricing.export.excel.sample') }}";
        }

        $('#excel_import_form').submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '{{ route('admin.pricing.import.excel') }}',
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                dataType: 'json',
                beforeSend: function() {
                    $('#upload_excel_btn').html('Processing ...');
                },
                success: function(result) {
                    if (result == 1) {
                        $('#excel_file_chooser').html('Choose').removeClass('btn-success').addClass(
                            'btn-primary');
                        $('#upload_excel_btn').addClass('d-none');
                        $('#upload_excel_btn').html('Start Import');
                        $('#importModal').modal('toggle');
                        listTable.ajax.reload();
                        $.alert({
                            title: 'Success',
                            content: 'Import Process Success',
                        });
                    } else {
                        $.alert({
                            title: 'Alert!',
                            content: 'File Error',
                        });
                    }
                },
                error: function(data) {
                    $.alert({
                        title: 'Alert!',
                        content: 'Something Wrong',
                    });
                    $('#upload_excel_btn').html('Error');
                    console.log(data);
                }
            });
        });

        @if (old('record'))
            $('#record').val({{ old('record') }});
        @endif

        @if (old('isnew'))
            $('#isnew').val({{ old('isnew') }}).trigger('change');
        @endif
    </script>

    <script>
        $('#start').select2({
            placeholder: 'Select Start Location',
            allowClear: true
        });

        $('#end').select2({
            placeholder: 'Select End Location',
            allowClear: true
        });

        $('#route').select2({
            placeholder: 'Select Route',
            allowClear: true
        });

        $('#vehicle_type').select2({
            placeholder: 'Select Vehicle Type',
            allowClear: true
        });
    </script>


@endsection
