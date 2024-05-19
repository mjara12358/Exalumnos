<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white dark:text-white leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="pt-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">

                <head>
                    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
                    <script type="text/javascript">
                        google.charts.load('current', {
                            'packages': ['map'],
                            'mapsApiKey': '{{config('app.googleMaps_api_key')}}'
                        });
                    
                        // Retrasar la carga del gráfico por 2 segundos
                        setTimeout(function() {
                            google.charts.setOnLoadCallback(drawMap);
                        }, 1000);
                    
                        function drawMap() {
                            var data = google.visualization.arrayToDataTable([
                                ['Ubicacion', 'Exalumno'],
                                @foreach ($exAlumnos as $user)
                                    ['{{ $user->paisempresa }}-{{ $user->departamentoempresa }}-{{ $user->ciudadempresa }}',
                                        'Exalumno: {{ $user->name }}'
                                    ],
                                @endforeach
                            ]);
                    
                            var options = {
                                showTooltip: true,
                                showInfoWindow: true,
                                useMapTypeControl: true
                            };
                    
                            var map = new google.visualization.Map(document.getElementById('chart_div'));
                    
                            map.draw(data, options);
                    
                            // Ocultar el spinner después de que se cargue el gráfico
                            document.querySelector('#chart_div > div[role="status"]').style.display = 'none';
                        };
                    </script>
                    
                    <script type="text/javascript">
                        google.charts.load("current", {
                            packages: ["corechart"]
                        });
                        google.charts.setOnLoadCallback(drawChart);

                        function drawChart() {
                            var data = google.visualization.arrayToDataTable([
                                ['Género', 'Cantidad'],
                                @foreach ($generoCount as $genero => $cantidad)
                                    ['{{ $genero }}', {{ $cantidad }}],
                                @endforeach
                            ]);

                            var options = {
                                title: 'Distribución de Género',
                                is3D: true,
                                backgroundColor: '#1f2937', // Establece el color de fondo oscuro
                                chartArea: {
                                    left: 20,
                                    top: 50,
                                    width: '100%',
                                    height: '1000%'
                                },
                                legend: {
                                    textStyle: {
                                        color: 'white' // Establece el color del texto de la leyenda en blanco
                                    }
                                },
                                titleTextStyle: {
                                    color: 'white', // Establece el color del título del gráfico en blanco
                                    fontSize: 22 // Tamaño del texto de la leyenda
                                },
                            };

                            var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
                            chart.draw(data, options);
                        }
                    </script>
                    <script type="text/javascript">
                        google.charts.load('current', {
                            'packages': ['bar']
                        });
                        google.charts.setOnLoadCallback(drawChart);

                        function drawChart() {
                            var data = google.visualization.arrayToDataTable([
                                ['Año de Grado', 'Presencial', 'Remota', 'Mixta'],
                                @foreach ($modalidadCountPorAño as $año => $modalidades)
                                    ['{{ $año }}', {{ $modalidades['Presencial'] ?? 0 }},
                                        {{ $modalidades['Remoto'] ?? 0 }}, {{ $modalidades['Mixto'] ?? 0 }}
                                    ],
                                @endforeach
                            ]);

                            var options = {
                                chart: {
                                    title: 'Modalidad de Trabajo más común por año',
                                    subtitle: 'Presencial, Remoto, y Mixto por Año de Graduacion',
                                },
                                backgroundColor: '#1f2937', // Establece el color de fondo
                                chartArea: {
                                    backgroundColor: {
                                        stroke: '#1f2937', // Color del trazo del patrón
                                        strokeWidth: 1, // Ancho del trazo del patrón
                                        fill: '#1f2937', // Color de relleno del patrón
                                        gradient: { // Gradiente de color para el patrón
                                            color1: '#1f2937', // Color 1 del gradiente
                                            color2: '#1f2937', // Color 2 del gradiente
                                            x1: '0%',
                                            y1: '0%', // Punto de inicio del gradiente (arriba a la izquierda)
                                            x2: '100%',
                                            y2: '100%' // Punto final del gradiente (abajo a la derecha)
                                        }
                                    },
                                    left: 20,
                                    top: 50,
                                    width: '100%',
                                    height: '100%'
                                },
                                legend: {
                                    textStyle: {
                                        color: 'white' // Establece el color del texto de la leyenda en blanco
                                    }
                                },
                                titleTextStyle: {
                                    color: 'white', // Establece el color del título del gráfico en blanco
                                    fontSize: 22 // Tamaño del texto de la leyenda
                                },
                                hAxis: {
                                    titleTextStyle: {
                                        color: 'white' // Color del texto del eje X
                                    },
                                    textStyle: {
                                        color: 'white' // Color del texto de los valores del eje X
                                    }
                                },
                                vAxis: {
                                    titleTextStyle: {
                                        color: 'white' // Color del texto del eje Y
                                    },
                                    textStyle: {
                                        color: 'white' // Color del texto de los valores del eje Y
                                    }
                                },
                            };

                            var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

                            chart.draw(data, google.charts.Bar.convertOptions(options));
                        }
                    </script>
                    <script type="text/javascript">
                        google.charts.load("current", {
                            packages: ["corechart"]
                        });
                        google.charts.setOnLoadCallback(drawChart);

                        function drawChart() {
                            var data = google.visualization.arrayToDataTable([
                                ['Intervalo de Salario', 'Cantidad de Usuarios'],
                                @foreach ($salarioCount as $intervalo => $cantidad)
                                    ['{{ $intervalo }}', {{ $cantidad }}],
                                @endforeach
                            ]);

                            var options = {
                                title: 'Usuarios por Intervalo de Salario',
                                pieHole: 0.4,
                                backgroundColor: '#1f2937', // Establece el color de fondo
                                chartArea: {
                                    left: 20,
                                    top: 50,
                                    width: '100%',
                                    height: '100%'
                                },
                                legend: {
                                    textStyle: {
                                        color: 'white' // Establece el color del texto de la leyenda en blanco
                                    }
                                },
                                titleTextStyle: {
                                    color: 'white', // Establece el color del título del gráfico en blanco
                                    fontSize: 22
                                },
                            };

                            var chart = new google.visualization.PieChart(document.getElementById('donutchart'));
                            chart.draw(data, options);
                        }
                    </script>
                    <script type="text/javascript">
                        google.charts.load('current', {
                            'packages': ['bar']
                        });
                        google.charts.setOnLoadCallback(drawChart);

                        function drawChart() {
                            var data = google.visualization.arrayToDataTable([
                                ['Año', 'Empleado', 'Desempleado'],
                                @foreach ($empleadoCountPorAño as $año => $empleados)
                                    ['{{ $año }}', {{ $empleados['Empleado'] ?? 0 }},
                                        {{ $empleados['Desempleado'] ?? 0 }}
                                    ],
                                @endforeach
                            ]);

                            var options = {
                                chart: {
                                    title: 'Estado Laboral de los Exalumnos por Año',
                                    subtitle: 'Empleado vs Desempleado'
                                },
                                bars: 'horizontal', // Requerido para Gráficos de Barras Material.
                                backgroundColor: '#1f2937', // Establecer el color de fondo
                                chartArea: {
                                    backgroundColor: {
                                        stroke: '#1f2937', // Color del trazo del patrón
                                        strokeWidth: 1, // Ancho del trazo del patrón
                                        fill: '#1f2937', // Color de relleno del patrón
                                        gradient: { // Gradiente de color para el patrón
                                            color1: '#000000', // Color 1 del gradiente
                                            color2: '#000000', // Color 2 del gradiente
                                            x1: '0%',
                                            y1: '0%', // Punto de inicio del gradiente (arriba a la izquierda)
                                            x2: '100%',
                                            y2: '100%' // Punto final del gradiente (abajo a la derecha)
                                        }
                                    },
                                    left: 20,
                                    top: 50,
                                    width: '100%',
                                    height: '80%'
                                },
                                legend: {
                                    textStyle: {
                                        color: 'white' // Establecer el color del texto de la leyenda en blanco
                                    }
                                },
                                titleTextStyle: {
                                    color: 'white' // Establecer el color del título del gráfico en blanco
                                },
                                hAxis: {
                                    titleTextStyle: {
                                        color: 'white' // Color del texto del eje X
                                    },
                                    textStyle: {
                                        color: 'white' // Color del texto de los valores del eje X
                                    }
                                },
                                vAxis: {
                                    titleTextStyle: {
                                        color: 'white' // Color del texto del eje Y
                                    },
                                    textStyle: {
                                        color: 'white' // Color del texto de los valores del eje Y
                                    }
                                },
                            };

                            var chart = new google.charts.Bar(document.getElementById('barchart_material'));

                            chart.draw(data, google.charts.Bar.convertOptions(options));
                        }
                    </script>
                    <script type="text/javascript">
                        google.charts.load('current', {
                            'packages': ['bar']
                        });
                        google.charts.setOnLoadCallback(drawChart);

                        function drawChart() {
                            var data = google.visualization.arrayToDataTable([
                                ['Año de Grado', 'OPS', 'De Planta', 'Por Obra'],
                                @foreach ($contratoCountPorAño as $año => $contratos)
                                    ['{{ $año }}', {{ $contratos['OPS'] ?? 0 }},
                                        {{ $contratos['De planta'] ?? 0 }}, {{ $contratos['Por obra'] ?? 0 }}
                                    ],
                                @endforeach
                            ]);

                            var options = {
                                chart: {
                                    title: 'Contrato de Trabajo más común por año',
                                    subtitle: 'OPS, De Planta, y Por Obra por Año de Graduacion',
                                },
                                backgroundColor: '#1f2937', // Establece el color de fondo
                                chartArea: {
                                    backgroundColor: {
                                        stroke: '#1f2937', // Color del trazo del patrón
                                        strokeWidth: 1, // Ancho del trazo del patrón
                                        fill: '#1f2937', // Color de relleno del patrón
                                        gradient: { // Gradiente de color para el patrón
                                            color1: '#1f2937', // Color 1 del gradiente
                                            color2: '#1f2937', // Color 2 del gradiente
                                            x1: '0%',
                                            y1: '0%', // Punto de inicio del gradiente (arriba a la izquierda)
                                            x2: '100%',
                                            y2: '100%' // Punto final del gradiente (abajo a la derecha)
                                        }
                                    },
                                    left: 20,
                                    top: 50,
                                    width: '100%',
                                    height: '100%'
                                },
                                legend: {
                                    textStyle: {
                                        color: 'white' // Establece el color del texto de la leyenda en blanco
                                    }
                                },
                                titleTextStyle: {
                                    color: 'white', // Establece el color del título del gráfico en blanco
                                    fontSize: 22 // Tamaño del texto de la leyenda
                                },
                                hAxis: {
                                    titleTextStyle: {
                                        color: 'white' // Color del texto del eje X
                                    },
                                    textStyle: {
                                        color: 'white' // Color del texto de los valores del eje X
                                    }
                                },
                                vAxis: {
                                    titleTextStyle: {
                                        color: 'white' // Color del texto del eje Y
                                    },
                                    textStyle: {
                                        color: 'white' // Color del texto de los valores del eje Y
                                    }
                                },
                            };

                            var chart = new google.charts.Bar(document.getElementById('columnchart_material_contratos'));

                            chart.draw(data, google.charts.Bar.convertOptions(options));
                        }
                    </script>
                    <script type="text/javascript">
                        google.charts.load('current', {
                            'packages': ['bar']
                        });
                        google.charts.setOnLoadCallback(drawChart);

                        function drawChart() {
                            var data = google.visualization.arrayToDataTable([
                                ['Año', 'Completa', 'Media'],
                                @foreach ($jornadaCountPorAño as $año => $jornada)
                                    ['{{ $año }}', {{ $jornada['Completa'] ?? 0 }},
                                        {{ $jornada['Media'] ?? 0 }}
                                    ],
                                @endforeach
                            ]);

                            var options = {
                                chart: {
                                    title: 'Jornada Laboral de los Exalumnos por Año',
                                    subtitle: 'Completa vs Media'
                                },
                                bars: 'horizontal', // Requerido para Gráficos de Barras Material.
                                backgroundColor: '#1f2937', // Establecer el color de fondo
                                chartArea: {
                                    backgroundColor: {
                                        stroke: '#1f2937', // Color del trazo del patrón
                                        strokeWidth: 1, // Ancho del trazo del patrón
                                        fill: '#1f2937', // Color de relleno del patrón
                                        gradient: { // Gradiente de color para el patrón
                                            color1: '#000000', // Color 1 del gradiente
                                            color2: '#000000', // Color 2 del gradiente
                                            x1: '0%',
                                            y1: '0%', // Punto de inicio del gradiente (arriba a la izquierda)
                                            x2: '100%',
                                            y2: '100%' // Punto final del gradiente (abajo a la derecha)
                                        }
                                    },
                                    left: 20,
                                    top: 50,
                                    width: '100%',
                                    height: '80%'
                                },
                                legend: {
                                    textStyle: {
                                        color: 'white' // Establecer el color del texto de la leyenda en blanco
                                    }
                                },
                                titleTextStyle: {
                                    color: 'white' // Establecer el color del título del gráfico en blanco
                                },
                                hAxis: {
                                    titleTextStyle: {
                                        color: 'white' // Color del texto del eje X
                                    },
                                    textStyle: {
                                        color: 'white' // Color del texto de los valores del eje X
                                    }
                                },
                                vAxis: {
                                    titleTextStyle: {
                                        color: 'white' // Color del texto del eje Y
                                    },
                                    textStyle: {
                                        color: 'white' // Color del texto de los valores del eje Y
                                    }
                                },
                            };

                            var chart = new google.charts.Bar(document.getElementById('barchart_material_jornada'));

                            chart.draw(data, google.charts.Bar.convertOptions(options));
                        }
                    </script>
                </head>
                <div
                    class="p-6 lg:p-8 bg-white dark:bg-gray-800 dark:bg-gradient-to-bl dark:from-gray-700/50 dark:via-transparent border-b border-gray-800 dark:border-gray-700">

                    <div class="grid grid-cols-1 divide-y divide-gray-900 dark:divide-gray-200">
                        <div>
                            <div class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                    class="w-10 h-10 text-gray-900 dark:text-gray-200">
                                    <path
                                        d="M11.7 2.805a.75.75 0 0 1 .6 0A60.65 60.65 0 0 1 22.83 8.72a.75.75 0 0 1-.231 1.337 49.948 49.948 0 0 0-9.902 3.912l-.003.002c-.114.06-.227.119-.34.18a.75.75 0 0 1-.707 0A50.88 50.88 0 0 0 7.5 12.173v-.224c0-.131.067-.248.172-.311a54.615 54.615 0 0 1 4.653-2.52.75.75 0 0 0-.65-1.352 56.123 56.123 0 0 0-4.78 2.589 1.858 1.858 0 0 0-.859 1.228 49.803 49.803 0 0 0-4.634-1.527.75.75 0 0 1-.231-1.337A60.653 60.653 0 0 1 11.7 2.805Z" />
                                    <path
                                        d="M13.06 15.473a48.45 48.45 0 0 1 7.666-3.282c.134 1.414.22 2.843.255 4.284a.75.75 0 0 1-.46.711 47.87 47.87 0 0 0-8.105 4.342.75.75 0 0 1-.832 0 47.87 47.87 0 0 0-8.104-4.342.75.75 0 0 1-.461-.71c.035-1.442.121-2.87.255-4.286.921.304 1.83.634 2.726.99v1.27a1.5 1.5 0 0 0-.14 2.508c-.09.38-.222.753-.397 1.11.452.213.901.434 1.346.66a6.727 6.727 0 0 0 .551-1.607 1.5 1.5 0 0 0 .14-2.67v-.645a48.549 48.549 0 0 1 3.44 1.667 2.25 2.25 0 0 0 2.12 0Z" />
                                    <path
                                        d="M4.462 19.462c.42-.419.753-.89 1-1.395.453.214.902.435 1.347.662a6.742 6.742 0 0 1-1.286 1.794.75.75 0 0 1-1.06-1.06Z" />
                                </svg>

                                <h5 class="ml-4 text-4xl font-semibold tracking-tight text-gray-900 dark:text-white">
                                    {{ __('Exalumnos') }}</h5>
                            </div>

                            <div class="flex items-center">
                                <h3 class="mt-3 ml-14 mb-4 mr-2 text-2xl font-medium text-gray-900 dark:text-white">
                                    {{ __('¡Descubre dónde trabajan nuestros exalumnos!') }}
                                </h3>
                                <svg data-popover-target="chart-info" data-popover-placement="bottom"
                                    class="w-6 h-6 text-gray-500 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white cursor-pointer ms-1"
                                    aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                    viewBox="0 0 20 20">
                                    <path
                                        d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm0 16a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3Zm1-5.034V12a1 1 0 0 1-2 0v-1.418a1 1 0 0 1 1.038-.999 1.436 1.436 0 0 0 1.488-1.441 1.501 1.501 0 1 0-3-.116.986.986 0 0 1-1.037.961 1 1 0 0 1-.96-1.037A3.5 3.5 0 1 1 11 11.466Z" />
                                </svg>
                                <div data-popover id="chart-info" role="tooltip"
                                    class="absolute z-10 invisible inline-block text-sm text-gray-500 transition-opacity duration-300 bg-white border border-gray-200 rounded-lg shadow-sm opacity-0 w-72 dark:bg-gray-800 dark:border-gray-600 dark:text-gray-400">
                                    <div class="p-3 space-y-2">
                                        <h3 class="font-semibold text-gray-900 dark:text-white">
                                            {{ __('Mapa laboral') }}</h3>
                                        <p>{{ __('Aquí podrás visualizar las ubicaciones de las empresas donde se desempeñan nuestros exalumnos. Sumérgete en un viaje virtual mientras navegas por las diversas empresas que han acogido a nuestros talentosos graduados. Explora las posibilidades, descubre conexiones y empieza a trazar tu propio camino hacia el éxito. ¡Bienvenido a una experiencia única en nuestro dashboard!') }}
                                        </p>
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="m1 9 4-4-4-4" />
                                        </svg></a>
                                    </div>
                                    <div data-popper-arrow></div>
                                </div>
                            </div>
                        </div>
                        <div>
                            <!-- Pricing Card -->
                            <div
                                class="mt-4 mb-4 flex flex-col p-6 mx-auto text-gray-900 bg-gray-600 border border-gray-200 rounded-lg shadow-sm dark:border-gray-700 xl:p-6 dark:bg-gray-800 dark:text-white">
                                <style>
                                    /* Establece el color del texto dentro del chart_div en negro */
                                    #chart_div {
                                        color: #000000;
                                    }
                                </style>
                                <div id="chart_div" class="sm:rounded-lg relative" style="min-height: 400px;">
                                    <!-- Spinner -->
                                    <div role="status"
                                        class="absolute inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50">
                                        <svg aria-hidden="true"
                                            class="w-10 h-10 text-gray-200 animate-spin dark:text-gray-600 fill-blue-600"
                                            viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                                                fill="currentColor" />
                                            <path
                                                d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                                                fill="currentFill" />
                                        </svg>
                                        <span class="sr-only">Loading...</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div>
                            <div class="mt-4 mb-4 grid grid-cols-2 md:grid-cols-2 gap-4">
                                <div class="grid gap-4">
                                    <div
                                        class="flex flex-col p-6 mx-auto text-gray-900 bg-gray-600 border border-gray-200 rounded-lg shadow-sm dark:border-gray-700 xl:p-8 dark:bg-gray-800 dark:text-white">

                                        <div id="piechart_3d" style="width: 500px; height: 400px;"></div>
                                    </div>
                                    <div
                                        class="flex flex-col p-6 mx-auto text-gray-900 bg-gray-600 border border-gray-200 rounded-lg shadow-sm dark:border-gray-700 xl:p-8 dark:bg-gray-800 dark:text-white">

                                        <div id="barchart_material" style="width: 500px; height: 200px;"></div>
                                    </div>
                                    <div
                                        class="flex flex-col p-6 mx-auto text-gray-900 bg-gray-600 border border-gray-200 rounded-lg shadow-sm dark:border-gray-700 xl:p-8 dark:bg-gray-800 dark:text-white">

                                        <div id="columnchart_material_contratos" style="width: 500px; height: 200px;">
                                        </div>
                                    </div>
                                </div>
                                <div class="grid gap-4">
                                    <div
                                        class="flex flex-col p-6 mx-auto text-gray-900 bg-gray-600 border border-gray-200 rounded-lg shadow-sm dark:border-gray-700 xl:p-8 dark:bg-gray-800 dark:text-white">

                                        <div id="columnchart_material" style="width: 500px; height: 300px;"></div>
                                    </div>
                                    <div
                                        class="flex flex-col p-6 mx-auto text-gray-900 bg-gray-600 border border-gray-200 rounded-lg shadow-sm dark:border-gray-700 xl:p-8 dark:bg-gray-800 dark:text-white">

                                        <div id="donutchart" style="width: 500px; height: 300px;"></div>
                                    </div>
                                    <div
                                        class="flex flex-col p-6 mx-auto text-gray-900 bg-gray-600 border border-gray-200 rounded-lg shadow-sm dark:border-gray-700 xl:p-8 dark:bg-gray-800 dark:text-white">

                                        <div id="barchart_material_jornada" style="width: 500px; height: 200px;"></div>
                                    </div>
                                </div>
                            </div>

                            {{-- <hr
                                class="my-8 h-px border-t-0 bg-transparent bg-gradient-to-r from-transparent via-neutral-500 to-transparent opacity-25 dark:via-neutral-400" /> --}}
                            <hr class="my-8 h-0.5 border-t-0 bg-neutral-100 dark:bg-white/10" />
                            <div class="flex justify-between ml-2 mb-2 mt-10 pb-2">
                                <!-- Título "Habilidades" -->
                                <div class="flex items-center">
                                    <svg class="h-10 w-10 text-gray-900 dark:text-gray-200" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2" />
                                        <circle cx="8.5" cy="7" r="4" />
                                        <polyline points="17 11 19 13 23 9" />
                                    </svg>

                                    <div class="flex items-center">
                                        <h4
                                            class="ml-4 mr-2 text-4xl font-semibold tracking-tight text-gray-900 dark:text-white">
                                            {{ __('Habilidades') }}</h4>
                                        <svg data-popover-target="chart-info-habilidades"
                                            data-popover-placement="bottom"
                                            class="w-6 h-6 text-gray-500 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white cursor-pointer ms-1"
                                            aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                            viewBox="0 0 20 20">
                                            <path
                                                d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm0 16a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3Zm1-5.034V12a1 1 0 0 1-2 0v-1.418a1 1 0 0 1 1.038-.999 1.436 1.436 0 0 0 1.488-1.441 1.501 1.501 0 1 0-3-.116.986.986 0 0 1-1.037.961 1 1 0 0 1-.96-1.037A3.5 3.5 0 1 1 11 11.466Z" />
                                        </svg>
                                        <div data-popover id="chart-info-habilidades" role="tooltip"
                                            class="absolute z-10 invisible inline-block text-sm text-gray-500 transition-opacity duration-300 bg-white border border-gray-200 rounded-lg shadow-sm opacity-0 w-72 dark:bg-gray-800 dark:border-gray-600 dark:text-gray-400">
                                            <div class="p-3 space-y-2">
                                                <h3 class="font-semibold text-gray-900 dark:text-white">
                                                    {{ __('Buscador de habilidades') }}</h3>
                                                <p>{{ __('¡Explora las habilidades de nuestros exalumnos! En este panel del dashboard, puedes buscar por habilidades específicas entre todos nuestros exalumnos registrados. Encuentra el perfil que más te interese y accede a su información de contacto para establecer una comunicación directa. ¡Conéctate con exalumnos que pueden ser de gran ayuda para tu carrera profesional o proyectos futuros!') }}
                                                </p>
                                                <path stroke="currentColor" stroke-linecap="round"
                                                    stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4" />
                                                </svg></a>
                                            </div>
                                            <div data-popper-arrow></div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Buscador de Habilidades -->
                                <div class="relative">
                                    <label for="search" class="sr-only">{{ __('Buscar Habilidad') }}</label>
                                    <div
                                        class="absolute inset-y-0 rtl:inset-r-0 start-0 flex items-center ps-3 pointer-events-none">
                                        <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                            <path stroke="currentColor" stroke-linecap="round"
                                                stroke-linejoin="round" stroke-width="2"
                                                d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                                        </svg>
                                    </div>
                                    <input type="text" id="search"
                                        class="block pt-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                        placeholder={{ __('Buscar Habilidad') }}>
                                </div>
                            </div>
                        </div>

                        <div>
                            <div class="mt-4 grid grid-cols-2 md:grid-cols-3 gap-4" id="exalumnos">
                                @foreach ($exAlumnos as $exAlumno)
                                    <div
                                        class="mt-2 max-w-md bg-gray-600 bg-opacity-50 border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                                        <div class="flex flex-col items-center pb-10">
                                            <img class="w-24 h-24 mt-6 mb-3 rounded-full shadow-lg"
                                                src="{{ $exAlumno->profile_photo_url }}" alt="Bonnie image" />
                                            <div class="p-2 text-center">
                                                <h5
                                                    class="mb-2 text-2xl font-bold tracking-tight text-white dark:text-white">
                                                    {{ $exAlumno->name }} {{ $exAlumno->apellido }}</h5>
                                                <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">
                                                    {{ __('Habilidades: ') }}
                                                    {{ $exAlumno->habilidades }}</p>
                                                <div class="flex mt-4 md:mt-6 justify-center">
                                                    <a data-modal-target="ver-modal" data-modal-toggle="ver-modal"
                                                        onclick="verExalumno({{ json_encode($exAlumno) }})"
                                                        class="inline-flex items-center px-4 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">{{ __('Contacto') }}</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
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
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 14 14">
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
                                            {{ __('Información Personal') }}</h5>
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

                                <div class="flex items-center justify-center">
                                    <svg class="h-16 w-16 text-gray-900 dark:text-gray-200 nimate-bounce mx-auto"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 9l4-4 4 4m0 6l-4 4-4-4" />
                                    </svg>

                                    <svg class="h-20 w-20 mt-12 text-gray-900 dark:text-gray-200 animate-bounce mx-auto"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                    </svg>

                                    <svg class="h-16 w-16 text-gray-900 dark:text-gray-200 nimate-bounce mx-auto"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 9l4-4 4 4m0 6l-4 4-4-4" />
                                    </svg>
                                </div>

                            </div>
                            <!-- Columna 2 -->
                            <div>
                                <div
                                    class="flex flex-col mx-auto border border-gray-200 rounded-lg shadow-sm dark:border-gray-400 xl:p-4 ">
                                    <div class="mb-6 flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                            fill="currentColor"
                                            class="mr-4 w-10 h-10 text-gray-900 dark:text-gray-200">
                                            <path fill-rule="evenodd"
                                                d="M7.5 5.25a3 3 0 0 1 3-3h3a3 3 0 0 1 3 3v.205c.933.085 1.857.197 2.774.334 1.454.218 2.476 1.483 2.476 2.917v3.033c0 1.211-.734 2.352-1.936 2.752A24.726 24.726 0 0 1 12 15.75c-2.73 0-5.357-.442-7.814-1.259-1.202-.4-1.936-1.541-1.936-2.752V8.706c0-1.434 1.022-2.7 2.476-2.917A48.814 48.814 0 0 1 7.5 5.455V5.25Zm7.5 0v.09a49.488 49.488 0 0 0-6 0v-.09a1.5 1.5 0 0 1 1.5-1.5h3a1.5 1.5 0 0 1 1.5 1.5Zm-3 8.25a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Z"
                                                clip-rule="evenodd" />
                                            <path
                                                d="M3 18.4v-2.796a4.3 4.3 0 0 0 .713.31A26.226 26.226 0 0 0 12 17.25c2.892 0 5.68-.468 8.287-1.335.252-.084.49-.189.713-.311V18.4c0 1.452-1.047 2.728-2.523 2.923-2.12.282-4.282.427-6.477.427a49.19 49.19 0 0 1-6.477-.427C4.047 21.128 3 19.852 3 18.4Z" />
                                        </svg>

                                        <h5
                                            class="mb-1 text-2xl font-semibold tracking-tight text-gray-900 dark:text-white">
                                            {{ __('Información Laboral') }}</h5>
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
    </div>
    <x-banner-end></x-banner-end>
    <script>
        // Obtener el campo de entrada de búsqueda
        const searchInput = document.getElementById('search');

        // Obtener todas las tarjetas de exalumnos
        const exAlumnos = document.querySelectorAll('#exalumnos .max-w-md');

        // Agregar evento de escucha al campo de entrada de búsqueda
        searchInput.addEventListener('input', function() {
            const searchTerm = this.value.toLowerCase();

            // Iterar sobre todas las tarjetas de exalumnos
            exAlumnos.forEach(function(exAlumno) {
                const nombre = exAlumno.querySelector('.text-white').textContent.toLowerCase();
                const habilidades = exAlumno.querySelector('.text-gray-700').textContent.toLowerCase();

                // Mostrar u ocultar la tarjeta de exalumno según si el término de búsqueda coincide con el nombre o las habilidades
                if (nombre.includes(searchTerm) || habilidades.includes(searchTerm)) {
                    exAlumno.style.display = 'block';
                } else {
                    exAlumno.style.display = 'none';
                }
            });
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

            document.getElementById('verestadoempleo').textContent = user.empleado || "Sin especificar";
            document.getElementById('verempresaemprendimiento').textContent = user.empresa || "Sin especificar";
            document.getElementById('vercargoocupado').textContent = user.cargo || "Sin especificar";
            document.getElementById('versalario').textContent = user.salario || "Sin especificar";
            document.getElementById('vermodalidad').textContent = user.modalidad || "Sin especificar";
            document.getElementById('vertipocontrato').textContent = user.tipocontrato || "Sin especificar";
            document.getElementById('vertipojornada').textContent = user.tipojornada || "Sin especificar";
            document.getElementById('verreconocimientos').textContent = user.reconocimientos || "Sin especificar";
            document.getElementById('verhabilidades').textContent = user.habilidades || "Sin especificar";

        }
    </script>
</x-app-layout>
