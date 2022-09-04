<x-app-layout>
    <div class="py-12">
        <div class="flex flex-col items-center">
            <div class="max-w-xl flex flex-col items-center text-center pt-8 lg:pt-32 pb-16 lg:pb-48">
                <div class="bg-white rounded-full w-96 h-96">
                    <p class="text-indigo-500 md:text-lg xl:text-xl font-semibold mb-4 md:mb-6">Let's manage your Game</p>
            
                    <div class="w-56 mx-auto">
                        <img class="w-100" src="{{ asset('img/hero.png') }}">
                    </div>
    
                    <div class="w-full flex flex-col sm:flex-row sm:justify-center gap-2.5">
                      <a href="{{ route('register') }}" class="inline-block bg-indigo-500 hover:bg-indigo-600 active:bg-indigo-700 focus-visible:ring ring-indigo-300 text-white text-sm font-semibold text-center rounded-lg outline-none transition duration-100 px-8 py-3">Register</a>
                      <a href="{{ route('register') }}" class="inline-block bg-indigo-200 hover:bg-indigo-300 focus-visible:ring ring-indigo-300 text-indigo-500 active:text-indigo-700 text-sm font-semibold text-center rounded-lg outline-none transition duration-100 px-8 py-3">Login</a>
                    </div>
                </div>

                <p class="pt-6 text-gray-600 text-lg">ManGaはステータスごとにあなたのゲームを管理するWebアプリケーションです。</p>
              </div>
        </div>
    </div>
</x-app-layout>
