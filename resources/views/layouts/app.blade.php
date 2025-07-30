<!DOCTYPE html>
<html lang="en" class="h-full bg-gray-50">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="shortcut icon" href="{{ asset('img/favicon.ico') }}" type="image/x-icon">
    @vite('resources/css/app.css')
    @yield('css')
    <title>@yield('title')</title>
</head>

<body class="h-full">
    <div>
        <div class="hidden relative z-50 lg:hidden mobile-sidenav" role="dialog" aria-modal="true">
            <div class="fixed inset-0 bg-gray-900/80"></div>

            <div class="fixed inset-0 flex">
                <div class="relative mr-16 flex w-full max-w-xs flex-1">

                    <div class="absolute left-full top-0 flex w-16 justify-center pt-5">
                        <button type="button" class="-m-2.5 p-2.5 close-sidenav">
                            <span class="sr-only">Close sidebar</span>
                            <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>

                    <div class="flex grow flex-col gap-y-5 overflow-y-auto bg-gray-900 px-6 pb-4 ring-1 ring-white/10">
                        <div class="flex h-16 shrink-0 items-center">
                            <a href="{{ route('dashboard') }}"><img class="w-auto" src="{{ asset('img/main.png') }}" alt="Company Logo"></a>
                        </div>
                        <nav class="flex flex-1 flex-col">
                            <ul role="list" class="flex flex-1 flex-col gap-y-7">
                                <li>
                                    <ul role="list" class="-mx-2 space-y-1">
                                        <li>
                                            <a href="{{ route('dashboard') }}" class="text-gray-400 hover:text-white hover:bg-gray-800 group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold">
                                                <svg class="h-6 w-6 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                                                </svg>
                                                Dashboard
                                            </a>
                                        </li>
                                        @can('manage_leads')
                                        <li>
                                            <div>
                                                <button type="button" class="hover:text-white hover:bg-gray-800 leads-mobile-drop-down flex items-center w-full text-left rounded-md p-2 gap-x-3 text-sm leading-6 font-semibold text-gray-400" aria-controls="sub-menu-1" aria-expanded="false">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 003.741-.479 3 3 0 00-4.682-2.72m.94 3.198l.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0112 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 016 18.719m12 0a5.971 5.971 0 00-.941-3.197m0 0A5.995 5.995 0 0012 12.75a5.995 5.995 0 00-5.058 2.772m0 0a3 3 0 00-4.681 2.72 8.986 8.986 0 003.74.477m.94-3.197a5.971 5.971 0 00-.94 3.197M15 6.75a3 3 0 11-6 0 3 3 0 016 0zm6 3a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0zm-13.5 0a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z" />
                                                    </svg>
                                                    Leads
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3.0" stroke="currentColor" class="w-3 h-3 flex justify-end ml-auto">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                                    </svg>
                                                </button>
                                                <ul class="hidden mt-1 px-2" id="mobile-sub-menu-1">
                                                    <li>
                                                        <div>
                                                            <button type="button" class="hover:text-white hover:bg-gray-800 mobile-sub-menu-dropdown flex items-center w-full text-left rounded-md p-2 gap-x-3 text-sm leading-6 text-gray-400" aria-controls="sub-menu-1" aria-expanded="false">
                                                                Find Leads
                                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3.0" stroke="currentColor" class="w-3 h-3 flex justify-end ml-auto">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                                                </svg>
                                                            </button>
                                                            <ul class="hidden mt-1 px-2" id="mobile-sub-menu-list">
                                                                <li>
                                                                    <a href="{{ route('find-facebook-leads') }}" class="hover:text-white hover:bg-gray-800 block rounded-md py-2 pr-2 pl-9 text-xs leading-6 text-gray-400">Facebook Leads</a>
                                                                </li>
                                                                <li>
                                                                    <a href="{{ route('find-linkedin-leads') }}" class="hover:text-white hover:bg-gray-800 block rounded-md py-2 pr-2 pl-9 text-xs leading-6 text-gray-400">LinkedIn Leads</a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </li>

                                                    <li>
                                                        <a href="{{ route('my-leads') }}" class="hover:text-white hover:bg-gray-800 flex items-center w-full text-left rounded-md p-2 gap-x-3 text-sm leading-6 text-gray-400" aria-controls="sub-menu-1" aria-expanded="false">
                                                            Saved Leads
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="{{ route('my-organizations') }}" class="hover:text-white hover:bg-gray-800 flex items-center w-full text-left rounded-md p-2 gap-x-3 text-sm leading-6 text-gray-400" aria-controls="sub-menu-1" aria-expanded="false">
                                                            Lead Groups
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </li>
                                        @endcan
                                        @can('manage_deals')
                                        <li>
                                            <div>
                                                <button type="button" class="hover:text-white hover:bg-gray-800 deals-mobile-drop-down flex items-center w-full text-left rounded-md p-2 gap-x-3 text-sm leading-6 font-semibold text-gray-400" aria-controls="sub-menu-1" aria-expanded="false">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M11.48 3.499a.562.562 0 011.04 0l2.125 5.111a.563.563 0 00.475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 00-.182.557l1.285 5.385a.562.562 0 01-.84.61l-4.725-2.885a.563.563 0 00-.586 0L6.982 20.54a.562.562 0 01-.84-.61l1.285-5.386a.562.562 0 00-.182-.557l-4.204-3.602a.563.563 0 01.321-.988l5.518-.442a.563.563 0 00.475-.345L11.48 3.5z" />
                                                    </svg>
                                                    Deals
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3.0" stroke="currentColor" class="w-3 h-3 flex justify-end ml-auto">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                                    </svg>
                                                </button>
                                                <ul class="hidden mt-1 px-2" id="mobile-sub-menu-2">
                                                    <li>
                                                        <a href="{{ route('pipeline-view') }}" class="hover:text-white hover:bg-gray-800 block rounded-md py-2 pr-2 pl-9 text-xs leading-6 text-gray-400">Pipeline View</a>
                                                    </li>
                                                    <li>
                                                        <a href="{{ route('lead-groups') }}" class="hover:text-white hover:bg-gray-800 block rounded-md py-2 pr-2 pl-9 text-xs leading-6 text-gray-400">Stages</a>
                                                    </li>
                                                    <li>
                                                        <a href="{{ route('deals') }}" class="hover:text-white hover:bg-gray-800 block rounded-md py-2 pr-2 pl-9 text-xs leading-6 text-gray-400">Offered Deals</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </li>
                                        @endcan
                                        @can('manage_facebook_post')
                                        <li>
                                            <div>
                                                <button type="button" class="hover:text-white hover:bg-gray-800 posts-mobile-drop-down flex items-center w-full text-left rounded-md p-2 gap-x-3 text-sm leading-6 font-semibold text-gray-400" aria-controls="sub-menu-1" aria-expanded="false">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                                    </svg>
                                                    Posts
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3.0" stroke="currentColor" class="w-3 h-3 flex justify-end ml-auto">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                                    </svg>
                                                </button>
                                                <ul class="hidden mt-1 px-2" id="mobile-sub-menu-3">
                                                    <li>
                                                        <a href="{{ route('post-template-list') }}" class="hover:text-white hover:bg-gray-800 block rounded-md py-2 pr-2 pl-9 text-xs leading-6 text-gray-400">Post on Social Media</a>
                                                    </li>
                                                    <li>
                                                        <a href="{{ route('linkedin-post-list') }}" class="hover:text-white hover:bg-gray-800 block rounded-md py-2 pr-2 pl-9 text-xs leading-6 text-gray-400">Post on LinkedIn</a>
                                                    </li>
                                                    <li>
                                                        <a href="{{ route('instagram-post-list') }}" class="hover:text-white hover:bg-gray-800 block rounded-md py-2 pr-2 pl-9 text-xs leading-6 text-gray-400">Post on Instagram</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </li>
                                        @endcan
                                        @can('manage_email_templates')
                                        <li>
                                            <div>
                                                <button type="button" class="hover:text-white hover:bg-gray-800 emails-mobile-drop-down flex items-center w-full text-left rounded-md p-2 gap-x-3 text-sm leading-6 font-semibold text-gray-400" aria-controls="sub-menu-1" aria-expanded="false">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" />
                                                    </svg>
                                                    Emails
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3.0" stroke="currentColor" class="w-3 h-3 flex justify-end ml-auto">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                                    </svg>
                                                </button>
                                                <ul class="hidden mt-1 px-2" id="mobile-sub-menu-4">
                                                    <li>
                                                        <a href="{{ route('email-categories') }}" class="hover:text-white hover:bg-gray-800 block rounded-md py-2 pr-2 pl-9 text-xs leading-6 text-gray-400">Email Categories</a>
                                                    </li>
                                                    <li>
                                                        <a href="{{ route('email-templates') }}" class="hover:text-white hover:bg-gray-800 block rounded-md py-2 pr-2 pl-9 text-xs leading-6 text-gray-400">Email Templates</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </li>
                                        @endcan
                                        @can('manage_post_templates')
                                        <li>
                                            <div>
                                                <button type="button" class="hover:text-white hover:bg-gray-800 post-templates-mobile-drop-down flex items-center w-full text-left rounded-md p-2 gap-x-3 text-sm leading-6 font-semibold text-gray-400" aria-controls="sub-menu-1" aria-expanded="false">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 7.5h1.5m-1.5 3h1.5m-7.5 3h7.5m-7.5 3h7.5m3-9h3.375c.621 0 1.125.504 1.125 1.125V18a2.25 2.25 0 01-2.25 2.25M16.5 7.5V18a2.25 2.25 0 002.25 2.25M16.5 7.5V4.875c0-.621-.504-1.125-1.125-1.125H4.125C3.504 3.75 3 4.254 3 4.875V18a2.25 2.25 0 002.25 2.25h13.5M6 7.5h3v3H6v-3z" />
                                                    </svg>
                                                    Post Templates
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3.0" stroke="currentColor" class="w-3 h-3 flex justify-end ml-auto">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                                    </svg>
                                                </button>
                                                <ul class="hidden mt-1 px-2" id="mobile-sub-menu-5">
                                                    <li>
                                                        <a href="{{ route('post-template-categories') }}" class="hover:text-white hover:bg-gray-800 block rounded-md py-2 pr-2 pl-9 text-xs leading-6 text-gray-400">Post Template Categories</a>
                                                    </li>
                                                    <li>
                                                        <a href="{{ route('post-templates') }}" class="hover:text-white hover:bg-gray-800 block rounded-md py-2 pr-2 pl-9 text-xs leading-6 text-gray-400">Post Template List</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </li>
                                        @endcan
                                        <li>
                                            <a href="{{ route('page.list') }}" class="text-gray-400 hover:text-white hover:bg-gray-800 group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 3v11.25A2.25 2.25 0 006 16.5h2.25M3.75 3h-1.5m1.5 0h16.5m0 0h1.5m-1.5 0v11.25A2.25 2.25 0 0118 16.5h-2.25m-7.5 0h7.5m-7.5 0l-1 3m8.5-3l1 3m0 0l.5 1.5m-.5-1.5h-9.5m0 0l-.5 1.5m.75-9l3-3 2.148 2.148A12.061 12.061 0 0116.5 7.605" />
                                                </svg>
                                                SEO Audit Report
                                            </a>
                                        </li>
                                        @can('manage_users_roles')
                                        <li>
                                            <a href="{{ route('users-and-roles') }}" class="text-gray-400 hover:text-white hover:bg-gray-800 group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
                                                </svg>
                                                Users & Roles
                                            </a>
                                        </li>
                                        @endcan
                                        @can('manage_notifications')
                                        <li>
                                            <a href="{{ route('notification') }}" class="text-gray-400 hover:text-white hover:bg-gray-800 group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0M3.124 7.5A8.969 8.969 0 015.292 3m13.416 0a8.969 8.969 0 012.168 4.5" />
                                                </svg>
                                                Notifications
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('affiliate-list') }}" class="text-gray-400 hover:text-white hover:bg-gray-800 group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 14.15v4.25c0 1.094-.787 2.036-1.872 2.18-2.087.277-4.216.42-6.378.42s-4.291-.143-6.378-.42c-1.085-.144-1.872-1.086-1.872-2.18v-4.25m16.5 0a2.18 2.18 0 00.75-1.661V8.706c0-1.081-.768-2.015-1.837-2.175a48.114 48.114 0 00-3.413-.387m4.5 8.006c-.194.165-.42.295-.673.38A23.978 23.978 0 0112 15.75c-2.648 0-5.195-.429-7.577-1.22a2.016 2.016 0 01-.673-.38m0 0A2.18 2.18 0 013 12.489V8.706c0-1.081.768-2.015 1.837-2.175a48.111 48.111 0 013.413-.387m7.5 0V5.25A2.25 2.25 0 0013.5 3h-3a2.25 2.25 0 00-2.25 2.25v.894m7.5 0a48.667 48.667 0 00-7.5 0M12 12.75h.008v.008H12v-.008z" />
                                                </svg>
                                                Affiliate Partners
                                            </a>
                                        </li>
                                        @endcan
                                        <li>
                                            <a href="https://www.2xmyleads.com/login" target="_blank" class="text-gray-400 hover:text-white hover:bg-gray-800 group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 8.25V18a2.25 2.25 0 002.25 2.25h13.5A2.25 2.25 0 0021 18V8.25m-18 0V6a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 6v2.25m-18 0h18M5.25 6h.008v.008H5.25V6zM7.5 6h.008v.008H7.5V6zm2.25 0h.008v.008H9.75V6z" />
                                                </svg>
                                                Training
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>

        <div class="hidden lg:fixed lg:inset-y-0 lg:z-50 lg:flex lg:w-52 lg:flex-col">
            <!-- Modal -->
            @if (!$data)
            <div class="relative z-10" aria-labelledby="modal-title" role="dialog" aria-modal="true">
                <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>
                <div class="fixed inset-0 z-10 overflow-y-auto">
                    <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                        <div class="relative transform overflow-hidden rounded-lg bg-white px-4 pb-4 pt-5 text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-sm sm:p-6">
                            <div>
                                <div class="mx-auto flex h-12 w-12 items-center justify-center rounded-full bg-red-100">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-red-600">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m0-10.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.75c0 5.592 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.57-.598-3.75h-.152c-3.196 0-6.1-1.249-8.25-3.286zm0 13.036h.008v.008H12v-.008z" />
                                    </svg>
                                </div>
                                <div class="mt-3 text-center sm:mt-5">
                                    <h3 class="text-base font-semibold leading-6 text-gray-900" id="modal-title">Action required</h3>
                                    <div class="mt-2">
                                        <p class="text-xs text-gray-500">Activate your account by clicking the button below</p>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-5 sm:mt-6 text-center">
                                <a href="{{ route('facebook.login') }}" class="w-1/2"><img src="{{ asset('img/facebook_button.png') }}" alt=""></a>
                                <a href="https://www.2xmyleads.com/Privacy-Policies" target="_blank" class="text-xs leading-6 text-gray-600 mt-2 hover:text-gray-900"><u>Privacy Policy</u></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif

            <div class="flex grow flex-col gap-y-5 overflow-y-auto bg-gray-900 px-6 pb-4">
                <div class="flex h-16 shrink-0 items-center">
                    <a href="{{ route('dashboard') }}"><img class="w-auto" src="{{ asset('img/main.png') }}" alt="Company Logo"></a>
                </div>
                <nav class="flex flex-1 flex-col">
                    <ul role="list" class="flex flex-1 flex-col gap-y-7">
                        <li>
                            <ul role="list" class="-mx-2 space-y-1">
                                <li>
                                    <a href="{{ route('dashboard') }}" class="hover:bg-gray-800 text-gray-400 hover:text-white group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold">
                                        <svg class="h-6 w-6 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                                        </svg>
                                        Dashboard
                                    </a>
                                </li>
                                @can('manage_leads')
                                <li>
                                    <div>
                                        <button type="button" class="hover:text-white hover:bg-gray-800 leads-drop-down flex items-center w-full text-left rounded-md p-2 gap-x-3 text-sm leading-6 font-semibold text-gray-400" aria-controls="sub-menu-1" aria-expanded="false">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 003.741-.479 3 3 0 00-4.682-2.72m.94 3.198l.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0112 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 016 18.719m12 0a5.971 5.971 0 00-.941-3.197m0 0A5.995 5.995 0 0012 12.75a5.995 5.995 0 00-5.058 2.772m0 0a3 3 0 00-4.681 2.72 8.986 8.986 0 003.74.477m.94-3.197a5.971 5.971 0 00-.94 3.197M15 6.75a3 3 0 11-6 0 3 3 0 016 0zm6 3a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0zm-13.5 0a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z" />
                                            </svg>
                                            Leads
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3.0" stroke="currentColor" class="w-3 h-3 flex justify-end ml-auto">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                            </svg>
                                        </button>
                                        <ul class="hidden mt-1 px-2" id="sub-menu-1">
                                            <li>
                                                <div>
                                                    <button type="button" class="hover:text-white hover:bg-gray-800 sub-menu-dropdown flex items-center w-full text-left rounded-md p-2 gap-x-3 text-sm leading-6 text-gray-400" aria-controls="sub-menu-1" aria-expanded="false">
                                                        Find Leads
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3.0" stroke="currentColor" class="w-3 h-3 flex justify-end ml-auto">
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                                        </svg>
                                                    </button>
                                                    <ul class="hidden mt-1 px-2" id="sub-menu-list">
                                                        <li>
                                                            <a href="{{ route('find-facebook-leads') }}" class="hover:text-white hover:bg-gray-800 block rounded-md py-2 pr-2 pl-9 text-xs leading-6 text-gray-400">Facebook Leads</a>
                                                        </li>
                                                        <li>
                                                            <a href="{{ route('find-linkedin-leads') }}" class="hover:text-white hover:bg-gray-800 block rounded-md py-2 pr-2 pl-9 text-xs leading-6 text-gray-400">LinkedIn Leads</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </li>

                                            <li>
                                                <a href="{{ route('my-leads') }}" class="hover:text-white hover:bg-gray-800 flex items-center w-full text-left rounded-md p-2 gap-x-3 text-sm leading-6 text-gray-400" aria-controls="sub-menu-1" aria-expanded="false">
                                                    Saved Leads
                                                </a>
                                            </li>
                                            <li>
                                                <a href="{{ route('my-organizations') }}" class="hover:text-white hover:bg-gray-800 flex items-center w-full text-left rounded-md p-2 gap-x-3 text-sm leading-6 text-gray-400" aria-controls="sub-menu-1" aria-expanded="false">
                                                    Lead Groups
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </li>
                                @endcan
                                @can('manage_deals')
                                <li>
                                    <div>
                                        <button type="button" class="hover:text-white hover:bg-gray-800 deals-drop-down flex items-center w-full text-left rounded-md p-2 gap-x-3 text-sm leading-6 font-semibold text-gray-400" aria-controls="sub-menu-1" aria-expanded="false">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M11.48 3.499a.562.562 0 011.04 0l2.125 5.111a.563.563 0 00.475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 00-.182.557l1.285 5.385a.562.562 0 01-.84.61l-4.725-2.885a.563.563 0 00-.586 0L6.982 20.54a.562.562 0 01-.84-.61l1.285-5.386a.562.562 0 00-.182-.557l-4.204-3.602a.563.563 0 01.321-.988l5.518-.442a.563.563 0 00.475-.345L11.48 3.5z" />
                                            </svg>
                                            Deals
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3.0" stroke="currentColor" class="w-3 h-3 flex justify-end ml-auto">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                            </svg>
                                        </button>
                                        <ul class="hidden mt-1 px-2" id="sub-menu-2">
                                            <li>
                                                <a href="{{ route('pipeline-view') }}" class="hover:text-white hover:bg-gray-800 block rounded-md py-2 pr-2 pl-9 text-xs leading-6 text-gray-400">Pipeline View</a>
                                            </li>
                                            <li>
                                                <a href="{{ route('lead-groups') }}" class="hover:text-white hover:bg-gray-800 block rounded-md py-2 pr-2 pl-9 text-xs leading-6 text-gray-400">Stages</a>
                                            </li>
                                            <li>
                                                <a href="{{ route('deals') }}" class="hover:text-white hover:bg-gray-800 block rounded-md py-2 pr-2 pl-9 text-xs leading-6 text-gray-400">Offered Deals</a>
                                            </li>
                                        </ul>
                                    </div>
                                </li>
                                @endcan
                                @can('manage_facebook_post')
                                <li>
                                    <div>
                                        <button type="button" class="hover:text-white hover:bg-gray-800 posts-drop-down flex items-center w-full text-left rounded-md p-2 gap-x-3 text-sm leading-6 font-semibold text-gray-400" aria-controls="sub-menu-1" aria-expanded="false">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                            </svg>
                                            Posts
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3.0" stroke="currentColor" class="w-3 h-3 flex justify-end ml-auto">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                            </svg>
                                        </button>
                                        <ul class="hidden mt-1 px-2" id="sub-menu-3">
                                            <li>
                                                <a href="{{ route('post-template-list') }}" class="hover:text-white hover:bg-gray-800 block rounded-md py-2 pr-2 pl-9 text-xs leading-6 text-gray-400">Post on Social Media</a>
                                            </li>
                                        </ul>
                                    </div>
                                </li>
                                <li>
                                    <a href="{{ route('page.list') }}" class="text-gray-400 hover:text-white hover:bg-gray-800 group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 3v11.25A2.25 2.25 0 006 16.5h2.25M3.75 3h-1.5m1.5 0h16.5m0 0h1.5m-1.5 0v11.25A2.25 2.25 0 0118 16.5h-2.25m-7.5 0h7.5m-7.5 0l-1 3m8.5-3l1 3m0 0l.5 1.5m-.5-1.5h-9.5m0 0l-.5 1.5m.75-9l3-3 2.148 2.148A12.061 12.061 0 0116.5 7.605" />
                                        </svg>
                                        SEO Audit Report
                                    </a>
                                </li>
                                @endcan
                                @can('manage_email_templates')
                                <li>
                                    <div>
                                        <button type="button" class="hover:text-white hover:bg-gray-800 emails-drop-down flex items-center w-full text-left rounded-md p-2 gap-x-3 text-sm leading-6 font-semibold text-gray-400" aria-controls="sub-menu-1" aria-expanded="false">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" />
                                            </svg>
                                            Emails
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3.0" stroke="currentColor" class="w-3 h-3 flex justify-end ml-auto">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                            </svg>
                                        </button>
                                        <ul class="hidden mt-1 px-2" id="sub-menu-4">
                                            <li>
                                                <a href="{{ route('email-categories') }}" class="hover:text-white hover:bg-gray-800 block rounded-md py-2 pr-2 pl-9 text-xs leading-6 text-gray-400">Email Categories</a>
                                            </li>
                                            <li>
                                                <a href="{{ route('email-templates') }}" class="hover:text-white hover:bg-gray-800 block rounded-md py-2 pr-2 pl-9 text-xs leading-6 text-gray-400">Email Templates</a>
                                            </li>
                                        </ul>
                                    </div>
                                </li>
                                @endcan
                                @can('manage_post_templates')
                                <li>
                                    <div>
                                        <button type="button" class="hover:text-white hover:bg-gray-800 post-templates-drop-down flex items-center w-full text-left rounded-md p-2 gap-x-3 text-sm leading-6 font-semibold text-gray-400" aria-controls="sub-menu-1" aria-expanded="false">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 7.5h1.5m-1.5 3h1.5m-7.5 3h7.5m-7.5 3h7.5m3-9h3.375c.621 0 1.125.504 1.125 1.125V18a2.25 2.25 0 01-2.25 2.25M16.5 7.5V18a2.25 2.25 0 002.25 2.25M16.5 7.5V4.875c0-.621-.504-1.125-1.125-1.125H4.125C3.504 3.75 3 4.254 3 4.875V18a2.25 2.25 0 002.25 2.25h13.5M6 7.5h3v3H6v-3z" />
                                            </svg>
                                            Post Templates
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3.0" stroke="currentColor" class="w-3 h-3 flex justify-end ml-auto">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                            </svg>
                                        </button>
                                        <ul class="hidden mt-1 px-2" id="sub-menu-5">
                                            <li>
                                                <a href="{{ route('post-template-categories') }}" class="hover:text-white hover:bg-gray-800 block rounded-md py-2 pr-2 pl-9 text-xs leading-6 text-gray-400">Post Categories</a>
                                            </li>
                                            <li>
                                                <a href="{{ route('post-templates') }}" class="hover:text-white hover:bg-gray-800 block rounded-md py-2 pr-2 pl-9 text-xs leading-6 text-gray-400">Post List</a>
                                            </li>
                                        </ul>
                                    </div>
                                </li>
                                @endcan
                                @can('manage_users_roles')
                                <li>
                                    <a href="{{ route('users-and-roles') }}" class="text-gray-400 hover:text-white hover:bg-gray-800 group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
                                        </svg>
                                        Users & Roles
                                    </a>
                                </li>
                                @endcan
                                @can('manage_notifications')
                                <li>
                                    <a href="{{ route('notification') }}" class="text-gray-400 hover:text-white hover:bg-gray-800 group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0M3.124 7.5A8.969 8.969 0 015.292 3m13.416 0a8.969 8.969 0 012.168 4.5" />
                                        </svg>
                                        Notifications
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('affiliate-list') }}" class="text-gray-400 hover:text-white hover:bg-gray-800 group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 14.15v4.25c0 1.094-.787 2.036-1.872 2.18-2.087.277-4.216.42-6.378.42s-4.291-.143-6.378-.42c-1.085-.144-1.872-1.086-1.872-2.18v-4.25m16.5 0a2.18 2.18 0 00.75-1.661V8.706c0-1.081-.768-2.015-1.837-2.175a48.114 48.114 0 00-3.413-.387m4.5 8.006c-.194.165-.42.295-.673.38A23.978 23.978 0 0112 15.75c-2.648 0-5.195-.429-7.577-1.22a2.016 2.016 0 01-.673-.38m0 0A2.18 2.18 0 013 12.489V8.706c0-1.081.768-2.015 1.837-2.175a48.111 48.111 0 013.413-.387m7.5 0V5.25A2.25 2.25 0 0013.5 3h-3a2.25 2.25 0 00-2.25 2.25v.894m7.5 0a48.667 48.667 0 00-7.5 0M12 12.75h.008v.008H12v-.008z" />
                                        </svg>
                                        Affiliate Partners
                                    </a>
                                </li>
                                @endcan
                                <li>
                                    <a href="https://www.2xmyleads.com/login" target="_blank" class="text-gray-400 hover:text-white hover:bg-gray-800 group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 8.25V18a2.25 2.25 0 002.25 2.25h13.5A2.25 2.25 0 0021 18V8.25m-18 0V6a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 6v2.25m-18 0h18M5.25 6h.008v.008H5.25V6zM7.5 6h.008v.008H7.5V6zm2.25 0h.008v.008H9.75V6z" />
                                        </svg>
                                        Training
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>

        <div class="lg:pl-52">
            <div class="sticky top-0 z-40 flex h-16 shrink-0 items-center gap-x-4 border-b border-gray-200 bg-white px-4 shadow-sm sm:gap-x-6 sm:px-6 lg:px-8">
                <button type="button" class="-m-2.5 p-2.5 text-gray-700 lg:hidden open-sidenav">
                    <span class="sr-only">Open sidebar</span>
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                    </svg>
                </button>
                <div class="h-6 w-px bg-gray-900/10 lg:hidden" aria-hidden="true"></div>
                <div class="flex justify-end flex-1 gap-x-4 self-stretch lg:gap-x-6">
                    <!-- Modal -->
                    @if (!$data)
                        <div class="relative z-10 lg:hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
                            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>
                            <div class="fixed inset-0 z-10 overflow-y-auto">
                                <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                                    <div class="relative transform overflow-hidden rounded-lg bg-white px-4 pb-4 pt-5 text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-sm sm:p-6">
                                        <div>
                                            <div class="mx-auto flex h-12 w-12 items-center justify-center rounded-full bg-red-100">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-red-600">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m0-10.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.75c0 5.592 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.57-.598-3.75h-.152c-3.196 0-6.1-1.249-8.25-3.286zm0 13.036h.008v.008H12v-.008z" />
                                                </svg>
                                            </div>
                                            <div class="mt-3 text-center sm:mt-5">
                                                <h3 class="text-base font-semibold leading-6 text-gray-900" id="modal-title">Action required</h3>
                                                <div class="mt-2">
                                                    <p class="text-xs text-gray-500">Activate your account by clicking the button below</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mt-5 sm:mt-6 text-center">
                                            <a href="{{ route('facebook.login') }}" class="w-1/2"><img src="{{ asset('img/facebook_button.png') }}" alt=""></a>
                                            <a href="https://www.2xmyleads.com/Privacy-Policies" target="_blank" class="text-xs leading-6 text-gray-600 mt-2 hover:text-gray-900"><u>Privacy Policy</u></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                    <div class="flex items-center gap-x-4 lg:gap-x-6">
                        <div class="relative">
                            <button type="button" class="-m-2.5 p-2.5 flex text-gray-400 hover:text-gray-500" id="notification-button">
                                <span class="sr-only">View notifications</span>
                                <svg class="h-6 w-6 mr-1" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0" />
                                </svg>
                                <span class="inline-flex items-center rounded-md bg-blue-100 px-2 py-1 text-xs font-medium text-blue-700" id="notifCount">{{ auth()->user()->unreadNotifications->count() }}</span>
                            </button>
                            <div class="hidden absolute right-0 z-10 mt-2.5 w-60 md:w-96 lg:w-96 origin-top-right rounded-md bg-white shadow-lg ring-1 ring-gray-900/5 focus:outline-none dropdown-notification" role="menu" aria-orientation="vertical" aria-labelledby="notification-menu-button" tabindex="-1">
                                @if (auth()->user()->unreadNotifications->isEmpty())
                                <div class="bg-white py-4 px-4 sm:px-6">
                                    <p class="text-gray-500 text-sm">No notifications</p>
                                </div>
                                @else
                                @php
                                    $i = 0;
                                @endphp
                                @foreach (auth()->user()->unreadNotifications as $notification)
                                    <div class="border-t rounded-sm border-gray-200 divide-y divide-gray-100">
                                        <a id="notification-title{{ $i }}" data-id="{{ $notification->id }}" class="cursor-pointer text-blue-500 hover:text-blue-800 flex items-center text-left w-full p-2 gap-x-3 text-sm leading-6 font-semibold">{{ $notification->data['title'] }}</a>
                                        <ul class="hidden mt-1 px-2" id="notification-menu{{ $i }}">
                                            <li>
                                                <p class="text-sm px-4 py-2">{!! $notification->data['message'] !!}</p>
                                            </li>
                                        </ul>
                                    </div>
                                @php
                                    $i++;
                                @endphp
                                @endforeach
                                @endif
                            </div>
                        </div>

                        <div class="hidden lg:block lg:h-6 lg:w-px lg:bg-gray-900/10" aria-hidden="true"></div>

                        <div class="relative">
                            <button type="button" class="-m-1.5 flex items-center p-1.5" id="user-menu-button" aria-expanded="false" aria-haspopup="true">
                                <span class="sr-only">Open user menu</span>
                                <img class="h-8 w-8 rounded-full bg-gray-50" src="{{ isset($data->avatar) ? $data->avatar : asset('img/profile.png') }}" alt="">
                                <span class="hidden lg:flex lg:items-center">
                                    <span class="ml-4 text-sm font-semibold leading-6 text-gray-900" aria-hidden="true">{{ $currentUser->first_name }}</span>
                                    <svg class="ml-2 h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                        <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
                                    </svg>
                                </span>
                            </button>

                            <div class="hidden absolute right-0 z-10 mt-2.5 w-32 origin-top-right rounded-md bg-white py-2 shadow-lg ring-1 ring-gray-900/5 focus:outline-none dropdown-menu" role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button" tabindex="-1">
                                <a href="{{ route('personal-info') }}" class="block px-3 py-1 text-sm leading-6 text-gray-900" role="menuitem" tabindex="-1" id="user-menu-item-0">Profile</a>
                                <a href="{{ route('business-information') }}" class="block px-3 py-1 text-sm leading-6 text-gray-900" role="menuitem" tabindex="-1" id="user-menu-item-1">Settings</a>
                                <a href="{{ route('logout') }}" class="block px-3 py-1 text-sm leading-6 text-gray-900" role="menuitem" tabindex="-1" id="user-menu-item-2">Sign out</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex flex-col min-h-screen">
                <main class="flex-grow py-10">
                    <div class="px-4 sm:px-6 lg:px-8">
                        @yield('content')
                    </div>
                </main>
                <footer class="bg-white">
                    <div class="mx-auto max-w-7xl overflow-hidden px-6 py-20 sm:py-24 lg:px-8">
                        <nav class="text-center" aria-label="Footer">
                            <div class="pb-1">
                                <a href="https://www.2xmyleads.com/Privacy-Policies" target="_blank" class="text-xs leading-6 text-gray-600 hover:text-gray-900"><u>Privacy Policy</u></a>
                            </div>
                        </nav>
                        <div class="mt-10 flex justify-center space-x-10">
                            <a href="https://www.facebook.com/2xMyLeads" target="_blank" class="text-gray-400 hover:text-gray-500">
                                <span class="sr-only">Facebook</span>
                                <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z" clip-rule="evenodd" />
                                </svg>
                            </a>
                            <a href="https://www.instagram.com/2xmyleads" target="_blank" class="text-gray-400 hover:text-gray-500">
                                <span class="sr-only">Instagram</span>
                                <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.45 2.525c.636-.247 1.363-.416 2.427-.465C8.901 2.013 9.256 2 11.685 2h.63zm-.081 1.802h-.468c-2.456 0-2.784.011-3.807.058-.975.045-1.504.207-1.857.344-.467.182-.8.398-1.15.748-.35.35-.566.683-.748 1.15-.137.353-.3.882-.344 1.857-.047 1.023-.058 1.351-.058 3.807v.468c0 2.456.011 2.784.058 3.807.045.975.207 1.504.344 1.857.182.466.399.8.748 1.15.35.35.683.566 1.15.748.353.137.882.3 1.857.344 1.054.048 1.37.058 4.041.058h.08c2.597 0 2.917-.01 3.96-.058.976-.045 1.505-.207 1.858-.344.466-.182.8-.398 1.15-.748.35-.35.566-.683.748-1.15.137-.353.3-.882.344-1.857.048-1.055.058-1.37.058-4.041v-.08c0-2.597-.01-2.917-.058-3.96-.045-.976-.207-1.505-.344-1.858a3.097 3.097 0 00-.748-1.15 3.098 3.098 0 00-1.15-.748c-.353-.137-.882-.3-1.857-.344-1.023-.047-1.351-.058-3.807-.058zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.802a3.333 3.333 0 100 6.666 3.333 3.333 0 000-6.666zm5.338-3.205a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z" clip-rule="evenodd" />
                                </svg>
                            </a>
                            <a href="https://www.linkedin.com/company/2xmyleads" target="_blank" class="text-gray-400 hover:text-gray-500">
                                <span class="sr-only">Twitter</span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="19px" height="19" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-6 w-6">
                                    <path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z"></path>
                                    <rect x="2" y="9" width="4" height="12"></rect>
                                    <circle cx="4" cy="4" r="2"></circle>
                                </svg>
                            </a>
                        </div>
                        <p class="mt-10 text-center text-xs leading-5 text-gray-500">&copy; 2023 2xMyBiz.com Marketing Inc. All rights reserved.</p>
                    </div>
                </footer>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    <script>
        $(document).ready(function(){
            <?php $maxNotifs = count(auth()->user()->unreadNotifications);
                for($i = 0; $i < $maxNotifs; $i++){ ?>
                    $('#notification-title<?php echo $i; ?>').click(function(){
                        var notificationId = $(this).data('id');
                        $.ajax({
                            url: '/notifications/' + notificationId + '/markAsRead',
                            method: 'GET',
                            success: function(response) {
                                $('#notifCount').text(response.notificationCount);
                            },
                            error: function(xhr) {
                                //
                            }
                        });
                        $('#notification-menu<?php echo $i; ?>').toggle('hidden');
                    });
            <?php } ?>
        });
    </script>
    @yield('js')
</body>

</html>
