<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" href="{{ asset('css/app.css') }}">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/material-design-icons/3.0.1/iconfont/material-icons.min.css" integrity="sha256-x8PYmLKD83R9T/sYmJn1j3is/chhJdySyhet/JuHnfY=" crossorigin="anonymous"/>
		<title>{{ __('Administration Panel') }} - {{ __('View User') }} #{{$user->userid}}</title>
    </head>
    <body class="bg-neutral-50">
        <x-navbar/>
        <p class="bg-neutral-50 font-bold text-red-900 text-center text-4xl my-12 select-none">{{ __('Administrator Mode') }}</p>
        <div class="flex flex-row bg-neutral-50 border b-l-1">
            <div class="basis-1/7 mr-2 flex flex-col">
                <img class="h-64 w-64 mt-8 mx-8 mb-2 border rounded-full border-neutral-200 select-none" 
                src="@if(file_exists('storage/avatars/'.$user->userid.'.jpg'))
                    {{ asset('storage/avatars/'.$user->userid.'.jpg') }}
                    @else
                    {{ asset('no-image.png') }}
                    @endif">
                <a href="{{ route('admin.deletepicture', $user->userid) }}" class="mb-6 text-center font-bold text-gray-700 underline text-sm cursor-pointer hover:text-emerald-700">{{ __('Delete Picture') }}</a>
            </div>    
            <div class="basis-5/7 shrink-0 pt-12 flex flex-col justify-center">
                <p class="text-5xl text-gray-700 font-bold capitalize pb-6">{{ $user->firstname }} {{ $user->surname }}</p>
                <div class="flex flex-row items-center pb-2">
                    <span class="inline material-icons pr-2">email</span>
                    <p class="inline">{{ $user->email }}</p>
                </div>
                <p class="pb-2 italic text-gray-700"> <span class="font-bold">{{ __('Username') }}:</span> {{ $user->username }} </p>
                <p class="pb-2 italic text-gray-700"> <span class="font-bold">{{ __('Created at') }}:</span> {{ $user->created_at }} </p>
            </div>
            <div class="basis-1/7 grow-0 shrink-0 ml-auto mr-24 flex flex-col justify-center">
                <a href="{{ route('admin.edituser', $user->userid) }}" class="mb-6 block font-bold text-white text-center p-2 bg-gray-800 text-xl border-0 rounded-md border-gray-800 hover:bg-emerald-800 
                    ease-in-out duration-300 cursor-pointer select-none">{{ __('Edit Profile') }}</a>
                <a href="{{ route('admin.deleteuser', $user->userid) }}" class="block font-bold text-white text-center p-2 bg-gray-800 text-xl border-0 rounded-md border-gray-800 hover:bg-red-800 
                ease-in-out duration-300 cursor-pointer select-none">{{ __('Delete Profile') }}</a>
                <a href="{{ route('show.admin') }}" class="mt-6 block font-bold text-white text-center p-2 bg-gray-800 text-xl border-0 rounded-md border-gray-800 
                    ease-in-out duration-300 cursor-pointer select-none hover:bg-blue-900">{{ __('Manage Site') }}</a>
            </div>
        </div>
        <div class="space-between flex flex-row">
            <div class="flex flex-col basis-1/2 border b-r-1 b-b-1 min-h-screen bg-neutral-50">
                <p class="self-center mt-4 font-bold text-gray-700 text-4xl">{{ __('Experience') }}</p>
                @if(isset($experience) && count($experience) != 0)
                <span onclick="showExpForm()" class="self-center mt-4 font-bold text-gray-700 underline text-sm cursor-pointer hover:text-emerald-700">+ {{ __('Add New') }}</span>
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
                        <a href="/experience/edit/{{$item->expid}}" class="mt-4 font-bold text-gray-700 underline text-sm cursor-pointer hover:text-emerald-700">{{ __('Update') }}</a>
                        <form class="inline" action="/experience/delete/{{$item->expid}}" method="POST">
                            @method('DELETE')
                            @csrf
                            <input type="submit" value="{{ __('Delete') }}" class="mt-4 font-bold text-gray-700 underline text-sm cursor-pointer hover:text-emerald-700">
                        </form>
                    </div>
                @endforeach
                </div>
                @else
                <p class="self-center mt-24 text-gray-700 text-3xl">
                {{ __('There are no entries for experience. Add one') }} <span onclick="showExpForm()" class="self-center mt-4 font-bold text-gray-700 underline cursor-pointer hover:text-emerald-700">{{ __('here') }}</span>!
                </p>
                @endif
            </div>
            <div class="flex flex-col basis-1/2 border b-b-1 min-h-screen bg-neutral-50">
                <p class="self-center mt-4 font-bold text-gray-700 text-4xl">{{ __('Education') }}</p>
                @if(isset($education) && count($education) != 0)
                <span onclick="showEduForm()" class="self-center mt-4 font-bold text-gray-700 underline text-sm cursor-pointer hover:text-emerald-700">+ {{ __('Add New') }}</span>
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
                        <a href="/education/edit/{{$item->eduid}}" class="mt-4 font-bold text-gray-700 underline text-sm cursor-pointer hover:text-emerald-700">{{ __('Update') }}</a>
                        <form class="inline" action="/education/delete/{{$item->eduid}}" method="POST">
                            @method('DELETE')
                            @csrf
                            <input type="submit" value="{{ __('Delete') }}" class="mt-4 font-bold text-gray-700 underline text-sm cursor-pointer hover:text-emerald-700">
                        </form>
                    </div>
                @endforeach
                </div>
                @else
                <p class="self-center mt-24 text-gray-700 text-3xl">
                {{ __('There are no entries for education. Add one') }} <span onclick="showEduForm()" class="self-center mt-4 font-bold text-gray-700 underline cursor-pointer hover:text-emerald-700">{{ __('here') }}</span>!
                </p>
                @endif
            </div>
        </div>
        <form id="expform" action="{{ route('admin.newexp') }}" method="POST" onsubmit="return validateExpForm()" style="box-shadow: 0 0 0 100vw rgb(0 0 0 / 0.5);"
        class="hidden flex-col bg-neutral-50 z-10 h-fit w-fit border border-neutral-200 px-12 py-6 fixed left-0 right-0 mx-auto top-0 bottom-0 my-auto box-shadow">
        @csrf
        <input type="hidden" name="userid" value="{{$user->userid}}">
        <span class="material-icons self-end pb-8 cursor-pointer" onclick="closeExpForm()">close</span>
            <div class="flex flex-row justify-between pb-4">
                <label for="workplace" class="font-bold text-gray-700 text-md pr-2">{{ __('Workplace') }}: </label>
                <input type="text" required name="workplace" id="workplace" class="border border-neutral-300 w-72">
            </div>

            <div class="flex flex-row justify-between pb-4">
                <label for="position" class="font-bold text-gray-700 text-md pr-2">{{ __('Position') }}: </label>
                <input type="text" required name="position" id="position" class="border border-neutral-300 w-72">
            </div>

            <div class="flex flex-row justify-center">
                <div class="mr-4">
                    <label for="startyear_exp" class="font-bold text-gray-700 text-md">{{ __('Start year') }}: </label>
                    <input type="number" required name="startyear" id="startyear_exp" class="border border-neutral-300 w-16">
                </div>
                <div>
                    <label for="endyear_exp" class="font-bold text-gray-700 text-md">{{ __('End year') }}: </label>
                    <input type="number" name="endyear" id="endyear_exp" class="border border-neutral-300 w-16">
                </div>
              
            </div>
            <span class="bg-red-200 px-2 py-1 mt-2 border-l-4 border-red-700 font-bold text-sm" id="error_exp">
            @error('warning_exp')
            {{$message}}
            @enderror
            </span>
            <input type="submit" value="{{ __('Add') }}" class="mt-4 block font-bold text-white text-center p-2 bg-gray-800 text-xl border-0 rounded-md border-gray-800 hover:bg-emerald-800 
                    ease-in-out duration-300 cursor-pointer select-none">
        </form>
        <form id="eduform" method="POST" action="{{ route('admin.newedu') }}" onsubmit="return validateEduForm()" style="box-shadow: 0 0 0 100vw rgb(0 0 0 / 0.5);" 
        class="flex flex-col bg-neutral-50 z-10 h-fit w-fit border border-neutral-200 
        px-12 py-6 fixed left-0 right-0 mx-auto top-0 bottom-0 my-auto box-shadow">
        @csrf
        <input type="hidden" name="userid" value="{{$user->userid}}">
        <span class="material-icons self-end pb-8 cursor-pointer" onclick="closeEduForm()">close</span>
            <div class="flex flex-row justify-between pb-4">
                <label for="institution" class="font-bold text-gray-700 text-md pr-2">{{ __('Institution') }}: </label>
                <input type="text" required name="institution" id="institution" class="border border-neutral-300 w-72">
            </div>

            <div class="flex flex-row justify-between pb-4">
                <label for="program" class="font-bold text-gray-700 text-md pr-2">{{ __('Program') }}: </label>
                <input type="text" required name="program" id="program" class="border border-neutral-300 w-72">
            </div>

            <div class="flex flex-row justify-center">
                <div class="mr-4">
                    <label for="startyear_edu" class="font-bold text-gray-700 text-md">{{ __('Start year') }}: </label>
                    <input type="number" required name="startyear" id="startyear_edu" class="border border-neutral-300 w-16">
                </div>
                <div>
                    <label for="endyear_edu" class="font-bold text-gray-700 text-md">{{ __('End year') }}: </label>
                    <input type="number" name="endyear" id="endyear_edu" class="border border-neutral-300 w-16">
                </div>
              
            </div>
            <span class="bg-red-200 px-2 py-1 mt-2 border-l-4 border-red-700 font-bold text-sm" id="error_edu">
            @error('warning_edu')
            {{$message}}
            @enderror
            </span>
            <input type="submit" value="{{ __('Add') }}" class="mt-4 block font-bold text-white text-center p-2 bg-gray-800 text-xl border-0 rounded-md border-gray-800 hover:bg-emerald-800 
                    ease-in-out duration-300 cursor-pointer select-none">
        </form>
        <script src="{{ asset('js/experience_form.js') }}"></script>
        <script src="{{ asset('js/education_form.js') }}"></script>    
    </body>
</html>