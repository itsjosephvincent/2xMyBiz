@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/lead-profile.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
@endsection

@section('title', 'Lead Profile | 2xMyLeads')

@section('content')
    <div class="grid grid-cols-1">
        <div class="col-span-1">
            <button id="backBtn" class="inline-flex items-center gap-x-1.5 rounded bg-indigo-50 px-2 py-1 text-xs font-semibold text-black shadow-sm hover:bg-indigo-100">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="-ml-0.5 h-5 w-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
                </svg>
                Go back
            </button>
        </div>
    </div>

    <div class="border border-gray-200 bg-white px-4 py-5 sm:px-6 mt-4">
        <div class="grid grid-cols-1 lg:grid-cols-3">
            <div class="col-span-1 flex justify-center">
                <img class="inline-block h-28 w-28 rounded-full" src="{{ isset($lead->linkedin) ? asset('img/org.png') : $lead->lead_photo }}" alt="">
            </div>
            <div class="lg:col-span-1 flex lg:justify-start mt-2 lg:mt-0">
                <div class="grid grid-rows-4 view">
                    <div class="lg:mx-0 mx-12">
                        <p class="text-lg text-center lg:text-left font-medium">{{ $lead->lead_name }}</p>
                    </div>
                    <div class="text-xs text-center lg:text-left text-gray-500 lg:mx-0 mx-14">{{ isset($lead->email) ? trim(str_replace(['[', ']', '"'], '', $lead->email)) : 'No email address' }}</div>
                    <div class="text-xs text-center lg:text-left text-gray-500 lg:mx-0 mx-14"><span class="inline-flex flex-shrink-0 items-center rounded-full bg-{{ $lead->lead_class_name }} px-1.5 py-0.5 text-xs text-white ring-1 ring-green-600/20">{{ $lead->lead_group_name }}</span></div>
                    <div class="text-xs text-center lg:text-left text-gray-500 lg:mx-0 mx-14"><a href="{{ $lead->website }}" target="_blank" class="text-blue-500 underline">Visit website</a></div>
                </div>
            </div>
            <div class="lg:col-span-1 flex lg:justify-start lg:mt-0">
                <div class="grid grid-rows-2">
                    <div class="flex justify-center">
                        <div class="mb-4 flex-shrink-0 sm:mb-0 sm:mr-4">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="text-pipexblue w-8 h-8">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                            </svg>
                        </div>
                        <div class="ml-2 lg:ml-0">
                            <h4 class="text-xs">Lead group:</h4>
                            <span class="inline-flex mt-1 flex-shrink-0 items-center rounded-full bg-{{ $lead->leadclassname }} px-1.5 py-0.5 text-xs text-white ring-1 ring-green-600/20">{{ $lead->organization_name }}</span>
                        </div>
                    </div>
                    <div class="flex mx-16 lg:mt-1">
                        <div class="mb-4 flex-shrink-0 sm:mb-0 sm:mr-4">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8 text-pipexblue">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5" />
                            </svg>
                        </div>
                        <div class="ml-2 lg:ml-0">
                            <h4 class="text-xs">Created:</h4>
                            <p class="mt-1 text-xs">{{ date('m-d-Y', strtotime($lead->created_at)) }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 lg:space-x-4">
        <div class="lg:col-span-1">
            <div class="border border-gray-200 bg-white px-4 py-5 sm:px-6 mt-4">
                <div>
                    <div class="sm:flex sm:items-center">
                        <div class="sm:flex-auto">
                        <h1 class="text-base font-semibold leading-6 text-gray-900">Lead information</h1>
                        </div>
                        <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
                            <button id="editInfoBtn" class="inline-flex items-center gap-x-1.5 rounded bg-indigo-50 px-2 py-1 text-xs font-semibold text-black shadow-sm hover:bg-indigo-100">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="-ml-0.5 h-5 w-5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125" />
                                </svg>
                                Edit
                            </button>
                        </div>
                    </div>
                    <div class="mt-8 flow-root">
                        <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                            <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                                <table class="min-w-full divide-y divide-gray-300">
                                    <tbody>
                                        <tr>
                                            <td class="whitespace-nowrap py-4 pl-4 pr-3 text-xs font-medium text-gray-900 sm:pl-0">Name</td>
                                            <td class="whitespace-nowrap px-3 py-4 text-xs text-gray-500">{{ $lead->lead_name }}</td>
                                        </tr>
                                        <tr>
                                            <td class="whitespace-nowrap py-4 pl-4 pr-3 text-xs font-medium text-gray-900 sm:pl-0">Email</td>
                                            <td class="whitespace-nowrap px-3 py-4 text-xs text-gray-500">{{ isset($lead->email) ? trim(str_replace(['[', ']', '"'], '', $lead->email)) : 'N/A' }}</td>
                                        </tr>
                                        <tr>
                                            <td class="whitespace-nowrap py-4 pl-4 pr-3 text-xs font-medium text-gray-900 sm:pl-0">Deal</td>
                                            <td class="whitespace-nowrap px-3 py-4 text-xs text-gray-500">{{ isset($lead->deal_title) ? $lead->deal_title : 'N/A' }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @if (isset($details))
            <div class="border border-gray-200 bg-white px-4 py-5 sm:px-6 mt-4">
                <div>
                    <div class="sm:flex sm:items-center">
                        <div class="sm:flex-auto">
                            <h1 class="text-base font-semibold leading-6 text-gray-900">Additional information</h1>
                        </div>
                    </div>
                    <div class="mt-8 flow-root">
                        <div class="-mx-4 -my-2 overflow-scroll h-32 sm:-mx-6">
                            <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                                <table class="min-w-full divide-y divide-gray-300">
                                    <tbody>
                                        <tr>
                                            <td class="whitespace-nowrap py-4 pl-4 pr-3 text-xs font-medium text-gray-900 sm:pl-0">About Message</td>
                                            <td class="whitespace-nowrap px-3 py-4 text-xs text-gray-500">{{ $details->about ?? 'Page has no about message' }}</td>
                                        </tr>
                                        <tr>
                                            <td class="whitespace-nowrap py-4 pl-4 pr-3 text-xs font-medium text-gray-900 sm:pl-0">Facebook Category</td>
                                            <td class="whitespace-nowrap px-3 py-4 text-xs text-gray-500">{{ $details->category }}</td>
                                        </tr>
                                        <tr>
                                            <td class="whitespace-nowrap py-4 pl-4 pr-3 text-xs font-medium text-gray-900 sm:pl-0">New Page Experience</td>
                                            <td class="whitespace-nowrap px-3 py-4 text-xs text-gray-500">
                                                @if ($details->has_transitioned_to_new_page_experience == 0)
                                                Page has not transitioned
                                                @else
                                                Page has transitioned
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="whitespace-nowrap py-4 pl-4 pr-3 text-xs font-medium text-gray-900 sm:pl-0">Community Page</td>
                                            <td class="whitespace-nowrap px-3 py-4 text-xs text-gray-500">
                                                @if ($details->community_page == 0)
                                                Page is not community type
                                                @else
                                                Page is community type
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="whitespace-nowrap py-4 pl-4 pr-3 text-xs font-medium text-gray-900 sm:pl-0">Verified</td>
                                            <td class="whitespace-nowrap px-3 py-4 text-xs text-gray-500">
                                                @if ($details->verification_status == 'not_verified')
                                                Page is not verified
                                                @else
                                                Page is verified
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="whitespace-nowrap py-4 pl-4 pr-3 text-xs font-medium text-gray-900 sm:pl-0">Published</td>
                                            <td class="whitespace-nowrap px-3 py-4 text-xs text-gray-500">
                                                @if ($details->is_published == 1)
                                                Page is published
                                                @else
                                                Page is not published
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="whitespace-nowrap py-4 pl-4 pr-3 text-xs font-medium text-gray-900 sm:pl-0">Messenger Bot</td>
                                            <td class="whitespace-nowrap px-3 py-4 text-xs text-gray-500">
                                                @if ($details->is_messenger_platform_bot == 0)
                                                Messenger bot is disabled
                                                @else
                                                Messenger bot is enabled
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="whitespace-nowrap py-4 pl-4 pr-3 text-xs font-medium text-gray-900 sm:pl-0">Place Type</td>
                                            <td class="whitespace-nowrap px-3 py-4 text-xs text-gray-500">{{ $details->place_type ?? 'Page has no place type'}}</td>
                                        </tr>
                                        <tr>
                                            <td class="whitespace-nowrap py-4 pl-4 pr-3 text-xs font-medium text-gray-900 sm:pl-0">Fan count</td>
                                            <td class="whitespace-nowrap px-3 py-4 text-xs text-gray-500">{{ $details->fan_count }}</td>
                                        </tr>
                                        <tr>
                                            <td class="whitespace-nowrap py-4 pl-4 pr-3 text-xs font-medium text-gray-900 sm:pl-0">Follower count</td>
                                            <td class="whitespace-nowrap px-3 py-4 text-xs text-gray-500">{{ $details->followers_count }}</td>
                                        </tr>
                                        <tr>
                                            <td class="whitespace-nowrap py-4 pl-4 pr-3 text-xs font-medium text-gray-900 sm:pl-0">Check in count</td>
                                            <td class="whitespace-nowrap px-3 py-4 text-xs text-gray-500">{{ $details->checkins }}</td>
                                        </tr>
                                        <tr>
                                            <td class="whitespace-nowrap py-4 pl-4 pr-3 text-xs font-medium text-gray-900 sm:pl-0">Were here count</td>
                                            <td class="whitespace-nowrap px-3 py-4 text-xs text-gray-500">{{ $details->were_here_count }}</td>
                                        </tr>
                                        <tr>
                                            <td class="whitespace-nowrap py-4 pl-4 pr-3 text-xs font-medium text-gray-900 sm:pl-0">Overall Star Ratings</td>
                                            <td class="whitespace-nowrap px-3 py-4 text-xs text-gray-500">{{ $details->overall_star_rating ?? 'No star rating' }}</td>
                                        </tr>
                                        <tr>
                                            <td class="whitespace-nowrap py-4 pl-4 pr-3 text-xs font-medium text-gray-900 sm:pl-0">Ratings</td>
                                            <td class="whitespace-nowrap px-3 py-4 text-xs text-gray-500">{{ $details->rating_count ?? 'No rating' }}</td>
                                        </tr>
                                        <tr>
                                            <td class="whitespace-nowrap py-4 pl-4 pr-3 text-xs font-medium text-gray-900 sm:pl-0">Talking About Count</td>
                                            <td class="whitespace-nowrap px-3 py-4 text-xs text-gray-500">{{ $details->talking_about_count }}</td>
                                        </tr>
                                        <tr>
                                            <td class="whitespace-nowrap py-4 pl-4 pr-3 text-xs font-medium text-gray-900 sm:pl-0">Price Range</td>
                                            <td class="whitespace-nowrap px-3 py-4 text-xs text-gray-500">{{ $details->price_range ?? 'Page has no price range' }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif
            <div class="border border-gray-200 bg-white px-4 py-5 sm:px-6 mt-4">
                <div>
                    <div class="sm:flex sm:items-center">
                        <div class="sm:flex-auto">
                        <h1 class="text-base font-semibold leading-6 text-gray-900">Address</h1>
                        </div>
                        <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
                            <button id="editAddressBtn" class="inline-flex items-center gap-x-1.5 rounded bg-indigo-50 px-2 py-1 text-xs font-semibold text-black shadow-sm hover:bg-indigo-100">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="-ml-0.5 h-5 w-5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125" />
                                </svg>
                                Edit
                            </button>
                        </div>
                    </div>
                    <div class="mt-8 flow-root">
                        <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                            <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                                <table class="min-w-full divide-y divide-gray-300">
                                    <tbody>
                                        <tr>
                                            <td class="whitespace-nowrap py-4 pl-4 pr-3 text-xs font-medium text-gray-900 sm:pl-0">Country</td>
                                            <td class="whitespace-nowrap px-3 py-4 text-xs text-gray-500">{{ isset($lead->country) ? $lead->country : '' }}</td>
                                        </tr>
                                        <tr>
                                            <td class="whitespace-nowrap py-4 pl-4 pr-3 text-xs font-medium text-gray-900 sm:pl-0">City</td>
                                            <td class="whitespace-nowrap px-3 py-4 text-xs text-gray-500">{{ isset($lead->city) ? $lead->city : '' }}</td>
                                        </tr>
                                        <tr>
                                            <td class="whitespace-nowrap py-4 pl-4 pr-3 text-xs font-medium text-gray-900 sm:pl-0">State</td>
                                            <td class="whitespace-nowrap px-3 py-4 text-xs text-gray-500">{{ isset($lead->state) ? $lead->state : '' }}</td>
                                        </tr>
                                        <tr>
                                            <td class="whitespace-nowrap py-4 pl-4 pr-3 text-xs font-medium text-gray-900 sm:pl-0">Zip</td>
                                            <td class="whitespace-nowrap px-3 py-4 text-xs text-gray-500">{{ isset($lead->zip) ? $lead->zip : '' }}</td>
                                        </tr>
                                        <tr>
                                            <td class="whitespace-nowrap py-4 pl-4 pr-3 text-xs font-medium text-gray-900 sm:pl-0">Street</td>
                                            <td class="whitespace-nowrap px-3 py-4 text-xs text-gray-500">{{ isset($lead->street) ? $lead->street : '' }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="lg:col-span-2">
            <div class="border border-gray-200 bg-white px-4 py-5 sm:px-6 mt-4">
                <div class="block">
                    <div class="border-b border-gray-200">
                        <nav class="-mb-px flex justify-center" aria-label="Tabs">
                            <a id="activityBtn" class="cursor-pointer border-indigo-500 text-indigo-600 w-1/4 border-b-2 py-4 px-1 text-center text-sm font-medium" aria-current="page">Activity</a>
                            <a id="fileBtn" class="cursor-pointer border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700 w-1/4 border-b-2 py-4 px-1 text-center text-sm font-medium">File</a>
                            <a id="noteBtn" class="cursor-pointer border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700 w-1/4 border-b-2 py-4 px-1 text-center text-sm font-medium">Note</a>
                        </nav>
                    </div>
                </div>
                <div class="activity">
                    <form action="{{ route('save-activity') }}" method="post">
                        @csrf
                        <input type="hidden" name="secret" value="{{ $lead->id }}">
                        <div class="mt-6">
                            <p class="text-sm text-gray-500">Activity Type</p>
                            <fieldset class="mt-4">
                                <div class="space-y-4 sm:flex sm:items-center sm:space-x-10 sm:space-y-0">
                                    <div class="flex items-center">
                                        <input name="activity" value="Call" type="radio" class="h-4 w-4 border-gray-300 text-indigo-600 focus:ring-indigo-600" required>
                                        <label class="ml-3 block text-sm font-medium leading-6 text-gray-900">Call</label>
                                    </div>
                                    <div class="flex items-center">
                                        <input name="activity" value="Meeting" type="radio" class="h-4 w-4 border-gray-300 text-indigo-600 focus:ring-indigo-600" required>
                                        <label class="ml-3 block text-sm font-medium leading-6 text-gray-900">Meeting</label>
                                    </div>
                                    <div class="flex items-center">
                                        <input name="activity" value="Email" type="radio" class="h-4 w-4 border-gray-300 text-indigo-600 focus:ring-indigo-600" required>
                                        <label class="ml-3 block text-sm font-medium leading-6 text-gray-900">Email</label>
                                    </div>
                                    <div class="flex items-center">
                                        <input name="activity" value="Task" type="radio" class="h-4 w-4 border-gray-300 text-indigo-600 focus:ring-indigo-600" required>
                                        <label class="ml-3 block text-sm font-medium leading-6 text-gray-900">Task</label>
                                    </div>
                                    <div class="flex items-center">
                                        <input name="activity" value="Deadline" type="radio" class="h-4 w-4 border-gray-300 text-indigo-600 focus:ring-indigo-600" required>
                                        <label class="ml-3 block text-sm font-medium leading-6 text-gray-900">Deadline</label>
                                    </div>
                                    <div class="flex items-center">
                                        <input name="activity" value="Others" type="radio" class="h-4 w-4 border-gray-300 text-indigo-600 focus:ring-indigo-600" required>
                                        <label class="ml-3 block text-sm font-medium leading-6 text-gray-900">Others</label>
                                    </div>
                                </div>
                            </fieldset>
                        </div>
                        <div class="space-y-12">
                            <div>
                                <div class="mt-4 grid grid-cols-1 gap-x-6 gap-y-2 sm:grid-cols-6">
                                    <div class="sm:col-span-3">
                                        <label class="block text-sm font-medium leading-6 text-gray-900">Title</label>
                                        <div>
                                            <div class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">
                                                <input type="text" name="title" class="block flex-1 border-0 bg-transparent py-1.5 pl-1 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-span-full">
                                        <label class="block text-sm font-medium leading-6 text-gray-900">Description</label>
                                        <div>
                                            <textarea name="description" rows="3" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" required></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="grid grid-cols-2 space-x-4">
                            <div class="mt-4">
                                <label class="block text-sm font-medium leading-6 text-gray-900">Start Date</label>
                                <div>
                                    <input type="text" name="set_date_from" id="datepickerFrom" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" required>
                                </div>
                            </div>
                            <div class="mt-4">
                                <label class="block text-sm font-medium leading-6 text-gray-900">Start Time</label>
                                <div>
                                    <input type="text" name="set_time_from" id="timepickerFrom" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" required>
                                </div>
                            </div>
                        </div>
                        <div class="grid grid-cols-2 space-x-4">
                            <div class="mt-4">
                                <label class="block text-sm font-medium leading-6 text-gray-900">End Date</label>
                                <div>
                                    <input type="text" name="set_date_to" id="datepickerTo" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" required>
                                </div>
                            </div>
                            <div class="mt-4">
                                <label class="block text-sm font-medium leading-6 text-gray-900">End Time</label>
                                <div>
                                    <input type="text" name="set_time_to" id="timepickerTo" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" required>
                                </div>
                            </div>
                        </div>
                        <div class="mt-4">
                            <button type="submit" class="rounded bg-pipexblue px-2 py-1 text-sm font-semibold text-white shadow-sm hover:bg-blue-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Save</button>
                        </div>
                    </form>
                </div>
                <div class="file hidden">
                    <form action="{{ route('upload-file') }}" enctype="multipart/form-data" method="post">
                    @csrf
                        <input type="hidden" value="{{ $lead->id }}" name="secret">
                        <div class="col-span-full">
                            <div class="mt-2 flex justify-center rounded-lg border border-dashed border-gray-900/25 px-6 py-10">
                                <div class="text-center">
                                    <svg class="mx-auto h-12 w-12 text-gray-300" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                                        <path fill-rule="evenodd" d="M1.5 6a2.25 2.25 0 012.25-2.25h16.5A2.25 2.25 0 0122.5 6v12a2.25 2.25 0 01-2.25 2.25H3.75A2.25 2.25 0 011.5 18V6zM3 16.06V18c0 .414.336.75.75.75h16.5A.75.75 0 0021 18v-1.94l-2.69-2.689a1.5 1.5 0 00-2.12 0l-.88.879.97.97a.75.75 0 11-1.06 1.06l-5.16-5.159a1.5 1.5 0 00-2.12 0L3 16.061zm10.125-7.81a1.125 1.125 0 112.25 0 1.125 1.125 0 01-2.25 0z" clip-rule="evenodd" />
                                    </svg>
                                    <div class="mt-4 flex text-sm leading-6 text-gray-600">
                                        <label for="file-upload" class="relative cursor-pointer rounded-md bg-white font-semibold text-indigo-600 focus-within:outline-none focus-within:ring-2 focus-within:ring-indigo-600 focus-within:ring-offset-2 hover:text-indigo-500">
                                            <span id="selectFile">Select a file</span>
                                            <input id="file-upload" name="file_upload" type="file" class="sr-only" required>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mt-4 flex justify-center">
                            <button type="submit" class="rounded bg-pipexblue px-2 py-1 text-sm font-semibold text-white shadow-sm hover:bg-blue-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Upload</button>
                        </div>
                    </form>
                </div>
                <div class="note hidden">
                    <form action="{{ route('save-note') }}" method="post">
                        @csrf
                        <input type="hidden" value={{ $lead->id }} name="secret">
                        <div class="space-y-12">
                            <div>
                                <div class="mt-4 grid grid-cols-1 gap-x-6 gap-y-2 sm:grid-cols-6">
                                    <div class="sm:col-span-3">
                                        <label class="block text-sm font-medium leading-6 text-gray-900">Title</label>
                                        <div>
                                            <div class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">
                                                <input type="text" name="note_title" class="block flex-1 border-0 bg-transparent py-1.5 pl-1 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-span-full">
                                        <label class="block text-sm font-medium leading-6 text-gray-900">Description</label>
                                        <div>
                                            <textarea name="note_message" rows="3" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" required></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mt-4">
                            <button type="submit" class="rounded bg-pipexblue px-2 py-1 text-sm font-semibold text-white shadow-sm hover:bg-blue-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Save</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="border border-gray-200 bg-white px-4 py-5 sm:px-6 mt-4">
                <div>
                    <div class="block">
                        <div class="border-b border-gray-200">
                            <nav class="-mb-px flex justify-center" aria-label="Tabs">
                                <a id="toDoBtn" class="border-indigo-500 text-indigo-600 w-1/4 border-b-2 py-4 px-1 text-center text-sm font-medium" aria-current="page">To Do</a>
                                <a id="doneBtn" class="border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700 w-1/4 border-b-2 py-4 px-1 text-center text-sm font-medium">Done</a>
                                <a id="filesBtn" class="border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700 w-1/4 border-b-2 py-4 px-1 text-center text-sm font-medium">Files</a>
                                <a id="notesBtn" class="border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700 w-1/4 border-b-2 py-4 px-1 text-center text-sm font-medium">Notes</a>
                            </nav>
                        </div>
                    </div>
                    <div class="toDo">
                        @if ($pendingActivities->isEmpty())
                        <div class="border rounded-lg border-gray-200 bg-white px-4 sm:px-6 mt-2">
                            <div class="grid grid-rows-2 place-items-center">
                                <div>
                                    <img src="{{ asset('img/no_data.png') }}" class="w-28 mt-2" alt="no data">
                                </div>
                                <div>
                                    <p class="text-gray-500 text-sm">No data yet.</p>
                                </div>
                            </div>
                        </div>
                        @else
                        <div class="px-4 sm:px-6 lg:px-8">
                            <div class="flow-root">
                                <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                                    <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                                        <table class="min-w-full divide-y divide-gray-300">
                                            <thead>
                                                <tr>
                                                    <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-0">Type</th>
                                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Title</th>
                                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">From</th>
                                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">To</th>
                                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody class="divide-y divide-gray-200">
                                                @foreach ($pendingActivities as $pending)
                                                <tr>
                                                    <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-0">{{ $pending->activity_type }}</td>
                                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $pending->title }}</td>
                                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $pending->date_from }} - {{ $pending->time_from }}</td>
                                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $pending->date_to }} - {{ $pending->time_to }}</td>
                                                    <td class="relative whitespace-nowrap text-sm font-medium sm:pr-0">
                                                        <a href="{{ route('update-activity-status', $pending->id) }}" class="text-pipexblue hover:text-blue-500">Mark done</a>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                    <div class="done hidden">
                        @if ($doneActivities->isEmpty())
                        <div class="border rounded-lg border-gray-200 bg-white px-4 sm:px-6 mt-2">
                            <div class="grid grid-rows-2 place-items-center">
                                <div>
                                    <img src="{{ asset('img/no_data.png') }}" class="w-28 mt-2" alt="no data">
                                </div>
                                <div>
                                    <p class="text-gray-500 text-sm">No data yet.</p>
                                </div>
                            </div>
                        </div>
                        @else
                        <div class="px-4 sm:px-6 lg:px-8">
                            <div class="flow-root">
                                <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                                    <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                                        <table class="min-w-full divide-y divide-gray-300">
                                            <thead>
                                                <tr>
                                                    <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-0">Type</th>
                                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Title</th>
                                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">From</th>
                                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">To</th>
                                                </tr>
                                            </thead>
                                            <tbody class="divide-y divide-gray-200">
                                                @foreach ($doneActivities as $done)
                                                <tr>
                                                    <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-0">{{ $done->activity_type }}</td>
                                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $done->title }}</td>
                                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $done->date_from }} - {{ $done->time_from }}</td>
                                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $done->date_to }} - {{ $done->time_to }}</td>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                    <div class="files hidden">
                        @if ($leadfiles->isEmpty())
                        <div class="border rounded-lg border-gray-200 bg-white px-4 sm:px-6 mt-2">
                            <div class="grid grid-rows-2 place-items-center">
                                <div>
                                    <img src="{{ asset('img/no_data.png') }}" class="w-28 mt-2" alt="no data">
                                </div>
                                <div>
                                    <p class="text-gray-500 text-sm">No data yet.</p>
                                </div>
                            </div>
                        </div>
                        @else
                        <div class="px-4 sm:px-6 lg:px-8">
                            <div class="flow-root">
                                <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                                    <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                                        <table class="min-w-full divide-y divide-gray-300">
                                            <thead>
                                                <tr>
                                                    <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-0">File name</th>
                                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody class="divide-y divide-gray-200">
                                                @foreach ($leadfiles as $leadfile)
                                                <tr>
                                                    <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-0">{{ $leadfile->file_name }}</td>
                                                    <td class="relative whitespace-nowrap text-sm font-medium sm:pr-0">
                                                        <a href="{{ $leadfile->file_path }}" target="_blank" class="text-pipexblue hover:text-blue-500">View</a>
                                                    </td>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                    <div class="notes hidden">
                        @if ($leadnotes->isEmpty())
                        <div class="border rounded-lg border-gray-200 bg-white px-4 sm:px-6 mt-2">
                            <div class="grid grid-rows-2 place-items-center">
                                <div>
                                    <img src="{{ asset('img/no_data.png') }}" class="w-28 mt-2" alt="no data">
                                </div>
                                <div>
                                    <p class="text-gray-500 text-sm">No data yet.</p>
                                </div>
                            </div>
                        </div>
                        @else
                        <div class="px-4 sm:px-6 lg:px-8">
                            <div class="mt-8 flow-root">
                                <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                                <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                                    <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 sm:rounded-lg">
                                    <table class="min-w-full divide-y divide-gray-300">
                                        <thead class="bg-gray-50">
                                        <tr>
                                            <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">Title</th>
                                            <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6">
                                            <span class="sr-only">View</span>
                                            </th>
                                        </tr>
                                        </thead>
                                        <tbody class="divide-y divide-gray-200 bg-white">
                                            @php
                                                $i = 0;
                                            @endphp
                                            @foreach ($leadnotes as $leadnote)
                                            <tr>
                                                <input type="hidden" id="leadnotetoken{{ $i }}" value="{{ $leadnote->id }}">
                                                <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6">{{ $leadnote->title }}</td>
                                                <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-6">
                                                    <a id="viewNoteBtn{{ $i }}" class="cursor-pointer text-indigo-600 hover:text-indigo-900">View<span class="sr-only">, {{ $leadnote->title }}</span></a>
                                                </td>
                                            </tr>
                                            @php
                                                $i++;
                                            @endphp
                                            @endforeach
                                        </tbody>
                                    </table>
                                    </div>
                                </div>
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="relative z-10 edit-info hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>
        <div class="fixed inset-0 z-10 overflow-y-auto">
            <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                <div class="relative transform overflow-hidden rounded-lg bg-white px-4 pb-4 pt-5 text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg sm:p-6">
                    <div>
                        <h3 class="text-base font-semibold leading-6 text-gray-900" id="modal-title">Update lead information</h3>
                    </div>
                    <form action="{{ route('update-lead', $lead->id) }}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="mt-2">
                            <label class="block text-sm font-medium leading-6 text-gray-900">Page name</label>
                            <div>
                                <input type="text" name="lead_name" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" value="{{ $lead->lead_name }}">
                            </div>
                        </div>
                        <div class="mt-2">
                            <label class="block text-sm font-medium leading-6 text-gray-900">Email</label>
                            <div>
                                <input type="email" name="lead_email" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" value="{{ isset($lead->email) ? trim(str_replace(['[', ']', '"'], '', $lead->email)) : '' }}">
                            </div>
                        </div>
                        <div class="mt-2">
                            <label class="block text-sm font-medium leading-6 text-gray-900">Lead group</label>
                            <select name="organizations" class="block w-full rounded-md border-0 py-1.5 pl-3 pr-10 text-gray-900 ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                <option value="" selected disabled>Select Lead Group</option>
                                @foreach ($organizations as $organization)
                                <option value="{{ $organization->id }}">{{ $organization->organization_name }}</option>
                                @endforeach
                                @foreach ($myorganizations as $myorganization)
                                <option value="{{ $myorganization->id }}">{{ $myorganization->organization_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mt-2">
                            <label class="block text-sm font-medium leading-6 text-gray-900">Deals</label>
                            <select name="deals" class="block w-full rounded-md border-0 py-1.5 pl-3 pr-10 text-gray-900 ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                <option value="" selected disabled>Select Deal</option>
                                @foreach ($deals as $deal)
                                    <option value="{{ $deal->id }}">{{ $deal->deal_title }}</option>
                                @endforeach
                                @if (isset($mydeals))
                                    @foreach ($mydeals as $mydeal)
                                        <option value="{{ $mydeal->id }}">{{ $mydeal->deal_title }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="mt-2">
                            <label class="block text-sm font-medium leading-6 text-gray-900">Stage</label>
                            <select name="leadgroups" class="block w-full rounded-md border-0 py-1.5 pl-3 pr-10 text-gray-900 ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                <option value="" selected disabled>Select Stage</option>
                                @foreach ($leadgroups as $leadgroup)
                                    <option value="{{ $leadgroup->id }}">{{ $leadgroup->lead_group_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mt-5 sm:mt-6 sm:grid sm:grid-flow-row-dense sm:grid-cols-2 sm:gap-3">
                            <button type="submit" class="inline-flex w-full justify-center rounded-md bg-pipexblue px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-blue-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 sm:col-start-2">Update</button>
                            <button type="button" id="cancelEditInfoBtn" class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:col-start-1 sm:mt-0">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="relative z-10 edit-address hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>
        <div class="fixed inset-0 z-10 overflow-y-auto">
            <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                <div class="relative transform overflow-hidden rounded-lg bg-white px-4 pb-4 pt-5 text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg sm:p-6">
                    <div>
                        <h3 class="text-base font-semibold leading-6 text-gray-900" id="modal-title">Update lead address</h3>
                    </div>
                    <form action="{{ route('update-lead-address', $lead->id) }}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="mt-2">
                            <label class="block text-sm font-medium leading-6 text-gray-900">Country</label>
                            <select name="country" class="block w-full rounded-md border-0 py-1.5 pl-3 pr-10 text-gray-900 ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                <option value="" selected disabled>Select country</option>
                                @foreach ($countries as $country)
                                    <option value="{{ $country->country_name }}">{{ $country->country_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mt-2">
                            <label class="block text-sm font-medium leading-6 text-gray-900">City</label>
                            <div>
                                <input type="text" name="city" value="{{ isset($lead->city) ? $lead->city : '' }}" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                            </div>
                        </div>
                        <div class="mt-2">
                            <label class="block text-sm font-medium leading-6 text-gray-900">State</label>
                            <div>
                                <input type="text" name="city" value="{{ isset($lead->state) ? $lead->state : '' }}" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                            </div>
                        </div>
                        <div class="mt-2">
                            <label class="block text-sm font-medium leading-6 text-gray-900">Zip</label>
                            <div>
                                <input type="text" name="city" value="{{ isset($lead->zip) ? $lead->zip : '' }}" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                            </div>
                        </div>
                        <div class="mt-2">
                            <label class="block text-sm font-medium leading-6 text-gray-900">Street</label>
                            <div>
                                <input type="text" name="city" value="{{ isset($lead->street) ? $lead->street : '' }}" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                            </div>
                        </div>
                        <div class="mt-5 sm:mt-6 sm:grid sm:grid-flow-row-dense sm:grid-cols-2 sm:gap-3">
                            <button type="submit" class="inline-flex w-full justify-center rounded-md bg-pipexblue px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-blue-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 sm:col-start-2">Update</button>
                            <button type="button" id="cancelEditAddrBtn" class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:col-start-1 sm:mt-0">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="relative z-10 edit-note hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>
        <div class="fixed inset-0 z-10 overflow-y-auto">
            <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                <div class="relative transform overflow-hidden rounded-lg bg-white px-4 pb-4 pt-5 text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg sm:p-6">
                    <form action="{{ route('update-lead-note') }}" method="post">
                        @csrf
                        <input type="hidden" name="lead_id" id="lead_id">
                        <div class="mt-2">
                            <label class="block text-sm font-medium leading-6 text-gray-900">Title</label>
                            <div>
                                <input type="text" name="note_title" id="edit-note-title" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" value="{{ $lead->lead_name }}">
                            </div>
                        </div>
                        <div class="mt-2">
                            <label for="note_messagte" class="block text-sm font-medium leading-6 text-gray-900">Description</label>
                            <div>
                              <textarea rows="4" name="note_message" id="edit_note_message" class="block w-full rounded-md border-0 resize-none py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"></textarea>
                            </div>
                        </div>
                        <div class="mt-5 sm:mt-6 sm:grid sm:grid-flow-row-dense sm:grid-cols-2 sm:gap-3">
                            <button type="submit" class="inline-flex w-full justify-center rounded-md bg-pipexblue px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-blue-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 sm:col-start-2">Update</button>
                            <button type="button" id="cancelEditNoteBtn" class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:col-start-1 sm:mt-0">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @include('sweetalert::alert')
@endsection

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
        $(document).ready(function() {
            $('#editInfoBtn').click(function(){
                $('.edit-info').toggle('hidden');
            });

            $('#cancelEditInfoBtn').click(function(){
                $('.edit-info').toggle('hidden');
            });

            $('#cancelEditNoteBtn').click(function(){
                $('.edit-note').toggle('hidden');
            });

            $('#editAddressBtn').click(function(){
                $('.edit-address').toggle('hidden');
            });

            $('#cancelEditAddrBtn').click(function(){
                $('.edit-address').toggle('hidden');
            });

            $('#file-upload').change(function() {
                if ($(this).val()) {
                    $('#selectFile').text('File is ready for upload');
                } else {
                    $('#selectFile').text('Select a file');
                }
            });

            $('#backBtn').click(function(){
                window.history.back();
            });

            $('#activityBtn').click(function(){
                $('#activityBtn').removeClass('border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700 w-1/4 border-b-2 py-4 px-1 text-center text-sm font-medium');
                $('#activityBtn').addClass('border-indigo-500 text-indigo-600 w-1/4 border-b-2 py-4 px-1 text-center text-sm font-medium');
                $('#fileBtn').removeClass('border-indigo-500 text-indigo-600 w-1/4 border-b-2 py-4 px-1 text-center text-sm font-medium');
                $('#fileBtn').addClass('border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700 w-1/4 border-b-2 py-4 px-1 text-center text-sm font-medium');
                $('#noteBtn').removeClass('border-indigo-500 text-indigo-600 w-1/4 border-b-2 py-4 px-1 text-center text-sm font-medium');
                $('#noteBtn').addClass('border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700 w-1/4 border-b-2 py-4 px-1 text-center text-sm font-medium');
                $('.activity').removeClass('hidden');
                $('.file').addClass('hidden');
                $('.note').addClass('hidden');
            });

            $('#fileBtn').click(function(){
                $('#activityBtn').removeClass('border-indigo-500 text-indigo-600 w-1/4 border-b-2 py-4 px-1 text-center text-sm font-medium');
                $('#activityBtn').addClass('border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700 w-1/4 border-b-2 py-4 px-1 text-center text-sm font-medium');
                $('#fileBtn').removeClass('border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700 w-1/4 border-b-2 py-4 px-1 text-center text-sm font-medium');
                $('#fileBtn').addClass('border-indigo-500 text-indigo-600 w-1/4 border-b-2 py-4 px-1 text-center text-sm font-medium');
                $('#noteBtn').removeClass('border-indigo-500 text-indigo-600 w-1/4 border-b-2 py-4 px-1 text-center text-sm font-medium');
                $('#noteBtn').addClass('border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700 w-1/4 border-b-2 py-4 px-1 text-center text-sm font-medium');
                $('.activity').addClass('hidden');
                $('.file').removeClass('hidden');
                $('.note').addClass('hidden');
            });

            $('#noteBtn').click(function(){
                $('#activityBtn').removeClass('border-indigo-500 text-indigo-600 w-1/4 border-b-2 py-4 px-1 text-center text-sm font-medium');
                $('#activityBtn').addClass('border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700 w-1/4 border-b-2 py-4 px-1 text-center text-sm font-medium');
                $('#fileBtn').removeClass('border-indigo-500 text-indigo-600 w-1/4 border-b-2 py-4 px-1 text-center text-sm font-medium');
                $('#fileBtn').addClass('border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700 w-1/4 border-b-2 py-4 px-1 text-center text-sm font-medium');
                $('#noteBtn').removeClass('border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700 w-1/4 border-b-2 py-4 px-1 text-center text-sm font-medium');
                $('#noteBtn').addClass('border-indigo-500 text-indigo-600 w-1/4 border-b-2 py-4 px-1 text-center text-sm font-medium');
                $('.activity').addClass('hidden');
                $('.file').addClass('hidden');
                $('.note').removeClass('hidden');
            });

            $('#toDoBtn').click(function(){
                $('#toDoBtn').removeClass('border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700 w-1/4 border-b-2 py-4 px-1 text-center text-sm font-medium');
                $('#toDoBtn').addClass('border-indigo-500 text-indigo-600 w-1/4 border-b-2 py-4 px-1 text-center text-sm font-medium');
                $('#doneBtn').removeClass('border-indigo-500 text-indigo-600 w-1/4 border-b-2 py-4 px-1 text-center text-sm font-medium');
                $('#doneBtn').addClass('border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700 w-1/4 border-b-2 py-4 px-1 text-center text-sm font-medium');
                $('#filesBtn').removeClass('border-indigo-500 text-indigo-600 w-1/4 border-b-2 py-4 px-1 text-center text-sm font-medium');
                $('#filesBtn').addClass('border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700 w-1/4 border-b-2 py-4 px-1 text-center text-sm font-medium');
                $('#notesBtn').removeClass('border-indigo-500 text-indigo-600 w-1/4 border-b-2 py-4 px-1 text-center text-sm font-medium');
                $('#notesBtn').addClass('border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700 w-1/4 border-b-2 py-4 px-1 text-center text-sm font-medium');
                $('.toDo').removeClass('hidden');
                $('.done').addClass('hidden');
                $('.files').addClass('hidden');
                $('.notes').addClass('hidden');
            });

            $('#doneBtn').click(function(){
                $('#toDoBtn').removeClass('border-indigo-500 text-indigo-600 w-1/4 border-b-2 py-4 px-1 text-center text-sm font-medium');
                $('#toDoBtn').addClass('border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700 w-1/4 border-b-2 py-4 px-1 text-center text-sm font-medium');
                $('#doneBtn').removeClass('border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700 w-1/4 border-b-2 py-4 px-1 text-center text-sm font-medium');
                $('#doneBtn').addClass('border-indigo-500 text-indigo-600 w-1/4 border-b-2 py-4 px-1 text-center text-sm font-medium');
                $('#filesBtn').removeClass('border-indigo-500 text-indigo-600 w-1/4 border-b-2 py-4 px-1 text-center text-sm font-medium');
                $('#filesBtn').addClass('border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700 w-1/4 border-b-2 py-4 px-1 text-center text-sm font-medium');
                $('#notesBtn').removeClass('border-indigo-500 text-indigo-600 w-1/4 border-b-2 py-4 px-1 text-center text-sm font-medium');
                $('#notesBtn').addClass('border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700 w-1/4 border-b-2 py-4 px-1 text-center text-sm font-medium');
                $('.toDo').addClass('hidden');
                $('.done').removeClass('hidden');
                $('.files').addClass('hidden');
                $('.notes').addClass('hidden');
            });

            $('#filesBtn').click(function(){
                $('#toDoBtn').removeClass('border-indigo-500 text-indigo-600 w-1/4 border-b-2 py-4 px-1 text-center text-sm font-medium');
                $('#toDoBtn').addClass('border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700 w-1/4 border-b-2 py-4 px-1 text-center text-sm font-medium');
                $('#doneBtn').removeClass('border-indigo-500 text-indigo-600 w-1/4 border-b-2 py-4 px-1 text-center text-sm font-medium');
                $('#doneBtn').addClass('border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700 w-1/4 border-b-2 py-4 px-1 text-center text-sm font-medium');
                $('#filesBtn').removeClass('border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700 w-1/4 border-b-2 py-4 px-1 text-center text-sm font-medium');
                $('#filesBtn').addClass('border-indigo-500 text-indigo-600 w-1/4 border-b-2 py-4 px-1 text-center text-sm font-medium');
                $('#notesBtn').removeClass('border-indigo-500 text-indigo-600 w-1/4 border-b-2 py-4 px-1 text-center text-sm font-medium');
                $('#notesBtn').addClass('border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700 w-1/4 border-b-2 py-4 px-1 text-center text-sm font-medium');
                $('.toDo').addClass('hidden');
                $('.done').addClass('hidden');
                $('.files').removeClass('hidden');
                $('.notes').addClass('hidden');
            });

            $('#notesBtn').click(function(){
                $('#toDoBtn').removeClass('border-indigo-500 text-indigo-600 w-1/4 border-b-2 py-4 px-1 text-center text-sm font-medium');
                $('#toDoBtn').addClass('border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700 w-1/4 border-b-2 py-4 px-1 text-center text-sm font-medium');
                $('#doneBtn').removeClass('border-indigo-500 text-indigo-600 w-1/4 border-b-2 py-4 px-1 text-center text-sm font-medium');
                $('#doneBtn').addClass('border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700 w-1/4 border-b-2 py-4 px-1 text-center text-sm font-medium');
                $('#filesBtn').removeClass('border-indigo-500 text-indigo-600 w-1/4 border-b-2 py-4 px-1 text-center text-sm font-medium');
                $('#filesBtn').addClass('border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700 w-1/4 border-b-2 py-4 px-1 text-center text-sm font-medium');
                $('#notesBtn').removeClass('border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700 w-1/4 border-b-2 py-4 px-1 text-center text-sm font-medium');
                $('#notesBtn').addClass('border-indigo-500 text-indigo-600 w-1/4 border-b-2 py-4 px-1 text-center text-sm font-medium');
                $('.toDo').addClass('hidden');
                $('.done').addClass('hidden');
                $('.files').addClass('hidden');
                $('.notes').removeClass('hidden');
            });

            flatpickr('#datepickerFrom');

            flatpickr('#timepickerFrom', {
                enableTime: true,
                noCalendar: true,
                dateFormat: "H:i:s",
            });

            flatpickr('#datepickerTo');

            flatpickr('#timepickerTo', {
                enableTime: true,
                noCalendar: true,
                dateFormat: "H:i:s",
            });

            <?php $maxLeadNotes = count($leadnotes);
                for($i = 0; $i < $maxLeadNotes; $i++) { ?>
                    $('#viewNoteBtn<?php echo $i; ?>').click(function(){
                        var id = $('#leadnotetoken<?php echo $i; ?>').val();
                        $.ajax({
                            type: 'GET',
                            url: '/leads/get-lead-note/' + id,
                            success: function(response){
                                $('#edit-note-title').val(response.title);
                                $('#edit_note_message').val(response.message);
                                $('#lead_id').val(response.id);
                                $('.edit-note').toggle('hidden');
                            }
                        })
                    });
            <?php } ?>
        });
    </script>
@endsection
