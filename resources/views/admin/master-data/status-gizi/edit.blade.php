@extends('layouts.app-breeze')

@slot('header')
    <h2 class="text-xl font-semibold text-gray-800">Edit Status Gizi</h2>
@endslot

@section('content')
<div class="py-10">
    <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
            <form method="POST" action="{{ route('status-gizi.update', $statusGizi) }}">
                @csrf @method('PUT')
                <div class="space-y-5">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nama Status</label>
                        <input type="text" name="nama_status" value="{{ old('nama_status', $statusGizi->nama_status) }}" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Warna (hex)</label>
                        <div class="flex items-center gap-3">
                            <input type="color" name="warna" value="{{ old('warna', $statusGizi->warna) }}" class="h-10 w-20 border border-gray-300 rounded-lg cursor-pointer">
                            <input type="text" name="warna_text" value="{{ old('warna', $statusGizi->warna) }}" class="flex-1 px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500">
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Keterangan</label>
                        <textarea name="keterangan" rows="3" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500">{{ old('keterangan', $statusGizi->keterangan) }}</textarea>
                    </div>
                    <div class="flex justify-end pt-4">
                        <button type="submit" class="px-5 py-2 bg-indigo-600 text-white text-sm font-medium rounded-lg hover:bg-indigo-700 transition">Update</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection