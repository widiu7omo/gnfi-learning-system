<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            <h1 class="text-xl font-semibold text-gray-900">Welcome to class {{$studyClass->name}}</h1>
        </h2>
        <a href="{{route('your-classes',auth()->user()->id)}}" class="text-indigo-600 flex flex-row items-center pt-3">
            <x-heroicon-s-chevron-left class="w-5 h-5"/>
            &nbsp;Back to classes
        </a>
    </x-slot>
    <x-session-alert/>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-3 gap-4">
                @php
                    $materials = [
                          'Fundamentals',
                          'Operators',
                          'Functions',
                          'Advanced',
                          'Request Lifecycle'
                        ];
                @endphp
                @foreach($materials as $material)
                    <div
                        class="p-4 py-8 flex items-center justify-center bg-white rounded-lg hover:bg-gray-50 hover:text-gray-500 text-gray-600 cursor-pointer">
                        <h1 class="text-3xl font-medium ">{{$material}}</h1>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
