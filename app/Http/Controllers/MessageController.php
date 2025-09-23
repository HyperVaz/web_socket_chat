<?php

namespace App\Http\Controllers;

use App\Http\Requests\Message\StoreRequest;
use App\Http\Resources\Message\MessageResource;
use App\Models\Messages;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function index()
    {
        $messages = Messages::all();
        $messages = MessageResource::collection($messages)->resolve();
        return inertia('Message/Index', compact($messages));
    }

    public function store(StoreRequest $request)
    {
        $data = $request->validated();
        $message = Messages::create($data);
        return MessageResource::make($message)->resolve();
    }
}
