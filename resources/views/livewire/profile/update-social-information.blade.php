<x-form-section submit="updateSocialInformation">
    <x-slot name="title">
        {{ __('Información Sociodemográfica') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Update your account\'s profile information and email address.') }}
    </x-slot>

    <x-slot name="form">

        <!-- Genero -->
        <div class="col-span-6 sm:col-span-4">
            <x-label for="genero" value="{{ __('Genero') }}" />
            <select id="genero" wire:model="state.genero"
                class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                <option value="">{{ __('Seleccione Genero') }}</option>
                <option value="Masculino">{{ __('Masculino') }}</option>
                <option value="Femenino">{{ __('Femenino') }}</option>
                <option value="otro">{{ __('otro') }}</option>
            </select>
            <x-input-error for="genero" class="mt-2" />
        </div>

        <!-- Educacion -->
        <div class="col-span-6 sm:col-span-4">
            <x-label for="educacion" value="{{ __('Educación') }}" />
            <select id="educacion" name="educacion" wire:model="state.educacion"
                class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                <option value="">{{ __('Seleccione Nivel Educativo') }}</option>
                <option value="Basica">{{ __('Basica') }}</option>
                <option value="Tecnico">{{ __('Tecnico') }}</option>
                <option value="Tecnologo">{{ __('Tecnologo') }}</option>
                <option value="Pregrado">{{ __('Pregrado') }}</option>
                <option value="Posgrado">{{ __('Posgrado') }}</option>
            </select>
            <x-input-error for="educacion" class="mt-2" />
        </div>

        <!-- Estrato -->
        <div class="col-span-6 sm:col-span-4">
            <x-label for="estrato" value="{{ __('Estrato') }}" />
            <select id="estrato" name="estrato" wire:model="state.estrato"
                class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                <option value="">{{ __('Seleccione Estrato') }}</option>
                <option value="Estrato 1">{{ __('Estrato 1') }}</option>
                <option value="Estrato 2">{{ __('Estrato 2') }}</option>
                <option value="Estrato 3">{{ __('Estrato 3') }}</option>
                <option value="Estrato 4">{{ __('Estrato 4') }}</option>
                <option value="Estrato 5">{{ __('Estrato 5') }}</option>
            </select>
            <x-input-error for="estrato" class="mt-2" />
        </div>

        <!-- Ingresos Familiares -->
        <div class="col-span-6 sm:col-span-4">
            <x-label for="ingresosfamiliares" value="{{ __('Ingresos Familiares') }}" />
            <select id="ingresosfamiliares" name="ingresosfamiliares" wire:model="state.ingresosfamiliares"
                class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                <option value="">{{ __('Seleccione Ingresos Familiares') }}</option>
                <option value="Entre 2 - 4 Millones">{{ __('Entre 2 - 4 Millones') }}</option>
                <option value="Entre 4 - 6 Millones">{{ __('Entre 4 - 6 Millones') }}</option>
                <option value="Entre 6 - 10 Millones">{{ __('Entre 6 - 10 Millones') }}</option>
                <option value="Más de 10 millones">{{ __('Más de 10 millones') }}</option>
            </select>
            <x-input-error for="ingresosfamiliares" class="mt-2" />
        </div>

        <!-- Domicilio -->
        <div class="col-span-6 sm:col-span-4">
            <x-label for="domicilio" value="{{ __('Domicilio') }}" />
            <x-input id="domicilio" type="text" class="mt-1 block w-full" placeholder='Direccion de su Domicilio'
                wire:model="state.domicilio" autocomplete="domicilio" />
            <x-input-error for="domicilio" class="mt-2" />
        </div>

        <!-- Estado Civil -->
        <div class="col-span-6 sm:col-span-4">
            <x-label for="estadocivil" value="{{ __('Estado Civil') }}" />
            <select id="estadocivil" name="estadocivil" wire:model="state.estadocivil"
                class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                <option value="">{{ __('Seleccione Estado Civil') }}</option>
                <option value="Soltero">{{ __('Soltero') }}</option>
                <option value="Casado">{{ __('Casado') }}</option>
            </select>
            <x-input-error for="estadocivil" class="mt-2" />
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
