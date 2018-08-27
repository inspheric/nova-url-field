Nova.booting((Vue, router) => {
    Vue.component('index-url-field', require('./components/IndexField'));
    Vue.component('detail-url-field', require('./components/DetailField'));
    Vue.component('form-url-field', require('./components/FormField'));
})
