<?php

namespace App\Http\Livewire;

use App\Enum\StatesEnum;
use App\Models\Task;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class KanbanColumn extends Component
{

    protected $listeners = [
        'update_task_list' => 'updateList'
    ];

    public Collection $tasks;
    public string $state;
    public string $stateName;

    public function mount ( string $state ) {

        $this->state = $state;
        $this->stateName = StatesEnum::getForOptions()[$state];

        $this->getTasks();

    }
    
    /**
     * Actualiza la lista de tareas
     */
    public function updateList () {

        $this->getTasks();

    }

    /**
     * Inserta una tarea existente, según su ID, en la columna.
     */
    public function insertTask ( $taskId ) {
        
        $task = Task::where('user_id', Auth::user()->id)
            ->where('id', $taskId)
            ->first();

        if ( ! $task ) {
            $this->dispatchBrowserEvent('notify', ['message' => 'No se ha podido mover la tarjeta.']);
            return;
        }

        // Si la tarjeta existe (y es del usuario que ha iniciado sesión) la añadimos
        // al estado de esta columna
        $task->state = $this->state;
        $task->save();

        // Lanzamos el evento para que las otras columnas se actualicen
        $this->emit('update_task_list');
        
    }

    /**
     * Obtiene las tareas de este usuario para el estado de esta columna
     */
    private function getTasks () {

        $this->tasks = Task::where('user_id', Auth::user()->id)
            ->where('state', $this->state)
            ->get();

    }

    public function render()
    {
        return view('livewire.kanban-column');
    }
}
