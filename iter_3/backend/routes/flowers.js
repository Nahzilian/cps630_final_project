const router = require('express').Router();
const Flower = require('../models/Flower');
const { pageDataFormatting } = require('../utils/formatting');

router.get('/', async (req, res, next) => {
    const pageLimit = parseInt(req.query.limit);
    const pageNum = parseInt(req.query.page);
    const countAllData = await Flower.count();

    if (!req.query.limit || !req.query.page) {
        const allFlower = await Flower.find({});
        return res.json(pageDataFormatting(allFlower, 0, 0, countAllData));
    }
    const allFlowerWithLimit = await Flower.find({}).limit(pageLimit).skip(pageLimit * pageNum);
    return res.json(pageDataFormatting(allFlowerWithLimit, pageLimit, pageNum, countAllData));
})


router.get('/reviews/:id', (req, res, next) => {

})

module.exports = router;