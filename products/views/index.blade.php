@extends("pageblok::templates.base")

@section('content')
{{ Form::open(array('route' => 'app.admin.products.delete', 'method' => 'post', 'class' => 'pageblok-list-form', 'onkeypress' => 'return event.keyCode != 13;')) }}
<div class="ts-menu-bar border-bottom">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <a class="btn btn-primary" href="{{ route('app.admin.products.create') }}">{{ trans('products::app.add.product') }}</a>
                <button class="btn btn-danger extra-actions" style="display: none;" type="submit">{{ trans('products::app.delete') }}</button>
            </div>
            <div class="col-md-4">
                @if($categories)
                <div class="dropdown pull-right">
                    <button class="btn btn-default dropdown-toggle" type="button" id="group-menu" data-toggle="dropdown">
                        {{ $selectedCategory }}
                        <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu" role="menu" aria-labelledby="group-menu">
                    <li role="menuitem"><a role="menuitem" tabindex="-1" href="{{ route('app.admin.products') }}">{{ trans('products::app.products') }}</a></li>
                    <li role="menuitem" class="divider"></li>
                    @foreach($categories as $categoryName)
                        <li role="presentation"><a role="menuitem" tabindex="-1" href="{{ route('app.admin.products', array('group' => $categoryName)) }}">{{ $categoryName }}</a></li>
                    @endforeach
                    </ul>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

<div class="container padded-top">
    <div class="row">
        <div class="col-md-12">
            @if ( $products && count($products) )
            <table class="table table-striped table-hover table-condensed pageblok-item-list">
                <tr>
                    <th></th>
                    <th>{{ trans('products::app.name') }}</th>
                    <th>{{ trans('products::app.brand') }}</th>
                    <th>{{ trans('products::app.category') }}</th>
                    <th>{{ trans('products::app.price') }}</th>
                    <th class="status-column">{{ trans('products::app.status') }}</th>
                </tr>
                @foreach ( $products as $product )
                <tr>
                    <td>
                        {{ Form::checkbox('id[]', $product->id); }}
                    </td>
                    <td>{{ link_to_route('app.admin.products.edit', $product->name, array('productid' => $product->id)); }}</td>
                    <td>{{ link_to_route('app.admin.products.edit', $product->brand, array('productid' => $product->id)); }}</td>
                    <td>{{ link_to_route('app.admin.products.edit', $product->category, array('productid' => $product->id)); }}</td>
                    <td>{{ link_to_route('app.admin.products.edit', " € $product->price", array('productid' => $product->id)); }}</td>
                    <td>
                        @if ($product->published)
                        <span class="label label-success">{{ trans('products::app.published') }}</span>
                        @else
                        <span class="label label-warning">{{ trans('products::app.draft') }}</span>
                        @endif

                    </td>
                </tr>
                @endforeach
            </table>
            @else
            <p class="alert alert-info">{{ trans('products::app.you.have.no.products') }} <a href="{{ route('app.admin.products.create') }}" class="btn btn-primary">{{ trans('products::app.add.product') }}</a></p>
            @endif
        </div>
    </div>
    <div class="row">
            <div class="col-md-12">
                <div class="pull-right">
                    {{ $products->links() }}
                </div>
            </div>
        </div>
</div>
{{ Form::close() }}
@stop