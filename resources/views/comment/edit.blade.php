@extends('layouts.app')
@section('content')
<div class="container">
    <form class="card" action="{{route('comment.update', ['comment' => $comment])}}" method="POST">
        @csrf
        @method('put')
        <header class="card-header">
            Edit Comment
        </header>
        <div class="card-body">
            @error('post_id')
                    <span class="text-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
            @enderror
            <small>Title: {{$comment->post->title}}</small><br>
            <small>Actor: {{$comment->post->user->name}}</small><hr>
            <div class="form-group">
              <label for="title">Title</label>
              <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" id="title" value="{{ old('title') ?? $comment->title }}" required>
                @error('title')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="body">Body</label>
                <textarea rows="5" class="form-control @error('body') is-invalid @enderror" name="body" id="body" required>{{ old('body') ?? $comment->title }}</textarea>
                  @error('body')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
              </div>
        </div>
        <div class="card-footer text-muted">
            <button type="submit" class="btn btn-success">Save</button>
            <a href="{{URL::previous()}}" class="btn btn-link">Back</a>
        </div>
    </form>
</div>
@endsection
