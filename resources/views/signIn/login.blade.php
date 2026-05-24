@extends('layouts.loginRegisterApp')

@section('title', 'Projects')

@section('content')

    <div class="card mx-auto mt-4" style="max-width: 400px;">
        <h1 class="card-title text-center text-success mt-3">Login</h1>
        <div class="card-body">
            <form method="POST" action="{{ route('login.main') }}">
                @csrf
                <div class="mb-3">
                    <label for="email" class="form-label text-success">Email address</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label text-success">Password</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                @if ($errors->any())
                <ul>
                    @foreach ($errors->all() as $error)
                        <li class="text-danger" style="list-style-type: none;">{{ $error }}</li>
                    @endforeach
                </ul>
            @endif
                <button type="submit" class="btn w-100 btn-success">Login</button>
                <p class="text-center mt-3">
                    Don't have an account? <a href="{{ route('register.index') }}" class="text-success">Register here</a>
                </p>
            </form>
        </div>
    </div>

@endsection
