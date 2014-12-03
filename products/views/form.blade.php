@extends("pageblok::templates.base")

@section('content')
{{ Form::open(array('route' => array($formRoute, $product->id), 'method' => 'post', 'class' => 'editor-form create-page', 'files' => true )) }}
<div class="border-bottom">
    <div class="container form-group">
        {{ HTML::linkRoute('app.admin.products',  trans('products::app.cancel'), null, array('class' => 'btn btn-default')) }}
        {{ Form::submit(trans('products::app.save'), array('class' => 'btn btn-success')) }}
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-md-9 padded-top border-right">
            <div class="form-group">
                {{ Form::label('name', trans('products::app.name')); }}
                {{ Form::text('name', $product->name, array('class' => 'form-control', 'placeholder' => trans('products::app.name'))); }}
            </div>
            <div class="row">
                <div class="form-group col-md-7">
                    {{ Form::label('brand', trans('products::app.brand')); }}
                    {{ Form::text('brand', $product->brand, array('class' => 'form-control', 'placeholder' => trans('products::app.brand'))); }}
                </div>
                <div class="form-group col-md-5">
                    {{ Form::label('price', trans('products::app.price')); }}
                    {{ Form::text('price', $product->price, array('class' => 'form-control', 'placeholder' => trans('products::app.price'))); }}
                </div>
            </div>

            <div class="form-group">
                <textarea class="form-control input-block-level content-editor" name="content" rows="18">{{ $product->content }}</textarea>
            </div>

        </div>
        <div class="col-md-3 padded-top">
            <div class="form-group">
                {{ Form::label('template', trans('products::app.template')); }}
                {{ Form::select('template', $templates, $product->template, array('class' => 'form-control')); }}
            </div>
            <div class="form-group">
                {{ Form::label('content_type', trans('products::app.content.type')); }}
                {{ Form::select('content_type', $contentTypes, 'html' , array('class' => 'form-control')); }}
            </div>
            <div class="form-group">
                {{ Form::label('publish', trans('products::app.publish')); }}
                {{ Form::select('published', array('1' => trans('products::app.yes'), '0' => trans('products::app.no')), $product->published , array('class' => 'form-control')); }}
            </div>
            <div class="form-group">
                {{ Form::label('category', trans('products::app.category')); }}
                {{ Form::text('category', $product->category, array('class' => 'form-control', 'placeholder' => trans('products::app.category'))); }}
            </div>
            <div class="form-group">
                {{ Form::label('hyperlink', trans('products::app.hyperlink')); }}
                {{ Form::text('hyperlink', $product->hyperlink, array('class' => 'form-control', 'placeholder' => "/" . trans('products::app.hyperlink'))); }}
            </div>
            <div class="form-group">
                {{ Form::label('css_classes', trans('products::app.stylesheet')); }}
                {{ Form::text('css_classes', $product->css_classes, array('class' => 'form-control', 'placeholder' => trans('products::app.stylesheet'))); }}
            </div>
            <div class="form-group">
                {{ Form::label('image_ref', trans('products::app.image')); }}
                <div class="image-preview">
                    @if($product->image_ref)
                        <img class="img-thumbnail center" src="{{ $product->image_ref }}" />
                    @endif
                </div>
                @if($product->image_ref)
                    <input type="hidden" name="remove_image" id="remove_image" value="0" />
                @endif
                <a href="javascript:void(0);" @if(!$product->image_ref) style="display: none;" @endif class="btn btn-danger btn-block img-remove" title="{{ trans("products::app.file.remove") }}">{{ trans("products::app.file.remove") }}</a>
                <span class="btn btn-default btn-block btn-file">
                    {{ trans('products::app.file.upload') }}<input type="file" id="image_ref" name="image_ref" />
                </span>

            </div>
        </div>
        {{ Form::close() }}
    </div>
</div>
@stop