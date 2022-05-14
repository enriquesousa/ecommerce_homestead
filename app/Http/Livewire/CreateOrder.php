<?php

namespace App\Http\Livewire;

use App\Models\Department;
use Livewire\Component;

class CreateOrder extends Component
{
    public $departments, $cities=[], $districts=[];
    public $department_id="", $city_id="", $district_id="";
    public $address, $references;
    public $envio_type=1;
    public $contact, $phone;

    public $rules = [
        'contact' => 'required',
        'phone' => 'required',
        'envio_type' => 'required',
    ];

    public function mount(){
        $this->departments = Department::all();
    }

    // Mantenernos a la escucha de la propiedad $envio_type
    public function updatedEnvioType($value){
        // $value=1 cuando se selecciona Recojo en tienda, reset mensajes de error (si hay) de la parte de envió a domicilio
        if ($value == 1) {
            $this->resetValidation([
                'department_id', 'city_id', 'district_id', 'address', 'references'
            ]);
        }
    }

    public function create_order(){
        $rules = $this->rules;
        if($this->envio_type == 2){
            $rules['department_id'] = 'required';
            $rules['city_id'] = 'required';
            $rules['district_id'] = 'required';
            $rules['address'] = 'required';
            $rules['references'] = 'required';
        }
        $this->validate($rules);
    }

    public function render()
    {
        return view('livewire.create-order');
    }
}
