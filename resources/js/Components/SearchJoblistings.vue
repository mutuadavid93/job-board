<template>
  <!-- <PrimaryButton class="mt-[56px] mb-10" @click.prevent="openModel">Search</PrimaryButton> -->

  <div class="fixed z-50 top-0 left-0 w-full h-full bg-black bg-opacity-30">
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
          class="border-0 w-full py-2 pl-2 mt-3.5 focus:ring-0 outline-none placeholder-[#838383] text-[#838383]"
          placeholder="Search jobs..."
          :autofocus="true"
        />

        <template v-if="results">
          <span class="text-[#838383]">Found </span>
          <span class="text-[#838383]" v-text="results.estimatedTotalHits"></span>
          <span class="text-[#838383]"> result(s)</span>

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
        <template v-else>
          <div class="text-center text-[#838383] mt-[56px]">Nothing to show here</div>
        </template>
      </div>
    </div>
    <!-- class="bg-gray-200 shadow-xl overflow-auto h-[calc(100vh-200px)] rounded-lg p-4 py-8 border border-gray-200" -->
  </div>
</template>

<script setup>
import TextInput from "@/Components/TextInput.vue";
import { ref, onMounted, watchEffect, watch } from "vue";
import JobItem from "@/Components/JobItem.vue";
import { store } from "@/store";
import MeiliSearch from "meilisearch";
import Close from "vue-material-design-icons/Close.vue";

let query = ref("");
let client = ref(null);
let results = ref(null);
let resultsContainer = ref(null);
let selectedHitIndex = ref(0);

const closeModel = () => {
  store.toggleModel();
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
