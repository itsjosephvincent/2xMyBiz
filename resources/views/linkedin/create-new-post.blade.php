@extends('layouts.app')

@section('css')
@endsection

@section('title', 'Schedule Post | 2xMyLeads')

@section('content')
    <div class="grid grid-cols-1">
        <div class="col-span-1">
            <a href="{{ route('linkedin-post-list') }}" class="inline-flex items-center gap-x-1.5 rounded bg-indigo-50 px-2 py-1 text-xs font-semibold text-black shadow-sm hover:bg-indigo-100">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="-ml-0.5 h-5 w-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
                </svg>
                Go back
            </a>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 lg:space-x-4 lg:mt-4 space-y-4 lg:space-y-0">
        <div class="lg:col-span-2">
            <div class="border border-gray-200 bg-white px-4 py-5 sm:px-6">
                <div class="flex items-start space-x-4 mt-4">
                    <div class="min-w-0 flex-1">
                        <form action="{{ route('post.linkedin') }}" id="postForm" enctype="multipart/form-data" method="post" class="relative">
                            @csrf
                            <div class="overflow-hidden rounded-lg shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-blue-500">
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
                            <div class="inset-x-0 bottom-0 flex justify-end mt-2">
                                <div class="group -my-2 -ml-2 inline-flex items-center rounded-full px-3 py-2 text-left text-gray-400">
                                    <label for="fileInput" class="cursor-pointer flex text-xs font-semibold bg-gray-400 hover:bg-gray-600 text-white py-2 px-4 rounded-md shadow-md">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                                        </svg>
                                        Attach photo
                                    </label>
                                    <input id="fileInput" name="postattachment" type="file" class="hidden">
                                </div>
                                <div class="flex-shrink-0">
                                    <button type="submit" class="inline-flex items-center rounded-md bg-indigo-600 px-8 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Post</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="lg:col-span-1">
            <div class="border border-gray-200 bg-white px-4 py-5 sm:px-6 h-96 overflow-y-scroll">
                <ul role="list" class="divide-y divide-gray-100">
                    @foreach ($linkedinPosts as $linkedin)
                    <li class="flex gap-x-4 py-5">
                        <div class="flex-auto">
                            <div class="flex items-baseline justify-between gap-x-4">
                                <p class="text-sm font-semibold leading-6 text-gray-900">{{ $linkedin->title }}</p>
                                <p class="flex-none text-xs text-gray-600">
                                    <time datetime="{{ $linkedin->created_at }}">{{ Carbon\Carbon::parse($linkedin->created_at)->diffForHumans() }}</time>
                                </p>
                            </div>
                            <p class="mt-1 line-clamp-2 text-sm leading-6 text-gray-600">{{ $linkedin->content }}</p>
                            @if ($linkedin->attachment)
                            <img src="{{ $linkedin->attachment }}">
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
    <script>
        $(document).ready(function(){
            $('#postForm').submit(function(){
                $('#loader').removeClass('hidden');
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
