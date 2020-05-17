@extends('layouts.app')

@section('content')
<div class="container">
    <a href="{{route('post.index')}}" class="btn btn-link"><- Back to post</a>
    <div class="card border-0 shadow">
        <header class="card-header font-weight-bold">
            {{ $post->title }}
        </header>
        <div class="card-body">
            {{ $post->body }}
            <hr>
            <div class="text-muted small">
                Actor: {{$post->user->name}}<br>
                Posted: {{$post->created_at}}
            </div>
        </div>
    </div>
</div>
@include('comment.component')
@endsection