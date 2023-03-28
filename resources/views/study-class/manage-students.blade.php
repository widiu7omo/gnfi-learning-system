<x-admin-shell>
    <div class="px-4 sm:px-6 lg:px-8" x-init="$watch('students',value=>console.log(value))"
         x-data="{
                students:[],
                saveChangeLoading:false,
                successSaved:false,
                studyClass:{{$studyClass->id}},
                toggleStudents(studentId){
                    if(this.students.includes(studentId)){
                        this.students = this.students.filter(val=>val!== studentId);
                    }else{
                        this.students.push(studentId);
                    }
                },
                async saveChanges(){
                    this.saveChangeLoading = true;
                    var response = await fetch('{{route('class-registration.add-students',$studyClass->id)}}',{
                        method:'POST',
                        body:JSON.stringify({
                            students:this.students,
                        }),
                        headers:{
                            'Content-type': 'application/json; charset-UTF-8',
                            'Accept':'application/json',
                            'X-CSRF-TOKEN': document.head.querySelector('meta[name=csrf-token]').content
                        }});
                    var decodedResponse = await response.json();
                    this.saveChangeLoading = false;
                    if(decodedResponse.success){
                        this.successSaved = true;
                        location.reload();
                    }
                },
            }">
        <div class="sm:flex sm:items-center">
            <div class="sm:flex-auto">
                <h1 class="text-xl font-semibold text-gray-900">{{$studyClass->name}} Class Students</h1>
                <p class="mt-2 text-sm text-gray-700">A list of all students from {{$studyClass->name}} class</p>
            </div>
            <div class="mt-4 sm:mt-0 sm:ml-16 sm:flex-none">
                <a href="{{route('study-class.view-students',$studyClass->id)}}"
                   class="inline-flex items-center justify-center rounded-md border border-indigo-400 px-4 py-2 text-sm font-medium text-indigo-600 shadow-sm hover:bg-indigo-700 hover:text-white focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 sm:w-auto">
                    Back
                </a>
                <button @click="saveChanges()"
                        class="inline-flex items-center justify-center rounded-md border border-transparent bg-indigo-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 sm:w-auto">
                    <span class="-mt-0.5" x-show="saveChangeLoading" x-cloak>
                        <x-spinner/>
                    </span>
                    <span>
                        Save Changes
                    </span>
                </button>
            </div>
        </div>
        <div class="-mx-4 mt-8 overflow-hidden w-full">
            <div class="w-full mb-4">
                <form action="{{route('study-class.manage-students',$studyClass->id)}}"
                      class="flex justify-end items-center space-x-3 ">
                    <x-text-input name="search" label="Search Students" class="block mt-1 w-[400px]" type="text"
                                  placeholder="Search Students"
                                  init-value="{{request()->search ?? '' }}"
                                  id="search_students"/>
                    <button
                        class="bg-white rounded-lg border shadow-sm border-gray-300 p-2 mt-1 flex items-center justify-center">
                        <x-heroicon-o-magnifying-glass class="w-6 h-6 text-indigo-600"/>
                    </button>
                </form>
            </div>
            <div x-show="successSaved" x-cloak
                 class="rounded-lg bg-green-50 border border-green-200 p-4 text-green-600 font-medium text-sm flex flex-row">
                <x-heroicon-o-check-circle class="w-6 h-6 text-green-600 mr-2"/>
                Changed has been saved
            </div>
            <div class="grid grid-cols-4 gap-4 m-4">
                @forelse($students as $student)
                    @php
                        $isEnrolled = $studyClass->students->contains($student)
                    @endphp
                    <label
                        @class(["text-xl font-medium shadow ring-1 ring-black ring-opacity-5 sm:-mx-6 md:mx-0 md:rounded-lg text-gray-600 p-3",$isEnrolled?'opacity-[40%]':''])>
                        <div class="flex justify-between">
                            <div class="flex flex-col">
                                <div class="text-gray-600 text-md">{{$student->name}}</div>
                                <div class="text-gray-500 text-sm">
                                    @if($isEnrolled)
                                        <small>Currently enroll this class</small>
                                    @endif
                                </div>
                            </div>
                            <div>
                                <x-checkbox :checked="$isEnrolled" @click="toggleStudents({{$student->id}})"
                                            :disabled="$isEnrolled"/>
                            </div>
                        </div>
                    </label>
                @empty
                    <div>No students registered</div>
                @endforelse
            </div>
        </div>
    </div>
</x-admin-shell>
