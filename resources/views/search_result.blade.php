<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="icon" type="image/x-icon" href="{{ asset('favicon.svg') }}">
		<link rel="stylesheet" href="{{ asset('css/app.css') }}">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/material-design-icons/3.0.1/iconfont/material-icons.min.css" integrity="sha256-x8PYmLKD83R9T/sYmJn1j3is/chhJdySyhet/JuHnfY=" crossorigin="anonymous"/>
		<script src="https://cdn.tailwindcss.com"></script>
		<title>Search Results - {{ $input }}</title>
    </head>
    <body class="bg-neutral-100">
        <x-navbar/>
        <x-searchbar/>
        @if(count($offers) != 0)
        <div class="flex flex-col w-2/3 mx-auto">
            <p class="font-bold text-gray-600 select-none mt-12 mb-4 text-lg">Search results</p>
            <div class="flex flex-col mb-32">
                @foreach($offers as $offer)
                <!-- <div class="bg-neutral-50 border border-gray-300 p-4 rounded">
                    <div class="flex">
                        <a href="/listing/{{ $offer->offerid }}"><p class="text-xl uppercase font-bold hover:text-emerald-700">{{ $offer->position }}</p></a>
                        <p class="select-none border border-emerald-700 rounded ml-auto bg-emerald-700 p-1 text-white font-bold">{{ $offer->salary }} €/mēn</p>
                    </div>

                    <div class="flex">
                        <p class="pb-4 italic">{{ $offer->name }}</p>
                        <p class="ml-auto">{{ $offer->workload }}</p>	
                    </div>
                            
                    <div class="flex">
                        <p class="">{{ $offer->description }}</p>
                            <p class="ml-auto">Ievietots: {{ $offer->posted_at }}</p>
                    </div>
                </div> -->
                <div class="bg-neutral-50 border border-gray-300 p-4 rounded flex flex-row space-between">
                        <div class="grow-0 pr-2">
                            <a href="/listing/{{ $offer->offerid }}">
                                <p class="text-xl uppercase font-bold hover:text-emerald-700">{{ $offer->position }}</p>
                            </a>
                            <p class="pb-4 italic text-gray-700">{{ $offer->name }}</p>
                            <p class="">{{ $offer->description }}</p>
                        </div>
                        
                        <div class="ml-auto flex flex-col justify-start shrink-0">
                            <p class="inline select-none border border-emerald-700 rounded ml-auto bg-emerald-700 p-2 text-white font-bold text-center">{{ $offer->salary }} €/mēn</p>
                            <p class="inline py-2 text-end">{{ $offer->workload }}</p>
                            <p class="inline text-end">Ievietots: {{ $offer->posted_at }}</p>
                        </div>
                </div>
                @endforeach
            </div>
        </div>
        <div class="mx-16 mb-4">
        {{ $offers->links() }}
        </div>
        @else
        <p class="w-1/2 mx-auto text-lg mt-16 text-gray-600 font-bold text-center">No job offers were found.</p>
        @endif
    </body>
</html>