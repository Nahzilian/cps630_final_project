const router = require('express').Router();
const Car = require('../models/Car');
const Trip = require('../models/Trip');
const User = require('../models/User');
const CustomerOrder = require('../models/CustomerOrder');
const { tripValidation, orderValidation } = require('../utils/validation');
const { userInfoFormat } = require('../utils/formatting');

const { validateToken } = require('../utils/authentication');

router.post('/', validateToken, async (req, res, next) => {
    const newTripObj = {
        source: req.body.source,
        destination: req.body.destination,
        distance: req.body.distance,
        carId: req.body.carId,
        price: req.body.price
    }
    const serviceCar = await Car.findById(req.body.carId);
    if (!serviceCar) return res.status(400).send({ msg: "Driver is not available" });

    const newTripValidation = tripValidation(newTripObj);
    if (newTripValidation.error) return res.status(400).send(newTripValidation.error.details[0].message);

    const newTrip = new Trip(newTripObj);
    const savedTrip = await newTrip.save();

    const newOrderObj = {
        totalPrice: req.body.totalPrice,
        customerId: req.body.customerId,
        flowers: req.body.flowers,
        tripId: savedTrip._id.toString()
    }
    const buyer = await User.findById(req.body.customerId);

    if (!buyer) return res.status(400).send({ msg: "User account is not available" });
    const remainBalance = parseFloat((buyer.balance - req.body.totalPrice).toFixed(2));

    if (remainBalance < 0) return res.status(400).send({ msg: "Insufficient balance" });
    const updateUser = await User.updateOne({ _id: buyer._id }, { balance: remainBalance });

    const newOrderValidation = orderValidation(newOrderObj);
    if (newOrderValidation.error) return res.status(400).send(newOrderValidation.error.details[0].message);

    const updatedUser = await User.findById(req.body.customerId);
    const newOrder = new CustomerOrder(newOrderObj);
    const savedOrder = await newOrder.save();
    console.log(userInfoFormat(updatedUser))
    return res.status(200).send({ msg: "Added successfully", user: userInfoFormat(updatedUser) });
})

router.get('/:id', validateToken, async (req, res, next) => {
    const orderId = req.params.id;
    const customerId = req.body.customerId;
    const isAdmin = req.body.isAdmin;

    if (orderId) {
        const customerOrdById = await CustomerOrder.findById(orderId);
        return res.json(customerOrdById);
    }
    if (isAdmin) {
        const allOrderAdmin = await CustomerOrder.find({});
        return res.json(allOrderAdmin);
    }

    const allOrder = await CustomerOrder.find({ customerId: customerId });
    return res.json(allOrder);

})

// Order should not be updated or delete


module.exports = router;