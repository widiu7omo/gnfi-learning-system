<x-admin-shell>
    <div class="px-4 sm:px-6 lg:px-8">
        <div class="sm:flex sm:items-center">
            <div class="sm:flex-auto">
                <h1 class="text-xl font-semibold text-gray-900">Students</h1>
                <p class="mt-2 text-sm text-gray-700">A list of all students </p>
            </div>
            {{--            <div class="mt-4 sm:mt-0 sm:ml-16 sm:flex-none">--}}
            {{--                <a href="{{route('students.create')}}"--}}
            {{--                   class="inline-flex items-center justify-center rounded-md border border-transparent bg-indigo-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 sm:w-auto">--}}
            {{--                    Add Students--}}
            {{--                </a>--}}
            {{--            </div>--}}
        </div>
        <x-session-alert/>
        <div class="-mx-4 mt-8 overflow-hidden shadow ring-1 ring-black ring-opacity-5 sm:-mx-6 md:mx-0 md:rounded-lg">
            <table class="min-w-full divide-y divide-gray-300">
                <thead class="bg-gray-50">
                <tr>
                    <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">
                        Name
                    </th>
                    <th scope="col"
                        class="hidden px-3 py-3.5 text-left text-sm font-semibold text-gray-900 sm:table-cell">
                        Email
                    </th>
                    <th scope="col"
                        class="hidden px-3 py-3.5 text-left text-sm font-semibold text-gray-900 sm:table-cell">
                        Verified
                    </th>
                    <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6">
                        <span class="sr-only">Edit</span>
                    </th>
                </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 bg-white">
                @forelse($students as $student)
                    <tr>
                        <td class="w-full max-w-0 py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:w-auto sm:max-w-none sm:pl-6">
                            {{$student->name}}
                            <dl class="font-normal lg:hidden">
                                <dt class="sr-only">{{$student->email}}
                                </dt>
                                <dt class="sr-only sm:hidden">Active</dt>
                            </dl>
                        </td>
                        <td class="hidden px-3 py-4 text-sm text-gray-500 lg:table-cell">{{$student->email}}
                        </td>
                        <td class="px-3 py-4 text-sm text-gray-500">
                            <div
                                @class(["px-2 py-1 text-white rounded w-fit",$student->isVerified()?"bg-indigo-600":"bg-red-600"])>{{$student->isVerified()?'Verified':"Not Verified"}}</div>
                        </td>
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
                                     class="origin-top-right absolute right-0 z-50 mt-2 w-56 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 focus:outline-none"
                                     role="menu" aria-orientation="vertical" aria-labelledby="menu-button"
                                     tabindex="-1">
                                    <div class="py-1" role="none">
                                        <a href="{{route('students.edit',$student->id)}}"
                                           class="text-gray-700 block px-4 py-2 text-sm hover:bg-gray-100">Edit</a>
                                        <form action="{{route('students.destroy',$student->id)}}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button
                                                class="text-gray-700 block px-4 py-2 text-sm text-left hover:bg-gray-100 w-full">
                                                Delete
                                            </button>
                                        </form>
                                        {{--                                        <a href="{{route('students.manage-class',$student->id)}}"--}}
                                        {{--                                           class="text-gray-700 block px-4 py-2 text-sm hover:bg-gray-100">Manage Study--}}
                                        {{--                                            Class</a>--}}
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
                {{$students->links()}}
            </div>
        </div>
    </div>
</x-admin-shell>
