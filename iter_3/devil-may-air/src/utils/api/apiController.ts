import axios from 'axios';

const clientInfoCaching = (data) => {
  localStorage.setItem('user', JSON.stringify(data.user));
  localStorage.setItem('token', JSON.stringify(data.token));
}

const randomBalance = () => {
  // User will have at least 100 dollars in their pocket
  return Math.floor(Math.random() * 5000) + 100;
}

export function login(username, password) {
  axios.post('/auth/login', { username, password })
    .then(res => {
      const userData = res.data;
      clientInfoCaching(userData);
    }).catch(err => { throw new Error(err) })
}

export function logout() {
  localStorage.removeItem('user');
  localStorage.removeItem('token');
}


export function register(form) {
  if (!form) throw new Error("No info found")
  const newUser = {
    name: form['name'].value,
    phone: form['phone'].value,
    email: form['email'].value,
    address: form['address'].value,
    cityCode: form['cityCode'].value,
    username: form['username'].value,
    password: form['password'].value,
    balance: randomBalance(),
    creditCard: form['creditCard'].value
  }
  axios.post('/user/register', newUser)
  .then(res => {
      const userData = res.data;
      clientInfoCaching(userData);
    }
  ).catch(err => { throw new Error(err) });

}

export async function checkout(info) {
  const token = JSON.parse(localStorage.getItem('token'));
  try {
    const { data } = await axios.post('/services/order', info, {headers: {'x-auth-token': token}});
    localStorage.setItem('user', JSON.stringify(data.user));
  } catch (err) {
    throw new Error(err);
  }
}

export async function sendReview(data){
  const token = JSON.parse(localStorage.getItem('token'));
  try {
    const d  = await axios.post('/review', data, {headers: {'x-auth-token': token}});

  } catch (err) {
    throw new Error(err);
  }
}

export async function getAllUserForDBMaintain() {
  const token = JSON.parse(localStorage.getItem('token'));
  try {
    const data = await axios.get('/user', {headers: {'x-auth-token': token}})
    return data;
  } catch(err) {
    throw new Error(err);
  }
}

export async function getTrips() {
  const token = JSON.parse(localStorage.getItem('token'));
  try {
    const data = await axios.get('/services/trip?id=', {headers: {'x-auth-token': token}})
    return data;
  } catch(err) {
    throw new Error(err);
  }
}

export async function getReviews() {
  const token = JSON.parse(localStorage.getItem('token'));
  try {
    const data = await axios.get('/review', {headers: {'x-auth-token': token}})
    return data;
  } catch(err) {
    throw new Error(err);
  }
}

export async function getOrders() {
  const token = JSON.parse(localStorage.getItem('token'));
  try {
    const data = await axios.get('/services/order', {headers: {'x-auth-token': token}});
    return data;
  } catch (err) {
    throw new Error(err);
  }
}

// Delete

export async function deleteTrip(id) {
  const token = JSON.parse(localStorage.getItem('token'));
  try {
    await axios.delete(`/services/trip/${id}`, {headers: {'x-auth-token': token}})
  } catch (err) {
    throw new Error(err);
  }
}

export async function deleteUser(id) {
  console.log(id)
  const token = JSON.parse(localStorage.getItem('token'));
  try {
    await axios.delete(`/user/${id}`, {headers: {'x-auth-token': token}})
  } catch (err) {
    throw new Error(err);
  }
}

export async function deleteReview(id) {
  const token = JSON.parse(localStorage.getItem('token'));
  try {
    await axios.delete(`/review/${id}`, {headers: {'x-auth-token': token}})
  } catch (err) {
    throw new Error(err);
  }
}

export async function deleteCar(id) {
  const token = JSON.parse(localStorage.getItem('token'));
  try {
    await axios.delete(`/services/car/${id}`, {headers: {'x-auth-token': token}})
  } catch (err) {
    throw new Error(err);
  }
}

export async function deleteFlower(id) {
  const token = JSON.parse(localStorage.getItem('token'));
  try {
    await axios.delete(`/services/flower/${id}`, {headers: {'x-auth-token': token}})
  } catch (err) {
    throw new Error(err);
  }
}

export async function deleteOrder(id) {
  const token = JSON.parse(localStorage.getItem('token'));
  try {
    await axios.delete(`/services/order/${id}`, {headers: {'x-auth-token': token}})
  } catch (err) {
    throw new Error(err);
  }
}


// Add

export async function addCar(form) {
  if (!form) throw new Error("No info found");
  const token = JSON.parse(localStorage.getItem('token'));
  const newCar = {
    model: form['model'].value,
    carCode: form['carCode'].value,
    imageid: form['imageid'].value,
    available: form['available'].value,
  }
  axios.post('/services/car', newCar, {headers: {'x-auth-token': token}})
  .catch(err => { throw new Error(err) });

}

export async function addFlower(form) {
  if (!form) throw new Error("No info found");
  const token = JSON.parse(localStorage.getItem('token'));
  const newCar = {
    price: form['price'].value,
    flowerName: form['flowerName'].value,
    storeCode: form['storeCode'].value,
    imageid: form['imageid'].value,
    quantity: form['quantity'].value,
  }
  axios.post('/services/flower', newCar, {headers: {'x-auth-token': token}})
  .catch(err => { throw new Error(err) });

}
