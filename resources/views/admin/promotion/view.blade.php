@extends("layouts.adminlayout")
@section("title")
    Chi tiết sự kiện
@endsection
@section("content")
    @if(session('success'))
        <div class="alert alert-success">
            {{session('success')}}
        </div>
    @endif
    <div class="row">
        <div class="col-lg-12">
            <label for="title">Title:</label>
            <span>{{$promotion->title}}</span>
            <hr/>
            <h7>Created at {{date('d/m/Y H:i:s', strtotime($promotion->created_at))}}</h7>
            <hr/>
            <label for="cover">Cover:</label>
            <img src="{{asset($promotion->cover)}}">
            <hr/>
            <label for="content">Content:</label>
            {!! $promotion->content !!}
            <hr/>
            <h7>Start at {{date('d/m/Y H:i:s', strtotime($promotion->StartTime))}}</h7>
            <hr/>
            <h7>End at {{date('d/m/Y H:i:s', strtotime($promotion->EndTime))}}</h7>
            <hr/>
            <p>Tags:</p>
            @foreach($promotion->tags as $tag)
                <span class="badge badge-primary">{{$tag->name}}</span>
            @endforeach

        </div>
    </div>
@endsection
