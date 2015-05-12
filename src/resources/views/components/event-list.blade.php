<div class="list-group">
    @foreach ($eventSummaryList->toArray() as $eventSummary)
    <a href="{{$eventSummary->getEventCore()->getEventUrl()}}" class="list-group-item" id="#event-id-{{$eventSummary->getEventId()}}">
        <h4 class="list-group-item-heading">
            <small>01/25</small>
            {{$eventSummary->getEventCore()->getEventTitle()}}
            <span class="label label-warning pull-right">
                {{$eventSummary->getEventCapacity()->getAccepted()}} / {{$eventSummary->getEventCapacity()->getCapacityLimit()}} 人
            </span>
        </h4>

        <small>
            <p class="list-group-item-text">
                {{$eventSummary->getEventArea()->getPrefectureCode()->getName()}}
                {{$eventSummary->getEventCore()->getStartDateTime()->formatDateTime()}}
            <span style="padding: 1px;font-weight: bold;font-size: 0.9em;box-sizing: content-box;">

                <span style="color: #009C9C;background: #F0FFF0;">
                    &nbsp;{{$eventSummary->getRating()->getTwitterCount()}} <small>tweets</small>
                </span>&nbsp;
                <span style="color: red;background: #fcc;">
                    &nbsp;{{$eventSummary->getRating()->getHatenaBookmarkCount()}} <small>users</small>
                </span>&nbsp;
                <span style="color: #666699;background: #F0F0FF;">
                    &nbsp;{{$eventSummary->getRating()->getFacebookCount()}} <small>ｲｲﾈ!</small>
                </span>&nbsp;
            </span>
            </p>
        </small>
    </a>
    @endforeach
</div>
