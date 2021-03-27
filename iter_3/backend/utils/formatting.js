const userInfoFormat = (data) => {
    return {
        id: data._id,
        name: data.name,
        phone: data.phone,
        email: data.email,
        address: data.address,
        cityCode: data.cityCode,
        balance: data.balance
    }
}

module.exports.userInfoFormat = userInfoFormat;