<template>
  <div>
    <button
      type="button"
      class="btn"
      @click="showModal"
    >
      Open Modal!
    </button>

    <modal
      v-show="isModalVisible"
      @close="closeModal"
    />
  </div>
</template>
<script>
import Modal from './compontents/modal.vue';
export default {
  components: {
    Modal,
  },
  data() {
    return {
      isModalVisible: false,
    };
  },
  methods: {
    showModal() {
      this.isModalVisible = true;
    },
    closeModal() {
      this.isModalVisible = false;
    },
  },
};
</script>
