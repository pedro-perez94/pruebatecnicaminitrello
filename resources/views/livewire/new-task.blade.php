<div class="w-full " x-data="{ open: false }">
    <div class="bg-white shadow-lg rounded-2xl p-4">
      <!-- Header -->
      <div class="flex justify-between items-center cursor-pointer" @click="open = !open">
        <h2 class="text-lg font-semibold text-gray-700">Nueva tarea</h2>
        <!-- Iconos -->
        <svg x-show="!open" xmlns="http://www.w3.org/2000/svg" 
            class="h-6 w-6 text-gray-500 transition-transform duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
        </svg>
        <svg x-show="open" xmlns="http://www.w3.org/2000/svg" 
            class="h-6 w-6 text-gray-500 transition-transform duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7" />
        </svg>
      </div>

      <!-- Contenido -->
      <div x-show="open" class="overflow-hidden mt-3 text-gray-600" x-cloak>
        <form wire:submit.prevent="save" class="space-y-4">
            <!-- Input Título -->
            <div>
            <label for="title" class="block text-sm font-medium text-gray-600 mb-1">Título</label>
            <input type="text" 
                id="title" 
                wire:model.defer="task.title"
                class="w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
            </div>

            <!-- Select Estado -->
            <div>
            <label for="state" class="block text-sm font-medium text-gray-600 mb-1">Estado</label>
            <select id="state" wire:model.defer="task.state"
                class="w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
            >
                <option value="">Seleccione estado</option>
                @foreach ( \App\Enum\StatesEnum::getForOptions() as $key => $state )
                  <option value="{{$key}}">{{ $state }}</option>
                @endforeach
            </select>
            </div>

            <!-- Textarea Descripción -->
            <div>
            <label for="description" class="block text-sm font-medium text-gray-600 mb-1">Descripción</label>
            <textarea id="description" rows="4" wire:model.defer="task.description"
                class="w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"></textarea>
            </div>

            <!-- Botón enviar -->
            <div class="pt-2">
                <x-ui.button.livewire-loading wire:target="save" >Guardar</x-ui.button.liveiwire-loading>
            </div>
        </fprm>
      </div>
    </div>
</div>