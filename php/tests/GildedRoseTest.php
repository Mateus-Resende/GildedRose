<?php

declare(strict_types=1);

namespace Tests;

use GildedRose\GildedRose;
use GildedRose\Item;
use PHPUnit\Framework\TestCase;

class GildedRoseTest extends TestCase
{
    public function testAgedBrieShouldIncreaseQuality(): void
    {
        $items = [new Item('Aged Brie', 1, 0)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertSame($items[0]->quality, 1);
    }

    public function testAgedBrieShouldIncreaseQualityByTwoIfSellInIsNegative(): void
    {
        $items = [new Item('Aged Brie', 0, 0)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertSame($items[0]->quality, 2);
    }

    public function testQualityCannotBeGreatedThan50(): void
    {
        $items = [new Item('Aged Brie', 1, 50)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertSame($items[0]->quality, 50);
    }

    public function testSulfurasDoesNotReduceQuality(): void
    {
        $items = [new Item('Sulfuras, Hand of Ragnaros', 1, 25)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertSame($items[0]->quality, 25);
    }

    public function testSulfurasDoesNotReduceSellIn(): void
    {
        $items = [new Item('Sulfuras, Hand of Ragnaros', 1, 25)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertSame($items[0]->sell_in, 1);
    }
}
