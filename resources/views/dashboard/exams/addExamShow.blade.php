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
    <form role="form" method="post" action="{{ route('ExamsController.addExamStore',['id'=>$course_id]) }}">
        @csrf
        <div class="form-group input-group">
            <span class="input-group-addon">Title</span>
            <input type="text" class="form-control" name="title">
        </div>
        <div class="form-group input-group">
            <span class="input-group-addon">Total Time Exam</span>
            <input type="number" class="form-control" name="time">
        </div>
        <div class="form-group input-group">
            <span class="input-group-addon">Start Date</span>
            <input type="date" class="form-control" name="startDate">
        </div>
        <div class="form-group input-group">
            <span class="input-group-addon">Time Start</span>
            <input type="time" class="form-control" name="startTime">
        </div>
        <div class="form-group input-group">
            <span class="input-group-addon">Time End</span>
            <input type="time" class="form-control" name="endTime">
        </div>
        <button class="btn btn-success btn-block">Create</button>
    </form>
@endsection
