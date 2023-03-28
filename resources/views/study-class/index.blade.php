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
                        <td class="px-3 py-4 text-sm text-gray-500">{{$studyClass->status == 0?'Inactive':'Active'}}</td>
                        <td class="py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-6">
                            <a href="{{route('study-class.edit',$studyClass->id)}}"
                               class="text-indigo-600 hover:text-indigo-900">Edit</a>
                            <form action="{{route('study-class.destroy',$studyClass->id)}}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="text-indigo-600 hover:text-indigo-900">Delete
                                </button>
                            </form>
                            <div class="divide-amber-50"></div>
                            <a href="{{route('study-class.toggle',$studyClass->id)}}"
                               class="text-indigo-600 hover:text-indigo-900">{{$studyClass->status == 0?'Activate':'Deactivate'}}</a>
                            <div class="divide-amber-50"></div>
                            <a href="{{route('study-class.view-students',$studyClass->id)}}"
                               class="text-indigo-600 hover:text-indigo-900">View Students</a>
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
