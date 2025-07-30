@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/my-leads.css') }}">
@endsection

@section('title', 'My Leads | 2xMyLeads')

@section('content')
    <div class="grid grid-cols-1 px-2">
        <div class="col-span-1 lg:col-end-12">
            <div>
                <label for="email" class="block text-sm font-medium leading-6 text-gray-900">Search</label>
                <div class="mt-2">
                    <input type="text" id="searchbar" class="block w-60 rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" placeholder="Search lead">
                </div>
            </div>
        </div>
    </div>

    @can('mini_funnel')
    <form id="filterForm">
        @csrf
        <div class="border border-gray-200 bg-white px-4 py-4 sm:px-6 mt-4">
            <div class="grid lg:grid-rows-1">
                <div class="grid grid-cols-4 lg:grid-cols-4 gap-4">
                    <div class="col-span-4 lg:col-span-1 lg:mt-6">
                        <input type="checkbox" name="withEmail" class="appearance-none checked:bg-blue-500" />
                        <label class="text-xs text-gray-500 ml-2">With Email</label>
                    </div>
                    <div class="col-span-4 lg:col-span-1">
                        <label class="text-xs text-gray-500 ml-2">Group</label>
                        <select name="groups" class="block w-full lg:w-40 rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                            <option value="" selected disabled>Select group</option>
                            @foreach ($organizations as $organization)
                                <option value="{{ $organization->id }}">{{ $organization->organization_name }}</option>
                            @endforeach
                            @foreach ($myOrganizations as $myOrg)
                                <option value="{{ $myOrg->id }}">{{ $myOrg->organization_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-span-4 lg:col-span-1">
                        <label class="text-xs text-gray-500 ml-2">Customer value stage</label>
                        <select name="pipelines" class="block w-full lg:w-40 rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                            <option value="" selected disabled>Select stage</option>
                            @foreach ($leadgroups as $leadgroup)
                                <option value="{{ $leadgroup->id }}">{{ $leadgroup->lead_group_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-span-4 lg:col-span-1 lg:mt-4 mt-4">
                        <div class="mt-2 flex justify-between">
                            <button type="submit" class="rounded w-20 lg:w-24 bg-pipexblue px-2 py-1 text-sm font-semibold text-white shadow-sm hover:bg-blue-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Apply</button>
                            <button type="button" id="resetFilter" class="rounded w-20 lg:w-24 bg-gray-600 px-2 py-1 text-sm font-semibold text-white shadow-sm hover:bg-gray-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Reset</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
    @endcan

    @if (!$leads->isEmpty())
    <div class="border border-gray-200 bg-white px-4 py-5 sm:px-6 mt-4">
        <div class="grid grid-cols-2">
            <div class="col-span-2 space-x-4">
                <input type="checkbox" class="appearance-none checked:bg-blue-500" id="selectAll">
                <label class="text-xs text-gray-500 ml-2">Select all</label>
            </div>
            <div class="col-span-2 lg:col-span-1 lg:flex lg:space-x-4 lg:col-end-7 mt-2 lg:mt-0">
                <button type="button" id="exportBtn" class="inline-flex items-center gap-x-1.5 rounded-md bg-pipexblue px-2.5 py-1.5 text-xs font-semibold text-white shadow-sm hover:bg-blue-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="-ml-0.5 h-5 w-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m.75 12l3 3m0 0l3-3m-3 3v-6m-1.5-9H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                    </svg>
                    CSV
                </button>
                <button type="button" id="updateBtn" class="inline-flex items-center gap-x-1.5 rounded-md bg-pipexblue px-2.5 py-1.5 text-sm font-semibold text-white shadow-sm hover:bg-blue-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="-ml-0.5 h-5 w-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125" />
                    </svg>
                    Update stage
                </button>
                <button type="button" id="deleteBtn" class="inline-flex items-center gap-x-1.5 rounded-md bg-red-500 px-2.5 py-1.5 text-sm font-semibold text-white shadow-sm hover:bg-red-800 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="-ml-0.5 h-5 w-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                      </svg>
                    Delete lead
                </button>
            </div>
        </div>
        <div class="mt-4">
            <ul role="list" id="leadList" class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
                @php
                    $i = 0;
                @endphp
                @foreach ($leads as $lead)
                <li class="border col-span-1 divide-y divide-gray-200 rounded-lg bg-white shadow">
                    <div class="flex w-full items-center justify-between space-x-6 p-6">
                        <div>
                            <input type="checkbox" name="secretToken[]" id="checkboxItem{{ $i }}" value="{{ $lead->id }}" class="appearance-none checked:bg-blue-500 checkbox-item">
                        </div>
                        <div class="flex-1 truncate">
                            <div class="flex items-center space-x-3">
                                <a href="{{ route('lead-profile', $lead->id) }}" class="truncate text-sm font-medium text-gray-900">{{ $lead->lead_name }}</a>
                            </div>
                            <p class="mt-1 truncate text-sm text-gray-500">{{ isset($lead->email) ? trim(str_replace(['[', ']', '"'], '', $lead->email)) : 'No email' }}</p>
                            <span class="inline-flex flex-shrink-0 items-center rounded-full bg-{{ $lead->lead_class_name }} px-1.5 py-0.5 text-xs text-white ring-1 ring-green-600/20">{{ $lead->lead_group_name }}</span>
                        </div>
                        <div class="grid grid-rows-2">
                            <div class="relative">
                                <button type="button" class="-m-2.5 p-2.5 flex text-gray-400 hover:text-gray-500" id="menu-button{{ $i }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-6 w-6 mr-1">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.75a.75.75 0 110-1.5.75.75 0 010 1.5zM12 12.75a.75.75 0 110-1.5.75.75 0 010 1.5zM12 18.75a.75.75 0 110-1.5.75.75 0 010 1.5z" />
                                    </svg>
                                </button>
                                <div class="hidden absolute right-0 z-10 mt-2.5 w-36 origin-top-right rounded-md bg-white shadow-lg ring-1 ring-gray-900/5 focus:outline-none" id="menu-dropdown{{ $i }}" role="menu" aria-orientation="vertical" aria-labelledby="notification-menu-button" tabindex="-1">
                                    <div class="bg-white py-4 px-4 sm:px-6">
                                        <ul class="flex flex-1 flex-col gap-y-1">
                                            <li><a href="{{ route('delete-lead', $lead->id) }}" class="text-red-500 hover:text-red-800 text-xs text-center">Delete</a></li>
                                            <li><button type="button" id="updateStageBtn{{ $i }}" data-id="{{ $lead->id }}" class="text-xs hover:text-blue-800 text-blue-500">Update stage</button></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <img class="h-10 w-10 flex-shrink-0 rounded-full bg-gray-300" src="{{ isset($lead->lead_photo) ? $lead->lead_photo : asset('img/org.png') }}" alt="">
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="-mt-px flex divide-x divide-gray-200">
                            <div class="flex w-0 flex-1">
                                @if (isset($lead->link))
                                <a href="{{ $lead->link }}" target="_blank" class="relative -mr-px inline-flex w-0 flex-1 items-center justify-center gap-x-3 rounded-bl-lg border border-transparent py-4 text-xs font-semibold text-gray-900">Facebook</a>
                                @else
                                <a class="line-through pointer-events-none disabled:opacity-50 disabled:cursor-not-allowed relative -mr-px inline-flex w-0 flex-1 items-center justify-center gap-x-3 rounded-bl-lg border border-transparent py-4 text-xs font-semibold text-gray-900">Facebook</a>
                                @endif
                            </div>
                            <div class="-ml-px flex w-0 flex-1">
                                @if (isset($lead->website))
                                    @if (substr($lead->website, 0, 8) !== 'https://' && substr($lead->website, 0, 7) !== 'http://')
                                        <?php $lead->website = 'https://' . $lead->website; ?>
                                    @endif
                                <a href="{{ $lead->website }}" target="_blank" class="relative -mr-px inline-flex w-0 flex-1 items-center justify-center gap-x-3 rounded-bl-lg border border-transparent py-4 text-xs font-semibold text-gray-900">Website</a>
                                @else
                                <a class="line-through pointer-events-none disabled:opacity-50 disabled:cursor-not-allowed relative -mr-px inline-flex w-0 flex-1 items-center justify-center gap-x-3 rounded-bl-lg border border-transparent py-4 text-xs font-semibold text-gray-900">Website</a>
                                @endif
                            </div>
                            <div class="-ml-px flex w-0 flex-1">
                                @if (isset($lead->linkedin))
                                <a href="{{ $lead->linkedin }}" target="_blank" class="relative -mr-px inline-flex w-0 flex-1 items-center justify-center gap-x-3 rounded-bl-lg border border-transparent py-4 text-xs font-semibold text-gray-900">LinkedIn</a>
                                @else
                                <a class="line-through pointer-events-none disabled:opacity-50 disabled:cursor-not-allowed relative -mr-px inline-flex w-0 flex-1 items-center justify-center gap-x-3 rounded-bl-lg border border-transparent py-4 text-xs font-semibold text-gray-900">LinkedIn</a>
                                @endif
                            </div>
                            @can('create_audit')
                            <div class="-ml-px flex w-0 flex-1">
                                <a href="{{ route('audit-page', $lead->id) }}" class="relative inline-flex w-0 flex-1 items-center justify-center gap-x-3 rounded-br-lg border border-transparent py-4 text-xs font-semibold text-gray-900">Audit</a>
                            </div>
                            @endcan
                            @can('create_email')
                                @if ($currentUser->hasRole('Free'))
                                    @if (isset($dashCount->contact_count) < 50)
                                        <div class="-ml-px flex w-0 flex-1">
                                            <a href="{{ route('lead-email-page', $lead->id) }}" class="relative inline-flex w-0 flex-1 items-center justify-center gap-x-3 rounded-br-lg border border-transparent py-4 text-xs font-semibold text-gray-900">Message</a>
                                        </div>
                                    @elseif($currentUser->hasRole('Freelancer'))
                                        <div class="-ml-px flex w-0 flex-1">
                                            <a href="{{ route('lead-email-page', $lead->id) }}" class="relative inline-flex w-0 flex-1 items-center justify-center gap-x-3 rounded-br-lg border border-transparent py-4 text-xs font-semibold text-gray-900">Message</a>
                                        </div>
                                    @else
                                        <a class="line-through pointer-events-none disabled:opacity-50 disabled:cursor-not-allowed relative -mr-px inline-flex w-0 flex-1 items-center justify-center gap-x-3 rounded-bl-lg border border-transparent py-4 text-xs font-semibold text-gray-900">Message</a>
                                    @endif
                                @else
                                    <div class="-ml-px flex w-0 flex-1">
                                        <a href="{{ route('lead-email-page', $lead->id) }}" class="relative inline-flex w-0 flex-1 items-center justify-center gap-x-3 rounded-br-lg border border-transparent py-4 text-xs font-semibold text-gray-900">Message</a>
                                    </div>
                                @endif
                            @endcan
                        </div>
                    </div>
                </li>
                @php
                    $i++;
                @endphp
                @endforeach
            </ul>
            <div class="flex justify-center mt-2 lead-pagination">
                {{ $leads->links('vendor.pagination.paginate') }}
            </div>
            <div class="grid grid-rows-2 place-items-center hidden" id="emptyLeads">
                <div>
                    <img src="{{ asset('img/no_data.png') }}" class="w-28 mt-2" alt="no data">
                </div>
                <div>
                    <p class="text-gray-500 text-sm">No data yet.</p>
                </div>
            </div>
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

    <div class="relative z-10 update-single-stage hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>
        <div class="fixed inset-0 z-10 overflow-y-auto">
            <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                <div class="relative transform overflow-hidden rounded-lg bg-white px-4 pb-4 pt-5 text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg sm:p-6">
                    <div>
                        <h3 class="text-base font-semibold leading-6 text-gray-900">Update lead stage</h3>
                    </div>
                    <form action="{{ route('update-single-lead-stage') }}" method="POST">
                        @csrf
                        <input type="hidden" name="leadid" id="leadid">
                        <div class="mt-4">
                            <label class="text-xs text-gray-500 ml-2">Stages</label>
                            <select name="stage" id="newStage" required class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                <option value="" selected disabled>Select stage</option>
                                @foreach ($leadgroups as $group)
                                    <option value="{{ $group->id }}">{{ $group->lead_group_name }}</option>
                                @endforeach
                                @if ($myleadgroups)
                                    @foreach ($myleadgroups as $mygroup)
                                        <option value="{{ $mygroup->id }}">{{ $mygroup->lead_group_name }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="mt-4 hidden lost-reason-section">
                            <label class="text-xs text-gray-500 ml-2">Lost Reason</label>
                            <select name="reason" id="lostReason" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                <option value="" selected disabled>Select reason</option>
                                @foreach ($reasons as $reason)
                                    <option value="{{ $reason->id }}">{{ $reason->reason }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mt-5 sm:mt-6 sm:grid sm:grid-flow-row-dense sm:grid-cols-2 sm:gap-3">
                            <button type="submit" class="inline-flex w-full justify-center rounded-md bg-pipexblue px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-blue-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 sm:col-start-2">Update</button>
                            <button type="button" id="cancel-update" class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:col-start-1 sm:mt-0">Cancel</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

    <div class="relative z-10 update-modal hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>
        <div class="fixed inset-0 z-10 overflow-y-auto">
            <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                <div class="relative transform overflow-hidden rounded-lg bg-white px-4 pb-4 pt-5 text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg sm:p-6">
                    <div>
                        <h3 class="text-base font-semibold leading-6 text-gray-900">Update lead stage</h3>
                    </div>
                    <form id="moveFrm">
                        <div class="mt-4">
                            <label class="text-xs text-gray-500 ml-2">Stages</label>
                            <select name="stage" id="newStageBulk" required class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                <option value="" selected disabled>Select stage</option>
                                @foreach ($leadgroups as $group)
                                    <option value="{{ $group->id }}">{{ $group->lead_group_name }}</option>
                                @endforeach
                                @if ($myleadgroups)
                                    @foreach ($myleadgroups as $mygroup)
                                        <option value="{{ $mygroup->id }}">{{ $mygroup->lead_group_name }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="mt-4 hidden lost-reason-bulk-section">
                            <label class="text-xs text-gray-500 ml-2">Lost Reason</label>
                            <select name="reason" id="lostReasonBulk" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                <option value="" selected disabled>Select reason</option>
                                @foreach ($reasons as $reason)
                                    <option value="{{ $reason->id }}">{{ $reason->reason }}</option>
                                @endforeach
                            </select>
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
    @include('sweetalert::alert')
@endsection

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function() {
            var tokenArray = [];

            <?php $maxLeads = count($leads);
                for($i = 0; $i < $maxLeads; $i++) { ?>
                    $('#checkboxItem<?php echo $i; ?>').change(function(){
                        var value = $(this).val();
                        if ($(this).is(':checked')) {
                            tokenArray.push(value);
                        } else {
                            var index = tokenArray.indexOf(value);
                            if (index !== -1) {
                                tokenArray.splice(index, 1);
                            }
                        }
                    });

                    $('#menu-button<?php echo $i; ?>').click(function(){
                        $('#menu-dropdown<?php echo $i; ?>').toggle('hidden');
                    });

                    $('#updateStageBtn<?php echo $i; ?>').click(function(){
                        $('#menu-dropdown<?php echo $i; ?>').toggle('hidden');
                        $('.update-single-stage').toggle('hidden');
                        $('#leadid').val($(this).data('id'));
                    });
            <?php } ?>

            $('#newStage').change(function(){
                if($(this).val() == 15){
                    $('.lost-reason-section').removeClass('hidden');
                }else{
                    $('.lost-reason-section').addClass('hidden');
                }
            });

            $('#newStageBulk').change(function(){
                if($(this).val() == 15){
                    $('.lost-reason-bulk-section').removeClass('hidden');
                }else{
                    $('.lost-reason-bulk-section').addClass('hidden');
                }
            });

            $('#cancel-update').click(function(){
                $('.update-single-stage').toggle('hidden');
            });

            $('#searchbar').keyup(function() {
                $.ajax({
                    url: '{{ route('search-my-lead') }}',
                    type: 'POST',
                    data: {
                        lead_name: $('#searchbar').val(),
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        if(response.length > 0){
                            $('#emptyLeads').addClass('hidden');
                            $('#leadList').html('');
                            $('.lead-pagination').addClass('hidden');
                            var counter = 0;
                            $.each(response, function(index, lead) {
                                var email = lead.email ? lead.email : 'No email';
                                var photo = lead.lead_photo ? lead.lead_photo : '{{ asset('img/org.png') }}';
                                var website = lead.website;
                                var disableWebsite = lead.website ? '' : 'line-through pointer-events-none disabled:opacity-50 disabled:cursor-not-allowed';
                                var disableLeadLink = lead.link ? '' : 'line-through pointer-events-none disabled:opacity-50 disabled:cursor-not-allowed';
                                var disableLinkedIn = lead.linkedin ? '' : 'line-through pointer-events-none disabled:opacity-50 disabled:cursor-not-allowed';
                                if(!website){
                                    website = '#';
                                }else{
                                    if(!website.startsWith('https://') && !website.startsWith('http://')){
                                        website = 'https://' + website;
                                    }
                                }
                                $('#leadList').append(`
                                    <li class="border col-span-1 divide-y divide-gray-200 rounded-lg bg-white shadow">
                                        <div class="flex w-full items-center justify-between space-x-6 p-6">
                                            <div>
                                                <input type="checkbox" name="secretToken[]" id="checkboxSelector`+counter+`" value="`+lead.id+`" class="appearance-none checked:bg-blue-500 checkbox-item" id="selectAll">
                                            </div>
                                            <div class="flex-1 truncate">
                                                <div class="flex items-center space-x-3">
                                                    <h3 class="truncate text-sm font-medium text-gray-900">`+lead.lead_name+`</h3>
                                                </div>
                                                <p class="mt-1 truncate text-sm text-gray-500">`+email.replace(/[\[\]"']/g, '')+`</p>
                                                <span class="inline-flex flex-shrink-0 items-center rounded-full bg-`+lead.lead_class_name+` px-1.5 py-0.5 text-xs text-white ring-1 ring-green-600/20">`+lead.lead_group_name+`</span>
                                            </div>
                                            <div class="grid grid-rows-2">
                                                <div>
                                                    <a href="/leads/delete-lead/`+lead.id+`" class="flex items-center justify-center text-red-500 px-2 py-1 text-xs font-semibold hover:text-red-800">
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                                        </svg>
                                                    </a>
                                                </div>
                                                <div>
                                                    <img class="h-10 w-10 flex-shrink-0 rounded-full bg-gray-300" src="`+photo+`">
                                                </div>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="-mt-px flex divide-x divide-gray-200">
                                                <div class="flex w-0 flex-1">
                                                    <a href="`+lead.link+`" target="_blank" class="`+disableLeadLink+`relative -mr-px inline-flex w-0 flex-1 items-center justify-center gap-x-3 rounded-bl-lg border border-transparent py-4 text-xs font-semibold text-gray-900">Facebook</a>
                                                </div>
                                                <div class="-ml-px flex w-0 flex-1">
                                                    <a href="`+website+`" target="_blank" class="`+disableWebsite+`relative -mr-px inline-flex w-0 flex-1 items-center justify-center gap-x-3 rounded-bl-lg border border-transparent py-4 text-xs font-semibold text-gray-900">Website</a>
                                                </div>
                                                <div class="-ml-px flex w-0 flex-1">
                                                    <a href="`+lead.linkedin+`" target="_blank" class="`+disableLinkedIn+`relative -mr-px inline-flex w-0 flex-1 items-center justify-center gap-x-3 rounded-bl-lg border border-transparent py-4 text-xs font-semibold text-gray-900">LinkedIn</a>
                                                </div>
                                                @can('create_audit')
                                                <div class="-ml-px flex w-0 flex-1">
                                                    <a href="{{ url('/audits/lead/`+lead.id+`') }}" class="relative inline-flex w-0 flex-1 items-center justify-center gap-x-3 rounded-br-lg border border-transparent py-4 text-xs font-semibold text-gray-900">Audit</a>
                                                </div>
                                                @endcan
                                                @can('create_email')
                                                    @if ($currentUser->hasRole('Free'))
                                                        @if (isset($dashCount->contact_count) < 50)
                                                            <div class="-ml-px flex w-0 flex-1">
                                                                <a href="{{ url('/leads/email/el/`+lead.id+`') }}" class="relative inline-flex w-0 flex-1 items-center justify-center gap-x-3 rounded-br-lg border border-transparent py-4 text-xs font-semibold text-gray-900">Email</a>
                                                            </div>
                                                        @elseif($currentUser->hasROle('Freelancer'))
                                                            <div class="-ml-px flex w-0 flex-1">
                                                                <a href="{{ url('/leads/email/el/`+lead.id+`') }}" class="relative inline-flex w-0 flex-1 items-center justify-center gap-x-3 rounded-br-lg border border-transparent py-4 text-xs font-semibold text-gray-900">Email</a>
                                                            </div>
                                                        @else
                                                            <a class="line-through pointer-events-none disabled:opacity-50 disabled:cursor-not-allowed relative -mr-px inline-flex w-0 flex-1 items-center justify-center gap-x-3 rounded-bl-lg border border-transparent py-4 text-xs font-semibold text-gray-900">Email</a>
                                                        @endif
                                                    @else
                                                        <div class="-ml-px flex w-0 flex-1">
                                                            <a href="{{ url('/leads/email/el/`+lead.id+`') }}" class="relative inline-flex w-0 flex-1 items-center justify-center gap-x-3 rounded-br-lg border border-transparent py-4 text-xs font-semibold text-gray-900">Email</a>
                                                        </div>
                                                    @endif
                                                @endcan
                                            </div>
                                        </div>
                                    </li>
                                `);
                                counter++;
                            });

                            for(var x = 0; x < counter; x++){
                                $('#checkboxSelector'+x).change(function(){
                                    var value = $(this).val();
                                    if ($(this).is(':checked')) {
                                        tokenArray.push(value);
                                    } else {2232323
                                        var index = tokenArray.indexOf(value);
                                        if (index !== -1) {
                                            tokenArray.splice(index, 1);
                                        }
                                    }
                                });
                            }
                        }else{
                            $('#leadList').html('');
                            $('.lead-pagination').addClass('hidden');
                            $('#emptyLeads').removeClass('hidden');
                        }
                    }
                });
            });

            $('#filterForm').submit(function(e) {
                e.preventDefault();
                $.ajax({
                    url: '{{ route('filter-my-lead') }}',
                    type: 'POST',
                    data: $('#filterForm').serialize(),
                    success: function(response) {
                        if(response.length > 0){
                            $('#emptyLeads').addClass('hidden');
                            $('#leadList').html('');
                            $('.lead-pagination').addClass('hidden');
                            var counter = 0;
                            $.each(response, function(index, lead) {
                                var email = lead.email ? lead.email : 'No email';
                                var photo = lead.lead_photo ? lead.lead_photo : '{{ asset('img/org.png') }}';
                                var website = lead.website;
                                var disableWebsite = lead.website ? '' : 'line-through pointer-events-none disabled:opacity-50 disabled:cursor-not-allowed';
                                var disableLeadLink = lead.link ? '' : 'line-through pointer-events-none disabled:opacity-50 disabled:cursor-not-allowed';
                                var disableLinkedIn = lead.linkedin ? '' : 'line-through pointer-events-none disabled:opacity-50 disabled:cursor-not-allowed';
                                if(!website){
                                    webiste = '#';
                                }else{
                                    if(!website.startsWith('https://') && !website.startsWith('http://')){
                                        website = 'https://' + website;
                                    }
                                }
                                $('#leadList').append(`
                                    <li class="border col-span-1 divide-y divide-gray-200 rounded-lg bg-white shadow">
                                        <div class="flex w-full items-center justify-between space-x-6 p-6">
                                            <div>
                                                <input type="checkbox" name="secretToken[]" id="checkboxSelector`+counter+`" value="`+lead.id+`" class="appearance-none checked:bg-blue-500 checkbox-item" id="selectAll">
                                            </div>
                                            <div class="flex-1 truncate">
                                                <div class="flex items-center space-x-3">
                                                    <h3 class="truncate text-sm font-medium text-gray-900">`+lead.lead_name+`</h3>
                                                </div>
                                                <p class="mt-1 truncate text-sm text-gray-500">`+email.replace(/[\[\]"']/g, '')+`</p>
                                                <span class="inline-flex flex-shrink-0 items-center rounded-full bg-`+lead.lead_class_name+` px-1.5 py-0.5 text-xs text-white ring-1 ring-green-600/20">`+lead.lead_group_name+`</span>
                                            </div>
                                            <div class="grid grid-rows-2">
                                                <div>
                                                    <a href="/leads/delete-lead/`+lead.id+`" class="flex items-center justify-center text-red-500 px-2 py-1 text-xs font-semibold hover:text-red-800">
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                                        </svg>
                                                    </a>
                                                </div>
                                                <div>
                                                    <img class="h-10 w-10 flex-shrink-0 rounded-full bg-gray-300" src="`+photo+`">
                                                </div>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="-mt-px flex divide-x divide-gray-200">
                                                <div class="flex w-0 flex-1">
                                                    <a href="`+lead.link+`" target="_blank" class="`+disableLeadLink+`relative -mr-px inline-flex w-0 flex-1 items-center justify-center gap-x-3 rounded-bl-lg border border-transparent py-4 text-xs font-semibold text-gray-900">Facebook</a>
                                                </div>
                                                <div class="-ml-px flex w-0 flex-1">
                                                    <a href="`+website+`" target="_blank" class="`+disableWebsite+`relative -mr-px inline-flex w-0 flex-1 items-center justify-center gap-x-3 rounded-bl-lg border border-transparent py-4 text-xs font-semibold text-gray-900">Website</a>
                                                </div>
                                                <div class="-ml-px flex w-0 flex-1">
                                                    <a href="`+lead.linkedin+`" target="_blank" class="`+disableLinkedIn+`relative -mr-px inline-flex w-0 flex-1 items-center justify-center gap-x-3 rounded-bl-lg border border-transparent py-4 text-xs font-semibold text-gray-900">LinkedIn</a>
                                                </div>
                                                @can('create_audit')
                                                <div class="-ml-px flex w-0 flex-1">
                                                    <a href="{{ url('/audits/lead/`+lead.id+`') }}" class="relative inline-flex w-0 flex-1 items-center justify-center gap-x-3 rounded-br-lg border border-transparent py-4 text-xs font-semibold text-gray-900">Audit</a>
                                                </div>
                                                @endcan
                                                @can('create_email')
                                                    @if ($currentUser->hasRole('Free'))
                                                        @if (isset($dashCount->contact_count) < 50)
                                                            <div class="-ml-px flex w-0 flex-1">
                                                                <a href="{{ url('/leads/email/el/`+lead.id+`') }}" class="relative inline-flex w-0 flex-1 items-center justify-center gap-x-3 rounded-br-lg border border-transparent py-4 text-xs font-semibold text-gray-900">Email</a>
                                                            </div>
                                                        @elseif($currentUser->hasROle('Freelancer'))
                                                            <div class="-ml-px flex w-0 flex-1">
                                                                <a href="{{ url('/leads/email/el/`+lead.id+`') }}" class="relative inline-flex w-0 flex-1 items-center justify-center gap-x-3 rounded-br-lg border border-transparent py-4 text-xs font-semibold text-gray-900">Email</a>
                                                            </div>
                                                        @else
                                                            <a class="line-through pointer-events-none disabled:opacity-50 disabled:cursor-not-allowed relative -mr-px inline-flex w-0 flex-1 items-center justify-center gap-x-3 rounded-bl-lg border border-transparent py-4 text-xs font-semibold text-gray-900">Email</a>
                                                        @endif
                                                    @else
                                                        <div class="-ml-px flex w-0 flex-1">
                                                            <a href="{{ url('/leads/email/el/`+lead.id+`') }}" class="relative inline-flex w-0 flex-1 items-center justify-center gap-x-3 rounded-br-lg border border-transparent py-4 text-xs font-semibold text-gray-900">Email</a>
                                                        </div>
                                                    @endif
                                                @endcan
                                            </div>
                                        </div>
                                    </li>
                                `);
                                counter++;
                            });

                            for(var x = 0; x < counter; x++){
                                $('#checkboxSelector'+x).change(function(){
                                    var value = $(this).val();
                                    if ($(this).is(':checked')) {
                                        tokenArray.push(value);
                                    } else {
                                        var index = tokenArray.indexOf(value);
                                        if (index !== -1) {
                                            tokenArray.splice(index, 1);
                                        }
                                    }
                                });
                            }
                        }else{
                            $('#leadList').html('');
                            $('.lead-pagination').addClass('hidden');
                            $('#emptyLeads').removeClass('hidden');
                        }
                    }
                });
            });

            $('#updateBtn').click(function(e){
                if(tokenArray.length > 0){
                    $('.update-modal').toggle('hidden');
                }else{
                    Swal.fire({
                        title: 'Error',
                        text: 'No leads selected',
                        icon: 'error'
                    });
                }
            });

            $('#moveFrm').submit(function(e) {
                e.preventDefault();
                if (tokenArray.length > 0) {
                    $.ajax({
                        url: '{{ route('update-lead-stage') }}',
                        method: 'POST',
                        data: {
                            'secretToken[]': tokenArray,
                            'lead_group_id': $('#newStageBulk').val(),
                            'reason': $('#lostReasonBulk').val(),
                            '_token': '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            location.reload();
                        }
                    })
                }
            });

            $('#resetFilter').click(function() {
                document.getElementById("filterForm").reset();
            });

            $('#selectAll').change(function() {
                if ($(this).is(':checked')) {
                    $('.checkbox-item').prop('checked', true);
                    $('input[name="secretToken[]"]:checked').each(function() {
                        tokenArray.push($(this).val());
                    });
                } else {
                    $('.checkbox-item').prop('checked', false);
                    $('input[name="secretToken[]"]:not(:checked)').each(function() {
                        var index = tokenArray.indexOf($(this).val());
                        if (index !== -1) {
                            tokenArray.splice(index, 1);
                        }
                    });
                }
            });

            $('#exportBtn').click(function() {
                if(tokenArray.length > 0){
                    $.ajax({
                        url: '{{ route('export-to-csv') }}',
                        method: 'POST',
                        data: {
                            'secretToken[]': tokenArray,
                            '_token': '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            var downloadLink = document.createElement('a');
                            downloadLink.href = 'data:text/csv;charset=utf-8,' + encodeURIComponent(response);
                            downloadLink.download = '2xMyLeads.csv';
                            downloadLink.click();
                        }
                    });
                }else{
                    Swal.fire({
                        title: 'Error',
                        text: 'No leads selected',
                        icon: 'error'
                    });
                }
            });

            $('#deleteBtn').click(function(){
                if(tokenArray.length > 0){
                    $.ajax({
                        url: '{{ route('mass-remove-leads') }}',
                        method: 'POST',
                        data: {
                            'secretToken[]': tokenArray,
                            '_token': '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            if(response === true){
                                Swal.fire({
                                    title: 'Success',
                                    text: 'Successfully deleted leads.',
                                    icon: 'success'
                                }).then(function(result){
                                    if(result.isConfirmed){
                                        location.reload();
                                    }
                                });
                            }else{
                                Swal.fire({
                                    title: 'Error',
                                    text: 'An error has occured. Please contact your system administrator.',
                                    icon: 'error'
                                });
                            }
                        },
                        error: function(jqXHR, textStatus, errorThrown){
                        }
                    });
                }else{
                    Swal.fire({
                        title: 'Error',
                        text: 'No leads selected',
                        icon: 'error'
                    });
                }
            })

            $('#cancelBtn').click(function(){
                $('.update-modal').toggle('hidden');
            });
        });
    </script>
@endsection
