@extends("pageblok::templates.base")

@section('content')
{{ Form::open(array('route' => array($formRoute, $gallery->id), 'method' => 'post', 'class' => 'editor-form')) }}
<div class="border-bottom">
    <div class="container form-group">
        {{ HTML::linkRoute('app.admin.galleries',  trans('galleries::app.cancel'), null, array('class' => 'btn btn-default')) }}
        {{ Form::submit(trans('galleries::app.save'), array('class' => 'btn btn-success')) }}
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-md-12 padded-top">
            <div class="form-group">
                {{ Form::label('pb_name', trans('galleries::app.name')); }}
                {{ Form::text('pb_name', $gallery->pb_name, array('class' => 'form-control', 'autofocus' => 'autofocus', 'placeholder' => trans('galleries::app.name'))); }}
            </div>
            <div class="form-group">
                {{ Form::label('title', trans('galleries::app.title')); }}
                {{ Form::text('title', $gallery->title, array('class' => 'form-control', 'autofocus' => 'autofocus', 'placeholder' => trans('galleries::app.title'))); }}
            </div>
            <div class="form-group">
                {{ Form::label('description', trans('galleries::app.description')); }}
                {{ Form::text('description', $gallery->description, array('class' => 'form-control', 'placeholder' => trans('galleries::app.description'))); }}
            </div>
            <div class="form-group">
                {{ Form::label('template', trans('galleries::app.template')); }}
                {{ Form::select('template', $templates, $gallery->template, array('class' => 'form-control')); }}
            </div>
            <div class="form-group">
                {{ Form::label('class_name', trans('galleries::app.stylesheet')); }}
                {{ Form::text('class_name', $gallery->class_name, array('class' => 'form-control', 'placeholder' => trans('galleries::app.stylesheet'))); }}
            </div>
            <div class="form-group">
                {{ Form::label('publish', trans('galleries::app.publish')); }}
                {{ Form::select('published', array('1' => 'Yes', '0' => 'No'), $gallery->published , array('class' => 'form-control')); }}
            </div>
        </div>
        {{ Form::close() }}
    </div>
</div>
@stop