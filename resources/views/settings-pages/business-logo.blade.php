@extends('pages.settings')

@section('settings')
    <div class="grid grid-cols-1">
        <div class="col-span-1">
            <h6 class="text-lg font-medium">Business logo</h6>
        </div>
    </div>

    @error('logo')
    <div class="rounded-md bg-red-50 mt-6 p-4">
        <div class="flex">
            <div class="flex-shrink-0">
                <svg class="h-5 w-5 text-red-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.28 7.22a.75.75 0 00-1.06 1.06L8.94 10l-1.72 1.72a.75.75 0 101.06 1.06L10 11.06l1.72 1.72a.75.75 0 101.06-1.06L11.06 10l1.72-1.72a.75.75 0 00-1.06-1.06L10 8.94 8.28 7.22z" clip-rule="evenodd" />
                </svg>
            </div>
            <div class="ml-3">
                <h3 class="text-sm font-medium text-red-800">{{ $message }}</h3>
            </div>
        </div>
    </div>
    @enderror

    <form action="{{ route('update-business-logo') }}" id="logo-upload" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mt-4">
            <div class="mt-2 flex justify-center rounded-lg border border-dashed border-gray-900/25">
                <img src="{{ isset($userBusiness->business_logo) ? $userBusiness->business_logo : '' }}" class="w-20 h20 {{ isset($userBusiness->business_logo) ? '' : 'hidden' }} preview-img">
                <div class="text-center default-img {{ isset($userBusiness->business_logo) ? 'hidden' : '' }}">
                    <svg class="mx-auto h-12 w-12 text-gray-300" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                        <path fill-rule="evenodd" d="M1.5 6a2.25 2.25 0 012.25-2.25h16.5A2.25 2.25 0 0122.5 6v12a2.25 2.25 0 01-2.25 2.25H3.75A2.25 2.25 0 011.5 18V6zM3 16.06V18c0 .414.336.75.75.75h16.5A.75.75 0 0021 18v-1.94l-2.69-2.689a1.5 1.5 0 00-2.12 0l-.88.879.97.97a.75.75 0 11-1.06 1.06l-5.16-5.159a1.5 1.5 0 00-2.12 0L3 16.061zm10.125-7.81a1.125 1.125 0 112.25 0 1.125 1.125 0 01-2.25 0z" clip-rule="evenodd" />
                    </svg>
                </div>
            </div>
            <div class="mt-4 text-center text-sm select-button">
                <label for="file-upload" class="relative cursor-pointer rounded-md bg-pipexblue px-2 py-1 font-semibold text-white focus-within:outline-none focus-within:ring-2 focus-within:ring-indigo-600 focus-within:ring-offset-2 hover:bg-blue-500">
                    <span>Select a file</span>
                    <input id="file-upload" name="logo" type="file" class="hidden" required>
                </label>
            </div>
            <div class="mt-4 text-center text-sm hidden upload-button">
                <button type="submit" class="rounded-md bg-pipexblue px-2.5 py-1.5 text-sm font-semibold text-white shadow-sm hover:bg-blue-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Upload</button>
            </div>
        </div>
    </form>

    <div class="hidden relative z-10 upload-loader" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>
        <div class="fixed inset-0 z-10 overflow-y-auto">
            <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                <div class="relative transform overflow-hidden rounded-lg bg-white px-4 pb-4 pt-5 text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-sm sm:p-6">
                    <div>
                        <div class="flex justify-center items-center">
                            <div class="loader"></div>
                        </div>
                        <div class="mt-3 text-center sm:mt-5">
                            <h3 class="text-base font-semibold leading-6 text-gray-900" id="modal-title">Uploading</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('sweetalert::alert')
@endsection

@section('js')
<script>
    $(document).ready(function(){
        const preview = document.querySelector('.preview-img');
        const addFile = document.querySelector('#file-upload');

        addFile.addEventListener('change', function () {
            const file = this.files[0];
            const reader = new FileReader();

            $('.default-img').addClass('hidden');
            $('.preview-img').removeClass('hidden');
            $('.upload-button').removeClass('hidden');
            $('.select-button').addClass('hidden');

            reader.addEventListener('load', function () {
                preview.src = reader.result;
            });

            reader.readAsDataURL(file);
        });

        $('#logo-upload').submit(function(){
            $('.upload-loader').toggle('hidden');
        });

        $('.affiliate-drop-down').click(function(){
            $('#affiliate-menu').toggle('hidden');
        });
    });
</script>
@endsection
