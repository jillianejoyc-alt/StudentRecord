<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class StudentController extends Controller
{
    public function dashboard(): View
    {
        return view('dashboard', [
            'totalStudents' => Student::count(),
            'maleStudents' => Student::where('gender', 'Male')->count(),
            'femaleStudents' => Student::where('gender', 'Female')->count(),
            'totalCourses' => Student::query()->distinct()->count('course'),
            'recentStudents' => Student::latest('created_at')->latest('id')->limit(5)->get(),
        ]);
    }

    public function index(Request $request): View
    {
        $search = trim((string) $request->query('search', ''));
        $students = Student::query()
            ->when($search !== '', function ($query) use ($search) {
                $pattern = '%'.mb_strtolower($search).'%';

                $query->where(function ($query) use ($pattern) {
                    $query->whereRaw('LOWER(student_number) LIKE ?', [$pattern])
                        ->orWhereRaw('LOWER(first_name) LIKE ?', [$pattern])
                        ->orWhereRaw('LOWER(middle_name) LIKE ?', [$pattern])
                        ->orWhereRaw('LOWER(last_name) LIKE ?', [$pattern])
                        ->orWhereRaw('LOWER(course) LIKE ?', [$pattern]);
                });
            })
            ->latest('id')
            ->paginate(10)
            ->withQueryString();

        return view('students.index', compact('students', 'search'));
    }

    public function create(): View
    {
        return view('students.create', ['student' => new Student()]);
    }

    public function store(Request $request): RedirectResponse
    {
        $student = Student::create($this->validatedData($request));

        return redirect()->route('students.show', $student)->with('success', 'Student record added successfully.');
    }

    public function show(Student $student): View
    {
        return view('students.show', compact('student'));
    }

    public function edit(Student $student): View
    {
        return view('students.edit', compact('student'));
    }

    public function update(Request $request, Student $student): RedirectResponse
    {
        $student->update($this->validatedData($request, $student));

        return redirect()->route('students.show', $student)->with('success', 'Student record updated successfully.');
    }

    public function destroy(Student $student): RedirectResponse
    {
        $student->delete();

        return redirect()->route('students.index')->with('success', 'Student record deleted successfully.');
    }

    private function validatedData(Request $request, ?Student $student = null): array
    {
        return $request->validate([
            'student_number' => ['required', 'string', 'max:50', Rule::unique('students', 'student_number')->ignore($student)],
            'first_name' => ['required', 'string', 'max:100'],
            'middle_name' => ['nullable', 'string', 'max:100'],
            'last_name' => ['required', 'string', 'max:100'],
            'gender' => ['required', 'in:Male,Female,Other'],
            'birth_date' => ['required', 'date', 'before_or_equal:today'],
            'email' => ['nullable', 'email', 'max:255'],
            'phone' => ['nullable', 'string', 'max:30'],
            'address' => ['required', 'string', 'max:2000'],
            'course' => ['required', 'string', 'max:150'],
            'year_level' => ['required', 'string', 'max:30'],
            'section' => ['required', 'string', 'max:50'],
        ]);
    }
}
