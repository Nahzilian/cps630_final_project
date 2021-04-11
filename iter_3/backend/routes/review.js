const router = require('express').Router();
const Review = require('../models/Review');

const { validateToken } = require('../utils/authentication');

router.post('/', validateToken, async (req, res, next) => {
  const newReviewObj = {
    review: req.body.review,
    score: req.body.score,
    type: req.body.type,
    itemId: req.body.itemId,
    userId: req.body.userId,
  };

  const newReview = new Review(newReviewObj);
  const saveReview = await newReview.save();

  return res.status(200).send({ msg: "Review Added successfully" })
})

router.get('/', async(req, res, next) => {
  const reviewId = req.params.id;

  if (reviewId) {
    const reviewById = await Review.findById(reviewId);
    return res.send(reviewById);
  }

  const allReview = await Review.find({});
  return res.send(allReview);
})

router.put('/',validateToken,(req, res, next) => {
  const reviewId = req.body.id;
  const newReviewObj = {
    review: req.body.review,
    score: req.body.score,
  }

  const reviewIdValidation = Review.findById(reviewId);
  if (!reviewIdValidation) return res.status(400).send({ msg: "Invalid id" });
  Review.updateOne({ _id: reviewId }, newReviewObj).then(
    () => {
      res.status(201).json({
        msg: "Updated successfully"
      })
    }
  ).catch((err) => res.status(400).json({
    error: err
  }))
})

router.delete('/:id',validateToken,(req, res, next) => {
  const reviewId = req.body.id;
  const reviewIdValidation = Review.findById(reviewId);
  if (!reviewIdValidation) return res.status(400).send({ msg: "Invalid id" });
  Review.deleteOne({ _id: req.params.id }).then(
    () => {
      res.status(201).json({
        msg: "Deleted successfully"
      })
    }
  ).catch((err) => res.status(400).json({
    error: err
  }))
})


module.exports = router;
