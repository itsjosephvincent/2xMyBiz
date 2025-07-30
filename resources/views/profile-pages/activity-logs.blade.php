@extends('pages.profile')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/activity-logs.css') }}">
@endsection

@section('profiles')
    <div class="grid grid-cols-1">
        <div class="col-span-1">
            <h6 class="text-lg font-medium">Activity logs</h6>
        </div>
    </div>

    <div class="px-4 sm:px-6 lg:px-8">
        <div class="mt-8 flow-root">
            <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                    <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 sm:rounded-lg">
                        <table class="min-w-full divide-y divide-gray-300">
                            <thead class="bg-white">
                                <tr>
                                    <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">Activity</th>
                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Description</th>
                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Timestamp</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 bg-white">
                                @foreach ($activities as $activity)
                                <tr>
                                    <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6">{{ $activity->log_name }}</td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $activity->description }}</td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ date('Y-m-d H:i:s', strtotime($activity->created_at)) }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="flex justify-center mt-2 lead-pagination">
                        {{ $activities->links('vendor.pagination.paginate') }}
                    </div>
                </div>
            </div>
        </div>
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
