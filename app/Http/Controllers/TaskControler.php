<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Http\Resources\TaskResource;
use Illuminate\Http\Request;

use App\Models\Task;

class TaskControler extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user= $request->user();
        return TaskResource::collection(Task::where('user_id', $user->id)->with('user')->paginate());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreTaskRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTaskRequest $request)
    {
        $result = Task::create($request->validated());

        return new TaskResource($result);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task, Request $request)
    {
        $user = $request->user();
        if ($user->id !== $task->user_id) {
            return abort(403, 'Unauthorized action.');
        }

        return new TaskResource($task);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTaskRequest  $request
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTaskRequest $request, Task $task)
    {
        // dd($request->validated());
        $task->update($request->validated());
        return new TaskResource($task);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task, Request $request)
    {
        $user = $request->user();
        if ($user->id !== $task->user_id) {
            return abort(403, 'Unauthorized action.');
        }

        $task->delete();

        return response("",204);
    }
}
