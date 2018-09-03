<template>
        <div>
            <a :href="field.value"
                :title="field.value"
                v-if="field.value && clickable"
                class="cursor-pointer dim no-underline text-primary inline-flex items-center"
                target="_blank"
            >
                <svg xmlns="http://www.w3.org/2000/svg"
                    class="fill-current mr-2"
                    :style="{ color: field.color }"
                    width="16"
                    height="16"
                    :viewBox="viewBox"
                    role="presentation"
                    v-html="field.icon"></svg>

                <span v-if="field.label">
                    {{ field.label }}
                </span>
                <span v-else>
                    {{ field.name }}
                </span>
            </a>
            <span v-else-if="field.value">{{ field.value }}</span>
            <span v-else>&mdash;</span>
        </div>
</template>

<script>

export default {
    props: ['resource', 'resourceName', 'resourceId', 'field', 'clickable'],

    computed: {
        viewBox() {
            const size = this.field.size ? this.field.size : 24;
            return `0 0 ${size} ${size}`
        }
    }
}
</script>
