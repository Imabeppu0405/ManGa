<x-app-layout scripts="$script">
    @push('scripts')
        @vite(['resources/js/api/steamApi.js'])
    @endpush
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('ゲーム詳細') }}
        </h2>
    </x-slot>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <div x-cloak x-data="{ editOpen : @js(boolval(old('game_id'))), id : @js(old('game_id', '')) }" class="py-12">
        <div class="m-2 p-6 w-5/6 bg-white rounded-lg border border-gray-200 shadow-md mx-auto">
            <div class="text-center flex justify-center">
                <a href="{{ $game->link ?? '#' }}" class="cursol-pointer text-gray-800 hover:text-gray-500">
                    <h1 class="mb-1 text-5xl tracking-tight">{{ $game->title }}</h1>
                </a>
                <div class="flex justify-center">
                    <span class="m-2 inline-flex min-w-24 items-center justify-center px-2 py-1 text-xl font-bold leading-none text-rose-100 bg-rose-500 rounded">{{ config("const.hardware_list.{$game->hardware_type}") }}</span>
                    <span class="m-2 inline-flex min-w-24 items-center justify-center px-2 py-1 text-xl font-bold leading-none text-blue-100 bg-blue-500 rounded">{{ config("const.category_list.{$game->category_id}") }}</span>
                </div>
            </div>
            <div class="m-3 flex justify-center items-end">
                <div class="mx-2 px-2">
                    <span>現在の記録登録数：</span>
                    <span class="text-4xl font-bold">{{ count($reports) }}</span>
                </div>
                @if ($isReported)
                    <button class="bg-white text-gray-500 font-semibold py-2 px-4 border border-gray-400 rounded shadow">
                        登録済
                    </button>
                @else
                    <button x-on:click="editOpen = true; id='{{$game->id}}'" x-on:click="" class="px-2 py-1 text-indigo-500 border border-indigo-500 font-semibold rounded hover:bg-indigo-500 hover:text-white" type="button" data-modal-toggle="registerModal">
                        記録を登録する
                    </button>
                @endif
            </div>
            <div class="pt-10">
                <div class="border-b-4 border-indigo-500 mx-auto w-64 mb-5">
                    <h2 class="mb-1 text-3xl tracking-tight text-center">News</h2>
                </div>
                <div id="newsCont" class="flex flex-wrap justify-center">
                </div>
            </div>
            <div class="pt-10">
                <div class="border-b-4 border-indigo-500 mx-auto w-64 mb-5">
                    <h2 class="mb-1 text-3xl tracking-tight text-center ">みんなの記録</h2>
                </div>
                <div class="flex flex-wrap justify-center">
                    @if ($reports->isNotEmpty())
                        @foreach ($reports as $report)
                            <div class="m-2 pt-6 px-6 max-w-sm bg-white rounded-lg border border-gray-200 shadow-md w-60 h-60">
                                <div class="flex justify-center items-center border-b border-gray-300">
                                    <h5 class="mb-1 text-xl tracking-tight mr-2 font-bold">{{ $report->name }}</h5>
                                    <p>{{ config("const.status_list.{$report->status_id}") }}</p>
                                </div>
                                <p class="pt-2 p-1 break-words">
                                    {{ Str::limit($report->memo, 100, '...') ?? 'メモ未登録' }}
                                </p>
                            </div>
                        @endforeach
                    @else
                        <div class="p-6 text-xl h-40">
                            登録されている記録はありません
                        </div>
                    @endif
                </div>
            </div>
            <input id="steamId" type="hidden" name="steam_id" value={{ $game->steam_id }}>
        </div>
        
        @include('includes.register-modal');
    </div>
</x-app-layout>