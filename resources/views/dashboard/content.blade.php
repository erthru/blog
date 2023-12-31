@extends("dashboard.app")
@section("title", "Konten")
@section("main")
    <div class="card">
        <div class="card-body">
            @if(session("successMsg"))
                <div class="alert alert-success">{{ session("successMsg") }}</div>
            @endif
            
            <div class="row">
                <div class="col-12 col-md-9">
                    <h4><strong>KONTEN</strong></h4>
                    <a href="/dashboard/content/add" class="text-success">+ Tambah</a>
                </div>

                <div class="col-12 col-md-3">
                    <form class="form-inline my-2 my-lg-0" action="/dashboard/content" method="get">
                        <input type="search" class="form-control" style="width: 100%" name="query" placeholder="cari konten" value="{{ app('request')->query('query') }}"/>
                    </form>
                </div>
            </div>
        
            <input type="checkbox" id="checkPages" value="1" class="mt-2"/>
            <label>Tampilkan laman saja</label>

            <div class="mt-3 dashboard-main-list">
                @foreach($contents as $content)
                    <h5><strong>{{ $content->title }}</strong></h5>
                    <p class="max-lines-3">{{ strip_tags($content->body) }}</p>

                    <div class="right-block">
                        <a href="/{{ $content->for_url }}" target="blank"><i class="fas fa-globe text-success mr-2"></i><span class="text-success mr-3"><strong>LIHAT</strong></span></a>
                        <a href="/dashboard/content/update/{{ $content->id }}"><i class="fas fa-pencil-alt text-warning mr-2"></i><span class="text-warning mr-3"><strong>PERBARUI</strong></span></a>
                        <a href="#modalDelete" data-toggle="modal" data-content="{{ $content }}"><i class="fas fa-trash text-danger mr-2"></i><span class="text-danger"><strong>HAPUS</strong></span></a>
                    </div>
                    <hr />
                @endforeach
            </div>

            <div class="dashboard-main-pagination">
                <ul class="pagination"></ul>
            </div>

            @if(count($contents) == 0)
                <span class="center-block mt-4">Belum ada Data.</span>
            @endif
        </div>
    </div>

    <div class="modal fade" role="dialog" id="modalDelete">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Konfirmasi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                
                <div class="modal-body">
                    <p id="pModalDelete"></p>
                </div>
                
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">BATAL</button>
                    <a id="aModalDelete" href="/" class="btn btn-danger">HAPUS</a>
                </div>
            </div>
        </div>
    </div>

    <script>
        var prepare = 0;

        if(location.href.indexOf("is_page=1") > -1){
            $("#checkPages").attr("checked", "checked");
        }

        $("#checkPages").change(function (){
            if(this.checked){
                location.href="?is_page=1";
            }else{
                location.href="/dashboard/content";
            }
        });
        
        if("{!! method_exists($contents, 'total') ? $contents->total() : 0 !!}" != 0){
            $(".pagination").twbsPagination({
                totalPages: "{!! method_exists($contents, 'lastPage') ? $contents->lastPage() : 0 !!}",
                visiblePages: 3,
                first: "Awal",
                last: "Terakhir",
                prev: null,
                next: null,
                startPage: isNaN(parseInt("{!! app('request')->query('page') !!}")) ? 1 : parseInt("{!! app('request')->query('page') !!}"),
                onPageClick: (evt, page) => {
                    prepare += 1;

                    if(prepare == 2){
                        if(location.href.indexOf("is_page=1") > -1){
                            location.href = "/dashboard/content?is_page=1&page=" + page;
                        }else{
                            location.href = "/dashboard/content?page=" + page;
                        }                    
                    }
                }
            });
        }

        $("#modalDelete").on("show.bs.modal", (e) => {
            const content = $(e.relatedTarget).data("content");
            $("#aModalDelete").attr("href", "/dashboard/content/delete/"+content.id);
            $("#pModalDelete").append("Hapus " + content.title + " ?");
        });
    </script>
@endsection