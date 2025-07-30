@extends('layouts.app')

@section('title', 'SEO Audit Report - 2xMyLeads')

@section('content')
<div class="grid grid-cols-2 mb-8">
    <div class="col-span-1">
        <a href="{{ route('page.list') }}" class="inline-flex items-center gap-x-1.5 rounded bg-indigo-50 px-2 py-1 text-xs font-semibold text-black shadow-sm hover:bg-indigo-100">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="-ml-0.5 h-5 w-5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
            </svg>
            Go back
        </a>
    </div>
    <div class="col-span-1 sm:flex justify-end hidden">
        <button id="downloadBtn" class="inline-flex items-end gap-x-1.5 rounded bg-indigo-50 px-2 py-1 text-xs font-semibold text-black shadow-sm hover:bg-indigo-100 ml-auto">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="-ml-0.5 h-5 w-5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3" />
            </svg>
            Download Report
        </button>
    </div>
</div>

<div id="audit-content">
    <div>
        <h3 class="text-base font-semibold leading-6 text-gray-900">Audit Report</h3>
        <dl class="mt-5 grid grid-cols-1 gap-5 sm:grid-cols-5">
            <div class="overflow-hidden rounded-lg bg-white px-4 py-5 shadow sm:p-6">
                <dt class="truncate text-sm text-center font-medium text-gray-500">Performance</dt>
                @if ($performance >= 50 && $performance <= 89)
                <dd class="mt-1 text-3xl text-center font-semibold tracking-tight text-orange-600">{{ $performance }}%</dd>
                @elseif ($performance >= 90)
                <dd class="mt-1 text-3xl text-center font-semibold tracking-tight text-green-600">{{ $performance }}%</dd>
                @else
                <dd class="mt-1 text-3xl text-center font-semibold tracking-tight text-red-600">{{ $performance }}%</dd>
                @endif
            </div>
            <div class="overflow-hidden rounded-lg bg-white px-4 py-5 shadow sm:p-6">
                <dt class="truncate text-sm text-center font-medium text-gray-500">Best Practices</dt>
                @if ($bestpractices >= 50 && $bestpractices <= 89)
                <dd class="mt-1 text-3xl text-center font-semibold tracking-tight text-orange-600">{{ $bestpractices }}%</dd>
                @elseif ($bestpractices >= 90)
                <dd class="mt-1 text-3xl text-center font-semibold tracking-tight text-green-600">{{ $bestpractices }}%</dd>
                @else
                <dd class="mt-1 text-3xl text-center font-semibold tracking-tight text-red-600">{{ $bestpractices }}%</dd>
                @endif
            </div>
            <div class="overflow-hidden rounded-lg bg-white px-4 py-5 shadow sm:p-6">
                <dt class="truncate text-sm text-center font-medium text-gray-500">Accessibility</dt>
                @if ($access <= 50 && $access >= 89)
                <dd class="mt-1 text-3xl text-center font-semibold tracking-tight text-orange-600">{{ $access }}%</dd>
                @elseif ($access >= 90)
                <dd class="mt-1 text-3xl text-center font-semibold tracking-tight text-green-600">{{ $access }}%</dd>
                @else
                <dd class="mt-1 text-3xl text-center font-semibold tracking-tight text-red-600">{{ $access }}%</dd>
                @endif
            </div>
            <div class="overflow-hidden rounded-lg bg-white px-4 py-5 shadow sm:p-6">
                <dt class="truncate text-sm text-center font-medium text-gray-500">SEO</dt>
                @if ($seo <= 50 && $seo >= 89)
                <dd class="mt-1 text-3xl text-center font-semibold tracking-tight text-orange-600">{{ $seo }}%</dd>
                @elseif ($seo >= 90)
                <dd class="mt-1 text-3xl text-center font-semibold tracking-tight text-green-600">{{ $seo }}%</dd>
                @else
                <dd class="mt-1 text-3xl text-center font-semibold tracking-tight text-red-600">{{ $seo }}%</dd>
                @endif
            </div>
            <div class="overflow-hidden rounded-lg bg-white px-4 py-5 shadow sm:p-6">
                <dt class="truncate text-sm text-center font-medium text-gray-500">PWA</dt>
                @if ($pwa <= 50 && $pwa >= 89)
                <dd class="mt-1 text-3xl text-center font-semibold tracking-tight text-orange-600">{{ $pwa }}%</dd>
                @elseif ($pwa >= 90)
                <dd class="mt-1 text-3xl text-center font-semibold tracking-tight text-green-600">{{ $pwa }}%</dd>
                @else
                <dd class="mt-1 text-3xl text-center font-semibold tracking-tight text-red-600">{{ $pwa }}%</dd>
                @endif
            </div>
        </dl>
    </div>
    <div class="bg-white py-24 sm:py-32 mt-4">
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
            <div class="mx-auto max-w-2xl lg:mx-0">
                <h2 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">Performance metrics</h2>
                <p class="mt-2 text-lg leading-8 text-gray-600">Values are estimated and may vary. <a class="text-blue-500 underline" href="https://developer.chrome.com/docs/lighthouse/performance/performance-scoring/?utm_source=lighthouse&utm_medium=lr" target="_blank">The performance score is calculated</a> directly from these metrics.</p>
            </div>
            <div class="mx-auto mt-10 grid max-w-2xl grid-cols-1 gap-x-8 gap-y-16 border-t border-gray-200 pt-10 sm:mt-16 sm:pt-16 lg:mx-0 lg:max-w-none lg:grid-cols-2">
                <article class="flex max-w-xl flex-col items-start justify-between">
                    <div class="group relative">
                        <h3 class="mt-3 text-lg font-semibold leading-6 text-gray-900 group-hover:text-gray-600">
                            <span class="absolute inset-0"></span>
                            First Contentful Paint
                        </h3>
                        @if (($fcp['numericValue'] / 1000) <= 1.8)
                        <h2 class="mt-4 text-4xl font-semibold leading-6 text-green-600 group-hover:text-gray-600">
                            <span class="absolute inset-0"></span>
                            {{ $fcp['displayValue'] }}
                        </h2>
                        @elseif (($fcp['numericValue'] / 1000) > 1.8 && ($fcp['numericValue'] / 1000) <= 3)
                        <h2 class="mt-4 text-4xl font-semibold leading-6 text-orange-600 group-hover:text-gray-600">
                            <span class="absolute inset-0"></span>
                            {{ $fcp['displayValue'] }}
                        </h2>
                        @else
                            <h2 class="mt-4 text-4xl font-semibold leading-6 text-red-600 group-hover:text-gray-600">
                                <span class="absolute inset-0"></span>
                                {{ $fcp['displayValue'] }}
                            </h2>
                        @endif
                        <p class="mt-5 line-clamp-3 text-sm leading-6 text-gray-600">First Contentful Paint marks the time at which the first text or image is painted.</p>
                    </div>
                </article>
                <article class="flex max-w-xl flex-col items-start justify-between">
                    <div class="group relative">
                        <h3 class="mt-3 text-lg font-semibold leading-6 text-gray-900 group-hover:text-gray-600">
                            <span class="absolute inset-0"></span>
                            Largest Contentful Paint
                        </h3>
                        @if (($lcp['numericValue'] / 1000) <= 2.5)
                        <h2 class="mt-4 text-4xl font-semibold leading-6 text-green-600 group-hover:text-gray-600">
                            <span class="absolute inset-0"></span>
                            {{ $lcp['displayValue'] }}
                        </h2>
                        @elseif (($lcp['numericValue'] / 1000) > 2.5 && ($lcp['numericValue'] / 1000) <= 4)
                        <h2 class="mt-4 text-4xl font-semibold leading-6 text-orange-600 group-hover:text-gray-600">
                            <span class="absolute inset-0"></span>
                            {{ $lcp['displayValue'] }}
                        </h2>
                        @else
                        <h2 class="mt-4 text-4xl font-semibold leading-6 text-red-600 group-hover:text-gray-600">
                            <span class="absolute inset-0"></span>
                            {{ $lcp['displayValue'] }}
                        </h2>
                        @endif
                        <p class="mt-5 line-clamp-3 text-sm leading-6 text-gray-600">Largest Contentful Paint marks the time at which the largest text or image is painted.</p>
                    </div>
                </article>
                <article class="flex max-w-xl flex-col items-start justify-between">
                    <div class="group relative">
                        <h3 class="mt-3 text-lg font-semibold leading-6 text-gray-900 group-hover:text-gray-600">
                            <span class="absolute inset-0"></span>
                            Total Blocking Time
                        </h3>
                        @if($tbt['numericValue'] <= 200)
                        <h2 class="mt-4 text-4xl font-semibold leading-6 text-green-600 group-hover:text-gray-600">
                            <span class="absolute inset-0"></span>
                            {{ $tbt['displayValue'] }}
                        </h2>
                        @elseif ($tbt['numericValue'] > 200 && $tbt['numericValue'] <= 600)
                        <h2 class="mt-4 text-4xl font-semibold leading-6 text-orange-600 group-hover:text-gray-600">
                            <span class="absolute inset-0"></span>
                            {{ $tbt['displayValue'] }}
                        </h2>
                        @else
                        <h2 class="mt-4 text-4xl font-semibold leading-6 text-red-600 group-hover:text-gray-600">
                            <span class="absolute inset-0"></span>
                            {{ $tbt['displayValue'] }}
                        </h2>
                        @endif
                        <p class="mt-5 line-clamp-3 text-sm leading-6 text-gray-600">Sum of all time periods between FCP and Time to Interactive, when task length exceeded 50ms, expressed in milliseconds.</p>
                    </div>
                </article>
                <article class="flex max-w-xl flex-col items-start justify-between">
                    <div class="group relative">
                        <h3 class="mt-3 text-lg font-semibold leading-6 text-gray-900 group-hover:text-gray-600">
                            <span class="absolute inset-0"></span>
                            Cumulative Layout Shift
                        </h3>
                        @if ($cls['numericValue'] <= 0.1)
                        <h2 class="mt-4 text-4xl font-semibold leading-6 text-green-600 group-hover:text-gray-600">
                            <span class="absolute inset-0"></span>
                            {{ $cls['displayValue'] }}
                        </h2>
                        @elseif ($cls['numericValue'] > 0.1 && $cls['numericValue'] <= 0.25 )
                        <h2 class="mt-4 text-4xl font-semibold leading-6 text-orange-600 group-hover:text-gray-600">
                            <span class="absolute inset-0"></span>
                            {{ $cls['displayValue'] }}
                        </h2>
                        @else
                        <h2 class="mt-4 text-4xl font-semibold leading-6 text-red-600 group-hover:text-gray-600">
                            <span class="absolute inset-0"></span>
                            {{ $cls['displayValue'] }}
                        </h2>
                        @endif
                        <p class="mt-5 line-clamp-3 text-sm leading-6 text-gray-600">Cumulative Layout Shift measures the movement of visible elements within the viewport.</p>
                    </div>
                </article>
                <article class="flex max-w-xl flex-col items-start justify-between">
                    <div class="group relative">
                        <h3 class="mt-3 text-lg font-semibold leading-6 text-gray-900 group-hover:text-gray-600">
                            <span class="absolute inset-0"></span>
                            Speed Index
                        </h3>
                        @if ($si['score'] <= 3.4)
                        <h2 class="mt-4 text-4xl font-semibold leading-6 text-green-600 group-hover:text-gray-600">
                            <span class="absolute inset-0"></span>
                            {{ $si['displayValue'] }}
                        </h2>
                        @elseif ($si['score'] > 3.4 && $si['score'] <= 5.8)
                        <h2 class="mt-4 text-4xl font-semibold leading-6 text-orange-600 group-hover:text-gray-600">
                            <span class="absolute inset-0"></span>
                            {{ $si['displayValue'] }}
                        </h2>
                        @else
                        <h2 class="mt-4 text-4xl font-semibold leading-6 text-red-600 group-hover:text-gray-600">
                            <span class="absolute inset-0"></span>
                            {{ $si['displayValue'] }}
                        </h2>
                        @endif
                        <p class="mt-5 line-clamp-3 text-sm leading-6 text-gray-600">Speed Index shows how quickly the contents of a page are visibly populated.</p>
                    </div>
                </article>
            </div>
        </div>
    </div>
    <div class="bg-white py-24 sm:py-32 mt-4">
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
            <div class="mx-auto max-w-2xl lg:mx-0">
                <h2 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">Best Practices</h2>
            </div>
            <div class="mx-auto mt-10 grid max-w-2xl grid-cols-1 gap-x-8 gap-y-16 border-t border-gray-200 pt-10 sm:mt-16 sm:pt-16 lg:mx-0 lg:max-w-none lg:grid-cols-2">
                <article class="flex max-w-xl flex-col items-start justify-between">
                    <div class="group relative">
                        <h3 class="mt-3 text-lg font-semibold leading-6 text-gray-900 group-hover:text-gray-600">
                            <span class="absolute inset-0"></span>
                            Trust and Safety
                        </h3>
                        <ul role="list" class="divide-y divide-white/5">
                            @foreach ($bestresults as $result)
                            @if (isset($result['group']) && $result['group'] == 'best-practices-trust-safety')
                            <li class="relative flex items-center space-x-1">
                                <div class="min-w-0 flex-auto">
                                    <div class="flex items-center gap-x-2">
                                        @if ($result['weight'] >= 4)
                                        <div class="flex-none rounded-full p-1 text-green-500 bg-green-100">
                                            <div class="h-2 w-2 rounded-full bg-current"></div>
                                        </div>
                                        @elseif($result['weight'] == 3)
                                        <div class="flex-none rounded-full p-1 text-orange-500 bg-orange-100">
                                            <div class="h-2 w-2 rounded-full bg-current"></div>
                                        </div>
                                        @else
                                        <div class="flex-none rounded-full p-1 text-red-500 bg-red-100">
                                            <div class="h-2 w-2 rounded-full bg-current"></div>
                                        </div>
                                        @endif
                                        <h2 class="min-w-0 text-sm font-semibold leading-6 text-black">
                                            <span class="break-words">{{ $audits[$result['id']]['title'] }}</span>
                                        </h2>
                                    </div>
                                </div>
                            </li>
                            @endif
                            @endforeach
                        </ul>
                    </div>
                </article>
                <article class="flex max-w-xl flex-col items-start justify-between">
                    <div class="group relative">
                        <h3 class="mt-3 text-lg font-semibold leading-6 text-gray-900 group-hover:text-gray-600">
                            <span class="absolute inset-0"></span>
                            User Experience
                        </h3>
                        <ul role="list" class="divide-y divide-white/5">
                            @foreach ($bestresults as $result)
                            @if (isset($result['group']) && $result['group'] == 'best-practices-ux')
                            <li class="relative flex items-center space-x-1">
                                <div class="min-w-0 flex-auto">
                                    <div class="flex items-center gap-x-2">
                                        @if ($result['weight'] >= 4)
                                        <div class="flex-none rounded-full p-1 text-green-500 bg-green-100">
                                            <div class="h-2 w-2 rounded-full bg-current"></div>
                                        </div>
                                        @elseif($result['weight'] == 3)
                                        <div class="flex-none rounded-full p-1 text-orange-500 bg-orange-100">
                                            <div class="h-2 w-2 rounded-full bg-current"></div>
                                        </div>
                                        @else
                                        <div class="flex-none rounded-full p-1 text-red-500 bg-red-100">
                                            <div class="h-2 w-2 rounded-full bg-current"></div>
                                        </div>
                                        @endif
                                        <h2 class="min-w-0 text-sm font-semibold leading-6 text-black">
                                            <span class="break-words">{{ $audits[$result['id']]['title'] }}</span>
                                        </h2>
                                    </div>
                                </div>
                            </li>
                            @endif
                            @endforeach
                        </ul>
                    </div>
                </article>
                <article class="flex max-w-xl flex-col items-start justify-between">
                    <div class="group relative">
                        <h3 class="mt-3 text-lg font-semibold leading-6 text-gray-900 group-hover:text-gray-600">
                            <span class="absolute inset-0"></span>
                            Browser Compatibilty
                        </h3>
                        <ul role="list" class="divide-y divide-white/5">
                            @foreach ($bestresults as $result)
                            @if (isset($result['group']) && $result['group'] == 'best-practices-browser-compat')
                            <li class="relative flex items-center space-x-1">
                                <div class="min-w-0 flex-auto">
                                    <div class="flex items-center gap-x-2">
                                        @if ($result['weight'] >= 4)
                                        <div class="flex-none rounded-full p-1 text-green-500 bg-green-100">
                                            <div class="h-2 w-2 rounded-full bg-current"></div>
                                        </div>
                                        @elseif($result['weight'] == 3)
                                        <div class="flex-none rounded-full p-1 text-orange-500 bg-orange-100">
                                            <div class="h-2 w-2 rounded-full bg-current"></div>
                                        </div>
                                        @else
                                        <div class="flex-none rounded-full p-1 text-red-500 bg-red-100">
                                            <div class="h-2 w-2 rounded-full bg-current"></div>
                                        </div>
                                        @endif
                                        <h2 class="min-w-0 text-sm font-semibold leading-6 text-black">
                                            <span class="break-words">{{ $audits[$result['id']]['title'] }}</span>
                                        </h2>
                                    </div>
                                </div>
                            </li>
                            @endif
                            @endforeach
                        </ul>
                    </div>
                </article>
                <article class="flex max-w-xl flex-col items-start justify-between">
                    <div class="group relative">
                        <h3 class="mt-3 text-lg font-semibold leading-6 text-gray-900 group-hover:text-gray-600">
                            <span class="absolute inset-0"></span>
                            General
                        </h3>
                        <ul role="list" class="divide-y divide-white/5">
                            @foreach ($bestresults as $result)
                            @if (isset($result['group']) && $result['group'] == 'best-practices-general')
                            <li class="relative flex items-center space-x-1">
                                <div class="min-w-0 flex-auto">
                                    <div class="flex items-center gap-x-2">
                                        @if ($result['weight'] >= 4)
                                        <div class="flex-none rounded-full p-1 text-green-500 bg-green-100">
                                            <div class="h-2 w-2 rounded-full bg-current"></div>
                                        </div>
                                        @elseif($result['weight'] == 3)
                                        <div class="flex-none rounded-full p-1 text-orange-500 bg-orange-100">
                                            <div class="h-2 w-2 rounded-full bg-current"></div>
                                        </div>
                                        @else
                                        <div class="flex-none rounded-full p-1 text-red-500 bg-red-100">
                                            <div class="h-2 w-2 rounded-full bg-current"></div>
                                        </div>
                                        @endif
                                        <h2 class="min-w-0 text-sm font-semibold leading-6 text-black">
                                            <span class="break-words">{{ $audits[$result['id']]['title'] }}</span>
                                        </h2>
                                    </div>
                                </div>
                            </li>
                            @endif
                            @endforeach
                        </ul>
                    </div>
                </article>
                <article class="flex max-w-xl flex-col items-start justify-between">
                    <div class="group relative">
                        <h3 class="mt-3 text-lg font-semibold leading-6 text-gray-900 group-hover:text-gray-600">
                            <span class="absolute inset-0"></span>
                            Passed Audits
                        </h3>
                        <ul role="list" class="divide-y divide-white/5">
                            @foreach ($bestresults as $result)
                                @if ($result['weight'] >= 4)
                                <li class="relative flex items-center space-x-1">
                                    <div class="min-w-0 flex-auto">
                                        <div class="flex items-center gap-x-2">
                                            <div class="flex-none rounded-full p-1 text-green-500 bg-green-100">
                                                <div class="h-2 w-2 rounded-full bg-current"></div>
                                            </div>
                                            <h2 class="min-w-0 text-sm font-semibold leading-6 text-black">
                                                <span class="break-words">{{ $audits[$result['id']]['title'] }}</span>
                                            </h2>
                                        </div>
                                    </div>
                                </li>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                </article>
            </div>
        </div>
    </div>
    <div class="bg-white py-24 sm:py-32 mt-4">
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
            <div class="mx-auto max-w-2xl lg:mx-0">
                <h2 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">Accessibility</h2>
                <p class="mt-2 text-lg leading-8 text-gray-600">
                    These checks highlight opportunities to <a class="text-blue-500 underline" href="https://developer.chrome.com/docs/lighthouse/accessibility/" target="_blank">improve the accessibility of your web app</a>.
                    Automatic detection can only detect a subset of issues and does not guarantee the accessibility of your web app,
                    so <a class="text-blue-500 underline" href="https://web.dev/how-to-review/" target="_blank">manual</a> testing is also encouraged.
                </p>
            </div>
            <div class="mx-auto mt-10 grid max-w-2xl grid-cols-1 gap-x-8 gap-y-16 border-t border-gray-200 pt-10 sm:mt-16 sm:pt-16 lg:mx-0 lg:max-w-none lg:grid-cols-2">
                <article class="flex max-w-xl flex-col items-start justify-between">
                    <div class="group relative">
                        <h3 class="mt-3 text-lg font-semibold leading-6 text-gray-900 group-hover:text-gray-600">
                            <span class="absolute inset-0"></span>
                            Aria
                        </h3>
                        <ul role="list" class="divide-y divide-white/5">
                            @foreach ($accresults as $accresult)
                                @if (isset($accresult['group']) && $accresult['group'] == 'a11y-aria')
                                <li class="relative flex items-center space-x-1">
                                    <div class="min-w-0 flex-auto">
                                        <div class="flex items-center gap-x-2">
                                            @if ($accresult['weight'] >= 4)
                                            <div class="flex-none rounded-full p-1 text-green-500 bg-green-100">
                                                <div class="h-2 w-2 rounded-full bg-current"></div>
                                            </div>
                                            @elseif($accresult['weight'] == 3)
                                            <div class="flex-none rounded-full p-1 text-orange-500 bg-orange-100">
                                                <div class="h-2 w-2 rounded-full bg-current"></div>
                                            </div>
                                            @else
                                            <div class="flex-none rounded-full p-1 text-red-500 bg-red-100">
                                                <div class="h-2 w-2 rounded-full bg-current"></div>
                                            </div>
                                            @endif
                                            <h2 class="min-w-0 text-sm font-semibold leading-6 text-black">
                                                <span class="break-words">{{ $audits[$accresult['id']]['title'] }}</span>
                                            </h2>
                                        </div>
                                    </div>
                                </li>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                </article>
                <article class="flex max-w-xl flex-col items-start justify-between">
                    <div class="group relative">
                        <h3 class="mt-3 text-lg font-semibold leading-6 text-gray-900 group-hover:text-gray-600">
                            <span class="absolute inset-0"></span>
                            Navigation
                        </h3>
                        <ul role="list" class="divide-y divide-white/5">
                            @foreach ($accresults as $accresult)
                                @if (isset($accresult['group']) && $accresult['group'] == 'a11y-navigation')
                                <li class="relative flex items-center space-x-1">
                                    <div class="min-w-0 flex-auto">
                                        <div class="flex items-center gap-x-2">
                                            @if ($accresult['weight'] >= 4)
                                            <div class="flex-none rounded-full p-1 text-green-500 bg-green-100">
                                                <div class="h-2 w-2 rounded-full bg-current"></div>
                                            </div>
                                            @elseif($accresult['weight'] == 3)
                                            <div class="flex-none rounded-full p-1 text-orange-500 bg-orange-100">
                                                <div class="h-2 w-2 rounded-full bg-current"></div>
                                            </div>
                                            @else
                                            <div class="flex-none rounded-full p-1 text-red-500 bg-red-100">
                                                <div class="h-2 w-2 rounded-full bg-current"></div>
                                            </div>
                                            @endif
                                            <h2 class="min-w-0 text-sm font-semibold leading-6 text-black">
                                                <span class="break-words">{{ $audits[$accresult['id']]['title'] }}</span>
                                            </h2>
                                        </div>
                                    </div>
                                </li>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                </article>
                <article class="flex max-w-xl flex-col items-start justify-between">
                    <div class="group relative">
                        <h3 class="mt-3 text-lg font-semibold leading-6 text-gray-900 group-hover:text-gray-600">
                            <span class="absolute inset-0"></span>
                            Names & Labels
                        </h3>
                        <ul role="list" class="divide-y divide-white/5">
                            @foreach ($accresults as $accresult)
                                @if (isset($accresult['group']) && $accresult['group'] == 'a11y-names-labels')
                                <li class="relative flex items-center space-x-1">
                                    <div class="min-w-0 flex-auto">
                                        <div class="flex items-center gap-x-2">
                                            @if ($accresult['weight'] >= 4)
                                            <div class="flex-none rounded-full p-1 text-green-500 bg-green-100">
                                                <div class="h-2 w-2 rounded-full bg-current"></div>
                                            </div>
                                            @elseif($accresult['weight'] == 3)
                                            <div class="flex-none rounded-full p-1 text-orange-500 bg-orange-100">
                                                <div class="h-2 w-2 rounded-full bg-current"></div>
                                            </div>
                                            @else
                                            <div class="flex-none rounded-full p-1 text-red-500 bg-red-100">
                                                <div class="h-2 w-2 rounded-full bg-current"></div>
                                            </div>
                                            @endif
                                            <h2 class="min-w-0 text-sm font-semibold leading-6 text-black">
                                                <span class="break-words">{{ $audits[$accresult['id']]['title'] }}</span>
                                            </h2>
                                        </div>
                                    </div>
                                </li>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                </article>
                <article class="flex max-w-xl flex-col items-start justify-between">
                    <div class="group relative">
                        <h3 class="mt-3 text-lg font-semibold leading-6 text-gray-900 group-hover:text-gray-600">
                            <span class="absolute inset-0"></span>
                            Contrast
                        </h3>
                        <ul role="list" class="divide-y divide-white/5">
                            @foreach ($accresults as $accresult)
                                @if (isset($accresult['group']) && $accresult['group'] == 'a11y-color-contrast')
                                <li class="relative flex items-center space-x-1">
                                    <div class="min-w-0 flex-auto">
                                        <div class="flex items-center gap-x-2">
                                            @if ($accresult['weight'] >= 4)
                                            <div class="flex-none rounded-full p-1 text-green-500 bg-green-100">
                                                <div class="h-2 w-2 rounded-full bg-current"></div>
                                            </div>
                                            @elseif($accresult['weight'] == 3)
                                            <div class="flex-none rounded-full p-1 text-orange-500 bg-orange-100">
                                                <div class="h-2 w-2 rounded-full bg-current"></div>
                                            </div>
                                            @else
                                            <div class="flex-none rounded-full p-1 text-red-500 bg-red-100">
                                                <div class="h-2 w-2 rounded-full bg-current"></div>
                                            </div>
                                            @endif
                                            <h2 class="min-w-0 text-sm font-semibold leading-6 text-black">
                                                <span class="break-words">{{ $audits[$accresult['id']]['title'] }}</span>
                                            </h2>
                                        </div>
                                    </div>
                                </li>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                </article>
                <article class="flex max-w-xl flex-col items-start justify-between">
                    <div class="group relative">
                        <h3 class="mt-3 text-lg font-semibold leading-6 text-gray-900 group-hover:text-gray-600">
                            <span class="absolute inset-0"></span>
                            Tables & List
                        </h3>
                        <ul role="list" class="divide-y divide-white/5">
                            @foreach ($accresults as $accresult)
                                @if (isset($accresult['group']) && $accresult['group'] == 'a11y-tables-lists')
                                <li class="relative flex items-center space-x-1">
                                    <div class="min-w-0 flex-auto">
                                        <div class="flex items-center gap-x-2">
                                            @if ($accresult['weight'] >= 4)
                                            <div class="flex-none rounded-full p-1 text-green-500 bg-green-100">
                                                <div class="h-2 w-2 rounded-full bg-current"></div>
                                            </div>
                                            @elseif($accresult['weight'] == 3)
                                            <div class="flex-none rounded-full p-1 text-orange-500 bg-orange-100">
                                                <div class="h-2 w-2 rounded-full bg-current"></div>
                                            </div>
                                            @else
                                            <div class="flex-none rounded-full p-1 text-red-500 bg-red-100">
                                                <div class="h-2 w-2 rounded-full bg-current"></div>
                                            </div>
                                            @endif
                                            <h2 class="min-w-0 text-sm font-semibold leading-6 text-black">
                                                <span class="break-words">{{ $audits[$accresult['id']]['title'] }}</span>
                                            </h2>
                                        </div>
                                    </div>
                                </li>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                </article>
                <article class="flex max-w-xl flex-col items-start justify-between">
                    <div class="group relative">
                        <h3 class="mt-3 text-lg font-semibold leading-6 text-gray-900 group-hover:text-gray-600">
                            <span class="absolute inset-0"></span>
                            Internationalization and localization
                        </h3>
                        <ul role="list" class="divide-y divide-white/5">
                            @foreach ($accresults as $accresult)
                                @if (isset($accresult['group']) && $accresult['group'] == 'a11y-language')
                                <li class="relative flex items-center space-x-1">
                                    <div class="min-w-0 flex-auto">
                                        <div class="flex items-center gap-x-2">
                                            @if ($accresult['weight'] >= 4)
                                            <div class="flex-none rounded-full p-1 text-green-500 bg-green-100">
                                                <div class="h-2 w-2 rounded-full bg-current"></div>
                                            </div>
                                            @elseif($accresult['weight'] == 3)
                                            <div class="flex-none rounded-full p-1 text-orange-500 bg-orange-100">
                                                <div class="h-2 w-2 rounded-full bg-current"></div>
                                            </div>
                                            @else
                                            <div class="flex-none rounded-full p-1 text-red-500 bg-red-100">
                                                <div class="h-2 w-2 rounded-full bg-current"></div>
                                            </div>
                                            @endif
                                            <h2 class="min-w-0 text-sm font-semibold leading-6 text-black">
                                                <span class="break-words">{{ $audits[$accresult['id']]['title'] }}</span>
                                            </h2>
                                        </div>
                                    </div>
                                </li>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                </article>
                <article class="flex max-w-xl flex-col items-start justify-between">
                    <div class="group relative">
                        <h3 class="mt-3 text-lg font-semibold leading-6 text-gray-900 group-hover:text-gray-600">
                            <span class="absolute inset-0"></span>
                            Best Practices
                        </h3>
                        <ul role="list" class="divide-y divide-white/5">
                            @foreach ($accresults as $accresult)
                                @if (isset($accresult['group']) && $accresult['group'] == 'a11y-best-practices')
                                <li class="relative flex items-center space-x-1">
                                    <div class="min-w-0 flex-auto">
                                        <div class="flex items-center gap-x-2">
                                            @if ($accresult['weight'] >= 4)
                                            <div class="flex-none rounded-full p-1 text-green-500 bg-green-100">
                                                <div class="h-2 w-2 rounded-full bg-current"></div>
                                            </div>
                                            @elseif($accresult['weight'] == 3)
                                            <div class="flex-none rounded-full p-1 text-orange-500 bg-orange-100">
                                                <div class="h-2 w-2 rounded-full bg-current"></div>
                                            </div>
                                            @else
                                            <div class="flex-none rounded-full p-1 text-red-500 bg-red-100">
                                                <div class="h-2 w-2 rounded-full bg-current"></div>
                                            </div>
                                            @endif
                                            <h2 class="min-w-0 text-sm font-semibold leading-6 text-black">
                                                <span class="break-words">{{ $audits[$accresult['id']]['title'] }}</span>
                                            </h2>
                                        </div>
                                    </div>
                                </li>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                </article>
                <article class="flex max-w-xl flex-col items-start justify-between">
                    <div class="group relative">
                        <h3 class="mt-3 text-lg font-semibold leading-6 text-gray-900 group-hover:text-gray-600">
                            <span class="absolute inset-0"></span>
                            Audio & Video
                        </h3>
                        <ul role="list" class="divide-y divide-white/5">
                            @foreach ($accresults as $accresult)
                                @if (isset($accresult['group']) && $accresult['group'] == 'a11y-audio-video')
                                <li class="relative flex items-center space-x-1">
                                    <div class="min-w-0 flex-auto">
                                        <div class="flex items-center gap-x-2">
                                            @if ($accresult['weight'] >= 4)
                                            <div class="flex-none rounded-full p-1 text-green-500 bg-green-100">
                                                <div class="h-2 w-2 rounded-full bg-current"></div>
                                            </div>
                                            @elseif($accresult['weight'] == 3)
                                            <div class="flex-none rounded-full p-1 text-orange-500 bg-orange-100">
                                                <div class="h-2 w-2 rounded-full bg-current"></div>
                                            </div>
                                            @else
                                            <div class="flex-none rounded-full p-1 text-red-500 bg-red-100">
                                                <div class="h-2 w-2 rounded-full bg-current"></div>
                                            </div>
                                            @endif
                                            <h2 class="min-w-0 text-sm font-semibold leading-6 text-black">
                                                <span class="break-words">{{ $audits[$accresult['id']]['title'] }}</span>
                                            </h2>
                                        </div>
                                    </div>
                                </li>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                </article>
                <article class="flex max-w-xl flex-col items-start justify-between">
                    <div class="group relative">
                        <h3 class="mt-3 text-lg font-semibold leading-6 text-gray-900 group-hover:text-gray-600">
                            <span class="absolute inset-0"></span>
                            Passed Audits
                        </h3>
                        <ul role="list" class="divide-y divide-white/5">
                            @foreach ($accresults as $accresult)
                                @if ($accresult['weight'] >= 4)
                                <li class="relative flex items-center space-x-1">
                                    <div class="min-w-0 flex-auto">
                                        <div class="flex items-center gap-x-2">
                                            <div class="flex-none rounded-full p-1 text-green-500 bg-green-100">
                                                <div class="h-2 w-2 rounded-full bg-current"></div>
                                            </div>
                                            <h2 class="min-w-0 text-sm font-semibold leading-6 text-black">
                                                <span class="break-words">{{ $audits[$accresult['id']]['title'] }}</span>
                                            </h2>
                                        </div>
                                    </div>
                                </li>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                </article>
            </div>
        </div>
    </div>
    <div class="bg-white py-24 sm:py-32 mt-4">
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
            <div class="mx-auto max-w-2xl lg:mx-0">
                <h2 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">SEO</h2>
                <p class="mt-2 text-lg leading-8 text-gray-600">
                    These checks ensure that your page is following basic search engine optimization advice.
                    There are many additional factors Lighthouse does not score here that may affect your search ranking, including performance on <a href="https://web.dev/learn-core-web-vitals/" class="text-blue-500 underline" target="_blank">Core Web Vitals</a>.
                    <a href="https://support.google.com/webmasters/answer/35769" class="text-blue-500 underline" target="_blank">Learn more about Google Search Essentials</a>.
                </p>
            </div>
            <div class="mx-auto mt-10 grid max-w-2xl grid-cols-1 gap-x-8 gap-y-16 border-t border-gray-200 pt-10 sm:mt-16 sm:pt-16 lg:mx-0 lg:max-w-none lg:grid-cols-2">
                <article class="flex max-w-xl flex-col items-start justify-between">
                    <div class="group relative">
                        <h3 class="mt-3 text-lg font-semibold leading-6 text-gray-900 group-hover:text-gray-600">
                            <span class="absolute inset-0"></span>
                            Mobile Friendly
                        </h3>
                        <ul role="list" class="divide-y divide-white/5">
                            @foreach ($seoresults as $seoresult)
                                @if (isset($seoresult['group']) && $seoresult['group'] == 'seo-mobile')
                                <li class="relative flex items-center space-x-1">
                                    <div class="min-w-0 flex-auto">
                                        <div class="flex items-center gap-x-2">
                                            @if ($seoresult['weight'] >= 4)
                                            <div class="flex-none rounded-full p-1 text-green-500 bg-green-100">
                                                <div class="h-2 w-2 rounded-full bg-current"></div>
                                            </div>
                                            @elseif($seoresult['weight'] == 3)
                                            <div class="flex-none rounded-full p-1 text-orange-500 bg-orange-100">
                                                <div class="h-2 w-2 rounded-full bg-current"></div>
                                            </div>
                                            @else
                                            <div class="flex-none rounded-full p-1 text-red-500 bg-red-100">
                                                <div class="h-2 w-2 rounded-full bg-current"></div>
                                            </div>
                                            @endif
                                            <h2 class="min-w-0 text-sm font-semibold leading-6 text-black">
                                                <span class="break-words">{{ $audits[$seoresult['id']]['title'] }}</span>
                                            </h2>
                                        </div>
                                    </div>
                                </li>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                </article>
                <article class="flex max-w-xl flex-col items-start justify-between">
                    <div class="group relative">
                        <h3 class="mt-3 text-lg font-semibold leading-6 text-gray-900 group-hover:text-gray-600">
                            <span class="absolute inset-0"></span>
                            Content Best Practices
                        </h3>
                        <ul role="list" class="divide-y divide-white/5">
                            @foreach ($seoresults as $seoresult)
                                @if (isset($seoresult['group']) && $seoresult['group'] == 'seo-content')
                                <li class="relative flex items-center space-x-1">
                                    <div class="min-w-0 flex-auto">
                                        <div class="flex items-center gap-x-2">
                                            @if ($seoresult['weight'] >= 4)
                                            <div class="flex-none rounded-full p-1 text-green-500 bg-green-100">
                                                <div class="h-2 w-2 rounded-full bg-current"></div>
                                            </div>
                                            @elseif($seoresult['weight'] == 3)
                                            <div class="flex-none rounded-full p-1 text-orange-500 bg-orange-100">
                                                <div class="h-2 w-2 rounded-full bg-current"></div>
                                            </div>
                                            @else
                                            <div class="flex-none rounded-full p-1 text-red-500 bg-red-100">
                                                <div class="h-2 w-2 rounded-full bg-current"></div>
                                            </div>
                                            @endif
                                            <h2 class="min-w-0 text-sm font-semibold leading-6 text-black">
                                                <span class="break-words">{{ $audits[$seoresult['id']]['title'] }}</span>
                                            </h2>
                                        </div>
                                    </div>
                                </li>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                </article>
                <article class="flex max-w-xl flex-col items-start justify-between">
                    <div class="group relative">
                        <h3 class="mt-3 text-lg font-semibold leading-6 text-gray-900 group-hover:text-gray-600">
                            <span class="absolute inset-0"></span>
                            Crawling and Indexing
                        </h3>
                        <ul role="list" class="divide-y divide-white/5">
                            @foreach ($seoresults as $seoresult)
                                @if (isset($seoresult['group']) && $seoresult['group'] == 'seo-crawl')
                                <li class="relative flex items-center space-x-1">
                                    <div class="min-w-0 flex-auto">
                                        <div class="flex items-center gap-x-2">
                                            @if ($seoresult['weight'] >= 4)
                                            <div class="flex-none rounded-full p-1 text-green-500 bg-green-100">
                                                <div class="h-2 w-2 rounded-full bg-current"></div>
                                            </div>
                                            @elseif($seoresult['weight'] == 3)
                                            <div class="flex-none rounded-full p-1 text-orange-500 bg-orange-100">
                                                <div class="h-2 w-2 rounded-full bg-current"></div>
                                            </div>
                                            @else
                                            <div class="flex-none rounded-full p-1 text-red-500 bg-red-100">
                                                <div class="h-2 w-2 rounded-full bg-current"></div>
                                            </div>
                                            @endif
                                            <h2 class="min-w-0 text-sm font-semibold leading-6 text-black">
                                                <span class="break-words">{{ $audits[$seoresult['id']]['title'] }}</span>
                                            </h2>
                                        </div>
                                    </div>
                                </li>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                </article>
                <article class="flex max-w-xl flex-col items-start justify-between">
                    <div class="group relative">
                        <h3 class="mt-3 text-lg font-semibold leading-6 text-gray-900 group-hover:text-gray-600">
                            <span class="absolute inset-0"></span>
                            Passed Audits
                        </h3>
                        <ul role="list" class="divide-y divide-white/5">
                            @foreach ($seoresults as $seoresult)
                                @if ($seoresult['weight'] >= 4)
                                <li class="relative flex items-center space-x-1">
                                    <div class="min-w-0 flex-auto">
                                        <div class="flex items-center gap-x-2">
                                            <div class="flex-none rounded-full p-1 text-green-500 bg-green-100">
                                                <div class="h-2 w-2 rounded-full bg-current"></div>
                                            </div>
                                            <h2 class="min-w-0 text-sm font-semibold leading-6 text-black">
                                                <span class="break-words">{{ $audits[$seoresult['id']]['title'] }}</span>
                                            </h2>
                                        </div>
                                    </div>
                                </li>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                </article>
            </div>
        </div>
    </div>
    <div class="bg-white py-24 sm:py-32 mt-4">
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
            <div class="mx-auto max-w-2xl lg:mx-0">
                <h2 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">PWA</h2>
                <p class="mt-2 text-lg leading-8 text-gray-600">
                    These checks validate the aspects of a Progressive Web App. <a href="https://web.dev/pwa-checklist/" target="_blank" class="text-blue-500 underline">Learn what makes a good Progressive Web App</a>.
                </p>
            </div>
            <div class="mx-auto mt-10 grid max-w-2xl grid-cols-1 gap-x-8 gap-y-16 border-t border-gray-200 pt-10 sm:mt-16 sm:pt-16 lg:mx-0 lg:max-w-none lg:grid-cols-2">
                <article class="flex max-w-xl flex-col items-start justify-between">
                    <div class="group relative">
                        <h3 class="mt-3 text-lg font-semibold leading-6 text-gray-900 group-hover:text-gray-600">
                            <span class="absolute inset-0"></span>
                            Installable
                        </h3>
                        <ul role="list" class="divide-y divide-white/5">
                            @foreach ($pwaresults as $pwaresult)
                                @if (isset($pwaresult['group']) && $pwaresult['group'] == 'pwa-installable')
                                <li class="relative flex items-center space-x-1">
                                    <div class="min-w-0 flex-auto">
                                        <div class="flex items-center gap-x-2">
                                            @if ($pwaresult['weight'] >= 4)
                                            <div class="flex-none rounded-full p-1 text-green-500 bg-green-100">
                                                <div class="h-2 w-2 rounded-full bg-current"></div>
                                            </div>
                                            @elseif($pwaresult['weight'] == 3)
                                            <div class="flex-none rounded-full p-1 text-orange-500 bg-orange-100">
                                                <div class="h-2 w-2 rounded-full bg-current"></div>
                                            </div>
                                            @else
                                            <div class="flex-none rounded-full p-1 text-red-500 bg-red-100">
                                                <div class="h-2 w-2 rounded-full bg-current"></div>
                                            </div>
                                            @endif
                                            <h2 class="min-w-0 text-sm font-semibold leading-6 text-black">
                                                <span class="break-words">{{ $audits[$pwaresult['id']]['title'] }}</span>
                                            </h2>
                                        </div>
                                    </div>
                                </li>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                </article>
                <article class="flex max-w-xl flex-col items-start justify-between">
                    <div class="group relative">
                        <h3 class="mt-3 text-lg font-semibold leading-6 text-gray-900 group-hover:text-gray-600">
                            <span class="absolute inset-0"></span>
                            PWA Optimized
                        </h3>
                        <ul role="list" class="divide-y divide-white/5">
                            @foreach ($pwaresults as $pwaresult)
                                @if (isset($pwaresult['group']) && $pwaresult['group'] == 'pwa-optimized')
                                <li class="relative flex items-center space-x-1">
                                    <div class="min-w-0 flex-auto">
                                        <div class="flex items-center gap-x-2">
                                            @if ($pwaresult['weight'] >= 4)
                                            <div class="flex-none rounded-full p-1 text-green-500 bg-green-100">
                                                <div class="h-2 w-2 rounded-full bg-current"></div>
                                            </div>
                                            @elseif($pwaresult['weight'] == 3)
                                            <div class="flex-none rounded-full p-1 text-orange-500 bg-orange-100">
                                                <div class="h-2 w-2 rounded-full bg-current"></div>
                                            </div>
                                            @else
                                            <div class="flex-none rounded-full p-1 text-red-500 bg-red-100">
                                                <div class="h-2 w-2 rounded-full bg-current"></div>
                                            </div>
                                            @endif
                                            <h2 class="min-w-0 text-sm font-semibold leading-6 text-black">
                                                <span class="break-words">{{ $audits[$pwaresult['id']]['title'] }}</span>
                                            </h2>
                                        </div>
                                    </div>
                                </li>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                </article>
                <article class="flex max-w-xl flex-col items-start justify-between">
                    <div class="group relative">
                        <h3 class="mt-3 text-lg font-semibold leading-6 text-gray-900 group-hover:text-gray-600">
                            <span class="absolute inset-0"></span>
                            Passed Audits
                        </h3>
                        <ul role="list" class="divide-y divide-white/5">
                            @foreach ($pwaresults as $pwaresult)
                                @if ($pwaresult['weight'] >= 4)
                                <li class="relative flex items-center space-x-1">
                                    <div class="min-w-0 flex-auto">
                                        <div class="flex items-center gap-x-2">
                                            <div class="flex-none rounded-full p-1 text-green-500 bg-green-100">
                                                <div class="h-2 w-2 rounded-full bg-current"></div>
                                            </div>
                                            <h2 class="min-w-0 text-sm font-semibold leading-6 text-black">
                                                <span class="break-words">{{ $audits[$pwaresult['id']]['title'] }}</span>
                                            </h2>
                                        </div>
                                    </div>
                                </li>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                </article>
            </div>
        </div>
    </div>
    <time class="text-gray-500 text-xs mt-2">Report generated: {{ \Carbon\Carbon::now()->format('F j, Y') }}</time>
