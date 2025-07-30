@extends('layouts.app')

@section('title', 'Facebook Post Templates | 2xMyLeads')

@section('content')
    <div class="grid lg:grid-cols-2 grid-cols-1">
        <div class="flex justify-start">
            <p class="text-lg font-medium">Choose post templates</p>
        </div>
        <div class="flex justify-end">
            <a href="{{ route('user-create-post') }}" class="rounded-md bg-pipexblue px-2.5 py-1.5 text-sm font-semibold text-white shadow-sm hover:bg-blue-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Create new post</a>
        </div>
    </div>

    <div class="border border-gray-200 bg-white px-4 py-5 sm:px-6 mt-4 mx-2">
        <form id="categoryfrm">
            @csrf
            <div>
                <label for="category" class="block text-sm font-medium leading-6 text-gray-900">Post categories</label>
                <select id="category" name="category" class="mt-2 block w-60 rounded-md border-0 py-1.5 pl-3 pr-10 text-gray-900 ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-indigo-600 sm:text-sm sm:leading-6">
                    <option value="" selected disabled>Select category</option>\
                    @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                    @endforeach
                </select>
            </div>
        </form>
    </div>

    @if ($posts->isEmpty())
    <div class="border rounded-lg border-gray-200 bg-white px-4 sm:px-6 mt-2">
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
    <div class="hidden mx-2 my-4 category-view">
        <p class="font-medium text-lg">Templates for category <span id="categoryChoice"></span></p>
    </div>
    <div class="border rounded-lg border-gray-200 bg-white px-4 sm:px-6 mt-2 hidden empty">
        <div class="grid grid-rows-2 place-items-center">
            <div>
                <img src="{{ asset('img/no_data.png') }}" class="w-28 mt-2" alt="no data">
            </div>
            <div>
                <p class="text-gray-500 text-sm">No templates available.</p>
            </div>
        </div>
    </div>
    <div class="grid grid-cols-1 lg:grid-cols-4 post-list">
    </div>
    @endif
    <div class="relative z-10 prompt-modal hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>
        <div class="fixed inset-0 z-10 overflow-y-auto">
            <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                <div class="relative transform overflow-hidden rounded-lg bg-white px-4 pb-4 pt-5 text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg sm:p-6">
                    <button type="button" class="close-button absolute top-0 right-0 m-4 text-gray-500 hover:text-gray-900" aria-label="Close">
                        <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                    <div>
                        <div class="mt-3 text-center sm:mt-5">
                            <h3 class="text-base font-semibold leading-6 text-gray-900" id="modal-title"></h3>
                            <div class="mt-2">
                                <p class="text-sm text-gray-500">Do you want to use this template with your business logo as a watermark on the template's image?</p>
                            </div>
                        </div>
                    </div>
                    <div class="mt-5 sm:mt-6 sm:grid sm:grid-flow-row-dense sm:grid-cols-2 sm:gap-3">
                        <a id="withBtn" class="inline-flex w-full justify-center rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 sm:col-start-2">Yes, with watermark</a>
                        <a id="withoutBtn" class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:col-start-1 sm:mt-0">Yes, without watermark</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
<script>
    $(document).ready(function(){
        $('#categoryfrm').submit(function(e){
            e.preventDefault();
            $.ajax({
                url: '{{ route('get-template-by-category') }}',
                method: 'POST',
                data: $(this).serialize(),
                success: function(response) {
                    if(response.posts.length > 0){
                        $('.post-list').removeClass('hidden');
                        $('.empty').addClass('hidden');
                        $('.post-list').html('');
                        $('.category-view').removeClass('hidden');
                        $('#categoryChoice').text(response.category.category_name);
                        var i = 0;
                        $.each(response.posts, function(index, post){
                            $('.post-list').append(`
                                <a id="postBtn${i}" class="cursor-pointer">
                                    <div>
                                        <div class="border rounded-lg border-gray-200 bg-white px-4 sm:px-6 mt-2 ml-2">
                                            <div class="sm:flex">
                                                <div class="px-2 py-4">
                                                    <input type="hidden" id="postToken${i}" value="${post.id}">
                                                    <h4 class="text-md font-medium" id="title${i}">${post.title}</h4>
                                                    <p class="text-xs mt-1">${post.content}</p>
                                                    ${
                                                        post.image_url
                                                        ? `<img class="mt-2" src="${post.image_url}">`
                                                        : ''
                                                    }
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            `)
                            $('#postBtn' + i).click(function(){
                                $('.prompt-modal').toggle('hidden');
                                var id = $('#postToken' + i).val();
                                var title = $('#title' + i).text();
                                $('#modal-title').text(title);
                                $('#withBtn').attr('href', '/facebook/post/template/with-watermark/' + post.id);
                                $('#withoutBtn').attr('href', '/facebook/post/template/without-watermark/' + post.id);
                            });
                            i++;
                        });
                    }else{
                        $('.post-list').addClass('hidden');
                        $('.empty').removeClass('hidden');
                        $('.category-view').removeClass('hidden');
                        $('#categoryChoice').text(response.category.category_name);
                    }
                }
            });
        });

        $('#category').change(function(){
            $('#categoryfrm').submit();
        });

        $('.close-button').click(function(){
            $('.prompt-modal').toggle('hidden');
        });
    });
</script>
@endsection
