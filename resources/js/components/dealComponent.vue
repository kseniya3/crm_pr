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
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="url in urldata.data"  :key="url.id">
                                <td>{{url.id}}</td>
                                <td>{{url.deal_name}}</td>
                                <td>{{url.open_date}}</td>
                                <td>{{url.close_date}}</td>
                                <td>{{url.deal_descrip}}</td>
                                <td>{{url.deadline}}</td>
                                <td v-for="user in users" :key="user.id" ></td>
                                <td></td>
                                <td></td>
                                <td>{{url.status}}</td>
                            </tr>
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
</template>

<script>
    export default{
        props:[
            'urldata',
            'userss'
        ],
        mounted(){
            this.update();
        },
        methods:{
            update: function(){
                console.log(this.urldata);
            }
        }
    }
</script>

<style scoped>

</style>
