@extends('layouts.master')
@section('content')
    <div class="col s12 m12 l12">
        <div id="Form-advance" class="card card card-default scrollspy">
            <div class="card-content">
                @if($errors->any())
                    <div class="card-alert card red">
                        <div class="card-content white-text">
                            @foreach($errors->all() as $m)
                                <p>{{$m}}</p>
                            @endforeach
                        </div>
                        <button type="button" class="close white-text" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                @endif
                <form class="col s12" id="add_trip_form" method="post" action="{{route('editTripPost',['id'=>$trip->id])}}">
                    @csrf
                    <div class="row">
                        <div class="input-field col m4">
                            <select name="ship_id" id="ship_id" disabled>
                                @foreach($ships as $ship)
                                    <option value="{{$ship->id}}" @if( (isset($_GET['shipName']) &&$_GET['shipName'] == $ship->name) || $trip->ship_id == $ship->id) selected @endif>{{$ship->name}}</option>
                                    @endforeach
                            </select>
                            <label for="date_format">Ship</label>
                        </div>
                        <div class="input-field col m4">
                            <input id="from" name="from" value="{{old('from')?:$trip->from}}" type="text">
                            <label for="from">From</label>
                        </div>
                        <div class="input-field col m4">
                            <input id="to" name="to" value="{{old('to')?:$trip->to}}" type="text">
                            <label for="to">To</label>
                        </div>
                        <div class="input-field col m4">
                            <input id="start_date" name="start_date" class="datepicker" value="{{old('start_date')?: ($trip->start_date != null ? date('Y-m-d', strtotime($trip->start_date)):'')}}" type="text">
                            <label for="start_date">Loading Start</label>
                        </div>
                        <div class="input-field col m4">
                            <input id="sailing_start" name="sailing_start" class="datepicker" value="{{old('sailing_start')?:($trip->sailing_start != null ? date('Y-m-d', strtotime($trip->sailing_start)):'')}}" type="text">
                            <label for="sailing_start">Sailing Start</label>
                        </div>
                        <div class="input-field col m4">
                            <input id="sailing_end" name="sailing_end" class="datepicker" value="{{old('sailing_end')?:($trip->sailing_end != null ? date('Y-m-d', strtotime($trip->sailing_end)):'')}}" type="text">
                            <label for="sailing_end">Sailing end</label>
                        </div>
                        <div class="input-field col m4">
                            <input id="end_date" name="end_date" class="datepicker" value="{{old('end_date')?: ($trip->end_date != null ? date('Y-m-d', strtotime($trip->end_date)):'')}}" type="text">
                            <label for="end_date">Discharge End</label>
                        </div>
                        <div class="input-field col m4">
                            <input id="cargo" class="" name="cargo" value="{{old('cargo')?: $trip->cargo}}" type="text">
                            <label for="start_date">Cargo</label>
                        </div>
                        <div class="input-field col m4">
                            <input id="quantity" class="" name="cargo_quantity" value="{{old('cargo_quantity')?: $trip->cargo_quantity}}" type="text">
                            <label for="quantity">Cargo Quantity</label>
                        </div>
                        <div class="input-field col m4">
                            <input id="total_fuel" class="" name="total_fuel" value="{{old('total_fuel')?: $trip->total_fuel}}" type="text">
                            <label for="total_fuel">Total Fuel</label>
                        </div>
                        <div class="input-field col m4">
                            <select name="type" id="type">
                                <option value="Single">Single</option>
                                <option value="Double" @if($trip->type == 'Double') selected @endif>Double</option>
                            </select>
                            <label for="status">Status</label>
                        </div>
                        <div class="input-field col m4">
                            <select name="status" id="status">
                                <option value="Loading" @if($trip->status == 'Loading') selected @endif>Loading</option>
                                <option value="Sailing" @if($trip->status == 'Sailing') selected @endif>Sailing</option>
                                <option value="Discharging" @if($trip->status == 'Discharging') selected @endif>Discharging</option>
                                <option value="Completed" @if($trip->status == 'Completed') selected @endif>Completed</option>
                            </select>
                            <label for="status">Status</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12">
                            <button class="btn cyan waves-effect waves-light right" type="submit" name="action">Update
                                <i class="material-icons right">send</i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endsection
@section('other_java')
    <script src="{{asset('/')}}assets/vendors/jquery-validation/jquery.validate.min.js"></script>
    <script>
        $("#add_trip_form").validate({
            rules: {
                ship_id: {
                    required: true
                },
                from:'required',
                to:'required',
            },
            errorElement : 'div',
            errorPlacement: function(error, element) {
                var placement = $(element).data('error');
                if (placement) {
                    $(placement).append(error)
                } else {
                    error.insertAfter(element);
                }
            }
        });
    </script>
@endsection