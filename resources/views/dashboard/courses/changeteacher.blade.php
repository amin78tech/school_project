@extends("dashboard.layouts.dashboard")
@section("content")
    <div class="row">
        <div class="col-lg-8">
            <div class="panel panel-default">
                <div class="panel-heading" style="display: flex">
                    All Student In Course
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover" style="text-align: center!important;">
                            <tbody>
                            <form action="{{ route("CoursesController.store",["id"=>$idCourse]) }}" method="post">
                                @csrf
                                <div class="form-group">
                                    <label>Selects Teacher</label>
                                    <select class="form-control" name="teacher">
                                        @foreach($teachers as $teacher)
                                            <option value="{{ $teacher['id'] }}">{{ $teacher['name']." ".$teacher['family'] }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-success">update teacher</button>
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

@endsection
