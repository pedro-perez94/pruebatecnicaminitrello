<button {{ $attributes->merge(['class' => 'w-full bg-indigo-600 text-white font-medium py-2 px-4 rounded-lg shadow hover:bg-indigo-700 transition']) }}
    wire:loading.attr="disabled"
    wire:loading.class="opacity-75"
>
    {{ $slot }}
    <span class="flex align-middle" wire:loading>
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-loader-circle-icon lucide-loader-circle animate-spin"><path d="M21 12a9 9 0 1 1-6.219-8.56"/></svg>
    </span>
</button>