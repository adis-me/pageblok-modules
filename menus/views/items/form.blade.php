@extends("pageblok::templates.base")

@section('content')
{{ Form::open(array('route' => array($formRoute, $id), 'method' => 'post', 'class' => 'editor-form edit-menuitems')) }}
<div class="border-bottom">
    <div class="container form-group">
        {{ HTML::linkRoute('app.admin.menus.items',  trans("menus::app.cancel"), array('menuid' => $item->menu_ref), array('class' => 'btn btn-default')) }}
        {{ Form::submit(trans("menus::app.save"), array('class' => 'btn btn-success')) }}
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-md-12 padded-top">
        <input type="hidden" name="menu_ref" value="{{ $item->menu_ref }}" />
        <div class="form-group">
            {{ Form::label('name', trans("menus::app.name")); }}
            {{ Form::text('name', $item->name, array('class' => 'form-control', 'placeholder' => 'Link name', 'autofocus' => 'autofocus')); }}
        </div>
        <div class="form-group">
            {{ Form::label('description', trans("menus::app.description")); }}
            {{ Form::text('description', $item->description, array('class' => 'form-control', 'placeholder' => 'Link beschrijving')); }}
        </div>
        <div class="form-group">
            {{ Form::label('url', trans("menus::app.url")); }}
            {{ Form::text('url', $item->url, array('class' => 'form-control', 'placeholder' => 'http://www.nu.nl/')); }}
        </div>
        <div class="form-group">
            {{ Form::label('type', trans("menus::app.link.type")); }}
            {{ Form::select('type', array('external' => trans('menus::app.link.external'), 'page' => trans('menus::app.link.page')), $item->type, array('class' => 'form-control')); }}
        </div>
        <div class="form-group">
            {{ Form::label('target', trans("menus::app.link.target")); }}
            {{ Form::select('target', array('_self' => trans('menus::app._self'), '_blank' => trans('menus::app._blank')), $item->target, array('class' => 'form-control')); }}
        </div>
        <div class="form-group">
            {{ Form::label('priority', trans("menus::app.priority")); }}
            {{ Form::text('priority', $item->priority, array('class' => 'form-control')); }}
        </div>
        <div class="form-group">
            {{ Form::label('css_classes', trans("menus::app.stylesheet")); }}
            {{ Form::text('css_classes', $item->css_classes, array('class' => 'form-control', 'placeholder' => '.round .strong')); }}
        </div>
        <div class="form-group">
            {{ Form::label('publish', trans("menus::app.publish")); }}
            {{ Form::select('published', array('1' => trans('menus::app.yes'), '0' => trans('menus::app.no')), $item->published, array('class' => 'form-control')); }}
        </div>

        <div class="form-group pull-right">

        </div>

    </div>
</div>
{{ Form::close() }}
@stop
