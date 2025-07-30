@extends('layouts.app')

@section('css')
@endsection

@section('title', 'Email | 2xMyLeads')

@section('content')
    <div class="grid grid-cols-1">
        <div class="col-span-1">
            <a href="{{ route('email-templates') }}" class="inline-flex items-center gap-x-1.5 rounded bg-indigo-50 px-2 py-1 text-xs font-semibold text-black shadow-sm hover:bg-indigo-100">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="-ml-0.5 h-5 w-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
                </svg>
                Go back
            </a>
        </div>
    </div>

    <div class="grid grid-cols-1 mt-4">
        <div class="col-span-1">
            <h6 class="text-lg font-medium">Edit email template</h6>
        </div>
    </div>
    <div class="hidden" id="rawMessage">{!! $email->message !!}</div>
    <div class="grid grid-cols-1 lg:grid-cols-3 lg:space-x-4 space-y-4 lg:space-y-0 mt-4">
        <div class="lg:col-span-2">
            <div class="border border-gray-200 bg-white px-4 py-5 sm:px-6">
                <form action="{{ route('update-template', $email->templateid) }}" class="relative" method="post">
                    @csrf
                    @method('PUT')
                    <div class="overflow-hidden rounded-lg border border-gray-300 divide-y divide-gray-300 shadow-sm focus-within:border-indigo-500 focus-within:ring-1 focus-within:ring-indigo-500">
                        <input type="text" name="title" value="{{ $email->title }}" class="block w-full border-0 pt-2.5 text-lg font-medium placeholder:text-gray-400 focus:ring-0">
                        <textarea rows="8" name="message" id="message" class="block w-full resize-none border-0 py-0 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6"></textarea>
                        <div aria-hidden="true">
                            <div class="py-2">
                                <div class="h-9"></div>
                            </div>
                            <div class="h-px"></div>
                        </div>
                    </div>
                    <div class="absolute inset-x-px bottom-0">
                        <div class="flex justify-between space-x-3 px-2 py-2 sm:px-3">
                            <div class="flex-shrink-0">
                                <button type="submit" class="inline-flex items-center rounded-md bg-pipexblue px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-blue-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Update email</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="lg:col-span-1">
            <div class="border border-gray-200 bg-white px-4 py-5 sm:px-6 h-96 overflow-y-scroll">
                <ul role="list" class="divide-y divide-gray-100">
                    <li class="flex justify-between gap-x-6">
                        <p class="mt-1 truncate text-xs leading-5 text-gray-500">Short codes:</p>
                    </li>
                    <li class="flex justify-between gap-x-6">
                        <p class="mt-1 truncate text-xs leading-5 text-gray-500">[Business name] = Lead's business name</p>
                    </li>
                    <li class="flex justify-between gap-x-6">
                        <p class="mt-1 truncate text-xs leading-5 text-gray-500">[Email] = Lead's email</p>
                    </li>
                    <li class="flex justify-between gap-x-6">
                        <p class="mt-1 truncate text-xs leading-5 text-gray-500">[Address] = Lead's address</p>
                    </li>
                    <li class="flex justify-between gap-x-6">
                        <p class="mt-1 truncate text-xs leading-5 text-gray-500">[Link] = Lead's page link</p>
                    </li>
                    <li class="flex justify-between gap-x-6">
                        <p class="mt-1 truncate text-xs leading-5 text-gray-500">[Website] = Lead's website</p>
                    </li>
                    <li class="flex justify-between gap-x-6">
                        <p class="mt-1 truncate text-xs leading-5 text-gray-500">[About] = Lead's about</p>
                    </li>
                    <li class="flex justify-between gap-x-6">
                        <p class="mt-1 truncate text-xs leading-5 text-gray-500">[Category] = Lead's category</p>
                    </li>
                    <li class="flex justify-between gap-x-6">
                        <p class="mt-1 truncate text-xs leading-5 text-gray-500">[Fan count] = Lead's fan count</p>
                    </li>
                    <li class="flex justify-between gap-x-6">
                        <p class="mt-1 truncate text-xs leading-5 text-gray-500">[Followers count] = Lead's follow count</p>
                    </li>
                    <li class="flex justify-between gap-x-6">
                        <p class="mt-1 truncate text-xs leading-5 text-gray-500">[Star rating] = Lead's star rating</p>
                    </li>
                    <li class="flex justify-between gap-x-6">
                        <p class="mt-1 truncate text-xs leading-5 text-gray-500">[Rating count] = Lead's rating rating</p>
                    </li>
                    <li class="flex justify-between gap-x-6">
                        <p class="mt-1 truncate text-xs leading-5 text-gray-500">[Talking about] = Lead's talking count</p>
                    </li>
                    <li class="flex justify-between gap-x-6">
                        <p class="mt-1 truncate text-xs leading-5 text-gray-500">[Username] = Lead's username</p>
                    </li>
                    <li class="flex justify-between gap-x-6">
                        <p class="mt-1 truncate text-xs leading-5 text-gray-500">[Where here] = Lead's where here count</p>
                    </li>
                    <li class="flex justify-between gap-x-6">
                        <p class="mt-1 truncate text-xs leading-5 text-gray-500">[Audit link] = Lead's 2xmyleads audit link</p>
                    </li>
                    <li class="flex justify-between gap-x-6">
                        <p class="mt-1 truncate text-xs leading-5 text-gray-500">[Your name] = Your full name</p>
                    </li>
                    <li class="flex justify-between gap-x-6">
                        <p class="mt-1 truncate text-xs leading-5 text-gray-500">[My Business name] = Your business name</p>
                    </li>
                    <li class="flex justify-between gap-x-6">
                        <p class="mt-1 truncate text-xs leading-5 text-gray-500">[My Email] = Your email</p>
                    </li>
                    <li class="flex justify-between gap-x-6">
                        <p class="mt-1 truncate text-xs leading-5 text-gray-500">[My Address] = Your address</p>
                    </li>
                    <li class="flex justify-between gap-x-6">
                        <p class="mt-1 truncate text-xs leading-5 text-gray-500">[My Website] = Your website</p>
                    </li>
                    <li class="flex justify-between gap-x-6">
                        <p class="mt-1 truncate text-xs leading-5 text-gray-500">[My Phone] = Your phone number</p>
                    </li>
                    <li class="flex justify-between gap-x-6">
                        <p class="mt-1 truncate text-xs leading-5 text-gray-500">[My Calendar Link] = Your calendar link</p>
                    </li>
                    <li class="flex justify-between gap-x-6">
                        <p class="mt-1 truncate text-xs leading-5 text-gray-500">[My 2xMyLeads Link] = Your 2xMyLeads affiliate link</p>
                    </li>
                    <li class="flex justify-between gap-x-6">
                        <p class="mt-1 truncate text-xs leading-5 text-gray-500">[My Kartra Link] = Your Kartra affiliate link</p>
                    </li>
                    <li class="flex justify-between gap-x-6">
                        <p class="mt-1 truncate text-xs leading-5 text-gray-500">[About my company] = Your company message</p>
                    </li>
                </ul>
            </div>
        </div>
    </div>
@endsection

@section('js')
<script>
    $(document).ready(function(){
        $('#message').val($('#rawMessage').text())
    });
</script>
@endsection
