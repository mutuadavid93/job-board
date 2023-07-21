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
import { isValidPhoneNumber } from "libphonenumber-js";

const input = ref(null);
const telInput = ref(null);
const countryCode = ref("");
const countryName = ref("");

const emit = defineEmits(["update:modelValue", "phone-data"]);

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

  inputElement.addEventListener("countrychange", () => {
    countryCode.value = telInput.value.getSelectedCountryData().iso2.toUpperCase();
    countryName.value = telInput.value.getSelectedCountryData().name;
  });

  // Manually trigger the countrychange event initially
  // TIP: makes sure validation is against correct countryCode
  inputElement.dispatchEvent(new Event("countrychange"));
});

function onInput() {
  const formattedNumber = telInput.value.getNumber();
  const valid = isValidPhoneNumber(formattedNumber, countryCode.value);

  // Emit the custom event with countryCode, countryName, and valid values
  emit("phone-data", {
    countryCode: countryCode.value,
    countryName: countryName.value,
    phone: formattedNumber,
    valid,
  });

  // Actual phone number
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
