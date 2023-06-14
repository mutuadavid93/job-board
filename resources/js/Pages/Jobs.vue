<template>
  <Head title="Jobs" />
  <DefaultLayout>
    <div class="min-w-[1100px] pb-10">
      <div class="flex gap-8 mx-[15%] mt-14">
        <div class="w-8/12">
          <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
            {{ status }}
          </div>

          <form
            @submit.prevent="submit"
            class="flex items-center justify-between p-4 bg-[#F3F4F6] rounded-lg mb-2"
          >
            <div>
              <TextInput
                id="login-email"
                type="email"
                class="mt-1 w-full rounded-none"
                v-model="loginForm.email"
                required
                placeholder="Email"
                autocomplete="off"
              />

              <InputError class="mt-2" :message="loginForm.errors.email" />
            </div>

            <div>
              <TextInput
                id="login-password"
                type="password"
                class="mt-1 w-full rounded-none"
                v-model="loginForm.password"
                required
                placeholder="Password"
                autocomplete="off"
              />

              <InputError class="mt-2" :message="loginForm.errors.password" />
            </div>

            <div>
              <PrimaryButton
                class="ml-4 py-3 bg-red-600 text-white rounded-none hover:bg-white hover:text-blue-500"
                :class="{ 'opacity-25': loginForm.processing }"
                :disabled="loginForm.processing"
              >
                Log in
              </PrimaryButton>
            </div>
          </form>

          <div class="flex items-center justify-between">
            <Link href="#" class="text-sm mb-4 text-blue-500">Forgot your password?</Link>
            <span class="text-sm mb-4 text-gray-600"
              >No account? We'll set one up below.</span
            >
          </div>

          <form action="#">
            <div>
              <label for="job-title" class="block text-[#3E4857] font-extrabold"
                >Job Title</label
              >
              <input
                type="text"
                id="job-title"
                class="w-full border border-gray-400 rounded-lg bg-[#F9FAFB] shadow-md mb-2"
              />
              <span class="text-[13px] text-[#6B7280]"
                >Example: "Senior Laravel Developer", "Software Engineer"</span
              >
            </div>

            <div class="mt-5">
              <label for="job-location" class="block text-[#3E4857] font-extrabold"
                >Job Location</label
              >
              <input
                type="text"
                id="job-location"
                class="w-full border border-gray-400 rounded-lg bg-[#F9FAFB] shadow-md mb-2"
              />
              <span class="text-[13px] text-[#6B7280]"
                >Example: "Remote", "Remote / USA", "New York City", "Remote GMT-5", etc.
              </span>
            </div>

            <div class="mt-5">
              <label for="employment-type" class="block text-[#3E4857] font-extrabold"
                >Employment Type</label
              >
              <select
                id="employment-type"
                class="w-full border border-gray-400 bg-[#F9FAFB]"
              >
                <option value="Full Time" class="text-[14px]">Full Time</option>
                <option value="Part Time" class="text-[14px]">Part Time</option>
                <option value="Contractor" class="text-[14px]">Contractor</option>
                <option value="Temporary" class="text-[14px]">Temporary</option>
                <option value="Intern" class="text-[14px]">Intern</option>
                <option value="Volunteer" class="text-[14px]">Volunteer</option>
                <option value="Per Diem" class="text-[14px]">Per Diem</option>
                <option value="Other" class="text-[14px]">Other</option>
              </select>

              <div class="mt-5">
                <label for="salary" class="block text-[#3E4857] font-extrabold"
                  >Salary(optional)
                </label>
                <input
                  type="text"
                  id="salary"
                  class="w-full border border-[#D1D5DB] rounded-lg bg-[#F9FAFB] shadow-md mb-2"
                />
                <span class="text-[13px] text-[#6B7280]"
                  >Examples: "$120,000 – $145,000 USD", "€80,000 — €102,000"
                </span>
              </div>

              <div class="mt-5">
                <span class="block text-[#3E4857] font-extrabold">Company Logo</span>
                <div
                  class="flex items-center justify-start gap-4 bg-[#F9FAFB] p-4 rounded-lg"
                >
                  <OfficeBuildingOutline fillColor="#AAAAAC" :size="50" />
                  <label
                    for="select-file"
                    class="text-[#6B7280] text-sm font-extrabold p-2 rounded-xl border border-[#D1D5DB]"
                    >Select File
                  </label>
                  <input class="hidden" type="file" id="select-file" />
                </div>
                <span class="text-[13px] text-[#6B7280]"
                  >130x130 is best, but any works</span
                >
              </div>

              <div class="mt-5">
                <label for="tags" class="block text-[#3E4857] font-extrabold"
                  >Tags
                </label>
                <input
                  type="text"
                  id="tags"
                  class="w-full border border-[#D1D5DB] rounded-lg bg-[#F9FAFB] shadow-md mb-2"
                />
                <span class="text-[13px] text-[#6B7280]">Max of five tags </span>
              </div>

              <div class="mt-5 rounded-lg border-2 border-[#D1D5DB] px-4 py-4">
                <div class="text-center text-[16px] font-bold">
                  Enhance Your Listing. Get More Leads.
                </div>
                <div class="flex items-center justify-start gap-2 mt-4">
                  <input type="checkbox" id="company-logo" checked />
                  <label for="company-logo"
                    >Show your company logo in the listing (+$49)</label
                  >
                </div>
                <div class="flex items-center justify-start gap-2 mt-4">
                  <input type="checkbox" id="highlight-listing" />
                  <label for="highlight-listing"
                    >Boost your listing to the top of the page every 7 days (+$399)</label
                  >
                </div>
                <div class="flex items-center justify-start gap-2 mt-4">
                  <input type="checkbox" id="boost-listing" />
                  <label for="boost-listing"
                    >Boost your listing to the top of the page every day to maximize
                    exposure (+$1499)</label
                  >
                </div>
                <div class="flex items-center justify-start gap-2 mt-4">
                  <input type="checkbox" id="repost" />
                  <label for="repost">Repost automatically when listing expires</label>
                </div>
              </div>

              <div
                class="mt-5 flex items-center justify-between px-4 py-5 bg-[#E5E7EB] rounded-lg"
              >
                <div class="font-extrabold">Price</div>
                <div class="font-extrabold text-[#24C560]">$747.00</div>
              </div>

              <div class="mt-5 bg-[#DBEAFE] rounded-lg py-5 px-4 pb-8">
                <div class="text-center text-[16px] font-bold">
                  Enhance Your Listing. Get More Leads.
                </div>
                <div class="text-xs text-[#79818F] pl-10">
                  To login and edit the listing later.
                </div>
                <div class="mt-3">
                  <label for="name" class="block">Your Name</label>
                  <input
                    type="text"
                    id="name"
                    class="w-full bg-white border rounded-md"
                  />
                </div>
                <div class="mt-3">
                  <label for="email" class="block">Your Email</label>
                  <input
                    type="text"
                    id="email"
                    class="w-full bg-white border rounded-md"
                  />
                </div>
                <div class="mt-3">
                  <label for="password" class="block">Password</label>
                  <input
                    type="text"
                    id="password"
                    class="w-full bg-white border rounded-md"
                  />
                </div>
              </div>

              <!-- <div class="flex items-center justify-center mt-5">
                <Link
                  :href="route('checkout')"
                  as="button"
                  method="post"
                  class="rounded-lg p-2 px-4 text-white bg-blue-600 hover:bg-[#374151]"
                  type="button"
                >
                  Checkout
                </Link>
              </div> -->
            </div>
          </form>

          <form action="/create-checkout-session" class="flex items-center justify-center mt-5">
            <Link
              :href="route('checkout.index')"
              as="button"
              method="post"
              class="rounded-lg p-2 px-4 text-white bg-blue-600 hover:bg-[#374151]"
              type="button"
            >
              Checkout
            </Link>
          </form>

          <div class="-mb-4 font-bold">Live Preview</div>
          <!-- https://larajobs.com/logos/lX7Cf4BxhcaTRXDIL7sdEnej6rAt3sH3Q0MHzyWC.png -->
          <JobItem image="" />
        </div>

        <div>
          <div class="text-[#4B5563] text-center text-[1.2rem]">
            <span class="block">The official Laravel job board </span>
            <span class="block">since 2014. Trusted by </span>
            <span class="block"> thousands of companies.</span>
          </div>

          <div class="flex items-center justify-center mt-6">
            <img src="/images/adobe.svg" class="min-w-[25px] max-h-[25px] mx-4" />
            <img src="/images/ge.svg" class="min-w-[25px] max-h-[35px] mx-4" />
          </div>
          <div class="flex items-center justify-center mt-6">
            <img src="/images/hellofresh.svg" class="min-w-[25px] max-h-[25px] mx-4" />
            <img src="/images/wto.svg" class="min-w-[25px] max-h-[25px] mx-4" />
          </div>
          <div class="flex items-center justify-center mt-6">
            <img src="/images/usbank.svg" class="min-w-[25px] max-h-[25px] mx-4" />
          </div>

          <div class="my-8 border-2 border-[#D1D5DB] w-full"></div>

          <div class="text-[#4B5563] text-center text-[1.2rem]">
            <span class="block">Exclusively syndicated across </span>
            <span class="block"
              >the <a href="#" class="text-[#3B82F6]">Laravel News</a></span
            >
            <span class="block"> website/newsletter to millions</span>
            <span class="block">of readers</span>
          </div>

          <div class="flex items-center justify-center">
            <svg
              class="block mx-auto rounded-sm w-1/3 mt-4"
              version="1.1"
              id="Layer_1"
              xmlns="http://www.w3.org/2000/svg"
              xmlns:xlink="http://www.w3.org/1999/xlink"
              x="0px"
              y="0px"
              viewBox="0 0 183 174"
              style="enable-background: new 0 0 183 174"
              xml:space="preserve"
              fill="#f4645f"
            >
              <g>
                <path
                  class="st0"
                  d="M183-4H0c0,0,0,0,0,0v173.2c0,2.6,2.1,4.8,4.8,4.8h173.5c2.6,0,4.7-2.1,4.7-4.7L183-4C183-4,183-4,183-4z M87.9,129.1C87.9,129.2,87.9,129.2,87.9,129.1c0,1-0.8,1.8-1.8,1.8H48.2h0c0,0,0,0,0,0c-2.5,0-4.5-2-4.5-4.5V44.9c0,0,0-0.1,0-0.1 c0-1,0.8-1.7,1.8-1.7h6.8c0,0,0.1,0,0.1,0c1,0,1.7,0.8,1.7,1.8v76.3h32c0,0,0.1,0,0.1,0c1,0,1.7,0.8,1.7,1.8V129.1z M141,128.3  c0,0,0,0.1,0,0.1c0,1.4-1.2,2.6-2.7,2.5h-7.6c-0.7,0-1.3-0.1-1.9-0.4c-0.6-0.3-1.1-0.8-1.4-1.3L87.5,59.5v48.8c0,0,0,0.1,0,0.1 c0,1-0.8,1.7-1.8,1.7h-6.3c0,0-0.1,0-0.1,0c-1,0-1.7-0.8-1.7-1.8V45.7c0,0,0-0.1,0-0.1c0-1.4,1.2-2.6,2.7-2.5h7.5 c0.7,0,1.3,0.1,1.9,0.4c0.6,0.3,1.1,0.8,1.4,1.3l40,69.7V44.9c0,0,0-0.1,0-0.1c0-1,0.8-1.7,1.8-1.7h6.3c0,0,0.1,0,0.1,0 c1,0,1.7,0.8,1.7,1.8V128.3z"
                ></path>
              </g>
            </svg>
          </div>

          <div class="my-8 border-2 border-[#D1D5DB] w-full"></div>

          <div class="text-[#4B5563] text-center text-[1.2rem]">
            <span class="block">Emailed to 40,000+ Laravel</span>
            <span class="block"> developers</span>
          </div>

          <div class="my-8 border-2 border-[#D1D5DB] w-full"></div>

          <div class="text-[#4B5563] text-center text-[1.2rem]">
            <span class="block">From $299</span>
            <span class="block"> for 30 days</span>
          </div>

          <div class="my-8 border-2 border-[#D1D5DB] w-full"></div>

          <div class="flex flex-col">
            <div class="flex items-center justify-center">
              <img
                src="/images/matt2.jpg"
                class="rounded-full min-w-[160px] max-h-[160px]"
              />
            </div>

            <div class="mt-4 text-[1.25rem] font-extralight">
              "Listing our jobs through <br />LaraJobs was simple, quick,<br />
              and helped us find amazing<br />
              candidates.
            </div>

            <div class="mt-4 text-[1.25rem] font-extralight ]">
              <span class="bg-[#FEF08A]">We've now hired numerous</span>
              <span class="bg-[#FEF08A] block">times through LaraJobs and</span>
              <span class="bg-[#FEF08A] inline-block"
                >we'll absolutely use it again!"</span
              >
            </div>

            <div class="text-center mt-4">
              <a href="#" class="underline text-[#609AF8]">Matt Stauffer</a>
              <span>, Tighten Co.</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </DefaultLayout>
</template>

<script setup>
import { Head, Link, useForm } from "@inertiajs/vue3";
import DefaultLayout from "@/Layouts/DefaultLayout.vue";
import OfficeBuildingOutline from "vue-material-design-icons/OfficeBuildingOutline.vue";

import Checkbox from "@/Components/Checkbox.vue";
import GuestLayout from "@/Layouts/GuestLayout.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import JobItem from "@/Components/JobItem.vue";

defineProps({
  canResetPassword: {
    type: Boolean,
  },
  status: {
    type: String,
  },
});

const loginForm = useForm({
  email: "",
  password: "",
  remember: false,
});

const submit = () => {
  loginForm.post(route("login"), {
    onFinish: () => loginForm.reset("password"),
  });
};
</script>
