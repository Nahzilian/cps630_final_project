import axios from 'axios';

export async function getAllCar (page, limit) {
  try {
    const result = await axios.get(`/services/car?page=${page}&limit=${limit}`);
    return result;
  } catch (err) {
    throw new Error(err);
  }
}

export async function getAllFlower (page, limit) {
  try {
    const result = await axios.get(`/services/flower?page=${page}&limit=${limit}`)
    console.log(result);
    return result;
  } catch (err) {
    throw new Error(err);
  }
}
