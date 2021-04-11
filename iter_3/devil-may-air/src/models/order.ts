import Flower from "./flower";

export default class CustomerOrder {
  id: string;
  dateIssued: Date;
  dateDone: Date;
  totalPrice: number;
  customerId: string;
  tripId: string;
  flowers: Array<Flower>;
  constructor(
    _id: string,
    dateIssued: Date,
    dateDone: Date,
    totalPrice: number,
    customerId: string,
    tripId: string,
    flowers: Array<Flower>,
  ) {
    this.id = _id ;
    this.dateIssued = dateIssued ;
    this.dateDone = dateDone ;
    this.totalPrice = totalPrice ;
    this.customerId = customerId ;
    this.tripId = tripId ;
    this.flowers = flowers ;
  }
}
