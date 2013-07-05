<?php
namespace Metator\Cart;

class CartTest extends \PHPUnit_Framework_TestCase
{
    function testShouldAddID()
    {
        $cart = new Cart;
        $cart->add(5);
        $this->assertEquals(array(5), $cart->items(), 'should add ID');
    }

    function testShouldNotAddIDTwice()
    {
        $cart = new Cart;
        $cart->add(5);
        $cart->add(5);
        $this->assertEquals(array(5), $cart->items(), 'should not add ID twice');
    }

    function testShouldGetSingleQuantity()
    {
        $cart = new Cart;
        $cart->add(5);
        $this->assertEquals(1, $cart->quantity(5), 'should get single quantity');
    }

    function testShouldGetMultipleQuantity()
    {
        $cart = new Cart;
        $cart->add(5);
        $cart->add(5);
        $cart->add(5);
        $this->assertEquals(3, $cart->quantity(5), 'should get multiple quantity');
    }

    function testShouldRemoveFromItems()
    {
        $cart = new Cart;
        $cart->add(5);
        $cart->remove(5);
        $this->assertEquals(array(), $cart->items(), 'should remove from items');
    }

    function testShouldRemoveFromQuantity()
    {
        $cart = new Cart;
        $cart->add(5);
        $cart->remove(5);
        $this->assertEquals(0, $cart->quantity(5), 'should remove from quantity');
    }

    function testShouldSetQuantity()
    {
        $cart = new Cart;
        $cart->add(5);
        $cart->setQuantity(5,500);
        $this->assertEquals(500, $cart->quantity(5), 'should set quantity');
    }

    function testShouldRemoveWhenSetQuantity0()
    {
        $cart = new Cart;
        $cart->add(5);
        $cart->setQuantity(5,0);
        $this->assertEquals(array(), $cart->items(), 'should remove when set quantity to 0');
    }

    function testShouldCountItems()
    {
        $cart = new Cart;
        $cart->add(5);
        $cart->add(5);
        $cart->add(2);
        $this->assertEquals(3,$cart->itemCount(), 'should count items');
    }

    function testShouldSetPrice()
    {
        $cart = new Cart;
        $cart->add(5, 9.99);
        $this->assertEquals(9.99, $cart->price(5), 'should get price of an item');
    }

    function testItemPriceDoesntDependOnQuantity()
    {
        $cart = new Cart;
        $cart->add(5, 9.99);
        $cart->add(5);
        $this->assertEquals(9.99, $cart->price(5), 'item price does not depend on quantity');
    }

    function testItCanChangeTheItemsPrice()
    {
        $cart = new Cart;
        $cart->add(5, 9.99);
        $cart->add(5, 7.99);
        $this->assertEquals(7.99, $cart->price(5), 'it can change the items price');
    }

    function testShouldTotalPriceForAnItem()
    {
        $cart = new Cart;
        $cart->add(5, 10);
        $cart->setQuantity(5, 10);
        $this->assertEquals(100, $cart->totalPrice(5), 'it totals price for an item');
    }

    function testShouldTotalPriceForAllItems()
    {
        $cart = new Cart;
        $cart->add(1, 10);
        $cart->add(2, 5);
        $cart->setQuantity(1, 10); // $100 worth of item 1
        $cart->setQuantity(2, 5); // $25 worth of item 2
        $this->assertEquals(125, $cart->totalPrice(), 'it totals price for all items');
    }

}