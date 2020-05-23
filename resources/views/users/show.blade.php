@extends('layouts.app')
@section('title', 'Users')
@section('content')
    <div class="bg-white shadow overflow-hidden sm:rounded-lg">
        <div class="px-4 py-5 border-b border-gray-200 sm:px-6">
            <h3 class="text-lg leading-6 font-medium text-gray-900">
                User Profile
            </h3>

            <p class="mt-1 max-w-2xl text-sm leading-5 text-gray-500">
                Public details and information.
            </p>
        </div>

        <div>
            <dl>
                <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm leading-5 font-medium text-gray-500">
                        Full Name
                    </dt>

                    <dd class="mt-1 text-sm leading-5 text-gray-900 sm:mt-0 sm:col-span-2">
                        {{ $user->profile->first_name }} {{ $user->profile->last_name }} ({{ $user->profile->birth_date->age }}/{{ $user->profile->gender }}/{{ $user->address->first()->state }})
                    </dd>
                </div>

                <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm leading-5 font-medium text-gray-500">
                        Email Address
                    </dt>

                    <dd class="mt-1 text-sm leading-5 text-gray-900 sm:mt-0 sm:col-span-2">
                        {{ $user->email }}
                    </dd>
                </div>

                <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm leading-5 font-medium text-gray-500">
                        Joined On
                    </dt>

                    <dd class="mt-1 text-sm leading-5 text-gray-900 sm:mt-0 sm:col-span-2">
                        {{ $user->created_at->format('F j, Y') }} ({{ $user->created_at->diffForHumans() }})
                    </dd>
                </div>

                <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm leading-5 font-medium text-gray-500">
                        Sober Since
                    </dt>

                    <dd class="mt-1 text-sm leading-5 text-gray-900 sm:mt-0 sm:col-span-2">
                        {{ $user->profile->sobriety_date->format('F j, Y') }} ({{ number_format($user->profile->sobriety_date->diffInDays()).' '.Str::plural('day', $user->profile->sobriety_date->diffInDays()) }})
                    </dd>
                </div>

                <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm leading-5 font-medium text-gray-500">
                        Birth Date
                    </dt>

                    <dd class="mt-1 text-sm leading-5 text-gray-900 sm:mt-0 sm:col-span-2">
                        {{ $user->profile->birth_date->format('F j, Y') }}
                    </dd>
                </div>

                <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm leading-5 font-medium text-gray-500">
                        Phone Number
                    </dt>

                    <dd class="mt-1 text-sm leading-5 text-gray-900 sm:mt-0 sm:col-span-2">
                        {{ '('.substr($user->profile->phone, 0, 3).') '.substr($user->profile->phone, 3, 3).'-'.substr($user->profile->phone,6) }}
                    </dd>
                </div>

                <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm leading-5 font-medium text-gray-500">
                        Address
                    </dt>

                    <dd class="mt-1 text-sm leading-5 text-gray-900 sm:mt-0 sm:col-span-2">
                        {{ $user->address->first()->street }}
                        <br>
                        {{ $user->address->first()->city }}, {{ $user->address->first()->state }} {{ $user->address->first()->zip_code }}
                    </dd>
                </div>
            </dl>
        </div>
    </div>
@endsection
