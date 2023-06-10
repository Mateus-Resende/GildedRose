package com.gildedrose;

public class Item {

    private final String name;

    private int sellIn;

    private int quality;

    public Item(String name, int sellIn, int quality) {
        this.name = name;
        this.sellIn = sellIn;
        this.quality = quality;
    }

    @Override
    public String toString() {
        return this.name + ", " + this.sellIn + ", " + this.quality;
    }


    public String getName() {
        return this.name;
    }

    public int getSellIn() {
        return this.sellIn;
    }

    public int getQuality() {
        return this.quality;
    }

    public void setQuality(int quality) {
        this.quality = quality;
    }
    public void setSellIn(int sellIn) {
        this.sellIn = sellIn;
    }

    public void increaseQualityBy(int amount) {
        this.quality += amount;
        if (this.quality > 50) {
            this.quality = 50;
        }
    }

    public void decreaseSellIn() {
        this.sellIn -= 1;
        if (this.sellIn < 0) {
            decreaseQuality();
        }
    }

    public void decreaseQuality() {
        if (this.quality > 0) {
            this.quality -= 1;
        }
    }
}
