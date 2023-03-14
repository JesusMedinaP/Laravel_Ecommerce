<?php

namespace App\Http\Livewire;

use App\Models\Order;
use App\Models\Product;
use Livewire\Component;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class PaymentOrder extends Component
{
    use AuthorizesRequests;

    public $order;
    protected $listeners = ['payOrder'];

    public function mount(Order $order)
    {
        $this->order = $order;
    }

    public function payOrder()
    {
        $items = json_decode($this->order->content);

        foreach ($items as $item){
            $product = Product::where('id', $item->id)->first();
            $product->sold = (integer) $product->sold + $item->qty;
            $product->update();
        }

        $this->order->status = 2;
        $this->order->save();
        return redirect()->route('orders.show', $this->order);
    }

    public function render()
    {
        $this->authorize('view', $this->order);

        $items = json_decode($this->order->content);
        $envio = json_decode($this->order->envio);

        return view('livewire.payment-order', compact('items', 'envio'));
    }
}
