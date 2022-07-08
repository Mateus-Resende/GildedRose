<?php

declare(strict_types=1);

namespace GildedRose\models;

use GildedRose\models\Item;

class RegularItem
{
  public function __construct(Item $item)
  {
    $this->item = $item;
  }

  public function updateQuality(): void
  {
    --$this->item->sell_in;
    if ($this->item->quality > 0) {
      --$this->item->quality;
    }

    if ($this->item->sell_in < 0 && $this->item->quality > 0) {
      --$this->item->quality;
    }
  }
}
