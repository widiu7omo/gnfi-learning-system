<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Discover Classes') }}
        </h2>
    </x-slot>
    <x-session-alert/>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-3 gap-4">
                @forelse($studyClasses as $studyClass)
                    @php
                        $classRegistration = $studyClass->class_registration(auth()->user());
                    @endphp
                    <div class="bg-white border border-gray-100 rounded-md p-6 flex flex-col h-full">
                        <h3 class="text-2xl text-gray-900 font-medium">{{$studyClass->name}}</h3>
                        <small class="flex-1 text-sm text-gray-500">{{$studyClass->desc}}</small>
                        <div class="pt-8">
                            @if($classRegistration == null)
                                <a href="{{route('class.enroll',$studyClass->id)}}"
                                    @class(["w-full block rounded px-3 py-2 text-sm text-center text-white bg-indigo-600"])>
                                    Enroll
                                </a>
                            @else
                                <a href="{{route('class.enroll',$studyClass->id)}}"
                                    @class(["w-full block rounded px-3 py-2 text-sm text-center text-white",
                                            $classRegistration?->status == 0?'bg-orange-600':($classRegistration?->status == 1?'bg-green-600 ':"bg-red-600")
                                    ])>

                                    {{$classRegistration?->status == 0?'Waiting Confirmation':($classRegistration?->status == 1?'Enrolled':"Unable to enroll")}}
                                </a>
                            @endif
                        </div>
                    </div>
                @empty
                    <div class="text-sm font-medium text-gray-500 text-center">
                        No Class Available
                    </div>
                @endforelse
            </div>
            <div class="mt-8">
                {{$studyClasses->links()}}
            </div>
        </div>
    </div>
</x-app-layout>
