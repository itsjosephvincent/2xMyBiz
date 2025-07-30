@extends('layouts.app')

@section('css')
@endsection

@section('title', 'Pipeline View | 2xMyLeads')

@section('content')
    <div class="grid grid-cols-1 mb-8">
        <div class="col-span-1">
            <h6 class="text-lg font-medium">Pipeline view</h6>
        </div>
    </div>

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
                            @foreach ($orgs as $org)
                            <option value="{{ $org->id }}">{{ $org->organization_name }}</option>
                            @endforeach
                            @foreach ($myorgs as $myorg)
                            <option value="{{ $myorg->id }}">{{ $myorg->organization_name }}</option>
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

    <div class="border mt-4 border-gray-200 h-full bg-white w-full px-4 py-5 sm:px-6 flex flex-nowrap space-x-4 overflow-x-scroll" id="pipeline-view">
        @php
            $x = 0;
        @endphp
        @foreach ($leadgroups as $leadgroup)
        <div class="w-auto">
            <div class="divide-y divide-gray-200 rounded-lg overflow-hidden shadow">
                <div class="px-4 py-5 sm:px-6 bg-gray-200 w-60 bg-{{ $leadgroup->lead_class_name }}">
                    <p class="text-xs">{{ $leadgroup->lead_group_name }}</p>
                </div>
                <div class="sm:p-6 bg-gray-300 space-y-4 droppable h-80 overflow-y-scroll" id="stage{{ $x }}" data-id="{{ $leadgroup->id }}">
                    @php
                        $i = 0;
                    @endphp
                    @foreach ($leads as $lead)
                        @if ($lead->lead_group_id == $leadgroup->id)
                        <div class="rounded-md border-gray-200 bg-white px-2 py-5 sm:px-6" data-task-id="{{ $lead->id }}">
                            <input type="hidden" id="lead{{ $i }}" value="{{ $lead->id }}">
                            <div class="grid grid-cols-1 space-y-2">
                                <div class="flex justify-center">
                                    <img class="h-10 w-10 flex-shrink-0 rounded-full bg-gray-300" src="{{ isset($lead->lead_photo) ? $lead->lead_photo : asset('img/org.png') }}" alt="">
                                </div>
                                <div class="truncate text-center">
                                    <a href="{{ route('lead-profile', $lead->id) }}" class="text-xs text-pipexblue hover:text-blue-900">{{ $lead->lead_name }}</a>
                                </div>
                                @if ($lead->lead_group_id != 15)
                                <div class="flex justify-center">
                                    <button type="button" id="markBtn{{ $i }}" class="rounded bg-gray-100 px-2 py-1 text-xs font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-200">Mark lost</button>
                                </div>
                                @endif
                            </div>
                        </div>
                        @endif
                    @php
                        $i++;
                    @endphp
                    @endforeach
                </div>
            </div>
        </div>
        @php
            $x++;
        @endphp
        @endforeach
    </div>

    <div class="relative z-10 lost-modal hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>
        <div class="fixed inset-0 z-10 overflow-y-auto">
            <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                <div class="relative transform overflow-hidden rounded-lg bg-white px-4 pb-4 pt-5 text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg sm:p-6">
                    <form action="{{ route('mark-lost') }}" method="post">
                        @csrf
                        @method('PUT')
                        <div>
                            <div class="mx-auto flex h-12 w-12 items-center justify-center rounded-full bg-red-100">
                                <svg class="h-6 w-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" />
                                </svg>
                            </div>
                            <div class="mt-3 sm:mt-5">
                                <h3 class="text-base text-center font-semibold leading-6 text-gray-900" id="modal-title">Mark lead as lost</h3>
                                <div class="mt-2">
                                    <div>
                                        <input type="hidden" id="leadsecret" name="leadsecret">
                                        <label class="block text-sm font-medium leading-6 text-gray-900">Reason</label>
                                        <select name="reason" class="mt-2 block w-full rounded-md border-0 py-1.5 pl-3 pr-10 text-gray-900 ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                            <option value="" selected disabled>Select reason</option>
                                            @foreach ($reasons as $reason)
                                            <option value="{{ $reason->id }}">{{ $reason->reason }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mt-5 sm:mt-6 sm:grid sm:grid-flow-row-dense sm:grid-cols-2 sm:gap-3">
                            <button type="submit" class="inline-flex w-full justify-center rounded-md bg-red-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-red-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 sm:col-start-2">Submit</button>
                            <button type="button" id="cancelLostBtn" class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:col-start-1 sm:mt-0">Cancel</button>
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
            $('#cancelLostBtn').click(function(){
                $('.lost-modal').addClass('hidden');
            });

            $('.droppable').sortable({
                connectWith: '.droppable',
                placeholder: 'my-custom-placeholder-class',
                forcePlaceholderSize: true,
                stop: function(event, ui) {
                    var task_id = ui.item.data('task-id');
                    var lead_id = ui.item.parent().data('id');
                    var data = {
                        leads_id: lead_id,
                        _token: '{{ csrf_token() }}'
                    };
                    $.ajax({
                        url: '/leads/update-lead-group-id/' + task_id,
                        method: 'PUT',
                        data: data,
                        dataType: 'json',
                        success: function(response) {

                        },
                        error: function(xhr) {

                        }
                    });
                }
            });

            <?php $totalLeads = count($leads);
                for($i = 0; $i < $totalLeads; $i++){ ?>
                    $('#markBtn<?php echo $i; ?>').click(function(){
                        var value = $('#lead<?php echo $i; ?>').val();
                        $('.lost-modal').removeClass('hidden');
                        $('#leadsecret').val(value);
                    });
            <?php } ?>

            $('#filterForm').submit(function(e) {
                e.preventDefault();
                $.ajax({
                    url: '{{ route('filter-pipline') }}',
                    type: 'POST',
                    data: $('#filterForm').serialize(),
                    dataType: 'json',
                    success: function(response) {
                        <?php $maxStage = count($leadgroups);
                            for($i = 0; $i < $maxStage; $i++) { ?>
                                $('#stage<?php echo $i;?>').empty();
                                $.each(response, function(index, lead){
                                    if(lead.lead_group_id == $('#stage<?php echo $i;?>').data('id')){
                                        var leadHtml = `
                                        <div class="rounded-md border-gray-200 bg-white px-2 py-5 sm:px-6" data-task-id="${lead.id}">
                                            <input type="hidden" id="lead${index}" value="${lead.id}">
                                            <div class="grid grid-cols-1 space-y-2">
                                                <div class="flex justify-center">
                                                    <img class="h-10 w-10 flex-shrink-0 rounded-full bg-gray-300" src="${lead.lead_photo ? lead.lead_photo : asset('img/org.png')}" alt="">
                                                </div>
                                                <div class="truncate text-center">
                                                    <a href="/leads/lead-profile/p/${lead.id}" class="text-xs text-pipexblue hover:text-blue-900">${lead.lead_name}</a>
                                                </div>
                                                ${lead.lead_group_id != 15 ? `
                                                    <div class="flex justify-center">
                                                        <button type="button" id="markBtn${index}" class="rounded bg-gray-100 px-2 py-1 text-xs font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-200">Mark lost</button>
                                                    </div>
                                                ` : ''}
                                            </div>
                                        </div>
                                    `;
                                    $('#stage<?php echo $i;?>').append(leadHtml);
                                    }
                                });
                        <?php } ?>
                    },
                    error: function(error) {

                    }
                });
            });

            $('#resetFilter').click(function() {
                document.getElementById("filterForm").reset();
            });
        });
    </script>
@endsection
