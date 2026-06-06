@extends('layouts.app-breeze')

@slot('header')
    <div class="flex items-center justify-between">
        <h2 class="text-xl font-semibold text-gray-800">Status Gizi</h2>
        <a href="{{ route('status-gizi.create') }}" class="inline-flex items-center gap-2 px-4 py-2 bg-indigo-600 text-white text-sm font-medium rounded-lg hover:bg-indigo-700 transition shadow-sm">
            <i class="fas fa-plus-circle text-xs"></i> Tambah Status
        </a>
    </div>
@endslot

@section('content')
<div class="py-10">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Filter -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-5 mb-6">
            <form method="GET" class="flex flex-wrap items-end gap-4">
                <div class="flex-1 min-w-[200px]">
                    <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1">Cari Status</label>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Nama status..." class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 text-sm">
                </div>
                <div class="flex gap-2">
                    <button type="submit" class="px-5 py-2 bg-indigo-600 text-white text-sm font-medium rounded-lg hover:bg-indigo-700 transition">Cari</button>
                    @if(request('search'))
                        <a href="{{ route('status-gizi.index') }}" class="px-5 py-2 bg-gray-100 text-gray-700 text-sm font-medium rounded-lg hover:bg-gray-200 transition">Reset</a>
                    @endif
                </div>
            </form>
        </div>

        <!-- Tabel -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-indigo-50">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-indigo-800 uppercase tracking-wider">Nama Status</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-indigo-800 uppercase tracking-wider">Warna</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-indigo-800 uppercase tracking-wider">Keterangan</th>
                            <th class="px-6 py-4 text-right text-xs font-semibold text-indigo-800 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($statuses as $s)
                        <tr>
                            <td class="px-6 py-4 text-sm font-medium text-gray-900">{{ $s->nama_status }}</td>
                            <td class="px-6 py-4 text-sm">
                                <div class="flex items-center gap-2">
                                    <span class="inline-block w-5 h-5 rounded-full border border-gray-200 shadow-sm" style="background: {{ $s->warna }}"></span>
                                    <span class="text-gray-600">{{ $s->warna ?? '—' }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-600">{{ $s->keterangan ?? '—' }}</td>
                            <td class="px-6 py-4 text-right text-sm space-x-3">
                                <a href="{{ route('status-gizi.edit', $s) }}" class="text-indigo-600 hover:text-indigo-800 transition"><i class="far fa-edit"></i> Edit</a>
                                <form action="{{ route('status-gizi.destroy', $s) }}" method="POST" class="inline" onsubmit="return confirm('Yakin hapus status ini?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:text-red-700 transition"><i class="far fa-trash-alt"></i> Hapus</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="px-6 py-12 text-center text-gray-400">
                                <i class="fas fa-chart-line text-3xl mb-2 block"></i>
                                Belum ada data status gizi.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="px-6 py-4 border-t border-gray-100 bg-gray-50/30">
                {{ $statuses->links() }}
            </div>
        </div>
    </div>
</div>
@endsection