<header class="topbar">
    <div><div class="eyebrow">STUDENT RECORD MANAGEMENT</div><h1>{{ $pageTitle ?? 'Student Records' }}</h1></div>
    <a href="{{ route('students.create') }}" class="btn btn-primary topbar-action">Add student <span aria-hidden="true">+</span></a>
</header>