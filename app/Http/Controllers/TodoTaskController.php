<?php

namespace App\Http\Controllers;

use App\Models\TodoList;
use App\Models\TodoTask;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class TodoTaskController extends Controller
{
    public function store(Request $request, TodoList $todolist)
    {
        $request->validate([
            'task' => ['required', 'min:3', 'max:25', Rule::unique('todo_tasks', 'task')]
        ]);

        $todolist->tasks()->create([
            'task' => $request->task
        ]);

        return back()->with('success', 'Task added');
    }

    public function update(Request $request, TodoList $todolist)
    {
        $request->validate([
            'complete' => ['array', Rule::exists('todo_tasks', 'id')],
            'remove' => ['array', Rule::exists('todo_tasks', 'id')]
        ]);

        /*if (!$request->input('complete') && !$request->input('remove')) {
            $request->session()->flash('error', 'No tasks selected');

            throw ValidationException::withMessages([
                'no-tasks' => 'No tasks selected'
            ]);
        }*/

        DB::table('todo_tasks')
            ->where('todo_list_id', $todolist->id)
            ->update(['complete' => null]);

        if ($request->input('complete')) {
            foreach ($request->input('complete') as $k => $v) {
                $todolist->tasks()->where('id', $v)->update([
                    'complete' => Date::now()
                ]);
            }
        }

        if ($request->input('remove')) {
            foreach ($request->input('remove') as $k => $v) {
                $todolist->tasks()->where('id', $v)->delete();
            }
        }

        return back()->with('success', 'Tasks updated');
    }
}
