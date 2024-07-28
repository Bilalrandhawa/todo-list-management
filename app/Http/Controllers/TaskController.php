<?php

namespace App\Http\Controllers;
use App\Models\Task;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Carbon\Carbon;
class TaskController extends Controller
{
    public function AddTask()
    {
        $userName = auth()->user()->name;
        return view('tasks.create-tasks',compact('userName'));
    }
    // store data into db
    public function store(Request $request)
    {
        // Validate the request
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'due_date' => 'required|date_format:d/m/Y H:i',
            'status' => 'required|in:pending,accepted,rejected',
            'description' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Convert the date to a format
        try {
            $dueDate = Carbon::createFromFormat('d/m/Y H:i', $request->input('due_date'))->format('Y-m-d H:i:s');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['due_date' => 'Invalid date format'])->withInput();
        }


        Task::create([
            'title' => $request->input('title'),
            'due_date' => $dueDate,
            'status' => $request->input('status'),
            'description' => $request->input('description'),
            'user_id' => Auth()->user()->id,
        ]);

        return redirect()->route('dashboard')->with('success', 'Task created successfully.');
    }
    // Delete the task
    public function destroy($id)
    {
        $task = Task::findOrFail($id);
        $task->delete();

        return redirect()->back()->with('success', 'Task deleted successfully');
    }
    public function edit($id)
    {
        $userName = auth()->user()->name;
        $task = Task::findOrFail($id);
        return view('tasks.edit-tasks', compact('task','userName'));
    }
    public function update(Request $request)
    {
        // Validation rules
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'due_date' => 'required|date_format:d/m/Y H:i',
            'status' => 'required|in:pending,accepted,rejected',
            'description' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        // Convert the date to a format
        try {
            $dueDate = Carbon::createFromFormat('d/m/Y H:i', $request->input('due_date'))->format('Y-m-d H:i:s');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['due_date' => 'Invalid date format'])->withInput();
        }
        // update record
        $task = Task::find($request->input('id'));
        if ($task) {
            $task->title = $request->input('title');
            $task->due_date = $dueDate;
            $task->status = $request->input('status');
            $task->description = $request->input('description');
            $task->user_id = Auth()->user()->id;
            $task->save();

            return redirect()->route('dashboard')->with('success', 'Task updated successfully!');
        } else {
            return redirect()->route('dashboard')->with('error', 'Task not found.');
        }
    }
}
