@extends('layouts.auth')
@section('title', 'Confirm Your Password')

@section('content')
    <div>
        @livewire('auth.passwords.confirm')
    </div>
@endsection
