@extends('layouts.app')

@section('content')

    <div class="card">
        <div class="card-header">Dashboard</div>

        <div class="card-body">
            <div class="container-flex">
                <h1>Create Todo App</h1>
                {!! Form::open(['action' => 'TodoController@store','method' => 'POST'])!!}
                    <div class="form-group">
                        {{Form::label('title','Title')}}
                        {{Form::text('title_todoapp','',['class' => 'form-control', 'placeholder' => 'Title'])}}
                    </div>
                    <div class="form-group">
                        {{Form::label('description','Description')}}
                        {{Form::textarea('description_todoapp','',['class' => 'form-control','id' => 'article-ckeditor', 'placeholder' => 'Todo Description'])}}
                    </div>
                    <div class="row mb-5">
                        <div class="col-sm-12 col-md-12 col-lg-6">
                            {{Form::label('date','Date')}}
                            {{Form::date('date_todoapp','',['class' => 'form-control'])}}
                        </div>
                        <div class="col-sm-12 col-md-12 col-lg-6">
                            {{Form::label('time','Time')}}
                            {{Form::time('time_todoapp','',['class' => 'form-control'])}}
                        </div>
                    </div>
                    {{Form::submit('Submit',['class' => 'btn btn-primary'])}}
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection
