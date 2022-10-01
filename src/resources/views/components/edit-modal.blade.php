<div x-show="editOpen" id="editModal" tabindex="-1" aria-hidden="true" class="overflow-y-auto overflow-x-hidden bg-zinc-500/50 fixed top-0 right-0 left-0 z-50 w-full md:inset-0 h-modal md:h-full">
    <div class="relative left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 p-4 w-full max-w-lg h-auto w-auto">
        <!-- Modal content -->
        <div @click.outside="editOpen = false" class="relative bg-white rounded-lg shadow">
            <!-- Modal header -->
            <div class="flex justify-between items-start p-4 rounded-t border-b">
                <h3 class="text-xl font-semibold text-gray-700">
                    {{ $label }}
                </h3>
                <button x-on:click="editOpen = false" type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-700 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center" data-modal-toggle="editModal">
                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                </button>
            </div>
            <x-error-message />
            <!-- Modal body -->
            <div class="p-6 space-y-6">
                {{ $slot }}
            </div>
        </div>
    </div>
</div>