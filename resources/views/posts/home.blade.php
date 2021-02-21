@extends('layouts.app')

@section('content')
<div class="container">
    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif
    @if (session()->has('flash.message'))
        <div class="alert alert-{{ session('flash.class') }} alert-msg">
            {{ session('flash.message') }}
        </div>
    @endif
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card card-dark">
                {{-- <div class="card-header">Home</div> --}}
                <div class="card-body">
                    <form action="/store" method="post">
                    {{ csrf_field() }}
                    <textarea placeholder="Whats's happening?" name="text" class="form-control text-area"></textarea>
                    <button class="btn btn-info pull-right post-btn">Post</button>
                    </form>
                </div>
            </div>
            @foreach ($posts as $post)
            <div class="card">
                <div class="card-body">
                        <div class="d-inline">
                            <h5>
                                <i class="fa fa-user" aria-hidden="true"></i>&nbsp;{{$post->name}} 
                                <span class="time">
                                    @php $seconds = Carbon\Carbon::parse($post->created_at)->diffInSeconds() @endphp
                                    @if($seconds > 86400)
                                        {{ Carbon\Carbon::parse($post->created_at)->diffInDays() }}d
                                    @elseif($seconds > 3600)
                                        {{ Carbon\Carbon::parse($post->created_at)->diffInHours() }}h
                                    @elseif($seconds > 60)
                                        {{ Carbon\Carbon::parse($post->created_at)->diffInMinutes() }}m
                                    @else
                                        {{ Carbon\Carbon::parse($post->created_at)->diffInSeconds() }}s
                                    @endif
                                </span>
                            </h5>
                            
                        </div>
                        <p>{{$post->text}}</p>
                </div>
            </div>
            @endforeach
        </div>
        <div class="col-md-4">
            <form class="form-inline" action="/home" method="post">
                {{ csrf_field() }}
                <div class="form-group col-lg-10 mb-2 pr-0">
                    <input type="text" name="search" class="search_input" placeholder="Search" value="{{ $searchVal }}">
                </div>
                <button class="search_btn mb-2 mr-2"><i class="fa fa-search" aria-hidden="true"></i></button>
            </form>
            <div class="card">
                {{-- <div class="card-header">Users</div> --}}
                <div class="card-body">
                    @foreach ($users as $user)
                        <p><span class="userfollow">{{$user->name}}</span>
                            @php $followed = false @endphp
                            @if(count($user->followers)>0)
                                <a
                                href="
                                    @php $followIds = [] @endphp
                                    @foreach($user->followers as $follower)
                                        @php array_push($followIds,$follower->id) @endphp
                                    @endforeach
                                    @if(!in_array(Auth::user()->id,$followIds))
                                        /follow/{{$user->id}}
                                    @else
                                        @php $followed = true @endphp
                                        /unfollow/{{$user->id}}
                                    @endif"
                                    class="btn btn-info btn-xs pull-right follow-btn">
                                    @if($followed) Unfollow @else Follow @endif
                                </a>
                            @else
                                <a href="/follow/{{$user->id}}" class="btn btn-info btn-xs pull-right follow-btn">Follow</a>
                            @endif
                        </p>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
