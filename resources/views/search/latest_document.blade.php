<div class="card px-3">
    <div class="card-body">
        <h6 class="mb-1">{{__('search.latest document')}}</h6>
        <div class="list-unstyled row">
            @foreach(App\KnowledgeProduct::All()->filter(function($knowledge){
                return $knowledge->accessLevel->level_number < 1 && $knowledge->approved;
            })->take(6) as $item)
            <div class="m-2"><a href="{{url('search/detail/'.$item->id)}}">{{$item->title}}</div>
            @endforeach
        </div>
    </div>
</div>