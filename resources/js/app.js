import "./bootstrap";
import "../css/app.css";
import "@vueup/vue-quill/dist/vue-quill.snow.css";

import { createApp, h } from "vue";
import { createInertiaApp } from "@inertiajs/vue3";
import { resolvePageComponent } from "laravel-vite-plugin/inertia-helpers";
import { ZiggyVue } from "../../vendor/tightenco/ziggy/dist/vue.m";
import { QuillEditor } from "@vueup/vue-quill";
import VueMultiselect from "vue-multiselect";

const appName =
    window.document.getElementsByTagName("title")[0]?.innerText || "Laravel";

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) =>
        resolvePageComponent(
            `./Pages/${name}.vue`,
            import.meta.glob("./Pages/**/*.vue")
        ),
    setup({ el, App, props, plugin }) {
        return createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(ZiggyVue, Ziggy)
            .component("QuillEditor", QuillEditor)
            .component("VueMultiselect", VueMultiselect)
            .mount(el);
    },
    progress: {
        color: "#4B5563",
    },
});
