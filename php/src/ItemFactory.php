<?php

declare(strict_types=1);


namespace GildedRose;

use GildedRose\models\Item;

class ItemFactory
{
  static $itemMapping = [
    'Aged Brie' => 'GildedRose\models\AgedBrie',
    'Backstage passes to a TAFKAL80ETC concert' => 'GildedRose\models\BackstagePass',
    'Sulfuras, Hand of Ragnaros' => 'GildedRose\models\Sulfuras',
  ];

  public static function buildItemFor(Item $item)
  {
    $itemKlass = 'GildedRose\models\RegularItem';
    if (array_key_exists($item->name, ItemFactory::$itemMapping)) {
      $itemKlass = ItemFactory::$itemMapping[$item->name];
    }
    return new $itemKlass($item);
  }
}
