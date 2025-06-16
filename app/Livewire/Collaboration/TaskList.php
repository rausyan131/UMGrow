<?php

namespace App\Livewire\Collaboration;

use App\Models\CollaborationTask;
use App\Models\CollaborationTaskLog;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class TaskList extends Component
{
    public $collaborationId;

    public $newTask = '';
    public $assignedTo = 'both';
    public $newDeadline = '';

    public $filterBy = 'all';
    public $tasks = [];

    public $editMode = false;
    public $editTaskId;
    public $editedTask = '';
    public $editedAssignedTo = 'both';
    public $editedDeadline = '';
    public $editNote = '';


    protected $listeners = ['refreshTasks' => 'loadTasks'];

    public function mount($collaborationId)
    {
        $this->collaborationId = $collaborationId;
        $this->loadTasks();
    }

    public function loadTasks()
    {
        $query = CollaborationTask::where('collaboration_id', $this->collaborationId)
            ->orderByDesc('id');

        if ($this->filterBy !== 'all') {
            $query->where('assigned_to', $this->filterBy);
        }

        $this->tasks = $query->get();
    }

    public function applyFilter()
    {
        $this->loadTasks(); 
    }

    public function addTask()
    {
        $this->validate([
            'newTask' => 'required|string',
            'newDeadline' => 'nullable|date',
        ]);

        $task = CollaborationTask::create([
            'collaboration_id' => $this->collaborationId,
            'task' => $this->newTask,
            'assigned_to' => $this->assignedTo,
            'deadline' => $this->newDeadline ?: null,  
            'created_by' => auth()->id(),
        ]);
 
        

        CollaborationTaskLog::create([
            'task_id' => $task->id,
            'user_id' => Auth::id(),
            'action' => 'created',
            'note' => 'Menambahkan tugas baru',
        ]);

        $this->reset(['newTask', 'assignedTo', 'newDeadline']);
        $this->loadTasks();
        $this->dispatch('log-updated');
        $this->dispatch('show-toast', message: 'Tugas Berhasil ditambah');
    }

    public function editTask($taskId)
    {
        $task = CollaborationTask::findOrFail($taskId);
        $this->editMode = true;
        $this->editTaskId = $task->id;
        $this->editedTask = $task->task;
        $this->editedAssignedTo = $task->assigned_to;
        $this->editedDeadline = optional($task->deadline)->format('Y-m-d');
    }

    public function updateTask($taskId)
    {
        $this->validate([
            'editedTask' => 'required|string',
            'editedDeadline' => 'nullable|date',
        ]);
    
        $task = CollaborationTask::findOrFail($taskId);
    
        $changes = [];
    
        if ($task->task !== $this->editedTask) {
            $changes[] = "Nama tugas diubah dari '{$task->task}' ke '{$this->editedTask}'";
        }
    
        if ($task->assigned_to !== $this->editedAssignedTo) {
            $changes[] = "Penanggung jawab diubah dari '{$task->assigned_to}' ke '{$this->editedAssignedTo}'";
        }
    
        $oldDeadline = optional($task->deadline)->format('Y-m-d');
        $newDeadline = $this->editedDeadline;
        if ($oldDeadline !== $newDeadline) {
            $changes[] = "Deadline diubah dari '{$oldDeadline}' ke '{$newDeadline}'";
        }
    
        $task->update([
            'task' => $this->editedTask,
            'assigned_to' => $this->editedAssignedTo,
            'deadline' => $newDeadline ? Carbon::parse($newDeadline) : null,
        ]);
    
        $note = implode(', ', $changes);
        if ($this->editNote) {
            $note .= $note ? " | Catatan: {$this->editNote}" : $this->editNote;
        }
    
        CollaborationTaskLog::create([
            'task_id' => $task->id,
            'user_id' => Auth::id(),
            'action'  => 'updated',
            'note'    => $note ?: 'Mengedit tugas tanpa perubahan besar',
        ]);
    
        $this->editMode = false;
        $this->reset([
            'editTaskId',
            'editedTask',
            'editedAssignedTo',
            'editedDeadline',
            'editNote'
        ]);
    
        $this->loadTasks();
        $this->dispatch('log-updated');
        $this->dispatch('show-toast', message: 'Tugas berhasil diedit');
    }
    

    
    public function cancelEdit()
    {
        $this->editMode = false;
        $this->reset(['editTaskId', 'editedTask', 'editedAssignedTo', 'editedDeadline']);
    }

    public function toggleDone($taskId)
    {
        $task = CollaborationTask::find($taskId);
    
        $isNowDone = !$task->is_done;
    
        $task->is_done = $isNowDone;
    
        if ($isNowDone) {
            $task->completed_by = auth()->id();
            $task->completed_at = now();
        } else {
            $task->completed_by = null;
            $task->completed_at = null;
        }
    
        $task->save();
    
        CollaborationTaskLog::create([
            'task_id' => $task->id,
            'user_id' => auth()->id(),
            'action'  => $isNowDone ? 'completed' : 'uncompleted',
            'note'    => $isNowDone ? 'Menandai tugas sebagai selesai' : 'Membatalkan tanda selesai',
        ]);
    
        $this->loadTasks();
        $this->dispatch('log-updated');
    }
    

    public function deleteTask($taskId)
    {
        $task = CollaborationTask::find($taskId);
        if ($task) {
            CollaborationTaskLog::create([
                'task_id' => $task->id,
                'user_id' => Auth::id(),
                'action'  => 'deleted',
                'note'    => 'Menghapus tugas',
            ]);
            $task->delete();
            $this->loadTasks();
        }
        $this->dispatch('log-updated');
        $this->dispatch('show-toast', message: 'Tugas Berhasil dihapus');
    }

    public function getProgressPercentageProperty()
    {
        $total = count($this->tasks);
        $done = $this->tasks->where('is_done', true)->count();

        return $total > 0 ? round(($done / $total) * 100) : 0;
    }

    public function render()
    {
        return view('livewire.collaboration.task-list');
    }
}
