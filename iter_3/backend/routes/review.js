const router = require('express').Router();
const Review = require('../models/Review');

const { validateToken } = require('../utils/authentication');

router.post('/', validateToken, async (req, res, next) => {
  const newReviewObj = {
    review: req.body.review,
    score: req.body.score,
    type: req.body.type,
    itemId: req.body.itemId
  };

  const newReview = new Review(newReviewObj);
  const saveReview = await newReview.save();

  return res.status(200).send({msg: "Review Added successfully"})
})

router.get('/', (req, res, next)=>{

})


module.exports = router;
