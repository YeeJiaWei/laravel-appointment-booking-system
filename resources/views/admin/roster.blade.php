@extends('layouts.dashboard')

@section('content')
<div class="dash__block">
	<h1 class="dash__header">Create Working Time</h1>
	<h4 class="dash__description">Add Business Hours for the month.</h4>
	<form class="request" method="POST" action="/admin/roster/{{ $dateString }}">
		{{ csrf_field() }}
		@if ($flash = session('message'))
			<div class="alert alert-success">
				{{ $flash }}
			</div>
		@endif
		@include('shared.error_message')
		@if (!\App\Models\Employee::first())
			@include('shared.error_message_custom', [
				'title' => 'Employees do not exist.',
				'message' => 'Create an employee <a href="/admin/employees">here</a>.',
				'type' => 'danger'
			])
		@endif
		@include('shared.loading_message')
		<div class="form-group">
			<label for="roster_employee">Employee <span class="request__validate">(Title - Full Name - ID)</span></label>
			<select name="employee_id" id="roster_employee" class="form-control request__input" onchange="showRedirect('.loading', '/admin/roster/{{ $dateString }}/' + this.value)">
				@foreach (\App\Models\Employee::all()->sortBy('lastname')->sortBy('firstname')->sortBy('title') as $e)
					<option value="{{ $e->id }}" {{ old('employee_id') == $e->id || $employeeID == $e->id ? 'selected' : null }}>{{ $e->title . ' - ' . $e->firstname . ' ' . $e->lastname . ' - ' . $e->id }}</option>
				@endforeach
				<option value="" {{ old('employee_id') || $employeeID ? null : 'selected' }}>-- None --</option>
			</select>
		</div>
		<div class="form-group request__flex-container">
			<div class="request__flex request__flex--left">
				<label for="roster_start_time">Start Time <span class="request__validate">(24 hour format)</span></label>
				<input name="start_time" type="text" id="roster_start_time" class="form-control request__input" placeholder="hh:mm" value="{{ old('start_time') ? old('start_time') : '09:00' }}" masked-time>
			</div>
			<div class="request__flex request__flex--right">
				<label for="roster_end_time">End Time <span class="request__validate">(24 hour format)</span></label>
				<input name="end_time" type="text" id="roster_end_time" class="form-control request__input" placeholder="hh:mm" value="{{ old('end_time') ? old('end_time') : '17:00' }}" masked-time>
			</div>
		</div>
		<div class="form-group request__flex-container">
			<div class="request__flex request__flex--left">
				<label for="roster_month_year">Month & Year <span class="request__validate">(select to go to month)</span></label>
			    <select name="month_year" id="roster_month_year" class="form-control request__input" onchange="showRedirect('.loading', '/admin/roster/' + this.value + '{{ $employeeID ? '/' . $employeeID : null }}')">
			        @foreach ($months as $month)
			            <option value="{{ $month->format('m-Y') }}" {{ $date->format('m-Y') == $month->format('m-Y') ? 'selected' : null }}>{{ $month->format('F Y') }}</option>
			        @endforeach
			    </select>
			</div>
			<div class="request__flex request__flex--right">
				<label for="roster_day">Day <span class="request__validate">(day of month)</span></label>
			    <select name="day" id="roster_day" class="form-control request__input">
			        @for ($day = 1; $day <= $date->endOfMonth()->day; $day++)
			            <option value="{{ $day }}" {{ old('day') == $day ? 'selected' : null }}>{{ $day }}</option>
			        @endfor
			    </select>
			</div>
		</div>
		<button class="btn btn-lg btn-primary btn-block btn--margin-top" href="/admin/employees">Add Working Time</button>
	</form>
</div>
<hr>
<div class="dash__block">
	<h1 class="dash__header dash__header--margin-top">Roster {{ $employee ? ' for ' . $employee->firstname . ' ' . $employee->lastname : null }}</h1>
	<h4 class="dash__description">Show the roster of a given month.</h4>
	<div class="alert alert-warning">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <strong>Warning!</strong> Editing/deleting a working time will remove bookings on that date.
    </div>
	<h1>{{ $date->format('F Y') }}</h1>
	@include('shared.calendar', [
		'pDate' => $date,
		'items' => $roster,
		'type' => 'admin'
	])
</div>
@endsection