<x-form-section submit="updateGradoInformation" enctype="multipart/form-data">
    <x-slot name="title">
        {{ __('Información de Grado') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Update your account\'s profile information and email address.') }}
    </x-slot>

    <x-slot name="form" enctype="multipart/form-data">
        @csrf
        <!-- Numero de programa -->
        <div class="col-span-6 sm:col-span-4">
            <x-label for="numeroprograma" value="{{ __('Número de programa') }}" />
            <x-input id="numeroprograma" name="numeroprograma" type="text" class="mt-1 block w-full"
                wire:model="state.numeroprograma" placeholder='****************' autocomplete="numeroprograma" step="any" />
            <x-input-error for="numeroprograma" class="mt-2" />
        </div>

        <!-- Periodo de Grado -->
        <div class="col-span-6 sm:col-span-4">
            <x-label for="periodogrado" value="{{ __('Periodo de Grado') }}" />
            <select id="periodogrado" name="periodogrado" wire:model="state.periodogrado"
                class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                <option value="">{{ __('Seleccionar Periodo') }}</option>
                <option value="Semestre 1">{{ __('Semestre 1') }}</option>
                <option value="Semestre 2">{{ __('Semestre 2') }}</option>
            </select>
            <x-input-error for="periodogrado" class="mt-2" />
        </div>

        <!-- Facha Grado -->
        <div class="col-span-6 sm:col-span-4">
            <x-label for="fechagrado" value="{{ __('Fecha de Grado') }}" />
            <div class="relative ">
                <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 16">
                        <path
                            d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                    </svg>
                </div>
                <input type="date" id="fechagrado" name="fechagrado" wire:model="state.fechagrado"
                    class="mt-1 bg-gray-50 border border-gray-300 text-gray-900 text-sm focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5 dark:bg-gray-900 dark:border-gray-700 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 rounded-md shadow-sm s"
                    placeholder="fecha de grado">
            </div>
            <x-input-error for="fechagrado" class="mt-2" />
        </div>

        <!-- Acta de Grado-->
        <div class="col-span-6 sm:col-span-4">
            <x-label for="actagrado" value="{{ __('Acta de Grado') }}" />
            @if (!empty($user->actagrado))
                <p class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="existe">Actual: 
                    {{ pathinfo($user->actagrado, PATHINFO_BASENAME) }} | <a
                        class="text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-200"
                        target="_blank" href="{{ asset($user->actagrado) }}">
                        {{ __('Ver') }}
                    </a> | <a href="{{ asset($user->actagrado) }}"
                        download="{{ pathinfo($user->actagrado, PATHINFO_BASENAME) }}"
                        class="text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-200">
                        {{ __('Descargar') }}</a>
                </p>
            @endif
            <input
                class="mt-1 block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-900 dark:border-gray-700 dark:placeholder-gray-400"
                aria-describedby="file_input_help" id="actagrado" name="actagrado" wire:model="state.actagrado"
                type="file">
            <p class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="file_input_help">PDF</p>
            
            <x-input-error for="actagrado" class="mt-2" />
        </div>
    </x-slot>

    <x-slot name="actions">
        <x-action-message class="me-3" on="saved">
            {{ __('Saved.') }}
        </x-action-message>

        <x-button>
            {{ __('Save') }}
        </x-button>
    </x-slot>
</x-form-section>
