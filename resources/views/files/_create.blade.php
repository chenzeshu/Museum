<!-- 触发模态对话框的锚 -->
<a href="#create-file" class="uk-icon-button uk-icon-plus" data-uk-modal></a>

<!-- 模态对话框 -->
<div id="create-file" class="uk-modal">
    <div class="uk-modal-dialog uk-modal-dialog-file">
        <a class="uk-modal-close uk-close"></a>
        {!! Form::open(['route'=>'files.store','method'=>'post','class'=>'uk-form']) !!}
        <fieldset data-uk-margin>
            <legend>添加文件</legend>
            <div class="uk-form-row">
                <div class="uk-grid">
                    <div class="uk-width-1-6">
                        {!! Form::label('name','文件名称：') !!}
                    </div>
                    {!! Form::text('name',null) !!}
                    <div class="uk-width-1-6">
                        {!! Form::label('name','拍摄时间：') !!}
                    </div>
                    <form class="uk-form">
                        <input type="text" data-uk-datepicker="{format:'YYYY.MM.DD'}">
                    </form>
                </div>
            </div>
            <div class="uk-form-row">
                <div class="uk-grid">
                    <div class="uk-width-1-6">
                         {!! Form::label('name','剧种：') !!}
                    </div>
                         {!! Form::text('type',null) !!}
                    <div class="uk-width-1-6">
                         {!! Form::label('name','剧团：') !!}
                    </div>
                         {!! Form::text('troupe',null, ['class'=>"uk-form-width-medium"]) !!}
                </div>
            </div>
            <div class="uk-form-row">
                <div class="uk-grid">
                    <div class="uk-width-1-6">
                        {!! Form::label('name','演出地点：') !!}
                    </div>
                        {!! Form::text('address',null) !!}
                    <div class="uk-width-1-6">
                        {!! Form::label('name','主要演员：') !!}
                    </div>
                        {!! Form::text('actor',null, ['class'=>"uk-form-width-medium"]) !!}
                </div>
            </div>
            <div class="uk-form-row">
                <div class="uk-grid">
                    <div class="uk-width-1-6">
                        {!! Form::label('name','剧名：') !!}
                    </div>
                        {!! Form::text('drama',null) !!}
                    <div class="uk-width-1-6">
                        {!! Form::label('name','文件大小：') !!}
                    </div>
                        <input type="text" name="size" readonly="readonly" id="fileSize">
                </div>
            </div>
            <div class="uk-form-row">
                <div class="uk-grid">
                    <div class="uk-width-1-6">
                       {!! Form::label('name','文件路径：') !!}
                    </div>
                       <input type="text" name="path" readonly="readonly" id="filePath">
                    <div class="uk-width-1-6">
                       {!! Form::label('name','格式：') !!}
                    </div>
                       <input type="text" name="ext" readonly="readonly" id="fileExt">
                </div>
            </div>
            <div class="uk-form-file">
                <button class="uk-button">上传文件</button> <span style="font-size:12px;color:#aaa;" id="aetherupload-output">等待上传</span>
                <input type="file" id="aetherupload-file" name="file" onchange="up()">
                <div class="progress " style="height: 6px;margin-bottom: 2px;margin-top: 10px;width: 200px;">
                    <div id="aetherupload-progressbar" style="background:blue;height:6px;width:0;"></div><!--need to have an id "aetherupload-progressbar" here for the progress bar-->
                </div>
            </div>
            <div class="uk-form-row">
                <div class="uk-grid">
                    <div class="uk-width-1-8">
                    <!-- 加载编辑器的容器 -->
                        <textarea id="textarea1" class="wang" name="remark">
                            <p>备注...</p>
                        </textarea>
                    </div>
                </div>
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
<style>
    .uk-modal-dialog-file{
        width:50vw;
        height:85vh;
    }
</style>
@section('customerJS')
    <script type="text/javascript" src="{{asset('js/wang/js/wangEditor.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/md5.js')}}"></script>
    <script type="text/javascript">
        function up(){
            //checkMD5
            var file = $('#aetherupload-file')[0].files[0]
            var fileReader = new FileReader();
            var spark = new SparkMD5();
            blobSlice = File.prototype.mozSlice || File.prototype.webkitSlice || File.prototype.slice
            var currentChunk = 0,
                chunkSize = 2097152,    //切片大小2MB
                start = currentChunk * chunkSize,
                end = start + chunkSize >= file.size ? file.size : start + chunkSize,  //若文件小于2mb则整个文件
                currentFile = blobSlice.call(file, start, end)

            fileReader.readAsBinaryString(currentFile)
            fileReader.onload = function(e){    //
                spark.appendBinary(e.target.result)
                var hexHash = spark.end();                      // hex hash

                $.post("{{route('files.check')}}", {md5:hexHash, _token:"{{csrf_token()}}"}, function (res) {
                        if(res.errno === 0){
                            //uploadFile
                            AetherUpload.upload('../temp')
                        }else{
                            file = null;
                            alert(res.data)
                        }
                })
            }
        }
        //aetherUpload
        AetherUpload.success = function () {
            // Example
//            $('#test1').text(this.fileName);  //原文件名
            $('#fileSize').val(parseFloat(this.fileSize / (1000 * 1000)).toFixed(2) + 'MB');  //原文件大小MB
            $('#filePath').val(this.uploadBaseName + '.' + this.uploadExt);   //上传后的文件名
            $('#fileExt').val( this.uploadExt);   //文件后缀
        }

        //wangEditor
        var editor = new wangEditor('textarea1');
        // 为当前的editor配置密钥
//        editor.config.mapAk = '9d463853f5c1fd4409022fa6ba047d0b';  // 此处换成自己申请的密钥
        // 上传图片（举例）
        editor.config.uploadImgUrl = '{{url('upload/image')}}';
        //图片name
        editor.config.uploadImgFileName = 'image'
        // 配置自定义参数（举例）
        editor.config.uploadParams = {
            '_token':"{{csrf_token()}}"
        };
        // 设置 headers（举例）
        editor.config.uploadHeaders = {
            'Accept' : 'text/x-json'
        };
        // 隐藏掉插入网络图片功能。该配置，只有在你正确配置了图片上传功能之后才可用。
        editor.config.hideLinkImg = true;
        editor.create();
    </script>
@endsection