</div>

<div class="relative z-10 loader-modal hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>
    <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
        <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
            <div class="relative transform overflow-hidden rounded-lg bg-white px-4 pb-4 pt-5 text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-sm sm:p-6">
                <div class="text-center">
                    <div class="mx-auto flex h-12 w-12 items-center justify-center rounded-full animate-spin">
                        <div class="flex items-center justify-center h-screen">
                            <div class="animate-spin rounded-full border-t-4 border-blue-500 border-solid h-12 w-12"></div>
                        </div>
                    </div>
                    <div class="mt-3 text-center sm:mt-5">
                        <h3 class="text-base font-semibold leading-6 text-gray-900" id="modal-title">Preparing to download report</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js" integrity="sha512-GsLlZN/3F2ErC5ifS5QtgpiJtWd43JWSuIgh7mbzZ8zBps+dvLusV+eNQATqgA/HdeKFVgA5v3S/cIrLF7QnIg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    var download = document.getElementById('downloadBtn');
    var element = document.getElementById('audit-content');
    var opt = {
        margin:       1,
        filename:     'seo-audit-report.pdf',
        image:        { type: 'jpeg', quality: 0.98 },
        html2canvas:  { scale: 2 },
        jsPDF:        { unit: 'in', format: 'letter', orientation: 'portrait' }
    };
    download.addEventListener('click', function(){
        $(document).ready(function(){
            $('.loader-modal').removeClass('hidden');
        });
        html2pdf().set(opt).from(element).save().then(function(){
            $(document).ready(function(){
                $('.loader-modal').addClass('hidden');
            });
        });
    });
</script>
@endsection
