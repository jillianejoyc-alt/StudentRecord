@extends('layouts.app', ['pageTitle' => $student->first_name.' '.$student->last_name])

@section('content')
    <div class="welcome-line detail-heading">
        <div><a class="back-link" href="{{ route('students.index') }}">&lt; All student records</a><h2>{{ $student->first_name }} {{ $student->middle_name ? $student->middle_name.' ' : '' }}{{ $student->last_name }}</h2><p>Student number {{ $student->student_number }} - Added {{ $student->created_at->format('F j, Y') }}</p></div>
        <div class="heading-actions"><a class="btn btn-outline-primary" href="{{ route('students.edit', $student) }}">Edit record</a><form action="{{ route('students.destroy', $student) }}" method="POST" data-confirm="Delete {{ $student->first_name }} {{ $student->last_name }}'s record? This cannot be undone.">@csrf @method('DELETE')<button class="btn btn-outline-danger" type="submit">Delete</button></form></div>
    </div>
    <div class="detail-grid">
        <section class="content-panel detail-panel"><div class="panel-heading"><div><h2>Student information</h2><p>Personal profile details.</p></div><span class="course-pill">{{ $student->course }}</span></div>
            <dl class="detail-list"><div><dt>Student number</dt><dd>{{ $student->student_number }}</dd></div><div><dt>First name</dt><dd>{{ $student->first_name }}</dd></div><div><dt>Middle name</dt><dd>{{ $student->middle_name ?: 'Not specified' }}</dd></div><div><dt>Last name</dt><dd>{{ $student->last_name }}</dd></div><div><dt>Gender</dt><dd>{{ $student->gender }}</dd></div><div><dt>Birth date</dt><dd>{{ $student->birth_date->format('F j, Y') }}</dd></div></dl>
        </section>
        <section class="content-panel detail-panel"><div class="panel-heading"><div><h2>Contact and academic information</h2><p>Student contact and enrollment details.</p></div></div>
            <dl class="detail-list"><div><dt>Email</dt><dd>@if ($student->email)<a href="mailto:{{ $student->email }}">{{ $student->email }}</a>@else Not specified @endif</dd></div><div><dt>Phone</dt><dd>@if ($student->phone)<a href="tel:{{ $student->phone }}">{{ $student->phone }}</a>@else Not specified @endif</dd></div><div><dt>Course</dt><dd>{{ $student->course }}</dd></div><div><dt>Year level</dt><dd>{{ $student->year_level }}</dd></div><div><dt>Section</dt><dd>{{ $student->section }}</dd></div><div class="address-row"><dt>Address</dt><dd>{{ $student->address }}</dd></div></dl>
        </section>
    </div>
@endsection
