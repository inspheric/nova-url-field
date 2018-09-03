<template>
        <ul class="list-reset">
            <li v-for="(value, key) in field.value" class="mb-1">
                <a :href="value"
                    :title="value"
                    v-if="value && clickable"
                    class="cursor-pointer dim no-underline text-primary inline-flex items-center"
                    target="_blank"
                >
                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="fill-current mr-2"
                        :style="{ color: field.color[key] }"
                        width="16"
                        height="16"
                        :viewBox="viewBox(key)"
                        role="presentation"
                        v-html="field.icon[key]"></svg>

                    <span v-if="field.label[key]">
                        {{ field.label[key] }}
                    </span>
                    <span v-else>
                        {{ value }}
                    </span>
                </a>
                <span v-else-if="value">{{ value }}</span>
                <span v-else>&mdash;</span>
            </li>
        </ul>
</template>

<script>

export default {
    props: ['resource', 'resourceName', 'resourceId', 'field', 'clickable'],

    methods: {
        viewBox(key) {
            const size = this.field.size && this.field.size[key] ? this.field.size[key] : 24;
            return `0 0 ${size} ${size}`
        }
    }
}
</script>
