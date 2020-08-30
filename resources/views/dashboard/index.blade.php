@extends('layouts.app')

@section('content')
    {{--<div class="container">--}}
    <div class="container">
        <div class="form-group row">
            <div class="col-md-3">
                <div class="form-group">

                    <label>Item Name</label>
                    <input type="text" class="form-control" name="item_name" id="item_name" placeholder="Item Name" />

                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">

                    <label>Select Unit</label>
                    <select class="form-control" name="unit" id="unit">
                        <option value="">Unit</option>
                        @foreach ($units as $u)
                            <option value="{{ $u->id }}">
                                {{ $u->name }}
                            </option>
                        @endforeach
                    </select>

                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label>Select Department</label>
                    <select class="form-control" name="department" id="department">
                        <option value="">Department</option>
                        @foreach ($departments as $d)
                            <option value="{{ $d->id }}">
                                {{ $d->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label>Select Service Type</label>
                    <select class="form-control" name="service_type" id="service_type">
                        <option value="">Service Type</option>
                        @foreach ($service_types as $s)
                            <option value="{{ $s->id }}">{{ $s->name }}</option>
                        @endforeach
                    </select>

                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label>Renew Date From</label>
                    <input type="date" class="form-control" name="from_date" id="from_date" />
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label>Renew Date To</label>
                    <input type="date" class="form-control" name="to_date" id="to_date" />
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <br />
                    <button class="btn btn-primary" onclick="getFilterDocument()">SEARCH</button>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <br />
                    <button class="btn btn-warning" style="color: #FFF;" id="btnExport123" onclick="ExportToExcel('table_id')">
                        <b>
                            Excel
                        </b>
                        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-download" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M.5 8a.5.5 0 0 1 .5.5V12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V8.5a.5.5 0 0 1 1 0V12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V8.5A.5.5 0 0 1 .5 8z"/>
                            <path fill-rule="evenodd" d="M5 7.5a.5.5 0 0 1 .707 0L8 9.793 10.293 7.5a.5.5 0 1 1 .707.707l-2.646 2.647a.5.5 0 0 1-.708 0L5 8.207A.5.5 0 0 1 5 7.5z"/>
                            <path fill-rule="evenodd" d="M8 1a.5.5 0 0 1 .5.5v8a.5.5 0 0 1-1 0v-8A.5.5 0 0 1 8 1z"/>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">

                <table class="table table-bordered table-responsive" width="100%" id="table_id">
                    <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th class="text-center">Item</th>
                            <th class="text-center">Service</th>
                            <th class="text-center">Brand</th>
                            <th class="text-center">Model</th>
                            <th class="text-center">Serial</th>
                            <th class="text-center">Unit</th>
                            <th class="text-center">Dept.</th>
                            <th class="text-center">Email</th>
                            <th class="text-center">Liable Person</th>
                            <th class="text-center">Orig. Loc.</th>
                            <th class="text-center">Doc. Loc.</th>
                            <th class="text-center">Last Renew</th>
                            <th class="text-center">Next Renew</th>
                            <th class="text-center">Vendor</th>
                            <th class="text-center">Amount</th>
                            <th class="text-center">Remarks</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody id="filter_result">
                    @if(count($documents) > 0)
                        @foreach($documents as $d)
                            <tr>
                                <td class="text-center">{{ $d->id }}</td>
                                <td class="text-center">{{ $d->item_name }}</td>
                                <td class="text-center">{{ $d->service_type }}</td>
                                <td class="text-center">{{ $d->brand }}</td>
                                <td class="text-center">{{ $d->model }}</td>
                                <td class="text-center">{{ $d->serial_no }}</td>
                                <td class="text-center">{{ $d->unit }}</td>
                                <td class="text-center">{{ $d->department }}</td>
                                <td class="text-center">{{ $d->user_email }}</td>
                                <td class="text-center">{{ $d->user }}</td>
                                <td class="text-center">{{ $d->original_placement_location }}</td>
                                <td class="text-center">{{ $d->original_document_location }}</td>
                                <td class="text-center">{{ $d->last_renewal_date }}</td>
                                <td class="text-center">{{ $d->next_renewal_date }}</td>
                                <td class="text-center">{{ $d->vendor }}</td>
                                <td class="text-center">{{ $d->amount }}</td>
                                <td class="text-center">{{ $d->remarks }}</td>
                                <td class="text-center">

                                    @if($d->file != '')

                                        <a style="margin: 1px;" href="{{ asset('/public/storage/attachments').'/'.$d->file }}" class="btn btn-success" target="_blank">
                                            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-download" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" d="M.5 8a.5.5 0 0 1 .5.5V12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V8.5a.5.5 0 0 1 1 0V12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V8.5A.5.5 0 0 1 .5 8z"/>
                                                <path fill-rule="evenodd" d="M5 7.5a.5.5 0 0 1 .707 0L8 9.793 10.293 7.5a.5.5 0 1 1 .707.707l-2.646 2.647a.5.5 0 0 1-.708 0L5 8.207A.5.5 0 0 1 5 7.5z"/>
                                                <path fill-rule="evenodd" d="M8 1a.5.5 0 0 1 .5.5v8a.5.5 0 0 1-1 0v-8A.5.5 0 0 1 8 1z"/>
                                            </svg>
                                        </a>

                                    @endif

                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="17" class="text-center">No Documents Found!</td>
                        </tr>
                    @endif
                    </tbody>
                </table>
                <div class="row justify-content-center" id="pagination">{{ $documents->links() }}</div>
            </div>
        </div>
    </div>
    {{--</div>--}}
@endsection

<script type="text/javascript">
    function getFilterDocument() {
        var item_name = $("#item_name").val();
        var unit = $("#unit").val();
        var department = $("#department").val();
        var service_type = $("#service_type").val();
        var from_date = $("#from_date").val();
        var to_date = $("#to_date").val();

        $("#filter_result").empty();
        $("#pagination").empty();

        $.ajax({
            url: "{{ route("filterDocuments") }}",
            type: "GET",
            data: {_token:"{{csrf_token()}}", item_name: item_name, unit: unit, department: department, service_type: service_type, from_date: from_date, to_date: to_date},
            dataType: "json",
            success: function (data) {
                console.log(data);

                var res='';
                $.each (data, function (key, value) {
                    res +=
                        '<tr>'+
                        '<td class="text-center">'+value.id+'</td>'+
                        '<td class="text-center">'+(value.item_name != null ? value.item_name : '')+'</td>'+
                        '<td class="text-center">'+(value.service_type != null ? value.service_type : '')+'</td>'+
                        '<td class="text-center">'+(value.brand != null ? value.brand : '')+'</td>'+
                        '<td class="text-center">'+(value.model != null ? value.model : '')+'</td>'+
                        '<td class="text-center">'+(value.serial_no != null ? value.serial_no : '')+'</td>'+
                        '<td class="text-center">'+(value.unit != null ? value.unit : '')+'</td>'+
                        '<td class="text-center">'+(value.department != null ? value.department : '')+'</td>'+
                        '<td class="text-center">'+(value.user_email != null ? value.user_email : '')+'</td>'+
                        '<td class="text-center">'+(value.user != null ? value.user : '')+'</td>'+
                        '<td class="text-center">'+(value.original_placement_location != null ? value.original_placement_location : '')+'</td>'+
                        '<td class="text-center">'+(value.original_document_location != null ? value.original_document_location : '')+'</td>'+
                        '<td class="text-center">'+(value.last_renewal_date != null ? value.last_renewal_date : '')+'</td>'+
                        '<td class="text-center">'+(value.next_renewal_date != null ? value.next_renewal_date : '')+'</td>'+
                        '<td class="text-center">'+(value.vendor != null ? value.vendor : '')+'</td>'+
                        '<td class="text-center">'+(value.amount != null ? value.amount : '')+'</td>'+
                        '<td class="text-center">'+(value.remarks != null ? value.remarks : '')+'</td>'+
                        '<td class="text-center">'+(value.file != null ? '<a style="margin: 1px;" href="<?php echo url('/');?>/public/storage/attachments/'+value.file+'" class="btn btn-success" target="_blank"><svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-download" fill="currentColor" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M.5 8a.5.5 0 0 1 .5.5V12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V8.5a.5.5 0 0 1 1 0V12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V8.5A.5.5 0 0 1 .5 8z"/><path fill-rule="evenodd" d="M5 7.5a.5.5 0 0 1 .707 0L8 9.793 10.293 7.5a.5.5 0 1 1 .707.707l-2.646 2.647a.5.5 0 0 1-.708 0L5 8.207A.5.5 0 0 1 5 7.5z"/><path fill-rule="evenodd" d="M8 1a.5.5 0 0 1 .5.5v8a.5.5 0 0 1-1 0v-8A.5.5 0 0 1 8 1z"/></svg></a>' : '')+'</td>'+
                        '</tr>';

                });

                $('#filter_result').append(res);

            }
        });
    }


    function ExportToExcel(tableid) {
        var tab_text = "<table border='2px'><tr>";
        var textRange; var j = 0;
        tab = document.getElementById(tableid);//.getElementsByTagName('table'); // id of table
        if (tab==null) {
            return false;
        }
        if (tab.rows.length == 0) {
            return false;
        }

        for (j = 0 ; j < tab.rows.length ; j++) {
            tab_text = tab_text + tab.rows[j].innerHTML + "</tr>";
            //tab_text=tab_text+"</tr>";
        }

        tab_text = tab_text + "</table>";
        tab_text = tab_text.replace(/<A[^>]*>|<\/A>/g, "");//remove if u want links in your table
        tab_text = tab_text.replace(/<img[^>]*>/gi, ""); // remove if u want images in your table
        tab_text = tab_text.replace(/<input[^>]*>|<\/input>/gi, ""); // reomves input params

        var ua = window.navigator.userAgent;
        var msie = ua.indexOf("MSIE ");

        if (msie > 0 || !!navigator.userAgent.match(/Trident.*rv\:11\./))      // If Internet Explorer
        {
            txtArea1.document.open("txt/html", "replace");
            txtArea1.document.write(tab_text);
            txtArea1.document.close();
            txtArea1.focus();
            sa = txtArea1.document.execCommand("SaveAs", true, "download.xls");
        }
        else                 //other browser not tested on IE 11
        //sa = window.open('data:application/vnd.ms-excel,' + encodeURIComponent(tab_text));
            try {
                var blob = new Blob([tab_text], { type: "application/vnd.ms-excel" });
                window.URL = window.URL || window.webkitURL;
                link = window.URL.createObjectURL(blob);
                a = document.createElement("a");
                if (document.getElementById("caption")!=null) {
                    a.download=document.getElementById("caption").innerText;
                }
                else
                {
                    a.download = 'download';
                }

                a.href = link;

                document.body.appendChild(a);

                a.click();

                document.body.removeChild(a);
            } catch (e) {
            }


        return false;
        //return (sa);
    }
</script>