import { Item } from "./item";

export class StandardItem {
  item: Item;

  constructor(item) {
    this.item = item
  }

  updateState(): Item {
    this.item.sellIn = this.item.sellIn - 1;
    if (this.isQualityPositive()) {
      this.item.quality = this.item.quality - 1;
      if (this.hasSellDatePassed() && this.isQualityPositive()) {
        this.item.quality = this.item.quality - 1;
      }
    }

    return this.item;
  }

  isUnderHighestQualityValue(): boolean {
    return this.item.quality < 50
  }

  isQualityPositive(): boolean {
    return this.item.quality > 0;
  }

  hasSellDatePassed(): boolean {
    return this.item.sellIn < 0;
  }
}
