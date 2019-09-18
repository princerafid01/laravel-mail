@extends('layouts.master')
@section('other_vendor_css')
    <link rel="stylesheet" type="text/css" href="{{asset('assets/vendors/data-tables/css/jquery.dataTables.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/vendors/data-tables/extensions/responsive/css/responsive.dataTables.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/vendors/sweetalert/sweetalert.css')}}">
@endsection
@section('other_css')
    @foreach($months as $m)
        <style>
            #main .section-data-tables .dataTables_wrapper .dataTables_length#page-length-option_{{$m['month']}}_length,
            #main .section-data-tables .dataTables_wrapper .dataTables_filter#page-length-option_{{$m['month']}}_filter
            {
                display: block;
            }
            #main .section-data-tables .dataTables_wrapper .dataTables_paginate,
            #main .section-data-tables .dataTables_wrapper #page-length-option_{{$m['month']}}_paginate
            {
                margin-right: .35rem;
                margin-bottom: .75rem;
            }
            #main .section-data-tables .dataTables_wrapper .dataTables_paginate .paginate_button,
            #main .section-data-tables .dataTables_wrapper #page-length-option_{{$m['month']}}_paginate .paginate_button
            {
                margin-top: .25rem;
                padding: .25em .65em;
            }
            #main .section-data-tables .dataTables_wrapper .dataTables_paginate .paginate_button.current,
            #main .section-data-tables .dataTables_wrapper .dataTables_paginate .paginate_button.current:hover,
            #main .section-data-tables .dataTables_wrapper #page-length-option_{{$m['month']}}_paginate .paginate_button.current,
            #main .section-data-tables .dataTables_wrapper #page-length-option_{{$m['month']}}_paginate .paginate_button.current:hover
            {
                color: #fff !important;
                border: 1px solid #2196f3;
                border-radius: 6px;
                background: #2196f3;
                -webkit-box-shadow: 0 0 8px 0 #2196f3;
                box-shadow: 0 0 8px 0 #2196f3;
            }
            #main .section-data-tables .dataTables_wrapper .dataTables_paginate .paginate_button:hover,
            #main .section-data-tables .dataTables_wrapper #page-length-option_{{$m['month']}}_paginate .paginate_button:hover
            {
                color: #fff !important;
                border: 1px solid #2196f3;
                border-radius: 6px;
                background: #2196f3;
                -webkit-box-shadow: 0 0 8px 0 #2196f3;
                box-shadow: 0 0 8px 0 #2196f3;
            }
        </style>
        @endforeach
    <style>
        /*----------------------------------------
        Data Tables
------------------------------------------*/
        #main .section-data-tables table
        {
            width: 100%;
        }

        #main .section-data-tables .dataTables_wrapper table.dataTable thead th
        {
            min-width: 69px;

            color: #616161;
        }
        #main .section-data-tables .dataTables_wrapper table.dataTable thead th.background-image-none
        {
            background-image: none !important;
        }
        #main .section-data-tables .dataTables_wrapper table.dataTable thead th.select-all
        {
            background-image: none !important;
        }

        #main .section-data-tables .dataTables_wrapper table.dataTable th,
        #main .section-data-tables .dataTables_wrapper table.dataTable td
        {
            font-weight: 300;

            padding: 17px 14px;

            white-space: nowrap;

            border-bottom: 1px solid #cfd8dc;
        }

        #main .section-data-tables .dataTables_wrapper table.dataTable tbody
        {
            overflow: auto;

            max-width: 100%;
            height: 300px;
        }
        #main .section-data-tables .dataTables_wrapper table.dataTable tbody th,
        #main .section-data-tables .dataTables_wrapper table.dataTable tbody td
        {
            padding: 8px 14px;

            white-space: nowrap;

            border: none !important;
        }
        #main .section-data-tables .dataTables_wrapper table.dataTable tbody tr td:before,
        #main .section-data-tables .dataTables_wrapper table.dataTable tbody tr th:before
        {
            font-size: .9rem;
            line-height: 14px;

            top: 10px;
            left: -3px;

            width: 12px;
            height: 12px;

            text-indent: 0;
        }

        #main .section-data-tables .dataTables_wrapper table.dataTable tfoot th,
        #main .section-data-tables .dataTables_wrapper table.dataTable tfoot td
        {
            font-weight: 300;

            white-space: nowrap;

            border-top: 1px solid #cfd8dc;
        }

        #main .section-data-tables .dataTables_wrapper table.dataTable.stripe tbody tr,
        #main .section-data-tables .dataTables_wrapper table.dataTable.display tbody tr
        {
            height: auto;
        }
        #main .section-data-tables .dataTables_wrapper table.dataTable.stripe tbody tr .odd,
        #main .section-data-tables .dataTables_wrapper table.dataTable.display tbody tr .odd
        {
            background-color: #f4f5f7;
        }
        #main .section-data-tables .dataTables_wrapper table.dataTable.stripe tbody tr .odd > .sorting_1,
        #main .section-data-tables .dataTables_wrapper table.dataTable.display tbody tr .odd > .sorting_1
        {
            background-color: transparent;
        }
        #main .section-data-tables .dataTables_wrapper table.dataTable.stripe tbody tr .odd.selected,
        #main .section-data-tables .dataTables_wrapper table.dataTable.display tbody tr .odd.selected
        {
            background-color: #acbad4 !important;
        }
        #main .section-data-tables .dataTables_wrapper table.dataTable.stripe tbody tr .odd.selected th,
        #main .section-data-tables .dataTables_wrapper table.dataTable.display tbody tr .odd.selected th
        {
            border-radius: 0;
        }

        #main .section-data-tables .dataTables_wrapper table.dataTable.display tbody tr.hover > .sorting_1,
        #main .section-data-tables .dataTables_wrapper table.dataTable.display tbody tr:hover > .sorting_1,
        #main .section-data-tables .dataTables_wrapper table.dataTable.order-column.hover tbody tr.hover > .sorting_1,
        #main .section-data-tables .dataTables_wrapper table.dataTable.order-column.hover tbody tr:hover > .sorting_1
        {
            background-color: transparent;
        }

        #main .section-data-tables .dataTables_wrapper table [type='checkbox'] + span:not(.lever):before,
        #main .section-data-tables .dataTables_wrapper table [type='checkbox']:not(.filled-in) + span:not(.lever):after
        {
            opacity: .5;
            border-radius: 4px !important;
        }



        #main .section-data-tables .dataTables_wrapper .dataTables_length,
        #main .section-data-tables .dataTables_wrapper .dataTables_filter
        {
            display: none;
        }

        #main .section-data-tables .dataTables_wrapper .dataTables_info
        {
            margin-left: 18px;

            color: #616161;
        }

    </style>
