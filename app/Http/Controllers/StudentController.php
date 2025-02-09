<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreStudentRequest;
use App\Models\Student;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        $paginator = Student::paginate(10);
        return Inertia::render('Students/Index', [
            'paginator' => $paginator,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): Response
    {
        return Inertia::render('Students/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreStudentRequest $request): RedirectResponse
    {
        // Validate and create the student
        $validated = $request->validated();
        Student::create($validated);

        // Redirect to the students index with a success message
        return redirect()->route('students.index')->with('success', 'Student created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Student $student): Response
    {
        return Inertia::render('Students/Show', [
            'id' => $student->id,
            'firstName' => $student->first_name,
            'lastName' => $student->last_name,
            'address' => $student->address,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Student $student): Response
    {
        // Reuse Create page as functionality is
        // basically the same when both creating and editing
        return Inertia::render('Students/Create', [
            'id' => $student->id,
            'firstName' => $student->first_name,
            'lastName' => $student->last_name,
            'address' => $student->address,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreStudentRequest $request, Student $student): RedirectResponse
    {
        // Validate and update the student
        $validated = $request->validated();
        $student->update($validated);

        // Redirect to the students index with a success message
        return redirect()->route('students.index')->with('success', 'Student updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Student $student): RedirectResponse
    {
        // Delete the student
        $student->delete();

        // Redirect to the students index with a success message
        return redirect()->route('students.index')->with('success', 'Student deleted successfully!');
    }
}
