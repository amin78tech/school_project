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
                            <h3 class="panel-title">Please Register In</h3>
                        </div>
                        <div class="panel-body">
                            <form role="form" method="post" action="{{ route("UserRegisterController.store") }}">
                                @csrf
                                <fieldset>
                                    <div class="form-group">
                                        <input class="form-control" placeholder="Name" name="name" type="text" autofocus>
                                    </div>
                                    <div class="form-group">
                                        <input class="form-control" placeholder="Family" name="family" type="text" value="">
                                    </div>
                                    <div class="form-group">
                                        <input class="form-control" placeholder="Username" name="username" type="text" value="">
                                    </div>
                                    <div class="form-group">
                                        <input class="form-control" placeholder="E-mail" name="email" type="email" value="">
                                    </div>
                                    <div class="form-group">
                                        <input class="form-control" placeholder="Password" name="password" type="password" value="">
                                    </div>

                                    <div class="form-group">
                                        <label>Select Type:</label>
                                            @foreach($roles as $role)
                                                    @if($role['name']!=='admin')
                                                        <label class="radio-inline">
                                                        <input type="radio" name="option" id="{{ "optionsRadiosInline".$num++ }}" value="{{ $role['id'] }}" checked> {{ $role['name'] }}
                                                        </label>
                                                    @endif
                                             @endforeach
                                    </div>
                                    <button type="submit" class="btn btn-success btn-block btn-lg">Register</button>
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
            </div>
        </div>
    @include("dashboard.layouts.asset_js")
    </body>
</html>
