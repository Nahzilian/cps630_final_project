const router = require('express').Router();
const { signToken, login } = require('../utils/authentication');
const { userInfoFormat } = require('../utils/formatting');

router.post('/login',async (req, res) =>{
    const user = await login(req.body.username, req.body.password);
    res.status(200).json({token: signToken(user), user: userInfoFormat(user)});
});

module.exports = router;