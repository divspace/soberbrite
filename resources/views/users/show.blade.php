@extends('layouts.app')

@section('title', $user->profile->first_name.' '.$user->profile->last_name)

@section('content')
    <table class="table-auto">
        <tr>
            <td class="border px-4 py-2">
                <strong>Full Name</strong>
            </td>

            <td class="border px-4 py-2">
                {{ $user->profile->first_name }} {{ $user->profile->last_name }}
            </td>
        </tr>

        <tr class="bg-gray-100">
            <td class="border px-4 py-2">
                <strong>Email Address</strong>
            </td>

            <td class="border px-4 py-2">
                <a href="mailto:{{ $user->email }}">
                    {{ $user->email }}
                </a>
            </td>
        </tr>

        <tr>
            <td class="border px-4 py-2">
                <strong>Joined On</strong>
            </td>

            <td class="border px-4 py-2">
                {{ $user->created_at->format('F j, Y') }} ({{ $user->created_at->diffForHumans() }})
            </td>
        </tr>

        <tr class="bg-gray-100">
            <td class="border px-4 py-2">
                <strong>Sober Since</strong>
            </td>

            <td class="border px-4 py-2">
                {{ $user->profile->sobriety_date->format('F j, Y') }} ({{ number_format($user->profile->sobriety_date->diffInDays()).' '.Str::plural('day', $user->profile->sobriety_date->diffInDays()) }})
            </td>
        </tr>

        <tr>
            <td class="border px-4 py-2">
                <strong>Birth Date</strong>
            </td>

            <td class="border px-4 py-2">
                {{ $user->profile->birth_date->format('F j, Y') }} ({{ $user->profile->birth_date->age }} years old)
            </td>
        </tr>

        <tr class="bg-gray-100">
            <td class="border px-4 py-2">
                <strong>Location</strong>
            </td>

            <td class="border px-4 py-2">
                {{ $user->address->first()->location->city->name }}, {{ $user->address->first()->location->state->code }}
            </td>
        </tr>

        <tr>
            <td class="border px-4 py-2">
                <strong>Phone Number</strong>
            </td>

            <td class="border px-4 py-2">
                <a href="tel:+1{{ $user->profile->phone }}">
                    {{ '('.substr($user->profile->phone, 0, 3).') '.substr($user->profile->phone, 3, 3).'-'.substr($user->profile->phone, 6) }}
                </a>
            </td>
        </tr>
    </table>
@endsection
