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
    <form role="form" action="{{ route('QuestionsController.storeDescriptive') }}" method="post">
        @csrf
        <div class="form-group input-group">
            <span class="input-group-addon">Title</span>
            <input type="text" class="form-control" name="title">
        </div>
        <div class="form-group input-group">
            <span class="input-group-addon">Default Score</span>
            <input type="number" class="form-control" name="score">
        </div>
        <button class="btn btn-success btn-block">Create</button>
@endsection
