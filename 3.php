<?php

class Paypal
{
    function addPayment($amount){
        echo "add Payment $amount";
    }
}

class Combank
{
    function addPayment($amount){
        echo "add Payment $amount";
    }
}

class Order
{
    public $items = []; // just to make the code easy to learn
    public $quantities = [];
    public $prices = [];
    public $status = "OPEN"; // use constants

    public function addItem($name, $quantity, $price)
    {
        $this->items[] = $name;
        $this->quantities[] = $quantity;
        $this->prices[] = $price;
    }

    public function getTotalPrice()
    {
        $total = 0.00;
        foreach ($this->prices as $key => $price) {
            $total += $this->quantities[$key] * $price;
        }
        return $total;
    }

    public function pay($paymentType, $securityCode)  // responsible for the payment
    {
        if ($paymentType == "DEBIT") {
            echo "\n processing the debit payment with security code $securityCode \n\n";
            $this->status="PAID"; // should be a constant
        } elseif ($paymentType == "CREDIT") {
            echo "\n processing the credit payment with security code $securityCode \n\n";
            $this->status="PAID"; // should be a constant
        }
        elseif ($paymentType == "PAYPAL") {
            $paypal = new Paypal();
            $paypal->addPayment(100);
            echo "\n processing the paypal payment with security code $securityCode \n\n";
            $this->status="PAID"; // should be a constant
        }elseif ($paymentType == "COMBANK") {
            $paypal = new Combank();
            $paypal->addPayment(100);
            echo "\n processing the combank payment with security code $securityCode \n\n";
            $this->status="PAID"; // should be a constant
        } else {
            throw new Exception("Unknown Payment Type");
        }
    }
}



$order = new Order();
$order->addItem("Milo", 10,60.00);
$order->addItem("Fried Rice - Large", 2,350.00);
$order->addItem("Chicken Koththu", 5,200.00);

echo $order->getTotalPrice();
$order->pay("PAYPAL", "Honda@123");

echo "\n\n";
?>