<x-admin-shell>
    <div class="px-4 sm:px-6 lg:px-8">
        <div class="sm:flex sm:items-center">
            <div class="sm:flex-auto">
                <h1 class="text-xl font-semibold text-gray-900">New Study Class</h1>
                <p class="mt-2 text-sm text-gray-700">You are about to create new Class</p>
            </div>
            <div class="mt-4 sm:mt-0 sm:ml-16 sm:flex-none">
                <a href="{{route('study-class.index')}}"
                   class="inline-flex items-center justify-center rounded-md border border-transparent bg-indigo-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 sm:w-auto">
                    Back
                </a>
            </div>
        </div>
        @if ($errors->any())
            <div class="mt-3 border border-red-200 bg-red-50">
                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="bg-gray-50 shadow rounded-xl p-8 mt-8 border border-gray-200">
            <form action="{{route('study-class.store')}}" method="post">
                @csrf
                @include("study-class.form")
                <x-primary-button
                    class="inline-flex mt-6 items-center justify-center rounded-md border border-transparent bg-indigo-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 sm:w-auto">
                    {{ __('Save') }}
                </x-primary-button>
            </form>
        </div>
    </div>
</x-admin-shell>
