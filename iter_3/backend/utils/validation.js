const Joi = require('joi');

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

module.exports.userInfoValidation = userInfoValidation;
module.exports.updateUserValidation = updateUserValidation;