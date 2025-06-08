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
@endsection