<?php

namespace App\Livewire\Profile;

use App\Models\User;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\UpdatesUserProfileInformation;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class UpdateSocialInformation extends Component
{
    public $user;

    public $state = [
        'genero' => '',
        'educacion' => '',
        'estrato' => '',
        'ingresosfamiliares' => '',
        'domicilio' => '',
        'estadocivil' => '',
    ];

    public function render()
    {
        $this->user = Auth::user();
        return view('livewire.profile.update-social-information', ['user' => $this->user]);
    }

    public function mount()
    {
        $user = Auth::user(); // Suponiendo que estás utilizando Laravel Jetstream
        $this->state['genero'] = $user->genero;
        $this->state['educacion'] = $user->educacion;
        $this->state['estrato'] = $user->estrato;
        $this->state['ingresosfamiliares'] = $user->ingresosfamiliares;
        $this->state['domicilio'] = $user->domicilio;
        $this->state['estadocivil'] = $user->estadocivil;
    }

    public function updateSocialInformation(): void
    {
        $user = Auth::user();

        Validator::make($this->state, [
            'genero' => ['required', 'string', 'max:255'],
            'educacion' => ['required', 'string', 'max:255'],
            'estrato' => ['required', 'string', 'max:255'],
            'ingresosfamiliares' => ['required', 'string', 'max:255'],
            'domicilio' => ['required', 'string', 'max:255'],
            'estadocivil' => ['required', 'string', 'max:255'],
        ])->validateWithBag('updateSocialInformation');

        $user->forceFill([
                'genero' => $this->state['genero'],
                'educacion' => $this->state['educacion'],
                'estrato' => $this->state['estrato'],
                'ingresosfamiliares' => $this->state['ingresosfamiliares'],
                'domicilio' => $this->state['domicilio'],
                'estadocivil' => $this->state['estadocivil'],
            ])
            ->save();
    }
}
