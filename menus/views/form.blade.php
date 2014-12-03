@extends("pageblok::templates.base")

@section('content')
{{ Form::open(array('route' => array($formRoute, $menu->id), 'method' => 'post', 'class' => 'editor-form')) }}
<div class="border-bottom">
    <div class="container form-group">
        {{ HTML::linkRoute('app.admin.menus',  trans("menus::app.cancel"), null, array('class' => 'btn btn-default')) }}
        {{ Form::submit(trans("menus::app.save"), array('class' => 'btn btn-success')) }}
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-md-12 padded-top">
            <div class="form-group">
                {{ Form::label('pb_name', trans("menus::app.system.name")); }}
                {{ Form::text('pb_name', $menu->pb_name, array('class' => 'form-control', 'autofocus' => 'autofocus', 'placeholder' => "Hoofdmenu")); }}
            </div>
            <div class="form-group">
                {{ Form::label('description', trans("menus::app.description")); }}
                {{ Form::text('description', $menu->description, array('class' => 'form-control', 'placeholder' => 'Navigatie rechtsboven')); }}
            </div>
            <div class="form-group">
                {{ Form::label('template', 'Template'); }}
                {{ Form::select('template', $templates, $menu->template, array('class' => 'form-control')); }}
            </div>
            <div class="form-group">
                {{ Form::label('css_classes', trans("menus::app.stylesheet")); }}
                {{ Form::text('css_classes', $menu->css_classes, array('class' => 'form-control', 'placeholder' => '.rond .groot')); }}
            </div>
            <div class="form-group">
                {{ Form::label('published', trans("menus::app.publish")); }}
                {{ Form::select('published', array('1' => trans("menus::app.yes"), '0' => trans("menus::app.no")), $menu->published , array('class' => 'form-control')); }}
            </div>
        </div>
    </div>
</div>
{{ Form::close() }}
@stop