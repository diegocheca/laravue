<template>
  <div class="app-container">
    <countTo :start-val="startVal" :end-val="endVal" :duration="3000" />
  </div>
</template>

<script>
import countTo from 'vue-count-to';
export default {
  components: { countTo },
  data() {
    return {
      startVal: 0,
      endVal: 2017,
    };
  },
};
</script>
