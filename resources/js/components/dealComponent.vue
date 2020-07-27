<template>
        <div class="box-body">
            <div class="row">
                <div class="col-sm-12">
                    <div class="input-group">
                        
                        <input type="search" class="form-control" placeholder="Enter what you want to find..." v-model="search">
                    </div>
                    <div class="card">
                    <table class="table">
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
                                <th colspan="2" scope="col"><a :href="'/deals/create/'" class="btn btn-outline-success add_but">Add deal</a></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="url in search_list" :key="url.id">
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
                                <td><a :href="'/comments/'+url.id" class="for_a">Comment
                                </a></td>
                                <td>{{url.status}}</td>
                                <td class="table-buttons borderbut">
                                    <div class="input-group-btn">
                                        <button class="btn btn-outline-danger for_del_but" v-on:click="delete_deal(url.id)">
                                            <i class="fa fa-recycle"></i>
                                        </button>
                                    </div>
                                </td>
                                <td class="table-buttons borderbut">
                                    <a :href="'/deals/'+url.id + '/edit/'" class="btn btn-outline-success for_edit_but" >
                                    <i class="fa fa-edit"></i>
                                    </a>
                                    
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    </div>
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
        data(){
            return{
                search:'',
                arr:this.urldata.data
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
        },
        computed:{
            search_list(){
                const val=this.search.toLowerCase();
                return this.arr.filter(function(arf){
                    return arf.deal_name.toLowerCase().indexOf(val) > -1 ||
                    arf.status.toLowerCase().indexOf(val)>-1 ||
                    arf.deal_descrip.toLowerCase().indexOf(val)>-1
                })
            }
        }

    }
</script>

<style scoped>
.for_a{
    color: black;
}
.for_a:hover{
    text-decoration: underline;
}

.add_but{
    background-color: rgba(166, 255, 243, 0.753);
    border-color: rgba(12, 54, 49, 0.753);
    color: black;
}

.add_but:hover{
    background-color: rgba(18, 84, 87, 0.753);
    border-color: rgba(154, 235, 240, 0.753);
    color: rgb(255, 255, 255);
    transition: 1s;
}

.for_edit_but{
    background-color: rgb(217, 248, 188);
    border-color: teal;
    color: teal;
}

.for_edit_but:hover{
    background-color: rgb(15, 83, 52);
    border-color: white;
    color: white;
    transition: 1s;
}

.for_del_but{
    background-color: rgb(255, 81, 81);
    color: rgb(0, 0, 0);
    border-color:black;
}

.for_del_but:hover{
    background-color: rgb(99, 13, 13);
    color: white;
    border-color:rgb(255, 255, 255);
    transition: 1s;
}



.for_td{
    width:100px;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}
.borderbut{
    border: 0;
}

</style>
