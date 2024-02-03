import axios from "axios"
import { useUserStore } from '@/stores/UserStore'
// const store = useUserStore()

let config = {
  // baseURL: process.env.baseURL || process.env.apiUrl || ""
  baseURL: import.meta.env.VITE_BASE_URL || import.meta.env.VITE_API_URL || ""
  // baseURL: 'http://portainer.belit.local:10106'
  // timeout: 60 * 1000, // Timeout
  // withCredentials: true, // Check cross-site Access-Control
};

const _axios = axios.create(config)
_axios.interceptors.response.use(
  (response) => {
    //Sve ok
    return response
  },
  (error) => {
    if (error.response.status === 419) {
      alert('CSRF error - refreshing')
      window.location.reload()
    }
    return Promise.reject(error)
  }
)
//Pozivar za API - sa JWT
const axiosApi = axios.create(config)
axiosApi.interceptors.response.use(
  (response) => {
    //Sve ok
    return response
  },
  (error) => {
    const originalRequest = error.config
    if (error.response.status === 403 && !originalRequest._retry) {
      //Ako je istekao token, i ovo radimo samo jednom
      originalRequest._retry = true;
      //Vraca promise(user) ili error axiosa
      storeUser.refreshJWT()
      .then((user) => {
        //Zapravo mi ne treba
        let _ = user
        //Rekurzivno? ponovimo zahtev
        return axiosApi(originalRequest)
      })
      .catch((error) => {
        if(error.response.status == 401){
          let _ = useUserStore.storeCsrfToken(error.response.data.token)
        }
        return Promise.reject(error)
      })
    } else if (error.response.status === 419) {
      alert('CSRF error - refreshing')
      window.location.reload()
    } else {
      //Све остале грешке
      return Promise.reject(error)
    }
  }
)

export { _axios, axiosApi };