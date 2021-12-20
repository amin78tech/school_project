@extends("dashboard.layouts.dashboard")
@section("content")
            @if($errors->all()!=null)
                @foreach ($errors->all() as $error)
                    <div class="alert alert-danger alert-dismissible" style="text-align: right;margin-top: 1rem !important;";>
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        {{ $error }}
                    </div>
                @endforeach
            @endif
    <form role="form" action="{{ route("CourseController.store") }}" method="post">
        @csrf
        <div class="form-group input-group">
            <span class="input-group-addon">Name</span>
            <input type="text" class="form-control" value="" name="name">
        </div>
        <div class="form-group input-group">
            <span class="input-group-addon">Start Date Course</span>
            <input type="date" class="form-control" value="" name="startdate">
        </div>
        <div class="form-group input-group">
            <span class="input-group-addon">End Date Course</span>
            <input type="date" class="form-control" value="" name="enddate">
        </div>
        <div class="form-group">
            <label>Selects Teacher</label>
            <select class="form-control" name="optionTeacher">
                @foreach($teachers as $teacher)
                    <option value="{{ $teacher['user_id'] }}">{{ $teacher['name'].' '.$teacher['family'] }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label>Selects Student Multiple(Ctrl+ Click Right)</label>
            <select  class="form-control" name="optionStudent[]" multiple="multiple">
                @foreach($students as $student)
                    <option value="{{ $student['user_id'] }}">{{ $student['name'].' '.$student['family'] }}</option>
                @endforeach
            </select>
        </div>
        <button class="btn btn-warning btn-block">Register Course</button>
@endsection
