@extends($user['vendor'] == 1 ? getTemplate() . '.user.layout.supportlayout' : getTemplate() . '.user.layout_user.supportlayout')

@section('tab4','active')
@section('tab')

    <div class="h-20"></div>
    @if(count($lists) == 0)
        <div class="text-center">
            <img src="/assets/default/images/empty/notification.png">
            <div class="h-20"></div>
            <span class="empty-first-line">{{ trans('main.no_notification_es') }}</span>
            <div class="h-20"></div>
        </div>
    @else
        <div class="col-xs-12">
            <div class="row">
                <div class="table-responsive">
                    <table class="table ucp-table" id="notification-table">
                        <thead class="back-orange">
                        <tr>
                            <th width="200" class="cell-ta">{{ trans('main.title') }}</th>
                            <th class="cell-ta">{{ trans('main.text') }}</th>
                            <th width="200" class="text-center">{{ trans('main.date') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($lists as $item)
                            <tr>
                                <td class="lh180 cell-ta">{{ $item->title }}</td>
                                <td class="lh180 cell-ta">{!!  $item->msg !!}</td>
                                <td class="text-center">{{ date('d F Y H:i',$item->created_at) }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="row">
                @if(empty(request()->get('p')) && $count > 20)
                    <a href="?p=1" class="next-pagination pull-left"><span class="pagicon mdi mdi-chevron-left"></span></a>
                @endif
                @if(!empty(request()->get('p')) && $count>(request()->get('p') + 1) * 20)
                    <a href="?p={{ request()->get('p') + 1 }}" class="next-pagination pull-left"><span class="pagicon mdi mdi-chevron-left"></span></a>
                @endif
                @if(!empty(request()->get('p')) && request()->get('p') > 0)
                    <a href="?p={{ request()->get('p') - 1 }}" class="next-pagination pull-right"><span class="pagicon mdi mdi-chevron-right"></span></a>
                @endif
            </div>
        </div>
    @endif
    <div class="h-20"></div>
@endsection
