export default class Flower {
  price: number;
  id: string;
  flowerName: string;
  storeCode: string;
  imageid: number;
  constructor(
    price: number,
    _id: string,
    flowerName: string,
    storeCode: string,
    imageid: number,
  ) {
    this.price = price;
    this.id = _id;
    this.flowerName = flowerName;
    this.storeCode = storeCode;
    this.imageid = imageid;
  }
}
