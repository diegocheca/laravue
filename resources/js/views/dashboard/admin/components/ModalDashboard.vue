<template>
  <div>
    <demo-adaptive-modal />

    <button class="btn" @click="$modal.show('example-adaptive')">Adaptive</button>

  </div>
</template>

<script>
import DemoAdaptiveModal from './components/Modal_Adaptive.vue';

export default {
  components: {
    DemoAdaptiveModal,
  },
  props: {
    className: {
      type: String,
      default: 'chart',
    },
  },
  data() {
    return {
      canBeShown: false,
    };
  },
  created() {
    setInterval(() => {
      this.canBeShown = !this.canBeShown;
    }, 5000);
  },
  methods: {
    conditionalShow() {
      this.$modal.show('conditional-modal', {
        show: this.canBeShown,
      });
    },
    showBasicDialog() {
      this.$modal.show('dialog', {
        text: 'I am a tiny dialog box.<br/>And I render <b>HTML!</b>',
      });
    },
    showTitleDialog() {
      this.$modal.show('dialog', {
        title: 'Information',
        text: 'Check out, I have a title 😎',
      });
    },
    showButtonsDialog() {
      this.$modal.show('dialog', {
        title: 'The standard Lorem Ipsum passage',
        text:
          'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
        buttons: [
          {
            title: 'Cancel',
            handler: () => {
              this.$modal.hide('dialog');
            },
          },
          {
            title: 'Like',
            default: true,
            handler: () => {
              alert('Like action');
            },
          },
          {
            title: 'Repost',
            handler: () => {
              alert('Repost action');
            },
          },
        ],
      });
    },
    showDynamicRuntimeModal() {
      this.$modal.show(
        {
          template: `
              <div class="example-modal-content">
                <p>Component has been created inline.</p>
                <p>{{ text }}</p>
                <p>This component is draggable because of the "dynamicDefault" property.</p>
              </div>
            `,
          props: ['text'],
        },
        {
          text: 'Text has been passed as a property.',
        },
        {
          height: 'auto',
        }
      );
    },
    // showDynamicComponentModal() {
    //   this.$modal.show(DemoCustomComponent, {
    //     text: 'This text is passed as a property',
    //   });
    // },
    showDynamicComponentModalWithModalParams() {
      let counter = 0;
      const interval = setInterval(() => {
        if (counter === 5) {
          clearInterval(interval);
        } else {
          counter++;
        }
        const name = `dynamic-modal-${Math.random()}`;
        this.$modal.show(
          {
            template: `
              <div class="example-modal-content">
                <h2>{{ name }}</h2>
                <button class="btn" @click="closeByName">Close using name</button>
                <button class="btn" @click="closeByEvent">Close using events</button>
                <button class="btn" @click="this.$modal.hideAll">Close all dynamic modals</button>
              </div>
            `,
            props: ['name'],
            methods: {
              closeByName() {
                this.$modal.hide(name);
              },
              closeByEvent() {
                this.$emit('close');
              },
            },
          },
          { name },
          { name, height: 'auto' }
        );
      }, 300);
    },
    dialogEvent(eventName) {
      console.log('Dialog event: ' + eventName);
    },
  },

};
</script>
