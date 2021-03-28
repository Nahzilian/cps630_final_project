const userInfoFormat = (data) => {
    return {
        id: data._id,
        name: data.name,
        phone: data.phone,
        email: data.email,
        address: data.address,
        cityCode: data.cityCode,
        balance: data.balance,
        isAdmin: data.isAdmin
    }
}

module.exports.userInfoFormat = userInfoFormat;