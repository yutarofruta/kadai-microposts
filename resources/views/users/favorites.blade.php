@extends('layouts.app')

@section('content')
    <div class="row">
        <aside class="col-sm-4">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{{ $user->name }}</h3>
                </div>
                <div class="card-body">
                    <img class="rounded img-fluid" src="{{ Gravatar::src($user->email, 500) }}" alt="">
                </div>
            </div>
            @include('user_follow.follow_button', ['user' => $user])
        </aside>
        <div class="col-sm-8">
            <ul class="nav nav-tabs nav-justified mb-3">
                <li class="nav-item"><a href="{{ route('users.show', ['id' => $user->id]) }}" class="nav-link {{ Request::is('users/' . $user->id) ? 'active' : '' }}">TimeLine <span class="badge badge-secondary">{{ $count_microposts }}</span></a></li>
                <li class="nav-item"><a href="{{ route('users.followings', ['id' => $user->id]) }}" class="nav-link {{ Request::is('users/*/followings') ? 'active' : '' }}">Followings <span class="badge badge-secondary">{{ $count_followings }}</span></a></li>
                <li class="nav-item"><a href="{{ route('users.followers', ['id' => $user->id]) }}" class="nav-link {{ Request::is('users/*/followers') ? 'active' : '' }}">Followers <span class="badge badge-secondary">{{ $count_followers }}</span></a></li>
                <li class="nav-item"><a href="{{ route('users.favorites', ['id' => $user->id]) }}" class="nav-link {{ Request::is('users/*/favorites') ? 'active' : '' }}">Favorites <span class="badge badge-secondary"></span></a></li>
            </ul>
            <ul class="media-list">
            @foreach ($favorites as $micropost)
                <li class="media mb-3">
                    <img class="mr-2 rounded" src="{{ Gravatar::src($micropost->user->email, 50) }}" alt="">
                    <div class="media-body">
                        <div>
                            {!! link_to_route('users.show', $micropost->user->name, ['id' => $micropost->user->id]) !!} <span class="text-muted">posted at {{ $micropost->created_at }}</span>
                        </div>
                        <div>
                            <p class="mb-0">{!! nl2br(e($micropost->content)) !!}</p>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                @include('favorites.favorite_button', ['micropost'=>$micropost])
                            </div>
                            <div class="col-6">
                                @if (Auth::id() == $micropost->user_id)
                                {!! Form::open(['route' => ['microposts.destroy', $micropost->id], 'method' => 'delete']) !!}
                                    {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-sm']) !!}
                                {!! Form::close() !!}
                                @endif
                            </div>
                        </div>
                    </div>
                </li>
            @endforeach
            </ul>
            {{ $favorites->render('pagination::bootstrap-4') }}
        </div>
    </div>
@endsection