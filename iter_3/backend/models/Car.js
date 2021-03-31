const mongoose = require('mongoose');

const schema = {
    _id: {
        type: mongoose.Types.ObjectId,
        alias: 'carid',
        required: true,
        auto: true,
    },
    model: {
        type: String,
        required: true,
    },
    carCode: {
        type: String,
        required: true,
    },
    available: {
        type: Boolean,
        default: true
    },
    imageid: {
        type: Number,
    }
}

module.exports = mongoose.model('Car', schema);