@extends('lap::layouts.auth')

@section('title', 'Update Item Reject')
@section('child-content')
    <h2>@yield('title')</h2>

    <form method="POST" action="{{ route('admin.item_rejects.update', $item_reject->id) }}" novalidate data-ajax-form>
        @csrf
        @method('PATCH')

        <div class="list-group">
            <div class="list-group-item">
                <div class="form-group row mb-0">
                    <label for="room_id" class="col-md-2 col-form-label">Room Id</label>
                    <div class="col-md-8">
                        <select name="room_id" id="room_id" class="form-control">
                            <option value=""></option>
                            @foreach(app('App\Room')->orderBy('room_name')->get() as $model)
                                <option value="{{ $model->id }}"{{ $model->id == $item_reject->room_id ? ' selected' : '' }}>{{ $model->room_name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <div class="list-group-item">
                <div class="form-group row mb-0">
                    <label for="item_category_id" class="col-md-2 col-form-label">Item Category Id</label>
                    <div class="col-md-8">
                        <select name="item_category_id" id="item_category_id" class="form-control">
                            <option value=""></option>
                            @foreach(app('App\ItemCategory')->orderBy('id')->get() as $model)
                                <option value="{{ $model->id }}"{{ $model->id == $item_reject->item_category_id ? ' selected' : '' }}>{{ $model->id }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <div class="list-group-item">
                <div class="form-group row mb-0">
                    <label for="item_id" class="col-md-2 col-form-label">Item Id</label>
                    <div class="col-md-8">
                        <select name="item_id" id="item_id" class="form-control">
                            <option value=""></option>
                            @foreach(app('App\Item')->orderBy('item_name')->get() as $model)
                                <option value="{{ $model->id }}"{{ $model->id == $item_reject->item_id ? ' selected' : '' }}>{{ $model->item_name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <div class="list-group-item">
                <div class="form-group row mb-0">
                    <label for="quantity" class="col-md-2 col-form-label">Quantity</label>
                    <div class="col-md-8">
                        <input type="text" name="quantity" id="quantity" class="form-control" value="{{ $item_reject->quantity }}">
                    </div>
                </div>
            </div>

            <div class="list-group-item bg-light text-left text-md-right pb-1">
                <button type="submit" name="_submit" class="btn btn-primary mb-2" value="reload_page">Save</button>
                <button type="submit" name="_submit" class="btn btn-primary mb-2" value="redirect">Save &amp; Go Back</button>
            </div>
        </div>
    </form>
@endsection