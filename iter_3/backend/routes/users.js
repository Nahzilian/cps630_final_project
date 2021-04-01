const router = require('express').Router();
const { userInfoValidation } = require('../utils/validation');
const { encryptPassword } = require('../utils/encrypt');
const { userInfoFormat } = require('../utils/formatting');
const { signToken, validateToken } = require('../utils/authentication');
const User = require('../models/User');

router.post('/register', async (req, res) => {
    // If info is invalid
    const { error } = userInfoValidation(req.body);
    if( error ) return res.status(400).send(error.details[0].message);
    
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
    const usernameExist = await User.findOne({username: req.body.username});
    if (usernameExist) return res.status(400).send({error: 'Email already exist'});
    // Try saving user info
    try {
        const savedUser = await user.save();
        
        return res.send({user: userInfoFormat(savedUser), token: signToken(savedUser)});
    } catch(err) {
        return res.status(400).send(err);
    }
})

router.get('/me', validateToken, (req, res, next) => {
    res.send('Hello world')
})

router.put('/me/update/:id', validateToken, async (req, res, next) => {
    const userId = req.params.id;
    const user = {
        address: req.body.address,
        cityCode: req.body.cityCode,
        email: req.body.email,
        name: req.body.name,
        phone: req.body.phone
    }

    console.log(userId)
    console.log(user)
    User.updateOne({_id: userId}, user).then(
        () => {
            res.status(201).json({
                msg: "Updated successfully"
            })
        }
    ).catch( (err) => res.status(400).json({
        error: err
    }))
})

module.exports = router;