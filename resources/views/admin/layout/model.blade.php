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
  @yield('content')

</div>
<script>
    $(document).ready(function(){

    })
</script>
