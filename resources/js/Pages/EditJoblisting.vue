<template>
  <Head title="Jobs" />
  <DefaultLayout>
    <div class="min-w-[1100px] pb-10">
      <div class="flex gap-8 px-10 mt-14">
        <div class="w-11/12">
          <form action="#" @submit.prevent="update">
            <input type="hidden" name="_method" value="PUT" />
            <div>
              <InputLabel value="JOB TITLE" class="mb-1.5" />
              <TextInput
                class="w-full placeholder:italic placeholder:text-xs"
                type="text"
                id="job-title"
                v-model="form.title"
                placeholder="Job title"
              />
              <span class="text-[13px] text-[#6B7280]"
                >Example: "Senior Laravel Developer", "Software Engineer"</span
              >
              <span
                v-if="$page.props.errors.title"
                class="text-red-700 block mt-2 text-[13px]"
              >
                {{ $page.props.errors.title }}
              </span>
            </div>

            <div class="mt-5">
              <InputLabel value="EXPERIENCE LEVEL" class="mb-1.5" />
              <select
                id="experience_level"
                class="w-full border border-gray-400 bg-[#F9FAFB] rounded-lg mb-4"
                v-model="form.experience_level"
              >
                <option value="Senior Level" class="text-[14px]">Senior Level</option>
                <option value="Mid Level" class="text-[14px]">Mid Level</option>
                <option value="Entry Level" class="text-[14px]">Entry Level</option>
                <option value="Internship" class="text-[14px]">Internship</option>
              </select>
            </div>

            <div class="mb-6">
              <InputLabel value="COMPANY OVERVIEW" class="mb-1.5" />
              <QuillEditor
                v-model:content="form.company_overview"
                contentType="html"
                toolbar="essential"
                placeholder="Introduction of your company"
              />
            </div>

            <div class="mb-6">
              <InputLabel value="JOB PURPOSE – SUMMARY" class="mb-1.5" />
              <QuillEditor
                v-model:content="form.job_purpose"
                contentType="html"
                toolbar="essential"
                placeholder="Job purpose i.e. summary"
              />
              <span
                v-if="$page.props.errors.job_purpose"
                class="text-red-700 block mt-2 text-[13px]"
              >
                {{ $page.props.errors.job_purpose }}
              </span>
            </div>

            <div class="mb-6">
              <InputLabel
                value="KEY RESPONSIBILITIES &amp; ACCOUNTABILITIES"
                class="mb-1.5"
              />
              <QuillEditor
                v-model:content="form.responsibilities"
                toolbar="essential"
                contentType="html"
                placeholder="Key responsibilities &amp; accountabilities. Kindly use bullet points"
              />
              <span
                v-if="$page.props.errors.responsibilities"
                class="text-red-700 block mt-2 text-[13px]"
              >
                {{ $page.props.errors.responsibilities }}
              </span>
            </div>

            <div class="mb-4">
              <InputLabel
                value="PROFESSIONAL, TECHNICAL SKILLS AND PREVIOUS EXPERIENCE REQUIRED"
                class="mb-1.5"
              />
              <QuillEditor
                v-model:content="form.professional_skills"
                contentType="html"
                toolbar="essential"
                placeholder="Professional, technical skills and previous experience required"
              />
              <span
                v-if="$page.props.errors.professional_skills"
                class="text-red-700 block mt-2 text-[13px]"
              >
                {{ $page.props.errors.professional_skills }}
              </span>
            </div>

            <div class="mt-5">
              <InputLabel value="JOB LOCATION" class="mb-1.5" />
              <TextInput
                id="job-location"
                type="text"
                v-model="form.location"
                placeholder="Job location"
                class="w-full placeholder:italic placeholder:text-xs"
              />
              <span class="text-[13px] text-[#6B7280]"
                >Example: "Remote", "Remote / USA", "New York City", "Remote GMT-5", etc.
              </span>
              <span
                v-if="$page.props.errors.location"
                class="text-red-700 block mt-2 text-[13px]"
              >
                {{ $page.props.errors.location }}
              </span>
            </div>

            <div class="mt-5">
              <InputLabel value="EMPLOYMENT TYPE" class="mb-1.5" />
              <select
                id="employment-type"
                class="w-full border border-gray-400 bg-[#F9FAFB] rounded-md"
                v-model="form.employment_type"
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
              <span
                v-if="$page.props.errors.employment_type"
                class="text-red-700 block mt-2 text-[13px]"
              >
                {{ $page.props.errors.employment_type }}
              </span>

              <div class="mt-5">
                <InputLabel value="SALARY(optional)" class="mb-1.5" />
                <TextInput
                  type="number"
                  id="salary"
                  v-model="form.salary"
                  class="w-full"
                />
                <span class="text-[13px] text-[#6B7280]"
                  >Examples: "$120,000 – $145,000 USD", "€80,000 — €102,000"
                </span>
                <span
                  v-if="$page.props.errors.salary"
                  class="text-red-700 block mt-2 text-[13px]"
                >
                  {{ $page.props.errors.salary }}
                </span>
              </div>

              <div class="mt-5">
                <InputLabel value="COMPANY NAME" class="mb-1.5" />
                <TextInput
                  type="text"
                  id="company_name"
                  v-model="form.company_name"
                  placeholder="Company name"
                  class="w-full placeholder:italic placeholder:text-xs"
                />
                <span
                  v-if="$page.props.errors.company_name"
                  class="text-red-700 block mt-2 text-[13px]"
                >
                  {{ $page.props.errors.company_name }}
                </span>
              </div>

              <div class="mt-5">
                <InputLabel value="COMPANY LOGO" class="mb-1.5" />
                <div
                  class="flex items-center justify-start gap-4 bg-[#F9FAFB] p-4 rounded-lg"
                >
                  <img
                    v-if="imageDisplay"
                    :src="imageDisplay"
                    class="aspect-square object-cover p-1 rounded-lg min-w-[50px] max-h-[50px]"
                  />
                  <OfficeBuildingOutline v-else fillColor="#AAAAAC" :size="50" />
                  <label
                    for="select-file"
                    class="text-[#6B7280] text-sm font-extrabold p-2 rounded-xl border border-[#D1D5DB]"
                    >Select File
                  </label>
                  <input
                    @change="getUploadedImage"
                    class="hidden"
                    type="file"
                    name="uploadedFile"
                    id="select-file"
                  />
                  <progress
                    v-if="form.progress"
                    :value="form.progress.percentage"
                    max="100"
                  >
                    {{ form.progress.percentage }}%
                  </progress>
                  <span
                    v-if="$page.props.errors.company_logo"
                    class="text-red-700 block mt-2 text-[13px]"
                  >
                    {{ $page.props.errors.company_logo }}
                  </span>
                </div>
                <span class="text-[13px] text-[#6B7280]"
                  >130x130 is best, but any works</span
                >
              </div>

              <div class="flex items-center justify-center">
                <button
                  type="submit"
                  :disabled="form.processing"
                  class="rounded-lg p-2 px-4 text-white bg-blue-600 hover:bg-[#374151] my-5"
                >
                  Submit
                </button>
              </div>
            </div>
          </form>
        </div>

        <SideNav />
      </div>
    </div>
  </DefaultLayout>
