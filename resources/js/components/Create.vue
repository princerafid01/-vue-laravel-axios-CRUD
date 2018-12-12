<template>
    <div class="container mt-4 mb-4">
        <h3 class="text-center">Create Information</h3>
        <form @submit.prevent="createItem()">
            <div class="row">
                <div class="col-md-6 offset-md-3">
                    <div class="form-group">
                        <label for="name">Name:</label>
                        <input type="text" class="form-control" id="name" name="name"  placeholder="Name" v-model="newItem.name">
                    </div>
                    <div class="form-group">
                        <label for="age">Age:</label>
                        <input type="number" class="form-control" id="age" name="age"  placeholder="Enter Age" v-model="newItem.age">
                    </div>
                    <div class="form-group">
                        <label for="profession">Profession:</label>
                        <input type="text" class="form-control" id="profession" name="profession"  placeholder="Enter Profession" v-model="newItem.profession">
                    </div>
                    <button type="submit" class="btn btn-primary" id="name"><strong>+</strong> ADD</button>
                    <p class="text-center alert alert-danger mt-4" v-if="hasError">Please fill all fields! </p>
                    <p class="text-center alert alert-success mt-4" v-if="success"><strong>{{ success }} </strong></p>
                </div>
                    
            </div>
        </form>
    </div>
</template>

<script>
    export default {
        name: 'create',
        data(){
            return {
                newItem: {
                    name: '',
                    age: '',
                    profession: ''
                },
                hasError: false,
                success: ''
            }
    },
    watch:{
        success(){
            setTimeout(() => {
                this.success = '';
            }, 2500);
        }
    },
    methods:{
        createItem(){
            let input = this.newItem;
            if (input.name == '' || input.age == "" || input.profession =="" ) {
                this.hasError = true;
            } else{
                this.success = 'Validating your information....';
                axios.post('/viewitems' , input)
                    .then((response) => {
                        input.name = '';
                        input.age = '';
                        input.profession = '';
                        this.success = response.data +  "'s information is added succesfully!";
                        this.hasError = '';
                        Event.$emit('peopleCreated' , this.success);
                    })
                    .catch((err) => {
                        console.log(err)
                    });
            }
        }
    },
    }
</script>
