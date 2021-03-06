<template>
  <div :is="tag" :class="wrapperClasses" :style="wrapperStyles" :data-multiple="this.multiple" v-on-clickaway="away">
    <span :class="caretClasses">▼</span>
    <mdb-select-input @click.native="toggle = !toggle" :text="inputText" :value="inputValue" :disabled="disabled" />
    <transition @enter="enter" @after-enter="afterEnter" @before-leave="beforeLeave">
      <mdb-select-options v-if="toggle" :search="search" class="collapse-item">
        <mdb-select-option v-for="(optionValue, index) in optionValues" :active="activeOptions[index]" :disabled="disabledOptions[index]" :value="optionValues[index]" :key="index" :icon="icons[index]" @click.native="optionSelect(optionValues[index], optionTexts[index], index)">{{optionTexts[index]}}</mdb-select-option>
        <mdb-button v-if="multiple" save color="primary" size="sm" @click.native="toggle = !toggle">Save</mdb-button>
      </mdb-select-options>
    </transition>
  </div>
</template>

<script>
import classNames from 'classnames';
import mdbSelectInput from './SelectInput';
import mdbSelectOptions from './SelectOptions';
import mdbSelectOption from './SelectOption';
import mdbButton from '../Button';
import { mixin as clickaway } from 'vue-clickaway';

const Select = {
  name: 'Select',
  components: {
    mdbSelectInput,
    mdbSelectOptions,
    mdbSelectOption,
    mdbButton
  },
  props: {
    tag: {
      type: String,
      default: "div"
    },
    color: {
      type: String
    },
    multiple: {
      type: Boolean,
      default: false
    },
    disabled: {
      type: Boolean,
      default: false
    },
    search: {
      type: Boolean
    },
    wrapperClass: {
      type: String
    },
    wrapperStyle: {
      type: String
    },
    caretClass: {
      type: String
    },
    caretStyle: {
      type: String
    },
    getValue: {
      type: Function
    }
  },
  data() {
    return {
      toggle: false,
      inputValue: '',
      inputText: 'Choose Your option',
      optionValues: [],
      optionTexts: [],
      disabledOptions: [],
      activeOptions: [],
      multiValues: [],
      icons: [],
    };
  },
  mixins: [clickaway],
  methods: {
    optionSelect(value, text, index) {
      if (this.multiple) {
        this.activeOptions[index] = !this.activeOptions[index];
        if (typeof this.inputValue == 'undefined') {
          this.multiValues = [];
          this.multiValues.push(value);
          this.inputValue = this.multiValues.join();
          this.inputText = [];
          this.inputText.push(text);
        } else if (this.multiValues.includes(value)) {
          let valueIndex = this.multiValues.indexOf(value);
          this.multiValues.splice(valueIndex, 1);
          if (this.multiValues.length == 0) {
            this.inputValue = this.defaultValue;
            this.inputText = this.defaultText;
          } else {
            this.inputValue = this.multiValues.join();
            this.inputText.splice(valueIndex, 1);
          }
        } else {
          this.multiValues.push(value);
          this.inputValue = this.multiValues.join();
          this.inputText.push(text);
        }
      } else {
        this.activeOptions = [];
        this.activeOptions[index] = true;
        this.inputValue = value;
        this.inputText = text;
        this.toggle = false;
      }
      this.emitValue(this.inputValue);
    },
    emitValue(value) {
      this.$emit('getValue', value);
    },
    away() {
      this.toggle = false;
    },
    enter(el) {
      el.style.opacity = 0;
    },
    afterEnter(el) {
      el.style.opacity = 1;
    },
    beforeLeave(el) {
      el.style.opacity = 0;
    }
  },
  created() {
    this.$slots.default.forEach((slot, index) => {
      if (typeof slot.tag !== 'undefined') {
        if ('selected' in slot.data.attrs) {
          this.inputValue = slot.data.attrs.value;
          this.activeOptions[index] = true;
          if (this.multiple) {
            this.multiValues = [];
            this.multiValues.push(this.inputValue);
            this.defaultValue = this.multiValues;
            this.inputText = [];
            this.inputText.push(slot.children[0].text);
            this.defaultText = this.inputText;
          } else {
            this.inputText = slot.children[0].text;
          }
        } else {
          this.activeOptions[index] = false;
        }
        if ('disabled' in slot.data.attrs) {
          this.disabledOptions[index] = true;
          this.activeOptions[index] = false;
        } else {
          this.disabledOptions[index] = false;
        }
        if ('icon' in slot.data.attrs) {
          this.icons.push(slot.data.attrs.icon);
        }
        this.optionValues.push(slot.data.attrs.value);
        this.optionTexts.push(slot.children[0].text);
      }
    });
  },
  computed: {
    wrapperClasses() {
      return classNames(
        'select-wrapper',
        this.color ? 'colorful-select dropdown-' + this.color : '',
        this.wrapperClass
      );
    },
    wrapperStyles() {
      return this.wrapperStyle;
    },
    caretClasses() {
      return classNames(
        'caret',
        this.disabled ? 'disabled' : '',
        this.caretClass
      );
    },
    caretStyles() {
      return this.caretStyle;
    },
  },
  watch: {
    activeOptions(index) {
      this.activeOptions[index] = this.activeOptions[index];
    }
  }
};

export default Select;
export { Select as mdbSelect };
</script>

<style scoped>
.collapse-item {
  position: absolute;
  top: 0;
  z-index: 9999;
  width: 100%;
  transition: opacity .2s;
}
</style>
