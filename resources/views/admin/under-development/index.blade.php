@extends('admin.layouts.master')

@section('contents')
    <section class="section">
        <div class="section-header">           
            <h1>Under dervelopment</h1>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                             <img src="{{ asset('admin/assets/img/under-development.jpg') }}" style="margin: 5% 0 0 25%; height: 40%;" alt="Under Development">
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
@endsection

@push('scripts')

    <script src="{{ asset('admin/assets/js/journal-entry.js') }}"></script>

@endpush
