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
    <div class="col s12 m12 l12">
        <div id="Form-advance" class="card card card-default scrollspy">
            <div class="card-content">
                <h5 class="center-align uppercase">Noble Navigation & Shipping Line</h5>
                <h6 class="center-align">General Expense</h6>
                <h6 class="center-align">{{$month->format('F-Y')}}</h6>
                <hr>
                <div class="row mb-5"></div>
                <div class="row">
                    <div class="col s12">
                        @if($tr->count()>0)
                            <table>
                                <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Detail</th>
                                    <th>Created By</th>
                                    <th class="right-align">Amount</th>

                                </tr>
                                </thead>
                                <tbody>
                                @foreach($tr as $t)
                                    <tr>
                                        <td>@form_date($t->created_at)</td>
                                        <td>{{$t->detail}}</td>
                                        <td>{{$t->created_by->name}}</td>
                                        <td class="right-align" >@money($t->amount)</td>

                                    </tr>
                                @endforeach
                                <tr>
                                    <td colspan="3" class="right-align">Total</td>
                                    <td class="right-align" >@money($tr->sum('amount')) </td>
                                </tr>
                                </tbody>
                            </table>
                        @else
                            <p class="center-align">No expenses</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection