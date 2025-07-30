@extends('pages.profile')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/social-profiles.css') }}">
@endsection

@section('profiles')
    <div class="grid grid-cols-1">
        <div class="col-span-1">
            <h6 class="text-lg font-medium">Social profiles</h6>
        </div>
    </div>

    <div class="px-4 sm:px-6 lg:px-8">
        <div class="mt-8 flow-root">
            <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                    <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 sm:rounded-lg">
                        <table class="min-w-full divide-y divide-gray-300">
                            <tbody class="divide-y divide-gray-200 bg-white">
                                <tr>
                                    <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="19px" height="19" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-facebook">
                                            <path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path>
                                        </svg>
                                    </td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">Facebook</td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $userProfiles->facebook ?? '' }}</td>
                                    <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-sm font-medium sm:pr-6">
                                        <a id="facebookEdit" class="cursor-pointer text-indigo-600 hover:text-indigo-900">Update</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="19px" height="19" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-twitter">
                                            <path d="M23 3a10.9 10.9 0 0 1-3.14 1.53 4.48 4.48 0 0 0-7.86 3v1A10.66 10.66 0 0 1 3 4s-4 9 5 13a11.64 11.64 0 0 1-7 2c9 5 20 0 20-11.5a4.5 4.5 0 0 0-.08-.83A7.72 7.72 0 0 0 23 3z"></path>
                                        </svg>
                                    </td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">Twitter</td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $userProfiles->twitter ?? '' }}</td>
                                    <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-sm font-medium sm:pr-6">
                                        <a id="twitterEdit" class="cursor-pointer text-indigo-600 hover:text-indigo-900">Update</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="19px" height="19" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-linkedin">
                                            <path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z"></path>
                                            <rect x="2" y="9" width="4" height="12"></rect>
                                            <circle cx="4" cy="4" r="2"></circle>
                                        </svg>
                                    </td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">Linkedin</td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $userProfiles->linkedin ?? '' }}</td>
                                    <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-sm font-medium sm:pr-6">
                                        <a id="linkedinEdit" class="cursor-pointer text-indigo-600 hover:text-indigo-900">Update</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="19px" height="19" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-youtube">
                                            <path d="M22.54 6.42a2.78 2.78 0 0 0-1.94-2C18.88 4 12 4 12 4s-6.88 0-8.6.46a2.78 2.78 0 0 0-1.94 2A29 29 0 0 0 1 11.75a29 29 0 0 0 .46 5.33A2.78 2.78 0 0 0 3.4 19c1.72.46 8.6.46 8.6.46s6.88 0 8.6-.46a2.78 2.78 0 0 0 1.94-2 29 29 0 0 0 .46-5.25 29 29 0 0 0-.46-5.33z"></path>
                                            <polygon points="9.75 15.02 15.5 11.75 9.75 8.48 9.75 15.02"></polygon>
                                        </svg>
                                    </td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">YouTube</td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $userProfiles->youtube ?? '' }}</td>
                                    <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-sm font-medium sm:pr-6">
                                        <a id="youtubeEdit" class="cursor-pointer text-indigo-600 hover:text-indigo-900">Update</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="19px" height="19" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-instagram">
                                            <rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect>
                                            <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path>
                                            <line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line>
                                        </svg>
                                    </td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">Instagram</td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $userProfiles->instagram ?? '' }}</td>
                                    <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-sm font-medium sm:pr-6">
                                        <a id="instagramEdit" class="cursor-pointer text-indigo-600 hover:text-indigo-900">Update</a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="relative z-10 facebook-modal hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>
        <div class="fixed inset-0 z-10 overflow-y-auto">
            <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                <div class="relative transform overflow-hidden rounded-lg bg-white px-4 pb-4 pt-5 text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg sm:p-6">
                    <form action="{{ route('facebook') }}" method="post">
                        @csrf
                        <div>
                            <div class="mt-3 sm:mt-5">
                                <label for="email" class="block text-sm font-medium leading-6 text-gray-900">Facebook URL</label>
                                <div class="mt-2">
                                    <input type="text" name="facebook_url" value="{{ $userProfiles->facebook ?? '' }}" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                </div>
                            </div>
                        </div>
                        <div class="mt-5 sm:mt-6 sm:grid sm:grid-flow-row-dense sm:grid-cols-2 sm:gap-3">
                            <button type="submit" class="inline-flex w-full justify-center rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 sm:col-start-2">Update</button>
                            <button type="button" id="facebook-cancel" class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:col-start-1 sm:mt-0">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="relative z-10 twitter-modal hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>
        <div class="fixed inset-0 z-10 overflow-y-auto">
            <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                <div class="relative transform overflow-hidden rounded-lg bg-white px-4 pb-4 pt-5 text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg sm:p-6">
                    <form action="{{ route('twitter') }}" method="post">
                        @csrf
                        <div>
                            <div class="mt-3 sm:mt-5">
                                <label for="email" class="block text-sm font-medium leading-6 text-gray-900">Twitter URL</label>
                                <div class="mt-2">
                                    <input type="text" name="twitter_url" value="{{ $userProfiles->twitter ?? '' }}" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                </div>
                            </div>
                        </div>
                        <div class="mt-5 sm:mt-6 sm:grid sm:grid-flow-row-dense sm:grid-cols-2 sm:gap-3">
                            <button type="submit" class="inline-flex w-full justify-center rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 sm:col-start-2">Deactivate</button>
                            <button type="button" id="twitter-cancel" class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:col-start-1 sm:mt-0">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="relative z-10 linkedin-modal hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>
        <div class="fixed inset-0 z-10 overflow-y-auto">
            <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                <div class="relative transform overflow-hidden rounded-lg bg-white px-4 pb-4 pt-5 text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg sm:p-6">
                    <form action="{{ route('linkedin') }}" method="post">
                        @csrf
                        <div>
                            <div class="mt-3 sm:mt-5">
                                <label for="email" class="block text-sm font-medium leading-6 text-gray-900">Linkedin URL</label>
                                <div class="mt-2">
                                    <input type="text" name="linkedin_url" value="{{ $userProfiles->linkedin ?? '' }}" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                </div>
                            </div>
                        </div>
                        <div class="mt-5 sm:mt-6 sm:grid sm:grid-flow-row-dense sm:grid-cols-2 sm:gap-3">
                            <button type="submit" class="inline-flex w-full justify-center rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 sm:col-start-2">Deactivate</button>
                            <button type="button" id="linkedin-cancel" class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:col-start-1 sm:mt-0">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="relative z-10 youtube-modal hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>
        <div class="fixed inset-0 z-10 overflow-y-auto">
            <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                <div class="relative transform overflow-hidden rounded-lg bg-white px-4 pb-4 pt-5 text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg sm:p-6">
                    <form action="{{ route('youtube') }}" method="post">
                        @csrf
                        <div>
                            <div class="mt-3 sm:mt-5">
                                <label for="email" class="block text-sm font-medium leading-6 text-gray-900">Youtube URL</label>
                                <div class="mt-2">
                                    <input type="text" name="youtube_url" value="{{ $userProfiles->youtube ?? '' }}" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                </div>
                            </div>
                        </div>
                        <div class="mt-5 sm:mt-6 sm:grid sm:grid-flow-row-dense sm:grid-cols-2 sm:gap-3">
                            <button type="submit" class="inline-flex w-full justify-center rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 sm:col-start-2">Deactivate</button>
                            <button type="button" id="youtube-cancel" class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:col-start-1 sm:mt-0">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="relative z-10 instagram-modal hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>
        <div class="fixed inset-0 z-10 overflow-y-auto">
            <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                <div class="relative transform overflow-hidden rounded-lg bg-white px-4 pb-4 pt-5 text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg sm:p-6">
                    <form action="{{ route('instagram') }}" method="post">
                        @csrf
                        <div>
                            <div class="mt-3 sm:mt-5">
                                <label for="email" class="block text-sm font-medium leading-6 text-gray-900">Instagram URL</label>
                                <div class="mt-2">
                                    <input type="text" name="instagram_url" value="{{ $userProfiles->instagram ?? '' }}" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                </div>
                            </div>
                        </div>
                        <div class="mt-5 sm:mt-6 sm:grid sm:grid-flow-row-dense sm:grid-cols-2 sm:gap-3">
                            <button type="submit" class="inline-flex w-full justify-center rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 sm:col-start-2">Deactivate</button>
                            <button type="button" id="instagram-cancel" class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:col-start-1 sm:mt-0">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
