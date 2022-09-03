<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('ゲーム管理') }}
        </h2>
    </x-slot>
    <div x-data="{ updateOrCreateOpen : false, data : {}, deleteOpen : false, deleteData : {} }" class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="m-2 p-6 w-full bg-white rounded-lg border border-gray-200 shadow-md">
                <div class="flex justify-between pb-6 px-4">
                    <h1 class="text-xl font-bold">
                        登録ゲーム一覧
                    </h1>
                    <button 
                        x-on:click="
                        updateOrCreateOpen = true; 
                        data = {}" 
                        class="bg-blue-600 hover:bg-blue-500 text-white rounded px-4 py-2 w-52"
                        type="button" 
                        data-modal-toggle="createOrUpdateModal">
                        ゲーム登録
                    </button>
                </div>
                <table class="w-full">
                    <thead>
                        <tr>
                          <th class="px-2 py-2 w-12">ID</th>
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
                                <td class="border px-4 py-2">{{ $game->id }}</td>
                                <td class="border px-4 py-2">{{ $game->title }}</td>
                                <td class="border px-4 py-2">{{ $game->memo ?? '-' }}</td>
                                <td class="border px-4 py-2">{{ config("const.hardware_list.{$game->hardware_type}") }}</td>
                                <td class="border px-4 py-2">{{ config("const.category_list.{$game->category_id}") }}</td>
                                <td class="border px-4 py-2">
                                    <button
                                        x-on:click="
                                            updateOrCreateOpen = true; 
                                            data= { 
                                                id: '{{$game->id}}', 
                                                title: '{{$game->title}}', 
                                                category_id: '{{$game->category_id}}', 
                                                hardware_type: '{{$game->hardware_type}}', 
                                                memo: '{{$game->memo}}'}" 
                                        class="bg-green-600 hover:bg-green-500 text-white rounded px-4 py-2"
                                        type="button" 
                                        data-modal-toggle="createOrUpdateModal"
                                    >編集</button>
                                    <button 
                                        x-on:click="
                                            deleteOpen = true; 
                                            deleteData= { 
                                                id: '{{$game->id}}', 
                                                title: '{{$game->title}}'}" 
                                        class="bg-red-600 hover:bg-red-500 text-white rounded px-4 py-2"
                                        type="button"
                                        data-modal-toggle="deleteModal"
                                    >削除</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div x-show="updateOrCreateOpen" id="createOrUpdateModal" tabindex="-1" aria-hidden="true" class="overflow-y-auto overflow-x-hidden bg-zinc-500/50 fixed top-0 right-0 left-0 z-50 w-full md:inset-0 h-modal md:h-full">
            <div class="relative left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 p-4 w-full max-w-lg h-auto w-auto">
                <!-- Modal content -->
                <div @click.outside="updateOrCreateOpen = false" class="relative bg-white rounded-lg shadow">
                    <!-- Modal header -->
                    <div class="flex justify-between items-start p-4 rounded-t border-b">
                        <h3 class="text-xl font-semibold text-gray-900">
                            登録
                        </h3>
                        <button x-on:click="updateOrCreateOpen = false" type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center" data-modal-toggle="createOrUpdateModal">
                            <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                        </button>
                    </div>
                    <!-- Modal body -->
                    <div class="p-6 space-y-6">
                        <form id="createOrUpdateForm" class="space-y-6" action="game/save" method="POST">
                            @csrf
                            <div class="mb-6">
                                <label for="title" class="block mb-2 text-sm font-medium text-gray-900">タイトル</label>
                                <input type="text" name="title" id="title" x-bind:value="data.title" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="タイトル" required>
                            </div>
                            <div>
                                <label for="hardware_type" class="block mb-2 text-sm font-medium text-gray-900">機種</label>
                                <select id="hardware_type" name="hardware_type" class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
                                    <option hidden>選択してください</option>
                                    @foreach(config("const.hardware_list") as $key => $hardware_list_item)
                                        <option value="{{ $key }}" x-bind:selected="data.hardware_type == {{ $key }}">{{ $hardware_list_item }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label for="category_id" class="block mb-2 text-sm font-medium text-gray-900">カテゴリ</label>
                                <select id="category_id" name="category_id" class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
                                    <option hidden>選択してください</option>
                                    @foreach(config("const.category_list") as $key => $category_list_item)
                                        <option value="{{ $key }}" x-bind:selected="data.category_id == {{ $key }}">{{ $category_list_item }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label for="memo" class="block mb-2 text-sm font-medium text-gray-900">メモ</label>
                                <textarea id="memo" name="memo" x-bind:value="data.memo" rows="4" class="block p-2.5 w-full text-sm text-gray-900 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500" placeholder="メモを入力"></textarea>
                            </div>
                            <input hidden name="id" type="number" x-bind:value="data.id">
                            <button id="createOrUpdateBtn" type="submit" class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">登録</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div x-show="deleteOpen" id="deleteModal" tabindex="-1" class="overflow-y-auto overflow-x-hidden bg-zinc-500/50 fixed top-0 right-0 left-0 z-50 md:inset-0 h-modal md:h-full">
            <div class="relative left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 p-4 w-full max-w-md h-full md:h-auto">
                <div @click.outside="deleteOpen = false" class="relative bg-white rounded-lg shadow">
                    <button x-on:click="deleteOpen = false" type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center" data-modal-toggle="deleteModal">
                        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                    <div class="p-6 text-center">
                        <svg aria-hidden="true" class="mx-auto mb-4 w-14 h-14 text-gray-400 dark:text-gray-200" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">下記のゲームを削除してもよいですか？</h3>
                        <div class="flex justify-center pb-5">
                            <p class="mr-3 text-gray-500">ID: <strong x-text="deleteData.id"></strong></p>
                            <p class="text-gray-500">タイトル: <strong x-text="deleteData.title"></strong></p>
                        </div>
                        <form id="createOrUpdateForm" class="space-y-6" action="game/delete" method="POST">
                            @csrf
                            <input hidden name="id" type="number" x-bind:value="deleteData.id">
                            <button data-modal-toggle="deleteModal" type="submit" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">
                                削除する
                            </button>
                            <button x-on:click="deleteOpen = false" data-modal-toggle="deleteModal" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10">キャンセル</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>