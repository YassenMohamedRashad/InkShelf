<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Validate;
use Livewire\Component;

class UserInfo extends Component
{
    use LivewireAlert;

    #[Validate]
    public $address='';

    #[Validate('min:7', message: 'enter valid phone number')]
    public $phone_number='';

    #[Validate]
    public $birth_date='';

    #[Validate]
    public $gender='';


    public function rules()
    {
        return [
            'address' => 'required|string|min:10',
            'phone_number' => 'required|min:7|numeric',
            'birth_date' => 'required|date',
            'gender'=> 'required|in:male,female'
        ];
    }

    public function save(){
        $this->validate();
        User::find(Auth::user()->id)->update([
            'address' => $this->address,
            'phone_number' => $this->phone_number,
            'birth_date' => $this->birth_date,
            'gender' => $this->gender,
        ]);
        $this->alert('success', 'done successfully');
        $this->redirect(route('cart'), true);
    }
    public function render()
    {
        return view('livewire.pages.user-info');
    }
}
