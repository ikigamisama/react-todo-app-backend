<?php

namespace App\Http\Controllers\Api;

use App\Todo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Todo as TodoResource;


class TodoController extends Controller
{
    function __construct(){
        return $this->middleware('auth:api');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $todos = request()->user()->todos;
        return TodoResource::collection($todos);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $contact = $request->user()->todos()->create($request->all());
        return new TodoResource($contact);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Todo $todo)
    {
        return new TodoResource($todo);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Todo $todo)
    {
        if($request->user()->id !== $todo->user_id){
            return response()->json(['error' => 'Unauthorized Action'],401);
        }
        $todo->update($request->all());
        return response()->json(['details' => $todo ,'message' => 'Successful Update'],200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Todo $todo)
    {
        if(request()->user()->id !== $todo->user_id){
            return response()->json(['error' => 'Unauthorized Action'],401);
        }
        $todo->delete();

        return response()->json(['id' => $todo->id ,'message' => 'Successful Delete'],200);
    }
    public function getStatistic (Request $request){
        $current_Date =  date('Y-m-d');
        $countOutput = array();
     
        $countAllTodo = Todo::where(['user_id' => $request->user()->id])->count();
        $countAllTodoChecked = Todo::where('is_already_todo','true')->count();
        $countAllTodoThisDate = Todo::where(['todo_date' => $current_Date,'user_id' => $request->user()->id])->count();
 
     
        $countOutput = array(
            'all_todo_post' => $countAllTodo,
            'all_todo_check' => $countAllTodoChecked,
            'all_todo_this_date' => $countAllTodoThisDate
        );
 
        return json_encode($countOutput);
        
    }
}
