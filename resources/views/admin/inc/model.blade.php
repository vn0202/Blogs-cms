<style>
 .model-over{
     position: fixed;
     right: 0;
     left:0;
     top: 0;
     bottom: 0;
     background-color: rgba(0,0,0,0.5);
     padding-top: 60px;
     padding-bottom: 120px;
     display:none;
 }
 .model{
     min-width: 500px;
     margin: 0 auto;
     background-color: #fff;
 }
 .model-header{
     background-color: #fff;
     display: flex;
     justify-content: space-between;
     line-height: 60px;
     padding: 0 24px;
 }
 .model-header-heading{
     font-size: 18px;
     font-weight: 500;
 }
 .model-body{
     background-color: #f1f4f8;
     padding: 24px;
 }
 .model-container{
     background-color:#fff;
 }
 .icon-close{
     display: inline-block;
     padding :6px;
 }
 .icon-close:hover{
     cursor: pointer;
 }
</style>
<div class="model-over">
    <div class="model">
    <div class="model-header">
        <div class="model-header-heading">
            Add Tag
        </div>
        <span class="icon-close"><i class="fas fa-times"></i></span>
    </div>
    <div class="model-body">
        <div class="model-container">
            <div class="card card-primary">
                @if(session('success'))
                    <p class="alert-success text-center">{{session('success')}}</p>
                @endif
                <form id="quickForm" action="" method="POST">
                    @csrf

                    <div class="card-body">
                        <div class="form-group " >
                            <label for="title">Title</label>
                            <input  type="text" name="title" class="form-control" id="model_title" placeholder="Enter title">
                        </div>
                        @error('title')
                        <p class="text-danger">{{$message}}</p>
                        @enderror
                    </div>

                    <div class="card-footer text-right">
                        <button type="submit" class="btn btn-primary" id="submit-add-tag">Submit</button>
                        <button type="submit" class="btn btn-default cancel" >Cancel</button>

                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="model-footer"></div>
    </div>

</div>
<script>
    $(document).ready(function(){

    })
</script>
