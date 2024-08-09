<x-app-layout> {{--YA TENEMOS LA ESTRUCTURA DE LA PLANTILLA --}}
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Chirps') }} {{--DE ESTA MANERA ES PARA QUE SE PUEDA TRADUCIR EL TEXTO DENTRO DEL PARENTESIS--}}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form method="POST" action="{{ route('chirps.store') }}"> @csrf
                        <textarea class="block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" name="message"
                                  placeholder="{{__('What are you thinking?')}}">{{ old('message') }}
                        </textarea>
                        <x-input-error :messages="$errors->get('message')" class="mt-2"/>
                        <x-primary-button class="mt-4" >{{__('Chirp')}}</x-primary-button>
                    </form>
                </div>
            </div>
            <!-- --------------------------------------------------------- seccion de chirps ------------------------------------------------------------- -->

            <div class="mt-6 bg-white dark:bg-gray-800 shadow-sm rounded-lg divide-y dark:divide-gray-900">
                @foreach($chirps as $chirp)
                    <div class="p-6 flex space-x-2">
                        <svg class="h-6 w-6 text-gray-600 dark:text-gray-400 -scale-x-100" data-slot="icon" fill="none" stroke-width="1.5" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8.625 9.75a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0H8.25m4.125 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0H12m4.125 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0h-.375m-13.5 3.01c0 1.6 1.123 2.994 2.707 3.227 1.087.16 2.185.283 3.293.369V21l4.184-4.183a1.14 1.14 0 0 1 .778-.332 48.294 48.294 0 0 0 5.83-.498c1.585-.233 2.708-1.626 2.708-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0 0 12 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018Z"></path>
                        </svg>

                        <div class="flex-1">
                            <div class="flex justify-between items-center">
                                <div>
                                    <span class="text-gray-800 dark:text-gray-200">{{$chirp->user->name}}</span>
                                    <small class="ml-2 text-sm text-gray-600 dark:text-gray-400">{{$chirp->created_at->format('j M Y, g:i a')}}</small>
                                    @if($chirp->created_at != $chirp->updated_at)
                                        <small class="text-sm text-gray-600 dark:text-gray-400">
                                            &middot; {{__('edited')}}
                                        </small>
                                    @endif
                                </div>
                            </div>
                            <p class="mt-4 text-lg text-gray-900 dark:text-gray-100">{{$chirp->message}}</p>
                        </div>
                        @can('update', $chirp)
                            <x-dropdown>
                                <x-slot name="trigger">
                                    <button>
                                        <svg class="w-5 h-5 text-gray-500 dark:text-gray-300" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 12a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0ZM12.75 12a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0ZM18.75 12a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z" />
                                        </svg>
                                    </button>
                                </x-slot>
                                <x-slot name="content">
                                    <x-dropdown-link href="{{route('chirps.edit', $chirp)}}">{{__('Edit Chirp')}}</x-dropdown-link>

                                    <form method="POST" action="{{ route('chirps.destroy', $chirp) }}"> @csrf @method('DELETE')
                                        <x-dropdown-link :href="route('chirps.destroy', $chirp)" onClick="event.preventDefault(); this.closest('form').submit()">
                                            {{__('Delete Chirp')}}
                                        </x-dropdown-link>
                                    </form>
                                </x-slot>
                            </x-dropdown>
                        @endcan
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
