<!-- Tabs -->
<div class="card nav-tabs-responsive mb-3 pt-2 search-nav" style="z-index: 1;">
    <ul class="nav nav-tabs nav-tabs-bottom flex-nowrap mb-0">
        <li class="nav-item ">
            <a href="{{url('search/public?q='.$_GET['q'])}}"
                class="nav-link {{Request::is('search/public')?'active':''}}">
                <i class="icon-menu mr-2"></i> {{__('search.all')}}</a></li>
        <li class="nav-item text-center">
            <a href="{{url('search/public/'.'Document?q='.$_GET['q'])}}"
                class="nav-link {{Request::is('search/public/Document')?'active':''}}">
                <i class="icon-image2 mr-2"></i> {{__('search.documents')}}</a></li>
        <li class="nav-item text-center">
            <a href="{{url('search/public/'.'Photo?q='.$_GET['q'])}}"
                class="nav-link {{Request::is('search/public/Photo')?'active':''}}">
                <i class="icon-image2 mr-2"></i> {{__('search.images')}}</a></li>
        <li class="nav-item text-center">
            <a href="{{url('search/public/'.'Video?q='.$_GET['q'])}}"
                class="nav-link {{Request::is('search/public/Video')?'active':''}}">
                <i class="icon-file-play mr-2"></i> {{__('search.videos')}}</a></li>
        <li class="nav-item text-center">
            <a href="{{url('search/public/'.'Project?q='.$_GET['q'])}}"
                class="nav-link {{Request::is('search/public/Project')?'active':''}}">
                <i class="icon-file-play mr-2"></i> {{__('search.project')}}</a></li>
        <li class="nav-item text-center">
            <a href="{{url('search/public/'.'Map?q='.$_GET['q'])}}"
                class="nav-link {{Request::is('search/public/Map')?'active':''}}">
                <i class="icon-file-play mr-2"></i> {{__('search.map')}}</a></li>
    </ul>
</div>
<!-- /tabs -->