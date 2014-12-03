@extends("pageblok::templates.base")

@section('content')
{{ Form::open(array('route' => array('app.admin.menus.items.delete', $id), 'method' => 'post', 'class' => 'pageblok-list-form', 'onkeypress' => 'return event.keyCode != 13;')) }}
<div class="ts-menu-bar border-bottom">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <a class="btn btn-primary" href="{{ route('app.admin.menus.items.create', $id) }}">{{ trans("menus::app.add.menuitem") }}</a>
                <button class="btn btn-danger extra-actions" style="display: none;" type="submit">{{ trans("menus::app.delete") }}</button>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-md-12 padded-top">
            @if ( count($items) )
            <table class="table table-striped table-hover table-condensed pageblok-item-list">
                <tr>
                    <th></th>
                    <th>{{ trans('menus::app.name') }}</th>
                    <th>{{ trans('menus::app.description') }}</th>
                    <th>{{ trans('menus::app.url') }} <i class="fa fa-external-link"></i></th>
                    <th>{{ trans('menus::app.priority') }}</th>
                    <th class="status-column">{{ trans('menus::app.status') }}</th>
                </tr>
                @foreach ( $items as $item )
                <tr>
                    <td>
                        {{ Form::checkbox('id[]', $item->id); }}
                    </td>
                    <td>{{ link_to_route('app.admin.menus.items.edit', $item->name, array('itemid' => $item->id)); }}</td>
                    <td>{{ link_to_route('app.admin.menus.items.edit', $item->description, array('itemid' => $item->id)); }}</td>
                    <td>{{ link_to_route('app.admin.menus.items.edit', $item->url, array('itemid' => $item->id)); }}</td>
                    <td>{{ $item->priority; }}</td>
                    <td>
                        @if ($item->published)
                        <span class="label label-success">{{ trans('menus::app.published') }}</span>
                        @else
                        <span class="label label-warning">{{ trans('menus::app.draft') }}</span>
                        @endif
                    </td>
                </tr>
                @endforeach
            </table>
            @else
            <p class="alert alert-info">You have no menu items defined.</p>
            @endif
        </div>
    </div>
</div>
{{ Form::close() }}
@stop
