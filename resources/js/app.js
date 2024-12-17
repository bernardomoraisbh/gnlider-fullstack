import { createApp, h } from "vue";
import { createInertiaApp } from "@inertiajs/vue3";

import MainLayout from "./Layouts/MainLayout.vue";
import vuetify from "./plugins/vuetify";

import { ZiggyVue } from "ziggy";

createInertiaApp({
    resolve: (name) => {
        const pages = import.meta.glob("./Pages/**/*.vue", { eager: true });
        const importPage = pages[`./Pages/${name}.vue`];
        if (!importPage) {
            throw new Error(`Not found ${name}`);
        }
        // Define layout based on path
        // It's possible to use the implemented laayout with importPage.default.layout = page.layout || MainLayout
        importPage.default.layout = name.startsWith("Public/")
            ? undefined
            : MainLayout;
        return importPage;
    },
    setup({ el, App, props, plugin }) {
        createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(vuetify)
            .use(ZiggyVue)
            .mount(el);
    },
});
