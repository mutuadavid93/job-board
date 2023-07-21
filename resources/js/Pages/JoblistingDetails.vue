<template>
  <Head :title="joblisting?.title" />
  <DefaultLayout>
    <div class="w-full px-10">
      <div class="flex items-center justify-between mb-8 mt-4">
        <Link :href="route('home')" class="flex items-center tex-xs">
          <ChevronLeft :size="24" fillColor="#000" />
          Back
        </Link>
      </div>

      <div class="flex justify-between gap-5">
        <!-- start first column -->
        <div class="max-w-[calc(100%-316px)]">
          <div class="flex items-center justify-between">
            <div class="flex items-center gap-2">
              <div class="max-h-[89px]">
                <img
                  :src="joblisting?.company_logo"
                  class="rounded-full min-w-[89px] max-h-[89px]"
                />
              </div>
              <div class="">
                <h2 class="text-[24px] font-extrabold">{{ joblisting?.company_name }}</h2>
                <p class="text-[20px]">{{ joblisting?.title }}</p>
              </div>
            </div>

            <Link
              :href="route('joblistings.edit', { joblisting: joblisting })"
              class="rounded-full cursor-pointer p-2"
            >
              <PencilBoxOutline :size="38" fillColor="#000000" />
            </Link>
          </div>

          <div class="mt-4">
            <h2>COMPANY OVERVIEW</h2>
            <hr />
            <div
              class="mt-2 text-[18px] font-light"
              v-html="joblisting?.company_overview"
            />

            <br />
            <h2>JOB PURPOSE – SUMMARY</h2>
            <hr />
            <div class="mt-2 text-[18px] font-light">
              <div v-html="joblisting?.job_purpose" />
            </div>

            <br />
            <h2>KEY RESPONSIBILITIES & ACCOUNTABILITIES</h2>
            <hr />
            <div class="list-disc ml-4 mt-2 text-[18px] font-light">
              <ul id="responsibilities" v-html="joblisting?.responsibilities" />
            </div>

            <br />
            <h2>PROFESSIONAL, TECHNICAL SKILLS AND PREVIOUS EXPERIENCE REQUIRED</h2>
            <hr />

            <div class="text-[18px] mt-4 font-light">
              <div id="professional_skills" v-html="joblisting?.professional_skills" />
            </div>

            <br />
            <h2>HOW TO APPLY</h2>
            <hr />
            <div class="text-[18px] font-light">
              <p class="mt-4">
                {{ joblisting?.company_name }} Plc believes in diversity, equity and
                inclusivity as a competitive advantage. We are committed to a fair hiring
                process. To minimise unconscious biases from our hiring process, we’ve
                taken on an initiative to the #RightTheCV.
              </p>
              <p class="my-2">
                We encourage candidates to apply
                <span class="font-bold text-[#30BCED]">here</span>
              </p>
              <p class="my-2 font-semibold">
                Closing date: <AppDate :diffForHumans="joblisting?.created_at" />
              </p>
              <p class="my-2 italic">
                Employee referrals is encouraged, kindly forward CVs of any suitable
                candidates. Nonetheless please note that
                <a href="mailto:istreetec@gmail.com" class="text-[#30BCED] underline"
                  >internal applications</a
                >
                will take precedence.
              </p>
            </div>
          </div>
        </div>
        <!-- end first column -->

        <div class="w-[316px] -mt-12">
          <div
            class="text-white bg-[#30BCED] w-full text-[1rem] text-center py-2 border border-[#30BCED] rounded-md"
          >
            <Link :href="route('applications.apply', { joblisting: joblisting })">
              APPLY NOW
            </Link>
          </div>

          <div class="w-full mt-4 bg-white shadow-xl p-4 rounded-md text-[14px]">
            <div class="my-2">
              <div class="text-[#949494]">COMPANY</div>
              <div class="font-semibold text-[16px]">{{ joblisting?.company_name }}</div>
            </div>
            <div class="my-2">
              <div class="text-[#949494]">ROLE</div>
              <div class="font-semibold text-[16px]">{{ joblisting?.title }}</div>
            </div>
            <div class="my-2">
              <div class="text-[#949494]">CONTRACT TERMS</div>
              <div class="font-semibold text-[16px]">
                {{ joblisting?.employment_type }}
              </div>
            </div>
            <div class="my-2">
              <div class="text-[#949494]">LOCATION</div>
              <div class="font-semibold text-[16px]">{{ joblisting?.location }}</div>
            </div>
            <div class="my-2">
              <div class="text-[#949494]">CLOSING DATE</div>
              <div class="font-semibold text-[16px]">
                <AppDate :diffForHumans="joblisting?.created_at" />
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </DefaultLayout>
</template>

<script setup>
import { Head, Link } from "@inertiajs/vue3";
import DefaultLayout from "@/Layouts/DefaultLayout.vue";
import ChevronLeft from "vue-material-design-icons/ChevronLeft.vue";
import PencilBoxOutline from "vue-material-design-icons/PencilBoxOutline.vue";
import AppDate from "@/Components/AppDate.vue";

defineProps({
  joblisting: Object,
});
</script>

<style>
#responsibilities ul,
#professional_skills ul {
  list-style: disc;
  margin-left: 22px;
}
</style>
