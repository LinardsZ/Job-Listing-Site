<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="icon" type="image/x-icon" href="{{ asset('favicon.svg') }}">
		<link rel="stylesheet" href="{{ asset('css/app.css') }}">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/material-design-icons/3.0.1/iconfont/material-icons.min.css" integrity="sha256-x8PYmLKD83R9T/sYmJn1j3is/chhJdySyhet/JuHnfY=" crossorigin="anonymous"/>
		<title>
        @if(isset($company))    
        {{ $company->name }}'s {{ __('Profile') }}
        @else
        {{ $user->firstname }} {{ $user->surname }}'s {{ __('Profile') }}
        @endif
        </title>
    </head>
    <body class="bg-neutral-50">
        <x-navbar/>
        @if(isset($company))
        <div class="flex flex-row bg-neutral-50 border b-l-1">
            <div class="basis-1/7 mr-2">
                <img class="h-64 w-64 m-8 border rounded-full border-neutral-200 select-none" 
                src="@if(file_exists('storage/avatars/'.$user->userid.'.jpg'))
                {{ asset('storage/avatars/'.$user->userid.'.jpg') }}
                @else
                {{ asset('no-image.png') }}
                @endif">
            </div>    
            <div class="basis-6/7 shrink-0 pt-12 flex flex-col justify-center">
                <p class="text-5xl text-gray-700 font-bold capitalize pb-2">{{ $company->name }}</p>
                <p class="text-gray-700 capitalize font-bold pb-6">{{ __('Representer') }}: <span class="font-normal">{{ $user->firstname }} {{ $user->surname }}</span></p>
                <div class="flex flex-row items-center text-gray-700">
                    <span class="inline material-icons pr-2">email</span>
                    <p class="inline">{{ $user->email }}</p>
                </div>
                <p class="text-gray-700 font-bold">
                    <span class="col-span-1 row-span-2 material-icons pr-1">domain</span>
                    <span class="font-normal">{{ $company->registryid }}</span>
                </p>
                <p class="text-gray-700 font-bold">
                    <span class="col-span-1 row-span-2 material-icons pr-1">home</span>
                    <span class="font-normal">{{ $company->homepage }}</span>
                </p>
                <p class="text-gray-700 font-bold">
                    <span class="col-span-1 row-span-2 material-icons pr-1">place</span>
                    <span class="font-normal">{{ $company->location }}</span>
                </p>
            </div>
        </div>
        <div class="basis-7/7 mt-4 mb-12 mx-72">
            <p class="text-center mt-4 mb-12 font-bold text-gray-700 text-4xl">{{ __('About') }}</p>
                <p class="font-normal break-words">{{ $company->about }}</p>
        </div>
        <div class="flex flex-col border b-r-1 b-b-1 min-h-screen bg-neutral-50">
            <p class="self-center mt-4 font-bold text-gray-700 text-4xl">{{ __('Job Offers') }}</p>
            @if(count($joboffers) == 0)
            <p class="self-center mt-24 text-gray-700 text-3xl">
            {{ __('There are no job offer entries.') }}
            </p>
            @else
            @foreach($joboffers as $offer)
            <div class="grid grid-cols-1 auto-cols-auto mt-12">
                <div class="break-all text-center py-4 mr-6 ml-1 mb-6">
                    <div class="block border-t-2 w-1/3 self-center place-self-center mx-auto">&nbsp;</div>
                    <p class="font-bold text-md text-gray-700">{{ __('Position') }}: <span class="font-normal">{{ $offer->position }}</span></p>
                    <p class="font-bold text-md text-gray-700">{{ __('Category') }}: <span class="font-normal">{{ $offer->category }}</span></p>
                    <p class="font-bold text-md text-gray-700">{{ __('Location') }}: <span class="font-normal">{{ $offer->location }}</span></p>
                    <p class="font-bold text-md text-gray-700">{{ __('Salary') }}: <span class="font-normal">   
                    @if(empty($offer->salary))
                        -
                        @else
                        {{ $offer->salary }}
                        @endif
                    </span></p>
                    <p class="font-bold text-md text-gray-700">{{ __('Workload') }}: <span class="font-normal">{{ $offer->workload }}</span></p>
                    <p class="font-bold text-md text-gray-700">{{ __('Posted at') }}: <span class="font-normal">{{ $offer->posted_at }}</span></p>
                </div>
            </div>
            @endforeach
            @endif
        </div>
        @else
        <div class="flex flex-row bg-neutral-50 border b-l-1">
            <div class="basis-1/7 mr-2">
                <img class="h-64 w-64 m-8 border rounded-full border-neutral-200 select-none" 
                src="{{ asset('no-image.png') }}">
            </div>    
            <div class="basis-6/7 shrink-0 pt-12 flex flex-col justify-center">
                <p class="text-5xl text-gray-700 font-bold pb-2">[{{ __('No Company Added') }}]</p>
                <p class="text-gray-700 capitalize font-bold pb-6">{{ __('Representer') }}: <span class="font-normal">{{ $user->firstname }} {{ $user->surname }}</span></p>
                <div class="flex flex-row items-center text-gray-700">
                    <span class="inline material-icons pr-2">email</span>
                    <p class="inline">{{ $user->email }}</p>
                </div>
            </div>
        </div>
        @endif
    </body>
</html>