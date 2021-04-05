const router = require('express').Router();
const Car = require('../models/Car');
const Trip = require('../models/Trip');
const { pageDataFormatting } = require('../utils/formatting');

router.get('/', async (req, res) => {
    const pageLimit = parseInt(req.query.limit);
    const pageNum = parseInt(req.query.page);
    const countAllData = await Car.count();
    if (!req.query.limit || !req.query.page) {
        const allCar = await Car.find({});
        return res.json(pageDataFormatting(allCar, 0, 0, countAllData));
    }
    const allCarWithLimit = await Car.find({}).limit(pageLimit).skip(pageLimit * pageNum);
    return res.json(pageDataFormatting(allCarWithLimit, pageLimit, pageNum, countAllData));
})


router.get('/reviews/:id', (req, res, next) => {

})

module.exports = router;