<!DOCTYPE html>
<html lang="en">

<head>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet">
     <!--<link href="https://cdn.usebootstrap.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet"> -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OFFICIAL Invoice</title>
    <style>
    body {
        font-family: 'Verdana', sans-serif;
        margin: 0;
        padding: 0;
    }



    .header {
        text-align: center;
        /* background-color: #2c3e50; */
        /* color: #fff; */
        padding: 15px;
    }

    .details {
        margin-top: 20px;
    }

    .details p {
        margin: 5px 0;
    }

    .table-container {
        margin-top: 20px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }

    th,
    td {
        border: 1px solid #ddd;
        padding: 15px;
        text-align: left;
    }

    th {
        background-color: #2c3e50;
        color: #fff;
    }

    .total {
        margin-top: 20px;
        text-align: right;
        font-weight: bold;
        font-size: 18px;
        color: #e74c3c;
    }

    .footer {
        margin-top: 100px;
        /* text-align: center; */
        color: black;
    }

    .f-inline-end {
        float: inline-end;
    }

    .pro-address {
        font-weight: bold;
        font-size: 16px;
    }

    .pro-address-inside {
        font-size: 14px;
    }

    .mt-2-0 {
        margin-top: 2px;
    }

    .end-align {
        text-align: end;
    }

    .fs-12 {
        font-size: 12px;
    }

    .m-auto-r {
        margin: auto;
        margin-right: 18px;
    }

    .mt-50 {
        margin-top: 100px;
    }

    .mb-0 {
        margin-bottom: 0px;
    }
    .col-md-12{
        width : 100%;
        padding-left:15px;
        padding-right:15px;
        display:inline-flex;
    }
    .col-md-8{
        width : 78.66%;
        padding-left:15px;
        padding-right:15px;
        display:inline-block;
    }
    .col-md-4{
        width : 21.33%;
        padding-left:15px;
        padding-right:15px;
        display:inline-block;
    }
    </style>
</head>

<body>
    <div class="">
        <div class="">
             <div class=" ">
            <table style="border-collapse: collapse;">
               <thead>
                    <tr>
                        <!--<th>ITEM</th>-->
                        <!--<th>DESCRIPTION</th>-->
                    </tr>
                </thead>
                <tbody>
                    <tr> 
                        <td  style="border-style : hidden!important;width: 30%;"> 
                            <div>
                                <img src="asset/images/{{ @$invsetting['logo']}}" alt="Company Logo" width="70%">
                            </div>
                        </td>
                        <td colspan="3" style="border-style : hidden!important;">
                            <div> 
                                <p class="mb-0">{{ @$invsetting['company_name']}}</p>
                                <p class="mb-0"> {{ @$invsetting['company_address']}}</p>
                                <p class="mb-0">Tel:{{ @$invsetting['contact'] }}<span class="ml-3"> Fax No. {{ @$invsetting['company_fax'] }}</span></p>
                                <p class="mb-0"><strong>SST_ID:</strong> {{ @$invsetting['sst_id']}}</p>
                                <p class="mb-0"><strong>Agent_id:</strong> {{ @$invsetting['agent_id']}}</p>
                                <p class="mb-0"><strong>Date:</strong> {{ date("Y-m-d") }}</p>
                                <p class="mb-0"><strong>Invoice No:</strong> {{ @$data['invoice_number']}}</p>
                            </div>
                        </td>

                    </tr>

                </tbody>
            </table>
        </div>
        <!-- <div class="col-md-12">-->
        <!--    <div class="logo col-md-4">-->
        <!--        {{-- Left-side logo --}}-->
        <!--        <img src="asset/images/{{ @$invsetting['logo']}}" alt="Company Logo" width="100%">-->
        <!--    </div>-->
        <!--    <div class=" col-md-8">-->
        <!--        <p class="mb-0">{{ @$invsetting['company_name']}}</p>-->
        <!--        <p class="mb-0"> {{ @$invsetting['company_address']}}</p>-->
        <!--        <p class="mb-0">Tel:{{ @$invsetting['contact'] }}<span class="ml-3"> Fax No. {{ @$invsetting['company_fax'] }}</span></p>-->
        <!--        <p class="mb-0"><strong>SST_ID:</strong> {{ @$invsetting['sst_id']}}</p>-->
        <!--        <p class="mb-0"><strong>Agent_id:</strong> {{ @$invsetting['agent_id']}}</p>-->
        <!--        <p class="mb-0"><strong>Date:</strong> {{ date("Y-m-d") }}</p>-->
        <!--        <p class="mb-0"><strong>Invoice No:</strong> {{ @$data['invoice_number']}}</p>-->
        <!--    </div>-->
        <!--</div>-->
        <div class="header">
            <h3>OFFICIAL @if($type == 'invoice')  INVOICE @else Receipt @endif   </h3>
            <p class="mb-0">SST ID : {{ @$invsetting['sst_id']}}</p>
        </div>
        <div class="row" style="display:flex;">
            <div class="col-md-6">
                <div class="details">
                    <p class="mb-0"><strong>To:</strong> {{ @$data['name']}}</p>
                    <p class="mb-0"><strong>IC NO / Identity No:</strong> {{@$data['identity_number'] }}</p>
                    <p class="mb-0"><strong>Invoice Type:</strong>{{ @$data['invoice_type']}}</p>
                </div>
            </div>
        </div>
        <div class="table-container ">
            <table>
                <thead>
                    <tr>
                        <th>ITEM</th>
                        <th>DESCRIPTION</th>
                        <th>AMOUNT</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach(json_decode($data['item_list']) as $key => $list )
                    <tr>

                        <td>{{ $key+1}}</td>
                        <td>
                            <div>
                                <p>{{  @$list->descriptions}}</p>
                            </div>
                        </td>
                        <td> <b> {{ formatNumber( @$list->amounts )}}</b></td>
                    </tr>
                    @endforeach
                    <tr>
                        <td></td>
                        <td class="end-align pro-address">
                            <p class="mb-0"> Sub Total (Excluding SST)</p>
                            <p class="mb-0">Service tex @ {{ @$data['service_tax'] }}%</p>
                            <p class="mb-0">Total</p>
                        </td>
                        <td>
                            <p class="mb-0"><b>RM {{ formatNumber( @$data['sub_total'] )}}</b></p>
                            <p class="mb-0"><b>RM
                                    {{ formatNumber( calculatePercentage($data['sub_total'],@$data['service_tax']) )}}</b>
                            </p>
                            <p class="mb-0"><b>RM
                                    {{ formatNumber(  $data['total'])  }}</b>
                            </p>
                        </td>
                    </tr>

                </tbody>
            </table>
        </div>



        <div class="footer">
            <p class="mb-2">Ringgit
                Malaysia:{{   convertNumberToWords($data['total'] ); }}
            </p>
        </div>
        <hr>
        <p class="fs-12">{{ @$invsetting['description']}}</p>
    </div>
</body>

</html>