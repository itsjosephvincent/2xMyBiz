@extends('layouts.app')

@section('title', 'Lead Audit | 2xMyLeads')

@section('content')
    <div class="grid grid-cols-1">
        <div class="col-span-1">
            <a href="{{ route('my-leads') }}" class="inline-flex items-center gap-x-1.5 rounded bg-indigo-50 px-2 py-1 text-xs font-semibold text-black shadow-sm hover:bg-indigo-100">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="-ml-0.5 h-5 w-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
                </svg>
                Go back
            </a>
        </div>
    </div>

    <div class="border border-gray-200 bg-white px-4 py-5 sm:px-6 mt-4">
        <div class="grid grid-cols-1 lg:grid-cols-3">
            <div class="col-span-1 flex justify-center">
                <img class="inline-block h-28 w-28 rounded-full" src="{{ $lead->lead_photo ?? asset('img/org.png') }}" alt="">
            </div>
            <div class="lg:col-span-1 flex lg:justify-start mt-2 lg:mt-0">
                <div class="grid grid-rows-4">
                    <div class="lg:mx-0 mx-12">
                        <p class="text-sm font-medium">{{ $lead->lead_name }}</p>
                    </div>
                    <div class="text-xs text-gray-500 lg:mx-0 mx-16">{{ isset($lead->email) ? trim(str_replace(['[', ']', '"'], '', $lead->email)) : 'No email address' }}</div>
                    <div class="lg:mx-0 mx-24"><span class="inline-flex flex-shrink-0 items-center rounded-full bg-{{ $lead->lead_class_name }} px-1.5 py-0.5 text-xs text-white ring-1 ring-green-600/20">{{ $lead->lead_group_name }}</span></div>
                    @if ($leadDetails->audit_link)
                    <div class="lg:mx-0 mx-20">
                        <a href="{{ $leadDetails->audit_link }}" target="_blank" class="underline text-sm font-medium text-pipexblue">Check audit page here</a>
                    </div>
                    @endif
                </div>
            </div>
            <div class="lg:col-span-1 flex lg:justify-start mt-2 lg:mt-0">
                <div class="grid grid-rows-2">
                    <div class="flex justify-center">
                        <div class="mb-4 flex-shrink-0 sm:mb-0 sm:mr-4">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor" class="h-12 w-12 text-pipexblue">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                            </svg>
                        </div>
                        <div>
                            <h4 class="text-xs">Lead group:</h4>
                            <span class="inline-flex mt-1 flex-shrink-0 items-center rounded-full bg-{{ $lead->leadclassname }} px-1.5 py-0.5 text-xs text-white ring-1 ring-green-600/20">{{ $lead->organization_name }}</span>
                        </div>
                    </div>
                    <div class="flex mx-16 lg:mt-1">
                        <div class="mb-4 flex-shrink-0 sm:mb-0 sm:mr-4">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor" class="w-12 h-12 text-pipexblue">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5" />
                            </svg>
                        </div>
                        <div>
                            <h4 class="text-xs">Created:</h4>
                            <p class="mt-1 text-sm">{{ date('m-d-Y', strtotime($lead->created_at)) }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="px-4 sm:px-6 lg:px-8 mt-6">
        <div class="sm:flex sm:items-center">
            <div class="sm:flex-auto">
                <h1 class="text-base font-semibold leading-6 text-gray-900">Facebook Page CHECKLIST</h1>
                <p class="mt-2 text-xs text-gray-500">Use these checklists to audit your own sites or even your client's sites if you are working with clients as a social media consultant.<br>Add notes where needed. This is also a good time to review what you have in your About sections and profiles to make sure everything is up to date.</p>
            </div>
        </div>
        <form action="{{ route('update-audit', $lead->id) }}" method="post">
            @csrf
            @method('PUT')
            <div class="mt-4 flow-root">
                <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                        <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 sm:rounded-lg">
                            <table class="min-w-full divide-y divide-gray-300">
                                <tbody class="divide-y divide-gray-200 bg-white">
                                    <tr>
                                        <td class="whitespace-nowrap py-4 pl-4 pr-3 text-xs font-medium text-gray-900 sm:pl-6">Do you have an engaging and professional Facebook Cover photo?<br><span class="text-red-500">Size 851x315 pixels</span></td>
                                        @if ($leadDetails->cover)
                                            <td class="whitespace-nowrap py-4 pl-4 pr-3 text-xs font-medium text-gray-900 sm:pl-6">
                                                <p>
                                                    <label>
                                                        <input type="radio" value="1" name="group1" checked>
                                                        <span class="text-pipexblue"><b>Yes</b></span>
                                                    </label>
                                                </p>
                                            </td>
                                            <td class="whitespace-nowrap py-4 pl-4 pr-3 text-xs font-medium text-gray-900 sm:pl-6">
                                                <p>
                                                    <label>
                                                        <input type="radio" value="0" name="group1">
                                                        <span class="text-red-500"><b>No</b></span>
                                                    </label>
                                                </p>
                                            </td>
                                        @elseif ($response1)
                                            <td class="whitespace-nowrap py-4 pl-4 pr-3 text-xs font-medium text-gray-900 sm:pl-6">
                                                <p>
                                                    <label>
                                                        <input type="radio" value="1" name="group1" {{ $response1->answer == 1 ? 'checked' : '' }}>
                                                        <span class="text-pipexblue"><b>Yes</b></span>
                                                    </label>
                                                </p>
                                            </td>
                                            <td class="whitespace-nowrap py-4 pl-4 pr-3 text-xs font-medium text-gray-900 sm:pl-6">
                                                <p>
                                                    <label>
                                                        <input type="radio" value="0" name="group1" {{ $response1->answer == 0 ? 'checked' : '' }}>
                                                        <span class="text-red-500"><b>No</b></span>
                                                    </label>
                                                </p>
                                            </td>
                                        @else
                                            <td class="whitespace-nowrap py-4 pl-4 pr-3 text-xs font-medium text-gray-900 sm:pl-6">
                                                <p>
                                                    <label>
                                                        <input type="radio" value="1" name="group1">
                                                        <span class="text-pipexblue"><b>Yes</b></span>
                                                    </label>
                                                </p>
                                            </td>
                                            <td class="whitespace-nowrap py-4 pl-4 pr-3 text-xs font-medium text-gray-900 sm:pl-6">
                                                <p>
                                                    <label>
                                                        <input type="radio" value="0" name="group1" checked>
                                                        <span class="text-red-500"><b>No</b></span>
                                                    </label>
                                                </p>
                                            </td>
                                        @endif
                                    </tr>
                                    <tr>
                                        <td class="whitespace-nowrap py-4 pl-4 pr-3 text-xs font-medium text-gray-900 sm:pl-6"><p>Do you have a tagline or any demonstrated benefits on your cover photo?</p></td>
                                        @if ($response2)
                                            <td class="whitespace-nowrap py-4 pl-4 pr-3 text-xs font-medium text-gray-900 sm:pl-6">
                                                <p>
                                                    <label>
                                                        <input type="radio" value="1" name="group2" {{ $response1->answer == 1 ? 'checked' : '' }}>
                                                        <span class="text-pipexblue"><b>Yes</b></span>
                                                    </label>
                                                </p>
                                            </td>
                                            <td class="whitespace-nowrap py-4 pl-4 pr-3 text-xs font-medium text-gray-900 sm:pl-6">
                                                <p>
                                                    <label>
                                                        <input type="radio" value="0" name="group2" {{ $response1->answer == 0 ? 'checked' : '' }}>
                                                        <span class="text-red-500"><b>No</b></span>
                                                    </label>
                                                </p>
                                            </td>
                                        @else
                                            <td class="whitespace-nowrap py-4 pl-4 pr-3 text-xs font-medium text-gray-900 sm:pl-6">
                                                <p>
                                                    <label>
                                                        <input type="radio" value="1" name="group2">
                                                        <span class="text-pipexblue"><b>Yes</b></span>
                                                    </label>
                                                </p>
                                            </td>
                                            <td class="whitespace-nowrap py-4 pl-4 pr-3 text-xs font-medium text-gray-900 sm:pl-6">
                                                <p>
                                                    <label>
                                                        <input type="radio" value="0" name="group2" checked>
                                                        <span class="text-red-500"><b>No</b></span>
                                                    </label>
                                                </p>
                                            </td>
                                        @endif
                                    </tr>
                                    <tr>
                                        <td class="whitespace-nowrap py-4 pl-4 pr-3 text-xs font-medium text-gray-900 sm:pl-6"><p>Does your cover photo have a description with it (when you click on it)with a link to your website?</p></td>
                                        @if ($response3)
                                            <td class="whitespace-nowrap py-4 pl-4 pr-3 text-xs font-medium text-gray-900 sm:pl-6">
                                                <p>
                                                    <label>
                                                        <input type="radio" value="1" name="group3" {{ $response3->answer == 1 ? 'checked' : '' }}>
                                                        <span class="text-pipexblue"><b>Yes</b></span>
                                                    </label>
                                                </p>
                                            </td>
                                            <td class="whitespace-nowrap py-4 pl-4 pr-3 text-xs font-medium text-gray-900 sm:pl-6">
                                                <p>
                                                    <label>
                                                        <input type="radio" value="0" name="group3" {{ $response3->answer == 0 ? 'checked' : '' }}>
                                                        <span class="text-red-500"><b>No</b></span>
                                                    </label>
                                                </p>
                                            </td>
                                        @else
                                            <td class="whitespace-nowrap py-4 pl-4 pr-3 text-xs font-medium text-gray-900 sm:pl-6">
                                                <p>
                                                    <label>
                                                        <input type="radio" value="1" name="group3">
                                                        <span class="text-pipexblue"><b>Yes</b></span>
                                                    </label>
                                                </p>
                                            </td>
                                            <td class="whitespace-nowrap py-4 pl-4 pr-3 text-xs font-medium text-gray-900 sm:pl-6">
                                                <p>
                                                    <label>
                                                        <input type="radio" value="0" name="group3" checked>
                                                        <span class="text-red-500"><b>No</b></span>
                                                    </label>
                                                </p>
                                            </td>
                                        @endif
                                    </tr>
                                    <tr>
                                        <td class="whitespace-nowrap py-4 pl-4 pr-3 text-xs font-medium text-gray-900 sm:pl-6"><p>Do you have an interesting Profile photo that is clear and easy to see?<br><span class="text-red-500">Size 180x180 pixels</span></p></td>
                                        @if ($lead->lead_photo)
                                            <td class="whitespace-nowrap py-4 pl-4 pr-3 text-xs font-medium text-gray-900 sm:pl-6">
                                                <p>
                                                    <label>
                                                        <input type="radio" value="1" name="group4" checked>
                                                        <span class="text-pipexblue"><b>Yes</b></span>
                                                    </label>
                                                </p>
                                            </td>
                                            <td class="whitespace-nowrap py-4 pl-4 pr-3 text-xs font-medium text-gray-900 sm:pl-6">
                                                <p>
                                                    <label>
                                                        <input type="radio" value="0" name="group4">
                                                        <span class="text-red-500"><b>No</b></span>
                                                    </label>
                                                </p>
                                            </td>
                                        @elseif ($response4)
                                            <td class="whitespace-nowrap py-4 pl-4 pr-3 text-xs font-medium text-gray-900 sm:pl-6">
                                                <p>
                                                    <label>
                                                        <input type="radio" value="1" name="group4" {{ $response4->answer == 1 ? 'checked' : '' }}>
                                                        <span class="text-pipexblue"><b>Yes</b></span>
                                                    </label>
                                                </p>
                                            </td>
                                            <td class="whitespace-nowrap py-4 pl-4 pr-3 text-xs font-medium text-gray-900 sm:pl-6">
                                                <p>
                                                    <label>
                                                        <input type="radio" value="0" name="group4" {{ $response4->answer == 0 ? 'checked' : '' }}>
                                                        <span class="text-red-500"><b>No</b></span>
                                                    </label>
                                                </p>
                                            </td>
                                        @else
                                            <td class="whitespace-nowrap py-4 pl-4 pr-3 text-xs font-medium text-gray-900 sm:pl-6">
                                                <p>
                                                    <label>
                                                        <input type="radio" value="1" name="group4">
                                                        <span class="text-pipexblue"><b>Yes</b></span>
                                                    </label>
                                                </p>
                                            </td>
                                            <td class="whitespace-nowrap py-4 pl-4 pr-3 text-xs font-medium text-gray-900 sm:pl-6">
                                                <p>
                                                    <label>
                                                        <input type="radio" value="0" name="group4" checked>
                                                        <span class="text-red-500"><b>No</b></span>
                                                    </label>
                                                </p>
                                            </td>
                                        @endif
                                    </tr>
                                    <tr>
                                        <td class="whitespace-nowrap py-4 pl-4 pr-3 text-xs font-medium text-gray-900 sm:pl-6"><p>Is your Facebook About Short Description (the one that appears on your Facebook Timeline) clear and interesting?<br>Does it containt your web address?</p></td>
                                        @if ($leadDetails->about)
                                            <td class="whitespace-nowrap py-4 pl-4 pr-3 text-xs font-medium text-gray-900 sm:pl-6">
                                                <p>
                                                    <label>
                                                        <input type="radio" value="1" name="group5" checked>
                                                        <span class="text-pipexblue"><b>Yes</b></span>
                                                    </label>
                                                </p>
                                            </td>
                                            <td class="whitespace-nowrap py-4 pl-4 pr-3 text-xs font-medium text-gray-900 sm:pl-6">
                                                <p>
                                                    <label>
                                                        <input type="radio" value="0" name="group5">
                                                        <span class="text-red-500"><b>No</b></span>
                                                    </label>
                                                </p>
                                            </td>
                                        @elseif ($response5)
                                            <td class="whitespace-nowrap py-4 pl-4 pr-3 text-xs font-medium text-gray-900 sm:pl-6">
                                                <p>
                                                    <label>
                                                        <input type="radio" value="1" name="group5" {{ $response5->answer == 1 ? 'checked' : '' }} />
                                                        <span class="text-pipexblue"><b>Yes</b></span>
                                                    </label>
                                                </p>
                                            </td>
                                            <td class="whitespace-nowrap py-4 pl-4 pr-3 text-xs font-medium text-gray-900 sm:pl-6">
                                                <p>
                                                    <label>
                                                        <input type="radio" value="0" name="group5" {{ $response5->answer == 0 ? 'checked' : '' }}>
                                                        <span class="text-red-500"><b>No</b></span>
                                                    </label>
                                                </p>
                                            </td>
                                        @else
                                            <td class="whitespace-nowrap py-4 pl-4 pr-3 text-xs font-medium text-gray-900 sm:pl-6">
                                                <p>
                                                    <label>
                                                        <input type="radio" value="1" name="group5">
                                                        <span class="text-pipexblue"><b>Yes</b></span>
                                                    </label>
                                                </p>
                                            </td>
                                            <td class="whitespace-nowrap py-4 pl-4 pr-3 text-xs font-medium text-gray-900 sm:pl-6">
                                                <p>
                                                    <label>
                                                        <input type="radio" value="0" name="group5" checked>
                                                        <span class="text-red-500"><b>No</b></span>
                                                    </label>
                                                </p>
                                            </td>
                                        @endif
                                    </tr>
                                    <tr>
                                        <td class="whitespace-nowrap py-4 pl-4 pr-3 text-xs font-medium text-gray-900 sm:pl-6"><p>Is your entire About section filled with the benefits of your business and good keywords?</p></td>
                                        @if ($leadDetails->about)
                                            <td class="whitespace-nowrap py-4 pl-4 pr-3 text-xs font-medium text-gray-900 sm:pl-6">
                                                <p>
                                                    <label>
                                                        <input type="radio" value="1" name="group6" checked>
                                                        <span class="text-pipexblue"><b>Yes</b></span>
                                                    </label>
                                                </p>
                                            </td>
                                            <td class="whitespace-nowrap py-4 pl-4 pr-3 text-xs font-medium text-gray-900 sm:pl-6">
                                                <p>
                                                    <label>
                                                        <input type="radio" value="0" name="group6">
                                                        <span class="text-red-500"><b>No</b></span>
                                                    </label>
                                                </p>
                                            </td>
                                        @elseif ($response6)
                                            <td class="whitespace-nowrap py-4 pl-4 pr-3 text-xs font-medium text-gray-900 sm:pl-6">
                                                <p>
                                                    <label>
                                                        <input type="radio" value="1" name="group6" {{ $response6->answer == 1 ? 'checked' : '' }}>
                                                        <span class="text-pipexblue"><b>Yes</b></span>
                                                    </label>
                                                </p>
                                            </td>
                                            <td class="whitespace-nowrap py-4 pl-4 pr-3 text-xs font-medium text-gray-900 sm:pl-6">
                                                <p>
                                                    <label>
                                                        <input type="radio" value="0" name="group6" {{ $response6->answer == 0 ? 'checked' : '' }}>
                                                        <span class="text-red-500"><b>No</b></span>
                                                    </label>
                                                </p>
                                            </td>
                                        @else
                                            <td class="whitespace-nowrap py-4 pl-4 pr-3 text-xs font-medium text-gray-900 sm:pl-6">
                                                <p>
                                                    <label>
                                                        <input type="radio" value="1" name="group6">
                                                        <span class="text-pipexblue"><b>Yes</b></span>
                                                    </label>
                                                </p>
                                            </td>
                                            <td class="whitespace-nowrap py-4 pl-4 pr-3 text-xs font-medium text-gray-900 sm:pl-6">
                                                <p>
                                                    <label>
                                                        <input type="radio" value="0" name="group6" checked>
                                                        <span class="text-red-500"><b>No</b></span>
                                                    </label>
                                                </p>
                                            </td>
                                        @endif
                                    </tr>
                                    <tr>
                                        <td class="whitespace-nowrap py-4 pl-4 pr-3 text-xs font-medium text-gray-900 sm:pl-6"><p>Do you have Facebook Apps Installed?</p></td>
                                        @if ($response7)
                                            <td class="whitespace-nowrap py-4 pl-4 pr-3 text-xs font-medium text-gray-900 sm:pl-6">
                                                <p>
                                                    <label>
                                                        <input type="radio" value="1" name="group7" {{ $response7->answer == 1 ? 'checked' : '' }}>
                                                        <span class="text-pipexblue"><b>Yes</b></span>
                                                    </label>
                                                </p>
                                            </td>
                                            <td class="whitespace-nowrap py-4 pl-4 pr-3 text-xs font-medium text-gray-900 sm:pl-6">
                                                <p>
                                                    <label>
                                                        <input type="radio" value="0" name="group7" {{ $response7->answer == 0 ? 'checked' : '' }}>
                                                        <span class="text-red-500"><b>No</b></span>
                                                    </label>
                                                </p>
                                            </td>
                                        @else
                                            <td class="whitespace-nowrap py-4 pl-4 pr-3 text-xs font-medium text-gray-900 sm:pl-6">
                                                <p>
                                                    <label>
                                                        <input type="radio" value="1" name="group7">
                                                        <span class="text-pipexblue"><b>Yes</b></span>
                                                    </label>
                                                </p>
                                            </td>
                                            <td class="whitespace-nowrap py-4 pl-4 pr-3 text-xs font-medium text-gray-900 sm:pl-6">
                                                <p>
                                                    <label>
                                                        <input type="radio" value="0" name="group7" checked>
                                                        <span class="text-red-500"><b>No</b></span>
                                                    </label>
                                                </p>
                                            </td>
                                        @endif
                                    </tr>
                                    <tr>
                                        <td class="whitespace-nowrap py-4 pl-4 pr-3 text-xs font-medium text-gray-900 sm:pl-6"><p>Do you have a Facebook App installed that will collect e-mails ofpotential clients?<br>A lead generation tool?</p></td>
                                        @if ($response8)
                                            <td class="whitespace-nowrap py-4 pl-4 pr-3 text-xs font-medium text-gray-900 sm:pl-6">
                                                <p>
                                                    <label>
                                                        <input type="radio" value="1" name="group8" {{ $response8->answer == 1 ? 'checked' : '' }}>
                                                        <span class="text-pipexblue"><b>Yes</b></span>
                                                    </label>
                                                </p>
                                            </td>
                                            <td class="whitespace-nowrap py-4 pl-4 pr-3 text-xs font-medium text-gray-900 sm:pl-6">
                                                <p>
                                                    <label>
                                                        <input type="radio" value="0" name="group8" {{ $response8->answer == 0 ? 'checked' : '' }}>
                                                        <span class="text-red-500"><b>No</b></span>
                                                    </label>
                                                </p>
                                            </td>
                                        @else
                                            <td class="whitespace-nowrap py-4 pl-4 pr-3 text-xs font-medium text-gray-900 sm:pl-6">
                                                <p>
                                                    <label>
                                                        <input type="radio" value="1" name="group8">
                                                        <span class="text-pipexblue"><b>Yes</b></span>
                                                    </label>
                                                </p>
                                            </td>
                                            <td class="whitespace-nowrap py-4 pl-4 pr-3 text-xs font-medium text-gray-900 sm:pl-6">
                                                <p>
                                                    <label>
                                                        <input type="radio" value="0" name="group8" checked>
                                                        <span class="text-red-500"><b>No</b></span>
                                                    </label>
                                                </p>
                                            </td>
                                        @endif
                                    </tr>
                                    <tr>
                                        <td class="whitespace-nowrap py-4 pl-4 pr-3 text-xs font-medium text-gray-900 sm:pl-6"><p>If you have Facebook Apps installed do you have custom App covers to go along with the branding of your Page?</p></td>
                                        @if ($response9)
                                            <td class="whitespace-nowrap py-4 pl-4 pr-3 text-xs font-medium text-gray-900 sm:pl-6">
                                                <p>
                                                    <label>
                                                        <input type="radio" value="1" name="group9" {{ $response9->answer == 1 ? 'checked' : '' }}>
                                                        <span class="text-pipexblue"><b>Yes</b></span>
                                                    </label>
                                                </p>
                                            </td>
                                            <td class="whitespace-nowrap py-4 pl-4 pr-3 text-xs font-medium text-gray-900 sm:pl-6">
                                                <p>
                                                    <label>
                                                        <input type="radio" value="0" name="group9" {{ $response9->answer == 0 ? 'checked' : '' }}>
                                                        <span class="text-red-500"><b>No</b></span>
                                                    </label>
                                                </p>
                                            </td>
                                        @else
                                            <td class="whitespace-nowrap py-4 pl-4 pr-3 text-xs font-medium text-gray-900 sm:pl-6">
                                                <p>
                                                    <label>
                                                        <input type="radio" value="1" name="group9">
                                                        <span class="text-pipexblue"><b>Yes</b></span>
                                                    </label>
                                                </p>
                                            </td>
                                            <td class="whitespace-nowrap py-4 pl-4 pr-3 text-xs font-medium text-gray-900 sm:pl-6">
                                                <p>
                                                    <label>
                                                        <input type="radio" value="0" name="group9" checked>
                                                        <span class="text-red-500"><b>No</b></span>
                                                    </label>
                                                </p>
                                            </td>
                                        @endif
                                    </tr>
                                    <tr>
                                        <td class="whitespace-nowrap py-4 pl-4 pr-3 text-xs font-medium text-gray-900 sm:pl-6"><p>What is the current Facebook engagement of your Page (People Talking About This divided by total Fans)?<br>Is it over 2%?</p></td>
                                        @if ($response10)
                                            <td class="whitespace-nowrap py-4 pl-4 pr-3 text-xs font-medium text-gray-900 sm:pl-6">
                                                <p>
                                                    <label>
                                                        <input type="radio" value="1" name="group10" {{ $response10->answer == 1 ? 'checked' : '' }} />
                                                        <span class="text-pipexblue"><b>Yes</b></span>
                                                    </label>
                                                </p>
                                            </td>
                                            <td class="whitespace-nowrap py-4 pl-4 pr-3 text-xs font-medium text-gray-900 sm:pl-6">
                                                <p>
                                                    <label>
                                                        <input type="radio" value="0" name="group10" {{ $response10->answer == 0 ? 'checked' : '' }}>
                                                        <span class="text-red-500"><b>No</b></span>
                                                    </label>
                                                </p>
                                            </td>
                                        @else
                                            <td class="whitespace-nowrap py-4 pl-4 pr-3 text-xs font-medium text-gray-900 sm:pl-6">
                                                <p>
                                                    <label>
                                                        <input type="radio" value="1" name="group10">
                                                        <span class="text-pipexblue"><b>Yes</b></span>
                                                    </label>
                                                </p>
                                            </td>
                                            <td class="whitespace-nowrap py-4 pl-4 pr-3 text-xs font-medium text-gray-900 sm:pl-6">
                                                <p>
                                                    <label>
                                                        <input type="radio" value="0" name="group10" checked>
                                                        <span class="text-red-500"><b>No</b></span>
                                                    </label>
                                                </p>
                                            </td>
                                        @endif
                                    </tr>
                                    <tr>
                                        <td class="whitespace-nowrap py-4 pl-4 pr-3 text-xs font-medium text-gray-900 sm:pl-6"><p>Is your website easy to find on your Facebook Page?<br>Either in your short description or prominently featured in your About Page several times?</p></td>
                                        @if ($lead->website)
                                            <td class="whitespace-nowrap py-4 pl-4 pr-3 text-xs font-medium text-gray-900 sm:pl-6">
                                                <p>
                                                    <label>
                                                        <input type="radio" value="1" name="group11" {{ $lead->website ? 'checked' : '' }}>
                                                        <span class="text-pipexblue"><b>Yes</b></span>
                                                    </label>
                                                </p>
                                            </td>
                                            <td class="whitespace-nowrap py-4 pl-4 pr-3 text-xs font-medium text-gray-900 sm:pl-6">
                                                <p>
                                                    <label>
                                                        <input type="radio" value="0" name="group11" {{ $lead->website ? '' : 'checked' }}>
                                                        <span class="text-red-500"><b>No</b></span>
                                                    </label>
                                                </p>
                                            </td>
                                        @elseif ($response11)
                                            <td class="whitespace-nowrap py-4 pl-4 pr-3 text-xs font-medium text-gray-900 sm:pl-6">
                                                <p>
                                                    <label>
                                                        <input type="radio" value="1" name="group11" {{ $response11->answer == 1 ? 'checked' : '' }}>
                                                        <span class="text-pipexblue"><b>Yes</b></span>
                                                    </label>
                                                </p>
                                            </td>
                                            <td class="whitespace-nowrap py-4 pl-4 pr-3 text-xs font-medium text-gray-900 sm:pl-6">
                                                <p>
                                                    <label>
                                                        <input type="radio" value="0" name="group11" {{ $response11->answer == 0 ? 'checked' : '' }}>
                                                        <span class="text-red-500"><b>No</b></span>
                                                    </label>
                                                </p>
                                            </td>
                                        @else
                                            <td class="whitespace-nowrap py-4 pl-4 pr-3 text-xs font-medium text-gray-900 sm:pl-6">
                                                <p>
                                                    <label>
                                                        <input type="radio" value="1" name="group11">
                                                        <span class="text-pipexblue"><b>Yes</b></span>
                                                    </label>
                                                </p>
                                            </td>
                                            <td class="whitespace-nowrap py-4 pl-4 pr-3 text-xs font-medium text-gray-900 sm:pl-6">
                                                <p>
                                                    <label>
                                                        <input type="radio" value="0" name="group11" checked>
                                                        <span class="text-red-500"><b>No</b></span>
                                                    </label>
                                                </p>
                                            </td>
                                        @endif
                                    </tr>
                                    <tr>
                                        <td class="whitespace-nowrap py-4 pl-4 pr-3 text-xs font-medium text-gray-900 sm:pl-6"><p>Are you posting at least once a day during the week?</p></td>
                                        @if ($response12)
                                            <td class="whitespace-nowrap py-4 pl-4 pr-3 text-xs font-medium text-gray-900 sm:pl-6">
                                                <p>
                                                    <label>
                                                        <input type="radio" value="1" name="group12" {{ $response12->answer == 1 ? 'checked' : '' }}>
                                                        <span class="text-pipexblue"><b>Yes</b></span>
                                                    </label>
                                                </p>
                                            </td>
                                            <td class="whitespace-nowrap py-4 pl-4 pr-3 text-xs font-medium text-gray-900 sm:pl-6">
                                                <p>
                                                    <label>
                                                        <input type="radio" value="0" name="group12" {{ $response12->answer == 0 ? 'checked' : '' }}>
                                                        <span class="text-red-500"><b>No</b></span>
                                                    </label>
                                                </p>
                                            </td>
                                        @else
                                            <td class="whitespace-nowrap py-4 pl-4 pr-3 text-xs font-medium text-gray-900 sm:pl-6">
                                                <p>
                                                    <label>
                                                        <input type="radio" value="1" name="group12">
                                                        <span class="text-pipexblue"><b>Yes</b></span>
                                                    </label>
                                                </p>
                                            </td>
                                            <td class="whitespace-nowrap py-4 pl-4 pr-3 text-xs font-medium text-gray-900 sm:pl-6">
                                                <p>
                                                    <label>
                                                        <input type="radio" value="0" name="group12" checked>
                                                        <span class="text-red-500"><b>No</b></span>
                                                    </label>
                                                </p>
                                            </td>
                                        @endif
                                    </tr>
                                    <tr>
                                        <td class="whitespace-nowrap py-4 pl-4 pr-3 text-xs font-medium text-gray-900 sm:pl-6"><p>Are people liking or commenting on your posts?</p></td>
                                        @if ($response13)
                                            <td class="whitespace-nowrap py-4 pl-4 pr-3 text-xs font-medium text-gray-900 sm:pl-6">
                                                <p>
                                                    <label>
                                                        <input type="radio" value="1" name="group13" {{ $response13->answer == 1 ? 'checked' : '' }}>
                                                        <span class="text-pipexblue"><b>Yes</b></span>
                                                    </label>
                                                </p>
                                            </td>
                                            <td class="whitespace-nowrap py-4 pl-4 pr-3 text-xs font-medium text-gray-900 sm:pl-6">
                                                <p>
                                                    <label>
                                                        <input type="radio" value="0" name="group13" {{ $response13->answer == 0 ? 'checked' : '' }}>
                                                        <span class="text-red-500"><b>No</b></span>
                                                    </label>
                                                </p>
                                            </td>
                                        @else
                                            <td class="whitespace-nowrap py-4 pl-4 pr-3 text-xs font-medium text-gray-900 sm:pl-6">
                                                <p>
                                                    <label>
                                                        <input type="radio" value="1" name="group13">
                                                        <span class="text-pipexblue"><b>Yes</b></span>
                                                    </label>
                                                </p>
                                            </td>
                                            <td class="whitespace-nowrap py-4 pl-4 pr-3 text-xs font-medium text-gray-900 sm:pl-6">
                                                <p>
                                                    <label>
                                                        <input type="radio" value="0" name="group13" checked>
                                                        <span class="text-red-500"><b>No</b></span>
                                                    </label>
                                                </p>
                                            </td>
                                        @endif
                                    </tr>
                                    <tr>
                                        <td class="whitespace-nowrap py-4 pl-4 pr-3 text-xs font-medium text-gray-900 sm:pl-6"><p>Are you asking questions in your posts to try and get engagement?</p></td>
                                        @if ($response14)
                                            <td class="whitespace-nowrap py-4 pl-4 pr-3 text-xs font-medium text-gray-900 sm:pl-6">
                                                <p>
                                                    <label>
                                                        <input type="radio" value="1" name="group14" {{ $response14->answer == 1 ? 'checked' : '' }}>
                                                        <span class="text-pipexblue"><b>Yes</b></span>
                                                    </label>
                                                </p>
                                            </td>
                                            <td class="whitespace-nowrap py-4 pl-4 pr-3 text-xs font-medium text-gray-900 sm:pl-6">
                                                <p>
                                                    <label>
                                                        <input type="radio" value="0" name="group14" {{ $response14->answer == 0 ? 'checked' : '' }}>
                                                        <span class="text-red-500"><b>No</b></span>
                                                    </label>
                                                </p>
                                            </td>
                                        @else
                                            <td class="whitespace-nowrap py-4 pl-4 pr-3 text-xs font-medium text-gray-900 sm:pl-6">
                                                <p>
                                                    <label>
                                                        <input type="radio" value="1" name="group14">
                                                        <span class="text-pipexblue"><b>Yes</b></span>
                                                    </label>
                                                </p>
                                            </td>
                                            <td class="whitespace-nowrap py-4 pl-4 pr-3 text-xs font-medium text-gray-900 sm:pl-6">
                                                <p>
                                                    <label>
                                                        <input type="radio" value="0" name="group14" checked>
                                                        <span class="text-red-500"><b>No</b></span>
                                                    </label>
                                                </p>
                                            </td>
                                        @endif
                                    </tr>
                                    <tr>
                                        <td class="whitespace-nowrap py-4 pl-4 pr-3 text-xs font-medium text-gray-900 sm:pl-6"><p>Are you varying your posts between Text, Photos, and Links?</p></td>
                                        @if ($response15)
                                            <td class="whitespace-nowrap py-4 pl-4 pr-3 text-xs font-medium text-gray-900 sm:pl-6">
                                                <p>
                                                    <label>
                                                        <input type="radio" value="1" name="group15" {{ $response15->answer == 1 ? 'checked' : '' }} />
                                                        <span class="text-pipexblue"><b>Yes</b></span>
                                                    </label>
                                                </p>
                                            </td>
                                            <td class="whitespace-nowrap py-4 pl-4 pr-3 text-xs font-medium text-gray-900 sm:pl-6">
                                                <p>
                                                    <label>
                                                        <input type="radio" value="0" name="group15" {{ $response15->answer == 0 ? 'checked' : '' }}>
                                                        <span class="text-red-500"><b>No</b></span>
                                                    </label>
                                                </p>
                                            </td>
                                        @else
                                            <td class="whitespace-nowrap py-4 pl-4 pr-3 text-xs font-medium text-gray-900 sm:pl-6">
                                                <p>
                                                    <label>
                                                        <input type="radio" value="1" name="group15">
                                                        <span class="text-pipexblue"><b>Yes</b></span>
                                                    </label>
                                                </p>
                                            </td>
                                            <td class="whitespace-nowrap py-4 pl-4 pr-3 text-xs font-medium text-gray-900 sm:pl-6">
                                                <p>
                                                    <label>
                                                        <input type="radio" value="0" name="group15" checked>
                                                        <span class="text-red-500"><b>No</b></span>
                                                    </label>
                                                </p>
                                            </td>
                                        @endif
                                    </tr>
                                    <tr>
                                        <td class="whitespace-nowrap py-4 pl-4 pr-3 text-xs font-medium text-gray-900 sm:pl-6"><p>Do you have unanswered posts or spam on your Timeline?</p></td>
                                        @if ($response16)
                                            <td class="whitespace-nowrap py-4 pl-4 pr-3 text-xs font-medium text-gray-900 sm:pl-6">
                                                <p>
                                                    <label><input type="radio" value="1" name="group16" {{ $response16->answer == 1 ? 'checked' : '' }}>
                                                        <span class="text-pipexblue"><b>Yes</b></span>
                                                    </label>
                                                </p>
                                            </td>
                                            <td class="whitespace-nowrap py-4 pl-4 pr-3 text-xs font-medium text-gray-900 sm:pl-6">
                                                <p>
                                                    <label>
                                                        <input type="radio" value="0" name="group16" {{ $response16->answer == 0 ? 'checked' : '' }}>
                                                        <span class="text-red-500"><b>No</b></span>
                                                    </label>
                                                </p>
                                            </td>
                                        @else
                                            <td class="whitespace-nowrap py-4 pl-4 pr-3 text-xs font-medium text-gray-900 sm:pl-6">
                                                <p>
                                                    <label>
                                                        <input type="radio" value="1" name="group16">
                                                        <span class="text-pipexblue"><b>Yes</b></span>
                                                    </label>
                                                </p>
                                            </td>
                                            <td class="whitespace-nowrap py-4 pl-4 pr-3 text-xs font-medium text-gray-900 sm:pl-6">
                                                <p>
                                                    <label>
                                                        <input type="radio" value="0" name="group16" checked>
                                                        <span class="text-red-500"><b>No</b></span>
                                                    </label>
                                                </p>
                                            </td>
                                        @endif
                                    </tr>
                                    <tr>
                                        <td class="whitespace-nowrap py-4 pl-4 pr-3 text-xs font-medium text-gray-900 sm:pl-6"><p>Are you sharing tips in your niche?<br>Are your posts benefiting your audiences?</p></td>
                                        @if ($response17)
                                            <td class="whitespace-nowrap py-4 pl-4 pr-3 text-xs font-medium text-gray-900 sm:pl-6">
                                                <p>
                                                    <label>
                                                        <input type="radio" value="1" name="group17" {{ $response17->answer == 1 ? 'checked' : '' }}>
                                                        <span class="text-pipexblue"><b>Yes</b></span>
                                                    </label>
                                                </p>
                                            </td>
                                            <td class="whitespace-nowrap py-4 pl-4 pr-3 text-xs font-medium text-gray-900 sm:pl-6">
                                                <p>
                                                    <label>
                                                        <input type="radio" value="0" name="group17" {{ $response17->answer == 0 ? 'checked' : '' }}>
                                                        <span class="text-red-500"><b>No</b></span>
                                                    </label>
                                                </p>
                                            </td>
                                        @else
                                            <td class="whitespace-nowrap py-4 pl-4 pr-3 text-xs font-medium text-gray-900 sm:pl-6">
                                                <p>
                                                    <label>
                                                        <input type="radio" value="1" name="group17">
                                                        <span class="text-pipexblue"><b>Yes</b></span>
                                                    </label>
                                                </p>
                                            </td>
                                            <td class="whitespace-nowrap py-4 pl-4 pr-3 text-xs font-medium text-gray-900 sm:pl-6">
                                                <p>
                                                    <label>
                                                        <input type="radio" value="0" name="group17" checked>
                                                        <span class="text-red-500"><b>No</b></span>
                                                    </label>
                                                </p>
                                            </td>
                                        @endif
                                    </tr>
                                    <tr>
                                        <td class="whitespace-nowrap py-4 pl-4 pr-3 text-xs font-medium text-gray-900 sm:pl-6"><p>Are you also sending traffic to your website several times a week?</p></td>
                                        @if ($lead->website)
                                            <td class="whitespace-nowrap py-4 pl-4 pr-3 text-xs font-medium text-gray-900 sm:pl-6">
                                                <p>
                                                    <label>
                                                        <input type="radio" value="1" name="group18" {{ $lead->website ? 'checked' : '' }}>
                                                        <span class="text-pipexblue"><b>Yes</b></span>
                                                    </label>
                                                </p>
                                            </td>
                                            <td class="whitespace-nowrap py-4 pl-4 pr-3 text-xs font-medium text-gray-900 sm:pl-6">
                                                <p>
                                                    <label>
                                                        <input type="radio" value="0" name="group18" {{ $lead->website ? '' : 'checked' }}>
                                                        <span class="text-red-500"><b>No</b></span>
                                                    </label>
                                                </p>
                                            </td>
                                        @elseif ($response18)
                                            <td class="whitespace-nowrap py-4 pl-4 pr-3 text-xs font-medium text-gray-900 sm:pl-6">
                                                <p>
                                                    <label>
                                                        <input type="radio" value="1" name="group18" {{ $response18->answer == 1 ? 'checked' : '' }}>
                                                        <span class="text-pipexblue"><b>Yes</b></span>
                                                    </label>
                                                </p>
                                            </td>
                                            <td class="whitespace-nowrap py-4 pl-4 pr-3 text-xs font-medium text-gray-900 sm:pl-6">
                                                <p>
                                                    <label>
                                                        <input type="radio" value="0" name="group18" {{ $response18->answer == 0 ? 'checked' : '' }}>
                                                        <span class="text-red-500"><b>No</b></span>
                                                    </label>
                                                </p>
                                            </td>
                                        @else
                                            <td class="whitespace-nowrap py-4 pl-4 pr-3 text-xs font-medium text-gray-900 sm:pl-6">
                                                <p>
                                                    <label>
                                                        <input type="radio" value="1" name="group18">
                                                        <span class="text-pipexblue"><b>Yes</b></span>
                                                    </label>
                                                </p>
                                            </td>
                                            <td class="whitespace-nowrap py-4 pl-4 pr-3 text-xs font-medium text-gray-900 sm:pl-6">
                                                <p>
                                                    <label>
                                                        <input type="radio" value="0" name="group18" checked>
                                                        <span class="text-red-500"><b>No</b></span>
                                                    </label>
                                                </p>
                                            </td>
                                        @endif
                                    </tr>
                                    <tr>
                                        <td class="whitespace-nowrap py-4 pl-4 pr-3 text-xs font-medium text-gray-900 sm:pl-6"><p>Are you using your personal profile to post about your business?</p></td>
                                        @if ($response19)
                                            <td class="whitespace-nowrap py-4 pl-4 pr-3 text-xs font-medium text-gray-900 sm:pl-6">
                                                <p>
                                                    <label>
                                                        <input type="radio" value="1" name="group19" {{ $response19->answer == 1 ? 'checked' : '' }}>
                                                        <span class="text-pipexblue"><b>Yes</b></span>
                                                    </label>
                                                </p>
                                            </td>
                                            <td class="whitespace-nowrap py-4 pl-4 pr-3 text-xs font-medium text-gray-900 sm:pl-6">
                                                <p>
                                                    <label>
                                                        <input type="radio" value="0" name="group19" {{ $response19->answer == 0 ? 'checked' : '' }}>
                                                        <span class="text-red-500"><b>No</b></span>
                                                    </label>
                                                </p>
                                            </td>
                                        @else
                                            <td class="whitespace-nowrap py-4 pl-4 pr-3 text-xs font-medium text-gray-900 sm:pl-6">
                                                <p>
                                                    <label>
                                                        <input type="radio" value="1" name="group19">
                                                        <span class="text-pipexblue"><b>Yes</b></span>
                                                    </label>
                                                </p>
                                            </td>
                                            <td class="whitespace-nowrap py-4 pl-4 pr-3 text-xs font-medium text-gray-900 sm:pl-6">
                                                <p>
                                                    <label>
                                                        <input type="radio" value="0" name="group19" checked>
                                                        <span class="text-red-500"><b>No</b></span>
                                                    </label>
                                                </p>
                                            </td>
                                        @endif
                                    </tr>
                                    <tr>
                                        <td class="whitespace-nowrap py-4 pl-4 pr-3 text-xs font-medium text-gray-900 sm:pl-6"><p>Do you have your personal profile linked properly to your Facebook Page in your Work section?</p></td>
                                        @if ($response20)
                                            <td class="whitespace-nowrap py-4 pl-4 pr-3 text-xs font-medium text-gray-900 sm:pl-6">
                                                <p>
                                                    <label>
                                                        <input type="radio" value="1" name="group20" {{ $response20->answer == 1 ? 'checked' : '' }}>
                                                        <span class="text-pipexblue"><b>Yes</b></span>
                                                    </label>
                                                </p>
                                            </td>
                                            <td class="whitespace-nowrap py-4 pl-4 pr-3 text-xs font-medium text-gray-900 sm:pl-6">
                                                <p>
                                                    <label>
                                                        <input type="radio" value="0" name="group20" {{ $response20->answer == 0 ? 'checked' : '' }}>
                                                        <span class="text-red-500"><b>No</b></span>
                                                    </label>
                                                </p>
                                            </td>
                                        @else
                                            <td class="whitespace-nowrap py-4 pl-4 pr-3 text-xs font-medium text-gray-900 sm:pl-6">
                                                <p>
                                                    <label>
                                                        <input type="radio" value="1" name="group20">
                                                        <span class="text-pipexblue"><b>Yes</b></span>
                                                    </label>
                                                </p>
                                            </td>
                                            <td class="whitespace-nowrap py-4 pl-4 pr-3 text-xs font-medium text-gray-900 sm:pl-6">
                                                <p>
                                                    <label>
                                                        <input type="radio" value="0" name="group20" checked>
                                                        <span class="text-red-500"><b>No</b></span>
                                                    </label>
                                                </p>
                                            </td>
                                        @endif
                                    </tr>
                                    <tr>
                                        <td class="whitespace-nowrap py-4 pl-4 pr-3 text-xs font-medium text-gray-900 sm:pl-6"><p>Does your Page have a custom URL?</p></td>
                                        @if ($leadDetails->username)
                                            <td class="whitespace-nowrap py-4 pl-4 pr-3 text-xs font-medium text-gray-900 sm:pl-6">
                                                <p>
                                                    <label>
                                                        <input type="radio" value="1" name="group21" {{ $leadDetails->username ? 'checked' : '' }}>
                                                        <span class="text-pipexblue"><b>Yes</b></span>
                                                    </label>
                                                </p>
                                            </td>
                                            <td class="whitespace-nowrap py-4 pl-4 pr-3 text-xs font-medium text-gray-900 sm:pl-6">
                                                <p>
                                                    <label>
                                                        <input type="radio" value="0" name="group21" {{ $leadDetails->username ? '' : 'checked' }}>
                                                        <span class="text-red-500"><b>No</b></span>
                                                    </label>
                                                </p>
                                            </td>
                                        @elseif ($response21)
                                            <td class="whitespace-nowrap py-4 pl-4 pr-3 text-xs font-medium text-gray-900 sm:pl-6">
                                                <p>
                                                    <label>
                                                        <input type="radio" value="1" name="group21" {{ $response21->answer == 1 ? 'checked' : '' }}>
                                                        <span class="text-pipexblue"><b>Yes</b></span>
                                                    </label>
                                                </p>
                                            </td>
                                            <td class="whitespace-nowrap py-4 pl-4 pr-3 text-xs font-medium text-gray-900 sm:pl-6">
                                                <p>
                                                    <label>
                                                        <input type="radio" value="0" name="group21" {{ $response21->answer == 0 ? 'checked' : '' }}>
                                                        <span class="text-red-500"><b>No</b></span>
                                                    </label>
                                                </p>
                                            </td>
                                        @else
                                            <td class="whitespace-nowrap py-4 pl-4 pr-3 text-xs font-medium text-gray-900 sm:pl-6">
                                                <p>
                                                    <label>
                                                        <input type="radio" value="1" name="group21">
                                                        <span class="text-pipexblue"><b>Yes</b></span>
                                                    </label>
                                                </p>
                                            </td>
                                            <td class="whitespace-nowrap py-4 pl-4 pr-3 text-xs font-medium text-gray-900 sm:pl-6">
                                                <p>
                                                    <label>
                                                        <input type="radio" value="0" name="group21" checked>
                                                        <span class="text-red-500"><b>No</b></span>
                                                    </label>
                                                </p>
                                            </td>
                                        @endif
                                    </tr>
                                    <tr>
                                        <td class="whitespace-nowrap py-4 pl-4 pr-3 text-xs font-medium text-gray-900 sm:pl-6"><p>Are you regularly spending money on Facebook ads? At least once a month?</p></td>
                                        @if ($response22)
                                            <td class="whitespace-nowrap py-4 pl-4 pr-3 text-xs font-medium text-gray-900 sm:pl-6">
                                                <p>
                                                    <label>
                                                        <input type="radio" value="1" name="group22" {{ $response22->answer == 1 ? 'checked' : '' }}>
                                                        <span class="text-pipexblue"><b>Yes</b></span>
                                                    </label>
                                                </p>
                                            </td>
                                            <td class="whitespace-nowrap py-4 pl-4 pr-3 text-xs font-medium text-gray-900 sm:pl-6">
                                                <p>
                                                    <label>
                                                        <input type="radio" value="0" name="group22" {{ $response22->answer == 0 ? 'checked' : '' }}>
                                                        <span class="text-red-500"><b>No</b></span>
                                                    </label>
                                                </p>
                                            </td>
                                        @else
                                            <td class="whitespace-nowrap py-4 pl-4 pr-3 text-xs font-medium text-gray-900 sm:pl-6">
                                                <p>
                                                    <label>
                                                        <input type="radio" value="1" name="group22">
                                                        <span class="text-pipexblue"><b>Yes</b></span>
                                                    </label>
                                                </p>
                                            </td>
                                            <td class="whitespace-nowrap py-4 pl-4 pr-3 text-xs font-medium text-gray-900 sm:pl-6">
                                                <p>
                                                    <label>
                                                        <input type="radio" value="0" name="group22" checked>
                                                        <span class="text-red-500"><b>No</b>
                                                        </span>
                                                    </label>
                                                </p>
                                            </td>
                                        @endif
                                    </tr>
                                    <tr>
                                        <td class="whitespace-nowrap py-4 pl-4 pr-3 text-xs font-medium text-gray-900 sm:pl-6"><p>Do you have a link to your Facebook Page prominently located on your website?</p></td>
                                        @if ($lead->website)
                                            <td class="whitespace-nowrap py-4 pl-4 pr-3 text-xs font-medium text-gray-900 sm:pl-6">
                                                <p>
                                                    <label>
                                                        <input type="radio" value="1" name="group23" {{ $lead->website ? 'checked' : '' }}>
                                                        <span class="text-pipexblue"><b>Yes</b></span>
                                                    </label>
                                                </p>
                                            </td>
                                            <td class="whitespace-nowrap py-4 pl-4 pr-3 text-xs font-medium text-gray-900 sm:pl-6">
                                                <p>
                                                    <label>
                                                        <input type="radio" value="0" name="group23" {{ $lead->website ? '' : 'checked' }}>
                                                        <span class="text-red-500"><b>No</b></span>
                                                    </label>
                                                </p>
                                            </td>
                                        @elseif ($response23)
                                            <td class="whitespace-nowrap py-4 pl-4 pr-3 text-xs font-medium text-gray-900 sm:pl-6">
                                                <p>
                                                    <label>
                                                        <input type="radio" value="1" name="group23" {{ $response23->answer == 1 ? 'checked' : '' }}>
                                                        <span class="text-pipexblue"><b>Yes</b></span>
                                                    </label>
                                                </p>
                                            </td>
                                            <td class="whitespace-nowrap py-4 pl-4 pr-3 text-xs font-medium text-gray-900 sm:pl-6">
                                                <p>
                                                    <label>
                                                        <input type="radio" value="0" name="group23" {{ $response23->answer == 0 ? 'checked' : '' }}>
                                                        <span class="text-red-500"><b>No</b></span>
                                                    </label>
                                                </p>
                                            </td>
                                        @else
                                            <td class="whitespace-nowrap py-4 pl-4 pr-3 text-xs font-medium text-gray-900 sm:pl-6">
                                                <p>
                                                    <label>
                                                        <input type="radio" value="1" name="group23">
                                                        <span class="text-pipexblue"><b>Yes</b></span>
                                                    </label>
                                                </p>
                                            </td>
                                            <td class="whitespace-nowrap py-4 pl-4 pr-3 text-xs font-medium text-gray-900 sm:pl-6">
                                                <p>
                                                    <label>
                                                        <input type="radio" value="0" name="group23" checked>
                                                        <span class="text-red-500"><b>No</b></span>
                                                    </label>
                                                </p>
                                            </td>
                                        @endif
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="flex justify-center mt-4">
                <button type="submit" class="rounded-md bg-indigo-600 px-2.5 py-1.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Create audit page</button>
            </div>
        </form>
    </div>
@endsection
