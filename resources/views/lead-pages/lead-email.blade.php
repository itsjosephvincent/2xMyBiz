@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/lead-profile.css') }}">
@endsection

@section('title', 'Lead Email | 2xMyLeads')

@section('content')
    <div class="grid grid-cols-1">
        <div class="col-span-1">
            <a href="{{ route('my-leads') }}" class="inline-flex items-center gap-x-1.5 rounded bg-indigo-50 px-2 py-1 text-xs font-semibold text-black shadow-sm hover:bg-indigo-100">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="-ml-0.5 h-5 w-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
                </svg>
                Go back
            </a>
        </div>
    </div>

    <div class="border border-gray-200 bg-white px-4 py-5 sm:px-6 mt-4">
        <div class="grid grid-cols-1 lg:grid-cols-3">
            <div class="col-span-1 flex justify-center">
                <img class="inline-block h-28 w-28 rounded-full" src="{{ $lead->lead_photo ?? asset('img/org.png') }}" alt="">
            </div>
            <div class="lg:col-span-1 flex lg:justify-start mt-2 lg:mt-0">
                <div class="grid grid-rows-3">
                    <div class="lg:mx-0 mx-12">
                        <p class="text-sm font-medium">{{ $lead->lead_name }}</p>
                    </div>
                    <div class="text-xs text-gray-500 lg:mx-0 mx-16">{{ isset($lead->email) ? trim(str_replace(['[', ']', '"'], '', $lead->email)) : 'No email address' }}</div>
                    <div class="lg:mx-0 mx-24"><span class="inline-flex flex-shrink-0 items-center rounded-full bg-{{ $lead->lead_class_name }} px-1.5 py-0.5 text-xs text-white ring-1 ring-green-600/20">{{ $lead->lead_group_name }}</span></div>
                </div>
            </div>
            <div class="lg:col-span-1 flex lg:justify-start mt-2 lg:mt-0">
                <div class="grid grid-rows-2">
                    <div class="flex justify-center">
                        <div class="mb-4 flex-shrink-0 sm:mb-0 sm:mr-4">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor" class="h-12 w-12 text-pipexblue">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                            </svg>
                        </div>
                        <div>
                            <h4 class="text-xs">Lead group:</h4>
                            <span class="inline-flex mt-1 flex-shrink-0 items-center rounded-full bg-{{ $lead->leadclassname }} px-1.5 py-0.5 text-xs text-white ring-1 ring-green-600/20">{{ $lead->organization_name }}</span>
                        </div>
                    </div>
                    <div class="flex mx-16 lg:mt-1">
                        <div class="mb-4 flex-shrink-0 sm:mb-0 sm:mr-4">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor" class="w-12 h-12 text-pipexblue">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5" />
                            </svg>
                        </div>
                        <div>
                            <h4 class="text-xs">Created:</h4>
                            <p class="mt-1 text-sm">{{ date('m-d-Y', strtotime($lead->created_at)) }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="border border-gray-200 bg-white px-4 py-5 sm:px-6 mt-4">
        <form action="{{ route('get-emails-by-category') }}" method="post" id="catFrm">
            @csrf
            <input type="hidden" name="lead_id" value="{{ $lead->id }}">
            <div>
                <label class="block text-sm font-medium leading-6 text-gray-900">Email category</label>
                <select id="categorySelect" name="category_id" class="mt-2 block w-60 rounded-md border-0 py-1.5 pl-3 pr-10 text-gray-900 ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-indigo-600 sm:text-sm sm:leading-6">
                    <option value="" selected disabled>Select email category</option>
                    @foreach ($emailcategories as $emailcategory)
                    <option value="{{ $emailcategory->id }}">{{ $emailcategory->category_name }}</option>
                    @endforeach
                </select>
            </div>
        </form>
    </div>

    <div class="border border-gray-200 bg-white px-4 py-5 sm:px-6 mt-4 email-list">
        @if (isset($emailcategorylist))
            <div class="sm:flex sm:items-center">
                <div class="sm:flex-auto">
                    <p class="text-sm">Search results for email category <b>"{{ $category }}"</b></p>
                </div>
            </div>
            @if ($emailcategorylist->isEmpty())
                <div class="grid grid-rows-2 place-items-center">
                    <div>
                        <img src="{{ asset('img/no_data.png') }}" class="w-28 mt-2" alt="no data">
                    </div>
                    <div>
                        <p class="text-gray-500 text-sm">No data yet.</p>
                    </div>
                </div>
            @else
            <div class="px-4 sm:px-6 lg:px-8">
                <div class="mt-2 flow-root">
                    <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                        <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                            <table class="min-w-full divide-y divide-gray-300">
                                <thead>
                                    <tr>
                                        <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-0">Title</th>
                                        <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-0">
                                            <span class="sr-only">View</span>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200">
                                    @php
                                        $i = 0;
                                    @endphp
                                    @foreach ($emailcategorylist as $email)
                                    <tr>
                                        <input type="hidden" value="{{ $email->id }}" id="emailsecret{{ $i }}">
                                        <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-0">{{ $email->title }}</td>
                                        <td><a id="viewBtn{{ $i }}" class="cursor-pointer rounded-md bg-indigo-50 px-2.5 py-1.5 text-sm font-semibold text-pipexblue shadow-sm hover:bg-indigo-200">View</a></td>
                                    </tr>
                                    @php
                                        $i++;
                                    @endphp
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            @endif
        @else
            <div class="grid grid-rows-2 place-items-center mt-2">
                <div>
                    <img src="{{ asset('img/no_data.png') }}" class="w-28" alt="no data">
                </div>
                <div>
                    <p class="text-gray-500 text-sm">No email category selected yet.</p>
                </div>
            </div>
        @endif
    </div>

    <div class="border border-gray-200 bg-white px-4 py-5 sm:px-6 mt-4 edit-email hidden">
        <div class="grid grid-cols-1 lg:grid-cols-2">
            <div>
                <form id="editForm">
                @csrf
                    <div class="flex items-start space-x-4">
                        <div class="min-w-0 flex-1">
                            <input type="hidden" name="editsecrettoken" value="{{ $lead->id }}">
                            <input type="hidden" name="secrettoken" value="{{ $currentUser->id }}">
                            <div class="overflow-hidden rounded-lg shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-indigo-600">
                                <textarea rows="3" name="editemail" id="editemail" class="block w-full h-60 resize-none border-0 bg-transparent py-1.5 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6"></textarea>
                            </div>
                            <div class="mt-4 space-x-4 flex justify-center">
                                <button type="button" id="cancelEmailBtn" class="inline-flex items-center rounded-md border border-gray-400 bg-white px-3 py-2 text-sm font-semibold text-black shadow-sm hover:bg-gray-100 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Cancel</button>
                                <button type="submit" id="convertEmailBtn" class="inline-flex items-center rounded-md bg-pipexblue px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-blue-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Convert short codes</button>
                                <button type="button" id="copyBtn" class="hidden inline-flex items-center rounded-md bg-pipexblue px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-blue-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Copy</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="pl-4">
                <table>
                    <tbody>
                        <tr>
                            <td class="text-xs text-gray-500">Short codes:</td>
                        </tr>
                        <tr>
                            <td class="text-xs text-gray-500">[Business name] = Lead's business name</td>
                            <td class="text-xs text-gray-500">[Your name] = Your full name</td>
                        </tr>
                        <tr>
                            <td class="text-xs text-gray-500">[Email] = Lead's email</td>
                            <td class="text-xs text-gray-500">[My Business name] = Your business name</td>
                        </tr>
                        <tr>
                            <td class="text-xs text-gray-500">[Address] = Lead's address</td>
                            <td class="text-xs text-gray-500">[My Email] = Your email</td>
                        </tr>
                        <tr>
                            <td class="text-xs text-gray-500">[Link] = Lead's page link</td>
                            <td class="text-xs text-gray-500">[My Address] = Your address</td>
                        </tr>
                        <tr>
                            <td class="text-xs text-gray-500">[Website] = Lead's website</td>
                            <td class="text-xs text-gray-500">[My Website] = Your website</td>
                        </tr>
                        <tr>
                            <td class="text-xs text-gray-500">[About] = Lead's about</td>
                            <td class="text-xs text-gray-500">[My Phone] = Your phone number</td>
                        </tr>
                        <tr>
                            <td class="text-xs text-gray-500">[Category] = Lead's category</td>
                            <td class="text-xs text-gray-500"> [My 2xMyLeads Link] = Your 2xMyLeads affiliate link</td>
                        </tr>
                        <tr>
                            <td class="text-xs text-gray-500">[Fan count] = Lead's fan count</td>
                            <td class="text-xs text-gray-500">[My Kartra Link] = Your Kartra affiliate link</td>
                        </tr>
                        <tr>
                            <td class="text-xs text-gray-500">[Followers count] = Lead's follow count</td>
                            <td class="text-xs text-gray-500">[My Calendar Link] = Your calendar link</td>
                        </tr>
                        <tr>
                            <td class="text-xs text-gray-500">[Star rating] = Lead's star rating</td>
                            <td class="text-xs text-gray-500">[About my company] = Your company message</td>
                        </tr>
                        <tr>
                            <td class="text-xs text-gray-500">[Rating count] = Lead's rating rating</td>
                        </tr>
                        <tr>
                            <td class="text-xs text-gray-500">[Talking about] = Lead's talking count</td>
                        </tr>
                        <tr>
                            <td class="text-xs text-gray-500">[Username] = Lead's username</td>
                        </tr>
                        <tr>
                            <td class="text-xs text-gray-500">[Where here] = Lead's where here count</td>
                        </tr>
                        <tr>
                            <td class="text-xs text-gray-500">[Audit link] = Lead's 2xmyleads audit link</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="relative z-10 email-view hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>
        <div class="fixed inset-0 z-10 overflow-y-auto">
            <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                <div class="relative transform overflow-hidden rounded-lg bg-white px-4 pb-4 pt-5 text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg sm:p-6">
                    <div>
                        <div>
                            <h3 class="text-sm font-semibold leading-6 text-gray-900" id="modalTitle"></h3>
                            <div class="mt-2 text-xs" id="modalMessage"></div>
                        </div>
                    </div>
                    <div class="mt-5 sm:mt-6 sm:grid sm:grid-flow-row-dense sm:grid-cols-2 sm:gap-3">
                        <button type="button" id="selectModalBtn" class="inline-flex w-full justify-center rounded-md bg-pipexblue px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-blue-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 sm:col-start-2">Select email</button>
                        <button type="button" id="closeModalBtn" class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:col-start-1 sm:mt-0">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('sweetalert::alert')
@endsection

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function() {
            $('#categorySelect').change(function(event) {
                $('#catFrm').submit();
            });

            $('#closeModalBtn').click(function(){
                $('.email-view').addClass('hidden');
                $('#modalTitle').html('');
                $('#modalMessage').html('');
            });

            <?php $emailCount = isset($emailcategorylist) ? count($emailcategorylist) : 0;
                for($i = 0; $i < $emailCount; $i++) { ?>
                    $('#viewBtn<?php echo $i; ?>').click(function(e){
                        e.preventDefault();
                        $.ajax({
                            type: 'POST',
                            url: '{{ route('get-email') }}',
                            data: {
                                email_id: $('#emailsecret<?php echo $i; ?>').val(),
                                _token: '{{ csrf_token() }}'
                            },
                            success: function(response){
                                $('#emailtoken').val(response.id);
                                $('#modalTitle').text(response.title);
                                $('#modalMessage').html(response.message);
                                $('.email-view').removeClass('hidden');
                            }
                        });
                    });
            <?php } ?>

            $('#selectModalBtn').click(function(e){
                $('.email-view').addClass('hidden');
                $('.email-list').addClass('hidden');
                $('.edit-email').removeClass('hidden');
                $('#convertEmailBtn').removeClass('hidden');
                $('#copyBtn').addClass('hidden');
                $('#editemail').val($('#modalMessage').text());
            });

            $('#cancelEmailBtn').click(function(){
                $('.email-list').removeClass('hidden');
                $('.edit-email').addClass('hidden');
                $('#convertEmailBtn').removeClass('hidden');
                $('#copyBtn').addClass('hidden');
                $('#editemail').val('');
            });

            $('#editForm').submit(function(e) {
                e.preventDefault();
                $.ajax({
                    type: 'POST',
                    url: '{{ route('preview') }}',
                    data: $(this).serialize(),
                    success: function(response) {
                        $('#editemail').val(response.message);
                        $('#convertEmailBtn').addClass('hidden');
                        $('#copyBtn').removeClass('hidden');
                    },
                    error: function(xhr, status, error) {

                    }
                });
            });

            $('#copyBtn').click(function(e) {
                e.preventDefault();
                $.ajax({
                    type: 'GET',
                    url: '{{ route('increment-contact-count') }}',
                    data: $(this).serialize(),
                    success: function(response) {
                        $('#editemail').select();
                        document.execCommand('copy');
                        Swal.fire({
                            title: 'Success',
                            text: 'Message copied.',
                            icon: 'success'
                        });
                    },
                });
            });
        });
    </script>
@endsection
