import axios from "axios";

const api = axios.create({
  baseURL: "http://127.0.0.1:8000/api",
});

api.interceptors.request.use(
  (config) => {
    const token = localStorage.getItem("token");
    if (token) {
      config.headers.Authorization = `Bearer ${token}`;
    }
    return config;
  },
  (error) => {
    return Promise.reject(error);
  }
);

export default {
  getKaryawans() {
    return api.get("/karyawan");
  },
  addKaryawan(data) {
    return api.post("/karyawan", data);
  },
  updateKaryawan(id, data) {
    return api.put(`/karyawan/${id}`, data);
  },
  deleteKaryawan(id) {
    return api.delete(`/karyawan/${id}`);
  },
  getStatistics(params) {
    return api.get("/statistics", { params });
  },
};
