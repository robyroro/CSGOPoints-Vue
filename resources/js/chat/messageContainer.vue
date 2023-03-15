<template>
  <div class="h-screen">
  <div class="flex flex-col-reverse dark:bg-c-d-blue" style="height: calc(100% - 110px); overflow-y:auto;">
  <div v-for="(message, index) in messages" :key="index">
    <messageItem :message="message"/>
  </div>
  </div>
  </div>
</template>

<script>
import messageItem from '../chat/messageItem';

export default {
  components: {messageItem},
  props: ['messages'],
  data() {
        return {
          isChatopen: false
        }
  }
}
</script>