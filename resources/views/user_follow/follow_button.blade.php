@if(Auth::user() != $user)
    @if(Auth::user()->is_following($user->id))
        {!! Form::open(['route'=>['user.unfollow', $user->id], 'method'=>'DELETE']) !!}
            {!! Form::submit('UnFollow', ['class'=>'btn btn-danger btn-block']) !!}
        {!! Form::close() !!}
    @else
        {!! Form::open(['route'=>['user.follow', $user->id]]) !!}
            {!! Form::submit('Follow', ['class'=>'btn btn-primary btn-block']) !!}
        {!! Form::close() !!}
    @endif
@endif