<?php

namespace App\Http\Controllers;

use App\Dtos\TaskStoreDto;
use App\Dtos\TaskUpdateDto;
use App\Http\Requests\Task\TaskDeleteRequest;
use App\Http\Requests\Task\TaskListRequest;
use App\Http\Requests\Task\TaskShowRequest;
use App\Http\Requests\Task\TaskStoreRequest;
use App\Http\Requests\Task\TaskUpdateRequest;
use App\Models\Task;
use App\Services\TaskService;
use Illuminate\Http\JsonResponse;

class TaskController extends Controller
{
    public function __construct(protected TaskService $taskService)
    {
    }

    public function index(TaskListRequest $request): JsonResponse
    {
        $filters = $request->only(['status', 'search', 'sort_by', 'order']);
        $tasks = $this->taskService->list($filters);

        return response()->json($tasks);
    }

    public function store(TaskStoreRequest $request): JsonResponse
    {
        $dto = TaskStoreDto::fromArray([
            'title' => $request->validated('title'),
            'description' => $request->validated('description'),
            'dueDate' => $request->validated('due_date'),
            'status' => $request->validated('status'),
        ]);
        $task = $this->taskService->store($dto);

        return response()->json([
            'message' => 'Task created successfully.',
            'task' => $task,
        ], 201);
    }

    public function show(TaskShowRequest $request, Task $task): JsonResponse
    {
        return response()->json($task);
    }

    public function update(TaskUpdateRequest $request, Task $task): JsonResponse
    {
        $dto = TaskUpdateDto::fromArray([
            'title' => $request->validated('title'),
            'description' => $request->validated('description'),
            'dueDate' => $request->validated('due_date'),
            'status' => $request->validated('status'),
        ]);
        $task = $this->taskService->update($task, $dto);

        return response()->json([
            'message' => 'Task updated successfully.',
            'task' => $task,
        ]);
    }

    public function destroy(TaskDeleteRequest $request, Task $task): JsonResponse
    {
        $this->taskService->delete($task);

        return response()->json(['message' => 'Task deleted successfully.']);
    }
}
