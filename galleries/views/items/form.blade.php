@extends("pageblok::templates.base")

@section('content')
{{ Form::open(array('route' => array($formRoute, $id), 'method' => 'post',  'files' => true, 'class' => 'editor-form edit-galleryitems')) }}
<div class="border-bottom">
    <div class="container form-group">
        {{ HTML::linkRoute('app.admin.galleries.items',  trans('galleries::app.cancel'), array('galleryid' => $item->gallery_ref), array('class' => 'btn btn-default')) }}
        {{ Form::submit(trans('galleries::app.save'), array('class' => 'btn btn-success')) }}
    </div>
</div>

<div class="container padded-top">
    <div class="row">
        <div class="col-md-9 border-right padded-top">
            <input type="hidden" name="gallery_ref" value="{{ $item->gallery_ref }}" />
            <div class="form-group">
                {{ Form::label('pb_name', trans('galleries::app.name')); }}
                {{ Form::text('pb_name', $item->pb_name, array('class' => 'form-control', 'placeholder' => trans('galleries::app.name'), 'autofocus' => 'autofocus')); }}
            </div>
            <div class="form-group">
                {{ Form::label('title', trans('galleries::app.title')); }}
                {{ Form::text('title', $item->title, array('class' => 'form-control', 'autofocus' => 'autofocus', 'placeholder' => trans('galleries::app.title'))); }}
            </div>
            <div class="form-group">
                {{ Form::label('caption', trans('galleries::app.caption')); }}
                {{ Form::text('caption', $item->caption, array('class' => 'form-control', 'placeholder' => trans('galleries::app.caption'))); }}
            </div>
            <div class="form-group">
                {{ Form::label('class_name', trans('galleries::app.stylesheet')); }}
                {{ Form::text('class_name', $item->class_name, array('class' => 'form-control', 'placeholder' => trans('galleries::app.stylesheet'))); }}
            </div>
            <div class="form-group">
                {{ Form::label('publish', trans('galleries::app.publish')); }}
                {{ Form::select('published', array('1' => 'Yes', '0' => 'No'), $item->published, array('class' => 'form-control', 'placeholder' => 'Publish')); }}
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                {{ Form::label('template', trans('galleries::app.template')); }}
                {{ Form::select('template', $templates, $item->template, array('class' => 'form-control')); }}
            </div>
            <div class="form-group">
                {{ Form::label('image_ref', trans('galleries::app.image')); }}
                <div class="image-preview">
                    @if($item->image_ref)
                        <img class="img-thumbnail center" src="{{ $item->image_ref }}" />
                    @endif
                </div>
                @if($item->image_ref)
                    <input type="hidden" name="remove_image" id="remove_image" value="0" />
                @endif
                <a href="javascript:void(0);" @if(!$item->image_ref) style="display: none;" @endif class="btn btn-danger btn-block img-remove" title="{{ trans("galleries::app.file.remove") }}">{{ trans("galleries::app.file.remove") }}</a>
                <span class="btn btn-default btn-block btn-file">
                    {{ trans('galleries::app.file.upload') }}<input type="file" id="image_ref" name="image_ref" />
                </span>
            </div>
        </div>
    </div>
</div>
{{ Form::close() }}
@stop