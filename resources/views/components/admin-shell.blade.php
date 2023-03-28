<x-admin-layout>
    <div x-data="{ open: false }" @keydown.window.escape="open = false">

        <div x-show="open" class="fixed inset-0 flex z-40 md:hidden" x-ref="dialog"
             aria-modal="true">

            <div x-show="open" x-transition:enter="transition-opacity ease-linear duration-300"
                 x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                 x-transition:leave="transition-opacity ease-linear duration-300" x-transition:leave-start="opacity-100"
                 x-transition:leave-end="opacity-0"
                 class="fixed inset-0 bg-gray-600 bg-opacity-75" @click="open = false" aria-hidden="true">
            </div>

            <div x-show="open" x-transition:enter="transition ease-in-out duration-300 transform"
                 x-transition:enter-start="-translate-x-full" x-transition:enter-end="translate-x-0"
                 x-transition:leave="transition ease-in-out duration-300 transform"
                 x-transition:leave-start="translate-x-0" x-transition:leave-end="-translate-x-full"
                 class="relative flex-1 flex flex-col max-w-xs w-full pt-5 pb-4 bg-white">

                <div x-show="open" x-transition:enter="ease-in-out duration-300" x-transition:enter-start="opacity-0"
                     x-transition:enter-end="opacity-100" x-transition:leave="ease-in-out duration-300"
                     x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                     class="absolute top-0 right-0 -mr-12 pt-2">
                    <button type="button"
                            class="ml-1 flex items-center justify-center h-10 w-10 rounded-full focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white"
                            @click="open = false">
                        <span class="sr-only">Close sidebar</span>
                        <x-heroicon-o-x-circle class="h-6 w-6 text-white"/>
                    </button>
                </div>

                <div class="flex-shrink-0 flex items-center px-4">
                    <img class="h-8 w-auto"
                         src="https://tailwindui.com/img/logos/workflow-logo-indigo-600-mark-gray-800-text.svg"
                         alt="Workflow">
                </div>
                <div class="mt-5 flex-1 h-0 overflow-y-auto">
                    <nav class="px-2 space-y-1">

                        <a href="#"
                           class="bg-gray-100 text-gray-900 group flex items-center px-2 py-2 text-base font-medium rounded-md">
                            <x-heroicon-o-home class="text-gray-500 mr-4 flex-shrink-0 h-6 w-6"/>
                            Dashboard
                        </a>

                        <a href="#"
                           class="text-gray-600 hover:bg-gray-50 hover:text-gray-900 group flex items-center px-2 py-2 text-base font-medium rounded-md">
                            <x-heroicon-o-users
                                class="text-gray-400 group-hover:text-gray-500 mr-4 flex-shrink-0 h-6 w-6"/>
                            Students
                        </a>

                        <a href="#"
                           class="text-gray-600 hover:bg-gray-50 hover:text-gray-900 group flex items-center px-2 py-2 text-base font-medium rounded-md">
                            <x-heroicon-o-folder
                                class="text-gray-400 group-hover:text-gray-500 mr-4 flex-shrink-0 h-6 w-6"/>
                            Study Class
                        </a>

                        <a href="#"
                           class="text-gray-600 hover:bg-gray-50 hover:text-gray-900 group flex items-center px-2 py-2 text-base font-medium rounded-md">
                            <x-heroicon-o-calendar
                                class="text-gray-400 group-hover:text-gray-500 mr-4 flex-shrink-0 h-6 w-6"/>
                            Class Registration
                        </a>
                    </nav>
                </div>
            </div>

            <div class="flex-shrink-0 w-14" aria-hidden="true">
                <!-- Dummy element to force sidebar to shrink to fit close icon -->
            </div>
        </div>


        <!-- Static sidebar for desktop -->
        <div class="hidden md:flex md:w-64 md:flex-col md:fixed md:inset-y-0">
            <!-- Sidebar component, swap this element with another sidebar if you like -->
            <div class="flex flex-col flex-grow border-r border-gray-200 pt-5 bg-white overflow-y-auto">
                <div class="flex items-center flex-shrink-0 px-4">
                    <img class="h-8 w-auto"
                         src="https://tailwindui.com/img/logos/workflow-logo-indigo-600-mark-gray-800-text.svg"
                         alt="Workflow">
                </div>
                <div class="mt-5 flex-grow flex flex-col">
                    <nav class="flex-1 px-2 pb-4 space-y-1">
                        <a href="{{route('dashboard')}}"
                            @class([Str::contains(url()->current(),'dashboard') ?
                                'bg-gray-200 text-gray-900'
                                :"text-gray-600 hover:bg-gray-50 hover:text-gray-900",
                                'group flex items-center px-2 py-2 text-sm font-medium rounded-md'
                            ])>
                            <x-heroicon-o-home class="text-gray-400 mr-3 flex-shrink-0 h-6 w-6"/>
                            Dashboard
                        </a>
                        <a href="{{route('students.index')}}"
                            @class([Str::contains(url()->current(),'students') ?
                                 'bg-gray-200 text-gray-900'
                                 :"text-gray-600 hover:bg-gray-50 hover:text-gray-900",
                                 'group flex items-center px-2 py-2 text-sm font-medium rounded-md'
                             ])>
                            <x-heroicon-o-users
                                class="text-gray-400 group-hover:text-gray-500 mr-3 flex-shrink-0 h-6 w-6"/>
                            Students
                        </a>

                        <a href="{{route('study-class.index')}}"
                            @class([Str::contains(url()->current(),'study-class') ?
                                 'bg-gray-200 text-gray-900'
                                 :"text-gray-600 hover:bg-gray-50 hover:text-gray-900",
                                 'group flex items-center px-2 py-2 text-sm font-medium rounded-md'
                             ])>
                            <x-heroicon-o-folder
                                class="text-gray-400 group-hover:text-gray-500 mr-3 flex-shrink-0 h-6 w-6"/>
                            Study Class
                        </a>

                        <a href="{{route('class-registration.index')}}"
                            @class([Str::contains(url()->current(),'class-registration') ?
                                 'bg-gray-200 text-gray-900'
                                 :"text-gray-600 hover:bg-gray-50 hover:text-gray-900",
                                 'group flex items-center px-2 py-2 text-sm font-medium rounded-md'
                             ])>
                            <x-heroicon-o-calendar
                                class="text-gray-400 group-hover:text-gray-500 mr-3 flex-shrink-0 h-6 w-6"/>
                            Class Registration
                        </a>
                    </nav>
                </div>
            </div>
        </div>
        <div class="md:pl-64 flex flex-col flex-1">
            <div class="sticky top-0 z-10 flex-shrink-0 flex h-16 bg-white shadow">
                <button type="button"
                        class="px-4 border-r border-gray-200 text-gray-500 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-indigo-500 md:hidden"
                        @click="open = true">
                    <span class="sr-only">Open sidebar</span>
                    <x-heroicon-o-bars-3 class="h-6 w-6"/>
                </button>
                <div class="flex-1 px-4 flex justify-between">
                    <div class="flex-1 flex">
                        <form class="w-full flex md:ml-0" action="#" method="GET">
                            <label for="search-field" class="sr-only">Search</label>
                            <div class="relative w-full text-gray-400 focus-within:text-gray-600">
                                <div class="absolute inset-y-0 left-0 flex items-center pointer-events-none">
                                    <x-heroicon-o-magnifying-glass class="h-5 w-5"/>
                                </div>
                                <input id="search-field"
                                       class="block w-full h-full pl-8 pr-3 py-2 border-transparent text-gray-900 placeholder-gray-500 focus:outline-none focus:placeholder-gray-400 focus:ring-0 focus:border-transparent sm:text-sm"
                                       placeholder="Search" type="search" name="search">
                            </div>
                        </form>
                    </div>
                    <div class="ml-4 flex items-center md:ml-6">
                        <button type="button"
                                class="bg-white p-1 rounded-full text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            <span class="sr-only">View notifications</span>
                            <x-heroicon-o-bell class="h-6 w-6"/>
                        </button>

                        <!-- Profile dropdown -->
                        <div x-data="menu({ open: false })" x-init="init()"
                             @keydown.escape.stop="open = false; focusButton()" @click.away="onClickAway($event)"
                             class="ml-3 relative">
                            <div>
                                <button type="button"
                                        class="max-w-xs bg-white flex items-center text-sm rounded-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                                        id="user-menu-button" x-ref="button" @click="onButtonClick()"
                                        @keyup.space.prevent="onButtonEnter()" @keydown.enter.prevent="onButtonEnter()"
                                        aria-expanded="false" aria-haspopup="true"
                                        x-bind:aria-expanded="open.toString()" @keydown.arrow-up.prevent="onArrowUp()"
                                        @keydown.arrow-down.prevent="onArrowDown()">
                                    <span class="sr-only">Open user menu</span>
                                    <img class="h-8 w-8 rounded-full"
                                         src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&amp;ixid=eyJhcHBfaWQiOjEyMDd9&amp;auto=format&amp;fit=facearea&amp;facepad=2&amp;w=256&amp;h=256&amp;q=80"
                                         alt="">
                                </button>
                            </div>

                            <div x-show="open" x-cloak x-transition:enter="transition ease-out duration-100"
                                 x-transition:enter-start="transform opacity-0 scale-95"
                                 x-transition:enter-end="transform opacity-100 scale-100"
                                 x-transition:leave="transition ease-in duration-75"
                                 x-transition:leave-start="transform opacity-100 scale-100"
                                 x-transition:leave-end="transform opacity-0 scale-95"
                                 class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5 focus:outline-none"
                                 x-ref="menu-items" x-description="Dropdown menu, show/hide based on menu state."
                                 x-bind:aria-activedescendant="activeDescendant" role="menu" aria-orientation="vertical"
                                 aria-labelledby="user-menu-button" tabindex="-1"
                                 @keydown.arrow-up.prevent="onArrowUp()" @keydown.arrow-down.prevent="onArrowDown()"
                                 @keydown.tab="open = false" @keydown.enter.prevent="open = false; focusButton()"
                                 @keyup.space.prevent="open = false; focusButton()">

                                <a href="#" class="block px-4 py-2 text-sm text-gray-700" x-state:on="Active"
                                   x-state:off="Not Active" :class="{ 'bg-gray-100': activeIndex === 0 }"
                                   role="menuitem" tabindex="-1" id="user-menu-item-0" @mouseenter="activeIndex = 0"
                                   @mouseleave="activeIndex = -1" @click="open = false; focusButton()">Your Profile</a>

                                <a href="#" class="block px-4 py-2 text-sm text-gray-700"
                                   :class="{ 'bg-gray-100': activeIndex === 1 }" role="menuitem" tabindex="-1"
                                   id="user-menu-item-1" @mouseenter="activeIndex = 1" @mouseleave="activeIndex = -1"
                                   @click="open = false; focusButton()">Settings</a>

                                <a href="#" class="block px-4 py-2 text-sm text-gray-700"
                                   :class="{ 'bg-gray-100': activeIndex === 2 }" role="menuitem" tabindex="-1"
                                   id="user-menu-item-2" @mouseenter="activeIndex = 2" @mouseleave="activeIndex = -1"
                                   @click="open = false; focusButton()">Sign out</a>

                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <main class="flex-1">
                <div class="py-8">
                    <div class="max-w-7xl mx-auto px-4 sm:px-6 md:px-8">
                        <!-- Replace with your content -->
                        {{ $slot }}
                        <!-- /End replace -->
                    </div>
                </div>
            </main>
        </div>
    </div>
</x-admin-layout>
