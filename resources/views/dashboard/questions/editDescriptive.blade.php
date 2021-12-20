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
            <form role="form" action="{{ route('QuestionsController.editDescriptiveStore',['id'=>$descriptive[0]['bank_id']]) }}" method="post">
                @csrf
                <div class="form-group input-group">
                    <span class="input-group-addon">Title</span>
                    <input type="text" class="form-control" name="title" value="{{ $descriptive[0]['title'] }}">
                </div>
                <div class="form-group input-group">
                    <span class="input-group-addon">Score</span>
                    <input type="text" class="form-control" name="score" value="{{ $descriptive[0]['score'] }}">
                </div>
                <button class="btn btn-success btn-block">update</button>
@endsection
