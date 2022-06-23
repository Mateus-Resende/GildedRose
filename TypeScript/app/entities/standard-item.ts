import { Item } from "./item";

export class StandardItem {
  item: Item;

  constructor(item) {
    this.item = item
  }

  updateState(): Item {
    this.updateQuality();
    this.updateSellIn();

    return this.item;
  }

  updateQuality() {
    this.item.quality = this.item.quality - 1;
    if (this.hasSellDatePassed() && this.isQualityPositive()) {
      this.item.quality = this.item.quality - 1;
    }
  }

  updateSellIn() {
    this.item.sellIn = this.item.sellIn - 1;
  }

  isUnderHighestQualityValue(item: Item): boolean {
    return item.quality < 50
  }

  isQualityPositive(): boolean {
    return this.item.quality > 0;
  }

  hasSellDatePassed(): boolean {
    return this.item.sellIn < 0;
  }
}
