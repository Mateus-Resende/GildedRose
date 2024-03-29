import { Item } from "./item";
import { StandardItem } from "./standard-item";

export class BackstagePass extends StandardItem {
  constructor(item) {
    super(item);
  }

  updateState(): Item {
    this.item.sellIn = this.item.sellIn - 1;

    if (this.item.sellIn < 0) {
      this.item.quality = this.item.quality - this.item.quality;
    } else {
      this.item.quality = this.item.quality + 1;
      if (this.item.sellIn < 11) {
        this.item.quality = this.item.quality + 1;
      }
      if (this.item.sellIn < 6) {
        this.item.quality = this.item.quality + 1;
      }
    }
    return this.item;
  }
}
