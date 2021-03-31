const mongoose = require('mongoose');

Date.prototype.addDays = function(days) {
    var date = new Date(this.valueOf());
    date.setDate(date.getDate() + days);
    return date;
}

const schema = {
    _id: {
        type: mongoose.Types.ObjectId,
        alias: 'userid',
        required: true,
        auto: true,
    },
    dateIssued: {
        type: Date,
        default: Date.now()
    },
    dateDone: {
        type: Date,
        default: Date.now().addDays(5)
    },
    totalPrice: {
        type: Number,
        required: true,
    },
    paymentStatus: {
        type: String,
        default: 'pending',
    },
    customerId: {
        type: String,
        required: true,
    },
    tripId: {
        type: String,
        required: true,
    },
    flowerId: {
        type: String,
        required: true,
    }
}

module.exports = mongoose.model('CustomerOrder', schema);