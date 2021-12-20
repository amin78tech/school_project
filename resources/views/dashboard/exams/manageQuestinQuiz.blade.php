@extends("dashboard.layouts.dashboard")
@section("content")
    @if($errors->all()!=null)
        @foreach ($errors->all() as $error)
            <div class="alert alert-danger alert-dismissible" style="text-align: right;margin-top: 1rem !important;" ;>
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                {{ $error }}
            </div>
        @endforeach
    @endif
    @csrf
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading" style="display: flex !important;">
                    your question in exam
                </div>
                <!-- /.panel-heading -->
                @php
                    $get_count_test=count($test);
                    $arr_score_test=[];
                    $arr_score_des=[];
                @endphp
                @foreach($test as $num=>$item)
                    @php
                        $get_opt=$item->option()->get();
                        $count_opt=count($get_opt);
                        $arr_score_test[]=$scoreTest[$num]['score'];
                    @endphp
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover"
                                   style="text-align: center!important;">
                                <thead>
                                <tr>
                                    <th style="text-align: center !important;">question</th>
                                    @for($i=1;$i<=$count_opt;$i++)
                                        <th style="text-align: center !important;">option {{ $i }}</th>
                                    @endfor
                                    <th style="text-align: center !important;">Score</th>
                                    <th style="text-align: center !important;">Operator</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>{{ $item['title'] }}</td>
                                    @for($i=0;$i<$count_opt;$i++)
                                        <td style="text-align: center !important;">{{ $get_opt[$i]['option_value'] }}</td>
                                    @endfor
                                    <td style="text-align: center !important;">{{ $scoreTest[$num]['score'] }}</td>
                                    <td style="display: flex; justify-content: center">
                                        <form method="post"
                                              action="{{ route('ExamsController.deleteQuestionInExam',['id'=>$item['bank_id']]) }}">
                                            @method('DELETE')
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-danger fa fa-trash"></button>
                                        </form>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <!-- /.table-responsive -->
                    </div>
                @endforeach
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover"
                               style="text-align: center!important;">
                            <thead>
                            <tr>
                                <th style="text-align: center !important;">question</th>
                                <th style="text-align: center !important;">score</th>
                                <th style="text-align: center !important;">Operator</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($descriptives as $item=>$row)
                                @php
                                    $arr_score_des[]=$scoreDescriptives[$item]['score'];
                                @endphp
                                <tr>
                                    <td>{{ $row['title'] }}</td>
                                    <td>{{ $scoreDescriptives[$item]['score'] }}</td>
                                    <td>
                                        <form method="post"
                                              action="{{ route('ExamsController.deleteQuestionInExam',['id'=>$row['bank_id']]) }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger fa fa-trash"
                                                    style="margin-left: 1.4rem !important;"></button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /.table-responsive -->
                    <div>Total Score in Exam: @php  echo array_sum($arr_score_test)+array_sum($arr_score_des)   @endphp</div>
                </div>

                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
    </div>

    <!-- add -->
    <form action="{{ route('ExamsController.addQuestionsInexam',['id'=>$exam_id]) }}" method="post">
        @csrf
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading" style="display: flex !important;">
                        Add question in exam
                    </div>
                    <!-- /.panel-heading -->
                    @php
                        $get_count_test=count($addTest);
                    @endphp
                    @foreach($addTest as $num=>$item)
                        @php
                            $get_opt=$item->option()->get();
                            $count_opt=count($get_opt);
                        @endphp
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover"
                                       style="text-align: center!important;">
                                    <thead>
                                    <tr>
                                        <th style="text-align: center !important;">Select</th>
                                        <th style="text-align: center !important;">question</th>
                                        @for($i=1;$i<=$count_opt;$i++)
                                            <th style="text-align: center !important;">option {{ $i }}</th>
                                        @endfor
                                        <th style="text-align: center !important;">Score (Defult)</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>
                                            <input type="checkbox" value="{{ $item['bank_id'] }}" name="question[]" onclick="removeDisable(event)">
                                        </td>
                                        <td>{{ $item['title'] }}</td>
                                        @for($i=0;$i<$count_opt;$i++)
                                            <td style="text-align: center !important;">{{ $get_opt[$i]['option_value'] }}</td>
                                        @endfor
                                        <td style="text-align: center !important;">
                                            <input type="number" value="{{ $item['score'] }}" class="form-control" name="score[]" disabled>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                        </div>
                    @endforeach
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover"
                                   style="text-align: center!important;">
                                <thead>
                                <tr>
                                    <th style="text-align: center !important;">Select</th>
                                    <th style="text-align: center !important;">question</th>
                                    <th style="text-align: center !important;">Score (Defult)</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($addDescriptives as $item=>$row)
                                    <tr>
                                        <td>
                                            <input type="checkbox" value="{{ $row['bank_id'] }}" name="question[]" onclick="removeDisable(event)">
                                        </td>
                                        <td>{{ $row['title'] }}</td>
                                        <td>
                                            <input type="number" value="{{ $row['score'] }}" class="form-control" name="score[]" onclick="this.disabled=false;" disabled>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- /.table-responsive -->
                    </div>

                    <!-- /.panel-body -->
                </div>
                <!-- /.panel -->
            </div>
        </div>
        <button type="submit" class="btn btn-success btn-block">Add</button>
    </form>


@endsection
