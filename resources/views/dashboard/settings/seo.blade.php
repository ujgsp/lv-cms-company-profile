@extends('dashboard.settings.index')

@section('content_settings')
<div class="card">
    <div class="card-header">
        <h5 class="card-title mb-0">SEO Settings</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('settings.seo.update', ['option' => 'setting_seo']) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('put')
            <div class="row">
                <div class="col-6">
                    <h3>Services</h3>
                    <hr>
                    <div class="py-2 form-group">
                        <div class="d-flex justify-content-between">
                            <label class="form-label">Keywords</label>
                        </div>
                        <input value="{{ $opt_seo['seo_service']['keywords'] }}" class="form-control" id="seo_service_keywords" type="text" name="seo_service_keywords" placeholder="SEO Keywords for this Page">
                        <small class="text-muted">Keywords separated by , (comma).</small>
                    </div>
                    <div class="py-2 form-group">
                        <div class="d-flex justify-content-between">
                            <label class="form-label">Description</label>
                        </div>
                        <textarea rows="4" class="form-control" id="seo_service_description" name="seo_service_description" placeholder="Meta Description for this Page...">{{ $opt_seo['seo_service']['description'] }}</textarea>
                        <small class="text-muted">Change the description of the services page.</small>
                    </div>
                </div>
                <div class="col-6">
                    <h3>Projects</h3>
                    <hr>
                    <div class="py-2 form-group">
                        <div class="d-flex justify-content-between">
                            <label class="form-label">Keywords</label>
                        </div>
                        <input value="{{ $opt_seo['seo_project']['keywords'] }}" class="form-control" id="seo_projects_keywords" type="text" name="seo_projects_keywords" placeholder="SEO Keywords for this Page">
                        <small class="text-muted">Keywords separated by , (comma).</small>
                    </div>
                    <div class="py-2 form-group">
                        <div class="d-flex justify-content-between">
                            <label class="form-label">Description</label>
                        </div>
                        <textarea rows="4" class="form-control" id="seo_projects_description" name="seo_projects_description" placeholder="Meta Description for this Page...">{{ $opt_seo['seo_project']['description'] }}</textarea>
                        <small class="text-muted">Change the description of the project page.</small>
                    </div>
                </div>
                <div class="col-6">
                    <h3>News</h3>
                    <hr>
                    <div class="py-2 form-group">
                        <div class="d-flex justify-content-between">
                            <label class="form-label">Keywords</label>
                        </div>
                        <input value="{{ $opt_seo['seo_news']['keywords'] }}" class="form-control" id="seo_news_keywords" type="text" name="seo_news_keywords" placeholder="SEO Keywords for this Page">
                        <small class="text-muted">Keywords separated by , (comma).</small>
                    </div>
                    <div class="py-2 form-group">
                        <div class="d-flex justify-content-between">
                            <label class="form-label">Description</label>
                        </div>
                        <textarea rows="4" class="form-control" id="seo_news_description" name="seo_news_description" placeholder="Meta Description for this Page...">{{ $opt_seo['seo_news']['description'] }}</textarea>
                        <small class="text-muted">Change the description of the news page.</small>
                    </div>
                </div>
                <div class="col-6">
                    <h3>Homepage</h3>
                    <hr>
                    <div class="py-2 form-group">
                        <div class="d-flex justify-content-between">
                            <label class="form-label">Keywords</label>
                        </div>
                        <input value="{{ $opt_seo['seo_homepage']['keywords'] }}" class="form-control" id="seo_homepage_keywords" type="text" name="seo_homepage_keywords" placeholder="SEO Keywords for this Page">
                        <small class="text-muted">Keywords separated by , (comma).</small>
                    </div>
                    <div class="py-2 form-group">
                        <div class="d-flex justify-content-between">
                            <label class="form-label">Description</label>
                        </div>
                        <textarea rows="4" class="form-control" id="seo_homepage_description" name="seo_homepage_description" placeholder="Meta Description for this Page...">{{ $opt_seo['seo_homepage']['description'] }}</textarea>
                        <small class="text-muted">Change the description of the homepage page.</small>
                    </div>
                </div>
            </div>
            <div class="mb-3 form-group">
                <div class="d-flex justify-content-between">
                    <label class="form-label">Open Graph SEO Image</label>
                </div>
                <div class="image-preview">
                    <img src="{{ asset('storage/' . $opt_seo['open_graph_image']) }}"
                        id="profileImg" class="img-fluid">
                    <input type="hidden" name="oldImage" value="{{ $opt_seo['open_graph_image'] }}">
                </div>

                <input name="open_graph_image" id="open_graph_image" type="file" class="form-control mb-2" accept="image/png, image/gif, image/jpeg" onchange="previewFile(this, 'profileImg');">
                <small class="text-muted d-block">Upload an image that appears on Embeds on Social Media and other places.</small>
            </div>

            <div class="py-2 form-group">
                <button type="submit" name="submit" class="btn btn-primary btn-lg">Update</button>
            </div>
        </form>
    </div>
</div>
@endsection
