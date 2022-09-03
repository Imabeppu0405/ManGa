<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Account') }}
        </h2>
    </x-slot>
    <div x-data="{ open : false, data : {} }" class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex flex-wrap justify-center">
                @if (isset($reports))
                    @foreach ($reports as $report)
                        <div class="m-2 p-6 max-w-sm bg-white rounded-lg border border-gray-200 shadow-md">
                            <div class="flex justify-start">
                                <a href="#">
                                    <h5 class="mb-1 text-2xl font-bold tracking-tight text-gray-900">{{ $report->title }}</h5>
                                </a>
                                <span class="m-2 inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-blue-100 bg-blue-700 rounded">{{ config("const.hardware_list.{$report->hardware_type}") }}</span>
                                <span class="m-2 inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-red-100 bg-red-700 rounded">{{ config("const.category_list.{$report->category_id}") }}</span>
                            </div>
                            <hr>
                            <div>
                                <div class="flex justify-center">
                                    <h6 class="mt-3 text-2xl font-bold tracking-tight text-gray-500">{{ config("const.status_list.{$report->status_id}") }}</h6>
                                    
                                </div>
                                <div class="flex justify-center mb-3">
                                    <span>{{ $report->start_at }}</span>
                                    ~
                                    <span>{{ $report->end_at }}</span>
                                </div>
                                <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">
                                    @if(isset($report->memo))
                                        {{ $report->memo }}
                                    @else
                                        メモ未登録
                                    @endif
                                </p>
                            </div>
                            <div class="m-3 flex justify-center">
                                <button 
                                    x-on:click="
                                        open = true; 
                                        data={  id: '{{$report->id}}', 
                                                game_id: '{{ $report->game_id }}', 
                                                status_id: '{{$report->status_id}}', 
                                                start_at: '{{$report->start_at}}', 
                                                end_at: '{{$report->end_at}}', 
                                                memo: '{{$report->memo}}'}" 
                                    class="px-2 py-1 text-green-500 border border-green-500 font-semibold rounded hover:bg-green-500 hover:text-white"
                                    type="button" 
                                    data-modal-toggle="editModal"
                                >
                                    変更する
                                </button>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="p-6 bg-white border-b border-gray-200">
                        登録されている記録はありません
                    </div>
                @endif
            </div>
            <div x-show="open" id="registerModal" tabindex="-1" aria-hidden="true" class="overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 w-full md:inset-0 h-modal md:h-full">
                <div class="relative p-4 w-full max-w-lg h-auto w-auto">
                    <!-- Modal content -->
                    <div @click.outside="open = false" class="relative bg-white rounded-lg shadow">
                        <!-- Modal header -->
                        <div class="flex justify-between items-start p-4 rounded-t border-b">
                            <h3 class="text-xl font-semibold text-gray-900">
                                登録
                            </h3>
                            <button @click="open = false" type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center" data-modal-toggle="editModal">
                                <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                            </button>
                        </div>
                        <!-- Modal body -->
                        <div class="p-6 space-y-6">
                            <form id="editForm" class="space-y-6" action="report/save" method="POST">
                                @csrf
                                <div>
                                    <label for="status_id" class="block mb-2 text-sm font-medium text-gray-900">ステータス</label>
                                    <select id="status_id" name="status_id" class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                        <option hidden>選択してください</option>
                                        @foreach(config("const.status_list") as $key => $status_list_item)
                                            <option value="{{ $key }}" x-bind:selected="data.status_id == {{ $key }}">{{ $status_list_item }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div>
                                    <label for="start_at" class="block mb-2 text-sm font-medium text-gray-900">プレイ期間</label>
                                    <div class="flex items-center">
                                        <div class="relative">
                                            <input id="start_at" name="start_at" x-bind:value='data.start_at' type="date" class="border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5" placeholder="開始日">
                                        </div>
                                        <span class="mx-4 text-gray-500">to</span>
                                        <div class="relative">
                                            <input id="end_at" name="end_at" x-bind:value='data.end_at' type="date" class="border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5" placeholder="完了日">
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <label for="memo" class="block mb-2 text-sm font-medium text-gray-900">メモ</label>
                                    <textarea id="memo" x-bind:value='data.memo' name="memo" rows="4" class="block p-2.5 w-full text-sm text-gray-900 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500" placeholder="メモを入力"></textarea>
                                </div>
                                <input hidden name="report_id" type="number" x-bind:value="data.id" >
                                <input hidden name="game_id" type="number" x-bind:value="data.game_id" >
                                <input hidden name="user_id" type="number" value="{{ $user_id }}" >
                                <button id="editBtn" type="submit" class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">登録</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>