<x-app-layout>
    <head>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    </head>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Urls Overview') }}
        </h2>
    </x-slot>
    <div class="max-w-4xl mx-auto p-4 sm:p-6 lg:p-8">
        <form method="POST" action="{{ route('urls.store') }}" class="space-y-4">
            @csrf
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">{{ __('Name') }}</label>
                <div class="mt-1">
                    <input type="text"
                        id="name"
                        name="name"
                        required
                        maxlength="200"
                        placeholder="{{ __('Enter the name of the URL') }}"
                        class="block w-full px-4 py-2 border border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-lg"
                        value="{{ old('name') }}"
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
                        maxlength="200"
                        placeholder="{{ __('Enter the original URL') }}"
                        class="block w-full px-4 py-2 border border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-lg"
                        value="{{ old('og_url') }}"
                    />
                </div>
                <x-input-error :messages="$errors->store->get('og_url')" class="mt-1 text-red-500" />
            </div>
            <x-primary-button class="mt-4">
                <i class="fas fa-save mr-2"></i>{{ __('Save') }}
            </x-primary-button>
        </form>

        <div class="mt-6 bg-white shadow-sm rounded-lg divide-y">
            @foreach ($urls as $item)
                <div class="p-6 flex space-x-6">
                    <!-- Left box -->
                    <div class="w-1/2 p-4 border-r border-gray-200 relative">
                        @if ($item->user->is(auth()->user()))
                        <x-dropdown>
                            <x-slot name="trigger">
                                <button class="flex items-center">
                                    <i class="fas fa-edit text-gray-400 mr-2"></i>
                                </button>
                            </x-slot>
                            <x-slot name="content">
                                <x-dropdown-link :href="route('urls.edit', $item)">
                                    {{ __('Edit') }}
                                </x-dropdown-link>
                                <form method="POST" action="{{ route('urls.destroy', $item) }}">
                                    @csrf
                                    @method('delete')
                                    <x-dropdown-link :href="route('urls.destroy', $item)" onclick="event.preventDefault(); this.closest('form').submit();">
                                        {{ __('Delete') }}
                                    </x-dropdown-link>
                                </form>
                            </x-slot>
                        </x-dropdown>
                        @endif
                        <div>
                            <span class="block text-gray-800 text-lg mt-2">
                                <i class="fas fa-user mr-2"></i>Created by: {{ $item->user->name }}
                            </span>
                            <span class="block text-gray-600 text-lg">
                                <i class="fas fa-calendar-alt mr-2"></i>Created at: {{ $item->created_at->format('j M Y, g:i a') }}
                            </span>
                            @unless ($item->created_at->eq($item->updated_at))
                                <span class="block text-gray-600 text-lg">
                                    <i class="fas fa-calendar-alt mr-2"></i>Edited at: {{ $item->updated_at->format('j M Y, g:i a') }}
                                </span>
                            @endunless
                        </div>
                    </div>

                    <!-- Right box -->
                    <div class="w-1/2 p-4 flex flex-col">
                        <div class="flex justify-between items-center">
                            <div>
                                <p class="text-lg text-gray-900">
                                    <i class="fas fa-tag mr-2"></i>{{ __('Name: ') }} {{ $item->name }}
                                </p>
                                <p class="mt-2 text-lg text-gray-900">
                                    <i class="fas fa-link mr-2"></i>{{ __('Original Url: ') }}{{ $item->og_url }}
                                </p>
                                <p class="mt-2 text-lg text-gray-900">
                                    <i class="fas fa-compress-arrows-alt mr-2"></i>{{ __('Short Url: ') }}
                                    <a href="{{ route('short-url', $item->short_url) }}" target="_blank">
                                        {{ route('short-url', $item->short_url) }}
                                    </a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <hr class="mt-2">
            @endforeach
        </div>
    </div>
</x-app-layout>
