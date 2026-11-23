@extends('layouts.app')

@section('title', 'Create Account - GameTech')

@section('content')

<div class="auth-container">

    <div class="panel auth-card">

        <div class="auth-header">
            <h1>Create Your Account</h1>

            <p>
                Join GameTech to shop gaming
                accessories and manage your orders.
            </p>
        </div>

        <form action="{{ route('register') }}"
              method="POST">

            @csrf

            <div class="form-group">
                <label for="name">
                    Full Name
                </label>

                <input type="text"
                       id="name"
                       name="name"
                       value="{{ old('name') }}"
                       class="form-control"
                       placeholder="Enter your full name"
                       autocomplete="name"
                       maxlength="255"
                       required>
            </div>

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
                       maxlength="255"
                       required>
            </div>

            <div class="form-group">
                <label for="password">
                    Password
                </label>

                <input type="password"
                       id="password"
                       name="password"
                       class="form-control"
                       placeholder="Create a password"
                       autocomplete="new-password"
                       minlength="8"
                       required>

                <small class="form-help">
                    Password must be at least 8 characters.
                </small>
            </div>

            <div class="form-group">
                <label for="password_confirmation">
                    Confirm Password
                </label>

                <input type="password"
                       id="password_confirmation"
                       name="password_confirmation"
                       class="form-control"
                       placeholder="Confirm your password"
                       autocomplete="new-password"
                       minlength="8"
                       required>
            </div>

            <button type="submit"
                    class="btn auth-submit">
                Create Account
            </button>

        </form>

        <div class="auth-footer">

            <p>
                Already have an account?
                <a href="{{ route('login') }}">
                    Sign In
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
