<?php

declare(strict_types=1);

namespace GildedRose\models;

use GildedRose\models\RegularItem;

class Sulfuras extends RegularItem
{
  public function __construct(Item $item)
  {
    $this->item = $item;
  }

  public function updateQuality(): void
  {
  }
}
