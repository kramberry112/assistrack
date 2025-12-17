<?php
namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\Channel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class StudentTaskStepUpdated implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $taskId;
    public $userId;
    public $currentStep;

    public function __construct($taskId, $userId, $currentStep)
    {
        $this->taskId = $taskId;
        $this->userId = $userId;
        $this->currentStep = $currentStep;
    }

    public function broadcastOn(): array
    {
        return [new Channel('student-tasks')];
    }

    public function broadcastWith()
    {
        return [
            'taskId' => $this->taskId,
            'userId' => $this->userId,
            'currentStep' => $this->currentStep,
            'percentage' => $this->currentStep * 10
        ];
    }
}
