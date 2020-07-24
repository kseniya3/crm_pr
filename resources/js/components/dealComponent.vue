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
                                <th scope="col"><a href="#">Finish date</a></th>
                                <th scope="col">Description</th>
                                <th scope="col">Deadline</th>
                                <th scope="col">Manager</th>
                                <th scope="col">Client</th>
                                <th scope="col">Comment</th>
                                <th scope="col">Status</th>
                                
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="url in arr.data"  :key="url.id">
                                <td>{{url.id}}</td>
                                <td>{{url.deal_name}}</td>
                                <td>{{url.open_date}}</td>
                                <td>{{url.close_date}}</td>
                                <td><div class="for_td">{{url.deal_descrip}}</div></td>
                                <td>{{url.deadline}}</td>
                                <td>{{url.user.name}}</td>
                                <td>
                                    <div v-for="client in url.clients" :key="client.id">{{client.second_name}}, </div>
                                </td>
                                <td><a :href="'/comments/'+url.id">Comment
                                </a></td>
                                <td>{{url.status}}</td>
                                <td class="table-buttons forbut">
                                    <div class="input-group-btn">
                                        <button class="btn btn-outline-danger" v-on:click="delete_deal(url.id)">
                                            <i class="fa fa-recycle"></i>
                                        </button>
                                    </div>
                                </td>
                                <td class="table-buttons forbut">
                                    
                                    <a :href="'/deals/'+url.id + '/edit/'" class="btn btn-outline-success" >
                                    <i class="fa fa-edit"></i>
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
        columns:[
            '№',
            'Appelation',
            'Start date',
            'Finish date',
            'Description',
            'Deadline',
            'Manager',
            'Client',
            'Comment',
            'Status'
        ],
        props:[
            'urldata'
        ],
        data () {return{
            arr:this.urldata,
            sortParam:''
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
                    axios.delete(`/deals/${index}`).then(function(response)
                    {
                        if(response.data.status == 'OK')
                        {
                            window.location.reload();
                        }
                    })
            }
        }
    }
</script>

<style scoped>
.forbut{
    border:0;
}
.for_td{
    width:100px;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}
</style>
