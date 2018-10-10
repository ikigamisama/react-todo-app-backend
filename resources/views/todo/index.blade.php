@extends('layouts.app')

@section('content')
    <h1>Todo</h1>
    @if(count($todos) > 1)
        @foreach($todos as $todo_list)
            <div class="card card-body bg-light mb-3">
                <div class="row">
                    <div class="col-md-12">
                        <h3><a href="/todo/{{$todo_list->id}}">{{$todo_list->todo_name}}</a></h3>
                        <small>Written on {{$todo_list->created_at}}</small>
                    </div>
                </div>
            </div>
        @endforeach
    @else
        <p>No Post Found</p>
    @endif
@endsection