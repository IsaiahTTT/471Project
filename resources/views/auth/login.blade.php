@extends('layouts.app')

@section('title', 'Login - GameTech')

@section('content')

<div class="auth-container">

    <div class="panel auth-card">

        <div class="auth-header">
            <h1>Welcome Back</h1>

            <p>
                Sign in to your GameTech account
                to continue shopping.
            </p>
        </div>

        <form action="{{ route('login') }}"
              method="POST">

            @csrf

            <div class="form-group">
                <label for="email">
                    Email Address
                </label>

                <input type="email"
                       id="email"
                       name="email"
                       value="{{ old('email') }}"
                       class="form-control"
                       placeholder="Enter your email"
                       autocomplete="email"
                       required
                       autofocus>
            </div>

            <div class="form-group">
                <label for="password">
                    Password
                </label>

                <input type="password"
                       id="password"
                       name="password"
                       class="form-control"
                       placeholder="Enter your password"
                       autocomplete="current-password"
                       required>
            </div>

            <button type="submit"
                    class="btn auth-submit">
                Sign In
            </button>

        </form>

        <div class="auth-footer">
            <p>
                Don't have an account?
                <a href="{{ route('register') }}">
                    Create an Account
                </a>
            </p>

            <a href="{{ route('products.index') }}"
               class="auth-back-link">
                &larr; Back to Store
            </a>
        </div>

    </div>

</div>

@endsection
