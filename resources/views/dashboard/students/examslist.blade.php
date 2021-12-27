@extends("dashboard.layouts.dashboard")
@section("content")
    <div class="row">

        <!-- /.col-lg-12 -->
    </div>
    @if(isset($exams))
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading" style="display: flex !important;">
                        All Exams In Course
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover" style="text-align: center!important;">
                                <thead>
                                <tr>
                                    <th style="text-align: center !important;">Exam Name</th>
                                    <th style="text-align: center !important;">Start Date</th>
                                    <th style="text-align: center !important;">End Time</th>
                                    <th style="text-align: center !important;">Operation</th>

                                </tr>
                                </thead>
                                <tbody>
{{--                                {{ var_dump($descriptive) }}--}}
                                @foreach($exams as $exam)
                                    <tr>
                                        <td>{{ $exam['name'] }}</td>
                                        <td>{{ $exam['start_date'] }}</td>
                                        <td>{{ $exam['end_time'] }}</td>
                                        <td style="display: flex; justify-content: center">
                                            @php
                                                $get_status=\App\Models\Startexam::query()->where('exam_num',$exam['id'])->where('user_id',\Illuminate\Support\Facades\Auth::user()->id)->select('status')->get();
                                                $get_date=\App\Models\Exam::query()->where('id',$exam['id'])->get();
                                            @endphp
                                            @if($get_status[0]['status']==0)
                                                <form method="get" action="{{ route('StudentController.showQuestionInExam',['id'=>$exam['id']]) }}">
                                                    @csrf
                                                    <button type="submit" class="btn btn-sm btn-danger  fa fa-share" style="margin-left: 1.4rem !important;" disabled></button>
                                                </form>
                                            @elseif($get_status[0]['status']==1)
                                                <form method="get" action="{{ route('StudentController.showQuestionInExam',['id'=>$exam['id']]) }}">
                                                    @csrf
                                                    <button type="submit" class="btn btn-sm btn-success  fa fa-share" style="margin-left: 1.4rem !important;"></button>
                                                </form>
                                            @endif
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
         @endif
@endsection
