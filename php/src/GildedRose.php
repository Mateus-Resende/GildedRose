<?php

declare(strict_types=1);

namespace GildedRose;

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

    public function updateQualityForAgedBrie(Item $item)
    {
        if ($item->quality < 50) {
            $item->quality += 1;
        }
        $item->sell_in -= 1;
        if ($item->sell_in < 0) {
            $item->quality += 1;
        }
    }

    public function updateQualityForBackstagePasses(Item $item)
    {
        $item->sell_in -= 1;
        if ($item->sell_in < 0) {
            $item->quality = 0;
        } elseif ($item->quality < 50) {
            $item->quality += 1;
            if ($item->sell_in < 6 && $item->quality < 50) {
                $item->quality += 1;
            }
            if ($item->sell_in < 11 && $item->quality < 50) {
                $item->quality += 1;
            }
        }
    }

    public function updateQualityForRegularItem(Item $item)
    {
        $item->sell_in -= 1;
        if ($item->quality > 0) {
            $item->quality -= 1;
        }

        if ($item->sell_in < 0 && $item->quality > 0) {
            $item->quality -= 1;
        }
    }
}
