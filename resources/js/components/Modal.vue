<template>
	<div class="modal fade" id="exampleModal">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title">Edit Information</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close" @click="resetPeople">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
	        <input type="hidden" disabled class="form-control" id="e_id" name="id"
	                  :value="item.id">
	        Name: <input type="text" class="form-control" id="name" name="name"
	                  v-model="item.name">
	        Age: <input type="number" class="form-control" id="age" name="age"
	          v-model="item.age">
	        Profession: <input type="text" class="form-control" id="profession" name="profession"
	          v-model="item.profession">
	          <p class="alert-success mt-3" v-if="success" style="font-size:20px">
	          	<em>{{ this.success }}</em>
	          </p>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-primary" @click="updatePeople">Save changes</button>
	        <button type="button" class="btn btn-secondary" data-dismiss="modal" @click="resetPeople">Close</button>

	      </div>
	    </div>
	  </div>
	</div>
</template>
<script>
export default {
	name: 'modal',
	data(){
		return{
			item: {
                id: '',
                name: '',
                age: '',
                profession:''
        	},
        	success: '',
        	hasModal: false
		}
	},
	methods:{		
		resetPeople(){
			this.item.id = '';
			this.item.name = '';
			this.item.age = '';
			this.item.profession = '';
		},
		updatePeople(){
			axios
				.post(`/updatePeople/${this.item.id}`, this.item)
				.then((response) => {
					this.success = "Please wait for a while....";
					Event.$emit('peopleUpdated',response.data)
					if (response.status == 200) {
						setTimeout(()=>{
							$('.modal').modal('hide');
						},2000);
					}

				})
				.catch(err => console.log(err));
		}
	},
	mounted(){
		Event.$on('peopleFound',(people)=>{
			this.success = "";
			this.item.name = people.name;
			this.item.age = people.age;
			this.item.profession = people.profession;
			this.item.id = people.id;
		})
		
	}
}
</script>
<style>
	
</style>