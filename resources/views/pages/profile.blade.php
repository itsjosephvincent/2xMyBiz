@extends('layouts.app')

@section('title', 'Profile - 2xMyLeads')

@section('content')
    <div class="grid grid-cols-1">
        <div class="col-span-1">
            <h6 class="text-lg font-medium">My Profile</h6>
        </div>
    </div>

    <div class="border border-gray-200 bg-white px-4 py-5 sm:px-6 mt-4">
        <div class="grid grid-cols-1 lg:grid-cols-4">
            <div class="col-span-1">
                <div class="flex justify-center">
                    <img class="block h-28 w-28 rounded-full" src="{{ isset($data->avatar) ? $data->avatar : $currentUser->profile_photo }}">
                </div>
                <div class="flex justify-center mt-2">
                    <form id="ppfrm" action="{{ route('update-profile-pic') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="group -my-2 -ml-2 inline-flex items-center rounded-full px-3 py-2 text-left">
                            <label for="fileInput" class="cursor-pointer flex text-xs border border-gray-200 text-black bg-white hover:bg-gray-200 py-1 px-2 rounded-md">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                                </svg>
                                Update photo
                            </label>
                            <input id="fileInput" name="profilePhoto" type="file" class="hidden">
                        </div>
                    </form>
                </div>
            </div>
            <div class="lg:col-span-1 flex lg:justify-start mt-2 lg:mt-0">
                <div class="grid grid-rows-4 view">
                    <div class="lg:mx-0 mx-12">
                        <p class="text-lg text-center lg:text-left font-medium">{{ $currentUser->first_name . ' ' . $currentUser->last_name }}</p>
                    </div>
                    <div class="text-xs text-center lg:text-left text-gray-500 lg:mx-0 mx-16">{{ $currentUser->email }}</div>
                    <div class="text-xs text-center lg:text-left text-gray-500 lg:mx-0 mx-16">
                        @if($currentUser->status == 'active')
                        <span class="inline-flex items-center rounded-full bg-green-100 px-4 py-1 text-xs font-medium text-green-700">Active</span>
                        @else
                        <span class="inline-flex items-center rounded-full bg-pink-100 px-4 py-1 text-xs font-medium text-pink-700">Inactive</span>
                        @endif
                    </div>
                    <div class="text-xs text-pipexblue flex justify-center lg:justify-start space-x-2 lg:mx-0 mx-16">
                        @if ($userProfiles)
                            @if ($userProfiles->facebook)
                                <a href="{{ $userProfiles->facebook }}" target="_blank"><svg class="mt-1" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-facebook mb-1" data-v-1931f91c=""><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path></svg></a>
                            @endif
                            @if ($userProfiles->twitter)
                                <a href="{{ $userProfiles->twitter }}" target="_blank"><svg class="mt-1" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-twitter"><path d="M23 3a10.9 10.9 0 0 1-3.14 1.53 4.48 4.48 0 0 0-7.86 3v1A10.66 10.66 0 0 1 3 4s-4 9 5 13a11.64 11.64 0 0 1-7 2c9 5 20 0 20-11.5a4.5 4.5 0 0 0-.08-.83A7.72 7.72 0 0 0 23 3z"></path></svg></a>
                            @endif
                            @if ($userProfiles->linkedin)
                                <a href="{{ $userProfiles->linkedin }}" target="_blank"><svg class="mt-1" blue-font" xmlns="http://www.w3.org/2000/svg" width="16px" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-linkedin"><path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z"></path><rect x="2" y="9" width="4" height="12"></rect><circle cx="4" cy="4" r="2"></circle></svg></a>
                            @endif
                            @if ($userProfiles->youtube)
                                <a href="{{ $userProfiles->youtube }}" target="_blank"><svg class="mt-1" blue-font" xmlns="http://www.w3.org/2000/svg" width="16px" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-youtube"><path d="M22.54 6.42a2.78 2.78 0 0 0-1.94-2C18.88 4 12 4 12 4s-6.88 0-8.6.46a2.78 2.78 0 0 0-1.94 2A29 29 0 0 0 1 11.75a29 29 0 0 0 .46 5.33A2.78 2.78 0 0 0 3.4 19c1.72.46 8.6.46 8.6.46s6.88 0 8.6-.46a2.78 2.78 0 0 0 1.94-2 29 29 0 0 0 .46-5.25 29 29 0 0 0-.46-5.33z"></path><polygon points="9.75 15.02 15.5 11.75 9.75 8.48 9.75 15.02"></polygon></svg></a>
                            @endif
                            @if ($userProfiles->instagram)
                                <a href="{{ $userProfiles->instagram }}" target="_blank"><svg class="mt-1" blue-font" xmlns="http://www.w3.org/2000/svg" width="16px" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-instagram"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line></svg></a>
                            @endif
                        @endif
                    </div>
                </div>
            </div>
            <div class="lg:col-span-1 flex lg:justify-start mt-2 lg:mt-0">
                <div class="grid grid-rows-2 space-y-2 lg:space-y-0">
                    <div class="flex justify-center">
                        <div class="mb-4 flex-shrink-0 sm:mb-0 sm:mr-4">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="text-pipexblue w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
                            </svg>
                        </div>
                        <div class="ml-2 lg:ml-0">
                            <h4 class="text-xs">Business address:</h4>
                            <p class="text-xs">{{ $userDetails->address1 ?? 'No address added' }}</p>
                        </div>
                    </div>
                    <div class="flex mx-16 lg:mt-1">
                        <div class="mb-4 flex-shrink-0 sm:mb-0 sm:mr-4">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="text-pipexblue w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 002.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 01-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 00-1.091-.852H4.5A2.25 2.25 0 002.25 4.5v2.25z" />
                              </svg>
                        </div>
                        <div class="ml-2 lg:ml-0">
                            <h4 class="text-xs">Contact:</h4>
                            <p class="text-xs">{{ $userDetails->contact_number ?? 'No contact number added' }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="lg:col-span-1 flex lg:justify-start mt-2 lg:mt-0">
                <div class="grid grid-rows-2 space-y-2 lg:space-y-0">
                    <div class="flex justify-center">
                        <div class="mb-4 flex-shrink-0 sm:mb-0 sm:mr-4">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="text-pipexblue w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5m-9-6h.008v.008H12v-.008zM12 15h.008v.008H12V15zm0 2.25h.008v.008H12v-.008zM9.75 15h.008v.008H9.75V15zm0 2.25h.008v.008H9.75v-.008zM7.5 15h.008v.008H7.5V15zm0 2.25h.008v.008H7.5v-.008zm6.75-4.5h.008v.008h-.008v-.008zm0 2.25h.008v.008h-.008V15zm0 2.25h.008v.008h-.008v-.008zm2.25-4.5h.008v.008H16.5v-.008zm0 2.25h.008v.008H16.5V15z" />
                            </svg>
                        </div>
                        <div class="ml-2 lg:ml-0">
                            <h4 class="text-xs">Created:</h4>
                            <p class="text-xs">{{ date('m-d-Y', strtotime($currentUser->created_at)) }}</p>
                        </div>
                    </div>
                    <div class="flex mx-16 lg:mt-1">
                        <div class="mb-4 flex-shrink-0 sm:mb-0 sm:mr-4">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="text-pipexblue w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 8.25v-1.5m0 1.5c-1.355 0-2.697.056-4.024.166C6.845 8.51 6 9.473 6 10.608v2.513m6-4.87c1.355 0 2.697.055 4.024.165C17.155 8.51 18 9.473 18 10.608v2.513m-3-4.87v-1.5m-6 1.5v-1.5m12 9.75l-1.5.75a3.354 3.354 0 01-3 0 3.354 3.354 0 00-3 0 3.354 3.354 0 01-3 0 3.354 3.354 0 00-3 0 3.354 3.354 0 01-3 0L3 16.5m15-3.38a48.474 48.474 0 00-6-.37c-2.032 0-4.034.125-6 .37m12 0c.39.049.777.102 1.163.16 1.07.16 1.837 1.094 1.837 2.175v5.17c0 .62-.504 1.124-1.125 1.124H4.125A1.125 1.125 0 013 20.625v-5.17c0-1.08.768-2.014 1.837-2.174A47.78 47.78 0 016 13.12M12.265 3.11a.375.375 0 11-.53 0L12 2.845l.265.265zm-3 0a.375.375 0 11-.53 0L9 2.845l.265.265zm6 0a.375.375 0 11-.53 0L15 2.845l.265.265z" />
                            </svg>
                        </div>
                        <div class="ml-2 lg:ml-0">
                            <h4 class="text-xs">Birthday:</h4>
                            <p class="text-xs">{{ date('m-d-Y', strtotime($currentUser->birthday)) ?? 'No birthday added' }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3">
        <div class="lg:col-span-1 lg:mr-10 mb-2 lg:mb-0">
            <div class="border border-gray-200 bg-white px-2 py-5 sm:px-6 mt-4">
                <nav class="flex flex-1 flex-col" aria-label="Sidebar">
                    <ul role="list" class="-mx-2 space-y-1">
                        <li>
                            <a href="{{ route('personal-info') }}" class="text-gray-700 hover:text-indigo-600 hover:bg-gray-50 group flex gap-x-3 rounded-md p-2 pl-3 text-sm leading-6 font-semibold">Personal info</a>
                        </li>
                        <li>
                            <a href="{{ route('password-change') }}" class="text-gray-700 hover:text-indigo-600 hover:bg-gray-50 group flex gap-x-3 rounded-md p-2 pl-3 text-sm leading-6 font-semibold">Password change</a>
                        </li>
                        <li>
                            <a href="{{ route('activity-list') }}" class="text-gray-700 hover:text-indigo-600 hover:bg-gray-50 group flex gap-x-3 rounded-md p-2 pl-3 text-sm leading-6 font-semibold">Activity logs</a>
                        </li>
                        <li>
                            <a href="{{ route('social-profiles') }}" class="text-gray-700 hover:text-indigo-600 hover:bg-gray-50 group flex gap-x-3 rounded-md p-2 pl-3 text-sm leading-6 font-semibold">Social profiles</a>
                        </li>
                        <li>
                            <a href="{{ route('integrations') }}" class="text-gray-700 hover:text-indigo-600 hover:bg-gray-50 group flex gap-x-3 rounded-md p-2 pl-3 text-sm leading-6 font-semibold">Integrations</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
        <div class="lg:col-span-2">
            <div class="border border-gray-200 bg-white px-4 py-5 sm:px-6 mt-4">
                @yield('profiles')
            </div>
        </div>
    </div>

    <div class="hidden relative z-10 upload-loader" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>
        <div class="fixed inset-0 z-10 overflow-y-auto">
            <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                <div class="relative transform overflow-hidden rounded-lg bg-white px-4 pb-4 pt-5 text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-sm sm:p-6">
                    <div>
                        <div class="flex justify-center items-center">
                            <div class="loader"></div>
                        </div>
                        <div class="mt-3 text-center sm:mt-5">
                            <h3 class="text-base font-semibold leading-6 text-gray-900" id="modal-title">Uploading</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
