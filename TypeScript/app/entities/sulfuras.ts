import { Item } from "./item";
import { StandardItem } from "./standard-item";

export class Sulfuras extends StandardItem {
  constructor(item) {
    super(item);
  }

  updateState(): Item {
    return this.item;
  }
}
