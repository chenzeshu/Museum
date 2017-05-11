<!-- 触发模态对话框的按钮 -->
<button class="uk-button" data-uk-modal="{target:'#remark-file-{{$file->id}}'}">备注</button>

<!-- 模态对话框 -->
<div id="remark-file-{{$file->id}}" class="uk-modal">
    <div class="uk-modal-dialog">
        <a class="uk-modal-close uk-close"></a>
        {!! $file->remark !!}
        {!! Form::close() !!}
    </div>
</div>

