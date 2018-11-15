import axios from 'axios'
import { Message, MessageBox } from 'element-ui'

// Creación de la intancia de Axios
const service = axios.create({
  baseURL: process.env.BASE_API, // api base_url
  timeout: 5000, // Tiempo máximo de espera para una solicitud ajax
  // headers: {
  //   'Authorization': 'Bearer ' + getToken(),
  //   'Content-Type': 'application/json',
  //   'X-Requested-With': 'XMLHttpRequest'
  // }
})

export default service
