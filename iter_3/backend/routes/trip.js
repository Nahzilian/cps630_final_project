const router = require('express').Router();
const Trip = require('../models/Trip');
const Car = require('../models/Car');
const { validateAdmin, validateToken } = require('../utils/authentication');
const { tripValidation } = require('../utils/validation');

router.get('/:id', validateToken ,async (req, res, next) => {
    const tripId = req.params.id;
    
    if(tripId) {
        const tripById = await Trip.findById(tripId);
        return res.send(tripById);
    }

    const allTrip = await Trip.find({});
    return res.send(allTrip)

})

router.post('/', validateToken, async (req, res, next) => {
    const carById = await Car.findById(req.body.carId);
    if(!carById) return res.status(400).send({msg: "Invalid car ID"})
    
    const tripObj = {
        source: req.body.source,
        destination: req.body.destination,
        distance: req.body.distance,
        carId: req.body.carId,
        price: req.body.price
    }

    const { error } = tripValidation(tripObj);
    if(error) return res.status(400).send({msg: "Invalid data"})

    const newTrip = new Trip(tripObj);
    await newTrip.save();
    return res.status(200).send({ msg: "Stored in DB" })
})

// User are not allow to update this information, as well as admin
