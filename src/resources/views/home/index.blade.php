<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('ゲーム一覧') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex flex-wrap">
                @if (isset($games))
                    @foreach ($games as $game)
                        <div class="m-2 p-6 max-w-sm bg-white rounded-lg border border-gray-200 shadow-md">
                            <div class="flex justify-start">
                                <a href="#">
                                    <h5 class="mb-1 text-2xl font-bold tracking-tight text-gray-900">{{ $game->title }}</h5>
                                </a>
                                <span class="m-2 inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-blue-100 bg-blue-700 rounded">{{ config("const.hardware_list.{$game->hardware_type}") }}</span>
                                <span class="m-2 inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-red-100 bg-red-700 rounded">{{ config("const.category_list.{$game->category_id}") }}</span>
                            </div>
                            <hr>
                        </div>
                    @endforeach
                @else
                    <div class="p-6 bg-white border-b border-gray-200">
                        登録されているゲームはありません
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
