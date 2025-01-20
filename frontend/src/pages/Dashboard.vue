<template>
  <div class="dashboard">
    <!-- Sidebar -->
    <div class="sidebar">
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
    </div>

    <!-- Main Content -->
    <div class="content">
      <h1>Dashboard</h1>
      <button @click="logout">Logout</button>
      <KaryawanTable />
    </div>
  </div>
</template>

<script>
import KaryawanTable from "../components/KaryawanTable.vue";
import api from "../services/api";

export default {
  components: { KaryawanTable },
  data() {
    return {
      totalKaryawan: 0,
      aktif: 0,
      nonaktif: 0,
      divisis: [],
      filterDivisi: "",
    };
  },
  methods: {
    async fetchStatistics() {
      const response = await api.get("/statistics", {
        params: { divisi: this.filterDivisi },
      });
      this.totalKaryawan = response.data.total;
      this.aktif = response.data.aktif;
      this.nonaktif = response.data.nonaktif;
      this.divisis = response.data.divisis;
    },
    logout() {
      localStorage.removeItem("token");
      this.$router.push("/");
    },
  },
  mounted() {
    this.fetchStatistics();
  },
};
</script>
