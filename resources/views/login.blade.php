@extends('template.main')

@section('content')
    <div class="card-body">
        @if($errors->any())
            @foreach($errors->all() as $error)
                <div class="alert alert-danger"> {{ $error }} </div>
            @endforeach
        @endif
    </div>
    <div class="d-flex justify-content-center align-items-center pt-5">
        <form dclass="border p-4 rounded shadow" style="max-width: 400px; width: 100%;" method="POST" action="{{ route('login.submit' )}}">
            @csrf
            <h3 class="text-center mb-4">Login</h3>
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="email" class="form-control" id="username" name="username" placeholder="Enter your username">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password">
            </div>
            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="rememberMe">
                <label class="form-check-label" for="rememberMe">Remember me</label>
            </div>
            <button type="submit" class="btn btn-primary w-100">Login</button>
            <div class="text-center mt-3">
                <a href="#" class="text-decoration-none">Forgot password?</a>
            </div>
        </form>
    </div>
@endsection