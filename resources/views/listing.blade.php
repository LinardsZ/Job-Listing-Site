<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" href="{{ asset('css/app.css') }}">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/material-design-icons/3.0.1/iconfont/material-icons.min.css" integrity="sha256-x8PYmLKD83R9T/sYmJn1j3is/chhJdySyhet/JuHnfY=" crossorigin="anonymous"/>
		<script src="https://cdn.tailwindcss.com"></script>
		<title>Job Listings - {{ $listing->position }}</title>
    </head>
    <body class="bg-neutral-100">
        <x-navbar/>
            <div class="grid grid-cols-9 grid-rows-6 my-32 w-1/2 mx-auto">
                <div class="row-span-1 col-span-9 grid grid-cols-9 bg-neutral-50 border-x border-t border-neutral-200 py-8">
                    <div class="col-span-2">
                        <img class="h-32 w-32 ml-6 border border-neutral-200 select-none" src="{{ asset('unnamed.png') }}">
                    </div>
                    <div class="col-span-5 font-bold text-4xl text-gray-600 break-normal select-none">
                        {{ $listing->position }} pārdevējs/a - konsultants/e Rīgā, Avotu ielā 26
                    </div>
                    <div class="col-span-2 flex flex-col flex justify-around px-4">
                        <a class="font-bold text-white text-center p-2 bg-gray-800 text-xl border-0 rounded-md border-gray-800 hover:bg-emerald-800 ease-in-out duration-300 cursor-pointer select-none">Nosūtīt e-pastu</a>
                        <a class="font-bold text-white text-center p-2 bg-gray-800 text-xl border-0 rounded-md border-gray-800 hover:bg-emerald-800 ease-in-out duration-300 cursor-pointer select-none">Uzsākt saraksti</a>
                    </div>
                </div>
                <div class="row-span-5 col-span-6 border-y border-l bg-neutral-50">
                    {{ $listing->description }}
                </div>
                <div class="row-span-5 col-span-3 border-y border-r bg-neutral-50 p-6">
                    <div class="font-bold pb-4 text-lg">Informācija par darbu</div>
                    
                    <div class="pb-2 flex items-center"><span class="material-icons pr-1">place</span><p> Atrašanās vieta</p></div>
                    <p>{{ $listing->location }}</p>
                    
                    <div class="pb-2 flex items-center"><span class="material-icons pr-1">euro_symbol</span><p> Alga</p></div>
                    <p>{{ $listing->salary }}</p>
                    
                    <div class="pb-2 flex items-center"><span class="material-icons pr-1">schedule</span><p> Darba slodze</p></div>
                    <p>{{ $listing->workload }}</p>

                    <div class="pb-2 flex items-center"><span class="material-icons pr-1">error_outline</span><p class="inline"> Papildus informācija</p></div>
                    <p>{{ $listing->extra_info }}</p>
                    
                    <div class="pb-2 flex items-center"><span class="material-icons pr-1">today</span><p> Ievietots</p></div>
                    <p>{{ $listing->posted_at }}</p>

                    <div class="pb-2 flex items-center"><span class="material-icons pr-1">domain</span><p> Reģ. nr.</p></div>
                </div>
            </div>
    </body>
</html>