@extends('layouts.app')

@section('title', 'Users and Roles - 2xMyLeads')

@section('content')
    <div class="grid grid-cols-1 lg:grid-cols-2 mb-8">
        <div class="flex justify-start">
            <h6 class="text-lg font-medium">Users & Roles</h6>
        </div>
        <div class="flex justify-end">
            <button type="button" id="createBtn" class="rounded-md bg-pipexblue px-2.5 py-1.5 text-sm font-semibold text-white shadow-sm hover:bg-blue-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Create user</button>
        </div>
    </div>

    <div class="border border-gray-200 bg-white px-4 py-5 sm:px-6">
        <div class="block">
            <div class="border-b border-gray-200">
                <nav class="-mb-px lg:flex lg:justify-center" aria-label="Tabs">
                    <a id="allBtn" class="cursor-pointer border-indigo-500 text-indigo-600 w-1/4 border-b-2 py-4 px-1 text-center text-sm font-medium">All Users</a>
                    <a id="activeBtn" class="cursor-pointer border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700 w-1/4 border-b-2 py-4 px-1 text-center text-sm font-medium">Active Users</a>
                    <a id="inactiveBtn" class="cursor-pointer border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700 w-1/4 border-b-2 py-4 px-1 text-center text-sm font-medium">Inactive Users</a>
                </nav>
            </div>
            <div class="all-users">
                <div class="grid grid-cols-1 px-8 lg:grid-cols-2 space-y-2 lg:space-y-0 mt-4">
                    <div class="lg:flex lg:justify-start">
                        <div>
                            <label class="block text-sm font-medium leading-6 text-gray-900">Search</label>
                            <div class="mt-2">
                                <input type="text" name="search" id="search-filter" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" placeholder="Search first name, or last name, or email">
                            </div>
                        </div>
                    </div>
                    <div class="lg:flex lg:justify-end">
                        <div class="flex place-items-center">
                            <button id="exportBtn" type="button" class="rounded-md w-full bg-white px-2.5 py-1.5 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-200">Export CSV</button>
                        </div>
                    </div>
                </div>
                <div class="px-4 sm:px-6 lg:px-8">
                    <div class="mt-2 flow-root">
                        <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                            <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                                <table class="min-w-full divide-y divide-gray-300">
                                    <thead>
                                        <tr>
                                            <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-0">
                                                <input type="checkbox" id="checkAll" class="filled-in">
                                            </th>
                                            <th scope="col" class="px-1 py-3.5 text-left text-sm font-semibold text-gray-900">Full name</th>
                                            <th scope="col" class="px-1 py-3.5 text-left text-sm font-semibold text-gray-900">Email</th>
                                            <th scope="col" class="px-1 py-3.5 text-left text-sm font-semibold text-gray-900">Role</th>
                                            <th scope="col" class="px-1 py-3.5 text-left text-sm font-semibold text-gray-900">Status</th>
                                            <th scope="col" class="px-1 py-3.5 text-left text-sm font-semibold text-gray-900">Last activity</th>
                                            <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-0">
                                                <span class="sr-only">Edit</span>
                                            </th>
                                        </tr>
                                    </thead>
                                    <form id="downloadFrm">
                                        <tbody class="divide-y divide-gray-200" id="userList">
                                            @foreach ($allmembers as $user)
                                            <tr>
                                                <td class="whitespace-nowrap py-2 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-0">
                                                    <input type="checkbox" name="idBox[]" value="{{ $user->id }}" class="checkbox-item">
                                                </td>
                                                <td class="whitespace-nowrap px-1 py-2 text-xs text-gray-500">{{ $user->first_name }} {{ $user->last_name }}</td>
                                                <td class="whitespace-nowrap px-1 py-2 text-xs text-gray-500">{{ $user->email }}</td>
                                                <td class="whitespace-nowrap px-1 py-2 text-xs text-gray-500">{{ $user->roles->pluck('name')->implode(', ') }}</td>
                                                <td class="whitespace-nowrap px-1 py-2 text-xs text-gray-500">{{ strtoupper($user->status) }}</td>
                                                <td class="whitespace-nowrap px-1 py-2 text-xs text-gray-500">{{ $user->last_login }}</td>
                                                <td class="whitespace-nowrap px-1 py-2 text-xs font-medium">
                                                    <a href="{{ route('get-user-profile', $user->id) }}" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                                                </td>
                                                <td class="whitespace-nowrap px-1 py-2 text-xs font-medium">
                                                    <a href="{{ route('login-as-user', $user->id) }}" class="text-indigo-600 hover:text-indigo-900">Login as user</a>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </form>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="flex justify-center mt-4 pagination-all">
                        {{ $allmembers->links('vendor.pagination.paginate') }}
                    </div>
                </div>
            </div>
            <div class="active-users hidden">
                <div class="grid grid-cols-1 px-8 lg:grid-cols-2 space-y-2 lg:space-y-0 mt-4">
                    <div class="lg:flex lg:justify-start">
                        <div>
                            <label class="block text-sm font-medium leading-6 text-gray-900">Search</label>
                            <div class="mt-2">
                                <input type="text" name="search" id="search-active-filter" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" placeholder="Search first name, or last name, or email">
                            </div>
                        </div>
                    </div>
                    <div class="lg:flex lg:justify-end">
                        <div class="flex place-items-center">
                            <button id="exportActvBtn" type="button" class="rounded-md w-full bg-white px-2.5 py-1.5 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-200">Export CSV</button>
                        </div>
                    </div>
                </div>
                <div class="px-4 sm:px-6 lg:px-8">
                    <div class="mt-2 flow-root">
                        <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                            <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                                <table class="min-w-full divide-y divide-gray-300">
                                    <thead>
                                        <tr>
                                            <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-0">
                                                <input type="checkbox" id="checkAllactive" class="filled-in">
                                            </th>
                                            <th scope="col" class="px-1 py-3.5 text-left text-sm font-semibold text-gray-900">Full name</th>
                                            <th scope="col" class="px-1 py-3.5 text-left text-sm font-semibold text-gray-900">Email</th>
                                            <th scope="col" class="px-1 py-3.5 text-left text-sm font-semibold text-gray-900">Role</th>
                                            <th scope="col" class="px-1 py-3.5 text-left text-sm font-semibold text-gray-900">Status</th>
                                            <th scope="col" class="px-1 py-3.5 text-left text-sm font-semibold text-gray-900">Last activity</th>
                                            <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-0">
                                                <span class="sr-only">Edit</span>
                                            </th>
                                        </tr>
                                    </thead>
                                    <form id="downloadActvFrm">
                                        <tbody class="divide-y divide-gray-200" id="actvuserList">
                                            @foreach ($activemembers as $active)
                                            <tr>
                                                <td class="whitespace-nowrap py-2 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-0">
                                                    <input type="checkbox" name="idActvBox[]" value="{{ $active->id }}" class="checkbox-active-item">
                                                </td>
                                                <td class="whitespace-nowrap px-1 py-2 text-xs text-gray-500">{{ $active->first_name }} {{ $active->last_name }}</td>
                                                <td class="whitespace-nowrap px-1 py-2 text-xs text-gray-500">{{ $active->email }}</td>
                                                <td class="whitespace-nowrap px-1 py-2 text-xs text-gray-500">{{ $active->roles->pluck('name')->implode(', ') }}</td>
                                                <td class="whitespace-nowrap px-1 py-2 text-xs text-gray-500">{{ strtoupper($active->status) }}</td>
                                                <td class="whitespace-nowrap px-1 py-2 text-xs text-gray-500">{{ $active->last_login }}</td>
                                                <td class="whitespace-nowrap px-1 py-2 text-xs font-medium">
                                                    <a href="{{ route('get-user-profile', $active->id) }}" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                                                </td>
                                                <td class="whitespace-nowrap px-1 py-2 text-xs font-medium">
                                                    <a href="{{ route('login-as-user', $active->id) }}" class="text-indigo-600 hover:text-indigo-900">Login as user</a>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </form>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="flex justify-center mt-4 pagination-active">
                        {{ $activemembers->links('vendor.pagination.paginate') }}
                    </div>
                </div>
            </div>
            <div class="inactive-users hidden">
                <div class="grid grid-cols-1 px-8 lg:grid-cols-2 space-y-2 lg:space-y-0 mt-4">
                    <div class="lg:flex lg:justify-start">
                        <div>
                            <label class="block text-sm font-medium leading-6 text-gray-900">Search</label>
                            <div class="mt-2">
                                <input type="text" name="search" id="search-inactive-filter" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" placeholder="Search first name, or last name, or email">
                            </div>
                        </div>
                    </div>
                    <div class="lg:flex lg:justify-end">
                        <div class="flex place-items-center">
                            <button id="exportInactvBtn" type="button" class="rounded-md w-full bg-white px-2.5 py-1.5 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-200">Export CSV</button>
                        </div>
                    </div>
                </div>
                <div class="px-4 sm:px-6 lg:px-8">
                    <div class="mt-8 flow-root">
                        <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                            <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                                <table class="min-w-full divide-y divide-gray-300">
                                    <thead>
                                        <tr>
                                            <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-0">
                                                <input type="checkbox" id="checkAllinactive" class="filled-in">
                                            </th>
                                            <th scope="col" class="px-1 py-3.5 text-left text-sm font-semibold text-gray-900">Full name</th>
                                            <th scope="col" class="px-1 py-3.5 text-left text-sm font-semibold text-gray-900">Email</th>
                                            <th scope="col" class="px-1 py-3.5 text-left text-sm font-semibold text-gray-900">Role</th>
                                            <th scope="col" class="px-1 py-3.5 text-left text-sm font-semibold text-gray-900">Status</th>
                                            <th scope="col" class="px-1 py-3.5 text-left text-sm font-semibold text-gray-900">Last activity</th>
                                            <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-0">
                                                <span class="sr-only">Edit</span>
                                            </th>
                                        </tr>
                                    </thead>
                                    <form id="downloadInactvFrm">
                                        <tbody class="divide-y divide-gray-200">
                                            @foreach ($inactivemembers as $inactive)
                                            <tr>
                                                <td class="whitespace-nowrap py-2 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-0">
                                                    <input type="checkbox" name="idInactvBox[]" value="{{ $inactive->id }}" class="checkbox-item">
                                                </td>
                                                <td class="whitespace-nowrap px-1 py-2 text-xs text-gray-500">{{ $inactive->first_name }} {{ $inactive->last_name }}</td>
                                                <td class="whitespace-nowrap px-1 py-2 text-xs text-gray-500">{{ $inactive->email }}</td>
                                                <td class="whitespace-nowrap px-1 py-2 text-xs text-gray-500">{{ $inactive->roles->pluck('name')->implode(', ') }}</td>
                                                <td class="whitespace-nowrap px-1 py-2 text-xs text-gray-500">{{ strtoupper($inactive->status) }}</td>
                                                <td class="whitespace-nowrap px-1 py-2 text-xs text-gray-500">{{ $inactive->last_login }}</td>
                                                <td class="relative whitespace-nowrap py-2 pl-3 pr-4 text-xs font-medium sm:pr-0">
                                                    <a href="{{ route('get-user-profile', $inactive->id) }}" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </form>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="flex justify-center mt-4 pagination-inactive">
                        {{ $inactivemembers->links('vendor.pagination.paginate') }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="relative z-10 new-user-modal hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>
        <div class="fixed inset-0 z-10 overflow-y-auto">
            <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                <div class="relative transform overflow-hidden rounded-lg bg-white px-4 pb-4 pt-5 text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg sm:p-6">
                    <form id="newUserFrm">
                        @csrf
                        <div>
                            <h3 class="text-base font-semibold leading-6 text-gray-900" id="modal-title">Create new user</h3>
                            <div class="mt-3 sm:mt-5">
                                <div>
                                    <label class="block text-sm font-medium leading-6 text-gray-900">First name</label>
                                    <div class="mt-1">
                                    <input type="text" name="first_name" required class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                    </div>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium leading-6 text-gray-900">Last name</label>
                                    <div class="mt-1">
                                    <input type="text" name="last_name" required class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                    </div>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium leading-6 text-gray-900">Email</label>
                                    <div class="mt-1">
                                    <input type="email" name="email" required class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                    </div>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium leading-6 text-gray-900">Password</label>
                                    <div class="mt-1">
                                    <input type="password" name="password" required class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                    </div>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium leading-6 text-gray-900">Role</label>
                                    <select name="role" class="mt-1 block w-full rounded-md border-0 py-1.5 pl-3 pr-10 text-gray-900 ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                        <option value="" disabled selected>Select a role</option>
                                        <option value="Admin">Admin</option>
                                        <option value="Free">Free</option>
                                        <option value="Freelancer">Freelance</option>
                                        <option value="Pro">Pro</option>
                                        <option value="Agency">Agency</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="mt-5 sm:mt-6 sm:grid sm:grid-flow-row-dense sm:grid-cols-2 sm:gap-3">
                            <button type="submit" class="inline-flex w-full justify-center rounded-md bg-pipexblue px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-blue-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 sm:col-start-2">Create</button>
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
        $(document).ready(function(){
            var form = document.getElementById('newUserFrm');

            $('#createBtn').click(function(){
                $('.new-user-modal').removeClass('hidden');
            });

            $('#cancelBtn').click(function(){
                form.reset();
                $('.new-user-modal').addClass('hidden');
            });

            $('#newUserFrm').submit(function(e){
                e.preventDefault();
                $.ajax({
                    url: '{{ route('create-user') }}',
                    type: 'POST',
                    data: $('#newUserFrm').serialize(),
                    success: function(response){
                        form.reset();
                        $('.new-user-modal').addClass('hidden');
                        Swal.fire({
                            title: 'Success',
                            text: 'User successfully created.',
                            icon: 'success'
                        });
                    }
                });
            });

            $('#allBtn').click(function(){
                $('#allBtn').removeClass('cursor-pointer border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700 w-1/4 border-b-2 py-4 px-1 text-center text-sm font-medium');
                $('#allBtn').addClass('cursor-pointer border-indigo-500 text-indigo-600 w-1/4 border-b-2 py-4 px-1 text-center text-sm font-medium');
                $('#activeBtn').removeClass('cursor-pointer border-indigo-500 text-indigo-600 w-1/4 border-b-2 py-4 px-1 text-center text-sm font-medium');
                $('#activeBtn').addClass('cursor-pointer border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700 w-1/4 border-b-2 py-4 px-1 text-center text-sm font-medium');
                $('#inactiveBtn').removeClass('cursor-pointer border-indigo-500 text-indigo-600 w-1/4 border-b-2 py-4 px-1 text-center text-sm font-medium');
                $('#inactiveBtn').addClass('cursor-pointer border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700 w-1/4 border-b-2 py-4 px-1 text-center text-sm font-medium');
                $('.all-users').removeClass('hidden');
                $('.active-users').addClass('hidden');
                $('.inactive-users').addClass('hidden');
            });

            $('#activeBtn').click(function(){
                $('#activeBtn').removeClass('cursor-pointer border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700 w-1/4 border-b-2 py-4 px-1 text-center text-sm font-medium');
                $('#activeBtn').addClass('cursor-pointer border-indigo-500 text-indigo-600 w-1/4 border-b-2 py-4 px-1 text-center text-sm font-medium');
                $('#allBtn').removeClass('cursor-pointer border-indigo-500 text-indigo-600 w-1/4 border-b-2 py-4 px-1 text-center text-sm font-medium');
                $('#allBtn').addClass('cursor-pointer border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700 w-1/4 border-b-2 py-4 px-1 text-center text-sm font-medium');
                $('#inactiveBtn').removeClass('cursor-pointer border-indigo-500 text-indigo-600 w-1/4 border-b-2 py-4 px-1 text-center text-sm font-medium');
                $('#inactiveBtn').addClass('cursor-pointer border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700 w-1/4 border-b-2 py-4 px-1 text-center text-sm font-medium');
                $('.all-users').addClass('hidden');
                $('.active-users').removeClass('hidden');
                $('.inactive-users').addClass('hidden');
            });

            $('#inactiveBtn').click(function(){
                $('#inactiveBtn').removeClass('cursor-pointer border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700 w-1/4 border-b-2 py-4 px-1 text-center text-sm font-medium');
                $('#inactiveBtn').addClass('cursor-pointer border-indigo-500 text-indigo-600 w-1/4 border-b-2 py-4 px-1 text-center text-sm font-medium');
                $('#allBtn').removeClass('cursor-pointer border-indigo-500 text-indigo-600 w-1/4 border-b-2 py-4 px-1 text-center text-sm font-medium');
                $('#allBtn').addClass('cursor-pointer border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700 w-1/4 border-b-2 py-4 px-1 text-center text-sm font-medium');
                $('#activeBtn').removeClass('cursor-pointer border-indigo-500 text-indigo-600 w-1/4 border-b-2 py-4 px-1 text-center text-sm font-medium');
                $('#activeBtn').addClass('cursor-pointer border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700 w-1/4 border-b-2 py-4 px-1 text-center text-sm font-medium');
                $('.all-users').addClass('hidden');
                $('.active-users').addClass('hidden');
                $('.inactive-users').removeClass('hidden');
            });

            $('#checkAll').click(function() {
                if ($(this).is(':checked')) {
                    $('.checkbox-item').prop('checked', true);
                } else {
                    $('.checkbox-item').prop('checked', false);
                }
            });

            $('#exportBtn').click(function() {
                var tokenArray = [];
                $('input[name="idBox[]"]:checked').each(function() {
                    tokenArray.push($(this).val());
                });
                if(tokenArray.length > 0){
                    $('#downloadFrm').submit();
                }else{
                    Swal.fire({
                        title: 'Error',
                        text: 'No users selected',
                        icon: 'error'
                    });
                }
            });

            $('#downloadFrm').submit(function() {
                var tokenArray = [];
                $('input[name="idBox[]"]:checked').each(function() {
                    tokenArray.push($(this).val());
                });

                $.ajax({
                    url: '{{ route('export-user') }}',
                    method: 'POST',
                    data: {
                        'idBox[]': tokenArray,
                        '_token': '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        var downloadLink = document.createElement('a');
                        downloadLink.href = 'data:text/csv;charset=utf-8,' + encodeURIComponent(
                            response);
                        downloadLink.download = '2xMyLeads - Users.csv';
                        downloadLink.click();
                    },
                    error: function(xhr) {
                        M.toast({
                            html: 'No lead selected',
                            classes: 'red'
                        });
                    }
                });
            });

            $('#search-filter').keyup(function() {
                $.ajax({
                    url: '{{ route('search-user-filter') }}',
                    type: 'POST',
                    data: {
                        search_user: $('#search-filter').val(),
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        $('#userList').html('');
                        $('.pagination-all').remove();
                        $.each(response, function(index, user) {
                            $('#userList').append(`
                                <tr>
                                    <td class="whitespace-nowrap py-2 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-0">
                                        <input type="checkbox" name="idBox[]" value="`+user.id+`" class="checkbox-item">
                                    </td>
                                    <td class="whitespace-nowrap px-1 py-2 text-xs text-gray-500">`+user.first_name+` `+(user.last_name ? user.last_name : '')+`</td>
                                    <td class="whitespace-nowrap px-1 py-2 text-xs text-gray-500">`+user.email+`</td>
                                    <td class="whitespace-nowrap px-1 py-2 text-xs text-gray-500">`+user.roles.map(role => role.name).join(', ')+`</td>
                                    <td class="whitespace-nowrap px-1 py-2 text-xs text-gray-500">`+user.status.toUpperCase()+`</td>
                                    <td class="whitespace-nowrap px-1 py-2 text-xs text-gray-500">`+(user.last_login ? user.last_login : '')+`</td>
                                    <td class="relative whitespace-nowrap py-2 pl-3 pr-4 text-xs font-medium sm:pr-0">
                                        <a href="/user/profile/`+user.id+`" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                                    </td>
                                    <td class="whitespace-nowrap px-1 py-2 text-xs font-medium">
                                        <a href="/users/login-as-user/`+user.id+`" class="text-indigo-600 hover:text-indigo-900">Login as user</a>
                                    </td>
                                </tr>
                            `);
                        });
                    },
                    error: function(xhr, status, error) {
                    }
                });
            });

            $('#checkAllactive').click(function() {
                if ($(this).is(':checked')) {
                    $('.checkbox-active-item').prop('checked', true);
                } else {
                    $('.checkbox-active-item').prop('checked', false);
                }
            });

            $('#exportActvBtn').click(function() {
                var tokenArray = [];
                $('input[name="idActvBox[]"]:checked').each(function() {
                    tokenArray.push($(this).val());
                });
                if(tokenArray.length > 0){
                    $('#downloadActvFrm').submit();
                }else{
                    Swal.fire({
                        title: 'Error',
                        text: 'No users selected',
                        icon: 'error'
                    });
                }
            });

            $('#downloadActvFrm').submit(function() {
                var tokenArray = [];
                $('input[name="idActvBox[]"]:checked').each(function() {
                    tokenArray.push($(this).val());
                });

                $.ajax({
                    url: '{{ route('export-user') }}',
                    method: 'POST',
                    data: {
                        'idBox[]': tokenArray,
                        '_token': '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        var downloadLink = document.createElement('a');
                        downloadLink.href = 'data:text/csv;charset=utf-8,' + encodeURIComponent(response);
                        downloadLink.download = '2xMyLeads - Active Users.csv';
                        downloadLink.click();
                    },
                    error: function(xhr) {
                        M.toast({
                            html: 'No lead selected',
                            classes: 'red'
                        });
                    }
                })
            });

            $('#search-active-filter').keyup(function() {
                $.ajax({
                    url: '{{ route('search-active-filter') }}',
                    type: 'POST',
                    data: {
                        search_user: $('#search-active-filter').val(),
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        $('#actvuserList').html('');
                        $('.pagination-active').remove();
                        $.each(response, function(index, user) {
                            $('#actvuserList').append(`
                                <tr>
                                    <td class="whitespace-nowrap py-2 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-0">
                                        <input type="checkbox" name="idActvBox[]" value="`+user.id+`" class="checkbox-active-item">
                                    </td>
                                    <td class="whitespace-nowrap px-1 py-2 text-xs text-gray-500">`+user.first_name+` `+(user.last_name ? user.last_name : '')+`</td>
                                    <td class="whitespace-nowrap px-1 py-2 text-xs text-gray-500">`+user.email+`</td>
                                    <td class="whitespace-nowrap px-1 py-2 text-xs text-gray-500">`+user.roles.map(role => role.name).join(', ')+`</td>
                                    <td class="whitespace-nowrap px-1 py-2 text-xs text-gray-500">`+user.status.toUpperCase()+`</td>
                                    <td class="whitespace-nowrap px-1 py-2 text-xs text-gray-500">`+(user.last_login ? user.last_login : '')+`</td>
                                    <td class="relative whitespace-nowrap py-2 pl-3 pr-4 text-xs font-medium sm:pr-0">
                                        <a href="/user/profile/`+user.id+`" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                                    </td>
                                    <td class="whitespace-nowrap px-1 py-2 text-xs font-medium">
                                        <a href="/users/login-as-user/`+user.id+`" class="text-indigo-600 hover:text-indigo-900">Login as user</a>
                                    </td>
                                </tr>
                            `);
                        });
                    },
                    error: function(xhr, status, error) {
                    }
                });
            });

            $('#checkAllinactive').click(function() {
                if ($(this).is(':checked')) {
                    $('.checkbox-inactive-item').prop('checked', true);
                } else {
                    $('.checkbox-inactive-item').prop('checked', false);
                }
            });

            $('#exportInactvBtn').click(function() {
                var tokenArray = [];
                $('input[name="idInactvBox[]"]:checked').each(function() {
                    tokenArray.push($(this).val());
                });
                if(tokenArray.length > 0){
                    $('#downloadInactvFrm').submit();
                }else{
                    Swal.fire({
                        title: 'Error',
                        text: 'No users selected',
                        icon: 'error'
                    });
                }
            });

            $('#downloadInactvFrm').submit(function() {
                var tokenArray = [];
                $('input[name="idInactvBox[]"]:checked').each(function() {
                    tokenArray.push($(this).val());
                });

                $.ajax({
                    url: '{{ route('export-user') }}',
                    method: 'POST',
                    data: {
                        'idBox[]': tokenArray,
                        '_token': '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        var downloadLink = document.createElement('a');
                        downloadLink.href = 'data:text/csv;charset=utf-8,' + encodeURIComponent(response);
                        downloadLink.download = '2xMyLeads - Inactive Users.csv';
                        downloadLink.click();
                    },
                    error: function(xhr) {
                        M.toast({
                            html: 'No lead selected',
                            classes: 'red'
                        });
                    }
                })
            });

            $('#search-inactive-filter').keyup(function() {
                $.ajax({
                    url: '{{ route('search-inactive-filter') }}',
                    type: 'POST',
                    data: {
                        search_user: $('#search-inactive-filter').val(),
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        $('#inactvuserList').html('');
                        $('.pagination-inactive').remove();
                        $.each(response, function(index, user) {
                            $('#inactvuserList').append(`
                                <tr>
                                    <td class="whitespace-nowrap py-2 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-0">
                                        <input type="checkbox" name="idInactvBox[]" value="`+user.id+`" class="checkbox-item">
                                    </td>
                                    <td class="whitespace-nowrap px-1 py-2 text-xs text-gray-500">`+user.first_name+` `+(user.last_name ? user.last_name : '')+`</td>
                                    <td class="whitespace-nowrap px-1 py-2 text-xs text-gray-500">`+user.email+`</td>
                                    <td class="whitespace-nowrap px-1 py-2 text-xs text-gray-500">`+user.roles.map(role => role.name).join(', ')+`</td>
                                    <td class="whitespace-nowrap px-1 py-2 text-xs text-gray-500">`+user.status.toUpperCase()+`</td>
                                    <td class="whitespace-nowrap px-1 py-2 text-xs text-gray-500">`+(user.last_login ? user.last_login : '')+`</td>
                                    <td class="relative whitespace-nowrap py-2 pl-3 pr-4 text-xs font-medium sm:pr-0">
                                        <a href="/user/profile/`+user.id+`" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                                    </td>
                                </tr>
                            `);
                        });
                    },
                    error: function(xhr, status, error) {
                    }
                });
            });
        });
    </script>
@endsection
