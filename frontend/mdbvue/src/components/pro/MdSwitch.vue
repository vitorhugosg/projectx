<template>
  <div :class="className">
    <label>
      {{offLabel}}
      <input :disabled="disabled" type="checkbox" />
      <span class="lever"></span>
      {{onLabel}}
    </label>
  </div>
</template>

<script>
import classNames from 'classnames';

const MdSwitch = {
  props: {
    offLabel: {
      type: String,
      default: "Off"
    },
    onLabel: {
      type: String,
      default: "On"
    },
    disabled: {
      type: Boolean
    },
    classes: {
      type: String
    }
  },
  computed: {
    className() {
      return classNames(
        'switch',
        this.classes
      );
    }
  }
};

export default MdSwitch;
export { MdSwitch as mdbSwitch };
</script>

<style scoped>

</style>
