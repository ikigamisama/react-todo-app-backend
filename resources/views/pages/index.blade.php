@extends('layouts.app')

@section('content')
    <div class="jumbotron text-center">
        <h1>{{$title}}</h1>
        <p>An app that create your own Todo List</p>
        <p>
            <a href="/dashboard" class="btn btn-primary" role="button">Create ToDo App Now</a>
        </p>


    </div>
    
@endsection