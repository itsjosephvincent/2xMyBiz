@extends('layouts.app')

@section('title', 'Schedule Post | 2xMyLeads')

@section('content')
    <div class="grid grid-cols-1">
        <div class="col-span-1">
            <a href="{{ route('post-template-list') }}" class="inline-flex items-center gap-x-1.5 rounded bg-indigo-50 px-2 py-1 text-xs font-semibold text-black shadow-sm hover:bg-indigo-100">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="-ml-0.5 h-5 w-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
                </svg>
                Go back
            </a>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 lg:space-x-4 space-x-0 space-y-4 lg:space-y-0 mt-4">
        <div class="lg:col-span-2 space-y-4">
            <form action="{{ route('user-created-post') }}" id="postForm" enctype="multipart/form-data" method="post">
                @csrf
                <div class="border border-gray-200 flex lg:space-x-4 bg-white px-4 py-5 sm:px-6 overflow-y-scroll">
                    <ul role="list" class="flex gap-2">
                        @foreach ($pages as $page)
                            <li class="col-span-1 border border-gray-200 rounded-lg bg-white shadow">
                                <div class="flex w-full items-center justify-between space-x-6 p-6">
                                    <div>
                                        <input type="checkbox" name="pageToken[]" required value="{{ $page->page_id }}" class="checkbox-item appearance-none checked:bg-blue-500 checkbox-item">
                                    </div>
                                    <div class="flex-1 truncate">
                                        <div class="flex items-center space-x-3">
                                            <h3 class="truncate text-sm font-medium text-gray-900">{{ $page->page_name }}</h3>
                                        </div>
                                        <p class="mt-1 truncate text-xs text-blue-500">Facebook Page</p>
                                    </div>
                                    <img class="h-10 w-10 flex-shrink-0 rounded-full bg-gray-300" src="{{ $page->page_photo }}">
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <div class="border border-gray-200 bg-white px-4 py-5 sm:px-6 mt-4 lg:mt-4">
                    <div class="flex items-start space-x-4 mt-4">
                        <div class="min-w-0 flex-1">
                            <div class="overflow-hidden rounded-lg shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-indigo-600">
                                <textarea rows="3" name="postcontent" placeholder="Write your content here..." required class="block w-full resize-none border-0 bg-transparent py-1.5 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6"></textarea>
                                <div class="py-2 flex justify-center items-center" aria-hidden="true">
                                    <div class="px-2 w-fit h-fit">
                                        <img class="w-auto image-preview">
                                    </div>
                                    <div class="py-px">
                                        <div class="h-9"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="group -my-2 -ml-2 mt-1 inline-flex items-center rounded-full px-3 py-2 text-left text-gray-400">
                                <label for="fileInput" class="cursor-pointer flex text-xs font-semibold bg-gray-400 hover:bg-gray-600 text-white py-2 px-4 rounded-md shadow-md">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                                    </svg>
                                    Attach photo
                                </label>
                                <input id="fileInput" name="post_image" type="file" class="hidden">
                            </div>
                            <div class="inset-x-0 bottom-0 flex justify-end py-2 mt-4">
                                <div class="flex-shrink-0">
                                    <button type="submit" class="inline-flex items-center rounded-md bg-indigo-600 px-8 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Post</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div>
            <div class="border border-gray-200 bg-white px-4 py-5 sm:px-6">
                <ul role="list" class="divide-y divide-gray-100">
                    @foreach ($scheduledPosts as $sched)
                    <li class="flex gap-x-4 py-5">
                        <div class="flex-auto">
                            <div class="flex items-baseline justify-between gap-x-4">
                                <p class="text-sm font-semibold leading-6 text-gray-900">{{ $sched->page_name }}</p>
                                <p class="flex-none text-xs text-gray-600">{{ $sched->date }}-{{ $sched->time }}</p>
                            </div>
                            <p class="mt-1 line-clamp-2 text-sm leading-6 text-gray-600">{{ $sched->content }}</p>
                            @if ($sched->attachment)
                            <img src="{{ $sched->attachment }}">
                            @endif
                            @if ($sched->is_posted === 0)
                            <div class="flex justify-end">
                                <a href="{{ route('post-now', $sched->id) }}" id="postNowBtn" class="rounded-md bg-white px-2.5 py-1.5 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50">Post now</a>
                            </div>
                            @endif
                        </div>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>

    <div class="hidden relative z-10" id="loader" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>
        <div class="fixed inset-0 z-10 overflow-y-auto">
            <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                <div class="relative transform overflow-hidden rounded-lg bg-white px-4 pb-4 pt-5 text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-sm sm:p-6">
                    <div>
                        <div class="flex justify-center items-center">
                            <div class="loader"></div>
                        </div>
                        <div class="mt-3 text-center sm:mt-5">
                            <h3 class="text-base font-semibold leading-6 text-gray-900" id="modal-title">Posting</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
        $(document).ready(function() {
            flatpickr('#datepicker');

            flatpickr('#timepicker', {
                enableTime: true,
                noCalendar: true,
                dateFormat: "h:i K",
                time_24hr: false
            });

            $('#postNowBtn').click(function(){
                $('#loader').toggle('hidden');
            });

            $('#postForm').submit(function(){
                $('#loader').toggle('hidden');
            });

            $('.checkbox-item').click(function() {
                if ($(this).is(':checked')) {
                    $('.checkbox-item').removeAttr('required');
                } else {
                    $('.checkbox-item').attr('required', 'required');
                }
            });

            const preview = document.querySelector('.image-preview');
            const addFile = document.querySelector('#fileInput');

            addFile.addEventListener('change', function () {
                const file = this.files[0];
                const reader = new FileReader();

                reader.addEventListener('load', function () {
                    preview.src = reader.result;
                });

                reader.readAsDataURL(file);
            });
        });
    </script>
@endsection
