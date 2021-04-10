const router = require('express').Router();
const Car = require('../models/Car');
const Trip = require('../models/Trip');
const { validateAdmin } = require('../utils/authentication');
const { pageDataFormatting } = require('../utils/formatting');
const { carValidation } = require('../utils/validation');

// Get car by page
router.get('/', async (req, res) => {
    const pageLimit = parseInt(req.query.limit);
    const pageNum = parseInt(req.query.page);
    const countAllData = await Car.countDocuments();
    if (!req.query.limit || !req.query.page) {
        const allCar = await Car.find({});
        return res.json(pageDataFormatting(allCar, 0, 0, countAllData));
    }
    const allCarWithLimit = await Car.find({}).limit(pageLimit).skip(pageLimit * pageNum);
    return res.json(pageDataFormatting(allCarWithLimit, pageLimit, pageNum, countAllData));
})

router.get('/available', async (req, res) => {
    const availableCar = await Car.find({ available: true }).limit(1);
    if (!availableCar) return res.status(400).send({ msg: 'No data found' });
    return res.status(200).send(availableCar)
})

// Update car

router.put('/', validateAdmin, async (req, res) => {
    const carId = req.body.id;
    const { error } = carValidation(req, body);

    const car = {
        model: req.body.model,
        carCode: req.body.carCode,
        available: req.body.available,
        imageid: req.body.imageid
    }

    Car.updateOne({ _id: carId }, car).then(
        () => {
            res.status(201).json({
                msg: "Updated successfully"
            })
        }
    ).catch((err) => res.status(400).json({
        error: err
    }))
})


// Post new car
router.post('/', validateAdmin, async (req, res) => {
    const newCarObj = {
        model: req.body.model,
        carCode: req.body.carCode,
        available: req.body.available,
        imageid: req.body.imageid
    }

    const { error } = carValidation(newCarObj);
    if (error) return res.status(400).send({ msg: "Invalid data" });

    const newCar = new Car(newCarObj);
    await newCar.save();
    return res.status(200).send({ msg: "Stored in DB" })
})


router.delete('/:id', validateAdmin, async (req, res) => {
    Car.deleteOne({ _id: req.params.id }).then(
        () => {
            res.status(201).json({
                msg: "Deleted successfully"
            })
        }
    ).catch((err) => res.status(400).json({
        error: err
    }))
})

router.get('/reviews/:id', (req, res, next) => {

})

module.exports = router;