<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" href="{{ asset('css/app.css') }}">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/material-design-icons/3.0.1/iconfont/material-icons.min.css" integrity="sha256-x8PYmLKD83R9T/sYmJn1j3is/chhJdySyhet/JuHnfY=" crossorigin="anonymous"/>
		<script src="https://cdn.tailwindcss.com"></script>
		<title>{{ $listing->position }}</title>
    </head>
    <body class="bg-neutral-100">
        <x-navbar/>
        <div class="flex flex-col w-1/2 mx-auto my-24">
            <div class="flex flex-row bg-neutral-50 border border-neutral-200 py-4">
                <div class="flex items-center">
                    <img class="h-32 w-32 ml-6 select-none" src="{{ asset('no-image.png') }}">
                </div>
                <div class="flex-1 px-4">
                    <p class="font-bold text-2xl text-gray-600 break-all select-none">{{ $listing->position }}</p>
                    <p class="italic text-gray-700 pt-2 pb-16">{{ $data->name }}</p>
                </div>
                <div class="flex flex-col pr-4 justify-center">
                    @auth
                    <a href="mailto:{{ $data->email }}" class="block font-bold text-white text-center mb-4 p-2 bg-gray-700 text-xl border-0 rounded-md border-gray-800 hover:bg-emerald-700 
                    ease-in-out duration-300 cursor-pointer select-none">Send e-mail</a>
                    <a class="block font-bold text-white text-center p-2 bg-gray-700 text-xl border-0 rounded-md border-gray-800 hover:bg-emerald-700 
                    ease-in-out duration-300 cursor-pointer select-none">Start a conversation</a>
                    @else
                    <a href="mailto:{{ $data->email }}" class="block font-bold text-white text-center mb-4 p-2 bg-gray-800 text-xl border-0 rounded-md border-gray-700 hover:bg-emerald-700 
                    ease-in-out duration-300 cursor-pointer select-none">Send e-mail</a>
                    @endauth
                </div>
            </div>
            <div class="flex justify-between flex-row bg-neutral-50 p-4 border-x border-b border-neutral-200">
                <pre class="float-right whitespace-pre-wrap font-sans">{{ $listing->description }}</pre>
                
                <div class="float-left flex flex-col shrink-0 grow-0 pl-4">
                    <p class="inline font-bold pb-8 text-lg text-gray-600">Information about the offer</p>
                    
                    <div class="pb-2 grid grid-rows-2 grid-cols-10 items-center">
                        <span class="col-span-1 row-span-2 material-icons pr-1">place</span>
                        <div class="col-span-9 row-span-2">
                            <p class="text-sm">Location:</p>
                            <p class="text-sm">{{ $listing->location }}</p>
                        </div>
                    </div>
                    
                    <div class="pb-2 grid grid-rows-2 grid-cols-10 items-center">
                        <span class="col-span-1 row-span-2 material-icons pr-1">euro_symbol</span>
                        <div class="col-span-9 row-span-2">
                            <p class="text-sm">Salary:</p>
                            <p class="text-sm">{{ $listing->salary }} €/month</p>
                        </div>
                    </div>

                    <div class="pb-2 grid grid-rows-2 grid-cols-10 items-center">
                        <span class="col-span-1 row-span-2 material-icons pr-1">schedule</span>
                        <div class="col-span-9 row-span-2">
                            <p class="text-sm">Workload:</p>
                            <p class="text-sm">{{ $listing->workload }}</p>
                        </div>
                    </div>

                    <div class="pb-2 grid grid-rows-2 grid-cols-10 items-center">
                        <span class="col-span-1 row-span-2 material-icons pr-1">today</span>
                        <div class="col-span-9 row-span-2">
                            <p class="text-sm">Posted at:</p>
                            <p class="text-sm">{{ $listing->posted_at }}</p>
                        </div>
                    </div>
                    
                    <div class="pb-2 grid grid-rows-2 grid-cols-10 items-center">
                        <span class="col-span-1 row-span-2 material-icons pr-1">domain</span>
                        <div class="col-span-9 row-span-2">
                            <p class="text-sm">Registry No.:</p>
                            <p class="text-sm">{{ $data->registryid }}</p>
                        </div>
                    </div>
                </div>
            </div>  
        </div>
    </body>
</html>