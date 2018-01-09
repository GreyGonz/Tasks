import axios from 'axios'

class Crud {
  constructor(endPoint) {
    this.endPoint = endPoint
  }
  getAll() {
    return axios.get(this.endPoint)
  }
}

export default function createApi(endPoint) {
  return new Crud(endPoint);
}