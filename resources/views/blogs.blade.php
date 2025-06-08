@extends('template.main')

@section('content')
    <div class="container">
        <div class="row">
            @foreach ($blogs as $blog)
            <div class="card m-1" style="width: 18rem;">
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title">{{ $blog->title }}</h5>
                    <h6 class="card-subtitle mb-2 text-body-secondary">{{ $blog->category }}</h6>
                    <p class="card-text">{{ \Illuminate\Support\Str::limit($blog->description, 100) }}</p>
                    <div class="mt-auto">
                        @if ($blog->status == 'Published')
                            <a href="#" class="card-link">Card link</a>
                            <a href="#" class="card-link">Another link</a>
                        @else
                            <span>{{ $blog->status }}</span>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
@endsection