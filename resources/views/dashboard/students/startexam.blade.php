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
    <!-- add -->
    <form action="{{ route('ExamsController.addQuestionsInexam',['id'=>$exam_id]) }}" method="post">
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
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>{{ $item['title'] }}</td>
                                        @for($i=0;$i<$count_opt;$i++)
                                            <td style="text-align: center !important;"><input type="checkbox" value="{{ $item['bank_id'] }}" name="question[]">{{ $get_opt[$i]['option_value'] }}</td>
                                        @endfor
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
                                    <th style="text-align: center !important;">Your Answare</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($descriptives as $item=>$row)
                                    <tr>
                                        <input type="hidden" value="{{ $row['bank_id'] }}" name="question[]">
                                        <td>{{ $row['title'] }}</td>
                                        <td>
                                            <input type="text" class="form-control" name="answer[]">
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
        <button type="submit" class="btn btn-success btn-block">Send</button>
    </form>
@endsection
