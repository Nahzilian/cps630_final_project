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
    return result;
  } catch (err) {
    throw new Error(err);
  }
}

export async function getAvailableCar() {
  try {
    const { data } = await axios.get('/services/car/available');
    // clientInfoCaching(data.user);
    return data;
  } catch (err) {
    throw new Error(err);
  }
}

export async function findReview(id){
  try {
    const result = await axios.get(`/review?id=${id}`);
    return result;
  } catch (err) {

  }
}
