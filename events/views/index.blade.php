@extends("pageblok::templates.base")

@section('content')
{{ Form::open(array('route' => 'app.admin.events.delete', 'method' => 'post', 'class' => 'pageblok-list-form', 'onkeypress' => 'return event.keyCode != 13;')) }}
<div class="ts-menu-bar border-bottom">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <a class="btn btn-primary" href="{{ route('app.admin.events.create') }}">{{ trans('events::app.add.event') }}</a>
                <button class="btn btn-danger extra-actions" style="display: none;" type="submit">{{ trans('events::app.delete') }}</button>
            </div>
        </div>
    </div>
</div>

<div class="container padded-top">
    <div class="row">
        <div class="col-md-12">
            @if ( $events && count($events) )
            <table class="table table-striped table-hover table-condensed pageblok-item-list">
                <tr>
                    <th></th>
                    <th>{{ trans('events::app.title') }}</th>
                    <th>{{ trans('events::app.from.date') }}</th>
                    <th>{{ trans('events::app.end.date') }}</th>
                    <th class="status-column">{{ trans('events::app.status') }}</th>
                </tr>
                @foreach ( $events as $event )
                <tr>
                    <td>
                        {{ Form::checkbox('id[]', $event->id); }}
                    </td>
                    <td>{{ link_to_route('app.admin.events.edit', $event->description, array('eventid' => $event->id)); }}</td>
                    <td>{{ \Carbon::parse($event->start_datetime)->format('d-m-Y') }}</td>
                    <td>{{ \Carbon::parse($event->end_datetime)->format('d-m-Y') }}</td>
                    <td>
                        @if ($event->published)
                        <span class="label label-success">{{ trans('events::app.published') }}</span>
                        @else
                        <span class="label label-warning">{{ trans('events::app.draft') }}</span>
                        @endif

                    </td>
                </tr>
                @endforeach
            </table>
            @else
            <p class="alert alert-info">{{ trans('events::app.you.have.no.events') }} <a href="{{ route('app.admin.events.create') }}" class="btn btn-primary">{{ trans('events::app.add.event') }}</a></p>
            @endif
        </div>
    </div>
    {{ Form::close() }}
</div>
@stop