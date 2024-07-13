<?php

class AcmeWidgetBasket {
    private $catalogue;
    private $deliveryRules;
    private $offers;
    private $basket;

    public function __construct($catalogue, $deliveryRules, $offers) {
        $this->catalogue = $catalogue;
        $this->deliveryRules = $deliveryRules;
        $this->offers = $offers;
        $this->basket = [];
    }

    public function add($productCode) {
        if (array_key_exists($productCode, $this->catalogue)) {
            $this->basket[] = $productCode;
        } else {
            throw new Exception("Product with code '$productCode' does not exist in the catalogue.");
        }
    }

    public function total() {
        $subtotal = 0;

        // Calculate subtotal
        foreach ($this->basket as $productCode) {
            $subtotal += $this->catalogue[$productCode]['price'];
        }

        // Apply special offer: "buy one red widget, get the second half price"
        $redWidgetCount = array_count_values($this->basket)['R01'] ?? 0;
        if ($redWidgetCount >= 2) {
            $discountAmount = floor($redWidgetCount / 2) * ($this->catalogue['R01']['price'] / 2);
            $subtotal -= $discountAmount;
        }

        // Apply delivery charges based on subtotal
        if ($subtotal < 50) {
            $deliveryCost = 4.95;
        } elseif ($subtotal < 90) {
            $deliveryCost = 2.95;
        } else {
            $deliveryCost = 0;
        }

        // Calculate total cost
        $total = $subtotal + $deliveryCost;

        return number_format($total, 2);
    }
}

// Example usage:
$catalogue = [
    'R01' => ['price' => 32.95],
    'G01' => ['price' => 24.95],
    'B01' => ['price' => 7.95]
];

$deliveryRules = [
    ['threshold' => 0, 'cost' => 4.95],
    ['threshold' => 50, 'cost' => 2.95],
    ['threshold' => 90, 'cost' => 0]
];

$offers = [
    // Initial offer: Buy one red widget, get the second half price
    ['productCode' => 'R01', 'offerType' => 'BOGOHP']
];

$basket1 = new AcmeWidgetBasket($catalogue, $deliveryRules, $offers);
$basket1->add('B01');
$basket1->add('G01');
echo "Basket 1 Total: $" . $basket1->total() . "\n";

$basket2 = new AcmeWidgetBasket($catalogue, $deliveryRules, $offers);
$basket2->add('R01');
$basket2->add('R01');
echo "Basket 2 Total: $" . $basket2->total() . "\n";

$basket3 = new AcmeWidgetBasket($catalogue, $deliveryRules, $offers);
$basket3->add('R01');
$basket3->add('G01');
echo "Basket 3 Total: $" . $basket3->total() . "\n";

$basket4 = new AcmeWidgetBasket($catalogue, $deliveryRules, $offers);
$basket4->add('B01');
$basket4->add('B01');
$basket4->add('R01');
$basket4->add('R01');
$basket4->add('R01');
echo "Basket 4 Total: $" . $basket4->total() . "\n";
?>
