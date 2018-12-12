<template>
<div class="container mt-4">
	<h3 class="p-4 text-center">Information of people</h3>
    <table class="table table-bordered table-condensed" id="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Age</th>
                <th>Profession</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tr v-if="!peoples">
        	<em>Please wait for a while.....</em>
        </tr>
        <tr v-for="(people , index) in peoples" :key="people.id" :class="{ 'alert-success' : (index == 0 && success) || (people.id == updated) }"> 
            <td>{{ people.id }}</td>
            <td>{{ people.name }}</td>
            <td>{{ people.age }}</td>
            <td>{{ people.profession}}</td>
            
            <td>
            	<button type="button" @click="findPeople(people.id)" data-toggle="modal" data-target="#exampleModal"  class="btn btn-info ml-4 mb-2 mt-2" >Edit</button>
            	<a href="#" @click.prevent="deletePeople(people.id)" onclick="confirm('Are you sure to delete this information?')" class="btn btn-danger ml-4 mb-2 mt-2" >Delete</a>
            </td>
            <modal/>
        </tr>
	    </table>
</div>


</template>
<script>
import Modal from "./Modal.vue";
export default{
	name: 'read',
	components: {
		Modal
	},
	data(){
		return {
            newItem: {
                name: '',
                age: '',
                profession: ''
            },
            peoples: '',
            success: '',
            updated: ''
        }
	},
	methods: {
		getPeoples(){
			axios.get('/peoples')
			.then((response) => {
				this.peoples = response.data;
			})
			.catch((err) => {
				console.log(err);
			});
		},
		findPeople(id){
			axios
				.get(`/findPeople/${id}`)
				.then((response) => {
					Event.$emit('peopleFound',response.data);
				})
				.catch((err) => {
					console.log(err);
				});
		},
		deletePeople(id){
			axios
				.get(`/deletePeople/${id}`)
				.then((response) => {
					Event.$emit('peopleCreated');
					alert(response.data);
				})
				.catch((err) => {
					console.log(err);
				});
		}
	},
	created(){
		this.getPeoples();
	},
	mounted() {
    Event.$on('peopleCreated', (success) => {
        this.getPeoples();
        this.success = success;
        setTimeout(() => {
            this.success = '';
        }, 14000);
    });
    Event.$on('peopleUpdated', (data) => {
        this.getPeoples();
        this.updated = data.id;
        setTimeout(() => {
                this.updated = '';
        }, 10000);
    });
}
}
</script>
<style>

	
</style>