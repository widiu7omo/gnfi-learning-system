<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Your Classes') }}
        </h2>
    </x-slot>
    <x-session-alert/>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 gap-4">
                @forelse($student->study_classes as $class)
                    @if($class->status == 1)
                        <div class="bg-white p-4 rounded-lg border border-gray-200 shadow-sm">
                            <div class="flex flex-row justify-between items-center">
                                <h3 class="text-2xl font-medium">{{$class->name}}</h3>
                                <small
                                    @class(["px-2 py-1 text-xs font-medium rounded-full",($class->pivot->status ==1?'!text-green-600 !bg-green-200':($class->pivot->status == 0?"bg-orange-200 text-orange-600":"!text-red-600 !bg-red-200"))])
                                >•&nbsp;{{$class->pivot->status == 0?"Waiting Confirmation":($class->pivot->status ==1?'Approved':"Decline")}}</small>
                            </div>
                            <p class="text-sm text-gray-500">{{$class->desc}}</p>
                            <a href="{{route('class-study.open-enrolled-class',$class->id)}}"
                               class="mt-6 {{$class->pivot->status != 1 ? 'pointer-events-none cursor-default opacity-25':''}} inline-flex items-center px-4 py-2 bg-gray-800 disabled:opacity-25 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">Open
                                Study Class
                            </a>
                        </div>
                    @endif
                @empty
                    <div class="text-sm font-semibold text-center max-w-2xl mx-auto h-[400px] flex items-center">
                        No class enrolled. Please visit &nbsp;
                        <a class="text-indigo-600" href="{{route('discover-class.index')}}">discover class</a>
                        &nbsp;to enroll new class
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>
