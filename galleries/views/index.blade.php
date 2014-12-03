@extends("pageblok::templates.base")

@section('content')
{{ Form::open(array('route' => 'app.admin.galleries.delete', 'method' => 'post', 'class' => 'pageblok-list-form', 'onkeypress' => 'return event.keyCode != 13;')) }}
<div class="ts-menu-bar border-bottom">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <a class="btn btn-primary" href="{{ route('app.admin.galleries.create') }}">{{ trans('galleries::app.add.gallery') }}</a>
                <button class="btn btn-danger extra-actions" style="display: none;" type="submit">{{ trans('galleries::app.delete') }}</button>
            </div>
        </div>
    </div>
</div>

<div class="container padded-top">
    <div class="row">
        <div class="col-md-12">
            @if ( count($galleries) )
            <table class="table table-striped table-hover table-condensed pageblok-item-list">
                <tr>
                    <th></th>
                    <th>{{ trans('galleries::app.title') }}</th>
                    <th>{{ trans('galleries::app.description') }}</th>
                    <th>{{ trans('galleries::app.items') }} <i class="fa fa-external-link"></i></th>
                    <th class="status-column">{{ trans('galleries::app.status') }}</th>
                </tr>
                @foreach ( $galleries as $gallery )
                <tr>
                    <td>
                        {{ Form::checkbox('id[]', $gallery->id); }}
                    </td>
                    <td>{{ link_to_route('app.admin.galleries.edit', $gallery->title, array('menuid' => $gallery->id)); }}</td>
                    <td>{{ link_to_route('app.admin.galleries.edit', $gallery->description, array('menuid' => $gallery->id)); }}</td>
                    <td>
                        {{ link_to_route('app.admin.galleries.items', $gallery->items()->count(), array('galleryid' => $gallery->id), array('class' => 'btn btn-default btn-xs')); }}
                    </td>
                    <td>
                        @if ($gallery->published)
                        <span class="label label-success">{{ trans('galleries::app.published') }}</span>
                        @else
                        <span class="label label-warning">{{ trans('galleries::app.draft') }}</span>
                        @endif

                    </td>
                </tr>
                @endforeach
            </table>
            @else
            <p class="alert alert-info">{{ trans('galleries::app.you.have.no.galleries') }} <a href="{{ route('app.admin.galleries.create') }}" class="btn btn-primary">{{ trans('galleries::app.add.gallery') }}</a></p>
            @endif
        </div>
    </div>
</div>
{{ Form::close() }}
@stop