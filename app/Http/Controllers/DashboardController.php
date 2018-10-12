<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use App\User;
use App\Todo;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user_id = auth()->user()->id;
        $todo_lists = User::find($user_id);

        if(!auth()->user()->id){
            return redirect('/register')->with('error','You Must Create account First');
        }
        return view('dashboard')->with('todos',$todo_lists->todos);
    }
    public function getFetchData(Request $request){
        if($request->ajax()){
            $output = array();
            $todo_lists = DB::table('todos')->get();
            $output = json_encode($todo_lists);
            return Response($output);
        }
    }
    public function updateTodoListChecked($id, $isChecked){
       $todo = Todo::find($id);
       $todo->is_already_todo = $isChecked;
       $todo->save();
    }
    public function getAllStatisticTodoApp(){
       $current_Date =  date('Y-m-d');
       $countOutput = array();
    
       $countAllTodo = Todo::where(['user_id' => $request->user()->id])->count();
       $countAllTodoChecked = Todo::where('is_already_todo','true')->count();
       $countAllTodoThisDate = Todo::where(['todo_date' => $current_Date,'user_id' => auth()->user()->id])->count();

    
       $countOutput = array(
           'all_todo_post' => $countAllTodo,
           'all_todo_check' => $countAllTodoChecked,
           'all_todo_this_date' => $countAllTodoThisDate
       );

       return json_encode($countOutput);
       

    }
}
