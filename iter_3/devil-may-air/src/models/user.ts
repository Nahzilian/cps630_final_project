export default class User {
  name: string;
  phone: string;
  email: string;
  address: string;
  cityCode: string;
  username: string;
  balance: string;
  isAdmin: boolean;
  constructor(
    name: string,
    phone: string,
    email: string,
    address: string,
    cityCode: string,
    username: string,
    balance: string,
    isAdmin: boolean,
  ) {
    this.name = name;
    this.phone = phone;
    this.email = email;
    this.address = address;
    this.cityCode = cityCode;
    this.username = username;
    this.balance = balance;
    this.isAdmin = isAdmin;
  }
}
