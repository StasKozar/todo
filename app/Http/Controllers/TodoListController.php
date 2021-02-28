<?php

namespace App\Http\Controllers;

use App\Models\TodoList;
use Illuminate\Http\Request;

class TodoListController extends Controller
{
    public function index()
    {
        $todoLists = auth()->user()->todoLists();
        return view('dashboard', compact('todoLists'));
    }

    public function add()
    {
        return view('todolists.add');
    }

    public function create(Request $request)
    {
        $this->validate($request, [
            'title' => 'required'
        ]);
        $todoList = new TodoList();
        $todoList->title = $request->title;
        $todoList->user_id = auth()->user()->id;
        $todoList->save();
        return redirect('/dashboard');
    }

    public function edit(TodoList $todoList)
    {
        if (auth()->user()->id == $todoList->user_id)
        {
            return view('todolists.edit', compact('todoList'));
        }
        else {
            return redirect('/dashboard');
        }
    }

    public function update(Request $request, TodoList $todoList)
    {
        if(isset($_POST['delete'])) {
            $todoList->delete();
            return redirect('/dashboard');
        }
        else
        {
            $this->validate($request, [
                'title' => 'required'
            ]);
            $todoList->title = $request->title;
            $todoList->save();
            return redirect('/dashboard');
        }
    }
}
