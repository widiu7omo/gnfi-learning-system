<x-public-layout>
    <div class="h-screen flex flex-col bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500">
        <div class="px-4 py-4 bg-white backdrop-blur-lg shadow-lg ">
            <div class="max-w-7xl flex flex-row items-center mx-auto w-full ">
                <div class="ml-4 flex lg:ml-0 ">
                    <a href="#">
                        <span class="sr-only">Workflow</span>
                        <img class="h-8 w-auto"
                             src="https://tailwindui.com/img/logos/workflow-mark.svg?color=indigo&shade=600" alt="">
                    </a>
                </div>
                <div class="ml-auto flex items-center">
                    @if (Route::has('login'))
                        <div class="sm:fixed sm:top-0 sm:right-0 p-6 text-right">
                            @auth
                                <a href="{{ url('/dashboard') }}"
                                   class="font-medium text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Go
                                    to your dashboard</a>
                            @else
                                <div class="hidden lg:flex lg:flex-1 lg:items-center lg:justify-end lg:space-x-6">
                                    <a href="{{route('login')}}"
                                       class="text-sm font-medium text-gray-700 hover:text-gray-800">Sign
                                        in</a>
                                    <span class="h-6 w-px bg-gray-200" aria-hidden="true"></span>
                                    @if (Route::has('register'))
                                        <a href="{{route('register')}}"
                                           class="text-sm font-medium text-gray-700 hover:text-gray-800">Create
                                            account</a>
                                    @endif
                                </div>
                            @endauth
                        </div>
                    @endif
                </div>
            </div>
        </div>
        <div
            class="flex-1 flex items-center justify-center ">
            <div class="flex flex-col space-y-4 justify-center items-center">
                <h1 class="text-5xl text-white ">Do you want to learn programming?</h1>
                <small class="text-white w-[600px] text-center">Get ready to learn any programming language in a
                    different way. Make sure you signup to join with
                    us. Get ready to it. </small>
                <a href="{{route('discover-class.index')}}"
                   class="w-fit rounded-lg text-center bg-indigo-600 text-white px-4 py-2 shadow border border-indigo-200 hover:border-indigo-400">Explore</a>
            </div>
        </div>
    </div>
</x-public-layout>
