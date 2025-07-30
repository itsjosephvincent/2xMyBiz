@extends('layouts.app')

@section('title', 'Dashboard - 2xMyLeads')

@section('content')

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-x-4">
        <div class="left-card lg:my-0 my-4 px-4 py-5 sm:px-6">
            <h3 class="text-2xl font-semibold leading-6 text-white">Create Good Sales Habits!</h3>
            <p class="text-xs mt-2 text-white">Start finding and cultivating - minimum of 20 leads<br>a day in your business.</p>
            <a href="{{ route('find-facebook-leads') }}" class="mt-4 inline-flex items-center gap-x-1.5 rounded-2xl bg-violet-600 px-2.5 py-1.5 text-sm font-semibold text-white shadow-sm hover:bg-violet-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="-ml-0.5 h-3 w-4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                </svg>
                Start now
            </a>
        </div>
        <div class="right-card lg:my-0 my-4 px-4 py-5 sm:px-6">
            <h3 class="text-2xl font-semibold leading-6 text-white">Welcome, {{ $currentUser->first_name }} to Your Lead Machine!</h3>
            <div class="relative flex items-start mt-2">
                <div class="flex h-6 items-center">
                    <input id="facebook" name="facebook" type="checkbox" class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-600" {{ isset($facebook) ? 'checked' : ''}} disabled>
                </div>
                <div class="ml-3 text-sm leading-6">
                     <label for="facebook" class="text-xs text-white"><a href="{{ route('integrations') }}"><u>Connect Your Facebook</u></a></label>
                </div>
            </div>
            @if ($currentUser->first_name && $currentUser->last_name && $currentUser->email && $currentUser->gender && $currentUser->birthday && $contact && $address)
            <div class="relative flex items-start">
                <div class="flex h-6 items-center">
                    <input id="profile" name="profile" type="checkbox" class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-600" checked disabled>
                </div>
                <div class="ml-3 text-sm leading-6">
                     <label for="profile" class="text-xs text-white"><a href="{{ route('personal-info') }}"><u>Complete Your Profile</u></a></label>
                </div>
            </div>
            @else
            <div class="relative flex items-start">
                <div class="flex h-6 items-center">
                    <input id="profile" name="profile" type="checkbox" class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-600" disabled>
                </div>
                <div class="ml-3 text-sm leading-6">
                     <label for="profile" class="text-xs text-white"><a href="{{ route('personal-info') }}"><u>Complete Your Profile</u></a></label>
                </div>
            </div>
            @endif
            @if ($bname && $bweb && $bemail && $bphone && $baddress && $babout && $bmessage && $blogo && $bbanner && $bcalendar)
            <div class="relative flex items-start">
                <div class="flex h-6 items-center">
                    <input id="profile" name="profile" type="checkbox" class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-600" checked disabled>
                </div>
                <div class="ml-3 text-sm leading-6">
                     <label for="profile" class="text-xs text-white">Fill in <a href="{{ route('business-information') }}"><u>Business Details</u></a>, <a href="{{ route('business-logo') }}"><u>Logo</u></a>, <a href="{{ route('business-banner') }}"><u>Banner</u></a>, and <a href="{{ route('business-calender') }}"><u>Calendar</u></a></label>
                </div>
            </div>
            @else
            <div class="relative flex items-start">
                <div class="flex h-6 items-center">
                    <input id="profile" name="profile" type="checkbox" class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-600" disabled>
                </div>
                <div class="ml-3 text-sm leading-6">
                     <label for="profile" class="text-xs text-white">Fill in <a href="{{ route('business-information') }}"><u>Business Details</u></a>, <a href="{{ route('business-logo') }}"><u>Logo</u></a>, <a href="{{ route('business-banner') }}"><u>Banner</u></a>, and <a href="{{ route('business-calender') }}"><u>Calendar</u></a></label>
                </div>
            </div>
            @endif

            <div class="relative flex items-start">
                <div class="flex h-6 items-center">
                    <input id="profile" name="profile" type="checkbox" class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-600" {{ isset($linkedin) ? 'checked' : '' }} disabled>
                </div>
                <div class="ml-3 text-sm leading-6">
                     <label for="profile" class="text-xs text-white"><a href="{{ route('integrations') }}"><u>Connect Your LinkedIn</u></a></label>
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-4 gap-4 mt-4">
        <div class="px-4 py-5 sm:px-6 search-card">
            <div class="grid grid-rows-2 gap-4">
                <div>
                    <h3 class="text-sm font-semibold leading-6 text-white">Searched Leads</h3>
                </div>
                <div>
                    <span class="text-3xl group flex gap-x-8 leading-5 font-semibold text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                        </svg>
                        {{ isset($dash_count->search_count) ? $dash_count->search_count : 0 }}
                    </span>
                </div>
            </div>
        </div>
        <div class="px-4 py-5 sm:px-6 saved-card">
            <div class="grid grid-rows-2 gap-4">
                <div>
                    <h3 class="text-sm font-semibold leading-6 text-white">Leads Saved</h3>
                </div>
                <div>
                    <span class="text-3xl group flex gap-x-8 leading-5 font-semibold text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
                        </svg>
                        {{ $lead_count }}
                    </span>
                </div>
            </div>
        </div>
        <div class="px-4 py-5 sm:px-6 contacted-card">
            <div class="grid grid-rows-2 gap-4">
                <div>
                    <h3 class="text-sm font-semibold leading-6 text-white">Leads Emailed</h3>
                </div>
                <div>
                    <span class="text-3xl group flex gap-x-8 leading-5 font-semibold text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" />
                        </svg>
                        {{ isset($dash_count->contact_count) ? $dash_count->contact_count : 0 }}
                    </span>
                </div>
            </div>
        </div>
        <div class="px-4 py-5 sm:px-6 closed-card">
            <div class="grid grid-rows-2 gap-4">
                <div>
                    <h3 class="text-sm font-semibold leading-6 text-white">Leads Closed</h3>
                </div>
                <div>
                    <span class="text-3xl group flex gap-x-8 leading-5 font-semibold text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 18.75h-9m9 0a3 3 0 013 3h-15a3 3 0 013-3m9 0v-3.375c0-.621-.503-1.125-1.125-1.125h-.871M7.5 18.75v-3.375c0-.621.504-1.125 1.125-1.125h.872m5.007 0H9.497m5.007 0a7.454 7.454 0 01-.982-3.172M9.497 14.25a7.454 7.454 0 00.981-3.172M5.25 4.236c-.982.143-1.954.317-2.916.52A6.003 6.003 0 007.73 9.728M5.25 4.236V4.5c0 2.108.966 3.99 2.48 5.228M5.25 4.236V2.721C7.456 2.41 9.71 2.25 12 2.25c2.291 0 4.545.16 6.75.47v1.516M7.73 9.728a6.726 6.726 0 002.748 1.35m8.272-6.842V4.5c0 2.108-.966 3.99-2.48 5.228m2.48-5.492a46.32 46.32 0 012.916.52 6.003 6.003 0 01-5.395 4.972m0 0a6.726 6.726 0 01-2.749 1.35m0 0a6.772 6.772 0 01-3.044 0" />
                        </svg>
                        {{ $closed_count }}
                    </span>
                </div>
            </div>
        </div>

        <div class="col-span-2 md:col-span-4 lg:col-span-2">
            <div class="sm:flex sm:items-center">
                <div class="sm:flex-auto">
                    <h1 class="text-base font-bold leading-6 text-gray-900">Leads per Stage</h1>
                </div>
            </div>
            <div class="rounded-lg border border-gray-200 bg-white px-4 py-5 sm:px-6 mt-2" id="chart"></div>
        </div>


        <div class="col-span-2 md:col-span-4 lg:col-span-2 lg:px-0 px-2">
            <div class="sm:flex sm:items-center">
                <div class="sm:flex-auto">
                    <h1 class="text-base font-bold leading-6 text-gray-900">Facebook Post Performance</h1>
                </div>
            </div>
            <div class="mt-2 flow-root">
                <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                        <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 sm:rounded-lg">
                            <table class="min-w-full divide-y divide-gray-300">
                                <thead class="bg-white">
                                        <tr>
                                            <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">Post title</th>
                                            <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Total likes</th>
                                            <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Total comments</th>
                                        </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200 bg-white">
                                    @if (isset($posts))
                                        @foreach ($posts as $post)
                                        <tr>
                                            <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6">{{ strtoupper($post['post_title']) }}</td>
                                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                                <span class="inline-flex">
                                                    {{ $post['total_likes'] }}
                                                    <svg id="Layer_1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1501.7 1504.4" class="h-4 w-4 mt-0.5 ml-1">
                                                        <style>.st0{fill:#5e91ff}.st1{fill:#fff}</style>
                                                        <title>Like</title>
                                                        <ellipse class="st0" cx="750.8" cy="752.2" rx="750.8" ry="752.2"/>
                                                        <path class="st1" d="M378.3 667.5h165.1c13 0 23.6 10.5 23.6 23.6v379.1c0 13-10.5 23.6-23.6 23.6H378.3c-13 0-23.6-10.5-23.6-23.6V691c.1-13 10.6-23.5 23.6-23.5zM624.7 1004.7V733.1c.1-66.9 18.8-132.4 54.1-189.2 21.5-34.4 69.7-89.5 96.7-118 6-6.4 27.8-25.2 27.8-35.5 0-13.2 1.5-34.5 2-74.2.3-25.2 20.8-45.9 46-45.7h1.1c44.1.8 58.2 41.6 58.2 41.6s37.7 74.4 2.5 165.4c-29.7 76.9-35.8 83.1-35.8 83.1s-9.6 13.9 20.8 13.3c0 0 185.6-.8 192-.8 13.7 0 57.4 12.5 54.9 68.2-1.8 41.2-27.4 55.6-40.5 60.3-1.7.6-2.6 2.5-1.9 4.2.3.7.8 1.3 1.5 1.7 13.4 7.8 40.8 27.5 40.2 57.7-.8 36.6-15.5 50.1-46.1 58.5-1.7.4-2.8 2.2-2.3 3.9.2.9.8 1.6 1.5 2 11.6 6.6 31.5 22.7 30.3 55.3-1.2 33.2-25.2 44.9-38.3 48.9-1.7.5-2.7 2.3-2.2 4 .2.7.7 1.4 1.3 1.8 8.3 5.7 20.6 18.6 20 45.1-.3 14-5 24.2-10.9 31.5-9.3 11.5-23.9 17.5-38.7 17.6l-411.8.8c-.1-.1-22.4 0-22.4-29.9z"/>
                                                    </svg>
                                                </span>
                                            </td>
                                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                                <span class="inline-flex">
                                                    {{ $post['total_comments'] }}
                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 439.3 529.7" class="h-4 w-4 mt-0.5 ml-1">
                                                        <path d="M0 529.7l108.9-117.1h330.4V0H.7L0 529.7zM338.7 173c20.5 0 37.2 16.6 37.2 37.2 0 20.5-16.6 37.2-37.2 37.2s-37.2-16.6-37.2-37.2c.1-20.5 16.7-37.2 37.2-37.2zM220 173c20.5 0 37.2 16.6 37.2 37.2 0 20.5-16.6 37.2-37.2 37.2-20.5 0-37.2-16.6-37.2-37.2.1-20.5 16.7-37.2 37.2-37.2zm-118.7 0c20.5 0 37.2 16.6 37.2 37.2 0 20.5-16.6 37.2-37.2 37.2-20.5 0-37.2-16.6-37.2-37.2 0-20.5 16.7-37.2 37.2-37.2z"/>
                                                    </svg>
                                                </span>
                                            </td>
                                        </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-span-2 md:col-span-4 lg:col-span-2">
            <div class="sm:flex sm:items-center">
                <div class="sm:flex-auto">
                    <h1 class="text-base font-bold leading-6 text-gray-900">Lead percentage by stage</h1>
                </div>
            </div>
            <div class="rounded-lg border border-gray-200 bg-white px-4 py-5 sm:px-6 mt-2" id="percentage"></div>
        </div>

        <div class="col-span-2 md:col-span-4 lg:col-span-2">
            <div class="sm:flex sm:items-center">
                <div class="sm:flex-auto">
                    <h1 class="text-base font-bold leading-6 text-gray-900">Top lost reasons</h1>
                </div>
            </div>
            <div class="rounded-lg border border-gray-200 bg-white px-4 py-5 sm:px-6 mt-2" id="reasons"></div>
        </div>

    </div>
@endsection

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script type="text/javascript" src="https://2xmybiz.kartra.com/resources/js/popup"></script>
    <script type="text/javascript">
        var data = @json($leadgroupnames);
        var data_count = @json($leadscount);
        var total_data = @json($lead_count);
        var notQualified = @json($notQualified);
        var costHigh = @json($costHigh);
        var notRightTime = @json($notRightTime);
        var notInterested = @json($notInterested);
        var notNeeded = @json($notNeeded);
        var haveGuy = @json($haveGuy);
        var tooLong = @json($tooLong);
        var noBusiness = @json($noBusiness);
        var other = @json($other);
    </script>
    <script src="{{ asset('js/dashboard.js') }}"></script>
@endsection
