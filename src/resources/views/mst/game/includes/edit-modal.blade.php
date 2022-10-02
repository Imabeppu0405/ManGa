<x-edit-modal :label="__('ゲーム登録')">
    <form id="createOrUpdateForm" class="space-y-6" action="game/save" method="POST">
        @csrf
        <div class="mb-6">
            <label for="title" class="block mb-2 text-sm font-medium text-gray-700">
                タイトル
                <x-required-badge />
            </label>
            <input type="text" name="title" id="title" x-bind:value="data.title" class="bg-gray-50 border border-gray-300 text-gray-700 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5" placeholder="タイトル">
        </div>
        <div>
            <label for="hardware_type" class="block mb-2 text-sm font-medium text-gray-700">
                機種
                <x-required-badge />
            </label>
            <select id="hardware_type" name="hardware_type" class="border border-gray-300 text-gray-700 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5" required>
                <option value="" hidden>選択してください</option>
                @foreach(config("const.hardware_list") as $key => $hardware_list_item)
                    <option value="{{ $key }}" x-bind:selected="data.hardware_type == {{ $key }}">{{ $hardware_list_item }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label for="category_id" class="block mb-2 text-sm font-medium text-gray-700">
                カテゴリ
                <x-required-badge />
            </label>
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
</x-edit-modal>