@extends('layouts.app')

@section('title', 'Post Social Media | 2xMyLeads')

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
            <form action="{{ route('post-no-watermark') }}" id="postForm" enctype="multipart/form-data" method="post">
                @csrf
                <div class="border border-gray flex lg:space-x-4 bg-white px-4 py-5 sm:px-6 overflow-y-scroll">
                    <ul role="list" class="flex gap-2">
                        @foreach ($pages as $page)
                            <li class="col-span-1 border border-gray-200 rounded-lg bg-white shadow">
                                <div class="flex w-full items-center justify-between space-x-6 p-6">
                                    <div>
                                        <input type="checkbox" name="pageToken[]" value="{{ $page->page_id }}" class="checkbox-item appearance-none checked:bg-blue-500 checkbox-item">
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
                <div class="flex justify-center items-center h-full">
                    <div class="bg-white border-gray border px-4 py-5 sm:px-6 mt-4 lg:mt-4 w-1/2">
                        <input type="hidden" name="title" value="{{ $post->title }}">
                        <div class="flex items-start space-x-4 mt-4">
                            <div class="min-w-0 flex-1">
                                <div class="overflow-hidden rounded-lg flex flex-col items-center px-4 py-4 shadow-sm">
                                    <textarea rows="3" name="postcontent" required class="post-content w-full resize-none border-1 border-gray-400 rounded-lg bg-transparent px-4 py-2 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6">{{ $post->content }}</textarea>
                                    <div class="py-2 px-2 flex justify-center items-center" aria-hidden="true">
                                        <div class="w-fit h-fit px-4 py-2">
                                            <img src="{{ $post->image_url }}" class="w-full px-2 py-2 border-2 border-gray-300 rounded-lg">
                                            <input type="hidden" name="postattachment" value="{{ $post->image_url }}">
                                            <input type="hidden" name="post_id" value="{{ $post->id }}">
                                        </div>
                                        <div class="py-px">
                                            <div class="h-9"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="inset-x-0 bottom-0 flex justify-end py-2 mt-4">
                                    <div class="flex-shrink-0">
                                        <button type="button" id="submitBtn" class="inline-flex items-center rounded-md bg-indigo-600 px-8 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Post</button>
                                    </div>
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

    @include('sweetalert::alert')
@endsection

@section('js')
    <script>
        $(document).ready(function() {
            $('#submitBtn').click(function(){
                var checkedCheckboxes = $('input[name="pageToken[]"]:checked');
                if(checkedCheckboxes.length  === 0){
                    $('.error-modal').toggle();
                } else {
                    $('#postForm').submit();
                }
            });

            $('.modal-button').click(function(){
                $('.error-modal').toggle('hidden');
            })

            $('#postNowBtn').click(function(){
                $('#loader').removeClass('hidden');
            });

            $('#postForm').submit(function(){
                $('#loader').removeClass('hidden');
            });

            $('.checkbox-item').click(function() {
                if ($(this).is(':checked')) {
                    $('.checkbox-item').removeAttr('required');
                } else {
                    $('.checkbox-item').attr('required', 'required');
                }
            });
        });
    </script>
@endsection
