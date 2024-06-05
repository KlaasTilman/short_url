<x-app-layout>
    <head>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    </head>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Token generator') }}
        </h2>
    </x-slot>
    <div class="max-w-3xl mx-auto p-4 sm:p-6 lg:p-8">
        <form method="POST" action="{{ route('token.store') }}" class="space-y-4">
            @csrf
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">{{ __('Name') }}</label>
                <div class="mt-1">
                    <input type="text"
                        id="name"
                        name="name"
                        required
                        maxlength="200"
                        placeholder="{{ __('Enter the name of the token') }}"
                        class="block w-full px-4 py-2 border border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-lg"
                        value="{{ old('name') }}"
                    />
                </div>
                <x-input-error :messages="$errors->store->get('name')" class="mt-1 text-red-500" />
            </div>
            <x-primary-button class="mt-4">
                <i class="fas fa-save mr-2"></i>{{ __('Generate') }}
            </x-primary-button>
        </form>
    </div>
    <div class="max-w-3xl mx-auto p-4 sm:p-6 lg:p-8 bg-gray-100 rounded-lg mt-6">
        <div class="flex items-center">
            <i class="fas fa-key text-indigo-500 mr-2"></i>
            <span class="font-semibold text-gray-700">Token:</span>
            <span class="ml-2 px-2 py-1 bg-indigo-50 text-indigo-700 rounded-md break-all">{{ $token }}</span>
        </div>
    </div>
</x-app-layout>