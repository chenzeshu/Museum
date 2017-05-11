
<!-- 触发模态对话框的锚 -->
<a href="#create-folder" class="uk-icon-button uk-icon-plus" data-uk-modal></a>

<!-- 模态对话框 -->
<div id="create-folder" class="uk-modal">
    <div class="uk-modal-dialog">
        <a class="uk-modal-close uk-close"></a>
        {!! Form::open(['route'=>'folders.store','method'=>'post','class'=>'uk-form']) !!}
        <fieldset>
            <legend>新建文件夹</legend>
            <div class="uk-form-row">
                {!! Form::label('name','文件夹名称：') !!}
                {!! Form::text('name',null) !!}
            </div>
            <div class="uk-form-row">
                {!! Form::label('name','文件夹描述：') !!}
                {!! Form::textarea('desc',null) !!}
            </div>

            <br>
            <div class="self-center">
                <button type="submit" class="uk-button uk-button-primary">确定</button>
                <a class="uk-modal-close uk-button">取消</a>
            </div>

        </fieldset>
        {!! Form::close() !!}
    </div>
</div>

