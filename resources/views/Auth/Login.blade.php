@extends('layouts.auth')

@section('title', 'Login - SIAPABAJA')

@section('content')
@php
  // role default ppk, bisa diganti via /login?role=unit
  $role = request('role', 'ppk');
  $showError = request()->boolean('error'); // tampilkan banner kalau ada ?error=1
@endphp

<section class="login-figma">
  <div class="login-figma-bg">

    {{-- Banner error --}}
    @if($showError || session('error'))
      <div class="login-error">
        {{ session('error') ?? 'Username atau Password Salah!' }}
      </div>
    @endif

    <div class="login-figma-card">
      <h2 class="login-figma-title">Masuk</h2>

      <p class="login-figma-desc">
        Silakan masukkan email dan kata sandi Anda untuk melanjutkan.
      </p>

      {{-- ✅ REAL LOGIN: POST ke server --}}
      <form class="login-figma-form" id="loginForm" action="{{ route('login.post', ['role' => $role]) }}" method="POST">
        @csrf
        <input type="hidden" name="role" value="{{ $role }}">

        <div class="fg">
          <label>Email</label>
          <input
            type="email"
            id="email"
            name="email"
            placeholder="esteban.schiller@gmail.com"
            autocomplete="email"
            value="{{ old('email') }}"
            required
          >
        </div>

        <div class="fg">
          <label>Kata Sandi</label>
          <input
            type="password"
            id="password"
            name="password"
            placeholder="••••••••"
            autocomplete="current-password"
            required
          >
        </div>

        <label class="fg-remember">
          <input type="checkbox" name="remember">
          <span>Ingat Kata Sandi</span>
        </label>

        <button class="fg-btn" type="submit">Masuk</button>

        <a class="fg-back" href="{{ url('/') }}">
          ‹ Kembali
        </a>
      </form>
    </div>
  </div>
</section>
@endsection
