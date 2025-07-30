@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.15.2/css/selectize.default.min.css" integrity="sha512-pTaEn+6gF1IeWv3W1+7X7eM60TFu/agjgoHmYhAfLEU8Phuf6JKiiE8YmsNC0aCgQv4192s4Vai8YZ6VNM6vyQ==" crossorigin="anonymous" referrerpolicy="no-referrer">
@endsection

@section('title', 'Find Facebook Leads | 2xMyLeads')

@section('content')
    <form action="{{ route('search-leads') }}" method="get">
        @csrf
        <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-4 gap-4 px-2">
            <div class="col-span-2 md:col-span-1 lg:col-span-1 px-4 sm:px-6">
                <div class="hidden category-section">
                    <label for="categorySearch" class="block text-sm font-medium leading-6 text-gray-900">Categories</label>
                    <div class="mt-2">
                        <select name="category_name" id="categorySearch">
                            <option value="" selected disabled>Select category</option>
                            @foreach ($categories as $category)
                            <option value="{{ $category->facebook_category_name }}">{{ $category->facebook_category_name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-span-2 md:col-span-1 lg:col-span-1 px-4 sm:px-6">
                <div>
                    <label for="keyword" class="block text-sm font-medium leading-6 text-gray-900">Keyword</label>
                    <div class="mt-2">
                    <input type="text" name="keyword" id="keyword" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" placeholder="place, city, etc.">
                    </div>
                </div>
            </div>
            <div class="col-span-2 md:col-span-2 lg:col-span-2 px-4 sm:px-6">
                <div class="md:mt-8 lg:mt-8">
                    <button type="submit" class="inline-flex items-center h-8 gap-x-1.5 rounded-md bg-pipexblue px-2.5 py-1.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                        Search
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </form>

    @if ($pages)
    <div class="px-4 sm:px-6 lg:px-8">
        <div class="sm:flex sm:items-center mt-10">
            <div class="sm:flex-auto">
                <p class="text-sm">
                    @if (!$categoryName && $keyword)
                    Search results for "<b>{{ $keyword }}</b>"
                    @elseif ($categoryName && !$keyword)
                    Search results for "<b>{{ $categoryName }}</b>"
                    @else
                    Search results for "<b>{{ $categoryName }}</b> and <b>{{ $keyword }}</b>"
                    @endif
                </p>
            </div>
            <div class="bulk-buttons hidden lg:mt-0 mt-4 space-x-2 sm:space-x-4">
                <button type="button" id="saveLeadsBtn" class="rounded-md bg-blue-700 px-2.5 py-1.5 text-sm font-semibold text-white shadow-sm hover:bg-blue-500">Save lead</button>
            </div>
        </div>
        <div class="mt-4 flow-root">
            <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                    <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 sm:rounded-lg">
                        <table class="min-w-full divide-y divide-gray-300">
                            <thead class="bg-white">
                                <tr>
                                    <th class="flex items-center justify-center">
                                        <input id="selectAll" type="checkbox" class="hidden h-4 w-4 mt-5 ml-2 rounded border-gray-300 text-blue-600 focus:ring-blue-600">
                                    </th>
                                    <th scope="col" class="px-3 py-3.5 text-left text-xs font-semibold text-gray-900">Page name</th>
                                    <th scope="col" class="px-3 py-3.5 text-left text-xs font-semibold text-gray-900">Location</th>
                                    <th scope="col" class="px-3 py-3.5 text-left text-xs font-semibold text-gray-900">Facebook Page</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 bg-white">
                                @php
                                    $i = 0;
                                @endphp
                                @foreach ($pages as $page)
                                <tr>
                                    <td class="flex items-center justify-center">
                                        <input name="leads[]" value="{{ $page->id }}" id="checkbox-item{{ $i }}" data-id="{{ $i }}" type="checkbox" class="checkboxitem h-4 w-4 mt-5 ml-2 rounded border-gray-300 text-blue-600 focus:ring-blue-600">
                                    </td>
                                    <td class="truncate whitespace-nowrap py-4 pl-4 pr-3 text-xs font-medium text-gray-900 sm:pl-6" style="max-width: 150px; overflow: hidden; text-overflow: ellipsis;">{{ $page->name }}</td>
                                    <td class="truncate whitespace-nowrap px-3 py-4 text-xs text-gray-500" style="max-width: 200px; overflow: hidden; text-overflow: ellipsis;">{{ isset($page->location->street) ? $page->location->street . ' ' : '' }}{{ isset($page->location->city) ? $page->location->city : '' }}</td>
                                    <th scope="col" class="truncate px-3 py-3.5 text-left text-sm font-semibold text-gray-900"><a href="{{ $page->link }}" target="_blank">View</a></th>
                                    <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-6">
                                        <input type="hidden" value="{{ $page->id }}" id="page_id{{ $i }}">
                                        <input type="hidden" value="{{ $page->name }}" id="page_name{{ $i }}">
                                        <input type="hidden" value="{{ isset($page->location->country) ? $page->location->country : null }}" id="page_country{{ $i }}">
                                        <input type="hidden" value="{{ isset($page->location->city) ? $page->location->city : null }}" id="page_city{{ $i }}">
                                        <input type="hidden" value="{{ isset($page->location->state) ? $page->location->state : null }}" id="page_state{{ $i }}">
                                        <input type="hidden" value="{{ isset($page->location->zip) ? $page->location->zip : null }}" id="page_zip{{ $i }}">
                                        <input type="hidden" value="{{ isset($page->location->street) ? $page->location->street : null }}" id="page_street{{ $i }}">
                                        <input type="hidden" value="{{ $page->link }}" name="page_link" id="page_link{{ $i }}">
                                        <button type="button" id="saveBtn{{ $i }}" class="rounded bg-pipexblue px-2 py-1 text-xs font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Save</button>
                                    </td>
                                    <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-6">
                                        <form id="blockForm{{ $i }}">
                                            @csrf
                                            <input type="hidden" value="{{ $page->id }}" name="page_id" id="page_id{{ $i }}">
                                            <input type="hidden" value="{{ $page->name }}" name="page_name" id="page_name{{ $i }}">
                                            <button type="submit" id="blockBtn{{ $i }}" class="rounded bg-red-600 px-2 py-1 text-xs font-semibold text-white shadow-sm hover:bg-red-900 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Block</button>
                                        </form>
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
        <div class="flex justify-center mt-2">
            {{ $pages->links('vendor.pagination.paginate') }}
        </div>
    </div>
    @else
    <div class="border rounded-lg border-gray-200 bg-white px-4 sm:px-6 mt-10">
        <div class="grid grid-rows-2 place-items-center">
            <div>
                <img src="{{ asset('img/no_data.png') }}" class="w-28 mt-2" alt="no data">
            </div>
            <div>
                <p class="text-gray-500 text-sm">No data yet.</p>
            </div>
        </div>
    </div>
    @endif

    <div class="hidden relative z-10" id="saveLoader" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>
        <div class="fixed inset-0 z-10 overflow-y-auto">
            <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                <div class="relative transform overflow-hidden rounded-lg bg-white px-4 pb-4 pt-5 text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-sm sm:p-6">
                    <div>
                        <div class="flex justify-center items-center">
                            <div class="loader"></div>
                        </div>
                        <div class="mt-3 text-center sm:mt-5">
                            <h3 class="text-base font-semibold leading-6 text-gray-900" id="modal-title">Saving lead</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="hidden relative z-10" id="loadLoader" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>
        <div class="fixed inset-0 z-10 overflow-y-auto">
            <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                <div class="relative transform overflow-hidden rounded-lg bg-white px-4 pb-4 pt-5 text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-sm sm:p-6">
                    <div>
                        <div class="flex justify-center items-center">
                            <div class="loader"></div>
                        </div>
                        <div class="mt-3 text-center sm:mt-5">
                            <h3 class="text-base font-semibold leading-6 text-gray-900" id="modal-title">Loading</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="hidden relative z-10" id="blockLoader" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>
        <div class="fixed inset-0 z-10 overflow-y-auto">
            <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                <div class="relative transform overflow-hidden rounded-lg bg-white px-4 pb-4 pt-5 text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-sm sm:p-6">
                    <div>
                        <div class="flex justify-center items-center">
                            <div class="loader"></div>
                        </div>
                        <div class="mt-3 text-center sm:mt-5">
                            <h3 class="text-base font-semibold leading-6 text-gray-900" id="modal-title">Blocking lead</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="hidden relative z-10" id="save-lead-modal" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>
        <div class="fixed inset-0 z-10 overflow-y-auto">
            <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                    <div class="relative transform overflow-hidden rounded-lg bg-white px-4 pb-4 pt-5 text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg sm:p-6">
                        <form id="pageForm">
                            @csrf
                        <div>
                            <div class="mt-3 sm:mt-5">
                                <input type="hidden" name="page_id" id="save_page_id">
                                <input type="hidden" name="page_name" id="save_page_name">
                                <input type="hidden" name="page_country" id="save_page_country">
                                <input type="hidden" name="page_city" id="save_page_city">
                                <input type="hidden" name="page_state" id="save_page_state">
                                <input type="hidden" name="page_zip" id="save_page_zip">
                                <input type="hidden" name="page_street" id="save_page_street">
                                <input type="hidden" name="page_link" id="save_page_link">
                                <label for="leadgroups" class="block text-sm font-medium leading-6 text-gray-900">Assign lead to group</label>
                                <select id="leadgroups" name="leadgroups" class="mt-2 block w-full rounded-md border-0 py-1.5 pl-3 pr-10 text-gray-900 ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                    <option value="" selected disabled>Select lead group</option>
                                    @foreach ($orgs as $org)
                                    <option value="{{ $org->id }}">{{ $org->organization_name }}</option>
                                    @endforeach
                                    @foreach ($myorgs as $myorg)
                                    <option value="{{ $myorg->id }}">{{ $myorg->organization_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="mt-5 sm:mt-6 sm:grid sm:grid-flow-row-dense sm:grid-cols-2 sm:gap-3">
                            <button type="submit" class="inline-flex w-full justify-center rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 sm:col-start-2">Save</button>
                            <button type="button" id="cancelSaveBtn" class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:col-start-1 sm:mt-0">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="hidden relative z-10" id="save-bulk-lead-modal" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>
        <div class="fixed inset-0 z-10 overflow-y-auto">
            <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                    <div class="relative transform overflow-hidden rounded-lg bg-white px-4 pb-4 pt-5 text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg sm:p-6">
                    <div>
                        <div class="mt-3 sm:mt-5">
                            <label for="bulkleadgroups" class="block text-sm font-medium leading-6 text-gray-900">Assign lead to group</label>
                            <select id="bulkleadgroups" name="leadgroups" class="mt-2 block w-full rounded-md border-0 py-1.5 pl-3 pr-10 text-gray-900 ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                <option value="" selected disabled>Select lead group</option>
                                @foreach ($orgs as $org)
                                <option value="{{ $org->id }}">{{ $org->organization_name }}</option>
                                @endforeach
                                @foreach ($myorgs as $myorg)
                                <option value="{{ $myorg->id }}">{{ $myorg->organization_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="mt-5 sm:mt-6 sm:grid sm:grid-flow-row-dense sm:grid-cols-2 sm:gap-3">
                        <button type="button" id="submitBulkBtn" class="inline-flex w-full justify-center rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 sm:col-start-2">Save</button>
                        <button type="button" id="cancelBulkBtn" class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:col-start-1 sm:mt-0">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('sweetalert::alert')
@endsection

@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.15.2/js/selectize.min.js" integrity="sha512-IOebNkvA/HZjMM7MxL0NYeLYEalloZ8ckak+NDtOViP7oiYzG5vn6WVXyrJDiJPhl4yRdmNAG49iuLmhkUdVsQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script type="text/javascript">
        $(document).ready(function() {

            $('#selectAll').removeClass('hidden');

            var tokenArray = [];

            $('.category-section').removeClass('hidden');

            $('#pageForm').on('submit', function(e) {
                e.preventDefault();
                $('#save-lead-modal').addClass('hidden');
                $('#saveLoader').removeClass('hidden');
                $.ajax({
                    type: 'POST',
                    url: '{{ route('save-leads') }}',
                    data: $('#pageForm').serialize(),
                    success: function(response) {
                        if(response == 'You have reached the maximum allowed saved leads for today.'){
                            Swal.fire({
                                title: 'Error',
                                text: 'You have reached the maximum allowed saved leads for today.',
                                icon: 'error'
                            });
                            $('#saveLoader').addClass('hidden');
                        }else{
                            Swal.fire({
                                title: 'Success',
                                text: 'Lead saved.',
                                icon: 'success'
                            });
                            $('#saveLoader').addClass('hidden');
                        }
                    }
                });
                var form = document.getElementById('pageForm');
                form.reset();
            });

            $('#cancelSaveBtn').click(function(){
                $('#save-lead-modal').toggle('hidden');
                var saveBtn = $(this).attr('save');
                var blockBtn = $(this).attr('block');
                $('#'+saveBtn).removeClass('pointer-events-none');
                $('#'+saveBtn).removeClass('bg-gray-500');
                $('#'+saveBtn).addClass('bg-pipexblue');
                $('#'+blockBtn).removeClass('pointer-events-none');
                $('#'+blockBtn).removeClass('bg-gray-500');
                $('#'+blockBtn).addClass('bg-red-600');
            });

            $('#cancelBulkBtn').click(function(){
                $('#save-bulk-lead-modal').toggle('hidden');
            });

            $('#submitBulkBtn').click(function(){
                $('#save-bulk-lead-modal').toggle('hidden');
                $('#saveLoader').toggle('hidden');
                $.ajax({
                    type: 'POST',
                    url: '{{ route('bulk-save-leads') }}',
                    data: {
                        'pageTokens[]': tokenArray,
                        'leadgroup': $('#bulkleadgroups').val(),
                        '_token': '{{ csrf_token() }}'
                    },
                    success: function(response){
                        $('#saveLoader').toggle('hidden');
                        if(response == 'You have reached the maximum allowed saved leads for today.'){
                            Swal.fire({
                                title: 'Error',
                                text: 'You have reached the maximum allowed saved leads for today.',
                                icon: 'error'
                            });
                        }else if(response == 'You can only select up to 10 leads within your current subscription tier.'){
                            Swal.fire({
                                title: 'Error',
                                text: 'You can only select up to 10 leads within your current subscription tier.',
                                icon: 'error'
                            });
                        } else{
                            Swal.fire({
                                title: 'Success',
                                text: 'Leads successfully saved.',
                                icon: 'success'
                            }).then(function(result){
                                if(result.isConfirmed){
                                    $('#loadLoader').toggle('hidden');
                                    location.reload();
                                }
                            });
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown){
                        $('#saveLoader').toggle('hidden');
                        Swal.fire({
                            title: 'Error',
                            text: 'An error has occured. Please contact the system administrator.',
                            icon: 'error'
                        });
                    }
                });
            });

            $('#selectAll').change(function() {
                if ($(this).is(':checked')) {
                    $('.checkboxitem').prop('checked', true);
                    $('input[name="leads[]"]:checked').each(function() {
                        var order = $(this).data('id');

                        $pageArray = [
                            $(this).val(),
                            $('#page_name' + order).val(),
                            $('#page_country' + order).val(),
                            $('#page_city' + order).val(),
                            $('#page_state' + order).val(),
                            $('#page_zip' + order).val(),
                            $('#page_street' + order).val(),
                            $('#page_link' + order).val(),
                        ];

                        tokenArray.push($pageArray);
                    });

                    $('.bulk-buttons').toggle('hidden');
                } else {
                    $('.checkboxitem').prop('checked', false);

                    $('input[name="leads[]"]:not(:checked)').each(function() {
                        var order = $(this).data('id');

                        var indexToRemove = -1;
                        for (var i = 0; i < tokenArray.length; i++) {
                            if (JSON.stringify(tokenArray[i]) === JSON.stringify($pageArray)) {
                                indexToRemove = i;
                                break; // Exit the loop once the element is found
                            }
                        }
                        if (indexToRemove !== -1) {
                            tokenArray.splice(indexToRemove, 1);
                        }
                    });

                    $('.bulk-buttons').toggle('hidden');
                }
            });

            $('#categorySearch').selectize();

            $('#saveLeadsBtn').click(function(){
                $("#save-bulk-lead-modal").toggle('hidden');
            });

            <?php $maxPages = count($pages);
                for($i = 0; $i < $maxPages; $i++){ ?>
                    $('#saveBtn<?php echo $i; ?>').click(function(){
                        var saveId = $('#saveBtn<?php echo $i; ?>').attr('id');
                        var blockId = $('#blockBtn<?php echo $i; ?>').attr('id');
                        $('#save-lead-modal').removeClass('hidden');
                        $('#blockBtn<?php echo $i; ?>').addClass('pointer-events-none');
                        $('#blockBtn<?php echo $i; ?>').addClass('bg-gray-500');
                        $('#blockBtn<?php echo $i; ?>').removeClass('bg-red-600');
                        $('#saveBtn<?php echo $i; ?>').addClass('pointer-events-none');
                        $('#saveBtn<?php echo $i; ?>').addClass('bg-gray-500');
                        $('#saveBtn<?php echo $i; ?>').removeClass('bg-pipexblue');
                        $('#cancelSaveBtn').attr('save', saveId);
                        $('#cancelSaveBtn').attr('block', blockId);
                        $("#save_page_id").val($('#page_id<?php echo $i; ?>').val());
                        $("#save_page_name").val($('#page_name<?php echo $i; ?>').val());
                        $("#save_page_country").val($('#page_country<?php echo $i; ?>').val());
                        $("#save_page_city").val($('#page_city<?php echo $i; ?>').val());
                        $("#save_page_state").val($('#page_state<?php echo $i; ?>').val());
                        $("#save_page_zip").val($('#page_zip<?php echo $i; ?>').val());
                        $("#save_page_street").val($('#page_street<?php echo $i; ?>').val());
                        $("#save_page_link").val($('#page_link<?php echo $i; ?>').val());
                    });

                    $('#blockForm<?php echo $i; ?>').on('submit', function(e){
                        e.preventDefault();
                        $('#blockLoader').removeClass('hidden');
                        $.ajax({
                            type: 'POST',
                            url: '{{ route('block-leads') }}',
                            data: $('#blockForm<?php echo $i; ?>').serialize(),
                            success: function(response){
                                $('#blockLoader').addClass('hidden');
                                Swal.fire({
                                    title: 'Success',
                                    text: 'Lead blocked.',
                                    icon: 'success'
                                });
                                $('#blockBtn<?php echo $i; ?>').addClass('pointer-events-none');
                                $('#blockBtn<?php echo $i; ?>').addClass('bg-gray-500');
                                $('#blockBtn<?php echo $i; ?>').removeClass('bg-red-600');
                                $('#saveBtn<?php echo $i; ?>').addClass('pointer-events-none');
                                $('#saveBtn<?php echo $i; ?>').addClass('bg-gray-500');
                                $('#saveBtn<?php echo $i; ?>').removeClass('bg-pipexblue');
                            }
                        })
                    });

                    $('#checkbox-item<?php echo $i; ?>').change(function(){
                        $pageArray = [
                            $(this).val(),
                            $('#page_name<?php echo $i; ?>').val(),
                            $('#page_country<?php echo $i; ?>').val(),
                            $('#page_city<?php echo $i; ?>').val(),
                            $('#page_state<?php echo $i; ?>').val(),
                            $('#page_zip<?php echo $i; ?>').val(),
                            $('#page_street<?php echo $i; ?>').val(),
                            $('#page_link<?php echo $i; ?>').val(),
                        ];

                        if ($(this).is(':checked')) {
                            $('#saveBtn<?php echo $i; ?>').addClass('pointer-events-none');
                            $('#saveBtn<?php echo $i; ?>').addClass('bg-gray-500');
                            $('#saveBtn<?php echo $i; ?>').removeClass('bg-pipexblue');
                            $('#blockBtn<?php echo $i; ?>').addClass('pointer-events-none');
                            $('#blockBtn<?php echo $i; ?>').addClass('bg-gray-500');
                            $('#blockBtn<?php echo $i; ?>').removeClass('bg-red-600');
                            tokenArray.push($pageArray);
                        } else {
                            $('#selectAll').prop('checked', false);
                            $('#saveBtn<?php echo $i; ?>').removeClass('pointer-events-none');
                            $('#saveBtn<?php echo $i; ?>').removeClass('bg-gray-500');
                            $('#saveBtn<?php echo $i; ?>').addClass('bg-pipexblue');
                            $('#blockBtn<?php echo $i; ?>').removeClass('pointer-events-none');
                            $('#blockBtn<?php echo $i; ?>').removeClass('bg-gray-500');
                            $('#blockBtn<?php echo $i; ?>').addClass('bg-red-600');
                            var indexToRemove = -1;
                            for (var i = 0; i < tokenArray.length; i++) {
                                if (JSON.stringify(tokenArray[i]) === JSON.stringify($pageArray)) {
                                    indexToRemove = i;
                                    break; // Exit the loop once the element is found
                                }
                            }
                            if (indexToRemove !== -1) {
                                tokenArray.splice(indexToRemove, 1);
                            }
                        }

                        if(tokenArray.length > 0){
                            $('.bulk-buttons').removeClass('hidden');
                        }else{
                            $('.bulk-buttons').addClass('hidden');
                        }
                    });
            <?php } ?>
        });
    </script>
@endsection
