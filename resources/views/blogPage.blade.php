@extends('template.main')

@section('content')
    <div class="container border bg-primary-subtle mt-3">
        <h1 class="mt-4">{{ $blog->title }}</h1>
        <p class="lead">{{ $blog->description }}</p>
        
        <div class="d-flex justify-content-end pb-3">
            <form action="{{ route('blogs.softDelete', $blog->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this blog?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Delete</button>
            </form>
        </div>
    </div>

    <div class="container mt-4">
        <form action="{{ route('blogs.comment', $blog->id) }}" method="POST">
            @csrf 
            <div class="mb-3">
                <label for="comment" class="form-label">Add a comment:</label>
                <textarea class="form-control" id="comment" name="comment" rows="2" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Post Comment</button>
        </form>
    </div>
@endsection