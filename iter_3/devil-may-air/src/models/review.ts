export default class Review {
  review: string;
  score: number;
  type: string;
  itemId: string;
  constructor(
    review: string,
    score: number,
    type: string,
    itemId: string,
  ) {
    this.review = review;
    this.score = score;
    this.type = type;
    this.itemId = itemId;
  }
}
