<div class="flex justify-center items-center my-36">
    <p class="font-bold text-5xl text-gray-600 select-none">Search for any job!</p>
</div>
<div class="flex items-center justify-center">
        <form method="GET" class="flex border-2 rounded" action="/show">
            <input type="" class="px-4 py-2 border-l w-36" placeholder="Category">
            <input type="" class="px-4 py-2 border-l w-36" placeholder="Location">
            <input type="text" class="px-4 py-2 w-80 border-l" placeholder="Enter a keyword...">
            <input name="_token" type="hidden" value="{{ csrf_token() }}">
            <button class="flex items-center justify-center px-4 border-l" type="submit">
                <svg class="w-6 h-6 text-gray-600" fill="currentColor" xmlns="http://www.w3.org/2000/svg"
                     viewBox="0 0 24 24">
                    <path
                        d="M16.32 14.9l5.39 5.4a1 1 0 0 1-1.42 1.4l-5.38-5.38a8 8 0 1 1 1.41-1.41zM10 16a6 6 0 1 0 0-12 6 6 0 0 0 0 12z" />
                </svg>
            </button>
        </form>
</div>
