<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('アカウント') }}
        </h2>
    </x-slot>
    <div x-data="{ editOpen : false, deleteOpen: false, data : {}, deleteData: {}, activeTab: 1 }" class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-error-message />
            <div class="">
                {{-- アカウント画像 --}}
                <div class="bg-gray-200 rounded-full w-28 h-28 mx-auto">
                    <svg version="1.1" y="-250" x="-250" viewBox="-250 -250 500 500" height="112px" width="112px" style="overflow:visible">
                        <g transform="rotate(0,0,0)" stroke-linejoin="round" fill="#fff"><path stroke-linecap="butt" stroke-linejoin="round" stroke-width="0" stroke-opacity="0" stroke="rgb(0,0,0)" fill="rgb(103,119,136)" d="m70.386659-69.482701a70.386664 70.288536 0 0 1-70.38666 70.28853a70.386664 70.288536 0 0 1-70.386675-70.288531a70.386664 70.288536 0 0 1 70.386675-70.288545a70.386664 70.288536 0 0 1 70.386659 70.288545z" />
                            <path stroke-linecap="butt" stroke-linejoin="round" stroke-width="0" stroke-opacity="0" stroke="rgb(0,0,0)" fill="rgb(103,119,136)" d="m55.57617 13.92945a100.394434 100.256988 0 0 1-55.576171 16.845705a100.394434 100.256988 0 0 1-55.59375-16.84278c-36.63765 7.141304-64.122075 39.1401-64.122075 77.78028v48.058589h239.43165v-48.05859c0-38.646315-27.493275-70.648666-64.139656-77.783205z" />
                        </g>
                    </svg>
                </div>
                <div class="p-2">
                    <div class="text-indigo-500 md:text-lg font-bold text-center">{{ Auth::user()->name }}</div>
                    <div class="text-gray-400 md:text-lg font-bold text-center">{{ Auth::user()->email }}</div>
                </div>
            </div>
            <div>
                <div>
                    <ul class="flex justify-center items-center my-4">
                        @foreach(config("const.status_list") as $key => $status_list_item)
                            <li class="cursor-pointer py-2 px-8 text-gray-500 border-b-8"
                                :class="activeTab == {{ $key }} ? 'text-indigo-500 border-indigo-500' : ''" x-on:click="activeTab = {{ $key }}"
                                >{{ $status_list_item }}</li>
                        @endforeach
                    </ul>
                </div>
                <div x-show="activeTab===1">
                    @include('account.includes.report-index', [
                        'reports'     => $favorite_reports,
                        'is_favorite' => true,
                    ])
                </div>
                <div x-show="activeTab===2">
                    @include('account.includes.report-index', [
                        'reports'  => $stack_reports,
                        'is_stack' => true,
                    ])
                </div>
                <div x-show="activeTab===3">
                    @include('account.includes.report-index', [
                        'reports'  => $clear_reports,
                        'is_clear' => true,
                    ])
                </div>
            </div>
        </div>
        @include('account.includes.edit-modal');
        @include('account.includes.delete-modal');
    </div>
</x-app-layout>