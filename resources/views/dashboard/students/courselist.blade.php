@extends("dashboard.layouts.dashboard")
@section("content")
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        All Course
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover" style="text-align: center!important;">
                                <thead>
                                <tr>
                                    <th style="text-align: center !important;">ID</th>
                                    <th style="text-align: center !important;">Name</th>
                                    <th style="text-align: center !important;">Start Date</th>
                                    <th style="text-align: center !important;">End Date</th>
                                    <th style="text-align: center !important;">operator</th>

                                </tr>
                                </thead>
                                <tbody>
                                @foreach($courses as $course)
                                    <tr>
                                        <td>{{ $course['id'] }}</td>
                                        <td>{{ $course['title'] }}</td>
                                        <td>{{ $course['start_date'] }}</td>
                                        <td>{{ $course['end_date'] }}</td>
                                        <td style="display: flex; justify-content: center">
                                            <form method="get" action="{{ route("StudentController.showExamsCourse",["id"=>$course['id']]) }}">
                                                @csrf
                                                <button type="submit" class="btn btn-sm btn-warning fa fa-tasks" style="margin-left: 1.4rem !important;"></button>
                                            </form>
                                        </td>
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
@endsection
