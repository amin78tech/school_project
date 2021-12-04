@extends("dashboard.layouts.dashboard")
@section("content")
    <form role="form" action="{{ route("CoursesController.addUserStore",["id"=>$course_id]) }}" method="post">
        @csrf
        <div class="form-group">
            <label>Selects Student Multiple(Ctrl+ Click Right)</label>
            <select  class="form-control" name="optionStudent[]" multiple="multiple">
                @foreach($users as $user)
                    <option value="{{ $user['id'] }}">{{ $user['name'].' '.$user['family'] }}</option>
                @endforeach
            </select>
        </div>
        <button class="btn btn-success btn-block">Add Student</button>
@endsection
