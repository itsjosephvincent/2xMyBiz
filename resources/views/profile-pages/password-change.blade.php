@extends('pages.profile')

@section('css')
@endsection

@section('profiles')
    <div class="grid grid-cols-1">
        <div class="col-span-1">
            <h6 class="text-lg font-medium">Update password</h6>
        </div>
    </div>

    <div class="flex flex-col mt-4">
        @if (session('error'))
        <div class="rounded-md bg-red-50 p-4">
            <div class="flex">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-red-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.28 7.22a.75.75 0 00-1.06 1.06L8.94 10l-1.72 1.72a.75.75 0 101.06 1.06L10 11.06l1.72 1.72a.75.75 0 101.06-1.06L11.06 10l1.72-1.72a.75.75 0 00-1.06-1.06L10 8.94 8.28 7.22z" clip-rule="evenodd" />
                    </svg>
                </div>
                <div class="ml-3">
                    <h3 class="text-sm font-medium text-red-800">{{ session('error') }}</h3>
                </div>
            </div>
        </div>
        @elseif (session('success'))
            <div class="rounded-md bg-green-50 p-4">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-green-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="ml-3">
                        <h3 class="text-sm font-medium text-green-800">{{ session('success') }}</h3>
                    </div>
                </div>
            </div>
        @endif
        <form action="{{ route('update-password', $currentUser->id) }}" method="post">
            @csrf
            @method('PUT')
            <div>
                <label class="block text-sm font-medium leading-6 text-gray-900">Current password</label>
                <div class="mt-1">
                    <input type="password" name="old_password" required class="block lg:w-80 w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                </div>
            </div>
            <div>
                <label class="block text-sm font-medium leading-6 text-gray-900">New password</label>
                <div class="mt-1">
                    <input type="password" name="new_password" required class="block lg:w-80 w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                </div>
            </div>
            <div>
                <label class="block text-sm font-medium leading-6 text-gray-900">Confirm password</label>
                <div class="mt-1">
                    <input type="password" name="password_confirmation" required class="block lg:w-80 w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                </div>
            </div>
            <div class="mt-4">
                <button type="submit" class="rounded-md bg-pipexblue px-2.5 py-1.5 text-sm font-semibold text-white shadow-sm hover:bg-blue-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Update</button>
            </div>
        </form>
    </div>
@endsection

@section('js')
<script>
    $(document).ready(function(){
        $('#fileInput').change(function(){
            var file = $(this)[0];
            if (file.files.length > 0) {
                $('#ppfrm').submit();
                $('.upload-loader').removeClass('hidden');
            }
        });
    });
</script>
@endsection
