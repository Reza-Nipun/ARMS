@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header"><h3>Edit Service Type</h3></div>

                    <br />

                    {!! Form::open(['action' => ['ServiceTypesController@update', $service_type->id], 'method' => 'PUT']) !!}

                    <div class="container">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">

                                    {{ Form::label('name', 'Service Type Name') }}
                                    {{ Form::text('name', $service_type->name, ['class' => 'form-control', 'placeholder' => 'Service Type Name']) }}

                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">

                                    {{ Form::label('description', 'Description') }}
                                    {{ Form::text('description', $service_type->description, ['class' => 'form-control', 'placeholder' => 'Description']) }}

                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">

                                    <br />
                                    {{ Form::submit('Submit', ['class' => 'btn btn-primary'])}}

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