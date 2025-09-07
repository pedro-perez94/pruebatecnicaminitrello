<div 
    x-data="{ show: false, message: '' }"
    x-init="
        window.addEventListener('notify', e => {
            message = e.detail.message;
            show = true;
            setTimeout(() => show = false, 6000);
        });
    "
    class="fixed top-5 right-5 z-50"
>
    <div 
        x-show="show"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 translate-y-2"
        x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100 translate-y-0"
        x-transition:leave-end="opacity-0 translate-y-2"
        class="bg-white shadow-lg rounded-2xl px-4 py-3 w-64 border border-gray-200"
    >
        <p class="text-gray-700 text-sm font-medium" x-text="message"></p>
    </div>
</div>