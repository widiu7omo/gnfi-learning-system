<div class="max-w-7xl px-8 mx-auto w-full pt-8">
    @if(session('success'))
        <div
            class="rounded-lg bg-green-50 border border-green-200 p-4 text-green-600 font-medium text-sm flex flex-row">
            <x-heroicon-o-check-circle class="w-6 h-6 text-green-600 mr-2"/>
            {{session('success')}}
        </div>
    @endif
    @if(session('error'))
        <div class="rounded-lg bg-red-50 border border-red-200 p-4 text-red-600 font-medium text-sm flex flex-row">
            <x-heroicon-o-x-circle class="w-6 h-6 text-red-600 mr-2"/>
            {{session('error')}}
        </div>
    @endif
</div>
