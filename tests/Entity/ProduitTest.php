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
}