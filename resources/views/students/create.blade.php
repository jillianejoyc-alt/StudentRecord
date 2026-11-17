@extends('layouts.app', ['pageTitle' => 'Add a student'])

@section('content')
    <div class="welcome-line"><div><h2>New student record</h2><p>Enter the student's personal and academic details below.</p></div></div>
    <section class="content-panel form-panel"><form action="{{ route('students.store') }}" method="POST">@csrf @include('students._form')</form></section>
@endsection
