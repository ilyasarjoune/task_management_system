<?php
namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Category;
use App\Models\Status;
use App\Models\User;
use App\Models\Assignment;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class taskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tasks = Task::all();
        $categories = Category::all();
        $statuses = Status::all();
        $users = User::all(); // Fetch all users
        return view('task', compact('tasks', 'categories', 'statuses', 'users'));
    }

    public function getTasks(Request $request)
    {
        if ($request->ajax()) {
            $tasks = Task::with(['category', 'status'])->select('tasks.*');
            return DataTables::of($tasks)
                ->addColumn('category', function (Task $task) {
                    return $task->category->name;
                })
                ->addColumn('status', function (Task $task) {
                    return $task->status->name;
                })
                ->addColumn('action', function ($row) {
                    return '
                        <button class="btn btn-sm btn-primary" onclick="editTask(' . $row->id . ')">Edit</button>
                        <form action="' . route('task.destroy', $row->id) . '" method="POST" style="display:inline;">
                            ' . csrf_field() . '
                            ' . method_field('DELETE') . '
                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                        </form>';
                })
                ->make(true);
        }
    }

    public function assignUser(Request $request, Task $task)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
        ]);

        Assignment::create([
            'task_id' => $task->id,
            'user_id' => $validated['user_id'],
        ]);

        return redirect()->back()->with('success', 'User assigned successfully.');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return 'tasks';
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the form data
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'statu_id' => 'required',
            'startDate' => 'nullable|date',
            'expectedEndDate' => 'nullable|date',
            'endDate' => 'nullable|date',
            'categorie_id' => 'required',
        ]);

        // Create a new task
        Task::create($validated);

        // Redirect back with success message
        return redirect()->back()->with('success', 'Task created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        return 'show';
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        return response()->json($task);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task)
    {
        // Validate the form data
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'statu_id' => 'required',
            'startDate' => 'nullable|date',
            'expectedEndDate' => 'nullable|date',
            'endDate' => 'nullable|date',
            'categorie_id' => 'required',
        ]);

        // Update the task
        $task->update($validated);

        // Redirect back with success message
        return redirect()->back()->with('success', 'Task updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        $task->delete();
        return redirect()->back()->with('success', 'Task deleted successfully.');
    }
}
