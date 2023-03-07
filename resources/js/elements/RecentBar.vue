<template>
    <div class="flex w-auto" v-for="log in logs" :key="log.id">
        <div class="flex flex-row items-center space-x-2 xl:w-auto">
            <div class="pr-4 md:pr-0 flex items-center bg-gray-200 dark:bg-c-black rounded transition-colors" :style="{borderTop: '1px solid' + log.color, backgroundColor:  log.color }">
                <img v-if="log.icon" :src="'https://community.akamai.steamstatic.com/economy/image/' + log.icon" class="rounded w-6 h-6 mr-2 ml-2 border border-gray-300 dark:border-gray-700"/>
                <img v-else-if="!log.user.avatar" :src="'https://ui-avatars.com/api/?bold=true&background=adadad&color=fff&uppercase=true&name=' + log.user.name" class="rounded w-6 h-6 mr-2 ml-2 border border-gray-300 dark:border-gray-700"/>
                <img v-else :src="log.user.avatar" class="rounded w-6 h-6 mr-2 ml-2 border border-gray-300 dark:border-gray-700"/>

                <div class="flex flex-col py-1" style="font-size: 10px">
                    <h5 class="text-gray-700 dark:text-white truncate" v-if="log.item">
                        {{ log.item }}
                    </h5>
                    <h5 class="text-gray-700 dark:text-white truncate" v-else>
                        {{ log.wall }}
                    </h5>
                    <h5 class="text-gray-700 dark:text-white truncate">
                        {{ log.user.name }}
                    </h5>
                </div>
                <span class="bg-gray-200 dark:bg-c-d-blue rounded px-2 ml-3 mr-6 md:mr-9 xl:mr-9 border border-gray-300 dark:border-gray-700 text-gray-700 dark:text-white transition-colors" style="font-size: 12px">{{ Math.trunc(log.points) }}</span>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: ["logs"],
    data() {
        return {};
    },
    methods: {},
};
</script>
