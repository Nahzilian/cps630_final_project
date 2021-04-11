export default class Car {
  available: boolean;
  id: string;
  model: string;
  carCode: string;
  imageid: number;
  score: number;
  usersVoted: number;
  constructor(
    available: boolean,
    _id: string,
    model: string,
    carCode: string,
    imageid: number,
    score: number,
    usersVoted: number
  ) {
    this.available = available;
    this.id = _id;
    this.model = model;
    this.carCode = carCode;
    this.imageid = imageid;
    this.score = score;
    this.usersVoted = usersVoted;
  }
}
