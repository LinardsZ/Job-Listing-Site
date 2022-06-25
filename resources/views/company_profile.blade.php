<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="icon" type="image/x-icon" href="{{ asset('favicon.svg') }}">
		<link rel="stylesheet" href="{{ asset('css/app.css') }}">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/material-design-icons/3.0.1/iconfont/material-icons.min.css" integrity="sha256-x8PYmLKD83R9T/sYmJn1j3is/chhJdySyhet/JuHnfY=" crossorigin="anonymous"/>
		<script src="https://cdn.tailwindcss.com"></script>
		<title>Company Profile</title>
    </head>
    <body class="bg-neutral-50">
        <x-navbar/>
        <div class="flex flex-row bg-neutral-50 border b-l-1">
            <div class="basis-1/7 mr-2">
                <img class="h-64 w-64 m-8 border border-neutral-200 select-none" src="{{ asset('no-image.png') }}">
            </div>    
            <div class="basis-5/7 shrink-0 pt-12 flex flex-col justify-center">
                <p class="text-5xl text-gray-700 font-bold capitalize pb-2">{{ $company->name }}</p>
                <p class="text-gray-700 capitalize font-bold pb-6">Representer: <span class="font-normal">{{ $user->firstname }} {{ $user->surname }}</span></p>
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
            <div class="basis-1/7 grow-0 shrink-0 ml-auto mr-24 flex items-center">
                <a href="{{ route('edit.company') }}" class="block font-bold text-white text-center p-2 bg-gray-800 text-xl border-0 rounded-md border-gray-800 hover:bg-emerald-800 
                    ease-in-out duration-300 cursor-pointer select-none">Edit Company</a>
            </div>
        </div>
        <div class="basis-7/7 mt-4 mb-12 mx-72">
            <p class="text-center mt-4 mb-12 font-bold text-gray-700 text-4xl">About</p>
                <p class="font-normal break-words">{{ $company->about }}</p>
        </div>
        <div class="flex flex-col border b-r-1 b-b-1 min-h-screen bg-neutral-50">
            <p class="self-center mt-4 font-bold text-gray-700 text-4xl">Job Offers</p>
            @if(count($joboffers) == 0)
            <p class="self-center mt-24 text-gray-700 text-3xl">
                There are no job offer entries. Add one <span onclick="showOfferForm()" class="self-center mt-4 font-bold text-gray-700 underline cursor-pointer hover:text-emerald-700">here</span>!
            </p>
            @else
            <span onclick="showOfferForm()" class="self-center mt-4 font-bold text-gray-700 underline text-sm cursor-pointer hover:text-emerald-700">+ Add New</span>
            @foreach($joboffers as $offer)
            <div class="grid grid-cols-1 auto-cols-auto mt-12">
                <div class="break-all text-center py-4 mr-6 ml-1 mb-6">
                    <div class="block border-t-2 w-1/3 self-center place-self-center mx-auto">&nbsp;</div>
                    <p class="font-bold text-md text-gray-700">Position: <span class="font-normal">{{ $offer->position }}</span></p>
                    <p class="font-bold text-md text-gray-700">Category: <span class="font-normal">{{ $offer->category }}</span></p>
                    <p class="font-bold text-md text-gray-700">Location: <span class="font-normal">{{ $offer->location }}</span></p>
                    <p class="font-bold text-md text-gray-700">Salary: <span class="font-normal">   
                    @if(empty($offer->salary))
                        -
                        @else
                        {{ $offer->salary }}
                        @endif
                    </span></p>
                    <p class="font-bold text-md text-gray-700">Workload: <span class="font-normal">{{ $offer->workload }}</span></p>
                    <p class="font-bold text-md text-gray-700">Posted at: <span class="font-normal">{{ $offer->posted_at }}</span></p>
                    <div>
                        <a href="/listing/{{ $offer->offerid }}" class="mt-4 font-bold text-gray-700 underline text-sm cursor-pointer hover:text-emerald-700">View</a>
                        <a href="/offer/edit/{{ $offer->offerid }}" class="mt-4 font-bold text-gray-700 underline text-sm cursor-pointer hover:text-emerald-700">Update</a>
                        <form class="inline" action="/offer/delete/{{ $offer->offerid }}" method="POST">
                            @method('DELETE')
                            @csrf
                            <input type="submit" value="Delete" class="mt-4 font-bold text-gray-700 underline text-sm cursor-pointer hover:text-emerald-700">
                        </form>
                    </div>
                </div>
            </div>
            @endforeach
            @endif
        </div>
        <form id="joboffer" action="{{ route('add.offer') }}" method="POST" onsubmit="return validateOffer()" style="box-shadow: 0 0 0 100vw rgb(0 0 0 / 0.5);"
        class="hidden flex-col bg-neutral-50 z-10 h-fit w-fit border border-neutral-200 px-12 py-6 fixed left-0 right-0 mx-auto top-0 bottom-0 my-auto box-shadow">
        @csrf
        <span class="material-icons self-end pb-8 cursor-pointer" onclick="closeOfferForm()">close</span>
            <div class="flex flex-row justify-between pb-4">
                <label for="position" class="font-bold text-gray-700 text-md pr-2">Position: </label>
                <input type="text" name="position" id="position" class="border border-neutral-300 w-72">
            </div>

            <div class="flex flex-row justify-between pb-4">
                <label for="category" class="font-bold text-gray-700 text-md pr-2">Category: </label>
                <input type="text" name="category" id="category" class="border border-neutral-300 w-72">
            </div>

            <div class="flex flex-row justify-between pb-4">
                <label for="location" class="font-bold text-gray-700 text-md pr-2">Location: </label>
                <input type="text" name="location" id="location" class="border border-neutral-300 w-72">
            </div>
            
            <div class="flex flex-row justify-between pb-4">
                <label for="salary" class="font-bold text-gray-700 text-md pr-2">Salary: </label>
                <input type="number" name="salary" id="salary" class="border border-neutral-300 w-72">
            </div>

            <div class="flex flex-row justify-between pb-4">
                <label for="workload" class="font-bold text-gray-700 text-md pr-2">Workload: </label>
                <input type="text" name="workload" id="workload" class="border border-neutral-300 w-72">
            </div>

            <div class="flex flex-row justify-between pb-4">
                <label for="description" class="font-bold text-gray-700 text-md pr-2">Description: </label>
                <textarea name="description" id="description" class="border border-neutral-300 w-72 resize-none overflow-y text-sm p-1.5" rows="10"></textarea>
            </div>

            <div class="flex flex-row justify-between pb-4">
                <label for="extra_info" class="font-bold text-gray-700 text-md pr-2">Extra information: </label>
                <input type="text" name="extra_info" id="extra_info" class="border border-neutral-300 w-72">
            </div>
            <div class="flex flex-col justify-around pb-4">
                <span class="msgs bg-red-200 px-2 py-1 border-l-4 border-red-700 font-bold text-sm mb-1" id="error-general"></span>
                <span class="msgs bg-red-200 px-2 py-1 border-l-4 border-red-700 font-bold text-sm mb-1" id="error-position"></span>
                <span class="msgs bg-red-200 px-2 py-1 border-l-4 border-red-700 font-bold text-sm mb-1" id="error-category"></span>
                <span class="msgs bg-red-200 px-2 py-1 border-l-4 border-red-700 font-bold text-sm mb-1" id="error-location"></span>
                <span class="msgs bg-red-200 px-2 py-1 border-l-4 border-red-700 font-bold text-sm mb-1" id="error-workload"></span>
                <span class="msgs bg-red-200 px-2 py-1 border-l-4 border-red-700 font-bold text-sm mb-1" id="error-extra_info"></span>
            </div>
            
            <input type="submit" value="Add" class="mt-4 block font-bold text-white text-center p-2 bg-gray-800 text-xl border-0 rounded-md border-gray-800 hover:bg-emerald-800 
                    ease-in-out duration-300 cursor-pointer select-none">
        </form>
        <script src="{{ asset('js/validate_offer.js') }}"></script>
    </body>
</html>