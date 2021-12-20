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
    <form role="form" method="post" action="{{ route('ExamsController.editExamStore',['id'=>$exam[0]['id']]) }}">
        @csrf
        <div class="form-group input-group">
            <span class="input-group-addon">Title</span>
            <input type="text" class="form-control" name="title" value="{{ $exam[0]['name'] }}">
        </div>
        <div class="form-group input-group">
            <span class="input-group-addon">Total Time Exam</span>
            <input type="number" class="form-control" name="time" value="{{ $exam[0]['time'] }}">
        </div>
        <div class="form-group input-group">
            <span class="input-group-addon">Start Date</span>
            <input type="date" class="form-control" name="startDate" value="{{ $startDate }}">
        </div>
        <div class="form-group input-group">
            <span class="input-group-addon">Start Time</span>
            <input type="time" class="form-control" name="StartTime" value="{{ $startTime }}">
        </div>
        <div class="form-group input-group">
            <span class="input-group-addon">End Time</span>
            <input type="time" class="form-control" name="EndTime" value="{{ $endTime }}">
        </div>
{{--        <div class="row">--}}
{{--            <div class="col-lg-12">--}}
{{--                <div class="panel panel-default">--}}
{{--                    <div class="panel-heading" style="display: flex !important;">--}}
{{--                        All Test--}}
{{--                    </div>--}}
{{--                    <!-- /.panel-heading -->--}}
{{--                    <div class="panel-body">--}}
{{--                        <div class="table-responsive">--}}
{{--                            <table class="table table-striped table-bordered table-hover" style="text-align: center!important;">--}}
{{--                                <thead>--}}
{{--                                <tr>--}}
{{--                                    <th style="text-align: center !important;">Select</th>--}}
{{--                                    <th style="text-align: center !important;">question</th>--}}
{{--                                    <th style="text-align: center !important;">option 1</th>--}}
{{--                                    <th style="text-align: center !important;">option 2</th>--}}
{{--                                    <th style="text-align: center !important;">option 3</th>--}}
{{--                                    <th style="text-align: center !important;">option 4</th>--}}
{{--                                </tr>--}}
{{--                                </thead>--}}
{{--                                <tbody>--}}
{{--                                @foreach($test as $item=>$row)--}}
{{--                                    <tr>--}}
{{--                                        <td><input type="checkbox" value="{{ $row[0]['bank_id'] }}" name="question[]" onclick="addscoreT()"></td>--}}
{{--                                        <td>{{ $row[0]['title'] }}</td>--}}
{{--                                        <td>{{ $option[$item][0]['option_one'] }}</td>--}}
{{--                                        <td>{{ $option[$item][0]['option_two'] }}</td>--}}
{{--                                        <td>{{ $option[$item][0]['option_three'] }}</td>--}}
{{--                                        <td>{{ $option[$item][0]['option_four'] }}</td>--}}
{{--                                    </tr>--}}
{{--                                @endforeach--}}
{{--                                </tbody>--}}
{{--                            </table>--}}
{{--                        </div>--}}
{{--                        <!-- /.table-responsive -->--}}
{{--                        <div class="trAddTdT"></div>--}}
{{--                    </div>--}}
{{--                    <!-- /.panel-body -->--}}
{{--                </div>--}}
{{--                <!-- /.panel -->--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        </div>--}}
{{--            <div class="row">--}}
{{--                <div class="col-lg-12">--}}
{{--                    <div class="panel panel-default">--}}
{{--                        <div class="panel-heading" style="display: flex !important;">--}}
{{--                            All Descriptive--}}
{{--                        </div>--}}
{{--                        <!-- /.panel-heading -->--}}
{{--                        <div class="panel-body">--}}
{{--                            <div class="table-responsive">--}}
{{--                                <table class="table table-striped table-bordered table-hover" style="text-align: center!important;">--}}
{{--                                    <thead>--}}
{{--                                    <tr>--}}
{{--                                        <th style="text-align: center !important;">Select</th>--}}
{{--                                        <th style="text-align: center !important;">question</th>--}}
{{--                                    </tr>--}}
{{--                                    </thead>--}}
{{--                                    <tbody>--}}
{{--                                    @foreach($descriptive as $item)--}}
{{--                                        <tr>--}}
{{--                                            <td><input type="checkbox" value="{{ $item[0]['bank_id'] }}" name="question[]" onclick="addscoreT()"></td>--}}
{{--                                            <td>{{ $item[0]['title'] }}</td>--}}
{{--                                        </tr>--}}
{{--                                    @endforeach--}}
{{--                                    </tbody>--}}
{{--                                </table>--}}
{{--                            </div>--}}
{{--                            <!-- /.table-responsive -->--}}
{{--                        </div>--}}
{{--                        <!-- /.panel-body -->--}}
{{--                    </div>--}}
{{--                    <!-- /.panel -->--}}
{{--                </div>--}}
{{--            </div>--}}
        <button class="btn btn-success btn-block">Edit</button>
    </form>
@endsection
