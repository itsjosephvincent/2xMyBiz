@extends('layouts.app')

@section('title', 'Notifications - 2xMyLeads')

@section('content')

    <div class="grid grid-cols-1 lg:grid-cols-2 mb-8">
        <div class="flex justify-start">
            <h6 class="text-lg font-medium">Notifications</h6>
        </div>
        <div class="flex justify-end">
            <button type="button" id="createBtn" class="rounded-md bg-pipexblue px-2.5 py-1.5 text-sm font-semibold text-white shadow-sm hover:bg-blue-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Create notification</button>
        </div>
    </div>

    <div class="px-4 sm:px-6 lg:px-8">
        <div class="mt-8 flow-root">
            <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                    <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 sm:rounded-lg">
                        <table class="min-w-full divide-y divide-gray-300">
                            <thead class="bg-white">
                                <tr>
                                    <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">Title</th>
                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Created at</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 bg-white">
                                @foreach ($notifs as $notif)
                                    <tr>
                                        <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6">{{ $notif->title }}</td>
                                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ date('m-d-Y', strtotime($notif->created_at)) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="flex justify-center mt-2 lead-pagination">
                        {{ $notifs->links('vendor.pagination.paginate') }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="relative z-10 new-notification-modal hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>
        <div class="fixed inset-0 z-10 overflow-y-auto">
            <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                <div class="relative transform overflow-hidden rounded-lg bg-white px-4 pb-4 pt-5 text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg sm:p-6">
                    <div>
                        <h3 class="text-base font-semibold leading-6 text-gray-900" id="modal-title">Create notification</h3>
                        <div class="mt-3 sm:mt-5">
                            <form action="{{ route('send-notification') }}" id="notificationForm" method="post" class="relative">
                                @csrf
                                <div class="overflow-hidden rounded-lg divide-y divide-gray-300 border border-gray-300 shadow-sm focus-within:border-indigo-500 focus-within:ring-1 focus-within:ring-indigo-500">
                                    <input type="text" name="title" id="titleText" class="block w-full border-0 pt-2.5 text-lg font-medium placeholder:text-gray-400 focus:ring-0" placeholder="Title">
                                    <textarea rows="8" name="message" id="messageText" class="block w-full resize-none border-0 py-0 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6" placeholder="Write your content..."></textarea>
                                    <div aria-hidden="true">
                                        <div class="py-2">
                                            <div class="h-9"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="absolute inset-x-px bottom-0">
                                    <div class="flex items-center justify-between space-x-3 px-2 py-2 sm:px-3">
                                        <div class="flex-shrink-0">
                                            <button type="button" id="cancelBtn" class="rounded-md bg-white px-2.5 py-1.5 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50">Cancel</button>
                                            <button type="submit" class="rounded-md bg-indigo-600 px-2.5 py-1.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Send</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="hidden relative z-10 notification-modal" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>
        <div class="fixed inset-0 z-10 overflow-y-auto">
            <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                <div class="relative transform overflow-hidden rounded-lg bg-white px-4 pb-4 pt-5 text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-sm sm:p-6">
                    <div>
                        <div class="flex justify-center items-center">
                            <div class="loader"></div>
                        </div>
                        <div class="mt-3 text-center sm:mt-5">
                            <h3 class="text-base font-semibold leading-6 text-gray-900" id="modal-title">Sending notification</h3>
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
        var form = document.getElementById('notificationForm');

        $('#cancelBtn').click(function(){
            form.reset();
            $('.new-notification-modal').addClass('hidden');
        });

        $('#createBtn').click(function(){
            $('.new-notification-modal').removeClass('hidden');
        });

        $('#notificationForm').submit(function(){
            $('.notification-modal').removeClass('hidden');
        });
    });
</script>
@endsection
