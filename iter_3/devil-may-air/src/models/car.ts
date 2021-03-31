export default class Car {
  available: boolean;
  id: string;
  model: string;
  carCode: string;
  imageid: number;
  constructor(
    available: boolean,
    _id: string,
    model: string,
    carCode: string,
    imageid: number,
  ) {
    this.available = available;
    this.id = _id;
    this.model = model;
    this.carCode = carCode;
    this.imageid = imageid;
  }
}
