@extends('layouts.master')
@section('other_css')
    <style>
        .custom td {
            padding: 5px !important;
        }
        @media print {
            .custom td {
                padding: 2px !important;
            }
            table {
                font-size: 1.2em;
            }
        }
    </style>
    @endsection
@section('content')
    <?php
    $income = 0;
    $expense = 0;
    ?>
    <div class="col s12 m12 l12">
        <div id="Form-advance" class="card card card-default scrollspy">
            <div class="card-content">
                <h3 class="center-align uppercase">{{$trip->ship->name}}</h3>
                <h5 class="center-align">{{$trip->number}}</h5>
                <hr>
                <div class="row mb-5"></div>
                <div class="row">
                    <div class="col s6">
                        <table class="striped custom">
                            <tr>
                                <td><b class="uppercase strong black-text">Ship</b></td>
                                <td>{{$trip->ship->name}}</td>
                            </tr>
                            <tr>
                                <td><b class="uppercase strong black-text">Trip Number</b></td>
                                <td>{{$trip->number}}</td>
                            </tr>
                            <tr>
                                <td><b class="uppercase strong black-text">Cargo</b></td>
                                <td>{{$trip->cargo?:'NA'}}</td>
                            </tr>
                            <tr>
                                <td><b class="uppercase strong black-text">Cargo Quantity</b></td>
                                <td>{{$trip->cargo_quantity?:'NA'}}</td>
                            </tr>
                            <tr>
                                <td><b class="uppercase strong black-text">Total Fuel</b></td>
                                <td>{{$trip->total_fuel?:'NA'}}</td>
                            </tr>
                            <tr>
                                <td><b class="uppercase strong black-text">From</b></td>
                                <td>{{$trip->from?:'NA'}}</td>
                            </tr>
                            <tr>
                                <td><b class="uppercase strong black-text">To</b></td>
                                <td>{{$trip->to?:'NA'}}</td>
                            </tr>
                            <tr>
                                <td><b class="uppercase strong black-text">Status</b></td>
                                <td>{{$trip->status}}</td>
                            </tr>
                        </table>
                    </div>
                    <div class="col s6">
                        <table class="striped custom">
                            <tr>
                                <td><b class="uppercase strong black-text">Loading Date</b></td>
                                <td>@form_date($trip->start_date)</td>
                            </tr>
                            <tr>
                                <td><b class="uppercase strong black-text">Sailing Date</b></td>
                                <td>@form_date($trip->sailing_start)</td>
                            </tr>
                            <tr>
                                <td><b class="uppercase strong black-text">Sailing End Date</b></td>
                                <td>@form_date($trip->sailing_end)</td>
                            </tr>
                            <tr>
                                <td><b class="uppercase strong black-text">Trip End Date</b></td>
                                <td>@form_date($trip->end_date)</td>
                            </tr>
                            <tr>
                                <td><b class="uppercase strong black-text">Trip Duration</b></td>
                                <td>{{$trip->duration}} days</td>
                            </tr>
                            <tr>
                                <td><b class="uppercase strong black-text">Type</b></td>
                                <td>{{$trip->type}}</td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="row mb-5"></div>
                <div class="row">
                    <div class="col s6">
                        <h6 class="uppercase strong">Expenses</h6>
                        <hr>
                        @if($trip->transactions->where('type','expense')->count()>0)
                            <table class="custom">
                                <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Detail</th>
                                    <th>Amount</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($trip->transactions->where('type','expense') as $ex)
                                    <tr>
                                        <td>@form_date($ex->created_at)</td>
                                        <td>{{$ex->detail}}</td>
                                        <td class="right-align">@money($ex->amount)</td>
                                    </tr>
                                @endforeach
                                <tr>
                                    <td colspan="3" class="right-align">@money($expense = $trip->transactions->where('type','expense')->sum('amount')) </td>
                                </tr>
                                </tbody>
                            </table>
                        @else
                            <p>No expenses</p>
                        @endif
                    </div>
                    <div class="col s6">
                        <h6 class="uppercase strong">Income</h6>
                        <hr>
                        @if($trip->transactions->where('type','income')->count()>0)
                            <table class="custom">
                                <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Detail</th>
                                    <th>Amount</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($trip->transactions->where('type','income') as $ex)
                                    <tr>
                                        <td>@form_date($ex->created_at)</td>
                                        <td>{{$ex->detail}}</td>
                                        <td class="right-align">@money($ex->amount)</td>
                                    </tr>
                                @endforeach
                                <tr>
                                    <td colspan="3" class="right-align">@money($income = $trip->transactions->where('type','income')->sum('amount')) </td>
                                </tr>
                                </tbody>
                            </table>
                        @else
                            <p>No Income</p>
                        @endif
                    </div>
                </div>
                <div class="row mb-5"></div>
                <div class="row">
                    <div class="col s6 offset-s6">
                        <table class="custom">
                            <tbody>
                            <tr>
                                <td><b class="uppercase strong black-text">Total Income</b></td>
                                <td class="right-align">@money($income)</td>
                            </tr>
                            <tr>
                                <td><b class="uppercase strong black-text">Total Expense</b></td>
                                <td class="right-align">@money($expense)</td>
                            </tr>
                            <tr>
                                <td><b class="uppercase strong black-text">Total Profit</b></td>
                                <td class="right-align">@money($income-$expense)</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection