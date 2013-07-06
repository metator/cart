[![Build Status](https://travis-ci.org/metator/cart.png?branch=master)](https://travis-ci.org/metator/cart)

Metator Cart
====

The simplest shopping cart class ever to exist. For a full stack shopping cart system, check out metator/application.

The cart class class is hopefully very intuitive. It depends on nothing, and assumes nothing except that your items have a unique identifier.

````php
use Metator\Cart\Cart;

$cart = new Cart;
$cart->add(5);
$cart->add(5);
$cart->add(5);

echo $cart->quantity(5); // 3
print_r($cart->items()); // array(5)

$cart->remove(5);
echo $cart->quantity(5); // 0
print_r($cart->items()); // array()

$cart->add(5);
$cart->setQuantity(5,500);

echo $cart->quantity(5); // 500

$cart->setQuantity(5,0);
print_r($cart->items()); // array()
````

##Understanding Identifiers##
The value for the ID could be the auto_increment from your database, a product SKU, or any kind of unique identifier like a hash. For example if a T-Shirt comes in multiple colors but always has the same SKU & ID regardless of color, you could use a hash representing the configured state of that product for the id here.
