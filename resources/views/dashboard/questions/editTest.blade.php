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
    <form role="form" action="{{ route('QuestionsController.editTestStore',['id'=>$test[0]['id']]) }}" method="post">
        @csrf
        <div class="form-group input-group">
            <span class="input-group-addon">Title</span>
            <input type="text" class="form-control" name="title" value="{{ $test[0]['title'] }}">
        </div>
        <div class="form-group input-group">
            <span class="input-group-addon">Score</span>
            <input type="text" class="form-control" name="score" value="{{ $test[0]['score'] }}">
        </div>
        <div class="form-group input-group">
            @php
                $get_count_opt=count($option);
            @endphp
            <span class="input-group-addon">Option</span>
            @for($i=0;$i<$get_count_opt;$i++)
                <input type="text" class="form-control" name="option[]" value="{{ $option[$i]['option_value'].','.$option[$i]['true_false'] }}">
            @endfor
        </div>
        <button class="btn btn-success btn-block">Update</button>
@endsection
