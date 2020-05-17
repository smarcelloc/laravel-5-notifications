<template>
  <a class="dropdown-item border-bottom py-2" href="#" @click.prevent="maskAsRead(notification.id)">
    <strong>{{comment.user.name}}</strong><br>
    <small class="text-muted">{{comment.created_at}}</small><br>
    <small>{{comment.title}}</small>
  </a>
</template>

<script>
export default {
  props: ["notification"],

  computed:{
    comment(){
      return this.notification.data.comment
    }
  },

  methods:{
    maskAsRead(idNotification){
      this.$store.dispatch('maskAsRead', {id : idNotification})
    }
  }
};
</script>