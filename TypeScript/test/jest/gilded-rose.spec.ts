import { GildedRose } from '@/gilded-rose';
import { Item } from '@/entities';

describe('Gilded Rose', () => {
  it('should foo', () => {
    const gildedRose = new GildedRose([new Item('foo', 0, 0)]);
    const items = gildedRose.updateQuality();
    expect(items[0].name).toBe('foo');
  });

  it('should reduce the sellIn by 1', () => {
    const sellIn: number = 3;
    const gildedRose = new GildedRose([new Item('foo', sellIn, 1)]);
    gildedRose.updateQuality();
    expect(gildedRose.items[0].sellIn).toBe(sellIn - 1);
  })

  it('should not have negative quality', () => {
    const gildedRose = new GildedRose([new Item('foo', 0, 1)]);
    gildedRose.updateQuality();
    gildedRose.updateQuality();
    expect(gildedRose.items[0].quality).toBe(0);
  });

  it('should reduce the quality by 2 when the date has passed', () => {
    const quality: number = 5;
    const gildedRose = new GildedRose([new Item('foo', 0, quality)]);
    gildedRose.updateQuality();
    expect(gildedRose.items[0].quality).toBe(quality - 2);
  });

  it('should increase quality if the item is an Aged Brie', () => {
    const quality: number = 5;
    const gildedRose = new GildedRose([new Item('Aged Brie', 2, quality)]);
    gildedRose.updateQuality();
    expect(gildedRose.items[0].quality).toBe(quality + 1);
  });

  it('should not have quality greater than 50', () => {
    const quality: number = 50;
    const gildedRose = new GildedRose([new Item('Aged Brie', 0, quality)]);
    gildedRose.updateQuality();
    expect(gildedRose.items[0].quality).toBe(quality);
  });


  it('should increase double of the quality if the item is an Aged Brie with negative sellIn', () => {
    const quality: number = 48;
    const gildedRose = new GildedRose([new Item('Aged Brie', 0, quality)]);
    gildedRose.updateQuality();
    expect(gildedRose.items[0].quality).toBe(quality + 2);
  });

  it('should not reduce quality of Sulfuras', () => {
    const quality: number = 50;
    const gildedRose = new GildedRose([new Item('Sulfuras, Hand of Ragnaros', null, quality)]);
    gildedRose.updateQuality();
    expect(gildedRose.items[0].quality).toBe(quality);
  });

  it('should increase quality of Backstage Passes by 2 when SellIn is 10', () => {
    const quality: number = 3;
    const gildedRose = new GildedRose([new Item('Backstage passes to a TAFKAL80ETC concert', 10, quality)]);
    gildedRose.updateQuality();
    expect(gildedRose.items[0].quality).toBe(quality + 2);
  });

  it('should increase quality of Backstage Passes by 2 when SellIn is less than 10', () => {
    const quality: number = 3;
    const gildedRose = new GildedRose([new Item('Backstage passes to a TAFKAL80ETC concert', 9, quality)]);
    gildedRose.updateQuality();
    expect(gildedRose.items[0].quality).toBe(quality + 2);
  });

  it('should increase quality of Backstage Passes by 3 when SellIn is less than 5', () => {
    const quality: number = 3;
    const gildedRose = new GildedRose([new Item('Backstage passes to a TAFKAL80ETC concert', 4, quality)]);
    gildedRose.updateQuality();
    expect(gildedRose.items[0].quality).toBe(quality + 3);
  });

  it('should increase quality of Backstage Passes by 3 when SellIn is 5', () => {
    const quality: number = 3;
    const gildedRose = new GildedRose([new Item('Backstage passes to a TAFKAL80ETC concert', 5, quality)]);
    gildedRose.updateQuality();
    expect(gildedRose.items[0].quality).toBe(quality + 3);
  });

  it('should decrease quality of Backstage Passes to 0 when SellIn is 0', () => {
    const gildedRose = new GildedRose([new Item('Backstage passes to a TAFKAL80ETC concert', 0, 10)]);
    gildedRose.updateQuality();
    expect(gildedRose.items[0].quality).toBe(0);
  });

  it('should update the quality of multiple items at the same time', () => {
    const quality: number = 3;
    const gildedRose = new GildedRose([
      new Item('Backstage passes to a TAFKAL80ETC concert', 0, 10),
      new Item('Backstage passes to a TAFKAL80ETC concert', 5, quality),
      new Item('Sulfuras, Hand of Ragnaros', null, quality),
      new Item('Aged Brie', 2, quality),
      new Item('foo', 0, quality)
    ]);
    gildedRose.updateQuality();
    expect(gildedRose.items[0].quality).toBe(0);
    expect(gildedRose.items[1].quality).toBe(quality + 3);
    expect(gildedRose.items[2].quality).toBe(quality);
    expect(gildedRose.items[3].quality).toBe(quality + 1);
    expect(gildedRose.items[4].quality).toBe(quality - 2);
  })
});
