const router = require('express').Router();
const Flower = require('../models/Flower');
const { validateAdmin } = require('../utils/authentication');
const { pageDataFormatting } = require('../utils/formatting');
const { flowerValidation } = require('../utils/validation');

router.get('/', async (req, res, next) => {
    const pageLimit = parseInt(req.query.limit);
    const pageNum = parseInt(req.query.page);
    const countAllData = await Flower.countDocuments();

    if (!req.query.limit || !req.query.page) {
        const allFlower = await Flower.find({});
        return res.json(pageDataFormatting(allFlower, 0, 0, countAllData));
    }
    const allFlowerWithLimit = await Flower.find({}).limit(pageLimit).skip(pageLimit * pageNum);
    return res.json(pageDataFormatting(allFlowerWithLimit, pageLimit, pageNum, countAllData));
})

router.post('/', validateAdmin, async (req, res, next) => {
    const newFlowerObj = {
        price: req.body.price,
        flowerName: req.body.flowerName,
        storeCode: req.body.storeCode,
        imageid: req.body.imageid
    }

    const { error } = flowerValidation(newFlowerObj);
    if(error) return res.status(400).send({msg: "Invalid data"});

    const newFlower = new Flower(newFlowerObj);
    await newFlower.save();
    return res.status(200).send({ msg: "Stored in DB" })

})

router.put('/', validateAdmin, async (req, res, next) => {
    const flowerId = req.body.id;
    const newFlowerObj = {
        price: req.body.price,
        flowerName: req.body.flowerName,
        storeCode: req.body.storeCode,
        imageid: req.body.imageid
    }

    const {error} = flowerValidation(newFlowerObj)
    if (error) return res.status(400).send({ msg: "Invalid data" });

    Flower.updateOne({ _id: flowerId }, newFlowerObj).then(
        () => {
            res.status(201).json({
                msg: "Updated successfully"
            })
        }
    ).catch((err) => res.status(400).json({
        error: err
    }))
})

router.delete('/:id', validateAdmin, async (req, res, next) => {
    /** 
     * If you are deleting car, all of the review, order, trip will be deleted accordingly
    */
    Flower.deleteOne({ _id: req.params.id }).then(
        () => {
            res.status(201).json({
                msg: "Deleted successfully"
            })
        }
    ).catch((err) => res.status(400).json({
        error: err
    }))
})

router.get('/reviews/:id', (req, res, next) => {

})

module.exports = router;