const mongoose = require('mongoose');

const schema = {
    _id: {
        type: mongoose.Types.ObjectId,
        alias: 'flowerid',
        required: true,
        auto: true,
    },
    price: {
        type: Number,
        required: true,
    },
    flowerName: {
        type: String,
        required: true,
    },
    storeCode: {
        type: String,
        required: true,
    },
    imageid: {
        type: Number,
    }
}

module.exports = mongoose.model('Flower', schema);