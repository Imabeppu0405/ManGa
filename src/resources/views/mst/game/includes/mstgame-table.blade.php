<div class="m-2 p-6 w-full bg-white rounded-lg border border-gray-200 shadow-md">
    <div class="flex justify-between pb-6 px-4">
        <h1 class="text-xl font-bold">
            登録ゲーム一覧
        </h1>
        <button 
            x-on:click="
            updateOrCreateOpen = true; 
            data = {}" 
            class="font-medium bg-indigo-500 hover:bg-indigo-600 text-white rounded px-4 py-2 w-52"
            type="button" 
            data-modal-toggle="createOrUpdateModal">
            ゲーム登録
        </button>
    </div>
    @if ($games->isNotEmpty())
        <table class="w-full">
            <thead>
                <tr>
                <th class="px-2 py-2 w-12">ID</th>
                <th class="px-4 py-2 w-1/4">タイトル</th>
                <th class="px-4 py-2">リンク</th>
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
                        <td class="border px-4 py-2">
                            <a href="{{ $game->link ?? '#' }}" class="cursol-pointer text-blue-700 hover:text-blue-500">
                                {{ $game->link ?? '-' }}
                            </a>
                        </td>
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
                                        link: '{{$game->link}}'}" 
                                class="font-medium border border-emerald-500 text-emerald-500 hover:bg-emerald-500 hover:text-white rounded px-4 py-2"
                                type="button" 
                                data-modal-toggle="createOrUpdateModal"
                            >編集</button>
                            <button 
                                x-on:click="
                                    deleteOpen = true; 
                                    deleteData= { 
                                        id: '{{$game->id}}', 
                                        title: '{{$game->title}}'}" 
                                class="font-medium border border-rose-500 text-rose-500 hover:bg-red-500 hover:text-white rounded px-4 py-2"
                                type="button"
                                data-modal-toggle="deleteModal"
                            >削除</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <div class="p-6 text-gray-700">
            登録されている記録はありません
        </div>
    @endif
</div>