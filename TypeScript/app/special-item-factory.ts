import { AgedBrie, BackstagePass, Item, StandardItem } from "./entities";

const AVAILABLE_ITEM_KLASSES: { [key: string]: typeof AgedBrie | typeof BackstagePass } = {
  'aged brie': AgedBrie,
  'backstage pass': BackstagePass,
}

export class SpecialItemFactory {
  static buildSpecialItem(item: Item) {
    const entity = AVAILABLE_ITEM_KLASSES[item.name.toLowerCase()] || StandardItem;
    return new entity(item);
  }
}
