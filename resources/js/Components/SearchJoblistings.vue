<template>
  <PrimaryButton class="mt-[56px] mb-10" @click.prevent="openModel">Search</PrimaryButton>

  <div v-if="isOpen" class="fixed z-50 top-0 left-0 w-full h-full bg-black bg-opacity-30">
    <div class="flex items-center justify-center mt-[61px]">
      <!-- 
        TIP: below element is the actual parent to content
        NOTE: The two above are for positioning and layout 
      -->
      <div
        ref="resultsContainer"
        class="bg-gray-200 w-full max-w-[800px] mx-auto shadow-xl overflow-auto h-[calc(100vh-200px)] rounded-lg p-4"
      >
        <div class="flex items-center relative my-3.5 mt-8 mx-1 mr-0">
          <div />
          <div
            @click="closeModel"
            class="absolute right-0 rounded-full p-1.5 bg-gray-500 hover:bg-gray-600 cursor-pointer"
          >
            <Close :size="24" fillColor="#FFFFFF" />
          </div>
        </div>

        <TextInput
          v-model="query"
          @keydown.up="focusPreviousHits"
          @keydown.down="focusNextHits"
          class="border border-gray-500 w-full py-2 pl-2 mt-3.5"
          placeholder="Search jobs..."
          autofocus
        />

        <template v-if="results">
          Found <span v-text="results.estimatedTotalHits"></span> result(s)

          <div v-for="(hit, index) in results.hits" :key="hit.id" class="ml-8">
            <JobItem
              :joblisting="hit"
              :style="{
                'background-color': index === selectedHitIndex ? '#30BCED' : '',
                color: index === selectedHitIndex ? '#FFFFFF' : '',
              }"
              :data-hit-index="index"
            />
          </div>
        </template>
      </div>
    </div>
    <!-- class="bg-gray-200 shadow-xl overflow-auto h-[calc(100vh-200px)] rounded-lg p-4 py-8 border border-gray-200" -->
  </div>
</template>

<script setup>
import TextInput from "@/Components/TextInput.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import { ref, onMounted, watchEffect, watch } from "vue";
import JobItem from "@/Components/JobItem.vue";
import MeiliSearch from "meilisearch";
import Close from "vue-material-design-icons/Close.vue";

let query = ref("");
let client = ref(null);
let results = ref(null);
let resultsContainer = ref(null);
let selectedHitIndex = ref(0);

const isOpen = ref(true);

const openModel = () => {
  isOpen.value = true;
};
const closeModel = () => {
  isOpen.value = false;
  query.value = "";
  results.value = null;
  selectedHitIndex.value = 0;
};

// TODO: toggle on clicking the search input

onMounted(() => {
  client.value = new MeiliSearch({ host: "http://localhost:7700" });
});

const search = async (query) => {
  if (query) {
    results.value = await client.value
      .index("joblistings_index")
      .search(query, { limit: 10 });
  }
};

watch(
  query,
  (currentQuery) => {
    if (!currentQuery) {
      // Reset everything.
      query.value = "";
      results.value = null;
      selectedHitIndex.value = 0;
    }

    // NOTE: if query changes, then search() runs
    search(currentQuery);
  },
  // Make watch() behave like watchEffect()
  { immediate: true }
);

const focusPreviousHits = () => {
  if (selectedHitIndex.value === 0) {
    // We move to the last hit
    selectedHitIndex.value = results.value.hits.length - 1;
  } else {
    // We navigate on
    selectedHitIndex.value--;
  }
  scrollContainer();
};

const scrollContainer = () => {
  const container = resultsContainer.value;
  const selectedHit = container.querySelector(
    `[data-hit-index="${selectedHitIndex.value}"]`
  );
  if (selectedHit) {
    const offset = -135; // Adjust the offset value as needed
    const scrollTo = selectedHit.offsetTop + offset;
    container.scrollTop = scrollTo;
  }
};

const focusNextHits = () => {
  if (selectedHitIndex.value < results.value.hits.length - 1) {
    // We increment to move down
    selectedHitIndex.value++;
  } else {
    // reset
    selectedHitIndex.value = 0;
  }
  scrollContainer();
};
</script>
