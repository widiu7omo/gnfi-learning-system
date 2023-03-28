<?php

namespace App\Http\Controllers;

use App\Models\StudyClass;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;

class StudyClassController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $studyClasses = StudyClass::latest()->paginate(5);
        return view('study-class.index', compact('studyClasses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('study-class.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'desc' => 'required'
        ]);
        StudyClass::create($request->only(['name', 'desc']));
        return redirect()->route('study-class.index')->with('success', 'New class created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(StudyClass $studyClass): View
    {
        return view('study-class.edit', compact('studyClass'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, StudyClass $studyClass)
    {
        $request->validate([
            'name' => 'required',
            'desc' => 'required'
        ]);
        $studyClass->update($request->only(['name', 'desc']));
        return redirect()->route('study-class.index')->with('success', 'Study Class updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(StudyClass $studyClass)
    {
        $studyClass->delete();
        return redirect()->route('study-class.index')->with('success', 'Study Class deleted successfully');
    }

    /**
     * Toggle class, active || inactive classes
     */
    public function toggle(StudyClass $studyClass)
    {
        $studyClass->update(['status' => !$studyClass->status]);
        return redirect()->route('study-class.index')
            ->with('success', 'Class ' . $studyClass->status == 0 ? 'Activated' : "Deactivated");
    }

    /**
     * Showing student's classes
     */
    public function studentClasses(User $student)
    {
//        $classes = $student->
        return view('study-class.your-classes');
    }

    /**
     * Discover class available for students
     */
    public function discoverClasses(){
        return view('study-class.discover-classes');
    }
}
