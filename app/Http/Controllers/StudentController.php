<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $students = User::role('student')->latest()->paginate(5);
        return view('students.index', compact('students'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('students.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users|email'
        ]);
        try {
            User::create(array_merge($request->only(['name', 'email']), ['email_verified_at' => $request->verified ? now() : null]));
            return redirect()->route('students.index')->with('success', 'Student created successfully');
        } catch (QueryException $e) {
            Log::error($e->getMessage());
            return redirect()->route('students.index')->with('error', 'Students failed to create');
        }
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
    public function edit(User $student)
    {
        return view('students.edit', compact('student'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $student)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email'
        ]);
        try {
            $student->update($request->only(['name', 'email']));
            return redirect()->route('students.index')->with('success', 'Student updated successfully');
        } catch (QueryException $e) {
            Log::error($e->getMessage());
            return redirect()->route('students.index')->with('error', 'Failed to update student');
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function manageClass(User $student){

    }
}
