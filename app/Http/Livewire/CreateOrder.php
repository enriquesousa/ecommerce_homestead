<?php

namespace App\Http\Livewire;

use App\Models\City;
use App\Models\Department;
use App\Models\District;
use App\Models\Order;
use Livewire\Component;

use Gloudemans\Shoppingcart\Facades\Cart;

class CreateOrder extends Component
{
    public $departments, $cities=[], $districts=[];
    public $department_id="", $city_id="", $district_id="";
    public $address, $references;
    public $envio_type=1;
    public $contact, $phone, $shipping_cost=0;

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

    // Mantenernos a la escucha de la propiedad $department_id (Estado)
    public function updatedDepartmentId($value){
        // get la Colección de Ciudades del estado
        $this->cities = City::where('department_id', $value)->get();
        $this->reset(['city_id', 'district_id']); // lo encerramos en un array porque queremos reset dos valores
    }

    // Mantenernos a la escucha de la propiedad $city_id (Ciudad)
    public function updatedCityId($value){
        // cargar el costo de envió a esa ciudad
        $city = City::find($value);
        $this->shipping_cost = $city->cost;
        // get la Colección de Colonias de la ciudad
        $this->districts = District::where('city_id', $value)->get();
        $this->reset('district_id'); // para que si cambiamos de ciudad se reset esta propiedad
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

        $order = new Order();
        $order->user_id = auth()->user()->id;
        $order->contact = $this->contact;
        $order->phone = $this->phone;
        $order->envio_type = $this->envio_type;
        $order->shipping_cost = 0;
        $order->total = $this->shipping_cost + Cart::subtotal();
        $order->content = Cart::content();

        if ($this->envio_type == 2) {
            $order->shipping_cost = $this->shipping_cost;
            $order->department_id = $this->department_id;
            $order->city_id = $this->city_id;
            $order->district_id = $this->district_id;
            $order->address = $this->address;
            $order->references = $this->references;
        }

        // crear un nuevo registro en la tabla orders
        $order->save();

        foreach (Cart::content() as $item) {
            // mandamos llamar al helper para que nos descuente el item en la base de datos
            discount($item);
        }


        // Limpiar el carrito de compra
        Cart::destroy();

        return redirect()->route('orders.payment', $order);

    }

    public function render()
    {
        return view('livewire.create-order');
    }
}
