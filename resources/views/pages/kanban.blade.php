<x-app-layout>

    {{-- Título de la página --}}
    <section class="p-4">
        <h1 class="text-3xl font-bold">Gestor de Tareas Interactivo - Prueba Técnica</h1>
    </section>

    <div class="w-full flex justify-center max-w-3xl mx-auto my-4">
        <livewire:new-task />
    </div>

    {{-- Sección principal/Wrapper --}}
    <section class="max-w-3xl mx-auto grid grid-cols-3 gap-3">

        @foreach ( array_keys(\App\Enum\StatesEnum::getForOptions()) as $state )
            <livewire:kanban-column state="{{$state}}" wire:key="column-{{$state}}" />
        @endforeach

    </section>
    
    <livewire:edit-task />

</x-app-layout>
