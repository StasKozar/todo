<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TodoTask;

class TodoTaskController extends Controller
{
    public function add($id)
    {
        $todoListId = $id;
    	return view('tasks.add', compact('todoListId'));
    }

    public function create(Request $request, int $todoListId)
    {
        $this->validate($request, [
            'title' => 'required'
        ]);
    	$task = new TodoTask();
    	$task->title = $request->title;
    	$task->todo_list_id = $todoListId;
    	$task->save();

    	return redirect('/todo-list/' . $todoListId);
    }

    public function update(Request $request, int $todoListId, TodoTask $task)
    {
    	if(isset($_POST['delete'])) {
    		$task->delete();

    		return redirect('/todo-list/' . $todoListId);
    	} elseif(isset($_POST['done'])) {
    		$task->is_done = 1;
	    	$task->save();

	    	return redirect('/todo-list/' . $todoListId);
    	}
    }
}
