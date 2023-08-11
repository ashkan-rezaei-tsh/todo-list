<?php

namespace App\Http\Controllers;

use App\Http\Requests\TodoAddRequest;
use App\Http\Requests\TodoUpdateRequest;
use App\Http\Resources\TodoListResource;
use App\Models\Todo;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

class TodoController extends Controller
{
    /**
     * @param TodoAddRequest $request
     * @return JsonResponse
     */
    public function store(TodoAddRequest $request): JsonResponse
    {
        $user = auth()->user();
        $todo = $user->todos()->create([
            'todo' => $request->todo,
            'description' => $request->description,
        ]);

        return response()->json($todo, 201);
    }


    /**
     * @return JsonResponse
     */
    public function list(): JsonResponse
    {
        return response()->json(TodoListResource::collection(auth()->user()->todos));
    }

    /**
     * @param $id
     * @return JsonResponse
     */
    public function show($id): JsonResponse
    {
        $user = auth()->user();

        $todo = $user->todos()->where('id', $id)->first();

        if ($todo) {
            return response()->json($todo);
        } else {
            abort(404);
        }
    }

    public function update($id, TodoUpdateRequest $request): JsonResponse
    {
        $user = auth()->user();

        $todo = $user->todos()->where('id', $id)->first();

        if (!$todo) {
            abort(404);
        }

        $result = $todo->update([
            'todo' => $request->todo ?? $todo->todo,
            'description' => $request->description ?? $todo->description,
            'done' => $request->done ?? $todo->done,
        ]);

        return response()->json(['status' => $result]);
    }

    public function toggleDone($id)
    {
        $user = auth()->user();

        $todo = $user->todos()->where('id', $id)->first();

        if (!$todo) {
            abort(404);
        }

        $result = $todo->update([
            'done' => !$todo->done
        ]);

        return response()->json(['status' => $result, 'todo' => $todo]);
    }
}
