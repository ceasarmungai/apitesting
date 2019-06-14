<?php

namespace App\Http\Controllers;

use App\Todo;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
   public function index()
{
    $result = Auth::user()->todo()->get();
    if(!$result->isEmpty()){
        return view('todo.dashboard',['todos'=>$result,'image'=>Auth::user()->userimage]);
    }else{
        return view('todo.dashboard',['todos'=>false,'image'=>Auth::user()->userimage]);
        $url = Storage::url('file.jpg');
    }
}
protected function validator(array $request)
{
    return Validator::make($request, [
        'todo' => 'required',
        'description' => 'required',
        'category' => 'required'
    ]);
}

    public function __construct()
{
    $this->middleware('auth');
}

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         return view('todo.addtodo');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
{
    $this->validator($request->all())->validate();
    if(Auth::user()->todo()->Create($request->all())){
        return $this->index();
    }
}
    /**
     * Display the specified resource.
     *
     * @param  \App\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function show(Todo $todo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function edit(Todo $todo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Todo $todo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Todo $todo)
    {
        //
    }
}
