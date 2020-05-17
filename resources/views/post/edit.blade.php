@extends('layouts.app')

@section('content')
<div class="container">
    <form class="card" action="{{route('post.update', ['post' => $post])}}" method="POST">
        @csrf
        @method('put')
        <header class="card-header">
            Edit Post
        </header>
        <div class="card-body">
            <div class="form-group">
              <label for="title">Title</label>
              <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" id="title" value="{{ old('title') ?? $post->title }}" required>
                @error('title')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="body">Body</label>
                <textarea rows="10" class="form-control @error('body') is-invalid @enderror" name="body" id="body" required>{{ old('body') ?? $post->body }}</textarea>
                  @error('body')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
              </div>
        </div>
        <div class="card-footer text-muted">
            <button type="submit" class="btn btn-success">Save</button>
            <a href="{{route('post.index')}}" class="btn btn-link">Back</a>
        </div>
    </form>
</div>
@endsection
