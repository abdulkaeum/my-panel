<?php

namespace App\Http\Controllers;

use App\Models\TodoList;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class TodoListController extends Controller
{
    public function index()
    {
        return view('todo.index', [
            'todolists' => auth()->user()->todolists()->orderBy('created_at')->paginate(10)
        ]);
    }

    public function show(TodoList $todolist)
    {
        return view('todo.show', [
            'todo' => $todolist
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make(
            ['todoname' => $request->input('todoname')],
            ['todoname' => ['required', 'min:3', 'max:30', Rule::unique('todo_lists','title')]]
        );

        if ($validator->fails()) {
            return redirect('/')->with('todoname', 'Provide characters between 5-30');
        }

        $todo = new TodoList();
        $todo->title = $request->input('todoname');
        $todo->user_id = $request->user()->id;
        $todo->save();

        return redirect()
            ->route('todolist.edit', $todo)
            ->with('info', 'Draft created');
    }

    public function edit(TodoList $todolist)
    {
        return view('todo.edit', [
            'todo' => $todolist
        ]);
    }

    public function update(Request $request, TodoList $todolist)
    {
        $request->validate([
            'title' => ['required', 'min:3', 'max:30', Rule::unique('todo_lists', 'title')->ignore($todolist->id)],
            'file' => ['file'],
        ]);

        $todolist->title = $request->title;
        $todolist->complete = $request->complete ? Date::now() : null;
        $todolist->flag = $request->flag ? Date::now() : null;
        $todolist->due_date = $request->due_date ?? null;
        $todolist->note = $request->note;
        $todolist->file = $request->file('file')?->store('todo') ?? null;
        $todolist->save();

        if($request->fileRemove || $request->file('file')){
            Storage::disk('public')->delete($request->fileRemove);
        }

        return redirect()->route('todolist.index')->with('success', $request->title.' todo is set');
    }

    public function flag(TodoList $todolist)
    {
        $todolist->flag = is_null($todolist->flag) ? Date::now() : null;
        $todolist->save();

        return back();
    }

    public function destroy(TodoList $todolist)
    {
        $todolist->delete();

        return back()->with('Success', 'Todo deleted');
    }
}
