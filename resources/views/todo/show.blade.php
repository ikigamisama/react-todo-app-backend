@extends('layouts.app')

@section('content')
    <a href="/posts" class="btn btn-default">Go Back</a>
    <h1>{{$todo->todo_name}}</h1>
    <br>
    <div>
        {!!$todo->todo_description!!}
    </div>
    <hr>
    <small>Written on {{$todo->created_at}} by {{$todo->user->name}}</small>
    <hr>

    @if(!Auth::guest())
        @if(Auth::user()->id === $todo->user_id)
            <a href="/todo/{{$todo->id}}/edit" class="btn btn-primary">Edit</a>

            {!!Form::open(['action' => ['TodoController@destroy', $todo->id], 'method' => 'POST', 'class' => 'float-right'])!!}
                {{Form::hidden('_method','DELETE')}}
                {{Form::submit('Delete',['class'=>'btn btn-danger'])}}
            {!!Form::close() !!}
        @endif
    @endif
@endsection