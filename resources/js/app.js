import './bootstrap';
import '../css/app.css';
import Layout from './Layouts/layout.vue';

import { createApp, h } from 'vue'
import { createInertiaApp } from '@inertiajs/vue3'
import { ZiggyVue } from '../../vendor/tightenco/ziggy';

createInertiaApp({
    title: title => `My App ${title}`,
    resolve: name => {
        const pages = import.meta.glob('./Pages/**/*.vue', { eager: true })
        let page = pages[`./Pages/${name}.vue`]
        if (name !== 'Auth/Register') {
            page.default.layout = page.default.layout || Layout
        }
            return page;
    },
    setup({ el, App, props, plugin }) {
        createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(ZiggyVue)
            .mount(el)
    },
    progress: {
        includeCSS: true,
        showSpinner: true
    }
})
