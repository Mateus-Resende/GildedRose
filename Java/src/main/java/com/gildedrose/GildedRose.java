package com.gildedrose;

class GildedRose {
    Item[] items;

    public GildedRose(Item[] items) {
        this.items = items;
    }

    public void updateQuality() {
        for (Item item : items) {
            switch(item.getName()) {
                case "Aged Brie":
                    item.increaseQualityBy(1);
                    item.decreaseSellIn();
                    continue;

                case "Sulfuras, Hand of Ragnaros":
                    continue;

                case "Backstage passes to a TAFKAL80ETC concert":
                    item.decreaseSellIn();

                    if (item.getSellIn() < 0) {
                        item.setQuality(0);
                    } else if (item.getSellIn() < 5) {
                        item.increaseQualityBy(3);
                    } else if (item.getSellIn() < 10) {
                        item.increaseQualityBy(2);
                    }
                    continue;

                case "Conjured Item":
                    item.decreaseSellIn();
                    item.decreaseQuality();
                    item.decreaseQuality();
                    continue;

                default:
                    item.decreaseSellIn();
                    item.decreaseQuality();
            }
        }
    }
}
