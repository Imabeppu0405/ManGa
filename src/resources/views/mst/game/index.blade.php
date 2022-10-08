<x-app-layout>
    <div x-cloak x-data="{  editOpen : @js(old('id', false)), 
                    data : {
                        id: @js(old('id')),  
                        title: @js(old('title')), 
                        category_id: @js(old('category_id')), 
                        hardware_type: @js(old('hardware_type')), 
                        link: @js(old('link')),
                        steam_id: @js(old('steam_id'))
                    }, 
                    deleteOpen : false, 
                    deleteData : {} }" 
        class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @include('mst.game.includes.mstgame-table', [
                'games' => $games
            ])
        </div>
        @include('mst.game.includes.edit-modal')
        @include('mst.game.includes.delete-modal')
    </div>
</x-app-layout>