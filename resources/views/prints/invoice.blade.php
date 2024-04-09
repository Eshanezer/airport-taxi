<!DOCTYPE>
<html>

<head>
    <title>#{{ $invoice->refno }}</title>

    <style type="text/css">
        body {
            margin-top: 0px;
            margin-left: 0px;
        }

        #page_1 {
            position: relative;
            overflow: hidden;
            margin: 19px 0px 20px 35px;
            padding: 0px;
            border: none;
            width: 758px;
        }

        #page_1 #id1_1 {
            border: none;
            margin: 0px 0px 0px 0px;
            padding: 0px;
            border: none;
            width: 758px;
            overflow: hidden;
        }

        #page_1 #id1_2 {
            border: none;
            margin: 450px 0px 0px 708px;
            padding: 0px;
            border: none;
            width: 50px;
            overflow: hidden;
        }

        #page_1 #p1dimg1 {
            position: absolute;
            top: 233px;
            left: 36px;
            z-index: -1;
            width: 658px;
            height: 1px;
            font-size: 1px;
            line-height: nHeight;
        }

        #page_1 #p1dimg1 #p1img1 {
            width: 658px;
            height: 1px;
        }

        .footer {
            font: 8px 'Arial';
        }


        .ft0 {
            font: 11px 'Arial';
            line-height: 14px;
        }

        .ft1 {
            font: bold 19px 'Times New Roman';
            line-height: 22px;
        }

        .ft2 {
            font: 12px 'Times New Roman';
            line-height: 15px;
        }

        .ft3 {
            font: 1px 'Times New Roman';
            line-height: 1px;
        }

        .ft4 {
            font: 1px 'Times New Roman';
            line-height: 4px;
        }

        .ft5 {
            font: bold 12px 'Times New Roman';
            line-height: 15px;
        }

        .ft6 {
            font: 11px 'Times New Roman';
            line-height: 14px;
        }

        .ft7 {
            font: 13px 'Times New Roman';
            line-height: 15px;
        }

        .ft8 {
            font: bold 18px 'Times New Roman';
            line-height: 20px;
        }

        .ft9 {
            font: bold 13px 'Times New Roman';
            line-height: 15px;
        }

        .ft10 {
            font: 1px 'Times New Roman';
            line-height: 14px;
        }

        .ft11 {
            font: 10px 'Times New Roman';
            line-height: 10px;
        }

        .p0 {
            text-align: left;
            margin-top: 0px;
            margin-bottom: 0px;
        }

        .p1 {
            margin-top: 20px;
            margin-bottom: 0px;
        }

        .p2 {
            margin-top: 3px;
            margin-bottom: 0px;
        }

        .p3 {
            margin-top: 0px;
            margin-bottom: 0px;
        }

        .p4 {
            margin-top: 0px;
            margin-bottom: 0px;
        }

        .p5 {
            text-align: left;
            margin-top: 0px;
            margin-bottom: 0px;
            white-space: nowrap;
        }

        .p6 {
            text-align: left;
            padding-left: 11px;
            margin-top: 0px;
            margin-bottom: 0px;
            white-space: nowrap;
        }

        .p7 {
            text-align: left;
            padding-left: 88px;
            margin-top: 0px;
            margin-bottom: 0px;
            white-space: nowrap;
        }

        .p8 {
            text-align: left;
            padding-left: 4px;
            margin-top: 0px;
            margin-bottom: 0px;
            white-space: nowrap;
        }

        .p9 {
            text-align: right;
            padding-right: 19px;
            margin-top: 0px;
            margin-bottom: 0px;
            white-space: nowrap;
        }

        .p10 {
            text-align: right;
            padding-right: 1px;
            margin-top: 0px;
            margin-bottom: 0px;
            white-space: nowrap;
        }

        .p11 {
            text-align: left;
            padding-left: 1px;
            margin-top: 0px;
            margin-bottom: 0px;
            white-space: nowrap;
        }

        .p12 {
            text-align: left;
            padding-left: 5px;
            margin-top: 0px;
            margin-bottom: 0px;
            white-space: nowrap;
        }

        .p13 {
            text-align: right;
            padding-right: 2px;
            margin-top: 0px;
            margin-bottom: 0px;
            white-space: nowrap;
        }

        .p14 {
            text-align: left;
            padding-left: 70px;
            margin-top: 0px;
            margin-bottom: 0px;
            white-space: nowrap;
        }

        .p15 {
            text-align: left;
            padding-left: 141px;
            margin-top: 10px;
            margin-bottom: 0px;
        }

        .td0 {
            padding: 0px;
            margin: 0px;
            width: 165px;
            vertical-align: bottom;
        }

        .td1 {
            padding: 0px;
            margin: 0px;
            width: 188px;
            vertical-align: bottom;
        }

        .td2 {
            padding: 0px;
            margin: 0px;
            width: 191px;
            vertical-align: bottom;
        }

        .td3 {
            padding: 0px;
            margin: 0px;
            width: 88px;
            vertical-align: bottom;
        }

        .td4 {
            padding: 0px;
            margin: 0px;
            width: 26px;
            vertical-align: bottom;
        }

        .td5 {
            border-bottom: #000000 1px solid;
            padding: 0px;
            margin: 0px;
            width: 165px;
            vertical-align: bottom;
        }

        .td6 {
            border-bottom: #000000 1px solid;
            padding: 0px;
            margin: 0px;
            width: 188px;
            vertical-align: bottom;
        }

        .td7 {
            border-bottom: #000000 1px solid;
            padding: 0px;
            margin: 0px;
            width: 191px;
            vertical-align: bottom;
        }

        .td8 {
            border-bottom: #000000 1px solid;
            padding: 0px;
            margin: 0px;
            width: 88px;
            vertical-align: bottom;
        }

        .td9 {
            border-bottom: #000000 1px solid;
            padding: 0px;
            margin: 0px;
            width: 26px;
            vertical-align: bottom;
        }

        .td10 {
            padding: 0px;
            margin: 0px;
            width: 353px;
            vertical-align: bottom;
        }

        .td11 {
            padding: 0px;
            margin: 0px;
            width: 114px;
            vertical-align: bottom;
        }

        .td12 {
            padding: 0px;
            margin: 0px;
            width: 379px;
            vertical-align: bottom;
        }

        .tr0 {
            height: 19px;
        }

        .tr1 {
            height: 15px;
        }

        .tr2 {
            height: 30px;
        }

        .tr3 {
            height: 23px;
        }

        .tr4 {
            height: 4px;
        }

        .tr5 {
            height: 22px;
        }

        .tr6 {
            height: 29px;
        }

        .tr7 {
            height: 16px;
        }

        .tr8 {
            height: 25px;
        }

        .tr9 {
            height: 14px;
        }

        .tr10 {
            height: 18px;
        }

        .tr11 {
            height: 21px;
        }

        .t0 {
            width: 658px;
            margin-left: 36px;
            margin-top: 34px;
            font: 12px 'Times New Roman';
        }

    </style>
