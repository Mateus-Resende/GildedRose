import { AgedBrie, BackstagePass, Item, StandardItem } from "./entities";
import { Sulfuras } from "./entities/sulfuras";

const AVAILABLE_ITEM_KLASSES: { [key: string]: typeof AgedBrie | typeof BackstagePass | typeof Sulfuras } = {
  'aged brie': AgedBrie,
  'backstage pass': BackstagePass,
  'sulfuras': Sulfuras
}

export class SpecialItemFactory {
  static buildSpecialItem(item: Item) {
    const entity = this.getItemKlass(item);
    return new entity(item);
  }

  private static getItemKlass(item): typeof AgedBrie | typeof BackstagePass | typeof Sulfuras | typeof StandardItem {
    const key = Object.keys(AVAILABLE_ITEM_KLASSES).find((key) => item.name.toLowerCase().includes(key));
    return AVAILABLE_ITEM_KLASSES[key] || StandardItem;
  }
}
