<template>
  <div>
    <h2>Statistics</h2>
    <p>Total Karyawan: {{ totalKaryawan }}</p>
    <p>Aktif: {{ aktif }}</p>
    <p>Nonaktif: {{ nonaktif }}</p>
    <div>
      <label>Filter Divisi:</label>
      <select v-model="filterDivisi" @change="fetchStatistics">
        <option value="">All</option>
        <option v-for="divisi in divisis" :key="divisi" :value="divisi">{{ divisi }}</option>
      </select>
    </div>
    <div>
      <label>Filter Status:</label>
      <select v-model="filterStatus" @change="fetchStatistics">
        <option value="">All</option>
        <option value="aktif">Aktif</option>
        <option value="nonaktif">Nonaktif</option>
      </select>
    </div>
  </div>
</template>

<script>
import api from "../services/api";

export default {
  data() {
    return {
      totalKaryawan: 0,
      aktif: 0,
      nonaktif: 0,
      divisis: [],
      filterDivisi: "",
      filterStatus: "",
    };
  },
  methods: {
    async fetchStatistics() {
      try {
        const response = await api.get("/statistics", {
          params: {
            divisi: this.filterDivisi,
            status: this.filterStatus,
          },
        });
        this.totalKaryawan = response.data.total;
        this.aktif = response.data.aktif;
        this.nonaktif = response.data.nonaktif;
        this.divisis = response.data.divisis;
      } catch (error) {
        console.error("Error fetching statistics:", error);
      }
    },
  },
  mounted() {
    this.fetchStatistics();
  },
};
</script>
