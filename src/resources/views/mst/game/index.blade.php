<x-app-layout>
    <div x-data="{ editOpen : false, data : {}, deleteOpen : false, deleteData : {} }" class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-error-message />
            @include('mst.game.includes.mstgame-table', [
                'games' => $games
            ])
        </div>
        @include('mst.game.includes.edit-modal')
        @include('mst.game.includes.delete-modal')
    </div>
</x-app-layout>