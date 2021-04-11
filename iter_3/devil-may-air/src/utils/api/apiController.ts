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

}

export async function deleteUser(id) {

}

export async function deleteReview(id) {

}

export async function deleteCar(id) {

}

export async function deleteFlower(id) {

}

export async function deleteOrder(id) {

}
