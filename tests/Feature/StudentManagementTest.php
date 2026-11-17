<?php

namespace Tests\Feature;

use App\Models\Student;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class StudentManagementTest extends TestCase
{
    use RefreshDatabase;

    public function test_student_records_can_be_created_viewed_updated_and_deleted(): void
    {
        $this->get('/')->assertRedirect(route('dashboard'));
        $this->get(route('dashboard'))->assertOk()->assertSee('TOTAL STUDENTS');
        $this->get(route('students.create'))->assertOk()->assertSee('New student record');

        $this->post(route('students.store'), $this->studentData())->assertRedirect();

        $student = Student::firstOrFail();
        $this->assertDatabaseHas('students', ['id' => $student->id, 'student_number' => '2026-001', 'first_name' => 'Jasper']);
        $this->get(route('students.show', $student))->assertOk()->assertSee('Morgan Lee');
        $this->get(route('students.edit', $student))->assertOk()->assertSee('Edit Jasper Lee');

        $this->patch(route('students.update', $student), array_merge($this->studentData(), ['first_name' => 'Jordan']))
            ->assertRedirect(route('students.show', $student));
        $this->assertDatabaseHas('students', ['id' => $student->id, 'first_name' => 'Jordan']);
        $this->get(route('dashboard'))->assertOk()->assertSee('Jordan Lee');

        $this->delete(route('students.destroy', $student))->assertRedirect(route('students.index'));
        $this->assertDatabaseMissing('students', ['id' => $student->id]);
    }

    public function test_students_can_be_searched_by_number_name_and_course(): void
    {
        Student::create($this->studentData());
        Student::create(array_merge($this->studentData(), [
            'student_number' => '2026-002',
            'first_name' => 'Avery',
            'course' => 'Computer Science',
        ]));

        $this->get(route('students.index', ['search' => '2026-001']))->assertOk()->assertSee('Jasper');
        $this->get(route('students.index', ['search' => 'Morgan']))->assertOk()->assertSee('Jasper');
        $this->get(route('students.index', ['search' => 'Computer Science']))->assertOk()->assertSee('Avery');
    }

    public function test_dashboard_counts_gender_and_distinct_courses(): void
    {
        Student::create($this->studentData());
        Student::create(array_merge($this->studentData(), [
            'student_number' => '2026-002',
            'first_name' => 'Avery',
            'gender' => 'Female',
        ]));
        Student::create(array_merge($this->studentData(), [
            'student_number' => '2026-003',
            'first_name' => 'Casey',
            'gender' => 'Other',
            'course' => 'Computer Science',
        ]));

        $this->get(route('dashboard'))
            ->assertOk()
            ->assertViewHas('totalStudents', 3)
            ->assertViewHas('maleStudents', 1)
            ->assertViewHas('femaleStudents', 1)
            ->assertViewHas('totalCourses', 2);
    }

    public function test_student_fields_are_validated_and_numbers_must_be_unique(): void
    {
        $this->from(route('students.create'))
            ->post(route('students.store'), ['student_number' => '', 'gender' => 'Unknown'])
            ->assertRedirect(route('students.create'))
            ->assertSessionHasErrors(['student_number', 'first_name', 'last_name', 'gender', 'birth_date', 'address', 'course', 'year_level', 'section']);

        Student::create($this->studentData());
        $this->from(route('students.create'))
            ->post(route('students.store'), $this->studentData())
            ->assertRedirect(route('students.create'))
            ->assertSessionHasErrors(['student_number']);
        $this->assertDatabaseCount('students', 1);
    }

    private function studentData(): array
    {
        return [
            'student_number' => '2026-001',
            'first_name' => 'Jasper',
            'middle_name' => 'Morgan',
            'last_name' => 'Lee',
            'gender' => 'Male',
            'birth_date' => '2005-04-12',
            'email' => 'jasper@example.com',
            'phone' => '555-0142',
            'address' => '14 Cedar Street',
            'course' => 'Information Technology',
            'year_level' => '2nd Year',
            'section' => 'A',
        ];
    }
}
