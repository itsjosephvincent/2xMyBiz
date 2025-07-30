@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/lead-profile.css') }}">
@endsection

@section('title', 'Lead Group Profile | 2xMyLeads')

@section('content')
    <div class="grid grid-cols-1">
        <div class="col-span-1">
            <a href="{{ route('my-organizations') }}" class="inline-flex items-center gap-x-1.5 rounded bg-indigo-50 px-2 py-1 text-xs font-semibold text-black shadow-sm hover:bg-indigo-100">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="-ml-0.5 h-5 w-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
                </svg>
                Go back
            </a>
        </div>
    </div>

    <div class="border border-gray-200 bg-white px-4 py-5 sm:px-6 mt-4">
        <div class="grid grid-cols-3">
            <div class="col-span-1 flex justify-center">
                <img class="inline-block h-28 w-28 rounded-full" src="{{ asset('img/org.png') }}">
            </div>
            <div class="col-span-1 flex justify-start">
                <div class="grid grid-rows-3 view">
                    @if ($organization->id != 1)
                    <div class="row-span-1">
                        <button type="button" id="editBtn" class="inline-flex items-center gap-x-1.5 rounded bg-indigo-50 px-2 py-1 text-xs font-semibold text-black shadow-sm hover:bg-indigo-100">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="-ml-0.5 h-5 w-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125" />
                            </svg>
                            Edit lead group
                        </button>
                    </div>
                    @endif
                    <div class="row-span-1 mt-1">{{ $organization->organization_name }}</div>
                    <div class="row-span-1"><span class="inline-flex flex-shrink-0 items-center rounded-full bg-{{ $organization->lead_class_name }} px-1.5 py-0.5 text-xs text-white ring-1 ring-green-600/20">{{ $organization->lead_group_name }}</span></div>
                </div>
            </div>
            <div class="col-span-1 flex justify-start">
                <div class="grid grid-rows-2">
                    <div class="sm:flex">
                        <div class="mb-4 flex-shrink-0 sm:mb-0 sm:mr-4">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor" class="h-12 w-12 text-pipexblue">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                            </svg>
                        </div>
                        <div>
                            <h4 class="text-xs">Have:</h4>
                            <p class="mt-1">{{ isset($leadcount) ? $leadcount : 0 }} leads</p>
                        </div>
                    </div>
                    <div class="sm:flex mt-1">
                        <div class="mb-4 flex-shrink-0 sm:mb-0 sm:mr-4">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor" class="w-12 h-12 text-pipexblue">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5" />
                            </svg>
                        </div>
                        <div>
                            <h4 class="text-xs">Created:</h4>
                            <p class="mt-1 text-sm">{{ date('m-d-Y', strtotime($organization->created_at)) }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="border border-gray-200 bg-white px-4 py-5 sm:px-6 mt-4">
        <div class="px-4 sm:px-6 lg:px-8">
            <div class="grid lg:grid-cols-2 grid-cols-1">
                <div class="mt-4 sm:mt-0 sm:flex-none">
                    <button type="button" id="addBtn" class="block rounded-md bg-pipexblue px-3 py-2 text-center text-sm font-semibold text-white shadow-sm hover:bg-blue-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Add lead</button>
                </div>
                <div class="bulk-buttons hidden lg:mt-0 mt-4 space-x-2 sm:space-x-4 flex justify-end">
                    <button type="button" id="updateGroupBtn" class="rounded bg-green-600 px-2 py-1 text-xs font-semibold text-white shadow-sm hover:bg-green-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-green-600">Update group</button>
                    <button type="button" id="updateStageBtn" class="rounded bg-cyan-600 px-2 py-1 text-xs font-semibold text-white shadow-sm hover:bg-cyan-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-cyan-600">Update stage</button>
                    <button type="button" id="updateDealsBtn" class="rounded bg-indigo-600 px-2 py-1 text-xs font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Update deal</button>
                </div>
            </div>
            <div class="mt-8 flow-root">
                <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                        <table class="min-w-full divide-y divide-gray-300">
                            <thead>
                                <tr>
                                    <th scope="col" class="pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-0"></th>
                                    <th scope="col" class="py-3.5 text-left text-sm font-semibold text-gray-900">Name</th>
                                    <th scope="col" class="py-3.5 text-left text-sm font-semibold text-gray-900">Facebook</th>
                                    <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-0">
                                        <span class="sr-only">Remove</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                @php
                                    $i = 0;
                                @endphp
                                @foreach ($groupleads as $grouplead)
                                <tr>
                                    <td>
                                        <div class="relative flex items-start">
                                            <div class="flex h-6 items-center">
                                                <input name="leadId[]" type="checkbox" id="checkboxItem{{ $i }}" value="{{ $grouplead->id }}" class="checkbox-item h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-600">
                                            </div>
                                        </div>
                                    </td>
                                    <td class="whitespace-nowrap pl-4 pr-3 text-xs font-medium text-gray-900 sm:pl-0"><a href="{{ route('lead-profile', $grouplead->id) }}">{{ $grouplead->lead_name }}</a></td>
                                    <td class="whitespace-nowrap py-4 text-xs text-blue-500 font-medium"><a href="{{ $grouplead->link }}" target="_blank">Visit</a></td>
                                    <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-xs font-medium sm:pr-0">
                                        <a href="{{ route('remove-leads-from-leadgroup', $grouplead->id) }}" class="text-red-500 hover:text-red-900">Remove<span class="sr-only">, Lindsay Walton</span></a>
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
        <div class="flex justify-center mt-2 lead-pagination">
            {{ $groupleads->links('vendor.pagination.paginate') }}
        </div>
    </div>


    <div class="relative z-10 edit hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>
        <div class="fixed inset-0 z-10 overflow-y-auto">
            <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                <div class="relative transform overflow-hidden rounded-lg bg-white px-4 pb-4 pt-5 text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg sm:p-6">
                    <form action="{{ route('update-organization', $organization->id) }}" method="post">
                        @csrf
                        @method('PUT')
                        <div>
                            <div>
                                <label for="email" class="block text-sm font-medium leading-6 text-gray-900">Lead group name</label>
                                <div class="mt-2">
                                    <input type="text" name="organization_name" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" value="{{ $organization->organization_name }}">
                                </div>
                            </div>
                            <div>
                                <label class="text-xs text-gray-500 ml-2">Group</label>
                                <select name="pipeline_category" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                    <option value="" selected disabled>Select category</option>
                                    @foreach ($leadgroups as $leadgroup)
                                        <option value="{{ $leadgroup->id }}">{{ $leadgroup->lead_group_name }}</option>
                                    @endforeach
                                    @foreach ($myleadgroups as $myleadgroup)
                                        <option value="{{ $myleadgroup->id }}">{{ $myleadgroup->lead_group_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="mt-5 sm:mt-6 sm:grid sm:grid-flow-row-dense sm:grid-cols-2 sm:gap-3">
                            <button type="submit" class="inline-flex w-full justify-center rounded-md bg-pipexblue px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-blue-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 sm:col-start-2">Update</button>
                            <button type="button" id="cancelBtn" class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:col-start-1 sm:mt-0">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="relative z-10 add hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>
        <div class="fixed inset-0 z-10 overflow-y-auto">
            <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                <div class="relative transform overflow-hidden rounded-lg bg-white px-4 pb-4 pt-5 text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg sm:p-6">
                    <form action="{{ route('add-leads-to-leadgroup', $organization->id) }}" method="post">
                        @csrf
                        @method('PUT')
                        <div>
                            <div>
                                <label class="text-xs text-gray-500 ml-2">Leads</label>
                                <select name="leads" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                    <option value="" selected disabled>Select lead</option>
                                    @foreach ($leads as $lead)
                                    <option value="{{ $lead->id }}">{{ $lead->lead_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="mt-5 sm:mt-6 sm:grid sm:grid-flow-row-dense sm:grid-cols-2 sm:gap-3">
                            <button type="submit" class="inline-flex w-full justify-center rounded-md bg-pipexblue px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-blue-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 sm:col-start-2">Add</button>
                            <button type="button" id="cancelAddBtn" class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:col-start-1 sm:mt-0">Cancel</button>
                        </div>
                    </form>
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

    <div class="relative z-10 lead-group-modal hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>
        <div class="fixed inset-0 z-10 overflow-y-auto">
            <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                <div class="relative transform overflow-hidden rounded-lg bg-white px-4 pb-4 pt-5 text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg sm:p-6">
                    <div>
                        <div>
                            <label class="text-xs text-gray-500 ml-2">Lead group</label>
                            <select name="leadgroup" id="leadgroupSelect" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
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
                        <button type="button" id="massUpdateGroupBtn" class="inline-flex w-full justify-center rounded-md bg-pipexblue px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-blue-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 sm:col-start-2">Update</button>
                        <button type="button" id="cancelOrgUpdateBtn" class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:col-start-1 sm:mt-0">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="relative z-10 lead-stage-modal hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>
        <div class="fixed inset-0 z-10 overflow-y-auto">
            <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                <div class="relative transform overflow-hidden rounded-lg bg-white px-4 pb-4 pt-5 text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg sm:p-6">
                    <div>
                        <div>
                            <label class="text-xs text-gray-500 ml-2">Lead stage</label>
                            <select name="leadstage" id="leadStageSelect" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                <option value="" selected disabled>Select lead stage</option>
                                @foreach ($leadgroups as $leadgroup)
                                <option value="{{ $leadgroup->id }}">{{ $leadgroup->lead_group_name }}</option>
                                @endforeach
                                @foreach ($myleadgroups as $myleadgroup)
                                <option value="{{ $myleadgroup->id }}">{{ $myleadgroup->lead_group_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="mt-5 sm:mt-6 sm:grid sm:grid-flow-row-dense sm:grid-cols-2 sm:gap-3">
                        <button type="button" id="massUpdateStageBtn" class="inline-flex w-full justify-center rounded-md bg-pipexblue px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-blue-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 sm:col-start-2">Update</button>
                        <button type="button" id="cancelStageUpdateBtn" class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:col-start-1 sm:mt-0">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="relative z-10 lead-deal-modal hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>
        <div class="fixed inset-0 z-10 overflow-y-auto">
            <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                <div class="relative transform overflow-hidden rounded-lg bg-white px-4 pb-4 pt-5 text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg sm:p-6">
                    <div>
                        <div>
                            <label class="text-xs text-gray-500 ml-2">Deal</label>
                            <select name="deals" id="dealSelect" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                <option value="" selected disabled>Select deal</option>
                                @foreach ($deals as $deal)
                                <option value="{{ $deal->id }}">{{ $deal->deal_title }}</option>
                                @endforeach
                                @foreach ($mydeals as $mydeal)
                                <option value="{{ $mydeal->id }}">{{ $mydeal->deal_title }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="mt-5 sm:mt-6 sm:grid sm:grid-flow-row-dense sm:grid-cols-2 sm:gap-3">
                        <button type="button" id="massUpdateDealBtn" class="inline-flex w-full justify-center rounded-md bg-pipexblue px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-blue-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 sm:col-start-2">Update</button>
                        <button type="button" id="cancelDealUpdateBtn" class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:col-start-1 sm:mt-0">Cancel</button>
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
        $(document).ready(function(){
            var tokenArray = [];

            $('#editBtn').click(function(){
                $('.edit').toggle('hidden');
            });

            $('#cancelBtn').click(function(){
                $('.edit').toggle('hidden');
            });

            $('#updateGroupBtn').click(function(){
                $('.lead-group-modal').toggle('hidden');
            });

            $('#cancelOrgUpdateBtn').click(function(){
                $('.lead-group-modal').toggle('hidden');
            });

            $('#updateStageBtn').click(function(){
                $('.lead-stage-modal').toggle('hidden');
            });

            $('#cancelStageUpdateBtn').click(function(){
                $('.lead-stage-modal').toggle('hidden');
            });

            $('#updateDealsBtn').click(function(){
                $('.lead-deal-modal').toggle('hidden');
            });

            $('#cancelDealUpdateBtn').click(function(){
                $('.lead-deal-modal').toggle('hidden');
            });

            $('#massUpdateGroupBtn').click(function(e){
                e.preventDefault();
                $('.lead-group-modal').toggle('hidden');
                $('#loadLoader').toggle('hidden');

                $.ajax({
                    type: 'POST',
                    url: '{{ route('mass-update-organization') }}',
                    data: {
                        'pageIds[]': tokenArray,
                        'leadgroup': $('#leadgroupSelect').val(),
                        '_token': '{{ csrf_token() }}'
                    },
                    success: function(response){
                        if(response === true){
                            $('#loadLoader').toggle('hidden');
                            Swal.fire({
                                title: 'Success',
                                text: 'Lead group successfully changed',
                                icon: 'success'
                            }).then(function(result){
                                if(result.isConfirmed){
                                    $('#loadLoader').toggle('hidden');
                                    location.reload();
                                }
                            });
                        }else{
                            Swal.fire({
                                title: 'Error',
                                text: 'An error has occured. Please contact the system administrator.',
                                icon: 'error'
                            });
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown){
                        $('#loadLoader').toggle('hidden');
                        Swal.fire({
                            title: 'Error',
                            text: 'An error has occured. Please contact the system administrator.',
                            icon: 'error'
                        });
                    }
                });
            });

            $('#massUpdateStageBtn').click(function(e){
                e.preventDefault();
                $('.lead-stage-modal').toggle('hidden');
                $('#loadLoader').toggle('hidden');

                $.ajax({
                    type: 'POST',
                    url: '{{ route('mass-update-stage') }}',
                    data: {
                        'pageIds[]': tokenArray,
                        'stagegroup': $('#leadStageSelect').val(),
                        '_token': '{{ csrf_token() }}'
                    },
                    success: function(response){
                        if(response === true){
                            $('#loadLoader').toggle('hidden');
                            Swal.fire({
                                title: 'Success',
                                text: 'Lead group successfully changed',
                                icon: 'success'
                            }).then(function(result){
                                if(result.isConfirmed){
                                    $('#loadLoader').toggle('hidden');
                                    location.reload();
                                }
                            });
                        }else{
                            Swal.fire({
                                title: 'Error',
                                text: 'An error has occured. Please contact the system administrator.',
                                icon: 'error'
                            });
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown){
                        $('#loadLoader').toggle('hidden');
                        Swal.fire({
                            title: 'Error',
                            text: 'An error has occured. Please contact the system administrator.',
                            icon: 'error'
                        });
                    }
                });
            });

            $('#massUpdateDealBtn').click(function(e){
                e.preventDefault();
                $('.lead-deal-modal').toggle('hidden');
                $('#loadLoader').toggle('hidden');

                $.ajax({
                    type: 'POST',
                    url: '{{ route('mass-update-deal') }}',
                    data: {
                        'pageIds[]': tokenArray,
                        'dealId': $('#dealSelect').val(),
                        '_token': '{{ csrf_token() }}'
                    },
                    success: function(response){
                        if(response === true){
                            $('#loadLoader').toggle('hidden');
                            Swal.fire({
                                title: 'Success',
                                text: 'Lead group successfully changed',
                                icon: 'success'
                            }).then(function(result){
                                if(result.isConfirmed){
                                    $('#loadLoader').toggle('hidden');
                                    location.reload();
                                }
                            });
                        }else{
                            Swal.fire({
                                title: 'Error',
                                text: 'An error has occured. Please contact the system administrator.',
                                icon: 'error'
                            });
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown){
                        $('#loadLoader').toggle('hidden');
                        Swal.fire({
                            title: 'Error',
                            text: 'An error has occured. Please contact the system administrator.',
                            icon: 'error'
                        });
                    }
                });
            });

            $('#addBtn').click(function(){
                $('.add').toggle('hidden');
            });

            $('#cancelAddBtn').click(function(){
                $('.add').toggle('hidden');
            });

            <?php $maxLeads = count($groupleads);
                for($i = 0; $i < $maxLeads; $i++){ ?>
                    $('#checkboxItem<?php echo $i; ?>').change(function() {
                        var value = $(this).val();

                        if ($(this).is(':checked')) {
                            tokenArray.push(value);
                        } else {
                            var index = tokenArray.indexOf(value);
                            if (index !== -1) {
                                tokenArray.splice(index, 1);
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
