@extends('dashboard.settings.index')

@section('content_settings')
    <div class="card">
        <div class="card-header">
            <h5 class="card-title mb-0">Appearance Navbar</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('settings.navbar.update', ['option' => 'setting_navbar']) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <div class="form-group">
                        <label class="form-label" for="navbar_default">Enable Default Navbar</label>
                        <div class="form-check form-switch form-switch-md float-end">
                            <input id="navbar_default" class="form-check-input" value="default"
                                name="navbar" type="radio" {{ $opt_appearance_navbar['navbar'] == 'default' ? 'checked' : '' }}>
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <div class="image-preview">
                        <img src="{{ asset('static/images/navbar/navbar-default.png') }}" alt="" id="profileImg"
                            class="img-fluid">
                    </div>
                </div>

                <div class="mb-3">
                    <div class="form-group">
                        <label class="form-label" for="navbar_02">Enable Navbar 02</label>
                        <div class="form-check form-switch form-switch-md float-end">
                            <input id="navbar_02" class="form-check-input" value="02"
                                name="navbar" type="radio" {{ $opt_appearance_navbar['navbar'] == '02' ? 'checked' : '' }}>
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <div class="image-preview">
                        <img src="{{ asset('static/images/navbar/navbar-02.png') }}" alt="" id="profileImg"
                            class="img-fluid">
                    </div>
                </div>

                <div class="py-2 form-group">
                    <button type="submit" name="submit" class="btn btn-primary btn-lg">Update</button>
                </div>
            </form>
        </div>
    </div>
@endsection
