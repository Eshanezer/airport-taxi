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
                                <h4 class="card-title">Filters</h4>
                                <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                                <div class="heading-elements">
                                    <ul class="list-inline mb-0">
                                        <li><a onclick="resetFilters()" data-action="reload"><i
                                                    class="ft-rotate-cw"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="card-content collapse show">
                                <div class="card-body pt-0">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <label for="from"><small class="text-dark">From
                                                            Date</small></label>
                                                    <input type="date" name="from" id="from" class="form-control"
                                                        placeholder="From Date">
                                                </div>
                                                <div class="col-md-3">
                                                    <label for="to"><small class="text-dark">To
                                                            Date</small></label>
                                                    <input type="date" name="to" id="to" class="form-control"
                                                        placeholder="To Date">
                                                </div>
                                                <div class="col-md-3">
                                                    <label for="driver"><small class="text-dark">Driver</small></label>
                                                    <br>
                                                    <select class="form-control select2reset" name="driver" id="driver">
                                                        <option selected disabled></option>
                                                        @foreach ($drivers as $driver)
                                                            <option {{ old('driver') == $driver->id ? 'selected' : '' }}
                                                                value="{{ $driver->id }}">
                                                                {{ $driver->turnno }} -
                                                                {{ $driver->fname }}
                                                                {{ $driver->lname }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-md-3">
                                                    <label for="representative"><small
                                                            class="text-dark">Representative</small></label>
                                                    <br>
                                                    <select class="form-control select2reset" name="representative"
                                                        id="representative">
                                                        <option selected disabled></option>
                                                        @foreach ($representatives as $representative)
                                                            <option
                                                                {{ old('representative') == $representative->id ? 'selected' : '' }}
                                                                value="{{ $representative->id }}">
                                                                {{ $representative->first_name }}
                                                                {{ $representative->last_name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row mt-3">
                                                <div class="col-md-12">
                                                    <button id="filterbtn" class="btn btn-info float-right ml-1"
                                                        onclick="reloadTable()">Filter Data</button>
                                                    <button onclick="exportData()"
                                                        class="btn btn-success float-right ml-1">Export Data</button>
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
                                <h4 class="card-title">Invoices</h4>
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
                                        <table class="table w-100" id="invoicetable">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Invoice No</th>
                                                    <th>DCC</th>
                                                    <th>Driver</th>
                                                    <th>Representative</th>
                                                    <th>KM</th>
                                                    <th>Journey Total</th>
                                                    <th>Discount</th>
                                                    <th>Driver Profit</th>
                                                    <th>Company Profit</th>
                                                    <th>Actions</th>
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

    <div class="modal fade" id="invoiceModal" tabindex="-1" role="dialog" aria-labelledby="invoiceModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header border border-bottom-0">
                    <h5 class="modal-title d-none" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" style="max-height: 700px; padding:0px !important" id="invoiceModalContent">
                </div>
            </div>
        </div>
    </div>

    @include('layouts.footer')
    @include('layouts.scripts')


    <script>
        let exportableIds = [];
        let fillExportable = true;
        let exportbtn = $('#exportbtn');

        var invoicetable = $('#invoicetable').DataTable({
            serverSide: true,
            lengthMenu: [
                [11, 26, 51, -1],
                [10, 25, 50, "All"]
            ],
            language: {
                searchPlaceholder: "Reference.."
            },
            responsive: true,
            ordering: false,
            ajax: {
                url: '{{ route('admin.invoice.list') }}',
                data: function(d) {
                    return $.extend(d, {
                        'from': $('#from').val(),
                        'to': $('#to').val(),
                        'driver': $('#driver').val(),
                        'representative': $('#representative').val()
                    });
                }
            },
            'columnDefs': [{
                'visible': false,
                'targets': [0]
            }],
            createdRow: function(row, data, dataIndex, cells) {
                if (fillExportable) {
                    fillExportable = false;
                    exportableIds = [];
                }
                if (data[0] != 0) {
                    exportableIds.push(data[0]);
                }
                $(cells).addClass(' align-middle datatables-sm text-avoid-break');
            },
            drawCallback: function(settings) {
                fillExportable = true;
            }
        });

        let listTable = invoicetable;

        function reloadTable() {
            invoicetable.ajax.reload();
        }

        function doView(invid) {
            showAlert('Are you sure to view this record ?', function() {
                $.ajax({
                    type: "GET",
                    url: "/invoice/view/" + invid,
                    success: function(response) {
                        if (response == 2) {
                            $.alert({
                                title: 'Alert!',
                                content: 'Invoice Not Found',
                            });
                        } else {
                            $('#invoiceModalContent').html(response);
                            $('#invoiceModal').modal('show');
                        }
                    }
                });
            });
        }

        function doDelete(invid) {
            showAlert('Are you sure to delete this record ?', function() {
                $.ajax({
                    type: "GET",
                    url: "/invoice/delete",
                    data: {
                        'id': invid
                    },
                    success: function(response) {
                        if (response == 1) {
                            invoicetable.ajax.reload();
                        }
                    }
                });
            });
        }

        function doPrint(invid) {
            showAlert('Are you sure to print this record ?', function() {
                $.ajax({
                    type: "GET",
                    url: "/invoice/view/" + invid,
                    success: function(response) {
                        if (response == 2) {
                            $.alert({
                                title: 'Alert!',
                                content: 'Invoice Not Found',
                            });
                        } else {
                            var printWindow = window.open('', 'Print-Window');
                            var doc = printWindow.document;
                            doc.write(response);
                            doc.close();

                            function show() {
                                if (doc.readyState === "complete") {
                                    printWindow.focus();
                                    printWindow.print();
                                    printWindow.document.close();
                                    setTimeout(function() {
                                        printWindow.close();
                                    }, 100);
                                } else {
                                    setTimeout(show, 100);
                                }
                            };
                            show();
                        }
                    }
                });
            });
        }

        function exportData() {
            if (exportableIds.length > 0) {
                showAlert('Are you sure to export this records ?', function() {
                    window.location = "/invoice/export/excel/" + JSON.stringify(exportableIds);;
                });
            } else {
                $.alert({
                    title: 'Alert!',
                    content: 'Nothing To Export',
                });
            }
        }

        function resetFilters(){
            $('#driver').val(null).trigger('change');
            $('#representative').val(null).trigger('change');
            $('#from').val('');
            $('#to').val('');
            reloadTable();
        }

        $('#representative').select2({
            placeholder: 'Select Representative',
            allowClear: true
        });
        $('#driver').select2({
            placeholder: 'Select Vehicle Type',
            allowClear: true
        });
        $('#start').select2({
            placeholder: 'Start Location',
            allowClear: true
        });
        $('#end').select2({
            placeholder: 'End Location',
            allowClear: true
        });
    </script>


@endsection
