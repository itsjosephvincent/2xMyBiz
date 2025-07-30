@extends('layouts.app')

@section('title', 'Post Templates | 2xMyLeads')

@section('content')
    <div class="grid lg:grid-cols-2 grid-cols-1">
        <div class="flex justify-start">
            <p class="text-lg font-medium">Post templates</p>
        </div>
        <div class="flex justify-end">
            <a href="{{ route('create-new-post-template') }}" class="rounded-md bg-pipexblue px-2.5 py-1.5 text-sm font-semibold text-white shadow-sm hover:bg-blue-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Create new template</a>
        </div>
    </div>

    @if ($posts->isEmpty())
    <div class="border rounded-lg border-gray-200 bg-white px-4 sm:px-6 mt-4">
        <div class="grid grid-rows-2 place-items-center">
            <div>
                <img src="{{ asset('img/no_data.png') }}" class="w-28 mt-2" alt="no data">
            </div>
            <div>
                <p class="text-gray-500 text-sm">No templates yet.</p>
            </div>
        </div>
    </div>
    @else
    <div class="grid grid-cols-1 lg:grid-cols-4 mt-4">
        @foreach ($posts as $post)
            <div>
                <div class="border rounded-lg border-gray-200 bg-white px-4 sm:px-6 mt-2 ml-2">
                    <div class="sm:flex">
                        <div class="px-2 py-4">
                            <div class="grid grid-cols-2">
                                <div class="flex justify-start w-80">
                                    <h4 class="text-medium font-medium">{{ $post->title }}</h4>
                                </div>
                                <div class="flex justify-end">
                                    <a href="{{ route('delete-template', $post->id) }}" class="text-red-500 hover:text-red-900">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                        </svg>
                                    </a>
                                </div>
                            </div>
                            <p class="text-xs mt-1">{{ $post->content }}</p>
                            @if ($post->image_url)
                            <img class="mt-2" src="{{ $post->image_url }}">
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <div class="flex justify-center mt-4">
        {{ $posts->links('vendor.pagination.paginate') }}
    </div>
    @endif
@endsection