@endsection
@section('content')
    <div class="col s12">
        <ul class="collapsible collapsible-accordion" data-collapsible="accordion">
            @foreach($months as $m)
                <li @if ($loop->first) class="active" @endif>
                    <div class="collapsible-header light-blue light-blue-text text-lighten-5">
                        <i class="material-icons">date_range</i> {{$m['month']}} - Total @money($m['total'])
                    </div>
                    <div class="collapsible-body light-blue lighten-5">
                        <a href="/gexpense/print?month={{$m['month']}}" class="mb-0 btn waves-effect waves-light green darken-1 float-right">Print</a>
                        <div class="section section-data-tables">
                            <table id="page-length-option_{{$m['month']}}" style="cursor: pointer" class="display DataTable stripe" width="100%">
                                <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Detail</th>
                                    <th>Amount</th>
                                    <th>Created by</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tfoot>
                                <tr>
                                    <th></th><th></th><th></th><th></th><th></th>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </li>
                @endforeach
        </ul>
    </div>
    @permission('gexpense_add')
    <div style="bottom: 50px; right: 19px;" class="fixed-action-btn " ><a href="{{route('addExpense')}}" class="btn-floating btn-large gradient-45deg-light-blue-cyan remote gradient-shadow tooltipped" data-position="top" data-tooltip="Add general expense"><i class="material-icons">add</i></a>
    </div>
    @endpermission
@endsection
@section('other_vendor_java')
    <script src="{{asset('assets/vendors/data-tables/js/jquery.dataTables.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/vendors/data-tables/extensions/responsive/js/dataTables.responsive.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/vendors/sweetalert/sweetalert.min.js')}}"></script>
@endsection
@section('other_java')
    <script>
        // $('#filter_form').on('submit', function (e) {
        //     e.preventDefault();
        //     form = $(this);
        //     $('#table_tab').trigger('click');
        //     var url = "/gexpenseList?"+form.serialize();
        //     DT.ajax.url(url).load();
        // })
        // $('#reset').on('click', function () {
        //     var url = "/gexpenseList";
        //     DT.ajax.url(url).load();
        // });
        $(document).on('click','.expense_link td:not(:last-child)', function () {
            var id = $(this).parent('.expense_link').attr('id');
            var url = '{{route('expenseModal', ['id'=>''])}}/'+id;
            $('#remote_modal').load(url,function(result){
                $('#remote_modal').modal('open');
            });
        });
        @foreach($months as $m)
        $('#page-length-option_{{$m['month']}}').DataTable({
            "processing": true,
            "serverSide": false,
            "pageLength": localStorage.getItem('len'),
            "order": [],
//            responsive: true,
            "ajax": "/gexpenseList?month={{$m['month']}}",
            "columns": [
                {"data": "created_at"},
                {'data':'detail'},
                {"data": "amount"},
                {"data": "created_by"},
                {"data": "id"}
            ],
            fnDrawCallback: function (nRow, aData, iDisplayIndex) {
                $('.dropdown-trigger').dropdown({
                        constrainWidth: false,
                    }
                );
                $('.modal').modal();
            },
            rowCallback: function( row, data ) {
                row.id = data.id;
                row.className = "expense_link";
            },
            columnDefs:[
                {targets:3,
                    render:function(a,n,e,s){
                        return  a.name}
                },
                {targets:2,
                    render:function(a,n,e,s){
                        return formatMoney(a)}
                },
                {targets:4,
                    render:function(a,n,e,s) {
                        return "<a class='dropdown-trigger' href='#' data-target='dropdown"+a+"'><i class='material-icons'>more_horiz</i></a>" +
                            "<ul id='dropdown"+a+"' class='dropdown-content'>" +
                                @permission('gexpense_edit') "<li><a class='remote' href='/gexpense/edit/"+a+"'><i class='material-icons'>edit</i>Edit</a></li>" + @endpermission
                                @permission('gexpense_delete') "<li><a onclick='confirm_delete(\"{{route('expenseDelete',['id'=>''])}}/"+a+"\")'><i class='material-icons'>delete</i>Delete</a></li>" + @endpermission

                        "</ul>";
                    }
                },
            ],
        });
        $('#page-length-option_{{$m['month']}}').on( 'length.dt', function ( e, settings, len ) {
            localStorage.setItem('len', len);
        });
            @endforeach
    </script>
@endsection