<div class="pb-3">
    <form action="home" method="get">
        <div class="flex justify-center">
            <div class="mx-2">
                <label for="title" class="block mb-2 text-sm font-medium text-gray-700">タイトル</label>
                <input type="text" name="title" id="title" value="{{ $search_param['title'] }}" class="bg-gray-100 border border-gray-300 text-gray-700 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5" placeholder="タイトル">
            </div>
            <div class="mx-2">
                <label for="hardware_type" class="block mb-2 text-sm font-medium text-gray-700 w-40">機種</label>
                <select id="hardware_type" name="hardware_type" class="bg-gray-100 border border-gray-300 text-gray-700 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5">
                    <option value="">-</option>
                    @foreach(config("const.hardware_list") as $key => $hardware_list_item)
                        <option value="{{ $key }}" {{ $search_param['hardware_type'] == $key ? 'selected' : '' }}>{{ $hardware_list_item }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mx-2">
                <label for="category_id" class="block mb-2 text-sm font-medium text-gray-700 w-40">カテゴリ</label>
                <select id="category_id" name="category_id" class="bg-gray-100 border border-gray-300 text-gray-700 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5">
                    <option value="">-</option>
                    @foreach(config("const.category_list") as $key => $category_list_item)
                        <option value="{{ $key }}" {{ $search_param['category_id'] == $key ? 'selected' : '' }}>{{ $category_list_item }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="text-center p-5">
            <button id="searchBtn" type="submit" class="w-80 text-white bg-indigo-500 hover:bg-indigo-600 focus:ring-4 focus:outline-none focus:ring-indigo-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">検索</button>
        </div>
    </form>
</div>