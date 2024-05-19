<?php

namespace App\Livewire\Profile;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Livewire\Component;
use Psy\Readline\Hoa\Console;

class UpdateLaborInformation extends Component
{
    public $user;
    public $token;
    public $countries;
    public $states;
    public $cities;
    public $countrySelect;

    public $state = [
        'empleado' => '',
        'empresa' => '',
        'paisempresa' => '',
        'departamentoempresa' => '',
        'ciudadempresa' => '',
        'direccionempresa' => '',
        'celularempresa' => '',
        'cargo' => '',
        'salario' => '',
        'modalidad' => '',
        'tipocontrato' => '',
        'tipojornada' => '',
        'reconocimientos' => '',
        'habilidades' => '',
    ];

    public function AllCountries()
    {
        try {
            $response = Http::get('https://countriesnow.space/api/v0.1/countries/positions');
            
            return $response->json();
        } catch (\Exception $ex) {
            // Manejar la excepción, por ejemplo, devolver un mensaje de error o registrarla en el registro de errores
            return $ex->getMessage();
        }
    }

    public function getStatesByCountry($country)
    {
        try {
            if (empty($country)) {
                $this->states = [];
                $this->cities = [];
            } else {
                $response = Http::post('https://countriesnow.space/api/v0.1/countries/states', [
                    'country' => $country
                ]);

                $this->countrySelect = $country;
                $this->states = $response->json()['data']['states']; // Suponiendo que la respuesta contiene una clave 'data' con la lista de estados
            }
        } catch (\Exception $ex) {
            // Manejar la excepción, por ejemplo, devolver un mensaje de error o registrarla en el registro de errores
            return $ex->getMessage();
        }
    }

    public function getCitiesByState($state)
    {
        try {
            if (empty($state)) {
                $this->cities = [];
            } else {
                $response = Http::post('https://countriesnow.space/api/v0.1/countries/state/cities', [
                    'country' => $this->countrySelect,
                    'state' => $state
                ]);

                $this->cities = $response->json()['data']; // Suponiendo que la respuesta contiene una clave 'data' con la lista de ciudades
            }
        } catch (\Exception $ex) {
            // Manejar la excepción, por ejemplo, devolver un mensaje de error o registrarla en el registro de errores
            return $ex->getMessage();
        }
    }

    public function render()
    {
        $this->user = Auth::user();
        return view('livewire.profile.update-labor-information', ['user' => $this->user]);
    }

    public function mount()
    {
        $response = $this->AllCountries();
        $this->countries = $response['data'];
        
        $user = Auth::user(); // Suponiendo que estás utilizando Laravel Jetstream
        $this->state['empleado'] = $user->empleado;
        $this->state['empresa'] = $user->empresa;
        $this->state['paisempresa'] = $user->paisempresa;
        $this->state['departamentoempresa'] = $user->departamentoempresa;
        $this->state['ciudadempresa'] = $user->ciudadempresa;
        $this->state['direccionempresa'] = $user->direccionempresa;
        $this->state['celularempresa'] = $user->celularempresa;
        $this->state['cargo'] = $user->cargo;
        $this->state['salario'] = $user->salario;
        $this->state['modalidad'] = $user->modalidad;
        $this->state['tipocontrato'] = $user->tipocontrato;
        $this->state['tipojornada'] = $user->tipojornada;
        $this->state['reconocimientos'] = $user->reconocimientos;
        $this->state['habilidades'] = $user->habilidades;

        $this->states = [];
        $this->cities = [];
        if (!empty($this->state['paisempresa'])) {
            $this->getStatesByCountry($this->state['paisempresa']);
        }

        if (!empty($this->state['departamentoempresa'])) {
            $this->countrySelect = $this->state['paisempresa'];
            $this->getCitiesByState($this->state['departamentoempresa']);
        }
        
    }

    public function updateLaborInformation(): void
    {
        $user = Auth::user();

        Validator::make($this->state, [
            'empleado' => ['nullable', 'string', 'max:255'],
            'empresa' => ['nullable', 'string', 'max:255'],
            'paisempresa' => ['nullable', 'string', 'max:255'],
            'departamentoempresa' => ['nullable', 'string', 'max:255'],
            'ciudadempresa' => ['nullable', 'string', 'max:255'],
            'direccionempresa' => ['nullable', 'string', 'max:255'],
            'celularempresa' => ['nullable', 'string', 'max:255'],
            'cargo' => ['nullable', 'string', 'max:255'],
            'salario' => ['nullable', 'string', 'max:255'],
            'modalidad' => ['nullable', 'string', 'max:255'],
            'tipocontrato' => ['nullable', 'string', 'max:255'],
            'tipojornada' => ['nullable', 'string', 'max:255'],
            'reconocimientos' => ['nullable', 'string', 'max:255'],
            'habilidades' => ['nullable', 'string', 'max:255'],
        ])->validateWithBag('updateLaborInformation');

        $user->forceFill([
            'empleado' => $this->state['empleado'],
            'empresa' => $this->state['empresa'],
            'paisempresa' => $this->state['paisempresa'],
            'departamentoempresa' => $this->state['departamentoempresa'],
            'ciudadempresa' => $this->state['ciudadempresa'],
            'direccionempresa' => $this->state['direccionempresa'],
            'celularempresa' => $this->state['celularempresa'],
            'cargo' => $this->state['cargo'],
            'salario' => $this->state['salario'],
            'modalidad' => $this->state['modalidad'],
            'tipocontrato' => $this->state['tipocontrato'],
            'tipojornada' => $this->state['tipojornada'],
            'reconocimientos' => $this->state['reconocimientos'],
            'habilidades' => $this->state['habilidades'],
        ])->save();
    }
}
