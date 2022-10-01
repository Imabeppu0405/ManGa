<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('ゲーム一覧') }}
        </h2>
    </x-slot>

    <div x-data="{ editOpen : @js(boolval(old('game_id'))), id : @js(old('game_id', '')) }" class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(!(old('game_id')))
                <x-error-message />
            @endif
            
            @include('home.includes.search-form', [
                'search_param' => $search_param
            ])

            <div class="flex flex-wrap justify-center">
                @if ($games->isNotEmpty())
                    @foreach ($games as $game)
                        <div class="m-2 pt-6 px-6 max-w-sm bg-white rounded-lg border border-gray-200 shadow-md">
                            <div class="text-center">
                                <a href="{{ $game->link ?? '#' }}" class="cursol-pointer text-gray-800 hover:text-gray-500">
                                    <h5 class="mb-1 text-xl tracking-tight">{{ $game->title }}</h5>
                                </a>
                            </div>
                            <div class="flex justify-center">
                                <span class="m-2 inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-rose-100 bg-rose-500 rounded">{{ config("const.hardware_list.{$game->hardware_type}") }}</span>
                                <span class="m-2 inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-blue-100 bg-blue-500 rounded">{{ config("const.category_list.{$game->category_id}") }}</span>
                            </div>
                            <div class="m-3 flex justify-center items-end">
                                @if (isset($game->status_id))
                                    <div class="px-2 text-gray-500 font-semiboldd" disabled>登録済：{{ config("const.status_list.{$game->status_id}") }}</div>
                                @else
                                    <button x-on:click="editOpen = true; id='{{$game->id}}'" x-on:click="" class="px-2 py-1 text-indigo-500 border border-indigo-500 font-semibold rounded hover:bg-indigo-500 hover:text-white" type="button" data-modal-toggle="registerModal">
                                        登録する
                                    </button>
                                @endif
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="p-6 border-b border-gray-200">
                        登録されているゲームはありません
                    </div>
                @endif
            </div>
        </div>
        @include('home.includes.register-modal');
    </div>
</x-app-layout>
