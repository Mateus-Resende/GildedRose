import { Item, AgedBrie } from "./entities";
import { SpecialItemFactory } from "./special-item-factory";

export class GildedRose {
  items: Array<Item>;

  constructor(items = [] as Array<Item>) {
    this.items = items;
  }

  updateQuality(): Array<Item> {
    for (let item of this.items) {
      this.buildSpecialItem(item).updateState();
    }

    return this.items;
  }

  buildSpecialItem(item: Item): AgedBrie {
    return SpecialItemFactory.buildSpecialItem(item);
  }
}
