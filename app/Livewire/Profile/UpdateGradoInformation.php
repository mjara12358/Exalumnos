<?php

namespace App\Livewire\Profile;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;
use Livewire\WithFileUploads;

class UpdateGradoInformation extends Component
{
    use WithFileUploads;

    public $user;

    public $state = [
        'anogrado' => '',
        'numeroprograma' => '',
        'periodogrado' => '',
        'fechagrado' => '',
        'actagrado' => '',
    ];

    public function render()
    {
        $this->user = Auth::user();
        return view('livewire.profile.update-grado-information', ['user' => $this->user]);
    }

    public function mount()
    {
        $user = Auth::user(); // Suponiendo que estás utilizando Laravel Jetstream
        $this->state['anogrado'] = $user->anogrado;
        $this->state['numeroprograma'] = $user->numeroprograma;
        $this->state['periodogrado'] = $user->periodogrado;
        $this->state['fechagrado'] = $user->fechagrado;
        $this->state['actagrado'] = $user->actagrado;
    }

    public function updateGradoInformation(): void
    {
        $user = Auth::user();

        Validator::make($this->state, [
            'numeroprograma' => ['required', 'string', 'max:255'],
            'periodogrado' => ['required', 'string', 'max:255'],
            'fechagrado' => ['required', 'date'],
            'actagrado' => ['nullable', 'file', 'max:300'], // Cambiado a 'nullable' y 'file'
        ])->validateWithBag('updateGradoInformation'); // Cambiado a 'updateGradoInformation'

        // Verifica si se ha cargado un archivo de acta de grado
        if ($this->state['actagrado']) {
            $fileName = time() . $this->state['actagrado']->getClientOriginalName();
            $path = $this->state['actagrado']->storeAs('actas', $fileName, 'public');
            $user->actagrado = '/storage/' . $path;
        }

        $user
            ->forceFill([
                'numeroprograma' => $this->state['numeroprograma'],
                'periodogrado' => $this->state['periodogrado'],
                'fechagrado' => $this->state['fechagrado'],
            ])
            ->save();
    }
}
