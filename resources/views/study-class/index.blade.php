<x-admin-shell>
    <div class="px-4 sm:px-6 lg:px-8">
        <div class="sm:flex sm:items-center">
            <div class="sm:flex-auto">
                <h1 class="text-xl font-semibold text-gray-900">Study Class</h1>
                <p class="mt-2 text-sm text-gray-700">A list of all classes available for students</p>
            </div>
            <div class="mt-4 sm:mt-0 sm:ml-16 sm:flex-none">
                <a href="{{route('study-class.create')}}"
                   class="inline-flex items-center justify-center rounded-md border border-transparent bg-indigo-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 sm:w-auto">
                    Add class
                </a>
            </div>
        </div>
        <x-session-alert/>
        <div class="-mx-4 mt-8 overflow-hidden shadow ring-1 ring-black ring-opacity-5 sm:-mx-6 md:mx-0 md:rounded-lg">
            <table class="min-w-full divide-y divide-gray-300">
                <thead class="bg-gray-50">
                <tr>
                    <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">
                        Class Name
                    </th>
                    <th scope="col"
                        class="hidden px-3 py-3.5 text-left text-sm font-semibold text-gray-900 sm:table-cell">
                        Description
                    </th>
                    <th scope="col"
                        class="hidden px-3 py-3.5 text-left text-sm font-semibold text-gray-900 sm:table-cell">
                        Total Students
                    </th>
                    <th scope="col"
                        class="hidden px-3 py-3.5 text-left text-sm font-semibold text-gray-900 sm:table-cell">
                        Status
                    </th>
                    <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6">
                        <span class="sr-only">Edit</span>
                    </th>
                </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 bg-white">
                @forelse($studyClasses as $studyClass)
                    <tr>
                        <td class="w-full max-w-0 py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:w-auto sm:max-w-none sm:pl-6">
                            {{$studyClass->name}}
                            <dl class="font-normal lg:hidden">
                                <dt class="sr-only">{{$studyClass->desc}}
                                </dt>
                                <dt class="sr-only sm:hidden">{{$studyClass->status == 0?'Inactive':'Active'}}</dt>
                            </dl>
                        </td>
                        <td class="hidden px-3 py-4 text-sm text-gray-500 lg:table-cell">{{$studyClass->desc}}
                        </td>
                        <td class="px-3 py-4 text-sm text-gray-500">{{$studyClass->get_total_students()}}</td>
                        <td class="px-3 py-4 text-sm text-gray-500">{{$studyClass->status == 0?'Inactive':'Active'}}</td>
                        <td class="py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-6">
                            <div class="relative inline-block text-left" x-data="menu({open:false})" x-init="init()"
                                 @keydown.escape.stop="open = false; focusButton()" @click.away="onClickAway($event)">
                                <div>
                                    <button type="button" @click="onButtonClick()"
                                            class="bg-gray-100 rounded-full flex items-center text-gray-400 hover:text-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-100 focus:ring-indigo-500"
                                            id="menu-button" aria-expanded="true" aria-haspopup="true">
                                        <span class="sr-only">Open options</span>
                                        <x-heroicon-s-ellipsis-vertical class="h-5 w-5"/>
                                    </button>
                                </div>
                                <div x-show="open" x-cloak
                                     class="origin-top-right absolute right-0 z-10 mt-2 w-56 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 focus:outline-none"
                                     role="menu" aria-orientation="vertical" aria-labelledby="menu-button"
                                     tabindex="-1">
                                    <div class="py-1" role="none">
                                        <a href="{{route('study-class.edit',$studyClass->id)}}"
                                           class="text-gray-700 block px-4 py-2 text-sm hover:bg-gray-100"
                                           role="menuitem">Edit</a>
                                        <form action="{{route('study-class.destroy',$studyClass->id)}}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button
                                                class="text-gray-700 block px-4 py-2 text-sm text-left hover:bg-gray-100 w-full"
                                                role="menuitem">Delete
                                            </button>
                                        </form>
                                        <a href="{{route('study-class.toggle',$studyClass->id)}}"
                                           class="text-gray-700 block px-4 py-2 text-sm hover:bg-gray-100"
                                           role="menuitem">{{$studyClass->status == 0?'Activate':'Deactivate'}}</a>
                                        <a href="{{route('study-class.view-students',$studyClass->id)}}"
                                           class="text-gray-700 block px-4 py-2 text-sm hover:bg-gray-100"
                                           role="menuitem">View
                                            Students</a>
                                    </div>
                                </div>
                            </div>

                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="h-[100px] text-center text-gray-500 font-medium">No Data</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
            <div
                class="bg-white px-4 py-3 border-t border-gray-200 sm:px-6">
                {{$studyClasses->links()}}
            </div>
        </div>
    </div>
</x-admin-shell>
