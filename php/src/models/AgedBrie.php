<?php

declare(strict_types=1);

namespace GildedRose\models;

use GildedRose\models\RegularItem;

class AgedBrie extends RegularItem
{
  public function __construct(Item $item)
  {
    $this->item = $item;
  }

  public function updateQuality(): void
  {
    if ($this->item->quality < 50) {
      ++$this->item->quality;
    }
    --$this->item->sell_in;
    if ($this->item->sell_in < 0) {
      ++$this->item->quality;
    }
  }
}
