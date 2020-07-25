@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header"><h3>Create Document</h3></div>

                    <br />

                    {!! Form::open(['action' => 'DocumentsController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}

                    <div class="container">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">

                                    {{ Form::label('item_name', 'Item Name') }} <span style="color: red">*</span>
                                    {{ Form::text('item_name', '', ['class' => 'form-control', 'placeholder' => 'Document Name']) }}

                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">

                                    {{ Form::label('service_type_id', 'Service Type') }} <span style="color: red">*</span>
                                    <select id="service_type_id"  name="service_type_id" class="form-control">
                                        <option value="">Select Service Type</option>
                                        @foreach ($service_types as $s)
                                             <option value="{{ $s->id }}">{{ $s->name }}</option>
                                        @endforeach
                                    </select>

                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">

                                    {{ Form::label('brand', 'Brand') }}
                                    {{ Form::text('brand', '', ['class' => 'form-control', 'placeholder' => 'Brand']) }}

                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">

                                    {{ Form::label('model', 'Model') }}
                                    {{ Form::text('model', '', ['class' => 'form-control', 'placeholder' => 'Model']) }}

                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">

                                    {{ Form::label('serial_no', 'Serial No') }}
                                    {{ Form::text('serial_no', '', ['class' => 'form-control', 'placeholder' => 'Serial No']) }}

                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">

                                    {{ Form::label('unit_id', 'Unit') }} <span style="color: red">*</span>
                                    <select id="unit_id"  name="unit_id" class="form-control">
                                        <option value="">Select Unit</option>
                                        @foreach ($units as $u)
                                            <option value="{{ $u->id }}">{{ $u->name }}</option>
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
                                            <option value="{{ $d->id }}">{{ $d->name }}</option>
                                        @endforeach
                                    </select>

                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">

                                    {{ Form::label('user', 'Liable Person') }} <span style="color: red">*</span>
                                    {{ Form::text('user', '', ['class' => 'form-control', 'placeholder' => 'Liable Person']) }}

                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">

                                    {{ Form::label('original_placement_location', 'Original Placement Location') }}
                                    {{ Form::text('original_placement_location', '', ['class' => 'form-control', 'placeholder' => 'Original Placement Location']) }}

                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">

                                    {{ Form::label('original_document_location', 'Original Document Location') }}
                                    {{ Form::text('original_document_location', '', ['class' => 'form-control', 'placeholder' => 'Original Document Location']) }}

                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">

                                    {{ Form::label('last_renewal_date', 'Last Renewal Date') }} <span style="color: red">*</span>
                                    {{ Form::date('last_renewal_date', '', ['class' => 'form-control', 'placeholder' => 'Last Renewal Date']) }}

                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">

                                    {{ Form::label('next_renewal_date', 'Next Renewal Date') }} <span style="color: red">*</span>
                                    {{ Form::date('next_renewal_date', '', ['class' => 'form-control', 'placeholder' => 'Next Renewal Date']) }}

                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">

                                    {{ Form::label('vendor', 'Vendor') }}
                                    {{ Form::text('vendor', '', ['class' => 'form-control', 'placeholder' => 'Vendor']) }}

                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">

                                    {{ Form::label('amount', 'Amount') }} <span style="color: red">*</span>
                                    {{ Form::number('amount', '', ['class' => 'form-control', 'placeholder' => 'Amount']) }}

                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">

                                    {{ Form::label('remarks', 'Remarks') }}
                                    {{ Form::text('remarks', '', ['class' => 'form-control', 'placeholder' => 'Remarks']) }}

                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">

                                    {{ Form::label('file', 'Attachment') }}
                                    {{ Form::file('file', ['class' => 'form-control']) }}

                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">

                                    <br />
                                    {{ Form::submit('SAVE', ['class' => 'btn btn-success'])}}
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