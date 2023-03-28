<x-admin-shell>
    <div class="px-4 sm:px-6 lg:px-8">
        <div class="sm:flex sm:items-center">
            <div class="sm:flex-auto">
                <h1 class="text-xl font-semibold text-gray-900">Class Enrollments</h1>
                <p class="mt-2 text-sm text-gray-700">A list of all students currently registration classes </p>
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
                        Student
                    </th>
                    <th scope="col"
                        class="hidden px-3 py-3.5 text-left text-sm font-semibold text-gray-900 sm:table-cell">
                        Study Class
                    </th>
                    <th scope="col"
                        class="hidden px-3 py-3.5 text-left text-sm font-semibold text-gray-900 sm:table-cell">
                        Confirmed
                    </th>
                    <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6">
                        <span class="sr-only">Edit</span>
                    </th>
                </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 bg-white">
                @forelse($classRegistrations as $classRegistration)
                    <tr>
                        <td class="w-full max-w-0 py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:w-auto sm:max-w-none sm:pl-6">
                            {{$classRegistration->student->name??'' }}
                            <dl class="font-normal lg:hidden">
                                <dt class="sr-only">{{$classRegistration->student->email ?? ''}}
                                </dt>
                                <dt class="sr-only sm:hidden">Active</dt>
                            </dl>
                        </td>
                        <td class="hidden px-3 py-4 text-sm text-gray-500 lg:table-cell">{{$classRegistration->study_class->name ?? ''}}
                        </td>
                        <td class="px-3 py-4 text-sm text-gray-500">
                            <div
                                @class(["px-2 py-1 text-white rounded w-fit",$classRegistration->status == 0?"bg-indigo-600":($classRegistration->status == 1?'bg-green-600':"bg-red-600")])>{{$classRegistration->status == 0?"Waiting Confirmation":($classRegistration->status == 1?'Accept':'Decline')}}</div>
                        </td>
                        <td class="py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-6">
                            <form action="{{route('class-registration.accept',$classRegistration->id)}}"
                                  method="POST">
                                @csrf
                                <button class="text-indigo-600 hover:text-indigo-900">Accept
                                </button>
                            </form>
                            <form action="{{route('class-registration.decline',$classRegistration->id)}}"
                                  method="POST">
                                @csrf
                                <button class="text-indigo-600 hover:text-indigo-900">Decline
                                </button>
                            </form>
                            <form action="{{route('class-registration.accept',$classRegistration->id)}}"
                                  method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="text-indigo-600 hover:text-indigo-900">Remove
                                </button>
                            </form>
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
                {{$classRegistrations->links()}}
            </div>
        </div>
    </div>
</x-admin-shell>
