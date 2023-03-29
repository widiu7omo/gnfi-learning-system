<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
            $user = User::create($request->only(['name', 'email']));
            $user->markEmailAsVerified();
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
            if ($request->verified === "on") {
                $student->markEmailAsVerified();
            }
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
    public function destroy(User $student)
    {
        DB::beginTransaction();
        try {
            $student->delete();
            DB::commit();
            return redirect()->route('students.index')->with('success', 'Student deleted successfully');
        } catch (QueryException $e) {
            Log::error($e->getMessage());
            DB::rollBack();
            return redirect()->route('students.index')->with('error', "You can't delete students that currently enrolled classes");
        }
    }

    public function manageClass(User $student)
    {

    }
}
