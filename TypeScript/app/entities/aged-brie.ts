import { Item } from "./item";
import { StandardItem } from "./standard-item";

export class AgedBrie extends StandardItem {
  constructor(item) {
    super(item)
  }

  updateState(): Item {
    this.item.sellIn = this.item.sellIn - 1;

    if (this.isUnderHighestQualityValue()) {
      this.item.quality = this.item.quality + 1;
      if (this.hasSellDatePassed()) {
        this.item.quality = this.item.quality + 1;
      }
    }
    return this.item;
  }
}
