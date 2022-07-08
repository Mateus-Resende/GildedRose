<?php

declare(strict_types=1);

namespace Tests;

use GildedRose\GildedRose;
use GildedRose\models\Item;
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

    public function testBackstagePassIncreaseQuality(): void
    {
        $items = [new Item('Backstage passes to a TAFKAL80ETC concert', 12, 25)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertSame($items[0]->quality, 26);
    }

    public function testBackstagePassIncreaseQualityBy2IfSellInIsLessThan10(): void
    {
        $items = [new Item('Backstage passes to a TAFKAL80ETC concert', 9, 25)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertSame($items[0]->quality, 27);
    }

    public function testBackstagePassIncreaseQualityBy3IfSellInIsLessThan5(): void
    {
        $items = [new Item('Backstage passes to a TAFKAL80ETC concert', 4, 25)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertSame($items[0]->quality, 28);
    }

    public function testBackstagePassQualityGoesToZeroWhenSellInPassed(): void
    {
        $items = [new Item('Backstage passes to a TAFKAL80ETC concert', 0, 25)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertSame($items[0]->quality, 0);
    }

    public function testReduceQualityOfRegularItem(): void
    {
        $items = [new Item('regular', 2, 25)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertSame($items[0]->quality, 24);
    }

    public function testReduceQualityOfRegularItemByTwoWhenSellInPassed(): void
    {
        $items = [new Item('regular', 0, 25)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertSame($items[0]->quality, 23);
    }

    public function testDoesNotHaveNegativeQuality(): void
    {
        $items = [new Item('regular', 0, 0)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertSame($items[0]->quality, 0);
    }

    public function testSellInShouldReduceForAgedBrie(): void
    {
        $items = [new Item('Aged Brie', 0, 0)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertSame($items[0]->sell_in, -1);
    }

    public function testSellInShouldReduceForBackstagePasses(): void
    {
        $items = [new Item('Aged Brie', 0, 0)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertSame($items[0]->sell_in, -1);
    }

    public function testSellInShouldReduceForRegular(): void
    {
        $items = [new Item('regular', 0, 0)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertSame($items[0]->sell_in, -1);
    }
}
