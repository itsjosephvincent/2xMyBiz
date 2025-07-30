@extends('pages.settings')

@section('settings')
    <div class="grid grid-cols-1">
        <div class="col-span-1">
            <h6 class="text-lg font-medium">Business information</h6>
        </div>
    </div>

    <form action="{{ route('update-business-information', $currentUser->id) }}" method="post">
        @csrf
        @method('PUT')
        <div class="grid grid-cols-1 lg:grid-cols-2 mt-4">
            <div class="lg:mr-4 mt-2">
                <label class="block text-sm font-medium leading-6 text-gray-900">Business name</label>
                <div class="mt-1">
                    <input type="text" name="business_name" value="{{ $userBusiness->business_name ?? '' }}" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                </div>
            </div>
            <div class="mt-2">
                <label class="block text-sm font-medium leading-6 text-gray-900">Business website</label>
                <div class="mt-1">
                    <input type="text" name="business_website" value="{{ $userBusiness->business_website ?? '' }}" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                </div>
            </div>
            <div class="lg:mr-4 mt-2">
                <label class="block text-sm font-medium leading-6 text-gray-900">Business email</label>
                <div class="mt-1">
                    <input type="email" name="business_email" value="{{ $userBusiness->business_email ?? '' }}" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                </div>
            </div>
            <div class="mt-2">
                <label class="block text-sm font-medium leading-6 text-gray-900">Business phone number</label>
                <div class="mt-1">
                    <input type="text" name="business_phone" value="{{ $userBusiness->business_phone ?? '' }}" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                </div>
            </div>
            <div class="lg:col-span-2 mt-2">
                <label class="block text-sm font-medium leading-6 text-gray-900">Business address</label>
                <div class="mt-1">
                    <input type="text" name="business_address" value="{{ $userBusiness->business_address ?? '' }}" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                </div>
            </div>
            <div class="lg:col-span-2 mt-2">
                <label class="block text-sm font-medium leading-6 text-gray-900">About our business</label>
                <div class="mt-1">
                    <input type="text" name="about_us" value="{{ $userBusiness->about_us ?? '' }}" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                </div>
            </div>
            <div class="lg:col-span-2 mt-2">
                <label class="block text-sm font-medium leading-6 text-gray-900">Audit message</label>
                <div class="mt-1">
                    <textarea rows="4" name="audit_message" class="block w-full resize-none rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">{{ $userBusiness->audit_message ?? 'Take a look at your report. If you have any questions, use the link below to schedule a meeting with a marketing strategist to discuss.' }}</textarea>
                </div>
            </div>
            <div class="lg:col-span-2 flex justify-center mt-4">
                <button type="submit" class="rounded-md w-24 bg-pipexblue px-2.5 py-1.5 text-sm font-semibold text-white shadow-sm hover:bg-blue-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Save</button>
            </div>
        </div>
    </form>
@endsection

@section('js')
<script>
    $(document).ready(function(){
        $('.affiliate-drop-down').click(function(){
            $('#affiliate-menu').toggle('hidden');
        });
    });
</script>
@endsection
