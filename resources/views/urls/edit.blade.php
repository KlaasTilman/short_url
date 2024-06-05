<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
            {{ __('Edit URL') }}
        </h2>
    </x-slot>

    <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
        <form method="POST" action="{{ route('urls.update', $url) }}" class="space-y-4">
            @csrf
            @method('patch')

            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">{{ __('Name') }}</label>
                <div class="mt-1">
                    <input type="text"
                        id="name"
                        name="name"
                        required
                        maxlength="255"
                        placeholder="{{ __('Enter the name of the URL') }}"
                        class="block w-full px-4 py-2 border border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-lg"
                        value="{{ old('name', $url->name) }}"
                    />
                </div>
                <x-input-error :messages="$errors->store->get('name')" class="mt-1 text-red-500" />
            </div>
            <div>
                <label for="og_url" class="block text-sm font-medium text-gray-700">{{ __('Original URL') }}</label>
                <div class="mt-1">
                    <input type="text"
                        id="og_url"
                        name="og_url"
                        required
                        maxlength="255"
                        placeholder="{{ __('Enter the original URL') }}"
                        class="block w-full px-4 py-2 border border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-lg"
                        value="{{ old('og_url', $url->og_url) }}"
                    />
                </div>
                <x-input-error :messages="$errors->store->get('og_url')" class="mt-1 text-red-500" />
            </div>
            <div class="mt-4 space-x-4">
                <x-primary-button>
                    <i class="fas fa-save mr-2"></i>{{ __('Save') }}
                </x-primary-button>
                <a href="{{ route('urls.index') }}" class="text-gray-700 hover:text-gray-900">
                    <i class="fas fa-times-circle mr-1"></i>{{ __('Cancel') }}
                </a>
            </div>
        </form>
    </div>
</x-app-layout>