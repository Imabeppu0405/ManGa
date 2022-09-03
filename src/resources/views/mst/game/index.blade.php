<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('ゲーム管理') }}
        </h2>
    </x-slot>
    <div x-data="{ open : false, id : '' }" class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="m-2 p-6 w-full bg-white rounded-lg border border-gray-200 shadow-md">
                <div class="flex justify-between pb-6 px-4">
                    <h1 class="text-xl font-bold">
                        登録ゲーム一覧
                    </h1>
                    <button class="bg-blue-600 hover:bg-blue-500 text-white rounded px-4 py-2 w-52">
                        ゲーム追加
                    </button>
                </div>
                <table class="w-full">
                    <thead>
                        <tr>
                          <th class="px-4 py-2 w-1/4">タイトル</th>
                          <th class="px-4 py-2">メモ</th>
                          <th class="px-4 py-2 w-28">機種</th>
                          <th class="px-4 py-2 w-32">カテゴリ</th>
                          <th class="px-4 py-2 w-44">編集</th>
                        </tr>
                      </thead>
                    <tbody>
                        @foreach($games as $game)
                            <tr>
                                <td class="border px-4 py-2">{{ $game->title }}</td>
                                <td class="border px-4 py-2">{{ $game->memo ?? '-' }}</td>
                                <td class="border px-4 py-2">{{ config("const.hardware_list.{$game->hardware_type}") }}</td>
                                <td class="border px-4 py-2">{{ config("const.category_list.{$game->category_id}") }}</td>
                                <td class="border px-4 py-2">
                                    <button class="bg-green-600 hover:bg-green-500 text-white rounded px-4 py-2">編集</button>
                                    <button class="bg-red-600 hover:bg-red-500 text-white rounded px-4 py-2">削除</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>