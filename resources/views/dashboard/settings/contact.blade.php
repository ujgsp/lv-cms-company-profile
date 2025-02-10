@extends('dashboard.settings.index')

@section('content_settings')
<form action="{{ route('settings.contact.update', ['option' => 'setting_contact_info']) }}" method="POST"
    enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="card">
        <div class="card-header">
            <h5 class="card-title mb-0">Contact Info</h5>
        </div>
        <div class="card-body">

            <div class="row">
                <div class="col-md-12">

                    <div class="mb-3">
                        <label class="form-label" for="phone">Phone <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone"
                            name="phone" value="{{ $opt_contact->phone }}">

                        @error('phone')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="email">Contact Email <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('email') is-invalid @enderror" id="email"
                            name="email" value="{{ $opt_contact->email }}">

                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="address">Address <span class="text-danger">*</span></label>
                        <textarea rows="2" class="form-control @error('address') is-invalid @enderror" id="address"
                            name="address">{{ $opt_contact->address }}</textarea>

                        @error('address')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="maps">Maps (Optional)</label>
                        <textarea rows="5" class="form-control @error('maps') is-invalid @enderror" id="maps"
                            name="maps">{{ $opt_contact->maps }}</textarea>


                        <small class="text-muted d-block mt-2">Paste the Google Maps embed code here.</small>

                        @error('maps')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <hr class="my-3" style="height: 0.5px;">
                    <div class="mb-3">
                        <div class="form-group">
                            <label class="form-label" for="enable_office_hours">Enable Office Hours</label>
                            <div class="form-check form-switch form-switch-md float-end">
                                <input id="enable_office_hours" class="form-check-input" {{
                                    $opt_contact->enable_office_hours == 'enable' ? 'checked' : '' }} value="enable"
                                name="enable_office_hours" type="checkbox">
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="office_hours">Office Hours (Optional)</label>
                        <textarea rows="3" class="form-control @error('office_hours') is-invalid @enderror"
                            id="office_hours" name="office_hours">{{ $opt_contact->office_hours }}</textarea>

                        <small class="text-muted d-block mt-2">Open-Close Times.</small>

                        @error('office_hours')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>


                </div>
            </div>


        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h5 class="card-title mb-0">SMTP Setting</h5>
        </div>
        <div class="card-body">
            <!-- SMTP -->
            <div class="mb-3">
                <div class="form-group">
                    <label class="form-label" for="smtp_status">Enable SMTP</label>
                    <div class="form-check form-switch form-switch-md float-end">
                        <input id="smtp_status" class="form-check-input" {{
                            $opt_contact->smtp_status === 'enable' ? 'checked' : '' }} value="enable"
                        name="smtp_status" type="checkbox">
                    </div>

                    <small class="text-muted d-block mt-2">The Host for the SMTP to use.</small>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-6">
                    <label class="form-label">SMTP Host <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('smtp_host') is-invalid @enderror" name="smtp_host"
                        value="{{ old('smtp_host', $opt_contact->smtp_host) }}">

                    <small class="text-muted d-block mt-2">The Host for the SMTP to use.</small>

                    @error('smtp_host')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label">SMTP Port <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('smtp_port') is-invalid @enderror" name="smtp_port"
                        value="{{ old('smtp_port', $opt_contact->smtp_port) }}">

                    <small class="text-muted d-block mt-2">The Port for the SMTP.</small>

                    @error('smtp_port')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-6">
                    <label class="form-label">SMTP Username <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('smtp_username') is-invalid @enderror"
                        name="smtp_username" value="{{ old('smtp_username', $opt_contact->smtp_user) }}">

                    <small class="text-muted d-block mt-2">The SMTP Login Username</small>

                    @error('smtp_username')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label">SMTP Password <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('smtp_password') is-invalid @enderror"
                        name="smtp_password" value="{{ old('smtp_password', $opt_contact->smtp_pass) }}">

                    <small class="text-muted d-block mt-2">The SMTP Login Password</small>

                    @error('smtp_password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-6">
                    <label class="form-label">SMTP Encryption <span class="text-danger">*</span></label>
                    <select class="form-select @error('smtp_encryption') is-invalid @enderror" name="smtp_encryption">
                        <option value="tls" {{ old('smtp_encryption', $opt_contact->smtp_encryption) == 'tls' ?
                            'selected' : ''}}>tls</option>
                        <option value="ssl" {{ old('smtp_encryption', $opt_contact->smtp_encryption) == 'ssl' ?
                            'selected' : ''}}>ssl</option>
                    </select>

                    <small class="text-muted d-block mt-2">Select SMTP Encryption Type.</small>

                    @error('smtp_encryption')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label">E-Mail From Name <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('email_from_name') is-invalid @enderror"
                        name="email_from_name" value="{{ old('email_from_name', $opt_contact->email_from_name) }}">

                    <small class="text-muted d-block mt-2">Set Email From Name (Alias)</small>

                    @error('email_from_name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>


        </div>


    </div>
    <div class="form-group">
        <button type="submit" name="submit" class="btn btn-primary btn-lg">Update</button>
    </div>
</form>
@endsection
