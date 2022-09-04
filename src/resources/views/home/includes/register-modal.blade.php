<div x-show="open" id="registerModal" tabindex="-1" aria-hidden="true" class="overflow-y-auto overflow-x-hidden bg-zinc-500/50 fixed top-0 right-0 left-0 z-50 w-full md:inset-0 h-modal md:h-full">
    <div class="relative left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 p-4 w-full max-w-lg h-auto w-auto">
        <!-- Modal content -->
        <div @click.outside="open = false" class="relative bg-white rounded-lg shadow">
            <!-- Modal header -->
            <div class="flex justify-between items-start p-4 rounded-t border-b">
                <h3 class="text-xl font-semibold text-gray-700">
                    登録
                </h3>
                <button x-on:click="open = false" type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-700 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center" data-modal-toggle="registerModal">
                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                </button>
            </div>
            <!-- Modal body -->
            <div class="p-6 space-y-6">
                <form id="registerForm" class="space-y-6" action="report/save" method="POST">
                    @csrf
                    <div>
                        <label for="status_id" class="block mb-2 text-sm font-medium text-gray-700">ステータス</label>
                        <select id="status_id" name="status_id" class="border border-gray-300 text-gray-700 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                            <option hidden>選択してください</option>
                            @foreach(config("const.status_list") as $key => $status_list_item)
                                <option value="{{ $key }}">{{ $status_list_item }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label for="start_at" class="block mb-2 text-sm font-medium text-gray-700">プレイ期間</label>
                        <div class="flex items-center">
                            <div class="relative">
                              <input id="start_at" name="start_at" type="date" class="border border-gray-300 text-gray-700 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5" placeholder="開始日">
                            </div>
                            <span class="mx-4 text-gray-500">to</span>
                            <div class="relative">
                              <input id="end_at" name="end_at" type="date" class="border border-gray-300 text-gray-700 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5" placeholder="完了日">
                            </div>
                        </div>
                    </div>
                    <div>
                        <label for="memo" class="block mb-2 text-sm font-medium text-gray-700">メモ</label>
                        <textarea id="memo" name="memo" rows="4" class="block p-2.5 w-full text-sm text-gray-700 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500" placeholder="メモを入力"></textarea>
                    </div>
                    <input hidden name="game_id" type="number" x-bind:value="id" >
                    <input hidden name="user_id" type="number" value="{{ $user_id }}" >
                    <button id="registerBtn" type="submit" class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">登録</button>
                </form>
            </div>
        </div>
    </div>
</div>