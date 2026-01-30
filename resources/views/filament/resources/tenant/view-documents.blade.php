<div class="space-y-4">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        {{-- Pengesahan Badan Hukum --}}
        <div class="border rounded-lg p-4">
            <h3 class="font-semibold text-lg mb-2">Pengesahan Pendirian Badan Hukum</h3>
            @if($record->dokumen_pengesahan)
                <div class="space-y-2">
                    <a href="{{ Storage::disk('public')->url($record->dokumen_pengesahan) }}" 
                       target="_blank" 
                       class="inline-flex items-center gap-2 text-primary-600 hover:underline">
                        <x-heroicon-o-document-text class="w-5 h-5" />
                        Lihat Dokumen
                    </a>
                    <a href="{{ Storage::disk('public')->url($record->dokumen_pengesahan) }}" 
                       download 
                       class="inline-flex items-center gap-2 text-gray-600 hover:underline ml-4">
                        <x-heroicon-o-arrow-down-tray class="w-5 h-5" />
                        Download
                    </a>
                </div>
            @else
                <p class="text-gray-500 italic">Belum diupload</p>
            @endif
        </div>

        {{-- Daftar Umum Koperasi --}}
        <div class="border rounded-lg p-4">
            <h3 class="font-semibold text-lg mb-2">Daftar Umum Koperasi</h3>
            @if($record->dokumen_daftar_umum)
                <div class="space-y-2">
                    <a href="{{ Storage::disk('public')->url($record->dokumen_daftar_umum) }}" 
                       target="_blank" 
                       class="inline-flex items-center gap-2 text-primary-600 hover:underline">
                        <x-heroicon-o-document-text class="w-5 h-5" />
                        Lihat Dokumen
                    </a>
                    <a href="{{ Storage::disk('public')->url($record->dokumen_daftar_umum) }}" 
                       download 
                       class="inline-flex items-center gap-2 text-gray-600 hover:underline ml-4">
                        <x-heroicon-o-arrow-down-tray class="w-5 h-5" />
                        Download
                    </a>
                </div>
            @else
                <p class="text-gray-500 italic">Belum diupload</p>
            @endif
        </div>

        {{-- Akte Notaris --}}
        <div class="border rounded-lg p-4">
            <h3 class="font-semibold text-lg mb-2">Akte Notaris Pendirian</h3>
            @if($record->dokumen_akte_notaris)
                <div class="space-y-2">
                    <a href="{{ Storage::disk('public')->url($record->dokumen_akte_notaris) }}" 
                       target="_blank" 
                       class="inline-flex items-center gap-2 text-primary-600 hover:underline">
                        <x-heroicon-o-document-text class="w-5 h-5" />
                        Lihat Dokumen
                    </a>
                    <a href="{{ Storage::disk('public')->url($record->dokumen_akte_notaris) }}" 
                       download 
                       class="inline-flex items-center gap-2 text-gray-600 hover:underline ml-4">
                        <x-heroicon-o-arrow-down-tray class="w-5 h-5" />
                        Download
                    </a>
                </div>
            @else
                <p class="text-gray-500 italic">Belum diupload</p>
            @endif
        </div>

        {{-- NPWP --}}
        <div class="border rounded-lg p-4">
            <h3 class="font-semibold text-lg mb-2">NPWP Koperasi</h3>
            @if($record->dokumen_npwp)
                <div class="space-y-2">
                    <a href="{{ Storage::disk('public')->url($record->dokumen_npwp) }}" 
                       target="_blank" 
                       class="inline-flex items-center gap-2 text-primary-600 hover:underline">
                        <x-heroicon-o-document-text class="w-5 h-5" />
                        Lihat Dokumen
                    </a>
                    <a href="{{ Storage::disk('public')->url($record->dokumen_npwp) }}" 
                       download 
                       class="inline-flex items-center gap-2 text-gray-600 hover:underline ml-4">
                        <x-heroicon-o-arrow-down-tray class="w-5 h-5" />
                        Download
                    </a>
                </div>
            @else
                <p class="text-gray-500 italic">Belum diupload</p>
            @endif
        </div>
    </div>
</div>