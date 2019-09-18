<div class="modal-content">
    <h4>Trip - {{$trip->number}}</h4>
        <div class="row" id="main-view-tab">
            <div class="col s12">
                <ul class="tabs tab-demo-active z-depth-1 cyan">
                    <li class="tab col m4"><a class="white-text waves-effect waves-light active" href="#sapien">Detail</a>
                    </li>
                    <li class="tab col m4"><a class="white-text waves-effect waves-light" href="#activeone">Income</a>
                    </li>
                    <li class="tab col m4"><a class="white-text waves-effect waves-light" href="#vestibulum">Expense</a>
                    </li>
                </ul>
            </div>
            <div class="col s12">
                <div id="sapien" class="col s12  cyan lighten-4">
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
                                    <td>{{$trip->cargo}}</td>
                                </tr>
                                <tr>
                                    <td><b class="uppercase strong black-text">Cargo Quantity</b></td>
                                    <td>{{$trip->cargo_quantity}}</td>
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
                </div>
                <div id="activeone" style="min-height: 200px" class="col s12  cyan lighten-4">
                    <table>
                        <thead>
                        <tr>
                            <th>Date</th>
                            <th>Detail</th>
                            <th>Amount</th>
                            <th>Created by</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($income as $i)
                            <tr>
                                <td>@form_date($i->created_at)</td>
                                <td>{{$i->detail}}</td>
                                <td> @money($i->amount)</td>
                                <td> {{$i->created_by->name}}</td><td><a class="tooltipped remote" data-position="top" data-tooltip="Edit" href="/transaction/edit/{{$i->id}}"><i class="material-icons">edit</i></a><a style="cursor: pointer" class="tooltipped" data-position="top" data-tooltip="Delete" onclick="confirm_delete('{{route('transactionDelete', ['id'=> $i->id])}}')"><i class="material-icons">delete</i></a></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div id="vestibulum" style="min-height: 200px" class="col s12  cyan lighten-4">
                    <table>
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Detail</th>
                                <th>Amount</th>
                                <th>Created by</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($expense as $i)
                            <tr>
                                <td>@form_date($i->created_at)</td>
                                <td>{{$i->detail}}</td>
                                <td> @money($i->amount)</td>
                                <td> {{$i->created_by->name}}</td>
                                <td><a class="tooltipped remote" data-position="top" data-tooltip="Edit" href="/transaction/edit/{{$i->id}}"><i class="material-icons">edit</i></a><a style="cursor: pointer" class="tooltipped" data-position="top" data-tooltip="Delete" onclick="confirm_delete('{{route('transactionDelete', ['id'=> $i->id])}}')"><i class="material-icons">delete</i></a></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
</div>