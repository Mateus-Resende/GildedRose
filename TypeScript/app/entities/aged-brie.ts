import { Item } from "./item";
import { StandardItem } from "./standard-item";

export class AgedBrie extends StandardItem {
  constructor(item) {
    super(item)
  }

  updateQuality(): void {
    this.item.quality = this.item.quality + 1;
    if (this.hasSellDatePassed()) {
      this.item.quality = this.item.quality + 1;
    }
  }
}
