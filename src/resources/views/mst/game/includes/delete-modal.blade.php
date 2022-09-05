<x-delete-modal :deleteItem="__('ゲーム')">
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
        <button x-on:click="deleteOpen = false" data-modal-toggle="deleteModal" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-700 focus:z-10">キャンセル</button>
    </form>
</x-delete-modal>