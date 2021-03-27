const mongoose = require('mongoose');

const schema = {
    _id: {
        type: mongoose.Types.ObjectId,
        alias: 'userid',
        required: true,
        auto: true,
    },
    name: {
        type: String,
        required: true,
        min: 1,
    },
    phone: {
        type: String,
        required: true,
        min: 9,
    },
    email: {
        type: String,
        required: true,
        min: 6,
    },
    address: {
        type: String,
        default: '',
        required: true,
    },
    cityCode: {
        type: String,
        default: '',
        required: true,
    },
    username: {
        type: String,
        default: '',
        required: true,
        unique: true,
        min: 6,
    },
    password: {
        type: String,
        default: '',
        required: true,
    },
    balance: {
        type: Number,
        required: true,
    },
    creditCard: {
        type: String,
        required: true,
    },
    isAdmin: {
        type: Boolean,
        default: false
    }
}

module.exports = mongoose.model('User', schema);