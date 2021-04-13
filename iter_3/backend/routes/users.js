const router = require('express').Router();
const { userInfoValidation, updateUserValidation, orderValidation } = require('../utils/validation');
const { encryptPassword } = require('../utils/encrypt');
const { userInfoFormat } = require('../utils/formatting');
const { signToken, validateToken, validateAdmin } = require('../utils/authentication');
const User = require('../models/User');
const Review = require('../models/Review');
const Trip = require('../models/Trip');
const CustomerOrder = require('../models/CustomerOrder');

router.post('/register', async (req, res) => {
    // If info is invalid
    const { error } = userInfoValidation(req.body);
    if (error) return res.status(400).send(error.details[0].message);

    // Encrypt password
    const hashPassword = await encryptPassword(req.body.password);

    // Create new user
    const user = new User({
        name: req.body.name,
        phone: req.body.phone,
        email: req.body.email,
        address: req.body.address,
        cityCode: req.body.cityCode,
        username: req.body.username,
        password: hashPassword,
        balance: req.body.balance,
        creditCard: req.body.creditCard
    });

    // Check if username alread
    const usernameExist = await User.findOne({ username: req.body.username });
    if (usernameExist) return res.status(400).send({ error: 'Email already exist' });
    // Try saving user info
    try {
        const savedUser = await user.save();
        return res.send({ user: userInfoFormat(savedUser), token: signToken(savedUser) });
    } catch (err) {
        return res.status(400).send(err);
    }
})

router.put('/register/admin', validateAdmin, async (req, res) => {
    const userId = req.body.id
    // Create new user
    const user = {
        name: req.body.name,
        phone: req.body.phone,
        email: req.body.email,
        address: req.body.address,
        cityCode: req.body.cityCode,
    };
    // Check if username alread
    const usernameExist = await User.findOne({ username: req.body.username });
    if (usernameExist) return res.status(400).send({ error: 'Email already exist' });
    // Try saving user info
    await User.updateOne({ _id: userId }, user).catch((err) => res.status(400).json({
        error: err
    }))
    const newUser = await User.findById(userId);
    res.status(201).json({
        user: userInfoFormat(newUser),
    })
})


router.get('/', validateAdmin, async (req, res, next) => {
    const users = await User.find({});
    return res.json(users);
})

router.get('/me/:id', validateToken, async (req, res, next) => {
    const user = await User.findOne({ _id: req.params.id });
    if (!user) return res.status(400).send({ error: 'No user found' });
    return res.status(200).json(user);
});

router.put('/me/update/:id', validateToken, async (req, res, next) => {
    const userId = req.params.id;

    const { error } = updateUserValidation(req.body);
    if (error) return res.status(400).send(error.details[0].message);

    const user = {
        address: req.body.address,
        cityCode: req.body.cityCode,
        email: req.body.email,
        name: req.body.name,
        phone: req.body.phone
    }

    User.updateOne({ _id: userId }, user).then(
        () => {
            res.status(201).json({
                msg: "Updated successfully"
            })
        }
    ).catch((err) => res.status(400).json({
        error: err
    }))
})


router.delete('/:id', validateAdmin, async (req, res, next) => {
    const userId = req.params.id;
    const userValidation = User.findById(userId);
    if (!userValidation) return res.status(400).send({ msg: "Invalid id" });
    // If you are deleting users, you have to delete Review, Order, Trip accordingly

    await Review.deleteMany({ userId: userId })
    const listOfOrder = await (await CustomerOrder.find({ customerId: userId }))
    for (let order of listOfOrder) {
        await Trip.deleteOne({ _id: order.tripId })
    }
    await CustomerOrder.deleteMany({ customerId: userId })

    User.deleteOne({ _id: userId }).then(
        () => {
            res.status(201).json({
                msg: "Updated successfully"
            })
        }
    ).catch((err) => res.status(400).json({
        error: err
    }))

})

module.exports = router;