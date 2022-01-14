@foreach ($gallreys as $gallrey)
<div class="col-lg-3 col-md-6">
    <div class="card">
        <div class="el-card-item">
            @switch($gallrey['file_extension'])
            @case('docx')
            <div class="el-card-avatar el-overlay-1" style="height: 230px;">
                <img src="{{asset('storage/images/doc.png')}}"  alt="user" />
                <div class="el-overlay">
                    <ul class="list-style-none el-info">
                        <li class="el-item">
                            <a class="
                              btn
                              default
                              btn-outline
                              image-popup-vertical-fit
                              el-link
                            " href="{{asset($gallrey['file_url'])}}"><i class="mdi mdi-magnify-plus"></i></a>
                        </li>
                        <li class="el-item">
                            <a class="btn default btn-outline el-link" href="javascript:void(0);"><i data-id="{{$gallrey['id']}}" class="fas fa-trash delete"></i></a>
                        </li>
                    </ul>
                </div>
            </div>
            @break
            @case('pdf')
            <div class="el-card-avatar el-overlay-1">
                <img src="{{asset('storage/images/pdf.png')}}" alt="user" />
                <div class="el-overlay">
                    <ul class="list-style-none el-info">
                        <li class="el-item">
                            <a class="
                              btn
                              default
                              btn-outline
                              image-popup-vertical-fit
                              el-link
                            " href="{{asset($gallrey['file_url'])}}"><i class="mdi mdi-magnify-plus"></i></a>
                        </li>
                        <li class="el-item">
                            <a class="btn default btn-outline el-link" href="javascript:void(0);"><i data-id="{{$gallrey['id']}}" class="fas fa-trash delete"></i></a>
                        </li>
                    </ul>
                </div>
            </div>
            @break
            @default
             <div class="el-card-avatar el-overlay-1" style="height: 230px;">
                <img src="{{asset($gallrey['file_url'])}}" alt="user" />
                <div class="el-overlay">
                    <ul class="list-style-none el-info">
                        <li class="el-item">
                            <a class="
                              btn
                              default
                              btn-outline
                              image-popup-vertical-fit
                              el-link
                            " href="{{asset($gallrey['file_url'])}}"><i class="mdi mdi-magnify-plus"></i></a>
                        </li>
                        <li class="el-item">
                            <a class="btn default btn-outline el-link" href="javascript:void(0);"><i data-id="{{$gallrey['id']}}" class="fas fa-trash delete"></i></a>
                        </li>
                    </ul>
                </div>
            </div>
            @endswitch


            <div class="el-card-content">
                <h4 class="mb-0"></h4>
                <span class="text-muted">subtitle of project</span>
            </div>
        </div>
    </div>
</div>
@endforeach
{{-- <span>{{$gallreys->links()}}</span> --}}
<script src="{{asset('assets/libs/magnific-popup/dist/jquery.magnific-popup.min.js')}}"></script>
<script src="{{asset('assets/libs/magnific-popup/meg.init.js')}}"></script>
