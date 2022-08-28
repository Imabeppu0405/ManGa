<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex flex-wrap">
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
                            <div class="m-3 flex justify-center">
                                <button class="px-2 py-1 text-green-500 border border-green-500 font-semibold rounded hover:bg-green-500 hover:text-white" type="button" data-modal-toggle="registerModal">
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
        </div>
    </div>
</x-app-layout>