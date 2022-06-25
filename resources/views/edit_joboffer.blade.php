<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" href="{{ asset('css/app.css') }}">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/material-design-icons/3.0.1/iconfont/material-icons.min.css" integrity="sha256-x8PYmLKD83R9T/sYmJn1j3is/chhJdySyhet/JuHnfY=" crossorigin="anonymous"/>
		<script src="https://cdn.tailwindcss.com"></script>
		<title>Updating {{ $offer->position }} - {{ $offer->category }}</title>
    </head>
    <body class="bg-neutral-100">
        <x-navbar/>
        <div class="my-24 mx-auto w-1/2">
            <div class="mb-12">
                <svg class="block fill-emerald-700 h-24 w-24 mx-auto" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                    viewBox="0 0 13.611 13.493"  xml:space="preserve">
                    <path class="" d="M4.174,0.37C4.293,0.24,4.449,0.148,4.549,0C4.531,1.498,4.54,2.997,4.544,4.496C4.871,4.182,5.169,3.834,5.522,3.55
                c1.16-1.162,2.322-2.321,3.485-3.479c0.033-0.048,0.09-0.056,0.144-0.053c1.487,0.002,2.974-0.001,4.46,0.001
                c-0.007,2.993,0.001,5.986-0.004,8.979c-0.918,0.901-1.821,1.818-2.736,2.723c-0.156,0.149-0.296,0.316-0.472,0.442
                c-0.442,0.44-0.885,0.88-1.326,1.321c-0.001-1.497,0-2.994,0-4.491c-1.093,1.086-2.181,2.178-3.274,3.264
                c-0.175,0.128-0.321,0.289-0.473,0.442c-0.263,0.263-0.525,0.526-0.791,0.786c-1.192-0.009-2.384-0.002-3.576-0.004
                c-0.318,0.005-0.637-0.011-0.955,0.01c0.001-2.9,0.001-5.8,0-8.7C0.016,4.687-0.028,4.56,0.034,4.469
                c0.243-0.235,0.465-0.495,0.733-0.702C1.902,2.634,3.037,1.502,4.174,0.37z M4.541,4.515C4.538,6.006,4.542,7.498,4.539,8.989
                C6.05,8.987,7.561,8.997,9.072,8.984c0.004-1.49,0.001-2.979,0.001-4.469C7.562,4.513,6.052,4.513,4.541,4.515z"/>
                </svg>
            </div>
            
            <p class="text-md text-center mb-8 mt-24">Updating offer <span class="font-bold text-gray-700 capitalize">{{ $offer->position }} - {{ $offer->category }}</span>:</p>
            <form class="flex flex-col items-center" onsubmit="return validateEditForm()" action="{{ route('set.offer') }}" method="POST">
                @csrf
                <input type="hidden" name="offerid" value="{{ $offer->offerid }}">

                <label class="w-1/3 font-bold" for="Position">Position:</label>
                <span class="msgs bg-red-200 px-2 py-1 border-l-4 border-red-700 font-bold text-xs mb-1" id="error-position">
                    @error('position')
                    {{ $message }}
                    @enderror
                </span>
                <input class="border border-red-900 mb-4 w-1/3" type="text" id="position" name="position" value="">

                <label class="w-1/3 font-bold" for="category">Category:</label>
                <span class="msgs bg-red-200 px-2 py-1 border-l-4 border-red-700 font-bold text-xs mb-1" id="error-category">
                    @error('category')
                    {{ $message }}
                    @enderror
                </span>
                <input class="border border-red-900 mb-4 w-1/3" type="text" id="category" name="category" value="">

                <label class="w-1/3 font-bold" for="workload">Workload:</label>
                <span class="msgs bg-red-200 px-2 py-1 border-l-4 border-red-700 font-bold text-xs mb-1" id="error-workload">
                    @error('workload')
                    {{ $message }}
                    @enderror
                </span>
                <input class="border border-red-900 mb-4 w-1/3" type="text" id="workload" name="workload" value="">
                
                <label class="w-1/3 font-bold" for="location">Location:</label>
                <span class="msgs bg-red-200 px-2 py-1 border-l-4 border-red-700 font-bold text-xs mb-1" id="error-location">
                    @error('location')
                    {{ $message }}
                    @enderror
                </span>
                <input class="border border-red-900 mb-4 w-1/3" type="text" id="location" name="location" value="">

                <label class="w-1/3 font-bold" for="salary">Salary:</label>
                <span class="msgs bg-red-200 px-2 py-1 border-l-4 border-red-700 font-bold text-xs mb-1" id="error-salary">
                    @error('salary')
                    {{ $message }}
                    @enderror
                </span>
                <input class="border border-red-900 mb-4 w-1/3" type="number" id="salary" name="salary" value="">

                <label class="w-1/3 font-bold" for="description">Description:</label>
                <textarea class="border border-red-900 mb-4 w-1/3 resize-y" type="text" id="description" name="description" rows="10" value=""></textarea>

                <label class="w-1/3 font-bold" for="extra_info">Extra information:</label>
                <span class="msgs bg-red-200 px-2 py-1 border-l-4 border-red-700 font-bold text-xs mb-1" id="error-extra_info">
                    @error('extra_info')
                    {{ $message }}
                    @enderror
                </span>
                <input class="border border-red-900 mb-4 w-1/3" type="text" id="extra_info" name="extra_info" value="">

                <input id="submit" class="mt-4 bg-gray-700 hover:bg-emerald-700 w-1/5 cursor-pointer text-white font-bold border rounded ease-in-out duration-300" type="submit">
            </form>
        </div>
        <script src="{{ asset('js/validate_editoffer.js') }}"></script>
    </body>
</html>