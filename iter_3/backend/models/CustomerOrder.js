const mongoose = require('mongoose');

Date.prototype.addDays = function(days) {
    var date = new Date(this.valueOf());
    date.setDate(date.getDate() + days);
    return date;
}

let date = new Date();
let dateDone = date.addDays(5);

const schema = {
    _id: {
        type: mongoose.Types.ObjectId,
        alias: 'userid',
        required: true,
        auto: true,
    },
    dateIssued: {
        type: Date,
        default: date
    },
    dateDone: {
        type: Date,
        default: dateDone
    },
    totalPrice: {
        type: Number,
        required: true,
    },
    customerId: {
        type: String,
        required: true,
    },
    tripId: {
        type: String,
        required: true,
    },
    flowers: {
        type: Array,
        required: true,
    }
}

module.exports = mongoose.model('CustomerOrder', schema);