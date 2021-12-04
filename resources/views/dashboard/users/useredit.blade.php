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
    <form role="form" action="{{ route("UserController.update",["id"=>$id]) }}" method="post">
        @csrf
        <div class="form-group input-group">
            <span class="input-group-addon">Name</span>
            <input type="text" class="form-control" value="{{ $name }}" name="name">
        </div>
        <div class="form-group input-group">
            <span class="input-group-addon">Family</span>
            <input type="text" class="form-control" value="{{ $family }}" name="family">
        </div>
        <div class="form-group input-group">
            <span class="input-group-addon">Username</span>
            <input type="text" class="form-control" value="{{ $username }}" name="username">
        </div>
        <div class="form-group input-group">
            <span class="input-group-addon">E-mail</span>
            <input type="text" class="form-control" value="{{ $email }}" name="email">
        </div>
        <div class="form-group input-group">
            <span class="input-group-addon">Password</span>
            <input type="text" class="form-control" value="{{ $password }}" name="password">
        </div>
        <div class="form-group">
            <label>Change Type User</label>
            @if($role=="student")
                <label class="radio-inline">
                    <input type="radio" name="option" id="optionsRadiosInline1" value="{{ $role }}" checked>Student
                </label>
                <label class="radio-inline">
                    <input type="radio" name="option" id="optionsRadiosInline2" value="teacher">Teacher
                </label>
            @else
                <label class="radio-inline">
                    <input type="radio" name="option" id="optionsRadiosInline1" value="{{ $role }}" checked>Teacher
                </label>
                <label class="radio-inline">
                    <input type="radio" name="option" id="optionsRadiosInline2" value="student">Student
                </label>
            @endif
        </div>
        <button class="btn btn-success btn-block">update</button>
@endsection
