<x-app-layout title="Graf">

    <x-slot name="pretitle">
        {{ __('Data') }}
    </x-slot>

    <x-slot name="pagetitle">
        {{ __('Graf') }}
    </x-slot>
    <div class="container-xl">
        <div class="col-12">
            @if(session('status'))
                <x-alert class="alert-danger bg-danger mb-2">
                    Data berhasil dihapus
                </x-alert>
            @endif

            @if(session('success'))
                <x-alert class="alert-success bg-success mb-2">
                    {{ session('success') }}
                </x-alert>
            @endif

            <div class="card">
                <div class="card-body border-bottom py-3">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="text-muted">
                            <button class="btn btn-primary">
                                <a class="d-none d-md-block text-white text-decoration-none"
                                    href="{{ route('grafs.create') }}">
                                    + Tambah data
                                </a>
                                <span class="d-md-none">
                                    + Tambah
                                </span>
                            </button>
                        </div>
                        <form class="d-flex gap-1 align-items-center">
                            <div class="ms-2 d-inline-block">
                                <input type="search" class="form-control" name="search" placeholder="Cari..."
                                    value="{{ @$_GET['search'] }}"
                                    aria-label="Search invoice">
                            </div>
                            <x-primary-button>
                                <span class="d-none d-md-block">Cari...</span>
                                <span class="d-md-none"><svg xmlns="http://www.w3.org/2000/svg" class="icon p-0 m-0"
                                        width="44" height="44" viewBox="0 0 24 24" stroke-width="2"
                                        stroke="currentColor" fill="none" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <circle cx="10" cy="10" r="7" />
                                        <line x1="21" y1="21" x2="15" y2="15" />
                                    </svg></span>
                            </x-primary-button>
                        </form>
                    </div>

                </div>
                <div class="table-responsive">
                    <table class="table card-table table-vcenter text-nowrap datatable">
                        <thead>
                            <tr>
                                <th>NO</th>
                                <th>Mulai</th>
                                <th>Tujuan</th>
                                <th>Jarak</th>
                                <th>Dibuat pada</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $index = ($grafs->currentPage() * $grafs->perPage()) - $grafs->perPage() + 1
                            @endphp
                            @foreach($grafs as $graf)
                                <tr>
                                    <td><a href="invoice.html" class="text-reset" tabindex="-1">{{ $index++ }}</a>
                                    </td>
                                    <td>
                                        {{ $graf->nodeStart->lokasi->nama ?? 'Node '.$graf->start }}
                                    </td>
                                    <td>
                                        {{ $graf->nodeEnd->lokasi->nama ?? 'Node '.$graf->end }}
                                    </td>
                                    <td>
                                        {{ $graf->jarak }}
                                    </td>
                                    <td>
                                        {{ $graf->created_at->toFormattedDateString() }}
                                    </td>
                                    <td class="text-end">
                                        <span class="dropdown">
                                            <button class="btn dropdown-toggle align-text-top"
                                                data-bs-boundary="viewport" data-bs-toggle="dropdown">Actions</button>
                                            <div class="dropdown-menu dropdown-menu-end">
                                                <a class="dropdown-item"
                                                    href="{{ route('lokasi.show',$graf->id) }}">
                                                    Detail
                                                </a>
                                                <form method="POST" id="form{{ $graf->id }}"
                                                    action="{{ route('grafs.destroy',$graf->id) }}">
                                                    @csrf
                                                    @method('delete')
                                                </form>
                                                <a class="dropdown-item" href="#"
                                                    onclick="setDataID('form{{ $graf->id }}')" data-bs-toggle="modal"
                                                    data-bs-target="#modal-danger">
                                                    Delete
                                                </a>
                                            </div>
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="card-footer d-flex align-items-center">
                    {{ $grafs->links('vendor.pagination.default') }}
                    <p class="m-0 text-muted d-none d-md-none">Showing <span>1</span> to <span>8</span> of
                        <span>16</span> entries</p>

                </div>
            </div>
        </div>
    </div>

    <x-modal-danger title="Apakah anda yakin ?" message="Data yang sudah dihapus tidak bisa dikembalikan seperti semula"
        confirmText="Konfirmasi" isConfirm="deleteData()" />

    <script>
        var _form;

        function setDataID(form) {
            _form = document.querySelector(`#${form}`);
        }

        function deleteData() {
            _form.submit();
        }

    </script>
</x-app-layout>
