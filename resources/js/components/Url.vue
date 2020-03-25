<template>
        <div>
            <a :href="field.value"
                :title="field.title || field.value"
                v-if="hasCustomHtml && clickable"
                class="cursor-pointer no-underline text-90"
                :target="field.sameTab ? '_self' : '_blank'"
                :rel="field.rel"
                v-html="field.customHtml"
            >
            </a>
            <div v-else-if="hasCustomHtml && !clickable"
                v-html="field.customHtml">
            </div>
            <a :href="field.value"
                :title="field.title || field.value"
                v-else-if="field.value && clickable"
                class="cursor-pointer dim no-underline text-primary flex items-center"
                :target="field.sameTab ? '_self' : '_blank'"
                :rel="field.rel"
            >
                <svg xmlns="http://www.w3.org/2000/svg"
                    class="fill-current mr-2 flex-no-shrink"
                    width="16"
                    height="16"
                    viewBox="0 0 24 24"
                    role="presentation"
                >
                    <path d="M19 6.41L8.7 16.71a1 1 0 1 1-1.4-1.42L17.58 5H14a1 1 0 0 1 0-2h6a1 1 0 0 1 1 1v6a1 1 0 0 1-2 0V6.41zM17 14a1 1 0 0 1 2 0v5a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V7c0-1.1.9-2 2-2h5a1 1 0 0 1 0 2H5v12h12v-5z"/>
                </svg>

                <span v-if="shouldDisplayAsHtml && field.label" class="block" v-html="field.label"></span>
                <span v-else class="block truncate">
                    {{ field.label ? field.label : field.value }}
                </span>
            </a>
            <span v-else-if="shouldDisplayAsHtml && field.label" class="block" v-html="field.label"></span>
            <span v-else-if="field.value" class="block truncate">{{ field.value }}</span>
            <span v-else>&mdash;</span>
        </div>
</template>

<script>
export default {
    props: ['resource', 'resourceName', 'resourceId', 'field', 'clickable'],

    computed: {
        hasCustomHtml() {
            return !!this.field.customHtml
        },
        shouldDisplayAsHtml() {
            return this.field.asHtml
        }
    }
}
</script>
