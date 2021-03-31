const router = require('express').Router();
const Flower = require('../models/Flower');


router.get('/init', async (req, res) => {
    const testCar = new Flower({
        price: 20,
        flowerName: "Rose",
        storeCode: "XYZ 123",
        imageid: 1
    })
    await testCar.save();
    res.send('OK')
})

router.get('/', async (req, res, next) => {
    const allFlower = await Flower.find({});
    return res.json({allFlower});
})


router.get('/reviews/:id', (req, res, next) => {

})

module.exports = router;