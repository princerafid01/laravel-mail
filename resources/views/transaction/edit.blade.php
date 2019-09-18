<form id="transaction" action="/transaction/edit/{{$tr->id}}" method="post">
    @csrf
<div class="modal-content">
    <h4>Edit {{$tr->type}}</h4>
    <div class="row">
        <div class="col s6 offset-s3">
            <input type="hidden" name="trip_id" value="{{$tr->id}}">
        @permission('date')
        <div class="input-field">
            <input id="date" class="datepicker" name="date" required value="{{date('Y-m-d', strtotime($tr->created_at))}}" type="text">
            <label for="date">Date</label>
        </div>
        @endpermission
        <div class="input-field">
            <input id="detail" name="detail" required value="{{$tr->detail}}"  type="text">
            <label for="detail">Detail</label>
        </div>
        <div class="input-field">
            <input id="amount" name="amount" required value="{{$tr->amount}}" type="number">
            <label for="amount">Amount</label>
        </div>

        </div>
    </div>
</div>
<div class="modal-footer">
    <button class="modal-action waves-effect waves-green btn-flat" type="submit">Save</button>
</div>
</form>