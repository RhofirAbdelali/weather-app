import axios from "axios";

const API_URL = "http://localhost:8000/api/weather";

export default {
  getAll: () => axios.get(API_URL),
  fetch: (lat, lon, city) =>
    axios.get(`${API_URL}/fetch?lat=${lat}&lon=${lon}&city=${city}`),
  update: (id, data) => axios.put(`${API_URL}/${id}`, data),
  delete: (id) => axios.delete(`${API_URL}/${id}`),
};
