<?php

namespace App\Notifications;


use Illuminate\Notifications\Notification;


class ThreadWasUpdate extends Notification
{

    /**
     * The thread that was updated.
     *
     * @var \App\Models\Thread
     */
    protected $thread;
    /**
     * The new reply.
     *
     * @var \App\Models\Reply
     */
    protected $reply;

    /**
     * Create a new notification instance.
     *
     * @param \App\Models\Thread $thread
     * @param \App\Models\Reply  $reply
     */
    public function __construct($thread, $reply)
    {
        $this->thread = $thread;
        $this->reply = $reply;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }


    /**
     * Get the array representation of the notification.
     *  Получить  представление в виде массива уведомления.
     * @param  mixed $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'message' => $this->reply->owner->name. " replied to " . $this->thread->title,
            'link' => $this->reply->path()
        ];
    }

}
