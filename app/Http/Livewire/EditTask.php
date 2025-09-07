<?php

namespace App\Http\Livewire;

use App\Models\Task;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class EditTask extends Component
{

    public bool $showModal = false;
    public array $task = [];

    protected $listeners = ['openEditModal' => 'loadTask'];

    /**
     * Carga la tarea en el componente
     */
    public function loadTask($taskId)
    {
        $task = Task::where('user_id', Auth::user()->id)
            ->where('id', $taskId)
            ->first();

        if ( ! $task ) {
            $this->dispatchBrowserEvent('notify', ['message' => 'No se ha podido encontrar la tarjeta.']);
            return;
        }

        $this->task = $task->toArray();
        
        $this->showModal = true;
    }

    /**
     * Actualiza la tarea
     */
    public function save()
    {
        $task = Task::where('user_id', Auth::user()->id)
            ->where('id', $this->task['id'])
            ->first();

        if ( ! $task ) {
            $this->dispatchBrowserEvent('notify', ['message' => 'No se ha podido encontrar la tarjeta.']);
            return;
        }

        $validator = Validator::make($this->task, [
            'title' => 'required|string|min:3|max:254',
            'description' => 'required|string',
            'state' => ['required', Rule::in(['todo', 'doing', 'done'])]
        ]);

        if ( $validator->fails() ) {
            $this->dispatchBrowserEvent('notify', ['message' => $validator->errors()->first()]);
            return;
        }

        $task->title = $this->task['title'];
        $task->description = $this->task['description'];
        $task->state = $this->task['state'];

        $task->save();

        $this->emit('update_task_list');
        $this->showModal = false;
    }

    public function render()
    {
        return view('livewire.edit-task');
    }
}
