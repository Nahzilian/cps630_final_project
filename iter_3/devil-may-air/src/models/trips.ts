export default class Trip {
  id: string;
  source: string;
  destination: string;
  distance: number;
  carId: string;
  price: number;
  constructor(
    _id: string,
    source: string,
    destination: string,
    distance: number,
    carId: string,
    price: number,
  ) {
    this.id = _id ;
    this.source = source ;
    this.destination = destination ;
    this.distance = distance ;
    this.carId = carId ;
    this.price = price ;
  }
}
