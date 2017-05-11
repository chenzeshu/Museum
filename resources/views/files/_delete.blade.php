<!-- 触发模态对话框的按钮 -->
<button class="uk-button uk-button-danger" data-uk-modal="{target:'#delete-file-{{$file->id}}'}">删除</button>

<!-- 模态对话框 -->
<div id="delete-file-{{$file->id}}" class="uk-modal">
    <div class="uk-modal-dialog">
        <a class="uk-modal-close uk-close"></a>
        {!! Form::model($file,['route'=>['files.update', $file->id],'method'=>'delete','class'=>'uk-form']) !!}
        <fieldset>
            <legend>删除文件</legend>
            <p class="uk-text-large">确定删除文件：<span class="uk-text-warning">【{{$file->name}}】</span>?</p>
            <br>
            <div class="self-center">
                <button type="submit" class="uk-button uk-button-primary">确定</button>
                <a class="uk-modal-close uk-button">取消</a>
            </div>

        </fieldset>
        {!! Form::close() !!}
    </div>
</div>