<script>
    $(document).ready(function(){
        $('#fileInput').change(function(){
            var file = $(this)[0];
            if (file.files.length > 0) {
                $('#ppfrm').submit();
                $('.upload-loader').removeClass('hidden');
            }
        });

        $('#facebookEdit').click(function(){
            $('.facebook-modal').removeClass('hidden');
        });

        $('#facebook-cancel').click(function(){
            $('.facebook-modal').addClass('hidden');
        });

        $('#twitterEdit').click(function(){
            $('.twitter-modal').removeClass('hidden');
        });

        $('#twitter-cancel').click(function(){
            $('.twitter-modal').addClass('hidden');
        });

        $('#linkedinEdit').click(function(){
            $('.linkedin-modal').removeClass('hidden');
        });

        $('#linkedin-cancel').click(function(){
            $('.linkedin-modal').addClass('hidden');
        });

        $('#youtubeEdit').click(function(){
            $('.youtube-modal').removeClass('hidden');
        });

        $('#youtube-cancel').click(function(){
            $('.youtube-modal').addClass('hidden');
        });

        $('#instagramEdit').click(function(){
            $('.instagram-modal').removeClass('hidden');
        });

        $('#instagram-cancel').click(function(){
            $('.instagram-modal').addClass('hidden');
        });
    });
</script>
@endsection
