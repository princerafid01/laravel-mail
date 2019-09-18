<form id="transaction" action="/transaction/add" method="post">
    @csrf
<div class="modal-content">
    <h4>Add {{$type}}</h4>
    <div class="row">
        <div class="col s6 offset-s3">

    @if($type)
        <input type="hidden" name="type" value="{{$type}}">
        @else
            <div class="input-field">
                <select name="type" required class="browser-default">
                    <option value="" disabled selected>Select Type</option>
                    <option value="income">Income</option>
                    <option value="expense">Expense</option>
                </select>
            </div>
    @endif
    @if($trip)
            <input type="hidden" name="trip_id" value="{{$trip}}">
        @else
            <div class="input-field">
                <input id="trip" name="trip" required  type="text">
                <label for="trip">Trip</label>
            </div>
        @endif
        @permission('date')
        <div class="input-field">
            <input id="date" class="datepicker" name="date" required value="{{date('Y-m-d')}}" type="text">
            <label for="date">Date</label>
        </div>
        @endpermission
        <div class="input-field">
            <input id="detail" name="detail" required  type="text">
            <label for="detail">Detail</label>
        </div>
        <div class="input-field">
            <input id="amount" name="amount" required  type="number">
            <label for="amount">Amount</label>
        </div>

        </div>
    </div>
</div>
<div class="modal-footer">
    <button class="modal-action waves-effect waves-green btn-flat" type="submit">Save</button>
</div>
</form>

@if(!$trip)
    <script>
        $('#trip').autocomplete({
            data: {!! $data->toJson() !!},
        });
    </script>
    @endif