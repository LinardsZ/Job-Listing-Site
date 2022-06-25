<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" href="{{ asset('css/app.css') }}">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/material-design-icons/3.0.1/iconfont/material-icons.min.css" integrity="sha256-x8PYmLKD83R9T/sYmJn1j3is/chhJdySyhet/JuHnfY=" crossorigin="anonymous"/>
		<script src="https://cdn.tailwindcss.com"></script>
		<title>Admin Panel</title>
    </head>
    <body>
        <x-navbar/>
        @if(isset($users))
        <p class="font-bold text-red-900 text-center text-4xl my-12 select-none">Administration Panel</p>
        <div class="flex flex-col w-2/3 mx-auto">
        @foreach($users as $user)
            <div class="bg-neutral-50 border border-gray-300 p-4 rounded flex flex-row space-between mb-4">
                <div class="grow-0 pr-2">
                    <p class="text-xl uppercase font-bold hover:text-emerald-700 cursor-default">{{ $user->firstname }} {{ $user->surname }}</p>
                    <p class="pb-2 italic text-gray-700"> <span class="font-bold">Username:</span> {{ $user->username }} </p>
                    <p class="pb-2 italic text-gray-700"> <span class="font-bold">E-mail:</span> {{ $user->email }} </p>
                </div>
                
                <div class="ml-auto flex flex-col justify-around shrink-0">
                    @if(isset($user->companyid))
                    <div class="flex flex-row justify-center">
                        <a href="/view/company/{{$user->companyid}}" class="text-gray-700 underline text-sm cursor-pointer hover:text-emerald-700 mr-2">View Company</a>
                    </div>
                    @endif
                    <div class="flex flex-row justify-center">
                        <a href="/view/user/{{$user->userid}}" class="text-gray-700 underline text-sm cursor-pointer hover:text-emerald-700 mr-2">View Profile</a>
                    </div>
                    <p class="font-bold text-gray-700">Account created at: <span class="font-normal">{{ $user->created_at }}</span></p>
                </div>
            </div>
        @endforeach
        </div>
        {{ $users->links() }}
        @else
        <p class="font-bold text-gray-700 text-center text-2xl">Database is empty.</p>
        @endif
    </body>
</html>