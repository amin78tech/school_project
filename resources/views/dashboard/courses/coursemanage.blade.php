@extends("dashboard.layouts.dashboard")
@section("content")
        <div class="row">
            <div class="col-lg-8">
                <div class="panel panel-default">
                    <div class="panel-heading" style="display: flex">
                        All Student In Course
                        <form method="post" action="{{ route("CoursesController.addUser",["id"=>$courseId]) }}">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-success fa fa-user-plus" style="margin-left: 1.4rem !important;"> Add Student</button>
                        </form>
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover" style="text-align: center!important;">
                                <thead>
                                <tr>
                                    <th style="text-align: center !important;">ID</th>
                                    <th style="text-align: center !important;">Name</th>
                                    <th style="text-align: center !important;">Family</th>
                                    <th style="text-align: center !important;">Username</th>
                                    <th style="text-align: center !important;">Email</th>
                                    <th style="text-align: center !important;">Operator</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($users as $users)
                                    <tr>
                                        <td>{{ $users['id'] }}</td>
                                        <td>{{ $users['name'] }}</td>
                                        <td>{{ $users['family'] }}</td>
                                        <td>{{ $users['username'] }}</td>
                                        <td>{{ $users['email'] }}</td>
                                        <td style="display: flex; justify-content: center">
                                            <form method="post" action="{{ route("CoursesController.deleteUser",["id"=>$users['id']]) }}">
                                                @method('DELETE')
                                                @csrf
                                                <button type="submit" class="btn btn-sm btn-danger fa fa-user-times"></button>
                                            </form>

                                        <form method="get" action="{{ route("UserController.edit",["id"=>$users["id"]]) }}">
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
            <div class="col-lg-3">
                <div class="panel panel-default">
                    <div class="panel-heading" style="display: flex">
                        Your Teacher InCourse
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body" style="text-align: center">
                        <h3>{{ $teacher[0]['name']." ".$teacher[0]['family'] }}</h3>
                        <div class="table-responsive">
                            <form method="post" action="{{ route("CoursesController.show",["id"=>$teacher[0]['id'],"idCourse"=>$courseId]) }}">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-warning fa fa-edit">Change</button>
                            </form>
                        </div>
                        <!-- /.table-responsive -->
                    </div>
                    <!-- /.panel-body -->
                </div>
                <!-- /.panel -->
            </div>
        </div>

@endsection
