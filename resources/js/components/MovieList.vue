<template>    
        <table class="table">
            <thead>
                <tr>
                    <th>  
                    </th>
                    <th>
                        Title
                    </th>
                    <th>
                        Plot
                    </th>
                    <th v-if="user.role_id == '1'">
                    </th>
                    <th v-if="user.role_id == '1'">
                    </th>
                </tr>
            </thead>
            <tr v-for="movie in movies">
                <td>
                    <img height="80px" :src="movie.image" width="70px" v-if="movie.method == 'imdb'"></img>
                    <img height="80px" :src="'/storage/'+movie.image" width="70px" v-else></img>
                </td> 
                <td>
                    <b>{{movie.name}}</b>
                </td>
                <td>
                    {{movie.description}}
                </td>
                <td v-if="user.role_id == '1'">
                    <a class="btn btn-info btn-sm" :href="'/movie/'+movie.id+'/edit'" id="edit-btn">Edit</a>
                    <a class="btn btn-danger btn-sm" @click="deleteMovie(movie.id)" style="color: #FFF" id="delete-btn">
                        Remove
                    </a>
                </td>
            </tr>
        </table>    
</template>

<script>
    export default {
        props : ['user'],

        data: function() {
            return {
                movies: [],
                editRoute: 'movie.edit'
            }
        },

        mounted() {
            this.loadMovies();
        },

        methods: {
            loadMovies: function() {
                axios.get('/api/vue-index')
                .then((response)=> {
                    this.movies = response.data;
                })
                .catch( function(error){
                    console.log(error);
                });
            },
            deleteMovie(id,event) {
                Swal.fire({
                  title: 'Are you sure?',
                  text: "You won't be able to revert this!",
                  icon: 'warning',
                  showCancelButton: true,
                  confirmButtonColor: '#3085d6',
                  cancelButtonColor: '#d33',
                  confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                  if (result.isConfirmed) {
                    axios.delete('movie/'+id);
                    location.reload();
                  }
                })
            }
        }

    }
</script>
