<x-app-layout>
    <div x-data="{ updateOrCreateOpen : false, data : {}, deleteOpen : false, deleteData : {} }" class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if ($errors->any())
                <div class="bg-red-100 border-l-4 border-red-500 text-red-800 p-4 text-lg" role="alert">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @include('mst.game.includes.mstgame-table', [
                'games' => $games
            ])
        </div>
        @include('mst.game.includes.edit-modal')
        @include('mst.game.includes.delete-modal')
    </div>
</x-app-layout>