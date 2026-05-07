<?php

namespace App\Notifications;

use App\Models\Book;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\DatabaseMessage;

class NewBookCreated extends Notification
{
    use Queueable;

    public function __construct(protected Book $book, protected User $creator)
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    /**
     * Get the array representation of the notification.
     */
    public function toDatabase(object $notifiable): array
    {
        return [
            'book_id' => $this->book->id,
            'title' => $this->book->title,
            'author' => $this->book->author,
            'creator_name' => $this->creator->name,
            'message' => "El estudiante {$this->creator->name} registró un nuevo libro: {$this->book->title}",
            'url' => route('books.index', ['book' => $this->book->id]),
            'created_at' => now()->toDateTimeString(),
        ];
    }

    public function toArray(object $notifiable): array
    {
        return $this->toDatabase($notifiable);
    }
}
