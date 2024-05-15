<?php

namespace App\Livewire\Profile;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Livewire\Component;

class UpdateLaborInformation extends Component
{
    public $user;
    public $token;
    public $countries;
    public $states;
    public $cities;

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

    public function render()
    {
        $this->user = Auth::user();
        return view('livewire.profile.update-labor-information', ['user' => $this->user]);
    }

    public function mount()
    {
        $response = Http::withHeaders([
            "Accept" => "application/json",
            "api-token" => "s4EP2smx8Rl4cC5tT2iH_cgzA1Q7P-BhwZpZB7GhaTIJD0AhCdLIRIYIFaOGQ8Pmtjc",
            "user-email" => "hawefo9797@funvane.com"
        ])->get('https://www.universal-tutorial.com/api/getaccesstoken');

        $this->token = $response->json('auth_token');

        $countries = Http::withHeaders([
            "Authorization" => "Bearer ". $this->token,
            "Accept" => "application/json"
        ])->get('https://www.universal-tutorial.com/api/countries/'); 
        $this->countries = $countries->json();
        
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
            $this->getStates();
        }

        if (!empty($this->state['departamentoempresa'])) {
            $this->getCities();
        }
        
    }

    public function getStates(){
        if (!empty($this->state['paisempresa'])) {
            $states = Http::withHeaders([
                "Authorization" => "Bearer ". $this->token,
                "Accept" => "application/json"
            ])->get('https://www.universal-tutorial.com/api/states/'. $this->state['paisempresa']); 
            $this->states = $states->json();
        }
    }

    public function getCities(){
        if (!empty($this->state['departamentoempresa'])) {
            $cities = Http::withHeaders([
                "Authorization" => "Bearer ". $this->token,
                "Accept" => "application/json"
            ])->get('https://www.universal-tutorial.com/api/cities/'. $this->state['departamentoempresa']); 
            $this->cities = $cities->json();
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
