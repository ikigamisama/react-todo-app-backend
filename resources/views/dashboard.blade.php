@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-10">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif
            <div class="card mb-3">
                <div class="card-header">Dashboard</div>
                <div class="card-body ">
                    <h2 class="text-center">Your Schedule for Today</h2>
                    <div class="row mt-3 text-white">
                        <div class="col-sm-12 col-md-6 col-lg-4 mb-2">
                            <div class="card bg-primary">
                                <div class="card-body">
                                    <h6>On This day</h6>
                                    <h2 id="todo_count_this_day"></h2>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-4 mb-2">
                                <div class="card bg-info">
                                    <div class="card-body">
                                        <h6>Checked</h6>
                                        <h2 id="todo_checked"></h2>
                                    </div>
                                </div>
                            </div>
                        <div class="col-sm-12 col-md-12 col-lg-4 mb-2">
                            <div class="card bg-danger">
                                <div class="card-body">
                                    <h6>Todo All Post</h6>
                                    <h2 id="todo_all_post"></h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header">Todo List</div>
                <div class="card-body">
                  <div class="container-flex mt-2">
                      <div class="table-container" style="max-height:500px;overflow-x:hidden;overflow-y:auto;">
                        <table class="table">
                            <thead>
                                <th>Todo</th>
                                <th>Date</th>
                                <th>Time</th>
                                <th></th>
                                <th></th>
                                <th>Done</th>
                            </thead>
                            <tbody class="">
                                @if(count($todos) > 0)
                                    @foreach($todos as $todo_list).
                                        <tr>
                                            <td>
                                                <a href="/todo/{{$todo_list->id}}">{{$todo_list->todo_name}}</a>
                                            </td>
                                            <td>{{$todo_list->todo_date}}</td>
                                            <td>{{$todo_list->todo_time}}</td>
                                            <td><a href="/todo/{{$todo_list->id}}/edit" class="btn btn-success">Edit</a></td>
                                            <td>
                                                {!!Form::open(['action' => ['TodoController@destroy', $todo_list->id], 'method' => 'POST'])!!}
                                                {{Form::hidden('_method','DELETE')}}
                                                {{Form::submit('Delete',['class'=>'btn btn-danger'])}}
                                                {!!Form::close() !!}
                                            </td>
                                            <td>
                                                @if($todo_list->is_already_todo === "false" || $todo_list->is_already_todo === false)
                                                    <input type="checkbox" data-id="{{$todo_list->id}}" class="check-done" >
                                                @else
                                                    <input type="checkbox" data-id="{{$todo_list->id}}" class="check-done" checked>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <p class="text-center">There Nothing Post here</p>
                                @endif
                            </tbody>
                        </table>
                      </div>
                  </div>
                </div>
            </div>
        </div>
    </div>
@endsection
