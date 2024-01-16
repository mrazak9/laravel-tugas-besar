@extends('layouts.app')

@section('title', 'Users')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/selectric/public/selectric.css') }}">
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>All Subject</h1>

                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="#">Subject</a></div>
                    <div class="breadcrumb-item">All Subject</div>
                </div>
            </div>
            <div class="section-body">

                <div class="row">
                    <div class="col-12">
                        @include('layouts.alert')
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>All Subject</h4>
                                <div class="section-header-button">
                                    {{-- <a href="{{ route('user.create') }}" class="btn btn-primary">New User</a> --}}
                                    <button type="button" class="btn btn-info importSubject" data-toggle="modal"
                                        data-target="#importSubject">
                                        Import Data Subject
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">

                                <div class="float-right">
                                    <form method="GET", action="{{ route('user.index') }}">
                                        <div class="input-group">
                                            <input type="text" class="form-control" placeholder="Search" name="name">
                                            <div class="input-group-append">
                                                <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                                <div class="clearfix mb-3"></div>

                                <div class="table-responsive">
                                    <table class="table-striped table">
                                        {{-- table for this $table->string('title');
                                        $table->bigInteger('lecturer_id')->unsigned();
                                        //semester
                                        $table->string('semester');
                                        //tahun akademik
                                        $table->string('academic_year');
                                        //sks
                                        $table->integer('sks');
                                        //kode matakuliah
                                        $table->string('code'); --}}
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Title</th>
                                                <th>Lecturer</th>
                                                <th>Semester</th>
                                                <th>Academic Year</th>
                                                <th>SKS</th>
                                                {{-- <th>Code</th> --}}
                                                <th>Action</th>
                                            </tr>

                                        </thead>
                                        <tbody>
                                            @foreach ($subjects as $subject)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $subject->title }}</td>
                                                    <td>{{ $subject->lecturer->name }}</td>
                                                    <td>{{ $subject->semester }}</td>
                                                    <td>{{ $subject->academic_year }}</td>
                                                    <td>{{ $subject->sks }}</td>
                                                    {{-- <td>{{ $subject->code }}</td> --}}
                                                    <td>
                                                        <a href="{{ route('subject.edit', $subject->id) }}"
                                                            class="btn btn-warning btn-sm">Edit</a>
                                                        <form method="POST"
                                                            action="{{ route('subject.destroy', $subject->id) }}"
                                                            class="d-inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button class="btn btn-danger btn-sm"
                                                                onclick="return confirm('Are you sure?')">Delete</button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>

                                    </table>
                                </div>
                                <div class="float-right">
                                    {{ $subjects->withQueryString()->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <div class="modal fade" tabindex="-1" role="dialog" id="importSubject">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Import Data Subject</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <p>Silahkan Pilih File Excel
                        </p>
                        <form action="{{ route('subjects.import') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <div class="custom-file">
                                    <label for="file_excel">Pilih File Excel</label>
                                    <input type="file" class="form-control" name="file_excel" id="file_excel"
                                        accept=".xlsx, .xls">
                                </div>
                            </div>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary">Import Data Subject</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <!-- JS Libraies -->
    <script src="{{ asset('library/selectric/public/jquery.selectric.min.js') }}"></script>

    <!-- Page Specific JS File -->
    <script src="{{ asset('js/page/features-posts.js') }}"></script>
@endpush
