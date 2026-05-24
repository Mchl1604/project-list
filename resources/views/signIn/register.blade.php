@extends('layouts.loginRegisterApp')

@section('title', 'Projects')

@section('content')

    <div class="card mx-auto mt-4" style="max-width: 400px;">
        <h1 class="card-title text-center text-success mt-3">Register</h1>
        <div class="card-body">
            <form method="POST" action="{{ route('register.store') }}">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label text-success">Full Name</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label text-success">Email address</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label text-success">Password</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <div class="mb-3">
                    <label for="password_confirmation" class="form-label text-success">Confirm Password</label>
                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
                </div>
                @if ($errors->any())
                <ul>
                    @foreach ($errors->all() as $error)
                        <li class="text-danger" style="list-style-type: none;">{{ $error }}</li>
                    @endforeach
                </ul>
            @endif
                <button type="submit" class="btn w-100 btn-success">Register</button>
                <p class="text-center mt-3">
                    Already have an account? <a href="{{ route('login.index') }}" class="text-success">Login here</a>
                </p>
            </form>
            
        </div>
    </div>

@endsection
