<template>
  <div class="custom-input">
    <label class="custom-input__label" :for="`custom-input-${id}`">
      <slot>Input</slot>
      <span v-if="required" class="text-red-500">*</span>
    </label>
    <div class="mt-1">
      <input
        :id="`custom-input-${id}`"
        :type="type"
        :required="required"
        @input="onInput($event.target.value)"
        class="custom-input__input w-full rounded-md"
        :value="modelValue"
        :placeholder="$attrs.placeholder"
        ref="inputElement"
      />
    </div>
  </div>
</template>

<script setup>
import { ref } from "vue";

const inputElement = ref(null);
const emit = defineEmits(["update:modelValue"]);

defineProps({
  id: {
    required: true,
    type: String,
  },
  type: {
    default: "text",
    type: String,
  },
  required: {
    default: false,
    type: Boolean,
  },
  modelValue: {
    type: [String, Number],
  },
});

const onInput = (value) => {
  emit("update:modelValue", value);
};
</script>

<style lang="scss" scoped></style>
