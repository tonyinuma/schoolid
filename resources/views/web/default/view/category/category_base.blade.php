@extends(getTemplate().'.view.layout.layout')
@section('title')
    {{ get_option('site_title','') }} - {{ !empty($category->title) ? $category->title : 'Categories' }}
@endsection
@section('page')

    <div class="container-fluid">
        <div class="row cat-search-section cat-search-section-s">
            <div class="container">
                <div class="col-md-4 col-sm-6 col-xs-12 cat-icon-container">
                </div>
                <div class="col-md-4">
                    <div class="h-10"></div>
                </div>
                <div class="col-md-4 col-sm-6 col-xs-12">
                    <div class="box box-s">
                        <div class="container-2">
                            <form>
                                {{ csrf_field() }}
                                <input type="search" id="search" name="q" value="{{ !empty(request()->get('q')) ? request()->get('q') : ''  }}" placeholder=" {{ !empty($category->title) ? $category->title : 'Search in all categories' }}"/>
                                <span class="icon"><i class="homeicon mdi mdi-magnify"></i></span>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row cat-tag-section">
            <div class="container">
                <div class="col-md-2 col-xs-12 tab-con">
                    <div class="btn-group" data-toggle="buttons">
                        <label class="btn btn-primary @if($pricing == 'all' || $pricing == '') active @endif">
                            <input type="radio" name="pricing" value="all" @if($pricing == 'all' || $pricing == '') checked @endif> {{ trans('main.all') }}
                        </label>
                        <label class="btn btn-primary @if($pricing == 'free') active @endif">
                            <input type="radio" name="pricing" value="free" @if($pricing == 'free') checked @endif> {{ trans('main.free') }}
                        </label>
                        <label class="btn btn-primary @if($pricing == 'price') active @endif">
                            <input type="radio" name="pricing" value="price" @if($pricing == 'price') checked @endif> {{ trans('main.paid') }}
                        </label>
                    </div>
                </div>
                <div class="col-md-3 col-xs-12 tab-con">
                    <div class="btn-group" data-toggle="buttons">
                        <label class="btn btn-primary @if($course == 'all' || $course == '') active @endif">
                            <input type="radio" name="course" value="all" @if($course == 'all' || $course == '') checked @endif> {{ trans('main.all') }}
                        </label>
                        <label class="btn btn-primary @if($course == 'multi') active @endif">
                            <input type="radio" name="course" value="multi" @if($course == 'multi') checked @endif> {{ trans('main.course') }}
                        </label>
                        <label class="btn btn-primary @if($course == 'webinar') active @endif">
                            <input type="radio" name="course" value="webinar" @if($course == 'webinar') checked @endif> {{ trans('main.webinar') }}
                        </label>
                        <label class="btn btn-primary @if($course == 'one') active @endif">
                            <input type="radio" name="course" value="one" @if($course == 'one') active @endif> {{ trans('main.single') }}
                        </label>
                    </div>
                </div>
                <div class="col-md-5 col-xs-12 text-left tab-con">
                    <div class="form-group">
                        <label class="control-label cont-lab-s" for="inputDefault">{{ trans('main.postal_delivery') }}</label>
                        <div class="switch switch-sm switch-primary sw-prim-s">
                            <input type="hidden" value="0" name="post-sell">
                            <input type="checkbox" name="post-sell" value="1" @if(!empty(request()->get('post-sell')) && request()->get('post-sell') == 1) checked @endif data-plugin-ios-switch/>
                        </div>
                        &nbsp;&nbsp;
                        <label class="control-label cont-lab-s" for="inputDefault">{{ trans('main.supported_course') }}</label>
                        <div class="switch switch-sm switch-primary sw-prim-s">
                            <input type="hidden" value="0" name="support">
                            <input type="checkbox" name="support" value="1" @if(!empty(request()->get('support')) && request()->get('support') == 1) checked @endif data-plugin-ios-switch/>
                        </div>
                        &nbsp;&nbsp;
                        <label class="control-label cont-lab-s" for="inputDefault">{{ trans('main.discount') }}</label>
                        <div class="switch switch-sm switch-primary sw-prim-s">
                            <input type="hidden" value="0" name="post">
                            <input type="checkbox" name="off" value="1" @if($off == 1) checked @endif data-plugin-ios-switch/>
                        </div>
                    </div>
                </div>
                <div class="col-md-2 col-xs-12 text-left tab-con">
                    <div class="form-group pull-left">
                        <select class="form-control" id="order">
                            <option value="new" @if($order == 'new') selected @endif>{{ trans('main.newest') }}</option>
                            <option value="old" @if($order == 'old') selected @endif>{{ trans('main.oldest') }}</option>
                            <option value="price" @if($order == 'price') selected @endif>{{ trans('main.price_ascending') }}</option>
                            <option value="cheap" @if($order == 'cheap') selected @endif>{{ trans('main.price_descending') }}</option>
                            <option value="sell" @if($order == 'sell') selected @endif>{{ trans('main.most_sold') }}</option>
                            <option value="popular" @if($order == 'popular') selected @endif>{{ trans('main.most_popular') }}</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <div class="h-20"></div>
    <div class="container-fluid">
        <div class="row">
            <div class="container">
                <div class="h-20"></div>
                <div class="col-md-12 col-xs-12">
                    <div class="newest-container">
                        <div class="row body body-target body-target-s">
                            <?php $vipIds[] = 0; ?>
                            @if(!empty($vip) && !isset($order) && !isset($pricing) && !isset($course) && !isset($off) && !isset($post_sell) && !isset($q) && !isset($support) && !isset($filters))
                                @foreach($vip as $content)
                                    @if(isset($content->content->id))
                                        <?php
                                            $vipIds[] = $content->content->id;
                                            $meta = arrayToList($content->content->metas, 'option', 'value');
                                        ?>
                                        <div class="col-md-3 col-sm-6 col-xs-12 pagi-content vip-content tab-con">
                                            <a href="/product/{{ $content->content->id }}" title="{{ $content->content->title }}" class="content-box pagi-content-box">

                                                <div class="img-container">
                                                    <img src="{{ $meta['thumbnail'] }}"/>
                                                    <span class="off-badge vip-badge">
                                                        <label class="text-center">{{ trans('main.vip_badge') }}</label>
                                                    </span>
                                                    @if($content->type == 'webinar' || $content->type == 'course+webinar')
                                                        <span class="live_class">Live class</span>
                                                    @endif
                                                </div>
                                                <h3>{!! truncate($content->content->title,30) !!}</h3>
                                                <div class="footer">
                                                    <span class="avatar" title="{{ $content->user->name }}" onclick="window.location.href = '/profile/{{ $content->user->id }}'"><img src="{{ get_user_meta($content['user_id'],'avatar',get_option('default_user_avatar','')) }}"></span>

                                                        <label class="pull-right content-clock">{{ contentDuration($content->id) }}</label>
                                                        <span class="boxicon mdi mdi-clock pull-right"></span>

                                                    <span class="boxicon mdi mdi-wallet pull-left"></span>
                                                    <span class="boxicon mdi mdi-wallet pull-left"></span>
                                                    <label class="pull-left">{{ price($content->id,$content->category_id,$meta['price'])['price_txt'] ?? 0 }}</label>
                                                </div>
                                            </a>
                                        </div>
                                    @endif
                                @endforeach
                            @else
                                <?php $vipIds[] = 0; ?>
                            @endif
                            @foreach($contents as $content)
                                @if(!in_array($content['id'],$vipIds))
                                    <div class="col-md-3 col-sm-6 col-xs-12 pagi-content tab-con">
                                        <a href="/product/{{ $content['id'] }}" title="{{ $content['title'] }}" class="content-box pagi-content-box">

                                            <div class="img-container">
                                                <img src="{{ !empty($content['metas']['thumbnail']) ? $content['metas']['thumbnail'] : '' }}"/>
                                                @if($content['discount'] != null)
                                                    <span class="off-badge">
                                                        <label class="text-center">%{{ !empty($content['discount']['off']) ? $content['discount']['off'] : 0 }}<br><span>{{ trans('main.discount') }}</span></label>
                                                    </span>
                                                @endif
                                                @if($content['type'] == 'webinar' || $content['type'] == 'course+webinar')
                                                    <span class="live_class">Live class</span>
                                                @endif
                                            </div>
                                            <h3>{!! truncate($content['title'],30) !!}</h3>
                                            <div class="footer">
                                                <span class="avatar" title="{{ !empty($content['user']['name']) ? $content['user']['name'] : '' }}" onclick="window.location.href = '/profile/{{ $content['user']['id'] }}'"><img src="{{ get_user_meta($content['user_id'],'avatar',get_option('default_user_avatar','')) }}"></span>

                                                    <label class="pull-right content-clock">{{ contentDuration($content['id']) }}</label>
                                                    <span class="boxicon mdi mdi-clock pull-right"></span>

                                                <span class="boxicon mdi mdi-wallet pull-left"></span>
                                                <label class="pull-left">@if(isset($content['metas']['price'])) {{ price($content['id'],$content['category_id'],$content['metas']['price'])['price_txt'] ?? 0 }} @endif</label>
                                            </div>
                                        </a>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                        <div class="h-10"></div>
                        <div class="pagi text-center center-block col-xs-12"></div>
                        <div class="row pagi-s">
                            @if(isset($ads))
                                @foreach($ads as $ad)
                                    @if($ad->position == 'category-pagination-bottom')
                                        <a href="{{ $ad->url }}"><img src="{{ $ad->image }}" class="{{ $ad->size }}" id="cat-side"></a>
                                    @endif
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('script')
    <script>
        $(function () {
            pagination('.body-target', {{ !empty($setting['site']['category_content_count']) ? $setting['site']['category_content_count'] : 6 }}, 0);
            $('.pagi').pagination({
                items: {!! count($contents) !!},
                itemsOnPage:  {{ !empty($setting['site']['category_content_count']) ? $setting['site']['category_content_count'] : 6 }},
                cssStyle: 'light-theme',
                prevText: 'Pre.',
                nextText: 'Next',
                onPageClick: function (pageNumber, event) {
                    pagination('.body-target', {{ !empty($setting['site']['category_content_count']) ? $setting['site']['category_content_count'] : 6 }}, pageNumber - 1);
                }
            });
        });
    </script>
    <script type="application/javascript" src="/assets/default/javascripts/category-page-custom.js"></script>
@endsection
