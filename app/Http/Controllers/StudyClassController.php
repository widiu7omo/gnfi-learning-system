<?php

namespace App\Http\Controllers;

use App\Models\StudyClass;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
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
        try {
            StudyClass::create($request->only(['name', 'desc']));
            return redirect()->route('study-class.index')->with('success', 'New class created successfully');
        } catch (QueryException $e) {
            Log::error($e->getMessage());
            return redirect()->route('study-class.index')->with('error', 'Failed to create class');
        }

    }

    /**
     * Display the specified resource.
     */
    public function openEnrolledClass(StudyClass $studyClass)
    {
        return view('study-class.open', compact('studyClass'));
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
        try {
            $studyClass->update($request->only(['name', 'desc']));
            return redirect()->route('study-class.index')->with('success', 'Study Class updated successfully');
        } catch (QueryException $e) {
            Log::error($e->getMessage());
            return redirect()->route('study-class.index')->with('error', 'Study Class failed to update');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(StudyClass $studyClass)
    {
        try {
            $studyClass->delete();
            return redirect()->route('study-class.index')->with('success', 'Study Class deleted successfully');
        } catch (QueryException $e) {
            Log::error($e->getMessage());
            return redirect()->route('study-class.index')->with('error', 'Study Class failed to delete');
        }

    }

    /**
     * Toggle class, active || inactive classes
     */
    public function toggle(StudyClass $studyClass)
    {
        try {
            $studyClass->update(['status' => !$studyClass->status]);
            return redirect()->route('study-class.index')
                ->with('success', 'Class ' . $studyClass->status == 0 ? 'Activated' : "Deactivated");
        } catch (QueryException $e) {
            Log::error($e->getMessage());
            return redirect()->route('study-class.index')
                ->with('success', 'Class failed to ' . $studyClass->status == 0 ? 'Activated' : "Deactivated");
        }

    }

    /**
     * Showing student's classes
     */
    public function studentClasses(User $student)
    {
        return view('study-class.your-classes', compact('student'));
    }

    /**
     * Discover class available for students
     */
    public function discoverClasses()
    {
        $studyClasses = StudyClass::where('status', '=', '1')->latest()->simplePaginate(15);
        return view('study-class.discover-classes', compact('studyClasses'));
    }

    /**
     * Get list of students that enrolled specific class
     */

    public function viewStudents(StudyClass $studyClass)
    {
        $students = $studyClass->students()->paginate(5);
        return view('study-class.view-students', compact('studyClass', 'students'));
    }

    /**
     * Ability to manage students specific class
     */

    public function manageStudents(StudyClass $studyClass, Request $request)
    {
        $students = User::studentsOnly();
        if ($request->search) {
            $students = $students->where('name', 'LIKE', "%{$request->search}%")->get();
        } else {
            $students = $students->get();
        }
        return view('study-class.manage-students', compact('studyClass', 'students'));
    }
}
