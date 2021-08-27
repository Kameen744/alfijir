import { App, plugin } from '@inertiajs/inertia-vue'
import Vue from 'vue'

import NProgress from 'nprogress'
import { Inertia } from '@inertiajs/inertia'

Inertia.on('start', () => NProgress.start())
Inertia.on('finish', () => NProgress.done())



Vue.use(plugin)

// Vue.prototype.$route = (...args) => route(...args).url()
Vue.mixin({ methods: { route } })

const el = document.getElementById('app')

new Vue({
    render: h => h(App, {
        props: {
            initialPage: JSON.parse(el.dataset.page),
            resolveComponent: name => import(`./Pages/${name}`)
                .then(({ default: page }) => {
                    page.layout = page.layout === undefined ? Layout : page.layout
                    return page
                }),
        },
    }),
}).$mount(el)
