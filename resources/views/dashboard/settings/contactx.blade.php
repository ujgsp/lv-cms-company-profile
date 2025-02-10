@extends('dashboard.settings.index')

@section('content_settings')
    <div class="card mt-3">
        <div class="card-body">
            <form method="POST" id="options-contact" enctype="multipart/form-data">

                <div class="py-2 form-group">
                    <div class="d-flex justify-content-between">
                        <label class="form-label">
                            Contact E-Mail </label>
                    </div>
                    <input value="info@bitflan.com" class="form-control" id="id-contact-email" type="text"
                        name="key-contact-email" placeholder="Your Contact E-Mail">
                    <small class="text-muted">Contact Form Messages will be sent to this E-Mail</small>
                </div>
                <div class="py-2 form-group">
                    <div class="d-flex justify-content-between">
                        <label class="form-label">
                            E-Mail Sending Type </label>
                    </div>
                    <select class="form-control" id="id-email-type" name="key-email-type" x-init="options_data.email_type = $el.value"
                        x-model="options_data.email_type">
                        <option value="default" selected="">Default PHP Mail</option>
                        <option value="smtp">SMTP</option>
                        <option value="sendgrid">SendGrid API</option>
                    </select>
                    <small class="text-muted">Choose how you want E-Mails to be sent from your website.</small>
                </div>
                <section >
                    <div class="py-2 form-group">
                        <div class="d-flex justify-content-between">
                            <label class="form-label">
                                SMTP Host </label>
                        </div>
                        <input value="" class="form-control" id="id-smtp-host" type="text" name="key-smtp-host"
                            placeholder="smtp.myhost.com">
                        <small class="text-muted">The Host for the SMTP to use.</small>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="py-2 form-group">
                                <div class="d-flex justify-content-between">
                                    <label class="form-label">
                                        SMTP Port </label>
                                </div>
                                <input value="25" class="form-control" id="id-smtp-port" type="number"
                                    name="key-smtp-port" placeholder="Your SMTP Port">
                                <small class="text-muted">The Port for the SMTP.</small>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="py-2 form-group">
                                <div class="d-flex justify-content-between">
                                    <label class="form-label">
                                        SMTP Encryption </label>
                                </div>
                                <select class="form-control" id="id-smtp-encryption" name="key-smtp-encryption">
                                    <option value="none" selected="">None</option>
                                    <option value="ssl">SSL</option>
                                    <option value="tls">TLS</option>
                                </select>
                                <small class="text-muted">Select SMTP Encryption Type.</small>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="py-2 form-group">
                                <div class="d-flex justify-content-between">
                                    <label class="form-label">
                                        SMTP Username </label>
                                </div>
                                <input value="" class="form-control" id="id-smtp-username" type="text"
                                    name="key-smtp-username" placeholder="Your SMTP Username">
                                <small class="text-muted">The SMTP Login Username</small>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="py-2 form-group">
                                <div class="d-flex justify-content-between">
                                    <label class="form-label">
                                        SMTP Password </label>
                                </div>
                                <input value="" class="form-control" id="id-smtp-password" type="text"
                                    name="key-smtp-password" placeholder="Your SMTP Password">
                                <small class="text-muted">The SMTP Login Password</small>
                            </div>
                        </div>
                    </div>
                </section>
                <section x-show="options_data.email_type == `sendgrid`" style="">
                    <div class="py-2 form-group">
                        <div class="d-flex justify-content-between">
                            <label class="form-label">
                                SendGrid API Key </label>
                        </div>
                        <input value="" class="form-control" id="id-sendgrid-api-key" type="text"
                            name="key-sendgrid-api-key" placeholder="Your API Key Here">
                        <small class="text-muted">Specify your API Key provided by SendGrid.</small>
                    </div>
                </section>
                <div class="py-2 form-group">
                    <input type="hidden" name="key-submit" value="true">
                    <input type="hidden" name="form-key" value="contact">

                    <button class="btn btn-primary btn-lg" type="submit">Submit</button>
                </div>
            </form>
        </div>
    </div>
@endsection
