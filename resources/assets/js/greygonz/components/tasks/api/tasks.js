import axios from 'axios'

class Crud {
  constructor(endPoint) {
    this.endPoint = endPoint
  }
  getAll() {
    return axios.get(this.endPoint)
  }
  update(task) {
    return axios.put(this.endPoint + '/' + task.id, task)
  }
}

export default function createApi(endPoint) {
  return new Crud(endPoint);
}