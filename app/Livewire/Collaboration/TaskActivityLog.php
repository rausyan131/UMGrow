<?php

namespace App\Livewire\Collaboration;

use Livewire\Component;
use App\Models\CollaborationTaskLog;

class TaskActivityLog extends Component
{
    public $collaborationId;
    public $logs = [];

    protected $listeners = ['log-updated' => 'loadLogs'];

    public function mount($collaborationId)
    {
        $this->collaborationId = $collaborationId;
        $this->loadLogs();
    }

    public function loadLogs()
    {
        $this->logs = CollaborationTaskLog::with(['task', 'user'])
            ->whereHas('task', function ($query) {
                $query->where('collaboration_id', $this->collaborationId);
            })
            ->latest()
            ->take(10)
            ->get();
    }

    public function render()
    {
        return view('livewire.collaboration.task-activity-log');
    }
}
