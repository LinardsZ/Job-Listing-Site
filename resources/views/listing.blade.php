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
    <body>
        <x-navbar/>
            <div class="bg-neutral-50 border border-gray-300 p-4 rounded">
                <div class="flex">
                    <p class="text-xl uppercase font-bold">{{ $listing->position }}</p>
                    <p class="border border-emerald-700 rounded ml-auto bg-emerald-700 p-1 text-white font-bold">{{ $listing->salary }} €/mēn</p>
                </div>
                <p class="place-self-center pb-4 italic">{{ $listing->name }}</p>			
                <p class="">{{ $listing->description }}</p>
            </div>
    </body>
</html>