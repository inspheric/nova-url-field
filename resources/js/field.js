import IndexField from "./components/IndexField";
import DetailField from "./components/DetailField";
import FormField from "./components/FormField";

Nova.booting((Vue) => {
    Vue.component('index-url-field', IndexField);
    Vue.component('detail-url-field', DetailField);
    Vue.component('form-url-field', FormField);
})
