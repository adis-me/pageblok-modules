@extends("pageblok::templates.base")

@section('styles')
    <link rel="stylesheet" href="{{ asset('packages/adis-me/pageblok/css/bootstrap-datetimepicker.min.css'); }}">
@stop

@section('content')
{{ Form::open(array('route' => array($formRoute, $event->id), 'method' => 'post', 'class' => 'editor-form create-page', 'files' => true )) }}
<div class="border-bottom">
    <div class="container form-group">
        {{ HTML::linkRoute('app.admin.events',  trans('events::app.cancel'), null, array('class' => 'btn btn-default')) }}
        {{ Form::submit(trans('events::app.save'), array('class' => 'btn btn-success')) }}
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-md-9 border-right padded-top">
            <div class="form-group">
                {{ Form::label('template', trans('events::app.system.name')); }}
                {{ Form::text('pb_name', $event->pb_name, array('class' => 'form-control', 'id' => 'title', 'autofocus' => 'autofocus', 'placeholder' => 'event name')); }}
            </div>
            <div class="form-group">
                {{ Form::label('title', trans('events::app.title')); }}
                {{ Form::text('title', $event->title, array('class' => 'form-control', 'placeholder' => trans('events::app.title'))); }}
            </div>
            <div class="form-group">
                {{ Form::label('subtitle', trans('events::app.subtitle')); }}
                {{ Form::text('subtitle', $event->subtitle, array('class' => 'form-control', 'placeholder' => trans('events::app.subtitle'))); }}
            </div>
            <div class="form-group">
                {{ Form::label('description', trans('events::app.description')); }}
                {{ Form::textarea('description', $event->description, array('class' => 'form-control', 'placeholder' => trans('events::app.description'), 'rows' => 3)); }}
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        {{ Form::label('start_datetime', trans('events::app.from.date')); }}
                        <div class='input-group date' id='start_datetime'>
                            <input type='text' class="form-control" name="start_datetime" data-date-format="DD-MM-YYYY HH:mm" value="{{ \Carbon::parse($event->start_datetime)->format('d-m-Y H:i') }}" />
                            <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        {{ Form::label('end_datetime', trans('events::app.end.date')); }}
                        <div class='input-group date' id='end_datetime'>
                            <input type='text' class="form-control" name="end_datetime" data-date-format="DD-MM-YYYY HH:mm" value="{{ \Carbon::parse($event->end_datetime)->format('d-m-Y H:i') }}" />
                            <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <textarea class="form-control input-event-level content-editor" name="content" rows="18">{{ $event->content }}</textarea>
            </div>
        </div>
        <div class="col-md-3 padded-top">
            <div class="form-group">
                {{ Form::label('template', trans('events::app.template')); }}
                {{ Form::select('template', $templates, $event->template, array('class' => 'form-control')); }}
            </div>
            <div class="form-group">
                {{ Form::label('content_type', trans('events::app.content.type')); }}
                {{ Form::select('content_type', $contentTypes, 'html' , array('class' => 'form-control')); }}
            </div>
            <div class="form-group">
                {{ Form::label('publish', trans('events::app.publish')); }}
                {{ Form::select('published', array('1' => trans('events::app.yes'), '0' => trans('events::app.no')), $event->published , array('class' => 'form-control')); }}
            </div>
            <div class="form-group">
                {{ Form::label('address', trans('events::app.address')); }}
                {{ Form::text('address', $event->address, array('class' => 'form-control', 'placeholder' => trans('events::app.address'))); }}
            </div>
            <div class="form-group">
                {{ Form::label('city', trans('events::app.city')); }}
                {{ Form::text('city', $event->city, array('class' => 'form-control', 'placeholder' => trans('events::app.city'))); }}
            </div>
            <div class="form-group">
                {{ Form::label('country', trans('events::app.country')); }}
                {{ Form::text('country', $event->country, array('class' => 'form-control', 'placeholder' => trans('events::app.country'))); }}
            </div>
            <div class="form-group">
                {{ Form::label('hyperlink', trans('events::app.hyperlink')); }}
                {{ Form::text('hyperlink', $event->hyperlinkg, array('class' => 'form-control', 'placeholder' => "/" . trans('events::app.hyperlink'))); }}
            </div>
            <div class="form-group">
                {{ Form::label('css_classes', trans('events::app.stylesheet')); }}
                {{ Form::text('css_classes', $event->css_classes, array('class' => 'form-control', 'placeholder' => trans('events::app.stylesheet'))); }}
            </div>
            <div class="form-group">
                {{ Form::label('image_ref', trans('events::app.image')); }}
                <div class="image-preview">
                    @if($event->image_ref)
                        <img class="img-thumbnail center" src="{{ $event->image_ref }}" />
                    @endif
                </div>
                @if($event->image_ref)
                    <input type="hidden" name="remove_image" id="remove_image" value="0" />
                @endif
                <a href="javascript:void(0);" @if(!$event->image_ref) style="display: none;" @endif class="btn btn-danger btn-block img-remove" title="{{ trans("events::app.file.remove") }}">{{ trans("events::app.file.remove") }}</a>
                <span class="btn btn-default btn-block btn-file">
                    {{ trans('events::app.file.upload') }}<input type="file" id="image_ref" name="image_ref" />
                </span
            </div>
        </div>
        {{ Form::close() }}
    </div>
</div>
@stop

@section('scripts')
    <script src="{{ asset('packages/adis-me/pageblok/js/moment.min.js'); }}"></script>
    <script src="{{ asset('packages/adis-me/pageblok/js/bootstrap-datetimepicker.min.js'); }}"></script>
    <script type="text/javascript">
        $(function() {
           $('#start_datetime').datetimepicker({
            useMinutes: false
           });
           $('#end_datetime').datetimepicker({
            useMinutes: false
           });
        });
    </script>
@stop