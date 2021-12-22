@extends("dashboard.layouts.dashboard")
@section("content")
    <div class="row">
        <div class="col-lg-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Alert Styles
                </div>
                <div class="panel-body">
                @foreach(auth()->user()->notifications as $notif)
                        @if($notif['read_at']==null)
                            <div class="alert alert-success" style="text-align: center">
                            {!! $notif['data']['notice'] !!}  <a href="{{ route('NotificationsController.read',['id'=>$notif['id']]) }}" class="alert-link"> متوجه شدم</a>
                            </div>
                        @endif
                @endforeach
                </div>
            </div>
        </div>

    </div>
@endsection
