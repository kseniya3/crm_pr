<template>
        <div class="box-body">
            <div class="row">
                <div class="col-sm-12">
                    <table class="table table-bordered table-hover dataTable">
                        <thead>
                            <tr role="row" class="box-title">
                                <th scope="col">№</th>
                                <th scope="col">Appelation</th>
                                <th scope="col">Start date</th>
                                <th scope="col">Finish date</th>
                                <th scope="col">Description</th>
                                <th scope="col">Deadline</th>
                                <th scope="col">Manager</th>
                                <th scope="col">Client</th>
                                <th scope="col">Comment</th>
                                <th scope="col">Status</th>
                                <!-- <th></th> -->
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="url in arr.data"  :key="url.id">
                                <td>{{url.id}}</td>
                                <td>{{url.deal_name}}</td>
                                <td>{{url.open_date}}</td>
                                <td>{{url.close_date}}</td>
                                <td>{{url.deal_descrip}}</td>
                                <td>{{url.deadline}}</td>
                                <td>{{url.user.name}}</td>
                                <!-- <td></td> -->
                                <td>
                                    <div v-for="client in url.clients" :key="client.id">{{client.second_name}}, </div>
                                </td>
                                <td><a :href="'/comments/'+url.id">Comment
                                </a></td>
                                <td>{{url.status}}</td>
                                <td class="table-buttons" style="border:0;">
                                    <div class="input-group-btn">
                                        <button class="btn btn-danger" v-on:click="delete_deal(url.id)">
                                            Delete
                                        </button>
                                    </div>
                                </td>
                                <td class="table-buttons">
                                    <a :href="'/deals/'+url.id + '/edit/'" class="btn btn-outline-success" >
                                        Edit
                                    </a>
                                </td>
                            </tr>
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
</template>

<script>

import axios from 'axios';
    export default{
        
        props:[
            'urldata'
        ],
        data () {return{
            arr:this.urldata
            }
        },
        mounted(){
            this.update();
        },
        methods:{
            update: function(){
                console.log(this.urldata);
            },
            delete_deal: function(index){
                    axios.delete(`/deals/${index}`).then((response)=>(console.log(index)))
            },
            open_comment: function(index){
                
            }
        }
    }
</script>

<style scoped>

</style>
