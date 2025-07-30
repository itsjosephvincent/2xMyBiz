@extends('layouts.app')

@section('title', 'Email Templates | 2xMyLeads')

@section('content')
    <div class="px-4 sm:px-6 lg:px-8">
        <div class="sm:flex sm:items-center">
            <div class="sm:flex-auto">
                <h1 class="text-base font-semibold leading-6 text-gray-900">Email templates</h1>
            </div>
            <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
                <a href="{{ route('create-email') }}" class="block rounded-md bg-pipexblue px-3 py-2 text-center text-sm font-semibold text-white shadow-sm hover:bg-blue-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Add email template</a>
            </div>
        </div>
        @if ($templates->isEmpty())
        <div class="border rounded-lg border-gray-200 bg-white px-4 sm:px-6 mt-10">
            <div class="grid grid-rows-2 place-items-center">
                <div>
                    <img src="{{ asset('img/no_data.png') }}" class="w-28 mt-2" alt="no data">
                </div>
                <div>
                    <p class="text-gray-500 text-sm">No email templates yet.</p>
                </div>
            </div>
        </div>
        @else
        <div class="mt-8 flow-root">
            <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                    <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 sm:rounded-lg">
                        <table class="min-w-full divide-y divide-gray-300">
                            <thead class="bg-white">
                                <tr>
                                    <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">Title</th>
                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Created</th>
                                    <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6">
                                        <span class="sr-only">Preview</span>
                                    </th>
                                    <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6">
                                        <span class="sr-only">Delete</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 bg-white">
                                @php
                                    $i = 0;
                                @endphp
                                @foreach ($templates as $template)
                                    <tr>
                                        <input type="hidden" id="email_id{{ $i }}" value="{{ $template->id }}">
                                        <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6">{{ $template->title }}</td>
                                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ date('Y-m-d', strtotime($template->created_at)) }}</td>
                                        <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-sm font-medium sm:pr-6">
                                            <a id="prvwBtn{{ $i }}" class="cursor-pointer text-blue-600 hover:text-blue-900">Preview<span class="sr-only">, {{ $template->title }}</span></a>
                                        </td>
                                        <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-sm font-medium sm:pr-6">
                                            <a href="{{ route('delete-email', $template->id) }}" class="text-red-600 hover:text-red-900">Delete<span class="sr-only">, {{ $template->title }}</span></a>
                                        </td>
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
                        <a id="editModalBtn" class="inline-flex w-full justify-center rounded-md bg-pipexblue px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-blue-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 sm:col-start-2">Edit email</a>
                        <button type="button" id="closeModalBtn" class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:col-start-1 sm:mt-0">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $(document).ready(function(){
            <?php $maxTemplates = count($templates);
                for($i = 0; $i < $maxTemplates; $i++){ ?>
                    $('#prvwBtn<?php echo $i; ?>').click(function(e){
                        e.preventDefault();
                        $.ajax({
                            type: 'POST',
                            url: '{{ route('get-email') }}',
                            data: {
                                email_id: $('#email_id<?php echo $i; ?>').val(),
                                _token: '{{ csrf_token() }}'
                            },
                            success: function(response){
                                $('#modalTitle').text(response.title);
                                $('#modalMessage').html(response.message);
                                $('.email-view').toggle('hidden');
                                $('#editModalBtn').attr('href', '{{ url('/emails/edit-email') }}/' + response.id);
                            },
                            error: function(xhr) {

                            }
                        });
                    });
            <?php } ?>

            $('#closeModalBtn').click(function(){
                $('#modalTitle').text('');
                $('#modalMessage').html('');
                $('.email-view').toggle('hidden');
            });
        });
    </script>
@endsection