</head>

<body>
    <div id="page_1">
        <div id="p1dimg1">
            <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAApIAAAABCAIAAADih9n1AAAALUlEQVQ4jWNgYGD4//8/AwMDnEE3Lv1tHPXaqNdGvTa8uQPugFGvjXqN1l4DAJRdDB9lpgKkAAAAAElFTkSuQmCC"
                id="p1img1">
        </div>


        <div id="id1_1">

            <center>
                <p class="p1 ft1">AYUBOWAN TOURS & TRAVELS (PVT) LTD.</p>
                <p class="p2 ft2">NO 15, RANAMOTO SHOPPING COMPLEX, COLOMBO ROAD, NEGAMBO</p>
                <p class="p3 ft2">ARRIVAL TERMINAL - BANDARANAYAKE INTERNATIONAL AIRPORT, KATUNAYAKE</p>
                <p class="p4 ft2">TEL : 031 222 5900 | MAIL : INFO@AYUBOWANTOURS.COM | WEB :
                    WWW.AYUBOWANTOURS.COM</p>
            </center>

            <table cellpadding=0 cellspacing=0 class="t0">

                <tr>
                    <td class="tr1 td0">
                        <p class="p5 ft2">PASSENGER NAME</p>
                    </td>
                    <td class="tr1 td1">
                        <p class="p6 ft2">
                            <nobr>{{ Str::upper($invoice->passenger ? $invoice->passenger : '-') }}</nobr>
                        </p>
                    </td>
                    <td class="tr1 td2">
                        <p class="p5 ft3">&nbsp;</p>
                    </td>
                    <td class="tr1 td3">
                        <p class="p5 ft3">&nbsp;</p>
                    </td>
                    <td class="tr1 td4">
                        <p class="p5 ft3">&nbsp;</p>
                    </td>
                </tr>
                <tr>
                    <td class="tr1 td0">
                        <p class="p5 ft2">INVOICE DATE</p>
                    </td>
                    <td class="tr1 td1">
                        <p class="p6 ft2">
                            <nobr>{{ $invoice->date }}</nobr>
                        </p>
                    </td>
                    <td class="tr1 td2">
                        <p class="p5 ft3">&nbsp;</p>
                    </td>
                    <td class="tr1 td3">
                        <p class="p5 ft3">&nbsp;</p>
                    </td>
                    <td class="tr1 td4">
                        <p class="p5 ft3">&nbsp;</p>
                    </td>
                </tr>
                <tr>
                    <td class="tr1 td0">
                        <p class="p5 ft2">INVOICE NO</p>
                    </td>
                    <td class="tr1 td1">
                        <p class="p6 ft2">#{{ $invoice->refno }}</p>
                    </td>
                    <td class="tr1 td2">
                        <p class="p5 ft3">&nbsp;</p>
                    </td>
                    <td class="tr1 td3">
                        <p class="p5 ft3">&nbsp;</p>
                    </td>
                    <td class="tr1 td4">
                        <p class="p5 ft3">&nbsp;</p>
                    </td>
                </tr>
                <tr>
                    <td class="tr1 td0">
                        <p class="p5 ft2">NO OF PAX</p>
                    </td>
                    <td class="tr1 td1">
                        <p class="p6 ft2">{{ $invoice->pax }}</p>
                    </td>
                    <td class="tr1 td2">
                        <p class="p5 ft3">&nbsp;</p>
                    </td>
                    <td class="tr1 td3">
                        <p class="p5 ft3">&nbsp;</p>
                    </td>
                    <td class="tr1 td4">
                        <p class="p5 ft3">&nbsp;</p>
                    </td>
                </tr>
                <tr>
                    <td class="tr2 td0">
                        <p class="p5 ft2">REPRESENTATIVE NAME</p>
                    </td>
                    <td class="tr2 td1">
                        <p class="p5 ft3">&nbsp;</p>
                    </td>
                    <td class="tr2 td2">
                        <p class="p7 ft2">DCC</p>
                    </td>
                    <td class="tr2 td3">
                        <p class="p5 ft3">&nbsp;</p>
                    </td>
                    <td class="tr2 td4">
                        <p class="p5 ft3">&nbsp;</p>
                    </td>
                </tr>
                <br>
                <tr>
                    <td class="tr3 td0">
                        <p class="p5 ft2">{{ Str::upper($invoice['representativedata']->first_name) }}
                            {{ Str::upper($invoice['representativedata']->last_name) }}</p>
                    </td>
                    <td class="tr3 td1">
                        <p class="p5 ft3">&nbsp;</p>
                    </td>
                    <td class="tr3 td2">
                        <p class="p7 ft2">{{ $invoice->dcc }}</p>
                    </td>
                    <td class="tr3 td3">
                        <p class="p5 ft3">&nbsp;</p>
                    </td>
                    <td class="tr3 td4">
                        <p class="p5 ft3">&nbsp;</p>
                    </td>
                </tr>
                <tr>
                    <td class="tr2 td0">
                        <p class="p5 ft2">START LOCATION</p>
                    </td>
                    <td class="tr2 td1">
                        <p class="p8 ft2">END LOCATION</p>
                    </td>
                    <td class="tr2 td2">
                        <p class="p5 ft2">VEHICLE TYPE</p>
                    </td>
                    <td class="tr2 td3">
                        <p class="p9 ft2">KM</p>
                    </td>
                    <td class="tr2 td4">
                        <p class="p10 ft2">PRICE</p>
                    </td>
                </tr>
                <tr>
                    <td class="tr4 td5">
                        <p class="p5 ft4">&nbsp;</p>
                    </td>
                    <td class="tr4 td6">
                        <p class="p5 ft4">&nbsp;</p>
                    </td>
                    <td class="tr4 td7">
                        <p class="p5 ft4">&nbsp;</p>
                    </td>
                    <td class="tr4 td8">
                        <p class="p5 ft4">&nbsp;</p>
                    </td>
                    <td class="tr4 td9">
                        <p class="p5 ft4">&nbsp;</p>
                    </td>
                </tr>
                @php
                    $extra = 0;
                    $extraDivide = 0;
                @endphp
                @foreach ($invoice['pricingrecords'] as $rec)
                    <tr>
                        <td class="tr5 td0">
                            <p class="p5 ft2">{{ Str::upper($rec['startdata']->location) }}</p>
                        </td>
                        <td class="tr5 td1">
                            <p class="p8 ft2">{{ Str::upper($rec['enddata']->location) }}</p>
                        </td>
                        <td class="tr5 td2">
                            <p class="p5 ft2">{{ Str::upper($rec['vehicletypedata']->type) }}</p>
                        </td>
                        <td class="tr5 td4">
                            <p class="p9 ft2">{{ $rec->km ? $rec->km : 'N/A' }}</p>
                        </td>
                        <td class="tr5 td3">
                            <p class="p10 ft2">{{ format_currency($rec->journey_price) }}</p>
                        </td>
                    </tr>
                    @php
                        $extra += $rec->extra;
                        $extraDivide += $rec->extra != 0 ? 1 : 0;
                    @endphp
                @endforeach

                @php
                    if ($extraDivide > 0) {
                        $extra = $extra / $extraDivide;
                    }
                @endphp
                <tr>
                    <td class="tr4 td5">
                        <p class="p5 ft4">&nbsp;</p>
                    </td>
                    <td class="tr4 td6">
                        <p class="p5 ft4">&nbsp;</p>
                    </td>
                    <td class="tr4 td7">
                        <p class="p5 ft4">&nbsp;</p>
                    </td>
                    <td class="tr4 td8">
                        <p class="p5 ft4">&nbsp;</p>
                    </td>
                    <td class="tr4 td9">
                        <p class="p5 ft4">&nbsp;</p>
                    </td>
                </tr>
                <tr>
                    <td class="tr6 td0">
                        <p class="p11 ft5">DRIVER</p>
                    </td>
                    <td class="tr6 td1">
                        <p class="p5 ft3">&nbsp;</p>
                    </td>
                    <td class="tr6 td2">
                        <p class="p5 ft3">&nbsp;</p>
                    </td>
                    <td class="tr6 td3">
                        <p class="p5 ft3">&nbsp;</p>
                    </td>
                    <td class="tr6 td4">
                        <p class="p5 ft3">&nbsp;</p>
                    </td>
                </tr>
                <tr>
                    <td colspan=2 class="tr7 td10">
                        <p class="p11 ft6">{{ Str::upper($invoice['driverdata']->turnno) }} -
                            {{ Str::upper($invoice['driverdata']->fname) }}
                            {{ Str::upper($invoice['driverdata']->lname) }} ( {{ $invoice['driverdata']->tp1 }} )
                        </p>
                    </td>
                    <td class="tr7 td2">
                        <p class="p5 ft3">&nbsp;</p>
                    </td>
                    <td class="tr7 td3">
                        <p class="p5 ft3">&nbsp;</p>
                    </td>
                    <td class="tr7 td4">
                        <p class="p5 ft3">&nbsp;</p>
                    </td>
                </tr>
                <tr>
                    <td class="tr8 td0">
                        <p class="p11 ft7"></p>
                    </td>
                    <td class="tr8 td1">
                        <p class="p5 ft3">&nbsp;</p>
                    </td>
                    <td class="tr8 td2">
                        <p class="p12 ft8">NET TOTAL</p>
                    </td>
                    <td colspan=2 class="tr8 td11">
                        <p class="p13 ft8">
                            {{ format_currency($invoice->journey_total - $invoice->discount_total) }}</p>
                    </td>
                </tr>
                <tr>
                    <td class="tr2 td0">
                        <p class="p5 ft2">REMARKS</p>
                    </td>
                    <td class="tr2 td1">
                        <p class="p5 ft3">&nbsp;</p>
                    </td>
                    <td class="tr2 td2">
                        <p class="p5 ft3">&nbsp;</p>
                    </td>
                    <td class="tr2 td3">
                        <p class="p5 ft3">&nbsp;</p>
                    </td>
                    <td class="tr2 td4">
                        <p class="p5 ft3">&nbsp;</p>
                    </td>
                </tr>
                <tr>
                    <td colspan="4" class="tr1 td0">
                        <p class="p5 ft2">{!! $invoice->remark ? $invoice->remark : '-' !!}</p>
                    </td>
                </tr>
                <tr>
                    <td class="tr1 td0">
                        <p class="p5 ft2"></p>
                    </td>
                    <td colspan=2 rowspan=2 class="tr6 td12">
                        <p class="p14 ft9">Visit - www.ayubowantours.com</p>
                    </td>
                    <td class="tr1 td3">
                        <p class="p5 ft3">&nbsp;</p>
                    </td>
                    <td class="tr1 td4">
                        <p class="p5 ft3">&nbsp;</p>
                    </td>
                </tr>
                <tr>
                    <td class="tr9 td0">
                        <p class="p5 ft10">&nbsp;</p>
                    </td>
                    <td class="tr9 td3">
                        <p class="p5 ft10">&nbsp;</p>
                    </td>
                    <td class="tr9 td4">
                        <p class="p5 ft10">&nbsp;</p>
                    </td>
                </tr>
                <tr>
                    <td class="tr10 td0">
                        <p class="p5 ft3">&nbsp;</p>
                    </td>
                    <td colspan=2 class="tr10 td12">
                        <p class="p7 ft9">Contact No : 0777 155 700</p>
                    </td>
                    <td class="tr10 td3">
                        <p class="p5 ft3">&nbsp;</p>
                    </td>
                    <td class="tr10 td4">
                        <p class="p5 ft3">&nbsp;</p>
                    </td>
                </tr>
                <tr>
                    <td class="tr11 td0">
                        <p class="p11 ft11">Signature of the guest</p>
                    </td>
                    <td class="tr11 td1">
                        <p class="p5 ft3">&nbsp;</p>
                    </td>
                    <td class="tr11 td2">
                        <p class="p5 ft3">&nbsp;</p>
                    </td>
                    <td colspan=2 class="tr11 td11">
                        <p class="p13 ft11">Signature of the Representative</p>
                    </td>
                </tr>
            </table>
            <br>


        </div>
        @if ($extra > 0)
            <center>
                <p class="footer">
                    {{ Str::upper('EVERY EXtrA KILO METER THAT EXCEEDS THE DISTANCE INDICATED IN THE BILL WILL BE CHARGED AT ' . $extra . ' LKR') }}
                </p>
            </center>
        @endif
        <div id="id1_2">
            <p class="p0 ft0">1/1</p>
        </div>
    </div>
</body>

</html>