</template>

<script setup>
import { ref } from "vue";
import { Head, Link, useForm } from "@inertiajs/vue3";
import DefaultLayout from "@/Layouts/DefaultLayout.vue";
import SideNav from "@/Components/SideNav.vue";
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import OfficeBuildingOutline from "vue-material-design-icons/OfficeBuildingOutline.vue";

const props = defineProps({ joblisting: Object });
let imageDisplay = ref(props.joblisting?.company_logo || "");
const form = useForm(() => {
  return {
    title: props.joblisting?.title || "",
    location: props.joblisting?.location || "",
    company_name: props.joblisting?.company_name || "",
    experience_level: props.joblisting?.experience_level || "Senior Level",
    employment_type: props.joblisting?.employment_type || "Full Time",
    company_logo: props.joblisting?.company_logo || null,
    salary: props.joblisting?.salary || "0",

    company_overview: props.joblisting?.company_overview || "",
    job_purpose: props.joblisting?.job_purpose || "",
    professional_skills: props.joblisting?.professional_skills || "",
    responsibilities: props.joblisting?.responsibilities || "",
  };
});

const update = () => {
  form.post(route("joblistings.update", { joblisting: props.joblisting.id }), {
    preserveScroll: true,
    data: form.value,
    onSuccess: () => {
      // Handle success
    },
    onError: () => {
      // Handle error
    },
  });
};

const getUploadedImage = (event) => {
  // convert the file into an object url
  imageDisplay.value = URL.createObjectURL(event.target.files[0]);
  form.company_logo = event.target.files[0];
};

async function setExistingImageAsFile(imagePath) {
  // Fetch the image data from the server
  const response = await fetch(imagePath);
  const imageData = await response.blob();

  // Create a File object from the image data
  const imageFile = new File([imageData], 'existing-image.jpg', { type: imageData.type });

  // Set the imageDisplay value and form.company_logo with the fetched image
  imageDisplay.value = URL.createObjectURL(imageFile);
  form.company_logo = imageFile;
}
setExistingImageAsFile(props.joblisting?.company_logo);
</script>
