@extends('layouts.app', ['pageTitle' => 'Dashboard'])

@section('content')
    <div class="welcome-line">
        <div><h2>Overview</h2><p>A current look at student enrollment.</p></div>
        <span class="date-chip">{{ now()->format('l, F j, Y') }}</span>
    </div>
    <div class="stats-grid">
        <article class="stat-card stat-total"><div class="stat-label">TOTAL STUDENTS</div><div class="stat-value">{{ number_format($totalStudents) }}</div><div class="stat-foot">Students in the registry</div><span class="stat-symbol">S</span></article>
        <article class="stat-card"><div class="stat-label">MALE STUDENTS</div><div class="stat-value">{{ number_format($maleStudents) }}</div><div class="stat-foot">Currently registered</div><span class="stat-symbol stat-dog">M</span></article>
        <article class="stat-card"><div class="stat-label">FEMALE STUDENTS</div><div class="stat-value">{{ number_format($femaleStudents) }}</div><div class="stat-foot">Currently registered</div><span class="stat-symbol stat-cat">F</span></article>
        <article class="stat-card"><div class="stat-label">TOTAL COURSES</div><div class="stat-value">{{ number_format($totalCourses) }}</div><div class="stat-foot">Distinct courses</div><span class="stat-symbol stat-other">C</span></article>
    </div>
    <section class="content-panel">
        <div class="panel-heading"><div><h2>Recently added students</h2><p>The latest additions to your records.</p></div><a class="text-link" href="{{ route('students.index') }}">View all students <span aria-hidden="true">&gt;</span></a></div>
        @if ($recentStudents->isEmpty())
            <div class="empty-state"><div class="empty-mark">S</div><h3>No student records yet</h3><p>Add your first student to begin building the registry.</p><a class="btn btn-primary" href="{{ route('students.create') }}">Add a student</a></div>
        @else
            <div class="table-responsive"><table class="table data-table align-middle mb-0">
                <thead><tr><th>Student</th><th>Student number</th><th>Course</th><th>Year / Section</th><th>Date added</th><th></th></tr></thead>
                <tbody>@foreach ($recentStudents as $student)
                    <tr><td><a class="student-name" href="{{ route('students.show', $student) }}">{{ $student->first_name }} {{ $student->last_name }}</a></td><td>{{ $student->student_number }}</td><td>{{ $student->course }}</td><td>{{ $student->year_level }} / {{ $student->section }}</td><td>{{ $student->created_at->format('M j, Y') }}</td><td class="text-end"><a class="row-action" href="{{ route('students.show', $student) }}" aria-label="View {{ $student->first_name }} {{ $student->last_name }}">View <span aria-hidden="true">&gt;</span></a></td></tr>
                @endforeach</tbody>
            </table></div>
        @endif
    </section>
@endsection