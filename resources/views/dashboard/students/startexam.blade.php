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
    <meta class="csrf_token" content="{{ csrf_token() }}" />
    <input type="hidden" class="getUserId" value="{{ \Illuminate\Support\Facades\Auth::user()->id }}">
    <input type="hidden" class="getExamId" value="{{ $exam_id }}">
    <!-- add -->
    <form action="{{ route('StudentController.storeQuestionInExam',['exam_id'=>$exam_id,'student_id'=>auth()->user()->id]) }}" method="post">
        @csrf
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading" style="display: flex !important;">
                        Your question in exam<br>
                    </div>
                    <div class="panel-heading" style="display: flex !important;">
                        <span class="exam_time">{{ $time }}</span>
                    </div>
                    <!-- /.panel-heading -->
                    @php
                        $get_count_test=count($test);
                    @endphp
                    @foreach($test as $num=>$item)
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
                                        <th style="text-align: center !important;">question</th>
                                        @for($i=1;$i<=$count_opt;$i++)
                                            <th style="text-align: center !important;">option {{ $i }}</th>
                                        @endfor
                                        <th style="text-align: center !important;">Operator</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <form action="{{ route('StudentController.storeQuestionInExam',['exam_id'=>$exam_id,'student_id'=>auth()->user()->id]) }}" method="post">
                                        @csrf
                                    <tr>
                                        @php
                                            $respone=\App\Models\Respon::query()->where('user_id',Auth::user()->id)->where('exam_id',$exam_id)->where('bank_id',$item['bank_id'])->select('respon')->get()->toArray();
                                            $opt_res_all=[];
                                            foreach ($respone as $i){
                                            $opt_res_all[]=explode(',',$i['respon']);
                                                }
                                            $opt_res_num=[];
                                            foreach ($opt_res_all as $j){
                                            $opt_res_num[]=intval($j[1])-1;
                                            }
                                        @endphp
                                        <td>{{ $item['title'] }}</td>
                                        @for($i=0;$i<$count_opt;$i++)
                                            @php
                                              $num=$i;
                                                ++$num;
                                            @endphp
                                            @if(in_array($i,$opt_res_num))
                                                <input type="hidden" value="{{ $get_opt[$i]['option_value'].",".$num }}" name="testAns[]">
                                                <td style="text-align: center !important;"><input type="checkbox" value="{{ $item['bank_id'] }}" name="question[]" onclick="activeInputAns(event)" checked>{{ $get_opt[$i]['option_value'] }}</td>
                                            @else
                                                <input type="hidden" value="{{ $get_opt[$i]['option_value'].",".$num }}" name="testAns[]" disabled>
                                                <td style="text-align: center !important;"><input type="checkbox" value="{{ $item['bank_id'] }}" name="question[]" onclick="activeInputAns(event)">{{ $get_opt[$i]['option_value'] }}</td>
                                            @endif
                                        @endfor
                                            <td><button class="btn btn-success" type="submit" onclick="getTime()">save</button></td>
                                    </tr>
                                    </form>
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
                                    <th style="text-align: center !important;">Your Answare</th>
                                    <th style="text-align: center !important;">Operator</th>
                                </tr>
                                </thead>
                                <tbody>
                                <form action="{{ route('StudentController.storeQuestionInExamDes',['exam_id'=>$exam_id,'student_id'=>auth()->user()->id]) }}" method="post">
                                    @csrf
                                @foreach($descriptives as $item=>$row)
                                    @php
                                        $respone=\App\Models\Respon::query()->where('user_id',Auth::user()->id)->where('exam_id',$exam_id)->where('bank_id',$row['bank_id'])->select('respon')->get()->toArray();
                                    @endphp
                                    <tr>
                                        <input type="hidden" value="{{ $row['bank_id'] }}" name="question[]">
                                        <td>{{ $row['title'] }}</td>
                                        <td>
                                            <input type="text" class="form-control" name="desAns[]" value="{{ ($respone) ? $respone[$item]['respon'] : null }}">
                                        </td>
                                        <td>
                                            <button type="submit" class="btn btn-success" onclick="getTime()">save</button>
                                        </td>
                                    </tr>
                                @endforeach
                                </form>
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
    </form>
    <form action="{{ route('StudentController.downExam',['id'=>$exam_id]) }}" method="get">
        @csrf
        <button type="submit" class="btn btn-success btn-block">Done</button>
    </form>
@endsection
