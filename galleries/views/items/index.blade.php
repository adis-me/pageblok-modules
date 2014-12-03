@extends("pageblok::templates.base")

@section('content')
{{ Form::open(array('route' => array('app.admin.galleries.items.delete', $id), 'method' => 'post', 'class' => 'pageblok-list-form', 'onkeypress' => 'return event.keyCode != 13;')) }}
<div class="ts-menu-bar border-bottom">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <a class="btn btn-primary" href="{{ route('app.admin.galleries.items.create', $id) }}">{{ trans('galleries::app.add.item') }}</a>
                <button class="btn btn-danger extra-actions" style="display: none;" type="submit">{{ trans('galleries::app.delete') }}</button>
            </div>
        </div>
    </div>
</div>

<div class="container padded-top">
    <div class="row">
        <div class="col-md-12">
            @if ( count($items) )
            <table class="table table-striped table-hover table-condensed pageblok-item-list">
                <tr>
                    <th></th>
                    <th>{{ trans('galleries::app.title') }}</th>
                    <th>{{ trans('galleries::app.preview') }}</th>
                    <th class="status-column">{{ trans('galleries::app.status') }}</th>
                </tr>
                @foreach ( $items as $item )
                <tr>
                    <td>
                        {{ Form::checkbox('id[]', $item->id); }}
                    </td>
                    <td>{{ link_to_route('app.admin.galleries.items.edit', $item->title, array('itemid' => $item->id)); }}</td>
                    <td>
                       <img src="{{ $item->image_ref }}" class="img-rounded" width="100" />
                    </td>
                    <td>
                        @if ($item->published)
                        <span class="label label-success">{{ trans('galleries::app.published') }}</span>
                        @else
                        <span class="label label-warning">{{ trans('galleries::app.draft') }}</span>
                        @endif
                    </td>
                </tr>
                @endforeach
            </table>
            @else
            <p class="alert alert-info">{{ trans('galleries::app.you.have.no.galleryitems') }} <a href="{{ route('app.admin.galleries.items.create', $id) }}" class="btn btn-primary">{{ trans('galleries::app.add.item') }}</a></p>
            @endif
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="pull-right">
                {{ $items->links() }}
            </div>
        </div>
    </div>
</div>
{{ Form::close() }}
@stop