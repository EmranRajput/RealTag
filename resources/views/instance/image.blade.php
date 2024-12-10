<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Document</title>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-7 mt-5">
                <h3>To send and receive messages,you have to authorize the instance.</h3>
                <ul>
                    <li>
                        Open whatsApp on your phone
                    </li>
                    <li>Tap <b>Menu :</b> or settings and select <b> Linked Devices</b> </li>
                    <li>Point your phone to this screen to capture the code</li>
                </ul>
            </div>
            <div class="col-md-5">
                @php $imageType = 'png' @endphp
                <img src="data:{{ $imageType }};base64,{{ base64_encode($response) }}" alt="">
            </div>
        </div>
    </div>
</body>

</html>