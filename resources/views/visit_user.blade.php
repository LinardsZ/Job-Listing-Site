<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="icon" type="image/x-icon" href="{{ asset('favicon.svg') }}">
		<link rel="stylesheet" href="{{ asset('css/app.css') }}">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/material-design-icons/3.0.1/iconfont/material-icons.min.css" integrity="sha256-x8PYmLKD83R9T/sYmJn1j3is/chhJdySyhet/JuHnfY=" crossorigin="anonymous"/>
		<title>{{ $data->firstname }} {{ $data->surname }}'s {{ __('Profile') }}</title>
    </head>
    <body class="bg-neutral-50">
        <x-navbar/>
        <div class="flex flex-row bg-neutral-50 border b-l-1">
            <div class="basis-1/7 mr-2">
                <img class="h-64 w-64 m-8 border rounded-full border-neutral-200 select-none" 
                src="@if(file_exists('storage/avatars/'.$data->userid.'.jpg'))
                    {{ asset('storage/avatars/'.$data->userid.'.jpg') }}
                    @else
                    {{ asset('no-image.png') }}
                    @endif">
            </div>    
            <div class="basis-6/7 shrink-0 pt-12 flex flex-col justify-center">
                <p class="text-5xl text-gray-700 font-bold capitalize pb-8">{{ $data->firstname }} {{ $data->surname }}</p>
                <div class="flex flex-row items-center">
                    <span class="inline material-icons pr-2">email</span>
                    <p class="inline">{{ $data->email }}</p>
                </div>
            </div>
        </div>
        <div class="space-between flex flex-row">
            <div class="flex flex-col basis-1/2 border b-r-1 b-b-1 min-h-screen bg-neutral-50">
                <p class="self-center mt-4 font-bold text-gray-700 text-4xl">{{ __('Experience') }}</p>
                @if(count($experience) != 0)
                <div class="grid grid-cols-2 auto-cols-auto mt-12">
                @foreach($experience as $item)
                    <div class="break-all text-center border-t border-l py-4 mr-6 ml-1 mb-6">
                        <p class="font-bold text-md text-gray-700">{{ __('Workplace') }}: <span class="font-normal">{{ $item->workplace }}</span></p>
                        <p class="font-bold text-md text-gray-700">{{ __('Position') }}: <span class="font-normal">{{ $item->position }}</span></p>
                        <p class="font-bold text-md text-gray-700">{{ __('Start year') }}: <span class="font-normal">{{ $item->startyear }}</span></p>
                        <p class="font-bold text-md text-gray-700">
                        {{ __('End year') }}: 
                            <span class="font-normal">
                            @if(!empty($item->endyear))
                            {{ $item->endyear }}
                            @else
                            -
                            @endif
                            </span>
                        </p>
                    </div>
                @endforeach
                </div>
                @else
                <p class="self-center mt-24 text-gray-700 text-3xl">
                {{ __('There are no entries for experience.') }} 
                </p>
                @endif
            </div>
            <div class="flex flex-col basis-1/2 border b-b-1 min-h-screen bg-neutral-50">
                <p class="self-center mt-4 font-bold text-gray-700 text-4xl">{{ __('Education') }}</p>
                @if(count($education) != 0)
                <div class="grid grid-cols-2 auto-cols-auto mt-12">
                @foreach($education as $item)
                    <div class="break-all text-center border-t border-r py-4 ml-6 mb-6 mr-1">
                        <p class="font-bold text-md text-gray-700">{{ __('Institution') }}: <span class="font-normal">{{ $item->institution }}</span></p>
                        <p class="font-bold text-md text-gray-700">{{ __('Program') }}: <span class="font-normal">{{ $item->program }}</span></p>
                        <p class="font-bold text-md text-gray-700">{{ __('Start year') }}: <span class="font-normal">{{ $item->startyear }}</span></p>
                        <p class="font-bold text-md text-gray-700">
                        {{ __('End year') }}: 
                            <span class="font-normal">
                            @if(!empty($item->endyear))
                            {{ $item->endyear }}
                            @else
                            -
                            @endif
                            </span>
                        </p>
                    </div>
                @endforeach
                </div>
                @else
                <p class="self-center mt-24 text-gray-700 text-3xl">
                {{ __('There are no entries for education.') }}
                </p>
                @endif
            </div>
        </div>
    </body>
</html>