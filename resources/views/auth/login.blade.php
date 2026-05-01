@extends('layouts.app')

@section('title', 'Login - PELITA 016')

@section('content')
<div class="min-h-screen flex items-center justify-center py-20 px-4">
    <div class="max-w-md w-full bg-white rounded-2xl shadow-2xl p-8" data-aos="fade-up">
        <div class="text-center mb-8">
            <div class="w-20 h-20 bg-gradient-to-r from-green-500 to-emerald-600 rounded-full flex items-center justify-center mx-auto mb-4">
                <i class="fas fa-recycle text-white text-3xl"></i>
            </div>
            <h2 class="text-3xl font-bold gradient-text">Login PELITA 016</h2>
            <p class="text-gray-600 mt-2">Masuk ke akun Bank Sampah Anda</p>
        </div>
        
        @if($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                {{ $errors->first() }}
            </div>
        @endif
        
        <form method="POST" action="/login">
            @csrf
            <div class="mb-4">
                <label class="block text-gray-700 mb-2">Email</label>
                <input type="email" name="email" value="{{ old('email') }}" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500" required>
            </div>
            
            <div class="mb-6">
                <label class="block text-gray-700 mb-2">Password</label>
                <input type="password" name="password" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500" required>
            </div>
            
            <div class="flex items-center justify-between mb-6">
                <label class="flex items-center">
                    <input type="checkbox" name="remember" class="mr-2">
                    <span class="text-sm text-gray-600">Ingat saya</span>
                </label>
                <a href="#" class="text-sm text-green-600 hover:text-green-700">Lupa password?</a>
            </div>
            
            <button type="submit" class="btn-gradient text-white w-full py-3 rounded-lg font-semibold">
                <i class="fas fa-sign-in-alt mr-2"></i>Login
            </button>
        </form>
        
        <div class="text-center mt-6">
            <p class="text-gray-600">Belum punya akun? <a href="/register" class="text-green-600 font-semibold">Daftar Sekarang</a></p>
        </div>
        
        <div class="mt-6 pt-6 border-t text-center">
            <p class="text-sm text-gray-500">Demo Account:</p>
            <p class="text-xs text-gray-400">Admin: admin@pelita016.com / admin123</p>
            <p class="text-xs text-gray-400">Nasabah: ahmad@example.com / password123</p>
        </div>
    </div>
</div>
@endsection