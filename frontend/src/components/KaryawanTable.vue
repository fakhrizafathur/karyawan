<template>
  <div>
    <h2>Karyawan Table</h2>
    <button @click="showAddModal" class="add">Tambah Karyawan</button>
    <table>
      <thead>
        <tr>
          <th>Nama</th>
          <th>Status</th>
          <th>Pekerjaan</th>
          <th>Divisi</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="karyawan in karyawans" :key="karyawan.id">
          <td>{{ karyawan.nama }}</td>
          <td>{{ karyawan.status }}</td>
          <td>{{ karyawan.pekerjaan.pekerjaan }}</td>
          <td>{{ karyawan.pekerjaan.divisi }}</td>
          <td>
            <button @click="showEditModal(karyawan)" class="edit">Edit</button>
            <button @click="deleteKaryawan(karyawan.id)" class="delete">Hapus</button>
          </td>
        </tr>
      </tbody>
    </table>

    <!-- Modal Form -->
    <div v-if="isModalVisible" class="modal">
      <div class="modal-content">
        <h3>{{ isEditing ? "Edit Karyawan" : "Tambah Karyawan" }}</h3>
        <form @submit.prevent="handleSubmit">
          <div>
            <label>Nama:</label>
            <input v-model="form.nama" type="text" required />
          </div>
          <div>
            <label>Status:</label>
            <select v-model="form.status" required>
              <option value="aktif">Aktif</option>
              <option value="nonaktif">Nonaktif</option>
            </select>
          </div>
          <div>
            <label>Pekerjaan:</label>
            <input v-model="form.pekerjaan" type="text" placeholder="Masukkan pekerjaan" required />
          </div>
          <div>
            <label>Divisi:</label>
            <input v-model="form.divisi" type="text" placeholder="Masukkan divisi" required />
          </div>
          <div style="display: flex; gap: 10px; margin-top: 15px">
            <button type="submit" class="submit">Simpan</button>
            <button type="button" class="cancel" @click="closeModal">Batal</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
import api from "../services/api";

export default {
  data() {
    return {
      karyawans: [],
      isModalVisible: false,
      isEditing: false,
      form: {
        id: null,
        nama: "",
        status: "",
        pekerjaan: "",
        divisi: "",
      },
    };
  },
  methods: {
    async fetchKaryawans() {
      const response = await api.getKaryawans();
      this.karyawans = response.data;
    },
    showAddModal() {
      this.isEditing = false;
      this.form = { id: null, nama: "", status: "", pekerjaan: "", divisi: "" };
      this.isModalVisible = true;
    },
    showEditModal(karyawan) {
      this.isEditing = true;
      this.form = {
        id: karyawan.id,
        nama: karyawan.nama,
        status: karyawan.status,
        pekerjaan: karyawan.pekerjaan.pekerjaan,
        divisi: karyawan.pekerjaan.divisi,
      };
      this.isModalVisible = true;
    },
    closeModal() {
      this.isModalVisible = false;
    },
    async handleSubmit() {
      try {
        if (this.isEditing) {
          await api.updateKaryawan(this.form.id, {
            nama: this.form.nama,
            status: this.form.status,
            pekerjaan: this.form.pekerjaan,
            divisi: this.form.divisi,
          });
        } else {
          await api.addKaryawan({
            nama: this.form.nama,
            status: this.form.status,
            pekerjaan: this.form.pekerjaan,
            divisi: this.form.divisi,
          });
        }
        this.closeModal();
        this.fetchKaryawans();
      } catch (error) {
        console.error("Error:", error.response);
        alert("Terjadi kesalahan, periksa data Anda.");
      }
    },
    async deleteKaryawan(id) {
      if (confirm("Apakah Anda yakin ingin menghapus karyawan ini?")) {
        await api.deleteKaryawan(id);
        this.fetchKaryawans();
      }
    },
  },
  mounted() {
    this.fetchKaryawans();
  },
};
</script>

<style>
/* Modal Styles */
.modal {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: rgba(0, 0, 0, 0.5);
  display: flex;
  justify-content: center;
  align-items: center;
}

.modal-content {
  background: white;
  padding: 20px;
  border-radius: 5px;
  width: 400px;
}
</style>
