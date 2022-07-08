<?php

declare(strict_types=1);

namespace GildedRose\models;

use GildedRose\models\RegularItem;

class BackstagePass extends RegularItem
{
  public function __construct(Item $item)
  {
    $this->item = $item;
  }

  public function updateQuality(): void
  {
    --$this->item->sell_in;
    if ($this->item->sell_in < 0) {
      $this->item->quality = 0;
    } elseif ($this->item->quality < 50) {
      ++$this->item->quality;
      if ($this->item->sell_in < 6 && $this->item->quality < 50) {
        ++$this->item->quality;
      }
      if ($this->item->sell_in < 11 && $this->item->quality < 50) {
        ++$this->item->quality;
      }
    }
  }
}
