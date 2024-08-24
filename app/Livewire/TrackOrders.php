<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class TrackOrders extends Component
{
    use LivewireAlert;

    public function cancel_order($order_id){
        $order = Auth::user()->orders()->where('id', $order_id)->first();
        if (!$order) {
            return $this->alert('error', 'Order not found');
        }
        if ($order->status != 'pending') {
            return $this->alert('error', 'cannot cancel order after pending process');
        }
        $order->status = 'cancelled';
        $order->save();
        $this->alert('success', 'Order cancelled successfully');
    }

    public function render()
    {
        return view('livewire.pages.track-orders',[
            'orders' => Auth::user()->orders
        ]);
    }
}
