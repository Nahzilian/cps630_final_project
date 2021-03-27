import axios from 'axios';

export function login(username, password){
  axios.post('/auth/login', {username, password})
  .then(res => {
    const userData = res.data;
    localStorage.setItem('user', JSON.stringify(userData.user));
    localStorage.setItem('token', JSON.stringify(userData.token));
  }).catch(err => {throw new Error(err)})
}
