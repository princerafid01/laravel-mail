
<div class="modal-content">
    <table class="striped">
        <tbody>
        <tr>
            <td><b class="strong text-black">Trip</b></td>
            <td><a href="/trips/view/{{$tr->trip_id}}">{{$tr->trip->number}}</a></td>
        </tr>
        <tr>
            <td><b class="strong text-black">Type</b></td>
            <td>{{$tr->type}}</td>
        </tr>
        <tr>
            <td><b class="strong text-black">Detail</b></td>
            <td>{{$tr->detail}}</td>
        </tr>
        <tr>
            <td><b class="strong text-black">Amount</b></td>
            <td>@money($tr->amount)</td>
        </tr>
        <tr>
            <td><b class="strong text-black">Created by</b></td>
            <td>{{$tr->created_by->name}}</td>
        </tr>
        </tbody>

    </table>
</div>
<div class="modal-footer">
    <button class="modal-action modal-close waves-effect waves-green btn-flat" type="submit">Okay</button>
</div>