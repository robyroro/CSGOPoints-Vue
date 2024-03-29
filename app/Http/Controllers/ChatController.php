<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\ChatRoom;
use App\Models\ChatMessage;
use App\Events\NewChatMessage;

class ChatController extends Controller
{
    public function rooms(Request $request)
    {
      return ChatRoom::all();
    }

    public function messages($roomId)
    {
       return ChatMessage::where('chat_room_id',$roomId)->with('user')->orderBy('created_at','desc')->take(15)->get();
    }

    public function newmessage(Request $request, $id)
    {
      $newMessage = new ChatMessage;
      $newMessage->user_id = Auth::id();
      $newMessage->chat_room_id = $id;
      $newMessage->message = $request->message;
      $newMessage->save();
      broadcast(new NewChatMessage($newMessage))->toOthers();
    	return $newMessage;
    }
}
