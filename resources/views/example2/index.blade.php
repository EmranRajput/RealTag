<!DOCTYPE html>
<html lang="en">

<head>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet"> -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OFFICIAL INVOICE</title>
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
    </style>
</head>

<body>
    <div class="">
        <div class="">
            <p class="mb-0"><strong>Date:</strong> {{ date("Y-m-d") }}</p>
            <p class="mb-0"><strong>Invoice No:</strong> AD 10943534765</p>
        </div>
        <div class="header">
            <h3>OFFICIAL INVOICE</h3>
            <p>SST ID:W10-2103-320000076</p>
        </div>
        <div class="row" style="display:flex;">
            <div class="col-md-6">
                <div class="details">
                    <p class="mb-0"><strong>To:</strong> John Doe</p>
                    <p class="mb-0"><strong>IC NO / Identity No:</strong> 3456543543</p>
                    <p class="mb-0"><strong>Invoice Type:</strong> Deposit</p>
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
                    <tr>
                        <td>1.</td>
                        <td>
                            <div>
                                <h6 class="pro-address">Booking Fee for Property :</h6>
                                <div class="d-flex">
                                    <p class="pro-address">Property Address :</p>
                                    <p class="pro-address-inside mt-2-0"> G-345,ZWTA RESIDENCES,TAMAM TEST RIDER
                                        GOE,43000
                                    </p>
                                </div>
                            </div>
                        </td>
                        <td>$10.00</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td class="end-align pro-address">
                            <p class="mb-0"> Sub Total (Excluding SST)</p>
                            <p class="mb-0">Service tex @ 0%</p>
                            <p class="mb-0">Total</p>
                        </td>
                        <td>
                            <p class="mb-0"><b>RM 3000.00</b></p>
                            <p class="mb-0"><b>RM 0.00</b></p>
                            <p class="mb-0"><b>RM 3000.00</b></p>
                        </td>
                    </tr>

                    <!-- Add more rows as needed -->
                </tbody>
            </table>
        </div>



        <div class="footer">
            <p class="mb-2">Ringgit Malaysia:THREE THOUSAND ONLY</p>
        </div>
        <hr>
        <p class="fs-12">This O.R is generated by computer and it's subject to payment clearence only.if we notice
            cheque bounce or
            payment unclear.Therefore the O.R will be automatically voied.</p>
    </div>
</body>

</html>