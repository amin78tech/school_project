@extends("dashboard.layouts.dashboard")
@section("content")
    <div class="row">

        <!-- /.col-lg-12 -->
    </div>
    @if(isset($courses))
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading" style="display: flex !important;">
                        All Course
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover" style="text-align: center!important;">
                                <thead>
                                <tr>
                                    <th style="text-align: center !important;">Course</th>
                                    <th style="text-align: center !important;">Start Date</th>
                                    <th style="text-align: center !important;">End Date</th>
                                    <th style="text-align: center !important;">Operator</th>

                                </tr>
                                </thead>
                                <tbody>
{{--                                {{ var_dump($descriptive) }}--}}
                                @foreach($courses as $course)
                                    <tr>
                                        <td>{{ $course['title'] }}</td>
                                        <td>{{ $course['start_date'] }}</td>
                                        <td>{{ $course['end_date'] }}</td>
                                        <td style="display: flex; justify-content: center">
                                            <form method="get" action="{{ route('ExamsController.showExams',['id'=>$course['id']]) }}">
                                                @csrf
                                                <button type="submit" class="btn btn-sm btn-success fa fa-cog" style="margin-left: 1.4rem !important;"></button>
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
