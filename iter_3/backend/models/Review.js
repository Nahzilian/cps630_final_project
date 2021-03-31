const mongoose = require('mongoose');

const schema = {
    _id: {
        type: mongoose.Types.ObjectId,
        alias: 'reviewid',
        required: true,
        auto: true,
    },
    review: {
        type: String,
        required: true,
    },
    score: {
        type: Number,
    },
    type: {
        type: String,
        required: true,
    },
    itemId: {
        type: String,
        required: true,
    }
}

module.exports = mongoose.model('Review', schema);