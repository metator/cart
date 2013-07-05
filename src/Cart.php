<?php
namespace Metator\Cart;

/** The simplest shopping cart class ever written, ever. */
class Cart
{
    protected $items = array();
    protected $quantity = array();
    protected $prices = array();

    /** Add an item ID to the cart  w/ an optional price for this item */
    function add($id, $price=null)
    {
        if(!in_array($id, $this->items)) {
            $this->items[] = $id;
        }
        if($price) {
            $this->prices[$id] = $price;
        }
        if(!isset($this->quantity[$id])) {
            $this->quantity[$id] = 0;
        }
        $this->quantity[$id]++;
    }

    /** Remove all items of a given ID from the cart */
    function remove($id)
    {
        $this->quantity[$id] = 0;
        $this->items = array_diff($this->items, array($id));
    }

    /** Get the total quantity of items in the cart */
    function itemCount()
    {
        return array_sum($this->quantity);
    }

    /** Get an array of unique item IDs in the cart */
    function items()
    {
        return $this->items;
    }

    /** Get the quantity of an item in the cart for an ID */
    function quantity($id)
    {
        return $this->quantity[$id];
    }

    /** Set the quantity of an item in the cart for an ID */
    function setQuantity($id, $quantity)
    {
        if($quantity == 0) {
            return $this->remove($id);
        }
        $this->quantity[$id] = $quantity;
    }

    /** Get the per item price for an ID */
    function price($id)
    {
        return $this->prices[$id];
    }

    /** Get the total price for an item if you pass an ID, or all items if you don't pass an ID. */
    function totalPrice($id=null)
    {
        if(!$id) {
            $total = 0;
            foreach($this->items() as $id) {
                $total += $this->totalPrice($id);
            }
            return $total;
        }
        return $this->price($id) * $this->quantity($id);
    }

}