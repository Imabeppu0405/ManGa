<x-delete-modal :deleteItem="__('ゲーム記録')" :action="__('report/delete')">
    <div class="flex justify-center pb-5">
        <p class="text-gray-500">タイトル: <strong x-text="deleteData.title"></strong></p>
    </div>
</x-delete-modal>