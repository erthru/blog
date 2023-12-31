@extends("dashboard.app")
@section("title","Konten Perbarui")
@section("main")
    <div class="card">
        <div class="card-body">
            <h4><strong>PERBARUI</strong></h4>
            
            <form class="mt-3" action="/dashboard/content/update/{{ $content->id }}" method="post" enctype="multipart/form-data">
                @csrf

                <div class="row">
                    <div class="col-12 col-md-9">
                        <div class="form-group">
                            <label>Judul</label>
                            <input type="text" class="form-control" placeholder="New Adventure" name="title" value="{{ old('title') ?: $content->title }}"/>
                        </div>
                        
                        <div class="form-group">
                            <label>Isi</label>
                            <textarea type="text" class="form-control" placeholder="Isi konten" name="body" id="body">{{ old("body") ?: $content->body }}</textarea>
                        </div>

                        <button type="submit" class="btn btn-success">SIMPAN</button>
                    
                        @if(count($errors) > 0)
                            <div class="alert alert-danger mt-3">
                                <ul>
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    </div>

                    <div class="col-12 col-md-3">
                        <div class="form-group">
                            <img src="{{ url('img') . '/' . $content->thumb }}" width="100%" height="auto" class="pb-4" id="imgPreview"/>

                            <label>Thumbnail</label>
                            <input type="file" name="thumbnail" id="imgFile">
                        </div>

                        <div class="form-group">
                            <label>Tags (Pisahkan dengan koma)</label>
                            @php
                                $tags = "";

                                foreach($content->tag as $tag){
                                    $tags .= $tag->name . ",";
                                };

                                $tags = substr($tags, 0, -1);
                            @endphp
                            <input type="text" class="form-control" placeholder="travel,food,coding" name="tags" value="{{ $tags }}"/>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        ClassicEditor.create(document.querySelector('#body'), {
            ckfinder: {
                uploadUrl: "/api/open/external/ckeditor_upload_image"
            }
        });
        
        if("{!! $content->thumb !!}" == ""){
            $("#imgPreview").hide();
        }
        
        $("#imgFile").change(function() {
            if (this.files && this.files[0]) {
                var reader = new FileReader();

                reader.onload = (e) => {
                    $("#imgPreview").show();
                    $('#imgPreview').attr('src', e.target.result);
                }

                reader.readAsDataURL(this.files[0]);
            }
        })
    </script>
@endsection