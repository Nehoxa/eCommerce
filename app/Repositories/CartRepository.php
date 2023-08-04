<?php

namespace App\Repositories;

use App\Models\Product;

class CartRepository
{
    public function add(Product $product)
    {
        \Cart::session(auth()->user()->id)
            ->add(
                array(
                'id' => $product->id,
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => 1,
                'attributes' => array(),
                'associatedModel' => $product
            )
            );

        return $this->count();
    }

    public function content()
    {
        return \Cart::session(auth()->user()->id)
            ->getContent();
    }

    public function total()
    {
        return \Cart::session(auth()->user()->id)->getTotal();
    }

    public function jsonOrderItems()
    {
        return $this
            ->content()
            ->map(function ($item) {
                return [
                    'name' => $item->name,
                    'quantity' => $item->quantity,
                    'price' => $item->price,
                ];
            })
            ->toJson();
    }

    public function count()
    {
        return $this->content()
            ->sum('quantity');
    }

    public function increase($id)
    {
        \Cart::session(auth()->user()->id)
            ->update($id, [
                'quantity' => +1
            ]);
    }

    public function decrease($id)
    {
        $item = \Cart::session(auth()->user()->id)->get($id);

        if ($item->quantity === 1) {
            $this->remove($id);
            return;
        }

        \Cart::session(auth()->user()->id)
            ->update($id, [
                'quantity' => -1
            ]);
    }

    public function remove($id)
    {
        \Cart::session(auth()->user()->id)->remove($id);
    }

    public function clear()
    {
        \Cart::session(auth()->user()->id)->clear();
    }
}
