<template>
<div class="w-full flex flex-col" style="height:100%;">
<chatRoomSelection v-if="currentRoom.id" :chatRooms="chatRooms" :currentRoom="currentRoom" v-on:roomChanged="setRoom($event)"/>
<messageContainer :messages="messages"/>
<inputMessage :room="currentRoom" v-on:messageSent="getMessages()"/>
</div>
</template>

<script>
import messageContainer from '../chat/messageContainer';
import inputMessage from  '../chat/inputMessage';
import chatRoomSelection from  '../chat/chatRoomSelection';

export default {
        components: {
            messageContainer,
            inputMessage,
            chatRoomSelection
        },
        data(){
        	return {
        		chatRooms:[],
        		currentRoom:[],
        		messages:[],
                isChatopen: false
        	}
        },
        watch:{
            currentRoom(val,oldVal){
                if(oldVal.id){
                    this.disconnect(oldVal);
                }
                this.connect();
            }
        },
        methods:{
            connect(){
                if(this.currentRoom.id){
                    let vm = this;
                    this.getMessages();
                    window.Echo.private('chat.'+this.currentRoom.id)
                    .listen('.message.new' , e => {
                        vm.getMessages();
                    });
                }
            },
            disconnect(room){
                window.Echo.leave('chat.'+room.id);
            },
        	getRooms(){
        		axios.get('/api/chat/rooms')
        		.then(reponse => {
        			this.chatRooms = reponse.data;
        			this.setRoom(this.chatRooms[0]);
        		})
        		.catch(error=>{
        			console.log(error);
        		})
        	},
        	setRoom(room){
        		this.currentRoom = room;
        	},
        	getMessages(){
        		axios.get('/api/chat/room/'+this.currentRoom.id+'/messages')
        		.then(response=>{
        			this.messages = response.data;
        		})
        		.catch(error=>{
        			console.log(error);
        		})
        	}
        },
        created(){
        	this.getRooms();
        },
        beforeRouteEnter(to, from, next) {
        if (!window.Laravel.isLoggedin) {
            window.location.href = "/login";
        }
        next();
    } 
}
</script>