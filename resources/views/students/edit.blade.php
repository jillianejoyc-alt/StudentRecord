@extends('layouts.app', ['pageTitle' => 'Edit student'])

@section('content')
    <div class="welcome-line"><div><h2>Edit {{ $student->first_name }} {{ $student->last_name }}</h2><p>Update this student's record.</p></div></div>
    <section class="content-panel form-panel"><form action="{{ route('students.update', $student) }}" method="POST">@csrf @method('PUT') @include('students._form', ['editing' => true])</form></section>
@endsection
