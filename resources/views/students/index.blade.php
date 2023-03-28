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
                            <a href="{{route('students.edit',$student->id)}}"
                               class="text-indigo-600 hover:text-indigo-900">Edit</a>
                            <form action="{{route('students.destroy',$student->id)}}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="text-indigo-600 hover:text-indigo-900">Delete
                                </button>
                            </form>
                            <div class="divide-amber-50"></div>
                            <a href="{{route('students.manage-class',$student->id)}}"
                               class="text-indigo-600 hover:text-indigo-900">Manage Study Class</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="h-[100px] text-center text-gray-500 font-medium">No Data</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
            @if($students->count() > 5)
                <div
                    class="bg-white px-4 py-3 border-t border-gray-200 sm:px-6">
                    {{$students->links()}}
                </div>
            @endif
        </div>
    </div>
</x-admin-shell>
