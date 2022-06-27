<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" href="{{ asset('css/app.css') }}">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/material-design-icons/3.0.1/iconfont/material-icons.min.css" integrity="sha256-x8PYmLKD83R9T/sYmJn1j3is/chhJdySyhet/JuHnfY=" crossorigin="anonymous"/>
		<title>{{ __('Conversation') }} - {{ $name->firstname }} {{ $name->surname }}</title>
    </head>
    <body>
        <x-navbar/>
        <div class="mt-24">
            <svg class="block fill-emerald-700 h-28 w-28 mx-auto" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
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
        <div class="flex justify-start items-center py-2 mt-12 border-t border-x border-gray-300 font-normal w-1/2 mx-auto text-gray-600 text-center select-none text-lg">
            <div class="w-12 h-12 mx-4">
                <img class="object-cover h-12 w-12 rounded-full border border-gray-300" src="@if(file_exists('storage/avatars/'.$rid.'.jpg'))
                        {{ asset('storage/avatars/'.$rid.'.jpg') }}
                        @else
                        {{ asset('no-image.png') }}
                        @endif">
            </div>
            <a href="{{ route('visit.profile', $rid) }}" class="font-bold hover:text-emerald-800 hover:underline">{{ $name->firstname }} {{ $name->surname }}</a>
        </div>
        <div class="flex flex-col border border-gray-300 m-4 mt-0 w-1/2 mx-auto mb-0 overflow-y-auto max-h-96 h-96 p-6 ">
            @foreach($messages as $msg)
            @if($msg->senderid != $uid)
            <div class="self-start bg-amber-100 border border-transparent rounded-lg p-2 shadow-md mb-2">
            @else
            <div class="self-end bg-sky-100 border border-transparent rounded-lg p-2 shadow-md mb-2">
            @endif
                <div class="relative max-w-sm w-fit">{{$msg->message}}</div>
            </div>
            @endforeach
        </div>
        <div class="border-b mb-32 border-x border-gray-300 w-1/2 mx-auto py-4">
            <form method="POST" action="{{ route('msg.store') }}" class="flex flex-row justify-center items-center" id="form">
                @csrf
                <input type="hidden" name="fromprofile" value="1">
                <input type="hidden" name="senderid" value="{{ $uid }}">
                <input type="hidden" name="receiverid" value="{{ $rid }}">
                <input type="text" name="message" placeholder="{{ __('Message') }}" class="w-1/2 bg-gray-100 px-2 py-1.5 rounded-full border-1.5 border-gray-300 focus:outline-emerald-700 mr-2.5">
                <span onclick="sendForm()" class="material-icons cursor-pointer">send</span>   
            </form>
        </div>
        <script>
            function sendForm() {
                document.getElementById('form').submit();
            }
        </script>
    </body>
</html>