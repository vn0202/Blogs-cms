<style>
    .model-over{
        position: fixed;
        right: 0;
        left:0;
        top: 0;
        bottom: 0;
        background-color: rgba(0,0,0,0.5);
        padding-top: 120px;
        padding-bottom: 120px;
        display:flex;
        z-index:10;
    }
    .model{
        min-width: 500px;
        margin: 0 auto;
        max-height: 200px;
        background-color: #fff;
        padding:24px;
        position: relative;
        right: 0;
        left: 100%;
        animation: movetoright 0.3s ease-in-out forwards;
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
    @keyframes movetoright {
        from{
            left:100%;
        }
        to{
               left:0px;
        }

    }
</style>
<div class="model-over">
    <div class="model">
        <div class=" text-center text-lg mb-4">
            Bạn không có quyền chỉnh sửa hay xóa bài viết này!
        </div>
        <div class=" text-right" >
            <span class="btn btn-primary cancel">Quay lại</span>
        </div>
    </div>

</div>
<script>
    $(document).ready(function(){
        $('.add-tag').click(function(){
            $('.model-over').css('display','flex');
        })
        $('.icon-close').click(function (){
            $('.model-over').css('display','none');
        })
        $('.cancel').click(function (e){
            e.preventDefault();
            $('.model-over').css('display','none');
        })
    })
</script>
