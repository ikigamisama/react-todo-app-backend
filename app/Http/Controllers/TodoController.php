<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Todo;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $todo_list = Todo::all();
        return view('todo.index')->with('todos',$todo_list);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('todo.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'title_todoapp' => 'required',
            'description_todoapp' => 'required',
            'date_todoapp' => 'required',
            'time_todoapp' => 'required'
        ]);

        $todo = new Todo;
        $todo->todo_name = $request->input('title_todoapp');
        $todo->todo_description = $request->input('description_todoapp');
        $todo->user_id = auth()->user()->id;
        $todo->todo_date = $request->input('date_todoapp');
        $todo->todo_time = $request->input('time_todoapp');
        $todo->is_already_todo = "false";
        $todo->save();

        return redirect('/dashboard')->with('success','Todo Create');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $todo = Todo::find($id);
        return view('todo.show')->with('todo',$todo);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $todo = Todo::find($id);
         // Check for corrent user
         if(auth()->user()->id !== $todo->user_id){
            return redirect('/dashboard')->with('error','unauthorized Page');   
         }
        return view('todo.edit')->with('todo',$todo);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'title_todoapp' => 'required',
            'description_todoapp' => 'required',
            'date_todoapp' => 'required',
            'time_todoapp' => 'required'
        ]);

        $todo = Todo::find($id);
        $todo->todo_name = $request->input('title_todoapp');
        $todo->todo_description = $request->input('description_todoapp');
        $todo->todo_date = $request->input('date_todoapp');
        $todo->todo_time = $request->input('time_todoapp');
        $todo->is_already_todo = 0;
        $todo->save();

        return redirect('/dashboard')->with('success','Todo Edited');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $todo = Todo::find($id);
        // Check for corrent user
        if(auth()->user()->id !== $todo->user_id){
            return redirect('/dashboard')->with('error','Unauthorized Page');   
         }
       
        $todo->delete();
        return redirect('/dashboard')->with('success','Post Removed');
    }
}
