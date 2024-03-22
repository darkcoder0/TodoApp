<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Todo;
use Illuminate\Support\Facades\Validator;

class TodoController extends Controller
{
    public function TaskList()
    {
        // Get all Task list
        $get_all_todo = Todo::paginate(2);
        return view('tasklist',['tasklist' => $get_all_todo]);
    }

    public function AddTask(Request $request)
    {
        // Add a new task using
        $validator = Validator::make($request->all(), [
            'task' =>'required|max:255',
            'desc' => 'required|max:255',
            'due_date' =>'required|date',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        else
        {
            $new_task = new Todo;
            $new_task->task_name = $request->task;
            $new_task->description = $request->desc;
            $new_task->due_date = $request->due_date;
            $new_task->status = 'pending';
            $new_task->save();
            return redirect()->back()->with('success', 'Task Added Successfully');
        }
    }

    public function EditTask(Request $request)
    {
        // Edit and Update a task
        $get_all_todo = Todo::paginate(2);
        $todo_id = $request->id;
        $task = Todo::find($todo_id);
        return view('tasklist',['edittask' => $task,'tasklist' => $get_all_todo]);

    }

    public function DeleteTask(Request $request){
        // Delete a task
        $delete_task = Todo::find($request->id);
        $delete_task->delete();
        return redirect()->back()->with('delete', 'Task Deleted Successfully');
    }

    public function UpdateTask(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'task' =>'required|max:255',
            'desc' => 'required|max:255',
            'due_date' =>'required|date',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        else
        {
            $update_task = Todo::find($request->id);
            $update_task->task_name = $request->task;
            $update_task->description = $request->desc;
            $update_task->due_date = $request->due_date;
            $update_task->save();

            return redirect('/')->with('success', 'Task Updated Successfully');
        }
    }

    public function Taskdone(Request $request)
    {
        $update_task = Todo::find($request->id);
        $update_task->status = 'completed';
        $update_task->save();
        return redirect()->back()->with('success', 'Task Completed Successfully');
    }
}

