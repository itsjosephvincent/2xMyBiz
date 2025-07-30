@extends('layouts.app')

@section('css')
@endsection

@section('title', 'Pipeline View | 2xMyLeads')

@section('content')
    <div class="px-4 sm:px-6 lg:px-8">
        <div class="sm:flex sm:items-center">
            <div class="sm:flex-auto">
                <h1 class="text-base font-semibold leading-6 text-gray-900">Offered deals</h1>
            </div>
            <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
                <button type="button" id="createBtn" class="block rounded-md bg-pipexblue px-3 py-2 text-center text-sm font-semibold text-white shadow-sm hover:bg-blue-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Add deal</button>
            </div>
        </div>
        <div class="mt-8 flow-root">
            <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                    <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 sm:rounded-lg">
                        <table class="min-w-full divide-y divide-gray-300">
                            <thead class="bg-white">
                                <tr>
                                    <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">Title</th>
                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Amount</th>
                                    <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6"><span class="sr-only">Edit</span></th>
                                    <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6"><span class="sr-only">Delete</span></th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 bg-white">
                                @foreach ($deals as $deal)
                                <tr>
                                    <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6">{{ $deal->deal_title }}</td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $deal->deal_price }}</td>
                                </tr>
                                @endforeach
                                @php
                                    $i = 0;
                                @endphp
                                @foreach ($mydeals as $mydeal)
                                <tr>
                                    <input type="hidden" id="dealid{{ $i }}" value="{{ $mydeal->id }}">
                                    <input type="hidden" id="dealname{{ $i }}" value="{{ $mydeal->deal_title }}">
                                    <input type="hidden" id="dealprice{{ $i }}" value="{{ $mydeal->deal_price }}">
                                    <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6">{{ $mydeal->deal_title }}</td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $mydeal->deal_price }}</td>
                                    <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-sm font-medium sm:pr-0">
                                        <a id="editBtn{{ $i }}" class="cursor-pointer text-pipexblue hover:text-blue-900">Edit<span class="sr-only">, {{ $mydeal->deal_title }}</span></a>
                                    </td>
                                    <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-sm font-medium sm:pr-0">
                                        <a href="{{ route('delete-deal', $mydeal->id) }}" class="text-red-600 hover:text-red-900">Delete<span class="sr-only">, {{ $mydeal->deal_title }}</span></a>
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
    </div>

    <div class="relative z-10 create-deal hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>
        <div class="fixed inset-0 z-10 overflow-y-auto">
            <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                <div class="relative transform overflow-hidden rounded-lg bg-white px-4 pb-4 pt-5 text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg sm:p-6">
                    <form action="{{ route('create-deal') }}" method="post">
                        @csrf
                        <div>
                            <div class="mt-3 sm:mt-5">
                                <h3 class="text-base text-center font-semibold leading-6 text-gray-900" id="modal-title">Create new deal</h3>
                                <div class="mt-2">
                                    <label class="block text-sm font-medium leading-6 text-gray-900">Deal title</label>
                                    <div class="mt-1">
                                        <input type="text" name="deal_title" id="title_deal" required class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                    </div>
                                </div>
                                <div class="mt-2">
                                    <label class="block text-sm font-medium leading-6 text-gray-900">Deal price</label>
                                    <div class="mt-1">
                                        <input type="number" name="deal_price" id="price_deal" step="0.01" min="0" max="1000" required class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mt-5 sm:mt-6 sm:grid sm:grid-flow-row-dense sm:grid-cols-2 sm:gap-3">
                            <button type="submit" class="inline-flex w-full justify-center rounded-md bg-pipexblue px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-blue-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 sm:col-start-2">Create</button>
                            <button type="button" id="cancelCreateBtn" class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:col-start-1 sm:mt-0">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="relative z-10 edit-deal hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>
        <div class="fixed inset-0 z-10 overflow-y-auto">
            <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                <div class="relative transform overflow-hidden rounded-lg bg-white px-4 pb-4 pt-5 text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg sm:p-6">
                    <form action="{{ route('update-deal') }}" method="post">
                        @csrf
                        @method('PUT')
                        <div>
                            <input type="hidden" name="dealtokenid" id="dealtokenid">
                            <div class="mt-3 sm:mt-5">
                                <h3 class="text-base text-center font-semibold leading-6 text-gray-900" id="modal-title">Create new deal</h3>
                                <div class="mt-2">
                                    <label class="block text-sm font-medium leading-6 text-gray-900">Deal title</label>
                                    <div class="mt-1">
                                        <input type="text" name="deal_title" id="deal_title" required class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                    </div>
                                </div>
                                <div class="mt-2">
                                    <label class="block text-sm font-medium leading-6 text-gray-900">Deal price</label>
                                    <div class="mt-1">
                                        <input type="number" name="deal_price" id="deal_price" step="0.01" min="0" max="1000" required class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mt-5 sm:mt-6 sm:grid sm:grid-flow-row-dense sm:grid-cols-2 sm:gap-3">
                            <button type="submit" class="inline-flex w-full justify-center rounded-md bg-pipexblue px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-blue-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 sm:col-start-2">Update</button>
                            <button type="button" id="cancelEditBtn" class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:col-start-1 sm:mt-0">Cancel</button>
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
            $('#createBtn').click(function(){
                $('.create-deal').toggle('hidden');
            });

            $('#cancelCreateBtn').click(function(){
                $('.create-deal').addClass('hidden');
                $('#title_deal').val('');
                $('#price_deal').val('');
            });

            <?php $maxdeal = count($mydeals);
                for($i = 0; $i < $maxdeal; $i++){ ?>
                    $('#editBtn<?php echo $i; ?>').click(function(){
                        $('.edit-deal').toggle('hidden');
                        var id = $('#dealid<?php echo $i; ?>').val();
                        var name = $('#dealname<?php echo $i; ?>').val();
                        var price = $('#dealprice<?php echo $i; ?>').val();
                        $('#dealtokenid').val(id);
                        $('#deal_title').val(name);
                        $('#deal_price').val(price);
                    });
            <?php } ?>

            $('#cancelEditBtn').click(function(){
                $('.edit-deal').toggle('hidden');
            });

            $('#cancelCreateBtn').click(function(){
                $('.create-deal').toggle('hidden');
            });
        });
    </script>
@endsection
