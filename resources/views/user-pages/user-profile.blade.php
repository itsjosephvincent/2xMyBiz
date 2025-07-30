@extends('layouts.app')

@section('css')
@endsection

@section('title', 'Users Profile - 2xMyLeads')

@section('content')
    <div class="grid grid-cols-1">
        <div class="col-span-1">
            <a href="{{ route('users-and-roles') }}" class="inline-flex items-center gap-x-1.5 rounded bg-indigo-50 px-2 py-1 text-xs font-semibold text-black shadow-sm hover:bg-indigo-100">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="-ml-0.5 h-5 w-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
                </svg>
                Go back
            </a>
        </div>
    </div>

    <div class="border border-gray-200 bg-white px-4 py-5 sm:px-6 mt-4">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="mx-auto max-w-3xl">
                <form action="{{ route('update-user', $user->id) }}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="grid grid-cols-1 lg:grid-cols-2 lg:space-y-0 space-y-2">
                        <div class="lg:mr-2">
                            <label class="block text-sm font-medium leading-6 text-gray-900">First name</label>
                            <div class="mt-1">
                                <input type="text" name="firstname" value="{{ $user->first_name }}" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium leading-6 text-gray-900">Last name</label>
                            <div class="mt-1">
                                <input type="text" name="lastname" value="{{ $user->last_name }}" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                            </div>
                        </div>
                        <div class="lg:mr-2">
                            <label class="block text-sm font-medium leading-6 text-gray-900">Email</label>
                            <div class="mt-1">
                                <input type="email" name="email" value="{{ $user->email }}" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium leading-6 text-gray-900">Password</label>
                            <div class="mt-1">
                                <input type="password" name="password" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                            </div>
                        </div>
                        <div class="lg:mr-2">
                            <label class="block text-sm font-medium leading-6 text-gray-900">Gender</label>
                            <select name="gender" class="mt-1 block w-full rounded-md border-0 py-1.5 pl-3 pr-10 text-gray-900 ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                @if(!$user->gender)
                                <option value="" selected disabled>Select gender</option>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                                @elseif ($user->gender == 'male')
                                <option value="male" selected>Male</option>
                                <option value="female">Female</option>
                                @else
                                <option value="male">Male</option>
                                <option value="female" selected>Female</option>
                                @endif
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium leading-6 text-gray-900">Status</label>
                            <select name="status" class="mt-1 block w-full rounded-md border-0 py-1.5 pl-3 pr-10 text-gray-900 ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                @if($user->status == 'active')
                                <option value="active" selected>Active</option>
                                <option value="inactive">Inactive</option>
                                @else
                                <option value="active">Active</option>
                                <option value="inactive" selected>Inactive</option>
                                @endif
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium leading-6 text-gray-900">Role</label>
                            <select name="role" class="mt-1 block w-full rounded-md border-0 py-1.5 pl-3 pr-10 text-gray-900 ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                @if ($user->hasRole('Admin'))
                                <option value="Admin" selected>Admin</option>
                                <option value="Free">Free</option>
                                <option value="Freelancer">Freelancer</option>
                                <option value="Pro">Pro</option>
                                <option value="Agency">Agency</option>
                                @elseif ($user->hasRole('Free'))
                                <option value="Admin">Admin</option>
                                <option value="Free" selected>Free</option>
                                <option value="Freelancer">Freelancer</option>
                                <option value="Pro">Pro</option>
                                <option value="Agency">Agency</option>
                                @elseif ($user->hasRole('Freelancer'))
                                <option value="Admin">Admin</option>
                                <option value="Free">Free</option>
                                <option value="Freelancer" selected>Freelancer</option>
                                <option value="Pro">Pro</option>
                                <option value="Agency">Agency</option>
                                @elseif ($user->hasRole('Pro'))
                                <option value="Admin">Admin</option>
                                <option value="Free">Free</option>
                                <option value="Freelancer">Freelancer</option>
                                <option value="Pro" selected>Pro</option>
                                <option value="Agency">Agency</option>
                                @elseif ($user->hasRole('Agency'))
                                <option value="Admin">Admin</option>
                                <option value="Free">Free</option>
                                <option value="Freelancer">Freelancer</option>
                                <option value="Pro">Pro</option>
                                <option value="Agency" selected>Agency</option>
                                @else
                                <option value="" selected disabled>Select role</option>
                                <option value="Admin">Admin</option>
                                <option value="Free">Free</option>
                                <option value="Freelancer">Freelancer</option>
                                <option value="Pro">Pro</option>
                                <option value="Agency">Agency</option>
                                @endif
                            </select>
                        </div>
                    </div>
                    <div class="flex justify-center mt-4">
                        <button type="submit" class="rounded-md bg-pipexblue px-2.5 py-1.5 text-sm font-semibold text-white shadow-sm hover:bg-blue-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @include('sweetalert::alert')
@endsection
