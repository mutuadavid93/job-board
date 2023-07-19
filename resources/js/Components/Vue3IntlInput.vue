<template>
  <div class="custom-tel-input">
    <CustomInput
      ref="input"
      type="tel"
      :id="id"
      :modelValue="modelValue"
      @update:modelValue="onInput"
      :required="$attrs.required"
    >
      <slot>Contact Number</slot>
    </CustomInput>
  </div>
</template>

<script setup>
import { onMounted, ref } from "vue";
import "intl-tel-input/build/css/intlTelInput.css";
import CustomInput from "@/Components/CustomInput.vue";
import intlTelInput from "intl-tel-input";

const input = ref(null);
const telInput = ref(null);

const emit = defineEmits(["update:modelValue"]);

const props = defineProps({
  id: String,
  modelValue: [String, Number],
});

onMounted(() => {
  // To reach underlying DOM element e.g. `input field` using it's ref i.e. `ref="inputElement"`
  // via a Component's ref i.e. `ref="input"`, use $refs.
  const inputElement = input.value.$refs.inputElement;
  telInput.value = intlTelInput(inputElement, {
    utilsScript:
      "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/18.1.8/js/utils.min.js",
    preferredCountries: ["gb", "us"],
    // your options here
  });
});

function onInput() {
  const formattedNumber = telInput.value.getNumber();
  emit("update:modelValue", formattedNumber);
}
</script>

<style>
.iti__flag {
  background-image: url("https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/18.1.8/img/flags.png");
}

@media (-webkit-min-device-pixel-ratio: 2), (min-resolution: 192dpi) {
  .iti__flag {
    background-image: url("https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/18.1.8/img/flags@2x.png");
  }
}

.iti.iti--allow-dropdown.iti--show-flags {
  width: 100%;
}
</style>
