<x-app-layout> {{--YA TENEMOS LA ESTRUCTURA DE LA PLANTILLA --}}
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Chirps') }} {{--DE ESTA MANERA ES PARA QUE SE PUEDA TRADUCIR EL TEXTO DENTRO DEL PARENTESIS--}}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form method="POST" action="{{route('chirps.update', $chirp)}}"> @csrf @method('PUT')
                        <textarea name="message" class="block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" name="message"
                                  placeholder="{{__('What are you thinking?')}}">{{ old('message', $chirp->message) }}
                        </textarea>
                        <x-input-error :messages="$errors->get('message')" class="mt-2"/>
                        <x-primary-button class="mt-4" >{{__('Chirp')}}</x-primary-button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
