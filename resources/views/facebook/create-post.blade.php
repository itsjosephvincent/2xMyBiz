@extends('layouts.app')

@section('title', 'Create Post Template | 2xMyLeads')

@section('content')
    <div class="grid grid-cols-1">
        <div class="col-span-1">
            <a href="{{ route('post-templates') }}" class="inline-flex items-center gap-x-1.5 rounded bg-indigo-50 px-2 py-1 text-xs font-semibold text-black shadow-sm hover:bg-indigo-100">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="-ml-0.5 h-5 w-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
                </svg>
                Go back
            </a>
        </div>
    </div>

    <div class="border border-gray-200 bg-white px-4 py-5 space-y-4 sm:px-6 mt-4">
        <div>
            <p class="text-lg font-medium">Create new template</p>
        </div>

        <div>
            <form action="{{ route('save-template') }}" method="post" enctype="multipart/form-data" class="relative">
                @csrf
                <div>
                    <label for="post_category" class="block text-sm font-medium leading-6 text-gray-900">Category</label>
                    <select id="post_category" name="post_category" class="mt-2 block w-60 rounded-md border-0 py-1.5 pl-3 pr-10 text-gray-900 ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-indigo-600 sm:text-sm sm:leading-6">
                        <option selected disabled>Select category</option>
                        @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="overflow-hidden mt-4 rounded-lg divide-gray-300 border border-gray-300 shadow-sm focus-within:border-indigo-500 focus-within:ring-1 focus-within:ring-indigo-500">
                    <input type="text" name="title" required class="block w-full border-0 pt-2.5 text-lg font-medium placeholder:text-gray-400 focus:ring-0" placeholder="Title">
                    <textarea rows="8" name="content" required class="block w-full resize-none border-0 py-0 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6" placeholder="Write a content..."></textarea>
                    <div class="flex justify-center">
                        <img class="w-80" id="preview-image">
                    </div>
                    <div aria-hidden="true">
                        <div class="py-2">
                            <div class="h-9"></div>
                        </div>
                        <div class="h-px"></div>
                    </div>
                </div>
                <div class="absolute inset-x-px bottom-0">
                    <div class="flex items-center justify-between space-x-3 px-2 py-2 sm:px-3">
                        <div class="flex">
                            <div class="group -my-2 -ml-2 inline-flex items-center rounded-full px-3 py-2 text-left text-gray-400">
                                <label for="fileInput" class="cursor-pointer flex text-xs font-semibold bg-gray-400 hover:bg-gray-600 text-white py-2 px-4 rounded-md shadow-md">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                                    </svg>
                                    Choose photo
                                </label>
                                <input id="fileInput" name="post_image" type="file" class="hidden">
                            </div>
                        </div>
                        <div class="flex-shrink-0">
                            <button type="submit" class="inline-flex items-center rounded-md bg-pipexblue px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-blue-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Create</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('js')
    <script type="text/javascript">
        $(document).ready(function(){
            const preview = document.querySelector('#preview-image');
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
