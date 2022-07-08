<?php

declare(strict_types=1);


namespace GildedRose;

use GildedRose\models\AgedBrie;
use GildedRose\models\BackstagePass;
use GildedRose\models\Item;
use GildedRose\models\RegularItem;
use GildedRose\models\Sulfuras;

final class GildedRose
{
    /**
     * @var Item[]
     */
    private $items;

    public function __construct(array $items)
    {
        $this->items = $items;
    }

    public function updateQuality(): void
    {
        foreach ($this->items as $item) {
            switch ($item->name) {
                case 'Sulfuras, Hand of Ragnaros':
                    $this->updateQualityForSulfuras($item);
                    break;
                case 'Aged Brie':
                    $this->updateQualityForAgedBrie($item);
                    break;
                case 'Backstage passes to a TAFKAL80ETC concert':
                    $this->updateQualityForBackstagePasses($item);
                    break;

                default:
                    $this->updateQualityForRegularItem($item);
                    break;
            }
        }
    }

    public function updateQualityForSulfuras(Item $item)
    {
        $sulfuras = new Sulfuras($item);
        $sulfuras->updateQuality();
    }

    public function updateQualityForAgedBrie(Item $item)
    {
        $agedBrie = new AgedBrie($item);
        $agedBrie->updateQuality();
    }

    public function updateQualityForBackstagePasses(Item $item)
    {
        $backstagePass = new BackstagePass($item);
        $backstagePass->updateQuality();
    }

    public function updateQualityForRegularItem(Item $item)
    {
        $regularItem = new RegularItem($item);
        $regularItem->updateQuality();
    }
}
