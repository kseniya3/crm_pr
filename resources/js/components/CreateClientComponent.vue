
<template>
    
    <div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">Quick Example</h3>
    </div>
    
 <!--    @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div><br />
    @endif -->
    <!-- /.box-header -->
    <!-- form start -->

    <form role="form" method="POST">
    
        <div class="box-body">
            <div class="form-group">
                <label>deal_name</label>
                <input type="text" name="deal_name" class="form-control" value="">
            </div>


            <div class="form-group">
                <label>close_date</label>
                <input type="dateTime-local" name="close_date" class="form-control" value="">
            </div> 
            <div class="form-group">
                <label>deal_descrip</label>
                <input type="text" name="deal_descrip" class="form-control" value="">
            </div>
            <div class="form-group">
                <label>deadline</label>
                <input type="dateTime-local" name="deadline" class="form-control" value="">
            </div>
            <div class="form-group">
                <label>Cient</label>

            </div>
                <input type="hidden" name="user_id" value="">
                
                <fieldset class="form-horizontal">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Comment:</label>
                        <div class="col-sm-12">
                            <textarea name="comment_text" class="form-control"></textarea>
                        </div>
                    </div>
                </fieldset>


        </div>
                <!-- /.box-body -->
        <div class="box-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>
    
    
</div>
</template>

<script>

    export default {
        
        
        mounted() {
            
            console.log('Component mounted.')
        }
    }
</script>
