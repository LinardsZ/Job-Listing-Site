<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" href="{{ asset('css/app.css') }}">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/material-design-icons/3.0.1/iconfont/material-icons.min.css" integrity="sha256-x8PYmLKD83R9T/sYmJn1j3is/chhJdySyhet/JuHnfY=" crossorigin="anonymous"/>
        <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
		<title>{{ $listing->position }}</title>
    </head>
    <body class="bg-neutral-100">
        @if(session()->has('message'))
		<div x-data="{show: true}" x-init="setTimeout(() => show = false, 2000)" x-show="show" x-transition:enter.duration.0ms x-transition:leave.duration.300ms
		class="fixed top-0 left-1/2 transform -translate-x-1/2 bg-emerald-700 text-white font-bold py-4 px-32">
			{{session('message')}}
		</div>
		@endif
        <x-navbar/>
        <div class="flex flex-col w-1/2 mx-auto my-24">
            <div class="flex flex-row bg-neutral-50 border border-neutral-200 py-4">
                <div class="flex items-center">
                    <img class="h-32 w-32 ml-6 select-none" 
                    src="@if(file_exists('storage/avatars/'.$data->userid.'.jpg'))
                    {{ asset('storage/avatars/'.$data->userid.'.jpg') }}
                    @else
                    {{ asset('no-image.png') }}
                    @endif">
                </div>
                <div class="flex-1 px-4">
                    <p class="font-bold text-2xl text-gray-600 break-all select-none">{{ $listing->position }}</p>
                    <p class="italic text-gray-700 pt-2 pb-16">{{ $data->name }}</p>
                </div>
                @auth
                <div class="flex flex-col pr-4 justify-center">
                    @if(Auth::id() != $data->userid)
                    <a href="mailto:{{ $data->email }}" class="block font-bold text-white text-center mb-4 py-2 px-4 bg-gray-700 text-xl border-0 rounded-md border-gray-800 hover:bg-emerald-700 
                    ease-in-out duration-300 cursor-pointer select-none">{{ __('Send e-mail') }}</a>
                     <button onclick="showMessageForm()" class="block font-bold text-white text-center mb-4 py-2 px-4 bg-gray-700 text-xl border-0 rounded-md border-gray-800 hover:bg-emerald-700 
                    ease-in-out duration-300 cursor-pointer select-none">{{ __('Start a conversation') }}</button>
                    @endif
                </div>
                @else
                <div class="flex flex-col pr-4 justify-center">
                    @if(Auth::id() != $data->userid)
                    <a href="mailto:{{ $data->email }}" class="block font-bold text-white text-center mb-4 py-2 px-4 bg-gray-700 text-xl border-0 rounded-md border-gray-800 hover:bg-emerald-700 
                    ease-in-out duration-300 cursor-pointer select-none">{{ __('Send e-mail') }}</a>
                    @endif
                </div>
                @endauth
            </div>
            <div class="flex justify-between flex-row bg-neutral-50 p-4 border-x border-b border-neutral-200">
                <pre class="float-right whitespace-pre-wrap font-sans">{{ $listing->description }}</pre>

                <div class="float-left flex flex-col shrink-0 grow-0 pl-4">
                    <p class="inline font-bold pb-8 text-lg text-gray-600">{{ __('Information about the offer') }}</p>
                    
                    <div class="pb-2 grid grid-rows-2 grid-cols-10 items-center">
                        <span class="col-span-1 row-span-2 material-icons pr-1">place</span>
                        <div class="col-span-9 row-span-2">
                            <p class="text-sm">{{ __('Location') }}:</p>
                            <p class="text-sm">{{ $listing->location }}</p>
                        </div>
                    </div>
                    
                    <div class="pb-2 grid grid-rows-2 grid-cols-10 items-center">
                        <span class="col-span-1 row-span-2 material-icons pr-1">euro_symbol</span>
                        <div class="col-span-9 row-span-2">
                            <p class="text-sm">{{ __('Salary') }}:</p>
                            <p class="text-sm">
                                @if($listing->salary)
                                {{ $listing->salary }} 
                                @else
                                -
                                @endif
                                €/{{ __('month') }}</p>
                        </div>
                    </div>

                    <div class="pb-2 grid grid-rows-2 grid-cols-10 items-center">
                        <span class="col-span-1 row-span-2 material-icons pr-1">schedule</span>
                        <div class="col-span-9 row-span-2">
                            <p class="text-sm">{{ __('Workload') }}:</p>
                            <p class="text-sm">{{ $listing->workload }}</p>
                        </div>
                    </div>

                    <div class="pb-2 grid grid-rows-2 grid-cols-10 items-center">
                        <span class="col-span-1 row-span-2 material-icons pr-1">today</span>
                        <div class="col-span-9 row-span-2">
                            <p class="text-sm">{{ __('Posted at') }}:</p>
                            <p class="text-sm">{{ $listing->posted_at }}</p>
                        </div>
                    </div>
                    
                    <div class="pb-2 grid grid-rows-2 grid-cols-10 items-center">
                        <span class="col-span-1 row-span-2 material-icons pr-1">domain</span>
                        <div class="col-span-9 row-span-2">
                            <p class="text-sm">{{ __('Registry No.') }}:</p>
                            <p class="text-sm">{{ $data->registryid }}</p>
                        </div>
                    </div>
                </div>
            </div>  
        </div>
        <form id="msgform" method="POST" action="{{ route('msg.store') }}" style="box-shadow: 0 0 0 100vw rgb(0 0 0 / 0.5);" 
        class="hidden flex-col bg-neutral-50 z-10 h-fit w-fit border border-neutral-200 
        px-12 py-6 fixed left-0 right-0 mx-auto top-0 bottom-0 my-auto box-shadow">
        @csrf
        <input type="hidden" name="check" value="{{ Auth::id() }}">
        <input type="hidden" name="userid" value="{{ $data->userid }}">
        <span class="material-icons self-end pb-4 cursor-pointer select-none" onclick="closeMessageForm()">close</span>
            <p class="font-bold text-gray-700 text-center mb-12 select-none">{{ __('Send a message to') }} <span class="font-normal">{{ $data->name }}</span></p>
            <div class="flex flex-col justify-between pb-4">
                <label for="institution" class="font-bold text-gray-700 text-md pr-2 select-none">{{ __('Message') }}: </label>
                <textarea name="message" id="message" class="border border-neutral-300 w-72 resize-y overflow-y p-1.5 text-sm selection:bg-emerald-700 selection:text-white" rows="8"></textarea>
            </div>

            <input type="submit" value="{{ __('Send') }}" class="mt-4 block font-bold text-white text-center p-2 bg-gray-800 text-xl border-0 rounded-md border-gray-800 hover:bg-emerald-800 
                    ease-in-out duration-300 cursor-pointer select-none">
        </form>
        <script src="{{ asset('js/message_form.js') }}"></script>
    </body>
</html>