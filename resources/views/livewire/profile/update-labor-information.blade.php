<x-form-section submit="updateLaborInformation">
    <x-slot name="title">
        {{ __('Información Laboral') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Update your account\'s profile information and email address.') }}
    </x-slot>

    <x-slot name="form">

        <!-- Empleado o Desempleado -->
        <div class="col-span-6 sm:col-span-4">
            <x-label for="empleado" value="{{ __('Empleado o Desempleado') }}" />
            <select id="empleado" wire:model="state.empleado"
                class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                <option value="">{{ __('Seleccione su Situacion Laboral') }}</option>
                <option value="Empleado">{{ __('Empleado') }}</option>
                <option value="Desempleado">{{ __('Desempleado') }}</option>
            </select>
            <x-input-error for="empleado" class="mt-2" />
        </div>

        <!-- Empresa o Emprendimiento -->
        <div class="col-span-6 sm:col-span-4">
            <x-label for="empresa" value="{{ __('Empresa o Emprendimiento') }}" />
            <x-input id="empresa" type="text" class="mt-1 block w-full" wire:model="state.empresa"
                placeholder='Nombre de la empresa' autocomplete="empresa" />
            <x-input-error for="empresa" class="mt-2" />
        </div>

        <!-- Pais de la Empresa-->
        <div class="col-span-6 sm:col-span-4">
            <x-label for="paisempresa" value="{{ __('Pais de la Empresa') }}" />
            <select id="paisempresa" wire:model="state.paisempresa" wire:change='getStates()'
                class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                <option value="">{{ __('Seleccione el Pais') }}</option>
                @foreach ($countries as $country)
                    <option value="{{ $country['country_name'] }}">{{ $country['country_name'] }}</option>
                @endforeach
            </select>
            <x-input-error for="paisempresa" class="mt-2" />
        </div>

        <!-- Departamento de la Empresa-->
        <div class="col-span-6 sm:col-span-4">
            <x-label for="departamentoempresa" value="{{ __('Departamento de la Empresa') }}" />
            <select id="departamentoempresa" wire:model="state.departamentoempresa" wire:change='getCities()'
                class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                <option value="">{{ __('Seleccione el Departamento') }}</option>
                @foreach ($states as $state)
                    <option value="{{ $state['state_name'] }}">{{ $state['state_name'] }}</option>
                @endforeach
            </select>
            <x-input-error for="departamentoempresa" class="mt-2" />
        </div>

        <!-- Ciudad de la empresa -->
        <div class="col-span-6 sm:col-span-4">
            <x-label for="ciudadempresa" value="{{ __('Ciudad de la empresa') }}" />
            <select id="ciudadempresa" wire:model="state.ciudadempresa"
                class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                <option value="">{{ __('Seleccione la Ciudad') }}</option>
                @foreach ($cities as $city)
                    <option value="{{ $city['city_name'] }}">{{ $city['city_name'] }}</option>
                @endforeach
            </select>
            <x-input-error for="ciudadempresa" class="mt-2" />
        </div>

        <!-- Direccion de Empresa o Emprendimiento -->
        <div class="col-span-6 sm:col-span-4">
            <x-label for="direccionempresa" value="{{ __('Direccion de Empresa o Emprendimiento') }}" />
            <x-input id="direccionempresa" type="text" class="mt-1 block w-full" wire:model="state.direccionempresa"
                autocomplete="direccionempresa" />
            <x-input-error for="direccionempresa" class="mt-2" />
        </div>

        <!-- Celular Empresa -->
        <div class="col-span-6 sm:col-span-4">
            <x-label for=" celularempresa" value="{{ __('Celular de la Empresa') }}" />
            <x-input id="celularempresa" type="tel" name="celularempresa" class="mt-1 block w-full" wire:model=""
                pattern="[0-9]{10}" wire:model="state.celularempresa" autocomplete="celularempresa" />
            <x-input-error for="celularempresa" class="mt-2" />
        </div>

        <!-- Cargo -->
        <div class="col-span-6 sm:col-span-4">
            <x-label for="cargo" value="{{ __('Cargo que ocupa') }}" />
            <x-input id="cargo" type="text" class="mt-1 block w-full" wire:model="state.cargo"
                placeholder='Titulo del Cargo' autocomplete="cargo" />
            <x-input-error for="cargo" class="mt-2" />
        </div>

        <!-- Salario -->
        <div class="col-span-6 sm:col-span-4">
            <x-label for="salario" value="{{ __('Salario') }}" />
            <select id="salario" wire:model="state.salario"
                class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                <option value="">{{ __('Seleccione su salario') }}</option>
                <option value="Entre 2 - 4 Millones">{{ __('Entre 2 - 4 Millones') }}</option>
                <option value="Entre 4 - 6 Millones">{{ __('Entre 4 - 6 Millones') }}</option>
                <option value="Entre 6 - 10 Millones">{{ __('Entre 6 - 10 Millones') }}</option>
                <option value="Más de 10 millones">{{ __('Más de 10 millones') }}</option>
            </select>
            <x-input-error for="salario" class="mt-2" />
        </div>

        <!-- Modalidad -->
        <div class="col-span-6 sm:col-span-4">
            <x-label for="modalidad" value="{{ __('Modalidad') }}" />
            <select id="modalidad" wire:model="state.modalidad"
                class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                <option value="">{{ __('Seleccione su modalidad') }}</option>
                <option value="Presencial">{{ __('Presencial') }}</option>
                <option value="Remoto">{{ __('Remoto') }}</option>
                <option value="Mixto">{{ __('Mixto') }}</option>
            </select>
            <x-input-error for="modalidad" class="mt-2" />
        </div>

        <!-- Tipo de Contrato -->
        <div class="col-span-6 sm:col-span-4">
            <x-label for="tipocontrato" value="{{ __('Tipo de Contrato') }}" />
            <select id="tipocontrato" wire:model="state.tipocontrato"
                class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                <option value="">{{ __('Seleccione el tipo de su contrato') }}</option>
                <option value="OPS">{{ __('OPS') }}</option>
                <option value="De planta">{{ __('De planta') }}</option>
                <option value="Por obra">{{ __('Por obra') }}</option>
            </select>
            <x-input-error for="tipocontrato" class="mt-2" />
        </div>

        <!-- Tipo de Jornada -->
        <div class="col-span-6 sm:col-span-4">
            <x-label for="tipojornada" value="{{ __('Tipo de Jornada') }}" />
            <select id="tipojornada" wire:model="state.tipojornada"
                class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                <option value="">{{ __('Seleccione el tipo de su jornada') }}</option>
                <option value="Completa">{{ __('Completa') }}</option>
                <option value="Media">{{ __('Media') }}</option>
            </select>
            <x-input-error for="tipojornada" class="mt-2" />
        </div>

        <!-- Reconocimientos -->
        <div class="col-span-6 sm:col-span-4">
            <x-label for="reconocimientos" value="{{ __('Reconocimientos') }}" />
            <x-input id="reconocimientos" type="text" class="mt-1 block w-full"
                wire:model="state.reconocimientos" autocomplete="reconocimientos" />
            <x-input-error for="reconocimientos" class="mt-2" />
        </div>

        <!-- Habilidades -->
        <div class="col-span-6 sm:col-span-4">
            <x-label for="habilidades" value="{{ __('Habilidades') }}" />
            <textarea id="habilidades" rows="4"
                class=" mt-1 block p-2.5 w-full text-sm border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                placeholder={{ __('Escribe aqui tus habilidades...') }} wire:model="state.habilidades"></textarea>
            <x-input-error for="habilidades" class="mt-2" />
        </div>
    </x-slot>

    <x-slot name="actions">
        <x-action-message class="me-3" on="saved">
            {{ __('Saved.') }}
        </x-action-message>

        <x-button wire:loading.attr="disabled" wire:target="photo">
            {{ __('Save') }}
        </x-button>
    </x-slot>
</x-form-section>
