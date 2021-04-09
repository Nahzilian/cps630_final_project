const mongoose = require('mongoose');

const schema = {
    _id: {
        type: mongoose.Types.ObjectId,
        alias: 'tripid',
        required: true,
        auto: true,
    },
    source: {
        type: String,
        required: true,
    },
    destination: {
        type: String,
        required: true,
    },
    distance: {
        type: Number,
        required: true,
    },
    carId: {
        type: String,
        required: true
    },
    price: {
        type: Number,
        required: true
    }
}

module.exports = mongoose.model('Trip', schema);