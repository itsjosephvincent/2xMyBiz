@extends('pages.profile')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/integrations.css') }}">
@endsection

@section('profiles')
    <div class="grid grid-cols-1">
        <div class="col-span-1">
            <h6 class="text-lg font-medium">Linked accounts</h6>
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
                                    <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-6">
                                        @if ($facebook)
                                            <button class="pointer-events-none text-gray-400">Connected to facebook</button>
                                        @else
                                            <a href="{{ route('facebook.login') }}" class="text-pipexblue text-sm hover:text-blue-500">Link</a>
                                        @endif
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
                                    <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-6">
                                        @if ($linkedin)
                                            <button class="pointer-events-none text-gray-400">Connected to linkedin</button>
                                        @else
                                            <a href="{{ route('linkedin.login') }}" class="text-pipexblue text-sm hover:text-blue-500">Link</a>
                                        @endif
                                    </td>
                                </tr>
                                {{-- <tr>
                                    <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="19px" height="19" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-instagram">
                                            <rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect>
                                            <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path>
                                            <line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line>
                                        </svg>
                                    </td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">Instagram</td>
                                    <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-6">
                                        @if ($instagram)
                                            <button class="pointer-events-none text-gray-400">Connected to instagram</button>
                                        @else
                                            <a href="{{ route('instagram.login') }}" class="text-pipexblue text-sm hover:text-blue-500">Link</a>
                                        @endif
                                    </td>
                                </tr> --}}
                            </tbody>
                        </table>
                    </div>
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
        });
    </script>
@endsection
