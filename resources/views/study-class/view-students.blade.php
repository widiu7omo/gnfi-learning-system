<x-admin-shell>
    <div class="px-4 sm:px-6 lg:px-8">
        <div class="sm:flex sm:items-center">
            <div class="sm:flex-auto">
                <h1 class="text-xl font-semibold text-gray-900">{{$studyClass->name}} Class Students</h1>
                <p class="mt-2 text-sm text-gray-700">A list of all students from {{$studyClass->name}} class</p>
            </div>
            <div class="mt-4 sm:mt-0 sm:ml-16 sm:flex-none">
                <a href="{{route('study-class.index')}}"
                   class="inline-flex items-center justify-center rounded-md border border-indigo-400 px-4 py-2 text-sm font-medium text-indigo-600 shadow-sm hover:bg-indigo-700 hover:text-white focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 sm:w-auto">
                    Back
                </a>
                <a href="{{route('study-class.manage-students',$studyClass->id)}}"
                   class="inline-flex items-center justify-center rounded-md border border-transparent bg-indigo-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 sm:w-auto">
                    Manage Students
                </a>
            </div>
        </div>
        <x-session-alert/>
        <div class="-mx-4 mt-8 overflow-hidden shadow ring-1 ring-black ring-opacity-5 sm:-mx-6 md:mx-0 md:rounded-lg">
            <table class="min-w-full divide-y divide-gray-300" x-data="{
                    selected:[],
                    toggleCheckbox(id){
                        if(this.selected.includes(id)){
                            this.selected = this.selected.filter(val=>val !== id);
                        }else{
                            this.selected.push(id);
                        }
                        console.log(this.selected)
                    },
                    deselectAll(){
                        location.reload();
                    },
                    async deleteAll(){
                        const response = await fetch('{{route('class-registration.remove-students',$studyClass->id)}}',{
                            method:'POST',
                            body:JSON.stringify({
                                students:this.selected
                            }),
                            headers:{
                                'Content-type':'application/json;charset=UTF-8;',
                                'Accept':'application/json',
                                'X-CSRF-TOKEN': document.head.querySelector('meta[name=csrf-token]').content
                            }
                        });
                        const decodeResponse = await response.json();
                        console.log(decodeResponse);
                        location.reload();
                    }
            }">
                <thead class="bg-gray-50">
                <tr x-cloak x-show="selected.length > 0" class="bg-red-100 border border-red-200">
                    <th colspan="5">
                        <div class="flex justify-between items-center p-2">
                            <p class="text-sm font-medium p-2 text-left px-3 text-red-800"
                               x-text="`${selected.length} Students selected`"></p>
                            <div class="space-x-2">
                                <button
                                    @click="deleteAll()"
                                    class="px-2 py-1 rounded-lg shadow-sm border border-red-200 bg-red-500 text-white text-sm">
                                    Delete All
                                </button>
                                <button @click="deselectAll()"
                                        class="px-2 py-1 rounded-lg shadow-sm border border-gray-200 bg-gray-500 text-white text-sm">
                                    Deselect All
                                </button>
                            </div>
                        </div>
                    </th>
                </tr>
                <tr>
                    <th>

                    </th>
                    <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">
                        Name
                    </th>
                    <th scope="col"
                        class="hidden px-3 py-3.5 text-left text-sm font-semibold text-gray-900 sm:table-cell">
                        Email
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
                @forelse($students as $student)
                    <tr>
                        <td class="mx-auto flex items-center justify-center h-20">
                            <x-checkbox id="{{$student->id}}" @click="()=>toggleCheckbox({{$student->id}})"/>
                        </td>
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
                                @class(["px-2 py-1 text-white rounded w-fit",$student->pivot->status == 0?"bg-indigo-600":($student->pivot->status == 1?"bg-green-600":"bg-red-600")])>{{$student->pivot->status == 0?'Waiting Confirmation':($student->pivot->status == 1?"Joined":"Rejected")}}</div>
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
                                           class="text-gray-700 block px-4 py-2 text-sm hover:bg-gray-100">Edit
                                            student</a>
                                        <form action="{{route('class-registration.destroy',$student->pivot->id)}}"
                                              method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <input type="hidden" name="backUrl"
                                                   value="{{route('study-class.view-students',$studyClass->id)}}">
                                            <button
                                                class="text-gray-700 block px-4 py-2 text-sm text-left hover:bg-gray-100 w-full">
                                                Remove from class
                                            </button>
                                        </form>
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
