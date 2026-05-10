<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>

            <!-- IDIOMA -->
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">

                <h2 class="text-xl font-bold mb-4">
                    🌍 Idioma actual
                </h2>

            <p class="mb-4 text-lg font-bold">

                🌍 Idioma seleccionado actualmente:

                {{ auth()->user()->idioma }}

            </p>


                <div class="flex gap-3">

                    <a href="/lang/es"
                        class="px-4 py-2 rounded text-white
                        {{ auth()->user()->idioma == 'es'
                            ? 'bg-green-700 ring-4 ring-green-300'
                            : 'bg-green-500' }}">

                        🇪🇸 Español

                    </a>

                    <a href="/lang/en"
                        class="px-4 py-2 rounded text-white
                        {{ auth()->user()->idioma == 'en'
                            ? 'bg-blue-700 ring-4 ring-blue-300'
                            : 'bg-blue-500' }}">

                        🇬🇧 English

                    </a>

                </div>


            </div>

        </div>
    </div>
</x-app-layout>
