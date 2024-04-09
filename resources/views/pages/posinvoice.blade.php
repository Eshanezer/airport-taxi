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
                    <meta name="csrf-token" content="{{ csrf_token() }}" />
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Route & Invoice Records</h4>
                                <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                                <div class="heading-elements">
                                    <ul class="list-inline mb-0">
                                        <li><a onclick="resetAll()" data-action="reload"><i class="ft-rotate-cw"></i></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="card-content collapse show">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label for="start"><small class="text-dark">Start
                                                    Location{!! required_mark() !!}</small></label>
                                            <br>
                                            <select class="form-control select2reset" name="start" id="start">
                                                <option selected disabled></option>
                                                @foreach ($locations as $location)
                                                    <option
                                                        {{ old('start') == $location->id ? 'selected' : ($location->setdefault == 1 ? 'selected' : '') }}
                                                        value="{{ $location->id }}">{{ $location->location }}</option>
                                                @endforeach
                                            </select>
                                            @error('start')
                                                <span class="text-danger"><small>{{ $message }}</small></span>
                                            @enderror

                                        </div>
                                    </div>
                                    <div class="row mt-1">
                                        <div class="col-md-12">
                                            <label for="route"><small class="text-dark">Route</small></label>
                                            <br>
                                            <select class="form-control select2reset" name="route" id="route">
                                                <option selected disabled></option>
                                                @foreach ($locations as $location)
                                                    <option {{ old('route') == $location->id ? 'selected' : '' }}
                                                        value="{{ $location->id }}">{{ $location->location }}</option>
                                                @endforeach
                                            </select>
                                            @error('route')
                                                <span class="text-danger"><small>{{ $message }}</small></span>
                                            @enderror

                                        </div>
                                    </div>
                                    <div class="row mt-1">
                                        <div class="col-md-12">
                                            <label for="end"><small class="text-dark">End
                                                    Location{!! required_mark() !!}</small></label>
                                            <br>
                                            <select class="form-control select2reset" name="end" id="end">
                                                <option selected disabled></option>
                                                @foreach ($locations as $location)
                                                    <option {{ old('end') == $location->id ? 'selected' : '' }}
                                                        value="{{ $location->id }}">{{ $location->location }}</option>
                                                @endforeach
                                            </select>
                                            @error('end')
                                                <span class="text-danger"><small>{{ $message }}</small></span>
                                            @enderror

                                        </div>
                                    </div>
                                    <div class="row mt-1" id="vehicletypetitlediv">
                                        <div class="col-md-12">
                                            <label for="end"><small class="text-dark">Vehicle
                                                    Type{!! required_mark() !!}</small></label>
                                        </div>
                                    </div>
                                    <div class="row" id="vehicletypediv">
                                    </div>

                                </div>
                            </div>

                        </div>


                    </div>


                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Invoice</h4>
                                <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                                <div class="heading-elements">
                                    <ul class="list-inline mb-0">
                                        <li><a onclick="resetAll()" data-action="reload"><i class="ft-rotate-cw"></i></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="card-content collapse show">
                                <div class="card-body pt-0">
                                    <div class="row">
                                        <div class="col-md-12" id="invoicerecorddiv">
                                            <table class="table table-striped mb-2">
                                                <thead>
                                                    <tr>
                                                        <th>Start Location</th>
                                                        <th>End Location</th>
                                                        <th>Journey Price</th>
                                                        <th>KM</th>
                                                        <th>%</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="invoicerecordtable">

                                                </tbody>
                                            </table>
                                            <hr>
                                        </div>
                                    </div>
                                    <div class="row mt-1">
                                        <div class="col-md-6">
                                            <label for="turnno"><small class="text-dark">Turn
                                                    No{!! required_mark() !!}</small></label>
                                            <br>
                                            <select onchange="initiateSummary()" class="form-control select2reset"
                                                name="turnno" id="turnno">
                                                <option selected disabled></option>
                                                @foreach ($drivers as $driver)
                                                    <option {{ old('turnno') == $driver->id ? 'selected' : '' }}
                                                        value="{{ $driver->id }}">{{ $driver->turnno }} -
                                                        {{ $driver->fname }} {{ $driver->lname }}</option>
                                                @endforeach
                                            </select>
                                            @error('turnno')
                                                <span class="text-danger"><small>{{ $message }}</small></span>
                                            @enderror
                                        </div>
                                        <div class="col-md-6 mt-1 mt-md-0">
                                            <label for="representative"><small
                                                    class="text-dark">Representative{!! required_mark() !!}</small></label>
                                            <br>
                                            <select onchange="initiateSummary()" class="form-control select2reset"
                                                name="representative" id="representative">
                                                <option selected disabled></option>
                                                @foreach ($representatives as $representative)
                                                    <option
                                                        {{ old('representative') == $representative->id ? 'selected' : '' }}
                                                        value="{{ $representative->id }}">
                                                        {{ $representative->first_name }}
                                                        {{ $representative->last_name }}</option>
                                                @endforeach
                                            </select>
                                            @error('representative')
                                                <span class="text-danger"><small>{{ $message }}</small></span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row mt-1">
                                        <div class="col-md-6">
                                            <label for="passenger"><small class="text-dark">Passenger
                                                    Name</small></label>
                                            <input type="text" name="passenger" id="passenger" class="form-control"
                                                placeholder="Passenger Name">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="passport"><small class="text-dark">Passport
                                                    Number</small></label>
                                            <input type="text" name="passport" id="passport" class="form-control"
                                                placeholder="Passport Number">
                                        </div>
                                    </div>

                                    <div class="row mt-1">
                                        <div class="col-md-12">
                                            <label for="remark"><small class="text-dark">Remark</small></label>
                                            <input type="text" name="remark" id="remark" class="form-control"
                                                placeholder="Remark">
                                        </div>
                                    </div>
                                    <div class="row mt-1">
                                        <div class="col-md-6">
                                            <label for="date"><small class="text-dark">Invoice Date</small></label>
                                            <input type="date" name="date" id="date" class="form-control"
                                                placeholder="mm/dd/yyyy">
                                        </div>
                                        <div class="col-md-2">
                                            <label for="pax"><small class="text-dark">No of Pax</small></label>
                                            <input type="text" value="1" name="pax" id="pax" class="form-control"
                                                placeholder="No of Pax">
                                        </div>
                                        <div class="col-md-2">
                                            <label for="extrawaitingfield"><small class="text-dark">Extra Waiting
                                                    Hours</small></label>
                                            <input type="number" onkeyup="initiateSummary()" value="0"
                                                name="extrawaitingfield" id="extrawaitingfield" class="form-control"
                                                placeholder="Extra KM Count">
                                        </div>
                                        <div class="col-md-2">
                                            <label for="extrakmfield"><small class="text-dark">Extra KM</small></label>
                                            <input type="number" onkeyup="initiateSummary()" value="0" name="extrakmfield"
                                                id="extrakmfield" class="form-control" placeholder="Extra KM Count">
                                        </div>
                                    </div>
                                    <hr class="my-3">
                                    <div class="row justify-content-end">
                                        <div class="col-md-3 text-right">
                                            <h5>Total KM</h5>
                                            <h5>Extra KM (<span id="extrakmfieldsummary">0</span>)</h5>
                                            <h5>Waiting Hrs (<span id="extrawaitingfieldsummary"></span> Horus)</h5>
                                            <h5>Journey Price</h5>
                                            <h5>Discount (%)</h5>
                                            <h5>DCC</h5>
                                        </div>
                                        <div class="col-md-1 text-right">
                                            <h5>:</h5>
                                            <h5>:</h5>
                                            <h5>:</h5>
                                            <h5>:</h5>
                                            <h5>:</h5>
                                            <h5>:</h5>
                                        </div>
                                        <div class="col-md-3 text-right">
                                            <h5><strong id="totalkm"></strong></h5>
                                            <h5><strong id="extrakm"></strong></h5>
                                            <h5><strong id="watinghours"></strong></h5>
                                            <h5><strong id="journeypricetotal"></strong></h5>
                                            <h5><strong id="discounttotal"></strong></h5>
                                            <h5><strong id="dccval"></strong></h5>
                                        </div>
                                    </div>
                                    <hr class="my-2">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <a href="/invoice/billed/list"><button class="btn btn-warning w-100">Go To Invoices</button></a>
                                        </div>
                                        <div class="col-md-3">
                                            <button onclick="resetAll()" class="btn btn-danger w-100">Reset</button>
                                        </div>
                                        <div class="col-md-6 mt-md-0 mt-1">
                                            <button onclick="doInvoice()" id="invoicebtn"
                                                class="btn btn-success w-100"><strong>Proceed Invoice ( <span
                                                        id="totalbtn">0.00</span> )</strong></button>
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
    </div>
    <!-- END: Content-->



    @include('layouts.footer')
    @include('layouts.scripts')

    <script>
        $('#assignrepTable').DataTable();
    </script>

    <script>
        let invoicebtn = $('#invoicebtn');

        $(document).ready(function() {
            recordsFetchingProcess();
            $('#vehicletypediv').html('').hide();
            $('#vehicletypetitlediv').hide();
            $('#invoicerecorddiv').hide();
            localStorage.clear();
            initiateSummary();
            resetInvoiceDate();
            disableInvoice(true);
            initiateSummary();
            $('#start').focus();
        });

        function disableInvoice(type) {
            invoicebtn.prop("disabled", type);
        }

        $('#start').select2({
            placeholder: 'Select Start Location',
            allowClear: true
        });

        $('#end').select2({
            placeholder: 'Select End Location',
            allowClear: true
        });

        $('#route').select2({
            placeholder: 'Select Route (Optional)',
            allowClear: true
        });

        $('#representative').select2({
            placeholder: 'Select Representative',
            allowClear: true
        });

        $('#turnno').select2({
            placeholder: 'Select Turn No',
            allowClear: true
        });

        $('#start').on('change', function() {
            recordsFetchingProcess();
        });

        $('#end').on('change', function() {
            recordsFetchingProcess();
        });

        $('#route').on('change', function() {
            recordsFetchingProcess();
        });

        function recordsFetchingProcess() {
            if ($('#start').val() && $('#end').val()) {
                $.ajax({
                    type: "GET",
                    url: "{{ route('admin.start.end.get.one') }}",
                    data: {
                        'start': $('#start').val(),
                        'end': $('#end').val(),
                        'route': $('#route').val()
                    },
                    success: function(response) {
                        $('#vehicletypediv').html('').hide();
                        $('#vehicletypetitlediv').hide();
                        if (response == 2) {
                            $('#vehicletypetitlediv').hide();
                            $('#vehicletypediv').show();
                            $('#vehicletypediv').append($(
                                '<div class="col-md-12 mt-2"><p class="alert alert-danger"><small>No vehicle types found</small></p></div>'
                            ));
                        } else {
                            $('#vehicletypetitlediv').show();
                            response[0].forEach(vehicleType => {
                                if (localStorage.getItem(vehicleType.id) === null) {
                                    localStorage.setItem(vehicleType.id, JSON.stringify(vehicleType));
                                }
                            });
                            $('#vehicletypediv').html(response[1]).show();
                        }
                    }
                });
            }
        }

        let invoiceRecords = [];

        let totalJourneyPrice = 0;
        let totalDiscount = 0;
        let totalDriverPrice = 0;
        let totalkmall = 0;
        let extrakmall = 0;
        let waitingall = 0;
        let grandtotal = 0;


        function addToInvoice(pricingid) {
            if (localStorage.getItem(pricingid) !== null) {
                let newData = JSON.parse(localStorage.getItem(pricingid));
                newData['discount'] = 0;
                invoiceRecords.push(newData);
                drawInvoiceTable();
            } else {
                $.alert({
                    title: 'Alert!',
                    content: 'Data stream issue, Please try again later.',
                });
            }
        }

        function removeFromTable(index) {
            invoiceRecords.splice(index, 1);
            initiateSummary();
            drawInvoiceTable();
        }

        function drawInvoiceTable() {
            if (invoiceRecords.length > 0) {
                $('#invoicerecorddiv').show();
                $('#invoicerecordtable').html('');
                for (let index = 0; index < invoiceRecords.length; index++) {
                    const invoiceRecord = invoiceRecords[index];
                    let td1 = $(
                        '<td class="align-middle datatables-sm"><input id="start' + index + '" onkeyup="changeStart(' +
                        index + ')" value="' +
                        invoiceRecord.startdata.location +
                        '" class="form-control form-control-sm" type="text"></td>'
                    );
                    let td2 = $(
                        '<td class="align-middle datatables-sm"><input id="end' + index + '"  onkeyup="changeEnd(' +
                        index + ')" value="' +
                        invoiceRecord.enddata.location +
                        '" class="form-control form-control-sm" type="text"></td>'
                    );
                    let td3 = $(
                        '<td class="align-middle datatables-sm"><input id="journeyprice' + index +
                        '"  onkeyup="changeJourneyPrice(' +
                        index + ')" value="' +
                        number_format(
                            invoiceRecord.journey_price, 2, '.', '-') +
                        '" class="form-control form-control-sm" type="text"></td>'
                    );
                    let td4 = $(
                        '<td class="align-middle datatables-sm">' + ((invoiceRecord.km) ? invoiceRecord.km :
                            '<span class="badge badge-danger">N/A</span>') + '</td>'
                    );
                    let td5 = $(
                        '<td class="align-middle datatables-sm"><input id="discount' + index +
                        '" onkeyup="changeDiscount(' + index +
                        ')" value="' + invoiceRecord.discount +
                        '" class="form-control form-control-sm" type="number"></td>'
                    );
                    let td6 = $(
                        '<td class="align-middle datatables-sm"><i onclick="removeFromTable(' + index +
                        ')" class="la la-remove text-danger"></i></td>');
                    let tr = $('<tr></tr>').append(td1).append(td2).append(td3).append(td4).append(td5).append(td6);
                    $('#invoicerecordtable').append(tr);
                    initiateSummary();
                }
            } else {
                $('#invoicerecorddiv').hide();
                $('#invoicerecordtable').html('');
            }
        }

        function changeStart(index) {
            let input = $('#start' + index);
            let start = (input.val()) ? input.val() : '';
            invoiceRecords[index].startdata.location = start;
            initiateSummary();
        }

        function changeEnd(index) {
            let input = $('#end' + index);
            let end = (input.val()) ? input.val() : '';
            invoiceRecords[index].enddata.location = end;
            initiateSummary();
        }

        function changeJourneyPrice(index) {
            let input = $('#journeyprice' + index);
            let journeyprice = (input.val()) ? input.val() : 0;
            invoiceRecords[index].journey_price = journeyprice;
            initiateSummary();
        }

        function changeDiscount(index) {
            let input = $('#discount' + index);
            let discount = (input.val()) ? input.val() : 0;
            invoiceRecords[index].discount = discount;
            initiateSummary();
        }

        function initiateSummary() {

            totalDriverPrice = 0;
            totalJourneyPrice = 0;
            totalDiscount = 0;
            totalkmall = 0;
            extrakmall = 0;
            waitingall = 0;
            grandtotal = 0;

            var extraCount = 0
            var WaitingCount = 0

            invoiceRecords.forEach(invoiceRecord => {
                totalJourneyPrice += Number(invoiceRecord.journey_price);
                totalDriverPrice += Number(invoiceRecord.driver_price);
                totalDiscount += Number(invoiceRecord.discount);
                extrakmall += Number(invoiceRecord.extra);
                waitingall += Number(invoiceRecord.waiting);
                totalkmall += Number(((invoiceRecord.km != '' && invoiceRecord.km) ? invoiceRecord.km : 0));

                if (invoiceRecord.extra != 0) {
                    extraCount++;
                }
                if (invoiceRecord.waiting != 0) {
                    WaitingCount++;
                }
            });

            var extrakmfieldtotal = (($('#extrakmfield').val()) ? Number($('#extrakmfield').val()) : 0);
            var waitingalltotal = (($('#extrawaitingfield').val()) ? Number($('#extrawaitingfield').val()) : 0);


            if (invoiceRecords.length > 0) {
                if (extraCount > 0) {
                    extrakmall = (Number(extrakmall) / extraCount) * extrakmfieldtotal;
                }
                if (WaitingCount > 0) {
                    waitingall = (Number(waitingall) / WaitingCount) * waitingalltotal;
                }
            }


            let totalkm = $('#totalkm');
            let extrakm = $('#extrakm');
            let watinghours = $('#watinghours');
            let journeypricetotal = $('#journeypricetotal');
            let discounttotal = $('#discounttotal');
            let dccval = $('#dccval');
            let totalbtn = $('#totalbtn');
            let extrakmfieldsummary = $('#extrakmfieldsummary');
            let extrawaitingfieldsummary = $('#extrawaitingfieldsummary');

            extrakmfieldsummary.html(extrakmfieldtotal);
            extrawaitingfieldsummary.html(waitingalltotal);
            totalkm.html(totalkmall);
            extrakm.html('{{ env('CURRENCY') }} ' + number_format(extrakmall, 2, '.', ','));
            watinghours.html('{{ env('CURRENCY') }} ' + number_format(waitingall, 2, '.', ','));
            journeypricetotal.html('{{ env('CURRENCY') }} ' + number_format(Number(totalJourneyPrice), 2, '.', ','));
            discounttotal.html('{{ env('CURRENCY') }} ' + number_format(Number(totalDiscount), 2, '.', ','));
            dccval.html(new Date().getFullYear() + '/' + (Number(totalJourneyPrice) - Number(totalDriverPrice)) + '/' + (
                Number(totalDriverPrice) - Number(totalDiscount)));

            grandtotal += (Number(extrakmall) + Number(waitingall) + Number(totalJourneyPrice)) - Number(totalDiscount);

            totalbtn.html(number_format(grandtotal, 2, '.', ','));


            if ($('#turnno').val() && $('#turnno').val() != '' && $('#representative').val() && $('#representative')
                .val() != '' && $('#pax').val() && $('#date').val() && invoiceRecords.length > 0) {
                disableInvoice(false);
            }
        }

        function resetAll() {

            invoiceRecords = [];
            localStorage.clear();

            $('#start').val(null).trigger('change');
            $('#route').val(null).trigger('change');
            $('#end').val(null).trigger('change');

            $('#invoicerecorddiv').hide();
            $('#invoicerecordtable').html('');

            $('#turnno').val(null).trigger('change');
            $('#representative').val(null).trigger('change');

            $('#remark').val('');
            $('#passenger').val('');
            $('#passport').val('');
            $('#pax').val(1);
            $('#extrawaitingfield').val('');
            $('#extrakmfield').val('');

            disableInvoice(true);

            $('#extrakmfieldsummary').html(0);
            $('#extrawaitingfieldsummary').html(0);

            initiateSummary();

            totalDriverPrice = 0;
            totalJourneyPrice = 0;
            totalDiscount = 0;
            totalkmall = 0;
            extrakmall = 0;
            waitingall = 0;
            grandtotal = 0;

            $('#start').focus();

            $('#vehicletypediv').html('');
            $('#vehicletypetitlediv').hide();
            $('#invoicerecorddiv').hide();
        }

        function resetInvoiceDate() {
            var todayDate = new Date();
            $('#date').val(todayDate.getFullYear() + '-' + ('0' + (todayDate.getMonth() + 1)).slice(-2) + '-' + ('0' +
                todayDate.getDate()).slice(-2));
        }

        function number_format(number, decimals, dec_point, thousands_point) {

            if (number == null || !isFinite(number)) {
                throw new TypeError("number is not valid");
            }

            if (!decimals) {
                var len = number.toString().split('.').length;
                decimals = len > 1 ? len : 0;
            }

            if (!dec_point) {
                dec_point = '.';
            }

            if (!thousands_point) {
                thousands_point = ',';
            }

            if (thousands_point == '-') {
                thousands_point = '';
            }

            number = parseFloat(number).toFixed(decimals);

            number = number.replace(".", dec_point);

            var splitNum = number.split(dec_point);
            splitNum[0] = splitNum[0].replace(/\B(?=(\d{3})+(?!\d))/g, thousands_point);
            number = splitNum.join(dec_point);

            return number;
        }

        function doInvoice() {
            if ($('#turnno').val() && $('#representative').val() && $('#pax').val() && $('#date').val() && invoiceRecords
                .length > 0) {
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: "GET",
                    url: "{{ route('admin.invoice.enroll') }}",
                    data: {
                        'driver': $('#turnno').val(),
                        'representative': $('#representative').val(),
                        'passenger': $('#passenger').val(),
                        'passport': $('#passport').val(),
                        'remark': $('#remark').val(),
                        'date': $('#date').val(),
                        'pax': $('#pax').val(),
                        'kmtotal': totalkmall,
                        'waiting': $('#extrawaitingfield').val(),
                        'extrakm': $('#extrakmfield').val(),
                        'extrakmtotal': extrakmall,
                        'waitingtotal': waitingall,
                        'driver_total': totalDriverPrice,
                        'journey_total': totalJourneyPrice,
                        'discount_total': totalDiscount,
                        'grand_total': grandtotal,
                        'invoicerecords': invoiceRecords
                    },
                    success: function(response) {
                        if (response == 2) {
                            $.alert({
                                title: 'Alert!',
                                content: 'Something Wrong !, Please contact administrator.',
                            });
                        } else {
                            showAlert('Are you sure to print this report ?', function() {
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
                                            resetAll();
                                            printWindow.close();
                                            // location.reload();
                                        }, 100);
                                    } else {
                                        setTimeout(show, 100);
                                    }
                                };
                                show();

                            });

                        }
                    }
                });
            } else {
                disableInvoice(true);
            }

        }
    </script>


@endsection
