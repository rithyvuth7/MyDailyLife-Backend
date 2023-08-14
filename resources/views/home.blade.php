<!doctype html>
<html lang="kh">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>MyDailyLife</title>
    <link rel="stylesheet" href="{{ '/bootstrap/css/bootstrap.min.css' }}">
    <link rel="stylesheet" href="{{ '/bootstrap/font/bootstrap-icons.css' }}">
    <link rel="stylesheet" href="{{ '/bootstrap/font/bootstrap-icon-sizes.css' }}">
    <script src="{{ '/bootstrap/js/popper.min.js' }}"></script>
    <script src="{{ '/bootstrap/js/bootstrap.min.js' }}"></script>

    <link rel="stylesheet" href="{{ '/css/custom.css' }}">

    <style>
        body{
            display: flex;
            justify-content: center;
            align-items: center;
            /*height: 100vh;*/
            background-image: url("/img/ds.jpg");
        }

    </style>
</head>
<?php
    $user = \App\Models\User::find(1);
?>
<body class="min-vh-100">
    <div class="card w-75" style="min-height: 50vh">
        <div class="card-header border-0 shadow">
            <h1 class="text-center">My Money Tracking</h1>
        </div>
        <div class="justify-content-center align-items-center d-flex">
            <a class="btn btn-primary text-nowrap card-link text-center" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                Transaction
            </a>
        </div>
        <div class="card-body row justify-content-center">
            <div class="card m-0 p-0 col-6">
                <div class="card-text text-center">
                    <h3>Cash <i class="bi bi-cash"></i></h3>
                </div>

                <div class="card-body">
                    <ul class="list-group list-group-flush text-center">
                        <li class="list-group-item">{{ $user->getCashKHR() . ' KHR'}}</li>
                        <li class="list-group-item">{{ $user->getCashUSD() . ' USD'}}</li>
                    </ul>
                </div>
            </div>
            <div class="card m-0 p-0 col-6">
                <div class="card-text text-center">
                    <h3>Bank <i class="bi bi-bank"></i></h3>
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush text-center">
                        <li class="list-group-item">{{ $user->getBankBalancesKHR() . ' KHR'}}</li>
                        <li class="list-group-item">{{ $user->getBankBalancesUSD() . ' USD'}}</li>
                    </ul>
                </div>
            </div>

        </div>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form action="{{ route('transactions.store') }}" method="post">
                    @csrf
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">New Transaction</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group pb-2">
                            <input type="radio" class="" id="currency1" name="currency" checked value="KHR">
                            <label for="currency1">KHR</label>
                            <input type="radio" class="" id="currency2" name="currency" value="USD">
                            <label for="currency2">USD</label>
                        </div>
                        <div class="form-group pb-2">
                            <label for="amount">Amount</label>
                            <input type="number" class="form-control" id="amount" name="amount" required>
                        </div>
                        <div class="form-group pb-2">
                            <input type="radio" class="" id="type1" checked name="type" value="in">
                            <label for="type1">Money In</label>
                            <input type="radio" class="" id="type2" name="type" value="out">
                            <label for="type2">Money Out</label>
                        </div>
                        <div class="form-group pb-2">
                            <input type="radio" class="" id="money_type1" name="money_type" checked value="cash">
                            <label for="money_type1">Cash</label>
                            <input type="radio" class="" id="money_type2" name="money_type" value="bank">
                            <label for="money_type2">Bank</label>
                        </div>
                        <div class="form-group pb-2">
                            <label for="remark">Remark</label>
                            <textarea class="form-control" id="remark" name="remark" rows="3" required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
