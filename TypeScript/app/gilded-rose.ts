import { Item } from "./entities/item";

export class GildedRose {
  items: Array<Item>;

  constructor(items = [] as Array<Item>) {
    this.items = items;
  }

  updateQuality(): Array<Item> {
    for (let item of this.items) {
      if (this.isUnderHighestQualityValue(item) && this.isQualityPositive(item)) {
        if (this.isSulfuras(item)) {
          continue;
        }

        item.sellIn = item.sellIn - 1;

        if (!this.isAgedBrie(item) && !this.isBackstagePass(item)) {
          this.changeQualityBy(item, -1);
        } else {
          this.changeQualityBy(item, 1);
          if (this.isBackstagePass(item)) {
            if (item.sellIn < 11) {
              this.changeQualityBy(item, 1);
            }
            if (item.sellIn < 6) {
              this.changeQualityBy(item, 1);
            }
          }
        }

        if (this.hasSellDatePassed(item)) {
          if (!this.isAgedBrie(item)) {
            if (!this.isBackstagePass(item)) {
              if (this.isQualityPositive(item)) {
                this.changeQualityBy(item, -1);
              }
            } else {
              this.changeQualityBy(item, -item.quality);
            }
          } else {
            this.changeQualityBy(item, 1);
          }
        }
      }
    }

    return this.items;
  }

  isAgedBrie(item: Item): boolean {
    return item.name.toLowerCase().includes('aged brie');
  }

  isBackstagePass(item: Item): boolean {
    return item.name.toLowerCase().includes('backstage passes');
  }

  isSulfuras(item: Item): boolean {
    return item.name.toLowerCase().includes('sulfuras');
  }

  isUnderHighestQualityValue(item: Item): boolean {
    return item.quality < 50
  }

  isQualityPositive(item: Item): boolean {
    return item.quality > 0;
  }

  changeQualityBy(item: Item, amount: number): void {
    item.quality = item.quality + amount;
  }

  hasSellDatePassed(item: Item): boolean {
    return item.sellIn < 0;
  }
}
