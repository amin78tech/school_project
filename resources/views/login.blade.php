<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>{{ $title }}</title>

        @include("dashboard.layouts.asset_style")
    </head>
    <body>

        <div class="container">
            <div class="row">
                <div class="col-md-4 col-md-offset-4">
                    <div class="login-panel panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">Please Login In</h3>
                        </div>
                        <div class="panel-body">
                            <form role="form" method="post" action="{{ route("UserLoginController.store") }}">
                                @csrf
                                <fieldset>
                                    <div class="form-group">
                                        <input class="form-control" placeholder="E-mail" name="email" type="email" autofocus>
                                    </div>
                                    <div class="form-group">
                                        <input class="form-control" placeholder="Password" name="password" type="password">
                                    </div>
                                    <div class="form-group">
                                        <label>Select Type</label>
                                        <label class="radio-inline">
                                            <input type="radio" name="option" id="optionsRadiosInline1" value="admin" checked>Admin
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" name="option" id="optionsRadiosInline2" value="teacher">Teacher
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" name="option" id="optionsRadiosInline3" value="student">Student
                                        </label>
                                    </div>
                                    <button type="submit" class="btn btn-success btn-block">Login</button>
                                </fieldset>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-4" style="margin-top: 8% !important;">
                    @if($errors->all()!=null)
                        @foreach ($errors->all() as $error)
                            <div class="alert alert-danger alert-dismissible" style="text-align: right;margin-top: 1rem !important;";>
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                {{ $error }}
                            </div>
                        @endforeach
                    @endif
                </div>
                @if(isset($login_error))
                <div class="col-md-4" style="margin-top: 8% !important;">
                            <div class="alert alert-danger alert-dismissible" style="text-align: right;margin-top: 1rem !important;";>
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                {{ $login_error }}
                            </div>
                    @endif
                    @if(isset($status_error))
                        <div class="col-md-4" style="margin-top: 8% !important;">
                            <div class="alert alert-danger alert-dismissible" style="text-align: right;margin-top: 1rem !important;";>
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                {{ $status_error }}
                            </div>
                    @endif
                </div>
            </div>
        </div>

        @include("dashboard.layouts.asset_js")

    </body>
</html>
