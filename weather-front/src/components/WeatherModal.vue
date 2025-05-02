<template>
  <div
    class="modal fade show d-block"
    tabindex="-1"
    style="background-color: rgba(0, 0, 0, 0.5)"
  >
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Modifier la météo</h5>
          <button
            type="button"
            class="btn-close"
            @click="$emit('close')"
          ></button>
        </div>
        <div class="modal-body">
          <form @submit.prevent="submit">
            <div class="mb-3">
              <label class="form-label">Température</label>
              <input
                v-model.number="localData.temperature"
                type="number"
                step="0.1"
                class="form-control"
                required
              />
            </div>
            <div class="mb-3">
              <label class="form-label">Vitesse du vent</label>
              <input
                v-model.number="localData.windspeed"
                type="number"
                step="0.1"
                class="form-control"
                required
              />
            </div>
            <button type="submit" class="btn btn-primary">Enregistrer</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: ["data"],
  emits: ["close", "save"],
  data() {
    return {
      localData: { ...this.data },
    };
  },
  methods: {
    submit() {
      this.$emit("save", this.localData);
    },
  },
};
</script>
