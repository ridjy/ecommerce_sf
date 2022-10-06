<?php

namespace App\Tests\Entity;
use App\Entity\Produit;

class ProduitTest extends \PHPUnit\Framework\TestCase
{
    public function testDefault()
    {
        $product = new Produit('Pomme', 'food', 1);
        $this->assertSame(0.055, $product->computeTVA());
    }

    public function testNegativePriceComputeTVA()
    {
        $product = new Produit('Un produit', Produit::FOOD_PRODUCT, -20);
       $this->expectException('Exception');
       $product->computeTVA();
    }

    /**
     * @dataProvider pricesForFoodProduct
     */
    public function testcomputeTVAFoodProduct($price, $expectedTva)
    {
        $product = new Produit('Un produit', Produit::FOOD_PRODUCT, $price);
        $this->assertSame($expectedTva, $product->computeTVA());
    }
    public function pricesForFoodProduct()
    {
        return [
            [0, 0.0],
            [20, 1.1],
            [100, 5.5]
        ];
    }
}