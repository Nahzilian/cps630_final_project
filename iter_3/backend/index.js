const express = require('express');
const app = express();
const mongoose = require('mongoose');
const dotenv = require('dotenv');
const userRoute = require('./routes/users');
const authRoute = require('./routes/auth');
const carRoute = require('./routes/cars');
const flowerRoute = require('./routes/flowers');
const orderRoute = require('./routes/orders');

// Allow cors for local development
const cors = require('cors');

// Use dotenv for environment config
// Make sure to include DB_ADDRESS in .env file
dotenv.config();

const PORT = process.env.PORT || 5500;
// Mongoose set up connection with MongoDB
mongoose.connect(process.env.DB_ADDRESS, {useNewUrlParser: true}, (console.log('Connected to db')));

// Allow certain headers for request
const corsOptions = {
    exposedHeaders: ['x-auth-token']
};

// Middleware options
app.use(cors(corsOptions));
app.use(express.json());

// Routes
app.get('/api/', (req, res) => {
    res.json({msg: "Data 1"})
});
app.use('/api/auth', authRoute);
app.use('/api/user', userRoute);
app.use('/api/services/car', carRoute);
app.use('/api/services/flower', flowerRoute);
app.use('/api/services/order', orderRoute);

app.listen(PORT,() => console.log(`Listening on port ${PORT}`));