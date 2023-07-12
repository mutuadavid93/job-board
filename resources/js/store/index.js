import { reactive } from "vue";

export const store = reactive({
    isOpen: false,
    toggleModel() {
        this.isOpen = !this.isOpen;
    },
});
