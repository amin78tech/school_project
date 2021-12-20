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
                        <form method="get" action="{{ route('ExamsController.addExamShow',['id'=>$course_id]) }}">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-success fa fa-plus-square" style="margin-left: 1.4rem !important;"> Add Exam</button>
                        </form>
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
                                            <form method="post" action="{{ route('ExamsController.delete',['id'=>$exam['id']]) }}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger fa fa-trash" style="margin-left: 1.4rem !important;"></button>
                                            </form>
                                            <form method="get" action="{{ route('ExamsController.editExam',['id'=>$exam['id']]) }}">
                                                @csrf
                                                <button type="submit" class="btn btn-sm btn-primary fa fa-edit" style="margin-left: 1.4rem !important;"></button>
                                            </form>
                                            <form method="get" action="{{ route('ExamsController.showQuizQuestion',['id'=>$exam['id']]) }}">
                                                @csrf
                                                <button type="submit" class="btn btn-sm btn-warning fa fa-tasks" style="margin-left: 1.4rem !important;"></button>
                                            </form>
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
