const jwt = require('jsonwebtoken')
const BadRequest = require('../exceptions/badRequest');
const Unauthorized = require('../exceptions/unauthorized');
const User = require('../models/User');
const bcrypt = require('bcryptjs');

const signToken = (data) => {
    const payload = { sub: data._id, name: data.name, email: data.email };
    const token = jwt.sign(payload, process.env.TOKEN_SECRET);
    return token;
}

const validateToken = async (req, res, next) => {
    const token = req.header('x-auth-token');
    if (!token) {
        throw new Unauthorized('Access denied no token provided.');
    }
    try {
        const decoded = jwt.verify(token, process.env.TOKEN_SECRET);
        const user = await User.findOne({ _id: decoded.sub });
        if (!user) throw new BadRequest('User associated with this token does not exist.');
        req.user = user;
        next();
    } catch (error) {
        next(new BadRequest('Invalid Token. ' + error.message));
    }
}


const login = async (username, password) => {
    const user = await User.findOne({ username: username });
    if (!user) throw new BadRequest('Invalid Username or password');
    const validPassword = await bcrypt.compare(password, user.password);
    if (!validPassword) throw new BadRequest('Invalid Username or password');
    return user;
}

module.exports.login = login;
module.exports.signToken = signToken;
module.exports.validateToken = validateToken;