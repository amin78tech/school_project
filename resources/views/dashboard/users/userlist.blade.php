@extends("dashboard.layouts.dashboard")
@section("content")
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Filter User
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <form role="form" style="display: flex;" method="post" action="{{ route("UsersController.show") }}">
                                @csrf
                            <div class="form-group input-group" style="margin-right: 3px !important;">
                                <span class="input-group-addon">Name</span>
                                <input type="text" class="form-control" name="name">
                            </div>
                            <div class="form-group input-group" style="margin-right: 3px !important;">
                                <span class="input-group-addon">Family</span>
                                <input type="text" class="form-control" name="family">
                            </div>
                            <div class="form-group input-group" style="margin-right: 3px !important;">
                                <span class="input-group-addon">Username</span>
                                <input type="text" class="form-control" name="username">
                            </div>
                                <div class="form-group" style="margin-right: 3px !important;">
                                    <select class="form-control" name="option">
                                        <option selected>select role user</option>
                                        <option value="teacher">teacher</option>
                                        <option value="student">student</option>
                                    </select>
                                </div>
                                <div class="form-group" style="margin-right: 3px !important;">
                                    <select class="form-control" name="status">
                                        <option selected>select status account</option>
                                        <option value="1">activate</option>
                                        <option value="0">inactive</option>
                                    </select>
                                </div>
                                <span class="input-group-btn" style="margin-right: 2px">
                                    <button class="btn btn-default" type="submit"><i class="fa fa-search"></i></button>
                                </span>
                        </form>
                        </div>
                    </div>
                    <!-- /.row (nested) -->
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-12 -->
    </div>
    @if(isset($users))
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        All Users
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
                                    <th style="text-align: center !important;">Role</th>
                                    <th style="text-align: center !important;">Status</th>
                                    <th style="text-align: center !important;">Operator</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($users as $user)
                                    <tr>
                                        <td>{{ $user['id'] }}</td>
                                        <td>{{ $user['name'] }}</td>
                                        <td>{{ $user['family'] }}</td>
                                        <td>{{ $user['username'] }}</td>
                                        <td>{{ $user['email'] }}</td>
                                        <td>
                                            @if($user['pivot']['role_id']==2)
                                                teacher
                                            @else
                                                student
                                            @endif
                                        </td>
                                        @if($user['status']==0)
                                            <td>
                                                <form method="post" action="{{ route("UserController.updateStatus",["id"=>$user["id"]]) }}">
                                                    @method('PUT')
                                                    @csrf
                                                    <input type="hidden" value="inactive" name="status">
                                                    <button type="submit" class="btn btn-sm btn-danger fa fa-toggle-off"></button>
                                                </form>
                                            </td>
                                        @else
                                            <td>
                                                <form method="post" action="{{ route("UserController.updateStatus",["id"=>$user["id"]]) }}">
                                                    @method('PUT')
                                                    @csrf
                                                    <input type="hidden" value="active" name="status">
                                                    <button type="submit" class="btn btn-sm btn-success fa fa-toggle-on"></button>
                                                </form>
                                            </td>
                                        @endif
                                        <td style="display: flex; justify-content: center">
                                            <form method="post" action="{{ route("UserController.destroy",["id"=>$user["id"]]) }}">
                                                @method('DELETE')
                                                @csrf
                                                <button type="submit" class="btn btn-sm btn-danger fa fa-trash"></button>
                                            </form>
                                            <form method="get" action="{{ route("UserController.edit",["id"=>$user["id"]]) }}">
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
    @else
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        All Users
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
                                    <th style="text-align: center !important;">Role</th>
                                    <th style="text-align: center !important;">Status</th>
                                    <th style="text-align: center !important;">Operator</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach($searchUser as $users)
                                        <tr>
                                            <td>{{ $users['id'] }}</td>
                                            <td>{{ $users['name'] }}</td>
                                            <td>{{ $users['family'] }}</td>
                                            <td>{{ $users['username'] }}</td>
                                            <td>{{ $users['email'] }}</td>
                                            <td>
                                                @if(isset($role))
                                                        @if($role[0]['pivot']['role_id']==2)
                                                            teacher
                                                        @else
                                                            student
                                                        @endif
                                                @else
                                                    @if( $users['pivot']['role_id']==2 )
                                                        teacher
                                                    @else
                                                        student
                                                        @endif
                                                @endif
                                            </td>
                                            @if($users['status']==0)
                                                <td>
                                                    <form method="post" action="{{ route("UserController.updateStatus",["id"=>$users['id']]) }}">
                                                        @method('PUT')
                                                        @csrf
                                                        <input type="hidden" value="inactive" name="status">
                                                        <button type="submit" class="btn btn-sm btn-danger fa fa-toggle-off"></button>
                                                    </form>
                                                </td>
                                            @else
                                                <td>
                                                    <form method="post" action="{{ route("UserController.updateStatus",["id"=>$users['id']]) }}">
                                                        @method('PUT')
                                                        @csrf
                                                        <input type="hidden" value="active" name="status">
                                                        <button type="submit" class="btn btn-sm btn-success fa fa-toggle-on"></button>
                                                    </form>
                                                </td>
                                            @endif
                                            <td style="display: flex; justify-content: center">
                                                <form method="post" action="{{ route("UserController.destroy",["id"=>$users['id']]) }}">
                                                    @method('DELETE')
                                                    @csrf
                                                    <button type="submit" class="btn btn-sm btn-danger fa fa-trash"></button>
                                                </form>
                                                <form method="get" action="{{ route("UserController.edit",["id"=>$users['id']]) }}">
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
