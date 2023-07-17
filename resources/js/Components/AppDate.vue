<template>
  <span class="text-[13px]">
    {{ isTimestampPassed ? sanitizeDate : "" }}
  </span>
  <span v-if="isDiffForHumansPassed">
    {{ isDiffForHumansPassed ? humanFriendlyDate : "" }}
  </span>
</template>

<script setup>
import dayjs from "dayjs";
import { computed } from "vue";
import relativeTime from "dayjs/plugin/relativeTime";
import localizedFormat from "dayjs/plugin/localizedFormat";

dayjs.extend(relativeTime);
dayjs.extend(localizedFormat);

const { timestamp, diffForHumans } = defineProps({
  timestamp: {
    type: String,
    default: null,
  },
  diffForHumans: {
    type: String,
    default: null,
  },
});

const sanitizeDate = computed(() => {
  return dayjs(timestamp).fromNow(true);
});

const humanFriendlyDate = computed(() => {
  return dayjs(diffForHumans).format("LL");
});

const isTimestampPassed = computed(() => timestamp !== null);
const isDiffForHumansPassed = computed(() => diffForHumans !== null);
</script>
