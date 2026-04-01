<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TodoController extends Controller
{
    public function index(){
        $tasks = session()->get('tasks',[]);
        return view("tasks.index",compact("tasks"));
    }

    public function store(Request $request){
        $request->validate([
            "title" => "required",
        ]);
        $tasks = session()->get("tasks", []);
        $tasks[] = [
            'id'=> time(),
            'title'=> $request->title,
            'completed' => false,
        ];
        session()->put('tasks',$tasks);
        return redirect()->route('tasks.index');
    }
    public function update($id)
    {
        $tasks = session()->get('tasks', []);

        foreach ($tasks as &$task) {
            if ($task['id'] == $id) {
                $task['completed'] = !$task['completed'];
            }
            unset($task);
        }

        session()->put('tasks', $tasks);

        return redirect()->route('tasks.index');
    }

    public function destroy($id)
    {
        $tasks = session()->get('tasks', []);

        $tasks = array_filter($tasks, function ($task) use ($id) {
            return $task['id'] != $id;
        });

        session()->put('tasks', $tasks);

        return redirect()->route('tasks.index');
    }
}