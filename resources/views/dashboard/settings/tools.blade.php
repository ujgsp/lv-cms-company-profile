@extends('dashboard.settings.index')

@section('content_settings')
    <div class="card">
        <div class="card-header">
            <h5 class="card-title mb-2">Menus Settings</h5>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('settings.tools.update', ['option' => 'setting_tools']) }}">
                @csrf
                @method('PUT')

                @foreach ($opt_tools as $key => $nav)
                    <div class="py-2 form-group">
                        <div class="d-inline-flex justify-content-between">
                            <label for="{{ $key }}" class="form-label ">
                                Enable Navigation {{ ucfirst($nav['navig_title']) }}
                            </label>
                        </div>
                        <div class="form-check form-switch form-switch-md float-end">
                            <input type="checkbox" class="form-check-input" id="{{ $key }}" name="{{ $key }}" {{ $nav['navig_status'] == 'enable' ? 'checked' : '' }}>
                        </div>
                        <small class="text-muted d-block">Enable / Disable this Tool.</small>
                    </div>
                @endforeach

                <div class="py-2 form-group">
                    <button type="submit" name="submit" class="btn btn-primary btn-lg">Update</button>
                </div>
            </form>

        </div>
    </div>
@endsection
