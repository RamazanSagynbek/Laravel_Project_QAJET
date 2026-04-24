<?php

namespace App\Notifications;

use App\Models\Message;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class NewMessageNotification extends Notification
{
    use Queueable;

    public function __construct(public Message $message)
    {
    }

    public function via(object $notifiable): array
    {
        return ['database'];
    }

    public function toDatabase(object $notifiable): array
    {
        return [
            'message_id' => $this->message->id,
            'chat_id' => $this->message->chat_id,
            'sender_name' => $this->message->user->name,
            'body' => \Str::limit($this->message->body, 100),
            'url' => route('chats.show', $this->message->chat),
        ];
    }
}
