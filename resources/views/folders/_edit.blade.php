<!-- 触发模态对话框的按钮 -->
<button class="uk-button uk-button-primary" data-uk-modal="{target:'#edit-folder-{{$folder->id}}'}">修改</button>

<!-- 模态对话框 -->
<div id="edit-folder-{{$folder->id}}" class="uk-modal">
    <div class="uk-modal-dialog">
        <a class="uk-modal-close uk-close"></a>
        {!! Form::model($folder,['route'=>['folders.update', $folder->id],'method'=>'PUT','class'=>'uk-form']) !!}
        <fieldset>
            <legend>修改文件夹</legend>
            <div class="uk-form-row">
                {!! Form::label('name','文件夹名称：') !!}
                {!! Form::text('name',null) !!}
            </div>
            <div class="uk-form-row">
                {!! Form::label('name','文件夹简述：') !!}
                {!! Form::textarea('desc',null) !!}
            </div>
            <br>
            <div class="self-center">
                <button type="submit" class="uk-button uk-button-primary">提交修改</button>
                <a class="uk-modal-close uk-button">取消</a>
            </div>

            <style>
                .self-center{
                    margin-left:90px;
                }
            </style>
        </fieldset>
        {!! Form::close() !!}
    </div>
</div>

