@if ($errors->any())
    <div class="alert alert-danger" role="alert"><strong>Please correct the following:</strong><ul class="mb-0 mt-1">@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div>
@endif
<div class="form-section-title">Student information</div>
<div class="row g-3">
    <div class="col-md-4"><label class="form-label" for="student_number">Student number <span class="required-mark">*</span></label><input class="form-control" id="student_number" name="student_number" value="{{ old('student_number', $student->student_number) }}" maxlength="50" required></div>
    <div class="col-md-4"><label class="form-label" for="first_name">First name <span class="required-mark">*</span></label><input class="form-control" id="first_name" name="first_name" value="{{ old('first_name', $student->first_name) }}" maxlength="100" required></div>
    <div class="col-md-4"><label class="form-label" for="middle_name">Middle name</label><input class="form-control" id="middle_name" name="middle_name" value="{{ old('middle_name', $student->middle_name) }}" maxlength="100"></div>
    <div class="col-md-4"><label class="form-label" for="last_name">Last name <span class="required-mark">*</span></label><input class="form-control" id="last_name" name="last_name" value="{{ old('last_name', $student->last_name) }}" maxlength="100" required></div>
    <div class="col-md-4"><label class="form-label" for="gender">Gender <span class="required-mark">*</span></label><select class="form-select" id="gender" name="gender" required><option value="">Select gender</option>@foreach (['Male', 'Female', 'Other'] as $gender)<option value="{{ $gender }}" @selected(old('gender', $student->gender) === $gender)>{{ $gender }}</option>@endforeach</select></div>
    <div class="col-md-4"><label class="form-label" for="birth_date">Birth date <span class="required-mark">*</span></label><input class="form-control" id="birth_date" name="birth_date" type="date" max="{{ today()->format('Y-m-d') }}" value="{{ old('birth_date', $student->birth_date?->format('Y-m-d')) }}" required></div>
    <div class="col-md-6"><label class="form-label" for="email">Email</label><input class="form-control" id="email" name="email" type="email" value="{{ old('email', $student->email) }}" maxlength="255"></div>
    <div class="col-md-6"><label class="form-label" for="phone">Phone</label><input class="form-control" id="phone" name="phone" type="tel" value="{{ old('phone', $student->phone) }}" maxlength="30"></div>
    <div class="col-12"><label class="form-label" for="address">Address <span class="required-mark">*</span></label><textarea class="form-control" id="address" name="address" rows="3" maxlength="2000" required>{{ old('address', $student->address) }}</textarea></div>
</div>
<div class="form-section-title owner-section-title">Academic information</div>
<div class="row g-3">
    <div class="col-md-6"><label class="form-label" for="course">Course <span class="required-mark">*</span></label><input class="form-control" id="course" name="course" value="{{ old('course', $student->course) }}" maxlength="150" required></div>
    <div class="col-md-3"><label class="form-label" for="year_level">Year level <span class="required-mark">*</span></label><input class="form-control" id="year_level" name="year_level" value="{{ old('year_level', $student->year_level) }}" maxlength="30" placeholder="e.g. 1st Year" required></div>
    <div class="col-md-3"><label class="form-label" for="section">Section <span class="required-mark">*</span></label><input class="form-control" id="section" name="section" value="{{ old('section', $student->section) }}" maxlength="50" required></div>
</div>
<div class="form-actions">
    <a class="btn btn-light" href="{{ isset($editing) && $editing ? route('students.show', $student) : route('students.index') }}">Cancel</a>
    <button class="btn btn-primary" type="submit">{{ isset($editing) && $editing ? 'Save changes' : 'Save student record' }}</button>
</div>
