const Joi = require('joi');

// Users

const userInfoValidation = (data) => {
    const schema = Joi.object({
        name: Joi.string().min(1).required(),
        phone: Joi.string().min(9).required(),
        email: Joi.string().min(6).required().email(),
        address: Joi.string().required(),
        cityCode: Joi.string().required(),
        username: Joi.string().min(6).required(),
        password: Joi.string().required(),
        balance: Joi.number().required(),
        creditCard: Joi.string().required(),
    });
    return schema.validate(data);
}

const updateUserValidation = (data) => {
    const schema = Joi.object({
        name: Joi.string().min(1).required(),
        phone: Joi.string().min(9).required(),
        email: Joi.string().min(6).required().email(),
        address: Joi.string().required(),
        cityCode: Joi.string().required(),
    });
    return schema.validate(data);
}

// Orders

const orderValidation = (data) => {
    const schema = Joi.object({
        customerId: Joi.string().required(),
        tripId: Joi.string().required(),
        flowers: Joi.array().required(),
        totalPrice: Joi.number().required()
    });
    return schema.validate(data);
}

// Products


// Trips
const tripValidation = (data) => {
    const schema = Joi.object({
        source: Joi.string().min(1).required(),
        destination: Joi.string().min(1).required(),
        distance: Joi.number().required(),
        carId: Joi.string().required(),
        price: Joi.number().required(),
    })
    return schema.validate(data);
}



module.exports.userInfoValidation = userInfoValidation;
module.exports.updateUserValidation = updateUserValidation;
module.exports.orderValidation = orderValidation;
module.exports.tripValidation = tripValidation;
