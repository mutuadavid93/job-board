<template>
  <span class="text-[13px]"> {{ sanitizeDate }}</span>
</template>

<script setup>
import dayjs from "dayjs";
import { computed } from "vue";
import relativeTime from "dayjs/plugin/relativeTime";

dayjs.extend(relativeTime);

const { timestamp } = defineProps({
  timestamp: {
    type: String,
    required: true,
  },
});

const sanitizeDate = computed(() => {
  return dayjs(timestamp).fromNow(true);
});
</script>
