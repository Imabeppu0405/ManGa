<x-edit-modal :label="__('ゲーム記録更登録')">
    <form id="registerForm" class="space-y-6" action="report/save" method="POST">
        @csrf
        <div>
            <label for="status_id" class="block mb-2 text-sm font-medium text-gray-700">ステータス</label>
            <select id="status_id" name="status_id" class="border border-gray-300 text-gray-700 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                <option value="" hidden>選択してください</option>
                @foreach(config("const.status_list") as $key => $status_list_item)
                    <option value="{{ $key }}" x-bind:selected="{{ old('status_id') ?? 0 }} === {{ $key }}">{{ $status_list_item }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label for="start_at" class="block mb-2 text-sm font-medium text-gray-700">プレイ期間</label>
            <div class="flex items-center">
                <div class="relative">
                  <input id="start_at" name="start_at" type="date" value="{{ old('start_at') }}" class="border border-gray-300 text-gray-700 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5" placeholder="開始日">
                </div>
                <span class="mx-4 text-gray-500">to</span>
                <div class="relative">
                  <input id="end_at" name="end_at" type="date" value="{{ old('end_at') }}" class="border border-gray-300 text-gray-700 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5" placeholder="完了日">
                </div>
            </div>
        </div>
        <div>
            <label for="memo" class="block mb-2 text-sm font-medium text-gray-700">メモ</label>
            <textarea id="memo" name="memo" rows="4" class="block p-2.5 w-full text-sm text-gray-700 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500" placeholder="メモを入力">{{ old('memo') }}</textarea>
        </div>
        <input hidden name="game_id" type="number" x-bind:value="id" >
        <button id="registerBtn" type="submit" class="w-full text-white bg-indigo-500 hover:bg-indigo-600 focus:ring-4 focus:outline-none focus:ring-indigo-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">登録</button>
    </form>
</x-edit-modal>