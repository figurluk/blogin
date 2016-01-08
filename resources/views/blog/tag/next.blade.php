<?php $i = 0; ?>
@foreach($articles as $article)
    @if($i%4==0 && $i==0)
        <div class="row">
            <div class="col-md-12">
                @elseif($i%4==0)
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                @endif

                <div class="article col-md-3">
                    <h1>{{$article->title}}</h1>
                    <p>{{substr($article->content,0,200)}} <b>...</b></p>
                    <a href="{{action('Blog\ArticlesController@show',$article->code)}}" class="btn btn-danger">Čítaj
                        ďalej</a>
                </div>

                <?php $i++; ?>
                @endforeach

                @if(count($articles)!=0)
            </div>
        </div>
    @endif
    <div id="nextArticles">
    </div>