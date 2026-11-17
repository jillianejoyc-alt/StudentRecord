<aside class="sidebar">
    <a class="brand" href="{{ route('dashboard') }}">
        <span class="brand-mark">S</span>
        <span><strong>StudentRecord</strong><small>Student records</small></span>
    </a>
    <div class="nav-caption">WORKSPACE</div>
    <nav class="side-nav" aria-label="Main navigation">
        <a href="{{ route('dashboard') }}" class="side-link {{ request()->routeIs('dashboard') ? 'active' : '' }}"><span class="nav-glyph">D</span> Dashboard</a>
        <a href="{{ route('students.index') }}" class="side-link {{ request()->routeIs('students.*') ? 'active' : '' }}"><span class="nav-glyph">R</span> Student records</a>
        <a href="{{ route('students.create') }}" class="side-link {{ request()->routeIs('students.create') ? 'active' : '' }}"><span class="nav-glyph">+</span> Add a student</a>
    </nav>
    <div class="sidebar-note"><span class="status-dot"></span><span>Records are stored securely<br>in your configured database.</span></div>
</aside>