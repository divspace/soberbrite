@extends('layouts.auth')
@section('title', 'Reset Password')

@section('content')
    <div>
        @livewire('auth.passwords.reset', [
            'token' => $token
        ])
    </div>
@endsection
