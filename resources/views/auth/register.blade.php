@extends('layouts.auth')

@section('title', 'Buat Akun')

@section('content')
    <p class="form-eyebrow">Mulai perjalananmu</p>
    <h1>Buat akun baru</h1>
    <p class="form-intro">Daftar untuk mulai menggunakan Ruang Karya.</p>

    @if ($errors->any())
        <div class="alert" role="alert">{{ $errors->first() }}</div>
    @endif

    <form method="POST" action="{{ route('register.store') }}">
        @csrf
        <div class="field">
            <label for="name">Nama lengkap</label>
            <input
                id="name"
                name="name"
                type="text"
                value="{{ old('name') }}"
                placeholder="Nama kamu"
                required
                autocomplete="name"
                @error('name') aria-invalid="true" aria-describedby="name-error" @enderror
            >
            @error('name')
                <p class="field-error" id="name-error">{{ $message }}</p>
            @enderror
        </div>

        <div class="field">
            <label for="email">Email</label>
            <input
                id="email"
                name="email"
                type="email"
                value="{{ old('email') }}"
                placeholder="nama@email.com"
                required
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
                placeholder="Minimal 8 karakter"
                required
                autocomplete="new-password"
                @error('password') aria-invalid="true" aria-describedby="password-error" @enderror
            >
            @error('password')
                <p class="field-error" id="password-error">{{ $message }}</p>
            @enderror
        </div>

        <div class="field">
            <label for="password_confirmation">Konfirmasi kata sandi</label>
            <input
                id="password_confirmation"
                name="password_confirmation"
                type="password"
                placeholder="Ulangi kata sandi"
                required
                autocomplete="new-password"
            >
        </div>

        <button class="submit-button" type="submit">Buat akun</button>
    </form>

    <p class="form-foot">Sudah punya akun? <a href="{{ route('login') }}">Masuk</a></p>
@endsection
