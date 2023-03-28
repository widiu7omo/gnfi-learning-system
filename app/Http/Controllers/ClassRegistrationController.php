<?php

namespace App\Http\Controllers;

use App\Models\ClassRegistration;
use App\Models\StudyClass;
use Illuminate\Database\QueryException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ClassRegistrationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $classRegistrations = ClassRegistration::paginate(5);
        return view('class-registration.index', compact('classRegistrations'));
    }

//    public function destroy(ClassRegistration $classRegistration)
//    {
//        try {
//            $classRegistration->delete();
//            return redirect()->route('class-registration.index')->with('success', 'Class registration deleted successfully');
//        } catch (QueryException $queryException) {
//            Log::error($queryException->getMessage());
//            return redirect()->route('class-registration.index')->with('error', 'Class registration failed to delete');
//        }
//    }

    /**
     * @param StudyClass $studyClass
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * Add new students from staff role
     */
    public function addStudents(StudyClass $studyClass, Request $request)
    {
        collect($request->students)->each(function ($student) use ($studyClass) {
            // Check duplication
            if (!$studyClass->students->contains($student)) {
                // Status directly become accepted because manage by staff
                $studyClass->students()->attach($student, ['status' => 1]);
            }
        });
        return response()->json(['success' => true]);
    }

    /**
     * @param StudyClass $studyClass
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * Remove students bulky by staff
     */
    public function removeStudents(StudyClass $studyClass, Request $request)
    {
        collect($request->students)->each(function ($student) use ($studyClass) {
            // Check duplication
            if ($studyClass->students->contains($student)) {
                $studyClass->students()->detach($student);
            }
        });
        return response()->json(['success' => true]);
    }

    public function destroy(ClassRegistration $classRegistration, Request $request)
    {
        $student = $classRegistration->student;
        $classRegistration->delete();
        if ($request->backUrl != null) {
            return redirect()->to($request->backUrl)->with('success', $student->name . " has been removed from this class");
        }
        return redirect()->route('class-registration.index')->with('success', $student->name . " has been removed class enrollments");
    }

    /**
     * @param StudyClass $studyClass
     * @return RedirectResponse
     * Enroll action to register class
     */
    public function enroll(StudyClass $studyClass)
    {
        //Check role is student or else
        if (auth()->user()->hasRole(['student'])) {
            if (!$studyClass->is_user_registered(auth()->user())) {
                $studyClass->students()->attach(auth()->user());
            } else {
                return redirect()->route('discover-class.index')->with('error', "You are already enroll this class.");
            }
            return redirect()->route('discover-class.index')->with('success', "Success enroll class. Please wait for confirmation");
        } else {
            abort(403, 'You are not allow to do this action');
        }
        //
    }

    /**
     * @param StudyClass $studyClass
     * @return RedirectResponse
     * Cancel enrollment class
     */
    public function cancelEnroll(StudyClass $studyClass)
    {
        //Check role is student or else
        if (auth()->user()->hasRole(['student'])) {
            $studyClass->students()->detach(auth()->user());
            return redirect()->route('discover-class.index');
        } else {
            abort(403, 'You are not allow to do this action');
        }
    }

    /**
     * @param ClassRegistration $classRegistration
     * @return RedirectResponse
     * Accept class registration
     */
    public function accept(ClassRegistration $classRegistration)
    {
        try {
            $classRegistration->update(['status' => 1]);
            return redirect()->route('class-registration.index')->with('success', 'Student enrollment accepted');
        } catch (QueryException $e) {
            Log::error($e->getMessage());
            return redirect()->route('class-registration.index')->with('error', 'Failed to accept enrollment');

        }
    }

    /**
     * @param ClassRegistration $classRegistration
     * @return RedirectResponse
     * Decline class registration
     */
    public function decline(ClassRegistration $classRegistration)
    {
        try {
            $classRegistration->update(['status' => -1]);
            return redirect()->route('class-registration.index')->with('success', 'Student enrollment accepted');
        } catch (QueryException $e) {
            Log::error($e->getMessage());
            return redirect()->route('class-registration.index')->with('error', 'Failed to accept enrollment');

        }
    }
}
