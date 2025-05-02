<template>
  <div class="container mt-5">
    <h2 class="mb-3">Liste des données météo</h2>

    <div class="row mb-3">
      <div class="col-md-6">
        <select v-model="selectedCity" class="form-select">
          <option v-for="city in cities" :value="city" :key="city.name">
            {{ city.name }}
          </option>
        </select>
      </div>
      <div class="col-md-6">
        <button class="btn btn-success" @click="fetchWeather">
          Récupérer depuis API
        </button>
      </div>
    </div>

    <table class="table table-bordered">
      <thead>
        <tr>
          <th>Ville</th>
          <th>Température</th>
          <th>Vent</th>
          <th>Latitude</th>
          <th>Longitude</th>
          <th>Date</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="entry in weatherList" :key="entry.id">
          <td>{{ entry.city }}</td>
          <td>{{ entry.temperature }}°C</td>
          <td>{{ entry.windspeed }} km/h</td>
          <td>{{ entry.latitude }}</td>
          <td>{{ entry.longitude }}</td>
          <td>{{ new Date(entry.time).toLocaleString() }}</td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
import weatherService from "../services/weatherService";

export default {
  data() {
    return {
      weatherList: [],
      cities: [
        { name: "Dijon", lat: 47.32, lon: 5.04 },
        { name: "Paris", lat: 48.8566, lon: 2.3522 },
        { name: "Lyon", lat: 45.764, lon: 4.8357 },
        { name: "Marseille", lat: 43.2965, lon: 5.3698 },
        { name: "Toulouse", lat: 43.6047, lon: 1.4442 },
        { name: "Nice", lat: 43.7102, lon: 7.262 },
        { name: "Nantes", lat: 47.2184, lon: -1.5536 },
        { name: "Strasbourg", lat: 48.5734, lon: 7.7521 },
        { name: "Montpellier", lat: 43.6119, lon: 3.8777 },
        { name: "Bordeaux", lat: 44.8378, lon: -0.5792 },
      ],
      selectedCity: { name: "Dijon", lat: 47.32, lon: 5.04 },
    };
  },
  created() {
    this.load();
  },
  methods: {
    async load() {
      const res = await weatherService.getAll();
      this.weatherList = res.data;
    },
    async fetchWeather() {
      await weatherService.fetch(
        this.selectedCity.lat,
        this.selectedCity.lon,
        this.selectedCity.name
      );
      this.load();
    },
  },
};
</script>

<style>
body {
  background: #f8f9fa;
}
</style>
