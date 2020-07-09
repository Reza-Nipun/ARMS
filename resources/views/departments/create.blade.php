@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header"><h3>Create Department</h3></div>

                    <br />

                    {!! Form::open(['action' => 'DepartmentsController@store', 'method' => 'POST']) !!}

                    <div class="container">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">

                                {{ Form::label('name', 'Department Name') }}
                                {{ Form::text('name', '', ['class' => 'form-control', 'placeholder' => 'Department Name']) }}

                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">

                                    {{ Form::label('description', 'Description') }}
                                    {{ Form::text('description', '', ['class' => 'form-control', 'placeholder' => 'Description']) }}

                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">

                                    <br />
                                    {{ Form::submit('SAVE', ['class' => 'btn btn-primary'])}}

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