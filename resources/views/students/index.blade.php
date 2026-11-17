@extends('layouts.app', ['pageTitle' => 'Student records'])

@section('content')
    <div class="welcome-line"><div><h2>All students</h2><p>Search and manage student records.</p></div><a href="{{ route('students.create') }}" class="btn btn-primary">Add a student <span aria-hidden="true">+</span></a></div>
    <section class="content-panel">
        <form class="search-form" action="{{ route('students.index') }}" method="GET" role="search">
            <label class="visually-hidden" for="student-search">Search by student number, name, or course</label>
            <input id="student-search" class="form-control" type="search" name="search" value="{{ $search }}" placeholder="Search by student number, name, or course">
            <button class="btn btn-outline-primary" type="submit">Search</button>
            @if ($search !== '') <a class="clear-search" href="{{ route('students.index') }}">Clear</a> @endif
        </form>
        @if ($students->isEmpty())
            <div class="empty-state compact-empty"><div class="empty-mark">S</div><h3>{{ $search !== '' ? 'No matching students' : 'No student records yet' }}</h3><p>{{ $search !== '' ? 'Try another student number, name, or course.' : 'Your registered students will appear here.' }}</p>@if ($search === '') <a class="btn btn-primary" href="{{ route('students.create') }}">Add a student</a> @endif</div>
        @else
            <div class="table-responsive"><table class="table data-table align-middle mb-0">
                <thead><tr><th>Student</th><th>Course</th><th>Year / Section</th><th>Gender</th><th>Phone</th><th>Added</th><th></th></tr></thead>
                <tbody>@foreach ($students as $student)
                    <tr><td><a class="student-name" href="{{ route('students.show', $student) }}">{{ $student->first_name }} {{ $student->middle_name ? $student->middle_name.' ' : '' }}{{ $student->last_name }}</a><span class="cell-sub">{{ $student->student_number }}</span></td><td><span class="course-pill">{{ $student->course }}</span></td><td>{{ $student->year_level }}<span class="cell-sub">{{ $student->section }}</span></td><td>{{ $student->gender }}</td><td>{{ $student->phone ?: '—' }}</td><td>{{ $student->created_at->format('M j, Y') }}</td><td class="text-end"><a class="row-action" href="{{ route('students.show', $student) }}" aria-label="View {{ $student->first_name }} {{ $student->last_name }}">View <span aria-hidden="true">&gt;</span></a></td></tr>
                @endforeach</tbody>
            </table></div>
            @if ($students->hasPages()) <div class="pagination-wrap">{{ $students->links() }}</div> @endif
        @endif
    </section>
@endsection
