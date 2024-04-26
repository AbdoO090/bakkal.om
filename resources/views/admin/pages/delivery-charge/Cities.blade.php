@extends('admin.master', ['menu' => 'delivery_charge', 'submenu' => 'cities_list'])
@section('title', isset($title) ? $title : '')
@section('content')
    <div id="table-url" data-url="{{ route('admin.citiesList') }}"></div>
    <div class="row">
        <div class="col-md-12">
            <div class="breadcrumb__content">
                <div class="breadcrumb__content__left">
                    <div class="breadcrumb__title">
                        <h2>{{ __('States List') }}</h2>
                    </div>
                </div>
                <div class="breadcrumb__content__right">
                    <nav aria-label="breadcrumb">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ __('Home') }}</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">{{ __('States List') }}</li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="customers__area bg-style mb-30">
                <div class="item-title">
                    <div class="col-xs-6">
                        <button data-bs-toggle="modal" data-bs-target="#createModal1"
                            class="btn btn-md btn-info">{{ __('Add States') }}</button>
                    </div>
                </div>
                <div class="customers__table">
                    <table id="BlogTable" class="row-border data-table-filter table-style">
                        <thead>
                            <tr>
                                <th>{{ __('Governorate') }}</th>
                                <th>{{ __('States') }}</th>
                                <th>{{ __('Charge (in OMR)') }}</th>
                                <th>{{ __('Status') }}</th>
                                <th>{{ __('Action') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="createModal1" tabindex="-1" role="dialog" aria-labelledby="createModalTitle1"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header bg-success">
                    <h5 class="modal-title text-white" id="editModalLongTitle">{{ __('Add') }}</h5>
                    <button type="button" class="close text-white" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form enctype="multipart/form-data" method="POST" action="{{ route('admin.citiesStore') }}">
                    <div class="modal-body">
                        @csrf
                        <div class="input__group mb-25">
                            <label for="name_en">{{ __('English name') }}</label>
                            <input type="text" id="name_en" name="name_en" placeholder="{{ __('English name') }}"
                                required>
                        </div>
                        <div class="input__group mb-25">
                            <label for="name_ar">{{ __('Arabic name') }}</label>
                            <input type="text" id="name_ar" name="name_ar" placeholder="{{ __('Arabic name') }}"
                                required>
                        </div>
                        <div class="input__group mb-25">
                            <label for="exampleInputEmail1">{{ __('Delivery Charge') }}</label>
                            <input type="number" min="0" step="0.01" name="charge"
                                placeholder="{{ __('Delivery Charge') }}" required>
                        </div>

                        <div class="input__group mb-25">
                            <label for="State">{{ __('Governorate') }}</label>
                            <select name="state_id" id="State" required>
                                @foreach ($States as $state)
                                    <option value="{{ $state->id }}">{{ $state->name_en }}</option>
                                @endforeach

                            </select>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger me-2"
                                data-bs-dismiss="modal">{{ __('Close') }}</button>
                            <button type="submit" class="btn btn-primary">{{ __('Add') }}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @foreach ($delivery_charges as $dc)
        <div class="modal fade" id="editModal{{ $dc->id }}" tabindex="-1" role="dialog"
            aria-labelledby="editModalTitle{{ $dc->id }}" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-success">
                        <h5 class="modal-title text-white" id="editModalLongTitle">{{ __('Edit') }}</h5>
                        <button type="button" class="close text-white" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form enctype="multipart/form-data" method="POST"
                        action="{{ route('admin.cities_update', encrypt($dc->id)) }}">
                        <div class="modal-body">
                            @csrf
                            <div class="input__group mb-25">
                                <label for="name_en">{{ __('English name') }}</label>
                                <input type="text" id="name_en" name="name_en"
                                    placeholder="{{ __('English name') }}" required value="{{ $dc->name_en }}">
                            </div>
                            <div class="input__group mb-25">
                                <label for="name_ar">{{ __('Arabic name') }}</label>
                                <input type="text" id="name_ar" name="name_ar"
                                    placeholder="{{ __('Arabic name') }}" required value="{{ $dc->name_ar }}">
                            </div>
                            <div class="input__group mb-25">
                                <label for="exampleInputEmail1">{{ __('Delivery Charge') }}</label>
                                <input type="number" min="0" step="0.01" name="charge"
                                    placeholder="{{ __('Delivery Charge') }}" required value="{{ $dc->charge }}">
                            </div>

                            <div class="input__group mb-25">
                                <label for="State">{{ __('Governorate') }}</label>
                                <select name="state_id" id="State" required>
                                    @foreach ($States as $state)
                                        <option value="{{ $state->id }}"
                                            {{ $dc->state_id == $state->id ? 'selected' : '' }}>{{ $state->name_en }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="input__group mb-25">
                                <label for="status">{{ __('Status') }}</label>
                                <select name="status" id="status" required>
                                    <option value="{{ ACTIVE }}" {{ $dc->Status == ACTIVE ? 'selected' : '' }}>
                                        {{ __('Active') }}</option>
                                    <option value="{{ INACTIVE }}" {{ $dc->Status == INACTIVE ? 'selected' : '' }}>
                                        {{ __('Inactive') }}</option>
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger me-2"
                                data-bs-dismiss="modal">{{ __('Close') }}</button>
                            <button type="submit" class="btn btn-primary">{{ __('Edit') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach
    @push('post_scripts')
        <script src="{{ asset('backend/js/admin/datatables/delivery-charge/Cities.js') }}"></script>
        <!-- Page level custom scripts -->
    @endpush
@endsection
