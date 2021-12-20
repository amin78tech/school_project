@extends("dashboard.layouts.dashboard")
@section("content")
    <div class="row">

        <!-- /.col-lg-12 -->
    </div>
    @if(isset($test))
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading" style="display: flex !important;">
                        All Test
                    </div>
                    <!-- /.panel-heading -->
                    @foreach($test as $num=>$item)
                        @php
                            $get_opt=$item[0]->option()->get();
                            $count_opt=count($get_opt);
                        @endphp
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover" style="text-align: center!important;">
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
                                    <tr>
                                        <td>{{ $item[0]['title'] }}</td>
                                        @for($i=0;$i<$count_opt;$i++)
                                            <td style="text-align: center !important;">{{ $get_opt[$i]['option_value'] }}</td>
                                        @endfor
                                        <td style="display: flex; justify-content: center">
                                            <form method="post" action="{{ route('QuestionsController.delete',['id'=>$item[0]['bank_id']]) }}">
                                                @method('DELETE')
                                                @csrf
                                                <button type="submit" class="btn btn-sm btn-danger fa fa-trash"></button>
                                            </form>
                                            <form method="post" action="{{ route('QuestionsController.editTestShow',['id'=>$item[0]['bank_id']]) }}">
                                                @csrf
                                                <button type="submit" class="btn btn-sm btn-primary fa fa-edit" style="margin-left: 1.4rem !important;"></button>
                                            </form>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <!-- /.table-responsive -->
                    </div>
                @endforeach
                    <!-- /.panel-body -->
                </div>
                <!-- /.panel -->
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading" style="display: flex !important;">
                        All descriptive
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover" style="text-align: center!important;">
                                <thead>
                                <tr>
                                    <th style="text-align: center !important;">Question</th>
                                    <th style="text-align: center !important;">operator</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($descriptive as $item)
                                    <tr>
                                        <td>{{ $item[0]['title'] }}</td>
                                        <td style="display: flex; justify-content: center">
                                            <form method="post" action="{{ route('QuestionsController.delete',['id'=>$item[0]['bank_id']]) }}">
                                                @method('DELETE')
                                                @csrf
                                                <button type="submit" class="btn btn-sm btn-danger fa fa-trash"></button>
                                            </form>
                                            <form method="post" action="{{ route('QuestionsController.editDescriptiveShow',['id'=>$item[0]['bank_id']]) }}">
                                                @csrf
                                                <button type="submit" class="btn btn-sm btn-primary fa fa-edit" style="margin-left: 1.4rem !important;"></button>
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
