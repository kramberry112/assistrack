<?php
namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\Channel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class StudentTaskRejected implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $taskId;
    public $userId;

    public function __construct($taskId, $userId)
    {
        $this->taskId = $taskId;
        $this->userId = $userId;
    }

    public function broadcastOn(): array
    {
        return [new Channel('student-tasks')];
    }

    public function broadcastWith()
    {
        return [
            'taskId' => $this->taskId,
            'userId' => $this->userId
        ];
    }
}