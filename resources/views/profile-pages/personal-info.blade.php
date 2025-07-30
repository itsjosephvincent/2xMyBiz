@extends('pages.profile')

@section('css')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
@endsection

@section('profiles')
    <div class="grid grid-cols-1">
        <div class="col-span-1">
            <h6 class="text-lg font-medium">Personal information</h6>
        </div>
    </div>

    <form action="{{ route('update-personal-info', $currentUser->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="grid grid-cols-1 lg:grid-cols-2 mt-4">
            <div class="lg:mr-2">
                <label class="block text-sm font-medium leading-6 text-gray-900">First name</label>
                <div class="mt-1">
                    <input type="text" name="first_name" value="{{ $currentUser->first_name ?? '' }}" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                </div>
            </div>
            <div>
                <label class="block text-sm font-medium leading-6 text-gray-900">Last name</label>
                <div class="mt-1">
                    <input type="text" name="last_name" value="{{ $currentUser->last_name ?? '' }}" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                </div>
            </div>
            <div class="lg:mr-2">
                <label class="block text-sm font-medium leading-6 text-gray-900">Email address</label>
                <div class="mt-1">
                    <input type="email" name="email_address" value="{{ $currentUser->email ?? '' }}" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                </div>
            </div>
            <div>
                <label class="block text-sm font-medium leading-6 text-gray-900">Gender</label>
                <select name="gender" class="mt-1 block w-full rounded-md border-0 py-1.5 pl-3 pr-10 text-gray-900 ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-indigo-600 sm:text-sm sm:leading-6">
                    @if (!$currentUser->gender)
                    <option value="" selected disabled>Select gender</option>
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                    @elseif ($currentUser->gender == 'male')
                    <option value="male" selected>Male</option>
                    <option value="female">Female</option>
                    @else
                    <option value="male">Male</option>
                    <option value="female" selected>Female</option>
                    @endif
                </select>
            </div>
            <div class="lg:mr-2">
                <label class="block text-sm font-medium leading-6 text-gray-900">Contact number</label>
                <div class="mt-1">
                    <input type="text" name="contact_number" value="{{ $userDetails->contact_number ?? '' }}" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                </div>
            </div>
            <div class="lg:mr-2">
                <label class="block text-sm font-medium leading-6 text-gray-900">Date of birth</label>
                <div class="mt-1">
                    <input type="text" name="birthday" id="birthdate" value="{{ $currentUser->birthday ?? '' }}" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                </div>
            </div>
            <div class="lg:col-span-2">
                <label class="block text-sm font-medium leading-6 text-gray-900">Address</label>
                <div class="mt-1">
                    <input type="text" name="address" value="{{ $userDetails->address1 ?? '' }}" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                </div>
            </div>
            <div class="lg:col-span-2 flex justify-center mt-4">
                <button type="submit" class="rounded-md bg-pipexblue px-2.5 py-1.5 text-sm font-semibold text-white shadow-sm hover:bg-blue-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Save</button>
            </div>
        </div>
    </form>
@endsection

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
        $(document).ready(function(){
            $('#fileInput').change(function(){
                var file = $(this)[0];
                if (file.files.length > 0) {
                    $('#ppfrm').submit();
                    $('.upload-loader').removeClass('hidden');
                }
            });

            flatpickr('#birthdate');
        });
    </script>
@endsection
