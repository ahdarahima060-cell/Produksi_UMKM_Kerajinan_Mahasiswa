@extends('layouts.auth')

@section('title', 'Masuk')

@section('content')
    <p class="form-eyebrow">Senang melihatmu kembali</p>
    <h1>Masuk ke akun</h1>
    <p class="form-intro">Masukkan email dan kata sandi untuk melanjutkan.</p>

    @if ($errors->any())
        <div class="alert" role="alert">{{ $errors->first() }}</div>
    @endif

    <form method="POST" action="{{ route('login.store') }}">
        @csrf
        <div class="field">
            <label for="email">Email</label>
            <input
                id="email"
                name="email"
                type="email"
                value="{{ old('email') }}"
                placeholder="nama@email.com"
                required
                autofocus
                autocomplete="email"
                @error('email') aria-invalid="true" aria-describedby="email-error" @enderror
            >
            @error('email')
                <p class="field-error" id="email-error">{{ $message }}</p>
            @enderror
        </div>

        <div class="field">
            <label for="password">Kata sandi</label>
            <input
                id="password"
                name="password"
                type="password"
                placeholder="Masukkan kata sandi"
                required
                autocomplete="current-password"
                @error('password') aria-invalid="true" aria-describedby="password-error" @enderror
            >
            @error('password')
                <p class="field-error" id="password-error">{{ $message }}</p>
            @enderror
        </div>

        <button class="submit-button" type="submit">Masuk</button>
    </form>

    <p class="form-foot">Belum punya akun? <a href="{{ route('register') }}">Daftar sekarang</a></p>
@endsection
