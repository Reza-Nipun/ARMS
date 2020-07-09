@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header"><h3>Edit Document</h3></div>

                    <br />

                    {!! Form::open(['action' => ['DocumentsController@update', $document->id], 'method' => 'PUT', 'enctype' => 'multipart/form-data']) !!}

                    <div class="container">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">

                                    {{ Form::label('item_name', 'Item Name') }} <span style="color: red">*</span>
                                    {{ Form::text('item_name', $document->item_name, ['class' => 'form-control', 'placeholder' => 'Document Name']) }}

                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">

                                    {{ Form::label('service_type_id', 'Service Type') }} <span style="color: red">*</span>
                                    <select id="service_type_id"  name="service_type_id" class="form-control">
                                        <option value="">Select Service Type</option>
                                        @foreach ($service_types as $s)
                                            <option value="{{ $s->id }}"
                                                    @if($s->id == $document->service_type_id) selected="selected" @endif>
                                                {{ $s->name }}
                                            </option>
                                        @endforeach
                                    </select>

                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">

                                    {{ Form::label('brand', 'Brand') }}
                                    {{ Form::text('brand', $document->brand, ['class' => 'form-control', 'placeholder' => 'Brand']) }}

                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">

                                    {{ Form::label('model', 'Model') }}
                                    {{ Form::text('model', $document->model, ['class' => 'form-control', 'placeholder' => 'Model']) }}

                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">

                                    {{ Form::label('serial_no', 'Serial No') }}
                                    {{ Form::text('serial_no', $document->serial_no, ['class' => 'form-control', 'placeholder' => 'Serial No']) }}

                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">

                                    {{ Form::label('unit_id', 'Unit') }} <span style="color: red">*</span>
                                    <select id="unit_id"  name="unit_id" class="form-control">
                                        <option value="">Select Unit</option>
                                        @foreach ($units as $u)
                                            <option value="{{ $u->id }}"
                                                    @if($u->id == $document->unit_id) selected="selected" @endif>
                                                {{ $u->name }}
                                            </option>
                                        @endforeach
                                    </select>

                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">

                                    {{ Form::label('department_id', 'Department') }} <span style="color: red">*</span>
                                    <select id="department_id"  name="department_id" class="form-control">
                                        <option value="">Select Department</option>
                                        @foreach ($departments as $d)
                                            <option value="{{ $d->id }}"

                                                    @if($d->id == $document->department_id) selected="selected" @endif>

                                                {{ $d->name }}
                                            </option>
                                        @endforeach
                                    </select>

                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">

                                    {{ Form::label('user', 'User') }} <span style="color: red">*</span>
                                    {{ Form::text('user', $document->user, ['class' => 'form-control', 'placeholder' => 'User']) }}

                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">

                                    {{ Form::label('original_placement_location', 'Original Placement Location') }}
                                    {{ Form::text('original_placement_location', $document->original_placement_location, ['class' => 'form-control', 'placeholder' => 'Original Placement Location']) }}

                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">

                                    {{ Form::label('original_document_location', 'Original Document Location') }}
                                    {{ Form::text('original_document_location', $document->original_document_location, ['class' => 'form-control', 'placeholder' => 'Original Document Location']) }}

                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">

                                    {{ Form::label('last_renewal_date', 'Last Renewal Date') }} <span style="color: red">*</span>
                                    {{ Form::date('last_renewal_date', $document->last_renewal_date, ['class' => 'form-control', 'placeholder' => 'Last Renewal Date']) }}

                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">

                                    {{ Form::label('next_renewal_date', 'Next Renewal Date') }} <span style="color: red">*</span>
                                    {{ Form::date('next_renewal_date', $document->next_renewal_date, ['class' => 'form-control', 'placeholder' => 'Next Renewal Date']) }}

                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">

                                    {{ Form::label('vendor', 'Vendor') }}
                                    {{ Form::text('vendor', $document->vendor, ['class' => 'form-control', 'placeholder' => 'Vendor']) }}

                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">

                                    {{ Form::label('amount', 'Amount') }} <span style="color: red">*</span>
                                    {{ Form::number('amount', $document->amount, ['class' => 'form-control', 'placeholder' => 'Amount']) }}

                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">

                                    {{ Form::label('remarks', 'Remarks') }}
                                    {{ Form::text('remarks', $document->remarks, ['class' => 'form-control', 'placeholder' => 'Remarks']) }}

                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">

                                    {{ Form::label('file', 'Attachment') }}
                                    {{ Form::file('file', ['class' => 'form-control']) }}

                                    @if($document->file != '')
                                        <input type="hidden" name="previous_file" id="previous_file" value="{{ $document->file }}">
                                        <a href="{{ asset('/public/storage/attachments/').'/'.$document->file }}" target="_blank">
                                            Download/View
                                        </a>
                                    @endif

                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">

                                    <br />
                                    {{ Form::submit('UPDATE', ['class' => 'btn btn-success'])}}
                                    {{--{{ Form::reset('RESET', ['class' => 'btn btn-primary'])}}--}}

                                </div>
                            </div>
                        </div>
                    </div>

                    {!! Form::close() !!}

                </div>
            </div>
        </div>
    </div>
@endsection