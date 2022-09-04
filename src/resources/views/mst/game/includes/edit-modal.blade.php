<div x-show="updateOrCreateOpen" id="createOrUpdateModal" tabindex="-1" aria-hidden="true" class="overflow-y-auto overflow-x-hidden bg-zinc-500/50 fixed top-0 right-0 left-0 z-50 w-full md:inset-0 h-modal md:h-full">
    <div class="relative left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 p-4 w-full max-w-lg h-auto w-auto">
        <!-- Modal content -->
        <div @click.outside="updateOrCreateOpen = false" class="relative bg-white rounded-lg shadow">
            <!-- Modal header -->
            <div class="flex justify-between items-start p-4 rounded-t border-b">
                <h3 class="text-xl font-semibold text-gray-700">
                    登録
                </h3>
                <button x-on:click="updateOrCreateOpen = false" type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-700 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center" data-modal-toggle="createOrUpdateModal">
                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                </button>
            </div>
            <!-- Modal body -->
            <div class="p-6 space-y-6">
                <form id="createOrUpdateForm" class="space-y-6" action="game/save" method="POST">
                    @csrf
                    <div class="mb-6">
                        <label for="title" class="block mb-2 text-sm font-medium text-gray-700">タイトル</label>
                        <input type="text" name="title" id="title" x-bind:value="data.title" class="bg-gray-50 border border-gray-300 text-gray-700 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5" placeholder="タイトル" required>
                    </div>
                    <div>
                        <label for="hardware_type" class="block mb-2 text-sm font-medium text-gray-700">機種</label>
                        <select id="hardware_type" name="hardware_type" class="border border-gray-300 text-gray-700 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5" required>
                            <option value="" hidden>選択してください</option>
                            @foreach(config("const.hardware_list") as $key => $hardware_list_item)
                                <option value="{{ $key }}" x-bind:selected="data.hardware_type == {{ $key }}">{{ $hardware_list_item }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label for="category_id" class="block mb-2 text-sm font-medium text-gray-700">カテゴリ</label>
                        <select id="category_id" name="category_id" class="border border-gray-300 text-gray-700 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5" required>
                            <option value="" hidden>選択してください</option>
                            @foreach(config("const.category_list") as $key => $category_list_item)
                                <option value="{{ $key }}" x-bind:selected="data.category_id == {{ $key }}">{{ $category_list_item }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label for="link" class="block mb-2 text-sm font-medium text-gray-700">リンク</label>
                        <input type="text" id="link" name="link" x-bind:value="data.link" class="bg-gray-50 border border-gray-300 text-gray-700 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5" placeholder="関連リンクを入力">
                    </div>
                    <input hidden name="id" type="number" x-bind:value="data.id">
                    <button id="createOrUpdateBtn" type="submit" class="w-full text-white bg-indigo-500 hover:bg-indigo-600 focus:ring-4 focus:outline-none focus:ring-indigo-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">登録</button>
                </form>
            </div>
        </div>
    </div>
</div>