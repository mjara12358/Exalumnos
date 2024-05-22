<x-app-layout>
    <x-slot name="header">
        <title>Clases</title>
        <h2 class="font-semibold text-xl text-white dark:text-white leading-tight">
            {{ __('Exalumnos') }}
        </h2>

    </x-slot>

    <div class="pt-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">

                <div class="flex ml-7 mt-2 pb-1 justify-left">
                    <div
                        class="flex items-center justify-between flex-column md:flex-row flex-wrap space-y-4 md:space-y-0 py-2">

                        <label for="buscar" class="sr-only">{{ __('Buscar') }}</label>
                        <div class="relative">
                            <div
                                class="absolute inset-y-0 rtl:inset-r-0 start-0 flex items-center ps-3 pointer-events-none">
                                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                                </svg>
                            </div>
                            <input type="text" id="buscar"
                                class="block pt-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder={{ __('Buscar') }}>
                        </div>
                    </div>
                </div>
                <div class="relative overflow-x-auto shadow-md sm:rounded-lg w-[95%] mx-auto">
                    @if (session('status'))
                        <div id="session-status"
                            class="bg-green-800 text-gray-200 dark:text-gray-200 text-center text-lg font-bold p-2">
                            {{ session('status') }}</div>
                    @endif
                    <table id="tabla-exalumnos"
                        class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-900 uppercase bg-gray-200 dark:bg-gray-700 dark:text-gray-100">
                            <tr>
                                <th scope="col" class="px-6 py-3">ID</th>
                                <th scope="col" class="px-6 py-3">Nombre</th>
                                <th scope="col" class="px-6 py-3">Apellido</th>
                                <th scope="col" class="px-6 py-3">#Documento</th>
                                <th scope="col" class="px-6 py-3">Celular</th>
                                <th scope="col" class="px-6 py-3">Correo</th>
                                <th scope="col" class="px-6 py-3">Fecha de Grado</th>
                                <th scope="col" class="px-6 py-3">Acciones</th>
                            </tr>
                        </thead>
                        <tbody id="filas-exalumnos">
                            @foreach ($exAlumnos as $user)
                                <tr id="fila-{{ $user->id }}"
                                    class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                    <td scope="row"
                                        class="px-6 py- font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ $user->id }}</td>
                                    <td scope="row"
                                        class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ $user->name }}</td>
                                    <td scope="row"
                                        class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ $user->apellido }}</td>
                                    <td scope="row"
                                        class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ $user->numdoc }}</td>
                                    <td scope="row"
                                        class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ $user->celular }}</td>
                                    <td scope="row"
                                        class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ $user->email }}</td>
                                    <td scope="row"
                                        class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ $user->fechagrado }}</td>
                                    <td scope="row"
                                        class="px-6 py-2 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        <div class="flex justify-center">
                                            <button type="button" data-modal-target="ver-modal"
                                                data-modal-toggle="ver-modal"
                                                onclick="verExalumno({{ json_encode($user) }})"
                                                class="inline-flex items-center justify-center p-2 rounded-md text-gray-800 bg-gray-200 dark:bg-gray-800 dark:text-white hover:bg-gray-300 dark:hover:bg-gray-700 focus:outline-none focus:bg-gray-300 dark:focus:bg-gray-700">
                                                <svg class="h-8 w-8 text-blue-500" width="24" height="24"
                                                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                                    fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" />
                                                    <circle cx="9" cy="7" r="4" />
                                                    <path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" />
                                                    <line x1="19" y1="7" x2="19" y2="10" />
                                                    <line x1="19" y1="14" x2="19" y2="14.01" />
                                                </svg>
                                            </button>
                                        </div>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <br>
            </div>
        </div>
    </div>

    <!-- Ver Usuario modal -->
    <div id="ver-modal" tabindex="-1" aria-hidden="true"
        class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative w-full max-w-4xl max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                    <h3 class="mb-1 text-xl font-bold text-gray-900 dark:text-white">
                        {{ __('Ver Exalumno') }}
                    </h3>
                    <button type="button"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                        data-modal-toggle="ver-modal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <div class="px-4">
                    <div class="grid grid-cols-2 gap-4 p-4">
                        <!-- Columna 1 -->
                        <div>
                            <div
                                class="flex flex-col mx-auto border border-gray-200 rounded-lg shadow-sm dark:border-gray-400 xl:p-4 ">
                                <div class="flex items-center">
                                    <svg class="mr-4 h-10 w-10 text-gray-900 dark:text-gray-200" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>

                                    <h5
                                        class="mb-1 text-2xl font-semibold tracking-tight text-gray-900 dark:text-white">
                                        {{ __('Informacion Personal') }}</h5>
                                </div>

                                <div class="grid grid-cols-2 gap-4 p-4">
                                    <div>
                                        <img id="verimagen"
                                            class="w-36 h-36 p-1 rounded-full ring-2 ring-gray-300 dark:ring-gray-500"
                                            alt="Bordered avatar">
                                    </div>
                                    <div>
                                        <h3 class="mb-1 text-l font-bold text-gray-900 dark:text-white">Nombre</h3>
                                        <p id="vernombre" class="text-gray-500 dark:text-gray-400 mb-6">
                                        </p>
                                        <h3 class="mb-1 text-l font-bold text-gray-900 dark:text-white">Apellido
                                        </h3>
                                        <p id="verapellido" class="text-gray-500 dark:text-gray-400 mb-6">
                                        </p>
                                    </div>
                                </div>

                                <div class="flex flex-row">
                                    <div class="mr-6 w-64">
                                        <h3 class="mb-1 text-l font-bold text-gray-900 dark:text-white">Correo
                                            electrónico
                                        </h3>
                                        <p id="vercorreo" class="text-gray-500 dark:text-gray-400 mb-6"></p>
                                        <h3 class="mb-1 text-l font-bold text-gray-900 dark:text-white">Tipo de
                                            Documento
                                        </h3>
                                        <p id="vertipodoc" class="text-gray-500 dark:text-gray-400 mb-6"></p>
                                        <h3 class="mb-1 text-l font-bold text-gray-900 dark:text-white">Fecha de
                                            nacimiento
                                        </h3>
                                        <p id="verfechanacimiento" class="text-gray-500 dark:text-gray-400 mb-6">
                                        </p>
                                    </div>
                                    <div class="w-64">
                                        <h3 class="mb-1 text-l font-bold text-gray-900 dark:text-white">Número de
                                            teléfono
                                        </h3>
                                        <p id="vernumero" class="text-gray-500 dark:text-gray-400 mb-6"></p>
                                        <h3 class="mb-1 text-l font-bold text-gray-900 dark:text-white">Número de
                                            Documento
                                        </h3>
                                        <p id="vernumdoc" class="text-gray-500 dark:text-gray-400 mb-6"></p>
                                    </div>
                                </div>
                            </div>

                            <div
                                class="mt-2 flex flex-col mx-auto border border-gray-200 rounded-lg shadow-sm dark:border-gray-400 xl:p-4 ">
                                <div class="mb-6 flex items-center">
                                    <svg class="mr-4 h-10 w-10 text-gray-900 dark:text-gray-200" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z" />
                                        <circle cx="12" cy="10" r="3" />
                                    </svg>
                                    <h5
                                        class="mb-1 text-2xl font-semibold tracking-tight text-gray-900 dark:text-white">
                                        {{ __('Informacion Sociodemografica') }}</h5>
                                </div>

                                <div class="flex flex-row">
                                    <div class="mr-6 w-64">
                                        <h3 class="mb-1 text-l font-bold text-gray-900 dark:text-white">Género</h3>
                                        <p id="vergenero" class="text-gray-500 dark:text-gray-400 mb-6">
                                        </p>
                                        <h3 class="mb-1 text-l font-bold text-gray-900 dark:text-white">Estrato
                                        </h3>
                                        <p id="verestrato" class="text-gray-500 dark:text-gray-400 mb-6">
                                        </p>
                                        <h3 class="mb-1 text-l font-bold text-gray-900 dark:text-white">Domicilio
                                        </h3>
                                        <p id="verdomicilio" class="text-gray-500 dark:text-gray-400 mb-6">
                                        </p>
                                    </div>
                                    <div class="w-64">
                                        <h3 class="mb-1 text-l font-bold text-gray-900 dark:text-white">Educación
                                        </h3>
                                        <p id="vereducacion" class="text-gray-500 dark:text-gray-400 mb-6">
                                        </p>
                                        <h3 class="mb-1 text-l font-bold text-gray-900 dark:text-white">Ingresos
                                            familiares
                                        </h3>
                                        <p id="veringresos" class="text-gray-500 dark:text-gray-400 mb-6">
                                        </p>
                                        <h3 class="mb-1 text-l font-bold text-gray-900 dark:text-white">Estado
                                            civil
                                        </h3>
                                        <p id="verestadocivil" class="text-gray-500 dark:text-gray-400 mb-6">
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div
                                class="mt-2 flex flex-col mx-auto border border-gray-200 rounded-lg shadow-sm dark:border-gray-400 xl:p-4 ">

                                <div class="mb-6 flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                        class="mr-4 w-10 h-10 text-gray-900 dark:text-gray-200">
                                        <path
                                            d="M11.7 2.805a.75.75 0 0 1 .6 0A60.65 60.65 0 0 1 22.83 8.72a.75.75 0 0 1-.231 1.337 49.948 49.948 0 0 0-9.902 3.912l-.003.002c-.114.06-.227.119-.34.18a.75.75 0 0 1-.707 0A50.88 50.88 0 0 0 7.5 12.173v-.224c0-.131.067-.248.172-.311a54.615 54.615 0 0 1 4.653-2.52.75.75 0 0 0-.65-1.352 56.123 56.123 0 0 0-4.78 2.589 1.858 1.858 0 0 0-.859 1.228 49.803 49.803 0 0 0-4.634-1.527.75.75 0 0 1-.231-1.337A60.653 60.653 0 0 1 11.7 2.805Z" />
                                        <path
                                            d="M13.06 15.473a48.45 48.45 0 0 1 7.666-3.282c.134 1.414.22 2.843.255 4.284a.75.75 0 0 1-.46.711 47.87 47.87 0 0 0-8.105 4.342.75.75 0 0 1-.832 0 47.87 47.87 0 0 0-8.104-4.342.75.75 0 0 1-.461-.71c.035-1.442.121-2.87.255-4.286.921.304 1.83.634 2.726.99v1.27a1.5 1.5 0 0 0-.14 2.508c-.09.38-.222.753-.397 1.11.452.213.901.434 1.346.66a6.727 6.727 0 0 0 .551-1.607 1.5 1.5 0 0 0 .14-2.67v-.645a48.549 48.549 0 0 1 3.44 1.667 2.25 2.25 0 0 0 2.12 0Z" />
                                        <path
                                            d="M4.462 19.462c.42-.419.753-.89 1-1.395.453.214.902.435 1.347.662a6.742 6.742 0 0 1-1.286 1.794.75.75 0 0 1-1.06-1.06Z" />
                                    </svg>

                                    <h5
                                        class="mb-1 text-2xl font-semibold tracking-tight text-gray-900 dark:text-white">
                                        {{ __('Informacion de Grado') }}</h5>
                                </div>

                                <div class="flex flex-row">
                                    <div class="mr-6 w-64">
                                        <h3 class="mb-1 text-l font-bold text-gray-900 dark:text-white">Número de
                                            programa
                                        </h3>
                                        <p id="vernumeroprograma" class="text-gray-500 dark:text-gray-400 mb-6">
                                        </p>
                                        <h3 class="mb-1 text-l font-bold text-gray-900 dark:text-white">Periodo de
                                            Grado
                                        </h3>
                                        <p id="verperiodogrado" class="text-gray-500 dark:text-gray-400 mb-6">
                                        </p>
                                    </div>
                                    <div class="w-64">
                                        <h3 class="mb-1 text-l font-bold text-gray-900 dark:text-white">Fecha de
                                            Grado
                                        </h3>
                                        <p id="verfechagrado" class="text-gray-500 dark:text-gray-400 mb-6">
                                        </p>
                                        <h3 class="mb-1 text-l font-bold text-gray-900 dark:text-white">Acta de
                                            Grado
                                        </h3>
                                        <p id="veractagrado" class="text-gray-500 dark:text-gray-400 mb-6">
                                        </p>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <!-- Columna 2 -->
                        <div>
                            <div
                                class="flex flex-col mx-auto border border-gray-200 rounded-lg shadow-sm dark:border-gray-400 xl:p-4 ">
                                <div class="mb-6 flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                        class="mr-4 w-10 h-10 text-gray-900 dark:text-gray-200">
                                        <path fill-rule="evenodd"
                                            d="M7.5 5.25a3 3 0 0 1 3-3h3a3 3 0 0 1 3 3v.205c.933.085 1.857.197 2.774.334 1.454.218 2.476 1.483 2.476 2.917v3.033c0 1.211-.734 2.352-1.936 2.752A24.726 24.726 0 0 1 12 15.75c-2.73 0-5.357-.442-7.814-1.259-1.202-.4-1.936-1.541-1.936-2.752V8.706c0-1.434 1.022-2.7 2.476-2.917A48.814 48.814 0 0 1 7.5 5.455V5.25Zm7.5 0v.09a49.488 49.488 0 0 0-6 0v-.09a1.5 1.5 0 0 1 1.5-1.5h3a1.5 1.5 0 0 1 1.5 1.5Zm-3 8.25a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Z"
                                            clip-rule="evenodd" />
                                        <path
                                            d="M3 18.4v-2.796a4.3 4.3 0 0 0 .713.31A26.226 26.226 0 0 0 12 17.25c2.892 0 5.68-.468 8.287-1.335.252-.084.49-.189.713-.311V18.4c0 1.452-1.047 2.728-2.523 2.923-2.12.282-4.282.427-6.477.427a49.19 49.19 0 0 1-6.477-.427C4.047 21.128 3 19.852 3 18.4Z" />
                                    </svg>

                                    <h5
                                        class="mb-1 text-2xl font-semibold tracking-tight text-gray-900 dark:text-white">
                                        {{ __('Informacion Laboral') }}</h5>
                                </div>

                                <h3 class="mb-1 text-l font-bold text-gray-900 dark:text-white">Empleado o
                                    Desempleado
                                </h3>
                                <p id="verestadoempleo" class="text-gray-500 dark:text-gray-400 mb-6">
                                </p>
                                <h3 class="mb-1 text-l font-bold text-gray-900 dark:text-white">Empresa o
                                    Emprendimiento
                                </h3>
                                <p id="verempresaemprendimiento" class="text-gray-500 dark:text-gray-400 mb-6">
                                </p>
                                <h3 class="mb-1 text-l font-bold text-gray-900 dark:text-white">País de la Empresa
                                </h3>
                                <p id="verpaisempresa" class="text-gray-500 dark:text-gray-400 mb-6">
                                </p>
                                <h3 class="mb-1 text-l font-bold text-gray-900 dark:text-white">Departamento de la
                                    Empresa
                                </h3>
                                <p id="verdepartamentoempresa" class="text-gray-500 dark:text-gray-400 mb-6">
                                </p>
                                <h3 class="mb-1 text-l font-bold text-gray-900 dark:text-white">Ciudad de la
                                    Empresa
                                </h3>
                                <p id="verciudadempresa" class="text-gray-500 dark:text-gray-400 mb-6">
                                </p>
                                <h3 class="mb-1 text-l font-bold text-gray-900 dark:text-white">Dirección de
                                    Empresa o
                                    Emprendimiento</h3>
                                <p id="verdireccionempresa" class="text-gray-500 dark:text-gray-400 mb-6">
                                </p>
                                <h3 class="mb-1 text-l font-bold text-gray-900 dark:text-white">Celular de la
                                    Empresa
                                </h3>
                                <p id="vercelularempresa" class="text-gray-500 dark:text-gray-400 mb-6">
                                </p>
                                <h3 class="mb-1 text-l font-bold text-gray-900 dark:text-white">Cargo que Ocupa
                                </h3>
                                <p id="vercargoocupado" class="text-gray-500 dark:text-gray-400 mb-6">
                                </p>
                                <div class="flex flex-row">
                                    <div class="mr-6 w-64">
                                        <h3 class="mb-1 text-l font-bold text-gray-900 dark:text-white">Salario
                                        </h3>
                                        <p id="versalario" class="text-gray-500 dark:text-gray-400 mb-6">
                                        </p>
                                        <h3 class="mb-1 text-l font-bold text-gray-900 dark:text-white">Tipo de
                                            Contrato
                                        </h3>
                                        <p id="vertipocontrato" class="text-gray-500 dark:text-gray-400 mb-6">
                                        </p>
                                    </div>
                                    <div class="w-64">
                                        <h3 class="mb-1 text-l font-bold text-gray-900 dark:text-white">Modalidad
                                        </h3>
                                        <p id="vermodalidad" class="text-gray-500 dark:text-gray-400 mb-6">
                                        </p>
                                        <h3 class="mb-1 text-l font-bold text-gray-900 dark:text-white">Tipo de
                                            Jornada
                                        </h3>
                                        <p id="vertipojornada" class="text-gray-500 dark:text-gray-400 mb-6">
                                        </p>
                                    </div>
                                </div>

                                <h3 class="mb-1 text-l font-bold text-gray-900 dark:text-white">Reconocimientos
                                </h3>
                                <p id="verreconocimientos" class="text-gray-500 dark:text-gray-400 mb-6">
                                </p>
                                <h3 class="mb-1 text-l font-bold text-gray-900 dark:text-white">Habilidades</h3>
                                <p id="verhabilidades" class="text-gray-500 dark:text-gray-400 mb-6">
                                </p>
                            </div>
                        </div>
                    </div>
                    <!-- Modal footer -->
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('buscar').addEventListener('input', function() {
            var buscar = this.value.toLowerCase();
            var filas = document.getElementById('filas-exalumnos').getElementsByTagName('tr');

            for (var i = 0; i < filas.length; i++) {
                var textoFila = filas[i].innerText.toLowerCase();
                if (textoFila.includes(buscar)) {
                    filas[i].style.display = '';
                } else {
                    filas[i].style.display = 'none';
                }
            }
        });

        function verExalumno(user) {
            document.getElementById('verimagen').src = user.profile_photo_url ||
                "{{ asset('storage/default-avatar.png') }}";
            document.getElementById('vernombre').textContent = user.name || "Sin especificar";
            document.getElementById('verapellido').textContent = user.apellido || "Sin especificar";
            document.getElementById('vercorreo').textContent = user.email || "Sin especificar";
            document.getElementById('vernumero').textContent = user.celular || "Sin especificar";
            document.getElementById('vertipodoc').textContent = user.tipodoc || "Sin especificar";
            document.getElementById('vernumdoc').textContent = user.numdoc || "Sin especificar";
            document.getElementById('verfechanacimiento').textContent = user.fechanacimiento || "Sin especificar";

            document.getElementById('vergenero').textContent = user.genero || "Sin especificar";
            document.getElementById('vereducacion').textContent = user.educacion || "Sin especificar";
            document.getElementById('verestrato').textContent = user.estrato || "Sin especificar";
            document.getElementById('veringresos').textContent = user.ingresosfamiliares || "Sin especificar";
            document.getElementById('verdomicilio').textContent = user.domicilio || "Sin especificar";
            document.getElementById('verestadocivil').textContent = user.estadocivil || "Sin especificar";

            document.getElementById('vernumeroprograma').textContent = user.numeroprograma || "Sin especificar";
            document.getElementById('verperiodogrado').textContent = user.periodogrado || "Sin especificar";
            document.getElementById('verfechagrado').textContent = user.fechagrado || "Sin especificar";
            if (user.actagrado) {
                var verLink = `<a class="text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-200" target="_blank" href="${user.actagrado}">{{ __('Ver') }}</a>`;
                var descargarLink = `<a href="${user.actagrado}" download="${user.actagrado.substring(user.actagrado.lastIndexOf('/') + 1)}" class="text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-200">{{ __('Descargar') }}</a>`;
                document.getElementById('veractagrado').innerHTML = `${verLink} | ${descargarLink}`;
            } else {
                document.getElementById('veractagrado').textContent = "Sin especificar";
            }

            document.getElementById('verestadoempleo').textContent = user.empleado || "Sin especificar";
            document.getElementById('verempresaemprendimiento').textContent = user.empresa || "Sin especificar";
            document.getElementById('verpaisempresa').textContent = user.paisempresa || "Sin especificar";
            document.getElementById('verdepartamentoempresa').textContent = user.departamentoempresa || "Sin especificar";
            document.getElementById('verciudadempresa').textContent = user.ciudadempresa || "Sin especificar";
            document.getElementById('verdireccionempresa').textContent = user.direccionempresa || "Sin especificar";
            document.getElementById('vercelularempresa').textContent = user.celularempresa || "Sin especificar";
            document.getElementById('vercargoocupado').textContent = user.cargo || "Sin especificar";
            document.getElementById('versalario').textContent = user.salario || "Sin especificar";
            document.getElementById('vermodalidad').textContent = user.modalidad || "Sin especificar";
            document.getElementById('vertipocontrato').textContent = user.tipocontrato || "Sin especificar";
            document.getElementById('vertipojornada').textContent = user.tipojornada || "Sin especificar";
            document.getElementById('verreconocimientos').textContent = user.reconocimientos || "Sin especificar";
            document.getElementById('verhabilidades').textContent = user.habilidades || "Sin especificar";

        }

        setTimeout(function() {
            var sessionStatus = document.getElementById('session-status');
            if (sessionStatus) {
                sessionStatus.style.display = 'none';
            }
        }, 2000);
    </script>

</x-app-layout>
