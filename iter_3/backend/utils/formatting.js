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

const pageDataFormatting = (data, pageSize, pageNum, dataCount) => {
    return {
        pageSize: pageSize,
        pageNum: pageNum,
        row: dataCount,
        data: data,
    }
}

module.exports.userInfoFormat = userInfoFormat;
module.exports.pageDataFormatting = pageDataFormatting;