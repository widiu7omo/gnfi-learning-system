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
        $classRegistrations = ClassRegistration::latest()->paginate(5);
        return view('class-registration.index', compact('classRegistrations'));
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
