<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
    <style>
    body {
        font-family: 'Arial', sans-serif;
        margin: 0;
        padding: 20px;
        background-color: #f4f4f4;
    }

    .invoice {
        background-color: #fff;
        border: 1px solid #ddd;
        padding: 20px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    h1 {
        color: #333;
    }

    p {
        margin: 5px 0;
    }

    .total {
        font-weight: bold;
        font-size: 18px;
        margin-top: 10px;
    }
    </style>
</head>

<body>
    <div class="invoice">
        <h1>Invoice</h1>

        <p><strong>Date:</strong> January 1, 2023</p>
        <p><strong>Customer:</strong> John Doe</p>

        <div class="items">
            <p><strong>Item 1:</strong> $50.00</p>
            <p><strong>Item 2:</strong> $30.00</p>
            <!-- Add more items as needed -->
        </div>

        <div class="total">
            <p>Total: $80.00</p>
        </div>
    </div>
</body>

</html>