<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Mode of Payment</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <link rel="stylesheet" href="billInvoiceStylesheet.css">
</head>

<body>
    <?php
    include 'navBar.php';
?>


    <div class="container d-flex my-5">
        <div class="py-5">
            <img src="http://kokolevel.com/wp-content/uploads/2019/10/payment-methods.png" alt=""
                 style="max-width: 500px;" />
        </div>
        <div class="p-4"></div>
        <div class="px-5 d-flex align-items-center">
            <form class="paymentMode">
                <div class="modeOfPayment pb-2">Please select mode of payment:</div>
                <input type="radio" name="paymentMode" value="cardPayment"> Card Payment
                <br>
                <input type="radio" name="paymentMode" value="payPal"> Paypal
                <br><br>
                <button type="button" class="btn btn-lg btn-primary text-center">Next</button>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js"
            integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk"
            crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.min.js"
            integrity="sha384-kjU+l4N0Yf4ZOJErLsIcvOU2qSb74wXpOhqTvwVx3OElZRweTnQ6d31fXEoRD1Jy"
            crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2"
            crossorigin="anonymous"></script>
</body>

</html>
