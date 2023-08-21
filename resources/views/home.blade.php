
@extends('layouts.app')
<?php
$user = \App\Models\User::find(1);
?>
@section('content')
    <div class="container">
        <div class="card">
            <h1 class="card-title">My Money Tracking</h1>
            <div class="card-text">
                <div class="card">
                    <div class="card-body">
                        <h3 class="card-text">Cash <i class="bi bi-cash"></i></h3>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">{{ number_format($user->getCashKHR()) . ' KHR'}}</li>
                            <li class="list-group-item">{{ number_format($user->getCashUSD()) . ' USD'}}</li>
                        </ul>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <h3 class="card-text">Bank <i class="bi bi-bank"></i></h3>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">{{ number_format($user->getBankBalancesKHR()) . ' KHR'}}</li>
                            <li class="list-group-item">{{ number_format($user->getBankBalancesUSD()) . ' USD'}}</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Transaction</button>
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
                        <div class="mb-3">
                            <label class="form-label pe-5">Currency</label>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" id="currency1" name="currency" checked value="KHR">
                                <label class="form-check-label" for="currency1">KHR</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" id="currency2" name="currency" value="USD">
                                <label class="form-check-label" for="currency2">USD</label>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="amount">Amount</label>
                            <div class="input-group mb-3">
                                <input type="number" class="form-control" id="amount" name="amount" required>
                                <span class="input-group-text" id="basic-addon2">KHR</span>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label pe-5">Type</label>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" id="type1" checked name="type" value="in">
                                <label class="form-check-label" for="type1">Money In</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" id="type2" name="type" value="out">
                                <label class="form-check-label" for="type2">Money Out</label>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label pe-5">Money Type</label>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" id="money_type1" name="money_type" checked value="cash">
                                <label class="form-check-label" for="money_type1">Cash</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" id="money_type2" name="money_type" value="bank">
                                <label class="form-check-label" for="money_type2">Bank</label>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="remark">Remark</label>
                            <select class="form-control form-select" id="remark" name="remark" required>
                                <option value="">Select Remark Or Add New</option>
                                @foreach($user->getRemarks() as $remark)
                                    <option value="{{ $remark }}">{{ $remark }}</option>
                                @endforeach
                            </select>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
@section('style')

    <style>

        .container {
            max-width: 500px;
            padding: 20px;
            text-align: center;
        }

        .card {
            background-color: rgba(255, 255, 255, 0.5);
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
            margin-bottom: 20px;
        }

        .card-title {
            font-size: 24px;
            margin-bottom: 20px;
        }

        .card-text {
            font-size: 18px;
            margin-bottom: 10px;
        }

        .btn-primary {
            width: 100%;
            background-color: #007bff;
            border-color: #007bff;
        }

        .btn-primary:hover {
            background-color: #0069d9;
            border-color: #0062cc;
        }

        .modal-title {
            font-size: 24px;
            margin-bottom: 20px;
        }

        .modal-body {
            text-align: left;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            font-weight: bold;
            margin-right: 10px;
        }

        .form-group input[type="radio"] {
            margin-right: 5px;
        }

        .form-group input[type="text"] {
            width: 100%;
            padding: 8px;
            border: 1px solid #ced4da;
            border-radius: 4px;
        }

        .form-group input[type="text"]:focus {
            outline: none;
            border-color: #80bdff;
            box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
        }

        .form-group .btn-primary {
            width: auto;
            display: inline-block;
        }
    </style>
@endsection

@section('script')

@endsection
