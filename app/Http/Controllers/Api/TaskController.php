<?php

namespace App\Http\Controllers\Api;

use App\Models\Task;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tasks = auth()->user()->tasks;
        if ($tasks) {
            return response()->json([
                'success' => true,
                'tasks' => $tasks
            ], 201);
        }

        return response()->json([
            'success' => false,
        ], 409);

    }

    // /**
    //  * Show the form for creating a new resource.
    //  */
    // public function create()
    // {
    //     //
    // }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'judul' => 'required|string|max:100',
            'deskripsi' => 'required|string',
            'selesai' => 'boolean'
        ]);


        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $task = Task::create([
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'selesai' => $request->has('selesai') ? $request->selesai : false,
            'user_id' => auth()->id(),
        ]);

         if ($task) {
            return response()->json([
                'success' => true,
                'task' => $task
            ], 201);
        }

        return response()->json([
            'success' => false,
        ], 409);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $task = auth()->user()->tasks()->findOrFail($id);
         if ($task) {
            return response()->json([
                'success' => true,
                'task' => $task
            ], 201);
        }

        return response()->json([
            'success' => false,
        ], 409);
    }

    // /**
    //  * Show the form for editing the specified resource.
    //  */
    // public function edit(string $id)
    // {
        
    // }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'judul' => 'required|string|max:100',
            'deskripsi' => 'required|string',
            'selesai' => 'required|boolean'
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        
        $task = auth()->user()->tasks()->findOrFail($id);
        
        $task = Task::update([
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'selesai' => $request->selesai,
            'user_id' => auth()->id(),
        ]);

        if ($task) {
            return response()->json([
                'success' => true,
                'task' => $task
            ], 201);
        }

        return response()->json([
            'success' => false,
        ], 409);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $task = auth()->user()->tasks()->findOrFail($id);
        $task = Task::delete();
        if ($task) {
             return response()->json([
                'success'=>true,
                'message' => 'Task deleted successfully'
            ],201);
        }

        return response()->json([
            'success' => false,
            'message' => 'fail to delete task'
        ],409);
    }
}
